jQuery(document).ready(function () {
    jQuery('.commentlist li').each(function (i) {
        jQuery(this).find('div.commentNumber').text('#'+(i+1))
    });

    console.log('test1');

    jQuery('#commentform').on('click','#submit',function (e) {
        e.preventDefault();

        var comParent=jQuery(this);

        jQuery('.wrap_result')
            .css('color','green')
            .text('Сохранение комментария')
            .fadeIn(500,function () {

                var data = jQuery('#commentform').serializeArray();

                jQuery.ajax({
                    url:jQuery('#commentform').attr('action'),
                    headers:{
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    },
                    data:data, 
                    type:'POST', 
                    datatype:'JSON',
                    success:function (html) {
                        if(html.error){
                            jQuery('wrap_result').css('color','red').append('<br><strong>Ошибка:</strong>'+html.errors.join('<br>'));
                            jQuery('wrap_result').delay(2000).fadeOut(500)
                        } else if (html.success){
                            jQuery('.wrap_result')
                                .append('<br><strong>Сохраненно</strong>')
                                .delay(2000)
                                .fadeOut(500,function() {
                                    if(html.data.parent_id>0){
                                        comParent.parents('div#respond').prev().after('<ul class="children">'+html.comment+'</ul>');
                                    }else {
                                        if(jQuery.contains('#comments','ol.commentlist')){
                                            jQuery('ol.commentlist').append(html.comment);

                                        } else {
                                            jQuery('#respond').before('<ol class="commentlist group"' +html.comment+'</ol>');
                                        }
                                    }

                                    jQuery('#cancel-comment-reply-link').click();
                                });
                        }
                    },
                    error:function () {
                        jQuery('wrap_result').css('color','red').append('<br><strong>Ошибка</strong>');
                        jQuery('wrap_result').delay(2000).fadeOut(500,function () {
                            jQuery('#cancel-comment-reply-link').click();
                        });
                    }
                });
            });


    });
});