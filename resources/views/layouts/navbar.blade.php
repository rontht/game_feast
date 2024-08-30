<nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Nav Bar">
    <div class="container">
        <!-- logo -->
        <a class="navbar-brand" href="home">Misfit Reviews</a>

        <!--hamburger menu-->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <!--Home-->
                <li class="nav-item">
                    <!--find a way to add active to class--> 
                    <a class="nav-link" aria-current="page" href="{{url("/")}}">HOME</a>
                </li>

                <!--Dropdown for Platforms-->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">PLATFORMS</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">PC</a></li>
                        <li><a class="dropdown-item" href="#">Playstation 5</a></li>
                        <li><a class="dropdown-item" href="#">Nintendo Switch</a></li>
                        <li><a class="dropdown-item" href="#">Xbox One</a></li>
                        <li><a class="dropdown-item" href="#">Other Platforms</a></li>
                    </ul>
                </li>

                <!--Reviews-->
                <li class="nav-item">
                    <a class="nav-link" href="game">GAMES</a>
                </li>

                <!--Manufacturer-->
                <li class="nav-item">
                    <a class="nav-link" href="dev">DEVELOPERS</a>
                </li>

            </ul>

            <!--Search Bar-->
            <form role="search">
                <input class="form-control" type="search" placeholder="Search" aria-label="Search">
            </form>
        </div>
    </div>
</nav>