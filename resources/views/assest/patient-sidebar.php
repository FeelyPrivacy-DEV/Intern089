<nav class="sidebar  close ">
    <header>
        <div class="image-text">
            <span class="image">
                <img src="/image/brainLogo.png" alt="J">
            </span>

            <div class="text logo-text">
                <span class="name">Jeev60</span>
            </div>
        </div>

        <!-- <i class='bx bx-chevron-right toggle'></i> -->
        <button class=" toggle" id="toggleSidebar"></button>
    </header>

    <div class="menu-bar">
        <div class="menu">
            <ul class="menu-links">
                <li class="nav-links">
                    <a href="/p/dashboard">
                        <i class='bx bx-home-alt icon'></i>
                        <span class="text nav-text">Dashboard</span>
                    </a>
                </li>

                <li class="nav-links">
                    <a href="/d/appointments">
                        <i class='bx bx-bar-chart-alt-2 icon'></i>
                        <span class="text nav-text">Select Doctor</span>
                    </a>
                </li> 

                <li class="nav-links">
                    <a href="/p/change-password">
                        <i class='bx bx-wallet icon'></i>
                        <span class="text nav-text">Change Password</span>
                    </a>
                </li>

            </ul>
        </div>

        <div class="bottom-content">
            <!-- <div class="btn-group dropdown profileBtnDrop">
                <a class="nav-link text-dark  " href="#" id="navbarDarkDropdownMenuLink" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <?php echo $_SESSION['fname']; ?>
                    <img src="/image/doc-img/doc-img/<?php echo $_SESSION['profile_image']; ?>" class="rounded-circle mx-2"  alt="" />
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
            </div> -->
            <ul class="menu-links">
                <li class="nav-links">
                    <i class="bi bi-box-arrow-right"></i>
                    <form action="/logout" method="POST"> 
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <button type='submit' name='logout' class='btn btn-sm fw-bold text-danger px-3'>Log Out</button>
                    </form>
                </li>
            </ul>

        </div>
    </div>
</nav>