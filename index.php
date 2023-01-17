<?php //session_start(); 

require_once 'code.php';
$sql = "select * from admin_accounts";
$data = mysqli_query($con, $sql);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" conte nt="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <title>Document</title>
</head>

<body>

    <div class="container-entry">
        <div class="row">
            <div class="col-md-12">

                <?php
                if (isset($_SESSION['status'])) {
                ?>

                    <div class="alert alert-warning alert-dismissible fade show" role="alert" alert-dismissible data-bs-dismiss="alert">
                        <strong>Bing Chilling!</strong> You inserted some deta in detabes.
                        <button type="button" data-bs-dismiss="alert" class="btn-close  aria-label=" Close"></button>
                    </div>


                <?php
                    unset($_SESSION['status']);
                }
                ?>

                <div class="card-header">
                    <h4>INSERT DATA INTO DATABASE IN PHP</h4>
                </div>
                <div class="card-body">

                    <!-- form kung san sesend ang input to code.php -->
                    <form action="code.php" method="POST">
                        <div class="form-group">
                            <label for="">First Name</label>
                            <input type="text" name="firstname" class="form-control" placeholder="Enter first name">
                        </div>
                        <div class="form-group">
                            <label for="">Last Name</label>
                            <input type="text" name="lastname" class="form-control" placeholder="Enter last name">
                        </div>
                        <div class="form-group">
                            <label for="">Age</label>
                            <input type="text" name="age" class="form-control" placeholder="Enter Age">
                        </div>
                        <div class="form-group">
                            <label for="">Gender</label>
                            <input type="radio" name="gender" value="Male">Male
                            <input type="radio" name="gender" value="Female">Female
                        </div>

                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" name="address" class="form-control" placeholder="Enter Address">
                        </div>
                        <!-- div ng submit data button -->
                        <div class="form-group">
                            <button type="submit" name="insert_data" class="btn btn-primary">SAVE DATA</button>
                        </div>
                    </form>
                    <!-- end ng form -->

                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="header-text">
            <h1>PHP SAERCH FILTER</h1>

            <form action="" method="GET">
                <div class="input-group mb-3">
                    <input type="text" name="search" value="<?php if (isset($_GET['search'])) {
                                                                echo $_GET['search'];
                                                            } ?>" class="form-control" placeholder="Search Data">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>

        <div class="container-table">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>FIRST NAME</th>
                        <th>LAST NAME</th>
                        <th>AGE</th>
                        <th>GENDER</th>
                        <th>ADDRESS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $con = mysqli_connect("localhost", "root", "", "lagunahillsdata");

                    if (isset($_GET['search'])) {
                        $filtervalues = $_GET['search'];
                        $query = "SELECT * FROM homeownerdb3 WHERE CONCAT(firstname,lastname,age,gender,address) LIKE '%$filtervalues%' ";
                        $query_run = mysqli_query($con, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $items) {
                    ?>
                                <tr>
                                    <td> <?= $items['id']  ?> </td>
                                    <td> <?= $items['firstname']  ?> </td>
                                    <td> <?= $items['lastname']  ?> </td>
                                    <td> <?= $items['age']  ?> </td>
                                    <td> <?= $items['gender']  ?> </td>
                                    <td> <?= $items['address']  ?> </td>
                                </tr>

                            <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="6">No Record Found</td>
                            </tr>
                    <?php
                        }
                    }

                    ?>
                    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
                </tbody>
            </table>
        </div>

    </div>
    
    <div class="container">
        <div class="container my-5">
        <h1>All Data</h1>
        </div>
        <table class="table table-stripped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>FIRST NAME</th>
                    <th>LAST NAME</th>
                    <th>AGE</th>
                    <th>GENDER</th>
                    <th>ADDRESS</th>
                </tr>
                <?php
                while ($row = mysqli_fetch_assoc($data)) {
                ?>
                    <tr>
                        <td> <?php echo $row['id']; ?></td>
                        <td> <?php echo $row['firstname']; ?></td>
                        <td> <?php echo $row['lastname']; ?></td>
                        <td> <?php echo $row['age']; ?></td>
                        <td> <?php echo $row['gender']; ?></td>
                        <td> <?php echo $row['address']; ?></td>
                    </tr>
                <?php
                };
                ?>
            </thead>
        </table>
    </div>

<!-- part of download button of pdf -->
    <div class="container">
        <form action="pdf_gen.php" method="POST" target="_blank">
            <button type="submit" name="btn_pdf" class="btn btn-success" target="_blank">Download PDF</button>
            
        </form>
    </div>

<script>
    
</script>

</body>

</html>