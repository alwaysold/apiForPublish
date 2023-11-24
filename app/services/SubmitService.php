<?php

class SubmitService extends Requests
{
    private $compilerService;
    private $userSolution;
    private $testCase;

    public function __construct()
    {
        $this->compilerService = new Compiler();
        $this->userSolution = new UserSolution();
        $this->testCase = new TestCase();
    }

    public function java($id)
    {
        $this->submitHelper($id[0], 'java');
    }

    public function python($id)
    {
        $this->submitHelper($id, 'java');
    }

    public function cpp($id)
    {
        $this->submitHelper($id, 'java');
    }

    public function csharp($id)
    {
        $this->submitHelper($id, 'java');
    }

    public function go($id)
    {
        $this->submitHelper($id, 'java');
    }

    public function typescript($id)
    {
        $this->submitHelper($id, 'java');
    }

    private function checkResult($actual, $expected)
    {

        $actual = substr($actual,16);
        $actual = substr($actual,0,-1);

        return $actual == $expected;
    }

    public function submitHelper($id, $language){

        $method = $this->getMethod();
        $body = $this->parseBodyInput();

        $result = [];
        $user_model = new User();
        $jwt = new JWT();
        $authorization = new Authorization();

        if ($method == 'POST') {
            $token = $authorization->getAuthorization();

            if ($token) {
                $user = $jwt->validateJWT($token);

                if ($user) {
                    $userId = $user->id;
                    $userExists = $user_model->list($userId->id);

                    if ($userExists) {
                        $testCases = $this->testCase->getTestCasesByQuestionId($id);
                        $results = [];

                        $code = $body['source'];

                        foreach ($testCases as $tc) {
                            $stdin = $tc['input'];
                            $expectedOutput = $tc['expected_output'];
                            $compilerResult = $this->compilerService->compileCode($language, $code, $stdin);
                            $isCorrect = $this->checkResult($compilerResult, $expectedOutput);
                            $results[] = $isCorrect;
                        }

                        $result['data'] = $results;

                        $this->userSolution->storeUserSolution($userId->id, $id, $language, $code, true);

                    } else {
                        http_response_code(401);
                        $result['error'] = "Unauthorized, user doesn't exist";
                    }
                } else {
                    http_response_code(401);
                    $result['error'] = "Unauthorized, please verify your token";
                }
            } else {
                http_response_code(401);
                $result['error'] = "Unauthorized, can't find token!";
            }
        } else {
            http_response_code(405);
            $result['error'] = "HTTP Method not allowed";
        }
        echo json_encode($result);
    }
}
