<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tout echanges</title>
</head>

<!-- Styles -->
<?php $this->load->view('assetsIncluder'); ?>

<body>
    <?php $this->load->view('navbar'); ?>

    <div class="container">
        <h3 class="p-3">Liste des echanges courants</h3>

        <?php if (count($echanges) == 0) { ?>
            <p class="p-3 card border-danger">Aucun echange pour le moment</p>    
        <?php } ?>

        <?php foreach($echanges as $echange) { ?>
            <div class="row">
                <div class="card w-100">
                    <div class="d-flex flex-row justify-content-between p-3">
                        <div class="card" style="width: 5rem; height: 5rem;">
                            <p class="card-text"><?php echo $this->objet->getObjetById($echange['receveur'])->getnomObjet(); ?></p>
                        </div>

                        <div class="card d-flex flex-row gap-1">
                            <?php 
                                $sous_echanges = explode(",", $echange['echangeur']);
    
                                foreach ($sous_echanges as $idObjet) {
                            ?>
                            <div class="card" style="width: 5rem; height: 5rem;">
                                <p class="card-text"><?php echo $this->objet->getObjetById($idObjet)->getnomObjet(); ?></p>
                            </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="d-flex flex-row justify-content-center w-100 btn-group p-3">
                        <a class="btn btn-primary" href="<?php echo site_url('frontoffice/echange/acceptEchange/'.$echange['idEchange']); ?>">Accepter</a>
                        <a class="btn btn-danger" href="<?php echo site_url('frontoffice/echange/declineEchange/'.$echange['idEchange']); ?>">Decliner</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</body>
</html>