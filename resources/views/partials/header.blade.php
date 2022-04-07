 @if (Auth::user()->status === 'Disabled')
 <script>
     alert('Votre compte a été désactivé Veuillez contacter l\'administrateur ');
 </script>
 @php
 return redirect()->route('logout');
 @endphp
 @else

 <header>
     <nav class="navbar navbar-expand-lg navbar-light position-relative">
         <div class="container-fluid">
             <a class="navbar-brand" href="#" style="color : rgb(251, 185, 34);
                  font-size: 20px;
                  font-weight: 500;
                  ">Rentauto </a>
             <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                 <span class="navbar-toggler-icon"></span>
             </button>
             <div class="collapse navbar-collapse" id="navbarSupportedContent">
                 <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                     @if (Auth::user()->permissions === "Admin")
                     <li class="nav-item mx-3 active_">
                         <a class="nav-link active" aria-current="page" href="{{ route('dashboard')}}">Users</a>
                     </li>
                     @else
                     <li class="nav-item mx-3 @php if(substr($_SERVER['REQUEST_URI'],0,20) == '/dashboard/locations' || ($_SERVER['REQUEST_URI']) == '/dashboard'){ @endphp active_ @php } @endphp">
                         <a class="nav-link" href="{{ route('locations')}}">Locations</a>
                     </li>
                     <li class="nav-item @php if(substr($_SERVER['REQUEST_URI'],0,15) == '/dashboard/cars'){ @endphp active_ @php } @endphp mx-3">
                         <a class="nav-link" href="{{ route('cars') }}">Voitures</a>
                     </li>
                     <li class="nav-item mx-3">
                         <a class="nav-link @php if(substr($_SERVER['REQUEST_URI'],0,18) == '/dashboard/drivers'){ @endphp active_ @php } @endphp" href="{{ route('drivers')}}">Chauffeurs</a>
                     </li>
                     @endif

                     <li class="nav-item dropdown position-absolute end-0 mx-3">
                         <a class="nav-link dropdown-toggle log-out" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                             {{ Auth::user()->name }}
                         </a>
                         <ul class="dropdown-menu bg-white border-0" aria-labelledby="navbarDropdown">
                             <li><a class="dropdown-item" href="{{ route('logout') }}">Se déconnecter</a></li>
                         </ul>
                     </li>

                 </ul>
             </div>
         </div>
     </nav>
<hr>
 </header>
 @endif