<?php
session_start();

if (!isset($_SESSION['studentNo'])) {
    
    header('Location: login.php');
    exit; 
}


$studentNo = $_SESSION['studentNo'];
$name = $_SESSION['name'];
$id = $_SESSION['id'];
$surname = $_SESSION['surname'];


?>
<?php
require "db.php";

$moduleName = $moduleCode = $moduleCredits = $numWeeks = $hoursClass = $startDate = $endDate = $term = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize user inputs
    $moduleName = filter_var($_POST['moduleName'], FILTER_SANITIZE_STRING);
    $moduleCode = filter_var($_POST['moduleCode'], FILTER_SANITIZE_STRING);
    $moduleCredits = filter_var($_POST['moduleCredits'], FILTER_VALIDATE_INT);
    $numWeeks = filter_var($_POST['numWeeks'], FILTER_VALIDATE_INT);
    $hoursClass = filter_var($_POST['hoursClass'], FILTER_VALIDATE_INT);
    $startDate = filter_var($_POST['startDate'], FILTER_SANITIZE_STRING);
    $endDate = filter_var($_POST['endDate'], FILTER_SANITIZE_STRING);
    $term = filter_var($_POST['term'], FILTER_SANITIZE_STRING);
    

    // Perform input validations
    if (empty($moduleName)) {
        $errors[] = "Module Name is required.";
    }
    if (empty($moduleCode)) {
        $errors[] = "Module Code is required.";
    }
    if ($moduleCredits <= 0) {
        $errors[] = "Module Credits must be a positive integer.";
    }
    if ($numWeeks <= 0) {
        $errors[] = "Number of Weeks must be a positive integer.";
    }
    if ($hoursClass < 0) {
        $errors[] = "Hours of Class must be a non-negative integer.";
    }

    // If there are no validation errors, insert the data into the database
    if (empty($errors)) {
        $hoursToStudy = (($moduleCredits * 10) / $numWeeks) - $hoursClass;
        $hoursStudied = 0;
        $sql = "INSERT INTO modules (moduleName, moduleCode, moduleCredits, numWeeks, hoursClass, startDate, endDate, term, hoursToStudy, hoursStudied, studentNumber)
        VALUES ('$moduleName', '$moduleCode', $moduleCredits, $numWeeks, $hoursClass, '$startDate', '$endDate', '$term', $hoursToStudy, $hoursStudied, '$studentNo')";
        if ($conn->query($sql) === TRUE) {
            header('Location: success.php');
        } else {
            echo "Error: " . $conn->error;
        }

        $conn->close();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Dashboard</title>
 
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700");

    * {
      margin: 0;
      padding: 0;
      outline: none;
      border: none;
      text-decoration: none;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    body {
      background: #dfe9f5;
    }

    .container {
      display: flex;
    }
    .button-container {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }
    
    .button-container button {
        border-radius: 20px;
        cursor: pointer;
        font-weight: 900;
        box-shadow: 6px 6px 6px #cbced1, -6px -6px 6px white;
        background: #1DA1F2;
        color: white;
        transition: 0.5s;
        width: 440px;
        height: 50px;
        justify-content: space-between;
    }
    
    .button-container button:hover {
        box-shadow: none;
    }
    .button-container button i {
        margin-right: 10px; 
        padding-left: 17px;
      padding-right: 17px;
      padding-top: 6px;
      padding-bottom: 6px;
    
     border-radius: 5px;
      line-height: 30px;
    
      background: #dde1e7;
      box-shadow: 2px 2px 5px #babecc,
                  -5px -5px 10px #ffffff73;
    }
    
    

    nav {
      position: relative;
      top: 0;
      bottom: 0;
height: 120vh;
      left: 0;
      background: #fff;
      width: 280px;
      overflow: hidden;
      box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1);
    }

    .logo {
      text-align: center;
      display: flex;
      margin: 10px 0 0 10px;
    }

    .logo img {
      width: 45px;
      height: 45px;
      border-radius: 50%;
    }

    .logo span {
      font-weight: bold;
      padding-left: 15px;
      font-size: 18px;
      text-transform: uppercase;
    }

    a {
      position: relative;
      color: rgb(85, 83, 83);
      font-size: 14px;
      display: table;
      width: 280px;
      padding: 10px;
    }

    nav .fas {
      position: relative;
      width: 100px;
      height: 40px;
      top: 14px;
      font-size: 20px;
      text-align: center;
      margin-left: -15px;
    }

    .nav-item {
      position: relative;
      top: 12px;
      margin-left: -15px;
    }

    a:hover {
      background: #eee;
    }

    .logout {
      position: absolute;
      bottom: 0;
    }

    .main {
      position: relative;
      padding: 20px;
      width: 100%;
    }

    .main-top {
      display: flex;
      width: 100%;
    }

    .main-top i {
      position: absolute;
      right: 0;
      margin: 10px 30px;
      color: rgb(110, 109, 109);
      cursor: pointer;
    }

    .main-skills {
      display: flex;
      margin-top: 20px;
    }

    .main-skills .card {
      width: 25%;
      margin: 10px;
      background: #fff;
      text-align: center;
      border-radius: 20px;
      padding: 10px;
      box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1);
    }

    .main-skills .card h3 {
      margin: 10px;
      text-transform: capitalize;
    }

    .main-skills .card button {
      background: #1DA1F2;
      color: #fff;
      padding: 7px 15px;
      border-radius: 10px;
      margin-top: 15px;
      cursor: pointer;
    }

    .main-skills .card button:hover {
      background: rgb(28, 98, 179);
    }

    .main-skills .card i {
      font-size: 22px;
      padding: 10px;
    }

    .main-course {
      margin-top: 20px;
      text-transform: capitalize;
    }

    .course-box {
      width: 100%;
      height: 100%;
      padding: 10px 10px 30px 10px;
      margin-top: 10px;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1);
    }

    .course-box ul {
      list-style: none;
      display: flex;
    }

    .course-box ul li {
      margin: 10px;
      color: gray;
      cursor: pointer;
    }

    .course-box ul .active {
      color: #000;
      border-bottom: 1px solid #000;
    }

    .course-box .course {
      display: flex;
    }

    .box {
      width: 33%;
      padding: 10px;
      margin: 10px;
      border-radius: 10px;
      background: rgb(235, 233, 233);
      box-shadow: rgb(28, 98, 179);
    }

    .box p {
      font-size: 12px;
      margin-top: 5px;
    }

    .box button {
      background: rgb(28, 98, 179);
      color: #fff;
      padding: 7px 10px;
      border-radius: 10px;
      margin-top: 3rem;
      cursor: pointer;
    }

    .box button:hover {
      background:#fff;
    }

    .box i {
      font-size: 7rem;
      float: right;
      margin: -20px 20px 20px 0;
    }

    .html {
      color: rgb(25, 94, 54);
    }

    .css {
      color: rgb(104, 179, 35);
    }

    .js {
      color: rgb(28, 98, 179);

    }
    


