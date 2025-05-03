<?php
session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}

require_once "db_connect.php";

$username = $password = "";
$username_err = $password_err = $login_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["username"]))){
        $username_err = "Vă rugăm să introduceți numele de utilizator sau adresa de e-mail.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Vă rugăm să introduceți parola.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    if(empty($username_err) && empty($password_err)){
        $sql = "SELECT id, username, email, password FROM client WHERE username = ? OR email = ?";
        
        if($stmt = $conn->prepare($sql)){
            
            $stmt->bind_param("ss", $param_username, $param_username);
            
            $param_username = $username;
        
            if($stmt->execute()){
                $stmt->store_result();
                
                if($stmt->num_rows == 1){                    
                    $stmt->bind_result($id, $username, $email, $hashed_password);
                    if($stmt->fetch()){
                        if(password_verify($password, $hashed_password)){
                            session_start();
                            
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["email"] = $email;
                            
                            $update_sql = "UPDATE client SET last_login = NOW() WHERE id = ?";
                            if($update_stmt = $conn->prepare($update_sql)){
                                $update_stmt->bind_param("i", $id);
                                $update_stmt->execute();
                                $update_stmt->close();
                            }
                            
                            header("location: index.php");
                        } else{
                            $login_err = "Nume de utilizator sau parolă nevalidă.";
                        }
                    }
                } else{
                    $login_err = "Nume de utilizator sau parolă nevalidă.";
                }
            } else{
                echo "Hopa! Ceva a mers prost. Vă rugăm să încercați din nou mai târziu.";
            }

            $stmt->close();
        }
    }
    
    $conn->close();
}

$pageTitle = "Login - OzoneAero";
include 'header.php';
?>

<section class="login-section">
    <div class="container">
        <div class="form-container">
            <h1>Conectați-vă la contul dvs</h1>
            <p class="form-intro">Accesați tabloul de bord personalizat despre vreme și locațiile salvate.</p>
            
            <?php 
            if(!empty($login_err)){
                echo '<div class="error-alert">' . $login_err . '</div>';
            }        
            ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="login-form">
                <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                    <label for="username">Nume de utilizator sau e-mail</label>
                    <input type="text" name="username" id="username" class="form-control" value="<?php echo $username; ?>">
                    <span class="error-message"><?php echo $username_err; ?></span>
                </div>    
                
                <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <div class="password-label-row">
                        <label for="password">Parolă</label>
                        <a href="reset-password.php" class="forgot-password">Aţi uitat parola?</a>
                    </div>
                    <input type="password" name="password" id="password" class="form-control">
                    <span class="error-message"><?php echo $password_err; ?></span>
                </div>
                
                <div class="form-group remember-me">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Ține-mă minte</label>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Log in</button>
                </div>
                
                <p class="register-link">Nu ai un cont? <a href="register.php">Înscrie-te acum</a></p>
            </form>
            
            <div class="social-login">
                <div class="divider">
                    <span>Sau conectați-vă cu</span>
                </div>
                <div class="social-buttons">
                    <a href="#" class="btn btn-social btn-google">Google</a>
                    <a href="#" class="btn btn-social btn-facebook">Facebook</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
