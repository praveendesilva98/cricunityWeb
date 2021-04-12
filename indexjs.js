// Selectionner tous les  post_body 
//jquery on peux lui passer , soit un selector ("#id",".class","tag"), soit un element html, 
//soit une list, soit un objet
function toggleWhite(event) {
	// console.log(event)
	target = event.target // ELEMENT HTML 
	condition=target.classList.contains("post_body")// en javascript de base
	condition_jquery = $(target).hasClass("post_body") // en jquery 
	// if() 
	if (condition_jquery) { // on a clicker sur post_body
		//recuperer le bon post - recuperer l'id
		currTarget = $(event.currentTarget)
		id_CurrTarget = currTarget.attr("post-id") // on a l'id du post
		// console.log(id_CurrTarget)

		//1er technique, on selectionne avec l'id
		// on va sélectionner la zone des commentaires du post avec 'id_CurrTarget'
		postComments = $("#toggleComment"+id_CurrTarget) 

		if(postComments.is(":hidden")){
			postComments.show()
		}else{
			postComments.hide()
		}
		event.stopPropagation();
	}
}

$(".white_box").on("click",toggleWhite)

$(function() 
{
	$("#content").on('click', function(ev)
	{
		ev.stopPropagation();
		ev.preventDefault()
		tar=$(ev.target)
		deleteOK=tar.hasClass("delete_button")  || tar.parent().hasClass("delete_button") 
		reportOK=tar.hasClass("report_button")  || tar.parent().hasClass("report_button")
		namelinkOK=tar.hasClass("posted_by") || tar.parent().hasClass("posted_by")
		contentlinkOK=tar.hasClass("content_link") || tar.parent().hasClass("content_link")
		linkOK=tar.hasClass("link") || tar.parent().hasClass("link")

		if(linkOK)
		{
		  if(tar.parent().hasClass("link") )
		  {
			  tar =$(ev.target).parent()
		  }
		  id=tar.attr("id")
		  link(id)
	  
		}

	  	if(namelinkOK)
	  	{
			if(tar.parent().hasClass("posted_by") )
			{
				tar =$(ev.target).parent()
			}
			id=tar.attr("id")
			name_link(id)
		
	  	}

	  	if(contentlinkOK)
	  	{
			if(tar.parent().hasClass("content_link") )
			{
				tar =$(ev.target).parent()
			}
			id=tar.attr("id")
			content_link(id)
		
	 	}

		if (deleteOK) 
		{
			if(tar.parent().hasClass("delete_button") )
			{
		  		tar =$(ev.target).parent()
			}
			id=tar.attr("id")
        	delete_button(id)

	  	}
		else if(reportOK)
		{
			if(tar.parent().hasClass("report_button") )
			{
		  		tar =$(ev.target).parent()
			}
			id=tar.attr("id")
        	report_button(id)

	  	}


	})
	   	function delete_button(id)
	   	{

			id=id.slice(4);
			bootbox.confirm("Are you sure you want to delete this post ?", function(result)
			{

				if(result)
				{
					$.post("delete_post.php?post_id="+id, null,function()
					{
						location.reload();
			  		});
				}

		  	});
		}
		  
		$('.report_buttoned').on('click', function(ev)
		{
			ev.stopPropagation();
		   }
		)

	// .report_buttoned
		function report_button(id)
		{
			id=id.slice(6);
			bootbox.confirm("Are you sure you want to report this post ?", function(result1)
			{
				$.post("report_post.php?post_id="+id, {result1:result1});

			  	if(result1)
					location.reload();
		  	});
	  	}
	  
		function name_link(id)
		{
			id=id.slice(9);
			window.location = id
	  	}

		function content_link(id)
		{
			id=id.slice(7);
			window.location = "content.php?post_id="+id 
		}
		  
		function link(id)
		{
			id=id.slice(8);
			window.location = id 
	  	}




  });





