<?php
/**
 * BİKGRUP - Ana Giriş ve SEO Uyumlu Rota Yönlendirici (Router)
 * PHP 8.2 / 8.3 / 8.4 Uyumlu
 */

declare(strict_types=1);

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/core/Lang.php';
require_once __DIR__ . '/core/Settings.php';
require_once __DIR__ . '/core/Security.php';
require_once __DIR__ . '/core/Auth.php';

// Temel Modellerin Global Yüklenmesi (Hiçbir sayfada Class Not Found hatası yaşanmaz)
require_once __DIR__ . '/app/Models/Category.php';
require_once __DIR__ . '/app/Models/Product.php';
require_once __DIR__ . '/app/Models/PageSection.php';
require_once __DIR__ . '/app/Models/BlogPost.php';
require_once __DIR__ . '/app/Models/Message.php';

// Dil ve Ayar motorlarını başlat
Lang::init();
Settings::load();

// Rota parametresini al (SEO Dostu Temiz URL Desteği)
$requestUri = $_SERVER['REQUEST_URI'] ?? '';
$path = parse_url($requestUri, PHP_URL_PATH) ?? '';

// /bikgrup önekini temizle
$baseDir = parse_url(BASE_URL, PHP_URL_PATH) ?? '';
if (!empty($baseDir) && str_starts_with($path, $baseDir)) {
    $path = substr($path, strlen($baseDir));
}

$url = trim($path, '/');
if (empty($url) && isset($_GET['url'])) {
    $url = trim($_GET['url'], '/');
}

// index.php dosya adını temizle
if (str_starts_with($url, 'index.php')) {
    $url = trim(substr($url, 9), '/');
}

$parts = !empty($url) ? explode('/', $url) : [];
$route = $parts[0] ?? '';
$subRoute = $parts[1] ?? '';
$param = $parts[2] ?? '';

// SEO Dostu Türkçe ve Uluslararası Rotaların Eşleştirilmesi
switch ($route) {
    case '':
    case 'anasayfa':
    case 'home':
        require_once APP_PATH . '/Controllers/HomeController.php';
        (new HomeController())->index();
        break;

    // Kurumsal / Hakkımızda
    case 'kurumsal':
    case 'hakkimizda':
    case 'about':
        require_once APP_PATH . '/Controllers/AboutController.php';
        (new AboutController())->index();
        break;

    // Ürünler
    case 'urunler':
    case 'products':
        require_once APP_PATH . '/Controllers/ProductsController.php';
        $controller = new ProductsController();
        if (!empty($subRoute)) {
            $controller->detail($subRoute);
        } else {
            $controller->index();
        }
        break;

    // Blog & Haberler
    case 'blog':
    case 'haberler':
        require_once APP_PATH . '/Controllers/BlogController.php';
        $controller = new BlogController();
        if (!empty($subRoute)) {
            $controller->detail($subRoute);
        } else {
            $controller->index();
        }
        break;

    // İletişim
    case 'iletisim':
    case 'contact':
        require_once APP_PATH . '/Controllers/ContactController.php';
        $controller = new ContactController();
        if ($subRoute === 'submit' || $subRoute === 'gonder') {
            $controller->submit();
        } else {
            $controller->index();
        }
        break;

    // KULLANICI TALEBİ: Politikalar (Gizlilik, KVKK, Çerez Politikası)
    case 'politikalar':
    case 'gizlilik':
    case 'privacy':
    case 'kvkk':
    case 'gdpr':
    case 'cerez-politikasi':
    case 'cookies':
        $activeTab = 'gizlilik';
        if ($route === 'kvkk' || $route === 'gdpr') {
            $activeTab = 'kvkk';
        } elseif ($route === 'cerez-politikasi' || $route === 'cookies') {
            $activeTab = 'cerez';
        }
        $siteTitle = Settings::getLocalized('site_title', 'BİKGRUP');
        $siteDesc = Settings::getLocalized('site_description', '');
        $pageTitle = ($activeTab === 'kvkk' ? 'KVKK Aydınlatma Metni' : ($activeTab === 'cerez' ? 'Çerez Politikası' : 'Gizlilik Politikası')) . ' - ' . $siteTitle;
        require_once APP_PATH . '/views/layouts/header.php';
        require_once APP_PATH . '/views/pages/policy.php';
        require_once APP_PATH . '/views/layouts/footer.php';
        break;

    // GİZLİ YÖNETİM PANELİ (xpanel)
    case PANEL_SLUG:
        require_once APP_PATH . '/Controllers/PanelController.php';
        $panel = new PanelController();

        switch ($subRoute) {
            case 'login':
                $panel->login();
                break;
            case 'do-login':
                $panel->doLogin();
                break;
            case 'logout':
                $panel->logout();
                break;
            case 'theme':
                $panel->theme();
                break;
            case 'save-theme':
                $panel->saveTheme();
                break;
            case 'settings':
                $panel->settings();
                break;
            case 'save-settings':
                $panel->saveSettings();
                break;
            case 'pages':
                $panel->pages();
                break;
            case 'save-page':
                $panel->savePageSection();
                break;
            case 'products':
                $panel->products();
                break;
            case 'save-product':
                $panel->saveProduct();
                break;
            case 'delete-product':
                $panel->deleteProduct();
                break;
            case 'blog':
                $panel->blog();
                break;
            case 'save-blog':
                $panel->saveBlog();
                break;
            case 'delete-blog':
                $panel->deleteBlog();
                break;
            case 'messages':
                $panel->messages();
                break;
            case 'read-message':
                $panel->readMessage();
                break;
            case 'delete-message':
                $panel->deleteMessage();
                break;
            case 'users':
                $panel->users();
                break;
            case 'save-user':
                $panel->saveUser();
                break;
            case 'delete-user':
                $panel->deleteUser();
                break;
            default:
                $panel->dashboard();
                break;
        }
        break;

    default:
        // Bilinmeyen rotada anasayfaya veya 404
        require_once APP_PATH . '/Controllers/HomeController.php';
        (new HomeController())->index();
        break;
}
