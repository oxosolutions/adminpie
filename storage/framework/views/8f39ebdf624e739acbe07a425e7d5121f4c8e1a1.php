<?php $__env->startSection('content'); ?>
<?php 
$page_title_data = array(
  'show_page_title' => 'yes',
  'show_add_new_button' => 'no',
  'show_navigation' => 'yes',
  'page_title' => 'Collaborate <span>' .get_visualization_title(request()->route()->parameters()['id']). '</span>',
  'add_new' => ''
); 
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('organization.visualization._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    	
        <div class="share-wrapper">
      <div class="share-link">
        <div class="title">
          Share Link
        </div>
        <div class="body-wrapper">
          <div class="link-field">
            <?php echo FormGenerator::GenerateField('shareable_link',['default_value'=>route('public.view.visualization',$model->embed_token)]); ?>

          </div>
          <div class="copy-button">
            <button id="copy_button" onclick="copyToClipboard('#input_shareable_link')"> Copy link</button>
          </div>
        </div>
        <div class="clear"></div>
      </div>
    <div class="share-user">
      
      <div class="title">
        How would you like to Collaborate this Visualization
      </div>
      
      <div class="body-wrapper">
        <div class="ar share_status" style="margin-bottom: 20px">
          <div class="ac l33">
              <input type="radio" id="only_me" name="group1" <?php echo e((@$share_type_value == 'only_me')?'checked="checked"':''); ?>>
              <label for="only_me">Private</label>
            </div>
            <div class="ac l33">
              <input type="radio" id="public" name="group1" <?php echo e((@$share_type_value == 'public')?'checked="checked"':''); ?>>
              <label for="public">Public</label>
            </div>
            <div class="ac l33">
              <input type="radio" id="specific" name="group1" <?php echo e((@$share_type_value == 'specific')?'checked="checked"':''); ?>>
              <label for="specific">Specific</label>
            </div>
            <input type="hidden" name="visualization_id" value="<?php echo e(request()->route()->parameters()['id']); ?>">
          
        </div>
        
        <div class="specific_user_field">
			<div class="user-field">
				<?php echo FormGenerator::GenerateField('email_user_share'); ?>

				
			</div>
			<div class="share-button">
				<div><?php echo FormGenerator::GenerateField('user-share-edit-view',['default_value'=>['read_write'=>'Can Read/Write','read_only'=>'Can Read Only']]); ?></div>
				<div><button>Add User</button></div>
			</div>
		</div>
		<div class="clear"></div>
      </div>
      
      <div class="list-users">
        <table class="striped">
              <thead>
            <tr>
              <th>Email</th>
              <th>Rights</th>
              <th>Remove</th>
            </tr>
              </thead>

              <tbody>
            
              <tr>
                <td>asdjkas</td>
                <td>sjkehs</td>
                <td><a href="" style="color: #757575"><i class="material-icons dp48">clear</i></a></td>
              </tr>
            
              </tbody>
          </table>
      </div>
    </div>
  </div>
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<style type="text/css">
    .share-wrapper{
      margin-top: 30px
    }
    .share-wrapper button{
      padding: 8px 12px;
    }
    .share-wrapper .share-link,
    .share-wrapper .share-user{
      border:1px solid #e8e8e8;
      padding:15px;
      position: relative;
      margin-bottom: 30px;
    }
    .share-wrapper .share-link .title,
    .share-wrapper .share-user .title{
      background-color: #e8e8e8;
      display: inline-block;
      padding:10px;
      position: absolute;
      top: -17px
    }
    .share-wrapper .share-link .body-wrapper,
    .share-wrapper .share-user .body-wrapper{
      padding: 20px 0px
    }
    .share-wrapper .share-link .body-wrapper .link-field,
    .share-wrapper .share-user .body-wrapper .user-field,
    .share-wrapper .share-link .body-wrapper .copy-button,
    .share-wrapper .share-user .body-wrapper .share-button,
    .share-wrapper .share-user .body-wrapper .share-button >div{
      float: left;
    }
    .share-wrapper .share-link .body-wrapper .link-field,
    .share-wrapper .share-user .body-wrapper .user-field{
      width: 75%;

    }
    .share-wrapper .share-link .body-wrapper .copy-button,
    .share-wrapper .share-user .body-wrapper .share-button{
      width: 25%;
    }
    .share-wrapper .share-user .body-wrapper .share-button >div{
      margin-left: 10px;
      width: 45%
    }
    .share-wrapper .share-user .list-users table thead{
      background-color: #454545;
      color: white
    }
 
  </style>
  <script type="text/javascript">
    $(document).ready(function(){
      // $('.specific_user_field , .list-users').hide();
      //  if($('.share_status').find('#specific').attr('checked')){
      //    $('.specific_user_field , .list-users').show();
      //  }
      $('body').on('change','.share_status input[type= radio]',function(){
        // var share_status = $(this).attr('id');
        // var survey_id = $('input[name=survey_id]').val();

          if(share_status == 'specific'){
            $('.specific_user_field , .list-users').show();
          }else{
            $('.specific_user_field , .list-users').hide();
          }

          // $.ajax({
          //  url : route()+'/change/survey/status',
          //  type: 'get',
          //  data : {share_status : share_status , survey_id : survey_id },
          //  success : function(res){
          //    if(res == "Success"){
          //      Materialize.toast('Saved',4000);
          //    }else{
          //      Materialize.toast('Something went wrong',4000);
          //    }
          //  }
          // });
      });
    });
  </script>
   
    <?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script type="text/javascript">
  document.getElementById("copy_button").addEventListener("click", function() {
      copyToClipboard(document.getElementById("input_shareable_link"));
      Materialize.toast('Copied!',2000);
  });
  function copyToClipboard(elem) {
    var targetId = "_hiddenCopyText_";
      var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
      var origSelectionStart, origSelectionEnd;
      if (isInput) {
          // can just use the original source element for the selection and copy
          target = elem;
          origSelectionStart = elem.selectionStart;
          origSelectionEnd = elem.selectionEnd;
      } else {
          // must use a temporary form element for the selection and copy
          target = document.getElementById(targetId);
          if (!target) {
              var target = document.createElement("textarea");
              target.style.position = "absolute";
              target.style.left = "-9999px";
              target.style.top = "0";
              target.id = targetId;
              document.body.appendChild(target);
          }
          target.textContent = elem.textContent;
      }
      // select the content
      var currentFocus = document.activeElement;
      target.focus();
      target.setSelectionRange(0, target.value.length);
      
      // copy the selection
      var succeed;
      try {
          succeed = document.execCommand("copy");
      } catch(e) {
          succeed = false;
      }
      // restore original focus
      if (currentFocus && typeof currentFocus.focus === "function") {
          currentFocus.focus();
      }
      
      if (isInput) {
          // restore prior selection
          elem.setSelectionRange(origSelectionStart, origSelectionEnd);
      } else {
          // clear temporary content
          target.textContent = "";
      }
      return succeed;
  }
  $(document).ready(function(){
    
    $('.specific_user_field , .list-users').hide();
      if($('.share_status').find('#specific').attr('checked')){
        $('.specific_user_field , .list-users').show();
      }
    $('body').on('change','.share_status input[type= radio]',function(){

    	console.log('Working');
      	var share_status = $(this).attr('id');
      	var survey_id = $('input[name=survey_id]').val();

        if(share_status == 'specific'){
          $('.specific_user_field , .list-users').show();
        }else{
          $('.specific_user_field , .list-users').hide();
        }

        /*$.ajax({
          url : route()+'/change/survey/status',
          type: 'get',
          data : {share_status : share_status , survey_id : survey_id },
          success : function(res){
            console.log(res);
            if(res.trim() == "Success"){
              Materialize.toast('Saved',4000);
            }else{
              Materialize.toast('Something went wrong',4000);
            }
          }
        });*/
    });
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>