<?php
/**
 * BİKGRUP - Genel Başlık ve Navigasyon Şablonu
 * Çizgisel Mimari & Akıllı Scrolled Navbar
 */

declare(strict_types=1);

$currentLang = Lang::current();
$siteName = Settings::get('site_name', 'BİKGRUP');
$categoriesMenu = Category::all(true);
$isHome = ($activeNav ?? '') === 'home';
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($currentLang) ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? $siteName) ?></title>
    <meta name="description" content="<?= htmlspecialchars(Settings::getLocalized('site_description', 'BİKGRUP Taze Narenciye, Meyve ve Tarımsal İhracat')) ?>">
    
    <!-- SEO & Sosyal Paylaşım Meta Etiketleri -->
    <meta property="og:title" content="<?= htmlspecialchars($pageTitle ?? $siteName) ?>">
    <meta property="og:description" content="<?= htmlspecialchars(Settings::getLocalized('site_description', 'Akdeniz ve Egenin en verimli topraklarında yetişen taze ürünler.')) ?>">
    <meta property="og:type" content="website">
    <meta property="og:image" content="<?= BASE_URL ?>/public/images/nature_hero_bg.jpg">

    <!-- Dinamik Tema Değişkenleri (Arka Panelden Anında Değişen Canlı CSS) -->
    <?= Settings::renderCssVariables() ?>
    
    <!-- CSS Dosyaları -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/style.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/animations.css">
</head>
<body>

    <!-- Yüzen Pill Navbar (Sayfa Aşağı Kaydırıldığında veya Adler Hero Olmayan Sayfalarda Görünür) -->
    <header class="header-wrapper <?= empty($hasHero) && !$isHome ? 'header-visible' : '' ?>">
        <nav class="navbar-pill">
            
            <a href="<?= BASE_URL ?>/" class="bik-logo">
                <span class="logo-leaf-icon" style="width:24px; height:24px; font-size:12px;">🌿</span>
                <span>BİK<span class="accent">GRUP</span></span>
            </a>

            <ul class="nav-menu">
                <li><a href="<?= BASE_URL ?>/" class="nav-link <?= ($activeNav ?? '') === 'home' ? 'active' : '' ?>"><?= __('nav_home') ?></a></li>
                <li><a href="<?= BASE_URL ?>/kurumsal" class="nav-link <?= ($activeNav ?? '') === 'about' ? 'active' : '' ?>"><?= __('nav_about') ?></a></li>
                <li><a href="<?= BASE_URL ?>/urunler" class="nav-link <?= ($activeNav ?? '') === 'products' ? 'active' : '' ?>"><?= __('nav_products') ?></a></li>
                <li><a href="<?= BASE_URL ?>/kurumsal#sertifikalar" class="nav-link"><?= __('nav_quality') ?></a></li>
                <li><a href="<?= BASE_URL ?>/blog" class="nav-link <?= ($activeNav ?? '') === 'blog' ? 'active' : '' ?>"><?= __('nav_blog') ?></a></li>
                <li><a href="<?= BASE_URL ?>/iletisim" class="nav-link <?= ($activeNav ?? '') === 'contact' ? 'active' : '' ?>"><?= __('nav_contact') ?></a></li>
            </ul>

            <div class="nav-actions">
                <div class="lang-switcher">
                    <a href="<?= Lang::switchUrl('tr') ?>" class="lang-btn <?= $currentLang === 'tr' ? 'active' : '' ?>" title="Türkçe">TR</a>
                    <a href="<?= Lang::switchUrl('en') ?>" class="lang-btn <?= $currentLang === 'en' ? 'active' : '' ?>" title="English">EN</a>
                </div>

                <button class="mobile-toggle" style="color:var(--theme-text);" aria-label="Menü">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </button>
            </div>

        </nav>
    </header>

    <!-- Mobil Çekmece Menü -->
    <div class="mobile-menu-drawer">
        <div class="mobile-menu-content">
            <button class="mobile-menu-close" aria-label="Kapat">✕</button>

            <a href="<?= BASE_URL ?>/" class="bik-logo" style="margin-bottom: 24px;">
                <span class="logo-leaf-icon">🌿</span>
                <span>BİK<span class="accent">GRUP</span></span>
            </a>

            <div class="mobile-menu-links">
                <a href="<?= BASE_URL ?>/"><?= __('nav_home') ?></a>
                <a href="<?= BASE_URL ?>/kurumsal"><?= __('nav_about') ?></a>
                <a href="<?= BASE_URL ?>/urunler"><?= __('nav_products') ?></a>
                <a href="<?= BASE_URL ?>/kurumsal#sertifikalar"><?= __('nav_quality') ?></a>
                <a href="<?= BASE_URL ?>/blog"><?= __('nav_blog') ?></a>
                <a href="<?= BASE_URL ?>/iletisim"><?= __('nav_contact') ?></a>
            </div>

            <div style="margin-top: auto;">
                <div class="lang-switcher" style="display: inline-flex;">
                    <a href="<?= Lang::switchUrl('tr') ?>" class="lang-btn <?= $currentLang === 'tr' ? 'active' : '' ?>">TR</a>
                    <a href="<?= Lang::switchUrl('en') ?>" class="lang-btn <?= $currentLang === 'en' ? 'active' : '' ?>">EN</a>
                </div>
            </div>
        </div>
    </div>
