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

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Dashboard</title>
  <link rel="stylesheet" href="style.css" />
  
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

    nav {
      position: relative;
      top: 0;
      bottom: 0;
      height: 100vh;
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
      height: 300px;
      padding: 10px 10px 30px 10px;
      margin-top: 10px;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1);
    }
    .custom-table {
    border: 2px solid #ccc;
    border-collapse: collapse;
    width: 100%;
}

.custom-table th, .custom-table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

.custom-table th {
    background-color: #f2f2f2;
}

.custom-table tr:nth-child(even) {
    background-color: #f2f2f2;
}

.custom-table tr:hover {
    background-color: #ddd;
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
    
.add-button {
    background-color: #007BFF; 
    color: #fff; 
    border: none;
    padding: 8px 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    border-radius: 4px;
    cursor: pointer;
}

.add-button:hover {
    background-color: #0056b3; 
}
.DONE {
    color: white;
    background-color: green;
}

.STILL {
    color: black;
    background-color: yellow;
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
          <a href="AboutUs.html">
            <i class="fas fa-question-circle"></i>
            <span class="nav-item">About Us</span>
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
       
      <p>Welcome to the Dashboard, <?php echo $name." ".$surname; ?></p>
   
      </div>

      <section class="main-course">
        <h1>Module Study Tracker</h1>
        <div class="course-box">
          <ul>
            <li class="active">My Modules</li>
            
          </ul>
          <div class="course">
          <?php
require "db.php";


$sql = "SELECT id, moduleName, moduleCode, moduleCredits, term, hoursToStudy, hoursStudied FROM modules WHERE studentNumber = $studentNo";

$result = $conn->query($sql);
?>

<table class="custom-table table table-striped">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Code</th>
            <th scope="col">Credits</th>
            <th scope="col">Term</th>
            <th scope="col">Hours To Study</th>
            <th scope="col">Hours Left To Study</th>
            <th scope="col">Hours Studied</th>
            <th scope="col">Studying Status</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row["moduleName"] . '</td>';
                echo '<td>' . $row["moduleCode"] . '</td>';
                echo '<td>' . $row["moduleCredits"] . '</td>';
                echo '<td>' . $row["term"] . '</td>';
                echo '<td>' . $row["hoursToStudy"] . '</td>';
                $hoursToStudy = $row["hoursToStudy"];
            $hoursStudied = $row["hoursStudied"];
            $hoursLeftToStudy = $hoursToStudy - $hoursStudied;
                echo '<td>' . $hoursLeftToStudy . '</td>';
                echo '<td>' . $row["hoursStudied"] . '</td>';
                
                   
            
            
            
   
$status = ($hoursLeftToStudy === 0) ? 'DONE' : 'STILL';

echo '<td class="' . $status . '">' . $status . '</td>';

                 
                 if ($hoursLeftToStudy === 0) {
                  echo '<td><button class="add-button hidden" >Add</button></td>';
              } else {
                echo '<td><a href="edit.php?id=' . $row["id"] . '" class="add-button">Add</a></td>';

              } 
                echo '</tr>';
            }
        }
        ?>
    </tbody>
</table>

<?php
$conn->close();
?>

</div>
            
          </div>
        </div>
      </section>
    </section>
  </div>
</body>

</html>





