<?php

class Compiler
{
    public function compileCode($language, $source, $stdin)
    {
        $compiler = $this->getCompilerForLanguage($language);
        return $this->compileCodeInternal($compiler, $language, $source, $stdin);
    }

    private function compileCodeInternal($compiler, $language, $source, $stdin)
    {
        $staticData = array(
            "compiler" => $compiler,
            "options" => array(
                "userArguments" => "",
                "executeParameters" => array(
                    "args" => "",
                    "stdin" => $stdin 
                ),
                "compilerOptions" => array(
                    "executorRequest" => true,
                    "skipAsm" => true,
                    "overrides" => []
                ),
                "filters" => array(
                    "execute" => true
                ),
                "tools" => array(),
                "libraries" => []
            ),
            "lang" => $language,
            "files" => [],
            "allowStoreCodeDebug" => true
        );

        $staticData['source'] = $source;

        $staticData_json = json_encode($staticData);

        $url = $this->getCompilerApiUrl($compiler);
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $staticData_json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($staticData_json)
            )
        );

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            return json_encode(['error' => 'Curl error: ' . curl_error($ch)]);
        }

        curl_close($ch);

        $modified_response = substr($response, 67);

        // return json_encode(['output' => $modified_response]);
        return $modified_response;
    }

    private function getCompilerForLanguage($language)
    {
        $compilerMapping = [
            'java' => 'java1102',
            'cpp' => 'g132',
            'python' => 'python311',
            'csharp' => 'dotnet707csharp',
            'go' => 'gl1210',
            'typescript' => 'tsc_0_0_35_gc',
        ];

        if (isset($compilerMapping[$language])) {
            return $compilerMapping[$language];
        } else {
            return 'defaultCompiler';
        }
    }

    private function getCompilerApiUrl($compiler)
    {
        return "https://godbolt.org/api/compiler/{$compiler}/compile";
        // return 'https://godbolt.org/api/compiler/' . $compiler . '/compile';
    }

}
