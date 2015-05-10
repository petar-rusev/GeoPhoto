$(document).ready(function(){

});
$("#voteUp").click(function(){
    var downVote = $("#down").val();
    $("#voteUp").append(upVote);
    $.ajax({
        url:'/albums/getVote',
        method: 'Get',
        success:(function(data){
            $('#gallery-heading').html(data);
        })
    });
});
$("#voteDown").click(function(){
    var downVote = $("#down").val();
    $("#voteDown").append(downVote);
    $.ajax({
        url:'/albums/getVote',
        method: 'Get',
        success:(function(data){
            $('#gallery-heading').html(data);
        })
    });
});