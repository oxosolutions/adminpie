	<?php if(Auth::guard('admin')->check() == true): ?>
	<?php
		$layout = 'admin.layouts.main';
	?>
<?php else: ?>
	<?php
		$layout = 'layouts.main';
	?>
<?php endif; ?>


<?php $__env->startSection('content'); ?>

	<?php
		$page_title_data = array(
			'show_page_title' => 'yes',
			'show_add_new_button' => 'no',
			'show_navigation' => 'yes',
			'page_title' => 'Map View <span>'.get_map_title(request()->route()->parameters()['id']).'</span>',
			'add_new' => '+ Add Custom Map'
		);
	?>
	<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
	<style type="text/css">
/***************************************
VISUALIZATION THEMES
***************************************/

/***************************************
CUSTOM MAP THEME LIGHT
***************************************/
.map-theme-light{

}
.map-theme-light .land{
fill: #cdcac5;
stroke: #ffffff;
stroke-width: 0.3;
}
.map-theme-light .land:hover{
fill: #b9b6b2;
}
.map-theme-light .active{
fill:#666666;
} 
.map-theme-light .active:hover{
fill:#454545;
}
/***************************************
CUSTOM MAP THEME DARK
***************************************/

.map-theme-dark{

}
.map-theme-dark .land{
    fill: #454545;
    stroke: #282828; 
    stroke-width: 0.3;
}
.map-theme-dark .land:hover{
    fill: #666666;
    stroke: #222222;
}
.map-theme-dark .active{
fill:#FFB300;
} 
.map-theme-dark .active:hover{
fill:#ff9800;
}  

/***************************************
CUSTOM MAP THEME GREEN
***************************************/
.map-theme-green{

}
.map-theme-green .land{
fill: #cdcac5;
stroke: #ffffff;
stroke-width: 0.3;
}
.map-theme-green .land:hover{
fill: #b9b6b2;
}
.map-theme-green .active{
fill:#6db77c;
} 
.map-theme-green .active:hover{
fill:#5ca56a;
} 



/***************************************
CUSTOM MAP THEME RED
***************************************/
.map-theme-red{

}
.map-theme-red .land{
fill: #cdcac5;
stroke: #ffffff;
stroke-width: 0.3;
}
.map-theme-red .land:hover{
fill: #b9b6b2;
}
.map-theme-red .active{
fill:#e53935;
} 
.map-theme-red .active:hover{
fill:#ca2c28;
} 

/***************************************
CUSTOM MAP THEME ORANGE
***************************************/
.map-theme-orange{

}
.map-theme-orange .land{
fill: #cdcac5;
stroke: #ffffff;
stroke-width: 0.3;
}
.map-theme-orange .land:hover{
fill: #b9b6b2;
}
.map-theme-orange .active{
fill:#ffa726;
} 
.map-theme-orange .active:hover{
fill:#ff9800;
}


/***************************************
CUSTOM MAP THEME BROWN
***************************************/
.map-theme-brown{

}
.map-theme-brown .land{
fill: #cdcac5;
stroke: #ffffff;
stroke-width: 0.3;
}
.map-theme-brown .land:hover{
fill: #b9b6b2;
}
.map-theme-brown .active{
fill:#8d6e63;
} 
.map-theme-brown .active:hover{
fill:#795548;
}


