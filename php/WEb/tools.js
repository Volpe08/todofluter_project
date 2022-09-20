const queryString = window.location.search;

const urlParams = new URLSearchParams(queryString);

const prenom = urlParams.get('prenom')
const nom = urlParams.get('nom')

document.getElementById('prenom').value = prenom;
document.getElementById('nom').value = nom;
