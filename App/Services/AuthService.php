<?php
    namespace App\Services;

    class AuthService {

        //http://localhost/PHP_API_REST_2021_with_JWT/public_html/api/auth/login
        public function login(){
        //public function get(){

            if( isset($_POST['email']) && isset($_POST['password']) && $_POST['email'] == 'teste@gmail.com' && $_POST['password'] == '123' ){
                //Application Key
                $key = '123456';

                //Header Token
                $header = [
                    'typ' => 'JWT',
                    'alg' => 'HS256'
                ];

                //Payload - Content
                $payload = [
                    'name' => 'Teste Testando 123',
                    'email' => $_POST['email'],
                ];

                //JSON
                $header = json_encode($header);
                $payload = json_encode($payload);

                //Base 64
                $header = base64_encode($header);
                $payload = base64_encode($payload);

                //Sign
                $sign = hash_hmac('sha256', $header . "." . $payload, $key, true);
                $sign = base64_encode($sign);

                //Token
                $token = $header . '.' . $payload . '.' . $sign;

                return $token;
            } // if $_POST...
            throw new \Exception('Usuário não autenticado');            
        } // public function get()...

        public static function checkAuth(){
            $http_header = apache_request_headers();
            if (isset($http_header['Authorization']) && $http_header['Authorization'] != null){
                $bearer = explode(' ', $http_header['Authorization']);
                //$bearer[0] = 'bearer';
                //$bearer[1] = token JWT;


                $token = explode('.', $bearer[1]);
                //$token[0] = header;
                //$token[1] = payload;
                //$token[2] = sign;
                //$key      = deve ser a mesma utilizada na funcao login para gerar o token JWT

                $header  = $token[0];
                $payload = $token[1];
                $sign    = $token[2];

                $key = '123456';

                //Conferir Sign
                $valid = hash_hmac('sha256', $header . "." . $payload, $key, true);
                $valid = base64_encode($valid);

                if ($sign === $valid){
                    return true;
                }
            }
            return  false;  
            

        } // public static function checkAuth

    } // Class AuthService
?>