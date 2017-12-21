$(document).ready(function(){
    
    window.url = "https://docs.google.com/spreadsheets/d/1742jl7dn8zzcfARrTXlOfe4LFecQkzIi3wC_XbB8aQU/edit#gid=0";
    window.defaultQuery = 'SELECT A,B';
    window.defaultSelected = 'zero_hunger';

    google.charts.load('current');   // Don't need to specify chart libraries!
    google.charts.setOnLoadCallback(init_func);
    function init_func(){
        //Code for get query result
        var opts = {sendMethod: 'auto'};
        var query = new google.visualization.Query('https://docs.google.com/spreadsheets/d/1742jl7dn8zzcfARrTXlOfe4LFecQkzIi3wC_XbB8aQU/edit?gid=892133123', opts);
        query.setQuery('select A,B,C,D,E,F');
        query.send(function(result){
                window.resultData = result['J']['og'];
                $('.sdg-goal[target='+defaultSelected+']').click();
                setTimeout(function(){
                    $('.chart-title-button:first').click();
                    $('.drawChart:first').click();
                },1000)
        });
    }
    

    $('.sdg-goals > .sdg-goal').click(function(){
        $(this).addClass('active').siblings().removeClass('active');
        window.selectedGoal = $(this).attr('target');
        var goal_gb_color = $(this).css("background-color");
        $(this).parent().css('border-color',goal_gb_color);
        $(this).parent().children('.arrow').css('border-top-color',goal_gb_color);
        $(this).parent().children('.arrow').css('left',$(this).position().left + $(this).width()/2);
        var goalTitle = 'Goal '+$(this).find('.goal-no').text()+' '+$(this).find('.goal-title').text();
        $('.selectedChartTitle').html(goalTitle);
        $('.selectedChartTitle').parent().parent().parent().css('border-color',goal_gb_color);
        $('.selectedChartTitle').parent().css('background-color',goal_gb_color);

        window.selectedGoalData = $.grep(resultData,function(value){
            return value['c'][0]['v'] == selectedGoal;
        });

        // goalTitles
        var countIndex = 0;
        var defaultSelectedTitle = '';
        var generatedButtons = '';
        var titlesArray = [];
        $.each(selectedGoalData, function(key,value){
            if($.inArray(value['c'][5]['v'], titlesArray) == -1){
                titlesArray.push(value['c'][5]['v']);
            }
        })
        $.each(titlesArray, function(key,value){
                generatedButtons += '<div class="singleTitle"><button class="chart-title-button">'+value+'</button><div class="hideDiv">';
                var chartButtons = '';
                $.each(selectedGoalData,function(key,val){
                    if(val['c'][5]['v'] == value){
                        console.log(val['c'][5]['v'],value);
                        chartButtons += '<button class="m100 drawChart" data-columns='+val['c']['3']['v']+' data-id='+val['c'][2]['v']+'>'+val['c'][4]['v']+'</button>';
                    }
                });
                generatedButtons += chartButtons;
                generatedButtons += '</div></div>';
        });
        drawVisualization();
        $('.titles').html(generatedButtons);
        $('.chart-title-button:first').click();
        $('.drawChart:first').click();
        //console.log(chartButtons);
    });


    //get all charts on change title
    $('.goalTitles').change(function(){
        //var chartData = JSON.parse(data);
        var singleTitleData = chartData[selectedGoal]['titles'][$(this).val()];
        console.log(singleTitleData['charts']);
        var chartsList = '<option>Select Chart</option>';
        $.each(singleTitleData['charts'], function(key,value){
            if($.isArray(value)){
                chartsList += '<option value="'+key+'">'+value[0]+'</option>';
            }else{
                chartsList += '<option value="'+key+'">'+value+'</option>';
            }
        });
        $('.goalCharts').html(chartsList);
        // console.log($(this).val());
    });

    $('body').on('click','.drawChart',function(){
        
        $(this).addClass('active').siblings().removeClass('active');
        if($(this).text()== 'By Zone'){
            $('#map_wrapper').addClass('active');
            // $('#map_wrapper').find('iframe');
        } else {
            $('#map_wrapper').removeClass('active');
        }
        var dataSourceUrl = 'https://docs.google.com/spreadsheets/d/1742jl7dn8zzcfARrTXlOfe4LFecQkzIi3wC_XbB8aQU/edit?gid='+$(this).data('id');
        var query = $(this).data('columns');
        window.url = dataSourceUrl;
        window.defaultQuery = 'SELECT '+query+' where '+query.split(",")[0]+' is not null'; 
        drawVisualization();
    });

    function get_chart_type(){
        var chart_type = $("input[name=chart_type]").val();
        return chart_type;
    }
    
    var wrapper;
    var pieChartWrapper;

    function drawVisualization(){

        wrapper = new google.visualization.ChartWrapper({
            chartType: get_chart_type(),
            dataSourceUrl:url,
            'query':defaultQuery,
            options: {},
            containerId: 'chart_wrapper', 
        });
        setTimeout(function(){
            var queryString = '';
            var colors = ['8bc34a','0097a7','e53935','f9a825'];
            var index = 0;
            var labels = wrapper['yda']['ng'];
            var labelInd = 1;
            console.log(labels.label);
            $.each(wrapper['yda']['og'], function(key,mapV){
                queryString+= 'IN-DL-'+mapV['c'][0]['v'].toUpperCase()+'=';
                var labelIndex = 0;
                $.each(labels, function(labelKey,labelValue){
                    if(labelIndex != 0){
                        queryString+= labelValue['label'].replace(' ','%20')+' '+mapV['c'][labelIndex]['f']+'25<br>';
                    }
                    labelIndex++;
                });
                queryString+= '=%23'+colors[index]+'+';
                index++;
            });
            queryString+= 'IN-DL-CENTRAL=No Data=%23FFFFFF';
            console.log('http://slum.fhts.ac.in/public/custom-maps/GM-632389430593/map-theme-ggreen/'+queryString);
            $('#delhi_map').attr('src','http://slum.fhts.ac.in/public/custom-maps/GM-632389430593/map-theme-ggreen/'+queryString);
            console.log(wrapper);
        },2000);

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
        var colors = ["#00BCD4","#ef5350"]; 
        wrapper.setOption('colors', colors);
        wrapper.setOption('animation', chartAnimation);
        wrapper.setOption('legend', 'top');
        wrapper.setOption('pointSize', '8');
        wrapper.setOption('width', '100%');
        wrapper.setOption('height', '380');
        wrapper.setOption('chartArea', chartArea);
        wrapper.setOption('displayAnnotations', true);
        //wrapper.setOption('bar', { groupWidth: "80%" } );
        wrapper.setOption('tooltip', { isHtml: true} );
        wrapper.draw();
        var query = new google.visualization.Query(url);
        query.setQuery(defaultQuery);

    }
    $('#display-chart-title').html($('.selectQuery').find(':selected').text());
    $('.selectQuery').change(function(){
        $('#display-chart-title').html($(this).find(':selected').text());
        var query = $(this).val();
        wrapper.setQuery('SELECT '+query+' where '+query.split(",")[0]+' is not null'); 
        wrapper.draw();
    });

    $( ".chart-type" ).click(function() {
        wrapper.setChartType($(this).val());
        wrapper.draw();
    });


    // Chart buttons of left side 
    $('body').on('click','.chart-title-button', function(){
        $('.chart-title-button').removeClass('active');
        $(this).addClass('active');
        //var parentDiv = $(this).parent('.singleTitle');
        var chartsDiv = $(this).parent('.singleTitle').find('.hideDiv');
        $('.action-buttons').html(chartsDiv.html());
        $('.action-buttons').find('.drawChart:first').click();
    });
});