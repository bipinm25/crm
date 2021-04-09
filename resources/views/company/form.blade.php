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
                            <li class="nav-item">
								<a class="nav-link" id="base-tab3" data-toggle="tab" aria-controls="tab3" href="#tab3" aria-expanded="false">Followup Comments</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="base-tab2" data-toggle="tab" aria-controls="tab2" href="#tab2" aria-expanded="false">Company Staff</a>
							</li>														
						</ul>
						<div class="tab-content px-1 pt-1">
							<div role="tabpanel" class="tab-pane active" id="tab1" aria-expanded="true" aria-labelledby="base-tab1">
                                                            
                            <div class="card">                                          
                                <div class="card-content collapse show">
                                    <div class="card-body">						
                                        <form class="form" method="post" action="{{route('savecompany')}}">
                                            @csrf
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-menu"></i> Basic Details</h4>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="company_name">Company Name</label>
                                                            <input type="text" id="company_name" class="form-control" placeholder="Company Name" name="company_name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="mobile">Mobile</label>
                                                            <input type="text" id="mobile" class="form-control" placeholder="Mobile" name="mobile">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="email">E-mail</label>
                                                            <input type="text" id="email" class="form-control" placeholder="E-mail" name="email">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="status">Status</label>
                                                            <select id="status" name="status_id" class="form-control">
                                                                <option value="0">Status</option>
                                                                    @foreach(Config('general_settings.company_status') as $key => $val)
                                                                        <option value="{{$key}}">{{$val}}</option>
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
                                                                        <option value="{{$k}}">{{$v}}</option>
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
                                                            <textarea id="full_address" rows="3" class="form-control" name="full_address" placeholder="Full Address"></textarea>
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
								<p>Sugar plum tootsie roll biscuit caramels. Liquorice brownie pastry cotton candy oat cake fruitcake jelly chupa chups. Pudding caramels pastry powder cake soufflé wafer caramels. Jelly-o pie cupcake.</p>
							</div>
                            
                            <div class="tab-pane" id="tab3" aria-labelledby="base-tab3">
                            
                            <div class="timeline-card card border-grey border-lighten-2">                
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="row">
                                                
                                                <div class="col-lg-6 col-12">
                                                    <div class="media">
                                                        <div class="media-left pr-1">
                                                            <a href="#">
                                                                <span class="avatar avatar-online"><img src="app-assets/images/portrait/small/avatar-s-1.png" alt="avatar"></span>
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <p class="text-bold-600 mb-0"><a href="#">Jason Ansley</a></p>
                                                            <p class="m-0">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo.</p>
                                                            <ul class="list-inline mb-1">                                                               
                                                                <li class="pr-1"><a href="#" class="text-muted"><span class="fa fa-comments-o"></span> Replay</a></li>
                                                            </ul>
                                                            <div class="media">
                                                                <div class="media-left pr-1">
                                                                    <a href="#">
                                                                        <span class="avatar avatar-online"><img src="app-assets/images/portrait/small/avatar-s-18.png" alt="avatar"></span>
                                                                    </a>
                                                                </div>
                                                                <div class="media-body">
                                                                    <p class="text-bold-600 mb-0"><a href="#">Janice Johnston</a></p>
                                                                    <p class="m-0">Gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</p>
                                                                    <ul class="list-inline mb-1">                                                                       
                                                                        <li class="pr-1"><a href="#" class="text-muted"><span class="fa fa-comments-o"></span> Replay</a></li>
                                                                    </ul>                                                                    
                                                                    <div class="media">
                                                                        <div class="media-left pr-1">
                                                                            <a href="#">
                                                                                <span class="avatar avatar-online"><img src="app-assets/images/portrait/small/avatar-s-18.png" alt="avatar"></span>
                                                                            </a>
                                                                        </div>
                                                                        <div class="media-body">
                                                                            <p class="text-bold-600 mb-0"><a href="#">Janice Johnston</a></p>
                                                                            <p class="m-0">Gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</p>
                                                                            <ul class="list-inline mb-1">                                                                       
                                                                                <li class="pr-1"><a href="#" class="text-muted"><span class="fa fa-comments-o"></span> Replay</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="media">
                                                                <div class="media-left pr-1">
                                                                    <a href="#">
                                                                        <span class="avatar avatar-online"><img src="app-assets/images/portrait/small/avatar-s-18.png" alt="avatar"></span>
                                                                    </a>
                                                                </div>
                                                                <div class="media-body">
                                                                    <p class="text-bold-600 mb-0"><a href="#">Janice Johnston</a></p>
                                                                    <p class="m-0">Gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</p>
                                                                    <ul class="list-inline mb-1">                                                                       
                                                                        <li class="pr-1"><a href="#" class="text-muted"><span class="fa fa-comments-o"></span> Replay</a></li>
                                                                    </ul>
                                                                </div>
                                                             </div>
                                                        </div>                                                        
                                                    </div>

                                                    <div class="media">
                                                        <div class="media-left pr-1">
                                                            <a href="#">
                                                                <span class="avatar avatar-online"><img src="app-assets/images/portrait/small/avatar-s-1.png" alt="avatar"></span>
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <p class="text-bold-600 mb-0"><a href="#">Jason Ansley</a></p>
                                                            <p class="m-0">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo.</p>
                                                            <ul class="list-inline mb-1">                                                               
                                                                <li class="pr-1"><a href="#" class="text-muted"><span class="fa fa-comments-o"></span> Replay</a></li>
                                                            </ul>                                                           
                                                        </div>                                                        
                                                    </div>


                                                    <div class="card-body">
                                                        <fieldset class="form-group position-relative has-icon-left mb-0">
                                                            <input type="text" class="form-control" placeholder="Write comments...">
                                                            <div class="form-control-position">
                                                                <i class="ft-message-square"></i>
                                                            </div>
                                                        </fieldset>
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

			
	</div>
</section>
@endsection

@section('javascript')
<script>
    $(function(){
        
    })
</script>
@endsection