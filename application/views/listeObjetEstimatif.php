<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
</head>

<!-- Styles -->
<?php $this->load->view('assetsIncluder'); ?>

<body>
<?php $this->load->view('navbar'); ?>
  <div class="container">
    <div class="card p-4 mt-2">
    </div>
    <div class="card-deck mr-3 ml-3 allObject">
      <?php foreach($all_objets as $objet) { ?>
        <div class="card d-flex flex-row p-3 justify-content-between align-items-center object">
          <img class="card-img-left rounded" src="<?php echo base_url('assets/images/'.$this->objet->get_one_of_images($objet['idObjet'])); ?>" width="150" height="150">
          <div class="card-body text-right">
            <p class="card-title"><?php echo $objet['nomObjet']; ?></p>
            <p class="card-text text-secondary"><?php echo $objet['description'] ?></p>
            <a class="btn btn-primary" href="<?php echo site_url('frontoffice/listeObjetEstimatif/echangeEstimatif/'.$objet['idObjet'])."/".$current_objet; ?>">Echanger</a>
          </div>
        </div>
      <?php } ?>
    </div>
  
  </div>
</body>

</html>