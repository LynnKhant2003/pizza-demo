<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="node_modules\bootstrap\dist\css\bootstrap.css"> -->
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="list.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-dark sticky-top">
        <!-- Container wrapper -->
        <div class="container">
            <!-- Navbar brand -->
            <a class="navbar-brand me-2 text-light" href="#">
                    CODE LAB Pizza<i class="fa-solid fa-pizza-slice ms-3"></i>
            </a>

            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarButtonsExample" aria-controls="navbarButtonsExample" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fas fa-bars"></i>
    </button>

            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarButtonsExample">
                <!-- Left links -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link  text-light" href="#pizza">Home</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link text-light" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#pizza">Pizza</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#contact">Contact</a>
                    </li>

                </ul>
                <!-- Left links -->

                    <div class="nav-item mt-0 text-white me-3">
                        <i class="fa-solid fa-circle-user me-2"></i>{{Auth()->user()->name}}
                    </div>
                    <form action="{{route('logout')}}" class="d-flex mb-0" method='post'>
                        @csrf
                        <button type="submit" class="btn btn-link  px-3 me-2 btn-outline-white">
                            <i class="fa-solid fa-arrow-right-to-bracket me-2"></i>Logout
                        </button>
                    </form>


                    {{-- <button type="button" class="btn btn-link btn-dark me-3">
                        <i class="fa-solid fa-user-plus me-2"></i>Register
        </button> --}}

                </div>
            </div>
            <!-- Collapsible wrapper -->
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
    @yield('content')
    <footer class="bg-light text-center p-2">Created by Code-Lab</footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script></body>
</body>
</html>
