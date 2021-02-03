<!DOCTYPE html>
<html lang="fr" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    
    <title><?= $title ?? 'Mon site' ?></title>
</head>
<body class="d-flex flex-column h-100">
    <nav class='navbar navbar-expand-lg navbar-dark bg-primary'>
       <a href="#" class="navbar-brand">Project test simplifier ou pas </a>
    </nav>

    <div class="container mt-4">
    <?= $content ?>
    </div>
    <footer class="bg-light py-4 footer mt-auto">
      <div class="container">
                  <?php if(defined('DEBUG_TIME')):?>
        Page générée en ms <?= round(1000 * (microtime(true) - DEBUG_TIME)) ?>ms
        <?php endif ?>
      </div> 
    </footer>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</html>