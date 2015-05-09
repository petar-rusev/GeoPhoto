$(document).ready(function(){
    $.ajax({
        url:'/albums/welcomeCheck',
        method: 'Get',
        async:false,
        success:(function(data){
            $('#welcome-screen').append(data);
        })
    });
});
