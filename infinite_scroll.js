function infiniteScroll()
{ //cours 2-3 DOM, AJAX  3H ? BOOTSTRAP CSS  1H ?  4h cours 
	var offset_ini= 0;
	var offset = offset_ini;

	// on initialise ajaxready à true au premier chargement de la fonction
	$(window).data('ajaxready', true); // je peux faire de l'ajax -> je peux demander des post

	$('#content').append('<div id="loader" offset='+offset+'><img src="img/ajax-loader.gif" alt="loader ajax"></div>'); //rajoute un loader

	var deviceAgent = navigator.userAgent.toLowerCase();
	var agentID = deviceAgent.match(/(iphone|ipod|ipad)/); //Est-ce un telephone ? 

	$(window).scroll(function() 
	{ // regarde quand on scroll

		// On teste si ajaxready vaut false, auquel cas on stoppe la fonction
		// console.log($(window).data('ajaxready'));
		if ($(window).data('ajaxready') == false) return; 

		if(parseInt($(window).scrollTop() + $(window).height()) == $(document).height()
		|| agentID && ($(window).scrollTop() + $(window).height()) + 150 > $(document).height()) {
		// lorsqu'on commence un traitement, on met ajaxready à false
		$(window).data('ajaxready', false);

		$('#content #loader').fadeIn(400);
		offset=parseInt($('#loader').attr("offset"));

	// console.log(offset);
		$.get('ajax_load_posts2.php?offset=' + offset, function(data)
		{
			// class="hidden"
			if (data != '') {
			// console.log($(data));
			// console.log($(data).filter("center").length);
			$('#content #loader').before(data); 
			$('.white_box:hidden').fadeIn(400); // MONTRE Les nouveaux posts petit à petit  (recherche fadeIn jquery)
			// console.log("center");
			// console.log($(data).filter("center").length);
			offset+= parseInt($(data).filter("center").length);
			$('#loader').attr("offset",offset);
			// une fois tous les traitements effectués,
			// on remet ajaxready à false
			// afin de pouvoir rappeler la fonction
			$(window).data('ajaxready', true);
			}

			$('#content #loader').fadeOut(400);            
		});
		}
	});
};
  
infiniteScroll();


