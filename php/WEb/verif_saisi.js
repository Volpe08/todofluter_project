
function Url_Valide(UrlTest,id) {
    var idurl= document.getElementById(id);
    idurl.innerHTML = '';

    var regexp = new RegExp("^((http|https)://){1}(www[.])?([a-zA-Z0-9]|-)+([.][a-zA-Z0-9(-|/|=|?)?]+)+$");
    if(UrlTest == "")
    {

    }else {
        if (regexp.test(UrlTest)) {
            alert('Mon URL est valide');
        } else {
            //alert ('Mon URL n\'est PAS valide');
            idurl.innerHTML = 'Mon URL n\'est PAS valide';
            idurl.style.color = 'red';
        }
    }
        return regexp.test(UrlTest);

}

function verif_number(number,id) {
    var idnumber = document.getElementById(id);
    idnumber.innerHTML = '';
    if(isNaN(number))
    {
        idnumber.innerHTML = 'Ce n\'est pas un nombre';
        idnumber.style.color = 'red';
        document.getElementById('valide').disabled = true;
    }else {
        document.getElementById('valide').disabled = false;

    }

}