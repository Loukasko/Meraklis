function changeText() {
    let elem = document.getElementById("btn-sample");
    if (elem.innerHTML === "Ανενεργός") {
        elem.style.backgroundColor = "green";
        elem.innerHTML = "Ενεργός";
    }
    else {
        elem.innerHTML = "Ανενεργός";
        elem.style.backgroundColor="darkRed";
    }
}

function toggle_map(){
    let map=document.getElementById("map-div");
    if(map.style.display==='none'){
        map.style.display='block';
    }else{
        map.style.display='none';
    }
}
