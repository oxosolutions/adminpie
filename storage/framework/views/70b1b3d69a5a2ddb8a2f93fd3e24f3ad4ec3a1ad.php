<div class="aione-page-content-primary">
<?php if(!empty(Session::get('success'))): ?>
    <div class="aione-message success">
        <?php echo Session::get('success'); ?>

    </div>
<?php endif; ?>
<?php if(!empty(Session::get('error'))): ?>
    <div class="aione-message error">
        <?php echo Session::get('error'); ?>

    </div>
<?php endif; ?>
<?php if(!empty(Session::get('warning'))): ?>
    <div class="aione-message warning">
        <?php echo Session::get('warning'); ?>

    </div>
<?php endif; ?>