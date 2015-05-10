$(document).ready(function(){
    $.ajax({
        url:'/albums/showRank',
        method: 'Get',
        success:(function(data){
            $('#high-ranked').append(data);
        })
    });
});