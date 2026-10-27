@extends('frontend.app')

@section('title', 'Welcome')

@section('content')




<!-- ===== HERO ===== -->
<section class="hero" id="top" style="padding-top:0;padding-bottom:0;">
  <div class="container">
    <div>
      <span class="eyebrow">১৪৪৭ হিজরি শিক্ষাবর্ষে ভর্তি চলছে</span>
      <h2>ইলম ও আমলের সম্মিলনে <em>গড়ি আগামীর</em> নির্ভরযোগ্য প্রজন্ম</h2>
      <p class="lead">কুরআন-হাদিসের আলোকে চরিত্র গঠন এবং যুগোপযোগী শিক্ষার সমন্বয়ে নিদারুল মাদরাসা প্রতিটি শিক্ষার্থীকে গড়ে তোলে একজন দক্ষ আলেম ও দায়িত্বশীল নাগরিক হিসেবে।</p>
      <div class="actions">
        <a href="{{ route('admission') }}" class="btn btn-gold">ভর্তি আবেদন করুন →</a>
        <a href="#about" class="btn btn-outline">প্রতিষ্ঠান সম্পর্কে জানুন</a>
      </div>
    </div>

    <div class="arch-frame">
      <div class="arch">
        <div class="glow"></div>
        <div class="glyph">اقرأ<small>পড়ো, তোমার প্রভুর নামে</small></div>
      </div>
      <div class="stat-chip">
        <div><strong>৫২০+</strong><span>শিক্ষার্থী</span></div>
        <div><strong>৩৮</strong><span>শিক্ষক</span></div>
        <div><strong>১২</strong><span>বছরের সেবা</span></div>
      </div>
    </div>
  </div>
  <div style="height:90px;"></div>
</section>

<div class="star-divider dark"></div>

<!-- ===== PILLARS ===== -->
<section id="about">
  <div class="container">
    <div class="section-head">
      <span class="kicker">আমাদের ভিত্তি</span>
      <h3>তিনটি স্তম্ভের উপর গড়া শিক্ষাদর্শন</h3>
      <p>আমরা বিশ্বাস করি প্রকৃত শিক্ষা কেবল মুখস্থবিদ্যা নয়— এটি জ্ঞান, আমল ও চরিত্রের সমন্বিত রূপ।</p>
    </div>
    <div class="pillars">
      <div class="pillar">
        <div class="icon">📖</div>
        <h4>কুরআন শিক্ষা</h4>
        <p>শুদ্ধ তিলাওয়াত, তাজবীদ ও হিফজের মাধ্যমে প্রতিটি শিক্ষার্থীকে কুরআনের সাথে সম্পর্কযুক্ত করে তোলা আমাদের প্রথম অগ্রাধিকার।</p>
      </div>
      <div class="pillar">
        <div class="icon">🕌</div>
        <h4>হাদিস ও ফিকহ</h4>
        <p>নির্ভরযোগ্য উস্তাদদের তত্ত্বাবধানে হাদিসশাস্ত্র ও ফিকহের মৌলিক ও উচ্চতর কিতাবাদি অধ্যয়ন করানো হয়।</p>
      </div>
      <div class="pillar">
        <div class="icon">🎓</div>
        <h4>আধুনিক শিক্ষা</h4>
        <p>বাংলা, ইংরেজি, গণিত ও বিজ্ঞান বিষয়ে সাধারণ শিক্ষা কারিকুলাম, যাতে শিক্ষার্থীরা যুগের সাথে তাল মিলিয়ে চলতে পারে।</p>
      </div>
    </div>
  </div>
</section>

