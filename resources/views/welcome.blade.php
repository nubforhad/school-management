@extends('frontend.app')

@section('title', 'Welcome')

@section('content')

<!-- ===== HERO ===== -->
<section class="hero" id="top" style="padding-top:0;padding-bottom:0;">
  <div class="container">
    <div>
      <span class="eyebrow">ভর্তি চলছে • প্লে থেকে ৮ম শ্রেণি</span>
      <h2>ইলম ও আমলের সম্মিলনে <em>গড়ি আগামীর</em> যোগ্য প্রজন্ম</h2>
      <p class="lead">নিদাউল কুরআন মাদরাসা গতানুগতিক কোনো শিক্ষা প্রতিষ্ঠান নয়। বিজ্ঞানময় কুরআন ও সুন্নাহর আলোকে নতুন প্রজন্মকে প্রতিযোগিতামূলক বিশ্বে যুগোপযোগী ও যোগ্য করে গড়ে তোলাই আমাদের লক্ষ্য।</p>
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
        <div><strong>৬</strong><span>শিক্ষা স্তর</span></div>
        <div><strong>৮ম</strong><span>শ্রেণি পর্যন্ত</span></div>
        <div><strong>বালক-বালিকা</strong><span>উভয়ের জন্য</span></div>
      </div>
    </div>
  </div>
  <div style="height:90px;"></div>
</section>

<div class="star-divider dark"></div>

<!-- ===== OBJECTIVE + PILLARS ===== -->
<section id="about">
  <div class="container">
    <div class="section-head">
      <span class="kicker">লক্ষ্য-উদ্দেশ্য</span>
      <h3>আমরা কী চাই</h3>
      <p>আগামী প্রজন্মকে প্রতিযোগিতামূলক বিশ্বে বিজ্ঞানময় কুরআন ও সুন্নাহর আলোকে যুগোপযোগী ও যোগ্য করে তৈরি করার পাশাপাশি সকল পর্যায়ের মুসলিম জনসাধারণকে ব্যবহারিক জীবনে একজন খাঁটি মুসলমান হিসেবে গড়ে তোলা।</p>
    </div>
    <div class="pillars">
      <div class="pillar">
        <div class="icon">📖</div>
        <h4>কুরআন শিক্ষা</h4>
        <p>নুরানি থেকে নাযেরা ও হিফয পর্যন্ত ধাপে ধাপে শুদ্ধ তিলাওয়াত, মাশক্ব ও হুসনে সাওতের প্রশিক্ষণ।</p>
      </div>
      <div class="pillar">
        <div class="icon">🎓</div>
        <h4>হিফযের সাথে জেনারেল শিক্ষা</h4>
        <p>হিফযের সাথে সমন্বয় করে শ্রেণিভিত্তিক জেনারেল ক্লাস এবং বোর্ড নির্ধারিত সিলেবাস অনুসরণ।</p>
      </div>
      <div class="pillar">
        <div class="icon">🌐</div>
        <h4>তিন ভাষায় শিক্ষা</h4>
        <p>বিশুদ্ধ বাংলা, আরবি ও ইংরেজি ভাষার সমন্বয়ে পাঠদান এবং ল্যাঙ্গুয়েজ ক্লাস।</p>
      </div>
    </div>
  </div>
</section>

