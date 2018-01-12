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
 <div class="content-wrapper">

<h1>helloooo</h1>
<div class="box-body">
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
        {!!Form::label($key,$key) !!}
        {!!Form::text($key,$value, ['class'=>'form-control','placeholder'=>'Enter Role Name']) !!}
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