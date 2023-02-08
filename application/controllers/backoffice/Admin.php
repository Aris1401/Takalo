<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Admin extends CI_Controller {
        function index() {
            $this->load->helper('url');
            $this->load->model('Utilisateur', 'user');
            $this->load->model('Echanger', 'troc');
            
            session_start();

            if ($_SESSION['current_user']->getestAdmin() != 1) redirect('frontoffice/acceuil');

            $data['nombre_user'] = $this->user->getNombreUsers();
            $data['nombre_echange'] = $this->troc->getNombreEchanger();

            $this->load->view('admin', $data);
        }
    }
?>