<?php
/**
 * BİKGRUP - xpanel Ana Arayüz Şablonu (Layout)
 */

declare(strict_types=1);

$user = Auth::user();
$unreadMsgCount = Message::unreadCount();
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'xpanel Yönetici Paneli') ?></title>
    
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/panel.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/animations.css">
</head>
<body class="panel-body">

    <!-- Sol Menü (Sidebar) -->
    <aside class="panel-sidebar">
        <div class="panel-brand">
            <span style="font-size: 22px;">🌿</span>
            <span class="logo-text">BİKGRUP</span>
            <span class="badge-secret">XPANEL</span>
        </div>

        <nav class="panel-nav">
            <a href="<?= BASE_URL ?>/index.php?url=<?= PANEL_SLUG ?>" class="panel-nav-link <?= ($activeMenu ?? '') === 'dashboard' ? 'active' : '' ?>">
                <span class="nav-icon">📊</span>
                <span>Genel Bakış</span>
            </a>

            <!-- Dinamik Tema ve Canlı Renk Yönetimi -->
            <a href="<?= BASE_URL ?>/index.php?url=<?= PANEL_SLUG ?>/theme" class="panel-nav-link <?= ($activeMenu ?? '') === 'theme' ? 'active' : '' ?>">
                <span class="nav-icon">🎨</span>
                <span>Dinamik Tema & Renkler</span>
            </a>

            <!-- Genel Site Ayarları -->
            <a href="<?= BASE_URL ?>/index.php?url=<?= PANEL_SLUG ?>/settings" class="panel-nav-link <?= ($activeMenu ?? '') === 'settings' ? 'active' : '' ?>">
                <span class="nav-icon">⚙️</span>
                <span>Genel Ayarlar & İletişim</span>
            </a>

            <!-- Dinamik Sayfa Bölümleri -->
            <a href="<?= BASE_URL ?>/index.php?url=<?= PANEL_SLUG ?>/pages" class="panel-nav-link <?= ($activeMenu ?? '') === 'pages' ? 'active' : '' ?>">
                <span class="nav-icon">📄</span>
                <span>Sayfa ve Alan Yönetimi</span>
            </a>

            <!-- Ürünler -->
            <a href="<?= BASE_URL ?>/index.php?url=<?= PANEL_SLUG ?>/products" class="panel-nav-link <?= ($activeMenu ?? '') === 'products' ? 'active' : '' ?>">
                <span class="nav-icon">🍊</span>
                <span>Ürünler & Hasat</span>
            </a>

            <!-- Blog -->
            <a href="<?= BASE_URL ?>/index.php?url=<?= PANEL_SLUG ?>/blog" class="panel-nav-link <?= ($activeMenu ?? '') === 'blog' ? 'active' : '' ?>">
                <span class="nav-icon">📰</span>
                <span>Blog & Haberler</span>
            </a>

            <!-- Mesajlar -->
            <a href="<?= BASE_URL ?>/index.php?url=<?= PANEL_SLUG ?>/messages" class="panel-nav-link <?= ($activeMenu ?? '') === 'messages' ? 'active' : '' ?>">
                <span class="nav-icon">✉️</span>
                <span>Gelen Mesajlar</span>
                <?php if ($unreadMsgCount > 0): ?>
                    <span style="background:#ef4444; color:#fff; font-size:11px; padding:2px 7px; border-radius:10px; margin-left:auto; font-weight:800;">
                        <?= $unreadMsgCount ?>
                    </span>
                <?php endif; ?>
            </a>

            <!-- Yöneticiler & Dokunulmazlık -->
            <a href="<?= BASE_URL ?>/index.php?url=<?= PANEL_SLUG ?>/users" class="panel-nav-link <?= ($activeMenu ?? '') === 'users' ? 'active' : '' ?>">
                <span class="nav-icon">👥</span>
                <span>Yöneticiler & Yetki</span>
            </a>

            <div style="border-top: 1px solid rgba(255,255,255,0.08); margin: 10px 0;"></div>

            <!-- Siteyi Canlı Gör -->
            <a href="<?= BASE_URL ?>/index.php" target="_blank" class="panel-nav-link">
                <span class="nav-icon">🌐</span>
                <span>Siteyi Canlı Gör ↗</span>
            </a>

            <!-- Çıkış -->
            <a href="<?= BASE_URL ?>/index.php?url=<?= PANEL_SLUG ?>/logout" class="panel-nav-link" style="color: #f87171;">
                <span class="nav-icon">🚪</span>
                <span>Güvenli Çıkış</span>
            </a>
        </nav>

        <!-- Oturum Açmış Yönetici Bilgisi -->
        <div class="panel-user-card">
            <div class="panel-user-avatar">
                <?= strtoupper(substr($user['name'] ?? 'A', 0, 1)) ?>
            </div>
            <div style="overflow: hidden;">
                <div style="font-weight: 700; font-size: 14px; color: #ffffff; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;">
                    <?= htmlspecialchars($user['name'] ?? 'Yönetici') ?>
                </div>
                <div style="font-size: 12px; color: #94a3b8; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;">
                    <?= htmlspecialchars($user['email'] ?? '') ?>
                </div>
            </div>
        </div>
    </aside>

    <!-- Ana Panel İçeriği -->
    <div class="panel-main">
        
        <!-- Topbar -->
        <header class="panel-topbar">
            <div style="font-family: 'Outfit', sans-serif; font-size: 20px; font-weight: 700;">
                <?= htmlspecialchars($pageTitle ?? 'Yönetim Paneli') ?>
            </div>

            <div style="display: flex; align-items: center; gap: 14px;">
                <?php if (!empty($user['is_immutable'])): ?>
                    <span class="badge-immutable" title="Bu hesap ana kurucu dokunulmaz hesaptır">
                        🛡️ Dokunulmaz Süper Admin
                    </span>
                <?php else: ?>
                    <span style="font-size: 13px; font-weight: 600; color: #64748b;">
                        Yönetici
                    </span>
                <?php endif; ?>
            </div>
        </header>

        <!-- İçerik Alanı -->
        <main class="panel-container">
            
            <!-- Başarı Mesajı -->
            <?php if (!empty($_SESSION['panel_success'])): ?>
                <div style="background: #f0fdf4; border: 1.5px solid #86efac; color: #166534; padding: 14px 20px; border-radius: 12px; margin-bottom: 24px; font-weight: 600; display:flex; justify-content:space-between; align-items:center;">
                    <span>✓ <?= htmlspecialchars($_SESSION['panel_success']) ?></span>
                    <button onclick="this.parentElement.remove();" style="background:none; border:none; cursor:pointer; color:#166534; font-size:18px;">✕</button>
                </div>
                <?php unset($_SESSION['panel_success']); ?>
            <?php endif; ?>

            <!-- Hata Mesajı -->
            <?php if (!empty($_SESSION['panel_error'])): ?>
                <div style="background: #fef2f2; border: 1.5px solid #fca5a5; color: #991b1b; padding: 14px 20px; border-radius: 12px; margin-bottom: 24px; font-weight: 600; display:flex; justify-content:space-between; align-items:center;">
                    <span>⚠️ <?= htmlspecialchars($_SESSION['panel_error']) ?></span>
                    <button onclick="this.parentElement.remove();" style="background:none; border:none; cursor:pointer; color:#991b1b; font-size:18px;">✕</button>
                </div>
                <?php unset($_SESSION['panel_error']); ?>
            <?php endif; ?>

            <!-- Görünüm Çıktısı -->
            <?= $panelContent ?? '' ?>

        </main>
    </div>

    <!-- Panel JavaScript -->
    <script src="<?= BASE_URL ?>/public/js/panel.js"></script>
</body>
</html>
