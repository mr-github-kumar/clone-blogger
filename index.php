<?php include('process.php');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="img/blogger-lcon.png" />
    <title>Blogger</title>
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
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"
    />
    <link rel="stylesheet" href="css/style.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto&display=swap"
      rel="stylesheet"
    />
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
    
    <!----to dipsplay data---->
    <?php 
		 $query = "SELECT post_ID, post_Title, post_Body, author_Name, post_Views, (SELECT COUNT(comment_ID) FROM comment
		 WHERE post_ID = post.post_ID) AS post_Comments, post_Date, post_Image
		 FROM post";		
		
		$result = mysqli_query($con, $query);
		if($result === false){
			die ("Error: " . $sql . "<br>" . $con->error);
		}
			
	?>
    <!--*************************************************************TOP HEADING****************************************************************-->
    <div class="top-head">
      <div class="left-top-head">
        <div class="logo">
          <a href="#"
            ><img src="img/blogger-logo.png" height="30" alt="blogger logo"
          /></a>
        </div>
        <div class="page-title">
          <span>All posts</span>
        </div>
      </div>

      <div class="right-top-head">
        <div class="top-right-menu rounded-circle">
          <a href=""><i class="fas fa-ellipsis-v"></i></a>
          <a href=""><i class="fas fa-ellipsis-v"></i></a>
          <a href=""><i class="fas fa-ellipsis-v"></i></a>
        </div>

        <div class="profile-pic">
          <img
            src="img/sk1.png"
            class="rounded-circle"
            alt="User profile picture display"
            width="30"
            height="30"
          />
        </div>
      </div>
    </div>

    <!--*************************************************************TOP NAVIGATION************************************************************-->
    <div class="top-navigation col-12">
      <!-----------------------------------------------------------top left navigation------------------------------------------------------------->
      <div class="blog">
        <div class="dropdown">
          <button
            class="btn dropdown-toggle"
            id="dropdownMenuButton"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
          >
            Website Development
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <h6 class="dropdown-header">Your blogs</h6>
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <h6 class="dropdown-header">Deleted blogs</h6>
            <a class="dropdown-item" href="#" tabindex="-1" aria-disabled="true"
              >Web Development 2020</a
            >
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">New blog..</a>
          </div>
        </div>

        <a href="publish.php" id="view" class="view">View Blog</a>
      </div>

      <!-----------------------------------------------------------top center navigation------------------------------------------------------------->
      <div class="top-center-nav col-7">
        <div class="new-post-button">
          <a href="write.php">
            <button>
              New Post
            </button>
          </a>
        </div>
        <div class="blogger col-5">
          <img src="img/person.png" alt="person icon" />
          <span>Using Blogger as <strong>Shishir Kumar</strong></span>
        </div>
      </div>

      <!-----------------------------------------------------------top right navigation------------------------------------------------------------->
      <div class="label-search col-3">
        <div class="label-dropdown">
          <div class="dropdown">
            <button
              class="btn dropdown-toggle"
              type="button"
              id="dropdownMenuButton"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              All labels
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="#">All labels</a>
            </div>
          </div>
        </div>

        <div class="search-bar">
          <input
            type="text"
            class="form-control"
            id="placeicon"
            placeholder=" &#xf007;"
            aria-label="Username"
            aria-describedby="basic-addon1"
          />
        </div>
      </div>
    </div>

    <!--*************************************************************MAIN BLOG MANAGER**************************************************************-->
    <div class="blog-manager">
      <!----------------------------------------------------------List of side utility items--------------------------------------------------------->
      <div class="side-blog-utility">
        <div class="utility-item-top">
          <a href="publish.php">
            <span class="utility-item-icon">
              <i class="fas fa-newspaper"></i>
            </span>
            <span class="utility-item-title">Posts</span>
          </a>
          <a href="#">
            <span class="utility-item-icon">
              <i class="fas fa-chart-bar"></i>
            </span>
            <span class="utility-item-title">Stats</span>
          </a>
          <a href="#">
            <span class="utility-item-icon">
              <i class="fas fa-comment-alt"></i>
            </span>
            <span class="utility-item-title">Comments</span>
          </a>
          <a href="#">
            <span class="utility-item-icon">
              <i class="fas fa-dollar-sign"></i>
            </span>
            <span class="utility-item-title">Earnings</span>
          </a>
          <a href="#">
            <span class="utility-item-icon">
              <i class="far fa-copy"></i>
            </span>
            <span class="utility-item-title">Pages</span>
          </a>
          <a href="#">
            <span class="utility-item-icon">
              <i class="fas fa-columns"></i>
            </span>
            <span class="utility-item-title">Layout</span>
          </a>
          <a href="#">
            <span class="utility-item-icon">
              <i class="fas fa-paint-roller"></i>
            </span>
            <span class="utility-item-title">Theme</span>
          </a>
          <a href="#">
            <span class="utility-item-icon">
              <i class="fas fa-cog"></i>
            </span>
            <span class="utility-item-title">Settings</span>
          </a>
        </div>
        <div class="utility-item-bottom">
          <a href="#">
            <span class="utility-item-icon">
              <i class="fas fa-bookmark"></i>
            </span>
            <span class="utility-item-title">Reading List</span>
          </a>
          <a href="#">
            <span class="utility-item-icon">
              <i class="fas fa-question-circle"></i>
            </span>
            <span class="utility-item-title">Help and feedback</span>
          </a>
          <!-- Side Blog Button-->
          <button class="btn">Try another blogger!</button>
        </div>
        <div class="footer">
          <span><a href="#"> Terms of Service |</a> </span>
          <span id="footer-mid-span"><a href="">Privacy </a> </span>
          <span><a href="">| Content Policy </a> </span>
        </div>
      </div>

      <!----------------------------------------------------------List of posts and its setting toolbar--------------------------------------------------------->
      <div class="blog-post-detail">
        <div class="post-toolbar col-12">
          <div class="post-toolbar-left col-6">
            <div class="post-toolbar-check">
              <input
                type="checkbox"
                aria-label="Checkbox for following text input"
              />
            </div>
            <button
              class="btn dropdown-toggle"
              type="button"
              id="dropdownMenuButton1"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              <span class="page-toolbar"><i class="fas fa-tag"></i></span>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item toolbar-text-drop" href="#"
                >New labels...</a
              >
            </div>
            <a href="publish.php">
              <button type="button" class="btn toolbar-text posttool-norl-border">
                Publish
              </button>
            </a>
            
            <button
              type="button"
              id="revertButton"
              class="btn toolbar-text posttool-norl-border"
            >
              Revert to draft
            </button>
            <button type="button" class="btn posttool-nol-border">
              <span class="page-toolbar1"><i class="fas fa-trash"></i></span>
            </button>
          </div>
          <div
            class="post-toolbar-right col-6"
            role="group"
            aria-label="Second group"
          >
            <span class="post-count">1 of 3</span>
            <button
              type="button"
              class="btn post-toolbar-arrow"
              id="posttool-left-arrow"
            >
              <span class="page-toolbar1">
                <i class="fas fa-chevron-left"></i>
              </span>
            </button>
            <button
              class="btn dropdown-toggle post-toolbar-arrow posttool-norl-border"
              type="button"
              id="dropdownMenuButton2"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              <span class="toolbar-text">1</span>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item toolbar-text-drop" href="#">1...</a>
            </div>
            <button
              type="button"
              class="btn post-toolbar-arrow posttool-nol-border"
            >
              <span class="page-toolbar1"
                ><i class="fas fa-chevron-right"></i
              ></span>
            </button>

            <button
              class="btn dropdown-toggle"
              type="button"
              id="dropdownMenuButton3"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              <span>25</span>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item toolbar-text-drop" href="#">25</a>
            </div>
          </div>
        </div>

        <div class="post-list col-12">
          <!--**********************************************************LIST OF POST PUBLISHED**********************************************************-->
          <table class="table col-12">
            <tbody class="col-12">

              <?php
                  while ($row = $result -> fetch_assoc()):
              ?>
                <tr class="table-dropdown col-12">
                  <td width="5%">
                    <input type="checkbox" aria-label="Checkbox for following text input" />
                  </td>
                  <td width="35%">
                    <span class="table-post-title col-6">
                      <a href="#"><?php echo $row['post_Title']?></a>
                    </span>
                    <div class="table-hidden-menu">
                      <a href="write.php?edit=<?php echo $row['post_ID'];?>">Edit</a>
                      <a href="view.php?view=<?php echo $row['post_ID'];?>">View</a>
                      <a href="process.php?delete=<?php echo $row['post_ID'];?>">Delete</a>
                    </div>
                  </td>
                  <td width="20%">
                    <span class="table-post-title">
                      <a href="#"><?php echo $row['author_Name']?></a>
                    </span>
                  </td>
                  <td width="10%">
                    <span class="table-post-comment"><?php echo $row['post_Comments']?></span>
                    <i class="fas fa-comment-alt page-toolbar1"></i>
                  </td>
                  <td width="10%">
                    <span class="table-post-view"><?php echo $row['post_Views']?></span>
                    <i class="fas fa-eye page-toolbar1"></i>
                  </td>
                  <td width="20%">
                    <span class="table-post-date"><?php echo $row['post_Date']?></span>
                  </td>
                </tr>
              <?php endwhile;?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </body>
</html>
