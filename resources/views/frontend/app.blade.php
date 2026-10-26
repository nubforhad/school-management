<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title> {{ $settings->get('institute_name') ?? 'Nidaul Quran Madrasah' }} </title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Bengali:wght@400;500;600;700;800&family=Hind+Siliguri:wght@300;400;500;600;700&family=Amiri:ital@0;1&display=swap" rel="stylesheet">

<style>

/* =========================================================
   নিদারুল মাদরাসা — Main Stylesheet
   Primary: #7f1531  |  Accent: Gold  |  Paper: warm rose-ivory
   ========================================================= */
@import url('https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Hind+Siliguri:wght@400;500;600;700&family=Noto+Serif+Bengali:wght@500;600;700&display=swap');

:root{
  --brand:#7f1531;
  --brand-light:#a02447;
  --brand-dark:#5f0f25;
  --brand-deep:#3f0a19;
  --gold:#d4aa55;
  --gold-soft:#e8cf94;
  --paper:#fcf8f5;
  --paper-2:#f5ebe6;
  --ink:#2b1119;
  --muted:#6f5a61;
  --line:#e8d9d3;
  --white:#fff;
  --radius:16px;
  --shadow:0 10px 30px rgba(63,10,25,.10);
  --shadow-lg:0 22px 50px rgba(63,10,25,.18);
  --f-body:'Hind Siliguri',system-ui,sans-serif;
  --f-head:'Noto Serif Bengali','Hind Siliguri',serif;
  --f-ar:'Amiri',serif;
}

*,*::before,*::after{box-sizing:border-box}
html{scroll-behavior:smooth;scroll-padding-top:90px}
body{margin:0;font-family:var(--f-body);font-size:16.5px;line-height:1.75;color:var(--ink);background:var(--paper);-webkit-font-smoothing:antialiased}
img{max-width:100%;display:block}
a{color:inherit;text-decoration:none}
ul{list-style:none;margin:0;padding:0}
h1,h2,h3,h4,h5{font-family:var(--f-head);margin:0;line-height:1.35;font-weight:700}
p{margin:0}
.container{width:100%;max-width:1200px;margin:0 auto;padding:0 22px}
section{padding:84px 0}
:focus-visible{outline:3px solid var(--gold);outline-offset:3px}

