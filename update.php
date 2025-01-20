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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DASHBOARD | Profile Template</title>
    <link rel="stylesheet" href="update.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container light-style flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-4">
            Account CENTER
        </h4>
        <div class="card overflow-hidden">
            <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush account-settings-links">
                        <a class="list-group-item list-group-item-action active" data-toggle="list"
                            href="#account-general">General</a>
                       
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="account-general">
                            <div class="card-body media align-items-center">
                                <img src="profile.png" alt
                                    class="d-block ui-w-80">
                             
                            </div>
                            <hr class="border-light m-0">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control mb-1" value="<?php echo $name; ?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Surname</label>
                                    <input type="text" class="form-control" value="<?php echo $surname; ?>">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Student number</label>
                                    <input type="text" class="form-control" value="<?php echo $studentNo; ?>">
                                </div>
                           
                            </div>
                        </div>
                        

                    </div>
                </div>
            </div>
        </div>
      
    </div>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">

    </script>
</body>

</html>