<?php
/**
 * BİKGRUP - Kurumsal & Hakkımızda Sayfası
 * SEO Uyumlu Temiz Tasarım
 */

declare(strict_types=1);

$currentLang = Lang::current();
$story = $sections['about_story'] ?? null;
$mission = $sections['mission_vision'] ?? null;
?>

<?php
$hasHero = true;
$GLOBALS['hasHero'] = true;
?>

<!-- ========================================================================
     KURUMSAL - ÇİZGİSEL MİMARİ HERO GİRİŞ ALANI (ORTALANMIŞ & SOL KARTSIZ)
     ======================================================================== -->
<section class="adler-hero-viewport">
    
    <!-- Tam Ekran Modern Tesis & Teknoloji Arka Planı -->
    <img src="<?= BASE_URL ?>/public/images/facility_automation.jpg" alt="BİKGRUP Modern Tesis ve İhracat" class="adler-bg-poster" loading="eager">
    <div class="adler-vignette"></div>

    <!-- İkonik Beyaz Çizgisel Çerçeve (Ortalanmış Mimari) -->
    <div class="adler-contour-frame frame-centered">
        
        <!-- Çerçevenin Üst Sınırı: Entegre Minimal Header -->
        <div class="adler-top-header">
            <a href="<?= BASE_URL ?>/" class="adler-logo">
                <span>BİKGRUP</span>
            </a>

            <nav class="adler-nav-menu">
                <a href="<?= BASE_URL ?>/" class="adler-nav-link"><?= __('nav_home') ?></a>
                <a href="<?= BASE_URL ?>/kurumsal" class="adler-nav-link active"><?= __('nav_about') ?></a>
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

        <!-- Çerçevenin Merkezi: KULLANICI TALEBİ ORTALANMIŞ YAZILAR (SOL KARTLAR KALDIRILDI) -->
        <div class="adler-inner-center-hero">
            <span class="adler-inner-badge"><?= $currentLang === 'en' ? 'Corporate Excellence' : 'BİKGRUP Kurumsal' ?></span>
            <h1 class="adler-inner-mega-title">
                <?= $currentLang === 'en' ? 'Trust & Future.' : 'Güven & Gelecek.' ?>
            </h1>
            <p class="adler-inner-desc">
                <?= $currentLang === 'en' 
                    ? 'Leading the fresh produce export industry for 25 years with our reliable supply chain and sustainable agriculture from fertile soils to world markets.' 
                    : 'Tarladan dünya pazarlarına uzanan güvenilir tedarik zincirimiz ve sürdürülebilir tarım ilkelerimizle 25 yıldır sektörün öncüsüyüz.' ?>
            </p>
            <div class="adler-inner-actions">
                <a href="#hikaye" class="about-pill-btn" style="border-color: #ffffff; color: #ffffff; background: rgba(255,255,255,0.15); backdrop-filter: blur(8px);">
                    <?= $currentLang === 'en' ? 'Learn More ↓' : 'Bizi Tanıyın ↓' ?>
                </a>
            </div>
        </div>

        <!-- Alt Denge Boşluğu -->
        <div style="height: 30px;"></div>

    </div>
</section>

<!-- ========================================================================
     KULLANICI REFERANSI: BÜYÜK DÜZ METİN VE MİSYON & VİZYON ALANI
     ======================================================================== -->
