<?php
    use App\Http\Controllers\AuthController;
    $user = AuthController::user();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project</title>
    <link rel="stylesheet" href="/css/user.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    {{-- table data --}}
  <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready( function () {
      $('#myTable').DataTable();
    });
  </script>
  
    {{-- Khalti --}}
    <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
</head>

<body class="body">
  <nav class="navbar navbar-expand-lg navbar-light bg-primary p-4">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto fw-bold">
          <li class="nav-item ms-4">
            <a class="nav-link" href="/">Home</a>
          </li>

          <li class="nav-item dropdown ms-4">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Explore Events
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="{{ route('view.top-event') }}">Top Rated</a></li>
              <li><a class="dropdown-item" href="{{ route('view.hotel-event') }}">Hotel</a></li>
              <li><a class="dropdown-item" href="{{ route('view.concert-event') }}">Concert</a></li>
              <li><a class="dropdown-item" href="{{ route('view.aud-event') }}">auditorium</a></li>
              <li><a class="dropdown-item" href="{{ route('view.free-event') }}">Free</a></li>
            </ul>
          </li>

          <li class="nav-item ms-4">
            <a class="nav-link" href="{{ route('view.booked-list') }}">My Events</a>
          </li>
        </ul>

        @if (Session::has('user'))
          <a href="" class="btn btn-md btn-success bg-dark text-white fw-bold">{{ $user->name }}</a>
          <a href="{{ route('logout') }}" class="btn btn-md btn-success bg-danger">
            <i class="fa fa-sign-out"></i> 
          </a>
        
        @else
          <a href="{{ route('view.login') }}" class="btn btn-md btn-success m-2">Login</a>
          <a href="{{ route('view.user-register') }}" class="btn btn-md btn-danger m-2">Register</a>
        @endif

      </div>
    </div>
  </nav>

  <div>
      @yield('content')
  </div>

  <footer id="footer" class="text-center fw-bold bg-danger mt-4">
    <div class="p-3 pb-0">
      <p class="d-flex justify-content-center align-items-center">
        <span>Use as Organizer</span>
        <a href="{{ route('view.admin-register') }}" class="btn btn-outline-primary ms-3">Sign up</a>
      </p>
    </div>

    <div class="text-center p-3 bg-secondary">&copy 2022 Copyright</div>
  </footer>


</body>

</html>