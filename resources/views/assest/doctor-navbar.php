<?php

if ($_SESSION['email'] != '') {
?>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="d-flex justify-content-between">
            <div class="rightNav d-flex"> 
                <div class="">
                    <button class="btn sideCollapseBtnDoc"><i class="bi bi-list"></i></button> 
                </div> 
                <div class=" d-flex justify-content-center search">
                    <label for="search" class="my-auto"><i class="bi bi-search"></i></label>
                    <input type="text" class="form-control " placeholder="Search Patients">
                </div>
            </div>
            <div class="d-flex">
                <div class="d-flex justify-content-end">
                    <button class="btn text-dark themeBtn mx-1" id="light"><i class="bi bi-sun-fill"></i></button>
                    <div class="btn-group dropdown profileBtnDrop">
                        <a class="nav-link text-dark  " href="#" id="navbarDarkDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $_SESSION['fname']; ?>
                            <!-- <img src="/image/doc-img/doc-img/<?php echo $_SESSION['profile_image']; ?>" class="rounded-circle mx-2"  alt="" /> -->
                        </a> 
                        <ul class="dropdown-menu dropdown-menu-start" aria-labelledby="navbarDarkDropdownMenuLink">
                            <li><a class="dropdown-item" href="#"></a></li>
                            <li><a class="dropdown-item" href="/d/profile-settings">Profile</a></li>
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
        </div>
    </nav>


<?php
} else {
?>
    <!-- navbar -->
    <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top fixed-top">
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
</nav> -->

<?php
}



?>