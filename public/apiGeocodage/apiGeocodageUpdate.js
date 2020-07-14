const btn = document.querySelector(".btnCoord");

btn.onclick = function() {

    const codePostal = document.querySelector('.code').innerText;
    const adresse = document.querySelector('.adresse').innerText;
    const id = document.querySelector('.id').innerText;
    const ville = document.querySelector('.ville').innerText;

    const url = `https://api-adresse.data.gouv.fr/search/?q=${adresse}+${ville}&postcode=${codePostal}&limit=1`;

    let dataTab = [];

    fetch(url, { mode: 'cors' })
        .then(function (response) {
            return response.json();
        })
        .then(function (profile) {
            console.log(profile);
            dataTab[id] = profile.features[0].geometry.coordinates;
    })

    const requete = new XMLHttpRequest();
    requete.open('POST','http://localhost:8000/finess/coord');
    requete.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    requete.send('id=1&coord=youpi');
    //document.location.href="http://localhost:8000/finess/coord";
}
