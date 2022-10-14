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

$mysqli->close();
?>
<!DOCTYPE php>
<php lang="en">
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
</head>
<style>
    /* START ANIMATION */
    /* Credit: followed and adapted tutorial by James Formica on Youtube */
        body {
        height: 100vh;
        background: linear-gradient(to bottom, #dbf5ff81, #aed9ea);
        overflow: hidden;
        }
        .cloud.three {
        top: 20%;
        width: 120px;
        height: 40px;
        animation-duration: 8s;
        }

        .cloud.two {
        top: 45%;
        width: 60px;
        height: 20px;
        animation-duration: 10s;
        }

        .cloud.four {
        top: 7%;
        margin-left:300px;
        width: 45px;
        height: 16px;
        animation-duration: 10s;
        }

        .cloud.five{
        top: -3%;
        margin-left:60%;
        width: 120px;
        height: 40px;
        animation-duration: 8s;
        }

        .cloud.six {
        top: 67%;
        margin-left:40px;
        width: 45px;
        height: 16px;
        animation-duration: 9s;
        }

        .cloud.seven {
        top: 67%;
        width: 120px;
        height: 40px;
        animation-duration: 30s;
        }

        .cloud.one {
        top: 85%;
        width: 250px;
        height: 80px;
        }

        .cloud {
        position: absolute;
        left: 0;
        background: white;
        border-radius: 1000px;
        animation: float 15s infinite linear;
        }

        .cloud::before {
        content: "";
        position: absolute;
        top: -80%;
        left: 10%;
        width: 50%;
        height: 150%;
        background: white;
        border-radius: 50%;
        }

        .cloud::after {
        content: "";
        position: absolute;
        top: -40%;
        right: 20%;
        width: 30%;
        height: 100%;
        background: white;
        border-radius: 50%;
        }

        @keyframes float {
            from {
                left: 0;
                transform: translateX(-100%);
                transform: translateY(10%);
            }

            to {
                left: 100%;
                transform: translateX(0%);
            }
        }
/* END ANIMATION */
    .submit-div{
        background-color: #ebf6fab3;
        padding:30px 15px;
        border: 1px solid #bbbbbb;
        font-family: 'Inconsolata', monospace;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
        margin-top: 150px;
        top:30%;
        position: relative;
    }
    #posts-col .row{
        width:90%;
        margin:0px auto;
    }
    #btn-row{
        padding-top: 10px;
    }
    .error{
        color:red;
        font-style:italic;
        visibility: hidden;
    }
    #posts-col{
        border-left: none;  
    }
    @media (max-width: 767px) {
        .simple-btn{
            font-size: 10px;
        }
        #posts-col{
            border-left: none;
            font-size: 14px;
            }
    }
    #btn-row{
        padding-top: 10px;
    }
</style>
<body>
<div class="cloud one"></div>
<div class="cloud two"></div>
<div class="cloud three"></div>
<div class="cloud four"></div>
<div class="cloud five"></div>
<div class="cloud six"></div>
<div class="cloud seven"></div>
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
                <div class="col" id="posts">
                    <div class="row">
                        <div class="submit-div">
                            <form id="submit-form" action="post_confirm.php" method="POST">
                                <label for="message-text" class="form-label">Share your thoughts here.</label>
                                <textarea class="form-control" id="message-text" name="message" placeholder="Lorem ipsum dolor sit amet. Eos cumque quia eum velit iusto id corporis sed repudiandae officiis et molestias dolores nam nostrum maiores ut atque aperiam. Et quia officia id voluptatem modi est nesciunt quos ab nostrum impedit quo debitis officia. Eos assumenda blanditiis sed dolores quaerat hic ipsum ipsa cum voluptatem magni a corporis magni. Ut accusantium voluptatum et delectus odio et laboriosam quaerat! Est explicabo tempora qui dolor quasi quo cumque odio! Rem sint nemo et cumque sunt u."rows="7"></textarea>
                                <small>max 500 characters</small>
                                <small id="e-msg" class="error">Error</small>
                                <div class="row justify-content-center" id="btn-row">
                                    <?php if( isset($_SESSION["logged_in"]) && $_SESSION["logged_in"]) :?>
                                        <div class="col-6 col-md-4"> 
                                            <button type="submit" class="btn simple-btn">post as <strong><?php echo $_SESSION["username"] ?></strong></button>
                                            <input type="hidden" name="user_id" value="<?php echo $_SESSION["user_id"] ?>">
                                        </div>
                                    <?php endif; ?>
                                    <div class="col-6 col-md-4">
                                        <button type="submit" name="anon" class="btn simple-btn">post as anonymous</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Javascript Validation
        document.querySelector("#submit-form").onsubmit = function(event) {
            
            let nameInput = document.querySelector("#message-text").value.trim();
            let errorMessage = document.querySelector("#e-msg");
            // Post cannot be empty
            if(nameInput.length < 1){
                event.preventDefault();
                errorMessage.style.visibility = "visible";
                errorMessage.innerHTML = "Post cannot be empty.";
            }
            //Post cannot be over 500 characters
            else if (nameInput.length > 500){
                event.preventDefault();
                errorMessage.style.visibility = "visible";
                errorMessage.innerHTML = "Post cannot be over 500 characters.";
            }
            else {
                errorMessage.style.visibility = "hidden";
            }
        }
    </script> 
</body>
</php>