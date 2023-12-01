<?php

class Feed extends Database
{

  private $pdo;

  public function __construct()
  {
    $this->pdo = $this->getConnection();
  }

  public function list($num)
  {
    try {
      $stm = $this->pdo->prepare("SELECT `title`, `content`, `media_url`, `abstract`, `author_id`, `publication_date` FROM `Papers` LIMIT ?");
      $stm->execute([$num]);

      if ($stm->rowCount() > 0) {
        return $stm->fetch(PDO::FETCH_ASSOC);
      } else {
        return false;
      }
    } catch (PDOException $err) {
      return false;
    }
  }
}
