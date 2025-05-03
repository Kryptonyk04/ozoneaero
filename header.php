<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'OzoneAero - Serviciul meteo'; ?></title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <?php if (isset($extraCSS)) echo $extraCSS; ?>
</head>
<body>
    <header class="site-header">
        <div class="container">
            <div class="logo">
                <a href="/">
                    <i class="fa-solid fa-cloud"></i>
                    <span>OzoneAero</span>
                </a>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="index.php" class="<?php echo $currentPage == 'home' ? 'active' : ''; ?>">Acasă</a></li>
                    <li><a href="map.php" class="<?php echo $currentPage == 'map' ? 'active' : ''; ?>">Harta vremii</a></li>
                    <li><a href="articles.php" class="<?php echo $currentPage == 'articles' ? 'active' : ''; ?>">Articole</a></li>
                    <li><a href="contact.php" class="<?php echo $currentPage == 'contact' ? 'active' : ''; ?>">Contact</a></li>
                </ul>
            </nav>
            <div class="auth-buttons">
                <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>
                    <div class="user-menu">
                        <div class="user-info">
                            <span class="welcome-text">Bine ați venit, </span> 
                            <span class="user-name">
                                <?php 
                                if(isset($_SESSION["first_name"]) && !empty($_SESSION["first_name"])) {
                                    echo htmlspecialchars($_SESSION["first_name"]);
                                } elseif(isset($_SESSION["username"])) {
                                    echo htmlspecialchars($_SESSION["username"]);
                                } else {
                                    echo "Utilizator";
                                }
                                ?>
                            </span>
                            <a href="logout.php" class="logout-btn">Deconectare</a>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="login.php" class="btn btn-outline">Conectare</a>
                    <a href="register.php" class="btn btn-primary">Înscrieți-vă</a>
                <?php endif; ?>
            </div>
        </div>
    </header>
</body>