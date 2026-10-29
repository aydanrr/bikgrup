<?php
/**
 * BİKGRUP - Anasayfa Şablonu
 * Çizgisel Çerçeve & Global Dünya İhracat Haritası
 */

declare(strict_types=1);

$currentLang = Lang::current();
?>

<!-- ========================================================================
     GÖRSELDEKİ BİREBİR ÇİZGİSEL MİMARİ HERO GİRİŞ ALANI (ADLER STYLE)
     ======================================================================== -->
<section class="adler-hero-viewport">
    
    <!-- Tam Ekran Yazısız Doğa & Teras Manzarası Afişi -->
    <img src="<?= BASE_URL ?>/public/images/nature_hero_bg.jpg" alt="BİKGRUP Doğa ve Tarım Arazileri" class="adler-bg-poster" loading="eager">
    <div class="adler-vignette"></div>

    <!-- İkonik Beyaz Çizgisel Çerçeve -->
    <div class="adler-contour-frame">
        
        <!-- Çerçevenin Üst Sınırı: Entegre Minimal Header -->
        <div class="adler-top-header">
            <a href="<?= BASE_URL ?>/" class="adler-logo">
                <span>BİKGRUP</span>
            </a>

            <nav class="adler-nav-menu">
                <a href="<?= BASE_URL ?>/" class="adler-nav-link"><?= __('nav_home') ?></a>
                <a href="<?= BASE_URL ?>/kurumsal" class="adler-nav-link"><?= __('nav_about') ?></a>
                <a href="<?= BASE_URL ?>/urunler" class="adler-nav-link"><?= __('nav_products') ?></a>
                <a href="<?= BASE_URL ?>/kurumsal#sertifikalar" class="adler-nav-link"><?= __('nav_quality') ?></a>
                <a href="<?= BASE_URL ?>/blog" class="adler-nav-link"><?= __('nav_blog') ?></a>
                <a href="<?= BASE_URL ?>/iletisim" class="adler-nav-link"><?= __('nav_contact') ?></a>
            </nav>

            <div class="adler-lang-pill">
                <a href="<?= Lang::switchUrl('tr') ?>" class="adler-lang-item <?= $currentLang === 'tr' ? 'active' : '' ?>">TR</a>
                <a href="<?= Lang::switchUrl('en') ?>" class="adler-lang-item <?= $currentLang === 'en' ? 'active' : '' ?>">EN</a>
            </div>

            <button class="mobile-toggle" aria-label="Menü">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>
        </div>

        <!-- Çerçevenin Orta/Sol Alanı: Dikey 3 Sütun ve Beyaz Kart -->
        <div class="adler-middle-section">
            <div class="adler-columns-group">
                
                <!-- 1. Sütun: Beyaz Özel Kart -->
                <a href="<?= BASE_URL ?>/urunler?kategori=narenciye&scroll=vitrin" class="adler-white-card">
                    <div class="adler-card-icon">🍊</div>
                    <div class="adler-card-title"><?= __('cat_citrus') ?></div>
                    
                    <div class="adler-card-meta">HASAT SEZONU</div>
                    <div class="adler-card-val">Ekim - Mayıs</div>
                    
                    <div class="adler-card-meta">İHRACAT HACMİ</div>
                    <div class="adler-card-val">50.000+ Ton</div>

                    <div class="adler-card-divider"></div>
                    <div class="adler-card-more">
                        <span>Daha Fazla</span>
                        <span style="font-size: 16px;">→</span>
                    </div>
                </a>

                <!-- 2. Sütun: Çizgisel Yarı Saydam Sütun (Meyveler) -->
                <a href="<?= BASE_URL ?>/urunler?kategori=meyveler&scroll=vitrin" class="adler-glass-col">
                    <div class="adler-card-icon">🍇</div>
                    <div class="adler-card-title"><?= __('cat_fruits') ?></div>
                    
                    <div class="adler-card-meta">HASAT SEZONU</div>
                    <div class="adler-card-val">Tüm Yıl</div>
                    
                    <div class="adler-card-meta">İHRACAT HACMİ</div>
                    <div class="adler-card-val">60.000+ Ton</div>

                    <div class="adler-card-divider"></div>
                    <div class="adler-card-more">
                        <span>İncele</span>
                        <span>+</span>
                    </div>
                </a>

                <!-- 3. Sütun: Çizgisel Yarı Saydam Sütun (Sebzeler) -->
                <a href="<?= BASE_URL ?>/urunler?kategori=sebzeler&scroll=vitrin" class="adler-glass-col">
                    <div class="adler-card-icon">🥦</div>
                    <div class="adler-card-title"><?= __('cat_vegetables') ?></div>
                    
                    <div class="adler-card-meta">HASAT SEZONU</div>
                    <div class="adler-card-val">Dört Mevsim</div>
                    
                    <div class="adler-card-meta">İHRACAT HACMİ</div>
                    <div class="adler-card-val">40.000+ Ton</div>

                    <div class="adler-card-divider"></div>
                    <div class="adler-card-more">
                        <span>İncele</span>
                        <span>+</span>
                    </div>
                </a>

            </div>
        </div>

        <!-- Çerçevenin Alt Sınırı: Devasa Tipografi (Kullanıcı İsteği: Scroll Down ve Sağdaki 2 Cam Buton Kaldırıldı) -->
        <div class="adler-bottom-section" style="justify-content: flex-end;">
            
            <div class="adler-title-group">
                <h1 class="adler-mega-title">
                    Doğadan<br>Dünyaya.
                </h1>

                <div class="adler-sub-group">
                    <div class="adler-sub-heading">
                        BİKGRUP Hakkında
                    </div>
                    <div class="adler-sub-desc">
                        Akdeniz ve Ege'nin en verimli topraklarında yetişen taze narenciye, meyve ve sebzeleri yüksek teknoloji tesislerimizde işleyerek 30'dan fazla ülkeye ulaştırıyoruz.
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- ========================================================================
     YENİ: GÖRSELDEKİ BİREBİR KÜRESEL DÜNYA İHRACAT HARİTASI (COUNTERS ALANI)
     ======================================================================== -->
