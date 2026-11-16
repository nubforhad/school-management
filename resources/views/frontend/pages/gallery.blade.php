@extends('frontend.app')

@section('title', 'গ্যালারি')

@section('content')

@php
  // ===== ছবির তালিকা =====
  // 'src' => 'asset/image/gallery/xxx.jpg' দিলে আসল ছবি দেখাবে, null থাকলে প্লেসহোল্ডার দেখাবে।
  // 'size' => 'wide' | 'tall' | '' (গ্রিডে আকার নির্ধারণ)
  $categories = [
    'campus'   => 'ক্যাম্পাস',
    'class'    => 'ক্লাসরুম',
    'hifz'     => 'হিফয বিভাগ',
    'program'  => 'অনুষ্ঠান',
    'sports'   => 'খেলাধুলা',
  ];

  $photos = [
    ['cat'=>'campus',  'title'=>'মাদরাসার প্রধান ফটক',        'caption'=>'সকালের আলোয় নিদাউল কুরআন মাদরাসা ক্যাম্পাস।',      'src'=>null, 'icon'=>'🏛️', 'size'=>'wide'],
    ['cat'=>'class',   'title'=>'জেনারেল ক্লাস',              'caption'=>'বোর্ড নির্ধারিত সিলেবাসে শ্রেণিভিত্তিক পাঠদান।',    'src'=>null, 'icon'=>'🎓', 'size'=>''],
    ['cat'=>'hifz',    'title'=>'হিফয শুনানি',                'caption'=>'প্রতিদিন নিয়ম করে উস্তাযকে শুনানি।',                'src'=>null, 'icon'=>'📖', 'size'=>'tall'],
    ['cat'=>'program', 'title'=>'কিরাত প্রতিযোগিতা',          'caption'=>'শিক্ষার্থীদের তিলাওয়াত প্রতিযোগিতার মুহূর্ত।',       'src'=>null, 'icon'=>'🎙️', 'size'=>''],
    ['cat'=>'sports',  'title'=>'বার্ষিক ক্রীড়া',             'caption'=>'ক্রীড়া প্রতিযোগিতায় শিক্ষার্থীদের অংশগ্রহণ।',       'src'=>null, 'icon'=>'🏃', 'size'=>''],
    ['cat'=>'class',   'title'=>'নুরানি ক্লাস',               'caption'=>'ছোটদের জন্য নুরানি পদ্ধতিতে আনন্দময় শিক্ষা।',       'src'=>null, 'icon'=>'🔤', 'size'=>'wide'],
    ['cat'=>'campus',  'title'=>'লাইব্রেরি কর্নার',           'caption'=>'পড়ার জন্য শান্ত ও পরিচ্ছন্ন পরিবেশ।',               'src'=>null, 'icon'=>'📚', 'size'=>''],
    ['cat'=>'hifz',    'title'=>'হিফয রিভিশন',                'caption'=>'বিশেষ রুটিনে নিয়মিত পুনরালোচনা।',                   'src'=>null, 'icon'=>'🤲', 'size'=>''],
    ['cat'=>'program', 'title'=>'অভিভাবক সমাবেশ',             'caption'=>'অভিভাবকদের সাথে মতবিনিময় সভা।',                    'src'=>null, 'icon'=>'👨‍👩‍👧', 'size'=>'tall'],
    ['cat'=>'program', 'title'=>'চিত্রাঙ্কন ও হাতের লেখা',    'caption'=>'সৃজনশীলতা বিকাশে চিত্রাঙ্কন ও হাতের লেখা প্রতিযোগিতা।','src'=>null, 'icon'=>'🎨', 'size'=>''],
    ['cat'=>'sports',  'title'=>'খেলার মাঠ',                  'caption'=>'শারীরিক বিকাশে খেলাধুলার সুযোগ।',                    'src'=>null, 'icon'=>'⚽', 'size'=>'wide'],
    ['cat'=>'campus',  'title'=>'নিরাপত্তা ব্যবস্থা',         'caption'=>'সিসিটিভির মাধ্যমে সার্বক্ষণিক নজরদারি।',             'src'=>null, 'icon'=>'🛡️', 'size'=>''],
  ];
