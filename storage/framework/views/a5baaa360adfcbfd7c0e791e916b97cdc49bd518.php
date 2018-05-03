<?php if( !empty( @$post->title ) || !empty( @$post->description ) ): ?>
<div id="aione_pagetitle" class="aione-pagetitle">
	<div class="row-wrapper">
		<div class="ar">
			<?php if(@$design_settings['pagetitle_show_title'] == 1): ?>
				<?php if( !empty( @$post->title ) ): ?>
					<h4 class="aione-page-title pb-20 m-0 aione-align-center"><?php echo e(@$post->title); ?></h4>
				<?php endif; ?>
			<?php endif; ?>
			<?php if(@$design_settings['pagetitle_show_description'] == 1): ?>
				<?php if( !empty( @$post->description ) ): ?>
					<p class="aione-page-description font-size-16 aione-align-center"><?php echo e(@$post->description); ?></p>
				<?php endif; ?>
			<?php endif; ?>
		</div>
	</div><!-- .row-wrapper -->
</div><!-- #aione_header -->
<?php endif; ?>

