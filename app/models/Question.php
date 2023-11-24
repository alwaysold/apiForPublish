<?php

class Question extends Database
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = $this->getConnection();
    }

    public function getQuestionById($id)
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM questions WHERE id = ?");
            $stm->execute([$id]);

            if ($stm->rowCount() > 0) {
                return $stm->fetch(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        } catch (PDOException $err) {
            return false;
        }
    }


    public function getQuestionAndCodeById($id, $language)
    {
        try {
            $stm = $this->pdo->prepare("SELECT q.id AS question_id, q.question_text, q.explanation,
                                        q.demo_input, q.demo_output, q.level_id AS 'level', q.question_name,
                                        qc.code_snippet, qc.solution, l.name AS 'language' 
                                        FROM questions q CROSS JOIN languages l 
                                        LEFT JOIN question_code qc ON q.id = qc.question_id 
                                        AND qc.language_id = l.id WHERE q.id = ? AND l.name = ?;");
            $stm->execute([$id, $language]);

            if ($stm->rowCount() > 0) {
                return $stm->fetch(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        } catch (PDOException $err) {
            return false;
        }
    }

    public function getQuestionListByLevel($id)
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM questions WHERE level_id = ?");
            $stm->execute([$id]);

            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $err) {
            return false;
        }
    }

    public function getAllQuestions()
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM questions");
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $err) {
            return false;
        }
    }
}
