const codePostal = document.querySelector('.code').innerText;
const adresse = document.querySelector('.adresse').innerText;
const id = document.querySelector('.id').innerText;
const ville = document.querySelector('.ville').innerText;

const url = `https://api-adresse.data.gouv.fr/search/?q=${adresse}+${ville}&postcode=${codePostal}&limit=1`;

fetch(url, { mode: 'cors' })
    .then(function (response) {
        return response.json();
    })
    .then(function (profile) {
        console.log(profile);
    })
