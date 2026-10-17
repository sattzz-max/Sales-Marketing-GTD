(()=>{'use strict';
const $=(s,r=document)=>r.querySelector(s),$$=(s,r=document)=>[...r.querySelectorAll(s)];
// Tracking opsional: aktif hanya jika dataLayer (mis. GTM) dipasang secara resmi.
document.addEventListener('click',e=>{const t=e.target.closest('[data-track]');if(t&&t.dataset.track&&window.dataLayer)window.dataLayer.push({event:'td_click',label:t.dataset.track});});
const hd=$('.site-header'),nav=$('#nav'),bg=$('.burger');
addEventListener('scroll',()=>hd.classList.toggle('stuck',scrollY>10),{passive:true});
bg.addEventListener('click',()=>{const o=nav.classList.toggle('open');bg.setAttribute('aria-expanded',o);});
$$('#nav a').forEach(a=>a.addEventListener('click',()=>{nav.classList.remove('open');bg.setAttribute('aria-expanded',false);}));
const links=$$('#nav a[href^="#"]');
const so=new IntersectionObserver(es=>es.forEach(en=>{if(en.isIntersecting){const id=en.target.id==='services'?'about':en.target.id==='gallery'?'events':en.target.id;links.forEach(l=>l.classList.toggle('active',l.getAttribute('href')==='#'+id));}}),{rootMargin:'-45% 0px -50% 0px'});
$$('main section[id]').forEach(s=>so.observe(s));
const ro=new IntersectionObserver(es=>es.forEach(en=>{if(en.isIntersecting){en.target.classList.add('in');ro.unobserve(en.target);}}),{threshold:.12});
$$('.reveal').forEach(r=>ro.observe(r));
// Carousel
const car=$('#carousel');
if(car){const vp=$('.viewport',car),tr=$('.track',car),sl=$$('.slide',car),dots=$('.dots',car);
 let i=0,timer,resume,sx=null;
 const spv=()=>parseFloat(getComputedStyle(car).getPropertyValue('--spv'))||1;
 const max=()=>Math.max(0,Math.ceil(sl.length-spv()));
 const build=()=>{dots.innerHTML='';for(let k=0;k<=max();k++){const b=document.createElement('button');b.setAttribute('role','tab');b.setAttribute('aria-label','Halaman '+(k+1));b.onclick=()=>{go(k);manual();};dots.appendChild(b);}};
 const go=n=>{i=n>max()?0:n<0?max():n;tr.style.transform=`translateX(${-i*sl[0].offsetWidth}px)`;$$('button',dots).forEach((d,k)=>d.setAttribute('aria-selected',k===i));};
 const stop=()=>clearInterval(timer);
 const play=()=>{stop();if(!matchMedia('(prefers-reduced-motion:reduce)').matches)timer=setInterval(()=>go(i+1),5000);};
 const manual=()=>{stop();clearTimeout(resume);resume=setTimeout(play,10000);};
 $('.prev',car).onclick=()=>{go(i-1);manual();};$('.next',car).onclick=()=>{go(i+1);manual();};
 car.addEventListener('mouseenter',stop);car.addEventListener('mouseleave',play);car.addEventListener('focusin',stop);car.addEventListener('focusout',play);
 vp.addEventListener('touchstart',e=>{sx=e.touches[0].clientX;stop();},{passive:true});
 vp.addEventListener('touchend',e=>{if(sx===null)return;const d=e.changedTouches[0].clientX-sx;if(Math.abs(d)>40)go(i+(d<0?1:-1));sx=null;manual();});
 let rt;addEventListener('resize',()=>{clearTimeout(rt);rt=setTimeout(()=>{build();go(Math.min(i,max()));},120);});
 build();go(0);play();}
// Lightbox
const lb=$('#lightbox');
if(lb){const items=$$('.g-item'),media=$('.lb-media',lb),cap=$('figcaption',lb);let k=0,last=null;
 const show=n=>{k=(n+items.length)%items.length;const it=items[k];media.innerHTML='';media.appendChild(($('img',it)||$('.ph',it)).cloneNode(true));cap.textContent=it.dataset.caption;};
 const open=n=>{last=document.activeElement;show(n);lb.hidden=false;document.body.style.overflow='hidden';$('.lb-close',lb).focus();};
 const close=()=>{lb.hidden=true;document.body.style.overflow='';last&&last.focus();};
 items.forEach((b,n)=>b.addEventListener('click',()=>open(n)));
 $('.lb-close',lb).onclick=close;$('.prev',lb).onclick=()=>show(k-1);$('.next',lb).onclick=()=>show(k+1);
 lb.addEventListener('click',e=>{if(e.target===lb)close();});
 addEventListener('keydown',e=>{if(lb.hidden)return;if(e.key==='Escape')close();if(e.key==='ArrowLeft')show(k-1);if(e.key==='ArrowRight')show(k+1);});}
// Inquiry form: status berhasil hanya jika server mengonfirmasi
const f=$('#inquiry');
if(f){const st=$('.status',f);f.addEventListener('submit',async e=>{e.preventDefault();st.className='status';st.textContent='Mengirim…';
 const btn=$('button[type=submit]',f);btn.disabled=true;
 try{const r=await fetch(f.action,{method:'POST',headers:{'Accept':'application/json'},body:new FormData(f)});const j=await r.json();
  st.textContent=j.message;st.classList.add(j.ok?'ok':'err');
  if(j.ok){f.reset();window.dataLayer&&window.dataLayer.push({event:'td_inquiry_success'});}
 }catch(x){st.textContent='Koneksi gagal. Data Anda belum terkirim; coba lagi.';st.classList.add('err');}
 btn.disabled=false;});}
// Modal video (konten dimuat hanya saat dibuka, dibuang saat ditutup)
const vm=$('#vmodal');
if(vm){const box=$('.vbox',vm);let last=null;
 const close=()=>{vm.hidden=true;box.innerHTML='';document.body.style.overflow='';last&&last.focus();};
 $$('[data-video-src]').forEach(b=>b.addEventListener('click',()=>{last=b;let el;
  if(b.dataset.videoType==='yt'){el=document.createElement('iframe');el.src=b.dataset.videoSrc;el.allow='autoplay; encrypted-media; picture-in-picture; fullscreen';el.allowFullscreen=true;el.title='Video Taman Dayu';}
  else{el=document.createElement('video');el.src=b.dataset.videoSrc;el.controls=true;el.autoplay=true;el.playsInline=true;}
  box.appendChild(el);vm.hidden=false;document.body.style.overflow='hidden';$('.vclose',vm).focus();}));
 $('.vclose',vm).onclick=close;vm.addEventListener('click',e=>{if(e.target===vm)close();});
 addEventListener('keydown',e=>{if(!vm.hidden&&e.key==='Escape')close();});}
})();
