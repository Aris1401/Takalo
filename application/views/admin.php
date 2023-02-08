<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>

<!-- Styles -->
<link href="<?php echo site_url('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo site_url('assets/vendor/animate/animate.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo site_url('assets/css/navbar.css'); ?>" rel="stylesheet" type="text/css"/>

<body>
    <?php $this->load->view('navbar'); ?>

    <div class="container mt-3">
        <div class="row">
            <div class="card w-100 p-5">
                <h4 class="card-title">
                    Nombre d'Utilisateur: 
                </h4>
                <p class="card p-3"><?php echo $nombre_user; ?></p>
            </div>
        </div>

        <div class="row mt-3">
            <div class="card w-100 p-5">
                <h4 class="card-title">
                    Nombre d'echange:  
                </h4>
                <p class="card p-3"><?php echo $nombre_echange; ?></p>
            </div>
        </div>
    </div>
</body>
</html>