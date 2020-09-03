<?php include('process.php');?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link
        rel="icon"
        type="image/x-icon"
        href="img/blogger-lcon.png"
        />
        <title>Edit</title>
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
        <link rel="stylesheet" href="css/style.css" />
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

        <!---------------------------Top Navigation-------------------------->
        <form action="process.php" method="POST" enctype="multipart/form-data">
        <!--Hidden Input type for update button to call data from database-->
            <input type="hidden" name='post_ID' value ="<?php echo $post_ID; ?>">

            <div class="post-editor-navigation">
                <div class="blog-title">
                    <a href="">Website Development</a>
                </div>

                <div class="post-search-textarea">
                    <span id="post-search-head">
                        Post
                    </span>
                    <input type="text" class="form-control" placeholder="Enter post title" aria-label="Username" aria-describedby="basic-addon1"
                    name="post_Title" autocomplete="off" value="<?php echo $post_Title; ?>"/>
                </div>

                <div class="blogger">
                <img src="img/person.png" alt="person icon" />
                <span>Using Blogger as <strong>Shishir Kumar</strong></span>
                </div>

                <div class="post-editor-button">
                    <a href="publish.php"><button id="publish-button" name="publish">Publish</button></a>

                    <?php
                        if ($update == true):    
                    ?>
                        <a href=""><button type="submit" name="update">Update</button></a>
                        <?php else: ?>
                        <a href=""><button type="submit" name="save">Save</button></a>
                    <?php endif; ?>

                    <a href=""><button>Preview</button></a>
                    <a href="index.php"><button name="close">Close</button></a>
                </div>
            </div>

            <!-------------------------Blog post Manager------------------------->
                <div class="blog-post-manager col-12">
                <!--------------------Post-page-editor------------------------------->
                    <div class="post-page-edit col-9">
                        <div class="post-page-toolbar">
                            <div class="page-toolbar-button col-2">
                                <a href=""><button id="toolbar-compose-button">Compose</button></a>
                                <a href=""><button>HTML</button></a>
                            </div>

                            <div class="page-toolbar-select col-2">
                                <span class="select-text-head">
                                    <select class="custom" id="inputGroupSelect01">
                                        <option selected> Type </option>
                                        <option value="1">Roboto</option>
                                        <option value="2">Arial</option>
                                        <option value="3">Time-roman</option>
                                    </select>
                                </span>

                                <span class="select-text-size">
                                    <select class="custom" id="inputGroupSelect01">
                                        <option selected>Size</option>
                                        <option value="10">10</option>
                                        <option value="12">12</option>
                                        <option value="14">14</option>
                                    </select>
                                </span>
                            </div>
                            
                            <div class="page-toolbar-font col-3">
                                <span class="page-toolbar">
                                    <i class="fas fa-bold"></i>
                                </span>

                                <span class="page-toolbar">
                                    <i class="fas fa-italic"></i>
                                </span>

                                <span class="page-toolbar">
                                    <i class="fas fa-underline"></i>
                                </span>

                                <span class="page-toolbar">
                                    <i class="fas fa-eraser"></i>
                                </span>
                                                            
                            </div>
                            <!---
                            
                            
                            <div class="page-toolbar-paragraph col-2">
                                <span class="page-toolbar"><i class="fas fa-align-left"></i></span>
                                <span class="page-toolbar"><i class="fas fa-align-center"></i></span>
                                <span class="page-toolbar"><i class="fas fa-align-right"></i></span>
                                <span class="page-toolbar"><i class="fas fa-align-justify"></i></span>
                            </div>

                            <div class="page-toolbar-action col-1">
                                <span class="page-toolbar"><i class="fas fa-undo"></i></span>
                                <span class="page-toolbar"><i class="fas fa-redo"></i></span>
                            </div>
                            --->

                            <div class="page-toolbar-media col-2">
                                <input type="file" for ="" name="file" value="<?php echo $row['post_Image'];?>" multiple="" class="page-toolbar"></input>
                            </div>
                            
                        </div>
                        <div class="post-page-area col-12">
                            <div class="post-page-text col-8">
                                <textarea class="form-control" aria-label="" aria-describedby="basic-addon1" name="post_Body"
                                autocomplete="off" rows="14" cols="50"> 
                                    <?php echo $post_Body;?>
                                </textarea>
                            </div>
                        </div>
                    </div>
            </form>
            <!---------------------right-side-utility------------------>
            <div class="right-side-utility">
                <div class="dropdown">
                    <button
                    class="btn"
                    type="button"
                    id="dropdownMenu2"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                    >
                        <span class="side-utility-heading">
                        <i class="fas fa-caret-right"> </i>
                        </span>
                        <span class="side-utility-heading">Post settings</span>
                    </button>
                    <div class="dropdown-menu border-0" aria-labelledby="dropdownMenu2">
                        <button class="dropdown-item" type="button">
                        <span class="side-utility-itme">
                        <i class="fas fa-tag"> </i>
                        </span>
                        Lables
                        </button>

                        <button class="dropdown-item" type="button">
                        <span class="side-utility-itme">
                        <i class="fas fa-clock"> </i>
                        </span>
                        Schedule
                        </button>

                        <button class="dropdown-item" type="button">
                        <span class="side-utility-itme">
                        <i class="fas fa-link"> </i>
                        </span>
                        Permalink
                        </button>

                        <button class="dropdown-item" type="button">
                            <span class="side-utility-itme">
                                <i class="fas fa-map-marker-alt"></i>
                            </span>
                            Location
                        </button>

                        <button class="dropdown-item" type="button">
                            <span class="side-utility-itme">
                                <i class="fas fa-cog"> </i>
                            </span>
                            Options
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
