<?php
$pageTitle = "Articole și Resurse Meteo - OzoneAero";
$currentPage = "articles";
$extraJS = '<script src="articles.js"></script>';
include 'header.php';
?>

<div class="container">
    <div class="page-header">
        <h1>Articole și Resurse Meteo din România</h1>
        <p>Explorează colecția noastră de articole, videoclipuri și fotografii despre fenomenele meteorologice din România.</p>
    </div>

    <div class="articles-tabs">
        <div class="tab-buttons">
            <button class="tab-btn active" data-tab="articles">Articole</button>
            <button class="tab-btn" data-tab="videos">Videoclipuri</button>
            <button class="tab-btn" data-tab="photos">Fotografii</button>
        </div>
    </div>

    <div class="articles-content">
        <div class="tab-content active" id="articles-tab">
            <div class="articles-grid">
                <div class="news-card">
                    <div class="news-image">
                        <img src="https://www.meteoromania.ro/images/clima/temperatura_orara_ieri.png" alt="Vreme extremă în România">
                    </div>
                    <div class="news-content">
                        <div class="news-meta">
                            <span><i class="fa-solid fa-calendar"></i> 15 Iunie 2023</span>
                            <span><i class="fa-solid fa-user"></i> Meteoromânia</span>
                        </div>
                        <h3>Tendințe climatice în România: Ce ne așteaptă în următorii ani</h3>
                        <p>Analiză detaliată a schimbărilor climatice în România și impactul asupra fenomenelor meteorologice extreme.</p>
                        <a href="https://www.meteoromania.ro/anm/images/clima/Schimbariclimatice2014.pdf" class="read-more" target="_blank">
                            Citește articolul
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <div class="news-card">
                    <div class="news-image">
                        <img src="https://s.iw.ro/gateway/g/ZmlsZVNvdXJjZT1odHRwJTNBJTJGJTJG/c3RvcmFnZTA3dHJhbnNjb2Rlci5yY3Mt/cmRzLnJvJTJGc3RvcmFnZSUyRjIwMTcl/MkYwNSUyRjIzJTJGNzc5NzExXzc3OTcx/MV90b3JuYWRhLnBuZyZ3PTc4MCZoPTQ0/MCZoYXNoPTdmNTMzOGNkZjEzODcwZDVkMjc3NzRjYzdiNGEwYjk0.thumb.jpg" alt="Tornadă în România">
                    </div>
                    <div class="news-content">
                        <div class="news-meta">
                            <span><i class="fa-solid fa-calendar"></i> 21 August 2023</span>
                            <span><i class="fa-solid fa-user"></i> Digi24</span>
                        </div>
                        <h3>Tornada din Ialomița: Fenomen meteorologic rar în România</h3>
                        <p>Reportaj despre tornada care a afectat județul Ialomița în mai 2017, cu imagini spectaculare.</p>
                        <a href="https://www.digi24.ro/stiri/actualitate/evenimente/video-comuna-devastata-de-a-doua-tornada-in-15-ani-729553" class="read-more" target="_blank">
                            Citește articolul
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <div class="news-card">
                    <div class="news-image">
                        <img src="https://media.mediafax.ro/FIamdMjDHtzOqcmWgG-ok5JpP-I=/1280x720/smart/filters:contrast(5):format(webp):quality(80)/https://www.mediafax.ro/wp-content/uploads/images/1/1688/22068558/1-7894446-mediafax-foto-zuma-press-hepta.jpg" alt="Caniculă în România">
                    </div>
                    <div class="news-content">
                        <div class="news-meta">
                            <span> 27 decembrie 2024</span>
                            <span><i class="fa-solid fa-user"></i> Mediafax</span>
                        </div>
                        <h3>Valuri de căldură în România: Cum ne protejăm</h3>
                        <p>Recomandări ale autorităților pentru a face față valurilor de căldură care bat recorduri în ultimii ani.</p>
                        <a href="https://www.mediafax.ro/social/schimbarile-climatice-au-adus-un-an-de-recorduri-periculoase-pentru-planeta-22625360" class="read-more" target="_blank">
                            Citește articolul
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="view-all">
                <a href="https://www.meteoromania.ro/avertizari/" class="btn btn-outline" target="_blank">Mai multe articole</a>
            </div>
        </div>

        <div class="tab-content" id="videos-tab">
            <div class="articles-grid">
                <div class="news-card">
                    <div class="news-image">
                        <img src="https://cdn.adh.reperio.news/image-d/d37f4270-ecae-43fd-bda4-3c19467c5b58/index.jpeg?p=a%3D1%26co%3D1.05%26w%3D700%26h%3D750%26r%3Dcontain%26f%3Dwebp" alt="Furtună violentă în București">
                        <div class="video-play">
                        </div>
                    </div>
                    <div class="news-content">
                        <div class="news-meta">
                            <span></i> 15 Iulie 2023</span>
                            <span></i> 4:32</span>
                        </div>
                        <h3>Furtună violentă în București - Imagini spectaculare</h3>
                        <p>Videoclip cu furtuna puternică care a lovit capitala în iulie 2024, cu descărcări electrice impresionante.</p>
                        <a href="https://www.youtube.com/watch?v=5XQ7J7J7J7J" class="btn btn-outline" target="_blank">
                            Vezi videoclipul
                           
                        </a>
                    </div>
                </div>

                <div class="news-card">
                    <div class="news-image">
                        <img src="https://www.idevice.ro/wp-content/uploads/2024/12/ANM-Prognoza-Meteo-Oficiala-Actualizata-ULTIM-MOMENT-Romania-Inceputul-2025.jpg" alt="Prognoza meteo ANM">
                        <div class="video-play">
                        </div>
                    </div>
                    <div class="news-content">
                        <div class="news-meta">
                            <span><i class="fa-solid fa-calendar"></i> Actualizat zilnic</span>
                            <span><i class="fa-solid fa-clock"></i> 2:15</span>
                        </div>
                        <h3>Prognoza meteo oficială ANM pentru România</h3>
                        <p>Prognoza zilnică a Administrației Naționale de Meteorologie pentru întreaga țară.</p>
                        <a href="https://www.youtube.com/watch?v=02XmC29-P1c" class="btn btn-outline" target="_blank">
                            Vezi videoclipul
                        </a>
                    </div>
                </div>

                <div class="news-card">
                    <div class="news-image">
                        <img src="https://cdn.aktual24.ro/wp-content/uploads/2023/11/viscol.png" alt="Viscol în Carpați">
                        <div class="video-play">

                        </div>
                    </div>
                    <div class="news-content">
                        <div class="news-meta">
                            <span></i> 10 Ianuarie 2023</span>
                        </div>
                        <h3>Viscol puternic în Carpații României</h3>
                        <p>Imagini spectaculare cu viscolul care a izolat sate în Carpați în ianuarie 2022.</p>
                        <a href="https://www.youtube.com/watch?v=pCXPIeNccZE" class="btn btn-outline" target="_blank">
                            Vezi videoclipul
                        </a>
                    </div>
                </div>
            </div>
            <div class="view-all">
                <a href="https://www.youtube.com/results?search_query=meteo+romania" class="btn btn-outline" target="_blank">Mai multe videoclipuri</a>
            </div>
        </div>

        <div class="tab-content" id="photos-tab">
            <div class="photo-grid">
                <div class="photo-item">
                    <img src="https://www.oradesibiu.ro/wp-content/uploads/2019/10/curcubeu2.jpg" alt="Curcubeu în Sibiu">
                    <div class="photo-overlay">
                        <p>Curcubeu spectaculos în Sibiu după o furtună</p>
                    </div>
                </div>
                <div class="photo-item">
                    <img src="https://i0.1616.ro/media/2/2621/34127/19016600/1/zalau.jpg?width=514" alt="Furtună în România">
                    <div class="photo-overlay">
                        <p>Furtună puternică în sudul României</p>
                    </div>
                </div>
                <div class="photo-item">
                    <img src="https://media.descopera.ro/NthcH8yMNykI1rYaY2P5xCZ9WuY=/1280x720/smart/filters:contrast(5):format(webp):quality(80)/https://www.descopera.ro/wp-content/uploads/2019/01/17843136/2-apuseni.jpg" alt="Viscol în Apuseni">
                    <div class="photo-overlay">
                        <p>Viscol în Munții Apuseni</p>
                    </div>
                </div>
                <div class="photo-item">
                    <img src="https://cdn.g4media.ro/wp-content/uploads/2023/08/FB1A9313-768x512.jpg" alt="Caniculă în București">
                    <div class="photo-overlay">
                        <p>Val de căldură în București</p>
                    </div>
                </div>
                <div class="photo-item">
                    <img src="https://storage0.dms.mpinteractiv.ro/media/1/1/4728/17230194/2/tornada.jpg" alt="Tornadă în România">
                    <div class="photo-overlay">
                        <p>Tornadă rară în sud-estul României</p>
                    </div>
                </div>
                <div class="photo-item">
                    <img src="https://foto.agerpres.ro/storage/watermark/7515968.jpg" alt="Ceată pe Dunăre">
                    <div class="photo-overlay">
                        <p>Ceață densă pe Dunăre dimineața</p>
                    </div>
                </div>
            </div>
            <div class="view-all">
                <a href="https://www.google.com/search?q=meteo+romania+poze&sca_esv=daf07b3e4903b956&udm=2&biw=1536&bih=735&ei=vUgLaJO_E9mgi-gPmKOe2AI&ved=0ahUKEwjTkav14vKMAxVZ0AIHHZiRBysQ4dUDCBE&uact=5&oq=meteo+romania+poze&gs_lp=EgNpbWciEm1ldGVvIHJvbWFuaWEgcG96ZUjwDVDEAVjSDHABeACQAQCYAV2gAbADqgEBNbgBA8gBAPgBAZgCA6ACzQHCAgYQABgHGB7CAg0QABiABBixAxhDGIoFwgIFEAAYgATCAgQQABgewgIGEAAYCBgemAMAiAYBkgcBM6AH8QuyBwEyuAfFAQ&sclient=img" class="btn btn-outline" target="_blank">Mai multe fotografii</a>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

