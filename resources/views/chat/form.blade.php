@extends('layout.template')

@section('content')
<div class="form-body">
   <div class="row">
      <div class="col-md-2" >
         <div class="sidebar">
            <div class="sidebar-content card d-none d-lg-block">
               <div class="card-body chat-fixed-search">
                  <fieldset class="form-group position-relative has-icon-left m-0">
                     <input type="text" class="form-control" id="iconLeft4" placeholder="Search user">
                     <div class="form-control-position">
                        <i class="ft-search"></i>
                     </div>
                  </fieldset>
               </div>
               <div id="users-list" class="list-group position-relative">
                  <div class="users-list-padding media-list">
                     <a href="#" class="media border-0">
                        <div class="media-left pr-1">
                           <span class="avatar avatar-md avatar-online"><img class="media-object rounded-circle" src="app-assets/images/portrait/small/avatar-s-3.png" alt="Generic placeholder image">
                           <i></i>
                           </span>
                        </div>
                        <div class="media-body w-100">
                           <h6 class="list-group-item-heading">Elizabeth Elliott <span class="font-small-3 float-right info">4:14 AM</span></h6>
                           <p class="list-group-item-text text-muted mb-0"><i class="ft-check primary font-small-2"></i> Okay <span class="float-right primary"><i class="font-medium-1 icon-pin blue-grey lighten-3"></i></span></p>
                        </div>
                     </a>
                     <a href="#" class="media border-0">
                        <div class="media-left pr-1">
                           <span class="avatar avatar-md avatar-busy"><img class="media-object rounded-circle" src="app-assets/images/portrait/small/avatar-s-7.png" alt="Generic placeholder image">
                           <i></i>
                           </span>
                        </div>
                        <div class="media-body w-100">
                           <h6 class="list-group-item-heading">Kristopher Candy <span class="font-small-3 float-right info">9:04 PM</span></h6>
                           <p class="list-group-item-text text-muted mb-0"><i class="ft-check primary font-small-2"></i> Thank you <span class="float-right primary"><span class="badge badge-pill badge-danger">12</span></span></p>
                        </div>
                     </a>
                     <a href="#" class="media border-0">
                        <div class="media-left pr-1">
                           <span class="avatar avatar-md avatar-away"><img class="media-object rounded-circle" src="app-assets/images/portrait/small/avatar-s-8.png" alt="Generic placeholder image">
                           <i></i>
                           </span>
                        </div>
                        <div class="media-body w-100">
                           <h6 class="list-group-item-heading">Sarah Woods <span class="font-small-3 float-right info">2:14 AM</span></h6>
                           <p class="list-group-item-text text-muted mb-0"><i class="ft-check font-small-2"></i> Hello krish! <span class="float-right primary"><i class="font-medium-1 icon-volume-off blue-grey lighten-3 mr-1"></i> <span class="badge badge-pill badge-danger">3</span></span></p>
                        </div>
                     </a>
                     <a href="#" class="media bg-blue-grey bg-lighten-5 border-right-info border-right-2">
                        <div class="media-left pr-1">
                           <span class="avatar avatar-md avatar-online"><img class="media-object rounded-circle" src="app-assets/images/portrait/small/avatar-s-7.png" alt="Generic placeholder image">
                           <i></i>
                           </span>
                        </div>
                        <div class="media-body w-100">
                           <h6 class="list-group-item-heading">Wayne Burton <span class="font-small-3 float-right info">Today</span></h6>
                           <p class="list-group-item-text text-muted mb-0"><i class="ft-check primary font-small-2"></i> Can we connect?</p>
                        </div>
                     </a>
                     <a href="#" class="media border-0">
                        <div class="media-left pr-1">
                           <span class="avatar avatar-md avatar-away"><img class="media-object rounded-circle" src="app-assets/images/portrait/small/avatar-s-5.png" alt="Generic placeholder image">
                           <i></i>
                           </span>
                        </div>
                        <div class="media-body w-100">
                           <h6 class="list-group-item-heading">Sarah Montgomery <span class="font-small-3 float-right info">Yesterday</span></h6>
                           <p class="list-group-item-text text-muted mb-0"><i class="ft-check font-small-2"></i> Will connect you</p>
                        </div>
                     </a>
                     <a href="#" class="media border-0">
                        <div class="media-left pr-1">
                           <span class="avatar avatar-md avatar-online"><img class="media-object rounded-circle" src="app-assets/images/portrait/small/avatar-s-9.png" alt="Generic placeholder image">
                           <i></i>
                           </span>
                        </div>
                        <div class="media-body w-100">
                           <h6 class="list-group-item-heading">Heather Howell <span class="font-small-3 float-right info">Friday</span></h6>
                           <p class="list-group-item-text text-muted mb-0"><i class="ft-check font-small-2"></i> Thank you <span class="float-right primary"><span class="badge badge-pill badge-danger">4</span></span></p>
                        </div>
                     </a>
                     <a href="#" class="media border-0">
                        <div class="media-left pr-1">
                           <span class="avatar avatar-md avatar-busy"><img class="media-object rounded-circle" src="app-assets/images/portrait/small/avatar-s-7.png" alt="Generic placeholder image">
                           <i></i>
                           </span>
                        </div>
                        <div class="media-body w-100">
                           <h6 class="list-group-item-heading">Kelly Reyes <span class="font-small-3 float-right info">Thrusday</span></h6>
                           <p class="list-group-item-text text-muted mb-0"><i class="ft-check font-small-2"></i> I love you </p>
                        </div>
                     </a>
                     <a href="#" class="media border-0">
                        <div class="media-left pr-1">
                           <span class="avatar avatar-md avatar-busy"><img class="media-object rounded-circle" src="app-assets/images/portrait/small/avatar-s-7.png" alt="Generic placeholder image">
                           <i></i>
                           </span>
                        </div>
                        <div class="media-body w-100">
                           <h6 class="list-group-item-heading">Kelly Reyes <span class="font-small-3 float-right info">Thrusday</span></h6>
                           <p class="list-group-item-text text-muted mb-0"><i class="ft-check font-small-2"></i> I love you </p>
                        </div>
                     </a>
                     <a href="#" class="media border-0">
                        <div class="media-left pr-1">
                           <span class="avatar avatar-md avatar-busy"><img class="media-object rounded-circle" src="app-assets/images/portrait/small/avatar-s-7.png" alt="Generic placeholder image">
                           <i></i>
                           </span>
                        </div>
                        <div class="media-body w-100">
                           <h6 class="list-group-item-heading">Kelly Reyes <span class="font-small-3 float-right info">Thrusday</span></h6>
                           <p class="list-group-item-text text-muted mb-0"><i class="ft-check font-small-2"></i> I love you </p>
                        </div>
                     </a>
                     <a href="#" class="media border-0">
                        <div class="media-left pr-1">
                           <span class="avatar avatar-md avatar-busy"><img class="media-object rounded-circle" src="app-assets/images/portrait/small/avatar-s-7.png" alt="Generic placeholder image">
                           <i></i>
                           </span>
                        </div>
                        <div class="media-body w-100">
                           <h6 class="list-group-item-heading">Kelly Reyes <span class="font-small-3 float-right info">Thrusday</span></h6>
                           <p class="list-group-item-text text-muted mb-0"><i class="ft-check font-small-2"></i> I love you </p>
                        </div>
                     </a>
                     <a href="#" class="media border-0">
                        <div class="media-left pr-1">
                           <span class="avatar avatar-md avatar-busy"><img class="media-object rounded-circle" src="app-assets/images/portrait/small/avatar-s-7.png" alt="Generic placeholder image">
                           <i></i>
                           </span>
                        </div>
                        <div class="media-body w-100">
                           <h6 class="list-group-item-heading">Kelly Reyes <span class="font-small-3 float-right info">Thrusday</span></h6>
                           <p class="list-group-item-text text-muted mb-0"><i class="ft-check font-small-2"></i> I love you </p>
                        </div>
                     </a>
                     <a href="#" class="media border-0">
                        <div class="media-left pr-1">
                           <span class="avatar avatar-md avatar-online"><img class="media-object rounded-circle" src="app-assets/images/portrait/small/avatar-s-14.png" alt="Generic placeholder image">
                           <i></i>
                           </span>
                        </div>
                        <div class="media-body w-100">
                           <h6 class="list-group-item-heading">Vincent Nelson</h6>
                           <p class="list-group-item-text text-muted mb-0"><i class="ft-check primary font-small-2"></i> Who you are?</p>
                        </div>
                     </a>
                     <a href="#" class="media border-0">
                        <div class="media-left pr-1">
                           <span class="avatar avatar-md avatar-online"><img class="media-object rounded-circle" src="app-assets/images/portrait/small/avatar-s-3.png" alt="Generic placeholder image">
                           <i></i>
                           </span>
                        </div>
                        <div class="media-body w-100">
                           <h6 class="list-group-item-heading">Elizabeth Elliott <span class="font-small-3 float-right info">4:14 AM</span></h6>
                           <p class="list-group-item-text text-muted mb-0"><i class="ft-check font-small-2"></i> Okay <span class="float-right primary"><i class="font-medium-1 icon-pin blue-grey lighten-3"></i></span></p>
                        </div>
                     </a>
                     <a href="#" class="media border-0">
                        <div class="media-left pr-1">
                           <span class="avatar avatar-md avatar-busy"><img class="media-object rounded-circle" src="app-assets/images/portrait/small/avatar-s-7.png" alt="Generic placeholder image">
                           <i></i>
                           </span>
                        </div>
                        <div class="media-body w-100">
                           <h6 class="list-group-item-heading">Kristopher Candy <span class="font-small-3 float-right info">9:04 PM</span></h6>
                           <p class="list-group-item-text text-muted mb-0"><i class="ft-check primary font-small-2"></i> Thank you <span class="float-right primary"><span class="badge badge-pill badge-danger">12</span></span></p>
                        </div>
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="col-md-10">

         <div class="row">

            <div class="col-lg-12">
               <div class="timeline-card card border-grey border-lighten-2" style="margin-left: 43px;">
                  <div class="card-content">
                     <div class="card-body">
                        <div class="row">
                           <div class="col-lg-12 col-12">
                              <div id="comment_div">
                                 <div class="col-xl-12 col-lg-6 col-12">
                                    <div class="card">
                                       <div class="card-content">
                                          <div class="media">
                                             <div class="p-2 text-center bg-danger rounded-left">
                                                <i class="icon-user font-large-2 text-white"></i>
                                             </div>
                                             <div class="p-2 media-body">
                                                <p>We like consistency and design that blends into its purpose. Vue Paper Dashboard 2 PRO is a perfect example of our most thoughtful work. It combines Vue.js components and plugins, while looking like everything fits together. For an easy start or inspiration for you project, we have also create a set of example pages, like the user settings or usage graphics.</p>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-xl-12 col-lg-6 col-12">
                                    <div class="card">
                                       <div class="card-content">
                                          <div class="media align-items-stretch">
                                             <div class="p-2 media-body text-right">
                                                <h5>New Users</h5>
                                                <h5 class="text-bold-400 mb-0">1,22,356</h5>
                                             </div>
                                             <div class="p-2 text-center bg-success rounded-right">
                                                <i class="icon-user font-large-2 text-white"></i>
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

            <div class="col-lg-12 col-12">

            <div class="timeline-card card border-grey border-lighten-2" style="margin-left: 43px;">
                  <div class="card-content">
                     <div class="card-body">
                        <div class="row">
                           <div class="col-lg-12 col-12">
                           <form class="form">
	                    	<div class="form-body">	                    		
	                    		<div class="row">
	                    			<div class="col-md-12">
		                    			<div class="form-group">				                           
				                            <input type="text" id="projectinput1" class="form-control" placeholder="Type here..." name="meggage">
				                        </div>
			                        </div>	
                                    <div class="col-md-12">
                                    <fieldset class="form-group">
                                        <div class="custom-file">
                                            <input type="file" multiple class="custom-file-input" id="inputGroupFile01">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                    </fieldset>
			                        </div>		                        
	                    		</div>
							</div>

	                        <div class="form-actions">	                           
	                            <button type="submit" class="btn btn-outline-primary">
	                                <i class="ft-check"></i> Sent
	                            </button>
	                        </div>
	                    </form>
                             
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
      

@endsection

@section('javascript')

<script>
    

</script>

@endsection