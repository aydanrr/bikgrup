<?php
/**
 * BIKGRUP - Kurumsal Politikalar, KVKK ve Gizlilik Sayfasi
 */

declare(strict_types=1);

$currentLang = Lang::current();
$activeTab = $activeTab ?? 'gizlilik'; // gizlilik, kvkk, cerez
?>

<?php
$hasHero = true;
$GLOBALS['hasHero'] = true;
?>

<!-- ========================================================================
     POLİTİKALAR - ÇİZGİSEL MİMARİ HERO GİRİŞ ALANI (ADLER STYLE)
     ======================================================================== -->
<section class="adler-hero-viewport">
    
    <!-- Tam Ekran Doğa Arka Planı -->
    <img src="<?= BASE_URL ?>/public/images/nature_hero_bg.jpg" alt="BİKGRUP Kurumsal Politikalar ve Hukuk" class="adler-bg-poster" loading="eager">
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

        <!-- Çerçevenin Merkezi: KULLANICI TALEBİ ORTALANMIŞ BAŞLIK VE POLİTİKA SEKMELERİ -->
        <div class="adler-inner-center-hero">
            <span class="adler-inner-badge"><?= $currentLang === 'en' ? 'Legal & Compliance' : 'Hukuk ve Uyum İlkeleri' ?></span>
            <h1 class="adler-inner-mega-title">
                <?= $currentLang === 'en' ? 'Transparency &<br>Trust.' : 'Şeffaflık &<br>Güven.' ?>
            </h1>
            <p class="adler-inner-desc">
                <?= $currentLang === 'en' 
                    ? 'Information regarding personal data protection, privacy terms, and cookies on the BİKGRUP platform.' 
                    : 'BİKGRUP olarak kişisel verilerinizin güvenliğine, gizlilik haklarınıza ve yasal mevzuata tam uyuma azami özen gösteriyoruz.' ?>
            </p>
            <div class="adler-inner-actions">
                <a href="<?= BASE_URL ?>/gizlilik" class="sarikaya-cat-pill <?= $activeTab === 'gizlilik' ? 'is-active' : '' ?>">
                    🔒 <?= $currentLang === 'en' ? 'Privacy Policy' : 'Gizlilik Politikası' ?>
                </a>
                <a href="<?= BASE_URL ?>/kvkk" class="sarikaya-cat-pill <?= $activeTab === 'kvkk' ? 'is-active' : '' ?>">
                    ⚖️ <?= $currentLang === 'en' ? 'GDPR / KVKK' : 'KVKK Metni' ?>
                </a>
                <a href="<?= BASE_URL ?>/cerez-politikasi" class="sarikaya-cat-pill <?= $activeTab === 'cerez' ? 'is-active' : '' ?>">
                    🍪 <?= $currentLang === 'en' ? 'Cookie Policy' : 'Çerez Politikası' ?>
                </a>
            </div>
        </div>

        <!-- Alt Denge Boşluğu -->
        <div style="height: 30px;"></div>

    </div>
</section>

