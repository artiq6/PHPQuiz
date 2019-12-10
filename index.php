<?php
include('session.php');
?>
<html>

<head>
   <?php
   include('head.php');
   ?>
   <title>Welcome </title>
</head>

<body>
   <?php
   include('nav.php');
   ?>
   <div class="container mt-3 col-sm-9">
      <div class="jumbotron">
         <h1 class="display-4">Hello, <?php echo $_SESSION['login_user']; ?>!</h1>
         <p class="lead">Welcome in QUIZ</p>
         <hr class="my-4">
         <p>Click button "QUIZ" to start game</p>
         <p class="lead">
            <a class="btn btn-primary btn-lg" href="quiz.php" role="button">QUIZ</a>
         </p>
      </div>
   </div>
   <h1 class="display-4 text-center">Najtrudniejsze Pytania</h1>
   <!-- SQL HARDEST QUESTIONS -->
   <?php
   echo '
   <div class="container col-sm-9 d-flex justify-content-center">
   <table class="table">
      <thead class="thead-dark">
         <tr>
            <th scope="col">#</th>
            <th scope="col">pytanie</th>
            <th scope="col">% poprawnych</th>
         </tr>
      </thead>
      <tbody>
      ';
   $sql = "SELECT question, round(`correct_answers`/`all_answers`*100) as percent FROM `questions` where correct_answers>0 ORDER BY percent LIMIT 5";
   $result = $conn->query($sql);
   if ($result->num_rows > 0) {
      $i = 0;
      // output data of each row
      while ($row = $result->fetch_assoc()) {
         //+1 to all_answers
         $i++;
         echo
            '
         <tr>
            <th scope="row">' . $i . '</th>
            <td>' . $row["question"] . '</td>
            <td>' . $row["percent"] . '%</td>
         </tr>
        ';
      }
   }
   echo '
      </tbody>
   </table></div>';
   ?>
   <!-- /SQL HARDEST QUESTIONS -->
    <!-- /SQL BEST USERS  -->
      <h1 class="display-4 text-center">Top użytkownicy</h1>
   <?php
   echo '
   <div class="container col-sm-9 d-flex justify-content-center">
   <table class="table">
      <thead class="thead-dark">
         <tr>
            <th scope="col">#</th>
            <th scope="col">login</th>
            <th scope="col">% poprawnych</th>
         </tr>
      </thead>
      <tbody>
      ';
   $sql = "SELECT login, round(`correct_answers`/`all_answers`*100) as percent FROM `users` where correct_answers>0 ORDER BY percent DESC LIMIT 10";
   $result = $conn->query($sql);
   if ($result->num_rows > 0) {
      $i = 0;
      // output data of each row
      while ($row = $result->fetch_assoc()) {
         //+1 to all_answers
         $i++;
         echo
            '
         <tr>
            <th scope="row">' . $i . '</th>
            <td>' . $row["login"] . '</td>
            <td>' . $row["percent"] . '%</td>
         </tr>
        ';
      }
   }
   echo '
      </tbody>
   </table></div>';
   ?>
   <?php
   include('scripts.php')
   ?>

</body>

</html>