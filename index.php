<?php 
    include "config.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CRUD App</title>
        <!-- Create, Read, Update, Delete -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</head>
<body>
    <?php require_once 'action.php'; ?>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand" href="/phpcrud/index.php">CRUD App</a>

        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#">Features</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Services</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About</a>
            </li> 
            </ul>
        </div>
        <form class="form-inline" action="/action_page.php">
            <input class="form-control mr-sm-2" type="text" placeholder="Search">
            <button class="btn btn-primary" type="submit">Search</button>
        </form>
    </nav>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3 class="tect-center text-dark mt-2">Advanced CRUD App Using PHP & MYSQLi Prepared Statement (Object Oriented)</h3>
                <hr>
                <?php if(isset($_SESSION['response'])){ ?>
                <div class="alert alert-<?php echo $_SESSION['res_type']; ?> alert-dismissible text-center">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <b class="text-center"><?php echo $_SESSION['response']; ?></b>
                </div>
                <?php } unset($_SESSION['response']); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <h3 class="text-center text-info">App Record</h3>
                <form action="action.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="form-group">
                    <input type="text" name="name" value="<?php echo $name; ?>" class="form-control" placeholder="Enter name" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" value="<?php echo $email; ?>" class="form-control" placeholder="Enter e-mail" required>
                </div>
                <div class="form-group">
                    <input type="tel" name="phone" value="<?php echo $phone; ?>" class="form-control" placeholder="Enter phone" required>
                </div>
                <div class="form-group">
                    <input type="hidden" name="oldimage" value="<?php echo $photo; ?>">
                    <input type="file" name="image" class="custom-file">
                    <img src="<?php echo $photo; ?>" width="120" class="img-thumbnail">
                </div>
                <div class="form-group">
                    <?php if($update==true){ ?>
                        <input type="submit" name="update" class="btn btn-success btn-block" value="Update Record">
                    <?php } else { ?>
                        <input type="submit" name="add" class="btn btn-primary btn-block" value="Add Record">
                    <?php } ?>
                </div>
                </form>
            </div>
            <div class="col-md-8">
                <?php
                    $query = "SELECT * FROM crud";
                    $stmt = $conn->prepare($query);
                    $stmt->execute();
                    $result = $stmt->get_result();
                ?>
                <h3 class="text-center text-info">Records Present In The Database</h3>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><img src="<?php echo $row['photo']; ?>" width="25"></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['phone']; ?></td>
                            <td>
                                <a href="details.php?details=<?php echo $row['id']; ?>" class="badge badge-primary p-2 mb-1">Details</a> |
                                <a href="action.php?delete=<?php echo $row['id']; ?>" class="badge badge-danger p-2 mb-1" onclick="return confirm('Do you want to delete this recording?')">Delete</a> |
                                <a href="index.php?edit=<?php echo $row['id']; ?>" class="badge badge-success p-2 mb-1">Edit</a> |
                            </td>
                        </tr>
                        <?php endwhile; ?>  
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</body>
</html>