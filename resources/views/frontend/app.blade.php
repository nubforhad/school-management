<!DOCTYPE html>
<html lang="bn">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> {{ $settings->get('institute_name') ?? 'Nidaul Quran Madrasah' }} </title>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link  href="https://fonts.googleapis.com/css2?family=Noto+Serif+Bengali:wght@400;500;600;700;800&family=Hind+Siliguri:wght@300;400;500;600;700&family=Amiri:ital@0;1&display=swap" rel="stylesheet">

<style>
  /* ========= নিদারুল মাদরাসা — Stylesheet v2  Primary #7f1531 (maroon) + deep teal + amber, cool-mist backgrounds  Same class names as before — just replace the CSS file. ==== */
@import url('https://fonts.googleapis.com/css2?family=Anek+Bangla:wght@400;500;600;700&family=Tiro+Bangla:ital@0;1&family=Reem+Kufi:wght@400;600&display=swap');

:root{
  --brand:#7f1531;
  --brand-light:#a3294a;
  --brand-dark:#5a0f23;
  --brand-tint:#f8e9ed;
  --teal:#721b00;
  --teal-deep:#5c1a0a;
  --teal-tint:#e4f0ee;
  --amber:#e2a93b;
  --amber-soft:#f6dfa8;
  --paper:#f5f8f7;
  --paper-2:#e9f0ee;
  --ink:#741403;
  --muted:#5b6e70;
  --line:#d9e4e2;
  --white:#fff;
  --radius:22px;
  --shadow:0 8px 28px rgba(15,76,74,.09);
  --shadow-lg:0 24px 54px rgba(10,47,46,.18);
  --f-body:'Anek Bangla','Hind Siliguri',system-ui,sans-serif;
  --f-head:'Tiro Bangla','Anek Bangla',serif;
  --f-ar:'Reem Kufi',serif;
}

*,*::before,*::after{box-sizing:border-box}
html{scroll-behavior:smooth;scroll-padding-top:100px}
body{margin:0;font-family:var(--f-body);font-size:16.5px;line-height:1.75;color:var(--ink);background:var(--paper);-webkit-font-smoothing:antialiased}
img{max-width:100%;display:block}
a{color:inherit;text-decoration:none}
ul{list-style:none;margin:0;padding:0}
h1,h2,h3,h4,h5{font-family:var(--f-head);margin:0;line-height:1.4;font-weight:400}
p{margin:0}
.container{width:100%;max-width:1200px;margin:0 auto;padding:0 22px}
section{padding:88px 0}
:focus-visible{outline:3px solid var(--amber);outline-offset:3px}

