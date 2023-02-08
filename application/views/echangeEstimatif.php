<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../assets/bootstrap/bootstrap.min.css">
	<title>Document</title>
</head>

<!-- Styles -->
<?php $this->load->view('assetsIncluder'); ?>

<body>
<?php $this->load->view('navbar'); ?>

	<div class="total mt-3">
		<div class="container">
			<div class="row">
				<div class="card w-100 d-flex flex-row">
					<div class="col-md-6">
						<?php foreach($this->objet->getAllImages($current_objet->getidObjet()) as $image) { ?>
							<img class="card-img-top rounded" src="<?php echo base_url('assets/images/'.$image); ?>" alt="Card image cap">
						<?php } ?>
					</div>

					<div class="card-body col-md-6 text-left">
					<h1 class="card-title">Nom Objet : <?php echo $current_objet->getnomObjet(); ?></h3>
						<div>
							<h3>Description</h3>
							<p><?php echo $current_objet->getDescription(); ?></p>
						</div>

						<div class="card p-3">
							<div class="card-body">
								<h5 class="card-title">Historique</h5>

								<?php 
									if (count($historique) == 0) {?> 
										<p class="text-danger">Aucune historique pour le moment</p>
									<?php }
								?>

								<?php foreach($historique as $hist) { ?>
									<p>Ancien: <?php echo $hist['nom'] ?> le <?php echo $hist['date'] ?></p>
								<?php } ?>
							</div>
						</div>

						<a class="btn btn-primary mt-3" href="<?php echo site_url('frontoffice/echange/change/'.$current_objet->getidObjet()); ?>">Echanger</a>
            <h3>Remise=<?php echo $marge; ?></h3>
						<?php if (isset($_GET['error'])) ?>
							<p class="text-danger mt-3">Vous n'avez pas d'objet a echanger.</p>
							<a href="<?php echo site_url('frontoffice/profil/ajoutObjet'); ?>">En ajouter?</a>
						<?php ?>
					</div>
						
				</div>
			</div>
		</div>


	</div>
	</div>
</body>

</html>