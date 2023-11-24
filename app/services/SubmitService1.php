<?php

class CompilerService extends Requests
{
    private $compilerModel;

    public function __construct()
    {
        $this->compilerModel = new Compiler();
    }

    public function java()
    {
        $method = $this->getMethod();
        $body = $this->parseBodyInput();

        if ($method === 'POST') {
            if (!empty($body['source']) && !empty($body['stdin'])) {
                $source = $body['source'];
                $stdin = $body['stdin'];
                $modifiedResponse = $this->compilerModel->compileCode('java', $source, $stdin);
                echo $modifiedResponse;
            }
        }
    }

    public function python()
    {
        $method = $this->getMethod();
        $body = $this->parseBodyInput();

        if ($method === 'POST') {
            if (!empty($body['source']) && !empty($body['stdin'])) {
                $source = $body['source'];
                $stdin = $body['stdin'];
                $modifiedResponse = $this->compilerModel->compileCode('python', $source, $stdin);
                echo $modifiedResponse;
            }
        }
    }


    public function cpp()
    {
        $method = $this->getMethod();
        $body = $this->parseBodyInput();

        if ($method === 'POST') {
            if (!empty($body['source']) && !empty($body['stdin'])) {
                $source = $body['source'];
                $stdin = $body['stdin'];
                $modifiedResponse = $this->compilerModel->compileCode('cpp', $source, $stdin);
                echo $modifiedResponse;
            }
        }
    }


    public function csharp()
    {
        $method = $this->getMethod();
        $body = $this->parseBodyInput();

        if ($method === 'POST') {
            if (!empty($body['source']) && !empty($body['stdin'])) {
                $source = $body['source'];
                $stdin = $body['stdin'];
                $modifiedResponse = $this->compilerModel->compileCode('csharp', $source, $stdin);
                echo $modifiedResponse;
            }
        }
    }


    public function go()
    {
        $method = $this->getMethod();
        $body = $this->parseBodyInput();

        if ($method === 'POST') {
            if (!empty($body['source']) && !empty($body['stdin'])) {
                $source = $body['source'];
                $stdin = $body['stdin'];
                $modifiedResponse = $this->compilerModel->compileCode('go', $source, $stdin);
                echo $modifiedResponse;
            }
        }
    }


    public function typescript()
    {
        $method = $this->getMethod();
        $body = $this->parseBodyInput();

        if ($method === 'POST') {
            if (!empty($body['source']) && !empty($body['stdin'])) {
                $source = $body['source'];
                $stdin = $body['stdin'];
                $modifiedResponse = $this->compilerModel->compileCode('typescript', $source, $stdin);
                echo $modifiedResponse;
            }
        }
    }


}
