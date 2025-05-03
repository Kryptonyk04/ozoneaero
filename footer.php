</main>
    <footer class="site-footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <div class="logo">
                        <a href="/">
                            <i class="fa-solid fa-cloud"></i>
                            <span>OzoneAero</span>
                        </a>
                    </div>
                    <p>Furnizarea de prognoze meteo precise și date meteorologice pentru toate județele din Romania.</p>
                    <div class="social-links">
                        <a href="#"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    </div>
                </div>
                <div class="footer-col">
                    <h3>Legături rapide</h3>
                    <ul>
                        <li><a href="index.php">Acasă</a></li>
                        <li><a href="map.php">Harta vremii</a></li>
                        <li><a href="articles.php">Articole</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h3>Legi</h3>
                    <ul>
                        <li><a href="/privacy.php">Politica de confidențialitate</a></li>
                        <li><a href="/terms.php">Termeni și condiții</a></li>
                        <li><a href="/cookies.php">Politica de cookie-uri</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h3>Contactaţi-ne</h3>
                    <ul class="contact-info">
                        <li>
                            <i class="fa-solid fa-location-dot"></i>
                            <span>Podele nr.104, Hunedoara, România</span>
                        </li>
                        <li>
                            <i class="fa-solid fa-phone"></i>
                            <span>+40 727 523 871</span>
                        </li>
                        <li>
                            <i class="fa-solid fa-envelope"></i>
                            <span>ozoneaero@gmail.com</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; <?php echo date('Y'); ?> OzoneAero. Toate drepturile rezervate.</p>
            </div>
        </div>
    </footer>

    <script src="main.js"></script>
    <?php if (isset($extraJS)) echo $extraJS; ?>
</body>
</html>