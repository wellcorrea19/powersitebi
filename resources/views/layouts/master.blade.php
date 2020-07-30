<!DOCTYPE HTML>
<html>
<head>
<title>Power BI Painel</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
 <!-- Bootstrap Core CSS -->
<link href="{{ asset('css/bootstrap.min.css')}}" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="{{ asset('css/style.css')}}" rel='stylesheet' type='text/css' />
<!-- Graph CSS -->
<link href="{{ asset('css/font-awesome.css')}}" rel="stylesheet"> 
<!-- jQuery -->
<!-- lined-icons -->
<link rel="stylesheet" href="{{ asset('css/icon-font.min.css')}}" type='text/css' />
<!-- //lined-icons -->
<!-- chart -->
<script src="js/Chart.js"></script>
<!-- //chart -->
<!--animate-->
<link href="{{ asset('css/animate.css')}}" rel="stylesheet">
<script src="{{ asset('js/wow.min.js')}}"></script>
<!--//end-animate-->
<!----webfonts--->
<link href='//fonts.googleapis.com/css?family=Cabin:400,400italic,500,500italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>

<!---//webfonts---> 
 <!-- Meters graphs -->
<script src="{{ asset('js/jquery-1.10.2.min.js')}}"></script>
<!-- Placed js at the end of the document so the pages load faster -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>


</head> 
   
 <body class="sticky-header left-side-collapsed">
    <section>
    <!-- left side start-->
		<div class="left-side sticky-left-side">

			<!--logo and iconic logo start-->
			<div class="logo">
				<h1><a>Elo <span>Softwares</span></a></h1>
			</div>
			<div class="logo-icon text-center">
				<a href="/" @if (Route::is('dashboard')) class="mm-active"  @endif><i class="lnr lnr-home"></i> </a>
			</div>

			<!--logo and iconic logo end-->
			<div class="left-side-inner">

				<!--sidebar nav start-->
                <ul class="nav nav-pills nav-stacked custom-nav">
                    <li><a href="{{route('faturamento')}}" @if (Route::is('faturamento')) class="mm-active"  @endif><i class="lnr lnr-pie-chart"></i><span>Faturamento</span></a></li>
                    <li><a href="{{route('fat-comp')}}" @if (Route::is('fat-comp')) class="mm-active"  @endif><i class="lnr lnr-chart-bars"></i> <span>Fat. Comparativo</span></a></li>
                    <li class="menu-list">
                        <a><i class="lnr lnr-pie-chart"></i>
                            <span>Operacional</span></a>
                            <ul class="sub-menu-list">
                                <li><a href="{{route('resultlucbru')}}"  @if (Route::is('resultlucbru')) class="mm-active" @endif>Lucro Bruto</a> </li>
                                <li><a href="{{route('resultlucliq')}}"  @if (Route::is('resultlucliq')) class="mm-active" @endif="">Lucro Liquído</a></li>
                                <li><a href="{{route('resultquant')}}"  @if (Route::is('resultquant')) class="mm-active" @endif>Quantitativo</a></li>
                            </ul>
                    </li>
                    <li><a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="lnr lnr-power-switch"></i>
                        <span>Sair</span></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form> 
                    </li>

                </ul>
				<!--sidebar nav end-->
			</div>
		</div>
		<!-- left side end-->
    
		<!-- main content start-->
		<div class="main-content">
			<!-- header-starts -->
			<div class="header-section">
			 
			<!--toggle button start-->
			<a class="toggle-btn  menu-collapsed"><i class="fa fa-bars"></i></a>
			<!--toggle button end-->

			<!--notification menu start -->
			<div class="menu-right">
				<div class="user-panel-top">  	
					<div class="profile_details">		
						<ul>
							<li class="dropdown profile_details_drop">
								<div class="profile_img">	
									<span style="background:url(images/1.jpg) no-repeat center"> </span> 
										<div class="user-name">
										<p>{{ Auth::user()->name }}<span>Administrator</span></p>
										</div>
									<div class="clearfix"></div>	
								</div>	
								
								<ul class="dropdown-menu drp-mnu">
									<li> <a href=""><i class="fa fa-cog"></i> Settings</a> </li> 
									<li> <a href=""><i class="fa fa-user"></i>Profile</a> </li> 
									<li>
										<a class="dropdown-item" href="{{ route('logout') }}"
											onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                             <i class="fa fa-sign-out"></i>
                                             {{ __('Logout') }}
                                            
										</a>
										<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
											@csrf
										</form> 
									</li>
								</ul>
							</li>
							<div class="clearfix"> </div>
						</ul>
					</div>		           	
					<div class="clearfix"></div>
				</div>
			  </div>
            </div>
            @yield('content')
		</div>
        <!--footer section start-->
			<footer>
			   <p>&copy 2020 Elo Softwares. Todos os Direitos Reservados.</a></p>
			</footer>
        <!--footer section end-->

      <!-- main content end-->
   </section>
  
<script src="{{ asset('/js/jquery.nicescroll.js')}}"></script>
<script src="{{ asset('/js/scripts.js')}}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('/js/bootstrap.min.js')}}"></script>
</body>
</html>