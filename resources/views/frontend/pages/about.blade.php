@extends('frontend.app')

@section('title', 'আমাদের সম্পর্কে')

@section('content')

<style>
  /* ===== About page extras (existing variables/classes ব্যবহার করা হয়েছে) ===== */
  .page-hero{position:relative;overflow:hidden;text-align:center;padding:72px 0 64px;background:
    radial-gradient(700px 400px at 90% 0,rgba(127,21,49,.10),transparent 60%),
    radial-gradient(600px 360px at 0 100%,rgba(15,76,74,.12),transparent 60%),
    var(--paper)}
  .page-hero h2{font-size:clamp(2rem,4vw,3rem);color:var(--teal-deep);margin-bottom:14px}
  .page-hero h2 em{font-style:normal;color:var(--brand);background:linear-gradient(transparent 68%,var(--amber-soft) 68%)}
  .page-hero p{max-width:62ch;margin:0 auto;color:var(--muted);font-size:1.08rem}
  .crumbs{display:inline-flex;gap:8px;font-size:.88rem;color:var(--muted);margin-bottom:18px}
  .crumbs a{color:var(--brand);font-weight:600}

  .intro-grid{display:grid;grid-template-columns:.85fr 1.15fr;gap:56px;align-items:center}
  .intro-text h3{font-size:clamp(1.6rem,3vw,2.2rem);color:var(--teal-deep);margin-bottom:16px;line-height:1.45}
  .intro-text p{color:var(--muted);margin-bottom:14px}
  .check-list{margin:18px 0 26px;display:grid;gap:10px}
  .check-list li{display:flex;gap:12px;align-items:flex-start;color:var(--ink);font-size:.98rem}
  .check-list li::before{content:"✓";flex-shrink:0;width:26px;height:26px;border-radius:50%;background:var(--brand-tint);color:var(--brand);display:grid;place-items:center;font-size:.85rem;font-weight:700;margin-top:2px}

  .mv-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:26px}
  .mv-card{border-radius:26px;padding:38px 34px;position:relative;overflow:hidden;color:#fff;box-shadow:var(--shadow-lg)}
  .mv-card.m1{background:linear-gradient(160deg,var(--brand),var(--brand-dark))}
  .mv-card.m2{background:linear-gradient(160deg,var(--teal),var(--teal-deep))}
  .mv-card::after{content:"";position:absolute;right:-30px;top:-50px;width:170px;height:170px;border-radius:50%;background:rgba(226,169,59,.18)}
  .mv-card .tag-top{position:relative;display:inline-block;background:rgba(255,255,255,.14);color:var(--amber-soft);font-size:.82rem;font-weight:600;padding:4px 14px;border-radius:999px;margin-bottom:14px}
  .mv-card h4{position:relative;font-size:1.5rem;color:var(--amber-soft);margin-bottom:10px}
  .mv-card p{position:relative;color:#f6dfe5;font-size:.98rem}

  .journey{max-width:860px;margin:0 auto;position:relative;padding-left:34px}
  .journey::before{content:"";position:absolute;left:11px;top:6px;bottom:6px;width:2px;background:var(--line)}
  .j-item{position:relative;background:#fff;border:1px solid var(--line);border-radius:var(--radius);padding:22px 26px;margin-bottom:18px;transition:.25s}
  .j-item:hover{border-color:var(--brand);box-shadow:var(--shadow)}
  .j-item::before{content:"";position:absolute;left:-31px;top:28px;width:16px;height:16px;border-radius:50%;background:var(--amber);box-shadow:0 0 0 4px #fff,0 0 0 5px var(--brand)}
  .j-item .year{display:inline-block;background:var(--teal-tint);color:var(--teal);font-weight:600;font-size:.82rem;padding:3px 14px;border-radius:999px;margin-bottom:8px}
  .j-item h5{font-size:1.12rem;color:var(--teal-deep);margin-bottom:4px}
  .j-item p{color:var(--muted);font-size:.95rem}

  .message-card{display:grid;grid-template-columns:260px 1fr;gap:40px;align-items:center;background:#fff;border:1px solid var(--line);border-radius:30px;padding:40px;box-shadow:var(--shadow)}
  .principal-photo{width:100%;aspect-ratio:3/4;border-radius:999px 999px 20px 20px;background:linear-gradient(170deg,var(--brand-light),var(--brand-dark));box-shadow:0 0 0 6px #fff,0 0 0 8px var(--teal);overflow:hidden;display:grid;place-items:center;color:var(--amber-soft);font-family:var(--f-ar);font-size:3rem}
  .principal-photo img{width:100%;height:100%;object-fit:cover}
  .message-card .q{font-family:var(--f-head);font-size:4rem;line-height:.6;color:var(--brand-tint)}
  .message-card h4{font-size:1.45rem;color:var(--teal-deep);margin-bottom:12px}
  .message-card p{color:var(--muted);margin-bottom:12px}
  .message-card .who strong{display:block;color:var(--brand);font-family:var(--f-head);font-weight:400;font-size:1.2rem}
  .message-card .who span{font-size:.88rem;color:var(--muted)}

  @media (max-width:980px){
    .intro-grid,.mv-grid{grid-template-columns:1fr}
    .intro-grid{gap:40px}
    .message-card{grid-template-columns:1fr;text-align:center;padding:32px 24px}
    .principal-photo{max-width:220px;margin:0 auto}
  }
  @media (max-width:640px){
    .page-hero{padding:56px 0}
    .mv-card{padding:30px 24px}
    .journey{padding-left:26px}
    .j-item{padding:18px 18px}
    .j-item::before{left:-25px}
  }
</style>

<!-- ===== PAGE HERO ===== -->
<section class="page-hero">
  <div class="container">
    <div class="crumbs"><a href="{{ url('/') }}">হোম</a><span>›</span><span>আমাদের সম্পর্কে</span></div>
    <span class="eyebrow" style="display:block;width:max-content;margin:0 auto 22px;">ইলম ও আমলের সম্মিলন</span>
    <h2>নিদাউল কুরআন মাদরাসা <em>পরিচিতি</em></h2>
    <p>বিজ্ঞানময় কুরআন ও সুন্নাহর আলোকে নতুন প্রজন্মকে যুগোপযোগী ও যোগ্য করে গড়ে তোলার এক নিবেদিত প্রতিষ্ঠান।</p>
  </div>
</section>

<div class="star-divider dark"></div>

<!-- ===== INTRO ===== -->
<section id="intro">
  <div class="container">
    <div class="intro-grid">
      <div class="arch-frame">
        <div class="arch">
          <div class="glow"></div>
          <div class="glyph">اقرأ<small>পড়ো, তোমার প্রভুর নামে</small></div>
        </div>
        <div class="stat-chip">
          <div><strong>৬</strong><span>শিক্ষা স্তর</span></div>
          <div><strong>৮ম</strong><span>শ্রেণি পর্যন্ত</span></div>
          <div><strong>বালক-বালিকা</strong><span>উভয়ের জন্য</span></div>
        </div>
      </div>

      <div class="intro-text">
        <span class="kicker">আমরা কারা</span>
        <h3>গতানুগতিক নয়, আদর্শ ও যুগোপযোগী শিক্ষা প্রতিষ্ঠান</h3>
        <p>নিদাউল কুরআন মাদরাসা গতানুগতিক কোনো শিক্ষা প্রতিষ্ঠান নয়। নতুন প্রজন্মসহ সর্বপর্যায়ের মানুষের জন্য বহুমুখী পরিকল্পনা নিয়ে আমরা কাজ করছি। এখানে নুরানি থেকে নাযেরা ও হিফয পর্যন্ত ধাপে ধাপে কুরআন শিক্ষার পাশাপাশি বোর্ড নির্ধারিত জেনারেল সিলেবাসও অনুসরণ করা হয়।</p>
        <ul class="check-list">
          <li>প্লে থেকে ৮ম শ্রেণি পর্যন্ত ছেলে-মেয়ে উভয়ের জন্য শিক্ষা</li>
          <li>হিফযের সাথে জেনারেল শিক্ষার অপূর্ব সমন্বয়</li>
          <li>বাংলা, আরবি ও ইংরেজি—তিন ভাষায় পাঠদান</li>
          <li>আমল-আখলাক ও নৈতিক চরিত্র গঠনে বিশেষ গুরুত্ব</li>
        </ul>
        <div class="actions">
          <a href="{{ route('admission') }}" class="btn btn-gold">ভর্তি আবেদন করুন →</a>
          <a href="{{ route('contact') }}" class="btn btn-outline">যোগাযোগ করুন</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== MISSION & VISION ===== -->
<section id="mission" style="background:var(--paper-2);">
  <div class="container">
    <div class="section-head">
      <span class="kicker">লক্ষ্য-উদ্দেশ্য</span>
      <h3>আমাদের মিশন ও ভিশন</h3>
    </div>
    <div class="mv-grid">
      <div class="mv-card m1">
        <span class="tag-top">আমাদের মিশন</span>
        <h4>যোগ্য প্রজন্ম গঠন</h4>
        <p>আগামী প্রজন্মকে প্রতিযোগিতামূলক বিশ্বে বিজ্ঞানময় কুরআন ও সুন্নাহর আলোকে যুগোপযোগী ও যোগ্য করে তৈরি করা।</p>
      </div>
      <div class="mv-card m2">
        <span class="tag-top">আমাদের ভিশন</span>
        <h4>খাঁটি মুসলিম গড়ে তোলা</h4>
        <p>সকল পর্যায়ের মুসলিম জনসাধারণকে ব্যবহারিক জীবনে একজন খাঁটি মুসলমান হিসেবে গড়ে তোলা।</p>
      </div>
    </div>
  </div>
</section>

<!-- ===== CORE VALUES ===== -->
<section id="values">
  <div class="container">
    <div class="section-head">
      <span class="kicker">আমাদের মূলনীতি</span>
      <h3>যে আদর্শে আমরা এগিয়ে চলি</h3>
    </div>
    <div class="pillars">
      <div class="pillar">
        <div class="icon">📖</div>
        <h4>কুরআন শিক্ষা</h4>
        <p>শুদ্ধ তিলাওয়াত, মাশক্ব ও হুসনে সাওতের প্রশিক্ষণসহ নুরানি থেকে হিফয পর্যন্ত ধাপে ধাপে শিক্ষা।</p>
      </div>
      <div class="pillar">
        <div class="icon">🎓</div>
        <h4>জেনারেল শিক্ষা</h4>
        <p>হিফযের সাথে সমন্বয় করে শ্রেণিভিত্তিক জেনারেল ক্লাস এবং বোর্ড নির্ধারিত সিলেবাস অনুসরণ।</p>
      </div>
      <div class="pillar">
        <div class="icon">🤲</div>
        <h4>আমল-আখলাক</h4>
        <p>প্রতি সেমিস্টার শেষে শিক্ষার্থীর আমল, আখলাক ও শৃঙ্খলাবোধ মূল্যায়ন।</p>
      </div>
      <div class="pillar">
        <div class="icon">🌐</div>
        <h4>তিন ভাষায় দক্ষতা</h4>
        <p>বিশুদ্ধ বাংলা, আরবি ও ইংরেজি ভাষার সমন্বয়ে পাঠদান ও ল্যাঙ্গুয়েজ ক্লাস।</p>
      </div>
      <div class="pillar">
        <div class="icon">🎨</div>
        <h4>সৃজনশীলতা</h4>
        <p>চিত্রাঙ্কন, হাতের লেখা, কালচারাল প্রোগ্রাম এবং সাংস্কৃতিক ও ক্রীড়া প্রতিযোগিতা।</p>
      </div>
      <div class="pillar">
        <div class="icon">🛡️</div>
        <h4>নিরাপদ পরিবেশ</h4>
        <p>সিসিটিভির মাধ্যমে সার্বক্ষণিক নজরদারি এবং অভিভাবকদের সাথে নিয়মিত যোগাযোগ।</p>
      </div>
    </div>
  </div>
</section>

<!-- ===== STATS BAND ===== -->
<div class="star-divider dark"></div>
<div class="band">
  <div class="container">
    <div class="item"><strong>৬</strong><span>শিক্ষা স্তর</span></div>
    <div class="item"><strong>৩</strong><span>ভাষায় পাঠদান</span></div>
    <div class="item"><strong>১৪+</strong><span>স্বাতন্ত্র্য বৈশিষ্ট্য</span></div>
    <div class="item"><strong>২৪/৭</strong><span>সিসিটিভি নজরদারি</span></div>
  </div>
</div>
<div class="star-divider dark"></div>

<!-- ===== JOURNEY ===== -->
<section id="journey">
  <div class="container">
    <div class="section-head">
      <span class="kicker">আমাদের পথচলা</span>
      <h3>প্রতিষ্ঠার ইতিহাস</h3>
      <p>নিচের তারিখ ও বিবরণ আপনার প্রতিষ্ঠানের প্রকৃত তথ্য দিয়ে পরিবর্তন করে নিন।</p>
    </div>
    <div class="journey">
      <div class="j-item">
        <span class="year">২০XX</span>
        <h5>প্রতিষ্ঠা</h5>
        <p>কুরআন ও সুন্নাহর আলোকে একটি আদর্শ শিক্ষা প্রতিষ্ঠানের স্বপ্ন নিয়ে নিদাউল কুরআন মাদরাসার যাত্রা শুরু।</p>
      </div>
      <div class="j-item">
        <span class="year">২০XX</span>
        <h5>হিফয বিভাগ চালু</h5>
        <p>আবাসিক ব্যবস্থাসহ হিফযের সাথে জেনারেল শিক্ষার সমন্বিত কারিকুলাম চালু।</p>
      </div>
      <div class="j-item">
        <span class="year">২০XX</span>
        <h5>বালিকা শাখা সংযোজন</h5>
        <p>ছেলে-মেয়ে উভয়ের জন্য প্লে থেকে ৮ম শ্রেণি পর্যন্ত শিক্ষার সুযোগ সম্প্রসারণ।</p>
      </div>
      <div class="j-item">
        <span class="year">আজ</span>
        <h5>নতুন প্রজন্মের পথে</h5>
        <p>একাডেমিক ক্যালেন্ডার, অভিভাবক সমাবেশ ও আধুনিক পদ্ধতিতে পাঠদান নিয়ে আমরা এগিয়ে চলছি।</p>
      </div>
    </div>
  </div>
</section>

<!-- ===== LEVELS ===== -->
<section id="levels" style="background:var(--paper-2);">
  <div class="container">
    <div class="section-head">
      <span class="kicker">শিক্ষা স্তর</span>
      <h3>এক নজরে আমাদের কারিকুলাম</h3>
    </div>
    <div class="dept-grid">
      <div class="dept-card"><div class="num">প্লে</div><div><h4>প্রি-নুরানি</h4><p>নুরানি প্রাথমিক পাঠ। ন্যূনতম বয়স ৪ বছর।</p></div></div>
      <div class="dept-card"><div class="num">নার্সারি</div><div><h4>নুরানি</h4><p>এক বছরে নুরানি সিলেবাস পরিপূর্ণ শেষ করা। ন্যূনতম বয়স ৫ বছর।</p></div></div>
      <div class="dept-card"><div class="num">১ম শ্রেণি</div><div><h4>প্রি-নাযেরা</h4><p>আমপারা শেষ করা ও মুখস্থ করানো এবং NCTB সিলেবাস।</p></div></div>
      <div class="dept-card"><div class="num">২য় শ্রেণি</div><div><h4>নাযেরা</h4><p>সম্পূর্ণ নাযেরা শেষ করে হিফযের জন্য প্রস্তুত করা।</p></div></div>
      <div class="dept-card"><div class="num">৩য়, ৪র্থ শ্রেণি</div><div><h4>হিফজুল কুরআন</h4><p>আধুনিক পদ্ধতিতে কুরআন মুখস্থ ও জেনারেল ক্লাস।</p></div></div>
      <div class="dept-card"><div class="num">৫ম শ্রেণি</div><div><h4>হিফয রিভিশন</h4><p>বিশেষ রুটিনে নিয়মিত শুনানির মাধ্যমে হিফয ধরে রাখা।</p></div></div>
    </div>
  </div>
</section>

<!-- ===== PRINCIPAL MESSAGE ===== -->
<section id="message">
  <div class="container">
    <div class="section-head" style="margin-bottom:40px;">
      <span class="kicker">বাণী</span>
      <h3>পরিচালকের কথা</h3>
    </div>
    <div class="message-card">
      <div class="principal-photo">
        {{-- ছবি বসাতে: <img src="{{ asset('asset/image/principal.jpg') }}" alt="পরিচালক"> --}}
        م
      </div>
      <div>
        <div class="q">“</div>
        <h4>ইলম ও আমলের আলোয় আলোকিত হোক আগামী প্রজন্ম</h4>
        <p>সম্মানিত অভিভাবকবৃন্দ, আসসালামু আলাইকুম। আপনার সন্তানের দ্বীনি ও নৈতিক ভবিষ্যৎ গড়াই আমাদের সবচেয়ে বড় দায়িত্ব। অভিজ্ঞ ও যোগ্য শিক্ষকমণ্ডলীর তত্ত্বাবধানে আমরা প্রতিটি শিক্ষার্থীকে কুরআনের আলোয় আলোকিত এবং আধুনিক বিশ্বে প্রতিযোগিতার জন্য প্রস্তুত করতে বদ্ধপরিকর।</p>
        <p>আপনাদের দোয়া ও সহযোগিতা আমাদের পথচলার প্রধান শক্তি।</p>
        <div class="who">
          <strong>পরিচালকের নাম</strong>
          <span>পরিচালক, নিদাউল কুরআন মাদরাসা</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== CTA BANNER ===== -->
<section style="padding-top:0;">
  <div class="cta-banner">
    <div>
      <h3>আপনার সন্তানের দ্বীনি ও নৈতিক ভবিষ্যৎ গড়তে আজই যোগাযোগ করুন</h3>
      <p>ভর্তি সংক্রান্ত যেকোনো তথ্যের জন্য কল করুন অথবা সরাসরি ক্যাম্পাসে চলে আসুন।</p>
    </div>
    <a href="{{ route('contact') }}" class="btn btn-gold">যোগাযোগ করুন →</a>
  </div>
</section>

@endsection