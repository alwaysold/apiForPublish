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
        $this->RunHelper('java');
    }

    public function python()
    {
        $this->RunHelper('python');
    }

    public function cpp()
    {
        $this->RunHelper('cpp');
    }

    public function csharp()
    {
        $this->RunHelper('csharp');
    }

    public function go()
    {
        $this->RunHelper('go');
    }

    public function typescript()
    {
        $this->RunHelper('typescript');
    }
    
    public function RunHelper($lang){
        $method = $this->getMethod();
        $body = $this->parseBodyInput();

        if ($method === 'POST') {
            if (!empty($body['source']) && !empty($body['stdin'])) {
                $source = $body['source'];
                $stdin = $body['stdin'];
                $modifiedResponse = $this->compilerModel->compileCode($lang, $source, $stdin);
                echo $modifiedResponse;
            }
        }
    }
}
