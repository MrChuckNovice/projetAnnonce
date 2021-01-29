<?php
namespace App\Helpers;

class Text{
    public static function excerpt(string $description, int $limit = 60)
    {
      if (mb_strlen($description) <= $limit) {
           return $description;
      }
      $lastSpace = mb_strpos($description, ' ', $limit);
      return mb_substr($description, 0, $lastSpace) . '...';
    }
}