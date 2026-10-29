<?php
/**
 * BİKGRUP - xpanel Yöneticiler ve Dokunulmaz Süper Admin Yönetimi
 */

declare(strict_types=1);

$currentUser = Auth::user();
?>

<div class="panel-card">
    <div class="panel-card-header">
        <div>
            <h2 class="panel-card-title">👥 Yönetici Hesapları & Dokunulmazlık Kalkanı</h2>
            <p style="color: var(--panel-text-muted); font-size: 14px; margin-top: 4px;">
                Süleyman Özer (Süper Admin) sistemin dokunulmaz kurucusudur. Yeni yöneticiler eklenebilir ancak hiçbiri Süleyman Admin'e dokunamaz veya silemez.
            </p>
        </div>
        <div>
            <button onclick="openModal('userModal')" class="btn btn-primary" style="padding: 10px 22px;">
                + Yeni Yönetici Ekle
            </button>
        </div>
    </div>

    <!-- Dokunulmazlık Bilgi Kutusu -->
    <div style="background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%); border: 1.5px solid #fde68a; border-radius: 16px; padding: 20px; margin-bottom: 24px; display: flex; align-items: center; gap: 16px;">
        <div style="font-size: 32px;">🛡️</div>
        <div>
            <div style="font-weight: 800; font-size: 15px; color: #92400e;">
                Yüksek Güvenlikli Dokunulmazlık Protokolü Aktif
            </div>
            <div style="font-size: 13px; color: #b45309; margin-top: 2px;">
                <strong>suleymannozer0@gmail.com</strong> hesabı veritabanı ve çekirdek kod katmanında (Auth.php & User.php) dokunulmaz kılınmıştır. Başka hiçbir yönetici bu hesabı silemez veya rolünü değiştiremez.
            </div>
        </div>
    </div>

    <table class="panel-table">
        <thead>
            <tr>
                <th>Yönetici</th>
                <th>E-Posta</th>
                <th>Rol & Statü</th>
                <th>Son Giriş</th>
                <th style="text-align: right;">İşlemler</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $u): ?>
                <?php 
                    $isImmutable = (int)$u['is_immutable'] === 1 || strtolower($u['email']) === 'suleymannozer0@gmail.com'; 
                ?>
                <tr style="<?= $isImmutable ? 'background: #fffdf5;' : '' ?>">
                    <td>
                        <div style="display:flex; align-items:center; gap: 10px;">
                            <div style="width:36px; height:36px; border-radius:50%; background: <?= $isImmutable ? 'linear-gradient(135deg, #f59e0b, #ea580c)' : '#e2e8f0' ?>; color: <?= $isImmutable ? '#ffffff' : '#334155' ?>; display:flex; align-items:center; justify-content:center; font-weight:800; font-size:14px;">
                                <?= strtoupper(substr($u['name'], 0, 1)) ?>
                            </div>
                            <div>
                                <div style="font-weight: 700; font-size: 15px; color: var(--panel-text);">
                                    <?= htmlspecialchars($u['name']) ?>
                                </div>
                                <div style="font-size: 12px; color: #64748b;">
                                    ID: #<?= $u['id'] ?>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span style="font-family: monospace; font-size: 14px; font-weight: 600; color: var(--panel-text);">
                            <?= htmlspecialchars($u['email']) ?>
                        </span>
                    </td>
                    <td>
                        <?php if ($isImmutable): ?>
                            <span class="badge-immutable">
                                👑 DOKUNULMAZ SÜPER ADMİN
                            </span>
                        <?php else: ?>
                            <span style="background: #e2e8f0; color: #334155; font-size: 12px; padding: 3px 10px; border-radius: 20px; font-weight: 700;">
                                Standart Yönetici
                            </span>
                        <?php endif; ?>
                    </td>
                    <td style="font-size: 13px; color: #64748b;">
                        <?= $u['last_login'] ? date('d.m.Y H:i', strtotime($u['last_login'])) : '—' ?>
                    </td>
                    <td style="text-align: right; white-space: nowrap;">
                        <?php if ($isImmutable): ?>
                            <button type="button" disabled title="Bu yönetici dokunulmazdır ve asla silinemez!" style="padding: 6px 14px; font-size: 12px; background: #fef3c7; color: #92400e; border: 1px solid #fcd34d; border-radius: 8px; cursor: not-allowed; font-weight: 700;">
                                🔒 Korumalı (Silinemez)
                            </button>
                        <?php else: ?>
                            <a href="<?= BASE_URL ?>/index.php?url=<?= PANEL_SLUG ?>/delete-user&id=<?= $u['id'] ?>" 
                               data-confirm-delete="<?= htmlspecialchars($u['name']) ?> isimli yöneticiyi silmek istediğinize emin misiniz?" 
                               class="btn" 
                               style="padding: 6px 12px; font-size: 12px; background: #fee2e2; color: #991b1b;">
                                Sil
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Yeni Yönetici Ekleme Modalı -->
<div id="userModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.6); backdrop-filter: blur(5px); z-index: 1000; align-items: center; justify-content: center; padding: 20px;">
    <div style="background: #ffffff; border-radius: 20px; width: 100%; max-width: 520px; padding: 30px; box-shadow: 0 25px 60px rgba(0,0,0,0.25);">
        
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 20px; border-bottom: 1px solid #e2e8f0; padding-bottom: 14px;">
            <h3 style="font-family:'Outfit', sans-serif; font-size: 20px; font-weight: 800;">+ Yeni Yönetici Ekle</h3>
            <button onclick="closeModal('userModal')" style="background:none; border:none; font-size: 20px; cursor: pointer;">✕</button>
        </div>

        <form action="<?= BASE_URL ?>/index.php?url=<?= PANEL_SLUG ?>/save-user" method="POST">
            <?= Security::csrfField() ?>

            <div style="margin-bottom: 16px;">
                <label class="form-label">Yönetici Adı Soyadı *</label>
                <input type="text" name="name" required placeholder="Ad Soyad" class="form-control">
            </div>

            <div style="margin-bottom: 16px;">
                <label class="form-label">E-Posta Adresi *</label>
                <input type="email" name="email" required placeholder="admin2@bikgrup.com" class="form-control">
            </div>

            <div style="margin-bottom: 16px;">
                <label class="form-label">Giriş Şifresi *</label>
                <input type="password" name="password" required placeholder="••••••••" class="form-control">
            </div>

            <div style="margin-bottom: 24px;">
                <label class="form-label">Rol & Yetki</label>
                <select name="role" class="form-control">
                    <option value="admin">Standart Yönetici (İçerik ve Ürün Yönetimi)</option>
                </select>
                <small style="color: #64748b; font-size: 12px; display: block; margin-top: 4px;">
                    * Yeni yöneticiler hiçbir koşulda Süleyman Admin hesabını değiştiremez veya silemez.
                </small>
            </div>

            <div style="text-align: right; display: flex; justify-content: flex-end; gap: 12px;">
                <button type="button" onclick="closeModal('userModal')" class="btn" style="background:#e2e8f0; color:#1e293b;">İptal</button>
                <button type="submit" class="btn btn-primary">Yöneticiyi Ekle</button>
            </div>
        </form>

    </div>
</div>
