<?php

    if($_SESSION['email'] != '') {
        ?>
<!-- navbar -->
<nav class='navbar navbar-expand-lg navbar-primary bg-primary '>
    <div class='container-fluid'>
        <a class='navbar-brand text-light mx-4' href='http://128.199.27.158/s/'>
            <img src="http://128.199.27.158/s/public/image/logo.png" height="60" alt="" srcset="">
        </a>
        <button class='navbar-toggler btn-primary' type='button' data-bs-toggle='collapse'
            data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false'
            aria-label='Toggle navigation'>
            <span class='navbar-toggler-icon'></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="http://128.199.27.158/s/view/">Home</a>
                </li>
            </ul>
            <form action='http://128.199.27.158/s/controller/php/logout.php' method='POST'>
                <button type='submit' name='logout' class='btn btn-danger text-light px-4 mx-5'>Log Out</button>
            </form>
            <div class="btn-group dropdown">
                <a class="nav-link text-dark dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <?php echo $_SESSION['fname']; ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarDarkDropdownMenuLink">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><a class="dropdown-item" href="#">Account Setting</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<?php
    }
    else {
        ?>
<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top fixed-top">
    <div class="container-fluid">
        <a class='navbar-brand text-light mx-4' href='http://128.199.27.158/s/'>
            <img src="http://128.199.27.158/s/public/image/logo.png" height="60" alt="" srcset="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Doctor</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Technology</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Connect</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Blog</a>
                </li>
            </ul>
            <a href="http://128.199.27.158/s/d" class='btn btn-outline-primary text-primary px-3 py-2 mx-5'>LOGIN /
                SIGNUP</a>
        </div>
    </div>
</nav>

<?php
    }



?>