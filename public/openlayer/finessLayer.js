// sources des données servant à remplir le paramètre "source" d'une layer

let sourceReg= new ol.source.Vector({
				url: "/openlayer/kml/regionCentre.kml",
				format: format = new ol.format.KML({
				extractStyles: true
				})
			});

let sourceOSM = new ol.source.OSM();


// instanciation des différentes Layers (couches) de données de la carte. 

let centre = new ol.layer.Vector({
	source: sourceReg
	});

let OSMlayer =  new ol.layer.Tile({
	source: sourceOSM
	});


// instanciation de la carte 

let map = new ol.Map({
	target: 'map',
	layers: [OSMlayer,centre],
	view: new ol.View({
		center: ol.proj.fromLonLat([1.67,47.6]),
		zoom: 8
	})
});

// instanciation des Overlay (surcouche), les points sur la carte et le lien sur le nom de l'établissement

	// instanciation d'une variable qui récupère tt les élément de la class "ponctuel" (1 élément = 1 point sur la carte)

let ponctuelTableau = document.querySelectorAll(".ponctuel");

Array.prototype.slice.call(ponctuelTableau).forEach(function(element){
	
	// récupération des coordonnées dans le html 
	let coord = (element.querySelector(".coord").innerHTML).split(",");
	coord[0]=parseFloat(coord[0]);
	coord[1]=parseFloat(coord[1]);
	// passage de coordonnées en lat/long en un systeme projeté
	let coordProj=ol.proj.fromLonLat([coord[0],coord[1]]);
	

	// instanciation de la surcouche
	var marker = new ol.Overlay({
  		position: coordProj,
  		positioning: 'center-center',
  		element: element.querySelector('#marker'),
  		stopEvent: false
	});
	// ajout de la surcouche à la carte
	map.addOverlay(marker);

	// lien sur le nom de l'établissement

	var lien = new ol.Overlay({
			position: coordProj,
			positioning: 'top-right',
			element: element.querySelector('#label'),
			stopEvent: false
		});
		map.addOverlay(lien);

});