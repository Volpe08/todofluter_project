fetch = require('isomorphic-fetch');
let url = 'https://lpinfo.io/json';

async function getInfo(url){
    const response = await fetch(url);
    return response.json();
}

(async function main(){
    let lpinfo = await getInfo(url);
    console.log(lpinfo);
})();