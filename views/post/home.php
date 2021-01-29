<?php
use App\Connection;
use App\Models\Annonce;
use App\Helpers\Text;
use App\URL;
$title= 'Mon site';
$pdo = Connection::getPDO();





$currentPage = URL::getInt('page', 1);
if ($currentPage <= 0) {
   throw new Exception('Numéro de page invalide');
}
$count = (int)$pdo->query('SELECT COUNT(id) FROM annonce')->fetch(PDO::FETCH_NUM)[0];
$perPage = 12;
$pages = ceil($count / $perPage);
if ($currentPage > $pages) {
   throw new Exception('Cette page n\'existe pas');
}
$offset = $perPage * ($currentPage - 1);
$query = $pdo->query("SELECT * FROM annonce LIMIT $perPage OFFSET $offset");
$annonces = $query->fetchAll(PDO::FETCH_CLASS, Annonce::class);
?>

<h1>ma page d'accueil</h1>
 <div class='row'>
      <?php foreach($annonces as $annonce): ?>
      <div class="col-md-3">
          <?php require 'card.php' ?>
      </div>
     <?php endforeach ?> 
 </div>

<div class="d-flex justify-content-between my-4">
     <?php if ($currentPage > 1): ?>
          <?php 
          $link = $router->url('home');
          if ($currentPage > 2) $link .= '?page=' . ($currentPage - 1);
          ?>
          <a href="<?= $link ?>"class="btn btn-primary"> Page précédent</a>
     <?php endif ?>
     <?php if ($currentPage < $pages): ?>
          <a href="<?= $router->url('home') ?>?page<?= $currentPage + 1 ?>"class="btn btn-primary"> Page suivante</a>
     <?php endif ?>
</div>