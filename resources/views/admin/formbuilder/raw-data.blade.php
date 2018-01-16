@if(Auth::guard('admin')->check() == true)
  @php
        $from = 'admin';
        $layout = 'admin.layouts.main';
  @endphp
@else
  @php
        $from = 'org';
        $layout = 'layouts.main';
  @endphp
@endif
@extends($layout)
@section('content')
@php
    
    $title = $form->form_title;


@endphp
@php
$page_title_data = array(
  'show_page_title' => 'yes',
  'show_add_new_button' => 'no',
  'show_navigation' => 'yes',
  'page_title' => 'Form <span>'.$title.'</span>',
  'add_new' => '+ Add Module'
); 
@endphp

@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
@include('admin.formbuilder._tabs')
    <div class="aione-table">
        <table class="stripped">
            @if(!$model->isEmpty())
                <tr>
                    @foreach($model[0]->toArray() as $key => $value)
                        @if(!in_array($key,['updated_at']))
                            <th><b>{{ ucwords(str_replace('_',' ',$key)) }}</b></th>
                        @endif
                    @endforeach
                </tr>
            @endif
            @if(!$model->isEmpty())
                @foreach($model as $key => $value)
                    <tr>
                        @foreach($value->toArray() as $column_key => $column_value)
                            @if(!in_array($column_key,['updated_at']))
                                @if($column_key == 'created_at')
                                    <td>{{ \Carbon\Carbon::parse($column_value)->diffForHumans() }}</td>
                                @else
                                    <td>{{ $column_value }}</td>
                                @endif
                            @endif
                        @endforeach
                    </tr>
                @endforeach
            @endif
        </table>
        {!! $model->render() !!}
    </div>
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
<style type="text/css">
   .subtitle{
                
   
    font-weight: 500;
    display: inline-block;

         }
</style>
@endsection