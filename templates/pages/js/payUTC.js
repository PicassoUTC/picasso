/********************************
				TODO


				change URL de payutc 
				https://api.nemopay.net/services/GESARTICLE/getCasUrl?system_id=payutc
********************************/

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

function displayBeers () {
	var dangerBeers=[];
	var normalBeers=[];
	callPayUTC("ADMINRIGHT", "loginApp", {'key': '44682eb98b373105b99511d3ddd0034f'}, function(data){

					
					arguments = {'fun_id': 2};
					callPayUTC("CATALOG","getProductsByCategories", arguments , function(result){
						var beers = [], i=0;
						var softs = [];
						for (var beer in result[0].products){
							beers[i] = result[0].products[beer];
							i++;
						}
						
						for (var beer in result[1].products){
							beers[i] = result[1].products[beer];
							i++;
						}

												
						for (var i=0; i<beers.length; i++){
							if (beers[i].stock < 100){
								dangerBeers.push(beers[i]);
							}else{
								normalBeers.push(beers[i]);
							}
						}

						for (var i=0; i<dangerBeers.length; i++){
							if (dangerBeers[i].name != "Ecocup"){
								var dangerPanel = document.getElementById("dangerStock");
								var textPanel = '<div class=\"col-lg-2 col-sm-2 col-md-2\"><div class=\"panel panel-default\"><div class=\"panel-heading\">'+dangerBeers[i].name+'</div><div class=\"panel-footer\">Stock: <span class="bold"> '+dangerBeers[i].stock+'</span></div></div></div>';
						        dangerPanel.innerHTML += textPanel;
							}
						}

						for (var i=0; i<normalBeers.length; i++){
							if (normalBeers[i].name != "Ecocup"){
								var normalPanel = document.getElementById("normalStock");
								var textPanel = '<div class=\"col-lg-2 col-sm-2 col-md-2\"><div class=\"panel panel-default\"><div class=\"panel-heading\">'+normalBeers[i].name+'</div><div class=\"panel-footer\">Stock: <span class="bold">'+normalBeers[i].stock+'</span></div></div></div>';
						        normalPanel.innerHTML += textPanel;
							}
						}

						if (dangerBeers.length == 0 || (dangerBeers.length == 1 && dangerBeers[0].name=="Ecocup")){
							console.log("No Beers in danger");
							var dangerRow = document.getElementById("dangerRow");
							dangerRow.parentNode.removeChild(dangerRow);
						}

					});

	});
}

function getProdByCat (argument) {
	callPayUTC("ADMINRIGHT", "loginApp", {'key': '44682eb98b373105b99511d3ddd0034f'}, function(data){

					
					arguments = {'fun_id': 2};
					callPayUTC("CATALOG","getProductsByCategories", arguments , function(result){
						console.log(result);
					});

	});
}

function displaySofts () {
	var dangerSofts=[];
	var normalSofts=[];

	callPayUTC("ADMINRIGHT", "loginApp", {'key': '44682eb98b373105b99511d3ddd0034f'}, function(data){

					
					arguments = {'fun_id': 2};
					callPayUTC("CATALOG","getProductsByCategories", arguments , function(result){
						var beers = [], i=0;
						var softs = [];
						
						for (var soft in result[11].products){
							softs[i] = result[11].products[soft];
							i++;
						}
						
						for (var i=0; i<softs.length; i++){
							if (softs[i].stock < 50){
								dangerSofts.push(softs[i]);
							}else{
								normalSofts.push(softs[i]);
							}
						}

						for (var i=0; i<dangerSofts.length; i++){
							if (dangerSofts[i].name != "Ecocup"){
								var dangerPanel = document.getElementById("dangerStock");
								var textPanel = '<div class=\"col-lg-2 col-sm-2 col-md-2\"><div class=\"panel panel-default\"><div class=\"panel-heading\">'+dangerSofts[i].name+'</div><div class=\"panel-footer\">Stock: <span class="bold"> '+dangerSofts[i].stock+'</span></div></div></div>';
						        dangerPanel.innerHTML += textPanel;
							}
						}

						for (var i=0; i<normalSofts.length; i++){
							if (normalSofts[i].name != "Ecocup"){
								var normalPanel = document.getElementById("normalStock");
								var textPanel = '<div class=\"col-lg-2 col-sm-2 col-md-2\"><div class=\"panel panel-default\"><div class=\"panel-heading\">'+normalSofts[i].name+'</div><div class=\"panel-footer\">Stock: <span class="bold">'+normalSofts[i].stock+'</span></div></div></div>';
						        normalPanel.innerHTML += textPanel;
							}
						}
					});

	});

}

function displaySnacks () {
	var dangerSnacks=[];
	var normalSnacks=[];

	callPayUTC("ADMINRIGHT", "loginApp", {'key': '44682eb98b373105b99511d3ddd0034f'}, function(data){

					
					arguments = {'fun_id': 2};
					callPayUTC("CATALOG","getProductsByCategories", arguments , function(result){
						
						var snacks = [], i=0;
						
						for (var snack in result[7].products){
							snacks[i] = result[7].products[snack];
							i++;
						}
						for (var snack in result[9].products){
							snacks[i] = result[9].products[snack];
							i++;
						}
						for (var snack in result[10].products){
							snacks[i] = result[10].products[snack];
							i++;
						}
						for (var snack in result[2].products){
							snacks[i] = result[2].products[snack];
							i++;
						}
						for (var i=0; i<snacks.length; i++){
							if (snacks[i].stock < 50){
								dangerSnacks.push(snacks[i]);
							}else{
								normalSnacks.push(snacks[i]);
							}
						}

						for (var i=0; i<dangerSnacks.length; i++){
							if (dangerSnacks[i].name != "Ecocup" && dangerSnacks[i].id != "85" && dangerSnacks[i].id != "86" && dangerSnacks[i].id != "1674" && dangerSnacks[i].id != "1675"){
								var dangerPanel = document.getElementById("dangerStock");
								var textPanel = '<div class=\"col-lg-2 col-sm-2 col-md-2\"><div class=\"panel panel-default\"><div class=\"panel-heading\">'+dangerSnacks[i].name+'</div><div class=\"panel-footer\">Stock: <span class="bold"> '+dangerSnacks[i].stock+'</span></div></div></div>';
						        dangerPanel.innerHTML += textPanel;
							}
						}

						for (var i=0; i<normalSnacks.length; i++){
							if (dangerSnacks[i].name != "Ecocup" && dangerSnacks[i].id != "85" && dangerSnacks[i].id != "86" && dangerSnacks[i].id != "1674" && dangerSnacks[i].id != "1675"){
								var normalPanel = document.getElementById("normalStock");
								var textPanel = '<div class=\"col-lg-2 col-sm-2 col-md-2\"><div class=\"panel panel-default\"><div class=\"panel-heading\">'+normalSnacks[i].name+'</div><div class=\"panel-footer\">Stock: <span class="bold">'+normalSnacks[i].stock+'</span></div></div></div>';
						        normalPanel.innerHTML += textPanel;
							}
						}
					});

	});

}