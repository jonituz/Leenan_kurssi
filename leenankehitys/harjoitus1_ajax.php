<!doctype html>
<html>
<head>

<script>
var pyynto;

function alusta_pyynto() {
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
      pyynto=new XMLHttpRequest();
    }
    else {// code for IE6, IE5
      pyynto=new ActiveXObject("Microsoft.XMLHTTP");
    }
}

function kasittele_vastaus() { //tämä funktio käsittelee vastauksen
    if (pyynto.readyState==4 && pyynto.status==200){
        var pelaajat = JSON.parse(pyynto.responseText);
        naytaTaulukko(pelaajat);
    }
}


function suorita_pyynto()
{
    alusta_pyynto();
    pyynto.onreadystatechange = kasittele_vastaus;
    var ktunnus=document.getElementById("ktunnus").value;
    pyynto.open("GET","harjoitus1_ajax_yhteys.php?ktunnus="+ktunnus,true); //pyyntö php-tiedostolle, muuttuja kysymysmerkkijonossa (GET)
    pyynto.send(); //lähetetään pyyntö palvelimelle
}


function naytaTaulukko(pelaajat){
    var taulukko=[];
    for (var i = 0; i < pelaajat.length; i++) {
        for (var avain in pelaajat[i]) {
            if (taulukko.indexOf(avain) === -1) {
                taulukko.push(avain);
            }
        }
    }
    
    var table = document.createElement("table");
    
    for(var i = 0; i < pelaajat.length; i++){
        
        tr = table.insertRow(-1); //lisää rivin taulukon loppuun
            
        for(var j = 0; j < taulukko.length; j++) {
        
            var tabCell = tr.insertCell(-1); //lisää solun rivin loppuun
            tabCell.innerHTML = pelaajat[i][taulukko[j]];
        }
    }
    
    var sisaltodiv = document.getElementById("naytadata");
    sisaltodiv.innerHTML = "",
    sisaltodiv.appendChild(table);
}
 </script>
</head>
<body>
<select id="ktunnus">
  <option value="jalosteet">Jalosteet</option>
  <option value="juomat">Juomat</option>
  <option value="kalatuotteet">Kalatuotteet</option>
  <option value="lihatuotteet">Lihatuotteet</option>
  <option value="maitotuotteet">Maitotuotteet</option>
  <option value="makeiset">Makeiset</option>
  <option value="mausteet">Mausteet</option>  
  <option value="viljatuotteet">Viljatuotteet</option>  
</select>
<input type="button" onclick="suorita_pyynto()" value="Valitse">
<div id="naytadata"></div>

</body>