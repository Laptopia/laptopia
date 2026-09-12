import { createServiceState, bezier, dot } from './service-state.js';

export function createBattery(){
  const s=createServiceState();let modules=[],rails=[];
  const point={x:0,y:0};
  function resize(size){
    s.resize(size);modules=[];rails=[];
    const positions=s.mobile?[[.18,.32],[.82,.78]]:[[.10,.26],[.89,.30],[.06,.61],[.86,.67],[.27,.86],[.65,.91]];
    const count=s.mobile?2:s.width<=1024?5:6;
    for(let i=0;i<count;i++)modules.push({x:positions[i][0]*s.width,y:positions[i][1]*s.height,cells:3+i%4,w:s.mobile?90:130,h:s.mobile?13:17,phase:Math.random()*Math.PI*2,active:0});
    // Two pack branches, linked once: a power-distribution composition, not a web.
    const pairs=s.mobile?[[0,1]]:count===5?[[0,2],[2,4],[4,3],[3,1]]:[[0,2],[2,4],[4,5],[5,3],[3,1]];
    for(const [a,b] of pairs){if(a>=count||b>=count)continue;const p=modules[a],q=modules[b];rails.push({a,b,phase:Math.random(),active:0,p:new Float64Array([p.x,p.y,p.x+(q.x-p.x)*.15,p.y+(q.y-p.y)*.4,q.x-(q.x-p.x)*.15,q.y-(q.y-p.y)*.4,q.x,q.y])});}
    s.elements=modules.length+rails.length;
  }
  function render(ctx,dt,reduced){
    s.begin(ctx,dt,reduced);
    for(const m of modules){
      m.active=s.follow(m.active,s.activity(m.x,m.y,240),4);
      const charge=reduced?.48:.45+Math.sin(s.time*.32+m.phase)*.18+m.active*.32;
      for(let k=0;k<m.cells;k++){
        const x=m.x-m.w/2,y=m.y+(k-(m.cells-1)/2)*(m.h+7),level=Math.max(.08,Math.min(1,charge*m.cells-k));
        ctx.lineWidth=.9;ctx.strokeStyle=`rgba(40,49,59,${.13+m.active*.12})`;ctx.beginPath();ctx.roundRect(x,y,m.w,m.h,4);ctx.stroke();
        ctx.fillStyle=`rgba(86,97,110,${.045+level*.08+m.active*.055})`;ctx.beginPath();ctx.roundRect(x+3,y+3,Math.max(1,(m.w-6)*level),m.h-6,2);ctx.fill();
      }
      ctx.lineWidth=1;ctx.strokeStyle='rgba(40,49,59,.15)';ctx.strokeRect(m.x+m.w/2+9,m.y-5,10,10);
      dot(ctx,m.x+m.w/2+14,m.y,.16+m.active*.2,1.8);
    }
    const budget=s.mobile?Math.max(1,Math.round(2-s.quality)):Math.round(5-s.quality*2);let bursts=0;
    for(let i=0;i<rails.length;i++){
      const r=rails[i],p=r.p,a=modules[r.a],b=modules[r.b];r.active=s.follow(r.active,Math.max(a.active,b.active));
      ctx.lineWidth=1;ctx.strokeStyle=`rgba(40,49,59,${.065+r.active*.15})`;ctx.beginPath();ctx.moveTo(p[0],p[1]);ctx.bezierCurveTo(p[2],p[3],p[4],p[5],p[6],p[7]);ctx.stroke();
      bezier(point,p,.5);dot(ctx,point.x,point.y,.12+r.active*.13,2.2);
      if(reduced)continue;
      r.phase=(r.phase+dt*(s.mobile?.04:.055)*(1+r.active*2))%1;
      const burst=s.gust>0&&r.active>.15&&bursts<(s.quality>1?1:2);
      if(i<budget||burst){const t=a.active>b.active?1-r.phase:r.phase;bezier(point,p,t);dot(ctx,point.x,point.y,.22+r.active*.13,1.8,r.active>.5?'88,128,117':'40,49,59');s.particles++;
        if(burst){bezier(point,p,(t+.10)%1);dot(ctx,point.x,point.y,.19,1.4);s.particles++;bursts++;}}
    }
  }
  return{init(){},resize,render,pointerMove:s.pointerMove,setQuality:s.setQuality,getStats(){return{...s.getStats(),modules:modules.length,rails:rails.length};},destroy(){modules=[];rails=[];}};
}
