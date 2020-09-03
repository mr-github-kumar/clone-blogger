<?php
    session_start();
	$con = mysqli_connect('localhost','root','root');

	createDatabase();
	
	//select your database
    mysqli_select_db($con,'blogger');	
	
	createTables();
    
    $post_ID = 0;
    $update = false;
    $post_Title='';
    $post_Body='';

    //Blog Edit Page-Save Button
    //to save post in datatbase when click save button
    if (isset($_POST['save'])){
        $post_Title = $_POST['post_Title'];
        $post_Body = $_POST['post_Body'];
        
        //upload image
        $files = $_FILES['file'];
        $fileName = $files['name'];
        $fileError = $files['error'];
        $fileTmp = $files['tmp_name'];

        //seperate name and extension of file using explode 
        $fileExt = explode('.', $fileName);
        $fileCheck = strtolower(end($fileExt));

        //allow type of file extension to upload
        $fileExtStored = array('jpg','jpeg','png','pdf');

        //check the file to allow if have allowed extension
        if (in_array($fileCheck, $fileExtStored )){
            //define file destination
            $fileDestination = 'uploadImg/'.$fileName;

            //move file from temprory location to new location
            move_uploaded_file($fileTmp, $fileDestination );
			$sql = "INSERT INTO post(post_Image,post_Title,post_Body) VALUES ('$fileDestination','$post_Title','$post_Body')";
			
			if ($con->query($sql) === FALSE) {
			  echo "Error: " . $sql . "<br>" . $con->error;
			}
        }

        $_SESSION['message'] = "Record has been saved!";
        $_SESSION['msg_type'] = "success";
        
        header("location:index.php");//user will directed to main page after click 
    }

    if (isset($_POST['publish'])){
        header("location:publish.php");

    }
    if (isset($_POST['close'])){
        header("location:index.php");
    }

    //Main Page - Delete link
    //To delete data from database when click delete button 
    if (isset($_GET['delete'])){
        $post_ID = $_GET['delete'];
        
		$sql = "DELETE FROM post WHERE post_ID=$post_ID";
			
		if ($con->query($sql) === FALSE) {
		  die("Error: " . $sql . "<br>" . $con->error);
		}        

        $_SESSION['message'] = "Record has been deleted!";
        $_SESSION['msg_type'] = "danger";
        
        header("location:index.php"); //user will directed to same page
    }

    //Main Page - Edit link
    //To edit data from database when click edit link
    if (isset($_GET['edit'])){
        $post_ID = $_GET['edit'];
        $update=true;
		
		$sql = "SELECT * FROM post WHERE post_ID=$post_ID";
			
		$result = $con->query($sql);
			
		if ($result === FALSE) {
		  die ("Error: " . $sql . "<br>" . $con->error);
		} 
		else{		
            $row = $result -> fetch_array();
            $post_Title = $row['post_Title'];
            $post_Body = $row['post_Body'];
		}
    }

    if (isset($_POST['update'])){
        $post_ID = $_POST['post_ID'];
        $post_Title = $_POST['post_Title'];
        $post_Body = $_POST['post_Body'];  
        
		$sql = "UPDATE post SET post_Title = '$post_Title', post_Body = '$post_Body' WHERE post_ID=$post_ID";
			
		if ($con->query($sql) === FALSE) {
		  die("Error: " . $sql . "<br>" . $con->error);
		}        

        $_SESSION['message'] = "Record has been updated!";
        $_SESSION['msg_type'] = "warning";
        
        header("location:index.php");
    }

    //Dashboard - direct to post 
    if (isset($_GET['read']) || isset($_GET['view'])){
		if(isset($_GET['read']))
			$post_ID = $_GET['read'];
		elseif(isset($_GET['view']))
		    $post_ID = $_GET['view'];
	   
		$sql = "SELECT * FROM post WHERE post_ID=$post_ID";
			
		$result = $con->query($sql);
			
		if ($result === FALSE) {
		  die ("Error: " . $sql . "<br>" . $con->error);
		} 
		else{		
            $row = $result -> fetch_array();
            $post_Title = $row['post_Title'];
            $post_Body = $row['post_Body'];
		}
		
		$query = "SELECT * FROM comment WHERE post_ID = $post_ID";
		$resultComments = mysqli_query($con, $query);
		
		if ($resultComments==false){
            die ("Error: " . $sql . "<br>" . $con->error);
        }
    }    

    if (isset($_POST['postComment'])){
        $post_ID = $_POST['post_ID'];
        $comment_Body = $_POST['comment_Body'];
        
		$sql = "INSERT INTO comment (comment_Body,post_ID) VALUES('$comment_Body','$post_ID')";
			
		if ($con->query($sql) === FALSE) {
		  die("Error: " . $sql . "<br>" . $con->error);
		}
        
        $_SESSION['message'] = "comment has been posted!";
        $_SESSION['msg_type'] = "success";
        
        header("location:view.php?id=$post_ID");
    }
	
	function createDatabase(){		
				
		$sql = "CREATE DATABASE IF NOT EXISTS blogger";
		
		global $con;
		
		if ($con->query($sql) == FALSE) {
		  die("Error creating database: " . $con->error);
		}
	}
	
	function createTables(){	
		global $con;
		$val = mysqli_query($con,'select 1 from post LIMIT 1');
		
		if(!$val){
			$sql = "CREATE TABLE post (
				post_ID INT AUTO_INCREMENT PRIMARY KEY,
				post_Title VARCHAR(200) NULL,
				post_Body TEXT NULL,
				author_Name VARCHAR(200) NOT NULL,
				post_Views INT DEFAULT 0,
				post_Comments INT DEFAULT 0,
				post_Date TIMESTAMP,
				post_Image VARCHAR(200) NOT NULL)";
			
			
			if ($con->query($sql) == FALSE) {
			  die("Error creating table: " . $con->error);
			}
			
			$sql3 = "INSERT INTO post(post_Image,post_Title,post_Body) VALUES ('uploadImg/css3_logo.png','CSS','Cascading Style Sheets (CSS) is a style sheet language used for describing the presentation of a document written in a markup language like HTML.[1] CSS is a cornerstone technology of the World Wide Web, alongside HTML and JavaScript.
			CSS is designed to enable the separation of presentation and content, including layout, colors, and fonts.[3] This separation can improve content accessibility, provide more flexibility and control in the specification of presentation characteristics, enable multiple web pages to share formatting by specifying the relevant CSS in a separate .css file, and reduce complexity and repetition in the structural content.
			Separation of formatting and content also makes it feasible to present the same markup page in different styles for different rendering methods, such as on-screen, in print, by voice (via speech-based browser or screen reader), and on Braille-based tactile devices. CSS also has rules for alternate formatting if the content is accessed on a mobile device. ')";
			
			if ($con->query($sql3) === FALSE) {
			  die("Error: " . $sql . "<br>" . $con->error);
			}		
		}

		$val1 = mysqli_query($con,'select 1 from comment LIMIT 1');
		
		if(!$val1){
			$sql1 = "CREATE TABLE comment (
				comment_ID INT AUTO_INCREMENT PRIMARY KEY,
				comment_Body TEXT NOT NULL,
				post_ID INT NOT NULL,
				FOREIGN KEY (post_ID) REFERENCES post(post_ID)  ON UPDATE CASCADE ON DELETE CASCADE)";
			
			
			if ($con->query($sql1) == FALSE) {
			  die("Error creating table: " . $con->error);
			}
		}

		
	}

?>