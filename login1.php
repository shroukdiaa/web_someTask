<?php
session_start();

if (isset($_SESSION["login1"]) && $_SESSION["login1"]) {
    header("Location: user.php");
    exit;
}

if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
    $errors = [];

    // Validation for Username
    if (empty($_POST["username"])) {
        $errors[] = "Username is required";
    } elseif (strlen($_POST["username"]) < 6) {
        $errors[] = "Username should be 6 characters or more";
    }

    // Validation for Password
    if (empty($_POST["password"])) {
        $errors[] = "Password is required";
    } elseif (strlen($_POST["password"]) < 6) {
        $errors[] = "Password should be 6 characters or more";
    } elseif (strlen($_POST["password"]) > 100) {
        $errors[] = "Password should be less than 100 characters";
    }

    // If no errors, proceed with login
    if (empty($errors)) {
        $_SESSION["username"] = $_POST["username"];
        $_SESSION["login1"] = true;

        header("Location: user.php");
        exit;
    } else {
        $_SESSION["errors"] = $errors;
        header("Location: login1.php");
        exit;
    }
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="C:\Users\Shery\Desktop\img_avatar2.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
        }
        input[type=text], input[type=password] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            display: inline-block;
            border: 1px solid #9993ecaf;
            border-radius: 12px;
            box-sizing: border-box;
        }
        .butsub {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 12px;
            background-color: #04AA6D;
        }
        button:hover {
            opacity: 0.8;
        }
        
        span.psw {
            float: right;
            padding-top: 16px;
        }
        .cancel {
            padding: 20px 0;
        }
        form {
            margin: 10px;
            border: 0px solid #f1f1f1;
            padding: 20px;
            background-color: white;
        }
        .divForm {
            border: 1px solid #f1f1f1;
            justify-content: center;
            align-items: center;
            width: 500px;
        }
        .login {
            margin: 10px;
            padding: 10px;
        }
        .create1 {
            text-align: center;
            justify-content: center;
            align-items: center;
            margin: 5px;
            padding: 2px;
        }
        @media screen and (max-width: 300px) {
            span.psw {
                display: block;
                float: none;
            }
        }
    </style>
</head>
<body>
    <div class="form_style">
        <?php if (isset($_SESSION["errors"]) && count($_SESSION["errors"]) > 0): ?>
            <div style="width:300px; padding: 14px 20px; margin: auto; background-color: rgba(255, 99, 71, 0.5);">
                <ul style="list-style-type:none;">
                    <?php foreach ($_SESSION["errors"] as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php unset($_SESSION["errors"]); // Clear errors after displaying ?>
            </div>
        <?php endif; ?>

        <div class="forms">
            <form action="" method="post">
                <div class="login">
                    <p style="font-size: 30px; padding:5px; text-align:center;"><b>Login</b></p> <br><br>
                    <div class="divForm">
                        <div>
                            <label for="username" class="username"><b>Username</b></label> <br><br>
                            <input type="text" placeholder="Enter Username" name="username" class="inpUser"> <br><br><br>
                        </div>
                        <div>
                            <label for="password"><b>Password</b></label><br><br>
                            <input type="password" placeholder="Enter Password" name="password" class="inppass"> <br><br><br>
                        </div>
                        <div>
                            <button type="submit" name="login1" class="butsub">Login</button> <br>
                        </div>
                        <div class="create1">
                            <label name="create">
                                <a href="index1.php"><h5>create account</h5></a>
                            </label>
                        </div>
                        
                        <div class="cancel">
                            <span class="psw">Forgot <a href="#">password?</a></span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
