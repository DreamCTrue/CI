<html>
<head>
 <title>GCM Demo application</title>
 <meta content='text/html; charset=UTF-8' http-equiv='Content-Type'/>
</head>
<body>
 <?php 
 
  if(isset($_POST['submit'])){
  
   $con = mysql_connect("localhost", "vany","tsoc2014");
   if(!$con){
    die('MySQL connection failed');
   }

   $db = mysql_select_db("vany");
   if(!$db){
    die('Database selection failed');
   }


   $registatoin_ids = array();
   $sql = "SELECT *FROM tblregistration";
   $result = mysql_query($sql, $con);
   while($row = mysql_fetch_assoc($result)){
    array_push($registatoin_ids, $row['registration_id']);
   }
	/*
	$registatoin_ids = array();
	array_push($registatoin_ids,'APA91bGY8BZcf8gAs5_knROuAtF3COvnAbSpzLybLVr5gv7jfVLiP6SNLPCTa60aqhnvnzMK3QhU4IGm6FGx_j_NOhiUnCnaEPyt5uudlTwWUQs5dqsec3e0i4GDArh4WnJ9rY5teMlD');
	*/
	// Set POST variables
         $url = 'https://android.googleapis.com/gcm/send';
  
    $message = array( 'title' => 'test title', 'message' => $_POST['message'], 'soundname' => "beep.wav",'timeStamp'=> date("Y-m-d H:i:s"));
         $fields = array(
             'registration_ids' => $registatoin_ids,
             'data' =>  $message
         );
  
         $headers = array(
             'Authorization: key=AIzaSyBUNr59L7EKcpX3KUdODfUYQGNYw7jT0Zs',
             'Content-Type: application/json'
         );
         // Open connection
         $ch = curl_init();
  
         // Set the url, number of POST vars, POST data
         curl_setopt($ch, CURLOPT_URL, $url);
  
         curl_setopt($ch, CURLOPT_POST, true);
         curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
         // Disabling SSL Certificate support temporarly
         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		
         curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
  
         // Execute post
         $result = curl_exec($ch);
         if ($result === FALSE) {
             die('Curl failed: ' . curl_error($ch));
         }
// 由回傳結果, 取得已解除安裝的 regID
    // 自資料庫中刪除
	$aGCMresult = json_decode($result,true);
	$aUnregID = $aGCMresult['results'];
        $unregcnt = count($aUnregID);
        for($i=0;$i<$unregcnt;$i++)
        {
          $aErr = $aUnregID[$i];
          if(isset($aErr['error']) && $aErr['error']=='NotRegistered')
          {
            $sqlTodel = "DELETE FROM tblregistration WHERE registration_id='".$aRegID[$i]."' ";
            mysql_query($sqlTodel, $con);
        }
    }
  
         // Close connection
         curl_close($ch);
         echo $result;
		 
  }
 ?>
 <form method="post" action="gcm_post2.php">
  <label>Insert Message: </label><input type="text" name="message" /><br />
  <input type="submit" name="submit" value="Send" />
 </form>
</body>
</html>
