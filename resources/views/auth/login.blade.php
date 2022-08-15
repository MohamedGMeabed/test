
<html lang="en">
	<!--begin::Head-->
	<head>
        <title>{{ env('APP_NAME') }}</title>
		<meta charset="utf-8" />
		<meta name="description" content="description" />
		<meta name="keywords" content="keywords , keywords , keywords" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="title" />
		<meta property="og:url" content="{{ url('/') }}" />
		<meta property="og:site_name" content="{{ env('APP_NAME') }}" />
		<link rel="canonical" href="{{ url('/') }}" />
		<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
		<!--begin::Fonts-->
        <link href="{{ asset('assets/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/style.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />

	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="bg-body">
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<!--begin::Aside-->
				<div class="d-flex flex-column flex-lg-row-auto w-xl-600px positon-xl-relative" style="background-color: #1e1e2d">
					<!--begin::Wrapper-->
					<div class="d-flex flex-column justify-content-center align-items-center position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
					
						<!--begin::Illustration-->
						<div class="d-flex w-100 flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px" style="background-image: url({{ asset('assets/Tabadul-logo.png') }})"></div>
						<!--end::Illustration-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Aside-->
				<!--begin::Body-->
				<div class="d-flex flex-column flex-lg-row-fluid py-10">
					<!--begin::Content-->
					<div class="d-flex flex-center flex-column flex-column-fluid">
						<!--begin::Wrapper-->
						<div class="w-lg-500px p-10 p-lg-15 mx-auto">
							<!--begin::Form-->
							<form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="post" action="{{ route('login') }}" >
								<!--begin::Heading-->
                                @csrf
								<div class="text-center mb-10">
									<!--begin::Title-->
									<h1 class="text-dark mb-3">Sign In to {{ env('APP_NAME') }}</h1>
									<!--end::Title-->

								</div>
								<!--begin::Heading-->
								<!--begin::Input group-->
								<div class="fv-row mb-10">
									<!--begin::Label-->
									<label class="form-label fs-6 fw-bolder text-dark">Email</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input class="form-control form-control-lg form-control-solid" type="text" name="email" autocomplete="off" />
									<!--end::Input-->
								</div>
								<!--end::Input group-->
								<!--begin::Input group-->
								<div class="fv-row mb-10">
									<!--begin::Wrapper-->
									<div class="d-flex flex-stack mb-2">
										<!--begin::Label-->
										<label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
										<!--end::Label-->
										<!--begin::Link-->
										<a href="{{route('password.request')}}" class="link-primary fs-6 fw-bolder">Forgot Password ?</a>
										<!--end::Link-->
									</div>
									<!--end::Wrapper-->
									<!--begin::Input-->
									<input class="form-control form-control-lg form-control-solid" type="password" name="password" autocomplete="off" />
									<!--end::Input-->
								</div>


								<div class="fv-row mb-10">
                                    <!--begin::Wrapper-->
									<div class="d-flex flex-stack mb-2">
                                        <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack">
                                            <span class="form-check-label text-gray-700 fs-6 fw-bold ms-0 me-2">Remember Me</span>
                                            <input class="form-check-input bordered" name="remember_me" type="checkbox" value="1" checked="checked" />
                                        </label>
									</div>
									<!--end::Wrapper-->
                                </div>

								<!--end::Input group-->
								<!--begin::Actions-->
								<div class="text-center">
									<!--begin::Submit button-->
									<button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5"  @if(Session::has('timer') || Session::has('locked'))  disabled @endif>
                                        @if(Session::has('locked'))
                                            <p class="alert alert-danger">{{ Session::get('locked') }}</p>
                                        @else
                                        <p  id="timer-p"  @if(!Session::has('timer')) style="display: none" @endif >you locked for <span id="timer"> {{ Session::get('timer') }} </span> seconds</p>
										<span id="continue" class="indicator-label" @if(Session::has('timer')) style="display: none" @endif>Continue</span>
                                        @endif
									</button>
									<!--end::Submit button-->
								</div>
								<!--end::Actions-->
							</form> 
							<!--end::Form-->
						</div>
						<!--end::Wrapper-->
					</div>
					<!--end::Content-->
				</div>
				<!--end::Body-->
			</div>
			<!--end::Authentication - Sign-in-->
		</div>
		<!--end::Root-->
		<!--end::Main-->
		<!--begin::Javascript-->
		<script>var hostUrl = "assets/";</script>
        <script src="{{  asset('assets/plugins.bundle.js')  }}"></script>
        <script src="{{  asset('assets/scripts.bundle.js')  }}"></script>
        <script>

            let timer = parseInt("{{ Session::get('timer') }} ");
            let locked = "{{ Session::has('locked') ? 0 : 1  }}";
            
            var time = setInterval(() => {
                timer -- ;
                $("#timer").html(timer);
                if(timer == 0)
                {
                    clearInterval(time);
                    $("#kt_sign_in_submit").prop('disabled',false);
                    $("#timer-p").hide();
                    $("#continue").show();
                }
            }, 1000);

            $("#kt_sign_in_form").submit(function(){
                if(timer > 0 || locked == 0){
                    return false;
                }
            });
        </script>
	</body>
	<!--end::Body-->
</html>
