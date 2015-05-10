$(document).ready(function(){
    $.ajax({
        url:'/albums/showComments',
        method: 'Get',
        success:(function(data){
            $('#albums-comment').html(data);
        })
    });
});/**
 * Created by Pesho on 5/10/2015.
 */
