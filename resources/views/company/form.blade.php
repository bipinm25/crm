@extends('layout.template')

@section('actions')
<div class="content-header row">
          <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Company List</h3>
            <div class="row breadcrumbs-top d-inline-block">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                  <li class="breadcrumb-item"><a href="{{route('company')}}">Company List</a></li>   
                  <li class="breadcrumb-item"><a href="javascript:;">Manage Company</a></li>   
                </ol>
              </div>
            </div>
          </div>
        </div>
@endsection

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
                                                            <select name="contact_person_id" class="form-control">
                                                                <option value="0">Select Person</option>                                                   
                                                                @foreach($staff as $s)
                                                                    <option {{ $s->id == $company->contact_person_id?'selected':''}} value="{{$s->id}}">{{$s->first_name.' '.$s->last_name}}</option>
                                                                @endforeach
                                                            </select>                                                           
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
                                            @canany(['company-full_access','company-read_write'])
                                                <div class="form-actions">                                               
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fa fa-check-square-o"></i> Save
                                                    </button>
                                                </div>
                                            @endcanany
                                        </form>
                                    </div>
                                </div>
                            </div>
                                    	
							
							</div>
							<div class="tab-pane" id="tab2" aria-labelledby="base-tab2">    

                            <div class="card-head">
                                <div class="card-content collapse show">
                                    <div class="card-body">        
                                
                                        <table class="table table-striped table-bordered staff-list" style="width: 100% !important;">
                                            <thead>
                                                <tr>
                                                    <th>Staff Id</th>
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
                                @canany(['company-full_access','company-read_write'])
                                    <div class="card-header">        	
                                        <a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
                                        <div class="heading-elements">
                                            <a class="btn btn-primary btn-sm" href="javascript:;" data-toggle="modal" data-target="#add_staff_modal"><i class="ft-plus white"></i> Add Staff</a>            			           			
                                        </div>
                                    </div>
                                @endcanany
                                </div>                   
                           
							</div>
                            
                            <div class="tab-pane" id="tab3" aria-labelledby="base-tab3">                            
                            <div class="timeline-card card border-grey border-lighten-2">                
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="row">                                                
                                                <div class="col-lg-12 col-12">
                                                <div id="comment_div"></div>
                                                @canany(['company-full_access','company-read_write'])
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
                                                @endcanany
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

<!-- Add Staff Modal -->
<div class="modal fade text-left" id="add_staff_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel1">@canany(['company-full_access','company-read_write']) Add/Edit Staff @endcanany</h4>
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
                            <input type="hidden" value="0" id="staff_id" name="staff_id"/>
							<div class="form-body">
								<h4 class="form-section"><i class="ft-user"></i> Staff Info</h4>
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
											<label for="email">E-mail</label>
											<input type="text" id="email" class="form-control" placeholder="E-mail" name="email">
                                            <code class="email-error" style="background-color: inherit;"></code>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="mobile">Contact Number</label>
											<input type="text" id="mobile" class="form-control" placeholder="Mobile" name="mobile">
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
                @canany(['company-full_access','company-read_write'])
                    <button type="button" id="save_staff"  class="btn btn-primary"><i class="fa fa-check-square-o"></i> Save</button>
                @endcanany
            </div>
        </div>
        </div>
    </div>
    <!-- End Staff Modal -->
@endsection
@section('javascript')
<script>

