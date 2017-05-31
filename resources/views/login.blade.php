<!DOCTYPE html>
<html lang="es">
	<head>

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon" />
		<title>Iniciar sesión-Sisprova</title>

		<meta name="description" content="Inicio de sesión" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}" />
		<link rel="stylesheet" href="{{url('assets/font-awesome/4.5.0/css/font-awesome.min.css')}}" />
		<!-- text fonts -->
		<link rel="stylesheet" href="{{url('assets/css/fonts.googleapis.com.css')}}" />
		<!-- ace styles -->
		<link rel="stylesheet" href="{{url('assets/css/ace.min.css')}}" />
		{{-- estilo fondo --}}
		<link rel="stylesheet" href="{{url('assets/css/estilo.css')}}" />
		<!--[if lte IE 9]>
			<link rel="stylesheet" href="{{url('assets/css/ace-part2.min.css')}}" />
		<![endif]-->
		<link rel="stylesheet" href="{{url('assets/css/ace-rtl.min.css')}}" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="{{url('assets/css/ace-ie.min.css')}}" />
		<![endif]-->
		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->
		<!--[if lte IE 8]>
			<script src="{{url('assets/js/html5shiv.min.js')}}"></script>
			<script src="{{url('assets/js/respond.min.js')}}"></script>
		<![endif]-->
	</head>

	<body class="login-layout light-login" style="background-size: cover; background-image: url('{{ url('Fondo3.jpg')}}">

		<div class="main-container">

			<div class="main-content">

				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center">

							</div>

							<div class="space-6"></div>

							@if(Session::has('message'))

								<div id="alert" class="alert alert-{{Session::get('class')}}">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									{{Session::get('message')}}
								</div>
							@endif

							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header blue lighter bigger">
												Iniciar sesión
											</h4>

											<div class="space-6"></div>

											<form action="{{url('check')}}" id="validation-login" method="post">
                        {{ csrf_field() }}
												<fieldset>
													<label class="block clearfix form-group">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" placeholder="Cedula" name="cedula" autocomplete="off" autofocus="true">
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>

													<label class="block clearfix form-group">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" placeholder="Contraseña" name="password" />
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>

													<div class="space"></div>

													<div class="clearfix">


														<button class="width-35 pull-right btn btn-sm btn-primary">
															<i class="ace-icon fa fa-key"></i>
															<span class="bigger-110">Iniciar</span>
														</button>
													</div>

													<div class="space-4"></div>
												</fieldset>
											</form>
										</div><!-- /.widget-main -->

										<div class="toolbar clearfix">
											<div class="col-md-offset-3">
											</div>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.login-box -->

								<!-- /.forgot-box -->


							</div><!-- /.position-relative -->
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
			<img src="{{url('logo.png')}}" style="position:absolute; right:2%; top:70%; height: auto;">
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="{{url('assets/js/jquery-2.1.4.min.js')}}"></script>
		<!-- <![endif]-->

		<!--[if IE]>
			<script src="{{url('assets/js/jquery-1.11.3.min.js')}}"></script>
		<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='{{url('assets/js/jquery.mobile.custom.min.js')}}'>"+"<"+"/script>");
		</script>

		<!-- inline scripts related to this page -->
		<script src="{{url('assets/js/jquery.validate.min.js')}}"></script>
		<script src="{{url('assets/js/jquery-additional-methods.min.js')}}"></script>

		<script type="text/javascript">
			jQuery(function($) {

				$(document).on('click', '.toolbar a[data-target]', function(e) {
					e.preventDefault();
					var target = $(this).data('target');
					$('.widget-box.visible').removeClass('visible');//hide others
					$(target).addClass('visible');//show target
				});


				$('#validation-login').validate({
					errorElement: 'label',
					errorClass: 'help-block',
					focusInvalid: false,
					ignore: "",
					rules: {
						user: 	  {required: true},
						password: {required: true}
					},
					messages: {
						user: "El usuario es requerido",
						password: "La contraseña es requerida"
					},
					highlight: function (e) {
						$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
					},
					success: function (e) {
						$(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
						$(e).remove();
					},
					errorPlacement: function (error, element) {
						error.insertAfter(element.parent());
					},
					submitHandler: function (form) {
						form.submit();
					},
					invalidHandler: function (form) {
					}
				}); //validacion de los campos del formulario de login

			});

		</script>
	</body>
</html>
