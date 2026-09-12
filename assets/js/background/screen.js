import { createServiceState, line, dot } from './service-state.js';

export function createScreen() {
  const s=createServiceState();let panels=[],cracks=[],centers=[],pixels=[],pressure=0;
  function resize(size){
    s.resize(size);panels=[];cracks=[];centers=[];pixels=[];pressure=0;
    const layouts=s.mobile?[[.78,.12,.26,.64]]:[[0,.18,.25,.60],[.79,.39,.25,.58]];
    for(const l of layouts){
      const x=l[0]*s.width,y=l[1]*s.height,w=l[2]*s.width,h=l[3]*s.height;
      const texture=[new Path2D(),new Path2D(),new Path2D()];
      for(let px=x+8;px<x+w;px+=12)for(let channel=0;channel<3;channel++){
        texture[channel].moveTo(px+channel*2,y+20);texture[channel].lineTo(px+channel*2,y+h-20);
      }
      panels.push({x,y,w,h,texture});
    }
    const locations=s.mobile?[[.02,.30],[.95,.73]]:[[.13,.36],[.91,.62],[.28,.88]];
    for(const l of locations){
      const x=l[0]*s.width,y=l[1]*s.height;centers.push({x,y});
      for(let ray=0;ray<(s.mobile?4:6);ray++){
        let px=x,py=y;const angle=ray*Math.PI*2/(s.mobile?4:6)+Math.random()*.35;
        for(let k=0;k<5;k++){
          const a=angle+(Math.random()-.5)*.23,length=(s.mobile?17:28)+Math.random()*20;
          const nx=px+Math.cos(a)*length,ny=py+Math.sin(a)*length;
          cracks.push({x:px,y:py,nx,ny,active:0,primary:ray%2===0});
          if(k===2){const branch=a+.65;cracks.push({x:px,y:py,nx:px+Math.cos(branch)*length*.7,ny:py+Math.sin(branch)*length*.7,active:0,primary:false});}
          px=nx;py=ny;
        }
      }
      for(let i=0;i<3;i++)pixels.push({x:x+24+i*8,y:y-45+i*12});
    }
    s.elements=cracks.length+panels.length+pixels.length;
  }
  function render(ctx,dt,reduced){
    s.begin(ctx,dt,reduced);
    for(const p of panels){
      ctx.lineWidth=.65;
      ctx.strokeStyle='rgba(142,101,111,.022)';ctx.stroke(p.texture[0]);
      ctx.strokeStyle='rgba(89,132,116,.022)';ctx.stroke(p.texture[1]);
      ctx.strokeStyle='rgba(83,121,145,.022)';ctx.stroke(p.texture[2]);
      ctx.strokeStyle='rgba(40,49,59,.075)';ctx.strokeRect(p.x,p.y,p.w,p.h);
      line(ctx,p.x+10,p.y+p.h*.57,p.x+p.w*.65,p.y+p.h*.57,.11);
      line(ctx,p.x+p.w*.78,p.y+20,p.x+p.w*.78,p.y+p.h*.45,.12);
    }
    for(let i=0;i<cracks.length;i++){
      const f=cracks[i];if(!f.primary&&s.quality>.5&&i%2)continue;
      f.active=s.follow(f.active,s.activity(f.x,f.y,220));
      const dx=(s.pointer.x-f.x)*f.active*.012,dy=(s.pointer.y-f.y)*f.active*.012;
      ctx.lineWidth=f.primary?1.1:.65;
      line(ctx,f.x+dx,f.y+dy,f.nx+dx*.4,f.ny+dy*.4,.12+f.active*.18);
    }
    for(const p of pixels){ctx.fillStyle='rgba(40,49,59,.11)';ctx.fillRect(p.x,p.y,3,3);ctx.fillRect(p.x+4,p.y+4,2,2);}
    pressure=s.follow(pressure,!s.mobile&&s.pointer.active?1:0,12);
    if(reduced)return;
    if(pressure>.01){
      const p=s.pointer,flash=Math.max(0,(s.gust-.15)/.15)*pressure;
      const offset=Math.sin(s.time*18)*1.5,scan=(s.time*190%110)-55;
      ctx.lineWidth=1;line(ctx,p.x-42+scan*.2,p.y+scan*.25,p.x+42+scan*.2,p.y+scan*.25,.19*pressure);
      if(flash>.01){line(ctx,p.x-40+offset,p.y-1,p.x+40+offset,p.y-1,.14*flash,'65,128,155');line(ctx,p.x-40-offset,p.y+1,p.x+40-offset,p.y+1,.09*flash,'150,92,114');}
      s.particles++;
    }
    const cycle=10+s.quality*4,t=s.time%cycle;
    if(t<.6){const c=centers[Math.floor(s.time/cycle)%centers.length];dot(ctx,c.x-35+t*110,c.y,.18*Math.sin(t/.6*Math.PI),1.4,'86,126,146');s.particles++;}
  }
  return{init(){},resize,render,pointerMove:s.pointerMove,setQuality:s.setQuality,getStats(){return{...s.getStats(),panels:panels.length,epicenters:centers.length,cracks:cracks.length};},destroy(){panels=[];cracks=[];centers=[];pixels=[];}};
}