<!-- ===== DEPARTMENTS ===== -->
<section id="departments" style="background:var(--paper-2);">
  <div class="container">
    <div class="section-head">
      <span class="kicker">শিক্ষা কার্যক্রম</span>
      <h3>বয়স ও স্তরভেদে সাজানো বিভাগসমূহ</h3>
    </div>
    <div class="dept-grid">
      <div class="dept-card">
        <div class="num">বিভাগ ০১</div>
        <div>
          <h4>নূরানী ও মক্তব</h4>
          <p>প্রাথমিক বয়সে শুদ্ধ উচ্চারণ ও বুনিয়াদি দ্বীনি শিক্ষার হাতেখড়ি।</p>
        </div>
      </div>
      <div class="dept-card">
        <div class="num">বিভাগ ০২</div>
        <div>
          <h4>হিফজুল কুরআন</h4>
          <p>সম্পূর্ণ কুরআন মুখস্থকরণ, তাজবীদসহ শুদ্ধ তিলাওয়াতের প্রশিক্ষণ।</p>
        </div>
      </div>
      <div class="dept-card">
        <div class="num">বিভাগ ০৩</div>
        <div>
          <h4>কিতাব বিভাগ</h4>
          <p>নাহু, সরফ, ফিকহ, হাদিস ও তাফসীরসহ দাওরায়ে হাদিস পর্যন্ত পাঠ্যক্রম।</p>
        </div>
      </div>
      <div class="dept-card">
        <div class="num">বিভাগ ০৪</div>
        <div>
          <h4>সাধারণ শিক্ষা</h4>
          <p>জাতীয় সিলেবাস অনুসরণে বাংলা, ইংরেজি, গণিত ও বিজ্ঞান শিক্ষা।</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== STATS BAND ===== -->
<div class="star-divider dark"></div>
<div class="band">
  <div class="container">
    <div class="item"><strong>৯৮%</strong><span>দাওরায়ে হাদিস উত্তীর্ণের হার</span></div>
    <div class="item"><strong>১২০+</strong><span>হাফেজে কুরআন তৈরি</span></div>
    <div class="item"><strong>২২</strong><span>বছরের অভিজ্ঞতা</span></div>
    <div class="item"><strong>৩৮</strong><span>যোগ্য শিক্ষক-উস্তাদ</span></div>
  </div>
</div>
<div class="star-divider dark"></div>

<!-- ===== NOTICE + ADMISSION ===== -->
<section id="notice">
  <div class="container">
    <div class="section-head" style="margin-bottom:40px;">
      <span class="kicker">হালনাগাদ তথ্য</span>
      <h3>নোটিশ বোর্ড ও ভর্তি সহায়িকা</h3>
    </div>

    <div class="notice-wrap">
      <div>
        <div class="notice-list">
          <div class="notice-item">
            <div class="notice-date"><strong>০৫</strong><span>শাওয়াল</span></div>
            <div>
              <h5>১৪৪৭ হিজরি শিক্ষাবর্ষের ভর্তি বিজ্ঞপ্তি প্রকাশ</h5>
              <p>নূরানী থেকে কিতাব বিভাগ পর্যন্ত সকল স্তরে সীমিত আসনে ভর্তি চলছে। আসন সংখ্যা সীমিত।</p>
              <span class="tag">ভর্তি</span>
            </div>
          </div>
          <div class="notice-item">
            <div class="notice-date"><strong>২৮</strong><span>রমজান</span></div>
            <div>
              <h5>বার্ষিক পরীক্ষার সময়সূচি প্রকাশিত হয়েছে</h5>
              <p>সকল বিভাগের শিক্ষার্থীদের জন্য চূড়ান্ত পরীক্ষার রুটিন নোটিশ বোর্ডে টাঙানো হয়েছে।</p>
              <span class="tag">পরীক্ষা</span>
            </div>
          </div>
          <div class="notice-item">
            <div class="notice-date"><strong>১৪</strong><span>শাবান</span></div>
            <div>
              <h5>অভিভাবক সমাবেশ ও দস্তারবন্দী অনুষ্ঠান</h5>
              <p>দাওরায়ে হাদিস সমাপনকারী শিক্ষার্থীদের সম্মানে দস্তারবন্দী মাহফিলের তারিখ ঘোষণা।</p>
              <span class="tag">অনুষ্ঠান</span>
            </div>
          </div>
        </div>
      </div>

      <div class="admission-card" id="admission">
        <h4>ভর্তি তথ্য এক নজরে</h4>
        <p>নতুন শিক্ষাবর্ষে ভর্তি হতে নিচের ধাপগুলো অনুসরণ করুন। আসন সীমিত হওয়ায় দ্রুত আবেদন করার পরামর্শ দেওয়া হচ্ছে।</p>
        <ul>
          <li><span>আবেদন শুরু</span><span>০১ শাওয়াল</span></li>
          <li><span>ভর্তি পরীক্ষা</span><span>১৫ শাওয়াল</span></li>
          <li><span>ফলাফল প্রকাশ</span><span>২০ শাওয়াল</span></li>
          <li><span>ক্লাস শুরু</span><span>০১ জিলকদ</span></li>
        </ul>
        <a href="#contact" class="btn btn-gold">আবেদন ফরম নিন</a>
      </div>
    </div>
  </div>
