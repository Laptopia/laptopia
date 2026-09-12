import { createServiceState, bezier, dot, line } from './service-state.js';

export function createBattery() {
  const s = createServiceState();
  let groups = [], rails = [];
  const point = { x: 0, y: 0 };
  function resize(size) {
    s.resize(size); groups = []; rails = [];
    const columns = Math.max(2, Math.round(s.width / (s.mobile ? 170 : 225)));
    const rows = Math.max(2, Math.round(s.height / (s.mobile ? 220 : 170)));
    for (let row = 0; row < rows; row++) for (let col = 0; col < columns; col++) {
      groups.push({ x:(col+.3+Math.random()*.4)*s.width/columns,y:(row+.3+Math.random()*.4)*s.height/rows,
        cells:3+Math.floor(Math.random()*4),phase:Math.random()*Math.PI*2,active:0 });
    }
    function add(a,b) {
      const p=groups[a],q=groups[b];
      rails.push({a,b,phase:Math.random(),points:new Float64Array([p.x,p.y,p.x+(q.x-p.x)*.35,p.y+12,q.x-(q.x-p.x)*.35,q.y-12,q.x,q.y])});
    }
    for (let row=0;row<rows;row++) for(let col=0;col<columns;col++) {
      const i=row*columns+col;
      if(col+1<columns) add(i,i+1);
      if(row+1<rows && col%3===row%3) add(i,i+columns);
    }
    s.elements = groups.length;
  }
  function render(ctx,dt,reduced) {
    s.begin(ctx,dt,reduced);
    for(const g of groups) {
      g.active=s.follow(g.active,s.activity(g.x,g.y,240),4);
      const charge = reduced ? .5 : .5 + Math.sin(s.time * .28 + g.phase) * .22;
      for(let k=0;k<g.cells;k++) {
        const fill=Math.max(0,Math.min(1,(charge+g.active*.35)*g.cells-k));
        const y=g.y+(k-(g.cells-1)/2)*7;
        line(ctx,g.x-22,y,g.x+22,y,.065+fill*.085+g.active*.15);
      }
      dot(ctx,g.x-28,g.y,.12+g.active*.12,1.5);
    }
    const pulseLimit=s.mobile?Math.max(1,Math.round(2-s.quality)):Math.round(7-s.quality*2);
    let bursts=0;
    for(let i=0;i<rails.length;i++) {
      const r=rails[i],p=r.points,a=groups[r.a],b=groups[r.b],active=Math.max(a.active,b.active);
      ctx.strokeStyle=`rgba(40,49,59,${.065+active*.12})`;
      ctx.beginPath();ctx.moveTo(p[0],p[1]);ctx.bezierCurveTo(p[2],p[3],p[4],p[5],p[6],p[7]);ctx.stroke();
      if(reduced) continue;
      r.phase=(r.phase+dt*(s.mobile ? .035 : .045)*(1+active*2))%1;
      const burst=s.gust>0&&active>.15&&bursts<(s.quality>1?1:2);
      if(i<pulseLimit||burst) {
        const t=a.active>b.active?r.phase:1-r.phase;
        bezier(point,p,t);
        dot(ctx,point.x,point.y,.18+active*.08,1.3,active>.5?'88,124,111':'40,49,59');s.particles++;
        if(burst){bezier(point,p,(t+.09)%1);dot(ctx,point.x,point.y,.14,1.1);s.particles++;bursts++;}
      }
    }
  }
  return {init(){},resize,render,pointerMove:s.pointerMove,setQuality:s.setQuality,getStats:s.getStats,
    destroy(){groups=[];rails=[];s.pointer.active=false;}};
}
