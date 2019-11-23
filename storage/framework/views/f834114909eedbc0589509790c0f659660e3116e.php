
    <?php if($default_model != null): ?>
        
        <?php echo Form::model($default_model,['route'=>'save.form.data','method'=>'POST']); ?>

            <?php echo FormGenerator::GenerateForm($slug,[],$default_model,$form_from); ?>

    <?php else: ?>

        <?php echo Form::open(['route'=>'save.form.data','method'=>'POST']); ?>

            <?php echo FormGenerator::GenerateForm($slug,[],null,$form_from); ?>

    <?php endif; ?>
        
        <?php echo Form::hidden('form_id',$model->id); ?>


        <?php echo Form::close(); ?>