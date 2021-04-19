@extends('layout.template')


@section('actions')
<div class="content-header row">
          <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Group List</h3>
            <div class="row breadcrumbs-top d-inline-block">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                  <li class="breadcrumb-item"><a href="#">Group List</a></li>         
                </ol>
              </div>
            </div>
          </div>
          <div class="content-header-right col-md-4 col-12">
            <div class="btn-group float-md-right">           
              <a class="btn btn-info add_user" href="javascript:;" data-toggle="modal" data-target="#add_group_modal"><i class="fa fa-plus"></i> Add Group</a>          
            </div>
          </div>
        </div>
@endsection

@section('content')

<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Group List</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">                                                     
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>                            
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">                        
                        <table class="table table-striped table-bordered group-list" style = "width:100%">
                            <thead>
                                <tr>
                                    <th>Group Id</th>
                                    <th>Group Name</th>                                                                  
                                    <th>Company</th>                                                             
                                    <th>Created By</th>                                   
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

    <!-- Add Group Modal -->
    <div class="modal fade text-left" id="add_group_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel1">Add Group</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <div class="card">			
				<div class="card-content collapse show">
					<div class="card-body">						
						<form class="form" id="group_form" autocomplete="off">
                            @csrf
                            <input type="hidden" value="0" id="group_id" name="group_id"/>
							<div class="form-body">
								<h4 class="form-section"><i class="ft-user"></i> Group Info</h4>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="group_name">Group Name</label>
											<input type="text" id="group_name" class="form-control" placeholder="Group Name" name="group_name">
                                            <code class="group_name-error" style="background-color: inherit;"></code>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="last_name">Company</label>
											<p>select2</p>
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
                <button type="button" id="save_group"  class="btn btn-primary"><i class="fa fa-check-square-o"></i> Save</button>
            </div>
        </div>
        </div>
    </div>
    <!-- End User Modal -->
@endsection

@section('javascript')
<script>

    function resetGroupForm(){
        $('#group_form')[0].reset();        
        $('#group_form').find("input[type=hidden]").val('0');
    }

    function clearGroupError(){        
        $('#group_form code').each(function (key, value) {                       
            $(this).html('');
        });
    }

$('#add_group_modal').on('hidden.bs.modal', function () {
        resetGroupForm();     
        clearGroupError();
    });

</script>
@endsection