<?php
/**
 * BİKGRUP - Açık Renkli, Yaratıcı & Sanatsal Altbilgi (Footer) Şablonu
 * Sol Tarafta Instagram Butonu, Sağ Tarafta WhatsApp Butonu
 */

declare(strict_types=1);

$currentLang = Lang::current();
$whatsapp = Settings::get('site_whatsapp', '+905320000000');
$phone = Settings::get('site_phone', '+90 (242) 555 01 23');
$email = Settings::get('site_email', 'info@bikgrup.com');
$address = Settings::getLocalized('site_address', 'Organize Sanayi Bölgesi 4. Cadde No: 18, Antalya / TÜRKİYE');
$instagram = Settings::get('social_instagram', 'https://instagram.com/bikgrup');
?>

    <!-- SOL ALT: Floating Instagram Butonu (Kullanıcı Talebi) -->
    <a href="<?= htmlspecialchars($instagram) ?>" 
       target="_blank" 
       rel="noopener noreferrer" 
       class="floating-instagram-btn anim-pulse" 
       title="Instagram'da BİKGRUP'u Takip Edin">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
        </svg>
        <span>Instagram</span>
    </a>

    <!-- SAĞ ALT: Floating WhatsApp Butonu -->
    <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $whatsapp) ?>?text=Merhaba,%20BİKGRUP%20ürünleri%20hakkında%20bilgi%20almak%20istiyorum." 
       target="_blank" 
       rel="noopener noreferrer" 
       class="floating-action-btn anim-pulse" 
       title="WhatsApp ile Bilgi Al">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12.031 2C6.495 2 2 6.495 2 12.031c0 1.956.564 3.782 1.541 5.334L2 22l4.795-1.503a9.98 9.98 0 005.236 1.488c5.536 0 10.031-4.495 10.031-10.031C22.062 6.495 17.567 2 12.031 2zm5.733 14.18c-.244.685-1.42 1.306-1.954 1.365-.494.054-1.127.08-3.266-.807-2.735-1.134-4.507-3.904-4.644-4.088-.136-.184-1.112-1.478-1.112-2.82 0-1.341.704-2.001.954-2.274.244-.265.535-.333.712-.333.178 0 .356.002.511.01.168.008.39-.064.611.468.228.552.778 1.899.845 2.036.067.137.112.298.023.475-.09.178-.134.29-.267.445-.133.155-.28.347-.399.466-.134.133-.274.278-.118.545.156.267.692 1.142 1.487 1.85 1.024.912 1.888 1.195 2.155 1.328.267.134.423.112.578-.067.156-.178.667-.778.845-1.045.178-.267.356-.222.6-.133.245.089 1.556.734 1.823.867.267.134.445.2.511.312.067.111.067.645-.177 1.33z"/>
        </svg>
        <span>Bilgi Al</span>
    </a>

    <!-- YENİ: AÇIK RENKLİ & SANATSAL MİMARİ FOOTER (KULLANICI TALEBİ) -->
    <footer class="footer-creative">
        <div class="container">
            <!-- Footer Alanları (Beyaz Blok Kutusu Kaldırıldı, Doğal & Ferah Mimari) -->
            <div class="footer-grid">
                
                <!-- 1. Marka ve Tanıtım -->
                <div class="footer-col-brand">
                    <a href="<?= BASE_URL ?>/" class="bik-logo" style="margin-bottom: 20px;">
                        <span class="logo-leaf-icon">🌿</span>
                        <span class="logo-brand"><span class="bold">BİK</span><span class="accent">GRUP</span></span>
                    </a>
                    <p style="color: #64748b; font-size: 15px; line-height: 1.8; margin-bottom: 26px; max-width: 360px;">
                        <?= __('footer_about_text') ?>
                    </p>
                    
                    <!-- Sosyal Medya İkonları -->
                    <div style="display: flex; gap: 12px;">
                        <a href="<?= htmlspecialchars($instagram) ?>" target="_blank" style="display:inline-flex; align-items:center; justify-content:center; width:42px; height:42px; border-radius:12px; background:#f1f5f9; color:#e1306c; font-weight:700; transition:all 0.2s;" title="Instagram">
                            IG
                        </a>
                        <a href="<?= htmlspecialchars(Settings::get('social_linkedin', '#')) ?>" target="_blank" style="display:inline-flex; align-items:center; justify-content:center; width:42px; height:42px; border-radius:12px; background:#f1f5f9; color:#0a66c2; font-weight:700; transition:all 0.2s;" title="LinkedIn">
                            IN
                        </a>
                    </div>
                </div>

                <!-- 2. Hızlı Kurumsal Bağlantılar -->
                <div>
                    <h4 class="footer-heading"><?= __('footer_quick_links') ?></h4>
                    <ul class="footer-links">
                        <li><a href="<?= BASE_URL ?>/"><?= __('nav_home') ?></a></li>
                        <li><a href="<?= BASE_URL ?>/kurumsal"><?= __('nav_about') ?></a></li>
                        <li><a href="<?= BASE_URL ?>/urunler"><?= __('nav_products') ?></a></li>
                        <li><a href="<?= BASE_URL ?>/blog"><?= __('nav_blog') ?></a></li>
                        <li><a href="<?= BASE_URL ?>/iletisim"><?= __('nav_contact') ?></a></li>
                    </ul>
                </div>

                <!-- 3. Ürün Kategorileri -->
                <div>
                    <h4 class="footer-heading"><?= __('nav_products') ?></h4>
                    <ul class="footer-links">
                        <li><a href="<?= BASE_URL ?>/urunler?kategori=narenciye"><?= __('cat_citrus') ?></a></li>
                        <li><a href="<?= BASE_URL ?>/urunler?kategori=meyveler"><?= __('cat_fruits') ?></a></li>
                        <li><a href="<?= BASE_URL ?>/urunler?kategori=sebzeler"><?= __('cat_vegetables') ?></a></li>
                        <li><a href="<?= BASE_URL ?>/kurumsal#sertifikalar"><?= $currentLang === 'en' ? 'Quality Certificates' : 'Kalite Belgeleri' ?></a></li>
                    </ul>
                </div>

                <!-- 4. KULLANICI TALEBİ: Politikalar Sütunu -->
                <div>
                    <h4 class="footer-heading"><?= $currentLang === 'en' ? 'Policies' : 'Politikalar' ?></h4>
                    <ul class="footer-links">
                        <li><a href="<?= BASE_URL ?>/gizlilik"><?= $currentLang === 'en' ? 'Privacy Policy' : 'Gizlilik Politikası' ?></a></li>
                        <li><a href="<?= BASE_URL ?>/kvkk"><?= $currentLang === 'en' ? 'GDPR / KVKK Clarification' : 'KVKK Aydınlatma Metni' ?></a></li>
                        <li><a href="<?= BASE_URL ?>/cerez-politikasi"><?= $currentLang === 'en' ? 'Cookie Policy' : 'Çerez Politikası' ?></a></li>
                        <li><a href="<?= BASE_URL ?>/politikalar"><?= $currentLang === 'en' ? 'Corporate Compliance' : 'Kurumsal İlkeler' ?></a></li>
                    </ul>
                </div>

                <!-- 5. İletişim & Lokasyon -->
                <div>
                    <h4 class="footer-heading"><?= __('footer_contact_info') ?></h4>
                    <div class="footer-contact-item">
                        <span style="font-size: 16px;">📍</span>
                        <span><?= htmlspecialchars($address) ?></span>
                    </div>
                    <div class="footer-contact-item">
                        <span style="font-size: 16px;">📞</span>
                        <a href="tel:<?= preg_replace('/[^0-9+]/', '', $phone) ?>" style="color: var(--theme-primary); font-weight:700;">
                            <?= htmlspecialchars($phone) ?>
                        </a>
                    </div>
                    <div class="footer-contact-item">
                        <span style="font-size: 16px;">✉️</span>
                        <a href="mailto:<?= htmlspecialchars($email) ?>" style="color: #475569;">
                            <?= htmlspecialchars($email) ?>
                        </a>
                    </div>
                </div>

            </div>

            <!-- Alt Telif Çubuğu: KULLANICI TALEBİ EN ALTTA ORTALANDI -->
            <div class="footer-bottom-bar">
                <div>
                    &copy; <?= date('Y') ?> <strong><?= htmlspecialchars(Settings::get('site_name', 'BİKGRUP')) ?></strong>. <?= __('footer_rights') ?>
                </div>
                <div style="font-size: 13px; opacity: 0.85;">
                    <a href="<?= BASE_URL ?>/gizlilik"><?= $currentLang === 'en' ? 'Privacy' : 'Gizlilik' ?></a> &bull; 
                    <a href="<?= BASE_URL ?>/kvkk">KVKK</a> &bull; 
                    <a href="<?= BASE_URL ?>/cerez-politikasi"><?= $currentLang === 'en' ? 'Cookies' : 'Çerezler' ?></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Ana JavaScript Motoru -->
    <script src="<?= BASE_URL ?>/public/js/main.js"></script>
</body>
</html>
