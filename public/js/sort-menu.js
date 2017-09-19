$(document).ready(function(){


        calcWidth($('#title0'));

        window.onresize = function(event) {
            console.log("window resized");

            //method to execute one time after a timer

        };

        //recursively calculate the Width all titles
        function calcWidth(obj){
            console.log('---- calcWidth -----');

            var titles = 
            $(obj).siblings('.space').children('.route').children('.title');

            $(titles).each(function(index, element){
                var pTitleWidth = parseInt($(obj).css('width'));
                var leftOffset = parseInt($(obj).siblings('.space').css('margin-left'));

                var newWidth = pTitleWidth - leftOffset;

                if ($(obj).attr('id') == 'title0'){
                    console.log("called");

                    newWidth = newWidth - 10;
                }

                $(element).css({
                    'width': newWidth,
                })

                calcWidth(element);
            });

        }


        $('.space').sortable({
            connectWith:'.space',
            // handle:'.title',
            // placeholder: ....,
            tolerance:'intersect',
            over:function(event,ui){
            },
            receive:function(event, ui){
                calcWidth($(this).siblings('.title'));
            },
        });
        $('.space').disableSelection();
    });
