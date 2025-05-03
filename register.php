<?php
session_start();

require_once 'db_connect.php';

$username = $email = $password = $confirm_password = $first_name = $last_name = "";
$username_err = $email_err = $password_err = $confirm_password_err = "";
$registration_success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (empty(trim($_POST["username"]))) {
        $username_err = "Vă rugăm să introduceți un nume de utilizator.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
        $username_err = "Numele de utilizator poate conține numai litere, cifre și liniuțe de subliniere.";
    } else {
        $sql = "SELECT id FROM client WHERE username = ?";
        
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $param_username);
            
            $param_username = trim($_POST["username"]);
            
            if ($stmt->execute()) {
                $stmt->store_result();
                
                if ($stmt->num_rows == 1) {
                    $username_err = "Acest nume de utilizator este deja luat.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Hopa! Ceva a mers prost. Vă rugăm să încercați din nou mai târziu.";
            }

            $stmt->close();
        }
    }

    if (empty(trim($_POST["email"]))) {
        $email_err = "Vă rugăm să introduceți un e-mail.";
    } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $email_err = "Vă rugăm să introduceți o adresă de email validă.";
    } else {
        $sql = "SELECT id FROM client WHERE email = ?";
        
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $param_email);
            
            $param_email = trim($_POST["email"]);
            
            if ($stmt->execute()) {
                $stmt->store_result();
                
                if ($stmt->num_rows == 1) {
                    $email_err = "Acest e-mail este deja înregistrat.";
                } else {
                    $email = trim($_POST["email"]);
                }
            } else {
                echo "Hopa! Ceva a mers prost. Vă rugăm să încercați din nou mai târziu.";
            }

            $stmt->close();
        }
    }
    
    if (empty(trim($_POST["password"]))) {
        $password_err = "Vă rugăm să introduceți o parolă.";     
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Parola trebuie să aibă cel puțin 6 caractere.";
    } else {
        $password = trim($_POST["password"]);
    }
    
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Vă rugăm să confirmați parola.";     
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Parola nu se potrivește.";
        }
    }
    
    $first_name = trim($_POST["first_name"] ?? "");
    $last_name = trim($_POST["last_name"] ?? "");
    
    if (empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)) {
        
        $sql = "INSERT INTO client (username, email, password, first_name, last_name, created_at) VALUES (?, ?, ?, ?, ?, NOW())";
         
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sssss", $param_username, $param_email, $param_password, $param_first_name, $param_last_name);
            
            $param_username = $username;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $param_first_name = $first_name;
            $param_last_name = $last_name;
            
            if ($stmt->execute()) {
                $registration_success = true;
                
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $conn->insert_id;
                $_SESSION["username"] = $username;
                
                header("refresh:3;url=index.php");
            } else {
                echo "Hopa! Ceva a mers prost. Vă rugăm să încercați din nou mai târziu.";
            }
            $stmt->close();
        }
    }
    $conn->close();
}

$pageTitle = "Register - OzoneAero";
include 'header.php';
?>

<section class="register-section">
    <div class="container">
        <div class="form-container">
            <h1>Creați un cont</h1>
            <p class="form-intro">Alăturați-vă OzoneAero pentru a vă salva locațiile preferate, pentru a primi alerte meteo și pentru a vă personaliza experiența.</p>
            
            <?php if ($registration_success): ?>
                <div class="success-message">
                    <h3>Înregistrare reușită!</h3>
                    <p>Contul dvs. a fost creat cu succes. Acum sunteți autentificat.</p>
                    <p>Veți fi redirecționat către pagina principală în 3 secunde. Dacă nu, <a href="index.php">click aici</a>.</p>
                </div>
            <?php else: ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="register-form">
                    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" value="<?php echo $username; ?>">
                        <span class="error-message"><?php echo $username_err; ?></span>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" value="<?php echo $first_name; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" value="<?php echo $last_name; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="<?php echo $email; ?>">
                        <span class="error-message"><?php echo $email_err; ?></span>
                    </div>
                    
                    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                        <label for="password">Parolă</label>
                        <input type="password" name="password" id="password" class="form-control">
                        <span class="error-message"><?php echo $password_err; ?></span>
                    </div>
                    
                    <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                        <label for="confirm_password">Confirmați parola</label>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control">
                        <span class="error-message"><?php echo $confirm_password_err; ?></span>
                    </div>
                    
                    <div class="form-group terms-checkbox">
                        <input type="checkbox" name="terms" id="terms" required>
                        <label for="terms">I agree to the <a href="terms.php">Termeni și condiții</a> şi <a href="privacy.php">Politica de confidențialitate</a></label>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Creează cont</button>
                    </div>
                    
                    <p class="login-link">Aveți deja un cont? <a href="login.php">Conectare</a></p>
                </form>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
