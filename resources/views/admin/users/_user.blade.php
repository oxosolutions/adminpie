@foreach($userList as $key => $value)
<div class="card-panel shadow white z-depth-1 hoverable project"  >
  <div class="row valign-wrapper no-margin-bottom">
    <div class="col l1 s2 center-align project-image-wrapper">
      <div class="defualt-logo"  data-toggle="popover" title="Click to view details" >
       {{ucfirst($value->name[0])}}
      </div>
      
    </div>
    
    <div class="col l11 s10 editable " >
      <div class="row m-0 valign-wrapper">
        <div class="col s8 m8 l8">
          <input type="hidden" value="{{$value->id}}" class="id" >
          <input type="hidden" name="_token" value="{{csrf_token()}}" class="shift_token" >
          
          <a href="{{route('user.get',$value->id)}}" data-toggle="popover" title="Click here to edit the user name" data-content="TEST" >
            <h5 class="project-title black-text flow-text truncate line-height-35">
              <span class="project-name shift_name font-size-14 name">{{$value->name}}</span>
            </h5> 
          </a>
        </div>
        
        <div class="col s4 m4 l4 right-align">
          <div class="switch">
            <a href="javascript:;" style="display: none" class="delete" data-toggle="popover" title="Click here to delete this Module">  <i class="fa fa-times red-text" aria-hidden="true"></i></a>
           </div>
        </div>
      </div>
    </div>
  </div>
    
</div>
@endforeach