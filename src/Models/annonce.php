<?php
namespace App\Models;

use App\Connection;
use App\Helpers\Text;
use DateTime;
use Exception;

class Annonce extends Connection{

    const TABLE_NAME = "annonce";

    private $id;

    private $slug;

    private $titreannonce;

    private $description;

    private $created_at;

    private $categorie;

    private $photo;
    
    public function getTitre(): ?string 
    {
        return $this->titreannonce;
    }

    public function getDescription(): ?string
    {
        return nl2br(htmlentities($this->description));
    }

    public function getExcerpt(): ?string
    {
        if($this->description === null) {
            return null;
        }
        return nl2br(htmlentities(Text::excerpt($this->description, 60)));
    }

    public function getCreatedAt(): \DateTime
    {
        return new \DateTime($this->created_at);
    }
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function getID(): ?int
    {
        return $this->id;
    }

    public function getPhoto() 
    {
        return $this->getPhoto;
    }

    public function setPhoto($photo) {

        if(isset($photo) && $photo['error'] == 0){
            // Testons si le fichier n'est pas trop gros
            if($photo['size']<= 10000000) {
                //l'extension est autorisée
                $infosfichier = pathinfo($photo['name']);
                $extension_upload = $infosfichier['extension'];
                $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                if (in_array($extension_upload, $extensions_autorisees)) {

                    $this->photo=$photo;
                    return $this;
                }
            }else{
                throw new Exception('photo trop grande');
            }
        }else{
            throw new Exception("une erreur est survenue à l'upload du fichier");
        }
    }

    public function savePhoto() 
    {
        $photo = $this->getPhoto();

        $extension = pathinfo($photo['name'])['extension'];

        $newName = "Annonce_" . $this->getID();

        $newNameWithExtension = $newName . "." . $extension;

        move_uploaded_file($photo['tmp_name'], './public/uploads/' . $newNameWithExtension);

        $data = [
            'id' => $this->getID(),
            'photo' => $newNameWithExtension
        ];

        Connection::update(self::TABLE_NAME, $data);

        return $this;
    }

    private function createMiniature() {

        $photo = $this->getPhoto();
    
        $extension = pathinfo($photo['name'])['extension'];
        $oldName = "annonce_" . $this->getId();
        $oldNameWithExtension = $oldName . "." . $extension;

        $titreAncienneImage = $oldNameWithExtension;
        $extension = $extension;
        $dossierEnregistrement = './public/uploads';
        $titreNouvelleImage = $titreAncienneImage . '_300x300.' . $extension;
        $resultMiniature = createMiniature($titreAncienneImage, $extension, $dossierEnregistrement, $titreNouvelleImage);
        if(!$resultMiniature){
            echo "Il y a eu un problème lors de la création de la miniature.";
            return;
        }

    }
}