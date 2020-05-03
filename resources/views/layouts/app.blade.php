<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
      <meta name="description" content="Bootstrap Admin App + jQuery">
      <meta name="keywords" content="app, responsive, jquery, bootstrap, dashboard, admin">
      <title>Transporte Pipi</title>
      <!-- =============== VENDOR STYLES ===============-->
      <!-- FONT AWESOME-->
      <link rel="stylesheet" href="{{asset('/vendor/fontawesome/css/font-awesome.min.css')}}">
      <!-- SIMPLE LINE ICONS-->
      <link rel="stylesheet" href="{{asset('/vendor/simple-line-icons/css/simple-line-icons.css')}}">
      <!-- ANIMATE.CSS-->
      <link rel="stylesheet" href="{{asset('/vendor/animate.css/animate.min.css')}}">
      <!-- WHIRL (spinners)-->
      <link rel="stylesheet" href="{{asset('/vendor/whirl/dist/whirl.css')}}">
      <!-- =============== PAGE VENDOR STYLES ===============-->
      <!-- =============== BOOTSTRAP STYLES ===============-->
      <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}" id="bscss">
      <!-- =============== APP STYLES ===============-->
      <link rel="stylesheet" href="{{asset('css/app.css')}}" id="maincss">
      <link rel="stylesheet" href="{{asset('css/theme-h.css')}}" id="">
      <link rel="stylesheet" href="{{asset('css/bootstrap-dialog.css')}}">
      <link rel="stylesheet" href="{{ asset('vendor/chosen_v1.2.0/chosen.min.css') }}">
      <!-- DATETIMEPICKER-->
      {{--  <link rel="stylesheet" href="{{ asset('vendor/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}">  --}}
      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      <!-- COLORPICKER-->
      {{--  <link rel="stylesheet" href="{{ asset('vendor/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.css') }}">  --}}
      <!-- SELECT2-->
      <link rel="stylesheet" href="{{ asset('vendor/select2/dist/css/select2.css') }}">
      <link rel="stylesheet" href="{{ asset('vendor/select2-bootstrap-theme/dist/select2-bootstrap.css') }}">
      <!-- SWEET ALERT-->
   <link rel="stylesheet" href="{{ asset('vendor/sweetalert/dist/sweetalert.css') }}">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
      
   </head>
   <body>
      <div class="wrapper">
         <!-- top navbar-->
         <header class="topnavbar-wrapper">
            <!-- START Top Navbar-->
            <nav role="navigation" class="navbar topnavbar">
               <!-- START navbar header-->
               <div class="navbar-header">
                  <a href="#/" class="navbar-brand">
                     <div class="brand-logo">
                        <img src="{{ asset('/images/logowhite.png') }}" alt="Logo" class="img-responsive" style="width: 140px;">
                     </div>
                     <div class="brand-logo-collapsed">
                        <img src="{{ asset('/images/logowhite_single.png') }}" alt="Logo" class="img-responsive">
                     </div>
                  </a>
               </div>
               <!-- END navbar header-->
               <!-- START Nav wrapper-->
               <div class="nav-wrapper">
                  <!-- START Left navbar-->
                  <ul class="nav navbar-nav">
                     <li>
                        <!-- Button used to collapse the left sidebar. Only visible on tablet and desktops-->
                        <a href="#" data-toggle-state="aside-collapsed" class="hidden-xs">
                           <em class="fa fa-navicon"></em>
                        </a>
                        <!-- Button to show/hide the sidebar on mobile. Visible on mobile only.-->
                        <a href="#" data-toggle-state="aside-toggled" data-no-persist="true" class="visible-xs sidebar-toggle">
                           <em class="fa fa-navicon"></em>
                        </a>
                     </li>
                  </ul>
                  <!-- END Left navbar-->
                  <!-- START Right Navbar-->
                  <ul class="nav navbar-nav navbar-right">
                     
                     <!-- START Offsidebar button-->
                     <li>
                        <a href="#" data-toggle-state="offsidebar-open" data-no-persist="true">
                           <em class="icon-notebook"></em>
                        </a>
                     </li>
                     <!-- END Offsidebar menu-->
                  </ul>
                  <!-- END Right Navbar-->
               </div>
               <!-- END Nav wrapper-->
            </nav>
            <!-- END Top Navbar-->
         </header>
         <!-- sidebar-->
         <aside class="aside">
            <!-- START Sidebar (left)-->
            <div class="aside-inner">
               <nav data-sidebar-anyclick-close="" class="sidebar">
                  <!-- START sidebar nav-->
                  <ul class="nav">
                     <!-- Iterates over all sidebar items-->
                     <li class="nav-heading ">
                        <span data-localize="sidebar.heading.MENU">Menu</span>
                     </li>

                  @if (in_array(Auth::user()->rol_id,array(1,2,6,4,5)))
                        <li class={{ Request::is('facturas') ? "active" : "" }}>
                        <a href="{{route('facturas.index')}}" title="Facturacion">
                           <em class="fa icon-note"></em>
                           <span data-localize="sidebar.nav.FACTURACION">Facturacion</span>
                        </a>
                     </li>
                     @endif
                     
                     @if (in_array(Auth::user()->rol_id,array(1,2,6,4,5)))
                        <li class={{ (Request::is('camiones') || Request::is('camiones/*')) ? "active" : "" }}>
                        <a href="{{route('camiones.index')}}" title="Camiones">
                           <em class="fa fa-truck"></em>
                           <span data-localize="sidebar.nav.CAMIONES">Camiones</span>
                        </a>
                     </li>
                     @endif
                     
                     @if (in_array(Auth::user()->rol_id,array(1,2,6)))
                        <li class={{ Request::is('configuraciones/asignar_viajes_index') ? "active" : "noclase" }} >
                        <a href="{{route('configuraciones.asignar_viajes')}}" title="Asignar viajes">
                           <em class="icon-plus"></em>
                           <span data-localize="sidebar.nav.ASIGNAR_VIAJES">Asignar viajes</span>
                        </a>
                     </li>
                     @endif
                     
                     @if (in_array(Auth::user()->rol_id,array(1,2,6,4,5)))
                        <li class={{ (Request::is('clientes') || Request::is('clientes/*')) ? "active" : "" }}>
                        <a href="{{ route('clientes.index') }}" title="Clientes">
                           <em class="fa fa-users"></em>
                           <span data-localize="sidebar.nav.CLIENTES">Clientes</span>
                        </a>
                     </li>
                     @endif
                     
                     @if (in_array(Auth::user()->rol_id,array(1,2,6,4,5)))
                        <li class={{ (Request::is('empleados') || Request::is('empleados/*')) ? "active" : "" }}>
                           <a href="{{route('empleados.index')}}" title="Empleados">
                              <em class="fa fa-user"></em>
                              <span data-localize="sidebar.nav.EMPLEADOS">Empleados</span>
                           </a>
                        </li>
                     @endif
                     
                     @if (in_array(Auth::user()->rol_id,array(1,2,3,6,4,5)))
                        <li class={{ (Request::is('gastos') || Request::is('gastos/*')) ? "active" : "" }}>
                           <a href="{{route('gastos.index')}}" title="Gastos">
                              <em class="fa fa-dollar"></em>
                              <span data-localize="sidebar.nav.GASTOS">Gastos</span>
                           </a>
                        </li>
                     @endif
                     
                     @if (in_array(Auth::user()->rol_id,array(1,2,6)))
                        <li class={{ (Request::is('configuraciones')) ? "active" : "" }}>
                           <a href="#conf" title="conf" data-toggle="collapse">
                              <em class="fa fa-cogs"></em>
                              <span data-localize="sidebar.nav.conf">Configuracion</span>
                           </a>
                           <ul id="conf" class="nav sidebar-subnav collapse">
                              <li class="sidebar-subnav-header">Configuracion</li>
                              <li class={{ (Request::is('configuraciones.conceptos')) ? "active" : "" }} >
                                 <a href="{{route('configuraciones.conceptos')}}" title="Conceptos Gastos">
                                    <span>Conceptos Gastos</span>
                                 </a>
                              </li>
                               <li class={{ (Request::is('configuraciones.tipos_cmc')) ? "active" : "" }} >
                                 <a href="{{route('configuraciones.tipos_cmc')}}" title="Tipo Camiones">
                                    <span>Tipo Camiones</span>
                                 </a>
                              </li>
                              <li class={{ (Request::is('configuraciones.posiciones_view')) ? "active" : "" }} >
                                 <a href="{{route('configuraciones.posiciones_view')}}" title="Posiciones">
                                    <span>Posiciones</span>
                                 </a>
                              </li>
                              <li class={{ (Request::is('configuraciones.item_ft_view')) ? "active" : "" }} >
                                 <a href="{{route('configuraciones.item_ft_view')}}" title="Item Facturacion">
                                    <span>Item Facturacion</span>
                                 </a>
                              </li>
                              <li class={{ (Request::is('configuraciones.asignar_viajes')) ? "active" : "" }} >
                                 <a href="{{route('register')}}" title="Usuarios">
                                    <span>Usuarios</span>
                                 </a>
                              </li>
                           </ul>
                        </li>
                     @endif
                                       
                  @if (in_array(Auth::user()->rol_id,array(1,2,6,4)))
                       <li class={{ (Request::is('reportes/*')) ? "active" : "" }}>
                     <a href="#rep" title="rep" data-toggle="collapse">
                        <em class="fa fa-file-text"></em>
                        <span data-localize="sidebar.nav.rep">Reportes</span>
                     </a>
                     <ul id="rep" class="nav sidebar-subnav collapse">
                        <li class="sidebar-subnav-header">Reportes</li>
                        <li class={{ (Request::is('reportes.facturacion')) ? "active" : "" }} >
                           <a href="{{route('reportes.facturacion')}}" title="Reporte de facturacion">
                              <span>Reporte de facturacion</span>
                           </a>
                        </li>
                         <li class={{ (Request::is('reportes.viajes')) ? "active" : "" }}>
                           <a href="{{route('reportes.viajes')}}" title="Reporte de viajes por camion">
                              <span>Reporte de viajes</span>
                           </a>
                        </li>
                        <li class={{ (Request::is('reportes.gastos')) ? "active" : "" }}>
                           <a href="{{route('reportes.gastos')}}" title="Reporte de gastos">
                              <span>Reporte de gastos</span>
                           </a>
                        </li>
                     </ul>
                  </li> 
                  @endif
                  
                     
                  </ul>
                  <!-- END sidebar nav-->
               </nav>
            </div>
            <!-- END Sidebar (left)-->
         </aside>
         <!-- offsidebar-->
         <aside class="offsidebar hide">
            <!-- START Off Sidebar (right)-->
            <nav>
               <div role="tabpanel">
                  <!-- Nav tabs-->
                  <ul role="tablist" class="nav nav-tabs nav-justified">
                     
                     <li role="presentation">
                        <a href="#app-chat" class="active" aria-controls="app-chat" role="tab" data-toggle="tab">
                           <em class="icon-user fa-lg"></em>
                        </a>
                     </li>
                  </ul>
                  <!-- Tab panes-->
                  <div class="tab-content">
                     
                     <div id="app-chat" role="tabpanel" class="tab-pane fade in active">
                        <h3 class="text-center text-thin">Session</h3>
                        
                        <a href="#" class="media-box p mt0">
                           <span class="pull-right">
                              <span class="circle circle-success circle-lg"></span>
                           </span>
                           <span class="pull-left">
                              <!-- Contact avatar-->
                              <em class="icon-user fa-lg media-box-object img-circle thumb48"></em>
                           </span>
                           <!-- Contact info-->
                           <span class="media-box-body">
                              <span class="media-box-heading">
                                 <strong>{{Auth::user()->name}}</strong>
                              </span>
                           </span>
                        </a>
                     </div>
                     <div id="app-chat" role="tabpanel" class="tab-pane fade in active">
                        <form action="{{route('logout')}}" method="post">
                           {{ csrf_field() }}
                           {{-- <input type="submit" class="" name=""> --}}
                           <button type="submit" class="btn-link pull-left"><em class="icon-logout fa-lg"></em> Logout</button>
                        </form>
                     </div>
                  </div>
               </div>
            </nav>
            <!-- END Off Sidebar (right)-->
         </aside>
         <!-- Main section-->
         <section>
            <!-- Page content-->
            <div class="content-wrapper">
               
               @yield('content')
               
            </div>
         </section>
         <input type="hidden" value="{{URL::to('/')}}" id="baseurl"/>
      </div>
      <script src="{{asset('js/view/main.js')}}"></script>
      <script src="{{asset('js/view/empleado.js')}}"></script>
      <script src="{{asset('js/view/camion.js')}}"></script>
      <script src="{{asset('js/view/cliente.js')}}"></script>
      <script src="{{asset('js/view/facturacion.js')}}"></script>
      {{--  <script src="https://momentjs.com/downloads/moment.min.js"></script>  --}}

        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
      
      <!-- =============== VENDOR SCRIPTS ===============-->
      <!-- MODERNIZR-->
      <script src="{{asset('/vendor/modernizr/modernizr.custom.js')}}"></script>
      <!-- MATCHMEDIA POLYFILL-->
      {{-- <script src="{{asset('/vendor/matchMedia/matchMedia.js')}}"></script> --}}
      <!-- JQUERY-->
      {{--  <script src="{{asset('/vendor/jquery/dist/jquery.js')}}"></script>  --}}
      <!-- BOOTSTRAP-->
      <script src="{{asset('/vendor/bootstrap/dist/js/bootstrap.js')}}"></script>
      <!-- STORAGE API-->
      <script src="{{asset('/vendor/jQuery-Storage-API/jquery.storageapi.js')}}"></script>
      <!-- JQUERY EASING-->
      <script src="{{asset('/vendor/jquery.easing/js/jquery.easing.js')}}"></script>
      <!-- ANIMO-->
      <script src="{{asset('/vendor/animo.js/animo.js')}}"></script>
      <!-- SLIMSCROLL-->
      <script src="{{asset('/vendor/slimScroll/jquery.slimscroll.min.js')}}"></script>
      <!-- SCREENFULL-->
      <script src="{{asset('/vendor/screenfull/dist/screenfull.js')}}"></script>
      <!-- LOCALIZE-->
      {{--  <script src="{{asset('/vendor/jquery-localize-i18n/dist/jquery.localize.js')}}"></script>  --}}
      <!-- TAGS INPUT-->
      <script src="{{ asset('vendor/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
      <!-- CHOSEN-->
      <script src="{{ asset('vendor/chosen_v1.2.0/chosen.jquery.min.js') }}"></script>
      <!-- INPUT MASK-->
      <script src="{{ asset('vendor/jquery.inputmask/dist/jquery.inputmask.bundle.js') }}"></script>
      <!-- DATETIMEPICKER-->
      {{--  <script type="text/javascript" src="{{ asset('vendor/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>  --}}
      <!-- COLORPICKER-->
      {{--  <script type="text/javascript" src="{{ asset('vendor/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.js') }}"></script>  --}}
      <!-- SELECT2-->
      <script src="{{ asset('vendor/select2/dist/js/select2.js') }}"></script>
      <!-- RTL demo-->
      <script src="{{asset('js/demo/demo-rtl.js')}}"></script>
      <script src="{{asset('js/demo/demo-panels.js')}}"></script>
      <script src="{{asset('js/bootstrap-dialog.js')}}"></script>
      <!-- =============== APP SCRIPTS ===============-->
      <script src="{{asset('js/app.js')}}"></script>
      {{-- <script src="{{asset('js/jquery.dataTables.min.js')}}"></script> --}}
      
      <script src="{{ asset('vendor/datatables/media/js/jquery.dataTables.min.js') }}"></script>
      <script src="{{ asset('vendor/datatables-colvis/js/dataTables.colVis.js') }}"></script>
      <script src="{{ asset('vendor/datatables/media/js/dataTables.bootstrap.js') }}"></script>
      <script src="{{ asset('vendor/datatables-buttons/js/dataTables.buttons.js') }}"></script>
      <script src="{{ asset('vendor/datatables-buttons/js/buttons.bootstrap.js') }}"></script>
      <script src="{{ asset('vendor/datatables-buttons/js/buttons.colVis.js') }}"></script>
      <script src="{{ asset('vendor/datatables-buttons/js/buttons.flash.js') }}"></script>
      <script src="{{ asset('vendor/datatables-buttons/js/buttons.html5.js') }}"></script>
      <script src="{{ asset('vendor/datatables-buttons/js/buttons.print.js') }}"></script>
      <script src="{{ asset('vendor/datatables-responsive/js/dataTables.responsive.js') }}"></script>
      <script src="{{ asset('vendor/datatables-responsive/js/responsive.bootstrap.js') }}"></script>
      <script src="{{asset('js/jquery.mask.js')}}"></script>
      {{--  <script src="{{asset('js/bootstrap-datepicker.js')}}"></script>  --}}
         <!-- PARSLEY-->
      <script src="{{asset('vendor/parsleyjs/dist/parsley.min.js')}}"></script>
      <!-- SWEET ALERT-->
      {{-- <script src="{{asset('vendor/sweetalert/dist/sweetalert.min.js')}}"></script> --}}
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

      <script type="text/javascript">
      $(document).ready(function(){
         $('.date').mask('00/00/0000');
         // $('.time').mask('00:00:00');
         $('.date_time').mask('00/00/0000 00:00:00');
         $('.cedula').mask('000-0000000-0');
         $('.phone').mask('(000) 000-0000');
         
         $('.money').mask('000.000.000.000.000,00', {reverse: true});
         
         $('.datepicker').datepicker({
            dateFormat: 'yy-mm-dd',
            autoclose: true
         });
      
      });
      </script>
   </body>
</html>