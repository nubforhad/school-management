<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>নিদাউল কুরআন মাদরাসা</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Bengali:wght@400;500;600;700;800&family=Hind+Siliguri:wght@300;400;500;600;700&family=Amiri:ital@0;1&display=swap" rel="stylesheet">
<style>
  :root{
    --ink:#1b1a17;
    --paper:#f6f1e4;
    --paper-2:#efe7d3;
    --teal-900:#0a2e26;
    --teal-800:#0d3d32;
    --teal-700:#145c46;
    --teal-600:#1b7a5c;
    --gold:#c6a15b;
    --gold-light:#e3c988;
    --maroon:#7c2d2d;
    --line: rgba(198,161,91,0.35);
    --shadow: 0 20px 50px -20px rgba(10,46,38,0.35);
  }
  *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
  html{scroll-behavior:smooth;}
  body{
    font-family:'Hind Siliguri', sans-serif;
    background:var(--paper);
    color:var(--ink);
    line-height:1.7;
    overflow-x:hidden;
  }
  h1,h2,h3,h4,.brand,.nav-cta{font-family:'Noto Serif Bengali', serif;}
  a{color:inherit;text-decoration:none;}
  ul{list-style:none;}
  img{max-width:100%;display:block;}
  .container{max-width:1180px;margin:0 auto;padding:0 24px;}
  ::selection{background:var(--gold-light);color:var(--teal-900);}

  /* ===== Islamic geometric star pattern (signature motif) ===== */
  .star-divider{
    height:34px;
    width:100%;
    background-repeat:repeat-x;
    background-size:34px 34px;
    background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='34' height='34' viewBox='0 0 34 34'%3E%3Cg fill='none' stroke='%23c6a15b' stroke-width='1.1'%3E%3Cpath d='M17 2 L21 9 L29 9 L23 14 L26 22 L17 17 L8 22 L11 14 L5 9 L13 9 Z'/%3E%3C/g%3E%3C/svg%3E");
    opacity:.7;
  }
  .star-divider.dark{
    background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='34' height='34' viewBox='0 0 34 34'%3E%3Cg fill='none' stroke='%23e3c988' stroke-width='1.1'%3E%3Cpath d='M17 2 L21 9 L29 9 L23 14 L26 22 L17 17 L8 22 L11 14 L5 9 L13 9 Z'/%3E%3C/g%3E%3C/svg%3E");
  }

  /* ===== Top strip ===== */
  .topbar{
    background:var(--teal-900);
    color:var(--gold-light);
    font-size:13.5px;
    letter-spacing:.02em;
  }
  .topbar .container{
    display:flex;justify-content:space-between;align-items:center;
    padding-top:8px;padding-bottom:8px;flex-wrap:wrap;gap:6px;
  }
  .topbar .bismillah{font-family:'Amiri', serif;font-size:15px;color:var(--gold-light);opacity:.95;}
  .topbar .contacts{display:flex;gap:18px;flex-wrap:wrap;}
  .topbar .contacts span{opacity:.9;}

  /* ===== Header / Nav ===== */
  header.site{
    background:var(--paper);
    position:sticky;top:0;z-index:100;
    border-bottom:1px solid var(--line);
  }
  .nav-wrap{
    display:flex;align-items:center;justify-content:space-between;
    padding:14px 0;
  }
  .brand{
    display:flex;align-items:center;gap:12px;
  }
  .brand .mark{
    width:52px;height:52px;border-radius:50%;
    /* background:radial-gradient(circle at 35% 30%, var(--teal-600), var(--teal-900)); */
    display:flex;align-items:center;justify-content:center;
    box-shadow:var(--shadow);
    flex-shrink:0;
  }
  .brand .mark svg{width:28px;height:28px;}
  .brand .names h1{font-size:20px;color:var(--teal-900);font-weight:700;line-height:1.2;}
  .brand .names span{font-size:12px;letter-spacing:.08em;color:var(--maroon);font-family:'Hind Siliguri',sans-serif;}

  nav.main{}
  nav.main > ul{display:flex;gap:2px;align-items:center;}
  nav.main > ul > li{position:relative;}
  nav.main > ul > li > a{
    display:flex;align-items:center;gap:5px;
    padding:12px 16px;
    font-size:15.5px;font-weight:600;color:var(--teal-900);
    border-radius:6px;
    transition:background .2s, color .2s;
  }
  nav.main > ul > li > a:hover, nav.main > ul > li.open > a{
    background:var(--teal-900);color:var(--gold-light);
  }
  nav.main .caret{font-size:10px;transform:translateY(1px);transition:transform .2s;}
  nav.main > ul > li.open .caret{transform:rotate(180deg);}

  .submenu{
    position:absolute;top:calc(100% + 10px);left:0;
    min-width:230px;
    background:var(--teal-900);
    border-radius:10px;
    padding:10px;
    box-shadow:var(--shadow);
    opacity:0;visibility:hidden;transform:translateY(6px);
    transition:opacity .18s ease, transform .18s ease, visibility .18s;
    border:1px solid rgba(198,161,91,.25);
  }
  nav.main > ul > li.open .submenu{opacity:1;visibility:visible;transform:translateY(0);}
  .submenu li a{
    display:block;padding:10px 14px;border-radius:7px;
    font-size:14.5px;color:#efe4c4;font-weight:500;
  }
  .submenu li a:hover{background:rgba(198,161,91,.18);color:var(--gold-light);}

  .nav-cta{
    background:var(--gold);
    color:var(--teal-900);
    padding:11px 22px;
    border-radius:30px;
    font-weight:700;
    font-size:14.5px;
    box-shadow:0 8px 18px -6px rgba(198,161,91,.6);
    transition:transform .2s, box-shadow .2s;
    white-space:nowrap;
  }
  .nav-cta:hover{transform:translateY(-2px);box-shadow:0 12px 22px -6px rgba(198,161,91,.75);}

  .burger{display:none;background:none;border:none;cursor:pointer;padding:8px;}
  .burger span{display:block;width:26px;height:2.5px;background:var(--teal-900);margin:5px 0;border-radius:2px;}

  /* ===== HERO ===== */
  .hero{
    position:relative;
    background:
      radial-gradient(ellipse at 15% 20%, rgba(198,161,91,.15), transparent 45%),
      radial-gradient(ellipse at 85% 80%, rgba(198,161,91,.10), transparent 50%),
      linear-gradient(180deg, var(--teal-900), var(--teal-800) 55%, var(--teal-700));
    color:var(--paper);
    overflow:hidden;
  }
  .hero .container{
    position:relative;z-index:2;
    display:grid;grid-template-columns:1.1fr .9fr;gap:40px;
    align-items:center;
    padding-top:70px;padding-bottom:0;
  }
  .hero .eyebrow{
    display:inline-flex;align-items:center;gap:8px;
    font-size:13px;letter-spacing:.14em;
    color:var(--gold-light);
    border:1px solid rgba(227,201,136,.4);
    padding:6px 14px;border-radius:30px;
    margin-bottom:22px;
  }
  .hero h2{
    font-size:44px;line-height:1.35;font-weight:800;
    color:#fbf6e8;
    margin-bottom:20px;
  }
  .hero h2 em{font-style:normal;color:var(--gold-light);}
  .hero p.lead{
    font-size:16.5px;color:rgba(246,241,228,.82);
    max-width:520px;margin-bottom:32px;
  }
  .hero .actions{display:flex;gap:14px;flex-wrap:wrap;margin-bottom:56px;}
  .btn{
    padding:14px 26px;border-radius:8px;font-weight:700;font-size:15px;
    display:inline-flex;align-items:center;gap:8px;
    transition:transform .2s, box-shadow .2s, background .2s;
  }
  .btn-gold{background:var(--gold);color:var(--teal-900);box-shadow:0 12px 26px -10px rgba(198,161,91,.7);}
  .btn-gold:hover{transform:translateY(-2px);}
  .btn-outline{border:1.5px solid rgba(246,241,228,.5);color:#fbf6e8;}
  .btn-outline:hover{background:rgba(246,241,228,.08);}

  /* Mihrab / arch visual — the signature element */
  .arch-frame{
    position:relative;
    height:460px;
    display:flex;align-items:flex-end;justify-content:center;
  }
  .arch{
    width:100%;height:100%;
    background:linear-gradient(160deg, var(--teal-600), var(--teal-800) 70%);
    border-radius:230px 230px 14px 14px;
    border:2px solid var(--gold);
    position:relative;
    box-shadow:0 30px 60px -20px rgba(0,0,0,.5), inset 0 0 0 8px rgba(198,161,91,.12);
    display:flex;align-items:center;justify-content:center;
    overflow:hidden;
  }
  .arch::before{
    content:'';position:absolute;inset:22px;
    border:1px solid rgba(227,201,136,.5);
    border-radius:210px 210px 8px 8px;
  }
  .arch .glyph{
    font-family:'Amiri', serif;
    font-size:64px;color:var(--gold-light);
    text-align:center;line-height:1.5;
    z-index:2;
  }
  .arch .glyph small{display:block;font-family:'Noto Serif Bengali',serif;font-size:16px;color:rgba(251,246,232,.8);margin-top:14px;letter-spacing:.05em;}
  .arch .glow{
    position:absolute;width:280px;height:280px;border-radius:50%;
    background:radial-gradient(circle, rgba(198,161,91,.35), transparent 70%);
    top:-40px;
  }
  .stat-chip{
    position:absolute;bottom:-26px;left:50%;transform:translateX(-50%);
    background:var(--paper);color:var(--teal-900);
    padding:14px 26px;border-radius:14px;
    box-shadow:var(--shadow);
    display:flex;gap:26px;
    font-family:'Noto Serif Bengali',serif;
    z-index:3;
    white-space:nowrap;
  }
  .stat-chip div{text-align:center;}
  .stat-chip strong{display:block;font-size:20px;color:var(--maroon);}
  .stat-chip span{font-size:11.5px;font-family:'Hind Siliguri',sans-serif;color:#5b5546;}

  /* ===== Section shells ===== */
  section{padding:100px 0 90px;}
  .section-head{max-width:640px;margin:0 auto 56px;text-align:center;}
  .section-head .kicker{
    color:var(--maroon);font-weight:700;font-size:13.5px;
    letter-spacing:.16em;display:block;margin-bottom:10px;
  }
  .section-head h3{font-size:32px;color:var(--teal-900);font-weight:700;}
  .section-head p{margin-top:14px;color:#5b5546;font-size:15.5px;}

  /* ===== Pillars ===== */
  .pillars{display:grid;grid-template-columns:repeat(3,1fr);gap:26px;}
  .pillar{
    background:#fff;border:1px solid var(--line);
    border-radius:16px;padding:34px 28px;
    position:relative;
    transition:transform .25s, box-shadow .25s;
  }
  .pillar:hover{transform:translateY(-6px);box-shadow:var(--shadow);}
  .pillar .icon{
    width:56px;height:56px;border-radius:14px;
    background:linear-gradient(135deg, var(--teal-700), var(--teal-900));
    display:flex;align-items:center;justify-content:center;
    margin-bottom:20px;color:var(--gold-light);font-size:24px;
  }
  .pillar h4{font-size:19px;color:var(--teal-900);margin-bottom:10px;}
  .pillar p{font-size:14.5px;color:#5b5546;}

  /* ===== Departments ===== */
  .dept-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:20px;}
  .dept-card{
    background:var(--teal-900);color:var(--paper);
    border-radius:16px;padding:28px 22px;
    min-height:210px;display:flex;flex-direction:column;justify-content:space-between;
    position:relative;overflow:hidden;
    border:1px solid rgba(198,161,91,.25);
    transition:transform .25s;
  }
  .dept-card:hover{transform:translateY(-6px);}
  .dept-card .num{font-family:'Noto Serif Bengali',serif;font-size:13px;color:var(--gold-light);opacity:.8;}
  .dept-card h4{font-size:18px;margin:14px 0 8px;font-weight:700;}
  .dept-card p{font-size:13.5px;color:rgba(246,241,228,.72);}
  .dept-card::after{
    content:'';position:absolute;right:-30px;bottom:-30px;width:120px;height:120px;
    border-radius:50%;background:radial-gradient(circle, rgba(198,161,91,.18), transparent 70%);
  }

  /* ===== Why us / stats band ===== */
  .band{
    background:var(--teal-800);
    color:var(--paper);
    padding:70px 0;
    position:relative;
  }
  .band .container{
    display:grid;grid-template-columns:repeat(4,1fr);gap:20px;text-align:center;
  }
  .band .item strong{
    display:block;font-family:'Noto Serif Bengali',serif;
    font-size:38px;color:var(--gold-light);
  }
  .band .item span{font-size:14px;color:rgba(246,241,228,.75);}

  /* ===== Notices ===== */
  .notice-wrap{display:grid;grid-template-columns:1.3fr .9fr;gap:40px;}
  .notice-list{display:flex;flex-direction:column;border-top:1px solid var(--line);}
  .notice-item{
    display:flex;gap:22px;align-items:flex-start;
    padding:22px 4px;border-bottom:1px solid var(--line);
  }
  .notice-date{
    background:var(--paper-2);border:1px solid var(--line);
    border-radius:10px;padding:10px 14px;text-align:center;flex-shrink:0;
    font-family:'Noto Serif Bengali',serif;color:var(--teal-900);
    min-width:64px;
  }
  .notice-date strong{display:block;font-size:20px;}
  .notice-date span{font-size:11px;color:var(--maroon);}
  .notice-item h5{font-size:16.5px;color:var(--teal-900);margin-bottom:6px;}
  .notice-item p{font-size:13.5px;color:#5b5546;}
  .notice-item .tag{
    display:inline-block;margin-top:8px;font-size:11.5px;
    background:rgba(124,45,45,.1);color:var(--maroon);
    padding:3px 10px;border-radius:20px;font-weight:600;
  }

  .admission-card{
    background:linear-gradient(160deg, var(--maroon), #5a1f1f);
    border-radius:18px;padding:34px 30px;color:#f8e9e0;
    box-shadow:var(--shadow);
    height:fit-content;
  }
  .admission-card h4{font-family:'Noto Serif Bengali',serif;font-size:22px;margin-bottom:14px;color:#fdeee6;}
  .admission-card p{font-size:14px;color:rgba(248,233,224,.85);margin-bottom:22px;}
  .admission-card ul{margin-bottom:24px;}
  .admission-card li{
    font-size:13.5px;padding:8px 0;border-bottom:1px dashed rgba(248,233,224,.25);
    display:flex;justify-content:space-between;
  }
  .admission-card .btn-gold{width:100%;justify-content:center;}

  /* ===== Gallery ===== */
  .gallery-grid{
    display:grid;grid-template-columns:repeat(4,1fr);grid-auto-rows:140px;gap:14px;
  }
  .gallery-grid .g1{grid-column:span 2;grid-row:span 2;}
  .gtile{
    border-radius:14px;position:relative;overflow:hidden;
    display:flex;align-items:flex-end;padding:16px;
    color:#fbf6e8;font-family:'Noto Serif Bengali',serif;font-size:14px;
  }
  .gtile::before{content:'';position:absolute;inset:0;opacity:.85;}
  .gtile span{position:relative;z-index:2;}
  .gtile::after{content:'';position:absolute;inset:0;background:linear-gradient(180deg, transparent 40%, rgba(10,46,38,.75));z-index:1;}
  .gt1::before{background:linear-gradient(135deg,#1b7a5c,#0a2e26);}
  .gt2::before{background:linear-gradient(135deg,#c6a15b,#7c2d2d);}
  .gt3::before{background:linear-gradient(135deg,#145c46,#c6a15b);}
  .gt4::before{background:linear-gradient(135deg,#7c2d2d,#0d3d32);}
  .gt5::before{background:linear-gradient(135deg,#0d3d32,#1b7a5c);}

  /* ===== Testimonials ===== */
  .quote-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px;}
  .quote-card{
    background:#fff;border:1px solid var(--line);border-radius:16px;padding:28px;
  }
  .quote-card .stars{color:var(--gold);font-size:14px;margin-bottom:14px;}
  .quote-card p{font-size:14.5px;color:#3f3b30;margin-bottom:20px;}
  .quote-who{display:flex;align-items:center;gap:12px;}
  .quote-who .av{
    width:42px;height:42px;border-radius:50%;
    background:linear-gradient(135deg,var(--teal-600),var(--teal-900));
  }
  .quote-who strong{display:block;font-size:14px;color:var(--teal-900);}
  .quote-who span{font-size:12px;color:#6b6555;}

  /* ===== CTA banner ===== */
  .cta-banner{
    background:radial-gradient(ellipse at 30% 30%, rgba(198,161,91,.25), transparent 60%), var(--teal-900);
    border-radius:24px;padding:60px 50px;
    display:flex;justify-content:space-between;align-items:center;
    gap:30px;flex-wrap:wrap;color:var(--paper);
    margin:0 24px;
    max-width:1180px;margin-left:auto;margin-right:auto;
  }
  .cta-banner h3{font-size:28px;max-width:480px;}
  .cta-banner p{color:rgba(246,241,228,.75);margin-top:10px;font-size:14.5px;}

  /* ===== Footer ===== */
  footer{background:var(--teal-900);color:rgba(246,241,228,.8);padding-top:70px;}
  .footer-grid{
    display:grid;grid-template-columns:1.4fr 1fr 1fr 1.2fr;gap:40px;padding-bottom:50px;
  }
  .footer-grid h5{color:var(--gold-light);font-family:'Noto Serif Bengali',serif;font-size:16px;margin-bottom:18px;}
  .footer-grid p{font-size:13.5px;line-height:1.8;}
  .footer-grid ul li{margin-bottom:10px;font-size:13.5px;}
  .footer-grid ul li a:hover{color:var(--gold-light);}
  .foot-brand{display:flex;align-items:center;gap:10px;margin-bottom:16px;}
  .foot-brand .mark{width:40px;height:40px;border-radius:50%;background:radial-gradient(circle at 35% 30%, var(--teal-600), var(--teal-900));border:1px solid var(--gold);display:flex;align-items:center;justify-content:center;}
  .foot-brand span{font-family:'Noto Serif Bengali',serif;font-size:17px;color:#fbf6e8;font-weight:700;}
  .bottom-bar{
    border-top:1px solid rgba(198,161,91,.2);
    padding:22px 0;text-align:center;font-size:12.5px;color:rgba(246,241,228,.55);
  }

  /* ===== Responsive ===== */
  @media (max-width: 980px){
    .hero .container{grid-template-columns:1fr;padding-top:40px;}
    .arch-frame{height:320px;order:-1;}
    .pillars,.dept-grid,.band .container,.quote-grid{grid-template-columns:repeat(2,1fr)}
    .notice-wrap{grid-template-columns:1fr;}
    .footer-grid{grid-template-columns:1fr 1fr;}
    .gallery-grid{grid-template-columns:repeat(2,1fr)}
    .gallery-grid .g1{grid-column:span 2;}
  }
  @media (max-width: 720px){
    nav.main{position:fixed;inset:0 0 0 30%;top:0;background:var(--teal-900);
      transform:translateX(100%);transition:transform .3s ease;z-index:200;
      padding:90px 24px 24px;overflow-y:auto;}
    nav.main.open{transform:translateX(0);}
    nav.main > ul{flex-direction:column;align-items:stretch;gap:4px;}
    nav.main > ul > li > a{color:#fbf6e8;justify-content:space-between;}
    nav.main > ul > li > a:hover{background:rgba(198,161,91,.15);}
    .submenu{position:static;background:rgba(0,0,0,.2);opacity:1;visibility:visible;transform:none;max-height:0;overflow:hidden;padding:0;transition:max-height .25s ease, padding .25s ease;}
    nav.main > ul > li.open .submenu{max-height:400px;padding:8px;margin-top:4px;}
    .burger{display:block;}
    .nav-cta{display:none;}
    .hero h2{font-size:32px;}
    .pillars,.dept-grid,.band .container,.quote-grid{grid-template-columns:1fr}
    .cta-banner{flex-direction:column;text-align:center;padding:40px 26px;}
    .footer-grid{grid-template-columns:1fr;}
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