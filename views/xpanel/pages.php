<?php
/**
 * BİKGRUP - xpanel Dinamik Sayfa Bölümleri Yönetimi
 */

declare(strict_types=1);
?>

<div class="panel-card">
    <div class="panel-card-header">
        <div>
            <h2 class="panel-card-title">📄 Dinamik Sayfa Bölümleri Yönetimi</h2>
            <p style="color: var(--panel-text-muted); font-size: 14px; margin-top: 4px;">
                Anasayfa hero metinleri, tesis açıklamaları ve kurumsal hikaye alanlarını buradan düzenleyebilirsiniz.
            </p>
        </div>
    </div>

    <div style="display: flex; flex-direction: column; gap: 30px;">
        <?php foreach ($sections as $sec): ?>
            <div style="background: #f8fafc; border: 1.5px solid var(--panel-border); border-radius: 16px; padding: 24px;">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 16px; border-bottom:1px solid #e2e8f0; padding-bottom:12px;">
                    <div>
                        <span style="font-size: 12px; font-weight: 800; background: #e2e8f0; color: #475569; padding: 3px 10px; border-radius: 20px; text-transform: uppercase;">
                            <?= htmlspecialchars($sec['page_key']) ?> &gt; <?= htmlspecialchars($sec['section_key']) ?>
                        </span>
                    </div>
                </div>

                <form action="<?= BASE_URL ?>/index.php?url=<?= PANEL_SLUG ?>/save-page" method="POST">
                    <?= Security::csrfField() ?>
                    <input type="hidden" name="section_key" value="<?= htmlspecialchars($sec['section_key']) ?>">

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 16px;">
                        <div>
                            <label class="form-label">Üst Etiket / Rozet (TR)</label>
                            <input type="text" name="subtitle_tr" value="<?= htmlspecialchars($sec['subtitle_tr'] ?? '') ?>" class="form-control">
                        </div>
                        <div>
                            <label class="form-label">Üst Etiket / Rozet (EN)</label>
                            <input type="text" name="subtitle_en" value="<?= htmlspecialchars($sec['subtitle_en'] ?? '') ?>" class="form-control">
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 16px;">
                        <div>
                            <label class="form-label">Ana Başlık (TR)</label>
                            <textarea name="title_tr" rows="2" class="form-control"><?= htmlspecialchars($sec['title_tr'] ?? '') ?></textarea>
                        </div>
                        <div>
                            <label class="form-label">Ana Başlık (EN)</label>
                            <textarea name="title_en" rows="2" class="form-control"><?= htmlspecialchars($sec['title_en'] ?? '') ?></textarea>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 16px;">
                        <div>
                            <label class="form-label">Açıklama / Gövde Metni (TR)</label>
                            <textarea name="body_tr" rows="4" class="form-control"><?= htmlspecialchars($sec['body_tr'] ?? '') ?></textarea>
                        </div>
                        <div>
                            <label class="form-label">Açıklama / Gövde Metni (EN)</label>
                            <textarea name="body_en" rows="4" class="form-control"><?= htmlspecialchars($sec['body_en'] ?? '') ?></textarea>
                        </div>
                    </div>

                    <div style="text-align: right;">
                        <button type="submit" class="btn btn-primary" style="padding: 10px 24px; font-size: 14px;">
                            💾 Bu Bölümü Güncelle
                        </button>
                    </div>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</div>
