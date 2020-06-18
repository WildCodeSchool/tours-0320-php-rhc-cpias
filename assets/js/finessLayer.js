
//sources des données servant à remplir le paramètre "source" d'une layer
/*let sourceReg= new ol.source.Vector({
				url: "openlayer/kml/regionCentre.kml",
				format: format = new ol.format.KML({
				extractStyles: true
				})
			});*/

let sourceOSM = new ol.source.OSM();


//instanciation des différentes Layers (couches) de donnée de la carte. 
		/*let centre = new ol.layer.Vector({
			source: sourceReg
		});*/

		let OSMlayer =  new ol.layer.Tile({
			    source: sourceOSM
		});


//instanciation de la carte 

		let map = new ol.Map({
		    target: 'map',
		    layers: [OSMlayer],
		    view: new ol.View({
		      center: ol.proj.fromLonLat([1.67,47.6]),
		      zoom: 8
		    })
		});
