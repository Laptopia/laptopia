import { createServiceState, dot } from './service-state.js';

export function createPCB() {
  const s = createServiceState();
  let buses = [], zones = [], pads = [], logo, anchorFrame = 0;
  const anchor = { x: 0, y: 0, width: 80, source: 'fallback' };
  function updateAnchor() {
    anchorFrame = 0;
    const r = logo?.getBoundingClientRect();
    anchor.x = r?.width ? r.left : s.width * .8;
    anchor.y = r?.width ? r.bottom : 48;
    anchor.width = r?.width || 80; anchor.source = r?.width ? 'logo' : 'fallback';
  }
  function scroll() { if (!anchorFrame) anchorFrame = requestAnimationFrame(updateAnchor); }
  function resize(size) {
    s.resize(size); updateAnchor(); buses = []; zones = []; pads = [];
    const count = s.mobile ? 2 : s.width <= 1024 ? 3 : 4;
    const locations = s.mobile ? [[.16,.32],[.84,.76]] : [[.12,.32],[.86,.48],[.25,.83],[.90,.86]];
    for (let i = 0; i < count; i++) {
      const x = locations[i][0] * s.width, y = locations[i][1] * s.height;
      const w = s.mobile ? 100 : 160, h = s.mobile ? 120 : 150;
      const path = new Path2D();
      // Routing islands and package footprints, not a repeating full-screen grid.
      path.roundRect(x-w*.55,y-h*.5,w,h,10);
      path.rect(x-w*.22,y-h*.18,w*.38,h*.28);
      for (let k=0;k<6;k++) {
        const py=y-h*.16+k*7;
        path.moveTo(x-w*.22-12,py);path.lineTo(x-w*.22,py);
        path.moveTo(x+w*.16,py);path.lineTo(x+w*.16+12,py);
      }
      for (let k=0;k<8;k++) {
        const px=x-w*.43+(k%4)*w*.22, py=y+h*(k<4?.30:-.34);
        pads.push({x:px,y:py,active:0});
        path.moveTo(px,py);path.lineTo(px, y+(k<4?22:-22));path.lineTo(x+(k%2?40:-40),y+(k<4?22:-22));
      }
      zones.push({x,y,path,active:0});
    }
    const total = s.mobile ? 4 : s.width <= 1024 ? 6 : 8;
    for(let i=0;i<total;i++) {
      const z=zones[i%zones.length];
      buses.push({fraction:(i+.5)/total,x:z.x+(i%2?25:-25),y:z.y-25+i%2*50,lane:36+i*11,active:0,phase:Math.random()});
    }
    s.elements=buses.length+pads.length+zones.length;
  }
  function render(ctx,dt,reduced) {
    s.begin(ctx,dt,reduced);
    for(const z of zones) {
      z.active=s.follow(z.active,s.activity(z.x,z.y,250));
      ctx.lineWidth=.75;ctx.strokeStyle=`rgba(86,97,110,${.085+z.active*.08})`;ctx.stroke(z.path);
    }
    const pulseLimit=s.mobile?2:Math.round(5-s.quality);
    for(let i=0;i<buses.length;i++) {
      const b=buses[i], x=anchor.x+b.fraction*anchor.width, bend=anchor.y+b.lane;
      b.active=s.follow(b.active,Math.max(s.activity(b.x,b.y,250),s.activity((x+b.x)/2,bend,250)));
      ctx.lineWidth=i%2?1:1.45;ctx.strokeStyle=`rgba(40,49,59,${.10+b.active*.18})`;
      ctx.beginPath();ctx.moveTo(x,anchor.y);ctx.lineTo(x,bend);ctx.lineTo(b.x+20,bend);ctx.lineTo(b.x,bend+20);ctx.lineTo(b.x,b.y);ctx.stroke();
      if(reduced||i>=pulseLimit)continue;
      // Pulse travels a real orthogonal branch; probe adds a short faster scan.
      const l1=b.lane,l2=Math.abs(b.x+20-x),l3=28.284,l4=Math.abs(b.y-bend-20),total=l1+l2+l3+l4;
      b.phase=(b.phase+dt*(s.mobile?32:55)*(1+b.active*(s.gust>0?4:2))/total)%1;
      let d=b.phase*total,px=x,py=anchor.y;
      if(d<l1)py+=d;
      else if((d-=l1)<l2){px+=Math.sign(b.x+20-x)*d;py=bend;}
      else if((d-=l2)<l3){px=b.x+20-d/Math.SQRT2;py=bend+d/Math.SQRT2;}
      else{d-=l3;px=b.x;py=bend+20+Math.sign(b.y-bend-20)*d;}
      dot(ctx,px,py,.22+b.active*.22,1.9);s.particles++;
    }
    for(const p of pads) {
      p.active=s.follow(p.active,s.activity(p.x,p.y,240));
      ctx.lineWidth=1;ctx.strokeStyle=`rgba(40,49,59,${.17+p.active*.19})`;
      ctx.beginPath();ctx.arc(p.x,p.y,3.2,0,Math.PI*2);ctx.stroke();
      dot(ctx,p.x,p.y,.12+p.active*.16,1.1);
    }
  }
  return {init(){logo=document.querySelector('.laptopia-logo');window.addEventListener('scroll',scroll,{passive:true});},resize,render,pointerMove:s.pointerMove,setQuality:s.setQuality,
    getStats(){return{...s.getStats(),buses:buses.length,zones:zones.length,pads:pads.length,anchor:{...anchor}};},
    destroy(){window.removeEventListener('scroll',scroll);cancelAnimationFrame(anchorFrame);buses=[];zones=[];pads=[];logo=null;}};
}
