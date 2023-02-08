<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Profil extends CI_Controller {
        public function index() {
            $this->load->helper('url');
            $this->load->model('Utilisateur', 'user');
            $this->load->model('Obj', 'objet');

            session_start();

            if (!isset($_SESSION['current_user'])) {
                redirect('backoffice/LoginRegister');
            }

            $user_objects = $this->user->getUserObjects();
            $data['user_objets'] = $user_objects;

            $current_user = $_SESSION['current_user'];
            $data['user'] = $current_user;

            $this->load->view('profil', $data);
        }

        public function ajoutObjet() {
            $this->load->helper('url');
            $this->load->model('Categorie', 'categorie');
            session_start();

            if (!isset($_SESSION['current_user'])) {
                redirect('backoffice/LoginRegister');
            }

            $all_categorie = $this->categorie->getAllCategorie();
            $data['categories'] = $all_categorie;

            $this->load->view('ajoutObjet', $data);
        }

        public function doAjoutObjet() {
            $this->load->helper('url');
            $this->load->model('Obj', 'objet');
            $this->load->model('Utilisateur', 'user');

            $nom_objet = $this->input->post('nom');
            $description_objet = $this->input->post('description');
            $id_categorie = $this->input->post('categorie');
            $prix_estimer = $this->input->post('prix_estimer');
    
            // Get all photos
            $file_count = count($_FILES['file']['name']);

            $img_string = "";

            for ($i = 0; $i < $file_count; $i++) {
                $filename = $_FILES['file']['name'][$i];
                if (in_array(strchr($filename, "."), array('.png', '.jpg', '.jpeg', '.PNG', '.JPG', '.JPEG'))) {
                    move_uploaded_file($_FILES['file']['tmp_name'][$i], 'assets/images/'.$filename);
                    $img_string .= $filename;

                    if ($i < $file_count - 1) {
                        $img_string .= ",";
                    }
                }
            }
            session_start();

            if (!isset($_SESSION['current_user'])) {
                redirect('backoffice/LoginRegister');
            }

            // Insertion de cet objet
            $idUser = $_SESSION['current_user'];
            $this->objet->insertObjet($nom_objet, $description_objet, $img_string, $id_categorie, $prix_estimer, $idUser->getidUser());

            redirect(site_url('frontoffice/profil'));
        }

        public function modifierObjet($id = 'NULL') {
            $this->load->helper('url');

            if ($id == 'NULL') redirect(site_url('frontoffice/profil'));

            $this->load->model('Categorie', 'categorie');
            $this->load->model('Obj', 'objet');

            $current_objet = $this->objet->getObjetById($id);
            $data['current_objet'] = $current_objet;
            session_start();

            if (!isset($_SESSION['current_user'])) {
                redirect('backoffice/LoginRegister');
            }
            $all_categorie = $this->categorie->getAllCategorie();
            $data['categories'] = $all_categorie;

            $this->load->view('modifierObjet', $data);
        }

        public function doModifierObjet() {
            $this->load->helper('url');
            $this->load->model('Obj', 'objet');

            $id_objet = $this->input->post('idObjet');
            $nom_objet = $this->input->post('nom');
            $description_objet = $this->input->post('description');
            $id_categorie = $this->input->post('categorie');
            $prix_estimer = $this->input->post('prix_estimer');

            // Get all photos

            // Modification de nouvel objet

            // Insertion de cet objet
            $this->objet->modifierObjet($id_objet, $nom_objet, $description_objet, $id_categorie, $prix_estimer);

            redirect(site_url('frontoffice/profil'));
        }

        public function gererCategorie() {
            $this->load->helper('url');
            $this->load->model('Categorie', 'categorie');
            $all_categorie = $this->categorie->getAllCategorie();

            $data['categories'] = $all_categorie;
            session_start();

            if (!isset($_SESSION['current_user'])) {
                redirect('backoffice/LoginRegister');
            }
            $this->load->view('categories', $data);
        }

        public function ajouterCategorie() {
            $this->load->helper('url');

            $nom_categorie = $this->input->post('nom');
            session_start();

            if (!isset($_SESSION['current_user'])) {
                redirect('backoffice/LoginRegister');
            }
            // Creer nouveau categorie et inserer
            $this->load->model('Categorie', 'categorie');
            $this->categorie->insertCategorie($nom_categorie);

            redirect(site_url('frontoffice/profil/gererCategorie'));
        }
    }
?>