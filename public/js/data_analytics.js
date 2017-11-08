$(document).ready(function(){
	google.charts.load('current');   // Don't need to specify chart libraries!
		google.charts.setOnLoadCallback(drawVisualization);
		var wrapper;
    var pieChartWrapper;
    function drawVisualization(){
    	getHeaderColumns();
    	setURLS();
    	wrapper = new google.visualization.ChartWrapper({
	        chartType: 'LineChart',
			dataSourceUrl:url,
            'query':defaultQuery,
	        options: {},
	        containerId: 'column_chart', 
        });
        console.log(url);
        var chartAnimation = { 
			startup:true, //true/false
			duration:250, //  in milliseconds 
			easing:'inAndOut' // linear/in/out/inAndOut
		};
		var chartArea = {
            left: "10%",
            top: "10%",
            bottom: "25%",
            height: "100%",
            width: "100%"
		};
		var colors = ["#ed6f1d","#168dc5"];
		wrapper.setOption('animation', chartAnimation);
		wrapper.setOption('legend', 'top');
		wrapper.setOption('pointSize', '8');
		wrapper.setOption('width', '100%');
		wrapper.setOption('height', '100%');
		wrapper.setOption('chartArea', chartArea);
		wrapper.setOption('bar', { groupWidth: "80%" } );
		wrapper.setOption('tooltip', { isHtml: true} );
		wrapper.draw();
        window.selectedButton = 'bygender';
		generateDropDown('bygender');
		generateFilters(urlObject['bygender_url'],'B',2);
    }
    $('#usable_title').html($('.selectQuery').find(':selected').text());
    $('.selectQuery').change(function(){
        $('#usable_title').html($(this).find(':selected').text());
        var query = $(this).val();
        wrapper.setQuery('SELECT '+query);
        wrapper.draw();
    });
    function getHeaderColumns(){
    	window.headerData = {};
    	var bygender = {};
    	// bygender['D'] = 'Usable Observations';
    	bygender['E'] = 'Observations of Male Children|G';
    	bygender['F'] = 'Observations of Female Children|H';
    	bygender['I'] = 'Observations where Male Children were Immunized|K';
    	bygender['J'] = 'Observations where Female Children were Immunized|L';
    	bygender['M'] = 'Observations where Male Children were not Immunized|O';
    	bygender['N'] = 'Observations where Female Children were not Immunized|P';

    	var uipschedule = {};
    	// uipschedule['D'] = 'Usable Observations';
    	uipschedule['E'] = 'Observations where child is Immunized at Optimal time|G';
    	uipschedule['F'] = 'Observations where child is Not Immunized at Optimal time|H';

    	var everEmun = {};
    	// everEmun['D'] = 'Analyzable Sample';
    	everEmun['E'] = 'Children Immunized at any given time|G';
    	everEmun['F'] = 'Children Never Immunized|H';

    	var finance = {};
    	finance['C'] = 'By Financial Year|D';

    	var healthCenter = {};
    	healthCenter['C'] = 'By Primary Health Centre|D';

    	var eachDist = {};
    	eachDist['C'] = 'By District|D';

    	headerData['bygender'] = bygender;
    	headerData['uipschedule'] = uipschedule;
    	headerData['everEmun'] = everEmun;
    	headerData['finance'] = finance;
    	headerData['healthCenter'] = healthCenter;
    	headerData['eachDist'] = eachDist;
    }

    function generateDropDown(data){
    	var options = '';
    	$.each(headerData[data], function(key, val){
    		var splitArray = val.split('|');
    		options = options+'<option value="'+key+'" perc-col="'+splitArray[1]+'">'+splitArray[0]+'</option>';
    	});
    	$('select[name=selectColumn]').html(options);
        if(selectedButton == 'finance' || selectedButton == 'eachDist' || selectedButton == 'healthCenter'){
            $('select[name=selectColumn]').hide();
        }else{
            $('select[name=selectColumn]').show();
        }
    }
    function generateFilters(url,column,selected){
    	var query = 'SELECT '+column;
    	valuesArray = [];
    	callQuery(url,query,function(res){	 
    		var res = res.getDataTable();  
    		var options = '';
    		for(var i = 0; i<res.getNumberOfRows(); i++){
    			options = options+'<option>'+res.getValue(i,0)+'</option>'
    			valuesArray.push(res.getValue(i,0));
    		}
    		$('select[name=filtersDropdown]').html(options);
	    	$('select[name=filtersDropdown]').select2();
	    	$('select[name=filtersDropdown]').val(valuesArray.splice(0,selected));
	    	$('select[name=filtersDropdown]').trigger('change');
    	});
    }
    function callQuery(url,genQuery,output){
    	var query = new google.visualization.Query(url);
		query.setQuery(genQuery);
		query.send(output);
    }

    function callQueryA(url,genQuery){
		console.log("Start = "+Date.now());
		wrapper.setDataSourceUrl(url);
        wrapper.setQuery(genQuery);
        wrapper.draw();
		console.log("Start = "+Date.now());
    }

    function setURLS(){
    	window.urlObject = {};
    	urlObject['bygender_url']      = 'https://docs.google.com/spreadsheets/d/1qQW39uARlWgHjuKeC2OcmnoiZY6vvqJEryIHRb4f_1w/edit#gid=0';
    	urlObject['uipschedule_url']   = 'https://docs.google.com/spreadsheets/d/1r4rKiV26Oi4Mfmy1h2-whRnjKUOIKM_PI0dJDVmNWhI/edit#gid=0';
    	urlObject['everEmun_url'] 	   = 'https://docs.google.com/spreadsheets/d/1LcyoPe7C7-Rylbx4mN69TmWzCF3APIzd4opRiRKZbzE/edit#gid=0';
    	urlObject['finance_url'] 	   = 'https://docs.google.com/spreadsheets/d/1IZW1THaMJW_fAoEotxRe1KCunuSbvnYiqdE3C2l2IjE/edit#gid=0';
    	urlObject['healthCenter_url']  = 'https://docs.google.com/spreadsheets/d/1hunajiU8sqlNn5sh2qrj9buyFjuIpbjHKAZ1YNzitPk/edit#gid=0';
    	urlObject['eachDist_url'] 	   = 'https://docs.google.com/spreadsheets/d/1z0lmSFIAiXWasIw2YOjTW5W8r3I5WRgxxnHgpCv3yfo/edit#gid=0';
    }

    $('select[name=selectColumn]').change(function(){
    	var filterVars = $('select[name=filtersDropdown]').val();
		var where = [];
		where.push("WHERE B = '"+filterVars[0]+"'");
		var skip = 0;
		$.each(filterVars, function(key,val){
			if(skip != 0){
				where.push("or B = '"+val+"'");
			}
			skip++;
		});
		if($('input[name=data_type]:checked').val() == 'percent'){
			var dropdownVal = $('option:selected', this).attr('perc-col');
		}else{
			var dropdownVal = $(this).val();
		}
		var query= 'SELECT B,'+dropdownVal+' '+where.join(' ');
		console.log(selectedButton);
		callQueryA(urlObject[selectedButton+'_url'],query);
    });

    $('select[name=filtersDropdown]').change(function(){
    	var filterVars = $(this).val();
		var where = [];
		where.push("WHERE B = '"+filterVars[0]+"'");
		var skip = 0;
		$.each(filterVars, function(key,val){
			if(skip != 0){
				where.push("or B = '"+val+"'");
			}
			skip++;
		});

		if($('input[name=data_type]:checked').val() == 'percent'){
			var dropdownVal = $('select[name=selectColumn] option:selected').attr('perc-col');
			if(dropdownVal == 'undefined'){
				var dropdownVal = $('select[name=selectColumn]').val();
			}
		}else{
			var dropdownVal = $('select[name=selectColumn]').val();
		}
		var query= 'SELECT B,'+dropdownVal+' '+where.join(' ');
    	callQueryA(urlObject[selectedButton+'_url'],query);
    });

    $('input[name=data_type]').click(function(){
    	var filterVars = $('select[name=filtersDropdown]').val();
		var where = [];
		where.push("WHERE B = '"+filterVars[0]+"'");
		var skip = 0;
		$.each(filterVars, function(key,val){
			if(skip != 0){
				where.push("or B = '"+val+"'");
			}
			skip++;
		});
    	if($(this).val() == 'percent'){
    		var dropdownVal = $('select[name=selectColumn] option:selected').attr('perc-col');
			if(dropdownVal == 'undefined'){
				var dropdownVal = $('select[name=selectColumn]').val();
			}
    	}else{
    		var dropdownVal = $('select[name=selectColumn]').val();
    	}
    	var query= 'SELECT B,'+dropdownVal+' '+where.join(' ');
    	callQueryA(urlObject[selectedButton+'_url'],query);
    });

    $('.def').click();
    $('#usable_title').html($('.buttons:first').attr('data-title'));
    $('#bygender').addClass('activeButtn');
    $('#usable_drop').show();
    $('.aione-tab').click(function(){
    	var content_id = $(this).attr('data-content-id');
    	$('.hideDiv').hide();
    	$('.buttons').removeClass('activeButtn');
    	$('#'+content_id+'_drop').slideDown(300);
		$('#'+content_id+'_title').slideDown(300);
		$('#'+content_id+'_drop').find('.buttons:first').addClass('activeButtn');
		$('#'+content_id+'_drop').find('.buttons:first').click();
    });

    $('.buttons').click(function(){
    	$('.buttons').removeClass('activeButtn');
    	$(this).addClass('activeButtn');
    	window.selectedButton = $(this).attr('id');
    	generateDropDown(selectedButton);
		generateFilters(urlObject[selectedButton+'_url'],'B',2);
		$('#usable_title').html($(this).attr('data-title'));
    });

    $( ".chart-type" ).click(function() {
    	wrapper.setChartType($(this).val());
    	wrapper.draw();
    });
});
$('.col-lg-3 > .row > .col-md-12 > .btn').click(function() {
	$(this).addClass('active-button').parent().siblings().find('.btn').removeClass('active-button');
});
$('[data-toggle="tooltip"]').tooltip();  