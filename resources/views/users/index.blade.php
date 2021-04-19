@extends('layout.template', ['breacrums'=>'Users'])


@section('actions')
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/passwordstrength.css')}}">
<div class="content-header row">
          <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Users List</h3>
            <div class="row breadcrumbs-top d-inline-block">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                  <li class="breadcrumb-item"><a href="#">Users List</a></li>         
                </ol>
              </div>
            </div>
          </div>
          @canany(['user-full_access','user-read_write'])
          <div class="content-header-right col-md-4 col-12">
            <div class="btn-group float-md-right">           
              <a class="btn btn-info add_user" href="javascript:;" data-toggle="modal" data-target="#add_user_modal"><i class="fa fa-plus"></i> Add User</a>          
            </div>
          </div>
          @endcanany
        </div>
@endsection

@section('content')
<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Users List</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">                                                     
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>                            
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">                        
                        <table class="table table-striped table-bordered user-list" style = "width:100%">
                            <thead>
                                <tr>
                                    <th>User Id</th>
                                    <th>Name</th>                                                                  
                                    <th>Email</th>                                                             
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>                           
                            </tbody>                      
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Add User Modal -->
    <div class="modal fade text-left" id="add_user_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel1">Add/Edit User</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>

            <div class="modal-body">

            <div class="card">			
				<div class="card-content collapse show">
					<div class="card-body">						
						<form class="form" id="user_form" autocomplete="off">
                            @csrf
                            <input type="hidden" value="" id="user_id" name="user_id"/>
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
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="projectinput3">E-mail</label>
											<input type="text" id="email" class="form-control" placeholder="E-mail" name="email">
                                            <code class="email-error" style="background-color: inherit;"></code>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="projectinput4">Contact Number</label>
											<input type="text" id="phone" class="form-control" placeholder="Phone" name="phone">
										</div>
									</div>
								</div>

								<h4 class="form-section"><i class="fa fa-paperclip"></i> User Details</h4>                               
                                @canany(['user-full_access','user-read_write'])
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" autocomplete="off" id="username" class="form-control" placeholder="User Name" name="username">
                                        <code class="username-error" style="background-color: inherit;"></code>
                                    </div>                                
                                    <label for="password">Password</label>
                                    <fieldset class="form-group position-relative">                               
                                        <input type="password" onkeyup="trigger()" autocomplete="off" class="form-control" id="password" name="password"  placeholder="Password">
                                        <code class="password-error" style="background-color: inherit;"></code>                             
                                        <div class="form-control-position showpassword">
                                            <i class="ft-eye"></i>
                                        </div>
                                        <div class="indicator" >
                                            <span class="weak"></span>
                                            <span class="medium"></span>
                                            <span class="strong"></span>
                                        </div>                                   
                                    </fieldset>
                                @endcanany

                                <div class="form-group">
									<label for="role">Role</label>
									<select id="role" name="role" class="form-control">
                                        @foreach($roles as $v)
                                            <option value="{{$v}}">{{$v}}</option>
                                        @endforeach
									</select>
								</div>														
						</form>
					</div>
				</div>
			</div>
        </div>
            <div class="">
                <button type="button" class="btn btn-warning mr-1" data-dismiss="modal"><i class="ft-x"></i> Close</button>
                @canany(['user-full_access','user-read_write'])
                    <button type="button" id="save_user"  class="btn btn-primary"><i class="fa fa-check-square-o"></i> Save</button>
                @endcanany
            </div>
        </div>
        </div>
    </div>
    <!-- End User Modal -->
@endsection



@section('javascript')

<script src="{{asset("app-assets/js/passwordstrength.js")}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
<script>

    $('.showpassword').on('click', function(){
        $(this).find('i').toggleClass('ft-eye ft-eye-off');
        var _type = $(this).parent().find('#password').get(0).type;
        if(_type == 'password'){
            $(this).parent().find('#password').get(0).type = 'text';
        }else{
            $(this).parent().find('#password').get(0).type = 'password';
        }
       
    });

    $('#save_user').on('click',function(){
        clearUserError();
        $('#user_form').ajaxSubmit({
            url:'{{route("saveuser")}}',
            method:'post',
            success:function(res){
                    toastr.success("", "Saved", { positionClass: "toast-bottom-right", containerId: "toast-bottom-right" });
                    $('#add_user_modal').modal('hide');
                    list_users();
                },
            error: function(json){            
                if(json.status === 422) {
                    toastr.error("", "Error", { positionClass: "toast-bottom-right", containerId: "toast-bottom-right" });
                    var errors = json.responseJSON;       
                    $.each(errors.errors, function (key, value) {          
                        $('#user_form .'+key+'-error').html(value);
                    });
                }
            }               
        });        
    });

    function resetUserForm(){
        $('#user_form')[0].reset();        
        $('#user_form').find("input[type=hidden]").val('0');
    }

    function clearUserError(){        
        $('#user_form code').each(function (key, value) {                       
            $(this).html('');
        });
    }

    $('#add_user_modal').on('hidden.bs.modal', function () {
        resetUserForm();     
        clearUserError();
    });

    $('body').on('click', '.edit_user', function(){
        var user_id= $(this).data('user_id');
        $.ajax({
            url: '{{route("getuser")}}',
            method: 'get',
            data: {'user_id': user_id},
            dataType: 'json',
        }).done(function(res){
            var formfields = $('#user_form').serializeArray();
            $('#user_form #user_id').val(res.id);
            $.each(formfields,function(k,v){
                if(v.name in res){
                    $('#user_form').find('#'+v.name).val(res[v.name]);                   
                }
            });        
            $('#add_user_modal').modal('show');   
        });

    });

    $('body').on('click', '.delete_user', function(){
        var user_id = $(this).data('user_id');
        var swalopt = { 'title': "Delete User?",
                       'deleteurl' : '{{route("deleteuser")}}',
                       'method' : 'delete',
                       'ajaxdata' : {'user_id':user_id}
                     };
       var toastropt = { 'title': "User Deleted"};

       generalDelete(swalopt, toastropt, list_users);
    });

    var user_list;
    var list_users = function(){
        if ($.fn.DataTable.isDataTable('.user-list')) {
                user_list.destroy();
        }
        user_list = $(".user-list").DataTable({
                        "pageLength": 20,
                        "bLengthChange": false,
                        searching: false,
                        processing: true,
                        serverSide: true,
                        ajax: "{{ route('listusers') }}",
                        columns: [
                            {data: 'id', name: 'id'},
                            {data: 'name', name: 'name'},
                            {data: 'email','name':'email'},
                            {data: 'username','name':'username'},
                            {data: 'role', name: 'role'},                
                            {data: 'action', name: 'action', orderable: false, searchable: false},
                        ],
                        'order': [[0, "desc" ]],
                    });  
    }


    $(document).ready(function(){
        list_users();
    });
</script>
@endsection
