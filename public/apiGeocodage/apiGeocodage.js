const adresseCode = document.querySelectorAll('.select');

function pause(ms)
{
    var date = new Date();
    var curDate = null;
    do { curDate = new Date(); }
    while(curDate-date < ms);
}

let i = 0;

adresseCode.forEach(function (element) {
    const codePostal = element.querySelector('.code').innerText;
    const adresse = element.querySelector('.adresse').innerText;
    const id = element.querySelector('.id').innerText;
    const ville = element.querySelector('.ville').innerText;


    const url = `https://api-adresse.data.gouv.fr/search/?q=${adresse}+${ville}&postcode=${codePostal}&limit=1`;

    fetch(url, { mode: 'cors' })
        .then(function (response) {
            return response.json();
        })
        .then(function (profile) {
            console.log(profile);
        })
    if (i%2 == 0){
        pause(100);
    }
    if(i%50 == 0){
        pause(1000);
    }
    i++;
})



