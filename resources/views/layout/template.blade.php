<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Robust admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template.">
    <meta name="keywords" content="admin template, robust admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="PIXINVENT">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CRM</title>
    <link rel="apple-touch-icon" href="{{asset("app-assets/images/ico/apple-icon-120.png")}}">
    <link rel="shortcut icon" type="image/x-icon" href="https://pixinvent.com/bootstrap-admin-template/robust/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CMuli:300,400,500,700" rel="stylesheet">
	  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">  
 
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset("app-assets/css/vendors.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("app-assets/vendors/css/tables/datatable/datatables.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("app-assets/vendors/css/extensions/unslider.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("app-assets/vendors/css/weather-icons/climacons.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("app-assets/vendors/css/extensions/sweetalert.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("app-assets/vendors/css/extensions/toastr.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/forms/selects/select2.min.css')}}">
    <!-- END VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset("app-assets/vendors/css/forms/icheck/icheck.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("app-assets/vendors/css/forms/icheck/custom.css")}}">
    <!-- BEGIN ROBUST CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset("app-assets/css/app.min.css")}}">
    <!-- END ROBUST CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset("app-assets/css/core/menu/menu-types/vertical-menu.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("app-assets/css/core/colors/palette-gradient.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("app-assets/css/plugins/calendars/clndr.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("app-assets/css/core/colors/palette-climacon.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("app-assets/css/pages/users.min.css")}}">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/style.css")}}">
    <!-- END Custom CSS-->
  </head>

  <body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-col="2-columns">

 @include('layout.header')

 
 @include('layout.sidebar')

 <div class="app-content content">
   <div class="content-wrapper">
      @yield('actions')
      <div class="content-body">
        @yield('content')
      </div>
   </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade text-left" id="edit_profile_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel1">Edit Profile</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <div class="card">			
				<div class="card-content collapse show">
					<div class="card-body">						
						<form class="form" id="profile_form" autocomplete="off">
                @csrf
              <input type="hidden" value="{{Auth::user()->id}}" id="user_id" name="user_id"/>
							<div class="form-body">
								<h4 class="form-section"><i class="ft-user"></i> Personal Info</h4>
								<div class="row">

									<div class="col-md-6">
										<div class="form-group">
											<label for="first_name">First Name</label>
											<input type="text" id="first_name" class="form-control" placeholder="First Name" name="first_name">
                       <code class="first_name-error" style="background-color: inherit;"></code>
										</div>
									</div>
                  <div class="col-md-6">
										<div class="form-group">
											<label for="last_name">Last Name</label>
											<input type="text" id="last_name" class="form-control" placeholder="Last Name" name="last_name">
                       <code class="last_name-error" style="background-color: inherit;"></code>
										</div>
									</div>								
								</div>
                <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" class="form-control" placeholder="Email" name="email">
                    <code class="email-error" style="background-color: inherit;"></code>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="mobile">Mobile</label>
                    <input type="text" id="mobile" class="form-control" placeholder="Mobile" name="mobile">
                    <code class="mobile-error" style="background-color: inherit;"></code>
                  </div>
                </div>
                </div>
                <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <input type="password" id="current_password" class="form-control" placeholder="Current Password" name="current_password">
                    <code class="current_password-error" style="background-color: inherit;"></code>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" id="new_password" class="form-control" placeholder="New Password" name="new_password">
                    <code class="new_password-error" style="background-color: inherit;"></code>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="re_enter_password">Re-Enter Password</label>
                    <input type="password" id="re_enter_password" class="form-control" placeholder="Re-Enter Password" name="re_enter_password">
                    <code class="re_enter_password-error" style="background-color: inherit;"></code>
                  </div>
                </div>
                </div>																							
						</form>
					</div>
				</div>
			</div>
        </div>
            <div class="">
                <button type="button" class="btn btn-warning mr-1" data-dismiss="modal"><i class="ft-x"></i> Close</button>
                <button type="button" id="save_profile"  class="btn btn-primary"><i class="fa fa-check-square-o"></i> Save</button>
            </div>
        </div>
        </div>
    </div>
    <!-- End User Modal -->

@include('layout.footer')
    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset("app-assets/vendors/js/vendors.min.js")}}"></script>
    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset("app-assets/vendors/js/tables/datatable/datatables.min.js")}}"></script>
    
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{ asset("app-assets/vendors/js/extensions/jquery.knob.min.js")}}"></script>    
    <script src="{{ asset("app-assets/vendors/js/extensions/moment.min.js")}}"></script>
    <script src="{{ asset("app-assets/vendors/js/extensions/underscore-min.js")}}"></script>
    <script src="{{ asset("app-assets/vendors/js/extensions/clndr.min.js")}}"></script>
    <script src="{{ asset("app-assets/vendors/js/extensions/unslider-min.js")}}"></script>
    <script src="{{ asset("app-assets/vendors/js/extensions/sweetalert.min.js")}}"></script>
    <script src="{{ asset("app-assets/vendors/js/extensions/toastr.min.js")}}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN ROBUST JS-->
    <script src="{{ asset("app-assets/js/core/app-menu.min.js")}}"></script>
    <script src="{{ asset("app-assets/js/core/app.min.js")}}"></script>
    <script src="{{ asset("app-assets/js/scripts/customizer.min.js")}}"></script>
    <script src="{{ asset("app-assets/vendors/js/forms/icheck/icheck.min.js")}}"></script>
    <!-- END ROBUST JS-->    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
    <script>
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $('body').on('click','#edit_profile', function(){
        $.ajax({
            url:'{{route("getprofile")}}',
            method: 'get',
            dataType: 'json'
        }).done(function(res){
          var formfields = $('#profile_form').serializeArray();            
            $.each(formfields,function(k,v){
                if(v.name in res){
                    $('#profile_form').find('#'+v.name).val(res[v.name]);                    
                }
            });   
          $('#edit_profile_modal').modal('show');
        });        
      });

      
    $('#save_profile').on('click',function(){        
        $('#profile_form').ajaxSubmit({
            url:'{{route("saveprofile")}}',
            method:'post',
            success:function(res){
                    toastr.success("", "Saved", { positionClass: "toast-bottom-right", containerId: "toast-bottom-right" });
                    $('#edit_profile_modal').modal('hide');                    
                },
            error: function(json){            
                if(json.status === 422) {
                    toastr.error("", "Error", { positionClass: "toast-bottom-right", containerId: "toast-bottom-right" });                   
                    var errors = json.responseJSON;                        
                    $.each(errors.errors, function (key, value) {                         
                        $('#profile_form .'+key+'-error').html(value);
                    });
                }
            }               
        });        
    });
     

    function generalDelete(swalopt = {}, toastropt = {}, callback){
      swal({
            title: swalopt.title,
            text: "",
            icon: "warning",
            showCancelButton: true,
            buttons: {
                      cancel: {
                        text: "Cancel",
                        value: null,
                        visible: true,
                        className: "btn-warning",
                        closeModal: true,
                    },
                      confirm: {
                        text: "Yes, delete it!",
                        value: true,
                        visible: true,
                        className: "",
                        closeModal: true
                    }
            }
        }).then(isConfirm => {
                if (isConfirm) {                
                    $.ajax({
                        url: swalopt.deleteurl,
                        method: swalopt.method,
                        data: swalopt.ajaxdata,                     
                    }).done(function(res){
                        toastr.success("", toastropt.title, { positionClass: "toast-bottom-right", containerId: "toast-bottom-right" });
                        if(typeof callback == 'function'){
                          callback();
                        }
                    });                
                }
          });

    }
    </script>
    @yield('javascript')
  </body>
</html>