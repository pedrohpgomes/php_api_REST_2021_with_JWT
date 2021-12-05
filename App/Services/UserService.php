<?php
    namespace App\Services;

    use App\Models\User;

    class UserService {

        public function get($id=null){
            if($id){
                return User::select($id);
            } else{
                return User::selectAll();
            }
        }


        public function post(){
            //$data = $_POST;
            $data = json_decode(file_get_contents("php://input"), true);
            return User::insert($data);
        }

        public function update(){

        }

        public function delete(){

        }
    }