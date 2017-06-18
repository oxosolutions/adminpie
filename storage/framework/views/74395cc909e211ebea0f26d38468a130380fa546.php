<?php $__env->startSection('content'); ?>
<div>
    <?php echo $__env->make('organization.project._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="col l12">
    	<div class="fade-background">
	</div>
	<div id="projects" class="projects list-view">
	    <div class="row">
			<div class="col s12 m9 l9 pr-7" >
				<div class="row no-margin-bottom">
					<div class="col s12 m12 l6  pr-7 tab-mt-10" >
						<!-- <input class="search aione-field" placeholder="Search" /> -->
						<nav>
						    <div class="nav-wrapper">
						      	<form>
							        <div class="input-field">
							          	<input id="search" type="search" required style="background-color: #ffffff">
							          	<label class="label-icon" for="search" style=""><i class="material-icons icon-search" >search</i></label>
							          	<i class="material-icons icon-close">close</i>
							        </div>
						      	</form>
						    </div>
						</nav>
					</div>
					<div class="col s6 m6 l3  aione-field-wrapper pl-7 tab-mt-10">
						<div class="row aione-sort" style="">
							<select class="col  browser-default aione-field" >
								<option value="" disabled selected>Sort By</option>
								<option value="1">Name</option>
								<option value="2">Date</option>
							</select>
							<div class="col alpha-sort" style="width: 25%;padding-left:7px;">
								<a href="javascript:;" class="sort" ><i class="fa fa-sort-alpha-asc arrow_sort white" ></i></a>
							</div>
						</div>
					</div>

					<div class="col s6 m6 l3 pl-7 right-float tab-mt-10 tab-pl-10">
						<div class="row aione-switch-view">
							<ul class="right  views m-0" >
								<li class="inline-block" sty><a href="#list-view" class=" view" data-view="list-view"><i class="material-icons" >view_list</i></a></li>
								
								

								<li class="inline-block" ><a href="#detail-view" class=" view" data-view="detail-view"><i class="material-icons" >view_stream</i></a></li>


								<li class="inline-block" ><a href="#grid-view" class=" view" data-view="grid-view"><i class="material-icons" >view_module</i></a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="list" id="notes">
					
				</div>
			</div>

			<div class="col s12 m3 l3 pl-7" >
				<a id="add_new" href="#" class="btn add-new display-form-button" >
					Add Note
				</a>
				<div id="add_new_wrapper" class="add-new-wrapper add-form " style="background-color: #ffc;">
					<div class="row no-margin-bottom" id="notes">	  
				    	<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
				        <input type="text" name="title" placeholder="Title ">
				        <textarea id="textarea1" class="materialize-textarea" style="border: 1px solid rgb(161, 161, 161);"></textarea>
						<div class="col s12 m6 l12 aione-field-wrapper">
							<button class="btn waves-effect blue save-note" type="submit">Save Note
								<i class="material-icons right">save</i>
							</button>
						</div>
					</div>
				</div>
				<div class="card-panel shadow mt-22" >
					clients
				</div>
			</div>
		</div>
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
<style type="text/css">
	.materialize-textarea:focus{
		border-bottom: 1px solid #a1a1a1 !important;
	}
	 #notes ul,li{
	  list-style:none;
	}
	 #notes  ul{
	  overflow:hidden;
	 
	}
	 #notes  ul li a{
	  text-decoration:none;
	  color:#000;
	  background:#ffc;
	  display:block;
	  height:10em;
	  width:15.97em;
	  padding:1em;
	  -moz-box-shadow:5px 5px 7px rgba(33,33,33,1);
	  -webkit-box-shadow: 5px 5px 7px rgba(33,33,33,.7);
	  box-shadow: 5px 5px 7px rgba(33,33,33,.7);
	  -moz-transition:-moz-transform .15s linear;
	  -o-transition:-o-transform .15s linear;
	  -webkit-transition:-webkit-transform .15s linear;
	}
	 #notes  ul li{
	  margin:10px;
	  float:left;
	}
	 #notes  ul li h2{
	  font-size:140%;
	  font-weight:bold;
	  padding-bottom:10px;
	}
	h2{
		margin: 0px !important
	}
/*	 #notes  ul li p{
	  font-family:"Reenie Beanie",arial,sans-serif;
	  font-size:180%;
	}
	 #notes  ul li a{
	  -webkit-transform: rotate(-6deg);
	  -o-transform: rotate(-6deg);
	  -moz-transform:rotate(-6deg);
	}
	 #notes  ul li:nth-child(even) a{
	  -o-transform:rotate(4deg);
	  -webkit-transform:rotate(4deg);
	  -moz-transform:rotate(4deg);
	  position:relative;
	  top:5px;
	  background:#cfc;
	}
	 #notes  ul li:nth-child(3n) a{
	  -o-transform:rotate(-3deg);
	  -webkit-transform:rotate(-3deg);
	  -moz-transform:rotate(-3deg);
	  position:relative;
	  top:-5px;
	  background:#ccf;
	}
	 #notes  ul li:nth-child(5n) a{
	  -o-transform:rotate(5deg);
	  -webkit-transform:rotate(5deg);
	  -moz-transform:rotate(5deg);
	  position:relative;
	  top:-10px;
	}
	 #notes  ul li a:hover,ul li a:focus{
	  box-shadow:10px 10px 7px rgba(0,0,0,.7);
	  -moz-box-shadow:10px 10px 7px rgba(0,0,0,.7);
	  -webkit-box-shadow: 10px 10px 7px rgba(0,0,0,.7);
	  -webkit-transform: scale(1.25);
	  -moz-transform: scale(1.25);
	  -o-transform: scale(1.25);
	  position:relative;
	  z-index:5;
	}
	 #notes  ol{text-align:center;}
	 #notes  ol li{display:inline;padding-right:1em;}
	 #notes  ol li a{color:#fff;}*/
</style>

<?php $__env->stopSection(); ?>	
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>