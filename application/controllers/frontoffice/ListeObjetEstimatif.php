<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

    class ListeObjetEstimatif extends CI_Controller {
        function index($idObjet, $marge) {
            $this->load->helper('url');

            if ($idObjet == null || $marge == null) {
                redirect('frontoffice/profil');
            }
            
            $this->load->model('Obj', 'objet');
            $this->load->model('Utilisateur', 'user');
            session_start();
            $all_objets = $this->objet->getObjetsDeMarge($idObjet, $marge);

            $data['all_objets'] = $all_objets;
            $data['current_objet'] =$idObjet;

            $this->load->view('listeObjetEstimatif', $data);
        }

        function echangeEstimatif($id, $idOrigin) {
            $this->load->helper('url');

            if ($id == null) {
                redirect('frontoffice/listeObjetEstimatif');
            }

            $this->load->model('Obj', 'objet');
            $this->load->model('Utilisateur', 'user');
            $current_objet = $this->objet->getObjetById($id); // Get objet by id par base

            $data = array();
            $data['current_objet'] = $current_objet;

            if ($this->input->get('error')) {
                $data['error'] = true;
            }

            $data['marge'] = $this->objet->getMargeToObjet($idOrigin, $id);

            $current_user = $this->user->getUserById($current_objet->getidUser());
            $data['current_user'] = $current_user;

            $historique = $this->objet->historique($id);
            $data['historique'] = $historique;

            $this->load->view("echangeEstimatif", $data);
        }
    }
?>