<?php
namespace App;

class URL {

   public static function getInt(string $name, ?int $default = null): ?int
{
   if(!isset($_GET[$name])) return $default;

   if (!filter_var($_GET[$name], FILTER_VALIDATE_INT)) {
   throw new \Exception("Le paramètre $name n'est pas un entier");
   }
   return (int)$_GET[$name];
}
}