<?php 

class  Reservation
{
//        static public function getAll_rv(){
//            $query="SELECT *FROM Rendez_vous INNER JOIN utilisateur ON utilisateur.Reference = Rendez_vous.Reference";
//            $stmt = DB::connect()->prepare($query);
//            $stmt->execute();
//            return $stmt->fetchAll();
//        }
    //        all rv
    static public function getAll_rv(){
        $query="SELECT *FROM Rendez_vous ";
        $stmt = DB::connect()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    //        Delete
        static public function Delete($id){
            $query="SELECT *FROM Rendez_vous  where id=:id";
            $stmt = DB::connect()->prepare($query);
            $stmt->bindParam(':id', $id);
            if ($stmt->execute()) {
                $query="DELETE FROM Rendez_vous  where id=:id";
                $stmt = DB::connect()->prepare($query);
                $stmt->bindParam(':id', $id);
                if ($stmt->execute()) {
                    return 1;
                } else {
                    return 0;
                }
            } else {
                return 0;
            }
        }
    //        Add
        static public function Add($R_V){
            try {
                 $query="INSERT INTO Rendez_vous (Date,Horaire,Reference)VALUES(:Date,:Horaire,:Reference)";
                 $stmt = DB::connect()->prepare($query);
                 $stmt->bindParam(':Date',$R_V['Date']);
                 $stmt->bindParam(':Horaire',$R_V['Horaire']);
                 $stmt->bindParam(':Reference',$R_V['Reference']);
                 if ($stmt->execute()) {
                         return 1;
                     } else {
                         return 0;
                     }
            } catch (PDOException $ex) {
                echo 'erreur'.$ex->getMessage();
            }
        }

    //        edit
    static public function Edit($R_V){
        try {
            $stmt = DB::connect()->prepare("UPDATE Rendez_vous SET  Date=:Date,Horaire=:Horaire where id=:id");
            $stmt->bindParam(':Date',$R_V['Date']);
            $stmt->bindParam(':Horaire',$R_V['Horaire']);
            $stmt->bindParam(':id',$R_V['id']);
            if ($stmt->execute()) {
                return 1;
            } else {
                return 0;
            }
        } catch (PDOException $ex) {
            echo 'erreur'.$ex->getMessage();
        }
    }
}
?>