

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
  
  @endphp 
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')


<div> 

<div> {!! Form::selectRange('year' , 2013,2017 , $data['year'])  !!} </div>
<div> {!! Form::selectMonth('month', $data['month']);!!} </div>

</div>

<div class="aione-tables">
{{ dump($data['users']->toArray()) }}
    <table>
        <thead>
            <tr>
                <th class="bg-light-blue bg-darken-4 white aione-align-center"><input type="checkbox" name="all"></th>
                <th colspan="2" class="bg-light-blue bg-darken-4 white aione-align-center"> Name</th>
            </tr>
        </thead>
        <tbody>
        @foreach($data['users'] as $key => $value)
            <tr>
                <td class="light-blue darken-4 aione-align-center"><input type="checkbox" name="user_select[]" value=""></td>
                <td >{{ $value['belong_group']['name'] }}</td>
                <td >01/10/2017</td>
            </tr>
        @endforeach
        </tbody>
    </table>


@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')

@endsection