/* ---------- Buttons ---------- */
.btn{display:inline-flex;align-items:center;gap:8px;padding:13px 28px;border-radius:999px;font-weight:600;font-size:1rem;border:2px solid transparent;cursor:pointer;transition:transform .2s,background .2s,color .2s,box-shadow .2s}
.btn:hover{transform:translateY(-2px)}
.btn-gold{background:linear-gradient(135deg,var(--gold-soft),var(--gold));color:var(--brand-deep);box-shadow:0 8px 20px rgba(212,170,85,.35)}
.btn-gold:hover{box-shadow:0 12px 26px rgba(212,170,85,.5)}
.btn-outline{border-color:rgba(255,255,255,.55);color:#fff}
.btn-outline:hover{background:#fff;color:var(--brand)}

/* ---------- Top bar ---------- */
.topbar{background:var(--brand-deep);color:#f3dfe5;font-size:.88rem}
.topbar .container{display:flex;justify-content:space-between;align-items:center;gap:16px;padding-top:8px;padding-bottom:8px}
.bismillah{font-family:var(--f-ar);font-size:1.35rem;color:var(--gold-soft);line-height:1.4}
.topbar .contacts{display:flex;gap:22px;flex-wrap:wrap}

/* ---------- Header ---------- */
header.site{position:sticky;top:0;z-index:100;background:rgba(127,21,49,.97);backdrop-filter:blur(8px);border-bottom:3px solid var(--gold);box-shadow:0 6px 22px rgba(63,10,25,.25)}
.nav-wrap{display:flex;align-items:center;gap:20px;min-height:78px}
.brand{display:flex;align-items:center;gap:12px;margin-right:auto}
.mark{width:54px;height:54px;border-radius:50%;background:#fff;border:2px solid var(--gold);display:grid;place-items:center;overflow:hidden;flex-shrink:0}
.mark img{width:100%;height:100%;object-fit:contain;padding:3px}
.names h1{font-size:1.15rem;color:#fff;line-height:1.25}
.names span{display:block;font-size:.8rem;color:var(--gold-soft)}

nav.main > ul{display:flex;align-items:center;gap:2px}
nav.main li{position:relative}
nav.main a{display:flex;align-items:center;gap:4px;padding:10px 14px;color:#f7e9ee;font-weight:500;font-size:.96rem;border-radius:8px;transition:background .2s,color .2s}
nav.main > ul > li > a:hover,
nav.main > ul > li:focus-within > a{background:rgba(255,255,255,.12);color:var(--gold-soft)}
.caret{font-size:.7rem;opacity:.8;transition:transform .2s}
.has-sub:hover .caret{transform:rotate(180deg)}

.submenu{position:absolute;top:100%;left:0;min-width:240px;background:#fff;border-radius:12px;padding:8px;box-shadow:var(--shadow-lg);border-top:3px solid var(--gold);opacity:0;visibility:hidden;transform:translateY(10px);transition:.2s}
.has-sub:hover > .submenu,.has-sub:focus-within > .submenu{opacity:1;visibility:visible;transform:none}
.submenu a{color:var(--ink);padding:10px 14px;font-size:.93rem}
.submenu a:hover{background:var(--paper-2);color:var(--brand)}

.nav-cta{background:linear-gradient(135deg,var(--gold-soft),var(--gold));color:var(--brand-deep);padding:10px 22px;border-radius:999px;font-weight:700;font-size:.93rem;white-space:nowrap;transition:transform .2s,box-shadow .2s}
.nav-cta:hover{transform:translateY(-2px);box-shadow:0 8px 18px rgba(0,0,0,.25)}

.burger{display:none;width:44px;height:44px;border:1px solid rgba(255,255,255,.35);background:transparent;border-radius:10px;cursor:pointer;flex-direction:column;justify-content:center;align-items:center;gap:5px}
.burger span{width:22px;height:2px;background:#fff;border-radius:2px;transition:.25s}
.burger.active span:nth-child(1){transform:translateY(7px) rotate(45deg)}
.burger.active span:nth-child(2){opacity:0}
.burger.active span:nth-child(3){transform:translateY(-7px) rotate(-45deg)}

/* ---------- Star divider ---------- */
.star-divider{height:22px;background-color:var(--brand-deep);background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='44' height='22' viewBox='0 0 44 22'%3E%3Cpath d='M22 3l2.6 5.4 5.9.8-4.3 4.2 1 5.9L22 16.4l-5.2 2.9 1-5.9-4.3-4.2 5.9-.8z' fill='none' stroke='%23d4aa55' stroke-width='1.1'/%3E%3C/svg%3E");background-repeat:repeat-x;background-position:center;border-top:1px solid rgba(212,170,85,.4);border-bottom:1px solid rgba(212,170,85,.4)}

/* ---------- Hero ---------- */
.hero{position:relative;color:#fff;overflow:hidden;background:
  radial-gradient(800px 420px at 85% 20%,rgba(212,170,85,.18),transparent 60%),
  linear-gradient(135deg,var(--brand) 0%,var(--brand-dark) 60%,var(--brand-deep) 100%)}
.hero::before{content:"";position:absolute;inset:0;opacity:.07;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='80' height='80' viewBox='0 0 80 80'%3E%3Cpath d='M40 6l8 16 18 2-13 13 3 18-16-9-16 9 3-18L14 24l18-2z' fill='none' stroke='white' stroke-width='1'/%3E%3C/svg%3E")}
.hero .container{position:relative;display:grid;grid-template-columns:1.15fr .85fr;gap:56px;align-items:center;padding-top:70px}
.eyebrow{display:inline-block;padding:7px 18px;border:1px solid rgba(232,207,148,.55);border-radius:999px;color:var(--gold-soft);font-size:.9rem;background:rgba(255,255,255,.06);margin-bottom:22px}
.hero h2{font-size:clamp(2rem,4.2vw,3.2rem);line-height:1.4;margin-bottom:20px}
.hero h2 em{font-style:normal;color:var(--gold-soft)}
.hero .lead{font-size:1.1rem;color:#f2dde4;max-width:56ch;margin-bottom:32px}
.actions{display:flex;gap:14px;flex-wrap:wrap}

.arch-frame{position:relative;display:flex;justify-content:center;padding-bottom:40px}
.arch{position:relative;width:100%;max-width:340px;aspect-ratio:3/4;border-radius:999px 999px 20px 20px;border:3px solid var(--gold);padding:10px;background:linear-gradient(180deg,var(--brand-light),var(--brand-deep));box-shadow:0 0 0 10px rgba(212,170,85,.15),var(--shadow-lg);display:grid;place-items:center;overflow:hidden}
.arch .glow{position:absolute;width:260px;height:260px;border-radius:50%;background:radial-gradient(circle,rgba(232,207,148,.55),transparent 70%);top:14%}
.glyph{position:relative;text-align:center;font-family:var(--f-ar);font-size:4.4rem;color:var(--gold-soft);line-height:1.2;text-shadow:0 4px 18px rgba(0,0,0,.4)}
.glyph small{display:block;font-family:var(--f-body);font-size:.9rem;color:#f2dde4;margin-top:10px;padding:0 20px}
.stat-chip{position:absolute;bottom:0;left:50%;transform:translateX(-50%);display:flex;background:#fff;color:var(--ink);border-radius:14px;box-shadow:var(--shadow-lg);overflow:hidden;white-space:nowrap}
.stat-chip > div{padding:12px 20px;text-align:center;border-right:1px solid var(--line)}
.stat-chip > div:last-child{border:0}
.stat-chip strong{display:block;font-family:var(--f-head);font-size:1.35rem;color:var(--brand);line-height:1.3}
.stat-chip span{font-size:.78rem;color:var(--muted)}

/* ---------- Section heads ---------- */
.section-head{text-align:center;max-width:680px;margin:0 auto 52px}
.kicker{display:inline-block;color:var(--brand);font-weight:600;font-size:.95rem;padding-bottom:6px;margin-bottom:10px;border-bottom:2px solid var(--gold)}
.section-head h3{font-size:clamp(1.55rem,3vw,2.2rem);color:var(--brand-dark);margin-bottom:12px}
.section-head p{color:var(--muted)}

/* ---------- Pillars ---------- */
.pillars{display:grid;grid-template-columns:repeat(3,1fr);gap:26px}
.pillar{background:#fff;border:1px solid var(--line);border-radius:var(--radius);padding:34px 28px;box-shadow:var(--shadow);position:relative;overflow:hidden;transition:transform .25s,box-shadow .25s}
.pillar::before{content:"";position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(90deg,var(--brand),var(--gold))}
.pillar:hover{transform:translateY(-6px);box-shadow:var(--shadow-lg)}
.pillar .icon{width:64px;height:64px;border-radius:18px;display:grid;place-items:center;font-size:1.8rem;background:var(--paper-2);border:1px solid var(--line);margin-bottom:18px}
.pillar h4{font-size:1.25rem;color:var(--brand);margin-bottom:10px}
.pillar p{color:var(--muted);font-size:.97rem}

/* ---------- Departments ---------- */
.dept-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:22px}
.dept-card{display:flex;gap:20px;align-items:flex-start;background:#fff;border-radius:var(--radius);padding:26px;border:1px solid var(--line);border-left:5px solid var(--brand);transition:.25s}
.dept-card:hover{border-left-color:var(--gold);box-shadow:var(--shadow);transform:translateX(4px)}
.dept-card .num{flex-shrink:0;writing-mode:horizontal-tb;background:var(--brand);color:var(--gold-soft);font-size:.8rem;font-weight:600;padding:6px 12px;border-radius:8px;white-space:nowrap}
.dept-card h4{font-size:1.2rem;color:var(--brand-dark);margin-bottom:6px}
.dept-card p{color:var(--muted);font-size:.95rem}

/* ---------- Stats band ---------- */
.band{background:linear-gradient(135deg,var(--brand),var(--brand-dark));color:#fff;padding:46px 0}
.band .container{display:grid;grid-template-columns:repeat(4,1fr);gap:20px;text-align:center}
.band .item{padding:6px 10px;border-right:1px solid rgba(232,207,148,.25)}
.band .item:last-child{border:0}
.band strong{display:block;font-family:var(--f-head);font-size:2.4rem;color:var(--gold-soft);line-height:1.3}
.band span{font-size:.95rem;color:#f2dde4}

/* ---------- Notice + Admission ---------- */
.notice-wrap{display:grid;grid-template-columns:1.4fr 1fr;gap:34px;align-items:start}
.notice-list{display:flex;flex-direction:column;gap:16px}
.notice-item{display:flex;gap:20px;background:#fff;border:1px solid var(--line);border-radius:var(--radius);padding:20px;transition:.25s}
.notice-item:hover{box-shadow:var(--shadow);border-color:var(--brand)}
.notice-date{flex-shrink:0;width:72px;height:80px;border-radius:12px;background:var(--brand);color:#fff;display:flex;flex-direction:column;align-items:center;justify-content:center;border-bottom:4px solid var(--gold)}
.notice-date strong{font-family:var(--f-head);font-size:1.7rem;line-height:1.2}
.notice-date span{font-size:.8rem;color:var(--gold-soft)}
.notice-item h5{font-size:1.08rem;color:var(--brand-dark);margin-bottom:4px}
.notice-item p{font-size:.92rem;color:var(--muted);margin-bottom:8px}
.tag{display:inline-block;background:var(--paper-2);color:var(--brand);border:1px solid var(--line);font-size:.78rem;font-weight:600;padding:2px 12px;border-radius:999px}

.admission-card{background:linear-gradient(160deg,var(--brand),var(--brand-deep));color:#fff;border-radius:20px;padding:34px 30px;box-shadow:var(--shadow-lg);border:2px solid var(--gold);position:sticky;top:100px}
.admission-card h4{font-size:1.4rem;color:var(--gold-soft);margin-bottom:10px}
.admission-card p{font-size:.95rem;color:#f2dde4;margin-bottom:20px}
.admission-card ul{margin-bottom:26px}
.admission-card li{display:flex;justify-content:space-between;gap:10px;padding:12px 0;border-bottom:1px dashed rgba(232,207,148,.35);font-size:.96rem}
.admission-card li span:last-child{color:var(--gold-soft);font-weight:600}

/* ---------- Gallery ---------- */
.gallery-grid{display:grid;grid-template-columns:repeat(4,1fr);grid-auto-rows:190px;gap:14px}
.gtile{position:relative;border-radius:var(--radius);overflow:hidden;background-size:cover;background-position:center;display:flex;align-items:flex-end;transition:transform .3s}
.gtile:hover{transform:scale(1.02)}
.gtile::after{content:"";position:absolute;inset:0;background:linear-gradient(180deg,transparent 45%,rgba(63,10,25,.85))}
.gtile span{position:relative;z-index:1;color:#fff;font-weight:600;padding:16px 18px}
.g1{grid-column:span 2;grid-row:span 2}
.gt1{background-image:linear-gradient(135deg,var(--brand-light),var(--brand-deep))}
.gt2{background-image:linear-gradient(135deg,#b0833a,#5f0f25)}
.gt3{background-image:linear-gradient(135deg,var(--brand),#2d0712)}
.gt4{background-image:linear-gradient(135deg,#c99a4a,var(--brand-dark))}
.gt5{grid-column:span 2;background-image:linear-gradient(135deg,var(--brand-dark),var(--brand-light))}
/* ছবি বসাতে: .gt1{background-image:url('/asset/image/g1.jpg')} */

/* ---------- Testimonials ---------- */
.quote-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:26px}
.quote-card{background:#fff;border:1px solid var(--line);border-radius:var(--radius);padding:30px 26px;box-shadow:var(--shadow);position:relative}
.quote-card::before{content:"“";position:absolute;top:6px;right:22px;font-family:var(--f-head);font-size:5rem;line-height:1;color:var(--paper-2)}
.stars{color:var(--gold);letter-spacing:3px;margin-bottom:12px}
.quote-card p{position:relative;color:var(--muted);font-size:.97rem;margin-bottom:22px}
.quote-who{display:flex;align-items:center;gap:12px;padding-top:16px;border-top:1px solid var(--line)}
.av{width:46px;height:46px;border-radius:50%;background:linear-gradient(135deg,var(--brand),var(--gold));flex-shrink:0}
.quote-who strong{display:block;color:var(--brand-dark);font-size:.97rem;line-height:1.4}
.quote-who span{font-size:.82rem;color:var(--muted)}

/* ---------- CTA banner ---------- */
.cta-banner{max-width:1156px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;gap:28px;padding:44px 48px;border-radius:24px;color:#fff;background:
  radial-gradient(500px 240px at 100% 0,rgba(212,170,85,.3),transparent 65%),
  linear-gradient(135deg,var(--brand),var(--brand-deep));
  border:2px solid var(--gold);box-shadow:var(--shadow-lg)}
.cta-banner h3{font-size:clamp(1.3rem,2.4vw,1.8rem);margin-bottom:8px}
.cta-banner p{color:#f2dde4}
section:has(> .cta-banner){padding-left:22px;padding-right:22px}

/* ---------- Footer ---------- */
footer{background:var(--brand-deep);color:#e9d3da;padding-top:64px}
.footer-grid{display:grid;grid-template-columns:1.5fr 1fr 1fr 1.5fr;gap:40px;padding-bottom:48px}
.foot-brand{display:flex;align-items:center;gap:12px;margin-bottom:16px}
.foot-brand span{font-family:var(--f-head);font-size:1.25rem;color:#fff;font-weight:700}
footer p{font-size:.94rem}
footer h5{color:var(--gold-soft);font-size:1.08rem;margin-bottom:18px;padding-bottom:10px;position:relative}
footer h5::after{content:"";position:absolute;left:0;bottom:0;width:38px;height:2px;background:var(--gold)}
footer ul li{margin-bottom:10px;font-size:.94rem}
footer ul a{transition:.2s}
footer ul a:hover{color:var(--gold-soft);padding-left:6px}
.bottom-bar{text-align:center;padding:20px 16px;font-size:.88rem;background:#2e0712;color:#cdb0b9}

/* ---------- Responsive ---------- */
@media (max-width:1100px){
  .names span{display:none}
  nav.main a{padding:10px 9px;font-size:.9rem}
}
@media (max-width:980px){
  section{padding:64px 0}
  .burger{display:flex}
  nav.main{position:absolute;top:100%;left:0;right:0;background:var(--brand-dark);max-height:0;overflow:hidden;transition:max-height .35s ease;border-bottom:3px solid var(--gold)}
  nav.main.open{max-height:80vh;overflow-y:auto}
  nav.main > ul{flex-direction:column;align-items:stretch;padding:10px 16px 18px;gap:0}
  nav.main a{padding:13px 10px;border-bottom:1px solid rgba(255,255,255,.08);border-radius:0}
  .has-sub > a{justify-content:space-between}
  .caret{padding:4px 10px}
  .submenu{position:static;opacity:1;visibility:visible;transform:none;box-shadow:none;background:rgba(0,0,0,.18);border-top:0;border-radius:8px;padding:0 0 0 12px;max-height:0;overflow:hidden;transition:max-height .3s}
  .has-sub:hover > .submenu{max-height:0}
  .has-sub.sub-open > .submenu{max-height:400px}
  .submenu a{color:#f2dde4}
  .submenu a:hover{background:transparent;color:var(--gold-soft)}
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
  .nav-cta{padding:8px 14px;font-size:.82rem}
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