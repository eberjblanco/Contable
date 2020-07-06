<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <style type="text/css">
      .main-sidebar { 
        
      }
    </style>
 



  

@yield('head_local')
</head>
<body>




  <div class="wrapper">

      <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-orange navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="index3.html" class="nav-link">Home</a>
          </li>
          

         
        </ul>

        <!-- SEARCH FORM -->
       

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <a class="nav-link" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                Cerrar Sesión
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
                               
        </ul>
      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
          <img src="dist/img/Sin título.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
               style="opacity: .8">
          <span class="brand-text font-weight-light">Contable</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="dist/img/user.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="#" class="d-block"> {{ Auth::user()->name }}</a>
            </div>
          </div>

          <!-- Sidebar Menu -->
              <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            <li class="nav-item">
              <a href="{{ route('Empresas.index') }}" class="nav-link">
                <ion-icon name="business-outline"></ion-icon>
                <p>Mis Empresas</p>
              </a>
            </li>
         

          @if( Auth::user()->SuperAdmin == 1 )
              <li class="nav-item has-treeview ">
              <a href="#" class="nav-link">
                <ion-icon name="people-outline"></ion-icon>
                <p>
                  Gestión de Usuarios
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('User.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Registrados</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item has-treeview ">
              <a href="#" class="nav-link">
                <ion-icon name="business-outline"></ion-icon>
                <p>
                  Gestión de Empresas
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('regemp.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Registradas</p>
                  </a>
                </li>
                
              
              </ul>
            </li>

              <li class="nav-item has-treeview ">
              <a href="#" class="nav-link">
                <ion-icon name="construct-outline"></ion-icon>
                <p>
                  Configuración
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('MesesC.index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Períodos Activos</p>
                    </a>
                </li>
                
              
              </ul>
            </li>
          @endif

           

          

         
        </ul>
      </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
       








  <div id="app">
   
    <main class="py-4">

        <section class="content">
          <div class="container">
           
            @yield('content')
          </div>
            
         
        </section>
    
    </main>
  </div>

   </div>
      <!-- /.content-wrapper -->
      <footer class="main-footer">
        <strong>Desarrollado por <a target="_blank" href="https://multieliet.000webhostapp.com/">Multieliet</a></strong>
       
      
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule="" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js"></script>



  @yield('script_local')

</body>
</html>
