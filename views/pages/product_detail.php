<?php
/**
 * BİKGRUP - Ürün Detay Sayfası
 * Görsel Referanslarına Birebir Uygun:
 * 1. Hero Showcase (Dairesel Backdrop, Besin Değerleri, Contents & Teklif Butonu)
 * 2. Meyve Karakteristikleri (Et Rengi, Çekirdek, Kabuk Rengi, Doku, Şekil, Tat)
 * 3. Ürün Cinsleri & Çeşitleri
 * 4. 12 Aylık Hasat & İhracat Sezon Takvimi
 * 5. İhracat Ambalaj & Kutu Seçenekleri (7kg, 15kg, Teleskopik, File)
 */

declare(strict_types=1);

$currentLang = Lang::current();
$prodName = $product['name_' . $currentLang] ?? $product['name_tr'];
$prodShort = $product['short_desc_' . $currentLang] ?? $product['short_desc_tr'];
$prodContent = $product['content_' . $currentLang] ?? $product['content_tr'];
$catName = $product['category_name_' . $currentLang] ?? $product['category_name_tr'];
$whatsapp = Settings::get('site_whatsapp', '+905320000000');
$slug = $product['slug'];

// Ürüne özel cinsler ve hasat takvimi verileri
$varietiesData = [
    'washington-portakal' => [
        ['name' => 'Cara Cara', 'desc' => 'Kırmızımsı pembe iç et, düşük asit ve yüksek likopen zenginliği.', 'months' => ['KAS', 'ARA', 'OCA', 'ŞUB']],
        ['name' => 'Washington Navel', 'desc' => 'Göbekli, çekirdeksiz, kalın kabuklu ve sofralık tüketimin lideri.', 'months' => ['EKİ', 'KAS', 'ARA', 'OCA', 'ŞUB']],
        ['name' => 'Valencia Late', 'desc' => 'Yüksek meyve suyu randımanı, ferahlatıcı asidite ve geç hasat avantajı.', 'months' => ['MAR', 'NİS', 'MAY', 'HAZ']],
        ['name' => 'Kan Portakalı (Moro)', 'desc' => 'Yoğun yakut kırmızısı meyve eti ve eşsiz ahududumsu narenciye aroması.', 'months' => ['ARA', 'OCA', 'ŞUB', 'MAR']],
    ],
    'riored-greyfurt' => [
        ['name' => 'Riored Premium', 'desc' => 'Koyu kırmızı meyve eti, dengeli tatlılık ve yüksek kalibre standardı.', 'months' => ['KAS', 'ARA', 'OCA', 'ŞUB', 'MAR', 'NİS']],
        ['name' => 'Star Ruby', 'desc' => 'İnce kabuk, çekirdeksiz dolgun yapı ve zengin antioksidan içeriği.', 'months' => ['EKİ', 'KAS', 'ARA', 'OCA', 'ŞUB', 'MAR']],
        ['name' => 'White Marsh Seedless', 'desc' => 'Berrak sarı iç et, zamansız klasik ferahlatıcı greyfurt tadı.', 'months' => ['ARA', 'OCA', 'ŞUB', 'MAR', 'NİS']],
    ],
    'star-ruby-greyfurt' => [
        ['name' => 'Star Ruby', 'desc' => 'İnce kabuk, çekirdeksiz dolgun yapı ve zengin antioksidan içeriği.', 'months' => ['EKİ', 'KAS', 'ARA', 'OCA', 'ŞUB', 'MAR']],
        ['name' => 'Riored Premium', 'desc' => 'Koyu kırmızı meyve eti, dengeli tatlılık ve yüksek kalibre standardı.', 'months' => ['KAS', 'ARA', 'OCA', 'ŞUB', 'MAR', 'NİS']],
    ],
    'mayer-limon' => [
        ['name' => 'Mayer Limon', 'desc' => 'İnce parlak kabuk, bol sulu ve narin hafif tatlımsı narenciye.', 'months' => ['EYL', 'EKİ', 'KAS', 'ARA', 'OCA']],
        ['name' => 'Enterdonat', 'desc' => 'Erkenci ihracat limonu, eliptik form ve yüksek asit oranı.', 'months' => ['EYL', 'EKİ', 'KAS', 'ARA']],
        ['name' => 'Lamas & Kütdiken', 'desc' => 'Uzun depolamaya uygun, kalın kabuklu ve aromatik Akdeniz limonu.', 'months' => ['KAS', 'ARA', 'OCA', 'ŞUB', 'MAR', 'NİS']],
    ],
];

