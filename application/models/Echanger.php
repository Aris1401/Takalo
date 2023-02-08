<?php  
    class Echanger extends CI_Model{
        private $idEchange  ;
        private $echangeur;
        private $receveur;
        private $echangeurUser;
        private $reveceurUser;
        private $etat ;
        private $dateEchange;

        public function getidEchange() {
            return $this->idEchange;
        }

        public function setidEchange($idEchange) {
            $this->idEchange= $idEchange ;
        }

        public function getEchangeur() {
            return $this->echangeur;
        }

        public function setEchangeur($echangeur) {
            $this->echangeur = $echangeur;
        }

        public function getreceveur() {
            return $this->receveur;
        }

        public function setetat($etat) {
            $this->etat= $etat;
        }

        public function getetat() {
            return $this->etat;
        }

        public function setdateEchange($dateEchange) {
            $this->dateEchange = $dateEchange;
        }

        public function getdateEchange() {
            return $this->dateEchange;
        }

        public function setechangeurUser($echangeurUser) {
            $this->echangeurUser = $echangeurUser;
        }

        public function getechangeurUser() {
            return $this->echangeurUser;
        }

        public function setreveceurUser($reveceurUser) {
            $this->reveceurUser = $reveceurUser;
        }

        public function getreveceurUser() {
            return $this->reveceurUser;
        }

        public function getAllEchangeFor($idUser) {
            $query = "select * from Echange as e JOIN Objet as o ON e.receveur = o.idObjet JOIN Utilisateur as u on u.idUser = o.idUser WHERE o.idUser = %s AND etat != 5 AND etat != -1";
            $query = sprintf($query, $this->db->escape($idUser));

            $resultat = $this->db->query($query);

            $currentObjects = array();

            foreach($resultat->result_array() as $data) {
                array_push($currentObjects, $data);
            }

            return $currentObjects;
        }

        public function insertEchange($echangeur, $receveur, $idUser, $other_object) {
            // CREATE TABLE Echange (
            //     idEchange INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
            //     echangeur INT NOT NULL,
            //     receveur INT NOT NULL,
            //     etat INT NOT NULL DEFAULT 0,
            //     dateEchange TIMESTAMP);
            
            $query = "INSERT INTO Echange (echangeur, receveur, echangeurUser, reveceurUser, dateEchange) VALUES (%s, %s, %d, %d, NULL)";
            
            $query = sprintf($query, $this->db->escape($echangeur), $this->db->escape($receveur), $idUser, $other_object->getidUser());

            $this->db->query($query);
        }

        public function getNombreEchanger() {
            $users_Table = "Echange";

            $query = "SELECT count(*) as nombre FROM ".$users_Table." WHERE etat = 5";

            $resultat = $this->db->query($query);
            $ligne_resultat = $resultat->row_array();

            if ($ligne_resultat == null) return -1;

            return $ligne_resultat['nombre'];
        }

        public function getEchangeById($id) {
            $users_Table = "Echange";

            $query = "SELECT * FROM ".$users_Table." WHERE idEchange = %s";
            $query = sprintf($query, $this->db->escape($id));

            $resultat = $this->db->query($query);
            $ligne_resultat = $resultat->row_array();

            if ($ligne_resultat == null) return null;

            $echange = new Echanger();
            $echange->setidEchange($ligne_resultat['idEchange']);
            $echange->setEchangeur($ligne_resultat['echangeur']);
            $echange->receveur = $ligne_resultat['receveur'];
            $echange->setechangeurUser($ligne_resultat['echangeurUser']);
            $echange->setreveceurUser($ligne_resultat['reveceurUser']);
            $echange->setetat($ligne_resultat['etat']);
            $echange->setdateEchange($ligne_resultat['dateEchange']);

            return $echange;
        }

        public function changeEtatById($idEchange, $etat){
            $query = "UPDATE Echange SET etat = ?, dateEchange = NOW() WHERE idEchange = %s";
            // UPDATE Echange SET etat = 5, dateEchange = NOW() WHERE idEchange = 2
            $query = sprintf($query, $this->db->escape($idEchange));

            $this->db->query($query, array($etat));
        }
        
        public function checkEchange($echangeur, $receveur, $idUser, $other_object) {
            $users_Table = "Echange";
    
            $query = "SELECT * FROM ".$users_Table." WHERE echangeur = %s  and receveur = %d and echangeurUser = %d and reveceurUser = %d " ;
            $query = sprintf($query,$this->db->escape($echangeur), $receveur, $idUser, $other_object);

            $resultat = $this->db->query($query);
            $ligne_resultat = $resultat->row_array();
    
            if ($ligne_resultat == null) return true;
            return false;
        }
    }
?>