<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Echange extends CI_Controller {
        public function index() {
            $this->load->model('Utilisateur', 'user');
            $this->load->model('Echanger', 'troc');
            $this->load->helper('url');
            
            session_start();
            // if (!$this->session->has_userdata('current_user')) {
            //     redirect('LoginRegister');
            // }

            // Get tout les echanges en cours (etat = 0) 
            $all_echange = $this->troc->getAllEchangeFor($_SESSION['current_user']->getidUser());

            $data['echanges'] = $all_echange;

            $this->load->view('listeEchange', $data);
        }

        public function echange($id = 'NULL') {
            $this->load->helper('url');
            $this->load->model('Utilisateur', 'user');
            $this->load->model('Obj', 'objet');

            if ($id == 'NULL') redirect('frontoffice/echange');

            session_start();

            $user_objects = $this->user->getUserObjects();

            if (count($user_objects) == 0) {
                redirect('frontoffice/acceuil/affichageObjet/'.$id.'?error=1');
            }

            $my_objects = $user_objects; // Get array from database
            $user_object = $this->objet->getObjetById($id); // Get user object by id

            $data['my_objects'] = $my_objects;
            $data['current_object'] = $user_object;

            $this->load->view('echanger', $data);
        }

        public function doEchange() {
            $this->load->helper('url');
            $this->load->model('Echanger', 'troc');
            $this->load->model('Utilisateur', 'user');
            $this->load->model('Obj', 'objet');

            $my_object_id = $this->input->post('my_object');
            $other_object_id = $this->input->post('other_object');

            session_start();

            // Fonction echanger
            $this->troc->insertEchange($my_object_id, $other_object_id, $_SESSION['current_user']->getidUser(), $this->objet->getObjetById($other_object_id));

            redirect('frontoffice/echange');
        }

        public function acceptEchange($id = 'NULL') {
            $this->load->helper('url');
            $this->load->model('Echanger', 'troc');
            $this->load->model('Obj', 'objet');

            $this->troc->changeEtatById($id, 5);

            $this->objet->changeProprietaire($this->troc->getEchangeById($id)->getEchangeur(), $this->troc->getEchangeById($id)->getreveceurUser());

            redirect('frontoffice/echange');
        }

        public function declineEchange($id = 'NULL') {
            $this->load->helper('url');
            $this->load->model('Echanger', 'troc');

            $this->troc->changeEtatById($id, -1);

            redirect('frontoffice/echange');
        }
    }
?>