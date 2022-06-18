<?php
header('Access-control-Allow-Origin: *');//accept all request
header('Content-Type: application/json');//type of response
require_once './Autoloade.php';

$query= "SELECT * FROM utilisateur WHERE Reference=?";
$stmt = DB::connect()->prepare($query);
$result=array();
$result['error']=false;
    if ($_SESSION['is_db_connected']){
        $result["is_db_connected"]=true;
        $result["connction_msg"]="Connected successfully";
    }else{
        $result["is_db_connected"]=false;
        $result["connction_msg"]="Connected failed";
    }

$pages=[ 'Login-u','Logout-u','Read-rv','Inscription-u', 'Delete-rv', 'Update-rv','Add-rv'];
    if(isset($_GET['page']) !== null ){
        if (isset($_GET['page'])) {
            if (in_array($_GET['page'], $pages)) {
                $page=$_GET['page'];
                if ($page=="Read-rv"){
                    $result_rv=[];
                    $data = new Rv_controllers();
                    $result_rv=$data->getAll_Rv();
                    $result['r_v']=$result_rv;
                }else if ($page=="Add-rv"){
                    $delete_rv=new Rv_controllers();
                    $result_rv=$delete_rv->Add_rv();
                    if($result_rv){
                        $result['message']="successfully Add this r_v";
                    }else{
                        $result['error']=true;
                        $result['message']="Failed Add this r_v";
                    }
                }else if ($page=="Delete-rv"){
                    $delete_rv=new Rv_controllers();
                    $result_rv=$delete_rv->delete_rv();
                    if($result_rv){
                        $result['message']="successfully Deleting this r_v";
                    }else{
                        $result['error']=true;
                        $result['message']="Failed Deleting this r_v";
                    }
                }else if ($page=="Update-rv"){
                    $delete_rv=new Rv_controllers();
                    $result_rv=$delete_rv->update_rv();
                    if($result_rv){
                        $result['message']="successfully updating this r_v";
                    }else{
                        $result['error']=true;
                        $result['message']="Failed updating this r_v";
                    }
                }else if ($page=="Login-u"){
                    $connecter=new login_controller();
                    $connecter_user=$connecter->Connecter();
                    if($connecter_user['status']){
                        $result['user_connecter']=True;
                        $result['RF_user']=$connecter_user['Reference'];
                        $_SESSION[`Reference`] = $connecter_user['Reference'];
                        $_SESSION['login'] = true;
                    }else{
                        $result['user_connecter']=False;
                        $result['message_user']="Veuillez entrer les informations correctes afin d'entrer avec succès";
                    }
                }else if ($page=="Inscription-u"){
                    $Register=new login_controller();
                    $Register_user=$Register->Inscription_user();
                    if($Register_user['result_information_user']){
                        $result['user_daz']=True;
                        $result['RF_user']=$Register_user['RF_user'];
                        $result['message_user']="L'utilisateur a été créé avec succès";
                    }else if($Register_user['result_information_user'] == 0){
                        $result['user_daz']=False;
                        $result['RF_user']=$Register_user['RF_user'];
                        $result['message_user']="Vous êtes déjà inscrit sur notre plateforme";
                    }else{
                        $result['error']=true;
                        $result['message_user']="User Created Registration Failed";
                        }
                }else if($page=="Logout-u"){
                    $_SESSION['login'] == false;
                    unset($_SESSION[`Reference`]);
                    $user = new login_controller();
                    $user->De_Connecter();

                }

            }
        }
    }
echo json_encode($result);