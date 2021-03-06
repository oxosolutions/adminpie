<?php
$placeholder = FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder');
   $fieldOptionsArray = [];
   $fieldOptionsArray['class'] = 'datepicker '.$collection->field_slug;
   $fieldOptionsArray['id'] = 'input_'.$collection->field_slug;
   $fieldOptionsArray['placeholder'] = $placeholder;
   $fieldOptionsArray['readonly'] = 'readonly';
   $fieldOptionsArray['data-validation'] = '';
   $validationString = '';
   if($field_validations != null){
       $javaScriptValidations = json_decode(@$field_validations);
       if(!empty($javaScriptValidations)){
           foreach($javaScriptValidations as $key => $validation){
               if(@$validation->field_validation == 'length'){
                   $fieldOptionsArray['data-validation-length'] = @$validation->validation_argument;
               }
               $validationString.= @$validation->field_validation.' ';
           }
           $fieldOptionsArray['data-validation'] = $validationString;
       }
   }
?>

<?php echo Form::text(str_replace(' ','_',strtolower($collection->field_slug)), null,$fieldOptionsArray); ?>


<?php if(Session::has('date_error')): ?>
<script type='text/javascript'>Materialize.toast('Date is already in use', 5000)</script>
<?php endif; ?>

<script >
 $('.datepicker').pickadate({
           format: 'yyyy/mm/dd',
   selectMonths: true, // Creates a dropdown to control month
   selectYears: 100, // Creates a dropdown of 15 years to control year
   min: new Date(1970,1,1),
   max: new Date(2030,1,1)
   //
    });
 $('.datepicker').on('open', function(){
  $('.datepicker').appendTo('body');
 });
</script>