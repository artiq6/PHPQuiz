<?php
include('session.php');
if(!$_SESSION['admin'] == 1){
   header("location:index.php");
   die();
}
?>
<html>

<head>
   <?php
   include('head.php');
   ?>
   <title>Editor only for admin</title>
   <style>
      form {
         max-width: 960px;
      }
   </style>
</head>

<body>
   <?php
   include('nav.php');
   ?>
   <div class="container">
      <div class="d-flex justify-content-center">
         <h1 class="text-center">ADD QUESTION TO DATABASE:</h1>
      </div>
      <div class="d-flex justify-content-center">
         <form method="POST">
            <div class="form-group row mb-5">
               <div class="col">
                  <input name="question" type="text" class="form-control form-control-lg" id="question" placeholder="Question" required>
               </div>
            </div>
            <div class="form-group row">
               <div class="col">
                  <input name="a" type="text" class="form-control" id="answerA" placeholder="answer a" required>
               </div>
            </div>
            <div class="form-group row">
               <div class="col">
                  <input name="b" type="text" class="form-control" id="answerB" placeholder="answer b" required>
               </div>
            </div>
            <div class="form-group row">
               <div class="col">
                  <input name="c" type="text" class="form-control" id="answerC" placeholder="answer c" required>
               </div>
            </div>
            <div class="form-group row">
               <div class="col">
                  <input name="d" type="text" class="form-control" id="answerD" placeholder="answer d" required>
               </div>
            </div>
            <!-- RADIO -->
            <h6 class="text-center">Correct answer: </h6>
            <div class="col d-flex justify-content-center mb-5">
               <div class="form-check form-check-inline">
                  <input name="radio" class="form-check-input" type="radio" name="inlineRadioOptions" id="radioA" value="a" required>
                  <label class="form-check-label" for="radioA">a</label>
               </div>

               <div class="form-check form-check-inline">
                  <input name="radio" class="form-check-input" type="radio" name="inlineRadioOptions" id="radioB" value="b">
                  <label class="form-check-label" for="radioB">b</label>
               </div>

               <div class="form-check form-check-inline">
                  <input name="radio" class="form-check-input" type="radio" name="inlineRadioOptions" id="radioC" value="c">
                  <label class="form-check-label" for="radioC">c</label>
               </div>

               <div class="form-check form-check-inline">
                  <input name="radio" class="form-check-input" type="radio" name="inlineRadioOptions" id="radioD" value="d">
                  <label class="form-check-label" for="radioD">d</label>
               </div>
            </div>
            <!-- /RADIO -->

            <!-- SUB -->
            <div class="col d-flex justify-content-center">
               <button type="submit" class="btn btn-primary">Add</button>
            </div>
            <!-- /SUB -->
            <!-- PHP FUNCTION WITH ERRORS CODES -->
            <div class="col d-flex justify-content-center">
               <?php

               if ($_SERVER["REQUEST_METHOD"] == "POST") {
                  //database connection conf file
                  // include("Config.php");

                  //questions
                  $question = strval($_POST["question"]);

                  //answers
                  $a = strval($_POST["a"]);
                  $b = strval($_POST["b"]);
                  $c = strval($_POST["c"]);
                  $d = strval($_POST["d"]);

                  //radio correc answser
                  $radio = $_POST["radio"];

                  $sql = "INSERT INTO questions (question,a,b,c,d,correct) VALUES ('$question','$a','$b','$c','$d','$radio')";
                  if ($conn->query($sql) === TRUE) { //succes
                     echo "<p class='text-success text-center'>Added question to database</p>";
                  } else { //user exists
                     echo "<p class='text-danger text-center'>ERROR with question<p>";
                  }
               }

               ?>
            </div>

            <!-- /PHP FUNCTION WITH ERRORS CODES -->
         </form>
      </div>
      <div class="d-flex justify-content-center mt-5 mb-3">
         <h1 class="text-center">List of questions:</h1>
      </div>
      <div class="d-flex justify-content-center mb-5">
         <?php
         $sql = "SELECT * FROM questions WHERE 1";
         $result = $conn->query($sql);
         if ($result->num_rows > 0) {
            echo '
         <table id="questionsTable" class="table">
            <thead class="thead-dark">
               <tr>
                     <th scope="col">id</th>
                     <th scope="col">question</th>
                     <th scope="col">a</th>
                     <th scope="col">b</th>
                     <th scope="col">c</th>
                     <th scope="col">d</th>
                     <th scope="col">correct</th>
                  </tr>
               </thead>
            <tbody>';
            while ($row = $result->fetch_assoc()) {
               echo '<tr>
                     <th scope="row">' . $row['id'] . '</th>
                     <td>' . $row['question'] . '</td>
                     <td>' . $row['a'] . '</td>
                     <td>' . $row['b'] . '</td>
                     <td>' . $row['c'] . '</td>
                     <td>' . $row['d'] . '</td>
                     <td>' . $row['correct'] . '</td>
                  </tr>';
            }
            echo ' </tbody></table>';
         } else {
            echo ("NO QUESTIONS");
         }
         $conn->close();
         ?>
      </div>

   </div>
   <?php include('scripts.php'); ?>
   <script>
      $(document).ready(function() {
         $('#questionsTable').SetEditable({
            columnsEd: "0,1,2,3,4,5,6",
            onEdit: function(columnsEd) {
               var empId = columnsEd[0].childNodes[1].innerHTML;
               var question = columnsEd[0].childNodes[3].innerHTML;
               var a = columnsEd[0].childNodes[5].innerHTML;
               var b = columnsEd[0].childNodes[7].innerHTML;
               var c = columnsEd[0].childNodes[9].innerHTML;
               var d = columnsEd[0].childNodes[11].innerHTML;
               var correct = columnsEd[0].childNodes[13].innerHTML;

               $.ajax({
                  type: 'POST',
                  url: "questionAction.php",
                  dataType: "application/json",
                  data: {
                     id: empId,
                     question: question,
                     a: a,
                     b: b,   
                     c: c,
                     d: d,
                     correct: correct,
                     action: 'edit'
                  },
                  success: function(response) {
                     if (response.status) {}
                  }
               });
            },
            onBeforeDelete: function(columnsEd) {
               var empId = columnsEd[0].childNodes[1].innerHTML;
               $.ajax({
                  type: 'POST',
                  url: "questionAction.php",
                  dataType: "application/json",
                  data: {
                     id: empId,
                     action: 'delete'
                  },
                  success: function(response) {
                     if (response.status) {}
                  }
               });
            },
         });
      });
   </script>
</body>

</html>