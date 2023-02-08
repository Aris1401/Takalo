<?php  
    class Obj extends CI_Model {
        private $idObjet;
        private $description;
        private $nomObjet;
        private $categorie;
        private $idUser;
        private $prixEstimatif;
        public $photos;

        public function getidObjet() {
            return $this->idObjet;
        }

        public function setidObjet($idObjet) {
            $this->idObjet = $idObjet;
        }

        public function getnomObjet() {
            return $this->nomObjet;
        }

        public function setnomObjet($nomObjet) {
            $this->nomObjet = $nomObjet;
        }

        public function getdescription() {
            return $this->description;
        }

        public function setdescription($description) {
            $this->description = $description;
        }

        public function getCategorie() {
            return $this->categorie;
        }

        public function setCategorie($categorie) {
            $this->categorie = $categorie;
        }   

        public function setIdUser($id) {
            $this->idUser = $id;
        } 

        public function getIdUser() {
            return $this->idUser;
        }

        public function getPrixEstimatif() {
            return $this->prixEstimatif;
        }

        public function setPrixEstimatif($prix) {
            $this->prixEstimatif = $prix;
        }

        // Functions 
        public function getObjetById($id) {
            $users_Table = "Objet";

            $query = "SELECT * FROM ".$users_Table." WHERE idObjet = %s";
            $query = sprintf($query, $this->db->escape($id));

            $resultat = $this->db->query($query);
            $ligne_resultat = $resultat->row_array();

            if ($ligne_resultat == null) return null;

            $objet = new Obj();
            $objet->setidObjet($ligne_resultat['idObjet']);
            $objet->setnomObjet($ligne_resultat['nomObjet']);
            $objet->setCategorie($ligne_resultat['categorie']);
            $objet->setdescription($ligne_resultat['description']);
            $objet->setPrixEstimatif($ligne_resultat['prixEstimatif']);
            $objet->setIdUser($ligne_resultat['idUser']);
            $objet->photos = $ligne_resultat['photos'];

            return $objet;
        }

        public function changeProprietaire($idObjet, $newUser) {
            $query = "UPDATE Objet SET idUser = ? WHERE idObjet = %s";
            $query = sprintf($query, $this->db->escape($idObjet));

            $this->db->query($query, array($newUser));
        }

        public function insertObjet($nomObjet, $description, $photos, $categorie, $prixEstimatif, $idUser) {
            $query = "INSERT INTO Objet (description, nomObjet, categorie, prixEstimatif, photos, idUser) VALUES (%s, %s, ?, ?, %s, ?)";
            $query = sprintf($query, $this->db->escape($description), $this->db->escape($nomObjet), $this->db->escape($photos));

            $this->db->query($query, array($categorie, $prixEstimatif, $idUser));
        }

        public function modifierObjet($idObjet, $nomObjet, $description, $categorie, $prixEstimatif) {
            $query = "UPDATE Objet SET description = %s, nomObjet = %s, categorie = ?, prixEstimatif = ? WHERE idObjet = ?";
            $query = sprintf($query, $this->db->escape($description), $this->db->escape($nomObjet));

            $this->db->query($query, array($categorie, $prixEstimatif, $idObjet));
        }

        public function rechecher($mot_cle, $categorie) {
            $mot_cle = strtolower($mot_cle);

            $query = "SELECT * FROM Objet WHERE idUser != ".$this->db->escape($_SESSION['current_user']->getIduser())." AND (LOWER(description) LIKE '%".$this->db->escape_like_str($mot_cle)."%' OR LOWER(nomObjet) LIKE '%".$this->db->escape_like_str($mot_cle)."%')";
            if ($categorie != 0) {
                $query .= " AND categorie = ".$this->db->escape($categorie);
            } 

            $resultat = $this->db->query($query);

            $currentObjects = array();

            foreach($resultat->result_array() as $data) {
                array_push($currentObjects, $data);
            }

            return $currentObjects;
        }

        public function historique($idObjet) {
            session_start();

            $query = "SELECT u.nomUser as user, e.dateEchange as date FROM Echange as e JOIN Utilisateur as u ON e.reveceurUser = u.idUser  AND e.etat = 5";

            $query = sprintf($query, $this->db->escape($idObjet));

            $resultat = $this->db->query($query);

            $currentObjects = array();

            foreach($resultat->result_array() as $data) {
                array_push($currentObjects, $data);
            }

            return $currentObjects;
        }

        function get_one_of_images($idObjet) {
            $this->load->model('Obj', 'objet');
            $objet = $this->objet->getObjetById($idObjet);
    
            $images = $objet->photos;
            $images_splited = explode(",", $images);
    
            return $images_splited[rand(0, count($images_splited) - 1)];
        }

        function getAllImages($idObjet) {
            $this->load->model('Obj', 'objet');
            $objet = $this->objet->getObjetById($idObjet);
    
            $images = $objet->photos;
            $images_splited = explode(",", $images);
    
            return $images_splited;
        }
    }

?>