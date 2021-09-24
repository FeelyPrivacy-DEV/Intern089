<?php

    if($_SESSION['email'] != '') {
        ?>
        <!-- navbar -->
        <nav class='navbar navbar-expand-lg navbar-primary bg-primary '>
            <div class='container-fluid'>
                <a class='navbar-brand text-light mx-4' href='/'>
                    <img src="/image/logo.png" height="60" alt="" srcset="">
                </a>
                <button class='navbar-toggler btn-outline-primary' type='button' data-bs-toggle='collapse'
                    data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false'
                    aria-label='Toggle navigation'>
                    <span class='navbar-toggler-icon'></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <!-- <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="http://127.0.0.1/s/s/view/">Home</a>
                        </li> -->
                    </ul>

                    <div class="btn-group dropdown mx-5">
                        <a class="nav-link text-dark dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $_SESSION['fname']; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-start" aria-labelledby="navbarDarkDropdownMenuLink">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Account Setting</a></li>
                            <hr>
                            <li>
                                <form action="/logout" method="POST">

                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <button type='submit' name='logout' class='btn btn-sm fw-bold text-danger px-3'>Log Out</button>
                                </form>
                            </li>
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
        <a class='navbar-brand text-light mx-4' href='/'>
            <img src="/image/logo.png" height="60" alt="" srcset="">
        </a>
        <button class="navbar-toggler btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
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
            <a href="/" class='btn btn-outline-primary text-primary px-3 py-2 mx-5'>LOGIN /
                SIGNUP</a>
        </div>
    </div>
</nav>

<?php
    }



?>
