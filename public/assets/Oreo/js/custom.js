$( document ).ready(function() {
  

	var actus = $(".actu");
	var nombreActu = actus.length;
	var tabIndex = {};
	var indexShow = 1;
	var max = actus.length / 3;
	if(max < 1){
		max = 1;
	}

	for (var i = 0; i<nombreActu; i++)
	{
		tabIndex[i] = actus[i].id;
	}



	function hideActu()
	{
		for (var i = 0; i<nombreActu; i++)
		{
			$('#'+actus[i].id).hide();
		}
	}
	// on à un index ; et on multiplie par 5 pour savoir quelle section du tableau on affiche
	function afficheActu()
	{
		// on affiche les 5premier 
		for(var x = (indexShow * 3) - 3; x < indexShow * 3; x++)
		{
			$('#'+tabIndex[x]).show();
		}
	}
	function pagination()
	{
		$('#idPage').text(indexShow);
	}

	function DisplayButton()
	{
		if(indexShow >= 1 && indexShow != max){
			$('#forwardButton').show();
		}

		if(indexShow >= max){
			$('#forwardButton').hide();
		}


		if(indexShow >= 2)
		{
			$('#backButton').show();
		}else {
			$('#backButton').hide();
		}
	}

// par defaut on avance sinon on recule, start = premiere fois
	function Display(forward = true, start = false)
	{
			hideActu();
			if(start == false)
			{
				if(forward){
					if(indexShow != max){
						indexShow++;
					}
				}else {
					if(indexShow != 1){
						indexShow--;
					}
				}
			}

			DisplayButton();
			pagination();
			afficheActu();
	}

	Display(true, true);


	$('#forwardButton').on('click', function(){
		Display(true, false);
	});

	$('#backButton').on('click', function(){
		Display(false, false);
	});
	


});