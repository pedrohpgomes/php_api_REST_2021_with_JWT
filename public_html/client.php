<?php

    $url = 'http://localhost/PHP_API_REST_2021/public_html/api/';

    $class = 'user';

    $param = '';

    $response = file_get_contents($url.$class.$param);
   
    
   // $checkLogin = '{"status":"success","data":[{"id":"1","email":"rafa@gmail.com","password":"123","name":"Rafa"},{"id":"2","email":"bruno@gmail.com","password":"123","name":"asdasd"},{"id":"3","email":"pedro@ipb.org.br","password":"123","name":"pedro"},{"id":"4","email":"teste2@gmail.com","password":"123","name":"teste2"}]}';

   $array = json_decode(removeBomUtf8($response),1);
  //echo json_last_error();
  echo "<pre>";print_r($array);

  
   function removeBomUtf8($s){
    if(substr($s,0,3)==chr(hexdec('EF')).chr(hexdec('BB')).chr(hexdec('BF'))){
         return substr($s,3);
     }else{
         return $s;
     }
  }


















    
    /*echo $response;
    $array = json_decode($response);
    echo json_last_error();*/

    //
    //$response = '{"Peter":35,"Ben":37,"Joe":43}';
   
    //$response = safe_json_encode($response,4);
    //$html = $response;
    //$html=preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $html);
    //var_dump(json_decode($html, true));
    //var_dump(json_last_error());
    //$json = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $output)); // Remove os caracteres não imprimíveis da string
    //var_dump($response);
    //$array = json_decode( utf8_encode( $response ) );
    //echo $response;
    //echo json_last_error();
    //var_dump($array);

/*
    function safe_json_encode($value, $options = 0, $depth = 512) {
        $encoded = json_encode($value, $options, $depth);
        if ($encoded === false && $value && json_last_error() == JSON_ERROR_UTF8) {
            $encoded = json_encode(utf8ize($value), $options, $depth);
        }
        return $encoded;
    }

    function utf8ize($mixed) {
        if (is_array($mixed)) {
            foreach ($mixed as $key => $value) {
                $mixed[$key] = utf8ize($value);
            }
        } elseif (is_string($mixed)) {
            return mb_convert_encoding($mixed, "UTF-8", "UTF-8");
        }
        return $mixed;
    }
    */