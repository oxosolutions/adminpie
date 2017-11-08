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
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
<div class="row">
    {!! Form::open(['route'=>'role.delete' , 'method'=>'POST'])!!}
    <div class="row">
        <div class="col l9">
          <input type="hidden" name="old_role_id" value="{{$id}}">
            <p style="line-height: 24px;"><strong class="red-text">NOTE:</strong> You are about to Delete the role which is associate with many Users. Please select another role to replace with <STRONG>( {{$roleList[$id]['name']}} )</STRONG>.
            </p>    
        </div>
        <div class="col l3">
            <select name="new_role_id" class="browser-default">
                @foreach($roleList as $roleKey =>$roleVal) 
                    @if($id!= $roleVal['id']))
                        <option value="{{$roleVal['id']}}"  > {{$roleVal['name']}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        
    </div>
    {{-- <div class="row">
        <div class="card">
            <div class="row" style="margin-bottom: 0px">
                <div class="col l6 offset-l3">
                    <div class="row valign-wrapper" style="margin-bottom: 0px">
                        <div class="col l5">
                        <input type="hidden" name="old_role_id" value="{{$id}}">
                            Role <STRONG>{{$roleList[$id]['name']}}</STRONG>    
                        </div>
                        <div class="col l2">
                            Switch To
                        </div>
                        <div class="col l5" style="padding:10px">
                            <select name="new_role_id" class="browser-default">
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
    </div> --}}
    <div class="row" style="border: 1px solid #e8e8e8">
        <div class="row" style="background-color: #e8e8e8;padding:10px">
            List of users
        </div>
        <div class="row">
       {{--  {{dump($roleUser)}} --}}
            @foreach($roleUser as $key =>$value)
                <input name="user[]" value="{{$value['id']}}" type="hidden">
                    <div class="list-user">
                        <div class="chip" style="position: relative;">
                            {{-- {{dump($value->metas)}} --}}
                            @foreach($value->metas as $k => $v )
                                
                                @if($v->key == "profilePic")
                                    
                                    <img class="my-img" src="{{asset('ProfilePicture/'.$v->value)}}" >

                                @endif

                            @endforeach
                                <img class="default" src="{{asset('ProfilePicture/default-image.png')}}" >
                                <span>{{$value['name'][0]}}</span>
                                <a href="{{route('account.profile',$value->id)}}">{{$value['name']}}</a>
                         </div>
                    </div>
            @endforeach
        </div>
        <style type="text/css">
            .chip > span{
                    text-transform: capitalize;
                    position: absolute;
                    left: 0px;
                    color: white;
                    font-size: 20px;
                    font-weight: 900;
                    display: inline-block;
                    width: 32px;
            }
        </style>
      {{--   <script type="text/javascript">
            $(document).ready(function(){
                if($('.chip > img').hasClass('my-img')){
                    $('.chip .default').hide();
                }
            });
        </script> --}}

    </div>
    <div class=-"row">
        <button type="submit" class="btn blue">Delete Role</button>
    </div>
    {!! Form::close() !!}
</div>
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
<style type="text/css">
    .list-user{
        width: auto;
        display: inline-block;
        text-align: center;
        border-radius: 24px;
        color: white;
    }
</style>
@endsection