</section>

<!-- ===== GALLERY ===== -->
<section id="gallery" style="background:var(--paper-2);">
  <div class="container">
    <div class="section-head">
      <span class="kicker">প্রাণবন্ত ক্যাম্পাস</span>
      <h3>মাদরাসার একঝলক</h3>
    </div>
    <div class="gallery-grid">
      <div class="gtile g1 gt1"><span>দরসে কুরআন</span></div>
      <div class="gtile gt2"><span>হিফজ বিভাগ</span></div>
      <div class="gtile gt3"><span>বার্ষিক মাহফিল</span></div>
      <div class="gtile gt4"><span>খেলাধুলা</span></div>
      <div class="gtile gt5"><span>লাইব্রেরি</span></div>
    </div>
  </div>
</section>

<!-- ===== TESTIMONIALS ===== -->
<section>
  <div class="container">
    <div class="section-head">
      <span class="kicker">অভিভাবকদের কথা</span>
      <h3>তারা যা বলেন</h3>
    </div>
    <div class="quote-grid">
      <div class="quote-card">
        <div class="stars">★★★★★</div>
        <p>"আমার ছেলে এখানে ভর্তি হওয়ার পর থেকে দ্বীনি জ্ঞানের পাশাপাশি নৈতিকতায়ও অনেক পরিবর্তন এসেছে। শিক্ষকদের আন্তরিকতা প্রশংসনীয়।"</p>
        <div class="quote-who">
          <div class="av"></div>
          <div><strong>মোঃ আব্দুল করিম</strong><span>অভিভাবক, হিফজ বিভাগ</span></div>
        </div>
      </div>
      <div class="quote-card">
        <div class="stars">★★★★★</div>
        <p>"সাধারণ শিক্ষা ও দ্বীনি শিক্ষার চমৎকার সমন্বয় এখানে দেখেছি। আবাসন ব্যবস্থাও পরিচ্ছন্ন ও নিরাপদ।"</p>
        <div class="quote-who">
          <div class="av"></div>
          <div><strong>রোকেয়া বেগম</strong><span>অভিভাবক, কিতাব বিভাগ</span></div>
        </div>
      </div>
      <div class="quote-card">
        <div class="stars">★★★★★</div>
        <p>"এই মাদরাসা থেকে দাওরা সম্পন্ন করে আজ আমি একটি মসজিদে ইমামতি করছি। উস্তাদদের দোয়া ও শিক্ষা আজীবন কাজে লাগবে।"</p>
        <div class="quote-who">
          <div class="av"></div>
          <div><strong>হাফেজ ইউসুফ আলী</strong><span>প্রাক্তন শিক্ষার্থী</span></div>
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
    <a href="#contact" class="btn btn-gold">যোগাযোগ করুন →</a>
  </div>
</section>




@endsection