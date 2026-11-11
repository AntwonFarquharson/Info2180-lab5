window.onload = function() {
    var lookupBtn = document.getElementById("lookup");
    var lookupCitiesBtn = document.getElementById("lookup-cities");
    var countryInput = document.getElementById("country");
    var resultDiv = document.getElementById("result");

    lookupBtn.addEventListener("click", function() {
        var country = countryInput.value;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                resultDiv.innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "world.php?country=" + country, true);
        xhttp.send();
    });

    lookupCitiesBtn.addEventListener("click", function() {
        var country = countryInput.value;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                resultDiv.innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "world.php?country=" + country + "&lookup=cities", true);
        xhttp.send();
    });
};