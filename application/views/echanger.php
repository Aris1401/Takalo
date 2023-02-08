<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../assets/bootstrap/bootstrap.min.css">
	<title>Document</title>
</head>

<!-- Styles -->
<link href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/vendor/animate/animate.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('/assets/fontawesome-free-6.2.1-web/css/all.min.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('/assets/css/search.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/css/navbar.css'); ?>" rel="stylesheet" type="text/css"/>


<body>
	<?php $this->load->view('navbar'); ?>

	<div class="total">
		<div class="container">
			<div class="row">
				<div class="card w-100 d-flex flex-row">
					<div class="col-md-6 card-img-left">
						<?php foreach($this->objet->getAllImages($current_object->getidObjet()) as $image) { ?>
							<img class="card-img-top" src="<?php echo base_url('assets/images/'.$image); ?>" alt="Card image cap">
						<?php } ?>
					</div>

					<div class="card-body col-md-6 text-right">
					<h1 class="card-title">Nom Objet : <?php echo $current_object->getnomObjet(); ?></h3>
						<div>
							<h3>Description</h3>
							<p><?php echo $current_object->getDescription(); ?></p>
						</div>

						<ul class="card list-group list-group-flush">
							<?php if (isset($_SESSION['echanges'])){
								foreach($_SESSION['echanges'] as $echange) {
							?>
							<li class="list-group-item"><?php echo $this->objet->getObjetById($echange)->getnomObjet(); ?></li>
							<?php }} ?>
						</ul>

						<form action="<?php echo site_url('frontoffice/echange/addNewEchange') ?>" method="post" class="form-inline w-100 d-flex flex-row justify-content-end mt-2">
                            <input type="hidden" name="other_object" value="<?php echo $current_object->getidObjet(); ?>">
							
                            <div class="form-group">
                                <select class="form-control custom-select" name="my_object" id="objets">
                                    <?php foreach($my_objects as $objet) { ?>
                                        <option value="<?php echo $objet['idObjet'] ?>"><?php echo $objet['nomObjet']; ?></option>    
                                    <?php } ?>
                                </select>
                            </div>

                        	<input type="submit" value="Ajouter" class="btn btn-primary">
                        </form>

						<form class="form-group mt-2" action="<?php echo site_url('frontoffice/echange/doEchange') ?>" method="post">
							<input type="hidden" name="other_object" value="<?php echo $current_object->getidObjet(); ?>">
							
							<button type="submit" class="btn btn-secondary">
								Valider
							</button>
						</form>
					</div>
						
				</div>
			</div>
		</div>


	</div>
	</div>
</body>

</html>