<li>
    <div class="row">
        <div class="col l6 pr-7">
            <div class="col s12 m2 l12 aione-field-wrapper">
                {!! Form::select('filter_columns[]',$columns,null,["class"=>"no-margin-bottom aione-field " , 'placeholder'=>'Chart Type'])!!}
            </div>
        </div>
        <div class="col l6">
              <div class="col s12 m2 l12 aione-field-wrapper">
                {!! Form::select('filter_type[]',App\Model\Organization\Visualization::filterTypes(),null,["class"=>"no-margin-bottom aione-field " , 'placeholder'=>'Chart Type'])!!}
            </div>
        </div>
        <i class="fa fa-close"></i>
    </div>
</li>
<script type="text/javascript">
     $(document).ready(function() {
        $('select').material_select();
      });
</script>