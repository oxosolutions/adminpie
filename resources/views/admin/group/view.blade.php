@extends('admin.layouts.main')
@section('content')
{{-- page header is not working here  --}}
@php
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'no',
    'show_navigation' => 'yes',
    'page_title' => 'View Group&nbsp;&nbsp;<span>'.$group_data->name.'</span>',
    'add_new' => '+ Add User'
); 
@endphp
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
  @include('common.page_content_primary_start')
  @include('admin.group._tabs')
    <div class="aione-table">
        <table class="mb-20">
            <thead>
                <tr>
                    <th width="200">Field</th>    
                    <th>Value</th>    
                </tr>
                
            </thead>
            <tbody>
                @foreach($group_data->toArray() as $key => $value)
                    @if(!in_array($key,['id','created_by','updated_at']))
                        <tr>
                            <td>{{ ucwords(str_replace('_',' ',$key)) }}</td>
                            @if(is_array($value))
                                <td>
                                    @foreach($value as $k => $item)
                                        <span class="bg-cyan white p-5 display-inline-block mb-5" style="cursor: pointer;">{{ $item }}</span>
                                    @endforeach
                                </td>
                                {{-- <td>{{ implode(',',$value) }}</td> --}}
                            @else
                                <td>{{ $value }}</td>
                            @endif
                        </tr>
                    @endif
                @endforeach
                <tr>
                    <td>Organizations</td>
                    <td>
                        @foreach($oragnizations as $key => $value)
                            <a href="{{ route('auth.organization',$key) }}" target="_blank"><span class="bg-teal white p-5 display-inline-block" style="cursor: pointer;">{{ $value }}</span></a>
                        @endforeach
                    </td>
                </tr>
            </tbody>
        </table>
        <h5>Group having this organization</h5>
        <table>
            <thead>
                <tr>
                    <th width="200">Organizations</th>    
                    <th>Role</th>    
                </tr>
                
            </thead>
            <tbody>
               <tr>
                   <td>org name</td>
                   <td>1</td>
               </tr>
               <tr>
                   <td>org name</td>
                   <td>2</td>
               </tr>
            </tbody>
        </table>
    </div>
  @include('common.page_content_primary_end')
  @include('common.page_content_secondry_start')

  @include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection