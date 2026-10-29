<?php
/**
 * BİKGRUP - Gizli Yönetim Paneli (xpanel) Kontrolcüsü
 * PHP 8.2 / 8.3 / 8.4 Uyumlu
 */

declare(strict_types=1);

require_once ROOT_PATH . '/core/View.php';
require_once ROOT_PATH . '/core/Auth.php';
require_once ROOT_PATH . '/core/Security.php';
require_once ROOT_PATH . '/core/Settings.php';
require_once ROOT_PATH . '/app/Models/Product.php';
require_once ROOT_PATH . '/app/Models/Category.php';
require_once ROOT_PATH . '/app/Models/BlogPost.php';
require_once ROOT_PATH . '/app/Models/PageSection.php';
require_once ROOT_PATH . '/app/Models/Message.php';
require_once ROOT_PATH . '/app/Models/User.php';

class PanelController
{
    /**
     * Oturum kontrolü (Giriş yapılmamışsa login ekranına yönlendirir)
     */
    private function requireAuth(): void
    {
        if (!Auth::check()) {
            header("Location: " . BASE_URL . "/index.php?url=" . PANEL_SLUG . "/login");
            exit;
        }
    }

    /**
     * Giriş Ekranı
     */
    public function login(): void
    {
        if (Auth::check()) {
            header("Location: " . BASE_URL . "/index.php?url=" . PANEL_SLUG);
            exit;
        }

        View::renderPanel('login', [
            'pageTitle' => 'xpanel | Yönetici Girişi'
        ], false);
    }

