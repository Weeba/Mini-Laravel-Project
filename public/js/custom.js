 $(".like-button").click(function() {
    var id = this.value;
    $.get('/question/'+id+'/question_vote',{id:id}, function(data){
        // console.log(data);
         $("#like"+id).html(data);
    });
});

 $(".ans-like-button").click(function() {
    var id = this.value;
    $.get('/answer/'+id+'/answer_vote',{id:id}, function(data){
        // if(data == 0){
            $("#like"+id).html(data);
        // } else {
            // $("#like"+id).html(data);
        // }
    });
});

// $('#ajaxContent').load('http://www.example.com/paginated/data');

// $('.pagination a').on('click', function (event) {
//     event.preventDefault();
//     if ( $(this).attr('href') != '#' ) {
//         $("html, body").animate({ scrollTop: 0 }, "fast");
//         $('#ajaxContent').load($(this).attr('href'));
//     }
// });
