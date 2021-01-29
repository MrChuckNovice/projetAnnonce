<?php 
namespace App\Models;

use App\Core\Db;

class Model extends Db
{
    // Table de la base de données 
    protected $table;

    // Instance de Db
    private $db;

    public function findAll()
    {
        $query= $this->requete('SELECT * FROM  annonce');
        return $query->fetchAll();
    }

    public function findBy(array $criteres)
    {
        $champs = [];
        $valeurs = [];

        foreach($criteres as $champ => $valeur){

            $champs[]= "$champ = ?";
            $valeurs[]= $valeur;
        }
        // On transforme le tableau "champs" en une chaine de caractères
        $liste_champs = implode(' AND ', $champs);
        
        return $this->requete('SELECT * FROM '.$this->table.' WHERE '. $liste_champs, $valeurs)->fetchAll();
    }

    public function find(int $id)
    {
        return $this->requete("SELECT * FROM {$this->table} WHERE id = $id")->fetch();
    }

    public function create(Model $model)
    {
        $champs=[];
        $inter=[];
        $valeurs=[];
        
        // On boucle pour éclater le tableau
        foreach($model as $champ => $valeur){
         // INSERT INTO annonces (titre, description, actif) VALUES (?, ?, ?)
         if($valeur != null && $champ != 'db' && $champ != 'table'){
             $champs[] = $champ;
             $inter[] = "?";
             $valeur[] = $valeur; 
         }
        }

        $liste_champs = implode(',', $champs);
        $liste_inter = implode(',', $inter);

        return $this->requete('INSERT INTO '.$this->table.' ('. $liste_champs.')VALUES('.$liste_inter.')', $valeurs);
    }
    public function update(int $id, Model $model)
    {
        $champs=[];
        $valeurs=[];
        
        // On boucle pour éclater le tableau
        foreach($model as $champ => $valeur){
         // INSERT INTO annonces (titre, description, actif) VALUES (?, ?, ?)
         if($valeur != null && $champ != 'db' && $champ != 'table'){
             $champs[] = "$champ = ?";
             $valeur[] = $valeur; 
         }
        }
        $valeurs[] = $id; 

        $liste_champs = implode(',', $champs);

        return $this->requete('UPDATE '.$this->table.' SET'. $liste_champs.' WHERE id = ?', $valeurs);
    }

    public function delete(int $id)
    {
        return $this->requete("DELETE FROM {$this->table} WHERE id = ?", [$id]);
    }

    public function requete(string $sql, array $attributs = null)
    {
        $this->db = Db::getInstance();

        if($attributs !== null){

            $query = $this->db->prepare($sql);
            $query->execute($attributs);
            return $query;
        }else{
            return $this->db->query($sql);
        }
    }

    public function hydrate(array $donnees)
    {
        foreach($donnees as $key => $value){

            $setter = 'set'.ucfirst($key);

            //On vérifie si le setter existe
            if(method_exists($this, $setter)){

                $this->$setter($value);
            }
        }
        return $this;
    }
}
?>