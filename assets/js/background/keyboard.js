import { createServiceState, line, dot } from './service-state.js';

export function createKeyboard(){
  const s=createServiceState();let keys=[],fields=[],lastKey=-1,lastAmbient=-1;
  function resize(size){
    s.resize(size);keys=[];fields=[];lastKey=lastAmbient=-1;
    const layouts=s.mobile?[[.04,.32,3,5]]:s.width<=1024?[[-.04,.34,4,6],[.78,.78,2,4]]:[[-.04,.28,4,7],[.72,.72,3,6]];
    const pitch=s.mobile?55:68;
    for(let f=0;f<layouts.length;f++){
      const l=layouts[f],x=l[0]*s.width,y=l[1]*s.height;const path=new Path2D();
      for(let row=0;row<l[2];row++){
        let px=x+(row%2)*pitch*.2;
        path.moveTo(px-12,y+row*pitch+24);path.lineTo(px+l[3]*pitch,y+row*pitch+24);
        for(let col=0;col<l[3];col++){
          const span=row===l[2]-1&&col===2?2:col===l[3]-1?1.35:1;
          keys.push({x:px,y:y+row*pitch,w:pitch*span-10,h:pitch-20,row,col,field:f,trigger:-100,active:0});
          px+=pitch*span;if(span===2)col++;
        }
      }
      fields.push({path});
    }
    s.elements=keys.length;
  }
  function schedule(index){
    const k=keys[index],reach=s.quality>.5?1:2;
    for(const other of keys){if(other.field!==k.field)continue;const d=Math.abs(other.col-k.col)+Math.abs(other.row-k.row);
      if(d<=reach&&(other.col===k.col||other.row===k.row))other.trigger=s.time+d*.065;
    }
  }
  function render(ctx,dt,reduced){
    s.begin(ctx,dt,reduced);let nearest=-1,best=Infinity;
    if(!reduced&&s.pointer.active&&!s.mobile){
      for(let i=0;i<keys.length;i++){const k=keys[i],dx=k.x+k.w/2-s.pointer.x,dy=k.y+k.h/2-s.pointer.y,d=dx*dx+dy*dy;if(d<best){best=d;nearest=i;}}
      if(best<70*70&&nearest!==lastKey){schedule(nearest);lastKey=nearest;}
    }else lastKey=-1;
    if(!reduced&&Math.floor(s.time/11)!==lastAmbient){lastAmbient=Math.floor(s.time/11);schedule((lastAmbient*7+Math.floor(keys.length/2))%keys.length);}
    ctx.lineWidth=.6;ctx.strokeStyle='rgba(86,97,110,.035)';for(const f of fields)ctx.stroke(f.path);
    const limit=s.mobile?Math.max(1,Math.round(2-s.quality)):Math.round(5-s.quality*2);
    for(const k of keys){
      const age=s.time-k.trigger,ripple=reduced||age<0||age>.5?0:Math.sin(Math.PI*age/.5)*Math.exp(-age*2);
      const hover=s.activity(k.x+k.w/2,k.y+k.h/2,70);
      k.active=s.follow(k.active,Math.max(ripple,hover));const press=k.active*1.8;
      ctx.lineWidth=1.1;ctx.strokeStyle=`rgba(40,49,59,${.11+k.active*.22})`;ctx.fillStyle=`rgba(86,97,110,${.018+k.active*.045})`;
      ctx.beginPath();ctx.roundRect(k.x,k.y+press,k.w,k.h,7);ctx.stroke();ctx.fill();
      if(s.quality<1){ctx.lineWidth=.6;line(ctx,k.x+8,k.y+k.h-4+press,k.x+k.w-8,k.y+k.h-4+press,.055+k.active*.10);}
      if(!reduced&&age>=0&&age<.45&&ripple>.02&&s.particles<limit){dot(ctx,k.x+k.w/2+age*80,k.y+k.h/2,ripple*.25,1.6);s.particles++;}
    }
  }
  return{init(){},resize,render,pointerMove:s.pointerMove,setQuality:s.setQuality,getStats(){return{...s.getStats(),fields:fields.length};},destroy(){keys=[];fields=[];}};
}
