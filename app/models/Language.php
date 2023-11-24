<?php
class Language extends Database
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = $this->getConnection();
    }

    public function getAllLanguages()
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM languages");
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $err) {
            return false;
        }
    }
}
