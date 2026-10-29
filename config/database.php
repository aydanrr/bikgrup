<?php
/**
 * BİKGRUP - Veritabanı Yönetici Sınıfı
 * PHP 8.2 / 8.3 / 8.4 Uyumlu PDO Singleton
 */

declare(strict_types=1);

require_once __DIR__ . '/config.php';

class Database
{
    private static ?PDO $instance = null;

    /**
     * Singleton PDO Bağlantısı
     */
    public static function getConnection(): PDO
    {
        if (self::$instance === null) {
            try {
                // İlk olarak veritabanı var mı kontrol et, yoksa oluştur
                self::ensureDatabaseExists();

                $dsn = sprintf(
                    'mysql:host=%s;port=%s;dbname=%s;charset=%s',
                    DB_HOST,
                    DB_PORT,
                    DB_NAME,
                    DB_CHARSET
                );

                $options = [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
                ];

                self::$instance = new PDO($dsn, DB_USER, DB_PASS, $options);

                // Tablolar oluşturulmuş mu kontrol et
                self::ensureTablesExist();

            } catch (PDOException $e) {
                // Hata durumunda güvenli ve bilgilendirici mesaj
                die("<div style='font-family:sans-serif;padding:30px;background:#fff1f2;color:#9f1239;border:1px solid #fecdd3;border-radius:12px;max-width:600px;margin:50px auto;box-shadow:0 10px 25px rgba(0,0,0,0.05);'>
                    <h3 style='margin-top:0;'>⚠️ Veritabanı Bağlantı Hatası</h3>
                    <p>MySQL sunucusuna bağlanırken bir sorun oluştu:</p>
                    <code style='background:#ffe4e6;padding:4px 8px;border-radius:4px;display:block;margin:10px 0;'>" . htmlspecialchars($e->getMessage()) . "</code>
                    <small>Lütfen XAMPP MySQL servisinin çalıştığından emin olun.</small>
                </div>");
            }
        }

        return self::$instance;
    }

    /**
     * Veritabanının var olduğunu garanti eder, yoksa oluşturur
     */
    private static function ensureDatabaseExists(): void
    {
        try {
            $pdo = new PDO(
                sprintf('mysql:host=%s;port=%s', DB_HOST, DB_PORT),
                DB_USER,
                DB_PASS,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
            $pdo->exec(sprintf(
                "CREATE DATABASE IF NOT EXISTS `%s` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci",
                DB_NAME
            ));
        } catch (PDOException $e) {
            // Sessizce geç veya bağlantı adımında hata yakalanır
        }
    }

    /**
     * Tabloların varlığını kontrol eder, eksikse schema.sql'i çalıştırır
     */
    private static function ensureTablesExist(): void
    {
        if (self::$instance === null) {
            return;
        }

        $stmt = self::$instance->query("SHOW TABLES LIKE 'users'");
        if ($stmt->rowCount() === 0) {
            $schemaFile = CONFIG_PATH . '/schema.sql';
            if (file_exists($schemaFile)) {
                $sql = file_get_contents($schemaFile);
                if ($sql !== false) {
                    self::$instance->exec($sql);
                }
            }
        }
    }
}