<section class="about-statement-section" id="hikaye">
    <div class="about-statement-container reveal">
        
        <!-- Üst Küçük Soru/Etiket -->
        <div class="about-statement-tag">
            <?= $currentLang === 'en' ? 'What do we do at BİKGRUP?' : 'BİKGRUP\'ta ne yapıyoruz?' ?>
        </div>

        <!-- Birebir Görseldeki Büyük Kalın Düz Metin (Renkli Vurgular) -->
        <h2 class="about-statement-lead">
            <?= $currentLang === 'en' 
                ? 'We process <span class="text-orange">citrus</span> , <span class="text-red">fresh fruits</span> , and nutritious <span class="text-green">vegetables</span> grown in the most fertile soils of the Mediterranean and Aegean in our high-tech facilities and deliver them to all corners of the world.' 
                : 'Akdeniz ve Ege\'nin en verimli topraklarında yetişen <span class="text-orange">narenciye</span> , <span class="text-red">meyveler</span> , ve besleyici <span class="text-green">sebzeler</span> ileri teknoloji tesislerimizde işleyerek dünyanın dört bir yanına ulaştırıyoruz.' ?>
        </h2>

        <!-- KULLANICI TALEBİ: HİKAYEMİZİ ANLATAN NORMAL FORMATTA DÜZ PARAGRAF -->
        <p class="about-statement-story">
            <?= $currentLang === 'en' 
                ? 'With deep-rooted respect for nature, fertile soils, and honest labor, BİKGRUP has been delivering the purest Mediterranean harvest safely to global markets for over 25 years. Through integrated cold chain logistics, rigorous quality controls, and sustainable agricultural partnerships, we ensure that every fruit and vegetable preserves its orchard-fresh taste and high nutritional value all the way to your table.' 
                : 'Toprağa, üreticiye ve doğanın bereketine duyduğumuz derin saygıyla çıktığımız yolculukta, 25 yılı aşkın süredir Akdeniz\'in en taze mahsullerini güvenle sofralara taşıyoruz. Yüksek teknolojiye sahip paketleme tesislerimiz, kesintisiz soğuk zincir lojistiğimiz ve uluslararası gıda güvenliği standartlarımızla, tarladan toplanan her bir ürünü dalındaki tazeliğiyle koruyarak dünya standartlarında sunuyoruz.' ?>
        </p>

        <!-- Keşfet Butonu -->
        <a href="<?= BASE_URL ?>/urunler" class="about-pill-btn">
            <?= $currentLang === 'en' ? 'Discover Products →' : 'Keşfet →' ?>
        </a>

        <!-- İKİ AYRI RENKLİ KUTUCUK, İÇİNDE ÇİZGİSEL KARE VE SADECE YAZI (İKONSUZ) -->
        <div class="mv-boxes-grid reveal reveal-delay-1">
            
            <!-- Misyon Kutusu -->
            <div class="mv-color-box mv-box-mission">
                <div class="mv-box-inner-frame">
                    <span class="mv-box-badge">
                        <?= $currentLang === 'en' ? 'OUR MISSION' : 'MİSYONUMUZ' ?>
                    </span>
                    <p class="mv-box-desc">
                        <?= $currentLang === 'en' 
                            ? 'Preserving the natural goodness of our harvest to deliver premium produce safely to global tables, nourishing the future with sustainable agriculture.' 
                            : 'Topraktan gelen doğallığı koruyarak en taze mahsulleri güvenle dünya pazarlarına sunmak ve sürdürülebilir tarımla geleceği beslemek.' ?>
                    </p>
                </div>
            </div>

            <!-- Vizyon Kutusu -->
            <div class="mv-color-box mv-box-vision">
                <div class="mv-box-inner-frame">
                    <span class="mv-box-badge">
                        <?= $currentLang === 'en' ? 'OUR VISION' : 'VİZYONUMUZ' ?>
                    </span>
                    <p class="mv-box-desc">
                        <?= $currentLang === 'en' 
                            ? 'To represent the agricultural richness of Turkey at the highest quality standard as the world\'s most trusted and inspiring brand in fresh produce.' 
                            : 'Yüksek teknolojili tesislerimiz, çevre dostu üretimimiz ve dijital izlenebilirlikle Türk tarımını global arenada kalitenin ve güvenin simgesi yapmak.' ?>
                    </p>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- Kalite ve Sertifikalar Şeridi -->
<section class="section" id="sertifikalar">
    <div class="container" style="text-align: center;">
        <span class="hero-slide-badge" style="background: rgba(21, 128, 61, 0.1); color: var(--theme-primary);">Uluslararası Sertifikasyon</span>
        <h2 style="font-family: var(--font-heading); font-size: 32px; font-weight: 800; margin-bottom: 40px; color: var(--theme-text);">
            <?= __('sec_certifications') ?>
        </h2>

        <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 20px;" class="reveal">
            <?php 
            $certs = ['GlobalG.A.P.', 'BRCGS Food Safety', 'IFS Food', 'ISO 22000', 'Sedex (SMETA)', 'HACCP'];
            foreach ($certs as $cert): 
            ?>
                <div style="background: #ffffff; border: 1.5px solid #e2e8f0; border-radius: 16px; padding: 18px 28px; font-weight: 700; font-size: 15px; color: var(--theme-text); box-shadow: var(--shadow-sm);">
                    🛡️ <?= htmlspecialchars($cert) ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