/***************************************
CUSTOM MAP THEME BLUE
***************************************/
.map-theme-blue{

}
.map-theme-blue .land{
fill: #f2f2f2;
stroke: #282828;
stroke-width: 0.3;
}
.map-theme-blue .land:hover{
fill: #d2d2d2;
}
.map-theme-blue .active{
fill:#03a9f4;
} 
.map-theme-blue .active:hover{
fill:#0288d1;
}
	</style>
	<?php
		$mapkeys = [];
		$map_keys = $model->map_keys; 
		if($map_keys != null || $map_keys != ''){
			foreach(json_decode($map_keys , true) as $k => $v){
				foreach($v as $key => $value){
					$mapkeys[] = $value;
				}
			}
		}else{

		}
		$newData = json_encode($mapkeys);
	?>
	<script type="text/javascript">
		$(document).ready(function(){
			var map_keys = '<?php echo $newData; ?>';
			var mapkeys = {};
			if(map_keys.length === 0){
				var arrayData = jQuery.parseJSON(map_keys);
				$.each(arrayData , function(k, v){
					mapkeys[v] =  $('#'+v).attr('title');
				});
			}else{
				$('.map_area path').each(function(value){
					var keys = $(this).attr('id');
					var value = $(this).attr('title');
					mapkeys[keys] = value;
				});
			}
			if(mapkeys != ''){
				$.each(mapkeys , function(k , v){
					$('.mapData').append('<tr><td>'+k+'</td><td>'+v+'</td></tr>');
				});
				$('input[name=mapkeys]').val(mapkeys);
			}

			$(document).on('click','.exportExcel',function(){
				var dataArray = [];
				
				
				$.each(mapkeys, function(key,value){
					var objectArray = {};
					objectArray['Code'] = key;
					objectArray['Name'] = value;
					dataArray.push(objectArray);
				});
				JSONToCSVConvertor(dataArray, "Country Report", true);
				

				function JSONToCSVConvertor(JSONData, ReportTitle, ShowLabel) {
				    //If JSONData is not an object then JSON.parse will parse the JSON string in an Object
				    var arrData = typeof JSONData != 'object' ? JSON.parse(JSONData) : JSONData;
				    
				    var CSV = '';    
				    //Set Report title in first row or line
				    
				    CSV += ReportTitle + '\r\n\n';

				    //This condition will generate the Label/Header
				    if (ShowLabel) {
				        var row = "";
				        
				        //This loop will extract the label from 1st index of on array
				        for (var index in arrData[0]) {
				            
				            //Now convert each value to string and comma-seprated
				            row += index + ',';
				        }

				        row = row.slice(0, -1);
				        
				        //append Label row with line break
				        CSV += row + '\r\n';
				    }
				    
				    //1st loop is to extract each row
				    for (var i = 0; i < arrData.length; i++) {
				        var row = "";
				        
				        //2nd loop will extract each column and convert it in string comma-seprated
				        for (var index in arrData[i]) {
				            row += '"' + arrData[i][index] + '",';
				        }

				        row.slice(0, row.length - 1);
				        
				        //add a line break after each row
				        CSV += row + '\r\n';
				    }

				    if (CSV == '') {        
				        alert("Invalid data");
				        return;
				    }   
				    
				    //Generate a file name
				    var fileName = "";
				    //this will remove the blank-spaces from the title and replace it with an underscore
				    fileName += ReportTitle.replace(/ /g,"_");   
				    
				    //Initialize file format you want csv or xls
				    var uri = 'data:text/csv;charset=utf-8,' + escape(CSV);
				    
				    // Now the little tricky part.
				    // you can use either>> window.open(uri);
				    // but this will not work in some browsers
				    // or you will not get the correct file extension    
				    
				    //this trick will generate a temp <a /> tag
				    var link = document.createElement("a");    
				    link.href = uri;
				    
				    //set the visibility hidden so it will not effect on your web-layout
				    link.style = "visibility:hidden";
				    link.download = fileName + ".csv";
				    
				    //this part will append the anchor tag and remove it after automatic click
				    document.body.appendChild(link);
				    link.click();
				    document.body.removeChild(link);
				}
			});
		});
	</script>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<div class="ar map-view">
		<div class="ac l70 m70 s100">
			<div class="aione-border">
				<div id="aione_map" class="map-theme-green">
					<?php echo $model->map_data; ?>

				</div>
			</div>
		</div>
		<div class="ac l30 m30 s100">
			
			<div class="aione-table mb-20">
				<table class="compact">
					<thead >
						<tr><th colspan="2">Information</th></tr>
					</thead>
					<tbody>
						<tr >
							<td >Title</td>
							<td ><?php echo e($model->title); ?></td>
						</tr>
						<tr >
							<td >Map ID</td>
							<td class="table_code"><?php echo e($model->table_code); ?></td>
						</tr>
						<tr >
							<td >Description</td>
							<td ><?php echo e($model->description); ?></td>
						</tr>
					</tbody>
				</table>
			</div>


			<div class="mb-20 aione-border">
				<div class="bold p-10 aione-border-bottom">
					Select Theme
				</div>
				<div class="p-10">
					<select id="map_theme" name="theme" class="browser-default">
						<option value="map-theme-light">Light</option>
						<option value="map-theme-dark">Dark</option>
						<option value="map-theme-green" selected="selected">Green</option>
						<option value="map-theme-red">Red</option>
						<option value="map-theme-orange">Orange</option>
						<option value="map-theme-brown">Brown</option>
						<option value="map-theme-blue">Blue</option>
					</select>
				</div>
			</div>

			<div class="mb-20 aione-border">
				<div class="bold p-10 aione-border-bottom">
					Selected Pap Area
				</div>
				<div class="p-10">
					<p class="bold pv-6">Area Title</p>
					<p class="area_title pv-6 aione-border-bottom">Click on Map Area to Select</p>
					<p class="bold pv-6">Tooltip</p>
					<p class="field">
					<input id="map_area_id" type="hidden" name="map_area_id">
					<input id="map_area_tooltip" placeholder="Tooltip Text" type="text" name="map_area_tooltip">
					</p>

				</div>
			</div>

			<div class="aione-accordion mb-20">
				<div class="aione-item">
					<div class="aione-item-header aione-border-bottom">Map Link</div>
					<div class="aione-item-content aione-table p-10">
						<textarea id="embed_url" name="link" rows="6"> </textarea>
					</div>
				</div>
			</div>
			<div class="aione-accordion mb-20">
				<div class="aione-item">
					<div class="aione-item-header aione-border-bottom">Embed Code</div>
					<div class="aione-item-content aione-table p-10">
						<textarea id="embed_code" name="embed_code" rows="6"> </textarea>
					</div>
				</div>
			</div>
		
			<div class="aione-accordion mb-20">
				<div class="aione-item">
					<div class="aione-item-header aione-border-bottom">Map Structure</div>
					<div class="aione-item-content aione-table p-10">
						<table class="compact">
							<thead>
								<tr>
									<th>Map Area Key</th>
									<th>Map Area Title</th>
								</tr>
							</thead>
							<tbody class="mapData"></tbody>
						</table>
						
						<div class="aione-border-bottom pv-10 aione-align-center">
							<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
							<button class="exportExcel">Export to CSV</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<script type="text/javascript">

	$(document).ready(function(){
		$(document).on('change','#map_theme',function(){
			var selected_theme = $(this).val();
			$("#aione_map").attr("class", selected_theme);
			processURL();
		});
		var selected_area = {}

		$(document).on('click','#aione_map .land',function(){
			$(this).toggleClass("active");

			var selected_area_title = $(this).attr('title');
			$('.area_title').html(selected_area_title);

			var selected_area_id = $(this).attr('id');
			$('#map_area_id').val(selected_area_id);

			var selected_area_value = selected_area[selected_area_id]
			$('#map_area_tooltip').val(selected_area_value);

			processURL();
		});
		function processURL(){
			var map_code = $('.table_code').html();
			var selected_theme = $("#map_theme").val();
			url = route()+'/public/custom-maps/'+map_code.trim()+'/'+selected_theme+'/';
			var processedArray = [];
			var selected_area_id = $('#map_area_id').val();
			var selected_area_value = $('#map_area_tooltip').val();
			selected_area[selected_area_id] = selected_area_value;
			$.each(selected_area , function(k , v){
				if(k != undefined && k != ''){
					if($('#'+k).hasClass('active')){
						processedArray.push(k + '=' + v);
					}
				}
			});
			var url_parameters = processedArray.join('+')
			$('#embed_url').val('');
			$('#embed_url').val(url+url_parameters);
			$('#embed_code').val('');
			$('#embed_code').val('<iframe width="100%" height="400" frameborder="0" src="'+url+url_parameters+'"></iframe>');
		}
	
		$(document).on('focusout','#map_area_tooltip',function(){
			processURL();
		});
	})
	</script>
<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>