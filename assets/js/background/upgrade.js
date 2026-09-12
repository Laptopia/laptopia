import { createServiceState, line, dot } from './service-state.js';

export function createUpgrade() {
  const s=createServiceState();let systems=[];
  function resize(size) {
    s.resize(size);
    const positions=s.mobile?[[.50,.36],[.50,.79]]:[[.22,.33],[.77,.74]];
    systems=positions.map(([x,y],i)=>({x:x*s.width,y:y*s.height,scale:s.mobile?.70:1,active:0,phase:i*.32}));
    s.elements=systems.length*(s.mobile?18:28);
  }
  function render(ctx,dt,reduced) {
    s.begin(ctx,dt,reduced);
    for(const p of systems) {
      const z=p.scale, left=p.x-130*z,top=p.y-70*z;
      p.active=s.follow(p.active,s.activity(p.x,p.y,250),4);
      p.phase=reduced?0:(p.phase+dt*(.075+p.active*.18))%1;
      ctx.save();ctx.translate(left,top);ctx.scale(z,z);
      ctx.lineWidth=.9;ctx.strokeStyle=`rgba(40,49,59,${.13+p.active*.13})`;
      // Long notched RAM stick, separate M.2 module and system window.
      ctx.beginPath();ctx.moveTo(0,0);ctx.lineTo(190,0);ctx.lineTo(190,42);ctx.lineTo(92,42);ctx.lineTo(92,36);ctx.lineTo(85,36);ctx.lineTo(85,42);ctx.lineTo(0,42);ctx.closePath();ctx.stroke();
      for(let i=0;i<5;i++)ctx.strokeRect(12+i*33,8,24,20);
      ctx.strokeStyle='rgba(86,97,110,.10)';
      for(let i=0;i<(s.mobile?14:24);i++)line(ctx,7+i*(176/(s.mobile?13:23)),34,7+i*(176/(s.mobile?13:23)),41,.12);
      ctx.lineWidth=.9;ctx.strokeStyle=`rgba(40,49,59,${.12+p.active*.13})`;
      ctx.beginPath();ctx.roundRect(0,78,145,34,4);ctx.stroke();
      ctx.beginPath();ctx.arc(7,95,3,0,Math.PI*2);ctx.stroke();
      ctx.strokeRect(24,84,35,22);ctx.strokeRect(68,84,45,22);
      for(let i=0;i<5;i++)line(ctx,132+i*2,104,132+i*2,112,.13);
      ctx.beginPath();ctx.roundRect(210,58,58,64,5);ctx.stroke();
      line(ctx,210,72,268,72,.11);for(let i=0;i<3;i++)dot(ctx,218+i*6,65,.14,1);
      // Two data lanes feed discrete install blocks, without a progress bar.
      for(let lane=0;lane<2;lane++) {
        const startX=lane?145:190,startY=lane?95:21,endY=84+lane*20;
        ctx.strokeStyle=`rgba(86,97,110,${.075+p.active*.14})`;ctx.beginPath();ctx.moveTo(startX,startY);ctx.lineTo(200,startY);ctx.lineTo(200,endY);ctx.lineTo(210,endY);ctx.stroke();
        if(!reduced&&(s.qualityName==='high'||lane===0)) {
          const t=(p.phase+lane*.3)%1, first=200-startX,second=Math.abs(endY-startY),total=first+second+10,d=t*total;
          let x,y;if(d<first){x=startX+d;y=startY;}else if(d<first+second){x=200;y=startY+Math.sign(endY-startY)*(d-first);}else{x=200+d-first-second;y=endY;}
          ctx.fillStyle=`rgba(40,49,59,${.19+p.active*.17})`;ctx.fillRect(x-2,y-2,4,4);s.particles++;
        }
      }
      for(let i=0;i<6;i++) {
        const active=!reduced?Math.max(0,1-Math.abs(p.phase*6-i)):0;
        ctx.fillStyle=`rgba(86,97,110,${.035+active*(.05+p.active*.15)})`;ctx.fillRect(218+(i%3)*14,81+Math.floor(i/3)*18,9,10);
      }
      ctx.restore();
    }
  }
  return {init(){},resize,render,pointerMove:s.pointerMove,setQuality:s.setQuality,getStats:s.getStats,destroy(){systems=[];}};
}