    /**
     * Giriş İşlemi
     */
    public function doLogin(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . BASE_URL . "/index.php?url=" . PANEL_SLUG . "/login");
            exit;
        }

        if (!Security::validateCsrf($_POST['csrf_token'] ?? null)) {
            $_SESSION['panel_error'] = 'Güvenlik doğrulaması (CSRF) başarısız oldu!';
            header("Location: " . BASE_URL . "/index.php?url=" . PANEL_SLUG . "/login");
            exit;
        }

        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        $result = Auth::login($email, $password);

        if ($result['success']) {
            $_SESSION['panel_success'] = 'Hoş geldiniz, ' . htmlspecialchars(Auth::user()['name']);
            header("Location: " . BASE_URL . "/index.php?url=" . PANEL_SLUG);
            exit;
        } else {
            $_SESSION['panel_error'] = $result['message'];
            header("Location: " . BASE_URL . "/index.php?url=" . PANEL_SLUG . "/login");
            exit;
        }
    }

    /**
     * Çıkış Yap
     */
    public function logout(): void
    {
        Auth::logout();
        header("Location: " . BASE_URL . "/index.php?url=" . PANEL_SLUG . "/login");
        exit;
    }

    /**
     * Dashboard (Ana Panel)
     */
    public function dashboard(): void
    {
        $this->requireAuth();

        $stats = [
            'product_count'  => count(Product::all(false)),
            'category_count' => count(Category::all(false)),
            'blog_count'     => count(BlogPost::all(false)),
            'unread_messages'=> Message::unreadCount(),
            'user_count'     => count(User::all())
        ];

        $recentMessages = array_slice(Message::all(), 0, 5);
        $recentProducts = array_slice(Product::all(false), 0, 5);

        View::renderPanel('dashboard', [
            'pageTitle'      => 'xpanel | Genel Bakış & Dashboard',
            'activeMenu'     => 'dashboard',
            'stats'          => $stats,
            'recentMessages' => $recentMessages,
            'recentProducts' => $recentProducts
        ]);
    }

    /**
     * Dinamik Tema ve Canlı Renk Yöneticisi
     */
    public function theme(): void
    {
        $this->requireAuth();

        $db = Database::getConnection();
        $themeSettings = $db->query("SELECT * FROM settings WHERE group_name = 'theme' ORDER BY id ASC")->fetchAll();

        View::renderPanel('theme', [
            'pageTitle'     => 'xpanel | Dinamik Tema & Renk Yönetimi',
            'activeMenu'    => 'theme',
            'themeSettings' => $themeSettings
        ]);
    }

    /**
     * Tema Renklerini Kaydet
     */
    public function saveTheme(): void
    {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !Security::validateCsrf($_POST['csrf_token'] ?? null)) {
            $_SESSION['panel_error'] = 'Güvenlik doğrulaması hatası!';
            header("Location: " . BASE_URL . "/index.php?url=" . PANEL_SLUG . "/theme");
            exit;
        }

        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE settings SET setting_value = ? WHERE setting_key = ? AND group_name = 'theme'");

        foreach ($_POST as $key => $value) {
            if (str_starts_with($key, 'theme_')) {
                $stmt->execute([trim($value), $key]);
            }
        }

        $_SESSION['panel_success'] = 'Site renkleri ve tema ayarları başarıyla güncellendi! Değişiklikler anında sitede aktif.';
        header("Location: " . BASE_URL . "/index.php?url=" . PANEL_SLUG . "/theme");
        exit;
    }

    /**
     * Genel Site Ayarları (Logo metni, telefon, adres vb.)
     */
    public function settings(): void
    {
        $this->requireAuth();

        $db = Database::getConnection();
        $generalSettings = $db->query("SELECT * FROM settings WHERE group_name != 'theme' ORDER BY group_name ASC, id ASC")->fetchAll();

        View::renderPanel('settings', [
            'pageTitle'       => 'xpanel | Genel Site Ayarları & İletişim',
            'activeMenu'      => 'settings',
            'generalSettings' => $generalSettings
        ]);
    }

    /**
     * Genel Ayarları Kaydet
     */
    public function saveSettings(): void
    {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !Security::validateCsrf($_POST['csrf_token'] ?? null)) {
            $_SESSION['panel_error'] = 'Güvenlik doğrulaması hatası!';
            header("Location: " . BASE_URL . "/index.php?url=" . PANEL_SLUG . "/settings");
            exit;
        }

        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE settings SET setting_value = ? WHERE setting_key = ?");

        foreach ($_POST as $key => $value) {
            if ($key !== 'csrf_token') {
                $stmt->execute([trim($value), $key]);
            }
        }

        $_SESSION['panel_success'] = 'Genel site ayarları başarıyla güncellendi.';
        header("Location: " . BASE_URL . "/index.php?url=" . PANEL_SLUG . "/settings");
        exit;
    }

    /**
     * Dinamik Sayfa Bölümleri Yönetimi (Hero, Hakkımızda vb.)
     */
    public function pages(): void
    {
        $this->requireAuth();

        $sections = PageSection::all();

        View::renderPanel('pages', [
            'pageTitle'  => 'xpanel | Dinamik Sayfa ve Bölüm Yönetimi',
            'activeMenu' => 'pages',
            'sections'   => $sections
        ]);
    }

    /**
     * Sayfa Bölümü Güncelle
     */
    public function savePageSection(): void
    {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !Security::validateCsrf($_POST['csrf_token'] ?? null)) {
            $_SESSION['panel_error'] = 'Güvenlik hatası!';
            header("Location: " . BASE_URL . "/index.php?url=" . PANEL_SLUG . "/pages");
            exit;
        }

        $sectionKey = trim($_POST['section_key'] ?? '');
        $data = [
            'title_tr'    => trim($_POST['title_tr'] ?? ''),
            'title_en'    => trim($_POST['title_en'] ?? ''),
            'subtitle_tr' => trim($_POST['subtitle_tr'] ?? ''),
            'subtitle_en' => trim($_POST['subtitle_en'] ?? ''),
            'body_tr'     => trim($_POST['body_tr'] ?? ''),
            'body_en'     => trim($_POST['body_en'] ?? '')
        ];

        PageSection::update($sectionKey, $data);

        $_SESSION['panel_success'] = 'Bölüm içeriği başarıyla güncellendi.';
        header("Location: " . BASE_URL . "/index.php?url=" . PANEL_SLUG . "/pages");
        exit;
    }

    /**
     * Ürünler Yönetimi
     */
    public function products(): void
    {
        $this->requireAuth();

        $products = Product::all(false);
        $categories = Category::all(false);

        View::renderPanel('products', [
            'pageTitle'  => 'xpanel | Ürün Yönetimi',
            'activeMenu' => 'products',
            'products'   => $products,
            'categories' => $categories
        ]);
    }

    /**
     * Ürün Kaydet (Ekle / Güncelle)
     */
    public function saveProduct(): void
    {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !Security::validateCsrf($_POST['csrf_token'] ?? null)) {
            $_SESSION['panel_error'] = 'Güvenlik hatası!';
            header("Location: " . BASE_URL . "/index.php?url=" . PANEL_SLUG . "/products");
            exit;
        }

        $id = !empty($_POST['id']) ? (int)$_POST['id'] : null;

        $slug = trim($_POST['slug'] ?? '');
        if (empty($slug)) {
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $_POST['name_tr'] ?? 'urun')));
        }

        $data = [
            'category_id'       => (int)($_POST['category_id'] ?? 1),
            'slug'              => $slug,
            'name_tr'           => trim($_POST['name_tr'] ?? ''),
            'name_en'           => trim($_POST['name_en'] ?? ''),
            'short_desc_tr'     => trim($_POST['short_desc_tr'] ?? ''),
            'short_desc_en'     => trim($_POST['short_desc_en'] ?? ''),
            'content_tr'        => trim($_POST['content_tr'] ?? ''),
            'content_en'        => trim($_POST['content_en'] ?? ''),
            'image'             => trim($_POST['image'] ?? 'product_riored.png'),
            'origin_tr'         => trim($_POST['origin_tr'] ?? 'Akdeniz & Ege / Türkiye'),
            'origin_en'         => trim($_POST['origin_en'] ?? 'Mediterranean & Aegean / Turkey'),
            'harvest_season_tr' => trim($_POST['harvest_season_tr'] ?? ''),
            'harvest_season_en' => trim($_POST['harvest_season_en'] ?? ''),
            'packaging_tr'      => trim($_POST['packaging_tr'] ?? ''),
            'packaging_en'      => trim($_POST['packaging_en'] ?? ''),
            'temperature'       => trim($_POST['temperature'] ?? '+4°C / +8°C'),
            'is_featured'       => isset($_POST['is_featured']) ? 1 : 0,
            'is_active'         => isset($_POST['is_active']) ? 1 : 0,
            'sort_order'        => (int)($_POST['sort_order'] ?? 0)
        ];

        if ($id) {
            Product::update($id, $data);
            $_SESSION['panel_success'] = 'Ürün başarıyla güncellendi.';
        } else {
            Product::create($data);
            $_SESSION['panel_success'] = 'Yeni ürün başarıyla eklendi.';
        }

        header("Location: " . BASE_URL . "/index.php?url=" . PANEL_SLUG . "/products");
        exit;
    }

    /**
     * Ürün Sil
     */
    public function deleteProduct(): void
    {
        $this->requireAuth();
        $id = (int)($_GET['id'] ?? 0);
        if ($id > 0) {
            Product::delete($id);
            $_SESSION['panel_success'] = 'Ürün silindi.';
        }
        header("Location: " . BASE_URL . "/index.php?url=" . PANEL_SLUG . "/products");
        exit;
    }

    /**
     * Blog Yönetimi
     */
    public function blog(): void
    {
        $this->requireAuth();

        $posts = BlogPost::all(false);

        View::renderPanel('blog', [
            'pageTitle'  => 'xpanel | Blog & Haber Yönetimi',
            'activeMenu' => 'blog',
            'posts'      => $posts
        ]);
    }

    /**
     * Blog Kaydet
     */
    public function saveBlog(): void
    {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !Security::validateCsrf($_POST['csrf_token'] ?? null)) {
            $_SESSION['panel_error'] = 'Güvenlik hatası!';
            header("Location: " . BASE_URL . "/index.php?url=" . PANEL_SLUG . "/blog");
            exit;
        }

        $id = !empty($_POST['id']) ? (int)$_POST['id'] : null;
        $slug = trim($_POST['slug'] ?? '');
        if (empty($slug)) {
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $_POST['title_tr'] ?? 'yazi')));
        }

        $data = [
            'slug'         => $slug,
            'title_tr'     => trim($_POST['title_tr'] ?? ''),
            'title_en'     => trim($_POST['title_en'] ?? ''),
            'excerpt_tr'   => trim($_POST['excerpt_tr'] ?? ''),
            'excerpt_en'   => trim($_POST['excerpt_en'] ?? ''),
            'content_tr'   => trim($_POST['content_tr'] ?? ''),
            'content_en'   => trim($_POST['content_en'] ?? ''),
            'image'        => trim($_POST['image'] ?? 'blog_cold_chain.png'),
            'author'       => trim($_POST['author'] ?? 'BİKGRUP'),
            'read_time'    => trim($_POST['read_time'] ?? '4 dk'),
            'is_published' => isset($_POST['is_published']) ? 1 : 0
        ];

        if ($id) {
            BlogPost::update($id, $data);
            $_SESSION['panel_success'] = 'Blog yazısı güncellendi.';
        } else {
            BlogPost::create($data);
            $_SESSION['panel_success'] = 'Yeni blog yazısı yayınlandı.';
        }

        header("Location: " . BASE_URL . "/index.php?url=" . PANEL_SLUG . "/blog");
        exit;
    }

    /**
     * Blog Sil
     */
    public function deleteBlog(): void
    {
        $this->requireAuth();
        $id = (int)($_GET['id'] ?? 0);
        if ($id > 0) {
            BlogPost::delete($id);
            $_SESSION['panel_success'] = 'Blog yazısı silindi.';
        }
        header("Location: " . BASE_URL . "/index.php?url=" . PANEL_SLUG . "/blog");
        exit;
    }

    /**
     * Gelen Mesajlar
     */
    public function messages(): void
    {
        $this->requireAuth();

        $messages = Message::all();

        View::renderPanel('messages', [
            'pageTitle'  => 'xpanel | Gelen İletişim Mesajları',
            'activeMenu' => 'messages',
            'messages'   => $messages
        ]);
    }

    /**
     * Mesajı Okundu İşaretle
     */
    public function readMessage(): void
    {
        $this->requireAuth();
        $id = (int)($_GET['id'] ?? 0);
        if ($id > 0) {
            Message::markAsRead($id);
        }
        header("Location: " . BASE_URL . "/index.php?url=" . PANEL_SLUG . "/messages");
        exit;
    }

    /**
     * Mesaj Sil
     */
    public function deleteMessage(): void
    {
        $this->requireAuth();
        $id = (int)($_GET['id'] ?? 0);
        if ($id > 0) {
            Message::delete($id);
            $_SESSION['panel_success'] = 'Mesaj silindi.';
        }
        header("Location: " . BASE_URL . "/index.php?url=" . PANEL_SLUG . "/messages");
        exit;
    }

    /**
     * Yöneticiler (Dokunulmaz Süleyman Admin Koruma Katmanı)
     */
    public function users(): void
    {
        $this->requireAuth();

        $users = User::all();

        View::renderPanel('users', [
            'pageTitle'  => 'xpanel | Yönetici Hesapları & Dokunulmazlık',
            'activeMenu' => 'users',
            'users'      => $users
        ]);
    }

    /**
     * Yönetici Kaydet (Ekle / Düzenle)
     */
    public function saveUser(): void
    {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !Security::validateCsrf($_POST['csrf_token'] ?? null)) {
            $_SESSION['panel_error'] = 'Güvenlik hatası!';
            header("Location: " . BASE_URL . "/index.php?url=" . PANEL_SLUG . "/users");
            exit;
        }

        $id = !empty($_POST['id']) ? (int)$_POST['id'] : null;
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $role = trim($_POST['role'] ?? 'admin');

        try {
            if ($id) {
                User::update($id, [
                    'name'     => $name,
                    'email'    => $email,
                    'password' => $password,
                    'role'     => $role
                ]);
                $_SESSION['panel_success'] = 'Yönetici hesabı güncellendi.';
            } else {
                if (empty($password)) {
                    throw new Exception("Yeni yönetici için şifre belirlemelisiniz!");
                }
                User::create([
                    'name'     => $name,
                    'email'    => $email,
                    'password' => $password,
                    'role'     => $role
                ]);
                $_SESSION['panel_success'] = 'Yeni yönetici hesabı başarıyla oluşturuldu.';
            }
        } catch (Exception $e) {
            $_SESSION['panel_error'] = $e->getMessage();
        }

        header("Location: " . BASE_URL . "/index.php?url=" . PANEL_SLUG . "/users");
        exit;
    }

    /**
     * Yönetici Sil (Dokunulmazlık Korumalı)
     */
    public function deleteUser(): void
    {
        $this->requireAuth();
        $id = (int)($_GET['id'] ?? 0);

        try {
            User::delete($id);
            $_SESSION['panel_success'] = 'Yönetici hesabı başarıyla silindi.';
        } catch (Exception $e) {
            $_SESSION['panel_error'] = $e->getMessage();
        }

        header("Location: " . BASE_URL . "/index.php?url=" . PANEL_SLUG . "/users");
        exit;
    }
}
