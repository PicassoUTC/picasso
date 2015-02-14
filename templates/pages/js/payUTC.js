function callPayUTC (service, method, data, callback) {
    //console.log("https://assos.utc.fr/buckutt/" + service + "/" +method);
    
    return $.ajax({
        type: "POST",
        url: "https://assos.utc.fr/buckutt/" + service + "/" +method,
        data:data,
        success: callback,
        dataType : "json"


    });
    
}



function getProdsByCat () {
	callPayUTC("ADMINRIGHT", "loginApp", {'key': '44682eb98b373105b99511d3ddd0034f'}, function(data){

					
					arguments = {'fun_id': 2};
					callPayUTC("CATALOG","getProductsByCategories", arguments , function(result){
						var beers = [], i=0;
						for (var beer in result[0].products){
							beers[i] = result[0].products[beer];
							i++;
						}
						
						for (var beer in result[1].products){
							beers[i] = result[1].products[beer];
							i++;
						}

						console.log("Returned Array: ", beers);
						displayBeers(beers);
					});

	});

}


function updateStock (product, stock) { //BAD REQUEST
	callPayUTC("ADMINRIGHT", "loginApp", {'key': '44682eb98b373105b99511d3ddd0034f'}, function(data){

					
					arguments = {'fun_id': 2, 'obj_id': product.id, 'stock': stock, 'parent': product.categorie_id, 'prix':product.price, 
								'alcool': product.alcool, 'image' : (product.image)? product.image : 0,
								'tva' : product.tva, 'active' :product.active, 'return_of': product.return_of, 'meta' : product.meta};
					callPayUTC("GESARTICLE","setProduct", arguments , function(result){
						console.log(result);
					});

	});
}

function displayBeers (beerArray) {
	var dangerBeers=[];
	var normalBeers=[];
	for (var i=0; i<beerArray.length; i++){
		if (beerArray[i].stock < 100){
			dangerBeers.push(beerArray[i]);
		}else{
			normalBeers.push(beerArray[i]);
		}
	}

	for (var i=0; i<dangerBeers.length; i++){
		if (dangerBeers[i].name != "Ecocup"){
			var dangerPanel = document.getElementById("dangerStock");
			var textPanel = '<div class=\"col-lg-2 col-sm-2 col-md-2\"><div class=\"panel panel-default\"><div class=\"panel-heading\">'+dangerBeers[i].name+'</div><div class=\"panel-body\">Photo de la biere</div><div class=\"panel-footer\">Stock: <span class="bold"> '+dangerBeers[i].stock+'</span></div></div></div>';
	        dangerPanel.innerHTML += textPanel;
		}
	}

	for (var i=0; i<normalBeers.length; i++){
		if (normalBeers[i].name != "Ecocup"){
			var normalPanel = document.getElementById("normalStock");
			var textPanel = '<div class=\"col-lg-2 col-sm-2 col-md-2\"><div class=\"panel panel-default\"><div class=\"panel-heading\">'+normalBeers[i].name+'</div><div class=\"panel-body\">Photo de la biere</div><div class=\"panel-footer\">Stock: <span class="bold">'+normalBeers[i].stock+'</span></div></div></div>';
	        normalPanel.innerHTML += textPanel;
		}
	}
}

getProdsByCat();