$productVarieties = $varietiesData[$slug] ?? [
    ['name' => $prodName . ' - Select', 'desc' => 'Özenle seçilmiş, birinci sınıf ihraç kalibresi taze mahsul.', 'months' => ['EKİ', 'KAS', 'ARA', 'OCA', 'ŞUB', 'MAR']],
    ['name' => $prodName . ' - Standart', 'desc' => 'Global standartlarda kalibrasyon ve soğuk hava koruması.', 'months' => ['KAS', 'ARA', 'OCA', 'ŞUB']],
];

// Tüm 12 Ay Listesi
$allMonths = ['AĞU', 'EYL', 'EKİ', 'KAS', 'ARA', 'OCA', 'ŞUB', 'MAR', 'NİS', 'MAY', 'HAZ', 'TEM'];

// Meyve Karakteristikleri (Görsel 3)
$characteristics = [
    'et_rengi' => ['title' => 'Et Rengi', 'val' => 'Pembemsi Turuncu'],
    'cekirdek' => ['title' => 'Çekirdek', 'val' => 'Çekirdeksiz'],
    'kabuk_rengi' => ['title' => 'Kabuk Rengi', 'val' => 'Turuncu'],
    'dokusu' => ['title' => 'Dokusu', 'val' => 'Gevrek ve Su Oranı Yüksek'],
    'sekil' => ['title' => 'Meyve Şekli', 'val' => 'Düzgün Yuvarlak Şekilli'],
    'tadi' => ['title' => 'Tadı', 'val' => 'Tatlı ve Aromatik'],
];
?>