<section class="section" style="padding-top: 40px; padding-bottom: 80px;">
    <div class="container" style="max-width: 960px;">
        <div style="background: #ffffff; border-radius: 24px; border: 1px solid #e2e8f0; padding: clamp(28px, 5vw, 55px); box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04);">

            <?php if ($activeTab === 'gizlilik'): ?>
                <!-- GIZLILIK POLITIKASI -->
                <h2 style="font-size: 26px; font-weight: 800; color: #0f172a; margin-bottom: 20px;">
                    <?= $currentLang === 'en' ? 'Privacy Policy' : 'Gizlilik Politikasi' ?>
                </h2>
                <p style="color: #64748b; font-size: 14px; margin-bottom: 24px;">
                    <em><?= $currentLang === 'en' ? 'Last Updated: October 2026' : 'Son Guncelleme: Ekim 2026' ?></em>
                </p>
                <div style="color: #334155; font-size: 15px; line-height: 1.8; display: flex; flex-direction: column; gap: 18px;">
                    <p>
                        BIKGRUP olarak (bundan boyle "Sirket" olarak anilacaktir), web sitemizi ziyaret eden kullanicilarimizin ve is ortaklarimizin kisisel bilgilerinin gizliligini korumayi en temel kurumsal sorumluluklarimizdan biri kabul etmekteyiz.
                    </p>
                    <h3 style="font-size: 19px; font-weight: 700; color: #0f172a; margin-top: 10px;">1. Toplanan Bilgiler</h3>
                    <p>
                        Web sitemiz uzerinden paylastiginiz iletisim formu bilgileri (ad, soyad, e-posta, telefon ve mesaj icerigi) yalnizca size hizmet sunmak, taleplerinizi karsilamak ve ihracat/satis surecleri hakkinda bilgilendirme saglamak amaciyla toplanmaktadir.
                    </p>
                    <h3 style="font-size: 19px; font-weight: 700; color: #0f172a; margin-top: 10px;">2. Bilgilerin Guvenligi ve Paylasimi</h3>
                    <p>
                        Toplanan kisisel bilgileriniz hicbir surette ucuncu taraflara ticari amaclarla satilmaz, kiralanmaz veya yetkisiz kisi ve kurumlarla paylasilmaz. Yasal zorunluluklar sakli kalmak kaydiyla, verileriniz yuksek guvenlikli sunucularda korunmaktadir.
                    </p>
                    <h3 style="font-size: 19px; font-weight: 700; color: #0f172a; margin-top: 10px;">3. Iletisim</h3>
                    <p>
                        Gizlilik politikamizla ilgili soru, gorus ve talepleriniz icin <strong>info@bikgrup.com</strong> e-posta adresi uzerinden sirket yetkililerimizle iletisime gecebilirsiniz.
                    </p>
                </div>

            <?php elseif ($activeTab === 'kvkk'): ?>
                <!-- KVKK AYDINLATMA METNI -->
                <h2 style="font-size: 26px; font-weight: 800; color: #0f172a; margin-bottom: 20px;">
                    <?= $currentLang === 'en' ? 'KVKK / Personal Data Protection Clarification' : '6698 Sayili KVKK Uyarinca Aydinlatma Metni' ?>
                </h2>
                <p style="color: #64748b; font-size: 14px; margin-bottom: 24px;">
                    <em><?= $currentLang === 'en' ? 'Data Controller: BIKGRUP Tarim ve Ihracat A.S.' : 'Veri Sorumlusu: BIKGRUP Tarim ve Ihracat A.S.' ?></em>
                </p>
                <div style="color: #334155; font-size: 15px; line-height: 1.8; display: flex; flex-direction: column; gap: 18px;">
                    <p>
                        BIKGRUP Tarim ve Ihracat A.S. olarak, 6698 sayili Kisisel Verilerin Korunmasi Kanunu ("KVKK") uyarinca, veri sorumlusu sifatiyla elde ettigimiz kisisel verilerinizin islenmesinde ve muhafazasinda kanuni ilkelere ve kurallara riayet etmekteyiz.
                    </p>
                    <h3 style="font-size: 19px; font-weight: 700; color: #0f172a; margin-top: 10px;">1. Kisisel Verilerin Islenme Amaci</h3>
                    <p>
                        Kisisel verileriniz; tarimsal uretim, paketleme, soguk hava ve ihracat faaliyetlerimizin yurutulmesi, musteri iliskilerinin yonetimi, bilgi ve teklif taleplerinin cevaplandirilmasi amaclariyla KVKK 5. ve 6. maddelerine uygun olarak islenmektedir.
                    </p>
                    <h3 style="font-size: 19px; font-weight: 700; color: #0f172a; margin-top: 10px;">2. Ilgili Kisinin Haklari (Madde 11)</h3>
                    <p>
                        KVKK 11. maddesi uyarinca veri sahipleri; kisisel verilerinin islenip islenmedigini ogrenme, islenmisse bilgi talep etme, islenme amacina uygun kullanilip kullanilmadigini ogrenme ve verilerin silinmesini veya duzeltilmesini talep etme haklarina sahiptir.
                    </p>
                </div>

            <?php else: ?>
                <!-- CEREZ POLITIKASI -->
                <h2 style="font-size: 26px; font-weight: 800; color: #0f172a; margin-bottom: 20px;">
                    <?= $currentLang === 'en' ? 'Cookie Policy' : 'Cerez (Cookie) Politikasi' ?>
                </h2>
                <p style="color: #64748b; font-size: 14px; margin-bottom: 24px;">
                    <em><?= $currentLang === 'en' ? 'BIKGRUP Online Platforms' : 'BIKGRUP Cevrimici Hizmetleri' ?></em>
                </p>
                <div style="color: #334155; font-size: 15px; line-height: 1.8; display: flex; flex-direction: column; gap: 18px;">
                    <p>
                        Web sitemizde, ziyaretcilerimize daha iyi bir kullanici deneyimi sunabilmek, site performansini analiz etmek ve tercihleri hatirlayabilmek amaciyla cerezler (cookies) kullanilmaktadir.
                    </p>
                    <h3 style="font-size: 19px; font-weight: 700; color: #0f172a; margin-top: 10px;">1. Kullanilan Cerez Turleri</h3>
                    <p>
                        - <strong>Zorunlu Cerezler:</strong> Web sitesinin temel fonksiyonlarinin dogru calismasi icin gereklidir.<br>
                        - <strong>Performans ve Analitik Cerezleri:</strong> Sayfa ziyaretleri ve trafik kaynaklarini anonim olarak olcerek site deneyimini iyilestirmemize yardimci olur.<br>
                        - <strong>Islevsel Cerezler:</strong> Dil secimi gibi kisisellestirilmis tercihlerinizi hatirlar.
                    </p>
                    <h3 style="font-size: 19px; font-weight: 700; color: #0f172a; margin-top: 10px;">2. Cerez Tercihlerinin Yonetimi</h3>
                    <p>
                        Tarayicinizin ayarlarini degistirerek cerezleri dilediginiz zaman engelleyebilir veya silebilirsiniz. Ancak cerezlerin devre disi birakilmasi durumunda web sitesinin bazi ozellikleri beklenen sekilde calismayabilir.
                    </p>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>
