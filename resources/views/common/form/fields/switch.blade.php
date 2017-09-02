{!!Form::hidden(str_replace(' ','_',strtolower($collection->field_slug)),0)!!}
{!!Form::checkbox(str_replace(' ','_',strtolower($collection->field_slug)),1,null,['class'=>$collection->field_slug,'id'=>'input_'.$collection->field_slug])!!}
<label class="switch" for="input_{{$collection->field_slug}}">
    <span class="handle"></span>
</label>