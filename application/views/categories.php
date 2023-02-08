<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerer categorie</title>
</head>

<!-- Styles -->
<?php $this->load->view('assetsIncluder'); ?>

<body>
    <?php $this->load->view('navbar'); ?>

    <div class="container">
        <h3 class="card p-3 mt-2">Gerer categories</h3>

        <h5>Tous les categories</h5>
        <ul class="list-group list-group-flush">
            <?php foreach($categories as $categorie){ ?>
                <li class="list-group-item"><?php echo $categorie['nomCategorie']; ?></li>
            <?php } ?>
        </ul>

        <form action="<?php echo site_url('frontoffice/profil/ajouterCategorie') ?>" method="post" class="form-group p-3 d-flex flex-row card mt-3">
            <input type="text" class="form-control col-md-3" name="nom" id="categorie" placeholder="Nouvelle categorie">
            <input class="btn btn-primary col-md-1" type="submit" value="Ajouter">
        </form>
    </div>
</body>
</html>