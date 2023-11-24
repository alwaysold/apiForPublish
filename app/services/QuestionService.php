<?php

class QuestionService extends Requests
{
    public function questionListByLevel($id)
    {
        $method = $this->getMethod();

        $result = [];

        $Question_model = new Question();

        if ($method == 'GET') {

            $questionExists = $Question_model->getQuestionListByLevel($id[0]);

            if ($questionExists) {
                $result['data'] = $questionExists;
            } else {
                http_response_code(404);
                $result['error'] = "not found, level dosent exist";
            }

        } else {
            http_response_code(405);
            $result['error'] = "HTTP Method not allowed";
        }

        echo json_encode($result);
    }

    public function getAllQuestions()
    {
        $method = $this->getMethod();

        $result = [];

        $Question_model = new Question();

        if ($method == 'GET') {

            $questionExists = $Question_model->getAllQuestions();

            if ($questionExists) { 
                $result['data'] = $questionExists;
            } else {
                http_response_code(404);
                $result['error'] = "not found, no qiuestions are there!";
            }

        } else {
            http_response_code(405);
            $result['error'] = "HTTP Method not allowed";
        }

        echo json_encode($result);
    }

    public function java($id)
    {
        $this->QuestionHelper($id,'java');
    }

    public function python($id)
    {
        $this->QuestionHelper($id,'python');
    }

    public function cpp($id)
    {
        $this->QuestionHelper($id,'cpp');
    }

    public function csharp($id)
    {
        $this->QuestionHelper($id,'csharp');
    }

    public function go($id)
    {
        $this->QuestionHelper($id,'go');
    }

    public function typescript($id)
    {
        $this->QuestionHelper($id,'typescript');
    }

    public function QuestionHelper($id, $language){
        $method = $this->getMethod();

        $result = [];

        $Question_model = new Question();

        if ($method == 'GET') {

            $questionExists = $Question_model->getQuestionAndCodeById($id[0],$language);

            if ($questionExists) {
                $result['data'] = $questionExists;
            } else {
                http_response_code(404);
                $result['error'] = "not found, question dosent exist";
            }

        } else {
            http_response_code(405);
            $result['error'] = "HTTP Method not allowed";
        }

        echo json_encode($result);
    }
}
