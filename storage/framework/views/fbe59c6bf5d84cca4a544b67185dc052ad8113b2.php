<?php $__env->startSection('content'); ?>
<?php 
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'no',
	'page_title' => 'Control Panel',
	'add_new' => ''
); 
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('admin.control-panel._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo FormGenerator::GenerateForm('control_panel_testing_form'); ?>

		<div class="aione-border console-div">
			<div class="bg-grey bg-lighten-3 p-7 gradient font-weight-600" style="position: relative;">
				Output:<span class="font-weight-400 font-size-13 ml-10 headRunTest">Running test <span>( <span class="runnigTestLink"></span> )</span></span>
				<div class="loader ">
					<img src="<?php echo e(asset('media/Gear.svg')); ?>" style="width: 20px">
				</div>
			</div>
			<div >
<pre class="sf-dump console-output" id="sf-dump-1054727430" data-indent-pad="  ">
</pre> 
			</div>
		</div>
		
		
	<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<style type="text/css">
            .console-div{
                display: none;
            }
			.select2-container--open .select2-dropdown--above, .select2-container--open .select2-dropdown--below{
				min-height: 200px;
			    max-height: 200px;
			    overflow: auto;
			}
			.console-box{
				min-height: 400px;
				max-height: 400px;
				overflow: auto;
				background-color: 
			}
			.gradient{
            				/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#deefff+0,b8ccdd+100 */
            background: #deefff; /* Old browsers */
            background: -moz-linear-gradient(top, #deefff 0%, #b8ccdd 100%); /* FF3.6-15 */
            background: -webkit-linear-gradient(top, #deefff 0%,#b8ccdd 100%); /* Chrome10-25,Safari5.1-6 */
            background: linear-gradient(to bottom, #deefff 0%,#b8ccdd 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#deefff', endColorstr='#b8ccdd',GradientType=0 ); /* IE6-9 */
            			}

            .loader {
              position: absolute;
              right: 5px;
              top: 5px;
              
            }

         

		</style>
		<style> pre.sf-dump { display: block; white-space: pre; padding: 5px; } pre.sf-dump:after { content: ""; visibility: hidden; display: block; height: 0; clear: both; } pre.sf-dump span { display: inline; } pre.sf-dump .sf-dump-compact { display: none; } pre.sf-dump abbr { text-decoration: none; border: none; cursor: help; } pre.sf-dump a { text-decoration: none; cursor: pointer; border: 0; outline: none; color: inherit; } pre.sf-dump .sf-dump-ellipsis { display: inline-block; overflow: visible; text-overflow: ellipsis; max-width: 5em; white-space: nowrap; overflow: hidden; vertical-align: top; } pre.sf-dump .sf-dump-ellipsis+.sf-dump-ellipsis { max-width: none; } pre.sf-dump code { display:inline; padding:0; background:none; } .sf-dump-str-collapse .sf-dump-str-collapse { display: none; } .sf-dump-str-expand .sf-dump-str-expand { display: none; } .sf-dump-public.sf-dump-highlight, .sf-dump-protected.sf-dump-highlight, .sf-dump-private.sf-dump-highlight, .sf-dump-str.sf-dump-highlight, .sf-dump-key.sf-dump-highlight { background: rgba(111, 172, 204, 0.3); border: 1px solid #7DA0B1; border-radius: 3px; } .sf-dump-public.sf-dump-highlight-active, .sf-dump-protected.sf-dump-highlight-active, .sf-dump-private.sf-dump-highlight-active, .sf-dump-str.sf-dump-highlight-active, .sf-dump-key.sf-dump-highlight-active { background: rgba(253, 175, 0, 0.4); border: 1px solid #ffa500; border-radius: 3px; } pre.sf-dump .sf-dump-search-hidden { display: none; } pre.sf-dump .sf-dump-search-wrapper { float: right; font-size: 0; white-space: nowrap; max-width: 100%; text-align: right; } pre.sf-dump .sf-dump-search-wrapper > * { vertical-align: top; box-sizing: border-box; height: 21px; font-weight: normal; border-radius: 0; background: #FFF; color: #757575; border: 1px solid #BBB; } pre.sf-dump .sf-dump-search-wrapper > input.sf-dump-search-input { padding: 3px; height: 21px; font-size: 12px; border-right: none; width: 140px; border-top-left-radius: 3px; border-bottom-left-radius: 3px; color: #000; } pre.sf-dump .sf-dump-search-wrapper > .sf-dump-search-input-next, pre.sf-dump .sf-dump-search-wrapper > .sf-dump-search-input-previous { background: #F2F2F2; outline: none; border-left: none; font-size: 0; line-height: 0; } pre.sf-dump .sf-dump-search-wrapper > .sf-dump-search-input-next { border-top-right-radius: 3px; border-bottom-right-radius: 3px; } pre.sf-dump .sf-dump-search-wrapper > .sf-dump-search-input-next > svg, pre.sf-dump .sf-dump-search-wrapper > .sf-dump-search-input-previous > svg { pointer-events: none; width: 12px; height: 12px; } pre.sf-dump .sf-dump-search-wrapper > .sf-dump-search-count { display: inline-block; padding: 0 5px; margin: 0; border-left: none; line-height: 21px; font-size: 12px; }pre.sf-dump, pre.sf-dump .sf-dump-default{background-color:#18171B; color:#FF8400; line-height:1.2em; font:12px Menlo, Monaco, Consolas, monospace; word-wrap: break-word; white-space: pre-wrap; position:relative; z-index:0; word-break: break-all}pre.sf-dump .sf-dump-num{font-weight:bold; color:#1299DA}pre.sf-dump .sf-dump-const{font-weight:bold}pre.sf-dump .sf-dump-str{font-weight:bold; color:#56DB3A}pre.sf-dump .sf-dump-note{color:#1299DA}pre.sf-dump .sf-dump-ref{color:#A0A0A0}pre.sf-dump .sf-dump-public{color:#FFFFFF}pre.sf-dump .sf-dump-protected{color:#FFFFFF}pre.sf-dump .sf-dump-private{color:#FFFFFF}pre.sf-dump .sf-dump-meta{color:#B729D9}pre.sf-dump .sf-dump-key{color:#56DB3A}pre.sf-dump .sf-dump-index{color:#1299DA}pre.sf-dump .sf-dump-ellipsis{color:#FF8400}</style>	
	<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script type="text/javascript">
    $(document).ready(function(){
        
        var runnigHTML = '<span class="run">\n<span class="sf-dump-str line-height-18 runningClass" title="7 characters">Running:</span>   <span class="runnigLink"></span><span>';
        var doneHTML = '\n<span class="sf-dump-str line-height-18" title="7 characters">Done:</span>     <span class="green doneLink"></span> [<span class="green ">OK</span>] <span><i class="fa fa-check green"></i> 200 </span> ';
        var errorHTML = '\n<span class="sf-dump-str line-height-18" style="color: red " title="7 characters">Error:</span>    <span class="red errorLink"></span>  [<span class="red">ERROR</span>] <span class="red"><i class="fa fa-close red"></i> 500 </span>';
        $('.aione-button').click(function(){
            $('.console-div').show();
            $('.loader').show();
            $('.headRunTest').show();
            $('.console-output').html('');
            var selectedRows = $('select').val();
            if(selectedRows.length != 0){
                runAjax(selectedRows,0);
            }
            function runAjax(selectedRows,i){
                if(selectedRows[i] != undefined){
                    $('.console-output').append(runnigHTML);
                    $('.runnigLink').html('http://master.scolm.com/'+selectedRows[i]+'  ....');
                    $('.runnigTestLink').html('http://master.scolm.com/'+selectedRows[i]);
                    $.ajax({
                       type:'POST',
                       url: route()+'/route/test',
                       data: {route:selectedRows[i],'_token':'<?php echo e(csrf_token()); ?>'},
                       success: function(result){
                            $('.run').remove();
                            if(result.status == 200 || result.status == 302){
                                $('.console-output').append(doneHTML);
                                $('.doneLink:last').html('http://master.scolm.com/'+selectedRows[i]);
                            }
                            if(result.status == 500){
                                $('.console-output').append(errorHTML);
                                $('.errorLink:last').html('http://master.scolm.com/'+selectedRows[i]);
                            }
                            i++;
                            runAjax(selectedRows,i);
                       }
                    });
                }else{
                    $('.loader').hide();
                    $('.headRunTest').hide();
                }
            } 
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>