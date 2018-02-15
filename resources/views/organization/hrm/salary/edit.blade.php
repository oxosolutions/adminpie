@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
  'show_page_title' => 'yes',
  'show_add_new_button' => 'yes',
  'show_navigation' => 'yes',
  'page_title' => 'Edit Salary',
); 

// $data = $data->except(); 
// dump($data);
// foreach ($data as $key => $value) {

//   dump($key);
//   dump($value);
//   echo "<br>";
//   # code...
// }
    // dump($data['employee_id']);
    // $details = $salary->user_detail->metas->pluck('value','key');
     // $details['pay_scale']
     // App\\Model\\Organization
     
@endphp 

@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')

  {!! Form::open(['route'=>'salary.slip.update'])!!}

  @foreach ($data->toArray() as $key => $value)
    @if(in_array($key, ['created_at','updated_at']))
      @continue
      {{-- @php
       @continue 
      @endphp --}}
    @endif

    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
      @if($key =='id')
        {!!Form::hidden($key,$value, ['class'=>'form-control','placeholder'=>'Enter Role Name']) !!}

      @else
        {{-- {!!Form::label($key,$key) !!} --}}
        {{-- {!!Form::text($key,$value, ['class'=>'form-control','placeholder'=>'Enter Role Name']) !!} --}}
            <div id="field_46" data-conditions="0" data-field-type="text" class="field-wrapper ac field-wrapper-name field-wrapper-type-text ">
                <div id="field_label_name" class="field-label">

                    <label for="input_name">
                    <h4 class="field-title" id="{{$key,$key}}">{{ucwords(str_replace('_',' ',$key,$key))}}</h4>
                    </label>

                </div><!-- field label-->


                <div id="field_name" class="field field-type-text">

                    <input class="input-name" id="input_name" placeholder="Enter Designation" data-validation="" name="name" type="text" value="{{$value}}"> 

                </div><!-- field -->
            </div>
        @if($errors->has($key))
          <span class="help-block">
              {{ $errors->first($key) }}
          </span>
        @endif
      @endif
      </div>

  @endforeach
  {!! Form::submit() !!}
{!! Form::close() !!}

  

  


</div>


@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')

@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection