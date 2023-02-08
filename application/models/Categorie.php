<?php  
    class categorie extends CI_Model{
        private $idCategorie;
        private $nomCategorie;
    
        public function getIdCategorie() {
            return $this->idCategorie;
        }

        public function setIdCategorie  ($idCategorie) {
            $this->idCategorie   = $idCategorie ;
        }

        public function getNomCategorie() {
            return $this->nomCategorie;
        }

        public function setNomCategorie($nomCategorie) {
            $this->nomCategorie = $nomCategorie;
        }

        public function getAllCategorie() {
            $query = "SELECT * FROM Categorie";

            $resultat = $this->db->query($query);

            $currentObjects = array();

            foreach($resultat->result_array() as $data) {
                array_push($currentObjects, $data);
            }

            return $currentObjects;
        }

        public function insertCategorie($nom_categorie) {
            $query = "INSERT INTO Categorie (nomCategorie) VALUES (%s)";
            $query = sprintf($query, $this->db->escape($nom_categorie));

            $this->db->query($query);
        }
    }
?>
