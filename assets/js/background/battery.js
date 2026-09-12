import { createServiceState, bezier, dot } from './service-state.js';

export function createBattery() {
  const s = createServiceState(); let packs = [], rails = [];
  const point = { x: 0, y: 0 };
  function resize(size) {
    s.resize(size); packs = []; rails = [];
    const positions = s.mobile ? [[.24,.32],[.74,.77]] : [[.12,.28],[.86,.32],[.14,.76],[.84,.78],[.50,.58]];
    const count = s.mobile ? 2 : 5, cellW = s.mobile ? 16 : 22, cellH = s.mobile ? 75 : 112;
    for (let i = 0; i < count; i++) {
      const cells = s.mobile ? 3 + i % 2 : 3 + i % 4, x = positions[i][0] * s.width, y = positions[i][1] * s.height;
      packs.push({ x, y, cells, cellW, cellH, weight: i === 4 ? .23 : 1, phase: i * 1.26, active: 0, junctionX: x + (cells * (cellW + 6) - 6) / 2 + 15 });
    }
    const pairs = s.mobile ? [[0,1]] : [[0,2],[2,4],[4,3],[3,1]];
    for (const [a,b] of pairs) {
      const p = packs[a], q = packs[b];
      rails.push({ a,b,phase:Math.random(),active:0,weight:a===4||b===4?.4:.85,
        points:new Float64Array([p.junctionX,p.y,p.junctionX+(q.junctionX-p.junctionX)*.3,p.y+30,q.junctionX-(q.junctionX-p.junctionX)*.3,q.y-30,q.junctionX,q.y]) });
    }
    s.elements = packs.reduce((n,p) => n + p.cells, 0) + rails.length;
  }
  function render(ctx,dt,reduced) {
    s.begin(ctx,dt,reduced);
    for (const p of packs) {
      p.active = s.follow(p.active,s.activity(p.x,p.y,240)*p.weight,3);
      const width = p.cells*(p.cellW+6)-6, left=p.x-width/2, top=p.y-p.cellH/2;
      ctx.lineWidth=.8;ctx.strokeStyle=`rgba(86,97,110,${.065*p.weight})`;
      // Open retaining brackets join the cylindrical cells into an internal pack.
      ctx.beginPath();ctx.moveTo(left-5,top+16);ctx.lineTo(left-5,top-5);ctx.lineTo(left+width+5,top-5);ctx.lineTo(left+width+5,top+16);
      ctx.moveTo(left-5,top+p.cellH-16);ctx.lineTo(left-5,top+p.cellH+5);ctx.lineTo(left+width+5,top+p.cellH+5);ctx.lineTo(left+width+5,top+p.cellH-16);ctx.stroke();
      for(let cell=0;cell<p.cells;cell++) {
        const x=left+cell*(p.cellW+6), seed=cell%3===0?.30:cell%3===1?.68:.96;
        const ambient=reduced?0:Math.sin(s.time*.24+p.phase+cell*.3)*.07;
        const level=Math.max(.12,Math.min(1,seed+ambient+p.active*(.20+.10*Math.sin(s.time*3-cell*.65)))), innerH=p.cellH-14, fillH=innerH*level;
        ctx.lineWidth=1.1;ctx.strokeStyle=`rgba(40,49,59,${.16*p.weight+p.active*.13})`;
        ctx.beginPath();ctx.roundRect(x,top,p.cellW,p.cellH,p.cellW*.4);ctx.stroke();
        ctx.fillStyle=`rgba(86,97,110,${.075*p.weight+p.active*.055})`;
        ctx.beginPath();ctx.roundRect(x+3,top+7+innerH-fillH,p.cellW-6,fillH,3);ctx.fill();
        ctx.lineWidth=.65;ctx.beginPath();ctx.ellipse(x+p.cellW/2,top+8,p.cellW*.30,2.4,0,0,Math.PI*2);ctx.stroke();
      }
      ctx.lineWidth=.9;ctx.strokeStyle=`rgba(40,49,59,${.12*p.weight+p.active*.16})`;ctx.strokeRect(p.junctionX-5,p.y-8,10,16);
      // Busbars connect each cell terminal to the BMS, rather than floating packs.
      ctx.beginPath();ctx.moveTo(left+p.cellW/2,top-10);ctx.lineTo(left+width-p.cellW/2,top-10);
      for(let cell=0;cell<p.cells;cell++){const terminal=left+cell*(p.cellW+6)+p.cellW/2;
        ctx.moveTo(terminal,top-10);ctx.lineTo(terminal,top);}
      ctx.moveTo(left+width-p.cellW/2,top-10);ctx.lineTo(p.junctionX,top-10);ctx.lineTo(p.junctionX,p.y-8);ctx.stroke();
      ctx.lineWidth=.65;ctx.beginPath();ctx.moveTo(left+4,top+p.cellH+12);ctx.lineTo(left+10,top+p.cellH+12);
      ctx.moveTo(left+7,top+p.cellH+9);ctx.lineTo(left+7,top+p.cellH+15);ctx.stroke();
      dot(ctx,p.junctionX,p.y,.15*p.weight+p.active*.18,1.8);
    }
    const budget=s.mobile?Math.max(1,Math.round(2-s.quality)):Math.round(4-s.quality);let bursts=0;
    for(let i=0;i<rails.length;i++) {
      const r=rails[i],p=packs[r.a],q=packs[r.b],v=r.points;
      r.active=s.follow(r.active,Math.max(p.active,q.active),4);
      ctx.lineWidth=.9;ctx.strokeStyle=`rgba(40,49,59,${(.075+r.active*.13)*r.weight})`;ctx.beginPath();ctx.moveTo(v[0],v[1]);ctx.bezierCurveTo(v[2],v[3],v[4],v[5],v[6],v[7]);ctx.stroke();
      if(reduced)continue;
      r.phase=(r.phase+dt*(s.mobile?.045:.06)*(1+r.active*2))%1;
      const burst=s.gust>0&&r.active>.18&&bursts<(s.quality>1?1:2);
      if(i<budget||burst){const t=p.active>q.active?1-r.phase:r.phase;bezier(point,v,t);
        const center=Math.max(0,1-Math.abs(point.x/s.width-.5)/.27), quiet=1-center*.75;
        dot(ctx,point.x,point.y,(.22+r.active*.15)*quiet,1.8,r.active>.5?'89,127,115':'40,49,59');s.particles++;
        if(burst){bezier(point,v,(t+.09)%1);dot(ctx,point.x,point.y,.16*quiet,1.4);s.particles++;bursts++;}}
    }
  }
  return {init(){},resize,render,pointerMove:s.pointerMove,setQuality:s.setQuality,
    getStats(){return{...s.getStats(),packs:packs.length,cells:packs.reduce((n,p)=>n+p.cells,0),rails:rails.length};},
    destroy(){packs=[];rails=[];}};
}