/* ---------- Buttons ---------- */
.btn{display:inline-flex;align-items:center;gap:8px;padding:14px 30px;border-radius:14px;font-weight:600;font-size:1rem;border:2px solid transparent;cursor:pointer;transition:transform .2s,background .2s,color .2s,box-shadow .2s}
.btn:hover{transform:translateY(-2px)}
.btn-gold{background:var(--amber);color:var(--teal-deep);box-shadow:0 8px 20px rgba(226,169,59,.35)}
.btn-gold:hover{background:#ecb74e}
.btn-outline{border-color:var(--brand);color:var(--brand);background:transparent}
.btn-outline:hover{background:var(--brand);color:#fff}

/* ---------- Top bar ---------- */
.topbar{background:var(--teal-deep);color:#cfe3e0;font-size:.87rem}
.topbar .container{display:flex;justify-content:space-between;align-items:center;gap:16px;padding-top:7px;padding-bottom:7px}
.bismillah{font-family:var(--f-ar);font-size:1.2rem;color:var(--amber-soft);line-height:1.5}
.topbar .contacts{display:flex;gap:22px;flex-wrap:wrap}

/* ---------- Header (light, clean) ---------- */
header.site{position:sticky;top:0;z-index:100;background:rgba(255,255,255,.94);backdrop-filter:blur(10px);box-shadow:0 4px 24px rgba(10,47,46,.08);border-bottom:1px solid var(--line)}
.nav-wrap{display:flex;align-items:center;gap:18px;min-height:80px}
.brand{display:flex;align-items:center;gap:12px;margin-right:auto}
.mark{width:56px;height:56px; background:var(--brand-tint); display:grid;place-items:center;overflow:hidden;flex-shrink:0}
.mark img{width:100%;height:100%;object-fit:contain;padding:4px}
.names h1{font-size:1.2rem;color:var(--brand);line-height:1.25}
.names span{display:block;font-size:.8rem;color:var(--muted)}

nav.main > ul{display:flex;align-items:center;gap:2px}
nav.main li{position:relative}
nav.main a{display:flex;align-items:center;gap:4px;padding:10px 13px;color:var(--ink);font-weight:500;font-size:.96rem;transition:color .2s}
nav.main > ul > li > a{position:relative}
nav.main > ul > li > a::after{content:"";position:absolute;left:13px;right:13px;bottom:2px;height:3px;border-radius:3px;background:var(--brand);transform:scaleX(0);transition:transform .25s}
nav.main > ul > li:hover > a,
nav.main > ul > li:focus-within > a{color:var(--brand)}
nav.main > ul > li:hover > a::after,
nav.main > ul > li:focus-within > a::after{transform:scaleX(1)}
.caret{font-size:.68rem;opacity:.7;transition:transform .2s}
.has-sub:hover .caret{transform:rotate(180deg)}

.submenu{position:absolute;top:calc(100% + 6px);left:0;min-width:250px;background:#fff;border-radius:16px;padding:8px;box-shadow:var(--shadow-lg);border:1px solid var(--line);opacity:0;visibility:hidden;transform:translateY(10px);transition:.2s}
.has-sub:hover > .submenu,.has-sub:focus-within > .submenu{opacity:1;visibility:visible;transform:none}
.submenu a{padding:10px 14px;font-size:.93rem;border-radius:10px;border-left:3px solid transparent}
.submenu a:hover{background:var(--brand-tint);color:var(--brand);border-left-color:var(--brand)}

.nav-cta{background:var(--brand);color:#fff;padding:11px 24px;border-radius:14px;font-weight:600;font-size:.93rem;white-space:nowrap;box-shadow:0 8px 18px rgba(127,21,49,.28);transition:transform .2s,background .2s}
.nav-cta:hover{transform:translateY(-2px);background:var(--brand-light)}

.burger{display:none;width:46px;height:46px;border:1.5px solid var(--brand);background:var(--brand-tint);border-radius:12px;cursor:pointer;flex-direction:column;justify-content:center;align-items:center;gap:5px}
.burger span{width:22px;height:2px;background:var(--brand);border-radius:2px;transition:.25s}
.burger.active span:nth-child(1){transform:translateY(7px) rotate(45deg)}
.burger.active span:nth-child(2){opacity:0}
.burger.active span:nth-child(3){transform:translateY(-7px) rotate(-45deg)}

/* ---------- Star divider ---------- */
.star-divider{height:20px;background-color:var(--teal-deep);background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='40' height='20' viewBox='0 0 40 20'%3E%3Cpath d='M20 3l7 7-7 7-7-7z' fill='none' stroke='%23e2a93b' stroke-width='1.2'/%3E%3C/svg%3E");background-repeat:repeat-x;background-position:center}

/* ---------- Hero (light) ---------- */
.hero{position:relative;overflow:hidden;color:var(--ink);background:
  radial-gradient(700px 400px at 90% 10%,rgba(127,21,49,.10),transparent 60%),
  radial-gradient(600px 360px at 0 100%,rgba(15,76,74,.12),transparent 60%),
  var(--paper)}
.hero::before{content:"";position:absolute;inset:0;opacity:.5;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='60' height='60' viewBox='0 0 60 60'%3E%3Cpath d='M30 4l26 26-26 26L4 30z' fill='none' stroke='%230f4c4a' stroke-opacity='.10' stroke-width='1'/%3E%3C/svg%3E")}
.hero .container{position:relative;display:grid;grid-template-columns:1.15fr .85fr;gap:56px;align-items:center;padding-top:72px}
.eyebrow{display:inline-block;padding:7px 18px;border-radius:999px;background:var(--brand-tint);color:var(--brand);font-weight:600;font-size:.9rem;border:1px solid rgba(127,21,49,.25);margin-bottom:22px}
.hero h2{font-size:clamp(2.1rem,4.4vw,3.4rem);line-height:1.38;margin-bottom:20px;color:var(--teal-deep)}
.hero h2 em{font-style:normal;color:var(--brand);background:linear-gradient(transparent 68%,var(--amber-soft) 68%)}
.hero .lead{font-size:1.1rem;color:var(--muted);max-width:56ch;margin-bottom:32px}
.actions{display:flex;gap:14px;flex-wrap:wrap}

.arch-frame{position:relative;display:flex;justify-content:center;padding-bottom:42px}
.arch{position:relative;width:100%;max-width:340px;aspect-ratio:3/4;border-radius:999px 999px 24px 24px;padding:10px;background:linear-gradient(170deg,var(--brand-light),var(--brand-dark));box-shadow:0 0 0 8px #fff,0 0 0 10px var(--teal),var(--shadow-lg);display:grid;place-items:center;overflow:hidden}
.arch .glow{position:absolute;width:250px;height:250px;border-radius:50%;background:radial-gradient(circle,rgba(246,223,168,.5),transparent 70%);top:12%}
.glyph{position:relative;text-align:center;font-family:var(--f-ar);font-size:4.2rem;color:var(--amber-soft);line-height:1.3}
.glyph small{display:block;font-family:var(--f-body);font-size:.9rem;color:#f6dfe5;margin-top:10px;padding:0 20px}
.stat-chip{position:absolute;bottom:0;left:50%;transform:translateX(-50%);display:flex;background:#fff;border-radius:18px;box-shadow:var(--shadow-lg);overflow:hidden;white-space:nowrap;border:1px solid var(--line)}
.stat-chip > div{padding:12px 20px;text-align:center;border-right:1px solid var(--line)}
.stat-chip > div:last-child{border:0}
.stat-chip strong{display:block;font-family:var(--f-head);font-size:1.4rem;color:var(--brand);line-height:1.3;font-weight:400}
.stat-chip span{font-size:.78rem;color:var(--muted)}

/* ---------- Section heads ---------- */
.section-head{text-align:center;max-width:800px;margin:0 auto 54px}
.kicker{display:inline-block;color:var(--teal);background:var(--teal-tint);font-weight:600;font-size:.9rem;padding:4px 16px;border-radius:999px;margin-bottom:14px}
.section-head h3{font-size:clamp(1.6rem,3.2vw,2.3rem);color:var(--teal-deep);margin-bottom:12px}
.section-head p{color:var(--muted)}

/* ---------- Pillars ---------- */
.pillars{display:grid;grid-template-columns:repeat(3,1fr);gap:26px}
.pillar{background:#fff;border:1px solid var(--line);border-radius:var(--radius);padding:36px 30px;box-shadow:var(--shadow);text-align:center;transition:transform .25s,box-shadow .25s,border-color .25s}
.pillar:hover{transform:translateY(-6px);box-shadow:var(--shadow-lg);border-color:var(--brand)}
.pillar .icon{width:72px;height:72px;margin:0 auto 20px;border-radius:50%;display:grid;place-items:center;font-size:1.9rem;background:var(--brand-tint);box-shadow:0 0 0 6px #fff,0 0 0 7px rgba(127,21,49,.25)}
.pillar h4{font-size:1.3rem;color:var(--brand);margin-bottom:10px}
.pillar p{color:var(--muted);font-size:.96rem}

/* ---------- Departments ---------- */
.dept-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:22px}
.dept-card{display:flex;gap:20px;align-items:flex-start;background:#fff;border-radius:var(--radius);padding:28px;border:1px solid var(--line);transition:.28s}
.dept-card:hover{background:var(--brand);border-color:var(--brand);transform:translateY(-4px);box-shadow:var(--shadow-lg)}
.dept-card:hover h4,.dept-card:hover p{color:#fff}
.dept-card:hover .num{background:var(--amber);color:var(--teal-deep)}
.dept-card .num{flex-shrink:0;background:var(--teal-tint);color:var(--teal);font-size:.8rem;font-weight:600;padding:6px 14px;border-radius:10px;white-space:nowrap;transition:.28s}
.dept-card h4{font-size:1.22rem;color:var(--teal-deep);margin-bottom:6px;transition:.28s}
.dept-card p{color:var(--muted);font-size:.95rem;transition:.28s}

/* ---------- Stats band ---------- */
.band{background:linear-gradient(135deg,var(--teal),var(--teal-deep));color:#fff;padding:50px 0}
.band .container{display:grid;grid-template-columns:repeat(4,1fr);gap:20px;text-align:center}
.band .item{padding:6px 10px;border-right:1px solid rgba(255,255,255,.15)}
.band .item:last-child{border:0}
.band strong{display:block;font-family:var(--f-head);font-size:2.6rem;color:var(--amber-soft);line-height:1.3;font-weight:400}
.band span{font-size:.95rem;color:#cfe3e0}

/* ---------- Notice + Admission ---------- */
.notice-wrap{display:grid;grid-template-columns:1.4fr 1fr;gap:34px;align-items:start}
.notice-list{display:flex;flex-direction:column;gap:16px}
.notice-item{display:flex;gap:20px;background:#fff;border:1px solid var(--line);border-radius:var(--radius);padding:20px;transition:.25s}
.notice-item:hover{box-shadow:var(--shadow);border-color:var(--teal)}
.notice-date{flex-shrink:0;width:74px;height:82px;border-radius:16px;background:var(--teal-tint);color:var(--teal);display:flex;flex-direction:column;align-items:center;justify-content:center}
.notice-date strong{font-family:var(--f-head);font-size:1.8rem;line-height:1.2;font-weight:400}
.notice-date span{font-size:.8rem;font-weight:600}
.notice-item h5{font-size:1.1rem;color:var(--teal-deep);margin-bottom:4px}
.notice-item p{font-size:.92rem;color:var(--muted);margin-bottom:8px}
.tag{display:inline-block;background:var(--brand-tint);color:var(--brand);font-size:.78rem;font-weight:600;padding:2px 12px;border-radius:999px}

.admission-card{background:linear-gradient(160deg,var(--brand),var(--brand-dark));color:#fff;border-radius:26px;padding:36px 30px;box-shadow:var(--shadow-lg);position:sticky;top:104px;overflow:hidden}
.admission-card::after{content:"";position:absolute;right:-50px;top:-50px;width:160px;height:160px;border-radius:50%;background:rgba(226,169,59,.18)}
.admission-card h4{font-size:1.45rem;color:var(--amber-soft);margin-bottom:10px;position:relative}
.admission-card p{font-size:.95rem;color:#f6dfe5;margin-bottom:20px;position:relative}
.admission-card ul{margin-bottom:26px;position:relative}
.admission-card li{display:flex;justify-content:space-between;gap:10px;padding:12px 0;border-bottom:1px dashed rgba(255,255,255,.28);font-size:.96rem}
.admission-card li span:last-child{color:var(--amber-soft);font-weight:600}

/* ---------- Gallery ---------- */
.gallery-grid{display:grid;grid-template-columns:repeat(4,1fr);grid-auto-rows:190px;gap:14px}
.gtile{position:relative;border-radius:var(--radius);overflow:hidden;background-size:cover;background-position:center;display:flex;align-items:flex-end;transition:transform .3s}
.gtile:hover{transform:scale(1.02)}
.gtile::after{content:"";position:absolute;inset:0;background:linear-gradient(180deg,transparent 45%,rgba(10,47,46,.85))}
.gtile span{position:relative;z-index:1;color:#fff;font-weight:600;padding:16px 18px}
.g1{grid-column:span 2;grid-row:span 2}
.gt1{background-image:linear-gradient(135deg,var(--brand-light),var(--brand-dark))}
.gt2{background-image:linear-gradient(135deg,var(--teal),var(--teal-deep))}
.gt3{background-image:linear-gradient(135deg,#b4832a,var(--brand-dark))}
.gt4{background-image:linear-gradient(135deg,var(--teal),#1b6b66)}
.gt5{grid-column:span 2;background-image:linear-gradient(135deg,var(--brand-dark),var(--teal-deep))}
/* ছবি বসাতে: .gt1{background-image:url('/asset/image/g1.jpg')} */

/* ---------- Testimonials ---------- */
.quote-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:26px}
.quote-card{background:#fff;border:1px solid var(--line);border-radius:var(--radius);padding:30px 26px;box-shadow:var(--shadow);position:relative}
.quote-card::before{content:"“";position:absolute;top:8px;right:22px;font-family:var(--f-head);font-size:5rem;line-height:1;color:var(--brand-tint)}
.stars{color:var(--amber);letter-spacing:3px;margin-bottom:12px}
.quote-card p{position:relative;color:var(--muted);font-size:.97rem;margin-bottom:22px}
.quote-who{display:flex;align-items:center;gap:12px;padding-top:16px;border-top:1px solid var(--line)}
.av{width:46px;height:46px;border-radius:50%;background:linear-gradient(135deg,var(--brand),var(--teal));flex-shrink:0}
.quote-who strong{display:block;color:var(--teal-deep);font-size:.97rem;line-height:1.4}
.quote-who span{font-size:.82rem;color:var(--muted)}

/* ---------- CTA banner ---------- */
.cta-banner{max-width:1156px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;gap:28px;padding:46px 50px;border-radius:30px;color:#fff;background:
  radial-gradient(480px 240px at 100% 0,rgba(226,169,59,.28),transparent 65%),
  linear-gradient(135deg,var(--brand),var(--brand-dark));
  box-shadow:var(--shadow-lg)}
.cta-banner h3{font-size:clamp(1.3rem,2.4vw,1.8rem);margin-bottom:8px}
.cta-banner p{color:#f6dfe5}
section:has(> .cta-banner){padding-left:22px;padding-right:22px}

/* ---------- Footer ---------- */
footer{background:var(--teal-deep);color:#bdd3d0;padding-top:66px}
.footer-grid{display:grid;grid-template-columns:1.5fr 1fr 1fr 1.5fr;gap:40px;padding-bottom:48px}
.foot-brand{display:flex;align-items:center;gap:12px;margin-bottom:16px}
.foot-brand .mark{border-color:var(--amber)}
.foot-brand span{font-family:var(--f-head);font-size:1.3rem;color:#fff}
footer p{font-size:.94rem}
footer h5{color:var(--amber-soft);font-size:1.12rem;margin-bottom:18px}
footer ul li{margin-bottom:10px;font-size:.94rem}
footer ul a{transition:.2s}
footer ul a:hover{color:var(--amber-soft);padding-left:6px}
.bottom-bar{text-align:center;padding:20px 16px;font-size:.88rem;background:#5e0e0e;color:#e7f0ef}

/* ---------- Responsive ---------- */
@media (max-width:1100px){
  .names span{display:none}
  nav.main a{padding:10px 8px;font-size:.9rem}
}
@media (max-width:980px){
  section{padding:64px 0}
  .burger{display:flex}
  nav.main{position:absolute;top:100%;left:0;right:0;background:#fff;max-height:0;overflow:hidden;transition:max-height .35s ease;box-shadow:0 20px 30px rgba(10,47,46,.12)}
  nav.main.open{max-height:80vh;overflow-y:auto;border-bottom:3px solid var(--brand)}
  nav.main > ul{flex-direction:column;align-items:stretch;padding:10px 16px 18px;gap:0}
  nav.main a{padding:13px 10px;border-bottom:1px solid var(--line)}
  nav.main > ul > li > a::after{display:none}
  .has-sub > a{justify-content:space-between}
  .caret{padding:4px 10px}
  .submenu{position:static;opacity:1;visibility:visible;transform:none;box-shadow:none;border:0;background:var(--paper);border-radius:12px;padding:0 0 0 10px;max-height:0;overflow:hidden;transition:max-height .3s}
  .has-sub:hover > .submenu{max-height:0}
  .has-sub.sub-open > .submenu{max-height:400px}
  .has-sub.sub-open .caret{transform:rotate(180deg)}

  .hero .container{grid-template-columns:1fr;text-align:center;gap:40px}
  .hero .lead{margin-left:auto;margin-right:auto}
  .actions{justify-content:center}
  .pillars,.quote-grid{grid-template-columns:1fr 1fr}
  .notice-wrap{grid-template-columns:1fr}
  .admission-card{position:static}
  .band .container{grid-template-columns:1fr 1fr}
  .band .item:nth-child(2){border:0}
  .footer-grid{grid-template-columns:1fr 1fr}
  .gallery-grid{grid-template-columns:repeat(2,1fr)}
  .cta-banner{flex-direction:column;text-align:center;padding:36px 26px}
}
@media (max-width:640px){
  body{font-size:16px}
  .topbar .container{justify-content:center;text-align:center}
  .topbar .contacts{justify-content:center;gap:6px 16px;font-size:.8rem}
  .nav-cta{padding:9px 14px;font-size:.82rem}
  .names h1{font-size:1rem}
  .mark{width:46px;height:46px}
  .pillars,.quote-grid,.dept-grid,.footer-grid{grid-template-columns:1fr}
  .dept-card{flex-direction:column;gap:12px}
  .stat-chip > div{padding:10px 12px}
  .stat-chip strong{font-size:1.1rem}
  .gallery-grid{grid-auto-rows:150px}
  .g1{grid-column:span 2;grid-row:span 1}
  .notice-item{flex-direction:column}
  .notice-date{width:100%;height:auto;flex-direction:row;gap:8px;padding:8px}
}
@media (prefers-reduced-motion:reduce){
  *{transition:none!important;scroll-behavior:auto!important}
}
</style>

</head>

<body>


  @include('frontend.layout.header')

  <div class="star-divider"></div>

  @yield('content')

  @include('frontend.layout.footer')

  <script>
    // Dropdown submenu (desktop hover handled by CSS; click for touch + mobile)
  document.querySelectorAll('nav.main > ul > li.has-sub > a').forEach(function(link){
    link.addEventListener('click', function(e){
      var parentLi = link.parentElement;
      var isMobile = window.innerWidth <= 720;
      if(isMobile){
        e.preventDefault();
        var wasOpen = parentLi.classList.contains('open');
        document.querySelectorAll('nav.main > ul > li.has-sub').forEach(function(li){ li.classList.remove('open'); });
        if(!wasOpen) parentLi.classList.add('open');
      }
    });
  });
  document.querySelectorAll('nav.main > ul > li.has-sub').forEach(function(li){
    li.addEventListener('mouseenter', function(){ if(window.innerWidth > 720) li.classList.add('open'); });
    li.addEventListener('mouseleave', function(){ if(window.innerWidth > 720) li.classList.remove('open'); });
  });

  var burger = document.getElementById('burgerBtn');
  var nav = document.getElementById('mainNav');
  burger.addEventListener('click', function(){
    nav.classList.toggle('open');
  });

  document.querySelectorAll('nav.main a').forEach(function(a){
    a.addEventListener('click', function(){
      if(window.innerWidth <= 720 && a.parentElement.parentElement.parentElement.id === 'mainNav'){
        // close only when navigating to a real section link (not submenu toggle handled above)
      }
    });
  });
  </script>

</body>

</html>