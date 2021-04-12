const toBeSelected = (s) => document.querySelector(s);

toBeSelected('.menu-toggle').addEventListener('click', () =>{
    toBeSelected('header').classList.toggle('nav-open');
    if(!$(".sidebar > .nav-list").hasClass("hidden")){
// setTimeout( function(){
    $(".sidebar > .nav-list").hide(1000,function(){
    	$(".sidebar > .nav-list").addClass("hidden",1000)
    });


    // },1000);
}else{
	$(".sidebar > .nav-list").show(0,function(){


	$(".sidebar > .nav-list").toggleClass("hidden",1000);
	})
}
});

toBeSelected('dropdown-toggle').addEventListener('click', (e) =>{
    e.preventDefault();
    toBeSelected('#myDropdown').classList.toggle('show-dropdown');
        // $(".sidebar > .nav-list").addClass("hidden",1000);

});