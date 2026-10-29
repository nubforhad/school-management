@extends('frontend.app')

@section('title', 'মুহতামিম ও শিক্ষক মণ্ডলী')

@php
  // শিক্ষকদের তথ্য এখানে এডিট করুন। পরে চাইলে ডাটাবেজ থেকে $teachers পাঠিয়ে এই অ্যারে মুছে দিতে পারবেন।
  // 'photo' => 'asset/image/teachers/name.jpg' দিলে ছবি দেখাবে, নইলে নামের প্রথম অক্ষর দেখাবে।
  $teachers = $teachers ?? [
    ['name' => 'শিক্ষকের নাম', 'role' => 'নায়েবে মুহতামিম',     'qual' => 'দাওরায়ে হাদিস, ইফতা',       'dept' => 'hifz',    'photo' => null],
    ['name' => 'শিক্ষকের নাম', 'role' => 'প্রধান ক্বারী',         'qual' => 'তাখাসসুস ফিল কিরাআত',        'dept' => 'hifz',    'photo' => null],
    ['name' => 'শিক্ষকের নাম', 'role' => 'হিফয বিভাগীয় শিক্ষক',   'qual' => 'হাফেয, কামিল',               'dept' => 'hifz',    'photo' => null],
    ['name' => 'শিক্ষকের নাম', 'role' => 'নাযেরা বিভাগীয় শিক্ষক', 'qual' => 'আলিম, ক্বারী',                'dept' => 'nazera',  'photo' => null],
    ['name' => 'শিক্ষকের নাম', 'role' => 'নুরানি বিভাগীয় শিক্ষক', 'qual' => 'ফাযিল, নুরানি প্রশিক্ষণপ্রাপ্ত', 'dept' => 'nurani',  'photo' => null],
    ['name' => 'শিক্ষিকার নাম', 'role' => 'প্রি-নুরানি শিক্ষিকা',  'qual' => 'স্নাতক, প্রশিক্ষণপ্রাপ্ত',    'dept' => 'nurani',  'photo' => null],
    ['name' => 'শিক্ষকের নাম', 'role' => 'ইংরেজি শিক্ষক',          'qual' => 'বি.এ (অনার্স), ইংরেজি',       'dept' => 'general', 'photo' => null],
    ['name' => 'শিক্ষকের নাম', 'role' => 'গণিত ও বিজ্ঞান শিক্ষক',  'qual' => 'বি.এস.এস, বি.এড',            'dept' => 'general', 'photo' => null],
    ['name' => 'শিক্ষকের নাম', 'role' => 'আরবি ভাষা শিক্ষক',       'qual' => 'মদীনা বিশ্ববিদ্যালয় (স্নাতক)', 'dept' => 'general', 'photo' => null],
  ];
  $deptLabels = ['hifz' => 'হিফয বিভাগ', 'nazera' => 'নাযেরা বিভাগ', 'nurani' => 'নুরানি বিভাগ', 'general' => 'জেনারেল ও ভাষা'];
@endphp

@section('content')

