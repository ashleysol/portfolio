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

$sql = "SELECT message, user_name, users_id, posts.id AS p_id
FROM posts_has_users
JOIN posts
	ON posts_id = posts.id
JOIN users
	ON users_id = users.id
ORDER BY posts_id DESC;";

$results = $mysqli->query($sql);

if ( $results == false ) {
	echo $mysqli->error;
	exit();
}

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
        /* Posts */
        #posts-col .row .post{
            background-color:#ebf6fa;
            border-radius: 0 10px 10px 10px;
            margin-bottom:25px;
            padding: 15px;
            border: 1px solid #bbbbbb;
            font-family: 'Inconsolata', monospace;
            max-width: 800px;
        }
        #posts-col .row .post p{
            margin:0px;
        }
        .simple-btn{
            background-color: #aed9ea;
            border: 1px solid #80adbc;
            font-size: 14px;
            padding:2% 2%;
        }
        @media (max-width: 767px) {
            #posts-col{
            border-left: none;
            font-size: 14px;
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
                <?php while ( $row = $results->fetch_assoc() ) : ?>
                    <div class="row">
                        <div class="post">
                            <?php 
                            $name = $row['user_name'];
                            if($row['users_id'] == 1){
                                echo "<p>" . $name . "</p>";
                            }
                            else{
                                echo '<a class="username" href="profile.php?user_id=' . $row['users_id'] . '">' . $name . '</a>';
                            }
                            ?>
                            <p class="message"><?php echo $row['message']; ?></p>
                            <?php if( isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] && $_SESSION["user_id"] == 1) :?>
                                <a href="delete.php?post_id=<?php echo $row['p_id'] ?>" class="btn simple-btn">delete</a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</body>
</html>