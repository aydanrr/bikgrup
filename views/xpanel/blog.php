<?php
/**
 * BİKGRUP - xpanel Blog Yönetimi
 */

declare(strict_types=1);
?>

<div class="panel-card">
    <div class="panel-card-header">
        <div>
            <h2 class="panel-card-title">📰 Blog ve Haber Yönetimi</h2>
            <p style="color: var(--panel-text-muted); font-size: 14px; margin-top: 4px;">
                Sektörel analizler, soğuk zincir rehberleri ve şirket duyurularını yönetin.
            </p>
        </div>
        <div>
            <button onclick="openModal('blogModal')" class="btn btn-primary" style="padding: 10px 22px;">
                + Yeni Yazı Ekle
            </button>
        </div>
    </div>

    <table class="panel-table">
        <thead>
            <tr>
                <th>Görsel</th>
                <th>Başlık (TR)</th>
                <th>Okuma Süresi</th>
                <th>Tarih</th>
                <th style="text-align: right;">İşlemler</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($posts as $post): ?>
                <tr>
                    <td style="width: 60px;">
                        <img src="<?= BASE_URL ?>/public/images/<?= htmlspecialchars($post['image'] ?: 'blog_cold_chain.png') ?>" style="width: 48px; height: 48px; border-radius: 10px; object-fit: cover;">
                    </td>
                    <td style="font-weight: 700;">
                        <?= htmlspecialchars($post['title_tr']) ?>
                    </td>
                    <td>
                        ⏱ <?= htmlspecialchars($post['read_time']) ?>
                    </td>
                    <td style="font-size: 13px; color: #64748b;">
                        <?= date('d.m.Y', strtotime($post['created_at'])) ?>
                    </td>
                    <td style="text-align: right;">
                        <a href="<?= BASE_URL ?>/index.php?url=blog/<?= urlencode($post['slug']) ?>" target="_blank" class="btn" style="padding: 6px 12px; font-size: 12px; background: #e2e8f0; color: #1e293b;">
                            Gör
                        </a>
                        <a href="<?= BASE_URL ?>/index.php?url=<?= PANEL_SLUG ?>/delete-blog&id=<?= $post['id'] ?>" 
                           data-confirm-delete="Bu yazıyı silmek istediğinize emin misiniz?" 
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

<!-- Yeni Blog Modalı -->
<div id="blogModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.6); backdrop-filter: blur(5px); z-index: 1000; align-items: center; justify-content: center; padding: 20px;">
    <div style="background: #ffffff; border-radius: 20px; width: 100%; max-width: 680px; max-height: 90vh; overflow-y: auto; padding: 30px;">
        
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 20px; border-bottom: 1px solid #e2e8f0; padding-bottom: 14px;">
            <h3 style="font-family:'Outfit', sans-serif; font-size: 20px; font-weight: 800;">+ Yeni Blog Yazısı</h3>
            <button onclick="closeModal('blogModal')" style="background:none; border:none; font-size: 20px; cursor: pointer;">✕</button>
        </div>

        <form action="<?= BASE_URL ?>/index.php?url=<?= PANEL_SLUG ?>/save-blog" method="POST">
            <?= Security::csrfField() ?>

            <div style="margin-bottom: 16px;">
                <label class="form-label">Başlık (TR) *</label>
                <input type="text" name="title_tr" required placeholder="Yazı başlığı..." class="form-control">
            </div>

            <div style="margin-bottom: 16px;">
                <label class="form-label">Kısa Özet (TR)</label>
                <textarea name="excerpt_tr" rows="2" class="form-control" placeholder="Yazının kısa girişi..."></textarea>
            </div>

            <div style="margin-bottom: 16px;">
                <label class="form-label">Detaylı Makale İçeriği (TR)</label>
                <textarea name="content_tr" rows="5" class="form-control" placeholder="Yazının tam içeriği (HTML veya paragraf destekler)..."></textarea>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px;">
                <div>
                    <label class="form-label">Okuma Süresi</label>
                    <input type="text" name="read_time" value="4 dk" class="form-control">
                </div>
                <div>
                    <label class="form-label">Kapak Görseli</label>
                    <select name="image" class="form-control">
                        <option value="facility_automation.jpg">Modern Tesis (facility_automation.jpg)</option>
                        <option value="fresh_vegetables.jpg">Sebzeler (fresh_vegetables.jpg)</option>
                        <option value="hero_box.jpg">Hasat Kasası (hero_box.jpg)</option>
                        <option value="citrus_showcase.jpg">Narenciye (citrus_showcase.jpg)</option>
                    </select>
                </div>
            </div>

            <div style="text-align: right; display: flex; justify-content: flex-end; gap: 12px;">
                <button type="button" onclick="closeModal('blogModal')" class="btn" style="background:#e2e8f0; color:#1e293b;">İptal</button>
                <button type="submit" class="btn btn-primary">Yazıyı Yayınla</button>
            </div>
        </form>

    </div>
</div>
