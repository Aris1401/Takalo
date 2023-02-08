<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../assets/bootstrap/bootstrap.min.css">
	<title>Document</title>
</head>

<!-- Styles -->
<link href="<?php echo site_url('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo site_url('assets/vendor/animate/animate.css'); ?>" rel="stylesheet" type="text/css"/>

<body>
	<div class="total">
		<div class="container">
			<div class="row">
				<div class="card w-100 d-flex flex-row">
					<div class="col-md-6 card-img-left">
						<?php foreach($this->objet->getAllImages($current_object->getidObjet()) as $image) { ?>
							<img class="card-img-top" src="<?php echo site_url('assets/images/'.$image); ?>" alt="Card image cap">
						<?php } ?>
					</div>
					
					<div class="card-body col-md-6 text-right">
					<h1 class="card-title">Nom Objet : <?php echo $current_object->getnomObjet(); ?></h3>
						<div>
							<h3>Description</h3>
							<p><?php echo $current_object->getDescription(); ?></p>
						</div>

						<form action="<?php echo site_url('frontoffice/echange/doEchange') ?>" method="post" class="form-inline w-100 d-flex flex-row justify-content-end">
                            <input type="hidden" name="other_object" value="<?php echo $current_object->getidObjet(); ?>">
                        
                            <div class="form-group">
                                <select class="form-control custom-select" name="my_object" id="objets">
                                    <?php foreach($my_objects as $objet) { ?>
                                        <option value="<?php echo $objet['idObjet'] ?>"><?php echo $objet['nomObjet']; ?></option>    
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <input type="submit" value="Echanger" class="btn btn-primary">
                            </div>
                        </form>
					</div>
						
				</div>
			</div>
		</div>


	</div>
	</div>
</body>

</html>