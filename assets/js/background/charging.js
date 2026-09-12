import { createServiceState, line, dot } from './service-state.js';

// Connector geometry is built once per resize; contacts share the engine loop.
export function createCharging() {
  const s = createServiceState(); let ports = [];
  function resize(size) {
    s.resize(size);
    const positions = s.mobile ? [[.28,.30],[.72,.76]] : [[.17,.27],[.80,.30],[.20,.76],[.79,.77]];
    ports = positions.map(([x,y], index) => {
      const width = s.mobile ? 110 : 172, height = s.mobile ? 54 : 78;
      const p = { x:x*s.width, y:y*s.height, width, height, jack:index%2===1, active:0, phase:index*.21, contacts:[] };
      const count = p.jack ? 4 : s.mobile ? 8 : 12;
      for(let i=0;i<count;i++) p.contacts.push({x:p.x-width*.34+i*width*.68/(count-1), y:p.y+height*.20, length:28+(i%3)*12});
      return p;
    });
    s.elements = ports.reduce((n,p)=>n+p.contacts.length,0);
  }
  function render(ctx,dt,reduced) {
    s.begin(ctx,dt,reduced);
    for(const p of ports) {
      p.active=s.follow(p.active,s.activity(p.x,p.y,220),4);
      p.phase=reduced?0:(p.phase+dt*(.10+p.active*.25))%1;
      const left=p.x-p.width/2, top=p.y-p.height/2;
      ctx.lineWidth=1;ctx.strokeStyle=`rgba(40,49,59,${.13+p.active*.15})`;
      ctx.beginPath();ctx.roundRect(left,top,p.width,p.height,p.jack?8:p.height*.38);ctx.stroke();
      ctx.lineWidth=.7;ctx.beginPath();ctx.roundRect(left+8,top+8,p.width-16,p.height-16,p.jack?4:p.height*.28);ctx.stroke();
      if(p.jack) {
        ctx.beginPath();ctx.arc(p.x,p.y,p.height*.22,0,Math.PI*2);ctx.stroke();dot(ctx,p.x,p.y,.15+p.active*.2,2);
      } else {
        ctx.beginPath();ctx.roundRect(left+20,p.y-6,p.width-40,12,5);ctx.stroke();
      }
      for(let i=0;i<p.contacts.length;i++) {
        const c=p.contacts[i], bottom=p.y+p.height/2+10;
        const local=s.activity(c.x,bottom+15,160), scan=!reduced?Math.max(0,1-Math.abs(p.phase*p.contacts.length-i)/1.4):0;
        const alpha=.085+local*.12+scan*(.04+p.active*.16);
        ctx.strokeStyle=`rgba(86,97,110,${alpha})`;ctx.strokeRect(c.x-2,c.y,4,10);
        line(ctx,c.x,c.y+10,c.x,bottom,alpha);
        line(ctx,c.x,bottom,c.x+(i%2?12:-12),bottom+c.length,alpha);
        dot(ctx,c.x+(i%2?12:-12),bottom+c.length,.12+local*.13,1.5);
        if(!reduced&&scan>.4&&i% (s.qualityName==='high'?2:4)===0) {
          const t=(p.phase*3+i*.11)%1;
          dot(ctx,c.x+(i%2?12:-12)*t,bottom+c.length*t,.19+p.active*.19,1.7);s.particles++;
        }
      }
      // Shell mounting tabs keep the silhouette recognizable as a real connector.
      for(const sign of [-1,1]) {ctx.strokeStyle='rgba(86,97,110,.10)';ctx.strokeRect(p.x+sign*(p.width/2+7)-3,p.y-12,6,24);}
    }
  }
  return {init(){},resize,render,pointerMove:s.pointerMove,setQuality:s.setQuality,getStats:s.getStats,destroy(){ports=[];}};
}
