<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Acceuil extends CI_Controller {
        function index() {
            $this->load->helper('url');
            $this->load->model('Utilisateur', 'user');
            $this->load->model('Obj', 'objet');
            $this->load->model('Categorie', 'categorie');
            session_start();

            if (!isset($_SESSION['current_user'])) {
                redirect('backoffice/LoginRegister');
            }

            $all_categorie = $this->categorie->getAllCategorie();
            $data['categories'] = $all_categorie;

            $users_object = $this->user->getCurrentUserObjects(); // Get tout les objets qui ne sont pas a moi
            $data['users_object'] = $users_object;

            $this->load->view('acceuil', $data);
        }

        function affichageObjet($id = 'NULL') {
            $this->load->helper('url');

            if ($id == 'NULL') redirect(site_url('frontoffice/loginRegister'));

            $this->load->model('Obj', 'objet');
            $this->load->model('Utilisateur', 'user');
            $current_objet = $this->objet->getObjetById($id); // Get objet by id par base

            $data = array();
            $data['current_objet'] = $current_objet;

            if ($this->input->get('error')) {
                $data['error'] = true;
            }
             
            $this->load->model('Utilisateur', 'user');
            session_start();
            if($current_objet==null || $_SESSION['current_user']->getidUser()==$current_objet->getidUser())
            {
                redirect('frontoffice/acceuil');
            }
            
            $current_user = $this->user->getUserById($current_objet->getidUser());
            $data['current_user'] = $current_user;

            $historique = $this->objet->historique($id);
            $data['historique'] = $historique;

            $this->load->view("afficherObj", $data);
        }

        function rechercher() {
            $this->load->helper('url');
            $this->load->model('Obj', 'objet');

            if ($this->input->get('rechercher') == null || $this->input->get('categorie') == null) {
                redirect('frontoffice/acceuil');
            }

            $mot_cles = $this->input->get('rechercher');
            $id_categorie = $this->input->get('categorie');
            $this->load->model('Categorie', 'categorie');

            $this->load->model('Utilisateur', 'user');
            $this->load->model('Obj', 'objet');

            session_start();

            $all_categorie = $this->categorie->getAllCategorie();
            $data['categories'] = $all_categorie;

            $users_object = $this->objet->rechecher($mot_cles, $id_categorie); // Get tout les objets qui ne sont pas a moi
            $data['users_object'] = $users_object;

            $this->load->view('acceuil', $data);
        }

        function deconnexion()
        {
            $this->load->helper('url');
            session_start();

            if (isset($_SESSION['current_user'])) {
                unset($_SESSION['current_user']);
                redirect('backoffice/LoginRegister');
            }
           
        }
    }
?>