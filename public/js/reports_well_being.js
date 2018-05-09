$(document).ready(function(){
    window.selected_section = 12;
    window.selected_answer_id;
    var raw_data = $( "#raw_data").val();
    //console.log(raw_data);
    var parsed_data = aione_parse_json(raw_data);
    var survey_data = parsed_data['survey_details'];
    
    parsed_data = parsed_data['answers'];

    parsed_data = sortArrayDataByDate(parsed_data);

    var answers = parsed_data[parsed_data.length-1];

    window.selected_answer_id = answers.id;

    draw_archive(parsed_data);

    draw_sections(survey_data);

    draw_questions(survey_data, selected_section, answers);

    $('body').on('click','.archive-reports ul li', function(){
        var elem = $(this);
        var recordData = parsed_data.filter(function(value){
            return value.id == elem.data('index');
        });
        window.selected_answer_id = elem.data('index');
        draw_questions(survey_data, window.selected_section, recordData[0]);
        $(this).addClass('active').siblings().removeClass('active');
    });

    $('.data-sources-tabs > li:first').addClass('active');
    $('.archive-reports ul li:first').addClass('active');

    $('body').on('click','.data-sources-tabs > li',function(){
        var target = $(this).data("target");
        $(this).addClass('active').siblings().removeClass('active');
        var recordData = parsed_data.filter(function(value){
            return value.id == window.selected_answer_id;
        });
        draw_questions(survey_data,$(this).data('target'),recordData[0]);
        window.selected_section = $(this).data('target');
    })
});



function draw_questions(survey_data, initial_draw, answers){
    $('#better_life_index_report').html('');
    var record = survey_data.filter(function(value){
        return value.section_id == initial_draw;
    });
    $('#better_life_index_report').parent('div').find('h4').html(record[0].section_name);

    $.each(record[0].fields, function(key,value){
        if($.inArray(value.field_type,['radio','checkbox','select','multi_select']) !== -1){
            var questionHtml = '<div class="p-20"><div class="pb-20">'+value.field_title+'</div><div><div class="indicater-2">';

                $.each(value.options, function(k,option){
                    if(value.field_type == 'checkbox'){
                        if($.inArray(option.key,JSON.parse(answers[value.field_slug])) !== -1){
                            questionHtml += '<span class="aione-border bg-green white border-green border-lighten-2">'+option.value+'</span>';
                        }else{
                            questionHtml += '<span class="aione-border border-green border-lighten-2">'+option.value+'</span>';
                        }
                    }else{
                        if(answers[value.field_slug] == option.key){
                            questionHtml += '<span class="aione-border bg-green white border-green border-lighten-2">'+option.value+'</span>';
                        }else{
                            questionHtml += '<span class="aione-border border-green border-lighten-2">'+option.value+'</span>';
                        }
                    }
                    
                });
        
            questionHtml += '<div class="clear"></div></div></div></div>';
            $('#better_life_index_report').append(questionHtml);
        }else{
            var questionHtml = '<div class="p-20"><div class="pb-20">'+value.field_title+'</div><div><div class="indicater-2">';

            questionHtml += '<span class="aione-border bg-green white border-green border-lighten-2">'+answers[value.field_slug]+'</span>';

            questionHtml += '<div class="clear"></div></div></div></div>';
            $('#better_life_index_report').append(questionHtml);
        }
    });
}


function draw_archive(parsed_data){
    var total_records = parsed_data.length;
    $('.archive-reports').find('ul').html('');
    for(var i = total_records-1; i >= 0; i--){
        $('.archive-reports').find('ul').append('<li class="aione-border-bottom p-10" data-index="'+parsed_data[i].id+'">'+parsed_data[i].survey_completed_on+'</li>');
    }
}


function draw_sections(sections_array){
    
    $.each(sections_array, function(key, value){
        $('.report-sections').append('<li data-target="'+value.section_id+'" class="border-grey border-lighten-2 aione-border-bottom">'+value.section_name+'</li>');
    });
}


function sortArrayDataByDate(array){
    var sortedarr = array.sort(function(a,b){   
        var d1 = new Date(Date.parse(a.survey_completed_on));
        var d2 = new Date(Date.parse(b.survey_completed_on));
            return d1 > d2 ? 1  
            : d1 < d2 ? -1 
            : 0; 
    });
    return sortedarr;
}

function aione_parse_json(data){
    if(data.length>0){
        data = JSON.parse(data);
        return data;
    } else {
        return false;
    }
}