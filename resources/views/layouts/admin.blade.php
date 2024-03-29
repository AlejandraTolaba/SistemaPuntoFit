<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ADPuntoFit | www.puntofit.com</title>

    <!-- jQuery 2.1.4 -->
    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
    <link rel="icon" type="image/jpg" href="{{asset('imagenes/pf/logo1.jpg')}}">

  </head>
  <body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        
        <!-- Logo -->
        
        <a href=# class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
            <div style="float:left">
                <img src="{{asset('/imagenes/pf/logo1.jpg')}}"  class="img-circle" alt="Logo" height="30px" width="30px"/>
            </div> 
            <!-- <span class="logo-mini"><b>PF</b></span> -->
          <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>PUNTO FIT</b></span>
          
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->
              <!--<li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                 
                    <i class="fa fa-user"></i>
                    <span class="hidden-xs">Administrador</span>
                </a>
                 <ul class="dropdown-menu">
                  
                  <li class="user-header">
                    
                    <p>
                      www.incanatoit.com - Desarrollando Software
                      <small>www.youtube.com/jcarlosad7</small>
                    </p>
                  </li>
                  
                  
                  <li class="user-footer">
                    
                    <div class="pull-right">
                      <a href="#" class="btn btn-default btn-flat">Cerrar</a>
                    </div>
                  </li>
                </ul> 
              </li>-->
              
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->

          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>
            
            <li class="treeview">
              <a href={{asset('actividad')}}>
                <i class="fa fa-folder"></i>
                <span>Actividades</span>
                
              </a>
            </li>
            
           <!--  <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>Profesores</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
            </li> -->
            <li class="treeview">
              <a href="{{url('alumno/')}}">
                <i class="fa fa-users"></i>
                <span>Alumnos</span>
              </a>
            </li>
                       
            <!-- <li class="treeview">
              <a href="#">
                <i class="fa fa-calendar"></i> <span>Horarios</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="configuracion/usuario"><i class="fa fa-circle-o"></i> Sala 1</a></li>
                <li><a href="configuracion/usuario"><i class="fa fa-circle-o"></i> Sala 2</a></li>
                <li><a href="configuracion/usuario"><i class="fa fa-circle-o"></i> Sala 3</a></li>
                
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-usd"></i> <span>Movimientos de caja</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="configuracion/usuario"><i class="fa fa-circle-o"></i> Registrar ingreso</a></li>
                <li><a href="configuracion/usuario"><i class="fa fa-circle-o"></i> Registrar egreso</a></li>
              </ul>
              
            </li>
             <li>
              <a href="#">
                <i class="fa fa-plus-square"></i> <span>Ayuda</span>
                <small class="label pull-right bg-red">PDF</small>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
                <small class="label pull-right bg-yellow">IT</small>
              </a>
            </li> -->
                        
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>





      <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
          
          <div class="row">
            <div class="col-md-12">
                  <!--Contenido-->
                        @yield('contenido')
                  <!--Fin Contenido-->
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!--Fin-Contenido-->


      <footer class="main-footer no-print">
        <div class="pull-right hidden-xs">
          <b>Desarrollado por Miriam-Alejandra</b> 
        </div>
        <strong>Copyright &copy; 2019. Todos los derechos reservados</strong> 
      </footer>

      
    
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/app.min.js')}}"></script>
    
  </body>
</html>