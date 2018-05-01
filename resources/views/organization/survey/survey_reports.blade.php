@extends('layouts.main')
@section('content')
    <style type="text/css">
        #aione_form_wrapper_abc {
            border: 1px solid #e8e8e8;
            margin-bottom: 10px;
            padding: 10px
        }

        .remove_condition i {
            font-size: 22px;
            display: inline-block;
            margin-top: 54px;
            margin-right: 30px;
            float: right;
        }

        .search-options, .result-options {
            margin-bottom: 10px
        }

        .search-options input[type=submit],
        .result-options input,
        .result-options a {
            float: right;
        }

        .result-options input {
            float: left;
            color: white;
            display: inline-block;
            padding: 0 10px;
            font-size: 16px;
            line-height: 30px;
            font-weight: 400;
            font-family: "Open Sans", Arial, Helvetica, sans-serif;
            text-align: center;
            cursor: pointer;
            -webkit-transition: all 150ms ease-out;
            -moz-transition: all 150ms ease-out;
            -o-transition: all 150ms ease-out;
            transition: all 150ms ease-out;
        }

        .result-options input:hover {
            background-color: none;
        }
    </style>
    @php
        $operator_options = [
                                "="=>'Equal to',
                                 ">"=>'Greater then',
                                 "<"=>'Less then' ,
                                ">="=>'Greater then and equal to',
                                "<="=>'Less then and equal to',
                                "like"=>' match with'
                            ];
         if(!empty($data) && !isset($data['error'])){
            $keys = array_keys($data[0]);
        }
        $page_title_data = array(
            'show_page_title' => 'yes',
            'show_add_new_button' => 'no',
            'show_navigation' => 'yes',
            'page_title' => 'Survey Report <span>'.get_survey_title(request()->route()->parameters()['id']).'</span>',
            'add_new' => '+ Add Media'
        );
    @endphp
    @include('common.pageheader',$page_title_data)
    @include('common.pagecontentstart')
    @include('common.page_content_primary_start')
    @include('organization.survey._tabs')

    @if(!empty($error))
        <div class="aione-message warning">
            {{ __("survey.survey_results_table_missing") }}
        </div>
    @else
        {!! Form::open(['route'=>['survey.reports',@request()->id],'method' => 'post' ]) !!}
        <div class="ar">
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
                                    <h4 class="field-title" id="select_fiellds">Select Fields</h4>
                                </label>
                            </div>
                            <div id="field_fields" class="field field-type-multi_select">
                                {!! Form::select('fields[]',@$columns,null,['placeholder'=>'Select field' ,'multiple'=>true, 'class'=>'browser-default select'])  !!}
                                <div class="field-actions">
                                    <a hraf="#" class="aione-form-multiselect-all aione-action-link">Select All</a> /
                                    <a href="#" class="aione-form-multiselect-none aione-action-link">Select None</a>
                                </div>
                            </div>
                        </div>
                    </div> <!-- .aione-form-section -->
                </div>
            </div>
            <div class="ac l50 m100 a100">
                <div class="aione-border">
                    <div class="">
                        <h5 class="aione-align-center font-weight-400 m-0 pv-10 bg-grey bg-lighten-4 aione-border-bottom">
                            Vertical Filteration
                        </h5>
                    </div>
                    <div id="aione_form_section_374" class="aione-form-section non-repeater p-5">
                        <div class="aione-box">
                            <style type="text/css">
                                .repeater-wrapper .repeater-row > i {
                                    z-index: 999999
                                }
                            </style>
                            <div class="repeater-group">
                                <div class="repeater-wrapper">
                                    @if(!empty(request()->all()))
                                        @php
                                            $request = request()->all();
                                        @endphp
                                        @foreach($request['condition_field'] as $filledKey => $filledVal)
                                            <div class="repeater-row ar">
                                                <i class="material-icons dp48 repeater-row-delete">close</i>
                                                <div id="aione_form_section_527" class="aione-form-section">
                                                    <div class="aione-row">
                                                        <div id="aione_form_section_content" class="aione-form-section-content">
                                                            <div class="aione-row ar">
                                                                <div id="field_2477" data-conditions="0" data-field-type="select" class="field-wrapper ac field-wrapper-column field-wrapper-type-select l33 m33 s100">
                                                                    <div id="field_column" class="field field-type-select">
                                                                        {!! Form::select("condition_field["
                                                                        .$filledKey."]",$condition_fields,
                                                                        $request['condition_field'][$filledKey] ,['placeholder'=>'Select field' , 'class'=>'browser-default select'])  !!}
                                                                    </div><!-- field -->
                                                                </div><!-- field wrapper -->
                                                                <div id="field_2478" data-conditions="0" data-field-type="select" class="field-wrapper ac field-wrapper-operation field-wrapper-type-select l33 m33 s100">
                                                                    <div id="field_operation" class="field field-type-select">
                                                                        {!! Form::select('operator['.$filledKey.']',
                                                                        $operator_options, $request['operator'][$filledKey] ,
                                                                        ['placeholder'=>'Select field' , 'class'=>'browser-default select'])  !!}

                                                                    </div><!-- field -->
                                                                </div><!-- field wrapper -->
                                                                <div id="field_2479" data-conditions="0" data-field-type="text" class="field-wrapper ac field-wrapper-value field-wrapper-type-text l33 m33 s100">
                                                                    <div id="field_value" class="field field-type-text">
                                                                        <input class="input-value" id="input_value"
                                                                                placeholder="" data-validation=""
                                                                                name="condition_field_value[{{$filledKey}}]" type="text" value="{{ $request['condition_field_value'][$filledKey] }}">
                                                                    </div><!-- field -->
                                                                </div><!-- field wrapper -->
                                                            </div> <!-- .aione-row -->
                                                        </div> <!-- .aione-form-content -->
                                                    </div> <!-- .aione-row -->
                                                </div> <!-- .aione-form-section -->
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="repeater-row ar">
                                            <i class="material-icons dp48 repeater-row-delete">close</i>
                                            <div id="aione_form_section_527" class="aione-form-section">
                                                <div class="aione-row">
                                                    <div id="aione_form_section_content" class="aione-form-section-content">
                                                        <div class="aione-row ar">
                                                            <div id="field_2477" data-conditions="0" data-field-type="select" class="field-wrapper ac field-wrapper-column field-wrapper-type-select l33 m33 s100">
                                                                <div id="field_column" class="field field-type-select">
                                                                    {!! Form::select('condition_field[]',$condition_fields,null,['placeholder'=>'Select field' , 'class'=>'browser-default select'])  !!}
                                                                </div><!-- field -->
                                                            </div><!-- field wrapper -->
                                                            <div id="field_2478" data-conditions="0" data-field-type="select" class="field-wrapper ac field-wrapper-operation field-wrapper-type-select l33 m33 s100">
                                                                <div id="field_operation" class="field field-type-select">
                                                                    {!! Form::select('operator[]',$operator_options, null ,['placeholder'=>'Select field' , 'class'=>'browser-default select'])  !!}
                                                                </div><!-- field -->
                                                            </div><!-- field wrapper -->
                                                            <div id="field_2479" data-conditions="0" data-field-type="text" class="field-wrapper ac field-wrapper-value field-wrapper-type-text l33 m33 s100">
                                                                <div id="field_value" class="field field-type-text">
                                                                    <input class="input-value" id="input_value" placeholder="" data-validation="" name="condition_field_value[]" type="text">
                                                                </div><!-- field -->
                                                            </div><!-- field wrapper -->
                                                        </div> <!-- .aione-row -->
                                                    </div> <!-- .aione-form-content -->
                                                </div> <!-- .aione-row -->
                                            </div> <!-- .aione-form-section -->
                                        </div>

                                    @endif
                                </div>
                                <button type="submit" class="aione-float-right aione-button add-new-repeater">Add New</button>
                                <div style="clear: both">
                                </div>
                            </div>
                        </div>
                    </div> <!-- .aione-form-section -->
                </div>
            </div>
        </div>
        <div class="field-wrapper field-wrapper-SLUG field-wrapper-type-select ">
            <div id='parent'>
            </div>
            <div class="aione-row search-options aione-align-right mv-10">
                <button type="submit" class="aione-button" name="export" value="export">
                    <i class="fa fa-sign-out mr-5"></i>Export Records
                </button>
                <button type="submit" class="aione-button" name="Search"><i class="fa fa-search mr-5"></i>Search
                </button>
            </div>
            {!! Form::close() !!}
        </div>


        @if(empty($model))
            <div class="aione-message warning">
                {{ __('survey.survey_results_table_missing') }}
            </div>
        @elseif(!empty($data['error']))
            <div class="aione-message warning">
                {{$data['error']}}
            </div>


        @else

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li style="color: red;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(!$model->isEmpty())
                <div id="table-structure" class="aione-table scrollx">
                    <div class="ac l80" style="line-height: 48px">Showing {{@$firstItem}} to {{@$lastItem}} of {{@$total}} records</div>
                    <table class="compact">
                        <thead>
                            <tr>
                                @php
                                    $columnsInOrderWithHeaders = [];
                                @endphp
                                @foreach($model[0] as $key =>$val)
                                    @php
                                        $columnsInOrderWithHeaders[] = $key;
                                    @endphp
                                    <th>
                                        <span class="aione-tooltip truncate" tooltip-data="">
                                        {{ @$key }}
                                        </span>
                                    </th>

                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($model as $keys => $vals )
                                @php
                                    $vals = (array)$vals;
                                @endphp
                                <tr>
                                    @foreach($columnsInOrderWithHeaders as $key => $column)
                                        <span class="aione-tooltip truncate" tooltip-data="{{$vals[$column]}}">
                                            <td>{{$vals[$column]}} </td>
                                        </span>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="aione-message warning">
                    No matching records found!
                </div>
            @endif
        @endif
    @endif
    @if(@$model != null)
        {{ @$model->render()}}
    @endif

    <style>
        .disappear {
            display: none;
        }

        .appear {
            display: block;
        }
    </style>

    <script>
        $('#more_condition').on('click', function (event) {
            $("#child").html();
            event.preventDefault();
            childs = $("#child").html();
            $("#append").append(childs);
            $("#append").find('a.remove_condition').addClass('appear');
        });

        function remove_parent(event) {
            $(event).parent('div').remove();
        }

        $(".close").hide();
    </script>

    @include('common.page_content_primary_end')
    @include('common.page_content_secondry_start')
    @include('common.page_content_secondry_end')
    @include('common.pagecontentend')
@endsection