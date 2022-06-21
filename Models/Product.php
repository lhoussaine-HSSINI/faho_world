<?php
class  Product{
//        static public function getAll_rv(){
//            $query="SELECT *FROM Rendez_vous INNER JOIN utilisateur ON utilisateur.Reference = Rendez_vous.Reference";
//            $stmt = DB::connect()->prepare($query);
//            $stmt->execute();
//            return $stmt->fetchAll();
//        }
    //        all rv
    static public function getAll_products(){
    $query="SELECT *FROM products ";
    $stmt = DB::connect()->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();
}
    //        Delete
    static public function Delete($Product_id){
    $query="SELECT *FROM products  where Product_id=:Product_id";
    $stmt = DB::connect()->prepare($query);
    $stmt->bindParam(':Product_id', $Product_id);
    if ($stmt->execute()) {
        $query="DELETE FROM products  where Product_id=:Product_id";
        $stmt = DB::connect()->prepare($query);
        $stmt->bindParam(':Product_id', $Product_id);
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
        $query="INSERT INTO products (Product_Name,Product_Price,Product_Quantity, Product_Brand, Product_Image)
            VALUES(:Product_Name,:Product_Price,:Product_Quantity, :Product_Brand,:Product_Image)";
        $stmt = DB::connect()->prepare($query);
        $stmt->bindParam(':Product_Name',$R_V['Product_Name']);
        $stmt->bindParam(':Product_Price',$R_V['Product_Price']);
        $stmt->bindParam(':Product_Quantity',$R_V['Product_Quantity']);
        $stmt->bindParam(':Product_Brand',$R_V['Product_Brand']);
        $stmt->bindParam(':Product_Image',$R_V['Product_Image']);
        if ($stmt->execute()) {
            return 1;
        } else {
            return 0;
        }
    } catch (PDOException $ex) {
        echo 'erreur'.$ex->getMessage();
        return 0;
    }
}
    //        edit
    static public function Edit($R_V){
    try {
        $query="UPDATE products SET  Product_Name=:Product_Name, Product_Price=:Product_Price,Product_Quantity=:Product_Quantity
            ,Product_Brand=:Product_Brand,Product_Image=:Product_Image where Product_id=:Product_id";
        $stmt = DB::connect()->prepare($query);
        $stmt->bindParam(':Product_Name',$R_V['Product_Name']);
        $stmt->bindParam(':Product_Price',$R_V['Product_Price']);
        $stmt->bindParam(':Product_Quantity',$R_V['Product_Quantity']);
        $stmt->bindParam(':Product_Brand',$R_V['Product_Brand']);
        $stmt->bindParam(':Product_Image',$R_V['Product_Image']);
        $stmt->bindParam(':Product_id',$R_V['Product_id']);
        if ($stmt->execute()) {
            return 1;
        } else {
            return 0;
        }
    } catch (PDOException $ex) {
        echo 'erreur'.$ex->getMessage();
        return 0;
    }
}
}