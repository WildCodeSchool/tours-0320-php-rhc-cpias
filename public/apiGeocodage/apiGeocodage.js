const adresseCode = document.querySelectorAll('.select');

const url ="";

function fetchAdresse(){
    fetch(url)
        .then(function(response){
            return response.json();
        })
        .then
}


adresseCode.forEach(function(element){
    const codePostal = element.querySelector('.code').innerText;
    const adresse = element.querySelector('.adresse').innerText;
    const id = element.querySelector('.id').innerText;

    const url = `https://api-adresse.data.gouv.fr/search/?q=${adresse}&postcode=${codePostal}`;

    }
);
