@extends('layout.template')


@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/fancy-file-uploader/fancy_fileupload.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/chat-window.css')}}">

<div class="form-body">
   <div class="row">
      <div class="col-md-2.5" >
         <div class="sidebar">
            <div class="sidebar-content card d-none d-lg-block">
               <div class="card-body chat-fixed-search">
               <pre class="language-markup"><span>Company - {{$group->company->name}}</span></pre>              
               <div class="form-group">  
               <fieldset>
                  <div class="input-group">								
                     <select name="user_id[]" class="form-control user_id">
                        <option></option>
                     </select>  
                     <div class="input-group-append">
                        <button class="btn btn-primary addusers" type="button">Add</button>
                     </div>
                  </div>
               </fieldset>                                 
               </div>
                        
               </div>
               <div id="users-list" class="list-group position-relative">


               </div>
            </div>
         </div>
      </div>
      <div class="col-md-9">
         <div class="row">
            <div class="col-lg-12">
               <div class="timeline-card card border-grey border-lighten-2">
                  <div class="card-content">
                     <div class="card-body">
                        <div class="row">
                           <div class="col-lg-12 col-12">
                              <div id="comment_div">
                                 <div class="position-relative">
                                    <div class="chat-messages p-4" id="chat-messages">                                                                         
                                       
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
               <div class="timeline-card card border-grey border-lighten-2">
                  <div class="card-content">
                     <div class="card-body">
                        <div class="row">
                           <div class="col-lg-12 col-12">
                              <form class="form" id="chat_form">
                                 <input type="hidden" value="{{request()->id}}" name="group_id"/>
                                 <div class="form-body">
                                    <div class="row">
                                       <div class="col-md-12">
                                          <div class="form-group">				                           
                                             <input type="text" id="message" class="form-control" placeholder="Type here..." name="message">
                                          </div>
                                       </div>
                                       <div class="col-md-12">
                                       <label for="group_name">Sent Files</label>
                                       <input type="file" accept=".jpg, .png, image/jpeg, image/png, .doc, .docx, .pdf" multiple name="chat_files" id="chat_files">
                                          
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-actions">	                           
                                    <button type="button" class="btn btn-outline-primary send_msg">
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
<script src="{{asset('app-assets/fancy-file-uploader/jquery.ui.widget.js')}}"></script> 
<script src="{{asset('app-assets/fancy-file-uploader/jquery.fileupload.js')}}"></script> 
<script src="{{asset('app-assets/fancy-file-uploader/jquery.iframe-transport.js')}}"></script> 
<script src="{{asset('app-assets/fancy-file-uploader/jquery.fancy-fileupload.js')}}"></script>
<script src="{{asset('app-assets/waypoint/lib/jquery.waypoints.min.js')}}"></script>
<script>
    //$('.chat-messages').perfectScrollbar(); 
    
    var chat_id = 0;

   //  var waypoint = new Waypoint({
   //    element: document.getElementById('chat-messages'),
   //       handler: function(direction) {
   //         alert(direction);
   //       }
   //    })
   
  
      var initFileUploader = function(){
         $('#chat_files').FancyFileUpload({
         'url' :'{{route("sendmessage")}}',
         params : {
            'action' : 'fileuploader',
            'group_id': '{{request()->id}}',
         },
         maxfilesize : 1000000,
         'uploadcompleted' : function(e, data) {
            getChat();
            initFileUploader();
         }
      });
      }

    $('.user_id').select2({
      placeholder: "Add Members",
      allowClear: true,
      ajax: {
                url: '{{route("searchusers")}}',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                        var query = {
                        search: params.term,
                        group_id: '{{ request()->id }}',
                        }                        
                        return query;
                     },
                processResults: function (data) {              
                    return {
                     results: data
                    };
                },
            cache: true    
            }, 
   });


   $('body').on('click', '.addusers', function(){
      var user_id = $('.user_id').val();

      $.ajax({
         'url' : "{{route('addmembers')}}",
         method: 'post',
         dataType: 'json',
         data: {'user_id': user_id, 'group_id' : "{{request()->id}}" },
      }).done(function(res){
         $(".user_id").empty().trigger('change');
         listMembers();
      });
   });

   var listMembers = function(){
      $.ajax({
         'url' : "{{route('listgroupmembers')}}",
         method: 'get',     
         data: {'group_id' : "{{request()->id}}" },
      }).done(function(res){
         $('#users-list').html(res);
      });
   }  

   $(function(){
      initFileUploader();
      listMembers();
      getChat();

      var waypoints = $('body').find('.chat-messages').waypoint({ 
         handler: function (direction) {
            alert(direction+999);
         },         
      });

      
   });

   $('body').on('click', '.delete_member', function(){
      var user_id = $(this).data('user_id');
      alert(user_id);
   });

   $('body').on('click', '.send_msg' ,function(e){
      e.preventDefault();
     
      sendMessage();
   });

   var sendMessage = function(){    

      //$('.ff_fileupload_actions button.ff_fileupload_start_upload').trigger('click');

      $('#chat_form').ajaxSubmit({
            url:'{{route("sendmessage")}}',
            method:'post',
            dataType:'json',
            beforeSubmit: function(arr, $form, options) {
                //arr.push({name: "staff_type", value: "2", type: "hidden",});
            },
            success:function(res){   
               $('#message').val('');
               getChat();                     
               $('.ff_fileupload_actions button.ff_fileupload_start_upload').trigger('click');
            },
            error: function(json){              
                
            }
        });   
   }

   var getChat = function(){
      $.ajax({
         'url': '{{route("getchat")}}',
         'data':{'group_id': '{{request()->id}}'},
         'dataType' : 'json',
      }).done(function(res){
         if(res.html.length > 0){
            $('.chat-messages').html(res.html);
         }else{
            $('.chat-messages').html(`<p>No chat found</p>`);
         }
         
      });
   }

   

</script>
@endsection