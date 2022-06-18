<?php /** @noinspection ALL */

class Rv_controllers{
        public function getAll_Rv(){
            $rv= Reservation::getAll_rv();
            return $rv;
        }
        public function delete_rv(){
            if(isset($_POST['id'])){
                $id = $_POST['id'];
                $resul_delete=Reservation::Delete($id);
                return $resul_delete;
            }
        }

        public function update_rv(){
            if(isset($_POST['id']) && isset($_POST['Date'])&&isset($_POST['Horaire'])){
                $R_V=array(
                    'id' => $_POST['id'],
                    'Date' => $_POST['Date'],
                    'Horaire' =>$_POST['Horaire'],
                );
                $resul_Edit=Reservation::Edit($R_V);
                return $resul_Edit;
            }
        }

        public function Add_rv(){
            if(isset($_POST['Date'])&&isset($_POST['Horaire'])&&isset($_POST['Reference'])){
                $R_V=array(
                    'Date' => $_POST['Date'],
                    'Horaire' =>$_POST['Horaire'],
                    'Reference'=>$_POST['Reference'],
                );
                $resul_Add=Reservation::Add($R_V);
                return $resul_Add;
            }
        }
}
?>
