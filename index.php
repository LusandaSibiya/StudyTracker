<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
</head>
<body class="align">
<?php
if (isset($_POST['registerBtn'])) {
    require "db.php";

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $studentNumber = $_POST['studentNumber'];
    $password = $_POST['password']; 

    
    $sql = "INSERT INTO students (name, surname, studentNumber, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $surname, $studentNumber, $password);

    if ($stmt->execute()) {
        header('Location: login.php');
    } else {
        echo "Error: " . $stmt->error;
    }

    
    $stmt->close();
    $conn->close();
}
?>
  <div class="grid">
    <h2>Study Tracker</h2>
    <h2>Register</h2>
    <form action="" method="POST" class="form login">
      <div class="form__field">
        <label for="name"><svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use></svg><span class="hidden">Name</span></label>
        <input id="name" type="text" name="name" class="form__input" placeholder="Name" required>
      </div>
      <div class="form__field">
        <label for="surname"><svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use></svg><span class="hidden">Surname</span></label>
        <input id="surname" type="text" name="surname" class="form__input" placeholder="Surname" required>
      </div>
      <div class="form__field">
        <label for="studentNumber"><svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use></svg><span class="hidden">Student Number</span></label>
        <input id="studentNumber" type="text" name="studentNumber" class="form__input" placeholder="Student Number" required>
      </div>
      <div class="form__field">
        <label for="password"><svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lock"></use></svg><span class="hidden">Password</span></label>
        <input id="password" type="password" name="password" class="form__input" placeholder="Password" required>
      </div>
      <div class="form__field">
        <input type="submit" name="registerBtn" value="Register">
      </div>
    </form>
    <p class="text--center">Already a student? <a href="login.php">Login</a> <svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="assets/images/icons.svg#arrow-right"></use></svg></p>
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


