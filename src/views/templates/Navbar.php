<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/adverts">Adverts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/adverts/search">Search</a>
                </li>
            </ul>
            <?php
            if (!isset($_SESSION["user"]))
            {
                echo '<ul class="navbar-nav ml-auto ">
                        <li class="nav-item">
                           <a class="nav-link" href="/login">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/register">Register</a>
                        </li>
                      </ul>';
            }
            else
            {
                echo '<ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                           <a class="nav-link" href="/logout">Logout</a>
                        </li>
                       </ul>';
            }
            ?>
        </div>
    </div>
</nav>