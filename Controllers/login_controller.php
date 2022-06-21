<?php

class login_controller{
    public function Inscription_user(){
        if(isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['Cin']) && isset($_POST['date_birth'])
            && isset($_POST['email']) && isset($_POST['tel']) &&isset($_POST['country']) &&isset($_POST['City'])){
            $password=$this->getreference($_POST['Cin']);
            $information_user=array(
                'First_Name' => trim($_POST['first_name']),
                'Last_Name' => trim($_POST['last_name']),
                'Cin' =>trim($_POST['Cin']),
                'Date_Birth' => trim($_POST['date_birth']),
                'Email' => trim($_POST['email']),
                'Mobile' =>trim($_POST['tel']),
                'Country' => trim($_POST['country']),
                'City' => trim($_POST['City']),
                'Password' =>$password,
                'Type_User' => 0,
            );
            $user = new User();
            return $user->user_inscription($information_user);
        }
    }
    private function getreference($cin){
        $b=md5($cin);
        $password=substr($b,10,8);
        return $password;
    }
    public function Connecter(){
        if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])){
            $information_user=array(
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
            );
            $user = new User();
            return $user->user_connecter($information_user);
        }
    }
    public function De_Connecter(){
        $user = new User();
        $user->log_out();
    }
    }

?>