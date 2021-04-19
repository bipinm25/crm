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
<div class="row">
        <div class="col-12">
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
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">                        
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
                </div>
            </div>
        </div>
    </div>


@endsection
@section('javascript')
<script>
var logs_list;
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
                            $(row).addClass( 'logs' );
                        }                 
                    });  
    }

    $(document).ready(function(){
        list_logs();
    });

    $('body').on('click','.logs-list .logs', function(){
       var log_id = $(this).data('log_id');
       $.ajax({
        url: '{{route("getlog")}}',
        data: {'log_id': log_id },        
        method:'get',        
       }).done(function(res){
           console.log(res);
       });
    })
</script>
@endsection