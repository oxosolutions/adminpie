<div class="col l9">
	
	<div class="input-field col l12">
		{!! Form::hidden('id',null)!!}
		{!! Form::text('title',null,['class'=>'validate', 'placeholder'=>'Enter the title of the page'])!!}
		<label for="first_name">Page Name</label>
    </div>
    <div class="input-field col l12">
				 {!!Form::select('categories', App\Model\Organization\Category::getListByTypePage(),null)!!}
	</div>
	 <div class="input-field col l12">

    {!!Form::text('sub_title',null, ['class'=>'form-control','placeholder'=>'Enter Page Sub-title']) !!}
		<label for="first_name">Sub Title</label>
    </div>
     <div class="input-field col l12">

    {!!Form::text('slug',null, ['class'=>'form-control','placeholder'=>'Enter Page Sub-title']) !!}
		<label for="first_name">Slug</label>
    </div>
    <div class="input-field col s12">
    {!! Form::textarea('content', null , ["class"=>"materialize-textarea"]) !!}
{{--         <textarea name="content" id="textarea1" class="materialize-textarea"></textarea>
 --}}        <label for="textarea1">Description</label>
    </div>
   


 @if(!empty(@$model->page_image))
    <div class="input-group input-group-sm">
      {!!Form::label('page_image','Current Image') !!}<br/>
      <img src="{{asset('pages_data/').'/'.$model->page_image}}" width="160px" />
    </div><br/>
    @else
     {{-- <div class="input-group input-group-sm">
     
      <img src="{{asset('/No_Image_Available.png')}}" width="100px" />
    </div> --}}
    <br/>
   
  @endif
  {{-- <div class="{{ $errors->has('page_image') ? ' has-error' : '' }} input-group input-group-sm">
    {!!Form::label('page_image','Image') !!}
    {!!Form::file('page_image',['class'=>'form-control','id'=>'file-3']) !!}
    @if($errors->has('page_image'))
      <span class="help-block">
            {{ $errors->first('page_image') }}
      </span>
    @endif
  </div> --}}

</div>
	
	

<div class=" col l3">
	<div class="card row" style="padding: 10px">
		<div class="input-field col l12">
		{!! Form::select('post_status',['pending'=>'Pending', 'draft'=>'Draft' , 'published'=>'published'],null,['placeholder'=>'Choose Status'])!!}
		    {{-- <select >
				<option value="" disabled selected>Choose your option</option>
				<option value="1">Pending</option>
				<option value="2">Draft</option>
				<option value="3">Published</option>
		    </select> --}}
		    <label>Materialize Select</label>
		</div>
		<div class="col l12">
			<a href="#" class="btn col l12">
				Preview
			</a>
			<button class="btn col l12">
				Update
			</button>
		</div>
		<div style="clear: both">
			
		</div>
	</div>
	<div class="card shadow">	
		<div class="card-content">
			<span class="card-title activator blue-text text-darken-2">Categories<i class="material-icons">priority_high</i>
				
			</span>
		    <div class="divider"></div>
		    <p class="p-20">
	      	{{-- @foreach($categories as $key => $category)
	      		<div class="chip">{{$category->name}} <i class="close material-icons">close</i></div>
	      	@endforeach --}}
	      	<textarea class="chips chips-autocomplete" name="categories"> </textarea><div class="chips chips-autocomplete"></div> 
	      </p>
	    </div>
	</div>
	<div class="card shadow">	
		<div class="card-content">
			<span class="card-title activator blue-text text-darken-2">Tags<i class="material-icons">priority_high</i>
			</span>
	      <div class="divider"></div>
	      <p class="p-20">
	      	{{-- @foreach($tags as $key => $tag)
	      		<div class="chip">{{$tag}} <i class="close material-icons">close</i></div>
	      	@endforeach --}}
	      	<div class="chips chips-autocomplete projects-chips"></div>
	      </p>
	    </div>
	</div>
</div>
<style type="text/css">
	button{
		position:relative;
		margin-left: 0px;
		margin-bottom: 10px
	}
</style>
<script type="text/javascript">
	$(document).ready(function(){

		 $('.chips').material_chip();
			    $('.chips-autocomplete').material_chip({
    autocompleteOptions: {
      data: {
        'Apple': null,
        'Microsoft': null,
        'Google': null
      },
      limit: Infinity,
      minLength: 1
    }
  });

		// 	     $('.chips').on('chip.add', function(e, chip){
  //   console.log(chip.toSource+' '+e);
  // });
			    });
</script>









