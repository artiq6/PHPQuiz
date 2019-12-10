<?php
echo '
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">Quiz</a>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="quiz.php">quiz</a>
      </li>';
if ($_SESSION['admin'] == 1){
  echo '
  <li class="nav-item">
    <a class="nav-link" href="editor.php">Editor</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="users.php">User List</a>
  </li>';
}
  echo '
  </ul>
  <a class="nav-link color-primary" href="#">' . $_SESSION["login_user"] . '</a>
        <a href="logout.php" class="btn btn-outline-danger my-2 my-sm-0">Logout</a>
        </div></nav>';
