function log(message) {
    return console.log(message);
}

function hideShow() {
    var e = document.getElementsByClassName("menu-box");
    e[0].classList.toggle("hide-show");
    var e2 = document.getElementsByClassName("icon-arrow-down");
    e2[0].classList.toggle("rotate180");
}

function validarImagenClave(ev){

    if(!validarRatio("imagen")){ev.preventDefault();alert("Debes seleccionar una imagen");return;}
    if(!validarSelect("palabra")){ev.preventDefault();alert("Debes seleccionar una palabra clave");return;}
    if(!validarChek("privacidad")){ev.preventDefault();alert("Debes aceptar las politicas de privacidad");return;}
}

function validarChek(name) {
    let e =  document.getElementsByName(name)[0];
//
    return e.checked;
}

function validarRatio(name) {

    let e =  document.getElementsByName(name);

    for (let i = 0; i < e.length; i++) {
        if (e[i].checked) {
           // alert("Selected Value = " + e[i].value);
            return true; // checked
        }
    };

       return false;
}

function validarSelect(name) {

    let e =  document.getElementsByName(name)[0];
    //alert("Selected Value 2 = " +e.options[e.selectedIndex].value);
    if(e.options[e.selectedIndex].value!=""){
        return true;
    }
    return false;
}

function getPalabra(){
    let e =  document.getElementsByName(name)[0];
    return e.options[e.selectedIndex].value;
}

function getCodigoImagen(){
    let e =  document.getElementsByName(name);

    for (let i = 0; i < e.length; i++) {
        if (e[i].checked) {
            return e[i].value;
        }
    };
}

// Tabs

function showPorfolio() {
    $("#nav-profile-porfolio").show();
    $("#nav-profile-datos").hide();
    $("#nav-tab-p").addClass('active')
    $("#nav-tab-h").removeClass('active')
}

function showDatos() {
    $("#nav-profile-porfolio").hide();
    $("#nav-profile-datos").show();
    $("#nav-tab-h").addClass('active');
    $("#nav-tab-p").removeClass('active')

}

