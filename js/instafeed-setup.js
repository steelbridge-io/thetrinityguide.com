    //Set up instafeed
    var userFeed = new Instafeed({

		get: 'user',
		userId: '7059297616',
    clientId: '56b7217312f749cf8a0766543d6e04eb',
		accessToken: 'bd1d97cf6fec81c932c95549aa1892cf',
    target: 'instafeed',
    sortBy: 'most-recent',
    links: true,
    limit: 6,
    resolution: 'standard_resolution',
		template:
			'<div class="col-sm-12 col-lg-2 col-md-4 insta-nth-img">' +
			'<a class="" href="{{link}}">' +
			'<div class="insta-img">' +
      '<img src="{{image}}">' +
      '<p class="insta-comm">"{{caption}}"</p>' +
      '</div>' +
			'</a>' +
			'</div>'

    });

    userFeed.run();

