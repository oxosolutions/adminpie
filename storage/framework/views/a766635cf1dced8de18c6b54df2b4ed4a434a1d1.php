<?php $__env->startSection('content'); ?>
<?php
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'no',
    'show_navigation' => 'yes',
    'page_title' => 'Stats <span>'.get_survey_title(request()->route()->parameters()['id']).'</span>',
    'add_new' => '+ Add Media'
);

?> 
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('organization.survey._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php if($data['status'] == 'error'): ?>
        <?php echo aione_message($data['errors'],'error','center'); ?>

    <?php endif; ?>

        <div class="ar pb-20">
            <div class="ac s100 m50 l25">
                <div class="aione-widget aione-border bg-grey bg-lighten-5">
                    <div class="aione-title">
                        <h5 class="aione-align-center font-weight-400 aione-border-bottom m-0 pv-10 mb-10 bg-grey bg-lighten-4">Sections</h5>
                    </div>
                    <div class="aione-align-center p-30 font-size-64 font-weight-600 blue-grey darken-2"><?php echo e(@$data['count']['sections']); ?></div>
                </div>
            </div>
            <div class="ac s100 m50 l25">
                <div class="aione-widget aione-border bg-grey bg-lighten-5">
                    <div class="aione-title">
                        <h5 class="aione-align-center font-weight-400 aione-border-bottom m-0 pv-10 mb-10 bg-grey bg-lighten-4">Questions</h5>
                    </div>
                    <div class="aione-align-center p-30 font-size-64 font-weight-600 blue-grey darken-2"><?php echo e(@$data['count']['fields']); ?></div>
                </div>
            </div>
            <div class="ac s100 m50 l25">
                <div class="aione-widget aione-border bg-grey bg-lighten-5">
                    <div class="aione-title">
                        <h5 class="aione-align-center font-weight-400 aione-border-bottom m-0 pv-10 mb-10 bg-grey bg-lighten-4">Completed Responses</h5>
                    </div>
                        <div class="aione-align-center p-30 font-size-64 font-weight-600 blue-grey darken-2"><?php echo e(@$data['count']['completed']); ?></div>
                </div>
            </div>
            <div class="ac s100 m50 l25">
                <div class="aione-widget aione-border bg-grey bg-lighten-5">
                    <div class="aione-title">
                        <h5 class="aione-align-center font-weight-400 aione-border-bottom m-0 pv-10 mb-10 bg-grey bg-lighten-4">Incomplete Responses</h5>
                    </div>
                    <div class="aione-align-center p-30 font-size-64 font-weight-600 blue-grey darken-2"><?php echo e(@$data['count']['incomplete']); ?></div>
                </div>
            </div>
        </div>

        <div class="ar pb-20">
            <div class="ac s100 m100 l50">
                <div class="aione-widget bg-grey bg-lighten-5">
                    <div class="aione-title aione-border-top aione-border-right aione-border-left">
                        <h5 class="aione-align-center font-weight-400 m-0 pv-10 bg-grey bg-lighten-4">
                            User Responses
                        </h5>
                    </div>
                    <div class="aione-table">
                        <table class="compact">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th colspan="3">Responses</th>
                                </tr>
                                <tr>
                                    <th>User</th>
                                    <th>Total</th>
                                    <th>Complate </th>
                                    <th>Incomplete </th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php if(isset($data['user_by']) && !empty($data['user_by'])): ?> 
                                    <?php $__currentLoopData = $data['user_by']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_key => $user_val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <?php if(!empty($user_val->user_id)): ?>
                                                    <?php
                                                       $user_detail = get_user_detail(false, true, $user_val->user_id);
                                                    ?>
                                                    <?php if(isset($user_detail['name'])): ?>
                                                        <?php echo e($user_detail['name']); ?> (<?php echo e($user_detail['email']); ?>)
                                                    <?php else: ?>
                                                        <?php echo e($user_val->user_id); ?>

                                                    <?php endif; ?>
                                                <?php else: ?>
                                                unknown 
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo e($user_val->total); ?></td>
                                            <td><?php echo e($user_val->completed); ?></td>
                                            <td><?php echo e($user_val->uncompleted); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                        </table>
                                <?php else: ?>
                                 </tbody>
                        </table>
                                <?php echo aione_message('No Data Exist','error','center'); ?> </td>
                                
                                <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="ac s100 m100 l50">
                <div class="aione-widget bg-grey bg-lighten-5">
                    <div class="aione-title aione-border-top aione-border-right aione-border-left">
                        <h5 class="aione-align-center font-weight-400 m-0 pv-10 bg-grey bg-lighten-4">
                            Daywise Responses
                        </h5>
                    </div>
                    <div class="aione-table">
                        <table class="compact">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th colspan="3">Responses</th>
                                </tr>
                                <tr>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Completed </th>
                                    <th>Incomplete </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(isset($data['date_by']) && !empty($data['date_by'])): ?> 
                                <?php $__currentLoopData = $data['date_by']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date_key => $date_val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($date_val->date); ?></td>
                                        <td><?php echo e($date_val->total); ?></td>
                                        <td><?php echo e($date_val->completed); ?></td>
                                        <td><?php echo e($date_val->uncompleted); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                 </tbody>
                        </table>
                                <?php else: ?>
                                 </tbody>
                        </table>
                                <?php echo aione_message('No Data Exist','error','center'); ?> </td>
                                
                                <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="ar pb-20">
            <div class="ac s100 m100 l50">
                <div class="aione-widget bg-grey bg-lighten-5">
                    <div class="aione-title aione-border-top aione-border-right aione-border-left">
                        <h5 class="aione-align-center font-weight-400 m-0 pv-10 bg-grey bg-lighten-4">
                            User Responses
                        </h5>
                    </div>
                    <div class="aione-table">
                        <table class="compact">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th colspan="3">Responses</th>
                                </tr>
                                <tr>
                                    <th>User</th>
                                    <th>Total</th>
                                    <th>Web</th>
                                    <th>Application</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php if(isset($data['user_submit_from']) && !empty($data['user_submit_from'])): ?> 
                                <?php $__currentLoopData = $data['user_submit_from']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_submit_key => $user_submit_val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                     <td>
                                        <?php if(!empty($user_submit_val->user_id)): ?>
                                            <?php
                                               $user_detail = get_user_detail(false, true, $user_submit_val->user_id);
                                            ?>
                                            <?php if(isset($user_detail['name'])): ?>
                                                <?php echo e($user_detail['name']); ?> (<?php echo e($user_detail['email']); ?>)
                                            <?php else: ?>
                                            <?php echo e($user_submit_val->user_id); ?>

                                            <?php endif; ?>
                                        <?php else: ?>
                                        unknown 
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($user_submit_val->total); ?></td>
                                    <td><?php echo e($user_submit_val->web); ?></td>
                                    <td><?php echo e($user_submit_val->application); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                        </table>
                                <?php else: ?>
                                 </tbody>
                        </table>
                                <?php echo aione_message('No Data Exist','error','center'); ?> </td>
                                
                                <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="ac s100 m100 l50">
                <div class="aione-widget bg-grey bg-lighten-5">
                    <div class="aione-title aione-border-top aione-border-right aione-border-left">
                        <h5 class="aione-align-center font-weight-400 m-0 pv-10 bg-grey bg-lighten-4">
                            Daywise Responses
                        </h5>
                    </div>
                    <div class="aione-table">
                        <table class="compact">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th colspan="3">Responses</th>
                                </tr>
                                <tr>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Web</th>
                                    <th>Application </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($data['date_submit_from']) && !empty($data['date_submit_from'])): ?> 
                                    <?php $__currentLoopData = $data['date_submit_from']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date_submit_key => $date_submit_val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($date_submit_val->date); ?></td>
                                        <td><?php echo e($date_submit_val->total); ?></td>
                                        <td><?php echo e($date_submit_val->web); ?></td>
                                        <td><?php echo e($date_submit_val->application); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                                <?php else: ?>
                                 </tbody>
                        </table>
                                <?php echo aione_message('No Data Exist','error','center'); ?> </td>
                                
                                <?php endif; ?>
                            
                    </div>
                </div>
            </div>
        </div>

   

    

    <script type="text/javascript">


        $(document).ready(function(){

        $('.collapsible').collapsible({

        accordion: false, // A setting that changes the collapsible behavior to expandable instead of the default accordion style
        onOpen: function(el) { 
        // alert('Open'); 
        }, // Callback for Collapsible open
        onClose: function(el) {
         // alert('Closed'); } // Callback for Collapsible close
        });


      });

    </script>
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>