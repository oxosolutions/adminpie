@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
  'show_page_title' => 'yes',
  'show_add_new_button' => 'no',
  'show_navigation' => 'yes',
  'page_title' => 'Merge Dataset',
  'add_new' => '+ Add Visualization'
 
); 
@endphp
<style type="text/css">
    .preview > div{
      margin-bottom: 20px;
    }
    .preview .preview-table,
    .merge-preview .preview-table{
            min-width: 100%;
    overflow: scroll;
    min-height: 0;
    max-height: 400px;
    }
     .preview .dataset-title,
     .merge-preview .dataset-title{
      padding: 10px;    border: 1px solid #e8e8e8;
     }
    .sweet-alert input{
      display: block
    }
</style>
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
    @include('common.page_content_primary_start')
    @if ($errors->any())

    <div class="aione-message error">
        <ul class="aione-messages">
        @foreach ($errors->all() as $error)
             <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    
    @endif
    @if(Session::has('error'))
        <p style="color:red;"> {{Session::get('error')}}</p>
    @endif
     {{-- @if(Session::has('success'))
        <div class="aione-message success">
            <ul class="aione-messages">
                <li>{{Session::get('success')}}</li>
            </ul>
        </div>
    @endif --}}
   {!! Form::open(['route'=>'merge.dataset'])!!}
    {!! FormGenerator::GenerateForm('merge_datasets_form')  !!}
    
    {!! Form::close() !!}
    <div class="ar">

        
        <div class="preview">
            @if(!empty($merge_datasets))
           
            <div >
                <div class="dataset-title" ><strong>Dataset :</strong>{{@$new_dataset_name}} <a href="{{route('view.dataset',['id'=>@$data_set_id]) }}"> View Dataset</a> </div>
                <div class="aione-table preview-table">
                    <table class="compact">
                        <thead>
                            <tr>
                               @foreach($merge_datasets->first() as $key =>$val)
                                    <th>{{$val}}</th>
                               @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($merge_datasets as $mkey=>$mval)
                                @if($mkey==0)
                                    @continue
                                @endif
                                <tr>
                                    @foreach($mval as $nextkey => $nextval)
                                        <td>{{$nextval}}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> 
            </div>
           
            @endif
            {{--<div >
                <div class="dataset-title" ><strong>Dataset :</strong>Name of the datsset</div>
                <div class="aione-table preview-table" >
                    <table class="compact">
                        <thead>
                            <tr>
                                <th>demo header</th>
                                <th>demo header</th>
                                <th>demo header</th>
                                <th>demo header</th>
                                <th>demo header</th>
                                <th>demo header</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                            </tr>
                            <tr>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                            </tr>
                            <tr>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                            </tr>
                            <tr>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                            </tr>
                            <tr>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                            </tr>
                            <tr>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                            </tr>
                        </tbody>
                    </table>
                </div> 
            </div> --}}
          
        </div>
        <div class="merge-preview" style="display: none">
            <h6>Result Preview</h6>
            <div>
                <div class="dataset-title" ><strong>Dataset :</strong>Name of the datsset 1 + <strong>Dataset :</strong>Name of the datsset 2</div>
                <div class="aione-table preview-table">
                    <table class="compact">
                        <thead>
                            <tr>
                                <th>demo header</th>
                                <th>demo header</th>
                                <th>demo header</th>
                                <th>demo header</th>
                                <th>demo header</th>
                                <th>demo header</th>
                                 <th>demo header</th>
                                <th>demo header</th>
                                <th>demo header</th>
                                <th>demo header</th>
                                <th>demo header</th>
                                <th>demo header</th>
                                 <th>demo header</th>
                                <th>demo header</th>
                                <th>demo header</th>
                                <th>demo header</th>
                                <th>demo header</th>
                                <th>demo header</th>
                                 <th>demo header</th>
                                <th>demo header</th>
                                <th>demo header</th>
                                <th>demo header</th>
                                <th>demo header</th>
                                <th>demo header</th>
                                 <th>demo header</th>
                                <th>demo header</th>
                                <th>demo header</th>
                                <th>demo header</th>
                                <th>demo header</th>
                                <th>demo header</th>
                                 <th>demo header</th>
                                <th>demo header</th>
                                <th>demo header</th>
                                <th>demo header</th>
                                <th>demo header</th>
                                <th>demo header</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                 <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                 <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                            </tr>
                             <tr>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                 <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                 <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                            </tr>
                             <tr>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                 <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                 <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                            </tr>
                             <tr>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                 <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                 <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                            </tr>
                             <tr>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                 <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                 <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                            </tr>
                             <tr>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                 <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                 <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                            </tr>
                             <tr>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                 <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                 <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                            </tr>
                            <tr>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                            </tr>
                            <tr>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                            </tr>
                            <tr>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                            </tr>
                            <tr>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                            </tr>
                            <tr>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                                <td>demo cell</td>
                            </tr>
                        </tbody>
                    </table>
                </div> 
            </div>
           
          
        </div>
    </div>
    @include('common.page_content_primary_end')
    @include('common.page_content_secondry_start')
     {{--  {!!Form::open(['route'=>'save.visualization'])!!}
    	   @include('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add Visualization','button_title'=>'Save & Next','section'=>'vissec1']])
      {!!Form::close()!!} --}}
      <script type="text/javascript">
        // $(document).on('click','.merge',function(e){
        //    e.preventDefault();
        //   swal({
        //     title: 'Enter name of dataset ',
        //     input: 'text',
        //     showCancelButton: true,
        //     confirmButtonText: 'Submit',
        //     showLoaderOnConfirm: true,
        //     preConfirm: function (email) {
        //       return new Promise(function (resolve, reject) {
        //         setTimeout(function() {
        //           if (email === 'taken@example.com') {
        //             reject('This name is already taken.')
        //           } else {
        //             resolve()
        //           }
        //         }, 2000)
        //       })
        //     },
        //     allowOutsideClick: false
        //   }).then(function (email) {
        //     swal({
        //       type: 'success',
        //       title: 'Ajax request finished!',
        //       html: 'Submitted email: ' + email
        //     })
        //   })
        // })
        $(document).on('click','.preview-result',function(e){
           $('.preview').hide();
            $('.merge-preview').show();
        })
         $(document).on('click','.preview-datasets',function(e){
           $('.merge-preview').hide();
           $('.preview').show();
         
        })
        
      </script>
    @include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection

