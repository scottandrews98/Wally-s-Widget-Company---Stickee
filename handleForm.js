var form = document.getElementById("calculate");

// Checks to make sure that form exists on the DOM
if(form){
    document.getElementById("calculate").addEventListener("click", calculateWidgets);
}

function calculateWidgets(){
    event.preventDefault()
    let totalWidgets = document.getElementById("widgetsCount").value;
    let params = "widgets="+totalWidgets+"";

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            populatePage(JSON.parse(this.responseText))
        }
    };

    xhttp.open("POST", "widgetSorter.php", true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send(params);   
}

function populatePage(json){
    document.getElementById('widgetsResult').innerHTML = "";

    for(var i = 0; i < json.length; i++){
        var individualPackets = "<div>"+ json[i] +"</div>";
        document.getElementById('widgetsResult').innerHTML += individualPackets;
    }

}