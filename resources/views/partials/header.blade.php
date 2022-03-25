    <header>
        <nav class="navbar navbar-expand-sm navbar-light">
            <div class="container-fluid mx-4">
                <a class="navbar-brand" href="#" style="color : rgb(251, 185, 34);
                  font-size: 30px;
                  font-weight: 600;
                  ">Rentauto </a>
                <button class="navbar-toggler " style=" border : 1px solid rgb(251, 185, 34);" type="button" data-toggle="collapse" data-target="#navbarID" aria-controls="navbarID" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarID">
                    @if (Auth::user()->permissions === "Admin")
                    <div class="navbar-nav mx-4">
                        <a class="nav-link user_" aria-current="page" href="{{ route('dashboard') }} " ">User Managment</a>
                    </div>
                    @else
                    <div class=" navbar-nav mx-4">
                            <a class="nav-link rent" aria-current="page" href="{{ route('dashboard') }}">Location</a>
                    </div>
                    <div class="navbar-nav mx-4">
                        <a class="nav-link car" aria-current="page" href="{{ route('cars') }}">Voitures</a>
                    </div>
                    <div class="navbar-nav mx-4">
                        <a class="nav-link car" aria-current="page" href="{{ route('drivers') }}">Chauffeurs</a>
                    </div>
                    @endif
                    <div class="navbar-nav mx-4 position-absolute end-0">
                        <a class="nav-link log-out active" aria-current="page" href="{{ route('logout') }}">log out</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>