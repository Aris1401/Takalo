<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Admin extends CI_Controller {
        function index() {
            session_start();
            $this->load->helper('url');

            $this->load->model('Utilisateur', 'user');
            $this->load->model('Echanger', 'troc');

            $data['nombre_user'] = $this->user->getNombreUsers();
            $data['nombre_echange'] = $this->troc->getNombreEchanger();

            $this->load->view('admin', $data);
        }
    }
?>