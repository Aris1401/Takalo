<!-- Navbar -->
<div class="navigation p-4 pt-0">
         <div class="row justify-content-md-center ">
            <div class="col-md-10 col-sm-12">
               <nav class="navbar navbar-default d-flex flex-row">
                  <a class="navbar-brand" href="<?php echo site_url('frontoffice/acceuil'); ?>">
                    Takalo
                  </a>

                  <div class="button_container" id="toggle">
                     <span class="black top"></span>
                     <span class="black middle"></span>
                     <span class="black bottom"></span>
                  </div>

                  <form class="form-inline" method="get" action="<?php echo site_url('frontoffice/acceuil/rechercher') ?>">
                     <input class="form-control mr-sm-2" name="rechercher" type="search" placeholder="Search" aria-label="Search">
                     
                     <select name="categorie" id="categorie" class="custom-select">
                        <option value="0">Tous les categories</option>
                        <?php foreach($categories as $categorie){ ?>
                           <option class="text-dark" value="<?php echo $categorie['idCategorie'] ?>"><?php echo $categorie['nomCategorie']; ?></option>
                        <?php } ?>
                     </select>
                        
                     <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
                  </form>

                  <div class="nav-item">
                     <a class="btn btn-primary rounded text-white" href="<?php echo site_url('frontoffice/profil') ?>">Profil</a>
                  </div>
                        
                  <div class="nav-item navbar-left btn-group mr-5">
                     <a class="btn btn-primary text-white" href="<?php echo site_url('backoffice/admin') ?>">Panneau admin</a>   
                     <a class="btn btn-primary text-white" href="<?php echo site_url('frontoffice/acceuil/deconnexion') ?>">Deconnexion</a>   
                  </div>

               </nav>
            </div>
         </div>
      </div>
      <!-- End Navbar -->