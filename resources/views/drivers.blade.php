@extends('layout.app')

@section('title')
Rentauto | Drivers
@endsection

@section('content')
@include('partials.header')

<div class="container-fluid">
    <div class="row my-5 d-flex justify-content-evenly">
        <form action="{{ route('driver.search' ) }}" method="POST" class="search d-flex col-4 ">

            @csrf
            <div>
                <input type="search" class="bg-transparent form-control" style=" border:none; border-bottom:2px solid blueviolet;" name="name" value="@php if(isset($_POST['name'])){echo $_POST['name'];}@endphp" required id="" placeholder="Search driver">
            </div>
            <button type="submit" class="border-0 bg-transparent" style="width:40px; height:36px;">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 30 30" width="25px" height="30px">
                    <g id="surface8234173">
                        <path style=" stroke:none;fill-rule:nonzero;fill:blueviolet;fill-opacity:1;" d="M 13 3 C 7.488281 3 3 7.488281 3 13 C 3 18.511719 7.488281 23 13 23 C 15.398438 23 17.597656 22.148438 19.324219 20.734375 L 25.292969 26.707031 C 25.542969 26.96875 25.917969 27.074219 26.265625 26.980469 C 26.617188 26.890625 26.890625 26.617188 26.980469 26.265625 C 27.074219 25.917969 26.96875 25.542969 26.707031 25.292969 L 20.734375 19.320312 C 22.148438 17.597656 23 15.398438 23 13 C 23 7.488281 18.511719 3 13 3 Z M 13 5 C 17.429688 5 21 8.570312 21 13 C 21 17.429688 17.429688 21 13 21 C 8.570312 21 5 17.429688 5 13 C 5 8.570312 8.570312 5 13 5 Z M 13 5 " />
                    </g>
                </svg>
            </button>
        </form>
        <form action="{{ route('driver.filter') }}" method="POST" class="col-4 d-flex ">
            @csrf
            <label for="filter" class=" form-label me-3 mt-1">Sort by</label>
            <div>
                <select class="form-select" style=" border:none; border-bottom:2px solid blueviolet;" name="filter" id="">
                    <option value="@php if(isset($_POST['filter'])){echo $_POST['filter'];}@endphp">@php if(isset($_POST['filter'])){echo $_POST['filter'];}else{echo 'Filtre...';}@endphp</option>
                    <option value="All">All</option>
                    <option value="Enabled">Disponible</option>
                    <option value="Disabled">Indisponible</option>
                </select>
            </div>
            <button type="submit" class="border-0 bg-transparent" style="width:40px; height:36px;">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 30 30" width="25px" height="30px">
                    <g id="surface8234173">
                        <path style=" stroke:none;fill-rule:nonzero;fill:blueviolet;fill-opacity:1;" d="M 13 3 C 7.488281 3 3 7.488281 3 13 C 3 18.511719 7.488281 23 13 23 C 15.398438 23 17.597656 22.148438 19.324219 20.734375 L 25.292969 26.707031 C 25.542969 26.96875 25.917969 27.074219 26.265625 26.980469 C 26.617188 26.890625 26.890625 26.617188 26.980469 26.265625 C 27.074219 25.917969 26.96875 25.542969 26.707031 25.292969 L 20.734375 19.320312 C 22.148438 17.597656 23 15.398438 23 13 C 23 7.488281 18.511719 3 13 3 Z M 13 5 C 17.429688 5 21 8.570312 21 13 C 21 17.429688 17.429688 21 13 21 C 8.570312 21 5 17.429688 5 13 C 5 8.570312 8.570312 5 13 5 Z M 13 5 " />
                    </g>
                </svg>
            </button>
        </form>
        <a href="{{ route('driver.new') }}" class="new btn col-2"> + Nouveau chauffeur</a>
    </div>
    <div class="row ">
        <h1 class="my-3 text-black text-center">Tous les chauffeurs</h1>
        @isset($issu)
        @if ($issu === "success")
        <div class="alert alert-success">
            Chauffeur retirée avec succès
        </div>
        @else
        <div class="alert alert-danger">
            Impossible de retirer ce chauffeur car il est impliqué dans une location
        </div>
        @endif
        @endisset
        <div class="col-12 py-1 px-3 rounded table-responsive">
            @isset($bool)
            @if ($bool)
            <div class="alert alert-success">
                Chauffeur ajouté avec succès
            </div>
            @endif
            @endisset
            <table class="table table-striped table-borderless rounded">
                <tbody>
                    <tr class="">
                        <th>Name</th>
                        <th>Prenoms</th>
                        <th>Email Adress</th>
                        <th>Status</th>
                        <th>Tarif Horaire</th>
                        <th>Date d'ajout</th>
                        <th></th>
                        <th></th>
                    </tr>
                    @forelse ($drivers as $driver)
                    <tr class="">
                        <td scope="row"> {{ $driver->name }} </td>
                        <td>{{ $driver->prenoms }}</td>
                        <td> {{ $driver->email }} </td>
                        <td>
                            @if ($driver->status === "Disponible")
                            <span class="text-success">{{ $driver->status }}</a>
                                @else
                                <span class="text-danger">{{ $driver->status }}</a>
                                    @endif
                        </td>
                        <td>{{ $driver->tarifChauf }}</td>
                        <td> {{ $driver->created_at}} </td>

                        <td><a href="{{ route('driver.to_update', ['id' =>$driver->id]) }}"><svg width="20" height="32" viewBox="0 0 28 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M21.7801 1.458L27.2001 7.442C28.1201 8.454 28.0401 10.17 27.2601 11.05L11.2401 28.694L0.120117 31.246L2.44012 18.97C2.44012 18.97 17.6401 2.184 18.4201 1.304C19.2001 0.445999 20.8601 0.445999 21.7801 1.458V1.458ZM16.3201 7.596L5.14012 19.938L7.36012 22.38L18.4401 9.95L16.3201 7.596ZM10.3801 25.702L21.5401 13.382L19.4001 11.006L8.22012 23.326L10.3801 25.702Z" fill="#699BF7" />
                                </svg></a>
                        </td>
                        <td><a href="{{ route('driver.delete', ['id'=> $driver->id] ) }}"><svg width="20" height="26" viewBox="0 0 25 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.5001 0.410706C13.6315 0.410613 14.7199 0.804994 15.541 1.51261C16.3621 2.22022 16.8535 3.18717 16.9138 4.21428L16.9197 4.42856H23.4019C23.6258 4.42862 23.8414 4.50597 24.005 4.64496C24.1687 4.78396 24.2682 4.97424 24.2835 5.17736C24.2987 5.38049 24.2286 5.5813 24.0873 5.73924C23.9459 5.89718 23.7439 6.00045 23.5221 6.02821L23.4019 6.03571H22.1537L20.7159 22.1639C20.6262 23.1701 20.1231 24.1087 19.3068 24.793C18.4905 25.4773 17.4208 25.8572 16.3104 25.8571H8.68975C7.57935 25.8572 6.50961 25.4773 5.69331 24.793C4.87701 24.1087 4.37397 23.1701 4.28425 22.1639L2.84521 6.03571H1.59828C1.38468 6.0357 1.17831 5.96537 1.01733 5.83774C0.856351 5.71011 0.751655 5.5338 0.722605 5.34142L0.714355 5.23213C0.714364 5.03795 0.79172 4.85034 0.932117 4.70399C1.07251 4.55765 1.26645 4.46247 1.47807 4.43606L1.59828 4.42856H8.08043C8.08043 3.36296 8.54607 2.341 9.37491 1.58751C10.2038 0.834014 11.3279 0.410706 12.5001 0.410706V0.410706ZM20.3812 6.03571H4.61896L6.04621 22.0343C6.1001 22.638 6.40199 23.2011 6.89181 23.6116C7.38163 24.0222 8.02351 24.2501 8.68975 24.25H16.3104C16.9766 24.2501 17.6185 24.0222 18.1083 23.6116C18.5981 23.2011 18.9 22.638 18.9539 22.0343L20.38 6.03571H20.3812ZM9.84828 10.0536C10.0619 10.0536 10.2683 10.1239 10.4292 10.2515C10.5902 10.3792 10.6949 10.5555 10.724 10.7478L10.7322 10.8571V19.4286C10.7321 19.6322 10.6471 19.8281 10.4942 19.9769C10.3413 20.1257 10.132 20.2161 9.90853 20.23C9.6851 20.2439 9.4642 20.1802 9.29047 20.0517C9.11674 19.9232 9.00313 19.7395 8.9726 19.5378L8.96435 19.4286V10.8571C8.96435 10.644 9.05748 10.4396 9.22325 10.2889C9.38902 10.1382 9.61385 10.0536 9.84828 10.0536V10.0536ZM15.1519 10.0536C15.3655 10.0536 15.5718 10.1239 15.7328 10.2515C15.8938 10.3792 15.9985 10.5555 16.0275 10.7478L16.0358 10.8571V19.4286C16.0357 19.6322 15.9506 19.8281 15.7977 19.9769C15.6448 20.1257 15.4355 20.2161 15.2121 20.23C14.9887 20.2439 14.7678 20.1802 14.594 20.0517C14.4203 19.9232 14.3067 19.7395 14.2762 19.5378L14.2679 19.4286V10.8571C14.2679 10.644 14.3611 10.4396 14.5268 10.2889C14.6926 10.1382 14.9174 10.0536 15.1519 10.0536ZM12.5001 2.01785C11.8281 2.01777 11.1812 2.24959 10.6901 2.66646C10.1989 3.08332 9.90017 3.65415 9.85418 4.26356L9.84828 4.42856H15.1519L15.146 4.26356C15.1 3.65415 14.8012 3.08332 14.3101 2.66646C13.8189 2.24959 13.172 2.01777 12.5001 2.01785V2.01785Z" fill="#FF0E0E" />
                                </svg></a>
                        </td>
                    </tr>
                    @empty
                    <div class="alert alert-danger">
                        <h5 class="text-center">
                            Oups!!! Aucun chauffeur n'a été inscrit
                        </h5>
                    </div>

                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
    <div class="row">
        <div class="col-12 d-flex justify-content-end">
            <form action="" method="POST" class="search d-flex">

                @csrf
                <div>
                    <input type="tel" class=" form-control" name="tarif" value="{{ old('tarif') }}" required id="" placeholder="changer le tarif des chauffeurs">
                </div>
                <button type="submit" class="border-0 bg-transparent" style="width:40px; height:36px;">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 30 30" width="25px" height="30px">
                        <g id="surface8234173">
                            <path style=" stroke:none;fill-rule:nonzero;fill:blueviolet;fill-opacity:1;" d="M 13 3 C 7.488281 3 3 7.488281 3 13 C 3 18.511719 7.488281 23 13 23 C 15.398438 23 17.597656 22.148438 19.324219 20.734375 L 25.292969 26.707031 C 25.542969 26.96875 25.917969 27.074219 26.265625 26.980469 C 26.617188 26.890625 26.890625 26.617188 26.980469 26.265625 C 27.074219 25.917969 26.96875 25.542969 26.707031 25.292969 L 20.734375 19.320312 C 22.148438 17.597656 23 15.398438 23 13 C 23 7.488281 18.511719 3 13 3 Z M 13 5 C 17.429688 5 21 8.570312 21 13 C 21 17.429688 17.429688 21 13 21 C 8.570312 21 5 17.429688 5 13 C 5 8.570312 8.570312 5 13 5 Z M 13 5 " />
                        </g>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>

@endsection