<!-- ========================================================================
     1. ÖNE ÇIKAN ÜRÜNLER VİTRİNİ (KULLANICI TALEBİ: GİRİŞTEN HEMEN SONRA)
     4 ADET, TASARIM BOZULMADAN AYNI ORANDA BÜYÜTÜLMÜŞ & DİKKAT ÇEKİCİ
     ======================================================================== -->
<section class="section home-featured-section" style="background: rgba(15, 23, 42, 0.02); padding-top: 60px; padding-bottom: 70px;">
    <div class="container">
        
        <div style="text-align: center; max-width: 640px; margin: 0 auto 55px auto;" class="reveal">
            <span style="font-size: 13px; font-weight: 800; color: var(--theme-primary); letter-spacing: 1.5px; text-transform: uppercase;">Taze Mahsuller</span>
            <h2 style="font-family: var(--font-heading); font-size: 38px; font-weight: 800; color: var(--theme-text); margin-top: 6px;">
                <?= __('sec_featured_products') ?>
            </h2>
            <p style="color: var(--theme-text-muted); font-size: 16px;">
                Dünya pazarlarında en çok talep gören yüksek standartlı sofralık ürünlerimiz.
            </p>
        </div>

        <?php $homeFeatured = array_slice($featuredProducts, 0, 4); ?>
        <div class="popout-products-grid home-featured-grid">
            <?php foreach ($homeFeatured as $index => $prod): ?>
                <div class="popout-product-card home-featured-card card-color-<?= ($index % 4) + 1 ?> reveal reveal-delay-<?= $index + 1 ?>">
                    <!-- Karttan Dışarı Taşan 3 Boyutlu Ürün Görseli (Orantılı Büyütülmüş) -->
                    <a href="<?= BASE_URL ?>/urunler/<?= urlencode($prod['slug']) ?>" class="popout-img-wrapper">
                        <img src="<?= BASE_URL ?>/public/images/<?= htmlspecialchars($prod['image'] ?: 'product_orange.png') ?>" 
                             alt="<?= htmlspecialchars($prod['name_' . $currentLang] ?? $prod['name_tr']) ?>" 
                             class="popout-floating-img" 
                             loading="lazy">
                    </a>

                    <!-- Kart Alt İçeriği: Ürün İsimleri & Sağ Altta Çapraz Ok Butonu -->
                    <div class="popout-card-bottom">
                        <div class="popout-card-text">
                            <span class="popout-card-prefix"><?= $currentLang === 'en' ? 'Fresh & Premium' : 'Taze & Doğal' ?></span>
                            <h3 class="popout-card-title">
                                <a href="<?= BASE_URL ?>/urunler/<?= urlencode($prod['slug']) ?>">
                                    <?= htmlspecialchars($prod['name_' . $currentLang] ?? $prod['name_tr']) ?>
                                </a>
                            </h3>
                        </div>

                        <!-- Sayı yerine çapraz ok işareti olan dairesel buton -->
                        <a href="<?= BASE_URL ?>/urunler/<?= urlencode($prod['slug']) ?>" class="popout-circle-btn" aria-label="<?= htmlspecialchars($prod['name_' . $currentLang] ?? $prod['name_tr']) ?> İncele">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="7" y1="17" x2="17" y2="7"></line>
                                <polyline points="7 7 17 7 17 17"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div style="text-align: center; margin-top: 55px;" class="reveal">
            <a href="<?= BASE_URL ?>/urunler" class="btn btn-outline" style="padding: 14px 36px; font-weight: 700;">
                <?= __('btn_all_products') ?> →
            </a>
        </div>

    </div>
