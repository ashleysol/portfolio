<?php
session_start();
if ( !isset($_POST['message']) || empty($_POST['message'])) {

	// Missing required fields.
	$error = "Invalid Post.";

} 
else {
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

    if ( isset($_POST['anon'])) {
		$user_id = 1;
	} else {
		$user_id = $_POST['user_id'];
	}

    $message_sql = "INSERT INTO posts (message)
    VALUES ('" . $_POST['message'] . "');";

    $id_sql = "SELECT id
    FROM posts
    WHERE message = '" . $_POST['message'] . "';";
    
    
    $message_res = $mysqli->query($message_sql);
	if ( !$message_res) {
		echo $mysqli->error;
		exit();
	}
    $id_res = $mysqli->query($id_sql);
    if ( !$id_res) {
		echo $mysqli->error;
		exit();
	}

    $id_res = $id_res->fetch_assoc();
    $mess_id = $id_res['id'];

    $add_sql = "INSERT INTO posts_has_users (posts_id, users_id)
    VALUES (" . $mess_id . "," . $user_id . ");";
    $add_res = $mysqli->query($add_sql);
	if ( !$add_res) {
		echo $mysqli->error;
		exit();
	}
}
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
            padding:15px 15px 5px 15px;
            border: 1px solid #bbbbbb;
            font-family: 'Inconsolata', monospace;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
            width:90%;
            margin-top: 200px;
            margin-bottom: 200px;
            text-align: center;
        }
        .simple-btn{
            padding:2% 8%;
            margin-top: 15px;
        }
        .error{
            color:red;
            font-size:14px;
            font-style:italic;
            margin-bottom:10px;
            visibility: hidden;
        }

    @media (max-width: 767px) {
        .profile-div{
            font-size: 14px;
        }
        #posts-col{
            border-left: none;
        }
        .error{
            font-size:12px;
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
                    <?php if ( isset($error) && !empty($error) ) : ?>
                        <div><?php echo $error; ?></div>
                    <?php else : ?>
                        <p>You have sent your thoughts into the world. Soon, they will fade away.</p>
                    <?php endif; ?>  
                </div>
            </div>
        </div>
    </div>
</body>
</html>