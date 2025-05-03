<?php
$pageTitle = "OzoneAero";
$currentPage = "home";
include 'header.php';
?>

<section class="hero">
    <div class="container">
        <div class="hero-content">
            <div class="hero-text">
                <h1>Serviciul meteo OzoneAero</h1>
                <p>Prognoze meteo precise, hărți interactive și date meteorologice complete pentru fiecare județ.</p>
                <div class="hero-buttons">
                    <a href="map.php" class="btn btn-primary">
                        Explorați harta vremii
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                    <a href="login.php" class="btn btn-outline">Conectare</a>
                </div>
            </div>
            <div class="hero-image">
                <div class="weather-icons">
                    <i class="fa-solid fa-cloud"></i>
                    <i class="fa-solid fa-sun"></i>
                    <i class="fa-solid fa-cloud-rain"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="features">
    <div class="container">
        <div class="section-header">
            <div class="badge">Caracteristici</div>
            <h2>Tot ce aveți nevoie pentru urmărirea vremii</h2>
            <p>OzoneAero oferă date meteo cuprinzătoare, prognoze și instrumente interactive pentru a vă ține informat despre condițiile meteorologice.</p>
        </div>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fa-solid fa-cloud"></i>
                </div>
                <h3>Prognoze meteo</h3>
                <p>Prognoze meteo precise zilnice, săptămânale și lunare pentru toate județele.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fa-solid fa-wind"></i>
                </div>
                <h3>Hărți interactive</h3>
                <p>Explorați condițiile meteorologice detaliate cu hărțile noastre interactive ale județului.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fa-solid fa-droplet"></i>
                </div>
                <h3>Articole meteo</h3>
                <p>Rămâneți la curent cu colecția noastră de articole, videoclipuri și fotografii legate de vreme.</p>
            </div>
        </div>
    </div>
</section>

<section class="latest-news">
    <div class="container">
        <div class="section-header">
            <h2>Ultimele știri despre vreme</h2>
            <p>Rămâneți la curent cu cele mai recente știri și evenimente meteorologice.</p>
        </div>
        <div class="news-grid">
            <div class="news-card">
                <div class="news-image">
                    <img src="https://s.iw.ro/gateway/g/ZmlsZVNvdXJjZT1odHRwJTNBJTJGJTJG/c3RvcmFnZTA4dHJhbnNjb2Rlci5yY3Mt/cmRzLnJvJTJGc3RvcmFnZSUyRjIwMjQl/MkYwOCUyRjE2JTJGMjA1MzIzMl8yMDUz/MjMyX3NodXR0ZXJzdG9ja18yMTY1OTIx/MTUzLmpwZyZ3PTc4MCZoPTQ0MCZoYXNo/PWY3N2U2NWU4ZjdiNTJiYzhjOTY5OWEwZDAwYTM0ODY1.thumb.jpg">
                </div>
                <div class="news-content">
                    <h3>Fenomenul meteo explicat</h3>
                    <p>Aflați despre cele mai recente modele meteorologice și impactul acestora asupra climei noastre.</p>
                    <a href="articles.php" class="read-more">
                    Citeşte mai mult
                    <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="news-card">
                <div class="news-image">
                    <img src="https://media.mediafax.ro/JFRob6nQwEGlLsedOKywNQQgy78=/1280x720/smart/filters:contrast(5):format(webp):quality(80)/https://www.mediafax.ro/wp-content/uploads/images/1/33166/18134764/4-86445734-l.jpg">
                </div>
                <div class="news-content">
                    <h3>Fenomenul meteo explicat</h3>
                    <p>Aflați despre cele mai recente modele meteorologice și impactul acestora asupra climei noastre.</p>
                    <a href="articles.php" class="read-more">
                    Citeşte mai mult
                    <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="news-card">
                <div class="news-image">
                    <img src="https://media.evz.ro/wp-content/uploads/2021/02/tornada-1024x683.jpg">
                </div>
                <div class="news-content">
                    <h3>Fenomenul meteo explicat</h3>
                    <p>Aflați despre cele mai recente modele meteorologice și impactul acestora asupra climei noastre.</p>
                    <a href="articles.php" class="read-more">
                    Citeşte mai mult
                    <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="view-all">
            <a href="articles.php" class="btn btn-outline">
                Vezi toate articolele
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<section class="cta">
    <div class="container">
        <div class="cta-content">
            <h2>Alăturați-vă OzoneAero astăzi</h2>
            <p>Creați un cont pentru a vă salva locațiile preferate, pentru a primi alerte meteo și pentru a vă personaliza experiența.</p>
            <div class="cta-buttons">
                <a href="register.php" class="btn btn-white">Înscrie-te acum</a>
                <a href="contact.php" class="btn btn-outline-white">Contactaţi-ne</a>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>