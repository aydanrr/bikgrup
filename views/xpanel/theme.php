<?php
/**
 * BİKGRUP - xpanel Canlı Tema ve Renk Yöneticisi
 */

declare(strict_types=1);

$themeMap = [];
foreach ($themeSettings as $s) {
    $themeMap[$s['setting_key']] = $s;
}
?>

<div class="panel-card">
    <div class="panel-card-header">
        <div>
            <h2 class="panel-card-title">🎨 Canlı Tema & Renk Özelleştirici</h2>
            <p style="color: var(--panel-text-muted); font-size: 14px; margin-top: 4px;">
                Sitenin ana renklerini, buton tonlarını ve yazı renklerini buradan özelleştirebilirsiniz. Kaydettiğiniz anda tüm sitede aktif olur.
            </p>
        </div>
        <div>
            <button type="submit" form="theme-form" class="btn btn-primary" style="padding: 12px 28px;">
                💾 Değişiklikleri Kaydet
            </button>
        </div>
    </div>

    <!-- Canlı Önizleme Simülatörü -->
    <div style="background: #ffffff; border-radius: 20px; padding: 24px; border: 2px dashed #cbd5e1; margin-bottom: 30px;">
        <h4 style="font-size: 14px; font-weight: 700; color: var(--panel-text-muted); text-transform: uppercase; margin-bottom: 14px;">
            Canlı Önizleme Simülasyonu
        </h4>
        <div style="display: flex; gap: 20px; align-items: center; flex-wrap: wrap;">
            <button type="button" id="preview-btn-primary" class="btn btn-primary">Örnek Birincil Buton</button>
            <button type="button" id="preview-btn-secondary" class="btn btn-secondary">Örnek İkincil Buton</button>
            <span id="preview-heading" style="font-family:'Outfit', sans-serif; font-size: 22px; font-weight: 800; color: var(--theme-primary);">
                Başlık Vurgu Rengi
            </span>
            <span id="preview-text" style="font-size: 14px; color: var(--theme-text-muted);">
                Örnek alt açıklama metni...
            </span>
        </div>
    </div>

    <form id="theme-form" action="<?= BASE_URL ?>/index.php?url=<?= PANEL_SLUG ?>/save-theme" method="POST">
        <?= Security::csrfField() ?>

        <div class="theme-color-grid">
            
            <?php foreach ($themeSettings as $setting): ?>
                <?php if ($setting['input_type'] === 'color'): ?>
                    <div class="theme-color-item">
                        <input type="color" 
                               name="<?= htmlspecialchars($setting['setting_key']) ?>" 
                               value="<?= htmlspecialchars($setting['setting_value'] ?: '#15803d') ?>" 
                               class="theme-color-input">
                        <div style="flex-grow: 1;">
                            <label class="form-label" style="margin-bottom: 2px;">
                                <?= htmlspecialchars($setting['label_tr']) ?>
                            </label>
                            <input type="text" 
                                   data-color-sync="<?= htmlspecialchars($setting['setting_key']) ?>" 
                                   value="<?= htmlspecialchars($setting['setting_value']) ?>" 
                                   class="form-control" 
                                   style="font-family: monospace; font-size: 13px; padding: 6px 10px;">
                        </div>
                    </div>
                <?php else: ?>
                    <div class="theme-color-item" style="grid-column: span 1;">
                        <div style="width: 100%;">
                            <label class="form-label"><?= htmlspecialchars($setting['label_tr']) ?></label>
                            <input type="text" 
                                   name="<?= htmlspecialchars($setting['setting_key']) ?>" 
                                   value="<?= htmlspecialchars($setting['setting_value']) ?>" 
                                   class="form-control">
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>

        </div>

        <div style="margin-top: 30px; text-align: right;">
            <button type="submit" class="btn btn-primary" style="padding: 14px 36px; font-size: 16px;">
                💾 Tüm Tema Renklerini Kaydet
            </button>
        </div>
    </form>
</div>
