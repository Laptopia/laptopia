import { createServiceState, bezier, dot } from './service-state.js';

export function createCooling(){
  const s=createServiceState();let flows=[],vortices=[],corridors=0;
  const point={x:0,y:0},modified=new Float64Array(8);
  function resize(size){
    s.resize(size);flows=[];vortices=[];
    const layouts=s.mobile?[[-.2,.26,.18,.72,.82,.10,1.2,.58]]:[[-.1,.35,.28,.62,.65,.08,1.1,.32],[-.1,.82,.3,.55,.68,.96,1.1,.66],[.10,-.1,.45,.26,-.08,.75,.36,1.1]];
    corridors=s.mobile?1:s.width<=1024?2:3;
    for(let c=0;c<corridors;c++){
      const l=layouts[c];const count=s.mobile?7:9;
      for(let i=0;i<count;i++){
        const offset=(i-(count-1)/2)*(s.mobile?9:11),p=new Float64Array(8);
        for(let k=0;k<4;k++){p[k*2]=l[k*2]*s.width;p[k*2+1]=l[k*2+1]*s.height+offset;}
        const path=new Path2D();path.moveTo(p[0],p[1]);path.bezierCurveTo(p[2],p[3],p[4],p[5],p[6],p[7]);
        const mid={x:0,y:0};bezier(mid,p,.5);
        flows.push({p,path,x:mid.x,y:mid.y,phase:Math.random(),active:0,layer:Math.abs(i-(count-1)/2),corridor:c});
      }
    }
    vortices=s.mobile?[{x:s.width*.82,y:s.height*.62,r:70}]:[{x:s.width*.14,y:s.height*.56,r:105},{x:s.width*.86,y:s.height*.72,r:90}];
    s.elements=flows.length+vortices.length;
  }
  function render(ctx,dt,reduced){
    s.begin(ctx,dt,reduced);
    for(let z=0;z<vortices.length;z++){
      const v=vortices[z];
      // Thin nested thermal contours add depth without a blur or bright heatmap.
      for(let k=0;k<3;k++){ctx.lineWidth=.7;ctx.strokeStyle=`rgba(${z?'87,128,129':'138,106,102'},${.027-k*.005})`;ctx.beginPath();ctx.ellipse(v.x,v.y,v.r+k*18,(v.r+k*18)*.55,.3,k*.5,Math.PI*1.65+k*.5);ctx.stroke();}
    }
    const limit=s.mobile?Math.max(1,Math.round(3-s.quality)):Math.round(12-s.quality*4);
    for(let i=0;i<flows.length;i++){
      const f=flows[i],p=f.p;if(s.quality>1.5&&f.layer>3)continue;
      f.active=s.follow(f.active,Math.max(s.activity(f.x,f.y,270),s.activity(p[2],p[3],270),s.activity(p[4],p[5],270)));
      modified.set(p);
      if(f.active>.002)for(let k=2;k<=4;k+=2){const dx=p[k]-s.pointer.x,dy=p[k+1]-s.pointer.y,scale=f.active*(.05+(s.gust>0?.025:0));modified[k]-=dy*scale;modified[k+1]+=dx*scale;}
      ctx.lineWidth=f.layer===0?1.35:.75;ctx.strokeStyle=`rgba(40,49,59,${.11-f.layer*.013+f.active*.15})`;
      if(f.active<.002)ctx.stroke(f.path);else{ctx.beginPath();ctx.moveTo(modified[0],modified[1]);ctx.bezierCurveTo(modified[2],modified[3],modified[4],modified[5],modified[6],modified[7]);ctx.stroke();}
      if(reduced)continue;
      f.phase=(f.phase+dt*(s.mobile?.06:.085)*(1+f.active*2+(s.gust>0?f.active*2:0)))%1;
      // Distribute animated particles across corridors, rather than the first group only.
      if(i%3===0&&s.particles<limit){bezier(point,modified,f.phase);dot(ctx,point.x,point.y,.22+f.active*.12,1.6,f.active>.5?(f.phase<.5?'137,108,101':'79,132,132'):'40,49,59');s.particles++;}
    }
  }
  return{init(){},resize,render,pointerMove:s.pointerMove,setQuality:s.setQuality,getStats(){return{...s.getStats(),corridors,streams:flows.length,vortices:vortices.length};},destroy(){flows=[];vortices=[];}};
}
