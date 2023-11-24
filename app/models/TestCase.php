<?php

class TestCase extends Database
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = $this->getConnection();
    }

    public function getTestCasesByQuestionId($questionId)
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM test_cases WHERE question_id = ?");
            $stm->execute([$questionId]);

            if ($stm->rowCount() > 0) {
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return [];
            }
        } catch (PDOException $err) {
            return [];
        }
    }
}
