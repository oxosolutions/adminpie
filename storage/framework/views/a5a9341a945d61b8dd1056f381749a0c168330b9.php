<div class="row checkbox waves-effect " style="margin-bottom: 0px;padding: 14px;width: 100%">
    <div class="col l6">
        <?php echo e(ucfirst($collection->field_title)); ?>

    </div>
    <div class="col l6 right-align">
         <div class="switch">
            <label>
              <?php echo Form::hidden(str_replace(' ','_',strtolower($collection->field_title)),0); ?>

              <?php echo Form::checkbox(str_replace(' ','_',strtolower($collection->field_title)),1,null,[]); ?>

              <span class="lever"></span>
            </label>
          </div>
    </div>
</div>
