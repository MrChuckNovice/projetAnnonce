<?php
namespace App\Models;
use App\Helpers\Text;
use DateTime;

class Annonce{

    private $id;

    private $slug;

    private $titreannonce;

    private $description;

    private $created_at;

    private $categorie;
    
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
}