var form = document.getElementById("form");

// Checks to make sure that form exists on the DOM
if(form){
    document.getElementById("calculate").addEventListener("click", calculateWidgets);
}

function calculateWidgets(){
    let totalWidgets = document.getElementById("widgetsCount").value();
    let params = "widgets="+totalWidgets+"";

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
        }
    };

    xhttp.open("POST", "widgetSorter.php", true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send(params);   
}