<style>
  /* ===== Teachers page extras (existing variables/classes ব্যবহার করা হয়েছে) ===== */
  .page-hero{position:relative;overflow:hidden;text-align:center;padding:72px 0 64px;background:
    radial-gradient(700px 400px at 90% 0,rgba(127,21,49,.10),transparent 60%),
    radial-gradient(600px 360px at 0 100%,rgba(15,76,74,.12),transparent 60%),
    var(--paper)}
  .page-hero h2{font-size:clamp(2rem,4vw,3rem);color:var(--teal-deep);margin-bottom:14px}
  .page-hero h2 em{font-style:normal;color:var(--brand);background:linear-gradient(transparent 68%,var(--amber-soft) 68%)}
  .page-hero p{max-width:62ch;margin:0 auto;color:var(--muted);font-size:1.08rem}
  .crumbs{display:inline-flex;gap:8px;font-size:.88rem;color:var(--muted);margin-bottom:18px}
  .crumbs a{color:var(--brand);font-weight:600}

  /* Muhtamim */
  .muhtamim{display:grid;grid-template-columns:320px 1fr;gap:50px;align-items:center;background:#fff;border:1px solid var(--line);border-radius:30px;padding:44px;box-shadow:var(--shadow);position:relative;overflow:hidden}
  .muhtamim::after{content:"";position:absolute;right:-50px;top:-60px;width:200px;height:200px;border-radius:50%;background:rgba(226,169,59,.15)}
  .muhtamim-photo{width:100%;aspect-ratio:3/4;border-radius:999px 999px 24px 24px;background:linear-gradient(170deg,var(--brand-light),var(--brand-dark));box-shadow:0 0 0 8px #fff,0 0 0 10px var(--teal),var(--shadow-lg);overflow:hidden;display:grid;place-items:center;color:var(--amber-soft);font-family:var(--f-ar);font-size:4rem}
  .muhtamim-photo img{width:100%;height:100%;object-fit:cover}
  .muhtamim-body{position:relative}
  .muhtamim-body .q{font-family:var(--f-head);font-size:4.5rem;line-height:.6;color:var(--brand-tint)}
  .muhtamim-body h3{font-size:clamp(1.4rem,2.6vw,1.9rem);color:var(--teal-deep);margin-bottom:14px}
  .muhtamim-body p{color:var(--muted);margin-bottom:12px}
  .m-name{margin-top:20px;padding-top:18px;border-top:1px dashed var(--line)}
  .m-name strong{display:block;font-family:var(--f-head);font-weight:400;font-size:1.35rem;color:var(--brand)}
  .m-name span{display:block;font-size:.9rem;color:var(--muted)}
  .m-quals{display:flex;gap:8px;flex-wrap:wrap;margin-top:12px}

  /* Filter tabs */
  .filter-tabs{display:flex;justify-content:center;gap:10px;flex-wrap:wrap;margin-bottom:40px}
  .filter-tabs button{font-family:var(--f-body);font-size:.95rem;font-weight:600;padding:10px 22px;border-radius:999px;border:1.5px solid var(--line);background:#fff;color:var(--ink);cursor:pointer;transition:.2s}
  .filter-tabs button:hover{border-color:var(--brand);color:var(--brand)}
  .filter-tabs button.active{background:var(--brand);border-color:var(--brand);color:#fff;box-shadow:0 8px 18px rgba(127,21,49,.25)}

  /* Teacher cards */
  .teacher-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:24px}
  .t-card{background:#fff;border:1px solid var(--line);border-radius:var(--radius);padding:30px 20px 26px;text-align:center;box-shadow:var(--shadow);transition:transform .25s,box-shadow .25s,border-color .25s;position:relative;overflow:hidden}
  .t-card:hover{transform:translateY(-6px);box-shadow:var(--shadow-lg);border-color:var(--brand)}
  .t-card.hide{display:none}
  .t-photo{width:112px;height:112px;margin:0 auto 18px;border-radius:50%;background:linear-gradient(135deg,var(--brand),var(--teal));display:grid;place-items:center;color:#fff;font-family:var(--f-head);font-size:2.4rem;box-shadow:0 0 0 5px #fff,0 0 0 6px rgba(127,21,49,.3);overflow:hidden}
  .t-photo img{width:100%;height:100%;object-fit:cover}
  .t-card h4{font-size:1.15rem;color:var(--teal-deep);margin-bottom:4px}
  .t-card .role{color:var(--brand);font-weight:600;font-size:.92rem;margin-bottom:8px}
  .t-card .qual{color:var(--muted);font-size:.88rem;margin-bottom:12px}
  .t-card .tag{font-size:.76rem}

  @media (max-width:1100px){.teacher-grid{grid-template-columns:repeat(3,1fr)}}
  @media (max-width:980px){
    .muhtamim{grid-template-columns:1fr;text-align:center;padding:34px 24px;gap:34px}
    .muhtamim-photo{max-width:250px;margin:0 auto}
    .m-quals{justify-content:center}
    .teacher-grid{grid-template-columns:repeat(2,1fr)}
  }
  @media (max-width:640px){
    .page-hero{padding:56px 0}
    .teacher-grid{grid-template-columns:1fr}
  }
</style>

<!-- ===== PAGE HERO ===== -->
<section class="page-hero">
  <div class="container">
    <div class="crumbs"><a href="{{ url('/') }}">হোম</a><span>›</span><span>মুহতামিম ও শিক্ষক মণ্ডলী</span></div>
    <span class="eyebrow" style="display:block;width:max-content;margin:0 auto 22px;">আমাদের গর্ব</span>
    <h2>মুহতামিম ও <em>শিক্ষক মণ্ডলী</em></h2>
    <p>দেশ ও বিদেশের প্রতিষ্ঠান থেকে উচ্চতর ডিগ্রিপ্রাপ্ত, নৈতিক ও চারিত্রিক মানসম্পন্ন অভিজ্ঞ শিক্ষকগণ আমাদের শিক্ষার্থীদের পথ দেখান।</p>
  </div>
</section>

<div class="star-divider dark"></div>

<!-- ===== MUHTAMIM ===== -->
<section id="muhtamim">
  <div class="container">
    <div class="section-head" style="margin-bottom:40px;">
      <span class="kicker">প্রতিষ্ঠানের প্রধান</span>
      <h3>মুহতামিমের বাণী</h3>
    </div>
    <div class="muhtamim">
      <div class="muhtamim-photo">
        {{-- ছবি বসাতে: <img src="{{ asset('asset/image/muhtamim.jpg') }}" alt="মুহতামিম"> --}}
        م
      </div>
      <div class="muhtamim-body">
        <div class="q">“</div>
        <h3>ইলম ও আমলের সম্মিলনে গড়ি আগামীর যোগ্য প্রজন্ম</h3>
        <p>সমস্ত প্রশংসা আল্লাহ তায়ালার জন্য। সম্মানিত অভিভাবকবৃন্দ, আসসালামু আলাইকুম। নিদাউল কুরআন মাদরাসা কুরআন ও সুন্নাহর আলোকে নতুন প্রজন্মকে যুগোপযোগী ও যোগ্য করে গড়ে তোলার অঙ্গীকার নিয়ে পথ চলছে।</p>
        <p>আপনাদের সন্তানদের শুদ্ধ তিলাওয়াত, হিফয, জেনারেল শিক্ষা এবং উত্তম আখলাক গঠনে আমরা সর্বোচ্চ চেষ্টা করি। আপনাদের দোয়া ও সহযোগিতাই আমাদের প্রধান শক্তি।</p>
        <div class="m-name">
          <strong>মুহতামিমের নাম</strong>
          <span>মুহতামিম, নিদাউল কুরআন মাদরাসা</span>
          <div class="m-quals">
            <span class="tag">দাওরায়ে হাদিস</span>
            <span class="tag">ইফতা</span>
            <span class="tag">যোগ্যতা যোগ করুন</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== TEACHERS ===== -->
<section id="teachers" style="background:var(--paper-2);">
  <div class="container">
    <div class="section-head">
      <span class="kicker">আমাদের শিক্ষকবৃন্দ</span>
      <h3>শিক্ষক মণ্ডলী</h3>
      <p>বাংলা, আরবি ও ইংরেজিতে দক্ষ এবং প্রতিষ্ঠানের নিজস্ব পদ্ধতিতে প্রশিক্ষিত শিক্ষকগণ।</p>
    </div>

    <div class="filter-tabs" id="teacherTabs">
      <button type="button" class="active" data-filter="all">সকল শিক্ষক</button>
      @foreach($deptLabels as $key => $label)
        <button type="button" data-filter="{{ $key }}">{{ $label }}</button>
      @endforeach
    </div>

    <div class="teacher-grid" id="teacherGrid">
      @foreach($teachers as $t)
        <div class="t-card" data-dept="{{ $t['dept'] }}">
          <div class="t-photo">
            @if(!empty($t['photo']))
              <img src="{{ asset($t['photo']) }}" alt="{{ $t['name'] }}">
            @else
              {{ mb_substr($t['name'], 0, 1) }}
            @endif
          </div>
          <h4>{{ $t['name'] }}</h4>
          <div class="role">{{ $t['role'] }}</div>
          <div class="qual">{{ $t['qual'] }}</div>
          <span class="tag">{{ $deptLabels[$t['dept']] ?? '' }}</span>
        </div>
      @endforeach
    </div>
  </div>
</section>

<!-- ===== WHY OUR TEACHERS ===== -->
<section id="quality">
  <div class="container">
    <div class="section-head">
      <span class="kicker">শিক্ষক নিয়োগ ও প্রশিক্ষণ</span>
      <h3>আমাদের শিক্ষকদের বৈশিষ্ট্য</h3>
    </div>
    <div class="pillars">
      <div class="pillar">
        <div class="icon">🎓</div>
        <h4>উচ্চতর ডিগ্রিপ্রাপ্ত</h4>
        <p>দেশ ও বিদেশের স্বনামধন্য প্রতিষ্ঠান থেকে উচ্চতর ডিগ্রিপ্রাপ্ত শিক্ষক দ্বারা পাঠদান।</p>
      </div>
      <div class="pillar">
        <div class="icon">📝</div>
        <h4>প্রশিক্ষিত ও পরিকল্পিত</h4>
        <p>প্রতিষ্ঠানের নিজস্ব পদ্ধতিতে প্রশিক্ষিত এবং ক্লাস শুরুর আগেই পাঠ পরিকল্পনা সম্পন্নকারী।</p>
      </div>
      <div class="pillar">
        <div class="icon">🤲</div>
        <h4>নৈতিক ও চারিত্রিক মান</h4>
        <p>শিক্ষার্থীদের জন্য আদর্শ হওয়ার মতো নৈতিক ও চারিত্রিক মানসম্পন্ন শিক্ষকমণ্ডলী।</p>
      </div>
    </div>
  </div>
</section>

<!-- ===== CTA BANNER ===== -->
<section style="padding-top:0;">
  <div class="cta-banner">
    <div>
      <h3>আপনার সন্তানকে অভিজ্ঞ শিক্ষকদের তত্ত্বাবধানে দিন</h3>
      <p>ভর্তি সংক্রান্ত যেকোনো তথ্যের জন্য কল করুন অথবা সরাসরি ক্যাম্পাসে চলে আসুন।</p>
    </div>
    <a href="{{ route('admission') }}" class="btn btn-gold">ভর্তি আবেদন করুন →</a>
  </div>
</section>

<script>
  // শিক্ষক ফিল্টার
  (function(){
    var tabs = document.querySelectorAll('#teacherTabs button');
    var cards = document.querySelectorAll('#teacherGrid .t-card');
    tabs.forEach(function(btn){
      btn.addEventListener('click', function(){
        tabs.forEach(function(b){ b.classList.remove('active'); });
        btn.classList.add('active');
        var f = btn.getAttribute('data-filter');
        cards.forEach(function(c){
          c.classList.toggle('hide', f !== 'all' && c.getAttribute('data-dept') !== f);
        });
      });
    });
  })();
</script>

@endsection