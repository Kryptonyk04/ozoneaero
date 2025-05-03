<?php
$pageTitle = "Harta vremii - OzoneAero";
$currentPage = "map";
$extraCSS = '<link rel="stylesheet" href="map.css">';
include 'header.php';
?>

<section class="map-section">
    <div class="container">
        <h1>Harta meteo interactivă</h1>
        <p class="map-intro">Explorați condițiile meteorologice actuale din România. Faceți clic pe un județ pentru a vedea informații detaliate despre vreme.</p>
        
        <div class="map-container">
            <?php include 'ro.svg'; ?>
            
            <div class="map-sidebar">
                <div class="county-info" id="county-info">
                    <h2>Selectați un județ</h2>
                    <p>Faceți clic pe un județ pentru a vedea datele meteo actuale.</p>
                </div>
                
                <div id="loading-indicator" class="loading-indicator" style="display: none;">
                    <div class="spinner"></div>
                    <p>Se încarcă datele meteo...</p>
                </div>
                
                <div class="time-period-selector" id="time-period-selector" style="display: none;">
                    <button class="time-btn active" data-period="daily">Zilnic</button>
                    <button class="time-btn" data-period="hourly">Orar</button>
                    <button class="time-btn" data-period="weekly">Săptămânal</button>
                </div>
                
                <div class="weather-details" id="weather-details">
                </div>
            </div>
        </div>
        
        <div class="map-legend">
            <h3>Legenda vremii</h3>
            <ul>
                <li><span class="legend-color" style="background-color: #ffeb3b;"></span> Însorit/senin</li>
                <li><span class="legend-color" style="background-color: #90caf9;"></span> Ploios</li>
                <li><span class="legend-color" style="background-color: #e0e0e0;"></span> Înnorat</li>
                <li><span class="legend-color" style="background-color: #81c784;"></span> Normal</li>
                <li><span class="legend-color" style="background-color: #ef5350;"></span> Fierbinte (>30°C)</li>
                <li><span class="legend-color" style="background-color: #90a4ae;"></span> Rece (<10°C)</li>
            </ul>
        </div>
    </div>
</section>

<script src="map.js"></script>

<?php include 'footer.php'; ?>
