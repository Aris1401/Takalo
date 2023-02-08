<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="../assets/css/Objet.css">
	<link rel="stylesheet" href="../assets/css/all.css">
	<link rel="stylesheet" href="../assets/bootstrap/bootstrap.min.css">

</head>

<!-- Styles -->
<link href="<?php echo site_url('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo site_url('assets/vendor/animate/animate.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo site_url('assets/css/navbar.css'); ?>" rel="stylesheet" type="text/css"/>

<body>
	<?php $this->load->view('navbar'); ?>

	<div class="container w-100 h-100 mt-2 d-flex justify-content-center align-items-center">
		<div class="AjoutObjet card p-3">
			<h1>Ajouter un nouveau objet</h1>
			<div class="form-group formAjout">
				<form action="<?php echo site_url('frontoffice/profil/doModifierObjet') ?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="idObjet" value="<?php echo $current_objet->getidObjet(); ?>">
				
					<label for="nom">Nom</label>
					<input class="form-control" type="text" name="nom" id="nom" placeholder="Nom" value="<?php echo $current_objet->getnomObjet(); ?>">

					<label for="prix">Prix</label>
					<input class="form-control" type="text" name="prix_estimer" id="prix" placeholder="Prix estimer" value="<?php echo $current_objet->getPrixEstimatif(); ?>">

					<label for="description">Description</label>
					<input class="form-control" type="text" name="description" id="description" placeholder="Description" value = "<?php echo $current_objet->getdescription(); ?>">
					
					<div class="form-group">
						<label for="categorie">Categorie</label>
						<select class="form-control" name="categorie" id="categorie">
							<?php foreach ($categories as $categorie) { ?>
								<option <?php if ($categorie == $current_objet->getCategorie()) echo "selected"; ?> value="<?php echo $categorie['idCategorie']; ?>"><?php echo $categorie['nomCategorie']; ?></option>
							<?php } ?>
						</select>
					</div>
					<input class="btn btn-primary w-100" type="submit" value="Valider">
				</form>
			</div>
	
		</div>		
	</div>

</body>

</html>