@if(Auth::guard('admin')->check() == true)
  @php
        $from = 'admin';
        $layout = 'admin.layouts.main';
        $route = 'admin.store.page';
  @endphp
@else
  @php
        $from = 'org';
        $layout = 'layouts.main';
        $route = 'store.page';
  @endphp
@endif
@extends($layout)


@section('content')
@php
$page_title_data = array(
'show_page_title' => 'yes',
'show_add_new_button' => 'yes',
'show_navigation' => 'yes',
'page_title' => 'Pages',
'add_new' => '+ Add Page'
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
@include('common.list.datalist')
<input type="hidden" name="_token" value="{{csrf_token()}}" class="page_token">
@include('common.page_content_primary_end')
  @include('common.page_content_secondry_start')
    {!! Form::open(['route'=>$route , 'class'=> 'form-horizontal','method' => 'post'])!!}
  @include('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add Page','button_title'=>'Save','section'=>'pagesec1']])
{!!Form::close()!!}
@include('common.page_content_secondry_end')
@include('common.pagecontentend')		
<script type="text/javascript">
/**
 * @param  {[none]}
 * @uses   {[change stats of page]}
 * @return {[type]}
 */
 $(document).on('change', '.pageStatus',function(e){
      e.preventDefault();
      var postedData = {};
      postedData['id']        	= $(this).parents('.switch').find('input[name=id]').val();
      postedData['status']      = $(this).prop('checked');
      postedData['_token']      = $('.page_token').val();
      var from = '{{$from}}';
      if(from == 'admin'){
        var url = 'page/status/update'
      }else{
        var  url = 'pages/status/update'
      }
      $.ajax({
        url:route()+'/'+url,
        type:'POST',
        data:postedData,
        success: function(res){
          if(res == 'true'){
          	Materialize.toast('Status Changed', 4000000);
          }
        }
      });
      $('.editable h5 ,.editable p').removeClass('edit-fields');
    });

	$('.add-new').off().click(function(e){
		e.preventDefault();
		$('.add-new-wrapper').toggleClass('active');
		$('.fade-background').fadeToggle(300);
	});
	
	$('.fade-background').click(function(){
		$('.fade-background').fadeToggle(300);
		$('.add-new-wrapper').toggleClass('active');
	});
</script>
<style type="text/css">
   .toast{
        top: 10px;
        left: 80px;
    }
</style>
@endsection