<!-- ===== FEATURES (স্বাতন্ত্র্য) ===== -->
<section id="features" style="background:var(--paper-2);">
  <div class="container">
    <div class="section-head">
      <span class="kicker">আমাদের স্বাতন্ত্র্য</span>
      <h3>কেন নিদাউল কুরআন মাদরাসা</h3>
      <p>নতুন প্রজন্মসহ সর্বপর্যায়ের মানুষের জন্য বহুমুখী পরিকল্পনা নিয়ে কাজ করছে নিদাউল কুরআন মাদরাসা।</p>
    </div>
    <div class="pillars">
      <div class="pillar"><div class="icon">১</div><h4>যোগ্য শিক্ষকমণ্ডলী</h4><p>দেশ ও বিদেশের প্রতিষ্ঠান থেকে উচ্চতর ডিগ্রিপ্রাপ্ত, প্রতিষ্ঠানের নিজস্ব পদ্ধতিতে প্রশিক্ষিত এবং বাংলা, আরবি ও ইংরেজিতে দক্ষ, নৈতিক ও চারিত্রিক মানসম্পন্ন শিক্ষক দ্বারা পাঠদান।</p></div>
      <div class="pillar"><div class="icon">২</div><h4>হিফয ও জেনারেল শিক্ষার সমন্বয়</h4><p>হিফযের সাথে জেনারেল শিক্ষার অপূর্ব সমন্বয়।</p></div>
      <div class="pillar"><div class="icon">৩</div><h4>সহপাঠ্যক্রম সিলেবাস</h4><p>বোর্ড কর্তৃক নির্ধারিত সিলেবাসের পাশাপাশি সহপাঠ্যক্রম (এক্সট্রা-কারিকুলাম) সিলেবাস প্রণয়ন ও অনুসরণ।</p></div>
      <div class="pillar"><div class="icon">৪</div><h4>বিশুদ্ধ ভাষা শিক্ষা</h4><p>বিশুদ্ধ বাংলা, আরবি এবং ইংরেজি ভাষার সমন্বয়ে শিক্ষাদান।</p></div>
      <div class="pillar"><div class="icon">৫</div><h4>হাতের লেখা প্রশিক্ষণ</h4><p>হাতের লেখা সুন্দর ও দ্রুত করানোর জন্য বিশেষ প্রশিক্ষণ।</p></div>
      <div class="pillar"><div class="icon">৬</div><h4>কালচারাল প্রোগ্রাম ও ল্যাঙ্গুয়েজ ক্লাস</h4><p>সাপ্তাহিক কালচারাল প্রোগ্রাম ও ল্যাঙ্গুয়েজ ক্লাস।</p></div>
      <div class="pillar"><div class="icon">৭</div><h4>চিত্রাঙ্কন প্রশিক্ষণ</h4><p>শিক্ষার্থীদের সৃজনশীলতা বিকাশে চিত্রাঙ্কন প্রশিক্ষণ।</p></div>
      <div class="pillar"><div class="icon">৮</div><h4>সাংস্কৃতিক ও ক্রীড়া প্রতিযোগিতা</h4><p>বার্ষিক সাংস্কৃতিক ও ক্রীড়া প্রতিযোগিতার আয়োজন।</p></div>
      <div class="pillar"><div class="icon">৯</div><h4>আয়াত ও হাদিস শিক্ষা</h4><p>প্রতিটি স্তরে বিষয়ভিত্তিক আয়াত ও হাদিস শেখানো।</p></div>
      <div class="pillar"><div class="icon">১০</div><h4>আমল-আখলাক মূল্যায়ন</h4><p>প্রত্যেক সেমিস্টার শেষে শিক্ষকদের সমন্বয়ে গঠিত বোর্ড কর্তৃক শিক্ষার্থীদের সার্বিক আমল-আখলাক, নিয়ম-কানুন ও শৃঙ্খলাবোধ মূল্যায়ন।</p></div>
      <div class="pillar"><div class="icon">১১</div><h4>ডায়েরি, পুরস্কার ও বৃত্তি</h4><p>ডায়েরিতে নিয়মিত ব্যক্তিগত প্রতিবেদন সংরক্ষণ। চূড়ান্ত ফলাফলের ভিত্তিতে বিভিন্ন ভাগে পুরস্কার এবং গরিব ও মেধাবী ছাত্রদের বিশেষ বৃত্তি প্রদান।</p></div>
      <div class="pillar"><div class="icon">১২</div><h4>অভিভাবক সমাবেশ ও প্যারেন্টিং</h4><p>মাদরাসার উন্নয়ন ও শিক্ষার্থীদের মানোন্নয়নে অভিভাবকদের অংশগ্রহণে সমাবেশ ও প্যারেন্টিং প্রোগ্রাম।</p></div>
      <div class="pillar"><div class="icon">১৩</div><h4>সিসিটিভি নজরদারি</h4><p>সিসিটিভির মাধ্যমে সার্বক্ষণিক পর্যবেক্ষণ।</p></div>
      <div class="pillar"><div class="icon">১৪</div><h4>একাডেমিক ক্যালেন্ডার</h4><p>বছরের সকল কার্যক্রম সংবলিত একাডেমিক ক্যালেন্ডার অনুসরণ করে পুরো বছরের কার্যক্রম পরিচালনা।</p></div>
    </div>
  </div>
</section>

