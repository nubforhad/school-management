@extends('frontend.app')

@section('title', 'যোগাযোগ')

@section('content')

<style>
  /* ===== Contact page extras (existing variables/classes ব্যবহার করা হয়েছে) ===== */
  .page-hero{position:relative;overflow:hidden;text-align:center;padding:72px 0 64px;background:
    radial-gradient(700px 400px at 90% 0,rgba(127,21,49,.10),transparent 60%),
    radial-gradient(600px 360px at 0 100%,rgba(15,76,74,.12),transparent 60%),
    var(--paper)}
  .page-hero h2{font-size:clamp(2rem,4vw,3rem);color:var(--teal-deep);margin-bottom:14px}
  .page-hero h2 em{font-style:normal;color:var(--brand);background:linear-gradient(transparent 68%,var(--amber-soft) 68%)}
  .page-hero p{max-width:60ch;margin:0 auto;color:var(--muted);font-size:1.08rem}
  .crumbs{display:inline-flex;gap:8px;font-size:.88rem;color:var(--muted);margin-bottom:18px}
  .crumbs a{color:var(--brand);font-weight:600}

  .contact-cards{margin-top:-36px;position:relative;z-index:2;padding:0 0 20px}
  .contact-cards .pillar{padding:30px 24px}
  .contact-cards .pillar a{color:var(--brand);font-weight:600}
  .contact-cards .pillar p{margin-bottom:2px}

  .contact-wrap{display:grid;grid-template-columns:1.3fr 1fr;gap:34px;align-items:start}
  .form-card{background:#fff;border:1px solid var(--line);border-radius:26px;padding:38px 34px;box-shadow:var(--shadow)}
  .form-card h4{font-size:1.5rem;color:var(--teal-deep);margin-bottom:6px}
  .form-card > p{color:var(--muted);margin-bottom:26px;font-size:.96rem}
  .form-grid{display:grid;grid-template-columns:1fr 1fr;gap:18px}
  .field{display:flex;flex-direction:column;gap:6px}
  .field.full{grid-column:1/-1}
  .field label{font-weight:600;font-size:.92rem;color:var(--teal-deep)}
  .field label b{color:var(--brand)}
  .field input,.field select,.field textarea{
    font-family:var(--f-body);font-size:1rem;color:var(--ink);background:var(--paper);
    border:1.5px solid var(--line);border-radius:12px;padding:12px 14px;width:100%;transition:border-color .2s,box-shadow .2s,background .2s}
  .field textarea{min-height:140px;resize:vertical}
  .field input:focus,.field select:focus,.field textarea:focus{outline:none;border-color:var(--brand);background:#fff;box-shadow:0 0 0 4px rgba(127,21,49,.10)}
  .field .err{color:#b3261e;font-size:.82rem}
  .alert-ok{background:var(--teal-tint);border:1px solid var(--teal);color:var(--teal-deep);padding:14px 18px;border-radius:14px;margin-bottom:22px;font-weight:600}
  .form-card .btn{margin-top:6px;border:0;font-family:var(--f-body)}

  .info-card{background:linear-gradient(160deg,var(--brand),var(--brand-dark));color:#fff;border-radius:26px;padding:36px 30px;box-shadow:var(--shadow-lg);position:sticky;top:104px;overflow:hidden}
  .info-card::after{content:"";position:absolute;right:-2px;top:-50px;width:160px;height:160px;border-radius:50%;background:rgba(226,169,59,.18)}
  .info-card h4{font-size:1.45rem;color:var(--amber-soft);margin-bottom:10px;position:relative}
  .info-card > p{font-size:.95rem;color:#f6dfe5;margin-bottom:18px;position:relative}
  .info-card ul{position:relative;margin-bottom:24px}
  .info-card li{display:flex;justify-content:space-between;gap:10px;padding:12px 0;border-bottom:1px dashed rgba(255,255,255,.28);font-size:.96rem}
  .info-card li span:last-child{color:var(--amber-soft);font-weight:600;text-align:right}
  .info-card .btn{position:relative}

  .map-box{border-radius:var(--radius);overflow:hidden;border:1px solid var(--line);box-shadow:var(--shadow);background:#fff}
  .map-box iframe{width:100%;height:420px;border:0;display:block}
  .map-box .map-foot{padding:18px 22px;display:flex;justify-content:space-between;align-items:center;gap:16px;flex-wrap:wrap}
  .map-box .map-foot strong{font-family:var(--f-head);font-weight:400;color:var(--teal-deep);font-size:1.15rem}
  .map-box .map-foot span{color:var(--muted);font-size:.93rem;display:block}

  .faq{max-width:860px;margin:0 auto;display:flex;flex-direction:column;gap:14px}
  .faq details{background:#fff;border:1px solid var(--line);border-radius:16px;padding:0 22px;transition:.25s}
  .faq details[open]{border-color:var(--brand);box-shadow:var(--shadow)}
  .faq summary{cursor:pointer;list-style:none;padding:18px 0;font-weight:600;color:var(--teal-deep);display:flex;justify-content:space-between;align-items:center;gap:12px}
  .faq summary::-webkit-details-marker{display:none}
  .faq summary::after{content:"+";font-size:1.5rem;color:var(--brand);line-height:1}
  .faq details[open] summary::after{content:"−"}
  .faq details p{color:var(--muted);padding-bottom:18px;font-size:.96rem}

  @media (max-width:980px){
    .contact-wrap{grid-template-columns:1fr}
    .info-card{position:static}
  }
  @media (max-width:640px){
    .form-grid{grid-template-columns:1fr}
    .form-card{padding:28px 20px}
    .map-box iframe{height:300px}
    .page-hero{padding:56px 0 56px}
  }
</style>

<!-- ===== PAGE HERO ===== -->
<section class="page-hero" style="padding-bottom:64px;">
  <div class="container">
    <div class="crumbs"><a href="{{ url('/') }}">হোম</a><span>›</span><span>যোগাযোগ</span></div>
    <span class="eyebrow" style="display:block;width:max-content;margin:0 auto 22px;">আমরা আপনার অপেক্ষায়</span>
    <h2>আমাদের সাথে <em>যোগাযোগ</em> করুন</h2>
    <p>ভর্তি, কারিকুলাম বা যেকোনো তথ্যের জন্য নির্দ্বিধায় কল করুন, বার্তা পাঠান অথবা সরাসরি ক্যাম্পাসে চলে আসুন।</p>
  </div>
</section>

<!-- ===== QUICK CONTACT CARDS ===== -->
<section class="contact-cards" style="padding-top:0;">
  <div class="container">
    <div class="pillars">
      <div class="pillar">
        <div class="icon">📞</div>
        <h4>ফোন</h4>
        <p><a href="tel:+8801XXXXXXXXX">+880 1XXX-XXXXXX</a></p>
        <p><a href="tel:+8801XXXXXXXXX">+880 1XXX-XXXXXX</a></p>
      </div>
      <div class="pillar">
        <div class="icon">✉️</div>
        <h4>ইমেইল</h4>
        <p><a href="mailto:{{ $settings->get('email') ?? 'info@nidaulquran.com' }}">{{ $settings->get('email') ?? 'info@nidaulquran.com' }}</a></p>
        <p>২৪ ঘণ্টার মধ্যে উত্তর দেওয়া হয়</p>
      </div>
      <div class="pillar">
        <div class="icon">📍</div>
        <h4>ঠিকানা</h4>
        <p>{{ $settings->get('address') ?? 'গ্রাম/মহল্লা, থানা, জেলা, ঢাকা' }}</p>
      </div>
    </div>
  </div>
</section>

<!-- ===== FORM + INFO ===== -->
<section id="contact">
  <div class="container">
    <div class="section-head" style="margin-bottom:40px;">
      <span class="kicker">বার্তা পাঠান</span>
      <h3>আপনার প্রশ্ন আমাদের জানান</h3>
      <p>নিচের ফরমটি পূরণ করুন, আমাদের প্রতিনিধি দ্রুত আপনার সাথে যোগাযোগ করবেন।</p>
    </div>

    <div class="contact-wrap">
      <div class="form-card">
        <h4>যোগাযোগ ফরম</h4>
        <p>যে তথ্যগুলোর পাশে <b style="color:var(--brand)">*</b> চিহ্ন আছে সেগুলো আবশ্যক।</p>

        @if(session('success'))
          <div class="alert-ok">✅ {{ session('success') }}</div>
        @endif

        <form action="" method="POST">
          @csrf
          <div class="form-grid">
            <div class="field">
              <label for="name">আপনার নাম <b>*</b></label>
              <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="পূর্ণ নাম লিখুন" required>
              @error('name')<span class="err">{{ $message }}</span>@enderror
            </div>
            <div class="field">
              <label for="phone">মোবাইল নম্বর <b>*</b></label>
              <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" placeholder="01XXXXXXXXX" required>
              @error('phone')<span class="err">{{ $message }}</span>@enderror
            </div>
            <div class="field">
              <label for="email">ইমেইল</label>
              <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="example@mail.com">
              @error('email')<span class="err">{{ $message }}</span>@enderror
            </div>
            <div class="field">
              <label for="subject">বিষয় <b>*</b></label>
              <select id="subject" name="subject" required>
                <option value="">বিষয় নির্বাচন করুন</option>
                <option value="ভর্তি তথ্য" @selected(old('subject')=='ভর্তি তথ্য')>ভর্তি তথ্য</option>
                <option value="হিফয বিভাগ" @selected(old('subject')=='হিফয বিভাগ')>হিফয বিভাগ</option>
                <option value="নুরানি / নাযেরা" @selected(old('subject')=='নুরানি / নাযেরা')>নুরানি / নাযেরা</option>
                <option value="আবাসিক সুবিধা" @selected(old('subject')=='আবাসিক সুবিধা')>আবাসিক সুবিধা</option>
                <option value="অন্যান্য" @selected(old('subject')=='অন্যান্য')>অন্যান্য</option>
              </select>
              @error('subject')<span class="err">{{ $message }}</span>@enderror
            </div>
            <div class="field full">
              <label for="message">আপনার বার্তা <b>*</b></label>
              <textarea id="message" name="message" placeholder="আপনার প্রশ্ন বা মতামত বিস্তারিত লিখুন..." required>{{ old('message') }}</textarea>
              @error('message')<span class="err">{{ $message }}</span>@enderror
            </div>
          </div>
          <button type="submit" class="btn btn-gold">বার্তা পাঠান →</button>
        </form>
      </div>

      <aside class="info-card">
        <h4>অফিস সময়সূচি</h4>
        <p>ভর্তি ও অন্যান্য তথ্যের জন্য নিচের সময়ে সরাসরি অফিসে আসতে পারেন।</p>
        <ul>
          <li><span>শনি - বৃহস্পতি</span><span>সকাল ৮:০০ - দুপুর ২:০০</span></li>
          <li><span>শুক্রবার</span><span>বন্ধ</span></li>
          <li><span>ভর্তি কার্যক্রম</span><span>সকাল ৯:০০ - বিকাল ৪:০০</span></li>
          <li><span>শিক্ষাবর্ষ</span><span>জানুয়ারি - ডিসেম্বর</span></li>
        </ul>
        <a href="{{ route('admission') }}" class="btn btn-gold">ভর্তি আবেদন করুন</a>
      </aside>
    </div>
  </div>
</section>

<!-- ===== MAP ===== -->
<section id="map" style="background:var(--paper-2);">
  <div class="container">
    <div class="section-head" style="margin-bottom:40px;">
      <span class="kicker">আমাদের অবস্থান</span>
      <h3>ক্যাম্পাসে আসার পথ</h3>
    </div>
    <div class="map-box">
      {{-- Google Maps > Share > Embed a map থেকে iframe src বসান --}}
      <iframe src="https://www.google.com/maps?q=Dhaka,Bangladesh&output=embed" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="মাদরাসার অবস্থান"></iframe>
      <div class="map-foot">
        <div>
          <strong>নিদাউল কুরআন মাদরাসা</strong>
          <span>{{ $settings->get('address') ?? 'আপনার পূর্ণ ঠিকানা এখানে লিখুন' }}</span>
        </div>
        <a href="https://www.google.com/maps?q=Dhaka,Bangladesh" target="_blank" rel="noopener" class="btn btn-outline">দিকনির্দেশনা নিন</a>
      </div>
    </div>
  </div>
</section>

<!-- ===== FAQ ===== -->
<section id="faq">
  <div class="container">
    <div class="section-head" style="margin-bottom:40px;">
      <span class="kicker">সাধারণ জিজ্ঞাসা</span>
      <h3>অভিভাবকদের সচরাচর প্রশ্ন</h3>
    </div>
    <div class="faq">
      <details>
        <summary>ভর্তির জন্য ন্যূনতম বয়স কত?</summary>
        <p>প্লে (প্রি-নুরানি) স্তরে ন্যূনতম বয়স ৪ বছর এবং নুরানি স্তরে ৫ বছর। ছেলে-মেয়ে উভয়ের জন্য ভর্তি উন্মুক্ত।</p>
      </details>
      <details>
        <summary>হিফয শিক্ষার্থীদের কি আবাসিক থাকা বাধ্যতামূলক?</summary>
        <p>জি, হিফয শিক্ষার্থীদের আবাসিক থাকা বাধ্যতামূলক। অন্যান্য স্তরে আবাসিক, অনাবাসিক ও ফুলটাইম—তিন ধরনেই ভর্তির সুযোগ রয়েছে।</p>
      </details>
      <details>
        <summary>ইউনিফর্ম কীভাবে সংগ্রহ করব?</summary>
        <p>মাদরাসার ডিজাইন ও কালারের ইউনিফর্মের স্যাম্পল অফিস থেকে সংগ্রহ করে অভিভাবকগণ নিজ দায়িত্বে তৈরি করে নেবেন। প্রতিষ্ঠানের মনোগ্রাম থাকা বাধ্যতামূলক।</p>
      </details>
      <details>
        <summary>বিকালের কোচিং সুবিধা আছে কি?</summary>
        <p>জি, বিকালের কোচিং সুবিধা রয়েছে। বিস্তারিত জানতে অফিসে যোগাযোগ করুন।</p>
      </details>
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
    <a href="tel:+8801XXXXXXXXX" class="btn btn-gold">এখনই কল করুন →</a>
  </div>
</section>

@endsection