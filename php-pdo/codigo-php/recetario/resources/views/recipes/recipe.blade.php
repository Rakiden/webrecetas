<!DOCTYPE html>
<html lang="en">
<head>
    <title>WebRecetas - Inicio</title>
    <link rel="icon" href="{{ asset('images/tortilla-de-patatas-porcion-cortada.jpg') }}"> 
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ url('../css/stylesRecipe.css') }}" />
    
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
            <li class="nav-item dropdown" >
                    @if (Auth::guest())
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Usuario
                    </a>
                    @else
                    <a class="nav-link dropdown-toggle"  href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{Auth::user()->name}}
                    </a>
                    @endif
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    @if (Auth::guest())
                    <a class="dropdown-item" href="/login">Log-in</a>
                    @else
                    <a class="dropdown-item" href="/panel/">Panel</a>
                    <a class="dropdown-item" href="/panel/">Favoritos</a>
                    <a class="dropdown-item" href="/logout">Log-out</a>
                    @endif
                    </div>
                </li>
             </ul>
        </div>
    </nav>
    <div class="content">
        <div class="row nomarpad">                        
            <div class="col-2 nomarpad"><img src="{{$recipe->image}}" alt="" style="width:100%; height:auto;border-radius:5px; 
                            -webkit-box-shadow: 4px 4px 5px 0px rgba(50, 50, 50, 0.3);-moz-box-shadow:4px 4px 5px 0px rgba(50, 50, 50, 0.3);
                            box-shadow:4px 4px 5px 0px rgba(50, 50, 50, 0.3);"></div>
            <div class="col-10 nomarpad" style="padding:10px!important">
                <div class="row nomarpad">
                    <div class="col-9 nomarpad" style="text-decoration:none;text-decoration:underline; font-weight:bold;word-break: break-word;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;line-height: 16px; /* fallback */
                                        max-height: 32px; /* fallback */-webkit-line-clamp: 2; /* number of lines to show */-webkit-box-orient: vertical;"><p>{{$recipe->title}}</p> 
                    </div>
                    @if(Auth::id()==1)
                    <div class="col-1"><form method="POST" action="../delete/{{$recipe->id}}" enctype="multipart/form-data">@csrf<button type="submit" class="btn btn-danger" style="float:right;margin: 10px;">Eliminar</button></form></div>
                    @if($isFavourite)
                    <div class="col-1"><form method="POST" action="../unfavourite/{{$recipe->id}}" enctype="multipart/form-data">@csrf<input src="../images/full_star.svg" type="image" name="submit" style="width:65%" alt="Submit"/></form></div>
                    @else
                    <div class="col-1"><form method="POST" action="../favourite/{{$recipe->id}}" enctype="multipart/form-data">@csrf<input src="../images/empty_star.svg" type="image" name="submit" style="width:65%" alt="Submit"/></form></div>
                    @endif
                    @else
                    @if($isFavourite)
                    <div class="col-2"><form method="POST" action="../unfavourite/{{$recipe->id}}" enctype="multipart/form-data">@csrf<input src="../images/full_star.svg" type="image" name="submit" style="width:65%" alt="Submit"/></form></div>
                    @else
                    <div class="col-2"><form method="POST" action="../favourite/{{$recipe->id}}" enctype="multipart/form-data">@csrf<input src="../images/empty_star.svg" type="image" name="submit" style="width:65%" alt="Submit"/></form></div>
                    @endif
                    @endif
                    <div class="col-1"><a href="https://api.whatsapp.com/send?text={{Request::url()}}"><img src="../images/waicon.png" style="width:75%"/></a></div>
                    <div class="col-12 nomarpad" style="text-decoration:none;font-style:italic;word-break: break-word;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;line-height: 16px; /* fallback */
                                        max-height: 32px; /* fallback */-webkit-line-clamp: 1; /* number of lines to show */-webkit-box-orient: vertical;"><p>{{$recipe->category}}</p></div>
                    <div class="col-12 nomarpad" style="text-decoration:none;word-break: break-word;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;line-height: 16px; /* fallback */
                                        max-height: 32px; /* fallback */-webkit-line-clamp: 4; /* number of lines to show */-webkit-box-orient: vertical;"><p>{{$recipe->ingredients}}</p></div>    
                        
                </div>
            </div>
            <div class="col-12"><div class="col-12 nomarpad" style="margin-top:40px!important"><p>{{$recipe->description}}</p></div></div>
        </div>
        @if(!Auth::guest())
            <div class="row nomarpad">
                <form method="POST" action="../comment/{{$recipe->id}}">
                @csrf
                    <textarea class="form-control" name="comment" id="comment" cols="100" rows="5" style="margin:10px; width:auto!important" required></textarea>
                    
                    <button type="submit" class="btn btn-primary" style="float:right;margin: 10px;">Enviar</button>
                </form>
            </div>
        @endif
        <div class="row nomarpad">
            @foreach($comments as $comment)
                    <div class="col-6 nomarpad"><p style="margin: 10px;padding: 10px;background: #e4d4d4;border-radius: 10px;">{{$comment->text}}</p></div>
            @endforeach
            <div class="col-12">{{$comments->links("pagination::bootstrap-4")}}</div>
        </div>
    </div>
    

</body>

<!-- CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

<!-- jQuery and JS bundle w/ Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</html>