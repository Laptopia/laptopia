import { createServiceState, dot } from './service-state.js';

export function createPCB() {
  const s = createServiceState();
  let buses = [], zones = [], pads = [], logo, anchorFrame = 0, edgeClip, centerClip;
  const anchor = { x: 0, y: 0, width: 80, source: 'fallback' };
  const scan={bus:-1,progress:1,x:0,y:0,nx:0,ny:0};
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
    scan.bus=-1;scan.progress=1;
    edgeClip=new Path2D();edgeClip.rect(0,0,s.width*.27,s.height);edgeClip.rect(s.width*.73,0,s.width*.27,s.height);
    centerClip=new Path2D();centerClip.rect(s.width*.27,0,s.width*.46,s.height);
    const count = s.mobile ? 2 : s.width <= 1024 ? 4 : 5;
    const locations = s.mobile ? [[.16,.32],[.84,.76]] : [[.12,.32],[.86,.48],[.53,.64],[.25,.83],[.90,.86]];
    for (let i = 0; i < count; i++) {
      const x = locations[i][0] * s.width, y = locations[i][1] * s.height;
      const w = s.mobile ? 100 : 160, h = s.mobile ? 120 : 150;
      const path = new Path2D();
      // Package sizes and small SMD banks distinguish a board from boxed diagrams.
      const chipW=s.mobile?45:i===0?96:i===2?110:52,chipH=chipW*.65;
      path.rect(x-chipW/2,y-chipH/2,chipW,chipH);
      for (let k=0;k<8;k++) {
        const py=y-chipH*.40+k*chipH*.11;
        path.moveTo(x-chipW/2-9,py);path.lineTo(x-chipW/2,py);
        path.moveTo(x+chipW/2,py);path.lineTo(x+chipW/2+9,py);
      }
      for(let k=0;k<4;k++){
        path.rect(x-chipW*.45+k*14,y+chipH/2+17,8,4);
        path.rect(x+chipW/2+20,y-chipH*.30+k*12,4,7);
      }
      for (let k=0;k<8;k++) {
        const px=x-w*.43+(k%4)*w*.22, py=y+h*(k<4?.30:-.34);
        pads.push({x:px,y:py,active:0,weight:!s.mobile&&i===2?.25:1,index:k});
        const detour=chipH/2+12;
        path.moveTo(px,py);path.lineTo(px, y+(k<4?detour:-detour));path.lineTo(x+(k%2?chipW/2+12:-chipW/2-12),y+(k<4?detour:-detour));
      }
      zones.push({x,y,path,active:0,weight:!s.mobile&&i===2?.25:1});
    }
    const total = s.mobile ? 4 : s.width <= 1024 ? 6 : 8;
    for(let i=0;i<total;i++) {
      const z=zones[i%zones.length];
      const detour=s.mobile?40:70;
      buses.push({fraction:(i+.5)/total,x:z.x+(i%2?detour:-detour),y:z.y-25+i%2*50,lane:36+i*11,active:0,phase:Math.random(),weight:z.weight});
    }
    s.elements=buses.length+pads.length+zones.length;
  }
  function strokeBus(ctx,b,x,bend,index){
    ctx.beginPath();ctx.moveTo(x,anchor.y);ctx.lineTo(x,bend);ctx.lineTo(b.x+20,bend);ctx.lineTo(b.x,bend+20);ctx.lineTo(b.x,b.y);ctx.stroke();
    if(index%3===0&&s.quality<1.5){ctx.lineWidth=.6;ctx.beginPath();ctx.moveTo(x+5,anchor.y);ctx.lineTo(x+5,bend-5);ctx.lineTo(b.x+25,bend-5);ctx.lineTo(b.x+5,bend+15);ctx.lineTo(b.x+5,b.y);ctx.stroke();}
  }
  function render(ctx,dt,reduced) {
    s.begin(ctx,dt,reduced);
    for(const z of zones) {
      z.active=s.follow(z.active,s.activity(z.x,z.y,250)*z.weight);
      ctx.lineWidth=.85;ctx.strokeStyle=`rgba(86,97,110,${.13*z.weight+z.active*.08})`;ctx.stroke(z.path);
    }
    const pulseLimit=s.mobile?2:Math.round(5-s.quality);
    let nearest=-1,best=0,sx=0,sy=0,ex=0,ey=0;
    for(let i=0;i<buses.length;i++) {
      const b=buses[i], x=anchor.x+b.fraction*anchor.width, bend=anchor.y+b.lane;
      const probe=s.pointer;
      const horizontal=Math.max(Math.min(x,b.x+20),Math.min(Math.max(x,b.x+20),probe.x));
      const vertical=Math.max(Math.min(bend+20,b.y),Math.min(Math.max(bend+20,b.y),probe.y));
      const hActivity=s.activity(horizontal,bend,240),vActivity=s.activity(b.x,vertical,240),target=Math.max(hActivity,vActivity);
      if(target>best){
        best=target;nearest=i;
        if(hActivity>vActivity){sx=b.x+20;sy=bend;ex=horizontal;ey=bend;}
        else{sx=ex=b.x;sy=Math.abs(probe.y-b.y)<Math.abs(probe.y-bend-20)?b.y:bend+20;ey=vertical;}
      }
      b.active=s.follow(b.active,target*b.weight);
      ctx.lineWidth=i%2?1:1.45;ctx.strokeStyle=`rgba(40,49,59,${.10*b.weight+b.active*.15})`;
      ctx.save();ctx.clip(edgeClip);strokeBus(ctx,b,x,bend,i);ctx.restore();
      ctx.save();ctx.clip(centerClip);ctx.globalAlpha=.25;strokeBus(ctx,b,x,bend,i);ctx.restore();
      if(reduced||i>=pulseLimit)continue;
      // Pulse travels a real orthogonal branch; probe adds a short faster scan.
      const l1=b.lane,l2=Math.abs(b.x+20-x),l3=28.284,l4=Math.abs(b.y-bend-20),total=l1+l2+l3+l4;
      b.phase=(b.phase+dt*(s.mobile?32:55)*(1+b.active*(s.gust>0?4:2))/total)%1;
      let d=b.phase*total,px=x,py=anchor.y;
      if(d<l1)py+=d;
      else if((d-=l1)<l2){px+=Math.sign(b.x+20-x)*d;py=bend;}
      else if((d-=l2)<l3){px=b.x+20-d/Math.SQRT2;py=bend+d/Math.SQRT2;}
      else{d-=l3;px=b.x;py=bend+20+Math.sign(b.y-bend-20)*d;}
      const central=Math.max(0,1-Math.abs(px/s.width-.5)/.28);
      dot(ctx,px,py,(.22+b.active*.22)*(1-central*.8),1.9);s.particles++;
    }
    if(!reduced&&!s.mobile&&s.pointer.active&&best>.15){
      if(nearest!==scan.bus||(scan.progress>=1&&s.gust>.1)){
        scan.bus=nearest;scan.progress=0;scan.x=sx;scan.y=sy;scan.nx=ex;scan.ny=ey;
      }
      if(scan.progress<1&&s.quality<1.5){
        scan.progress=Math.min(1,scan.progress+dt*3);
        const x=scan.x+(scan.nx-scan.x)*scan.progress,y=scan.y+(scan.ny-scan.y)*scan.progress;
        const central=Math.max(0,1-Math.abs(x/s.width-.5)/.28);
        dot(ctx,x,y,.32*(1-central*.8),2);s.particles++;
      }
    }else scan.bus=-1;
    for(const p of pads) {
      const sequence=reduced?0:Math.max(0,Math.sin(s.time*8-p.index*.8));
      p.active=s.follow(p.active,s.activity(p.x,p.y,190)*p.weight*sequence);
      ctx.lineWidth=1;ctx.strokeStyle=`rgba(40,49,59,${.17*p.weight+p.active*.19})`;
      ctx.beginPath();ctx.arc(p.x,p.y,3.2,0,Math.PI*2);ctx.stroke();
      dot(ctx,p.x,p.y,.12*p.weight+p.active*.16,1.1);
    }
  }
  return {init(){logo=document.querySelector('.laptopia-logo');window.addEventListener('scroll',scroll,{passive:true});},resize,render,pointerMove:s.pointerMove,setQuality:s.setQuality,
    getStats(){return{...s.getStats(),buses:buses.length,zones:zones.length,pads:pads.length,anchor:{...anchor}};},
    destroy(){window.removeEventListener('scroll',scroll);cancelAnimationFrame(anchorFrame);buses=[];zones=[];pads=[];logo=null;edgeClip=centerClip=null;}};
}
