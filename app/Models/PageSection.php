<?php
/**
 * BİKGRUP - Dinamik Sayfa Bölümleri Modeli
 */

declare(strict_types=1);

require_once ROOT_PATH . '/config/database.php';

class PageSection
{
    private static array $sectionsCache = [];

    /**
     * Belirli bir sayfanın tüm bölümlerini getirir
     */
    public static function getPageSections(string $pageKey): array
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM page_sections WHERE page_key = ?");
        $stmt->execute([$pageKey]);
        $rows = $stmt->fetchAll();

        $sections = [];
        foreach ($rows as $row) {
            $row['extra'] = !empty($row['extra_json']) ? json_decode($row['extra_json'], true) : [];
            $sections[$row['section_key']] = $row;
        }
        return $sections;
    }

    /**
     * Tekil bölümü anahtara göre getirir
     */
    public static function get(string $sectionKey): ?array
    {
        if (isset(self::$sectionsCache[$sectionKey])) {
            return self::$sectionsCache[$sectionKey];
        }

        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM page_sections WHERE section_key = ? LIMIT 1");
        $stmt->execute([$sectionKey]);
        $row = $stmt->fetch();

        if ($row) {
            $row['extra'] = !empty($row['extra_json']) ? json_decode($row['extra_json'], true) : [];
            self::$sectionsCache[$sectionKey] = $row;
            return $row;
        }

        return null;
    }

    /**
     * Bölüm güncelle
     */
    public static function update(string $sectionKey, array $data): bool
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE page_sections SET 
            title_tr = ?, title_en = ?, subtitle_tr = ?, subtitle_en = ?, 
            body_tr = ?, body_en = ?, extra_json = ? 
            WHERE section_key = ?");

        $extraJson = isset($data['extra']) ? json_encode($data['extra'], JSON_UNESCAPED_UNICODE) : null;

        return $stmt->execute([
            $data['title_tr'],
            $data['title_en'] ?? $data['title_tr'],
            $data['subtitle_tr'] ?? '',
            $data['subtitle_en'] ?? '',
            $data['body_tr'] ?? '',
            $data['body_en'] ?? '',
            $extraJson,
            $sectionKey
        ]);
    }

    /**
     * Tüm bölümleri listeler (Admin paneli için)
     */
    public static function all(): array
    {
        $db = Database::getConnection();
        return $db->query("SELECT * FROM page_sections ORDER BY page_key ASC, id ASC")->fetchAll();
    }
}
