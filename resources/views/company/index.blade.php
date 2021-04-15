@extends('layout.template', ['breacrums'=>'Company'])

@section('actions')
<div class="content-header row">
          <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Company List</h3>
            <div class="row breadcrumbs-top d-inline-block">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                  <li class="breadcrumb-item"><a href="#">Company List</a></li>         
                </ol>
              </div>
            </div>
          </div>
          <div class="content-header-right col-md-4 col-12">
            <div class="btn-group float-md-right">              
              <a class="btn btn-info" href="javascript:;" data-toggle="modal" data-target="#add_company_modal"><i class="fa fa-plus"></i> Add Company</a>     
            </div>
          </div>
        </div>
@endsection

@section('content')
<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Company List</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-toggle="collapse" href="#company_search" aria-expanded="false" aria-controls="company_search"><i class="ft-search"></i></a></li>
                            <!-- <li><a data-action="collapse"><i class="ft-minus"></i></a></li> -->
                            <!-- <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li> -->
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>                            
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">

                    <div class="collapse" id="company_search">
                      <div class="card card-body">                    

                      <form id="search_company-form">
                              <div class="row">
                                
                              <div class="col-3 col-sm-3">
                                 <div class="form-group">
                                 <label for="company_name">Company Name</label>
                                  <input type="text" name="company_name" class="form-control">
                                 </div>
                             </div>
                             <div class="col-3 col-sm-3">
                                 <div class="form-group">
                                 <label for="status_id">Status</label>
                                 <select id="status" name="status_id" class="form-control">
                                    <option value="0">Status</option>
                                        @foreach(Config('general_settings.company_status') as $key => $val)
                                            <option value="{{$key}}">{{$val}}</option>
                                        @endforeach
                                </select>
                                 </div>
                             </div>
                             <div class="col-3 col-sm-3">
                                 <div class="form-group">
                                 <label for="sub_status_id">Sub Status</label>
                                 <select id="sub_status_id" name="sub_status_id" class="form-control">
                                    <option value="0">Sub Status</option>
                                        @foreach(Config('general_settings.company_sub_status') as $k => $v)
                                            <option value="{{$k}}">{{$v}}</option>
                                        @endforeach
                                </select>
                                 </div>
                             </div>                            
                             <div class="col-3 col-sm-3">
                                 <div class="form-group" style="margin-top: 1.9rem;">                               
                                    <button class="btn btn-success search_company" >Search</button>
                                    <button class="btn btn-default reset_search_form">Reset</button>
                                 </div>
                             </div>                             
                            </div>                                
                      </form>

                      </div>
                    </div>       

                        <table class="table table-striped table-bordered company-list" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Company Id</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Sub Status</th>
                                    <th>mobile</th>
                                    <th>email</th>                                    
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody></tbody>                      
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- Add Company Modal -->
<div class="modal fade text-left" id="add_company_modal" tabindex="-1" role="dialog" aria-labelledby="add_company_modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" id="add_company_modal">Add Company</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <div class="card">			
				<div class="card-content collapse show">
					<div class="card-body">						
						<form class="form" id="company_form" autocomplete="off">
                            @csrf
                            <input type="hidden" value="0" name="company_id"/>                         
							<div class="form-body">
								<h4 class="form-section"><i class="ft-user"></i> Company Info</h4>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="first_name">Company Name</label>
											<input type="text" id="company_name" class="form-control" placeholder="Company Name" name="company_name">
                                            <code class="company_name-error" style="background-color: inherit;"></code>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
                                        <label for="status_id">Status</label>
                                        <select id="status" name="status_id" class="form-control">
                                            <option value="0">Status</option>
                                                @foreach(Config('general_settings.company_status') as $key => $val)
                                                    <option value="{{$key}}">{{$val}}</option>
                                                @endforeach
                                        </select>
										</div>
									</div>
								</div>									
                                <h4 class="form-section"><i class="ft-user"></i> Contact Person</h4>	
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
                <button type="button" id="save_company"  class="btn btn-primary"><i class="fa fa-check-square-o"></i> Save</button>
            </div>
        </div>
        </div>
    </div>
    <!-- End Company Modal -->
@endsection

@section('javascript')
<script>

/****** Company Section ***/
var company_list;
var list_company = function(params = {}){
    if ($.fn.DataTable.isDataTable('.company-list')) {
      company_list.destroy();
    }   
    company_list =  $(".company-list").DataTable({
            "pageLength": 20,
            "bLengthChange": false,
            searching: false,
            processing: true,
            serverSide: true,
            ajax: { 
                    url: "{{ route('listcompany') }}",
                    data: function(data){                        
                       if(Object.keys(params).length > 0 ){
                            Object.assign(data, params);
                       }                  
                    }
                },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'status_id','name':'status_id'},
                {data: 'sub_status_id','name':'sub_status_id'},
                {data: 'mobile', name: 'mobile'},
                {data: 'email', name: 'email'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            'order': [[0, "desc" ]],
        });   
    }

    $(document).ready(function(){
        list_company();
    });

    $('#save_company').on('click', function(){
        $('#company_form').ajaxSubmit({
            url:'{{route("savecompany")}}',
            method:'post',
            dataType:'json',
            beforeSubmit: function(arr, $form, options) {
                //arr.push({name: "staff_type", value: "2", type: "hidden",});
            },
            success:function(res){         
                clearCompanyError();      
                toastr.success("", "Saved", { positionClass: "toast-bottom-right", containerId: "toast-bottom-right" });
                if(res.redirecturl.length > 0){
                    window.location = res.redirecturl;
                }
            },
            error: function(json){                
                if(json.status === 422) {
                    toastr.error("", "Error", { positionClass: "toast-bottom-right", containerId: "toast-bottom-right" });
                    var errors = json.responseJSON;       
                    $.each(errors.errors, function (key, value) {                
                        $('#company_form .'+key+'-error').html(value);
                    });
                }
            }          
        });   
    });

    function clearCompanyError(){
        $('#company_form code').each(function (key, value) {                       
            $(this).html('');
        });
    }

    $('#add_company_modal').on('hidden.bs.modal', function () {        
        clearCompanyError();
    });

/****** End Company Section ***/

/****** Search Section ***/
$('.search_company').on('click', function(e){
        e.preventDefault();
        let srch_form = $('#search_company-form').serializeArray();
        var param = {};    
        $.each(srch_form, function(k,v){
            param[v.name] = v.value;
        });     
        list_company(param);
    });

    $('.reset_search_form').on('click', function(e){
        e.preventDefault();
        $('#search_company-form')[0].reset();
        list_company();      
    });
    

    $('body').on('click', '.delete_company', function(){
        var company_id = $(this).data('company_id');
        var swalopt = { 'title': "Delete Company?",
                       'deleteurl' : '{{route("deletecompany")}}',
                       'method' : 'delete',
                       'ajaxdata' : {'company_id':company_id}
                     };
       var toastropt = { 'title': "Company Deleted"};

       generalDelete(swalopt, toastropt, list_company);
    });
/****** End Search Section ***/

   

    
</script>
@endsection
