<?php
header('Access-control-Allow-Origin: *');//accept all request
header('Content-Type: application/json');//type of response
require_once './Autoloade.php';

$query= "SELECT * FROM users";
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

$pages=[ 'Login-u','Logout-u','Read-product','Inscription-u', 'Delete-rv', 'Update-rv','Addproduct'];
    if(isset($_GET['page']) !== null ){
        if (isset($_GET['page'])) {
            if (in_array($_GET['page'], $pages)) {
                $page=$_GET['page'];
                if ($page=="Read-product"){
                    $result_rv=[];
                    $data = new Product_controllers();
                    $result_rv=$data->getAll_products();
                    $result['table_product']=$result_rv;
                }else if ($page=="Addproduct"){
                    $Add_product=new Product_controllers();
                    $result_rv=$Add_product->Add_products();
                    if($result_rv){
                        $result['message']="successfully Add this product";
                    }else{
                        $result['error']=true;
                        $result['message']="Failed Add this product";
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
                    $result['user_information']=$connecter_user;
                    if($connecter_user['Status']){
                        $result['user_connecter']=True;
                        $result['message_user']="You are logged in successfully";
//                        $_SESSION[`Reference`] = 1;
//                        $_SESSION['login'] = true;
                    }else{
                        $result['user_connecter']=False;
                        $result['message_user']="Please enter the correct information in order to enter successfully";
                    }
                }else if ($page=="Inscription-u"){
                    $Register=new login_controller();
                    $Register_user=$Register->Inscription_user();
//                    $result=$_POST['email'];

                    if($Register_user===1){
                        $result['user_daz']=1;
                        $result['message_user']="User was successfully created";
                    }else if($Register_user === 2){
                        $result['user_daz']=0;
                        $result['message_user']="User Created Registration Failed";
                    }else{
                        $result['user_daz']=0;
                        $result['message_user']="You are already registered on our platform";
                    }
                }else if($page=="Logout-u"){
                    $_SESSION['login'] = false;
                    unset($_SESSION[`Reference`]);
                    $user = new login_controller();
                    $user->De_Connecter();
                }

            }
        }
    }
echo json_encode($result);