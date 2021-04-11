@extends('layout.template')

@section('content')
<section id="basic-form-layouts">
	<div class="row match-height">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-square-controls">Role</h4>
					<a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
					<div class="heading-elements">
						<ul class="list-inline mb-0">						
							<li><a data-action="expand"><i class="ft-maximize"></i></a></li>							
						</ul>
					</div>
				</div>
				<div class="card-content collapse show">
					<div class="card-body">
						<form class="form" method="post" action="{{route('saverole')}}">
                        @csrf	
						<input type="hidden" value="{{$role->id }}" name="role_id"/>					
                        <div class="row">						
									<div class="col-md-5">
										<div class="form-group">
											<label for="role_name">Role Name*</label>
											<input type="text" value="{{$role->name}}" id="role_name" class="form-control @error('role_name') border-danger @enderror" placeholder="Role Name" name="role_name">
                                            @if($errors->has('role_name'))
                                                <code style="background-color: inherit;">{{ $errors->first('role_name') }}</code>
                                            @endif
										</div>
									</div>									
								</div>
                        <div class="table-responsive">                       
                        <h4 class="form-section"><i class="ft-user"></i> Permissions</h4>
                       
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Module</th>
                                        <th>Full Access</th>
                                        <th>Read</th>
                                        <th>Read/Write</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(Config('general_settings.permissions') as $module => $permission)
                                    <tr>
									<td>{{ucfirst(str_replace('_',' ',$module))}}</td>
                                        @foreach($permission as $p)                                            
                                            <td><input type="checkbox" class="{{$p=='full_access'?$p:''}}"  {{in_array($module.'-'.$p, $all_permission)?'checked':''}}  value="1" name="permission[{{$module}}][{{$p}}]"/></td>    
                                        @endforeach 
                                        </tr>                        
                                    @endforeach                                                           
                                </tbody>
                            </table>
                </div>

							<div class="form-actions left">								
								<button type="submit" class="btn btn-primary">
									<i class="fa fa-check-square-o"></i> Save
								</button>
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>
	</div>


</section>
@endsection

@section('javascript')
<script>
    $(function(){
		$('body').on('click','.full_access', function(){
			if($(this).is(':checked')){								
				$(this).parent().parent().find('td input[type="checkbox"]').prop('checked', this.checked);
			}else{
				$(this).parent().parent().find('td input[type="checkbox"]').prop('checked', this.checked);
			}
			
		})
        
    })
</script>
@endsection