</section>

<!-- ========================================================================
     2. GÖRSELDEKİ KÜRESEL DÜNYA İHRACAT HARİTASI (YEŞİL & TURUNCU TONLARI)
     ======================================================================== -->
<section class="global-map-section section" style="padding-top: 70px;">
    <div class="container">
        
        <!-- Üst Başlık (Yeşil Vurgu - Kullanıcı Talebi) -->
        <div class="map-header-block reveal">
            <h2 class="map-heading">
                Akdeniz'den Dünyaya Ulaşan <span class="highlight-green">Kesintisiz İhracat Ağı</span>
            </h2>
            <p class="map-subtext">
                Türkiye'nin en bereketli bahçelerinden 4 kıtada 30'u aşkın ülkenin sofrasına taze lezzet köprüsü kuruyoruz.
            </p>
        </div>

        <!-- İnteraktif Dünya Haritası ve Kavisli Rotalar -->
        <div class="world-map-stage reveal">
            
            <!-- Noktasal Vektörel Dünya Haritası SVG & Kavisli Rotalar (Yeşil & Turuncu) -->
            <svg class="world-map-svg" viewBox="0 0 1000 480" fill="none" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <!-- Yeşil Degrade (Avrupa & İskandinavya) -->
                    <linearGradient id="curveGrad1" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#15803d" stop-opacity="0.2"/>
                        <stop offset="50%" stop-color="#22c55e" stop-opacity="0.85"/>
                        <stop offset="100%" stop-color="#15803d" stop-opacity="0.2"/>
                    </linearGradient>
                    <!-- Turuncu Degrade (Rusya & Asya) -->
                    <linearGradient id="curveGrad2" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#ea580c" stop-opacity="0.2"/>
                        <stop offset="50%" stop-color="#f97316" stop-opacity="0.85"/>
                        <stop offset="100%" stop-color="#ea580c" stop-opacity="0.2"/>
                    </linearGradient>
                    <!-- Yeşil-Turuncu Geçiş Degrade (Körfez & Amerika) -->
                    <linearGradient id="curveGrad3" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#16a34a" stop-opacity="0.2"/>
                        <stop offset="50%" stop-color="#f59e0b" stop-opacity="0.85"/>
                        <stop offset="100%" stop-color="#ea580c" stop-opacity="0.2"/>
                    </linearGradient>
                    <!-- Yeşil Merkez Parlaması -->
                    <radialGradient id="hubGlow" cx="50%" cy="50%" r="50%">
                        <stop offset="0%" stop-color="#22c55e" stop-opacity="0.85"/>
                        <stop offset="100%" stop-color="#22c55e" stop-opacity="0"/>
                    </radialGradient>
                </defs>

                <!-- Noktasal Kıta Siluetleri (Arka Plan) -->
                <g class="map-continents" fill="#cbd5e1" opacity="0.45">
                    <!-- Avrupa & Akdeniz -->
                    <circle cx="510" cy="180" r="3"/><circle cx="525" cy="170" r="2.5"/><circle cx="540" cy="165" r="3"/><circle cx="550" cy="180" r="3"/><circle cx="530" cy="195" r="3.5"/><circle cx="515" cy="210" r="3"/><circle cx="535" cy="220" r="3.5"/><circle cx="560" cy="205" r="3"/>
                    <circle cx="500" cy="160" r="3"/><circle cx="490" cy="150" r="2.5"/><circle cx="480" cy="165" r="3"/><circle cx="495" cy="175" r="3"/><circle cx="475" cy="185" r="3"/><circle cx="485" cy="200" r="2.5"/>
                    <!-- Rusya & Asya -->
                    <circle cx="580" cy="150" r="3"/><circle cx="610" cy="140" r="3.5"/><circle cx="640" cy="145" r="3"/><circle cx="670" cy="155" r="3.5"/><circle cx="700" cy="160" r="3"/><circle cx="730" cy="165" r="3.5"/><circle cx="760" cy="180" r="3"/><circle cx="790" cy="190" r="3.5"/>
                    <circle cx="600" cy="175" r="3"/><circle cx="630" cy="180" r="3.5"/><circle cx="660" cy="190" r="3"/><circle cx="690" cy="200" r="3.5"/><circle cx="720" cy="215" r="3"/><circle cx="750" cy="230" r="3"/>
                    <!-- Ortadoğu & Körfez -->
                    <circle cx="570" cy="225" r="3.5"/><circle cx="585" cy="235" r="3"/><circle cx="600" cy="245" r="3.5"/><circle cx="615" cy="255" r="3"/><circle cx="630" cy="265" r="3.5"/>
                    <!-- Afrika -->
                    <circle cx="510" cy="260" r="3.5"/><circle cx="530" cy="275" r="3"/><circle cx="520" cy="300" r="3.5"/><circle cx="545" cy="320" r="3"/><circle cx="535" cy="350" r="3.5"/><circle cx="550" cy="380" r="3"/>
                    <!-- Kuzey Amerika -->
                    <circle cx="210" cy="150" r="3.5"/><circle cx="240" cy="140" r="3"/><circle cx="270" cy="145" r="3.5"/><circle cx="300" cy="160" r="3"/><circle cx="230" cy="175" r="3.5"/><circle cx="260" cy="180" r="3"/><circle cx="290" cy="195" r="3.5"/><circle cx="220" cy="210" r="3"/><circle cx="250" cy="225" r="3.5"/>
                    <!-- Güney Amerika -->
                    <circle cx="310" cy="290" r="3.5"/><circle cx="330" cy="310" r="3"/><circle cx="340" cy="340" r="3.5"/><circle cx="330" cy="370" r="3"/><circle cx="320" cy="400" r="3"/>
                </g>

                <!-- Merkez Üs: TÜRKİYE / ANTALYA (x: 550, y: 200) - Yeşil & Turuncu Hub -->
                <circle cx="550" cy="200" r="18" fill="url(#hubGlow)"/>
                <circle cx="550" cy="200" r="6" fill="#16a34a" stroke="#ffffff" stroke-width="2"/>
                <circle cx="550" cy="200" r="10" stroke="#f97316" stroke-width="1.6" stroke-dasharray="3 3" class="anim-spin-slow"/>

                <!-- Kavisli İhracat Uçuş Rotaları (Türkiye Merkezli Dünyaya Yayılan Yaylar) -->
                <!-- 1. Rota: Türkiye -> Batı Avrupa (Yeşil Tonu) -->
                <path d="M 550 200 Q 520 120 480 165" stroke="url(#curveGrad1)" stroke-width="2.2" stroke-linecap="round" fill="none" class="route-animated"/>
                <circle cx="480" cy="165" r="4.5" fill="#22c55e"/>

                <!-- 2. Rota: Türkiye -> Kuzey & İskandinavya (Yeşil Tonu) -->
                <path d="M 550 200 Q 535 90 515 130" stroke="url(#curveGrad1)" stroke-width="2" stroke-linecap="round" fill="none" class="route-animated"/>
                <circle cx="515" cy="130" r="4" fill="#15803d"/>

                <!-- 3. Rota: Türkiye -> Doğu Avrupa & Rusya (Turuncu Tonu) -->
                <path d="M 550 200 Q 610 100 660 145" stroke="url(#curveGrad2)" stroke-width="2.2" stroke-linecap="round" fill="none" class="route-animated"/>
                <circle cx="660" cy="145" r="4.5" fill="#f97316"/>

                <!-- 4. Rota: Türkiye -> Körfez & Orta Doğu (Yeşil-Turuncu Tonu) -->
                <path d="M 550 200 Q 590 230 620 260" stroke="url(#curveGrad3)" stroke-width="2.2" stroke-linecap="round" fill="none" class="route-animated"/>
                <circle cx="620" cy="260" r="4.5" fill="#16a34a"/>

                <!-- 5. Rota: Türkiye -> Uzak Asya (Turuncu Tonu) -->
                <path d="M 550 200 Q 660 160 760 195" stroke="url(#curveGrad2)" stroke-width="1.8" stroke-linecap="round" fill="none" class="route-animated"/>
                <circle cx="760" cy="195" r="4.5" fill="#ea580c"/>

                <!-- 6. Rota: Türkiye -> Kuzey Amerika (Turuncu Kesikli) -->
                <path d="M 550 200 Q 380 90 270 165" stroke="url(#curveGrad2)" stroke-width="1.8" stroke-linecap="round" stroke-dasharray="4 4" fill="none"/>
                <circle cx="270" cy="165" r="4.5" fill="#f59e0b"/>
            </svg>

            <!-- Harita Üzerinde Konumlanan Modern Yüzen Kapsül Bilgi Kartları (Yeşil & Turuncu Rozetler) -->
            
            <!-- 1. Kart: Yeşil Altıgen Rozetli (Avrupa / Merkez) -->
            <div class="map-floating-capsule capsule-pos-1 anim-float">
                <div class="capsule-icon-box icon-green">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                        <polygon points="12 2 22 8.5 22 15.5 12 22 2 15.5 2 8.5 12 2"/>
                        <path d="M12 22v-6.5"/>
                        <path d="M12 15.5l10-7"/>
                        <path d="M12 15.5l-10-7"/>
                    </svg>
                </div>
                <div class="capsule-content">
                    <span class="capsule-title">30+ Ülkeye İhracat</span>
                    <span class="capsule-subtitle">Avrupa, Rusya & İskandinavya</span>
                </div>
            </div>

            <!-- 2. Kart: Turuncu Altıgen Rozetli (Körfez & Ortadoğu) -->
            <div class="map-floating-capsule capsule-pos-2 anim-float" style="animation-delay: 1.2s;">
                <div class="capsule-icon-box icon-orange">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                        <rect x="2" y="7" width="20" height="14" rx="2" ry="2"/>
                        <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
                    </svg>
                </div>
                <div class="capsule-content">
                    <span class="capsule-title">150.000+ Ton Kapasite</span>
                    <span class="capsule-subtitle">Modern Soğuk Hava Depoları</span>
                </div>
            </div>

            <!-- 3. Kart: Zümrüt/Yeşil Altıgen Rozetli (Global Güvence) -->
            <div class="map-floating-capsule capsule-pos-3 anim-float" style="animation-delay: 2.4s;">
                <div class="capsule-icon-box icon-emerald">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    </svg>
                </div>
                <div class="capsule-content">
                    <span class="capsule-title">%100 Taze & İzlenebilir</span>
                    <span class="capsule-subtitle">GlobalG.A.P. & BRCGS Sertifikalı</span>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- 4. TESİS VE OTOMASYON BÖLÜMÜ -->
