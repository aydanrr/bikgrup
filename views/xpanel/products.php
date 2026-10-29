<?php
/**
 * BİKGRUP - xpanel Ürün Yönetimi
 */

declare(strict_types=1);
?>

<div class="panel-card">
    <div class="panel-card-header">
        <div>
            <h2 class="panel-card-title">🍊 Ürün ve Hasat Yönetimi</h2>
            <p style="color: var(--panel-text-muted); font-size: 14px; margin-top: 4px;">
                Mevcut ürünleri güncelleyin veya yeni taze hasat ürünü ekleyin.
            </p>
        </div>
        <div>
            <button onclick="openModal('productModal')" class="btn btn-primary" style="padding: 10px 22px;">
                + Yeni Ürün Ekle
            </button>
        </div>
    </div>

    <table class="panel-table">
        <thead>
            <tr>
                <th>Görsel</th>
                <th>Ürün Adı (TR / EN)</th>
                <th>Kategori</th>
                <th>Hasat Sezonu</th>
                <th>Öne Çıkan</th>
                <th style="text-align: right;">İşlemler</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $prod): ?>
                <tr>
                    <td style="width: 60px;">
                        <img src="<?= BASE_URL ?>/public/images/<?= htmlspecialchars($prod['image'] ?: 'citrus_showcase.jpg') ?>" style="width: 48px; height: 48px; border-radius: 10px; object-fit: cover;">
                    </td>
                    <td>
                        <div style="font-weight: 700; font-size: 15px; color: var(--panel-text);">
                            <?= htmlspecialchars($prod['name_tr']) ?>
                        </div>
                        <div style="font-size: 12px; color: #64748b;">
                            <?= htmlspecialchars($prod['name_en'] ?? '') ?>
                        </div>
                    </td>
                    <td>
                        <span style="font-size: 13px; font-weight: 700; color: <?= htmlspecialchars($prod['badge_color'] ?? '#15803d') ?>;">
                            <?= htmlspecialchars($prod['category_name_tr'] ?? '') ?>
                        </span>
                    </td>
                    <td style="font-size: 13px; color: #475569;">
                        <?= htmlspecialchars($prod['harvest_season_tr'] ?: 'Tüm Yıl') ?>
                    </td>
                    <td>
                        <?= $prod['is_featured'] ? '⭐ Evet' : '—' ?>
                    </td>
                    <td style="text-align: right;">
                        <a href="<?= BASE_URL ?>/index.php?url=products/<?= urlencode($prod['slug']) ?>" target="_blank" class="btn" style="padding: 6px 12px; font-size: 12px; background: #e2e8f0; color: #1e293b;">
                            Gör
                        </a>
                        <a href="<?= BASE_URL ?>/index.php?url=<?= PANEL_SLUG ?>/delete-product&id=<?= $prod['id'] ?>" 
                           data-confirm-delete="<?= htmlspecialchars($prod['name_tr']) ?> ürününü silmek istediğinize emin misiniz?" 
                           class="btn" 
                           style="padding: 6px 12px; font-size: 12px; background: #fee2e2; color: #991b1b;">
                            Sil
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Yeni Ürün Ekleme Modalı -->
<div id="productModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.6); backdrop-filter: blur(5px); z-index: 1000; align-items: center; justify-content: center; padding: 20px;">
    <div style="background: #ffffff; border-radius: 20px; width: 100%; max-width: 680px; max-height: 90vh; overflow-y: auto; padding: 30px; box-shadow: 0 25px 60px rgba(0,0,0,0.25);">
        
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 20px; border-bottom: 1px solid #e2e8f0; padding-bottom: 14px;">
            <h3 style="font-family:'Outfit', sans-serif; font-size: 20px; font-weight: 800;">+ Yeni Ürün Ekle</h3>
            <button onclick="closeModal('productModal')" style="background:none; border:none; font-size: 20px; cursor: pointer;">✕</button>
        </div>

        <form action="<?= BASE_URL ?>/index.php?url=<?= PANEL_SLUG ?>/save-product" method="POST">
            <?= Security::csrfField() ?>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                <div>
                    <label class="form-label">Kategori *</label>
                    <select name="category_id" required class="form-control">
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name_tr']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label class="form-label">Görsel Seçimi</label>
                    <select name="image" class="form-control">
                        <option value="citrus_showcase.jpg">Narenciye Vitrini (citrus_showcase.jpg)</option>
                        <option value="fresh_fruits.jpg">Meyveler Vitrini (fresh_fruits.jpg)</option>
                        <option value="fresh_vegetables.jpg">Sebzeler Vitrini (fresh_vegetables.jpg)</option>
                        <option value="hero_box.jpg">Ahşap Kasa Hasat (hero_box.jpg)</option>
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                <div>
                    <label class="form-label">Ürün Adı (TR) *</label>
                    <input type="text" name="name_tr" required placeholder="Örn: Riored Greyfurt" class="form-control">
                </div>
                <div>
                    <label class="form-label">Ürün Adı (EN)</label>
                    <input type="text" name="name_en" placeholder="Örn: Riored Grapefruit" class="form-control">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                <div>
                    <label class="form-label">Hasat Sezonu (TR)</label>
                    <input type="text" name="harvest_season_tr" value="Ekim - Nisan" class="form-control">
                </div>
                <div>
                    <label class="form-label">Hasat Sezonu (EN)</label>
                    <input type="text" name="harvest_season_en" value="October - April" class="form-control">
                </div>
            </div>

            <div style="margin-bottom: 16px;">
                <label class="form-label">Kısa Açıklama (TR)</label>
                <textarea name="short_desc_tr" rows="2" class="form-control" placeholder="Öne çıkan lezzet özellikleri..."></textarea>
            </div>

            <div style="margin-bottom: 20px;">
                <label class="form-label">Detaylı İçerik ve Kalite Standartları</label>
                <textarea name="content_tr" rows="3" class="form-control" placeholder="Besin değeri, optik tasnif ve ihracat kalibresi detayları..."></textarea>
            </div>

            <div style="display: flex; gap: 20px; align-items: center; margin-bottom: 24px;">
                <label style="display:flex; align-items:center; gap: 8px; font-weight: 600; cursor: pointer;">
                    <input type="checkbox" name="is_featured" value="1" checked> Öne Çıkan Ürün
                </label>
                <label style="display:flex; align-items:center; gap: 8px; font-weight: 600; cursor: pointer;">
                    <input type="checkbox" name="is_active" value="1" checked> Yayında
                </label>
            </div>

            <div style="text-align: right; display: flex; justify-content: flex-end; gap: 12px;">
                <button type="button" onclick="closeModal('productModal')" class="btn" style="background:#e2e8f0; color:#1e293b;">İptal</button>
                <button type="submit" class="btn btn-primary">Ürünü Kaydet</button>
            </div>
        </form>

    </div>
</div>
