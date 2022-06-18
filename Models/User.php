<?php
 class User{
     function __construct() {
         $this->conn = new mysqli("localhost","root","","brief-6");
     }

      public function user_inscription($information_user) {

         $query= "SELECT * FROM utilisateur WHERE Nom=? AND Prénom=?";
         $stmt = $this->conn->prepare($query);
         $stmt->bind_param("ss",$information_user['Nom'], $information_user['Prénom']);
         $stmt->execute();
         $result= $stmt->get_result();
         $row1 = mysqli_num_rows($result);
         if ($row1 == 1) {
             return 0;
         } else {
             $stmt =$this->conn->prepare("INSERT INTO utilisateur (Reference,Nom, Prénom,Date_de_naissance) values(?,?,?,?)");
             $stmt->bind_param("ssss", $information_user['Reference'], $information_user['Nom'],$information_user['Prénom'], $information_user['Date_de_naissance']);
             $stmt->execute();
             return  1;
         }
     }

		public function  user_connecter($Reference) {
			$query= "SELECT * FROM utilisateur WHERE Reference=?";
			$stmt =$this->conn->prepare($query);
			$stmt->bind_param("s",$Reference);
			$stmt->execute();
			$result= $stmt->get_result();
			$row1 = mysqli_num_rows($result);
			$row2 = $result->fetch_assoc();
			if ($row1 == 1 ) {
                $row2["status"]=1;
                return $row2;
			} else {
                  $row2["status"]=0;
			}
		}
		
		public function log_out()
		{
			session_destroy();
		}
}
?>