<?php
/**
 * BIKGRUP - Iletisim Sayfasi
 * Adler Tarzi Cizgisel Cerceveli Dashboard & Canli Harita
 */

declare(strict_types=1);

$currentLang = Lang::current();
$whatsapp = Settings::get('site_whatsapp', '+905320000000');
$phone = Settings::get('site_phone', '+90 (242) 555 01 23');
$email = Settings::get('site_email', 'info@bikgrup.com');
$address = Settings::getLocalized('site_address', 'Organize Sanayi Bölgesi 4. Cadde No: 18, Antalya / TÜRKİYE');
$defaultSubject = $_GET['konu'] ?? $_GET['subject'] ?? '';

$hasHero = true;
$GLOBALS['hasHero'] = true;
?>

<!-- ========================================================================
     ILETISIM - CIZGISEL MIMARI HERO & HARITA DASHBOARD (KULLANICI TALEBI)
     ======================================================================== -->
<section class="adler-hero-viewport" style="min-height: calc(100vh - 40px); margin-bottom: 0;">
    
    <!-- Tam Ekran Narenciye & Bahce Arka Plani -->
    <img src="<?= BASE_URL ?>/public/images/citrus_showcase.jpg" alt="BIKGRUP Iletisim ve Global Ofisler" class="adler-bg-poster" loading="eager">
    <div class="adler-vignette"></div>

    <!-- Ikonik Beyaz Cizgisel Cerceve (Ortalanmis Mimari) -->
    <div class="adler-contour-frame frame-centered">
        
        <!-- Cercevenin Ust Siniri: Entegre Minimal Header -->
        <div class="adler-top-header">
            <a href="<?= BASE_URL ?>/" class="adler-logo">
                <span>BIKGRUP</span>
            </a>

            <nav class="adler-nav-menu">
                <a href="<?= BASE_URL ?>/" class="adler-nav-link"><?= __('nav_home') ?></a>
                <a href="<?= BASE_URL ?>/kurumsal" class="adler-nav-link"><?= __('nav_about') ?></a>
                <a href="<?= BASE_URL ?>/urunler" class="adler-nav-link"><?= __('nav_products') ?></a>
                <a href="<?= BASE_URL ?>/kurumsal#sertifikalar" class="adler-nav-link"><?= __('nav_quality') ?></a>
                <a href="<?= BASE_URL ?>/blog" class="adler-nav-link"><?= __('nav_blog') ?></a>
                <a href="<?= BASE_URL ?>/iletisim" class="adler-nav-link active"><?= __('nav_contact') ?></a>
            </nav>

            <div class="adler-lang-pill">
                <a href="<?= Lang::switchUrl('tr') ?>" class="adler-lang-item <?= $currentLang === 'tr' ? 'active' : '' ?>">TR</a>
                <a href="<?= Lang::switchUrl('en') ?>" class="adler-lang-item <?= $currentLang === 'en' ? 'active' : '' ?>">EN</a>
            </div>

            <button class="mobile-toggle" aria-label="Menu">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>
        </div>

        <!-- Çerçevenin Merkezi: BAŞLIK, KÜÇÜK DİKDÖRTGEN İLETİŞİM KARTLARI VE HARİTA KUTUSU -->
        <div class="adler-inner-center-hero" style="max-width: 1040px; padding: 15px 20px 5px;">
            <span class="adler-inner-badge"><?= __('nav_contact') ?></span>
            <h1 class="adler-inner-mega-title" style="margin-bottom: 8px; font-size: clamp(28px, 3.8vw, 48px);">
                <?= $currentLang === 'en' ? 'Connect With Us.' : 'Bizimle İletişime Geçin.' ?>
            </h1>
            <p class="adler-inner-desc" style="margin-bottom: 16px; font-size: 15px; max-width: 680px;">
                <?= $currentLang === 'en' 
                    ? 'Get in touch with our expert trade team anytime for fresh produce sourcing, export partnership, or facility visits.' 
                    : 'Taze ürün tedariği, ihracat ortaklığı veya tesis ziyaretleri için uzman ekibimizle dilediğiniz zaman iletişime geçebilirsiniz.' ?>
            </p>

            <!-- KULLANICI TALEBİ: KÜÇÜK DİKDÖRTGEN KARTLAR VE HARİTA KUTUSU DASHBOARD -->
            <div class="contact-hero-dashboard">
                
                <!-- Sol Kolon: Küçük Dikdörtgen İletişim Kartları -->
                <div class="contact-cards-stack">
                    
                    <!-- 1. Adres Kartı (Küçük Dikdörtgen) -->
                    <a href="https://maps.google.com/?q=<?= urlencode($address) ?>" target="_blank" rel="noopener noreferrer" class="contact-compact-rect" title="Haritada Aç">
                        <div class="contact-rect-icon">📍</div>
                        <div class="contact-rect-content">
                            <span class="contact-rect-label"><?= $currentLang === 'en' ? 'HEADQUARTERS & FACILITY' : 'GENEL MERKEZ & TESİS' ?></span>
                            <span class="contact-rect-val"><?= htmlspecialchars($address) ?></span>
                        </div>
                    </a>

                    <!-- 2. Telefon & WhatsApp Kartı (Küçük Dikdörtgen) -->
                    <a href="tel:<?= preg_replace('/[^0-9+]/', '', $phone) ?>" class="contact-compact-rect" title="Bizi Arayın">
                        <div class="contact-rect-icon">📞</div>
                        <div class="contact-rect-content">
                            <span class="contact-rect-label"><?= $currentLang === 'en' ? 'DIRECT PHONE & WHATSAPP' : 'TELEFON & WHATSAPP' ?></span>
                            <span class="contact-rect-val"><?= htmlspecialchars($phone) ?> &bull; <?= htmlspecialchars($whatsapp) ?></span>
                        </div>
                    </a>

                    <!-- 3. E-Posta & Mesai Kartı (Küçük Dikdörtgen) -->
                    <a href="mailto:<?= htmlspecialchars($email) ?>" class="contact-compact-rect" title="E-Posta Gönderin">
                        <div class="contact-rect-icon">✉️</div>
                        <div class="contact-rect-content">
                            <span class="contact-rect-label"><?= $currentLang === 'en' ? 'OFFICIAL EMAIL & HOURS' : 'E-POSTA & ÇALIŞMA SAATLERİ' ?></span>
                            <span class="contact-rect-val"><?= htmlspecialchars($email) ?> &bull; Pzt - Cmt: 08:30 - 18:30</span>
                        </div>
                    </a>

                </div>

                <!-- Sag Kolon: Harita Gosteren Kutu -->
                <div class="contact-map-box">
                    <iframe 
                        src="https://maps.google.com/maps?q=Antalya%20Organize%20Sanayi%20B%C3%B6lgesi&t=&z=13&ie=UTF8&iwloc=&output=embed" 
                        loading="lazy" 
                        title="BIKGRUP Lokasyon Haritasi"
                        allowfullscreen>
                    </iframe>
                </div>

            </div>

        </div>

        <!-- Alt Denge Boslugu -->
        <div style="height: 25px;"></div>

    </div>
</section>
<!-- KULLANICI TALEBI: ALTTAN TUM FORMLAR VE EKSTRA ALANLAR KALDIRILDI, HEMEN FOOTER GELIYOR -->
