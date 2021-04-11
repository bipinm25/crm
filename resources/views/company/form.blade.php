@extends('layout.template')

@section('content')




<section id="basic-form-layouts">
	<div class="row match-height">

    <div class="col-xl-12 col-lg-12">
			<div class="card">
                <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form">Company Info</h4>
                        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">                                            
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
				<div class="card-content">
					<div class="card-body">				
						<ul class="nav nav-tabs">
							<li class="nav-item">
								<a class="nav-link active" id="base-tab1" data-toggle="tab" aria-controls="tab1" href="#tab1" aria-expanded="true">General</a>
							</li>
                            @if($company->id > 0)
                                <li class="nav-item">
                                    <a class="nav-link" id="base-tab3" data-toggle="tab" aria-controls="tab3" href="#tab3" aria-expanded="false">Followup Comments</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="base-tab2" data-toggle="tab" aria-controls="tab2" href="#tab2" aria-expanded="false">Company Staffs</a>
                                </li>				
                            @endif									
						</ul>
						<div class="tab-content px-1 pt-1">
							<div role="tabpanel" class="tab-pane active" id="tab1" aria-expanded="true" aria-labelledby="base-tab1">
                                                            
                            <div class="card">                                          
                                <div class="card-content collapse show">
                                    <div class="card-body">						
                                        <form class="form" method="post" action="{{route('savecompany')}}">
                                            @csrf
                                            <input type="hidden" name="company_id" value="{{$company->id}}"/>
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-menu"></i> Basic Details</h4>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="company_name">Company Name</label>                                                            
                                                            <input type="text" id="company_name" value="{{$company->name}}" class="form-control @error('company_name') border-danger @enderror" placeholder="Company Name" name="company_name">                                                           
                                                            @if($errors->has('company_name'))
                                                                <code style="background-color: inherit;">{{ $errors->first('company_name') }}</code>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="mobile">Mobile</label>
                                                            <input type="text" value="{{$company->mobile}}" id="mobile" class="form-control" placeholder="Mobile" name="mobile">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="email">E-mail</label>
                                                            <input type="text" value="{{$company->email}}" id="email" class="form-control" placeholder="E-mail" name="email">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="status">Status</label>
                                                            <select id="status" name="status_id" class="form-control">
                                                                <option value="0">Status</option>
                                                                    @foreach(Config('general_settings.company_status') as $key => $val)
                                                                        <option {{ $key == $company->status_id?'selected':''}}  value="{{$key}}">{{$val}}</option>
                                                                    @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">                                               
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                        <label for="sub_status">Sub-Status</label>
                                                            <select id="sub_status" name="sub_status_id" class="form-control">
                                                                <option value="0">Sub Status</option>
                                                                    @foreach(Config('general_settings.company_sub_status') as $k => $v)
                                                                        <option {{ $k == $company->sub_status_id?'selected':''}} value="{{$k}}">{{$v}}</option>
                                                                    @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="contact_person">Contact Person</label>
                                                            <input type="text" id="contact_person" class="form-control" placeholder="Contact Person" name="contact_person">
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="full_address">Full Address</label>
                                                            <textarea id="full_address" rows="3" class="form-control" name="full_address" placeholder="Full Address">{{$company->full_address}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-actions">                                               
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-check-square-o"></i> Save
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                                    	
							
							</div>
							<div class="tab-pane" id="tab2" aria-labelledby="base-tab2">
                                    <div class="btn-group float-md-right">           
                                    <a class="btn btn-info add_staff" href="javascript:;" data-toggle="modal" data-target="#add_staff_modal"><i class="fa fa-plus"></i> Add Staff</a>        
                                    </div>
                            <div class="card-content collapse show">
                                <div class="card-body">                                   
                               
                                    <table class="table table-striped table-bordered staff-list" style="width: 100% !important;">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Mobile</th>                                                                             
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>                      
                                    </table>
                                </div>
                            </div>
							</div>
                            
                            <div class="tab-pane" id="tab3" aria-labelledby="base-tab3">
                            
                            <div class="timeline-card card border-grey border-lighten-2">                
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="row">                                                
                                                <div class="col-lg-12 col-12">
                                                <div id="comment_div"></div>
                                                
                                                <div class="form-actions">
                                                <section class="chat-app-form">
                                                    <form class="chat-app-input d-flex">
                                                    <fieldset class="form-group position-relative has-icon-left col-10 m-0">
                                                        <div class="form-control-position">
                                                        <i class="icon-emoticon-smile"></i>
                                                        </div>
                                                        <input type="text" data-parent_id="0" class="form-control comments" id="iconLeft4-message" placeholder="Write comments...">
                                                        <div class="form-control-position control-position-right">
                                                        <i class="fa fa-paper-plane-o"></i>
                                                        </div>
                                                    </fieldset>
                                                    <fieldset class="form-group position-relative has-icon-left col-2 m-0">
                                                        <button type="button" class="btn btn-info send_comment"><span class="d-none d-lg-block">Send</span></button>
                                                    </fieldset>
                                                    </form>
                                                </section>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

			
	</div>
</section>

<!-- Add User Modal -->
<div class="modal fade text-left" id="add_staff_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel1">Add/Edit Staff</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>

            <div class="modal-body">

            <div class="card">			
				<div class="card-content collapse show">
					<div class="card-body">						
						<form class="form" id="staff_form" autocomplete="off">
                            @csrf
                            <input type="hidden" value="{{$company->id}}" name="company_id"/>
                            <input type="hidden" value="0" name="staff_id"/>
							<div class="form-body">
								<h4 class="form-section"><i class="ft-user"></i> Personal Info</h4>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="first_name">First Name</label>
											<input type="text" id="first_name" class="form-control" placeholder="First Name" name="first_name">
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
											<input type="text" id="projectinput3" class="form-control" placeholder="E-mail" name="email">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="projectinput4">Contact Number</label>
											<input type="text" id="projectinput4" class="form-control" placeholder="Phone" name="phone">
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
                <button type="button" id="save_staff"  class="btn btn-primary"><i class="fa fa-check-square-o"></i> Save</button>
            </div>
        </div>
        </div>
    </div>
    <!-- End User Modal -->
@endsection

@section('javascript')
<script>
    $(function(){
        fetchcomments();
        list_staff({'company_id':'{{$company->id}}' });

        $('body').on('click', '.send_comment', function(){
            saveCommnent($(this));               
        }); 
    });

    $('body').on('click', '.replay', function(){
        $(this).closest('.media-body').find('.chat-app-form:first').toggleClass('hidden');
    });

    

    function fetchcomments(){
        $.ajax({
            url:'{{route("showcomments")}}',
            method:'GET',
            data:{'company_id' : "{{$company->id}}", },
        }).done(function(res){            
            $('#comment_div').html(res);
        });

    }

    function saveCommnent(_this){
        var _form = _this.closest('form');
            var comment = _form.find('.comments').val();
            var parent_id = _form.find('.comments').data('parent_id');
            var _data = {                   
                    'company_id':'{{$company->id}}',
                    'comment': comment,
                    'parent_id':parent_id,
            };
            $.ajax({
                url: "{{route('saveComment')}}",
                method:'POST',
                data:_data,
            }).done(function(res){
                _form.find('.comments').val('');
                fetchcomments();
            });
    }

    $('body').on('keypress','.comments',function(e) {
        if(e.which == 13) {
            e.preventDefault();
            saveCommnent($(this));            
        }
    });

    var staff_list;
    function list_staff(params){
        if ($.fn.DataTable.isDataTable('.staff-list')) {
            staff_list.destroy();
        }

        staff_list = $(".staff-list").DataTable({
            "pageLength": 20,
            "bLengthChange": false,
            searching: false,
            processing: true,
            serverSide: true,
            ajax: {
                    "url": "{{ route('listcompanystaff') }}",
                    "data": function(d){
                         d.company_id = '{{$company->id}}' 
                        }
                },                        
            columns: [
                {data: 'id', name: 'id'},
                {data: 'first_name', name: 'first_name'},
                {data: 'last_name','name':'last_name'},
                {data: 'email','name':'email'},                           
                {data: 'mobile', name: 'mobile'},            
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            'order': [[0, "desc" ]],
        });  
    }

    $('.save_staff').on('click', function(){
        $('#staff_form').ajaxSubmit({
            url:'{{route("savestaff")}}',
            method:'post',
            success:function(res){
                    $('#add_staff_modal').modal('hide');
                    list_staff();
                }            
        });   
    });
</script>
@endsection