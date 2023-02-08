<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Echange extends CI_Controller {
        public function index() {
            $this->load->model('Utilisateur', 'user');
            $this->load->model('Echanger', 'troc');
            $this->load->model('Obj', 'objet');
            $this->load->helper('url');
            
            session_start();
            // if (!$this->session->has_userdata('current_user')) {
            //     redirect('LoginRegister');
            // }

            // Get tout les echanges en cours (etat = 0) 
            $all_echange = $this->troc->getAllEchangeFor($_SESSION['current_user']->getidUser());

            if (isset($_SESSION['echanges'])) {
                unset($_SESSION['echanges']);
            }

            $data['echanges'] = $all_echange;

            $this->load->view('listeEchange', $data);
        }

        public function change($id = 'NULL') {
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

        public function addNewEchange() {
            $this->load->helper('url');
            session_start();

            $idOtherObjet = $this->input->post('other_object');
            $idObjet = $this->input->post('my_object');

            if (isset($_SESSION['echanges']) && !in_array($idObjet, $_SESSION['echanges'])) {
                $echanges = $_SESSION['echanges'];

                array_push($echanges, $idObjet);

                $_SESSION['echanges'] = $echanges;
            } else if (!isset($_SESSION['echanges'])){
                $echanges = array();

                array_push($echanges, $idObjet);

                $_SESSION['echanges'] = $echanges;
            }

            redirect('frontoffice/echange/change/'.$idOtherObjet);
        }

        public function doEchange() {
            $this->load->helper('url');
            $this->load->model('Echanger', 'troc');
            $this->load->model('Utilisateur', 'user');
            $this->load->model('Obj', 'objet');

            $other_object_id = $this->input->post('other_object');
            session_start();

            
            if(!isset($_SESSION['echanges'])) redirect('frontoffice/acceuil');

            // Fonction echanger
            $echange_string = "";
            for($i = 0; $i < count($_SESSION['echanges']); $i++) {
                $echange_string .= $_SESSION['echanges'][$i];

                if ($i < count($_SESSION['echanges']) - 1) {
                    $echange_string .= ",";
                }
            }

            if(!$this->troc->checkEchange($echange_string, $other_object_id, $_SESSION['current_user']->getIduser(), $this->objet->getObjetById($other_object_id)->getIdUser())) {
                unset($_SESSION['echanges']);
                redirect('frontoffice/ArisainaIante');
            }
            $this->troc->insertEchange($echange_string, $other_object_id, $_SESSION['current_user']->getIduser(), $this->objet->getObjetById($other_object_id));

            unset($_SESSION['echanges']);
            redirect('frontoffice/echange');
        }

        public function acceptEchange($id = 'NULL') {
            $this->load->helper('url');
            $this->load->model('Echanger', 'troc');
            $this->load->model('Obj', 'objet');

            $this->troc->changeEtatById($id, 5);

            $currentEchange = $this->troc->getEchangeById($id);
            $allOtherObjects = explode(',', $currentEchange->getEchangeur());

            foreach ($allOtherObjects as $idObjet) {
                $this->objet->changeProprietaire($idObjet, $this->troc->getEchangeById($id)->getreveceurUser());
            }

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