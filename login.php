<!DOCTYPE html>
<html lang="pl">

<head>
    <?php
    include('head.php')
    ?>
    <title>Login</title>
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
        }

        .form-signin .form-control:focus {
            z-index: 2;
        }

        .form-signin input[type="text"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

        h1 {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <form class="form-signin" method="post">
        <h1 class="text-center">Login</h1>
        <label for="inputEmail" class="sr-only">Login</label>
        <input name="login" type="text" id="inputEmail" class="form-control" placeholder="Login" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <a href="register.php" class="text-primary">New user? Set up online access</a>
        <button class="btn btn-lg btn-primary btn-block mt-1" type="submit">Login</button>
        <div>
            <?php
             include("Config.php");

             //starting session 
             session_start();

            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                //post login and password
                $login = $_POST['login'];
                $password = $_POST['password']; 

                //hashing password
                $passowrdHash = password_hash("$password", PASSWORD_DEFAULT);

                //insert user into table
                $sql = "SELECT * FROM users WHERE login = '$login'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    // output data of each row
                    $row = $result->fetch_assoc();

                if (password_verify($password,  $row['password'])) {
                    echo "<p class='text-success text-center'>Login and password correct</p>";
                    $_SESSION['login_user'] = $login;
                    $_SESSION['admin']=$row['admin'];
                    header("Location: index.php");
                } else {
                    echo "<p class='text-danger text-center'>Password incorrect<p>";
                }
                }
                else {
                    echo "<p class='text-danger text-center'>Login incorrect<p>";
                }
                //$active = $row['active'];
            }
            ?>
        </div>
    </form>
    
</body>

</html>
