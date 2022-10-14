<?php
session_start();
$host = "303.itpwebdev.com";
$user = "asperez_user_db";
$password = "cherrycoke!";
$db = "asperez_floating_thoughts_db";

$mysqli = new mysqli($host, $user, $password, $db);
if ( $mysqli->connect_errno ) {
	echo $mysqli->connect_error;
	exit();
}

$mysqli->set_charset('utf8');

if(!$_GET["user_id"] && (!isset($_SESSION["logged_in"]) || !$_SESSION["logged_in"])) {
    header("Location: login.php");
}
else if(!$_GET["user_id"]){
    $user_id = $_SESSION["user_id"];
}
else{
    $user_id = $_GET["user_id"];
}

$post_sql = "SELECT message, posts.id AS p_id
FROM posts_has_users
JOIN posts
	ON posts_id = posts.id
JOIN users
	ON users_id = users.id
WHERE users_id =" .$user_id ."
ORDER BY posts_id ASC;";

$user_sql = "SELECT user_name, description
FROM users
WHERE id =" .$user_id .";";

$post_res = $mysqli->query($post_sql);
$user_res = $mysqli->query($user_sql);

if ( $post_res == false || $user_res == false) {
	echo $mysqli->error;
	exit();
}
// var_dump($post_res);
$user = $user_res->fetch_assoc();
$name = $user['user_name'];
$desc = $user['description'];

$mysqli->close();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Floating Thoughts: Watch your thoughts float away.</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400&display=swap" rel="stylesheet">    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        .profile-div{
            background-color:#ebf6fa;
            padding:30px 15px;
            border: 1px solid #bbbbbb;
            font-family: 'Inconsolata', monospace;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
            width:90%;
        }
        #submission-col{
            text-align: left;
        }
        #profile-img{
            margin-left: auto;
            margin-right: auto;
            width:115px;
            height:115px;
            border-radius: 50%;
            overflow: hidden;
        }
        #profile-img img{
            width:200px;
        }
        #user{
            padding-top: 10px;
        }
        #quote{
            margin-top: -10px;
        }
        .message{
            font-size: 14px;
        }
        #edit-div{
        width:40px;
        height:40px;
        border: 1px solid black;
        margin-left: auto;
        margin-right: 20px;
        border-radius: 50%;
        background: url(images/edit.png) no-repeat center;
        background-size: 25px;
        }
        #edit-div img{
            width:30px;
            opacity: 0%;
        }
        #edit-txt{
            padding-top: 10px;
        }
        @media (max-width: 767px) {
            #posts-col{
            border-left: none;
            }
            #edit-div{
                width:25px;
                height:25px;
                background-size: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid" id="inner">
        <!-- START content -->
        <div class="row justify-content-center" id="content">
                        <!-- START sidebar -->
                        <div class="col-4" id="side-col">
                <div id="side-div">
                    <div id="side" >
                        <!-- Title -->
                        <div id="title">
                            <a href="main.php">Floating Thoughts</a>
                        </div>
                        <!--  -->
                        <div id="logo">
                            <div id="logo-div"><img src="images/c.gif"/></div>
                        </div>
                        <!-- Description -->
                        <div id="description">
                            Breathe in. Let yourself feel everything you are feeling. Breathe out. Let it fade away until it dissapears.
                        </div>
                        <!-- Links -->
                        <div class="row justify-content-center" id="links">
                            <div class="col-4 col-md-3">
                            <?php if( isset($_SESSION["logged_in"]) && $_SESSION["logged_in"]) :?>
                                <a href="logout.php" target="_blank"><img class="icon" src="images/login.png"></a>
                                <div class="icon-name">logout</div>
                            <?php else: ?>
                                <a href="login.php" target="_blank"><img class="icon" src="images/login.png"></a>
                                <div class="icon-name">login</div>
                            <?php endif; ?>
                            </div>
                            <div class="col-4 col-md-3">
                                <a href="profile.php" target="_blank"><img class="icon" src="images/profile.png"></a>
                                <div class="icon-name">profile</div>    
                            </div>
                            <div class="col-4 col-md-3">
                                <a href="post.php" target="_blank"><img class="icon" src="images/message.png"></a>
                                <div class="icon-name">post</div>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-8" id="posts-col">
                <div class="profile-div">
                    <!-- Image -->
                    <?php if( isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] && $_SESSION["user_id"] == $user_id) :?>
                        <div id="edit-div">
                            <a href="edit.php?user_id=<?php echo $user_id ?>"><img src="images/edit.png"/></a>
                            <p id="edit-txt">edit</p>
                        </div>
                    <?php endif; ?>
                    <div id="profile-img">
                        <img src="images/c.gif"/>
                    </div>
                    <!-- Username + quote -->
                    <h4 id="user"><?php echo $name ?></h4>
                    <p id="quote"><?php echo $desc ?></p>
                    <div id="submission-col">
                        <p>Submissions</p>
                        <?php while ( $row = $post_res->fetch_assoc() ) : ?>
                            <div class="row" id="ooff">
                                <div id="bbb" class="col-12 col-md-10">
                                    <p class="message"><?php echo $row['message'] ?></p>
                                </div>
                                
                                <div class="col-2">
                                <?php if( isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] && $_SESSION["user_id"] == $user_id) :?>
                                    <a href="delete.php?post_id=<?php echo $row['p_id'] ?>" class="btn simple-btn">delete</a>
                                <?php endif; ?>    
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>