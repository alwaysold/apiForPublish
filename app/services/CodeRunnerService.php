<?php
class CodeRunnerService extends Requests
{
  public function java($id)
  {

    $method = $this->getMethod();
    $body = $this->parseBodyInput();

    if ($method === 'POST') {

      if (!empty($body['source']) && !empty($body['stdin'])) {

        // Extract the specific fields
        $source = $body['source'];
        $stdin = $body['stdin'];

        // Static data for API
        $staticData = array(
          "compiler" => "java1102",
          "options" => array(
            "userArguments" => "",
            "executeParameters" => array(
              "args" => "",
              "stdin" => $stdin // Use the stdin from the incoming JSON
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
          "lang" => "java",
          "files" => [],
          "allowStoreCodeDebug" => true
        );

        // Add the source from the incoming JSON
        $staticData['source'] = $source;

        // Convert the data to JSON format
        $staticData_json = json_encode($staticData);

        // Initialize cURL session
        $url = 'https://godbolt.org/api/compiler/java2000/compile';
        $ch = curl_init($url);

        // Set cURL options
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

        // Execute cURL request
        $response = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
          echo 'Curl error: ' . curl_error($ch);
        }

        // Close cURL session
        curl_close($ch);

        $modified_response = substr($response, 67);

        // Print the modified response

        echo json_encode($modified_response);
      }
    }
  }

  public function cpp($id)
  {
    $method = $this->getMethod();
    $body = $this->parseBodyInput();

    

    if ($method === 'POST') {

      if (!empty($body['source']) && !empty($body['stdin'])) {

        // Extract the specific fields
        $source = $body['source'];
        $stdin = $body['stdin'];

        // Static data for API
        $staticData = array(
          "compiler" => "g132",
          "options" => array(
            "userArguments" => "",
            "executeParameters" => array(
              "args" => "",
              "stdin" => $stdin // Use the stdin from the incoming JSON
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
          "lang" => "c++",
          "files" => [],
          "bypassCache" => 2,
          "allowStoreCodeDebug" => true
        );

        // Add the source from the incoming JSON
        $staticData['source'] = $source;


        // Convert the data to JSON format
        $staticData_json = json_encode($staticData);

        // echo json_encode($staticData);
        // exit;

        // Initialize cURL session
        $url = 'https://godbolt.org/api/compiler/g132/compile';
        $ch = curl_init($url);

        // Set cURL options
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

        // Execute cURL request
        $response = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
          echo 'Curl error: ' . curl_error($ch);
        }

        // Close cURL session
        curl_close($ch);

        $modified_response = substr($response, 67);
        // $modified_response = $response;

        // Print the modified response

        echo json_encode($modified_response);
      }
    }
  }

  public function python($id)
  {

    $method = $this->getMethod();
    $body = $this->parseBodyInput();

    

    if ($method === 'POST') {

      if (!empty($body['source']) && !empty($body['stdin'])) {

        // Extract the specific fields
        $source = $body['source'];
        $stdin = $body['stdin'];

        // Static data for API
        $staticData = array(
          "compiler" => "python311",
          "options" => array(
            "userArguments" => "",
            "executeParameters" => array(
              "args" => "",
              "stdin" => $stdin // Use the stdin from the incoming JSON
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
          "lang" => "python",
          "files" => [],
          "bypassCache" => 2,
          "allowStoreCodeDebug" => true
        );

        // Add the source from the incoming JSON
        $staticData['source'] = $source;


        // Convert the data to JSON format
        $staticData_json = json_encode($staticData);

        // echo json_encode($staticData);
        // exit;

        // Initialize cURL session
        $url = 'https://godbolt.org/api/compiler/python311/compile';
        $ch = curl_init($url);

        // Set cURL options
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

        // Execute cURL request
        $response = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
          echo 'Curl error: ' . curl_error($ch);
        }

        // Close cURL session
        curl_close($ch);

        $modified_response = substr($response, 67);
        // $modified_response = $response;

        // Print the modified response

        echo json_encode($modified_response);
      }
    }
  }

  public function csharp($id)
  {

    $method = $this->getMethod();
    $body = $this->parseBodyInput();

    

    if ($method === 'POST') {

      if (!empty($body['source']) && !empty($body['stdin'])) {

        // Extract the specific fields
        $source = $body['source'];
        $stdin = $body['stdin'];

        // Static data for API
        $staticData = array(
          "compiler" => "dotnet707csharp",
          "options" => array(
            "userArguments" => "",
            "executeParameters" => array(
              "args" => "",
              "stdin" => $stdin // Use the stdin from the incoming JSON
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
          "lang" => "csharp",
          "files" => [],
          "bypassCache" => 2,
          "allowStoreCodeDebug" => true
        );

        // Add the source from the incoming JSON
        $staticData['source'] = $source;


        // Convert the data to JSON format
        $staticData_json = json_encode($staticData);

        // echo json_encode($staticData);
        // exit;

        // Initialize cURL session
        $url = 'https://godbolt.org/api/compiler/dotnet707csharp/compile';
        $ch = curl_init($url);

        // Set cURL options
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

        // Execute cURL request
        $response = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
          echo 'Curl error: ' . curl_error($ch);
        }

        // Close cURL session
        curl_close($ch);

        $modified_response = substr($response, 67);
        // $modified_response = $response;

        // Print the modified response

        echo json_encode($modified_response);
      }
    }
  }

  public function go($id)
  {

    $method = $this->getMethod();
    $body = $this->parseBodyInput();

    

    if ($method === 'POST') {

      if (!empty($body['source']) && !empty($body['stdin'])) {

        // Extract the specific fields
        $source = $body['source'];
        $stdin = $body['stdin'];

        // Static data for API
        $staticData = array(
          "compiler" => "gl1210",
          "options" => array(
            "userArguments" => "",
            "executeParameters" => array(
              "args" => "",
              "stdin" => $stdin // Use the stdin from the incoming JSON
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
          "lang" => "go",
          "files" => [],
          "bypassCache" => 2,
          "allowStoreCodeDebug" => true
        );

        // Add the source from the incoming JSON
        $staticData['source'] = $source;


        // Convert the data to JSON format
        $staticData_json = json_encode($staticData);

        // echo json_encode($staticData);
        // exit;

        // Initialize cURL session
        $url = 'https://godbolt.org/api/compiler/gl1210/compile';
        $ch = curl_init($url);

        // Set cURL options
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

        // Execute cURL request
        $response = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
          echo 'Curl error: ' . curl_error($ch);
        }

        // Close cURL session
        curl_close($ch);

        $modified_response = substr($response, 67);
        // $modified_response = $response;

        // Print the modified response

        echo json_encode($modified_response);
      }
    }
  }

  public function typescript($id)
  {

    $method = $this->getMethod();
    $body = $this->parseBodyInput();

    

    if ($method === 'POST') {

      if (!empty($body['source']) && !empty($body['stdin'])) {

        // Extract the specific fields
        $source = $body['source'];
        $stdin = $body['stdin'];

        // Static data for API
        $staticData = array(
          "compiler" => "tsc_0_0_35_gc",
          "options" => array(
            "userArguments" => "",
            "executeParameters" => array(
              "args" => "",
              "stdin" => $stdin // Use the stdin from the incoming JSON
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
          "lang" => "typescript",
          "files" => [],
          "bypassCache" => 2,
          "allowStoreCodeDebug" => true
        );

        // Add the source from the incoming JSON
        $staticData['source'] = $source;


        // Convert the data to JSON format
        $staticData_json = json_encode($staticData);

        // echo json_encode($staticData);
        // exit;

        // Initialize cURL session
        $url = 'https://godbolt.org/api/compiler/tsc_0_0_35_gc/compile';
        $ch = curl_init($url);

        // Set cURL options
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

        // Execute cURL request
        $response = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
          echo 'Curl error: ' . curl_error($ch);
        }

        // Close cURL session
        curl_close($ch);

        $modified_response = substr($response, 67);
        // $modified_response = $response;

        // Print the modified response

        echo json_encode($modified_response);
      }
    }
  }

}