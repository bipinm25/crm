@extends('layout.template', ['breacrums'=>'Role'])

@section('actions')
<div class="content-header row">
          <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Role List</h3>
            <div class="row breadcrumbs-top d-inline-block">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                  <li class="breadcrumb-item"><a href="#">Role List</a></li>         
                </ol>
              </div>
            </div>
          </div>
          <div class="content-header-right col-md-4 col-12">
            <div class="btn-group float-md-right">           
              <a class="btn btn-info" href="{{route('showrole')}}" ><i class="fa fa-plus"></i> Add</a>          
            </div>
          </div>
        </div>
@endsection

@section('content')
<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Role List</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">                                                     
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>                            
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">                        
                        <table class="table table-striped table-bordered company-list">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Role</th>                                                                  
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                            <tr>
                                    <td>{{$role->id}}</td>
                                    <td>{{$role->name}}</td>                                                                  
                                    <td><a href="{{route('showrole', $role->id)}}" title="Edit" class=""><i class="icon-note"></i></a>
                                        <a href="javascript:void(0)" title="Delete" class=""><i class="icon-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
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
    // $(document).ready(function(){
    //     var company_list =  $(".company-list").DataTable({
    //         "pageLength": 20,
    //         "bLengthChange": false,
    //         searching: false,
    //         processing: true,
    //         serverSide: true,
    //         ajax: "{{ route('listcompany') }}",
    //         columns: [
    //             {data: 'id', name: 'id'},
    //             {data: 'name', name: 'name'},
    //             {data: 'status_id','name':'status_id'},
    //             {data: 'sub_status_id','name':'sub_status_id'},
    //             {data: 'mobile', name: 'mobile'},
    //             {data: 'email', name: 'email'},
    //             {data: 'action', name: 'action', orderable: false, searchable: false},
    //         ],
    //         'order': [[0, "desc" ]],
    //     });   
    // });
</script>
@endsection
