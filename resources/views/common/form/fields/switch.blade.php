{{-- <div class="row checkbox waves-effect " style="margin-bottom: 0px;padding: 14px;width: 100%">
    <div class="col l6">
        {{ucfirst($collection->field_title)}}
    </div>
    <div class="col l6 right-align">
         <div class="switch">
            <label>
              {!!Form::hidden(str_replace(' ','_',strtolower($collection->field_title)),0)!!}
              {!!Form::checkbox(str_replace(' ','_',strtolower($collection->field_title)),1,null,[])!!}
              <span class="lever"></span>
            </label>
          </div>
    </div>
</div>
 --}}
@include('common.form.fields.includes.field-wrapper-start')
  @include('common.form.fields.includes.field-label-start')
    @include('common.form.fields.includes.label')
  @include('common.form.fields.includes.field-label-end')
  @include('common.form.fields.includes.field-start')
    <div class="switch">
      <label>
        {!!Form::hidden(str_replace(' ','_',strtolower($collection->field_title)),0)!!}
        {!!Form::checkbox(str_replace(' ','_',strtolower($collection->field_title)),1,null,[])!!}
        <span class="lever"></span>
      </label>
    </div>
    @include('common.form.fields.includes.error')
  @include('common.form.fields.includes.field-end')
@include('common.form.fields.includes.field-wrapper-end')