<!-- ===== DEPARTMENTS ===== -->
<section id="departments">
  <div class="container">
    <div class="section-head">
      <span class="kicker">হিফয ক্যাম্পাস</span>
      <h3>স্তর অনুযায়ী কারিকুলাম</h3>
    </div>
    <div class="dept-grid">
      <div class="dept-card">
        <div class="num">প্লে</div>
        <div>
          <h4>প্রি-নুরানি</h4>
          <p>মেয়াদ ১ বছর। নুরানি প্রাথমিক পাঠ শিখানো, নুরানি তালিমুল কুরআন বোর্ডের সিলেবাস অনুসরণ। ন্যূনতম বয়স ৪ বছর। ছেলে-মেয়ে উভয়ের জন্য।</p>
        </div>
      </div>
      <div class="dept-card">
        <div class="num">নার্সারি</div>
        <div>
          <h4>নুরানি</h4>
          <p>এক বছরে নুরানি সিলেবাস পরিপূর্ণ শেষ করা এবং পরবর্তী স্তরের জন্য যোগ্য করে গড়ে তোলা। ন্যূনতম বয়স ৫ বছর। ছেলে-মেয়ে উভয়ের জন্য।</p>
        </div>
      </div>
      <div class="dept-card">
        <div class="num">১ম শ্রেণি</div>
        <div>
          <h4>প্রি-নাযেরা</h4>
          <p>এক বছরে বিশুদ্ধভাবে আমপারা শেষ করা ও মুখস্থ করানো, নাযেরার জন্য প্রস্তুত করা এবং NCTB প্রণীত ১ম শ্রেণির সিলেবাস শেষ করা।</p>
        </div>
      </div>
      <div class="dept-card">
        <div class="num">২য় শ্রেণি</div>
        <div>
          <h4>নাযেরা</h4>
          <p>সম্পূর্ণ নাযেরা শেষ করে হিফযের জন্য প্রস্তুত করা। অভিজ্ঞ ক্বারী দ্বারা মাশক্ব ও হুসনে সাওতের প্রশিক্ষণ, উল্লেখযোগ্য সূরা মুখস্থ এবং NCTB প্রণীত ২য় শ্রেণির সিলেবাস।</p>
        </div>
      </div>
      <div class="dept-card">
        <div class="num">৩য়, ৪র্থ শ্রেণি</div>
        <div>
          <h4>হিফজুল কুরআন</h4>
          <p>সৃজনশীল ও অত্যাধুনিক পদ্ধতিতে কুরআন মুখস্থ। আন্তর্জাতিক ক্বারী দ্বারা মাশক্ব ও বিভিন্ন লাহানের প্রশিক্ষণ, গুরুত্বপূর্ণ আয়াতের অর্থ শেখানো এবং হিফযের সাথে জেনারেল ক্লাস। হিফয শিক্ষার্থীদের আবাসিক থাকা বাধ্যতামূলক।</p>
        </div>
      </div>
      <div class="dept-card">
        <div class="num">৫ম শ্রেণি</div>
        <div>
          <h4>হিফয রিভিশন</h4>
          <p>হিফয ধরে রাখতে বিশেষ রুটিনে নিয়মিত শুনানি। যে কোনো মাদরাসার হিফয সমাপ্তকারী শিক্ষার্থী ভর্তি হতে পারবে। জেনারেল ক্লাস ও কুরআনিক ভোকাবুলারি শেখার ব্যবস্থা।</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== ADMISSION TYPES BAND ===== -->
<div class="star-divider dark"></div>
<div class="band">
  <div class="container">
    <div class="item"><strong>বালক-বালিকা</strong><span>উভয়ের জন্য ভর্তি</span></div>
    <div class="item"><strong>আবাসিক</strong><span>হিফযে বাধ্যতামূলক</span></div>
    <div class="item"><strong>অনাবাসিক</strong><span>ফুলটাইম</span></div>
    <div class="item"><strong>বিকালের কোচিং</strong><span>সুবিধা রয়েছে</span></div>
  </div>
</div>
<div class="star-divider dark"></div>

