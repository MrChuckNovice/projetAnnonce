<?php
use App\Connection;
use App\Models\Annonce;

$id = (int)$params['id'];
$slug = $params['slug'];

$pdo = Connection::getPDO();
$query=$pdo->prepare('SELECT * FROM annonce WHERE id = :id');
$query->execute(['id' => $id]);
$query->setFetchMode(PDO::FETCH_CLASS, Annonce::class);
/** @var Post|false*/
$annonce = $query->fetch();

if ($annonce === false) {
    throw new Exception('Aucun article ne correspond à cet ID');
}

if($annonce->getSlug() !== $slug) {
    $url = $router->url('annonce', ['slug' => $annonce->getSlug(), 'id' =>$id]);
    http_response_code(301);
    header('Location: ' . $url);
}

?>

<h1><?= htmlentities($annonce->getTitre()) ?></h1>
                  <p class="text-muted"><?= $annonce->getCreatedAt()->format('d/m/y') ?></p>
                  <p><?= $annonce->getDescription() ?></p>