.form-field {
    margin: 10px 0;
}


.form-field label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}


.form-field input[type="text"],
.form-field input[type="number"],
.form-field input[type="date"],
.form-field select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
}


.button-container {
    text-align: center;
    margin-top: 20px;
}



#addModule:hover {
    background-color: #45a049;
}

  </style>
</head>


<body>
  <div class="container">
    <nav>
      <ul>
        <li>
          <a href="#" class="logo">
           
            <span class="nav-item">Study Tracker</span>
          </a>
        </li>
        <li>
          <a href="dashboard.php">
            <i class="fas fa-home"></i>
            <span class="nav-item">Home</span>
          </a>
        </li>
        
        <li>
          <a href="addModule.php">
            <i class="fas fa-book"></i>
            <span class="nav-item">Add A Module</span>
          </a>
        </li>
        
        <li>
          <a href="update.php">
            <i class="fas fa-user"></i>
            <span class="nav-item">Profile</span>
          </a>
        </li>
        
        <li>
          <a href="About.html">
            <i class="fas fa-question-circle"></i>
            <span class="nav-item">About</span>
          </a>
        </li>
        
        <li>
          <a href="logout.php" class="logout">
            <i class="fas fa-sign-out-alt"></i>
            <span class="nav-item">Log out</span>
          </a>
        </li>
      </ul>
    </nav>

    <section class="main">
      <div class="main-top">
       
      <p>Welcome to the Study Tracker <?php echo $name." ".$surname; ?></p>
   
      </div>

      <section class="main-course">
        <h1>Module Study Tracker</h1>
        <div class="course-box">
         <p>Add A Module</p>
         <?php if (!empty($errors)): ?>
            <div class="errors">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

          <form action="" Method="POST"id="moduleScheduleForm">
          <div class="form-field">
                <label for="moduleName">Module Name:</label>
                <input type="text" id="moduleName" name="moduleName" placeholder="Module Name">
            </div>
            <div class="form-field">
                <label for="moduleCode">Module Code:</label>
                <input type="text" id="moduleCode" name="moduleCode" placeholder="Module Code">
            </div>
            <div class="form-field">
                <label for="moduleCredits">Module Credits:</label>
                <input type="number" id="moduleCredits" name="moduleCredits" placeholder="Module Credits">
            </div>
            <div class="form-field">
                <label for="numWeeks">Number of Weeks:</label>
                <input type="number" id="numWeeks" name="numWeeks" placeholder="Number of Weeks">
            </div>
            <div class="form-field">
                <label for="moduleHours">Hours In Class Per Week:</label>
                <input type="number" id="moduleHours" name="hoursClass" placeholder="Module Hours">
            </div>
            <div class="form-field">
                <label for="startDate">Start Date:</label>
                <input type="date" id="startDate" name="startDate">
            </div>
            <div class="form-field">
                <label for="endDate">End Date:</label>
                <input type="date" id="endDate" name="endDate">
            </div>
        
            <div class="form-field">
                <label for="term">Term:</label>
                <select name="term" id="term">
                    <option disabled selected value="0">Select</option>
                    <option value="1st">1st Semester</option>
                    <option value="2nd">2nd Semester</option>
                </select>
            </div>
        
            <div class="button-container">
                <button id="addModule" type="submit">Add Module</button>
            </div>
  </form>
          </div>
        </div>
      </section>
    </section>
  </div>
</body>

</html>





