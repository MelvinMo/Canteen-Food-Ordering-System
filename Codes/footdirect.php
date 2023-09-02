<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('head.php'); ?>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/login.css" rel="stylesheet">

    <title>About Us | FOODCAVE</title>
</head>

<body class="d-flex flex-column h-100">
    <header class="navbar navbar-expand-md navbar-light fixed-top bg-light shadow-sm mb-auto">
        <div class="container-fluid mx-4">
            <a href="index.php">
                <img src="img/Color logo - no background.png" width="125" class="me-2" alt="FOODCAVE Logo">
            </a>
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="navbarCollapse">
                <div class="d-flex text-end"></div>
            </div>
        </div>
    </header>
    <div class="mt-5"></div>
    <div class="container form-signin text-center restricted mt-auto">
            <i class="mt-4 bi bi-telephone-fill text-success h1 display-2"></i>
            <h3 class="mt-2 mb-3 fw-normal text-bold">About Us</h3>
            <h4 class="mt-2 mb-3 fw-normal ">Anonymous</h4>
            <p class="mt-2 mb-3 fw-normal h6 ">M. Mazaheri, A. Panahi, N. Almooshaki, M. Mokhtari</p>
            <p class="mb-3 fw-bold text-bold text-wrap">Food ordering system of IUT</p>
            <h4 class="mt-2 mb-3 fw-normal ">Prof. Dr. Mahmoodzadeh</h4><p class="mt-2 mb-3 fw-normal h6 ">Department Of Electrical and Computer Engineering</p>
            <a class="btn btn-success btn-sm w-50" href="index.php">Return To Home</a>
    </div>

    <?php include('footer.php')?>
</body>

</html>