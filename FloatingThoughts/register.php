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
    <style>
        .profile-div{
            background-color:#ebf6fa;
            padding:15px 15px;
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
                                <a href="login.php" target="_blank"><img class="icon" src="images/login.png"></a>
                                <div class="icon-name">login</div>
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
                    <form id="reg-form" action="register_confirm.php" method="POST">
                        <div class="row mb-3">
                            <div class="font-italic text-danger col-sm-9 ml-sm-auto">
                               <!-- errors -->
                            </div>
                        </div>
                        <!-- username -->
                        <div class="form-group row">
                            <label for="username-id" class="col-sm-3 col-form-label text-sm-right">Username:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="username-id" name="username">
                                <div class="error">Error</div>
                            </div>
                        </div>
                        <!-- password -->
                        <div class="form-group row">
                            <label for="password-id" class="col-sm-3 col-form-label text-sm-right">Password:</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="password-id" name="password">
                                <div class="error">Error</div>
                            </div>
                        </div>
                        <!-- buttons -->
                        <div class="form-group row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9 mt-2">
                                <button type="submit" class="btn simple-btn">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        // Javascript Validation
        document.querySelector("#reg-form").onsubmit = function(event) {
            // Username cannot be empty
            let nameInput = document.querySelector("#username-id").value.trim();
            if(nameInput.length < 1){
                event.preventDefault();
                let errorMessage = document.querySelector("#username-id").nextElementSibling;
                errorMessage.style.visibility = "visible";
                errorMessage.innerHTML = "Username cannot be empty.";
            }
            else {
                let errorMessage = document.querySelector("#username-id").nextElementSibling;
                errorMessage.style.visibility = "hidden";
            }

            // Password cannot be empty
            let passInput = document.querySelector("#password-id").value.trim();
            if(nameInput.length < 1){
                event.preventDefault();
                let errorMessage = document.querySelector("#password-id").nextElementSibling;
                errorMessage.style.visibility = "visible";
                errorMessage.innerHTML = "Password cannot be empty.";
            }
            else {
                let errorMessage = document.querySelector("#password-id").nextElementSibling;
                errorMessage.style.visibility = "hidden";
            }
        }
    </script> 
</body>
</php>