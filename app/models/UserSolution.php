<?php

class UserSolution extends Database
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = $this->getConnection();
    }

    public function storeUserSolution($userId, $questionId, $languageId, $userCode, $isCorrect)
    {
        try {
            $submissionTime = date('Y-m-d H:i:s');

            $stm = $this->pdo->prepare("INSERT INTO user_solutions (user_id, question_id, language_id, user_code, submission_time, is_correct) VALUES (?, ?, ?, ?, ?, ?)");
            $stm->execute([$userId, $questionId, $languageId, $userCode, $submissionTime, $isCorrect]);

            return true;
        } catch (PDOException $err) {
            return false;
        }
    }
}
