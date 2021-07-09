
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    @include('includes.head')
  </head>
  <body>
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