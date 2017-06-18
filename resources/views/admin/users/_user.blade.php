@foreach($userList as $key => $value)
{{-- <div class="card-panel shadow white z-depth-1 hoverable project"  >
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
          
            <h5 title="Click here to edit the user name" class="project-title black-text flow-text truncate line-height-35">
              <span class="project-name shift_name font-size-14 name">{{$value->name}}</span>
            </h5> 
        </div>
        
        <div class="col s4 m4 l1 right-align">
          <div class="switch">
              <a href="javascript:;" onclick="return confirm('Are you sure?')" style="display: none" class="delete" data-toggle="popover" title="Click here to delete this Module"><i class="fa fa-times red-text" aria-hidden="true"></i></a>

             <a href="{{route('user.get',$value->id)}}" style="display: none" class="edit" data-toggle="popover" title="Click here to update this Module"><i class="fa fa-edit" aria-hidden="true"></i></a>
          </div>
        </div>
        
      </div>
    </div>
  </div>
    
</div> --}}
{{-- <div class="card" style="padding:5px 10px;margin-bottom: 5px;font-size: 13px;font-weight: 500;">
    <div class="row">
        <div class="col s7">Name</div>
        <div class="col s3">Status</div>
        <div class="col s2">Others</div>    
    </div>
</div> --}}
<div class="card-panel shadow white z-depth-1 hoverable project"  >
    <div class="row valign-wrapper">
        <div class="col s7">
            <div class="row valign-wrapper">
                <div class="col">
                    <div class="blue white-text" style="text-align: center;width: 32px;line-height: 32px;">
                        {{ucfirst($value->name[0])}}
                    </div>  
                </div>
                <input type="hidden" value="{{$value->id}}" class="id" >
                <input type="hidden" name="_token" value="{{csrf_token()}}" class="shift_token" >
                <div class="col" style="padding-left: 10px">
                    <div style="font-weight: 500;" class="">{{$value->name}}</div>
                    <div class="project-description"></div>
                    <div class="aione-list-options">
                        <a style="padding-right:10px" href="{{route('user.get',$value->id)}}"  class="edit" data-toggle="popover" title="Click here to update this Module">Edit</a>
                        <a href="" style="padding-right:10px">View</a>
                        <a style="padding-right:10px;color: red" href="javascript:;" onclick="return confirm('Are you sure?')"  class="delete" data-toggle="popover" title="Click here to delete this Module">Delete</a>
                    </div>
                </div>
            </div>

        </div>
        <div class="col s3">
            
        </div>
        <div class="col s2 right-align">
           
        </div>  
    </div>
    
</div>
<style type="text/css">
    .aione-list-options{
        position: absolute;
        font-size: 12px;
        display: none;
        margin-top:-3px;
    }
    .card-panel:hover .aione-list-options{
        display: block
    }
</style>
@endforeach