<?php
require '../vendor/autoload.php';

define('DEBUG_TIME', microtime(true));

if(isset($_GET['page']) && $_GET['page'] === '1'){
   //réécrire l'url sans le paramètre ?page
   $uri =  explode('?',$_SERVER['REQUEST_URI'])[0];
   $get = $_GET;
   unset($get['page']);
   $query = http_build_query($get);
   if (empty($query))
   {
       $uri = $uri . '?' . $query;
   }
   header('Location: ' . $uri);
   http_response_code(301);
   exit();
}



$router = new App\Router( dirname(__DIR__) . '/views');
$router
       ->get('/home','/post/home','home')
       ->get('/home/[*:slug]-[i:id]', 'post/show', 'annonce')
       ->get('/home/category','/category/show','category')
       ->run();
/*define('VIEW_PATH', dirname(__DIR__) . '/views');

$router->map('GET', '/home', function(){
    require VIEW_PATH . '/post/home.php';
});
$router->map('GET','/category', function(){
    require VIEW_PATH . '/category/show.php';
});
$match = $router->match();
$match['target']();
$router->map('GET','/home','home','home');
$router->map('GET', '/404', '404', '404');





if (is_array($match)) {
  if(is_callable( $match['target'])) {
      call_user_func_array( $match['target'], $match['params']);
  }else{
      $target= $match['target'];
      //match le target with view
      include "../views/{$target}.view.php";
  }
}else{
    include "../views/404.view.php";
}*/
?>