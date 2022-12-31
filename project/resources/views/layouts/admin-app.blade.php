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
  <link rel="stylesheet" href="/css/admin.css">
  <link rel="stylesheet" href="/css/sidebar.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
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

  <script>
    $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
  </script>
</head>


<body>
  
  <div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar" class="" style="background-color:#EBEDEF;">

        <ul class="list-unstyled components">
            <li>
                <a href="{{ route('admin.dashboard') }}"  class="text-dark text-decoration-none">Dashboard</a>
            </li>
            <li>
                <a href="/admin/add-event-option" class="text-dark text-decoration-none">List Event</a>
            </li>
            <li>
              <a href="{{ route('admin.view-my-event') }}" class="text-dark text-decoration-none">My Event</a>
            </li>
            <li>
              <a href="{{ route('admin.choose-event') }}"  class="text-dark text-decoration-none">Ticket</a>
          </li>
            <li>
              <a href="{{ route('admin.show-staff') }}" class="text-dark text-decoration-none">Staff</a>
            </li>
            <li>
              <a href="{{ route('admin.manage-index') }}" class="text-dark text-decoration-none">Manage</a>
            </li>
        </ul>

    </nav>

    <!-- Page Content  -->
    <div id="content">

        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">

                <button type="button" id="sidebarCollapse" class="btn btn-info" style="margin-top:  -40px; margin-left: -30px;">
                    <i class="fas fa-align-left"></i>
                </button>

                <div class="ml-auto">
                  @if (Session::has('user'))
                    <a href="" class="btn btn-md text-white bg-dark fw-bold">{{ $user->name }}</a>
                    <a href="{{ route('logout') }}" class="btn btn-md btn-danger">
                      <i class="fa fa-sign-out"></i> 
                    </a>
                  @endif
                </div>

            </div>
        </nav>

        @yield('content')
        
    </div>
</div>
  
</body>
</html>