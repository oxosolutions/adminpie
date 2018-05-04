<?php $__env->startSection('content'); ?>
<?php 
$page_title_data = array(
  'show_page_title' => 'yes',
  'show_add_new_button' => 'no',
  'show_navigation' => 'yes',
  'page_title' => 'Merge Dataset',
  'add_new' => '+ Add Visualization'
 
); 
 ?>
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
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php if($errors->any()): ?>

    <div class="aione-message error">
        <ul class="aione-messages">
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <li><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    
    <?php endif; ?>
    <?php if(Session::has('error')): ?>
        <p style="color:red;"> <?php echo e(Session::get('error')); ?></p>
    <?php endif; ?>
     
   <?php echo Form::open(['route'=>'merge.dataset']); ?>

    <?php echo FormGenerator::GenerateForm('merge_datasets_form'); ?>

    
    <?php echo Form::close(); ?>

    <div class="ar">

        
        <div class="preview">
            <?php if(!empty($merge_datasets)): ?>
           
            <div >
                <div class="dataset-title" ><strong>Dataset :</strong><?php echo e(@$new_dataset_name); ?> <a href="<?php echo e(route('view.dataset',['id'=>@$data_set_id])); ?>"> View Dataset</a> </div>
                <div class="aione-table preview-table">
                    <table class="compact">
                        <thead>
                            <tr>
                               <?php $__currentLoopData = $merge_datasets->first(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <th><?php echo e($val); ?></th>
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $merge_datasets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mkey=>$mval): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($mkey==0): ?>
                                    <?php continue; ?>
                                <?php endif; ?>
                                <tr>
                                    <?php $__currentLoopData = $mval; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nextkey => $nextval): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <td><?php echo e($nextval); ?></td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div> 
            </div>
           
            <?php endif; ?>
            
          
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
    <?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
     
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
    <?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>