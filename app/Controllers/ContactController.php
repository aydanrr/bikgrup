<?php
/**
 * BİKGRUP - İletişim Kontrolcüsü
 */

declare(strict_types=1);

require_once ROOT_PATH . '/core/View.php';
require_once ROOT_PATH . '/core/Security.php';
require_once ROOT_PATH . '/app/Models/Message.php';

class ContactController
{
    public function index(): void
    {
        $status = $_GET['status'] ?? null;

        View::render('contact', [
            'pageTitle' => __('nav_contact') . ' | ' . Settings::get('site_name', 'BİKGRUP'),
            'status'    => $status,
            'activeNav' => 'contact'
        ]);
    }

    public function submit(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . BASE_URL . "/index.php?url=contact");
            exit;
        }

        // CSRF Doğrulaması
        if (!Security::validateCsrf($_POST['csrf_token'] ?? null)) {
            header("Location: " . BASE_URL . "/index.php?url=contact&status=csrf_error");
            exit;
        }

        // Rate Limit (Dakikada en fazla 3 form gönderimi)
        if (!Security::checkRateLimit('contact_form', 3, 60)) {
            header("Location: " . BASE_URL . "/index.php?url=contact&status=rate_limited");
            exit;
        }

        $name = Security::clean($_POST['name'] ?? '');
        $email = Security::clean($_POST['email'] ?? '');
        $phone = Security::clean($_POST['phone'] ?? '');
        $subject = Security::clean($_POST['subject'] ?? '');
        $message = Security::clean($_POST['message'] ?? '');

        if (empty($name) || empty($email) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Security::recordFailedAttempt('contact_form');
            header("Location: " . BASE_URL . "/index.php?url=contact&status=invalid");
            exit;
        }

        // Mesajı kaydet
        Message::create([
            'name'    => $name,
            'email'   => $email,
            'phone'   => $phone,
            'subject' => $subject ?: 'Genel Bilgi ve Sipariş Talebi',
            'message' => $message
        ]);

        header("Location: " . BASE_URL . "/index.php?url=contact&status=success");
        exit;
    }
}
