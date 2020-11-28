<!DOCTYPE html>
<html lang="en">
<head>
    <title>WebRecetas - Inicio</title>
    <link rel="icon" href="{{ asset('images/tortilla-de-patatas-porcion-cortada.jpg') }}"> 
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ url('../css/styles.css') }}" />
    
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/index">WebRecetas</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="/index">Índice <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto"style="margin-right: 88px;">
                <select class="form-control" id="category" name="category"style="min-width:200px;margin-right: 60px" onchange="location = this.value;">
                    <option value="">Seleciona categoria</option>
                    <option value="?category=Carne">Carne</option>
                    <option value="?category=Vegetariana">Vegetariana</option>
                    <option value="?category=Vegana">Vegana</option>
                    <option value="?category=Pescado">Pescado</option>
                    <option value="?category=Cazuela">Cazuela</option>
                </select>
                <form class="form-inline my-2 my-lg-0" style="min-width:300px;" method="POST" action="../panel">@csrf
                    <input name="search" id="search" class="form-control mr-sm-2" type="search" placeholder="" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                </form>
                <li class="nav-item dropdown" >
                    @if (Auth::guest())
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Usuario
                    </a>
                    @else
                    <a class="nav-link dropdown-toggle"  href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Usuario
                    </a>
                    @endif
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    @if (Auth::guest())
                    <a class="dropdown-item" href="/login">Log-in</a>
                    @else
                    <a class="dropdown-item" href="/panel/">Panel</a>
                    <a class="dropdown-item" href="/logout">Log-out</a>
                    @endif
                    </div>
                </li>
             </ul>
        </div>
    </nav>
    <div class="content">
        <div class="row" style="min-height: 150px;align-content: center;color:#404b56">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6"><label style="font-weight:bold;text-decoration:underline">Nombre de Usuario</label><p>{{$user[0]->name}}</p></div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6"><label style="font-weight:bold;text-decoration:underline">Email de Usuario</label><p>{{$user[0]->email}}</p></div>
        </div>
        <h2 style="color:#2d343c;font-weight:bold;text-decoration:underline">Mis recetas</h2>
        <div class="row nomarpad">
            @foreach($myRecipes as $recipe)
            <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 nomarpad mb-3">
                <form method="POST" action="../myrecipe/{{$recipe->id}}">
                    <div class="row nomarpad">
                        @csrf
                            <a href="{{url('recipe/'.$recipe->id)}}" style="text-decoration:none;color:#404b56">
                                <div class="row nomarpad">                        
                                <div class="col-6 nomarpad"><img src="{{$recipe->image}}" alt="" style="width:100%; height:auto; border-radius:5px; 
                                    -webkit-box-shadow: 4px 4px 5px 0px rgba(50, 50, 50, 0.3);-moz-box-shadow:4px 4px 5px 0px rgba(50, 50, 50, 0.3);
                                    box-shadow:4px 4px 5px 0px rgba(50, 50, 50, 0.3);"></div>
                                    <div class="col-6 nomarpad" style="padding:10px!important">
                                        <p style="text-decoration:none;text-decoration:underline; font-weight:bold;word-break: break-word;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;line-height: 16px; /* fallback */
                                            max-height: 32px; /* fallback */-webkit-line-clamp: 2; /* number of lines to show */-webkit-box-orient: vertical;">{{$recipe->title}}</p>
                                        <button type="submit" class="btn btn-primary">Editar</button>
                                    </div>
                                   
                                </div>
                            </a>
                        </form>
                    </div>
                </div> 
            @endforeach
                <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 nomarpad mb-3" style="align-self: center; text-align-last: center;">
                    <a href="{{url('creation')}}" style="text-decoration:none;">
                        <div class="row nomarpad">                        
                        <div class="col-6 nomarpad"><button type="submit" class="btn btn-primary">+</button></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-12">{{$myRecipes->links("pagination::bootstrap-4")}}</div>  
        </div>
    

</body>

<!-- CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

<!-- jQuery and JS bundle w/ Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</html>