<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Omega </title>
  <style media="screen">
      .navbar {
          background-image: url('{{ url('Fondo.jpg')}}');
          background-repeat: repeat;
      }
      .logo{
        background-image: url('{{ url('Fondo.jpg')}}');
        background-repeat: repeat;
      }
      .content-wrapper{
        background-image: url('{{ url('Fondo2.jpg')}}');
        background-repeat: repeat;
      }
    }

  </style>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href=" {{ url('bootstrap/css/bootstrap.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href=" {{ url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href=" {{ url('https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href=" {{ url('dist/css/AdminLTE.min.css')}}">
  <link rel="stylesheet" href="{{ url('plugins/select2/select2.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href=" {{ url('dist/css/skins/_all-skins.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href=" {{ url('plugins/iCheck/flat/blue.css')}}">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- <link rel="stylesheet" type="text/css" href="{{url('plugins/datatables/jquery.dataTables.css')}}"> -->
  <link rel="stylesheet" type="text/css" href="{{url('plugins/datatables/dataTables.bootstrap.css')}}">
  @yield('css')
</head>
<body class="hold-transition skin-blue sidebar-mini" style="padding: 0px !important;">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">

    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">



          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{url('dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{Auth::User()->nombres}} {{Auth::User()->apellidos}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{url('dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">

                <p>
                  {{Auth::User()->nombres}} {{Auth::User()->apellidos}}
                </p>
              </li>
              <!-- Menu Body
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                 /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <!-- <a href="#" class="btn btn-default btn-flat">Perfil</a> -->
                </div>
                <div class="pull-right">
                  <a href="{{ url('logout') }}" class="btn btn-default btn-flat">Cerrar Sesion</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->

        </ul>
      </div>
    </nav>
  </header>

  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel" >
        <div >
          <img src="{{url('Certicol.png')}}" >
        </div>

      </div>
      <!-- search form -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">Modulos</li>
        <li>
          <a href="{{ url('inicio') }}">
            <i class="glyphicon glyphicon-home"></i> <span>Inicio</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="glyphicon glyphicon-file"></i> <span>Administrativa</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="{{ url('administrativas') }}"><i class="fa fa-circle-o"></i>Contratos</a></li>
            <li class="active"><a href="{{ url('otrosi/create') }}"><i class="fa fa-circle-o"></i>Otro sí</a></li>
            <li class="active"><a href="{{ url('adicionales/create') }}"><i class="fa fa-circle-o"></i>Valor adicional</a></li>
          </ul>
        </li>
      </ul>
      @if ( Auth::user()->rol_id == 1)
      <ul class="sidebar-menu">
        <li class="treeview">
          <a href="#">
            <i class="fa fa-plus-square"></i> <span>Alcance</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('transformaciones/create') }}"><i class="fa fa-circle-o"></i>Transformación</a></li>
            <li><a href="{{ url('distribuciones/create') }}"><i class="fa fa-circle-o"></i>Distribuciones</a></li>
            <li><a href="{{ url('pu_final/create') }}"><i class="fa fa-circle-o"></i>Uso final</a></li>
          </ul>
        </li>
      </ul>
      @endif
      @if ( Auth::user()->rol_id == 1)
      <ul class="sidebar-menu">
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>Usuarios/Clientes</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <li><a href="{{ url('usuarios') }}"><i class="fa fa-circle-o"></i>Usuarios</a></li>
            <li><a href="{{ url('clientes') }}"><i class="fa fa-circle-o"></i>Clientes</a></li>
          </ul>
        </li>
      </ul>
      @endif
      @if ( Auth::user()->rol_id == 1)
      <ul class="sidebar-menu">
        <li class="treeview">
          <a href="#">
            <i class="fa fa-book"></i> <span>Auditoría</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('auditorias') }}"><i class="fa fa-circle-o"></i>Auditoría</a></li>
          </ul>
        </li>
      </ul>
      @endif
      @if ( Auth::user()->rol_id == 1)
      <ul class="sidebar-menu">
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dollar"></i> <span>Cotizaciones</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('cotizaciones') }}"><i class="fa fa-circle-o"></i>Cotizaciones</a></li>
          </ul>
        </li>
      </ul>
      @endif

    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Panel
      </h1>

    </section>
            @yield('contenido')
            @yield('modales')

        </section>
      </div>
    </div>


    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->




  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->


<!-- jQuery 2.2.3 -->
<script src= "{{url('plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{url('https://code.jquery.com/ui/1.11.4/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  // $.widget.bridge('uibutton', $.ui.button);
</script>

<!-- Bootstrap 3.3.6 -->
<script src="{{url('bootstrap/js/bootstrap.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{url('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{url('plugins/fastclick/fastclick.js')}}"></script>
<!-- Select2 -->
<script src="{{url('js/plugins/select2/select2.full.js')}}"></script>
<!-- DataTables -->
<script src="{{url('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{url('dist/js/app.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="{{url('dist/js/pages/dashboard.js')}}"></script> -->
<!-- AdminLTE for demo purposes -->
<script src="{{url('dist/js/demo.js')}}"></script>
<script src="{{url('plugins/jQuery/funciones.js')}}"></script>
<script src="{{url('plugins/jQuery/jquery.steps.js')}}"></script>
<script src="{{url('plugins/input-mask/jquery.inputmask.js')}}"></script>

@yield('scripts')

</body>
</html>
