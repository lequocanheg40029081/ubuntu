<?php

require_once "./mvc/core/redirect.php";
require_once "./mvc/core/constant.php";
$redirect = new redirect();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= $title ?></title>
    <base href="">
    <!-- Bootstrap -->

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">

    <style media="screen">
        *,
        *:before,
        *:after {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #080710;
        }

        .background {
            width: 430px;
            height: 520px;
            position: absolute;
            transform: translate(-50%, -50%);
            left: 50%;
            top: 50%;
        }

        .background .shape {
            height: 200px;
            width: 200px;
            position: absolute;
            border-radius: 50%;
        }

        .shape:first-child {
            background: linear-gradient(#1845ad,
                    #23a2f6);
            left: -80px;
            top: -80px;
        }

        .shape:last-child {
            background: linear-gradient(to right,
                    #ff512f,
                    #f09819);
            right: -30px;
            bottom: -80px;
        }

        form {
            height: 520px;
            width: 400px;
            background-color: rgba(255, 255, 255, 0.13);
            position: absolute;
            transform: translate(-50%, -50%);
            top: 50%;
            left: 50%;
            border-radius: 10px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
            padding: 50px 35px;
        }

        form * {
            font-family: 'Poppins', sans-serif;
            color: #ffffff;
            letter-spacing: 0.5px;
            outline: none;
            border: none;
        }

        form h3 {
            font-size: 32px;
            font-weight: 500;
            line-height: 42px;
            text-align: center;
        }

        label {
            display: block;
            margin-top: 30px;
            font-size: 16px;
            font-weight: 500;
        }

        input {
            display: block;
            height: 50px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.07);
            border-radius: 3px;
            padding: 0 10px;
            margin-top: 8px;
            font-size: 14px;
            font-weight: 300;
        }

        ::placeholder {
            color: #e5e5e5;
        }

        button {
            margin-top: 50px;
            width: 100%;
            background-color: #ffffff;
            color: #080710;
            padding: 15px 0;
            font-size: 18px;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
        }

        .social {
            margin-top: 30px;
            display: flex;
        }

        .social div {
            background: red;
            width: 150px;
            border-radius: 3px;
            padding: 5px 10px 10px 5px;
            background-color: rgba(255, 255, 255, 0.27);
            color: #eaf0fb;
            text-align: center;
        }

        .social div:hover {
            background-color: rgba(255, 255, 255, 0.47);
        }

        .social .fb {
            margin-left: 25px;
        }

        .social i {
            margin-right: 4px;
        }
    </style>
</head>

<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <?php if (isset($_SESSION['flash'])) { ?>
        <p class="text-success"><?= $redirect->setFlash('flash'); ?></p>
    <?php } ?>
    <?php if (isset($_SESSION['errors'])) { ?>
        <p class="text-danger"><?= $redirect->setFlash('errors'); ?></p>
    <?php } ?>

    <form action="auth/signup" method="post">
        <h3>Sign up</h3>

        <label for="username">Fullname</label>
        <input type="text" name="data_post[name]" class="form-control" placeholder="Full name" required />



        <label for="username">Username</label>
        <input type="text" name="data_post[username]" class="form-control" placeholder="Username" pattern="[a-zA-Z ]+"
            required />


        <label for="password">Password</label>
        <input type="password" name="data_post[password]" class="form-control" placeholder="Password"
            pattern="[a-zA-Z-0-9]+" required />
 
        <div>
            <?php if (isset($_SESSION['errors'])) { ?>
                <h4 class="text-danger"><?= $redirect->setFlash('errors'); ?></h4>
            <?php } ?>
            <button class="btn btn-primary">Sign up</button>

            <button class="" a href="http://localhost:8088/shopping/dang-nhap.html">Login</button>
            <div class="social">
                <div class="go"><i class="fab fa-google"></i> Google</div>
                <div class="fb"><i class="fab fa-facebook"></i> Facebook</div>
            </div>
    </form>
    </div>

</body>

</html>