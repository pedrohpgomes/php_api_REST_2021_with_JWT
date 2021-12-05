<?php

    header('Content-Type: application/json');

    // nao se esquecer de implementar a JWT para permitir somente acesso autenticado
    require_once '../vendor/autoload.php';

    // http://localhost/PHP_API_REST_2021/public_html/api/users/1
    // api/users/1
    if (isset($_GET['url'])){
        $url = explode('/',$_GET['url']);
        // $url[0] = 'api';
        // $url[1] = controller or service
        // $url[2] = id, que pode ou nao ser passado
        //var_dump($url);
    }

    if ($url[0] === 'api'){
        array_shift($url);

        $service = 'App\Services\\'. ucfirst($url[0]).'Service';
        array_shift($url);

        $method = strtolower($_SERVER['REQUEST_METHOD']);
        //var_dump($method);

        try {
            $response = call_user_func_array(array(new $service, $method), $url);
            http_response_code(200);
            echo json_encode(array('status' => 'success','data' => $response));
            exit;
        } catch (\Exception $e){
            http_response_code(404);
            echo json_encode(array('status' => 'error','data' => $e->getMessage()), JSON_UNESCAPED_UNICODE);
            exit;
       }

    }