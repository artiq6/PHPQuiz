<!DOCTYPE html>
<html lang="pl">

<head>
    <?php
    include('head.php')
    ?>
    <title>Register</title>
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
        <h1 class="text-center">Register</h1>
        <label for="inputEmail" class="sr-only">Login</label>
        <input type="text" id="inputEmail" name="login" class="form-control" placeholder="Login" required autofocus autocomplete="off">
        <label for="inputPassword" class="sr-only">Password</label>
        <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <a href="login.php" class="text-primary">Alredy registered? Login.</a>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>

        <div>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                //database connection conf file
                require("Config.php");

                //post login and password
                $login = $_POST["login"];
                $password = $_POST["password"];

                //hashing password
                $passowrdHash = password_hash("$password", PASSWORD_DEFAULT);

                //insert user into table
                $sql = "INSERT INTO users (login,password) VALUES ('$login','$passowrdHash')";
                if ($conn->query($sql) === TRUE) {//succes
                    echo "<p class='text-success text-center'>Added user: $login to database</p>";
                    header("Location: login.php");
                } else {//user exists
                    echo "<p class='text-danger text-center'>User: $login exists<p>";
                }
                $conn->close();
            }
            ?>
        </div>
    </form>
</body>

</html>