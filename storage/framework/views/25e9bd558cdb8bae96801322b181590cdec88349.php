
<?php $__env->startSection('content'); ?>

<div class="fade-background">
</div>
<div id="projects" class="projects list-view">
	<div class="row">
		<div class="col s12 m9 l12 pr-7" >
			
			<div class="list" id="list">
 				<div class="col s12 m9 l12 pr-7" style="margin-top: 14px">
			
					<?php echo $__env->make('common.list.datalist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

				</div>
			</div>
		</div>

		<div class="col s12 m3 l3 pl-7" >
			<a href="#modal1" class="btn " >
				Add Client
			</a>
			<?php echo Form::open(['route'=>'save.client' , 'class'=> 'form-horizontal','method' => 'post']); ?>

				<?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'modal1','heading'=>'Add client','button_title'=>'Save Client','section'=>'clisec1']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php echo Form::close(); ?>

		</div>
	</div>
</div>

<script type="text/javascript">
		$('.add-new').off().click(function(e){
			e.preventDefault();
			$('.add-new-wrapper').toggleClass('active');
			$('.fade-background').fadeToggle(300);
		});
		
		$('.fade-background').click(function(){
			$('.fade-background').fadeToggle(300);
			$('.add-new-wrapper').toggleClass('active');
		});

</script>
	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>