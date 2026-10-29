<?php
/**
 * BİKGRUP - Ürünler Listesi Sayfası
 * SEO Uyumlu Temiz URL'ler
 */

declare(strict_types=1);

$currentLang = Lang::current();
?>

<?php
$hasHero = true;
$GLOBALS['hasHero'] = true;
?>

<!-- ========================================================================
     ÜRÜNLER - ÇİZGİSEL MİMARİ HERO GİRİŞ ALANI (ORTALANMIŞ & SOL KARTSIZ)
     ======================================================================== -->
<section class="adler-hero-viewport">
    
    <!-- Tam Ekran Doğa & Tarım Arka Planı -->
    <img src="<?= BASE_URL ?>/public/images/nature_hero_bg.jpg" alt="BİKGRUP Taze Ürünler ve İhracat" class="adler-bg-poster" loading="eager">
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
                <a href="<?= BASE_URL ?>/urunler" class="adler-nav-link active"><?= __('nav_products') ?></a>
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

        <!-- Çerçevenin Merkezi: ORTALANMIŞ BAŞLIK VE KATEGORİ FİLTRE BUTONLARI -->
        <div class="adler-inner-center-hero">
            <span class="adler-inner-badge"><?= __('nav_products') ?></span>
            <h1 class="adler-inner-mega-title">
                <?= $selectedCategory 
                    ? htmlspecialchars($selectedCategory['name_' . $currentLang] ?? $selectedCategory['name_tr']) 
                    : ($currentLang === 'en' ? 'Fresh Harvest &<br>Global Export.' : 'Taze Mahsul &<br>Global İhracat.') ?>
            </h1>
            <p class="adler-inner-desc">
                <?= $selectedCategory 
                    ? htmlspecialchars($selectedCategory['description_' . $currentLang] ?? $selectedCategory['description_tr']) 
                    : ($currentLang === 'en' 
                        ? 'Our nutritious and premium produce grown in the fertile soils of the Mediterranean maintains its peak freshness on its journey from our orchards to your table.' 
                        : 'Akdeniz ve Ege’nin verimli topraklarında yetişen besleyici ve sağlıklı ürünlerimiz, tarladan sofranıza uzanan yolculukta tazeliğini korur.') ?>
            </p>

            <!-- Kategori Butonları (Aşağı Kaydırma & Filtreleme Destekli) -->
            <div class="sarikaya-cat-pills-row" style="margin-top: 10px;">
                <a href="<?= BASE_URL ?>/urunler?scroll=vitrin" 
                   class="sarikaya-cat-pill <?= empty($selectedCategory) ? 'is-active' : '' ?>">
                    <?= __('cat_all') ?>
                </a>
                <?php foreach ($categories as $cat): ?>
                    <?php $isActive = !empty($selectedCategory) && (int)$selectedCategory['id'] === (int)$cat['id']; ?>
                    <a href="<?= BASE_URL ?>/urunler?kategori=<?= urlencode($cat['slug']) ?>&scroll=vitrin" 
                       class="sarikaya-cat-pill <?= $isActive ? 'is-active' : '' ?>">
                        <?= htmlspecialchars($cat['name_' . $currentLang] ?? $cat['name_tr']) ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Alt Denge Boşluğu -->
        <div style="height: 30px;"></div>

    </div>
</section>

<!-- ÜRÜN KARTLARI BÖLÜMÜ (Aşağı Kaydırma Hedefi) -->
<section class="section" id="urunler-vitrini" style="padding-top: 50px; scroll-margin-top: 40px;">
    <div class="container">
        
        <?php if (empty($products)): ?>
            <div style="text-align:center; padding: 60px 20px; background:#ffffff; border-radius: 20px; border:1px solid #e2e8f0;">
                <p style="font-size: 18px; color: var(--theme-text-muted);">Bu kategoride henüz yayınlanmış ürün bulunamadı.</p>
                <a href="<?= BASE_URL ?>/urunler?scroll=vitrin" class="btn btn-primary" style="margin-top: 16px;">Tüm Ürünlere Dön</a>
            </div>
        <?php else: ?>
            <div class="popout-products-grid">
                <?php foreach ($products as $index => $prod): ?>
                    <div class="popout-product-card card-color-<?= ($index % 4) + 1 ?> reveal reveal-delay-<?= ($index % 3) + 1 ?>">
                        <!-- Karttan Dışarı Taşan 3 Boyutlu Ürün Görseli -->
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
        <?php endif; ?>

    </div>
</section>

<!-- Otomatik Yumuşak Aşağı Kaydırma Scripti -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('scroll') || urlParams.has('kategori') || window.location.hash.includes('urunler-vitrini')) {
        const target = document.getElementById('urunler-vitrini');
        if (target) {
            setTimeout(() => {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }, 100);
        }
    }

    document.querySelectorAll('.sarikaya-cat-pill').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const href = this.getAttribute('href');
            if (href) {
                window.location.href = href;
            }
        });
    });
});
</script>
