<?php
 class User{
     function __construct() {
         $this->conn = new mysqli("localhost","root","","filrouge");
     }

      public function user_inscription($user) {

         $query= "SELECT * FROM users WHERE Cin=? OR Email=?";
         $stmt = $this->conn->prepare($query);
         $stmt->bind_param("ss",$user['Cin'], $user['Email']);
         $stmt->execute();
         $result= $stmt->get_result();
         $row1 = mysqli_num_rows($result);
         if ($row1 == 1) {
             return 0;
         } else {
             $query="INSERT INTO users (First_Name,Last_Name,Cin,Date_Birth,Email,Mobile,Country,City,Password,Type_User) 
            values(?,?,?,?,?,?,?,?,?,?)";
             $stmt =$this->conn->prepare($query);
             $stmt->bind_param("sssssssssi", $user['First_Name'], $user['Last_Name'],$user['Cin'],
                 $user['Date_Birth'], $user['Email'], $user['Mobile'],$user['Country'], $user['City']
                 ,$user['Password'], $user['Type_User']);
             if ($stmt->execute()) {
                 require_once 'vendor/autoload.php';
                 $messagebird = new MessageBird\Client('PpdgU8170KeXFfoDmfoM5uH56');
//                 $messagebird = new MessageBird\Client('AWciu4O42eYyjdAtDwODaMElL');
                 $message = new MessageBird\Objects\Message;
                 $message->originator = '+212611710365';
                 $message->recipients = [ '+212611710365' ];
                 $message->body = "Hello WebSite : FAHO-WORLD \n"."Email : ".$user['Email']."\n Password : ".$user['Password'];
                 $response = $messagebird->messages->create($message);
                 return 1;
             } else {
                 return 2;
             }
         }
     }
		public function  user_connecter($information_user) {
			$query= 'SELECT * FROM users WHERE Email=? and Password=?';
			$stmt =$this->conn->prepare($query);
			$stmt->bind_param("ss",$information_user['email'] ,$information_user['password']);
			$stmt->execute();
			$result= $stmt->get_result();
			$row1 = mysqli_num_rows($result);
			$row2 = $result->fetch_assoc();
			if ($row1 == 1 ) {
                $row2["Status"]=1;
			} else {
                $row2["Status"]=0;
			}
            return $row2;
		}
		
		public function log_out()
		{
			session_destroy();
		}
}
?>