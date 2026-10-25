@extends('frontend.app')

@section('title', 'নোটিশ')

@section('styles')
@endsection

@section('content')
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
  h1,h2,h3,h4,h5,.brand,.nav-cta{font-family:'Noto Serif Bengali', serif;}
  a{color:inherit;text-decoration:none;}
  ul{list-style:none;}
  .container{max-width:1180px;margin:0 auto;padding:0 24px;}
  ::selection{background:var(--gold-light);color:var(--teal-900);}

  .btn{
    padding:14px 26px;border-radius:8px;font-weight:700;font-size:15px;
    display:inline-flex;align-items:center;gap:8px;
    transition:transform .2s, box-shadow .2s, background .2s;
  }
  .btn-gold{background:var(--gold);color:var(--teal-900);box-shadow:0 12px 26px -10px rgba(198,161,91,.7);}
  .btn-gold:hover{transform:translateY(-2px);}

  section{padding:70px 0 80px;}

  /* ===== Page banner ===== */
  .page-banner{
    position:relative;
    background:
      radial-gradient(ellipse at 15% 20%, rgba(119, 125, 126, 0.15), transparent 45%),
      linear-gradient(180deg, var(--teal-900), var(--teal-800));
    color:var(--paper);
    padding:64px 0 54px;
    text-align:center;
    border-bottom:3px solid var(--gold);
  }
  .page-banner h2{font-size:38px;font-weight:800;color:#fbf6e8;margin-bottom:10px;}
  .page-banner p{font-size:15.5px;color:rgba(246,241,228,.8);max-width:560px;margin:0 auto 18px;}
  .breadcrumb{font-size:13.5px;color:var(--gold-light);display:flex;justify-content:center;gap:8px;}
  .breadcrumb a:hover{text-decoration:underline;}

  /* ===== Toolbar (search + filters) ===== */
  .toolbar{
    display:flex;justify-content:space-between;align-items:center;gap:18px;flex-wrap:wrap;
    margin-bottom:28px;
  }
  .filter-row{display:flex;gap:10px;flex-wrap:wrap;}
  .filter-chip{
    border:1.5px solid var(--line);background:transparent;cursor:pointer;
    padding:8px 18px;border-radius:30px;font-size:13.5px;font-weight:600;
    font-family:'Hind Siliguri', sans-serif;color:var(--teal-900);
    transition:background .2s, border-color .2s, color .2s;
  }
  .filter-chip:hover{border-color:var(--gold);}
  .filter-chip.active{background:var(--teal-900);color:var(--gold-light);border-color:var(--teal-900);}
  .search-box{position:relative;}
  .search-box input{
    border:1.5px solid var(--line);border-radius:30px;
    padding:10px 18px;min-width:260px;
    font-family:'Hind Siliguri', sans-serif;font-size:14px;
    background:#fff;color:var(--ink);
    transition:border-color .2s, box-shadow .2s;
  }
  .search-box input:focus{outline:none;border-color:var(--gold);box-shadow:0 0 0 4px rgba(198,161,91,.18);}

  /* ===== Notices ===== */
  .notice-wrap{display:grid;grid-template-columns:1.6fr .8fr;gap:40px;align-items:start;}
  .notice-list{display:flex;flex-direction:column;border-top:1px solid var(--line);}
  .notice-item{
    display:flex;gap:22px;align-items:flex-start;
    padding:24px 4px;border-bottom:1px solid var(--line);
    transition:background .2s;
  }
  .notice-item:hover{background:rgba(198,161,91,.07);}
  .notice-item.hide{display:none;}
  .notice-date{
    background:var(--paper-2);border:1px solid var(--line);
    border-radius:10px;padding:10px 14px;text-align:center;flex-shrink:0;
    font-family:'Noto Serif Bengali',serif;color:var(--teal-900);
    min-width:70px;
  }
  .notice-date strong{display:block;font-size:22px;line-height:1.3;}
  .notice-date span{font-size:11.5px;color:var(--maroon);display:block;}
  .notice-body{flex:1;min-width:0;}
  .notice-body h5{font-size:17px;color:var(--teal-900);margin-bottom:6px;line-height:1.5;}
  .notice-body p{font-size:14px;color:#5b5546;}
  .notice-meta{display:flex;align-items:center;gap:14px;flex-wrap:wrap;margin-top:10px;}
  .tag{
    display:inline-block;font-size:11.5px;
    background:rgba(124,45,45,.1);color:var(--maroon);
    padding:3px 12px;border-radius:20px;font-weight:600;
  }
  .tag.new{background:var(--maroon);color:#fdeee6;}
  .notice-link{font-size:13px;font-weight:700;color:var(--teal-700);}
  .notice-link:hover{color:var(--maroon);text-decoration:underline;}
  .empty-state{
    display:none;text-align:center;padding:50px 20px;color:#5b5546;font-size:15px;
    border-bottom:1px solid var(--line);
  }
  .empty-state.show{display:block;}

  /* ===== Pagination ===== */
  .pagination{display:flex;gap:8px;justify-content:center;margin-top:34px;flex-wrap:wrap;}
  .pagination a, .pagination span{
    min-width:40px;height:40px;padding:0 12px;border-radius:9px;
    display:inline-flex;align-items:center;justify-content:center;
    border:1.5px solid var(--line);font-size:14px;font-weight:600;color:var(--teal-900);
    transition:background .2s;
  }
  .pagination a:hover{background:rgba(198,161,91,.15);}
  .pagination .current{background:var(--teal-900);color:var(--gold-light);border-color:var(--teal-900);}

  /* ===== Sidebar ===== */
  .sidebar{display:flex;flex-direction:column;gap:24px;position:sticky;top:100px;}
  .admission-card{
    background:linear-gradient(160deg, var(--maroon), #5a1f1f);
    border-radius:18px;padding:30px 28px;color:#f8e9e0;
    box-shadow:var(--shadow);
  }
  .admission-card h4{font-size:21px;margin-bottom:12px;color:#fdeee6;}
  .admission-card p{font-size:14px;color:rgba(248,233,224,.85);margin-bottom:18px;}
  .admission-card ul{margin-bottom:22px;}
  .admission-card li{
    font-size:13.5px;padding:8px 0;border-bottom:1px dashed rgba(248,233,224,.25);
    display:flex;justify-content:space-between;gap:10px;
  }
  .admission-card .btn-gold{width:100%;justify-content:center;}
  .side-box{
    background:#fff;border:1px solid var(--line);border-radius:16px;padding:26px 24px;
  }
  .side-box h4{font-size:17px;color:var(--teal-900);margin-bottom:14px;padding-bottom:10px;border-bottom:1px solid var(--line);}
  .side-box li{border-bottom:1px dashed var(--line);}
  .side-box li:last-child{border-bottom:none;}
  .side-box li a{display:block;padding:10px 0;font-size:14px;color:#3f3b30;transition:color .2s, padding .2s;}
  .side-box li a:hover{color:var(--maroon);padding-left:6px;}

  /* ===== CTA banner ===== */
  .cta-banner{
    background:radial-gradient(ellipse at 30% 30%, rgba(198,161,91,.25), transparent 60%), var(--teal-900);
    border-radius:24px;padding:60px 50px;
    display:flex;justify-content:space-between;align-items:center;
    gap:30px;flex-wrap:wrap;color:var(--paper);
    max-width:1180px;margin-left:auto;margin-right:auto;
  }
  .cta-banner h3{font-size:28px;max-width:480px;}
  .cta-banner p{color:rgba(246,241,228,.75);margin-top:10px;font-size:14.5px;}

  /* ===== Responsive ===== */
  @media (max-width: 980px){
    .notice-wrap{grid-template-columns:1fr;}
    .sidebar{position:static;}
  }
  @media (max-width: 720px){
    .page-banner h2{font-size:30px;}
    .search-box, .search-box input{width:100%;}
    .notice-item{gap:14px;}
    .cta-banner{flex-direction:column;text-align:center;padding:40px 26px;margin:0 24px;}
  }
</style>

@php
  // ডেমো ডাটা — পরে Controller থেকে $notices পাঠালে এই অংশ মুছে দিন
  $notices = $notices ?? [
    ['day'=>'১৫','month'=>'অক্টোবর ২০২৬','title'=>'১৪৪৮ হিজরি শিক্ষাবর্ষের ভর্তি কার্যক্রম শুরু','desc'=>'নূরানী, মক্তব, হিফজ ও কিতাব বিভাগে নতুন ভর্তি চলছে। আগ্রহী অভিভাবকগণ অফিস চলাকালীন সময়ে যোগাযোগ করুন।','cat'=>'admission','cat_label'=>'ভর্তি','new'=>true,'file'=>'#'],
    ['day'=>'১০','month'=>'অক্টোবর ২০২৬','title'=>'ভর্তি পরীক্ষার তারিখ ও সময়সূচি প্রকাশ','desc'=>'আগামী শুক্রবার সকাল ৯টায় মাদরাসা ক্যাম্পাসে ভর্তি পরীক্ষা অনুষ্ঠিত হবে। পরীক্ষার্থীদের ছবি ও জন্ম নিবন্ধনের কপি সঙ্গে আনতে হবে।','cat'=>'admission','cat_label'=>'ভর্তি','new'=>true,'file'=>'#'],
    ['day'=>'০৫','month'=>'অক্টোবর ২০২৬','title'=>'প্রথম সাময়িক পরীক্ষার রুটিন','desc'=>'সকল শ্রেণির প্রথম সাময়িক পরীক্ষার বিস্তারিত রুটিন সংযুক্ত করা হয়েছে। নির্ধারিত সময়ের আগে প্রবেশপত্র সংগ্রহ করুন।','cat'=>'exam','cat_label'=>'পরীক্ষা','new'=>false,'file'=>'#'],
    ['day'=>'২৮','month'=>'সেপ্টেম্বর ২০২৬','title'=>'অভিভাবক সমাবেশের নোটিশ','desc'=>'শিক্ষার্থীদের শিক্ষাগত অগ্রগতি নিয়ে আলোচনার জন্য মাসিক অভিভাবক সমাবেশ অনুষ্ঠিত হবে। সকল অভিভাবকের উপস্থিতি কাম্য।','cat'=>'general','cat_label'=>'সাধারণ','new'=>false,'file'=>null],
    ['day'=>'২০','month'=>'সেপ্টেম্বর ২০২৬','title'=>'আবাসিক শিক্ষার্থীদের জন্য নতুন নির্দেশনা','desc'=>'আবাসিক শিক্ষার্থীদের হোস্টেল বিধি ও প্রয়োজনীয় জিনিসপত্রের তালিকা সংশোধন করা হয়েছে। অভিভাবকগণ নোটিশটি দেখে নিন।','cat'=>'general','cat_label'=>'সাধারণ','new'=>false,'file'=>'#'],
    ['day'=>'১২','month'=>'সেপ্টেম্বর ২০২৬','title'=>'সাপ্তাহিক ও বিশেষ ছুটির ঘোষণা','desc'=>'আগামী সপ্তাহে মাদরাসার কার্যক্রম বন্ধ থাকবে। ছুটির পর যথারীতি ক্লাস শুরু হবে।','cat'=>'holiday','cat_label'=>'ছুটি','new'=>false,'file'=>null],
  ];
@endphp

<!-- ===== PAGE BANNER ===== -->
<div class="page-banner">
  <div class="container">
    <h2>নোটিশ বোর্ড</h2>
    <p>ভর্তি, পরীক্ষা, ছুটি ও অন্যান্য গুরুত্বপূর্ণ বিজ্ঞপ্তি এখানে সবার আগে প্রকাশিত হয়।</p>
    <div class="breadcrumb">
      <a href="{{ url('/') }}">হোম</a> <span>/</span> <span>নোটিশ</span>
    </div>
  </div>
</div>

<!-- ===== NOTICES ===== -->
<section id="notices">
  <div class="container">

    <div class="toolbar">
      <div class="filter-row" id="filterRow">
        <button type="button" class="filter-chip active" data-filter="all">সব নোটিশ</button>
        <button type="button" class="filter-chip" data-filter="admission">ভর্তি</button>
        <button type="button" class="filter-chip" data-filter="exam">পরীক্ষা</button>
        <button type="button" class="filter-chip" data-filter="holiday">ছুটি</button>
        <button type="button" class="filter-chip" data-filter="general">সাধারণ</button>
      </div>
      <div class="search-box">
        <input type="text" id="noticeSearch" placeholder="নোটিশ খুঁজুন..." aria-label="নোটিশ খুঁজুন">
      </div>
    </div>

    <div class="notice-wrap">

      <!-- Notice list -->
      <div>
        <div class="notice-list" id="noticeList">
          @foreach($notices as $n)
            <article class="notice-item" data-cat="{{ $n['cat'] }}">
              <div class="notice-date">
                <strong>{{ $n['day'] }}</strong>
                <span>{{ $n['month'] }}</span>
              </div>
              <div class="notice-body">
                <h5>{{ $n['title'] }}</h5>
                <p>{{ $n['desc'] }}</p>
                <div class="notice-meta">
                  <span class="tag">{{ $n['cat_label'] }}</span>
                  @if($n['new'])<span class="tag new">নতুন</span>@endif
                  @if($n['file'])
                    <a href="{{ $n['file'] }}" class="notice-link" target="_blank" rel="noopener">নোটিশ ডাউনলোড করুন (PDF)</a>
                  @endif
                </div>
              </div>
            </article>
          @endforeach
          <div class="empty-state" id="emptyState">কোনো নোটিশ পাওয়া যায়নি। অন্য শব্দ বা বিভাগ দিয়ে খুঁজুন।</div>
        </div>

        {{-- Controller থেকে paginate() ব্যবহার করলে নিচের অংশ চালু করুন:
        <div class="pagination">{{ $notices->links() }}</div> --}}
        <div class="pagination">
          <span class="current">১</span>
          <a href="#">২</a>
          <a href="#">৩</a>
          <a href="#">পরবর্তী</a>
        </div>
      </div>

      <!-- Sidebar -->
      <aside class="sidebar">
        <div class="admission-card">
          <h4>ভর্তি চলছে</h4>
          <p>১৪৪৮ হিজরি শিক্ষাবর্ষে সীমিত আসনে ভর্তি নেওয়া হচ্ছে।</p>
          <ul>
            <li><span>নূরানী ও মক্তব</span><span>চলমান</span></li>
            <li><span>হিফজ বিভাগ</span><span>চলমান</span></li>
            <li><span>কিতাব বিভাগ</span><span>চলমান</span></li>
          </ul>
          <a href="{{ url('/admission') }}" class="btn btn-gold">অনলাইনে আবেদন করুন</a>
        </div>

        <div class="side-box">
          <h4>দ্রুত লিংক</h4>
          <ul>
            <li><a href="{{ url('/admission') }}">ভর্তি আবেদন ফরম</a></li>
            <li><a href="#">পরীক্ষার রুটিন</a></li>
            <li><a href="#">একাডেমিক ক্যালেন্ডার</a></li>
            <li><a href="#contact">যোগাযোগ</a></li>
          </ul>
        </div>
      </aside>

    </div>
  </div>
</section>

<!-- ===== CTA BANNER ===== -->
<section style="padding-top:0;">
  <div class="cta-banner">
    <div>
      <h3>নোটিশ সম্পর্কে কোনো প্রশ্ন থাকলে আমাদের সাথে যোগাযোগ করুন</h3>
      <p>অফিস চলাকালীন সময়ে কল করুন অথবা সরাসরি ক্যাম্পাসে চলে আসুন।</p>
    </div>
    <a href="#contact" class="btn btn-gold">যোগাযোগ করুন →</a>
  </div>
</section>

<script>
  (function(){
    var chips = document.querySelectorAll('#filterRow .filter-chip');
    var items = document.querySelectorAll('#noticeList .notice-item');
    var search = document.getElementById('noticeSearch');
    var empty = document.getElementById('emptyState');
    var activeFilter = 'all';

    function apply(){
      var q = search.value.trim().toLowerCase();
      var visible = 0;
      items.forEach(function(item){
        var okCat = activeFilter === 'all' || item.dataset.cat === activeFilter;
        var okText = !q || item.textContent.toLowerCase().indexOf(q) !== -1;
        var show = okCat && okText;
        item.classList.toggle('hide', !show);
        if(show) visible++;
      });
      empty.classList.toggle('show', visible === 0);
    }

    chips.forEach(function(chip){
      chip.addEventListener('click', function(){
        chips.forEach(function(c){ c.classList.remove('active'); });
        chip.classList.add('active');
        activeFilter = chip.dataset.filter;
        apply();
      });
    });
    search.addEventListener('input', apply);
  })();
</script>
@endsection