<div class="card mb-3">
               <div class="card-body">
                  <h5 class="card-title"><?= htmlentities($annonce->getTitre()) ?></h5>
                  <p class="text-muted"><?= $annonce->getCreatedAt()->format('d/m/y') ?></p>
                  <p><?= $annonce->getExcerpt() ?></p>
                  <p>
                      <a href="<?= $router->url('annonce', ['id' => $annonce->getID(), 'slug' => $annonce->getSlug()]) ?>"class="btn btn-primary">Voir plus</a>
                  </p>
               </div>      
            </div>