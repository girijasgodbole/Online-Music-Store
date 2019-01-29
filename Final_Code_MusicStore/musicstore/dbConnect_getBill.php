<?php

 	//header("Cache-Control: no-cache");
    //header("Pragma: nocache");
	
    $request_id = preg_replace("/[^0-9]/","",$_GET['request']);
    //$request_moreinfo = preg_replace("/[^0-9]/","",$_REQUEST['moreinfo']);
    if($request_id=="btnGetBillAddr")
    {
        //Open modal popup to allow address selection 
        //Address creation
  		$con=mysqli_connect('localhost','root','root','musicstore',1433);
		if (mysqli_connect_errno())
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
			exit();
		}
		//TODO: Get User ID from session
		$user = '1';
		//Get Address
		$result = mysqli_query($con,"SELECT * FROM address where userid=$user");
		if($result->num_rows == 0) 
		{ 
			echo "No Records";
			exit();	
		}
		$data =array();
 
		while($userData = mysqli_fetch_array($result))	
		{
				array_push($data, array('addressid' => $userData['addressid'],
				'userid' => $userData['userid'], 
				'addr1' => $userData['addr1'],
				'addr2' => $userData['addr2'],
				'addr3' => $userData['addr3'],
				'city' => $userData['city'],
				'state' => $userData['state'],
				'country' => $userData['country'],
				'zip' => $userData['zip'],
				'phone' => $userData['phone']));	
		}
		//header("Content-Type:application/json");
		//$json = json_encode($data);
		//echo $data;
        
    }
    


?>