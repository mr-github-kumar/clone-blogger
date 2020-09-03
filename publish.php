<?php include('process.php');?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" type="image/x-icon" href="img/blogger-lcon.png" />
        <title>Dashboard</title>
        <link
        href="https://fonts.googleapis.com/css2?family=Caveat&family=Montserrat:wght@400;600&display=swap"
        rel="stylesheet"
        />
        <link rel="stylesheet" href="css/publish.css"/>
    </head>
    <body>       

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
            $query = "SELECT * FROM post";
			$result = mysqli_query($con, $query);			
        ?>

        <header>
            <div class="content-wrap">
                <div class="profile-pic">
                    <div></div>
                </div>
                <h1>Shishir Kumar</h1>
                <h2>UI/UX Designer + Web Developer</h2>
                <p>
                    As a developer, I specialize in creating modular and scalable
                    front-end architectures. As an blogger, I focus on creating
                    inclusive learning environments, instructor training and curriculum
                    development.
                </p>
                <p>
                    I’m also exploring more creative pursuits designing households
                    product and accessories for
                    <a href="http://shishirkumar.me" target="_blank">Shishir Kumar</a>.
                </p>
            </div>
        </header>

    <!-- ********************  POSTS********************* -->
        <div class="posts">
            <div class="content-wrap divider">
                <h2>Featured Posts</h2>
                <p>
                    View latest posts below. More information can be found at
                    <a href="http://shishirkumar.me">www.shishirkumar.me</a>.
                </p>

                <!-- posts 1 -->
                    

                <div class="project-item">
                    <?php
                        while ($row = $result -> fetch_assoc()):
                    ?>
                        <div class="publish-post-body">
                            <div class="publish-post-image">
                                <img src="<?php echo $row['post_Image']?>" alt="post image">
                            </div>

                            <div class="publish-post-info">
                                <h3> <?php echo $row['post_Title']?> </h3>
                                <p> <?php echo substr($row['post_Body'],0,200).'. . .'?> </p>
                            
                                <div class="publish-post-button">
                                    <a class="btn" href="view.php?read=<?php echo $row['post_ID'];?>">
                                        Read more....
                                    </a>
                                    <a class="btn" href="index.php">
                                        Related post
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>

                    <?php
                        function pre_r($array){
                            echo '<pre>';
                            print_r($array);
                            echo '</pre>';
                        }
                    ?>
                </div>
            </div>
        </div>
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
