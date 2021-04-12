$(document).ready(function(){

    $('#search_text_input').focus(function(){
        if(window.matchMedia("(min-width: 800px)").matches)
        {
            $(this).animate({width: '750px'}, 500);
        }
    });

    $('.button_holder').on('click', function(){
        document.search_form.submit();
    })

});

function getLiveSearchUsers(value, user)
{
    $.post("ajax_search.php", {query:value, userLoggedIn: user}, function(data){

        if($(".search_results_footer_empty")[0])
        {
            $(".search_results_footer_empty").toggleClass("search_results_footer");
            $(".search_results_footer_empty").toggleClass("search_results_footer_empty");
        }

        $(".search_results").html(data);
        $(".search_results").html("<a href='search.php?q=" + value +">See All Results</a>");

        if(data = "")
        {
            $(".search_results").html("");
            $(".search_results_footer").toggleClass("search_results_footer_empty");
            $(".search_results_footer").toggleClass("search_results_footer");
        }
    });
}