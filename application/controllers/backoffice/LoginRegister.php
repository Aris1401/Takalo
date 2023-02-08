<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

    class LoginRegister extends CI_Controller {
        function index() {
            $this->load->helper('url');
            session_start();

            // echo isset($_SESSION['current_user']); 

            if (isset($_SESSION['current_user'])) {
                redirect('frontoffice/acceuil');
            } else {
                $this->load->view('login_registration');
            }
        }

        function admin() {
            $this->load->helper('url');
            session_start();

            // echo isset($_SESSION['current_user']); 

            if (isset($_SESSION['current_user'])) {
                redirect('frontoffice/acceuil');
            } else {
                $this->load->view('login_admin');
            }
        }

        function login() {
            session_start();

            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $this->load->model('Utilisateur', 'user');

            $ligne_resultat = $this->user->doLogin($username, $password);
            
            if ($ligne_resultat == null) {
                echo "False|";
            } else {
                if (!isset($_SESSION['current_user'])) {
                    $_SESSION['current_user'] = $this->user->getUserById($ligne_resultat['idUser']);
                }
                echo "True|";
            }
        }

        function register() {
            $this->load->helper('UI');
            $this->load->helper('url');

            $nom = $this->input->post('nom');
            $prenom = $this->input->post('prenom');
            $password = $this->input->post('password');

            if (check_inputs(array($nom, $prenom, $password))) {
                $this->load->model('Utilisateur', 'user');

                $user = new Utilisateur();
                $user->setnomUser($nom);
                $user->setPrenomUser($prenom);
                $user->setpassword($password);

                session_start();

                $_SESSION['current_user'] = $this->user->getUserById($this->user->doRegister($user));

                redirect('frontoffice/acceuil');
            } else {
                redirect('loginRegister?error=1');
            }
        }
    }
?>