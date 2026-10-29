-- BİKGRUP Veritabanı Şeması
-- Karakter seti utf8mb4, Türkçe ve Uluslararası içerik tam uyumlu

CREATE DATABASE IF NOT EXISTS `bikgrup_db` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `bikgrup_db`;

-- 1. YÖNETİCİLER TABLOSU
CREATE TABLE IF NOT EXISTS `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(150) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `role` ENUM('superadmin', 'admin') DEFAULT 'admin',
    `is_immutable` TINYINT(1) DEFAULT 0 COMMENT '1 ise Süper Admin dokunulmazdır, silinemez ve rolü değiştirilemez',
    `last_login` DATETIME NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dokunulmaz Süper Admin Hesabı
INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `is_immutable`) 
VALUES (1, 'Süleyman Özer (Süper Admin)', 'suleymannozer0@gmail.com', '$2y$10$EfViqG5yVvh/87BLl4FJsuEFVrpYD7YEoWAedMNMelggRXbaLRQpm', 'superadmin', 1)
ON DUPLICATE KEY UPDATE `is_immutable` = 1, `role` = 'superadmin';

-- 2. DİNAMİK AYARLAR VE TEMA RENKLERİ TABLOSU
CREATE TABLE IF NOT EXISTS `settings` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `setting_key` VARCHAR(100) NOT NULL UNIQUE,
    `setting_value` TEXT NULL,
    `group_name` VARCHAR(50) NOT NULL DEFAULT 'general' COMMENT 'theme, general, contact, social, seo',
    `label_tr` VARCHAR(150) NOT NULL,
    `label_en` VARCHAR(150) NULL,
    `input_type` VARCHAR(30) DEFAULT 'text' COMMENT 'text, textarea, color, image, number'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Varsayılan Tema Renkleri & Dinamik Stil Ayarları
INSERT INTO `settings` (`setting_key`, `setting_value`, `group_name`, `label_tr`, `label_en`, `input_type`) VALUES
('theme_primary', '#15803d', 'theme', 'Ana Renk (Canlı Yeşil)', 'Primary Color', 'color'),
('theme_primary_hover', '#166534', 'theme', 'Ana Renk Koyu / Hover', 'Primary Hover Color', 'color'),
('theme_secondary', '#ea580c', 'theme', 'İkincil Renk (Narenciye Turuncusu)', 'Secondary Color (Citrus Orange)', 'color'),
('theme_secondary_hover', '#c2410c', 'theme', 'İkincil Renk Hover', 'Secondary Hover Color', 'color'),
('theme_accent', '#059669', 'theme', 'Vurgu Rengi (Zümrüt)', 'Accent Color', 'color'),
('theme_bg', '#fcfdfd', 'theme', 'Genel Sayfa Arka Plan Rengi', 'Page Background Color', 'color'),
('theme_card_bg', '#ffffff', 'theme', 'Kart Arka Plan Rengi', 'Card Background Color', 'color'),
('theme_text', '#0f172a', 'theme', 'Ana Yazı Rengi (Koyu)', 'Primary Text Color', 'color'),
('theme_text_muted', '#64748b', 'theme', 'İkincil Yazı Rengi (Soluk Gri)', 'Muted Text Color', 'color'),
('theme_navbar_bg', 'rgba(255, 255, 255, 0.88)', 'theme', 'Navbar Cam Efekti Rengi', 'Navbar Glass Color', 'text'),
('theme_border_radius', '16px', 'theme', 'Bileşen Köşe Yuvarlaklığı', 'Border Radius', 'text'),

-- Genel Site ve İletişim Bilgileri
('site_name', 'BİKGRUP', 'general', 'Firma Adı', 'Company Name', 'text'),
('site_logo_text', 'BİKGRUP', 'general', 'Logo Metni', 'Logo Text', 'text'),
('site_tagline_tr', 'Doğanın En Taze Hasadı, Dünya Standartlarında Güvence', 'general', 'Slogan (TR)', 'Tagline (TR)', 'text'),
('site_tagline_en', 'Nature’s Freshest Harvest, World-Class Assurance', 'general', 'Slogan (EN)', 'Tagline (EN)', 'text'),
('site_phone', '+90 (242) 555 01 23', 'contact', 'Telefon Numarası', 'Phone Number', 'text'),
('site_email', 'info@bikgrup.com', 'contact', 'E-Posta Adresi', 'Email Address', 'text'),
('site_whatsapp', '+905320000000', 'contact', 'WhatsApp Hattı', 'WhatsApp Number', 'text'),
('site_address_tr', 'Organize Sanayi Bölgesi 4. Cadde No: 18, Antalya / TÜRKİYE', 'contact', 'Adres (TR)', 'Address (TR)', 'textarea'),
('site_address_en', 'Organized Industrial Zone, 4th Street No: 18, Antalya / TURKEY', 'contact', 'Adres (EN)', 'Address (EN)', 'textarea'),
('social_instagram', 'https://instagram.com/bikgrup', 'social', 'Instagram Profili', 'Instagram URL', 'text'),
('social_linkedin', 'https://linkedin.com/company/bikgrup', 'social', 'LinkedIn Profili', 'LinkedIn URL', 'text')
ON DUPLICATE KEY UPDATE `setting_key` = `setting_key`;

-- 3. KATEGORİLER TABLOSU
CREATE TABLE IF NOT EXISTS `categories` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `slug` VARCHAR(100) NOT NULL UNIQUE,
    `name_tr` VARCHAR(100) NOT NULL,
    `name_en` VARCHAR(100) NOT NULL,
    `description_tr` TEXT NULL,
    `description_en` TEXT NULL,
    `badge_color` VARCHAR(20) DEFAULT '#15803d',
    `icon_svg` TEXT NULL,
    `image` VARCHAR(255) NULL,
    `sort_order` INT DEFAULT 0,
    `is_active` TINYINT(1) DEFAULT 1,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `categories` (`slug`, `name_tr`, `name_en`, `description_tr`, `description_en`, `badge_color`, `image`, `sort_order`) VALUES
('narenciye', 'Narenciye', 'Citrus', 'Akdeniz güneşinin en kaliteli portakal, limon, mandalina ve greyfurtları. Yüksek C vitamini, doğal sululuk ve ferahlatıcı lezzet.', 'The finest oranges, lemons, mandarins, and grapefruits kissed by Mediterranean sunshine.', '#ea580c', 'category_narenciye.png', 1),
('meyveler', 'Meyveler', 'Fresh Fruits', 'Akdeniz ve Ege nin bereketli bahçelerinden dalından sofranıza taze elma, karpuz, incir, çilek ve üzüm çeşitleri.', 'Fresh apples, watermelons, figs, strawberries, and grapes picked at peak sweetness.', '#dc2626', 'category_meyveler.png', 2),
('sebzeler', 'Sebzeler', 'Fresh Vegetables', 'Verimli tarım arazilerinde kontrollü tarım prensipleriyle yetiştirilen taze domates, biber, patlıcan ve çıtır salatalıklar.', 'Crispy cucumbers, premium tomatoes, peppers, and eggplants grown with precision farming.', '#15803d', 'category_sebzeler.png', 3)
ON DUPLICATE KEY UPDATE `slug` = `slug`;

-- 4. ÜRÜNLER TABLOSU
CREATE TABLE IF NOT EXISTS `products` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `category_id` INT NOT NULL,
    `slug` VARCHAR(120) NOT NULL UNIQUE,
    `name_tr` VARCHAR(120) NOT NULL,
    `name_en` VARCHAR(120) NOT NULL,
    `short_desc_tr` TEXT NULL,
    `short_desc_en` TEXT NULL,
    `content_tr` LONGTEXT NULL,
    `content_en` LONGTEXT NULL,
    `image` VARCHAR(255) NULL,
    `origin_tr` VARCHAR(100) DEFAULT 'Akdeniz & Ege / Türkiye',
    `origin_en` VARCHAR(100) DEFAULT 'Mediterranean & Aegean / Turkey',
    `harvest_season_tr` VARCHAR(100) DEFAULT 'Ekim - Mayıs',
    `harvest_season_en` VARCHAR(100) DEFAULT 'October - May',
    `packaging_tr` VARCHAR(150) DEFAULT 'Teleskopik Koli, Plastik Kasa, IFCO Kasa',
    `packaging_en` VARCHAR(150) DEFAULT 'Telescopic Carton, Plastic Crate, IFCO Box',
    `temperature` VARCHAR(50) DEFAULT '+4°C / +8°C',
    `is_featured` TINYINT(1) DEFAULT 1,
    `is_active` TINYINT(1) DEFAULT 1,
    `sort_order` INT DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `products` (`category_id`, `slug`, `name_tr`, `name_en`, `short_desc_tr`, `short_desc_en`, `content_tr`, `content_en`, `image`, `harvest_season_tr`, `harvest_season_en`, `sort_order`, `is_featured`) VALUES
(1, 'riored-greyfurt', 'Riored Greyfurt', 'Riored Grapefruit', 'Koyu kırmızı meyve eti, yüksek meyve suyu oranı ve dengeli tatlılığı ile premium sofralık greyfurt.', 'Deep red flesh, high juice content, and perfectly balanced sweetness for premium tables.', 'Riored, Akdeniz havzasının güneşle olgunlaşan en lezzetli greyfurt cinsidir. Kalibre standardizasyonu ve optik leke ayıklama süreçlerinden geçirilerek ihraç edilir.', 'Riored is the finest grapefruit variety ripened under the Mediterranean sun. Sorted with optical grading for superior quality.', 'product_riored.png', 'Kasım - Nisan', 'November - April', 1, 1),
(1, 'star-ruby-greyfurt', 'Star Ruby Greyfurt', 'Star Ruby Grapefruit', 'Derin kırmızı-pembe iç rengi ve yoğun aromasıyla gastronomik sunumlara en uygun zarif seçim.', 'Deep red-pink inner color with intense aroma, an elegant choice for gastronomy.', 'Star Ruby, ince kabuk yapısı ve çekirdeksiz dolgun meyve etiyle tüm dünyada en çok tercih edilen narenciye türlerinden biridir.', 'Star Ruby is worldwide acclaimed for its thin peel, seedless juicy flesh, and rich antioxidant properties.', 'product_star_ruby.png', 'Ekim - Mart', 'October - March', 2, 1),
(1, 'white-marsh-seedless', 'White Marsh Seedless', 'White Marsh Seedless', 'Parlak sarı kabuğu, çekirdeksiz yapısı ve klasik ferahlatıcı tadıyla zamansız narenciye kalitesi.', 'Bright yellow peel, seedless texture, and classic refreshing citrus aroma.', 'Sarı etli, berrak ve yüksek asit-şeker dengesine sahip White Marsh Seedless, meyve suyu ve taze tüketim için mükemmeldir.', 'Yellow flesh, crisp notes, and balanced sugar-acid ratio making it great for fresh consumption.', 'product_white_marsh.png', 'Aralık - Nisan', 'December - April', 3, 1),
(1, 'washington-portakal', 'Washington Portakal', 'Washington Navel Orange', 'Geniş gövdesi, göbekli yapısı ve çekirdeksiz tatlı meyve etiyle Akdeniz in en sevilen portakalı.', 'Distinct navel structure, seedless juicy flesh, and unmistakable natural aroma.', 'Washington Navel, kalın ve kolay soyulan kabuğu, aromatik zenginliği ile taze sofralık tüketimin bir numarasıdır.', 'Washington Navel is renowned for its easy-peeling rind, aromatic richness, and supreme sweetness.', 'product_orange.png', 'Kasım - Şubat', 'November - February', 4, 1),
(1, 'mayer-limon', 'Mayer Limon', 'Meyer Lemon', 'İnce parlak kabuğu, yüksek meyve suyu verimi ve hafif tatlımsı narin aromasıyla lüks narenciye.', 'Thin glossy peel, exceptional juice yield, and delicately sweet floral citrus aroma.', 'Mayer Limon, zengin esansiyel yağları ve bol suyu ile dünya mutfaklarının vazgeçilmezidir.', 'Meyer lemon is highly prized in culinary arts for its fragrant aroma and rich juice extraction.', 'product_lemon.png', 'Eylül - Ocak', 'September - January', 5, 1),
(2, 'akdeniz-karpuzu', 'Akdeniz Karpuzu', 'Mediterranean Watermelon', 'Güneşle olgunlaşan, çıtır gevrek dokulu ve yüksek şeker oranına sahip tarladan taze karpuz.', 'Sun-ripened, crisp crunchy flesh with exceptional natural sweetness.', 'Verimli Çukurova ve Antalya ovalarında yetiştirilen karpuzlarımız, özel darbeye dayanıklı kasalama ile sevk edilir.', 'Harvested carefully to protect freshness and shipped in heavy-duty refrigerated crates.', 'product_watermelon.png', 'Mayıs - Ağustos', 'May - August', 6, 1),
(3, 'salkim-domates', 'Salkım Domates', 'Vine Tomatoes', 'Dalında kızaran, yoğun aromalı ve mükemmel kalibreli sera & açık alan salkım domatesleri.', 'Ripened on the vine, deeply aromatic with consistent sizing and vibrant red color.', 'İleri teknoloji topraksız tarım tesislerimizde biyolojik mücadele yöntemleriyle ilaçsız yetiştirilir.', 'Grown in high-tech hydroponic facilities with sustainable biological pest management.', 'product_tomato.png', 'Tüm Yıl Boyunca', 'All Year Round', 7, 1)
ON DUPLICATE KEY UPDATE `slug` = `slug`;

-- 5. SAYFA ALANLARI VE BÖLÜM İÇERİKLERİ TABLOSU (DİNAMİK YÖNETİM)
CREATE TABLE IF NOT EXISTS `page_sections` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `page_key` VARCHAR(50) NOT NULL COMMENT 'home, about, contact',
    `section_key` VARCHAR(80) NOT NULL UNIQUE,
    `title_tr` VARCHAR(255) NOT NULL,
    `title_en` VARCHAR(255) NULL,
    `subtitle_tr` VARCHAR(255) NULL,
    `subtitle_en` VARCHAR(255) NULL,
    `body_tr` LONGTEXT NULL,
    `body_en` LONGTEXT NULL,
    `extra_json` JSON NULL,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `page_sections` (`page_key`, `section_key`, `title_tr`, `title_en`, `subtitle_tr`, `subtitle_en`, `body_tr`, `body_en`, `extra_json`) VALUES
('home', 'hero_main', 
 'Akdeniz ve Ege nin en verimli topraklarında yetişen narenciye, meyveler ve besleyici sebzeleri ileri teknoloji tesislerimizde işleyerek dünyanın dört bir yanına ulaştırıyoruz.',
 'Processing the freshest citrus, fruits, and nutritious vegetables grown in the fertile soils of the Mediterranean and Aegean in our high-tech facilities to deliver them worldwide.',
 'BİKGRUP ile Doğallığın Güvencesi',
 'World-Class Fresh Produce with BİKGRUP',
 '30 dan fazla ülkeye kesintisiz soğuk zincir ihracatı, optik boylama teknolojisi ve GlobalG.A.P. sertifikalı güvenilir üretim.',
 'Exporting to over 30 countries with seamless cold-chain logistics, optical sorting technology, and GlobalG.A.P. certified production.',
 '{"stat1_num":"30+","stat1_label":"Ülkeye İhracat","stat2_num":"150K+","stat2_label":"Ton Yıllık Kapasite","stat3_num":"100%","stat3_label":"İzlenebilirlik"}'),

('home', 'facility_intro',
 'Sıradan bir işleme tesisi değiliz; otomasyon, izlenebilirlik ve kalite kontrol süreçlerimizle ürünlerimizi daima güvence altında tutuyoruz.',
 'We are not just a processing facility; we safeguard our produce with state-of-the-art automation, traceability, and rigorous quality control.',
 'Tek Dünya, Tek Pazar',
 'One World, One Market',
 'Tarladan sofraya uzanan süreçte, dalından toplanan her bir narenciye ve meyve en son teknoloji optik kameralarla kalibre edilir, boylanır ve hiçbir kimyasal kalıntı barındırmaksızın soğuk hava depolarımızda dinlendirilir.',
 'From field to fork, each citrus and fruit picked from the branch is sorted using optical cameras, sized accurately, and rested in state-of-the-art cold storage facilities.',
 '{"video_badge":"Modern Entegre Tesis","cta_text":"Tesislerimizi Keşfedin","cta_link":"about"}'),

('about', 'about_story',
 'Doğanın Bereketini Geleceğin Teknolojisiyle Buluşturuyoruz',
 'Bridging Nature’s Abundance with Tomorrow’s Technology',
 'BİKGRUP Kurumsal Hikayesi',
 'BİKGRUP Corporate Story',
 'BİKGRUP, Türkiye nin bereketli tarım coğrafyasında doğmuş; narenciye, meyve ve sebze alanında uluslararası ölçekte güvenilir bir tedarik zinciri lideri olmayı başarmıştır. 25 yılı aşkın tecrübemiz, 40.000 m² kapalı alana sahip modern paketleme ve soğuk hava tesislerimiz ile dünya standartlarında taze ürün ihracatı gerçekleştiriyoruz.',
 'Born in Turkey’s most fertile agricultural heartlands, BİKGRUP has established itself as an international benchmark in fresh produce supply chains. With over 25 years of heritage and 40,000 m² of modern packhouse and cold-storage infrastructure, we supply premium fresh harvests globally.',
 '{"founded_year":"1998","export_ratio":"85%","certifications":["GlobalG.A.P.","BRCGS Food","IFS Food","ISO 22000","Sedex"]}'),

('about', 'mission_vision',
 'Misyonumuz & Vizyonumuz',
 'Our Mission & Vision',
 'Sürdürülebilir Gelecek',
 'Sustainable Tomorrow',
 'MİSYONUMUZ: Topraktan gelen bereketi en saf ve taze haliyle koruyarak, insan sağlığını ve gıda güvenliğini odağında tutan yenilikçi üretim modelleriyle global pazarlara ulaştırmak.\n\nVİZYONUMUZ: İleri teknoloji izlenebilirlik sistemleri ve çevre dostu tarım uygulamalarıyla dünya taze meyve ve narenciye sektörünün en güvenilir ve ilham veren lider markası olmak.',
 'MISSION: Preserving the purity and freshness of the land, delivering world-class nutritional produce to global markets through sustainable and safe food systems.\n\nVISION: To be the most trusted, innovative, and pioneering brand in the global fresh citrus and produce sector through precision technology and ecological farming.',
 '[]')
ON DUPLICATE KEY UPDATE `section_key` = `section_key`;

-- 6. BLOG / HABERLER TABLOSU
CREATE TABLE IF NOT EXISTS `blog_posts` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `slug` VARCHAR(150) NOT NULL UNIQUE,
    `title_tr` VARCHAR(255) NOT NULL,
    `title_en` VARCHAR(255) NOT NULL,
    `excerpt_tr` TEXT NULL,
    `excerpt_en` TEXT NULL,
    `content_tr` LONGTEXT NULL,
    `content_en` LONGTEXT NULL,
    `image` VARCHAR(255) NULL,
    `author` VARCHAR(100) DEFAULT 'BİKGRUP Basın & Medya',
    `read_time` VARCHAR(30) DEFAULT '4 dk',
    `views` INT DEFAULT 0,
    `is_published` TINYINT(1) DEFAULT 1,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `blog_posts` (`slug`, `title_tr`, `title_en`, `excerpt_tr`, `excerpt_en`, `content_tr`, `content_en`, `image`, `read_time`) VALUES
('narenciye-ihracatinda-soguk-zincirin-onemi',
 'Narenciye İhracatında Soğuk Zincir ve İzlenebilirlik Standartları',
 'The Critical Role of Cold Chain & Traceability in Citrus Export',
 'Dalından toplanan narenciyenin tazeliğini ilk günkü gibi korumak için uyguladığımız kontrollü atmosfer teknolojileri ve soğuk zincir protokolleri.',
 'Our controlled atmosphere technologies and stringent cold-chain protocols designed to keep freshly harvested citrus pristine from tree to shelf.',
 '<p>Narenciye meyvelerinde hasat sonrası kalitenin korunması, uluslararası pazarlarda başarıyı belirleyen en kritik etkendir. BİKGRUP olarak tesislerimizde ürünler toplanır toplanmaz ön soğutma (pre-cooling) ünitelerine alınmakta, nem ve sıcaklık dereceleri dijital sensörlerle anlık takip edilmektedir.</p><p>Gelişmiş optik tasnif hatlarımız sayesinde her bir portakal, mandalina ve greyfurt, kabuk kusurları ve şeker yoğunluğuna göre mikrosaniyelik hassasiyetle sınıflandırılmaktadır.</p>',
 '<p>Preserving post-harvest quality in citrus fruits is the cornerstone of international export excellence. At BİKGRUP facilities, freshly harvested citrus undergoes immediate pre-cooling, with humidity and temperature tracked real-time via digital IoT sensors.</p>',
 'blog_cold_chain.png', '4 dk'),

('surdurulebilir-tarim-ve-gelecegin-gida-guvenligi',
 'Sürdürülebilir Tarım: Doğaya Saygılı Üretim ve Biyolojik Mücadele',
 'Sustainable Agriculture: Ecological Farming & Biological Pest Control',
 'Toprağın verimliliğini nesiller boyu korumak adına kimyasal kullanımını minimize eden biyolojik mücadele yöntemlerimiz.',
 'Minimizing chemical intervention through innovative biological pest control to nurture soil fertility for generations to come.',
 '<p>Modern tarımda sürdürülebilirlik bir tercih değil, geleceğe borcumuzdur. BİKGRUP anlaşmalı çiftçi ağımızda ve kendi bahçelerimizde zararlılarla mücadelede yararlı böcekler ve feromon tuzakları kullanılmaktadır. Bu sayede sıfır kalıntı hedefimize %100 oranında ulaşıyoruz.</p>',
 '<p>Sustainability in modern agriculture is an indispensable commitment to our future. In our orchards and partner grower networks, beneficial insects and pheromone traps are integrated into pest management, achieving zero residue targets.</p>',
 'blog_sustainable.png', '5 dk'),

('turk-meyve-ve-sebzesinin-avrupadaki-yukselisi',
 'Türk Narenciyesi ve Taze Meyvesinin Avrupa Pazarındaki Yükselişi',
 'The Ascendance of Turkish Citrus and Fresh Produce Across European Markets',
 'Almanya, İngiltere ve İskandinav ülkelerinde Türk narenciyesine artan talep ve kalite sertifikasyonlarımızın getirdiği avantajlar.',
 'Surging demand for Turkish citrus across Germany, the UK, and Scandinavia backed by our rigorous certifications.',
 '<p>Avrupa Birliği standartlarında taze meyve ithalatı, en yüksek hijyen ve izlenebilirlik kriterlerini zorunlu kılmaktadır. BRCGS Food, IFS ve GlobalG.A.P. belgelerimiz ile BİKGRUP, Avrupa nın önde gelen süpermarket zincirlerinin doğrudan onaylı tedarikçisidir.</p>',
 '<p>Fresh fruit import into European markets demands strict compliance with supreme hygiene and traceability benchmarks. With our GlobalG.A.P., IFS, and BRCGS certifications, BİKGRUP serves as an accredited direct supplier to leading retail chains.</p>',
 'blog_europe_market.png', '3 dk')
ON DUPLICATE KEY UPDATE `slug` = `slug`;

-- 7. İLETİŞİM MESAJLARI TABLOSU
CREATE TABLE IF NOT EXISTS `messages` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(150) NOT NULL,
    `phone` VARCHAR(50) NULL,
    `subject` VARCHAR(200) NOT NULL,
    `message` TEXT NOT NULL,
    `is_read` TINYINT(1) DEFAULT 0,
    `ip_address` VARCHAR(50) NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
