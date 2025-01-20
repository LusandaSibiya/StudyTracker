<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
</head>
<body class="align">
<?php
if (isset($_POST['loginBtn'])) {
    require "db.php";

    $studentNo = $_POST['studentNo'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM students WHERE studentNumber = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $studentNo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];

        if ($password == $hashedPassword) {
          session_start();

           
            $_SESSION['studentNo'] = $studentNo;
            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['surname'] = $row['surname'];
          header('Location: dashboard.php');
      } else {
          echo "Password doesn't match. Given password: $password, Hashed Password: $hashedPassword";
      }
      
    } else {
        echo "User not found. Please check your student number.";
    }

    $stmt->close();
    $conn->close();
}
?>
  <div class="grid">
    <h2>Study Tracker</h2>
    <h2>Login</h2>
    <form action="" method="POST" class="form login">
      <div class="form__field">
        <label for="studentNo"><svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use></svg><span class="hidden">Student Number</span></label>
        <input id="studentNo" type="text" name="studentNo" class="form__input" placeholder="Student Number" required>
      
      </div>
      <div class="form__field">
      
        <label for="password"><svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lock"></use></svg><span class="hidden">Password</span></label>
        <input id="password" type="password" name="password" class="form__input" placeholder="Password" required >
      </div>
      <div class="form__field">
        <input type="submit" name="loginBtn" value="Login">
      </div>
    </form>
    <p class="text--center">Not a student? <a href="index.php">Register now</a> <svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="assets/images/icons.svg#arrow-right"></use></svg></p>
  </div>
  <svg xmlns="http://www.w3.org/2000/svg" class="icons">
    <symbol id="arrow-right" viewBox="0 0 1792 1792">
    
    </symbol>
    <symbol id="lock" viewBox="0 0 1792 1792">
      
    </symbol>
    <symbol id="user" viewBox="0 0 1792 1792">
      
    </symbol>
  </svg>
</body>
</html>
