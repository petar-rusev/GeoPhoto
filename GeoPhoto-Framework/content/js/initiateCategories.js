$(document).ready(function(){
      $.ajax({
        url:'/categories/show',
        method: 'Get',
        success:(function(data){
            $('#categories').append(data);
        })
    });
});

$(document).ready(function(){
    $.ajax({
        url:'/categories/choose',
        method: 'Get',
        success:(function(data){
            $('#choose_category').append(data);
        })
    });
});