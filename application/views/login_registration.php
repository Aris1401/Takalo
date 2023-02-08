<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    $this->load->helper('url');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<link rel="stylesheet" href="<?php echo base_url('assets/css/default.css/'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/login_registration_style.css/'); ?>">

<script src="<?php echo base_url("assets/js/login_registration_script.js/"); ?>" defer></script>

<body>
    <div class="container">
        <div class="login-register-container">
            <!-- Login form -->
            <div class="login-form-container">
                <form method="post" class="login-form" action="<?php echo site_url('LoginRegisterController/login/') ?>">
                    <div class="titles">
                        <h1>Se connecter</h1>
                    </div>

                    <div class="login-form-inputs">
                        <input type="text" name="username" id="username" placeholder="username">
                        <input type="password" name="password" id="password" placeholder="password">
                        <p class="error-message">Nom ou mot de passe incorrect</p>
                    </div>

                    <div class="login-form-links">
                        <a>Aucun compte?</a>
                    </div>

                    <input type="submit" value="Se connecter" class="submit-login">
                </form>
            </div>

            <!-- Register form -->
            <div class="register-form-container">
                <form action="<?php echo site_url('backoffice/loginRegister/register/') ?>" method="post" class="register-form">
                    <div class="titles">
                        <h1>S'inscrire</h1>
                    </div>
    
                    <div class="register-form-inputs">
                        <input type="text" name="nom" id="nom" placeholder="nom">
                        <input type="text" name="prenom" id="prenom" placeholder="prenom">
                        <input type="date" name="date" id="date" placeholder="date">
                        <input type="password" name="password" id="password" placeholder="password">
                        <p class="error-message-register">Veuillez entrer des informations valides</p>
                    </div>
    
                    <input type="submit" value="S'inscrire" class="submit-register">
                </form>
            </div>             
        </div>
    </div>
</body>
</html>