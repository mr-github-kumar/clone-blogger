<?php include('process.php');?>
<?php 
    
    if (isset($_SESSION['message'])): ?>

	<div class="alert alert-<?$_SESSION['msg_Type']?>">
		<?php
			echo $_SESSION['message'];
			unset($_SESSION['message']);
		?>
	</div>
<?php endif ?>
<?php 
    if(isset($_GET['id'])){
        $post_ID = $_GET['id'];
		$query = "SELECT * FROM post WHERE post_ID=$post_ID";
		$result = mysqli_query($con, $query);
        if ($result==true){
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
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" type="image/x-icon" href="img/blogger-lcon.png" />
        <title>Post</title>
        <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
        crossorigin="anonymous"
        />
        <script
        src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"
        ></script>
        <script
        src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"
        ></script>
        <script
        src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"
        ></script>
        <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="css/view.css"/>
    </head>
    <body>
        <!-------------------------------Top Heading------------------------->
        <div class="top-head">
            <div class="left-top-head">
                <div class="page-logo">
                    <a href="#"> 
                    <img src="img/blogger-logo.png" height="30" alt="blogger logo"/> 
                    </a>
                </div>
            </div>

            <div class="right-top-head">
                <div class="top-right-menu">
                    <a href=""><i class="fas fa-ellipsis-v"></i></a>
                    <a href=""><i class="fas fa-ellipsis-v"></i></a>
                    <a href=""><i class="fas fa-ellipsis-v"></i></a>
                </div>

                <div class="profile-pic">
                    <img src="img/sk1.png" class="rounded-circle"
                    alt="User profile picture display"
                    width="30"
                    height="30" />
                </div>
            </div>
        </div>

        <form action="process.php" method="POST">
            <input type="hidden" name='post_ID' value ="<?php echo $post_ID ?>">
            
            <header>
                <div class="content-wrap">
                    <div class="post-pic">
                        <img src="<?php echo $row['post_Image']?>" class="rounded-circle" width="100"
                    height="100" alt="post image">
                    </div>
                    <h1><?php echo $row['post_Title']?></h1>
                </div>
            </header>

        <!-- ********************  POSTS********************* -->
            <div class="publish-post-info">
                <div class="main-post-body"> <?php echo $row['post_Body']?> </div>
                <div class="publish-post-comment">
                    <label>Add Comment:</label>
                    <div class="comment-body">
                        <textarea aria-label="" aria-describedby="basic-addon1" name="comment_Body"
                        autocomplete="off" rows="2" cols="50"> 
                        </textarea>
                        <div class="comment-btn">
                            <input class="btn" type="submit" name="postComment" value="Post Comment"/>
                            <a class="btn" href="publish.php">
                                Go Back
                            </a>
                        </div>
                    </div>
                </div>
                <?php if(isset($resultComments)) {
                 while($row = mysqli_fetch_assoc($resultComments)){ ?>
                    <div class="comment-list">
                        <i class="fa fa-user"></i>
                        <p><?php echo $row['comment_Body'];?> <br/>                           
                        </p>
                    </div>
                <?php } } ?>
            </div>
        </form>
        <footer>
            <h3>Let's Keep in Touch!</h3>
            <ul class="contact-list">
                <li>
                    <a href="mailto:email@example.com">contact@shishirkumar.me</a>
                </li>
                <li>
                    <a href="http://shishirkumar.me" target="_blank"> www.s hishirkumar.me </a>
                </li>
                <li>
                    <a href="#" target="_blank">Twitter</a>
                </li>
                <li><a href="#" target="_blank">LinkedIn</a></li>
            </ul>
        </footer>
    </body>
</html>
