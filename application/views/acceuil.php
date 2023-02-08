<!DOCTYPE html>
<html lang="en" class="no-js">
   <head>
      <!-- Meta -->
      <title>Home</title>
      <meta charset="UTF-8">
      <meta name="description" content="Free HTML template">
      <meta name="keywords" content="HTML, template, free">
      <meta name="author" content="Nicola Tolin">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Styles -->
      <link href="<?php echo site_url('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css"/>
      <link href="<?php echo site_url('assets/vendor/animate/animate.css'); ?>" rel="stylesheet" type="text/css"/>
      <link href="<?php echo site_url('assets/css/accueil.css'); ?>" rel="stylesheet" type="text/css"/>
   </head>
   <body>
      <?php $this->load->view('navbar'); 
      ?>
      
      <!-- Portfolio-Text -->
      <div class="container-fluid pb-5 portfolio-text">
         <div class="row">
            <div class="col-md-7 offset-md-1 col-sm-12">
               <h2>Donec rutrum congue leo eget malesuada lacinia eget consectetur.
               </h2>
            </div>
         </div>
         <div class="row">
            <div class="col-md-7 offset-md-1 col-sm-12">
               <p class="pb-5 pt-5">
                  Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Vivamus magna convallis at tellus. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi.
               </p>
            </div>
         </div>
      </div>
      <!-- End Portfolio-Text -->
      <!-- Gallery -->
      <div class="scrollblock">
         <div class="container-fluid pt-10">
            <div class="row justify-content-md-center ">
               <div class="col-md-10 col-sm-12">
                  <div class="card-columns">
                     <?php foreach ($users_object as $object) { ?>
                        <div class="card card-hover h-100" >
                           <!-- manombka eto leizy -->
                                 <!-- eto ny manomboka boucle ny php-->
                              <div class="card-body">
                                 <a href="<?php echo site_url('frontoffice/acceuil/affichageObjet/'.$object['idObjet']); ?>">
                                    <img class="card-img-top" src="<?php echo site_url('assets/images/'.$this->objet->get_one_of_images($object['idObjet'])); ?>" alt="Card image cap">
                                    <div class="reveal h-100 p-2 d-flex ">
                                       <div class="w-100 align-self-center">
                                          <p><?php echo $object['nomObjet']; ?></p>
                                       </div>
                                    </div>
                                 </a>
                              </div>
                              <!-- mifarana  eto leizy -->      
                        </div>
                     <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
        </div>                
      </div>
      <!-- End Gallery -->
      <!-- Footer -->
      <div class="container-fluid footer w-30">
         <div class="row">
            <div class="col-xl-8 col-md-8 offset-md-1 col-sm-12 ">
               <p>
                  <p>ETU2083 - SOLOFOARISON Tolotry Ny Avo Arisaina</p>
                  <p>ETU2010 - RAKOTONDRAMANANA Tanjona Iantenaina</p>
                  <p>ETU2085 - Allan Tohaina</p>
               </p>
            </div>
         </div>
      </div>
      <!-- End Footer -->
      <!-- Javascript -->
      <script src="../assets/vendor/jquery.min.js"></script>
      <script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
      <script src="../assets/vendor/wow/wow.js"></script>
      <script src="../assets/js/script.js"></script>
      <script>
         new WOW().init();
      </script>
      <!-- End Javascript -->
   </body>
</html>