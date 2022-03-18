<?php
  	require "../../dbConnect.inc";
	// senitize function
  	function senitized($str=""){
		$text = trim($str);
	    $text = strip_tags($text);
	    $text = htmlentities($text,ENT_QUOTES,"UTF-8");
	    return $text;
	}
	// there are post action
	if( isset($_POST) && !empty($_POST)){
		// didn't input name
		if(!isset($_POST['visitor']) || $_POST['visitor'] =='' ){
			echo "<h1 style='color:red'>Server Error:name can't be empty!</h1>"."<br/>";
		}
		// didn't input comment
		if(!isset($_POST['comment']) || $_POST['comment'] =='' ){
			echo "<h1 style='color:red'>Server Error:comment can't be empty!</h1>"."<br/>";
		}
		// there are name and comment
		if(isset($_POST['visitor']) && $_POST['visitor'] !='' &&  isset($_POST['comment']) && $_POST['comment'] !=''){
			$name = senitized($_POST['visitor']);
			$comment = senitized($_POST['comment']);
			if($mysqli){
				/*
				we are using client entered data - therefore we HAVE TO USE a prepared statement
				1)prepare my query
				2)bind
				3)execute
				4)close
				*/
				$stmt=$mysqli->prepare("insert into comments (name, comment, date) values (?, ?, NOW())");
				$stmt->bind_param("ss",$name, $comment);
				$stmt->execute();
				$stmt->close();
			}
		}
		


	}
	if ($mysqli) {
	  //get all comments from table
      $sql = 'select name, comment, date from comments order by date desc';
	  $res=$mysqli->query($sql);
	  if($res){
	  	// there are rows in the table
		while($rowHolder = mysqli_fetch_array($res,MYSQLI_ASSOC)){
			$records[] = $rowHolder;
		}
        //   var_dump($records);
	  }
	}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
        
        <!-- ===== CSS ===== -->
        <link rel="stylesheet" href="../assets/css/styles.css">
		  <link rel="stylesheet" href="../assets/css/comment.css">
		

        <title>Home</title>
    </head>
	<header class="header">
            <a href="#" class="header__logo">RLIU Java</a>

            <i class='bx bx-menu header__toggle' id="header-toggle"></i>

            <nav class="nav" id="nav-menu">
                <div class="nav__content bd-grid">
                    <a href="" class="nav__perfil">
                        <div class="nav__img">
                            <img src="assets/img/perfil.jpg" alt="">
                        </div>
                        
                        <div>
                            <span class="nav__name">RLiu Java</span>
                          
                        </div>
                    </a>
    
                    <div class="nav__menu">
                        <ul class="nav__list">
                            <li class="nav__item"><a href="#" class="nav__link">Home</a></li>
    
                            <li class="nav__item dropdown">
                                <a href="#" class="nav__link dropdown__link">About<i class='bx bx-chevron-down dropdown__icon'></i></a>
                                    
    
                                <ul class="dropdown__menu">
                                    <li class="dropdown__item"><a href="#" class="nav__link">What Is Java</a></li>
                                    <li class="dropdown__item"><a href="#" class="nav__link">Java Environment</a></li>
                                   
                                </ul>
                            </li>
    
                            

                            <li class="nav__item dropdown">
                                <a href="#" class="nav__link dropdown__link">Tutorial<i class='bx bx-chevron-down dropdown__icon'></i></a>
                                    
    
                                <ul class="dropdown__menu">
                                    <li class="dropdown__item"><a href="#" class="nav__link">Java basic syntax</a></li>
                                    <li class="dropdown__item"><a href="#" class="nav__link">Java objects and classes</a></li>
                                    <li class="dropdown__item"><a href="#" class="nav__link">Java basic data types and variable types</a></li>
                                </ul>
                            </li>
                               <li class="nav__item"><a href="#" class="nav__link">Quiz</a></li>
                            <li class="nav__item"><a href="#" class="nav__link active">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
<body>


	
		


<div class="content3">
		
		<h1>Tell me your comment </h1>
		
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>"  method="POST" id="form">
		<!-- name input -->	
		<div class="space"></div>
	    <div class="row">
	    	<span>Name:</span>
	        <input type="text" class="in" id="name" size="55" name="visitor" placeholder="Enter your name">
	        <label id="wname" class="lab"> name can't be empty</label>
	    </div>
	    <div class="space"></div>
	    <!-- comment input -->	
	    <div class="row">
	    	<span >Comment:</span>
	    	<label id="wcoment" class="lab"> Comment can't be empty</label>
	    	<div class="te">
	    		<textarea id="comment" name="comment" cols="68" rows="10" placeholder="Enter your comment"></textarea>
	    	</div>
	   		
	    </div>
	    <div class="space"></div>
	    <!-- submit button -->	
	    <div class="row">
	    	<input type="button" class="btn" id="sub" value="Submit comment" />
	    </div>
	    
	</form>
</div>


<div class="content2">
	<h1>Comments</h1>
	<div id="list">
		<!-- comments table -->	
		<table>
			<thead>
				<tr>
					<th>No</th>
					<th>Name</th>
					<th>Comment</th>
					<th>Date</th>
				</tr>
			</thead>
			<tbody>
				<?php
					// foreach row in table
					if(isset($records) && !empty($records)){
						foreach($records as $k =>$this_row){
							echo "<tr>";
							echo "<td class='no'>".($k+1)."</td>";
							echo "<td class='name'>".$this_row['name']."</td>";
							echo "<td>".$this_row['comment']."</td>";
							echo "<td class='date'>".$this_row['date']."</td>";
							echo "</tr>";
						}
					}
					
				?>
			</tbody>
		</table>
		<ul>
		
		</ul>
	</div>
</div>



</body>
</html>



