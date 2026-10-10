
<div class="topbar">
  <div class="container">
    <span class="bismillah">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</span>
    <div class="contacts">
      <span>📞 {{ $settings->get('phone') ?? '01713-260111' }} </span>
      <span>✉️ {{ $settings->get('email') ?? 'info@nidarul-madrasha.edu.bd'  }} </span>
      <span>📍 ঢাকা, বাংলাদেশ</span>
    </div>
  </div>
</div>

<header class="site">
  <div class="container nav-wrap">
    <a href="#top" class="brand">
      <div class="mark">
        <img src="{{ asset('asset/image/imagelogo.png') }}" alt="logo">
        <!-- <svg viewBox="0 0 24 24" fill="none"><path d="M12 2 L12 22 M4 8 Q12 2 20 8 M4 8 L4 20 Q12 24 20 20 L20 8" stroke="#e3c988" stroke-width="1.4" fill="none"/></svg> -->
      </div>
      <div class="names">
        <h1>নিদাউল কুরআন মাদরাসা</h1>
        <span>"সবার জন্য কুরআনের শিক্ষা" </span>
      </div>
    </a>

    <button class="burger" id="burgerBtn" aria-label="মেনু খুলুন">
      <span></span><span></span><span></span>
    </button>

    <nav class="main" id="mainNav">
      <ul>
        <li><a href="#top">হোম</a></li>

        <li class="has-sub">
          <a href="#about">আমাদের সম্পর্কে <span class="caret">▾</span></a>
          <ul class="submenu">
            <li><a href="#about">প্রতিষ্ঠানের পরিচিতি</a></li>
            <li><a href="#about">লক্ষ্য ও উদ্দেশ্য</a></li>
            <li><a href="#about">মুহতামিম ও শিক্ষক মণ্ডলী</a></li>
            <li><a href="#about">প্রতিষ্ঠার ইতিহাস</a></li>
          </ul>
        </li>

        <li class="has-sub">
          <a href="#departments">শিক্ষা কার্যক্রম <span class="caret">▾</span></a>
          <ul class="submenu">
            <li><a href="#departments">নূরানী ও মক্তব বিভাগ</a></li>
            <li><a href="#departments">হিফজুল কুরআন বিভাগ</a></li>
            <li><a href="#departments">কিতাব বিভাগ (দাওরায়ে হাদিস)</a></li>
            <li><a href="#departments">সাধারণ শিক্ষা বিভাগ</a></li>
          </ul>
        </li>

        <li class="has-sub">
          <a href="#admission">ভর্তি তথ্য <span class="caret">▾</span></a>
          <ul class="submenu">
            <li><a href="#admission">ভর্তি নিয়মাবলী</a></li>
            <li><a href="#admission">বেতন ও ফি কাঠামো</a></li>
            <li><a href="#admission">আবাসন ও বোর্ডিং</a></li>
            <li><a href="#admission">ভর্তি ফরম ডাউনলোড</a></li>
          </ul>
        </li>

        <li class="has-sub">
          <a href="#notice">নোটিশ বোর্ড <span class="caret">▾</span></a>
          <ul class="submenu">
            <li><a href="#notice">সকল নোটিশ</a></li>
            <li><a href="#notice">পরীক্ষার রুটিন</a></li>
            <li><a href="#notice">ছুটির তালিকা</a></li>
            <li><a href="#notice">রেজাল্ট</a></li>
          </ul>
        </li>

        <li><a href="#gallery">গ্যালারি</a></li>

        <li class="has-sub">
          <a href="#contact">যোগাযোগ <span class="caret">▾</span></a>
          <ul class="submenu">
            <li><a href="#contact">ঠিকানা ও মানচিত্র</a></li>
            <li><a href="#contact">দাতা ও অনুদান</a></li>
            <li><a href="#contact">অভিযোগ ও পরামর্শ</a></li>
          </ul>
        </li>
      </ul>
    </nav>

    <a href="{{ route('admission') }}" class="nav-cta">ভর্তি চলছে</a>
  </div>
</header>