<!-- ===== TEACHING INFO + UNIFORM ===== -->
<section id="academics">
  <div class="container">
    <div class="section-head">
      <span class="kicker">পাঠদান বিষয়ক তথ্য</span>
      <h3>শিক্ষা পদ্ধতি ও নিয়মাবলি</h3>
    </div>
    <div class="dept-grid">
      <div class="dept-card">
        <div class="num">মাধ্যম</div>
        <div><h4>শিক্ষার মাধ্যম</h4><p>বাংলা, আরবি ও ইংরেজি।</p></div>
      </div>
      <div class="dept-card">
        <div class="num">সময়কাল</div>
        <div><h4>শিক্ষাবর্ষ</h4><p>জানুয়ারি হতে ডিসেম্বর।</p></div>
      </div>
      <div class="dept-card">
        <div class="num">পাঠদান</div>
        <div><h4>পাঠ পরিকল্পনা ও ক্লাস</h4><p>শিক্ষকগণ ক্লাস শুরুর আগেই পাঠ পরিকল্পনা সম্পন্ন করেন। শ্রেণিকক্ষেই পাঠদান ও পাঠ আদায় করা হয়। নিয়মিত হোম ওয়ার্ক প্রদান ও গ্রহণ।</p></div>
      </div>
      <div class="dept-card">
        <div class="num">পরীক্ষা</div>
        <div><h4>মূল্যায়ন ও সিলেবাস বণ্টন</h4><p>মডেল টেস্ট ও মিডটার্ম পরীক্ষার নম্বর ফাইনাল পরীক্ষার সাথে সংযুক্ত হবে। মিডটার্মে ৬০ ভাগ সিলেবাস, ফাইনালে অবশিষ্ট ৪০ ভাগসহ সম্পূর্ণ সিলেবাস।</p></div>
      </div>
      <div class="dept-card">
        <div class="num">ইউনিফর্ম</div>
        <div><h4>ইউনিফর্ম</h4><p>মাদরাসার ডিজাইন ও কালারের ইউনিফর্মের স্যাম্পল অফিস থেকে সংগ্রহ করে অভিভাবকগণ নিজ দায়িত্বে তৈরি করে নেবেন। প্রতিষ্ঠানের মনোগ্রাম থাকা বাধ্যতামূলক।</p></div>
      </div>
    </div>
  </div>
</section>

<!-- ===== NOTICE + ADMISSION ===== -->
<section id="notice" style="background:var(--paper-2);">
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
              <h5>নতুন শিক্ষাবর্ষের ভর্তি বিজ্ঞপ্তি প্রকাশ</h5>
              <p>প্লে থেকে ৮ম শ্রেণি, নুরানি থেকে নাযেরা-হিফয পর্যন্ত সকল স্তরে ভর্তি চলছে। আসন সংখ্যা সীমিত।</p>
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
              <h5>অভিভাবক সমাবেশ ও প্যারেন্টিং প্রোগ্রাম</h5>
              <p>শিক্ষার্থীদের মানোন্নয়নে অভিভাবকদের অংশগ্রহণে সমাবেশ ও প্যারেন্টিং প্রোগ্রামের তারিখ ঘোষণা।</p>
              <span class="tag">অনুষ্ঠান</span>
            </div>
          </div>
        </div>
      </div>

      <div class="admission-card" id="admission">
        <h4>ভর্তি তথ্য এক নজরে</h4>
        <p>নতুন শিক্ষাবর্ষে ভর্তি হতে নিচের তথ্য দেখুন। আসন সীমিত হওয়ায় দ্রুত আবেদন করার পরামর্শ দেওয়া হচ্ছে।</p>
        <ul>
          <li><span>শ্রেণি</span><span>প্লে - ৮ম শ্রেণি</span></li>
          <li><span>বিভাগ</span><span>নুরানি - নাযেরা - হিফয</span></li>
          <li><span>শিক্ষার্থী</span><span>বালক - বালিকা</span></li>
          <li><span>ধরন</span><span>আবাসিক / অনাবাসিক / ফুলটাইম</span></li>
          <li><span>ন্যূনতম বয়স</span><span>প্লে ৪ বছর, নুরানি ৫ বছর</span></li>
        </ul>
        <a href="#contact" class="btn btn-gold">আবেদন ফরম নিন</a>
      </div>
    </div>
  </div>
</section>

<!-- ===== GALLERY ===== -->
<section id="gallery">
  <div class="container">
    <div class="section-head">
      <span class="kicker">প্রাণবন্ত ক্যাম্পাস</span>
      <h3>মাদরাসার একঝলক</h3>
    </div>
    <div class="gallery-grid">
      <div class="gtile g1 gt1"><span>দরসে কুরআন</span></div>
      <div class="gtile gt2"><span>হিফয বিভাগ</span></div>
      <div class="gtile gt3"><span>অভিভাবক সমাবেশ</span></div>
      <div class="gtile gt4"><span>সাংস্কৃতিক ও ক্রীড়া প্রতিযোগিতা</span></div>
      <div class="gtile gt4"><span>ক্রীড়া প্রতিযোগিতা</span></div>
      <div class="gtile gt5"><span>চিত্রাঙ্কন ও ল্যাঙ্গুয়েজ ক্লাস</span></div>
    </div>
  </div>
</section>


