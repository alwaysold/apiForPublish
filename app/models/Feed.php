<?php

class Feed extends Database
{

    private $pdo;

    public function __construct()
    {
        $this->pdo = $this->getConnection();
    }

    // SELECT `paper_id`, `title`, `content`, `media_url`, `abstract`, `author_id`, `publication_date` FROM `Papers` LIMIT $id 
    public function list($id)
    {
        try {
            $stm = $this->pdo->prepare("
            SELECT 
                p.paper_id, 
                p.title, 
                p.content, 
                p.media_url, 
                p.abstract, 
                p.author_id, 
                p.publication_date,
                COALESCE(reactions.count_type_1, 0) AS count_type_1,
                COALESCE(reactions.count_type_2, 0) AS count_type_2,
                COALESCE(reactions.count_type_3, 0) AS count_type_3,
                COALESCE(reactions.count_type_4, 0) AS count_type_4,
                COALESCE(reactions.count_type_5, 0) AS count_type_5
            FROM 
                Papers p
            LEFT JOIN 
                (
                    SELECT 
                        paper_id,
                        SUM(reaction_type = 1) AS count_type_1,
                        SUM(reaction_type = 2) AS count_type_2,
                        SUM(reaction_type = 3) AS count_type_3,
                        SUM(reaction_type = 4) AS count_type_4,
                        SUM(reaction_type = 5) AS count_type_5
                    FROM 
                        Reactions
                    GROUP BY 
                        paper_id
                ) reactions ON p.paper_id = reactions.paper_id
            LIMIT $id

            ");
            $stm->execute();
            // var_dump($stm);
            if ($stm->rowCount() > 0) {
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        } catch (PDOException $err) {
            return false;
        }
    }
}
