@extends('frontend.app')

@section('title', 'গ্যালারি')

@section('content')

    <style>
        /* PAGE HERO */
        .page-hero {
            position: relative;
            overflow: hidden;
            text-align: center;
            padding: 72px 0 64px;
            background:
                radial-gradient(700px 400px at 90% 0, rgba(127, 21, 49, .10), transparent 60%),
                radial-gradient(600px 360px at 0 100%, rgba(15, 76, 74, .12), transparent 60%),
                var(--paper);
        }

        .page-hero h2 {
            font-size: clamp(2rem, 4vw, 3rem);
            color: var(--teal-deep);
            margin-bottom: 14px;
        }

        .page-hero h2 em {
            font-style: normal;
            color: var(--brand);
            background: linear-gradient(transparent 68%, var(--amber-soft) 68%);
        }

        .page-hero p {
            max-width: 62ch;
            margin: 0 auto;
            color: var(--muted);
            font-size: 1.08rem;
        }

        .crumbs {
            display: inline-flex;
            gap: 8px;
            font-size: .88rem;
            color: var(--muted);
            margin-bottom: 18px;
        }

        .crumbs a {
            color: var(--brand);
            font-weight: 600;
        }

        /* FILTER */
        .g-filter {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            margin-bottom: 40px;
        }

        .g-filter button {
            font: inherit;
            font-size: .95rem;
            font-weight: 600;
            cursor: pointer;
            background: #fff;
            color: var(--teal-deep);
            border: 1px solid var(--line);
            border-radius: 999px;
            padding: 9px 22px;
            transition: .25s;
        }

        .g-filter button:hover {
            border-color: var(--brand);
            color: var(--brand);
        }

        .g-filter button.active {
            background: var(--brand);
            border-color: var(--brand);
            color: #fff;
            box-shadow: var(--shadow);
        }

        .g-filter button:focus-visible,
        .g-item:focus-visible,
        .lb button:focus-visible {
            outline: 3px solid var(--amber);
            outline-offset: 3px;
        }

        .g-filter .count {
            font-weight: 400;
            opacity: .75;
            margin-left: 4px;
        }

        /* GALLERY GRID */
        .g-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-auto-rows: 210px;
            grid-auto-flow: dense;
            gap: 18px;
        }

        .g-item {
            position: relative;
            overflow: hidden;
            border-radius: 22px;
            border: 0;
            padding: 0;
            cursor: pointer;
            background: var(--brand-dark);
            box-shadow: var(--shadow);
            text-align: left;
            font: inherit;
            color: #fff;
        }

        .g-item.wide {
            grid-column: span 2;
        }

        .g-item.tall {
            grid-row: span 2;
        }

        .g-item.hide {
            display: none;
        }

        .g-item img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .5s;
        }

        .g-item:hover img {
            transform: scale(1.06);
        }

        .g-ph {
            position: absolute;
            inset: 0;
            display: grid;
            place-items: center;
            font-size: 3.2rem;
        }

        .g-item[data-cat="campus"] .g-ph,
        .g-item[data-cat="hifz"] .g-ph {
            background: linear-gradient(160deg, var(--teal), var(--teal-deep));
        }

        .g-item[data-cat="class"] .g-ph,
        .g-item[data-cat="program"] .g-ph {
            background: linear-gradient(160deg, var(--brand), var(--brand-dark));
        }

        .g-item[data-cat="sports"] .g-ph {
            background: linear-gradient(160deg, var(--brand-light), var(--brand-dark));
        }

        .g-ph::after {
            content: "";
            position: absolute;
            right: -30px;
            top: -40px;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: rgba(226, 169, 59, .18);
        }

        .g-cap {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            padding: 44px 18px 16px;
            background: linear-gradient(transparent, rgba(0, 0, 0, .72));
            opacity: 0;
            transform: translateY(10px);
            transition: .3s;
        }

        .g-item:hover .g-cap,
        .g-item:focus-visible .g-cap {
            opacity: 1;
            transform: none;
        }

        .g-cap strong {
            display: block;
            font-size: 1.02rem;
            color: var(--amber-soft);
        }

        .g-cap span {
            font-size: .82rem;
            color: #f6dfe5;
        }

        .g-empty {
            display: none;
            text-align: center;
            color: var(--muted);
            padding: 40px 0;
        }

        /* LIGHTBOX */
        .lb {
            position: fixed;
            inset: 0;
            z-index: 9999;
            display: none;
            align-items: center;
            justify-content: center;
            background: rgba(10, 20, 20, .9);
            padding: 24px;
        }

        .lb.open {
            display: flex;
        }

        .lb-box {
            max-width: 920px;
            width: 100%;
            text-align: center;
            color: #fff;
        }

        /* HTML SLIDES */
        .lb-slide {
            display: none;
        }

        .lb-slide.active {
            display: block;
        }

        .lb-stage {
            position: relative;
            aspect-ratio: 16/10;
            border-radius: 22px;
            overflow: hidden;
            background: var(--brand-dark);
            display: grid;
            place-items: center;
            font-size: 5rem;
        }

        .lb-stage img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: contain;
            background: #000;
        }

        .lb-box h4 {
            color: var(--amber-soft);
            font-size: 1.3rem;
            margin: 18px 0 4px;
        }

        .lb-box p {
            color: #f6dfe5;
            font-size: .95rem;
            margin: 0 auto;
            max-width: 60ch;
        }

        .lb-count {
            display: block;
            margin-top: 10px;
            font-size: .85rem;
            color: rgba(255, 255, 255, .6);
        }

        .lb button {
            position: absolute;
            background: rgba(255, 255, 255, .14);
            color: #fff;
            border: 0;
            border-radius: 50%;
            width: 48px;
            height: 48px;
            font-size: 1.4rem;
            cursor: pointer;
            transition: .25s;
        }

        .lb button:hover {
            background: var(--brand);
        }

        .lb .close {
            top: 20px;
            right: 20px;
        }

        .lb .prev {
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
        }

        .lb .next {
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
        }

        /* CTA */
        .cta-banner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        /* RESPONSIVE */
        @media (max-width:980px) {
            .g-grid {
                grid-template-columns: repeat(2, 1fr);
                grid-auto-rows: 190px;
            }
        }

        @media (max-width:640px) {
            .page-hero {
                padding: 56px 0;
            }

            .g-grid {
                gap: 12px;
                grid-auto-rows: 150px;
            }

            .g-item.wide {
                grid-column: span 2;
            }

            .g-cap {
                opacity: 1;
                transform: none;
                padding-top: 30px;
            }

            .g-cap span {
                display: none;
            }

            .lb .prev {
                left: 8px;
            }

            .lb .next {
                right: 8px;
            }

            .lb button {
                width: 42px;
                height: 42px;
            }

            .lb {
                padding: 12px;
            }

            .lb-stage {
                aspect-ratio: 4/3;
            }

            .cta-banner {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media (prefers-reduced-motion:reduce) {

            .g-item img,
            .g-cap {
                transition: none;
            }
        }
    </style>


    {{-- PAGE HERO --}}
    <section class="page-hero">
        <div class="container">

            <div class="crumbs">
                <a href="{{ url('/') }}">হোম</a>
                <span>›</span>
                <span>গ্যালারি</span>
            </div>

            <span class="eyebrow" style="display:block;width:max-content;margin:0 auto 22px;">
                ক্যাম্পাসের মুহূর্তগুলো
            </span>

            <h2>আমাদের <em>গ্যালারি</em></h2>

            <p>
                ক্লাসরুম, হিফয শুনানি, অনুষ্ঠান ও খেলাধুলা—
                নিদাউল কুরআন মাদরাসার প্রতিদিনের কিছু ছবি।
            </p>

        </div>
    </section>

    <div class="star-divider dark"></div>


    {{-- GALLERY SECTION --}}
    <section id="gallery">
        <div class="container">
            {{-- CATEGORY FILTER --}}
            <div class="g-filter" role="tablist" aria-label="ছবির বিভাগ">
                <button type="button" class="active" data-filter="all">
                    সব ছবি <span class="count">(১২)</span>
                </button>
                <button type="button" data-filter="campus">
                    ক্যাম্পাস <span class="count">(৩)</span>
                </button>
                <button type="button" data-filter="class">
                    ক্লাসরুম <span class="count">(২)</span>
                </button>
                <button type="button" data-filter="hifz">
                    হিফয বিভাগ <span class="count">(২)</span>
                </button>
                <button type="button" data-filter="program">
                    অনুষ্ঠান <span class="count">(৩)</span>
                </button>
                <button type="button" data-filter="sports">
                    খেলাধুলা <span class="count">(২)</span>
                </button>
            </div>
            {{-- GALLERY HTML CONTENT --}}
            <div class="g-grid" id="gGrid">
                <button type="button" class="g-item wide" data-cat="campus" data-index="0">
                    <div class="g-ph">🏛️</div>
                    <div class="g-cap">
                        <strong>মাদরাসার প্রধান ফটক</strong>
                        <span>ক্যাম্পাস</span>
                    </div>
                </button>
                <button type="button" class="g-item" data-cat="class" data-index="1">
                    <div class="g-ph">🎓</div>
                    <div class="g-cap">
                        <strong>জেনারেল ক্লাস</strong>
                        <span>ক্লাসরুম</span>
                    </div>
                </button>
                <button type="button" class="g-item tall" data-cat="hifz" data-index="2">
                    <div class="g-ph">📖</div>
                    <div class="g-cap">
                        <strong>হিফয শুনানি</strong>
                        <span>হিফয বিভাগ</span>
                    </div>
                </button>
                <button type="button" class="g-item" data-cat="program" data-index="3">
                    <div class="g-ph">🎙️</div>
                    <div class="g-cap">
                        <strong>কিরাত প্রতিযোগিতা</strong>
                        <span>অনুষ্ঠান</span>
                    </div>
                </button>
                <button type="button" class="g-item" data-cat="sports" data-index="4">
                    <div class="g-ph">🏃</div>
                    <div class="g-cap">
                        <strong>বার্ষিক ক্রীড়া</strong>
                        <span>খেলাধুলা</span>
                    </div>
                </button>
                <button type="button" class="g-item wide" data-cat="class" data-index="5">
                    <div class="g-ph">🔤</div>
                    <div class="g-cap">
                        <strong>নুরানি ক্লাস</strong>
                        <span>ক্লাসরুম</span>
                    </div>
                </button>
                <button type="button" class="g-item" data-cat="campus" data-index="6">
                    <div class="g-ph">📚</div>
                    <div class="g-cap">
                        <strong>লাইব্রেরি কর্নার</strong>
                        <span>ক্যাম্পাস</span>
                    </div>
                </button>
                <button type="button" class="g-item" data-cat="hifz" data-index="7">
                    <div class="g-ph">🤲</div>
                    <div class="g-cap">
                        <strong>হিফয রিভিশন</strong>
                        <span>হিফয বিভাগ</span>
                    </div>
                </button>
                <button type="button" class="g-item tall" data-cat="program" data-index="8">
                    <div class="g-ph">👨‍👩‍👧</div>
                    <div class="g-cap">
                        <strong>অভিভাবক সমাবেশ</strong>
                        <span>অনুষ্ঠান</span>
                    </div>
                </button>
                <button type="button" class="g-item" data-cat="program" data-index="9">
                    <div class="g-ph">🎨</div>
                    <div class="g-cap">
                        <strong>চিত্রাঙ্কন ও হাতের লেখা</strong>
                        <span>অনুষ্ঠান</span>
                    </div>
                </button>
                <button type="button" class="g-item wide" data-cat="sports" data-index="10">
                    <div class="g-ph">⚽</div>
                    <div class="g-cap">
                        <strong>খেলার মাঠ</strong>
                        <span>খেলাধুলা</span>
                    </div>
                </button>
                <button type="button" class="g-item" data-cat="campus" data-index="11">
                    <div class="g-ph">🛡️</div>
                    <div class="g-cap">
                        <strong>নিরাপত্তা ব্যবস্থা</strong>
                        <span>ক্যাম্পাস</span>
                    </div>
                </button>
            </div>
            <p class="g-empty" id="gEmpty">
                এই বিভাগে এখনো কোনো ছবি যোগ করা হয়নি।
            </p>
        </div>
    </section>
    {{-- CTA BANNER --}}
    <section style="padding-top:0;">
        <div class="cta-banner">
            <div>
                <h3>নিজের চোখে ক্যাম্পাস দেখতে চান?</h3>
                <p> সরাসরি ক্যাম্পাসে এসে পরিবেশ দেখুন এবং ভর্তি সংক্রান্ত তথ্য জেনে নিন।
                </p>
            </div>
            <a href="{{ route('contact') }}" class="btn btn-gold">
                যোগাযোগ করুন →
            </a>
        </div>
    </section>


    {{-- LIGHTBOX: ALL CONTENT IN HTML --}}
    <div class="lb" id="lb" role="dialog" aria-modal="true" aria-label="ছবি দেখুন">

        <button type="button" class="close" id="lbClose" aria-label="বন্ধ করুন">
            ✕
        </button>
        <button type="button" class="prev" id="lbPrev" aria-label="আগের ছবি">
            ‹
        </button>
        <button type="button" class="next" id="lbNext" aria-label="পরের ছবি">
            ›
        </button>
        <div class="lb-box">
            <div class="lb-slide" data-index="0" data-cat="campus">
                <div class="lb-stage">🏛️</div>
                <h4>মাদরাসার প্রধান ফটক</h4>
                <p>সকালের আলোয় নিদাউল কুরআন মাদরাসা ক্যাম্পাস।</p>
            </div>

            <div class="lb-slide" data-index="1" data-cat="class">
                <div class="lb-stage">🎓</div>
                <h4>জেনারেল ক্লাস</h4>
                <p>বোর্ড নির্ধারিত সিলেবাসে শ্রেণিভিত্তিক পাঠদান।</p>
            </div>

            <div class="lb-slide" data-index="2" data-cat="hifz">
                <div class="lb-stage">📖</div>
                <h4>হিফয শুনানি</h4>
                <p>প্রতিদিন নিয়ম করে উস্তাযকে শুনানি।</p>
            </div>

            <div class="lb-slide" data-index="3" data-cat="program">
                <div class="lb-stage">🎙️</div>
                <h4>কিরাত প্রতিযোগিতা</h4>
                <p>শিক্ষার্থীদের তিলাওয়াত প্রতিযোগিতার মুহূর্ত।</p>
            </div>

            <div class="lb-slide" data-index="4" data-cat="sports">
                <div class="lb-stage">🏃</div>
                <h4>বার্ষিক ক্রীড়া</h4>
                <p>ক্রীড়া প্রতিযোগিতায় শিক্ষার্থীদের অংশগ্রহণ।</p>
            </div>

            <div class="lb-slide" data-index="5" data-cat="class">
                <div class="lb-stage">🔤</div>
                <h4>নুরানি ক্লাস</h4>
                <p>ছোটদের জন্য নুরানি পদ্ধতিতে আনন্দময় শিক্ষা।</p>
            </div>

            <div class="lb-slide" data-index="6" data-cat="campus">
                <div class="lb-stage">📚</div>
                <h4>লাইব্রেরি কর্নার</h4>
                <p>পড়ার জন্য শান্ত ও পরিচ্ছন্ন পরিবেশ।</p>
            </div>

            <div class="lb-slide" data-index="7" data-cat="hifz">
                <div class="lb-stage">🤲</div>
                <h4>হিফয রিভিশন</h4>
                <p>বিশেষ রুটিনে নিয়মিত পুনরালোচনা।</p>
            </div>

            <div class="lb-slide" data-index="8" data-cat="program">
                <div class="lb-stage">👨‍👩‍👧</div>
                <h4>অভিভাবক সমাবেশ</h4>
                <p>অভিভাবকদের সাথে মতবিনিময় সভা।</p>
            </div>

            <div class="lb-slide" data-index="9" data-cat="program">
                <div class="lb-stage">🎨</div>
                <h4>চিত্রাঙ্কন ও হাতের লেখা</h4>
                <p>সৃজনশীলতা বিকাশে চিত্রাঙ্কন ও হাতের লেখা প্রতিযোগিতা।</p>
            </div>

            <div class="lb-slide" data-index="10" data-cat="sports">
                <div class="lb-stage">⚽</div>
                <h4>খেলার মাঠ</h4>
                <p>শারীরিক বিকাশে খেলাধুলার সুযোগ।</p>
            </div>

            <div class="lb-slide" data-index="11" data-cat="campus">
                <div class="lb-stage">🛡️</div>
                <h4>নিরাপত্তা ব্যবস্থা</h4>
                <p>সিসিটিভির মাধ্যমে সার্বক্ষণিক নজরদারি।</p>
            </div>

            <span class="lb-count" id="lbCount"></span>

        </div>
    </div>


    {{-- JAVASCRIPT: ONLY FILTER AND LIGHTBOX CONTROL --}}
    <script>
        (function () {

            const items = Array.from(document.querySelectorAll('.g-item'));
            const slides = Array.from(document.querySelectorAll('.lb-slide'));
            const tabs = document.querySelectorAll('.g-filter button');

            const empty = document.getElementById('gEmpty');
            const lb = document.getElementById('lb');

            const closeBtn = document.getElementById('lbClose');
            const prevBtn = document.getElementById('lbPrev');
            const nextBtn = document.getElementById('lbNext');
            const count = document.getElementById('lbCount');

            let current = 0;
            let lastFocus = null;

            // Bengali Number
            function bn(number) {
                return String(number).replace(/\d/g, function (digit) {
                    return '০১২৩৪৫৬৭৮৯'[digit];
                });
            }

            // Visible Slides
            function visibleSlides() {
                return slides.filter(function (slide) {
                    return !slide.classList.contains('hide');
                });
            }

            // Show Lightbox Slide
            function show(index) {
                const visible = visibleSlides();
                if (!visible.length) return;
                current = (index + visible.length) % visible.length;
                slides.forEach(function (slide) {
                    slide.classList.remove('active');
                });
                visible[current].classList.add('active');
                count.textContent = bn(current + 1) + ' / ' + bn(visible.length);
            }
            // Category Filter
            tabs.forEach(function (tab) {
                tab.addEventListener('click', function () {
                    tabs.forEach(function (button) {
                        button.classList.remove('active');
                    });
                    tab.classList.add('active');
                    const filter = tab.dataset.filter;
                    items.forEach(function (item) {
                        const hide = filter !== 'all' &&
                            item.dataset.cat !== filter;
                        item.classList.toggle('hide', hide);
                    });
                    slides.forEach(function (slide) {
                        const hide = filter !== 'all' &&
                            slide.dataset.cat !== filter;
                        slide.classList.toggle('hide', hide);
                        slide.classList.remove('active');

                    });
                    const visible = visibleSlides();
                    empty.style.display = visible.length ? 'none' : 'block';

                });

            });

            // Open Lightbox
            function openLightbox(item) {
                lastFocus = item;
                const index = Number(item.dataset.index);
                const visible = visibleSlides();
                const position = visible.findIndex(function (slide) {
                    return Number(slide.dataset.index) === index;
                });
                if (position === -1) return;
                show(position);
                lb.classList.add('open');
                document.body.style.overflow = 'hidden';
                closeBtn.focus();
            }
            function closeLightbox() {
                lb.classList.remove('open');
                document.body.style.overflow = '';
                slides.forEach(function (slide) {
                    slide.classList.remove('active');
                });
                if (lastFocus) {
                    lastFocus.focus();
                }
            }
            items.forEach(function (item) {
                item.addEventListener('click', function () {
                    openLightbox(item);
                });
            });
            // Close Button
            closeBtn.addEventListener('click', closeLightbox);
            // Previous Image
            prevBtn.addEventListener('click', function () {
                show(current - 1);
            });
            // Next Image
            nextBtn.addEventListener('click', function () {
                show(current + 1);
            });
            // Outside Click
            lb.addEventListener('click', function (event) {
                if (event.target === lb) {
                    closeLightbox();
                }
            });
            // Keyboard Navigation
            document.addEventListener('keydown', function (event) {
                if (!lb.classList.contains('open')) return;
                if (event.key === 'Escape') {
                    closeLightbox();
                }
                if (event.key === 'ArrowLeft') {
                    show(current - 1);
                }
                if (event.key === 'ArrowRight') {
                    show(current + 1);
                }
            });

        })();
    </script>

@endsection