<div class="product-detail-page">
    <div class="container">
        
        <!-- Üst Breadcrumb -->
        <div class="detail-breadcrumb">
            <a href="<?= BASE_URL ?>/"><?= __('nav_home') ?></a>
            <span>/</span>
            <a href="<?= BASE_URL ?>/urunler"><?= __('nav_products') ?></a>
            <span>/</span>
            <span class="active-crumb"><?= htmlspecialchars($prodName) ?></span>
        </div>

        <!-- ====================================================================
             1. BÖLÜM: HERO SHOWCASE (GÖRSEL 1: TROPICAL MIX TARZI)
             ==================================================================== -->
        <section class="detail-hero-showcase">
            <div class="showcase-grid">
                
                <!-- Sol Sütun: Dairesel Renkli Backdrop, Taşan Ürün & 3D Yüzen Küreler -->
                <div class="showcase-visual-col">
                    <div class="showcase-circle-stage">
                        
                        <!-- Büyük Canlı Yeşil / Turuncu Dairesel Arka Plan -->
                        <div class="showcase-circle-bg"></div>

                        <!-- 3D Yüzen Pastel Küreler (Görseldeki Baloncuklar) -->
                        <div class="floating-bubble bubble-1"></div>
                        <div class="floating-bubble bubble-2"></div>
                        <div class="floating-bubble bubble-3"></div>

                        <!-- Vitrin Ürün Görseli (Kaydırma Yok, Tek ve Çarpıcı 3D Görsel) -->
                        <img src="<?= BASE_URL ?>/public/images/<?= htmlspecialchars($product['image'] ?: 'product_orange.png') ?>" 
                             alt="<?= htmlspecialchars($prodName) ?>" 
                             class="showcase-product-img">
                    </div>
                </div>

                <!-- Sağ Sütun: Başlık, İçerik İkonları, Besin Değerleri ve Teklif Butonu -->
                <div class="showcase-info-col">
                    
                    <span class="showcase-category-tag"><?= htmlspecialchars($catName) ?></span>
                    
                    <h1 class="showcase-product-title"><?= htmlspecialchars($prodName) ?></h1>
                    
                    <p class="showcase-short-desc">
                        <?= htmlspecialchars($prodShort ?: 'Akdeniz ve Ege nin bereketli topraklarında yetişen, uluslararası kalite standartlarında işlenen taze mahsulümüz.') ?>
                    </p>

                    <!-- İçerik İkonları (Contents:) -->
                    <div class="showcase-contents-block">
                        <div class="block-label">İçerik & Nitelikler:</div>
                        <div class="contents-icons-row">
                            <div class="content-icon-bubble" title="C Vitamini Deposu">
                                <span>🍊</span>
                            </div>
                            <div class="content-icon-bubble" title="Yüksek Doğal Su & Lif">
                                <span>💧</span>
                            </div>
                            <div class="content-icon-bubble" title="Zengin Antioksidan">
                                <span>🌿</span>
                            </div>
                            <div class="content-icon-bubble" title="%100 Doğal & Kalıntısız">
                                <span>🛡️</span>
                            </div>
                        </div>
                    </div>

                    <!-- Besin Değerleri Tablosu (Görsel 1: Nutritional values:) -->
                    <div class="showcase-nutrition-block">
                        <div class="block-label">Besin Değerleri (100g):</div>
                        <div class="nutrition-card">
                            <div class="nutrition-col-values">
                                <div class="nutri-val">47</div>
                                <div class="nutri-val">0.1 g</div>
                                <div class="nutri-val">11.8 g</div>
                                <div class="nutri-val">0.9 g</div>
                            </div>
                            <div class="nutrition-col-labels">
                                <div class="nutri-lbl">kcal (Enerji)</div>
                                <div class="nutri-lbl">yağ (fats)</div>
                                <div class="nutri-lbl">karbonhidrat</div>
                                <div class="nutri-lbl">protein</div>
                            </div>
                        </div>
                    </div>

                    <!-- Aksiyon / Teklif Butonu (Order Now Stili) -->
                    <div class="showcase-action-row">
                        <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $whatsapp) ?>?text=Merhaba,%20<?= urlencode($prodName) ?>%20ürünü%20için%20ihracat%20fiyat%20ve%20yükleme%20teklifi%20almak%20istiyorum." 
                           target="_blank" 
                           class="btn-order-now">
                            İhracat Teklifi Al
                        </a>
                        <a href="<?= BASE_URL ?>/iletisim?konu=<?= urlencode($prodName . ' İhracat Bilgisi') ?>" class="btn-detail-contact">
                            Bize Ulaşın
                        </a>
                    </div>

                </div>

            </div>
        </section>

        <!-- ====================================================================
             2. BÖLÜM: MEYVE KARAKTERİSTİKLERİ & KALİTE STANDARTLARI (DÜZENLİ & NET İNFOGRAFİK)
             ==================================================================== -->
        <section class="characteristics-section">
            <div class="section-badge-center">Uluslararası Standartlar</div>
            <h2 class="section-title-center">Meyve Karakteristiği ve Kalite Kriterleri</h2>
            <p class="section-desc-center">
                Optik kalibrasyon ve yapay zeka destekli leke ayıklama süreçlerimizden geçen taze mahsulün 6 temel fiziksel ve tat kriteri.
            </p>

            <div class="char-showcase-layout">
                
                <!-- Sol Sütun: 3 Anlaşılır Özellik Kartı -->
                <div class="char-column">
                    <div class="char-feature-card">
                        <div class="char-icon-circle">🎨</div>
                        <div class="char-card-body">
                            <span class="char-label">Et Rengi</span>
                            <span class="char-value"><?= $characteristics['et_rengi']['val'] ?></span>
                        </div>
                    </div>

                    <div class="char-feature-card">
                        <div class="char-icon-circle">🌱</div>
                        <div class="char-card-body">
                            <span class="char-label">Çekirdek Yapısı</span>
                            <span class="char-value"><?= $characteristics['cekirdek']['val'] ?></span>
                        </div>
                    </div>

                    <div class="char-feature-card">
                        <div class="char-icon-circle">🍊</div>
                        <div class="char-card-body">
                            <span class="char-label">Kabuk Rengi</span>
                            <span class="char-value"><?= $characteristics['kabuk_rengi']['val'] ?></span>
                        </div>
                    </div>
                </div>

                <!-- Orta Sütun: Meyve Vitrini -->
                <div class="char-hero-display">
                    <div class="char-fruit-aura"></div>
                    <img src="<?= BASE_URL ?>/public/images/<?= htmlspecialchars($product['image'] ?: 'product_orange.png') ?>" 
                         alt="<?= htmlspecialchars($prodName) ?>" 
                         class="char-hero-img">
                </div>

                <!-- Sağ Sütun: 3 Anlaşılır Özellik Kartı -->
                <div class="char-column">
                    <div class="char-feature-card">
                        <div class="char-icon-circle">💧</div>
                        <div class="char-card-body">
                            <span class="char-label">Dokusu & Sululuk</span>
                            <span class="char-value"><?= $characteristics['dokusu']['val'] ?></span>
                        </div>
                    </div>

                    <div class="char-feature-card">
                        <div class="char-icon-circle">✨</div>
                        <div class="char-card-body">
                            <span class="char-label">Meyve Şekli</span>
                            <span class="char-value"><?= $characteristics['sekil']['val'] ?></span>
                        </div>
                    </div>

                    <div class="char-feature-card">
                        <div class="char-icon-circle">🍯</div>
                        <div class="char-card-body">
                            <span class="char-label">Tadı & Asidite</span>
                            <span class="char-value"><?= $characteristics['tadi']['val'] ?></span>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- ====================================================================
             3. BÖLÜM: ÜRÜN CİNSLERİ & 12 AYLIK HASAT SEZON TAKVİMİ (GÖRSEL 2)
             ==================================================================== -->
        <section class="season-section">
            <div class="section-badge-center">Hasat & İhracat Takvimi</div>
            <h2 class="section-title-center">Ürün Cinsleri ve Hasat Sezonları</h2>
            <p class="section-desc-center">
                Yılın dört mevsiminde tarladan dünya sofralarına kesintisiz, taze ve planlı sevkiyat.
            </p>

            <div class="season-table-container">
                <table class="season-table">
                    <thead>
                        <tr>
                            <th class="col-season-label">SEZON / CİNS</th>
                            <?php foreach ($allMonths as $m): ?>
                                <th><?= $m ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productVarieties as $v): ?>
                            <tr>
                                <td class="col-variety-info">
                                    <div class="variety-name"><?= htmlspecialchars($v['name']) ?></div>
                                    <div class="variety-desc"><?= htmlspecialchars($v['desc']) ?></div>
                                </td>
                                <?php foreach ($allMonths as $m): ?>
                                    <?php $isActiveMonth = in_array($m, $v['months'], true); ?>
                                    <td class="col-month <?= $isActiveMonth ? 'active-season' : '' ?>">
                                        <?php if ($isActiveMonth): ?>
                                            <div class="season-badge-icon" title="<?= htmlspecialchars($v['name']) ?> hasat ayı">
                                                🍊
                                            </div>
                                        <?php else: ?>
                                            <span class="season-dot-empty">·</span>
                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- ====================================================================
             4. BÖLÜM: İHRACAT AMBALAJ VE KUTU ÇEŞİTLERİ (ARKAPLANI OLMAYAN SAYDAM GÖRSELLER)
             ==================================================================== -->
        <section class="packaging-section">
            <div class="section-badge-center">Uluslararası Standartlar</div>
            <h2 class="section-title-center">İhracat Ambalaj ve Kutu Çeşitlerimiz</h2>
            <p class="section-desc-center">
                Soğuk zincire ve uzun yol nakliyesine dayanıklı, havalandırma kanallı profesyonel ambalaj çözümleri.
            </p>

            <div class="packaging-grid">
                
                <!-- 1. Kutu: Karton Kutu 7 Kg -->
                <div class="packaging-card">
                    <div class="packaging-img-holder">
                        <img src="<?= BASE_URL ?>/public/images/packaging_carton_1.png" alt="Karton Kutu 7 Kg" loading="lazy">
                    </div>
                    <div class="packaging-details">
                        <h4 class="pkg-title">Karton Kutu</h4>
                        <div class="pkg-meta"><strong>Ağırlık:</strong> 7 Kg</div>
                        <div class="pkg-meta"><strong>Ebatlar(mm):</strong> 600 x 400 x 120</div>
                    </div>
                </div>

                <!-- 2. Kutu: Karton Kutu 15 Kg -->
                <div class="packaging-card">
                    <div class="packaging-img-holder">
                        <img src="<?= BASE_URL ?>/public/images/packaging_carton_2.png" alt="Karton Kutu 15 Kg" loading="lazy">
                    </div>
                    <div class="packaging-details">
                        <h4 class="pkg-title">Karton Kutu</h4>
                        <div class="pkg-meta"><strong>Ağırlık:</strong> 15 Kg</div>
                        <div class="pkg-meta"><strong>Ebatlar(mm):</strong> 600 x 400 x 160</div>
                    </div>
                </div>

                <!-- 3. Kutu: Karton Kutu 15 Kg Derin -->
                <div class="packaging-card">
                    <div class="packaging-img-holder">
                        <img src="<?= BASE_URL ?>/public/images/packaging_carton_3.png" alt="Karton Kutu 15 Kg Derin" loading="lazy">
                    </div>
                    <div class="packaging-details">
                        <h4 class="pkg-title">Karton Kutu</h4>
                        <div class="pkg-meta"><strong>Ağırlık:</strong> 15 Kg</div>
                        <div class="pkg-meta"><strong>Ebatlar(mm):</strong> 600 x 400 x 180</div>
                    </div>
                </div>

                <!-- 4. Kutu: Karton Kutu Teleskopik 15 Kg -->
                <div class="packaging-card">
                    <div class="packaging-img-holder">
                        <img src="<?= BASE_URL ?>/public/images/packaging_telescopic.png" alt="Karton Kutu Teleskopik" loading="lazy">
                    </div>
                    <div class="packaging-details">
                        <h4 class="pkg-title">Karton Kutu – Teleskopik</h4>
                        <div class="pkg-meta"><strong>Ağırlık:</strong> 15 Kg</div>
                        <div class="pkg-meta"><strong>Ebatlar(mm):</strong> 600 x 400 x 180</div>
                    </div>
                </div>

                <!-- 5. Kutu: File Perakende Ambalaj -->
                <div class="packaging-card">
                    <div class="packaging-img-holder">
                        <img src="<?= BASE_URL ?>/public/images/packaging_mesh.png" alt="File Ambalaj" loading="lazy">
                    </div>
                    <div class="packaging-details">
                        <h4 class="pkg-title">File Ambalaj</h4>
                        <div class="pkg-meta"><strong>Ağırlık:</strong> 1.5 Kg - 2 Kg</div>
                        <div class="pkg-meta"><strong>Kullanım:</strong> Perakende Market Rafı</div>
                    </div>
                </div>

            </div>

            <!-- Alt Yönlendirme Linkleri (Görsel 2 Sağ Alt) -->
            <div class="detail-bottom-nav">
                <a href="<?= BASE_URL ?>/urunler" class="nav-return-btn">
                    <span>↩</span> <?= mb_strtoupper($catName, 'UTF-8') ?> LİSTESİ
                </a>
                <a href="<?= BASE_URL ?>/" class="nav-return-btn">
                    <span>🏠</span> ANA SAYFA
                </a>
            </div>

        </section>

    </div>
</div>