{{-- =====================================================================
     NEW SECTIONS — এই ফাইলের কোড আপনার welcome.blade.php তে বসান।
     ১) "বাণী" সেকশন  → #about সেকশনের ঠিক পরে (</section> এর পর)
     ২) "শিক্ষক ও টিম" সেকশন → #departments সেকশনের পরে / ADMISSION BAND এর আগে
     ৩) নিচের <style> ব্লকটি আপনার মূল CSS ফাইলে সরিয়ে নিন
     ছবি দিতে: asset('images/team/...') পাথে ছবি রাখুন, নাম/পদবি বদলান।
     ===================================================================== --}}

     {{-- =====================================================================
     NEW SECTIONS — এই ফাইলের কোড আপনার welcome.blade.php তে বসান।
     ১) "বাণী" সেকশন  → #about সেকশনের ঠিক পরে (</section> এর পর)
     ২) "শিক্ষক ও টিম" সেকশন → #departments সেকশনের পরে / ADMISSION BAND এর আগে
     ৩) responsive.css ফাইলটি আপনার মূল CSS এর পরে লোড করুন
     ছবি দিতে: asset('images/team/...') পাথে ছবি রাখুন, নাম/পদবি বদলান।
     ===================================================================== --}}
<style>
  /* =====================================================================
   responsive.css — মূল CSS ফাইলের পরে লোড করুন (সবার শেষে)।
   layout এ <head> এর ভেতরে নিশ্চিত করুন:
   <meta name="viewport" content="width=device-width, initial-scale=1">
   Breakpoints: 1024px (ট্যাবলেট ল্যান্ডস্কেপ) · 768px (ট্যাবলেট) · 480px (মোবাইল)
   ===================================================================== */

/* ---------- সাধারণ নিরাপত্তা ---------- */
 
