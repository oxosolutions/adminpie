<?php $__env->startSection('content'); ?>
	<style type="text/css">
		.select2 ul{
			height: 38px !important;
		}
		.select2 input{
			padding:0px !important;
			height: 32px !important;
		}
	</style>
	<?php echo Form::open(['method' => 'POST','class' => '','route' => 'user.store']); ?>

		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">Basic layout<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
				<div class="heading-elements">
					<ul class="icons-list">
                		<li><a data-action="collapse"></a></li>
                		<li><a data-action="reload"></a></li>
                		<li><a data-action="close"></a></li>
                	</ul>
            	</div>
			</div>

			<div class="panel-body">
				

				

				<div class="form-group">
					<label>Your state:</label>
					<?php echo Form::select('userType',App\Model\Organization\UsersType::userTypes(), null, ['class'=>'select2','style'=>'display:block;','multiple'=>'multiple']); ?>

				</div>

				<div class="form-group">
					<label>Name:</label>
					<input type="text" class="form-control" placeholder="Eugene Kopyov">
				</div>

				<div class="form-group">
					<label>Email:</label>
				
   					 <?php echo Form::text('email', null, array('required','class'=>'form-control','placeholder'=>'Your e-mail address')); ?>

				</div>

				<div class="form-group">
					<label class="display-block">Gender:</label>

					<label class="radio-inline">
						<div class="choice"><span class="checked"><input type="radio" class="styled" name="gender" checked="checked"></span></div>
						Male
					</label>

					<label class="radio-inline">
						<div class="choice"><span><input type="radio" class="styled" name="gender"></span></div>
						Female
					</label>
				</div>

				<div class="form-group">
					<label>Your avatar:</label>
					<div class="uploader"><input type="file" class="file-styled"><span class="filename" style="-webkit-user-select: none;">No file selected</span><span class="action btn bg-pink-400" style="-webkit-user-select: none;">Choose File</span></div>
					<span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
				</div>

				<div class="form-group">
					<label>Tags:</label>
					<select multiple="" data-placeholder="Enter tags" class="select-icons select2-hidden-accessible" tabindex="-1" aria-hidden="true">
						<optgroup label="Services">
							<option value="wordpress2" data-icon="wordpress2">Wordpress</option>
							<option value="tumblr2" data-icon="tumblr2">Tumblr</option>
							<option value="stumbleupon" data-icon="stumbleupon">Stumble upon</option>
							<option value="pinterest2" data-icon="pinterest2">Pinterest</option>
							<option value="lastfm2" data-icon="lastfm2">Lastfm</option>
						</optgroup>
						<optgroup label="File types">
							<option value="pdf" data-icon="file-pdf">PDF</option>
							<option value="word" data-icon="file-word">Word</option>
							<option value="excel" data-icon="file-excel">Excel</option>
							<option value="openoffice" data-icon="file-openoffice">Open office</option>
						</optgroup>
						<optgroup label="Browsers">
							<option value="chrome" data-icon="chrome" selected="selected">Chrome</option>
							<option value="firefox" data-icon="firefox" selected="selected">Firefox</option>
							<option value="safari" data-icon="safari">Safari</option>
							<option value="opera" data-icon="opera">Opera</option>
							<option value="IE" data-icon="IE">IE</option>
						</optgroup>
					</select><span class="select2 select2-container select2-container--default select2-container--above" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1"><ul class="select2-selection__rendered"><li class="select2-selection__choice" title="Excel"><span class="select2-selection__choice__remove" role="presentation">×</span><i class="icon-file-excel"></i>Excel</li><li class="select2-selection__choice" title="Open office"><span class="select2-selection__choice__remove" role="presentation">×</span><i class="icon-file-openoffice"></i>Open office</li><li class="select2-selection__choice" title="Chrome"><span class="select2-selection__choice__remove" role="presentation">×</span><i class="icon-chrome"></i>Chrome</li><li class="select2-selection__choice" title="Firefox"><span class="select2-selection__choice__remove" role="presentation">×</span><i class="icon-firefox"></i>Firefox</li><li class="select2-selection__choice" title="Safari"><span class="select2-selection__choice__remove" role="presentation">×</span><i class="icon-safari"></i>Safari</li><li class="select2-selection__choice" title="Opera"><span class="select2-selection__choice__remove" role="presentation">×</span><i class="icon-opera"></i>Opera</li><li class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" role="textbox" aria-autocomplete="list" placeholder="" style="width: 0.75em;"></li></ul></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
				</div>

				<div class="form-group">
					<label>Your message:</label>
					<textarea rows="5" cols="5" class="form-control" placeholder="Enter your message here"></textarea>
				</div>

				<div class="text-right">
					<button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
				</div>
			</div>
		</div>
	<?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>