<section class="section" style="padding-top: 0;">
    <div class="container">
        <div class="facility-banner reveal">
            <img src="<?= BASE_URL ?>/public/images/facility_automation.jpg" alt="BİKGRUP İleri Teknoloji Tesisleri" class="bg-image">
            <div class="facility-content">
                <span class="facility-badge"><?= __('sec_facility_badge') ?></span>
                <h2 class="facility-title">
                    Sıradan bir işleme tesisi değiliz; otomasyon, izlenebilirlik ve kalite kontrol süreçlerimizle ürünlerimizi daima güvence altında tutuyoruz.
                </h2>
                <p class="facility-desc">
                    Optik kalibrasyon, yapay zekalı leke tarama ve sıfır kalıntı ilkemiz ile tarladan toplanan her bir ürünü uluslararası hijyen standartlarında dünya sofralarına hazırlıyoruz.
                </p>
                <a href="<?= BASE_URL ?>/iletisim" class="btn btn-primary" style="background:#22c55e; color:#0f172a; font-weight:800; padding: 14px 32px;">
                    <?= __('btn_contact_us') ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- 5. BLOG VE HABERLER -->
<section class="section">
    <div class="container">
        
        <div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom: 40px; flex-wrap: wrap; gap: 16px;" class="reveal">
            <div>
                <span style="font-size: 13px; font-weight: 800; color: var(--theme-primary); letter-spacing: 1.5px; text-transform: uppercase;">Sektörel Haberler</span>
                <h2 style="font-family: var(--font-heading); font-size: 36px; font-weight: 800; color: var(--theme-text); margin-top: 4px;">
                    <?= __('sec_blog_title') ?>
                </h2>
            </div>
            <a href="<?= BASE_URL ?>/blog" class="btn btn-outline" style="display:inline-flex;">
                Tüm Makaleler →
            </a>
        </div>

        <div class="blog-grid">
            <?php foreach ($recentPosts as $index => $post): ?>
                <article class="blog-card reveal reveal-delay-<?= $index + 1 ?>">
                    <div class="blog-card-img">
                        <img src="<?= BASE_URL ?>/public/images/<?= htmlspecialchars($post['image'] ?: 'blog_cold_chain.png') ?>" alt="<?= htmlspecialchars($post['title_' . $currentLang] ?? $post['title_tr']) ?>" loading="lazy">
                    </div>
                    <div class="blog-card-body">
                        <div class="blog-meta">
                            <span>⏱ <?= htmlspecialchars($post['read_time']) ?></span>
                            <span>•</span>
                            <span><?= date('d.m.Y', strtotime($post['created_at'])) ?></span>
                        </div>
                        <h3 class="blog-card-title"><?= htmlspecialchars($post['title_' . $currentLang] ?? $post['title_tr']) ?></h3>
                        <p class="blog-card-excerpt"><?= htmlspecialchars($post['excerpt_' . $currentLang] ?? $post['excerpt_tr']) ?></p>
                        <a href="<?= BASE_URL ?>/blog/<?= urlencode($post['slug']) ?>" class="blog-read-more">
                            <?= __('btn_read_more') ?> →
                        </a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>

    </div>
</section>
