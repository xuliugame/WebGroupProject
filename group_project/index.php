<?php

// set header footer and connect to db

	$page='home';
	$path='';
    require $path.'assets/head/header.php';
	
	
	
	
	require $path.'../dbConnect.inc';
	
	  $sql = "SELECT content FROM project3 where page='$page'";
	  
     $result = $mysqli->query($sql);

               if($result->num_rows > 0){
          
			while ($row = $result->FETCH_ASSOC()) {
				echo $row['content'];
            
			}
		}else{
			echo "0 results, did something wrong!";
		}

include($path.'assets/foot/footer.php');


?>


<!DOCTYPE html>
<html lang="en">



</html>