@extends('frontend.app')

@section('title', 'লক্ষ্য ও উদ্দেশ্য')

@section('content')

<style>
  /* ===== Objectives page extras (existing variables/classes ব্যবহার করা হয়েছে) ===== */
  .page-hero{position:relative;overflow:hidden;text-align:center;padding:72px 0 64px;background:
    radial-gradient(700px 400px at 90% 0,rgba(127,21,49,.10),transparent 60%),
    radial-gradient(600px 360px at 0 100%,rgba(15,76,74,.12),transparent 60%),
    var(--paper)}
  .page-hero h2{font-size:clamp(2rem,4vw,3rem);color:var(--teal-deep);margin-bottom:14px}
  .page-hero h2 em{font-style:normal;color:var(--brand);background:linear-gradient(transparent 68%,var(--amber-soft) 68%)}
  .page-hero p{max-width:62ch;margin:0 auto;color:var(--muted);font-size:1.08rem}
  .crumbs{display:inline-flex;gap:8px;font-size:.88rem;color:var(--muted);margin-bottom:18px}
  .crumbs a{color:var(--brand);font-weight:600}

  /* Main objective statement */
  .statement{position:relative;overflow:hidden;border-radius:30px;padding:56px 50px;text-align:center;color:#fff;background:
    radial-gradient(480px 240px at 100% 0,rgba(226,169,59,.28),transparent 65%),
    linear-gradient(135deg,var(--brand),var(--brand-dark));box-shadow:var(--shadow-lg)}
  .statement .ar{font-family:var(--f-ar);font-size:3rem;color:var(--amber-soft);line-height:1.3;margin-bottom:8px}
  .statement .tag-top{display:inline-block;background:rgba(255,255,255,.14);color:var(--amber-soft);font-size:.85rem;font-weight:600;padding:4px 16px;border-radius:999px;margin-bottom:18px}
  .statement p{max-width:780px;margin:0 auto;font-family:var(--f-head);font-size:clamp(1.2rem,2.3vw,1.6rem);line-height:1.8;color:#fff}

  /* Goal cards */
  .goal-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:22px}
  .goal-card{display:flex;gap:20px;align-items:flex-start;background:#fff;border:1px solid var(--line);border-radius:var(--radius);padding:30px 28px;transition:.28s}
  .goal-card:hover{border-color:var(--brand);box-shadow:var(--shadow-lg);transform:translateY(-4px)}
  .goal-no{flex-shrink:0;width:56px;height:56px;border-radius:16px;background:var(--brand-tint);color:var(--brand);display:grid;place-items:center;font-family:var(--f-head);font-size:1.6rem;transition:.28s}
  .goal-card:hover .goal-no{background:var(--brand);color:#fff}
  .goal-card h4{font-size:1.2rem;color:var(--teal-deep);margin-bottom:6px}
  .goal-card p{color:var(--muted);font-size:.95rem}

  /* Approach steps */
  .steps{display:grid;grid-template-columns:repeat(4,1fr);gap:22px;counter-reset:s}
  .step{background:#fff;border:1px solid var(--line);border-radius:var(--radius);padding:30px 22px 26px;text-align:center;position:relative;box-shadow:var(--shadow);transition:.25s}
  .step:hover{border-color:var(--teal);transform:translateY(-5px)}
  .step .badge{width:46px;height:46px;margin:-54px auto 16px;border-radius:50%;background:var(--amber);color:var(--teal-deep);display:grid;place-items:center;font-family:var(--f-head);font-size:1.3rem;box-shadow:0 0 0 5px var(--paper-2),0 8px 18px rgba(226,169,59,.35)}
  .step h4{font-size:1.1rem;color:var(--brand);margin-bottom:8px}
  .step p{color:var(--muted);font-size:.92rem}
  .steps-wrap{padding-top:30px}

  @media (max-width:980px){
    .goal-grid{grid-template-columns:1fr}
    .steps{grid-template-columns:1fr 1fr;row-gap:50px}
    .statement{padding:40px 26px}
  }
  @media (max-width:640px){
    .page-hero{padding:56px 0}
    .goal-card{flex-direction:column;gap:12px}
    .steps{grid-template-columns:1fr}
    .statement .ar{font-size:2.4rem}
  }
</style>

<!-- ===== PAGE HERO ===== -->
<section class="page-hero">
  <div class="container">
    <div class="crumbs"><a href="{{ url('/') }}">হোম</a><span>›</span><span>লক্ষ্য ও উদ্দেশ্য</span></div>
    <span class="eyebrow" style="display:block;width:max-content;margin:0 auto 22px;">আমরা কী চাই</span>
    <h2>আমাদের <em>লক্ষ্য ও উদ্দেশ্য</em></h2>
    <p>ইলম ও আমলের সম্মিলনে আগামীর যোগ্য প্রজন্ম গড়ে তোলাই নিদাউল কুরআন মাদরাসার মূল প্রত্যয়।</p>
  </div>
</section>

<div class="star-divider dark"></div>

<!-- ===== MAIN STATEMENT ===== -->
<section id="statement">
  <div class="container">
    <div class="statement">
      <div class="ar">اقرأ</div>
      <span class="tag-top">মূল উদ্দেশ্য</span>
      <p>আগামী প্রজন্মকে প্রতিযোগিতামূলক বিশ্বে বিজ্ঞানময় কুরআন ও সুন্নাহর আলোকে যুগোপযোগী ও যোগ্য করে তৈরি করার পাশাপাশি সকল পর্যায়ের মুসলিম জনসাধারণকে ব্যবহারিক জীবনে একজন খাঁটি মুসলমান হিসেবে গড়ে তোলা।</p>
    </div>
  </div>
</section>

<!-- ===== GOALS ===== -->
<section id="goals" style="background:var(--paper-2);">
  <div class="container">
    <div class="section-head">
      <span class="kicker">আমাদের লক্ষ্যসমূহ</span>
      <h3>যে লক্ষ্যে আমরা কাজ করছি</h3>
      <p>নতুন প্রজন্মসহ সর্বপর্যায়ের মানুষের জন্য বহুমুখী পরিকল্পনা নিয়ে এগিয়ে চলছে নিদাউল কুরআন মাদরাসা।</p>
    </div>
    <div class="goal-grid">
      <div class="goal-card">
        <div class="goal-no">১</div>
        <div>
          <h4>শুদ্ধ কুরআন শিক্ষা</h4>
          <p>নুরানি থেকে নাযেরা ও হিফয পর্যন্ত ধাপে ধাপে শুদ্ধ তিলাওয়াত, মাশক্ব ও হুসনে সাওতের প্রশিক্ষণ নিশ্চিত করা।</p>
        </div>
      </div>
      <div class="goal-card">
        <div class="goal-no">২</div>
        <div>
          <h4>হিফয ও জেনারেল শিক্ষার সমন্বয়</h4>
          <p>হিফযের পাশাপাশি বোর্ড নির্ধারিত সিলেবাস অনুসরণ করে শিক্ষার্থীকে আধুনিক শিক্ষায় যোগ্য করে তোলা।</p>
        </div>
      </div>
      <div class="goal-card">
        <div class="goal-no">৩</div>
        <div>
          <h4>আমল-আখলাক ও চরিত্র গঠন</h4>
          <p>আয়াত ও হাদিস শিক্ষা এবং সেমিস্টারভিত্তিক আমল-আখলাক মূল্যায়নের মাধ্যমে উত্তম চরিত্র গঠন।</p>
        </div>
      </div>
      <div class="goal-card">
        <div class="goal-no">৪</div>
        <div>
          <h4>তিন ভাষায় দক্ষতা অর্জন</h4>
          <p>বিশুদ্ধ বাংলা, আরবি ও ইংরেজি ভাষায় পাঠদান ও ল্যাঙ্গুয়েজ ক্লাসের মাধ্যমে ভাষাগত দক্ষতা বৃদ্ধি।</p>
        </div>
      </div>
      <div class="goal-card">
        <div class="goal-no">৫</div>
        <div>
          <h4>সৃজনশীলতা ও প্রতিভার বিকাশ</h4>
          <p>চিত্রাঙ্কন, হাতের লেখা, কালচারাল প্রোগ্রাম এবং সাংস্কৃতিক ও ক্রীড়া প্রতিযোগিতার মাধ্যমে প্রতিভা বিকাশ।</p>
        </div>
      </div>
      <div class="goal-card">
        <div class="goal-no">৬</div>
        <div>
          <h4>অভিভাবকদের সাথে সম্পৃক্ততা</h4>
          <p>অভিভাবক সমাবেশ, প্যারেন্টিং প্রোগ্রাম ও ডায়েরির মাধ্যমে শিক্ষার্থীদের মানোন্নয়নে অভিভাবকদের অংশীদার করা।</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== PILLARS ===== -->
<section id="pillars">
  <div class="container">
    <div class="section-head">
      <span class="kicker">আমাদের ভিত্তি</span>
      <h3>তিনটি মূল স্তম্ভ</h3>
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

<!-- ===== HOW WE ACHIEVE ===== -->
<section id="approach" style="background:var(--paper-2);">
  <div class="container">
    <div class="section-head" style="margin-bottom:64px;">
      <span class="kicker">বাস্তবায়ন পদ্ধতি</span>
      <h3>লক্ষ্য অর্জনে আমাদের পথ</h3>
    </div>
    <div class="steps steps-wrap">
      <div class="step">
        <div class="badge">১</div>
        <h4>যোগ্য শিক্ষক</h4>
        <p>উচ্চতর ডিগ্রিপ্রাপ্ত ও প্রতিষ্ঠানের নিজস্ব পদ্ধতিতে প্রশিক্ষিত শিক্ষক দ্বারা পাঠদান।</p>
      </div>
      <div class="step">
        <div class="badge">২</div>
        <h4>পরিকল্পিত পাঠদান</h4>
        <p>একাডেমিক ক্যালেন্ডার ও আগাম পাঠ পরিকল্পনা অনুযায়ী শ্রেণিকক্ষে পাঠ আদায়।</p>
      </div>
      <div class="step">
        <div class="badge">৩</div>
        <h4>নিয়মিত মূল্যায়ন</h4>
        <p>মডেল টেস্ট, মিডটার্ম ও ফাইনাল পরীক্ষার পাশাপাশি আমল-আখলাক মূল্যায়ন।</p>
      </div>
      <div class="step">
        <div class="badge">৪</div>
        <h4>পুরস্কার ও বৃত্তি</h4>
        <p>ফলাফলের ভিত্তিতে পুরস্কার এবং গরিব ও মেধাবী শিক্ষার্থীদের জন্য বিশেষ বৃত্তি।</p>
      </div>
    </div>
  </div>
</section>

<!-- ===== CTA BANNER ===== -->
<section style="padding-top:0;padding-bottom:88px;margin-top:88px;">
  <div class="cta-banner">
    <div>
      <h3>আমাদের এই যাত্রায় আপনার সন্তানকে শামিল করুন</h3>
      <p>ভর্তি সংক্রান্ত যেকোনো তথ্যের জন্য কল করুন অথবা সরাসরি ক্যাম্পাসে চলে আসুন।</p>
    </div>
    <a href="{{ route('admission') }}" class="btn btn-gold">ভর্তি আবেদন করুন →</a>
  </div>
</section>

@endsection