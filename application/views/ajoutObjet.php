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
<?php $this->load->view('assetsIncluder'); ?>

<body>
	<?php $this->load->view('navbar'); ?>

	<div class="container w-100 h-100 mt-2 d-flex justify-content-center align-items-center">
		<div class="AjoutObjet card p-3">
			<h1>Ajouter un nouveau objet</h1>
			<div class="form-group formAjout">
				<form action="<?php echo site_url('frontoffice/profil/doAjoutObjet') ?>" method="post" enctype="multipart/form-data">
					<label for="nom">Nom</label>
					<input class="form-control" type="text" name="nom" id="nom" placeholder="Nom">

					<label for="prix">Prix</label>
					<input class="form-control" type="number" step="0.1" name="prix_estimer" id="prix" placeholder="Prix estimer">

					<label for="description">Description</label>
					<input class="form-control" type="text" name="description" id="description" placeholder="Description">

					<label for="photos">Photos</label>
					<input class="form-control" type="file" name="file[]" multiple id="photos">
					
					<div class="form-group">
						<label for="categorie">Categorie</label>
						<select class="form-control" name="categorie" id="categorie">
							<?php foreach ($categories as $categorie) { ?>
								<option value="<?php echo $categorie['idCategorie']; ?>"><?php echo $categorie['nomCategorie']; ?></option>
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