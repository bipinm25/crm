@extends('layout.template')

@section('actions')
<div class="content-header row">
          <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Logs</h3>
            <div class="row breadcrumbs-top d-inline-block">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                  <li class="breadcrumb-item"><a href="javascript:;">Logs</a></li>   
                </ol>
              </div>
            </div>
          </div>         
        </div>
@endsection
@section('content')
<section id="basic-tabs-components">
	<div class="row match-height">
		<div class="col-xl-12 col-lg-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">User Logs</h4>
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
								<a class="nav-link active" id="base-tab1" data-toggle="tab" aria-controls="tab1" href="#tab1" aria-expanded="true">User Activity</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="base-tab2" data-toggle="tab" aria-controls="tab2" href="#tab2" aria-expanded="false">Login History</a>
							</li>														
						</ul>
						<div class="tab-content px-1 pt-1">
							<div role="tabpanel" class="tab-pane active" id="tab1" aria-expanded="true" aria-labelledby="base-tab1">

                                    <table class="table table-striped table-bordered logs-list" style = "width:100%">
                                    <thead>
                                        <tr>
                                            <th>Module</th>
                                            <th>Action</th>                                                                  
                                            <th>Action By</th>                                                             
                                            <th>Date</th>                                                                    
                                        </tr>
                                    </thead>
                                    <tbody>                           
                                    </tbody>                      
                                    </table>

							</div>
							<div class="tab-pane" id="tab2" aria-labelledby="base-tab2">
                            <table class="table table-striped table-bordered login-history" style = "width:100%">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Login Time</th>                                                                  
                                        <th>Region</th>                                                                                                             
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
		</div>
    </div>
</section>      


     <!--Log Modal -->
     <div class="modal fade text-left" id="log_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel16">Log Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">

                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">                        
                        <table class="table table-striped table-bordered" style = "width:100%">                            
                            <tbody>
                                <tr><td>Action</td><td id="action"></td></tr>
                                <tr><td>Action By</td><td id="action_by"></td></tr>
                                <tr><td>Date</td><td id="date"></td></tr>
                                <tr><td id="model_class"></td><td id="id"></td></tr>
                            </tbody>          
                        </table>
                    </div>
                </div>               

                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">                        
                        <table class="table table-striped table-bordered log_desc" style = "width:100%">
                            <thead>
                                <tr>
                                    <th>Field</th>
                                    <th id="old" class="">Old Value</th>
                                    <th id="new">New Value</th>
                                </tr>
                            </thead>
                            <tbody>                           
                            </tbody>                      
                        </table>
                    </div>
                </div>
                   
                </div>
                <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>                
                </div>
            </div>
            </div>
	</div>
    <!-- Log Modal -->


@endsection
@section('javascript')
<script>
var logs_list,login_history;

    var list_logs = function(){
        if ($.fn.DataTable.isDataTable('.logs-list')) {
                user_list.destroy();
        }
        logs_list = $(".logs-list").DataTable({
                        "pageLength": 20,
                        "bLengthChange": false,
                        searching: false,
                        processing: true,
                        serverSide: true,
                        ajax: "{{ route('getlogs') }}",
                        columns: [                           
                            {data: 'module', name: 'module'},
                            {data: 'action','name':'action'},
                            {data: 'action_by','name':'action_by'},
                            {data: 'date', name: 'date'},                
                            // {data: 'changes', name: 'changes', orderable: false, searchable: false},
                        ],
                        'order': [[3, "desc" ]],
                        'createdRow': function( row, data, dataIndex ) {
                            $(row).attr('data-log_id', data.id);
                            $(row).addClass( 'logs' ).css('cursor','pointer');
                        }                 
                    });  
    }

    var history_login = function(){
        if ($.fn.DataTable.isDataTable('.login-history')) {
                user_list.destroy();
        }
        login_history = $(".login-history").DataTable({
                        "pageLength": 20,
                        "bLengthChange": false,
                        searching: false,
                        processing: true,
                        serverSide: true,
                        ajax: "{{ route('getloginhistory') }}",
                        columns: [                           
                            {data: 'user', name: 'user'},
                            {data: 'logintime','name':'logintime'},
                            {data: 'region','name':'region'},                                
                            // {data: 'changes', name: 'changes', orderable: false, searchable: false},
                        ],
                        'order': [[1, "desc" ]],                                       
                    });  
    }

    $(document).ready(function(){
        list_logs(); 
        history_login();
    });

    $('body').on('click','.logs-list .logs', function(){
       var log_id = $(this).data('log_id');
       $.ajax({
        url: '{{route("getlog")}}',
        data: {'log_id': log_id },        
        method:'get',        
       }).done(function(res){
            showLogModal(res);           
       });
    });

    var showLogModal = function(res){
           $('#action').html(res.action);
           $('#action_by').html(res.action_by);
           $('#date').html(res.date);
           $('#id').html(res.id);
           $('#model_class').html(res.model_class+' ID');
           var tr ='';
           
           $('.log_desc').removeClass('hidden');
           if(res.action == 'deleted'){
            $('.log_desc').addClass('hidden');
           }  
           if(res.action == 'updated'){
            $('.log_desc thead').find('th#old').removeClass('hidden');  
            $.each(res.changes,function(k,v){       
                    k = k.replace(/_/g, " ");         
                    tr += `<tr><td>`+k+`</td><td>`+v.old+`</td><td>`+v.new+`</td></tr>`;
            });           
           }else if(res.action == 'created'){
            $('.log_desc thead').find('th#old').addClass('hidden');            
            $.each(res.changes,function(k,v){                     
                    if(v){
                        k = k.replace(/_/g, " ");         
                        tr += `<tr><td>`+k+`</td><td>`+v+`</td></tr>`;
                    }
            });           
           }
           $('.log_desc tbody').html(tr);
           $('#log_modal').modal('show');
    }
</script>
@endsection