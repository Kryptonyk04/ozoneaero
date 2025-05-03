<?php
session_start();

require_once 'db_connect.php';

$first_name = $last_name = $email = $subject = $message = "";
$first_name_err = $last_name_err = $email_err = $subject_err = $message_err = "";
$submission_success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (empty(trim($_POST["first_name"]))) {
        $first_name_err = "Vă rugăm să introduceți prenumele.";
    } else {
        $first_name = trim($_POST["first_name"]);
    }
    
    if (empty(trim($_POST["last_name"]))) {
        $last_name_err = "Vă rugăm să introduceți numele dvs. de familie.";
    } else {
        $last_name = trim($_POST["last_name"]);
    }
    
    if (empty(trim($_POST["email"]))) {
        $email_err = "Vă rugăm să introduceți adresa dvs. de e-mail.";
    } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $email_err = "Vă rugăm să introduceți o adresă de email validă.";
    } else {
        $email = trim($_POST["email"]);
    }
    
    if (empty(trim($_POST["subject"]))) {
        $subject_err = "Vă rugăm să introduceți un subiect.";
    } else {
        $subject = trim($_POST["subject"]);
    }
    
    if (empty(trim($_POST["message"]))) {
        $message_err = "Vă rugăm să introduceți mesajul dvs.";
    } else {
        $message = trim($_POST["message"]);
    }
    
    if (empty($first_name_err) && empty($last_name_err) && empty($email_err) && empty($subject_err) && empty($message_err)) {
        
        $sql = "INSERT INTO contact (first_name, last_name, email, subject, message, created_at) VALUES (?, ?, ?, ?, ?, NOW())";
         
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sssss", $param_first_name, $param_last_name, $param_email, $param_subject, $param_message);
            
            $param_first_name = $first_name;
            $param_last_name = $last_name;
            $param_email = $email;
            $param_subject = $subject;
            $param_message = $message;
            
            if ($stmt->execute()) {
                $submission_success = true;
                $first_name = $last_name = $email = $subject = $message = "";
            } else {
                echo "Hopa! Ceva a mers prost. Vă rugăm să încercați din nou mai târziu.";
            }

            $stmt->close();
        }
    }
    
    $conn->close();
}

$pageTitle = "Contactaţi-ne - OzoneAero";
$currentPage = "contact";
include 'header.php';
?>

<div class="container">
    <div class="page-header">
        <h1>Contactaţi-ne</h1>
        <p>Luați legătura cu echipa noastră pentru orice întrebări sau feedback.</p>
    </div>

    <div class="contact-grid">
        <div class="contact-form-card">
            <div class="card-header">
                <h2>Trimite-ne un mesaj</h2>
                <p>Completați formularul de mai jos și vă vom contacta cât mai curând posibil.</p>
            </div>
            <div class="card-content">
                <?php if ($submission_success): ?>
                    <div class="success-message">
                        <i class="fa-solid fa-check-circle"></i>
                        <p>Mesajul dumneavoastră a fost trimis cu succes. Vom reveni cu un mesaj în curând!</p>
                    </div>
                <?php endif; ?>

                <form method="POST" class="contact-form">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="first-name">Nume</label>
                            <input type="text" id="first-name" name="first_name" placeholder="Popescu" value="<?php echo htmlspecialchars($first_name); ?>">
                            <small class="error"><?php echo $first_name_err; ?></small>
                        </div>
                        <div class="form-group">
                            <label for="last-name">Prenume</label>
                            <input type="text" id="last-name" name="last_name" placeholder="Andrei" value="<?php echo htmlspecialchars($last_name); ?>">
                            <small class="error"><?php echo $last_name_err; ?></small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Popescu.Andrei@exemplu.com" value="<?php echo htmlspecialchars($email); ?>">
                        <small class="error"><?php echo $email_err; ?></small>
                    </div>
                    <div class="form-group">
                        <label for="subject">Subiect</label>
                        <input type="text" id="subject" name="subject" placeholder="Cum te putem ajuta?" value="<?php echo htmlspecialchars($subject); ?>">
                        <small class="error"><?php echo $subject_err; ?></small>
                    </div>
                    <div class="form-group">
                        <label for="message">Mesaj</label>
                        <textarea id="message" name="message" placeholder="Vă rugăm să furnizați cât mai multe detalii posibil..."><?php echo htmlspecialchars($message); ?></textarea>
                        <small class="error"><?php echo $message_err; ?></small>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fa-solid fa-paper-plane"></i>
                        Trimite mesaj
                    </button>
                </form>
            </div>
        </div>

        <div class="contact-info-container">
            <div class="contact-info-card">
                <div class="card-header">
                    <h2>Informații de contact</h2>
                    <p>Iată cum ne puteți contacta direct.</p>
                </div>
                <div class="card-content">
                    <div class="contact-info-item">
                        <i class="fa-solid fa-location-dot"></i>
                        <div>
                            <h3>Adresa noastră</h3>
                            <p>
                                Sat Podele<br>
                                Hunedoara, Romania<br>
                                104
                            </p>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <i class="fa-solid fa-envelope"></i>
                        <div>
                            <h3>Email</h3>
                            <p>
                                ozoneaero@gmail.com<br>
                            </p>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <i class="fa-solid fa-phone"></i>
                        <div>
                            <h3>Sună-ne</h3>
                            <p>
                                +40 727 523 871<br>
                                Luni - vineri, 09:00 - 17:00
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="map-card">
                <div class="card-header">
                    <h2>Locația noastră</h2>
                    <p>Găsiți-ne pe hartă.</p>
                </div>
                <div class="map-placeholder">
                    <i class="fa-solid fa-location-dot"></i>
                    <p class="map-note"><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1055.4770933270543!2d22.78962203787079!3d46.05498660359468!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sro!4v1745567804230!5m2!1sen!2sro" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
