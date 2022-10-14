<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
        height: 100vh;
        background: linear-gradient(to bottom, skyblue, cornflowerblue);
        overflow: hidden;
        }

        .cloud.one {
        top: 50%;
        width: 300px;
        height: 100px;
        }

        .cloud.two {
        top: 30%;
        width: 60px;
        height: 20px;
        animation-duration: 10s;
        }

        .cloud.three {
        top: 20%;
        width: 120px;
        height: 40px;
        animation-duration: 8s;
        }

        .cloud {
        position: absolute;
        left: 0;
        background: white;
        border-radius: 1000px;
        animation: zoomies 5s infinite linear;
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

        @keyframes zoomies {
        from {
            left: 0;
            transform: translateX(-100%);
        }

        to {
            left: 100%;
            transform: translateX(0%);
        }
        }

    </style>
</head>
<body>
<div class="cloud one"></div>
<div class="cloud two"></div>
<div class="cloud three"></div>
</body>
</html>