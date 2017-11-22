

@extends('layouts.main')
@section('content')
@php
  $page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'yes',
    'show_navigation' => 'yes',
    'page_title' => 'Salary',
  ); 
    $id = "";
   $user_count    = count($data['users']);
   $salary_count  = count(array_filter( array_column($data['users']->toArray(), 'salary')));
@endphp 
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
<div>
{!! Form::open(['route'=>'hrm.generate.salary_view']) !!}
<div class="ac l50 m100 a100">
    <div class="aione-border">
            <div class="">
                <h5 class="aione-align-center font-weight-400 m-0 pv-10 bg-grey bg-lighten-4 aione-border-bottom">
                    Horizontal Filteration
                </h5>
            </div>
            <div id="aione_form_section_374" class="aione-form-section non-repeater p-5">
              <div id="field_fields" class="field-wrapper field-wrapper-fields field-wrapper-type-select ">
              <div id="field_label_select_status" class="field-label">
                <label for="input_select_status">
                  <h4 class="field-title" id="select_fiellds">Select Year</h4>
                </label>
              </div>
              <div id="field_fields" class="field w100 field-type-select">
                {!! Form::selectRange('year' , 2013,2017 , $data['year'], ['placeholder'=>'Select year' , 'class'=>'browser-default select']) !!}
              </div>
            </div>
          </div> 
          <div id="aione_form_section_374" class="aione-form-section non-repeater p-5">
              <div id="field_fields" class="field-wrapper field-wrapper-fields field-wrapper-type-select ">
              <div id="field_label_select_status" class="field-label">
                <label for="input_select_status">
                  <h4 class="field-title" id="select_fiellds">Select Month</h4>
                </label>
              </div>
              <div id="field_fields" class="field field-type-select">
                  {!! Form::selectMonth('month', $data['month'], ['placeholder'=>'Select year' , 'class'=>'browser-default select']);!!}               
              </div>
            </div>
          </div> 
        </div>
    <div class="aione-row search-options aione-align-left mv-10">
      <button type="submit" class="aione-button" name="Search"><i class="fa fa-search mr-5"></i>Filter</button>
    </div>
  </div>
{{-- {!! Form::submit('filter') !!} --}}

</div>

<div class="aione-tables">


@if(isset($data['users']) && !empty($data['users']))
       
 {{--  {!! Form::open(['route'=>'hrm.generate.salary']) !!}  --}}
   <table>
        <thead>
            <tr>
                <th class="bg-light-blue bg-darken-4 white aione-align-center">
                @if($user_count != $salary_count)
                  <input type="checkbox"  id="selectAll">
                @endif

                </th>
                <th colspan="2" class="bg-light-blue bg-darken-4 white aione-align-center"> Name</th>
            </tr>
        </thead>
        <tbody>
       {{-- {{ dump($data['users']->toArray() ) }} --}}
        @foreach($data['users'] as $key => $value)
            <tr>
                <td class="light-blue darken-4 aione-align-center">
                  @if(empty($value['salary']))
                      <input type="checkbox" name="user_select[]" value="{{ $value->id }}">
                    @else
                      <a href="{{route('salary.slip.view',['id'=>$value['salary']['id']]) }}">    View    </a>
                      <a href="{{route('salary.slip.delete',['id'=>$value['salary']['id']]) }}">  Delete  </a>
                  @endif
                </td>
                <td >{{ $value['belong_group']['name'] }}</td>
                <td >01/10/2017</td>
            </tr>
        @endforeach
         @if($user_count != $salary_count)
             <div class="aione-row search-options aione-align-left mv-10">
              <button type="submit" class="aione-button" name="generate_salary" value="Generate Salary 1"><i class="fa fa-search mr-5"></i>Generate Salary</button>
            </div>
          
          @endif
        </tbody>
    </table>
    {!! Form::close()  !!}
@endif


@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')

<script>
	$(document).ready(function(){

		$('#selectAll').click(function(e){
    		var table= $(e.target).closest('table');
    		$('td input:checkbox',table).prop('checked',this.checked);
		});

		// $("#select_all").click(function(e){
		// 	$(this).closet()
		// });

	});

</script>

@endsection