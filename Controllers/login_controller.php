<?php

class login_controller{
    public function Inscription_user(){
        if(isset($_POST['Nom']) && isset($_POST['Prénom'])&&isset($_POST['Date_de_naissance'])){
            $Reference=$this->getreference($_POST['Nom'], $_POST['Prénom']);
            $information_user=array(
                'Nom' => trim($_POST['Nom']),
                'Prénom' => trim($_POST['Prénom']),
                'Date_de_naissance' =>$_POST['Date_de_naissance'],
                'Reference'=>$Reference,
            );
            $Resultat=array();
            $user = new User();
            $Resultat['result_information_user']=$user->user_inscription($information_user);
            $Resultat['RF_user']=$Reference;
            return $Resultat;

        }
    }

    private function getreference($nom,$prénom){
        $a=$nom.$prénom;
        $b=md5($a);
        $ref=substr($b,10,8);
        return $ref;
    }
    public function Connecter(){
        if(isset($_POST['R_U']) && !empty($_POST['R_U'])){
            $R_U = $_POST['R_U'];
            $user = new User();
            return $user->user_connecter($R_U);
        }
    }
    public function De_Connecter(){
        $user = new User();
        $user->log_out();
    }
    }

?>