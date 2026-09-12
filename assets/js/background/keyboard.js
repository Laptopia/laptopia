import { createServiceState, line, dot } from './service-state.js';

export function createKeyboard() {
  const s=createServiceState();let keys=[],buses=[],lastKey=-1,lastAmbient=-1,unit=64,rows=5;
  function resize(size) {
    s.resize(size);keys=[];buses=[];lastKey=lastAmbient=-1;
    const regular=Array(12).fill(1);
    const layouts=s.mobile?[Array(6).fill(1),[1.2,1,1,1,1, .8],[1.2,3.6,1.2]]:
      [[...Array(13).fill(1),2],[1.5,...regular,1.5],[1.75,...Array(11).fill(1),2.25],[2.25,...Array(10).fill(1),2.75],[1.5,1.5,1.5,6,1.5,1.5,1.5]];
    rows=layouts.length;unit=s.mobile?s.width*.88/6:Math.min(64,s.width*.94/15);
    const width=unit*(s.mobile?6:15),left=(s.width-width)/2,top=s.height*.32,rowPitch=unit*.82;
    for(let row=0;row<rows;row++) {
      let x=left+(row===1?unit*.12:row===2?unit*.18:0);
      const y=top+row*rowPitch;
      buses.push({x:left,y:y+unit*.30,nx:left+width});
      for(let col=0;col<layouts[row].length;col++) {
        const span=layouts[row][col],w=unit*span-7,h=unit*.61;
        const center=Math.max(0,1-Math.abs((x+w/2)/s.width-.5)/.29);
        keys.push({x,y,w,h,row,col,weight:1-center*.80,trigger:-100,active:0});x+=unit*span;
      }
    }
    s.elements=keys.length;
  }
  function schedule(index) {
    const source=keys[index],cx=source.x+source.w/2,reach=s.quality>.5?1.2:2.2;
    for(const k of keys) {
      const dx=Math.abs(k.x+k.w/2-cx)/unit,dy=Math.abs(k.row-source.row);
      if((dy===0&&dx<reach)||(dy<=2&&dx<.6))k.trigger=s.time+(dx+dy)*.065;
    }
  }
  function render(ctx,dt,reduced) {
    s.begin(ctx,dt,reduced);let nearest=-1;
    if(!reduced&&s.pointer.active&&!s.mobile) {
      for(let i=0;i<keys.length;i++){const k=keys[i];if(s.pointer.x>=k.x&&s.pointer.x<=k.x+k.w&&s.pointer.y>=k.y&&s.pointer.y<=k.y+k.h){nearest=i;break;}}
      if(nearest>=0&&nearest!==lastKey)schedule(nearest);lastKey=nearest;
    }else lastKey=-1;
    if(!reduced&&Math.floor(s.time/12)!==lastAmbient){lastAmbient=Math.floor(s.time/12);schedule((lastAmbient*11+Math.floor(keys.length*.33))%keys.length);}
    ctx.lineWidth=.6;for(const b of buses)line(ctx,b.x,b.y,b.nx,b.y,.022);
    const budget=s.mobile?Math.max(1,Math.round(2-s.quality)):Math.round(5-s.quality*2);
    for(const k of keys) {
      const age=s.time-k.trigger,ripple=reduced||age<0||age>.5?0:Math.sin(Math.PI*age/.5)*Math.exp(-age*2);
      const pressed=nearest>=0&&keys[nearest]===k?1:0;
      k.active=s.follow(k.active,Math.max(ripple,pressed)*k.weight);
      const offset=k.active*2;
      ctx.lineWidth=1.05;ctx.strokeStyle=`rgba(40,49,59,${.14*k.weight+k.active*.17})`;ctx.fillStyle=`rgba(86,97,110,${.015*k.weight+k.active*.045})`;
      ctx.beginPath();ctx.roundRect(k.x,k.y+offset,k.w,k.h,5);ctx.stroke();ctx.fill();
      // Unlabelled keycap legends and a long spacebar recess clarify the keyboard.
      ctx.lineWidth=.65;
      const mark=k.w>unit*2?Math.min(k.w*.45,unit*1.4):k.col===0||k.w>unit*1.3?10:4;
      line(ctx,k.x+k.w/2-mark/2,k.y+k.h*.42+offset,k.x+k.w/2+mark/2,k.y+k.h*.42+offset,.065*k.weight+k.active*.07);
      if(s.quality<1){ctx.lineWidth=.6;line(ctx,k.x+6,k.y+k.h-4+offset,k.x+k.w-6,k.y+k.h-4+offset,.06*k.weight+k.active*.08);}
      if(!reduced&&age>=0&&age<.45&&ripple>.02&&s.particles<budget){dot(ctx,k.x+k.w/2+age*unit,k.y+k.h/2,ripple*.20*k.weight,1.4);s.particles++;}
    }
  }
  return{init(){},resize,render,pointerMove:s.pointerMove,setQuality:s.setQuality,getStats(){return{...s.getStats(),fields:1,rows};},destroy(){keys=[];buses=[];}};
}
