<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
</head>

<!-- Styles -->
<link href="<?php echo site_url('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo site_url('assets/vendor/animate/animate.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo site_url('assets/css/navbar.css'); ?>" rel="stylesheet" type="text/css"/>

<body>
  <?php $this->load->view('navbar'); ?>
  
  <div class="container">
    <div class="card p-4 mt-2">
      <h3><?php echo $user->getnomUser() . " " . $user->getprenomUser(); ?></h3>
    </div>
  
    <div class="btn-group mt-2 mb-2 col-md-6 justify-content-end">
      <a class="btn btn-primary w-20 text-white" href="<?php echo site_url('frontoffice/profil/gererCategorie') ?>">Gerer les categories</a>
      <a class="btn btn-primary w-20 text-white" href="<?php echo site_url('frontoffice/profil/ajoutObjet'); ?>">Ajouter nouvel objet</a>
      <a class="btn btn-primary w-20 text-white" href="<?php echo site_url('frontoffice/echange'); ?>">Liste des echanges</a>
    </div>
  
    <div class="card-columns mt-3 d-flex flex-wrap mr-3 ml-3 allObject">
      <?php foreach($user_objets as $objet) { ?>
        <div class="card d-flex flex-row p-3 justify-content-between align-items-center object">
          <img class="card-img-left rounded" src="<?php echo site_url('assets/images/'.$this->objet->get_one_of_images($objet['idObjet'])); ?>" width="150" height="150">
          <div class="card-body text-right">
            <p class="card-title"><?php echo $objet['nomObjet']; ?></p>
            <p class="card-text text-secondary"><?php echo $objet['description'] ?></p>
            <a class="btn btn-primary" href="<?php echo site_url('frontoffice/profil/modifierObjet/'.$objet['idObjet']); ?>">Modifier</a>
          </div>
        </div>
      <?php } ?>
    </div>
  
  </div>
</body>

</html>