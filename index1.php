<?php 
session_start();

$name = "ali";
$age = 20;

setcookie("test", "welcome", time() + 20);

if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
    $errors = [];

    // Firstname validation
    if (!isset($_POST["firstname"]) || strlen($_POST["firstname"]) <= 0) {
        array_push($errors, "Firstname is required");
    } elseif (strlen($_POST["firstname"]) < 4) {
        array_push($errors, "Firstname should be more or equal to 4 characters");
    }

    // Lastname validation
    if (!isset($_POST["lastname"]) || strlen($_POST["lastname"]) <= 0) {
        array_push($errors, "Lastname is required");
    } elseif (strlen($_POST["lastname"]) < 4) {
        array_push($errors, "Lastname should be more or equal to 4 characters");
    }

    // Email validation
    if (!isset($_POST["email"]) || strlen($_POST["email"]) <= 0) {
        array_push($errors, "E-mail is required");
    } elseif (strlen($_POST["email"]) > 125) {
        array_push($errors, "E-mail should be less or equal to 125 characters");
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $email = htmlspecialchars($_POST["email"]);
        array_push($errors, "E-mail ($email) is not valid");
    }

    // Username validation
    if (!isset($_POST["username"]) || strlen($_POST["username"]) <= 0) {
        array_push($errors, "Username is required");
    } elseif (strlen($_POST["username"]) < 6) {
        array_push($errors, "Username should be more or equal to 6 characters");
    }

    // Password validation
    if (!isset($_POST["password"]) || strlen($_POST["password"]) <= 0) {
        array_push($errors, "Password is required");
    } elseif (strlen($_POST["password"]) < 6) {
        array_push($errors, "Password should be more or equal to 6 characters");
    } elseif (strlen($_POST["password"]) > 100) {
        array_push($errors, "Password should be less than 100 characters");
    }

    // Retype password validation
    if (!isset($_POST["retpassword"]) || strlen($_POST["retpassword"]) <= 0) {
        array_push($errors, "Retype Password is required");
    } elseif (strlen($_POST["retpassword"]) < 6) {
        array_push($errors, "Retype Password should be more or equal to 6 characters");
    } elseif (strlen($_POST["retpassword"]) > 100) {
        array_push($errors, "Retype Password should be less than 100 characters");
    }

    // Password match validation
    if (strcmp($_POST["password"], $_POST["retpassword"]) != 0) {
        array_push($errors, "Password and Retype Password do not match");
    }

    // Bio validation
    if (strlen($_POST["bio"]) > 1000) {
        array_push($errors, "Bio should be less than 1000 characters");
    }

    // If there are no errors, process the login
    if (empty($errors)) {
        $_SESSION["login1"] = true;
        header("Location:logout.php");
        exit;
    }
    if (count($errors) <= 0) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        session_start();
        $_SESSION["username"] = $username;
        $_SESSION["login1"] = true;

        header("Location:login1.php");
        exit;
    }
    
} 
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Create Account</title>
        <link rel="icon" type="image/x-icon" href="C:\Users\Shery\Desktop\open.jpg">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <style>
            input[type=text], input[type=password] {
                width: 100%;
                padding: 12px 20px;
                margin: 8px 0;
                display: inline-block;
                border: 1px solid #ccc;
                box-sizing: border-box;
                border-radius: 15px;
            }
            button {
                background-color: #04AA6D;
                color: white;
                padding: 14px 20px;
                margin: 8px 0;
                border: none;
                cursor: pointer;
                width: 100px;
            }
            .submit {
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .form-label {
                padding: 1px;
                margin: 8px;
                display: inline-block;
            }
            button:hover {
                opacity: 0.8;
            }
            .exit {
                width: auto;
                padding: 10px 18px;
                background-color: #f44336;
                border: none;
            }
            span {
                float: right;
                padding: 16px;
            }
            .dateb {
                width: 20%;
                padding: 10px;
                margin: 10px;
            }
            .selectg {
                padding: 10px;
                margin: 10px;
                width: 20%;
            }
            #bio {
                padding: 10px;
                margin: 10px;
                width: 50%;
                height: 20%;
            }
            .form_style {
                border: 3px solid #f1f1f1;
                margin: 100px;
            }
        </style>
    </head>

    <body>
        <div>
            <div class="form_style">
                <?php if (isset($errors) && !empty($errors)) { ?>
                    <div style="width:300px; padding: 14px 20px; margin: auto; background-color: rgba(255, 99, 71, 0.5);">
                        <ul style="list-style-type:none;">
                            <?php foreach($errors as $error) { ?>
                                <li><?php echo $error; ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>

                <form action="" method="POST" novalidate>

                    <div>
                        <p>Create Account</p>
                    </div> <br>

                    <div class="first">
                        <label for="firstname" class="form-label">Firstname</label>
                        <input type="text" class="form-control" name="firstname"> <br><br>
                    </div>

                    <div class="last">
                        <label for="lastname" class="form-label">Lastname</label>
                        <input type="text" class="form-control" name="lastname"> <br><br>
                    </div>

                    <div class="gender">
                        <label for="username" class="form-label">Gender</label> <br>
                        <select class="selectg" name="gender">
                            <option value="" selected disabled></option>
                            <option value="1">Female</option>
                            <option value="2">Male</option>
                            <option value="3">Other</option>
                        </select>
                    </div><br><br>

                    <div class="birth">
                        <label for="date" class="form-label">Birthday</label> <br>
                        <input type="date" class="dateb" name="birthday"> <br>
                    </div>
                    <br><br>
                    
                    <div class="email">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="text" class="form-control" name="email"> <br><br>
                    </div>

                    <div class="username">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username"> <br><br>
                    </div>

                    <div class="pass">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password"> <br><br>
                    </div> <br>

                    <div class="pass">
                        <label for="retpassword" class="form-label">Retype Password</label><br>
                        <input type="password" class="form-control" name="retpassword"> <br>
                    </div> <br>

                    <div class="bio">
                        <label for="bio" class="form-label">Bio</label><br><br>
                        <textarea name="bio" id="bio" cols="30" rows="10">text bio</textarea>
                    </div>
                    <br><br>

                    <div class="submit">
                        <button type="submit" class="btn" name="register">Register</button>
                    </div>

                    <div>
                        <button type="button" class="exit" name="logout">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
