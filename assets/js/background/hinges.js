import { createServiceState, line, dot } from './service-state.js';

export function createHinges() {
  const s=createServiceState();let laptops=[];
  function resize(size) {
    s.resize(size);
    const positions=s.mobile?[[.50,.35],[.50,.79]]:[[.24,.34],[.76,.73]];
    laptops=positions.map(([x,y],i)=>({x:x*s.width,y:y*s.height,w:Math.min(s.width*(s.mobile?.72:.36),420),active:0,phase:i*.4}));
    s.elements=laptops.length*14;
  }
  function render(ctx,dt,reduced) {
    s.begin(ctx,dt,reduced);
    for(const p of laptops) {
      const w=p.w,h=w*.53,left=p.x-w/2,top=p.y-h,base=p.y+22;
      const a=Math.max(s.activity(left+30,p.y,200),s.activity(left+w-30,p.y,200));
      p.active=s.follow(p.active,a,4);p.phase=reduced?0:(p.phase+dt*.13)%1;
      ctx.lineWidth=1;ctx.strokeStyle=`rgba(40,49,59,${.12+p.active*.10})`;
      ctx.beginPath();ctx.roundRect(left,top,w,h,9);ctx.stroke();
      ctx.lineWidth=.65;ctx.strokeStyle='rgba(86,97,110,.075)';ctx.strokeRect(left+10,top+10,w-20,h-20);
      ctx.beginPath();ctx.moveTo(left+5,p.y+4);ctx.lineTo(left-15,base+40);ctx.lineTo(left+w+15,base+40);ctx.lineTo(left+w-5,p.y+4);ctx.stroke();
      line(ctx,left-15,base+40,left+w+15,base+40,.13);
      ctx.strokeRect(p.x-w*.10,base+18,w*.20,12);
      for(const sign of [-1,1]) {
        const x=p.x+sign*(w/2-30), activity=s.activity(x,p.y,180), alpha=.15+activity*.19;
        ctx.lineWidth=1;ctx.strokeStyle=`rgba(40,49,59,${alpha})`;
        ctx.beginPath();ctx.roundRect(x-18,p.y-5,36,12,4);ctx.stroke();
        // Hinge knuckles and anchoring brackets, not generic mechanical circles.
        for(let k=-1;k<=1;k++)line(ctx,x+k*9,p.y-5,x+k*9,p.y+7,alpha);
        line(ctx,x,p.y-5,x,top+22,.09+activity*.10);
        line(ctx,x,p.y+7,x,base+25,.09+activity*.10);
        for(const y of [top+22,base+25]){ctx.beginPath();ctx.arc(x,y,3,0,Math.PI*2);ctx.stroke();line(ctx,x-2,y,x+2,y,alpha);}
        // Opening arcs and a short contour wave express load and reinforcement.
        ctx.strokeStyle=`rgba(86,97,110,${.065+activity*.13})`;ctx.lineWidth=.7;
        for(let r=0;r<(s.mobile?1:2);r++){ctx.beginPath();ctx.ellipse(x,p.y,23+r*11,36+r*12,0,Math.PI*1.10,Math.PI*1.85);ctx.stroke();}
        if(!reduced&&activity>.05&&s.qualityName!=='low') {
          const t=(p.phase+sign*.15+1)%1;
          dot(ctx,x,top+22+(h-22)*t,.18+activity*.16,1.7);s.particles++;
        }
        line(ctx,x-12,base+12,x+12,base+25,.07+activity*.10);
        line(ctx,x+12,base+12,x-12,base+25,.07+activity*.10);
      }
    }
  }
  return {init(){},resize,render,pointerMove:s.pointerMove,setQuality:s.setQuality,getStats:s.getStats,destroy(){laptops=[];}};
}
