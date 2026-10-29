<?php
/**
 * BİKGRUP - Gizli Yönetim Paneli (xpanel) Giriş Ekranı
 */

declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>xpanel | Güvenli Yönetici Girişi</title>
    
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/panel.css">
    <style>
        body.login-body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: radial-gradient(circle at top right, #1e293b 0%, #090d16 100%);
            padding: 20px;
        }
        .login-card {
            width: 100%;
            max-width: 440px;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 30px 70px rgba(0, 0, 0, 0.5);
            color: #ffffff;
        }
        .login-input {
            width: 100%;
            padding: 14px 18px;
            border-radius: 12px;
            border: 1.5px solid rgba(255, 255, 255, 0.15);
            background: rgba(255, 255, 255, 0.08);
            color: #ffffff;
            font-size: 15px;
            box-sizing: border-box;
            transition: all 0.2s;
        }
        .login-input:focus {
            border-color: #22c55e;
            background: rgba(255, 255, 255, 0.12);
            outline: none;
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.25);
        }
        .login-btn {
            width: 100%;
            padding: 15px;
            border-radius: 12px;
            background: linear-gradient(135deg, #15803d 0%, #22c55e 100%);
            color: #ffffff;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            border: none;
            box-shadow: 0 10px 25px -5px rgba(34, 197, 94, 0.4);
            transition: all 0.2s;
        }
        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 30px -4px rgba(34, 197, 94, 0.55);
        }
    </style>
</head>
<body class="login-body">

    <div class="login-card">
        
        <div style="text-align: center; margin-bottom: 30px;">
            <div style="display:inline-flex; align-items:center; justify-content:center; width:56px; height:56px; border-radius:16px; background:linear-gradient(135deg, #15803d, #22c55e); margin-bottom:14px; font-size:26px; box-shadow:0 8px 20px rgba(34,197,94,0.35);">
                🛡️
            </div>
            <h1 style="font-family:'Outfit', sans-serif; font-size: 26px; font-weight: 800; letter-spacing: -0.5px;">BİKGRUP xpanel</h1>
            <p style="color: #94a3b8; font-size: 14px; margin-top: 4px;">Gizli Kurumsal Yönetim Merkezi</p>
        </div>

        <?php if (!empty($_SESSION['panel_error'])): ?>
            <div style="background: rgba(239, 68, 68, 0.2); border: 1px solid rgba(239, 68, 68, 0.4); color: #fca5a5; padding: 12px 16px; border-radius: 12px; font-size: 14px; margin-bottom: 20px; text-align: center;">
                <?= htmlspecialchars($_SESSION['panel_error']) ?>
            </div>
            <?php unset($_SESSION['panel_error']); ?>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>/index.php?url=<?= PANEL_SLUG ?>/do-login" method="POST">
            <?= Security::csrfField() ?>

            <div style="margin-bottom: 20px;">
                <label style="display:block; font-size: 13px; font-weight: 600; color: #cbd5e1; margin-bottom: 8px;">Yönetici E-Posta</label>
                <input type="email" name="email" value="suleymannozer0@gmail.com" required class="login-input" placeholder="admin@bikgrup.com">
            </div>

            <div style="margin-bottom: 28px;">
                <label style="display:block; font-size: 13px; font-weight: 600; color: #cbd5e1; margin-bottom: 8px;">Şifre</label>
                <input type="password" name="password" value="7530" required class="login-input" placeholder="••••••••">
            </div>

            <button type="submit" class="login-btn">
                Güvenli Giriş Yap →
            </button>
        </form>

        <div style="margin-top: 30px; text-align: center; border-top: 1px solid rgba(255,255,255,0.08); padding-top: 20px;">
            <a href="<?= BASE_URL ?>/index.php" style="color: #94a3b8; font-size: 13px; text-decoration: none;">
                ← Web Sitesine Geri Dön
            </a>
        </div>

    </div>

</body>
</html>
