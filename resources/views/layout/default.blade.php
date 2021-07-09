
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    @include('includes.head')
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Todo App</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="#/login">Login </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#/register">Register </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#/logout">Logout </a>
            </li>
            
          </ul>
        </div>
      </nav>
    <div class="flex-center position-ref full-height">
      
       
        <div class="container">
          <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @yield('content')
            </div>
          </div>
        </div>
      </div>
     

    @include('includes.footer')
  </body>
</html>