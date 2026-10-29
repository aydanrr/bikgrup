<?php
/**
 * BİKGRUP - xpanel Genel Ayarlar ve İletişim Bilgileri
 */

declare(strict_types=1);
?>

<div class="panel-card">
    <div class="panel-card-header">
        <div>
            <h2 class="panel-card-title">⚙️ Genel Site & İletişim Ayarları</h2>
            <p style="color: var(--panel-text-muted); font-size: 14px; margin-top: 4px;">
                Firma adı, logo metni, iletişim telefonları ve adres bilgilerini güncelleyin.
            </p>
        </div>
    </div>

    <form action="<?= BASE_URL ?>/index.php?url=<?= PANEL_SLUG ?>/save-settings" method="POST">
        <?= Security::csrfField() ?>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
            <?php foreach ($generalSettings as $setting): ?>
                <div class="form-group" style="<?= $setting['input_type'] === 'textarea' ? 'grid-column: span 2;' : '' ?>">
                    <label class="form-label">
                        <?= htmlspecialchars($setting['label_tr']) ?>
                    </label>

                    <?php if ($setting['input_type'] === 'textarea'): ?>
                        <textarea name="<?= htmlspecialchars($setting['setting_key']) ?>" rows="3" class="form-control"><?= htmlspecialchars($setting['setting_value'] ?? '') ?></textarea>
                    <?php else: ?>
                        <input type="text" 
                               name="<?= htmlspecialchars($setting['setting_key']) ?>" 
                               value="<?= htmlspecialchars($setting['setting_value'] ?? '') ?>" 
                               class="form-control">
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <div style="margin-top: 24px; text-align: right;">
            <button type="submit" class="btn btn-primary" style="padding: 12px 32px;">
                💾 Bilgileri Güncelle
            </button>
        </div>
    </form>
</div>
