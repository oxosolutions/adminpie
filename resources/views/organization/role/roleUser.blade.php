@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'no',
    'show_navigation' => 'yes',
    'page_title' => 'Delete Confirmation',
    'add_new' => ''
);
@endphp
@include('common.pageheader',$page_title_data)
<div class="row">
    {!! Form::open(['route'=>'role.delete' , 'method'=>'POST'])!!}
    <div class="row">
        The role you want to delete is assosiated with the following users.You may change the role of users
    </div>
    <div class="row">
        <div class="card">
            <div class="row">
                <div class="col l6 offset-l3">
                    <div class="row valign=-wrapper">
                        <div class="col l5">
                        <input type="hidden" name="old_role_id" value="{{$id}}">
                            Role <STRONG>{{$roleList[$id]['name']}}</STRONG>    
                        </div>
                        <div class="col l2">
                            Switch To
                        </div>
                        <div class="col l5">
                            <select name="new_role_id">
                                @foreach($roleList as $roleKey =>$roleVal) 
                                    @if($id!= $roleVal['id']))
                                        <option value="{{$roleVal['id']}}"  > {{$roleVal['name']}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="row">
            List of users
        </div>
        @foreach($roleUser as $key =>$value)
            <div class="row">
            <input name="user[]" value="{{$value['id']}}" type="hidden">
                {{$value['name']}}
            </div>
        @endforeach
    </div>
    <div class=-"row">
        <button type="submit" class="btn blue">Delete Role</button>
    </div>
    {!! Form::close() !!}
</div>
@endsection