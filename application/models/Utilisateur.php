<?php 
    class Utilisateur extends CI_Model {
        private $iduser ;
        private $nomUser ;
        private $password ;
        private $estAdmin  ;
        private $prenomUser;

        public function getIduser() {
            return $this->iduser;
        }

        public function setIduser($iduser) {
            $this->iduser = $iduser;
        }  

        public function getnomUser() {
            return $this->nomUser;
        }

        public function setPrenomUser($prenomUser) {
            $this->prenomUser = $prenomUser;
        }

        public function getPrenomUser() {
            return $this->prenomUser;
        }

        public function setnomUser($nomUser) {
            $this->nomUser = $nomUser;
        }

        public function getpassword() {
            return $this->password;
        }

        public function setpassword($password) {
            $this->password = $password;
        }

        public function getestAdmin() {
            return $this->estAdmin;
        }

        public function setEstAdmin($estAdmin) {
            $this->estAdmin = $estAdmin;
        }  

        // Custom function
        public function doLogin($username, $password) {
            $users_Table = "Utilisateur";

            $query = "SELECT * FROM ".$users_Table." WHERE nomUser = %s and password = %s";
            $query = sprintf($query, $this->db->escape($username), $this->db->escape($password));

            $resultat = $this->db->query($query);
            $ligne_resultat = $resultat->row_array();

            return $ligne_resultat;
        }

        public function getUserById($id) {
            $users_Table = "Utilisateur";

            $query = "SELECT * FROM ".$users_Table." WHERE idUser = %s";
            $query = sprintf($query, $this->db->escape($id));

            $resultat = $this->db->query($query);
            $ligne_resultat = $resultat->row_array();

            if ($ligne_resultat == null) return null;

            $utilisateur = new Utilisateur();
            $utilisateur->setIduser($id);
            $utilisateur->setnomUser($ligne_resultat['nomUser']);
            $utilisateur->setPrenomUser($ligne_resultat['prenomUser']);
            $utilisateur->setpassword($ligne_resultat['password']);
            $utilisateur->setEstAdmin($ligne_resultat['estAdmin']);

            return $utilisateur;
        }

        public function doRegister($user) {
            $query = "INSERT INTO Utilisateur (nomUser, prenomUser, password) VALUES (%s, %s, %s)";
            $query = sprintf($query, $this->db->escape($user->getnomUser()), $this->db->escape($user->getprenomUser()), $this->db->escape($user->getpassword()));

            $this->db->query($query);

            return $this->db->insert_id();
        }

        public function getUserObjects() {
            $query = "SELECT * FROM Objet WHERE idUser = %s";
            $query = sprintf($query, $this->db->escape($_SESSION['current_user']->getIduser()));

            $resultat = $this->db->query($query);

            $currentObjects = array();

            foreach($resultat->result_array() as $data) {
                array_push($currentObjects, $data);
            }

            return $currentObjects;
        }

        public function getCurrentUserObjects() {
            $query = "SELECT * FROM Objet WHERE idUser != %s";
            $query = sprintf($query, $this->db->escape($_SESSION['current_user']->getIduser()));

            $resultat = $this->db->query($query);

            $currentObjects = array();

            foreach($resultat->result_array() as $data) {
                array_push($currentObjects, $data);
            }

            return $currentObjects;
        }

        public function getNombreUsers() {
            $users_Table = "Utilisateur";

            $query = "SELECT count(*) as nombre FROM ".$users_Table."";

            $resultat = $this->db->query($query);
            $ligne_resultat = $resultat->row_array();

            if ($ligne_resultat == null) return -1;


            return $ligne_resultat['nombre'];
        }
    }
?>