@endphp

<style>
  /* ===== Gallery page extras (existing variables/classes ব্যবহার করা হয়েছে) ===== */
  .page-hero{position:relative;overflow:hidden;text-align:center;padding:72px 0 64px;background:
    radial-gradient(700px 400px at 90% 0,rgba(127,21,49,.10),transparent 60%),
    radial-gradient(600px 360px at 0 100%,rgba(15,76,74,.12),transparent 60%),
    var(--paper)}
  .page-hero h2{font-size:clamp(2rem,4vw,3rem);color:var(--teal-deep);margin-bottom:14px}
  .page-hero h2 em{font-style:normal;color:var(--brand);background:linear-gradient(transparent 68%,var(--amber-soft) 68%)}
  .page-hero p{max-width:62ch;margin:0 auto;color:var(--muted);font-size:1.08rem}
  .crumbs{display:inline-flex;gap:8px;font-size:.88rem;color:var(--muted);margin-bottom:18px}
  .crumbs a{color:var(--brand);font-weight:600}

  /* ফিল্টার ট্যাব */
  .g-filter{display:flex;flex-wrap:wrap;justify-content:center;gap:10px;margin-bottom:40px}
  .g-filter button{font:inherit;font-size:.95rem;font-weight:600;cursor:pointer;background:#fff;color:var(--teal-deep);border:1px solid var(--line);border-radius:999px;padding:9px 22px;transition:.25s}
  .g-filter button:hover{border-color:var(--brand);color:var(--brand)}
  .g-filter button.active{background:var(--brand);border-color:var(--brand);color:#fff;box-shadow:var(--shadow)}
  .g-filter button:focus-visible,.g-item:focus-visible,.lb button:focus-visible{outline:3px solid var(--amber);outline-offset:3px}
  .g-filter .count{font-weight:400;opacity:.75;margin-left:4px}

  /* গ্যালারি গ্রিড */
  .g-grid{display:grid;grid-template-columns:repeat(4,1fr);grid-auto-rows:210px;grid-auto-flow:dense;gap:18px}
  .g-item{position:relative;overflow:hidden;border-radius:22px;border:0;padding:0;cursor:pointer;background:var(--brand-dark);box-shadow:var(--shadow);text-align:left;font:inherit;color:#fff}
  .g-item.wide{grid-column:span 2}
  .g-item.tall{grid-row:span 2}
  .g-item.hide{display:none}
  .g-item img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;transition:transform .5s}
  .g-item:hover img{transform:scale(1.06)}
  .g-ph{position:absolute;inset:0;display:grid;place-items:center;font-size:3.2rem}
  .g-item[data-cat="campus"] .g-ph,.g-item[data-cat="hifz"] .g-ph{background:linear-gradient(160deg,var(--teal),var(--teal-deep))}
  .g-item[data-cat="class"] .g-ph,.g-item[data-cat="program"] .g-ph{background:linear-gradient(160deg,var(--brand),var(--brand-dark))}
  .g-item[data-cat="sports"] .g-ph{background:linear-gradient(160deg,var(--brand-light),var(--brand-dark))}
  .g-ph::after{content:"";position:absolute;right:-30px;top:-40px;width:150px;height:150px;border-radius:50%;background:rgba(226,169,59,.18)}
  .g-cap{position:absolute;left:0;right:0;bottom:0;padding:44px 18px 16px;background:linear-gradient(transparent,rgba(0,0,0,.72));opacity:0;transform:translateY(10px);transition:.3s}
  .g-item:hover .g-cap,.g-item:focus-visible .g-cap{opacity:1;transform:none}
  .g-cap strong{display:block;font-size:1.02rem;color:var(--amber-soft)}
  .g-cap span{font-size:.82rem;color:#f6dfe5}
  .g-empty{display:none;text-align:center;color:var(--muted);padding:40px 0}

  /* লাইটবক্স */
  .lb{position:fixed;inset:0;z-index:999;display:none;align-items:center;justify-content:center;background:rgba(10,20,20,.9);padding:24px}
  .lb.open{display:flex}
  .lb-box{max-width:920px;width:100%;text-align:center;color:#fff}
  .lb-stage{position:relative;aspect-ratio:16/10;border-radius:22px;overflow:hidden;background:var(--brand-dark);display:grid;place-items:center;font-size:5rem}
  .lb-stage img{position:absolute;inset:0;width:100%;height:100%;object-fit:contain;background:#000}
  .lb-box h4{color:var(--amber-soft);font-size:1.3rem;margin:18px 0 4px}
  .lb-box p{color:#f6dfe5;font-size:.95rem;margin:0 auto;max-width:60ch}
  .lb-count{display:block;margin-top:10px;font-size:.85rem;color:rgba(255,255,255,.6)}
  .lb button{position:absolute;background:rgba(255,255,255,.14);color:#fff;border:0;border-radius:50%;width:48px;height:48px;font-size:1.4rem;cursor:pointer;transition:.25s}
  .lb button:hover{background:var(--brand)}
  .lb .close{top:20px;right:20px}
  .lb .prev{left:20px;top:50%;transform:translateY(-50%)}
  .lb .next{right:20px;top:50%;transform:translateY(-50%)}

  @media (max-width:980px){
    .g-grid{grid-template-columns:repeat(2,1fr);grid-auto-rows:190px}
  }
  @media (max-width:640px){
    .page-hero{padding:56px 0}
    .g-grid{gap:12px;grid-auto-rows:150px}
    .g-item.wide{grid-column:span 2}
    .g-cap{opacity:1;transform:none;padding-top:30px}
    .g-cap span{display:none}
    .lb .prev{left:8px}.lb .next{right:8px}
    .lb button{width:42px;height:42px}
  }
  @media (prefers-reduced-motion:reduce){
    .g-item img,.g-cap{transition:none}
  }
</style>

<!-- ===== PAGE HERO ===== -->
<section class="page-hero">
  <div class="container">
    <div class="crumbs"><a href="{{ url('/') }}">হোম</a><span>›</span><span>গ্যালারি</span></div>
    <span class="eyebrow" style="display:block;width:max-content;margin:0 auto 22px;">ক্যাম্পাসের মুহূর্তগুলো</span>
    <h2>আমাদের <em>গ্যালারি</em></h2>
    <p>ক্লাসরুম, হিফয শুনানি, অনুষ্ঠান ও খেলাধুলা—নিদাউল কুরআন মাদরাসার প্রতিদিনের কিছু ছবি।</p>
  </div>
</section>

<div class="star-divider dark"></div>

<!-- ===== GALLERY ===== -->
<section id="gallery">
  <div class="container">
    <div class="g-filter" role="tablist" aria-label="ছবির বিভাগ">
      <button type="button" class="active" data-filter="all">সব ছবি<span class="count">({{ count($photos) }})</span></button>
      @foreach($categories as $key => $label)
        <button type="button" data-filter="{{ $key }}">{{ $label }}<span class="count">({{ collect($photos)->where('cat',$key)->count() }})</span></button>
      @endforeach
    </div>

    <div class="g-grid" id="gGrid">
      @foreach($photos as $i => $p)
        <button type="button" class="g-item {{ $p['size'] }}" data-cat="{{ $p['cat'] }}"
                data-title="{{ $p['title'] }}" data-caption="{{ $p['caption'] }}"
                data-src="{{ $p['src'] ? asset($p['src']) : '' }}" data-icon="{{ $p['icon'] }}"
                aria-label="{{ $p['title'] }} বড় করে দেখুন">
          @if($p['src'])
            <img src="{{ asset($p['src']) }}" alt="{{ $p['title'] }}" loading="lazy">
          @else
            <div class="g-ph" aria-hidden="true">{{ $p['icon'] }}</div>
          @endif
          <div class="g-cap"><strong>{{ $p['title'] }}</strong><span>{{ $categories[$p['cat']] }}</span></div>
        </button>
      @endforeach
    </div>
    <p class="g-empty" id="gEmpty">এই বিভাগে এখনো কোনো ছবি যোগ করা হয়নি।</p>
  </div>
</section>

<!-- ===== CTA BANNER ===== -->
<section style="padding-top:0;">
  <div class="cta-banner">
    <div>
      <h3>নিজের চোখে ক্যাম্পাস দেখতে চান?</h3>
      <p>সরাসরি ক্যাম্পাসে এসে পরিবেশ দেখুন এবং ভর্তি সংক্রান্ত তথ্য জেনে নিন।</p>
    </div>
    <a href="{{ route('contact') }}" class="btn btn-gold">যোগাযোগ করুন →</a>
  </div>
</section>

<!-- ===== LIGHTBOX ===== -->
<div class="lb" id="lb" role="dialog" aria-modal="true" aria-label="ছবি দেখুন">
  <button type="button" class="close" id="lbClose" aria-label="বন্ধ করুন">✕</button>
  <button type="button" class="prev" id="lbPrev" aria-label="আগের ছবি">‹</button>
  <button type="button" class="next" id="lbNext" aria-label="পরের ছবি">›</button>
  <div class="lb-box">
    <div class="lb-stage" id="lbStage"></div>
    <h4 id="lbTitle"></h4>
    <p id="lbCaption"></p>
    <span class="lb-count" id="lbCount"></span>
  </div>
</div>

<script>
(function(){
  var items = Array.prototype.slice.call(document.querySelectorAll('.g-item'));
  var tabs  = document.querySelectorAll('.g-filter button');
  var empty = document.getElementById('gEmpty');
  var lb = document.getElementById('lb'), stage = document.getElementById('lbStage');
  var current = 0, lastFocus = null;

  var bn = function(n){ return String(n).replace(/\d/g, function(d){ return '০১২৩৪৫৬৭৮৯'[d]; }); };
  var visible = function(){ return items.filter(function(i){ return !i.classList.contains('hide'); }); };

  // ফিল্টার
  tabs.forEach(function(t){
    t.addEventListener('click', function(){
      tabs.forEach(function(x){ x.classList.remove('active'); });
      t.classList.add('active');
      var f = t.dataset.filter;
      items.forEach(function(i){ i.classList.toggle('hide', f !== 'all' && i.dataset.cat !== f); });
      empty.style.display = visible().length ? 'none' : 'block';
    });
  });

  // লাইটবক্স
  function show(idx){
    var list = visible();
    current = (idx + list.length) % list.length;
    var el = list[current];
    stage.innerHTML = '';
    if (el.dataset.src) {
      var img = document.createElement('img');
      img.src = el.dataset.src; img.alt = el.dataset.title;
      stage.appendChild(img);
    } else {
      stage.textContent = el.dataset.icon;
    }
    document.getElementById('lbTitle').textContent = el.dataset.title;
    document.getElementById('lbCaption').textContent = el.dataset.caption;
    document.getElementById('lbCount').textContent = bn(current + 1) + ' / ' + bn(list.length);
  }
  function open(el){
    lastFocus = el;
    show(visible().indexOf(el));
    lb.classList.add('open');
    document.body.style.overflow = 'hidden';
    document.getElementById('lbClose').focus();
  }
  function close(){
    lb.classList.remove('open');
    document.body.style.overflow = '';
    if (lastFocus) lastFocus.focus();
  }

  items.forEach(function(i){ i.addEventListener('click', function(){ open(i); }); });
  document.getElementById('lbClose').addEventListener('click', close);
  document.getElementById('lbPrev').addEventListener('click', function(){ show(current - 1); });
  document.getElementById('lbNext').addEventListener('click', function(){ show(current + 1); });
  lb.addEventListener('click', function(e){ if (e.target === lb) close(); });
  document.addEventListener('keydown', function(e){
    if (!lb.classList.contains('open')) return;
    if (e.key === 'Escape') close();
    if (e.key === 'ArrowLeft') show(current - 1);
    if (e.key === 'ArrowRight') show(current + 1);
  });
})();
</script>

@endsection