/** Comments Section **/
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

    var fetchcomments = function(){
        $.ajax({
            url:'{{route("showcomments")}}',
            method:'GET',
            data:{'company_id' : "{{$company->id}}", },
        }).done(function(res){            
            $('#comment_div').html(res);
        });

    }

    function saveCommnent(_this){
        var comment_id = 0;
        var _form = _this.closest('form');        
        var comment = _form.find('.comments').val();

        if(comment.trim().length > 0){
            if(_form.find('.comments').hasClass('editcomment')){                          
                comment_id = parseInt(_form.find('.comments').data('comment_id'));
            }
            var parent_id = _form.find('.comments').data('parent_id');
            var _data = {                   
                    'company_id':'{{$company->id}}',
                    'comment': comment,
                    'parent_id':parent_id,
                    'comment_id': comment_id,
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
    }

    $('body').on('keypress','.comments',function(e) {
        if(e.which == 13) {
            e.preventDefault();
            saveCommnent($(this));            
        }
    });

    $('body').on('click', '.edit_comment', function(){
        $(this).addClass('hidden');
        var comment_id = $(this).data('comment_id');
        var ptag = $(this).closest('.media-body').find('.p_comment:first');
        var comment = ptag.html();        
        ptag.html(`<section class="chat-app-form">
                                <form class="chat-app-input d-flex">
                                <fieldset class="form-group position-relative has-icon-left col-10 m-0">
                                    <div class="form-control-position">
                                    <i class="icon-emoticon-smile"></i>
                                    </div>
                                    <input type="text" value="`+comment+`" data-parent_id="0" data-comment_id="`+comment_id+`" class="form-control comments input-sm editcomment" placeholder="Write comments...">
                                    <div class="form-control-position control-position-right">
                                    <i class="fa fa-paper-plane-o"></i>
                                    </div>
                                </fieldset>
                                <fieldset class="form-group position-relative has-icon-left col-2 m-0">
                                    <button type="button" class="btn btn-info send_comment btn-sm"><span class="d-none d-lg-block">Send</span></button>
                                </fieldset>
                                </form>
                            </section>`);

    });

    $('body').on('click', '.delete_comment', function(){        
       var comment_id = $(this).data('comment_id');
       var swalopt = { 'title': "Delete Comment?",
                       'deleteurl' : '{{route("deletecomment")}}',
                       'method' : 'delete',
                       'ajaxdata' : {'comment_id':comment_id}
                     };
       var toastropt = { 'title': "Comment Deleted"};

       generalDelete(swalopt, toastropt, fetchcomments);
    });

    /***** End Comments Section  ****/

    
    /******** Staff section */
    var staff_list;
    var list_staff = function(params = {}){
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

    $('#save_staff').on('click', function(){
        $('#staff_form').ajaxSubmit({
            url:'{{route("savestaff")}}',
            method:'post',
            beforeSubmit: function(arr, $form, options) {
                arr.push({name: "staff_type", value: "2", type: "hidden",});
            },
            success:function(res){
                toastr.success("", "Saved", { positionClass: "toast-bottom-right", containerId: "toast-bottom-right" });
                resetStaffForm();
                clearStaffError();
                $('#add_staff_modal').modal('hide');
                list_staff();
            },
            error: function(json){                
                if(json.status === 422) {
                    toastr.error("", "Error", { positionClass: "toast-bottom-right", containerId: "toast-bottom-right" });
                    var errors = json.responseJSON;                   
                    $.each(errors.errors, function (key, value) {                       
                        $('#staff_form .'+key+'-error').html(value);
                    });
                }
            }          
        });   
    });

    $('body').on('click','.edit_staff', function(){
        var staff_id = $(this).data('staff_id');
        $('#staff_form').find('#staff_id').val(staff_id);
        $.ajax({
            url:'{{route("getstaff")}}',
            data: {'staff_id':staff_id},
            method:'get',
            dataType:'json',            
        }).done(function(res){         
            var formfields = $('#staff_form').serializeArray();            
            $.each(formfields,function(k,v){
                if(v.name in res){
                    $('#staff_form').find('#'+v.name).val(res[v.name]);                    
                }
            });     
            $('#add_staff_modal').modal('show');       
        });
    });


    $('#add_staff_modal').on('hidden.bs.modal', function () {
        resetStaffForm();
        clearStaffError();
    });

    function resetStaffForm(){
        $('#staff_form')[0].reset();
        $('#staff_form').find("input[name=staff_id]").val('0');
    }

    function clearStaffError(){
        $('#staff_form code').each(function (key, value) {                       
            $(this).html('');
        });
    }

    $('body').on('click', '.delete_staff', function(){
       var staff_id =  $(this).data('staff_id');

       var swalopt = { 'title': "Delete Staff?",
                       'deleteurl' : '{{route("deletestaff")}}',
                       'method' : 'delete',
                       'ajaxdata' : {'staff_id':staff_id}
                     };
       var toastropt = { 'title': "Staff Deleted"};
       generalDelete(swalopt, toastropt, list_staff);	
    });

    /******** End Staff section */
        
</script>
@endsection