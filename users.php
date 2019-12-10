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
   <title>User Editor only for admin</title>
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
         <h1 class="text-center">Users List:</h1>
      </div>
      <div class="d-flex justify-content-center mb-5">
         <?php
         $sql = "SELECT id, login, admin FROM users WHERE 1";
         $result = $conn->query($sql);
         if ($result->num_rows > 0) {
            echo '
         <table id="usersTable" class="table">
            <thead class="thead-dark">
               <tr>
                     <th scope="col">id</th>
                     <th scope="col">login</th>
                     <th scope="col">admin rights</th>
                     <th scope="col">edit me</th>
                  </tr>
               </thead>
            <tbody>';
            while ($row = $result->fetch_assoc()) {
               echo '<tr>
                     <th scope="row">' . $row['id'] . '</th>
                     <td>' . $row['login'] . '</td>
                     <td>' . $row['admin'] . '</td>
                  </tr>';
            }
            echo ' </tbody></table>';
         } else {
            echo ("NO USERS");
         }
         $conn->close();
         ?>
      </div>

   </div>
   <?php include('scripts.php'); ?>
   <script>
      $(document).ready(function() {
         $('#usersTable').SetEditable({
            columnsEd: "0,1,2",
            onEdit: function(columnsEd) {
               var empId = columnsEd[0].childNodes[1].innerHTML;
               var login = columnsEd[0].childNodes[3].innerHTML;
               var admin = columnsEd[0].childNodes[5].innerHTML;
               $.ajax({
                  type: 'POST',
                  url: "./actions/userAction.php",
                  dataType: "application/json",
                  data: {
                     id: empId,
                     login:login,
                     admin:admin,
                     action: 'edit'
                  },
                  success: function(response) {
                     if (response.status) {console.log(response)}
                  }
               });
            },
            onBeforeDelete: function(columnsEd) {
               var empId = columnsEd[0].childNodes[1].innerHTML;
               $.ajax({
                  type: 'POST',
                  url: "./actions/userAction.php",
                  dataType: "json",
                  data: {
                     id: empId,
                     action: 'delete'
                  },
                  success: function(response) {
                     if (response.status) {console.log(response)}
                  }
               });
            },
         });
      });
   </script>
</body>

</html>