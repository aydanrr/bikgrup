<?php
/**
 * BİKGRUP - Yönetici ve Kullanıcı Modeli
 * Süleyman Admin Dokunulmazlık Kuralları Tam Entegre
 */

declare(strict_types=1);

require_once ROOT_PATH . '/config/database.php';
require_once ROOT_PATH . '/core/Security.php';
require_once ROOT_PATH . '/core/Auth.php';

class User
{
    public static function all(): array
    {
        $db = Database::getConnection();
        return $db->query("SELECT id, name, email, role, is_immutable, last_login, created_at FROM users ORDER BY is_immutable DESC, id ASC")->fetchAll();
    }

    public static function find(int $id): ?array
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT id, name, email, role, is_immutable, last_login, created_at FROM users WHERE id = ? LIMIT 1");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function create(array $data): bool
    {
        $db = Database::getConnection();

        // Aynı e-posta var mı kontrol et
        $check = $db->prepare("SELECT id FROM users WHERE email = ?");
        $check->execute([$data['email']]);
        if ($check->fetch()) {
            throw new Exception("Bu e-posta adresi ile zaten kayıtlı bir yönetici var!");
        }

        $stmt = $db->prepare("INSERT INTO users (name, email, password, role, is_immutable) VALUES (?, ?, ?, ?, 0)");
        return $stmt->execute([
            $data['name'],
            $data['email'],
            Security::hashPassword($data['password']),
            $data['role'] ?? 'admin'
        ]);
    }

    public static function update(int $id, array $data): bool
    {
        $user = self::find($id);
        if (!$user) {
            throw new Exception("Yönetici bulunamadı!");
        }

        // Dokunulmaz Süper Admin Kontrolü
        if ((int)$user['is_immutable'] === 1 || strtolower($user['email']) === 'suleymannozer0@gmail.com') {
            // Eğer giriş yapan kişi bu süper admin değilse işlem engellenir!
            if (Auth::id() !== $id) {
                throw new Exception("Süleyman Özer (Süper Admin) dokunulmazdır ve başka bir yönetici tarafından düzenlenemez!");
            }
            // Kendi rolünü düşüremez
            $data['role'] = 'superadmin';
        }

        $db = Database::getConnection();

        if (!empty($data['password'])) {
            $stmt = $db->prepare("UPDATE users SET name = ?, email = ?, password = ?, role = ? WHERE id = ?");
            return $stmt->execute([
                $data['name'],
                $data['email'],
                Security::hashPassword($data['password']),
                $data['role'],
                $id
            ]);
        } else {
            $stmt = $db->prepare("UPDATE users SET name = ?, email = ?, role = ? WHERE id = ?");
            return $stmt->execute([
                $data['name'],
                $data['email'],
                $data['role'],
                $id
            ]);
        }
    }

    public static function delete(int $id): bool
    {
        $user = self::find($id);
        if (!$user) {
            throw new Exception("Yönetici bulunamadı!");
        }

        // KESİN DOKUNULMAZLIK KURALI
        if ((int)$user['is_immutable'] === 1 || strtolower($user['email']) === 'suleymannozer0@gmail.com') {
            throw new Exception("Süleyman Özer (Süper Admin) dokunulmazdır ve KESİNLİKLE SİLİNEMEZ!");
        }

        if (Auth::id() === $id) {
            throw new Exception("Kendi hesabınızı silemezsiniz!");
        }

        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