/* ---------- নতুন সেকশন: বাণী ---------- */
.message-stack { display: grid; gap: 28px;  margin: 0 auto; }
.message-card {
  display: grid; grid-template-columns: 220px 1fr; gap: 32px; align-items: start;
  background: var(--paper-2, #f6f1e4); border-radius: 20px; padding: 28px;
  border: 1px solid rgba(0,0,0,.08);
}
.message-card.reverse { grid-template-columns: 1fr 220px; }
.message-card.reverse .message-photo { order: 2; }
.message-photo { margin: 0; text-align: center; }
.message-photo img,
.message-photo .avatar-fallback {
  width: 180px; height: 220px; object-fit: cover; margin: 0 auto 14px;
  border-radius: 90px 90px 14px 14px; display: flex;
}
.message-photo figcaption strong { display: block; font-size: 1.05rem; }
.message-photo figcaption span { display: block; font-size: .88rem; opacity: .7; margin-top: 2px; }
.message-body h4 { margin: 0 0 12px; font-size: clamp(1.15rem, 3vw, 1.35rem); }
.message-body p { line-height: 1.9; margin: 0 0 12px; }
.message-body .signoff { font-weight: 600; margin-top: 16px; opacity: .85; }

/* ---------- নতুন সেকশন: টিম ---------- */
.team-group {
  margin: 36px 0 18px; font-size: clamp(1.05rem, 2.8vw, 1.2rem);
  padding-bottom: 8px; border-bottom: 2px solid var(--gold, #c9a24b); display: inline-block;
}
.team-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(210px, 1fr)); gap: 22px; }
.team-card { text-align: center; background: #fff; border-radius: 16px; padding: 22px 16px; border: 1px solid rgba(0,0,0,.08); }
.team-photo { width: 120px; height: 120px; margin: 0 auto 14px; }
.team-photo img,
.team-photo .avatar-fallback { width: 100%; height: 100%; border-radius: 50%; object-fit: cover; }
.team-card h5 { margin: 0 0 4px; font-size: 1.02rem; }
.team-card span { font-size: .88rem; opacity: .7; }
.avatar-fallback {
  display: flex; align-items: center; justify-content: center;
  background: var(--green, #0f4c3a); color: var(--gold, #e6c36a);
  font-size: 2rem; font-weight: 700;
}

/* =====================================================================
   ট্যাবলেট ল্যান্ডস্কেপ ও ছোট ল্যাপটপ  ≤ 1024px
   ===================================================================== */
@media (max-width: 1024px) {
  section { padding-top: 64px; padding-bottom: 64px; }
  .hero .container { display: grid; grid-template-columns: 1fr; gap: 40px; text-align: center; }
  .hero .actions { justify-content: center; }
  .hero .arch-frame { max-width: 420px; margin-inline: auto; }
  .pillars, .dept-grid { grid-template-columns: repeat(2, 1fr) !important; }
  .notice-wrap { grid-template-columns: 1fr !important; }
  .gallery-grid { grid-template-columns: repeat(3, 1fr) !important; grid-auto-rows: 180px; }
}

/* =====================================================================
   ট্যাবলেট  ≤ 768px
   ===================================================================== */
@media (max-width: 768px) {
  section { padding-top: 52px; padding-bottom: 52px; }
  .section-head { margin-bottom: 28px; }
  .section-head h3 { font-size: clamp(1.4rem, 5vw, 1.8rem); }

  /* হিরো */
  .hero h2 { font-size: clamp(1.7rem, 7vw, 2.4rem); line-height: 1.35; }
  .hero .lead { font-size: 1rem; line-height: 1.85; }
  .stat-chip { display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px; }
  .stat-chip > div { min-width: 0; }

  /* বাণী */
  .message-card, .message-card.reverse { grid-template-columns: 1fr; gap: 20px; padding: 22px; }
  .message-card.reverse .message-photo { order: 0; }
  .message-photo img, .message-photo .avatar-fallback { width: 150px; height: 185px; border-radius: 75px 75px 12px 12px; }
  .message-body { text-align: left; }

  /* টিম */
  .team-grid { grid-template-columns: repeat(2, 1fr); gap: 14px; }
  .team-card { padding: 18px 10px; }
  .team-photo { width: 96px; height: 96px; }
  .team-card h5 { font-size: .96rem; }

  /* ডিপার্টমেন্ট কার্ড */
  .dept-card { flex-direction: column; gap: 10px; }
  .dept-card .num { align-self: flex-start; }

  /* ব্যান্ড */
  .band .container { display: grid; grid-template-columns: repeat(2, 1fr); gap: 18px; text-align: center; }

  /* গ্যালারি */
  .gallery-grid { grid-template-columns: repeat(2, 1fr) !important; grid-auto-rows: 160px; gap: 12px; }
  .gallery-grid .gtile { grid-column: auto !important; grid-row: auto !important; }

  /* CTA */
  .cta-banner { flex-direction: column; text-align: center; gap: 18px; padding: 28px 20px; }
  .cta-banner .btn { width: 100%; text-align: center; }
}

/* =====================================================================
   মোবাইল  ≤ 480px
   ===================================================================== */
@media (max-width: 480px) {
  section { padding-top: 40px; padding-bottom: 40px; }

  .pillars, .dept-grid { grid-template-columns: 1fr !important; gap: 14px; }

  /* হিরো বাটন: পূর্ণ প্রস্থ */
  .hero .actions { flex-direction: column; align-items: stretch; gap: 10px; }
  .hero .actions .btn { width: 100%; text-align: center; justify-content: center; }
  .hero .arch-frame { max-width: 300px; }
  .stat-chip strong { font-size: 1rem; }
  .stat-chip span { font-size: .72rem; }

  /* নোটিশ */
  .notice-item { gap: 12px; padding: 14px; }
  .notice-date { min-width: 54px; }
  .admission-card { padding: 22px 18px; }
  .admission-card ul li { flex-direction: column; align-items: flex-start; gap: 2px; }
  .admission-card .btn { width: 100%; text-align: center; }

  /* গ্যালারি */
  .gallery-grid { grid-auto-rows: 130px; gap: 10px; }

  /* বাণী */
  .message-card, .message-card.reverse { padding: 18px; border-radius: 16px; }
  .message-body p { line-height: 1.8; font-size: .97rem; }

  /* টিম — মোবাইলেও ২ কলাম, কিন্তু আরও কম্প্যাক্ট */
  .team-grid { gap: 10px; }
  .team-photo { width: 80px; height: 80px; }
  .avatar-fallback { font-size: 1.4rem; }
  .team-card span { font-size: .8rem; }
}

/* ছোট মোবাইল (৩৬০px এর নিচে) */
@media (max-width: 360px) {
  .team-grid { grid-template-columns: 1fr; }
  .band .container { grid-template-columns: 1fr; }
}

/* মোশন কমানোর পছন্দ মান্য করা */
@media (prefers-reduced-motion: reduce) {
  * { animation: none !important; transition: none !important; scroll-behavior: auto !important; }
}
</style>

{{-- ================= ১) চেয়ারম্যান ও অন্যান্য বাণী ================= --}}
<section id="messages">
  <div class="container">
    <div class="section-head">
      <span class="kicker">বাণী</span>
      <h3>কর্তৃপক্ষের বক্তব্য</h3>
    </div>

    <div class="message-stack">

      {{-- চেয়ারম্যান --}}
      <article class="message-card">
        <figure class="message-photo">
          {{-- ছবি থাকলে নিচের লাইনটি চালু করুন --}}
          {{-- <img src="{{ asset('images/team/chairman.jpg') }}" alt="চেয়ারম্যান"> --}}
          <div class="avatar-fallback">
            <img src="{{ asset('asset/image/chair.jpeg') }}" alt="চেয়ারম্যান" style="width:100%; height:100%; object-fit:cover; border-radius:90px 90px 14px 14px;">
          </div>
          <figcaption>
            <strong>মাহমুদুল হাসান</strong>
            <span>চেয়ারম্যান, নিদাউল কুরআন মাদরাসা</span>
          </figcaption>
        </figure>
        <div class="message-body">
          <h4>চেয়ারম্যানের বাণী</h4>
          <p>আলহামদুলিল্লাহ। নিদাউল কুরআন মাদরাসা কেবল একটি শিক্ষাপ্রতিষ্ঠান নয়; এটি একটি আমানত। আমরা চাই প্রতিটি শিশু কুরআনের আলোয় বেড়ে উঠুক এবং একই সাথে আধুনিক বিশ্বে নিজের যোগ্যতা প্রমাণ করুক।</p>
          <p>ইলমের পাশাপাশি আমল ও আখলাকের চর্চা আমাদের শিক্ষাব্যবস্থার কেন্দ্রে। অভিভাবকদের আস্থা ও দোয়াই আমাদের সবচেয়ে বড় শক্তি। আল্লাহ আমাদের এই প্রচেষ্টা কবুল করুন।</p>
          <p class="signoff">— মাহমুদুল হাসান</p>
        </div>
      </article>

      {{-- অধ্যক্ষ / প্রিন্সিপাল --}}
      {{-- <article class="message-card reverse">
        <figure class="message-photo"> 
          <div class="avatar-fallback">অ</div>
          <figcaption>
            <strong>অধ্যক্ষের নাম</strong>
            <span>অধ্যক্ষ, নিদাউল কুরআন মাদরাসা</span>
          </figcaption>
        </figure>
        <div class="message-body">
          <h4>অধ্যক্ষের বাণী</h4>
          <p>প্লে থেকে ৮ম শ্রেণি পর্যন্ত প্রতিটি স্তরে আমরা শিক্ষার্থীর বয়স ও সামর্থ্য অনুযায়ী পাঠদান নিশ্চিত করি। শুদ্ধ তিলাওয়াত, হিফয, বাংলা-আরবি-ইংরেজি ভাষা এবং নৈতিক শিক্ষা একসাথে এগিয়ে চলে।</p>
          <p>অভিভাবকদের সাথে নিয়মিত যোগাযোগ রেখে প্রতিটি শিক্ষার্থীর অগ্রগতি আমরা পর্যবেক্ষণ করি।</p>
          <p class="signoff">— অধ্যক্ষের নাম</p>
        </div>
      </article> --}}

      {{-- সেক্রেটারি / সভাপতি — প্রয়োজন না হলে এই ব্লকটি মুছে দিন --}}
      <article class="message-card reverse">
        <figure class="message-photo">
          {{-- <img src="{{ asset('images/team/secretary.jpg') }}" alt="সেক্রেটারি"> --}}
          <div class="avatar-fallback">
            <img src="{{ asset('asset/image/md.jpg') }}" alt="সেক্রেটারি" style="width:100%; height:100%; object-fit:cover; border-radius:90px 90px 14px 14px;">
          </div>
          <figcaption>
            <strong>আবু সালমান মুহাম্মদ আম্মার</strong>
            <span>সেক্রেটারি, পরিচালনা কমিটি</span>
          </figcaption>
        </figure>
        <div class="message-body">
          <h4>সেক্রেটারির বক্তব্য</h4>
          <p>মাদরাসার উন্নয়ন ও শিক্ষার্থীদের মানোন্নয়নে পরিচালনা কমিটি নিরলস কাজ করছে। শিক্ষক, অভিভাবক ও শুভানুধ্যায়ীদের সম্মিলিত সহযোগিতায় আমরা আরও এগিয়ে যেতে চাই।</p>
          <p class="signoff">— আবু সালমান মুহাম্মদ আম্মার</p>
        </div>
      </article>

    </div>
  </div>
</section>


{{-- ================= ২) শিক্ষক ও টিম ================= --}}
<section id="team" style="background:var(--paper-2);">
  <div class="container">
    <div class="section-head">
      <span class="kicker">আমাদের টিম</span>
      <h3>শিক্ষকমণ্ডলী ও পরিচালনা পর্ষদ</h3>
      <p>দেশ ও বিদেশের প্রতিষ্ঠান থেকে উচ্চতর ডিগ্রিপ্রাপ্ত, নৈতিক ও চারিত্রিক মানসম্পন্ন শিক্ষকগণ আপনার সন্তানের পাশে আছেন।</p>
    </div>

    {{-- পরিচালনা পর্ষদ --}}
    <h4 class="team-group">পরিচালনা পর্ষদ</h4>
    <div class="team-grid">
      <div class="team-card">
        <div class="team-photo"><div class="avatar-fallback">
          <img src="{{ asset('asset/image/chair.jpeg') }}" alt="চেয়ারম্যান" style="width:100%; height:100%; object-fit:cover; border-radius:90px 90px 14px 14px;">
        </div></div>
        <h5>মাহমুদুল হাসান</h5>
        <span>চেয়ারম্যান</span>
      </div>
      
      <div class="team-card">
        <div class="team-photo"><div class="avatar-fallback">
          <img src="{{ asset('asset/image/md.jpg') }}" alt="সেক্রেটারি" style="width:100%; height:100%; object-fit:cover; border-radius:90px 90px 14px 14px;">
        </div></div>
        <h5>আবু সালমান মুহাম্মদ আম্মার</h5>
        <span>সেক্রেটারি</span>
      </div>
      <div class="team-card">
        <div class="team-photo"><div class="avatar-fallback">অ</div></div>
        <h5>অধ্যক্ষের নাম</h5>
        <span>অধ্যক্ষ</span>
      </div>
      <div class="team-card">
        <div class="team-photo"><div class="avatar-fallback">সদ</div></div>
        <h5>সদস্যের নাম</h5>
        <span>সদস্য</span>
      </div>
    </div>

    {{-- শিক্ষকবৃন্দ --}}
    <h4 class="team-group">শিক্ষকবৃন্দ</h4>
    <div class="team-grid">
      <div class="team-card">
        <div class="team-photo"><div class="avatar-fallback">ক্বা</div></div>
        <h5>শিক্ষকের নাম</h5>
        <span>প্রধান ক্বারী, হিফয বিভাগ</span>
      </div>
      <div class="team-card">
        <div class="team-photo"><div class="avatar-fallback">হি</div></div>
        <h5>শিক্ষকের নাম</h5>
        <span>হিফয শিক্ষক</span>
      </div>
      <div class="team-card">
        <div class="team-photo"><div class="avatar-fallback">না</div></div>
        <h5>শিক্ষকের নাম</h5>
        <span>নুরানি ও নাযেরা বিভাগ</span>
      </div>
      <div class="team-card">
        <div class="team-photo"><div class="avatar-fallback">আ</div></div>
        <h5>শিক্ষকের নাম</h5>
        <span>আরবি ভাষা শিক্ষক</span>
      </div>
      <div class="team-card">
        <div class="team-photo"><div class="avatar-fallback">ই</div></div>
        <h5>শিক্ষকের নাম</h5>
        <span>ইংরেজি শিক্ষক</span>
      </div>
      <div class="team-card">
        <div class="team-photo"><div class="avatar-fallback">বা</div></div>
        <h5>শিক্ষকের নাম</h5>
        <span>বাংলা ও জেনারেল বিভাগ</span>
      </div>
      <div class="team-card">
        <div class="team-photo"><div class="avatar-fallback">শি</div></div>
        <h5>শিক্ষিকার নাম</h5>
        <span>বালিকা শাখা</span>
      </div>
      <div class="team-card">
        <div class="team-photo"><div class="avatar-fallback">চি</div></div>
        <h5>শিক্ষকের নাম</h5>
        <span>চিত্রাঙ্কন ও হাতের লেখা</span>
      </div>
    </div>

    {{-- ডাইনামিক করতে চাইলে (Controller থেকে $teachers পাঠান):
    <div class="team-grid">
      @foreach($teachers as $t)
        <div class="team-card">
          <div class="team-photo">
            @if($t->photo)
              <img src="{{ asset('storage/'.$t->photo) }}" alt="{{ $t->name }}">
            @else
              <div class="avatar-fallback">{{ mb_substr($t->name, 0, 1) }}</div>
            @endif
          </div>
          <h5>{{ $t->name }}</h5>
          <span>{{ $t->designation }}</span>
        </div>
      @endforeach
    </div>
    --}}
  </div>
</section>


{{-- CSS এখন responsive.css ফাইলে আছে — মূল CSS এর পরে লোড করুন --}}
 

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