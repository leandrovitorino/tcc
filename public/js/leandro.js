$(document).ready(function () {
    let CPF = $("[data-id='document']");
    CPF.mask('000.000.000-00', {reverse: false});

    let CEL = $("[data-id='cellphone']");
    CEL.mask('(00) 00000-0000', {reverse: false});
});

function mostraCampo(obj) {
    var lbl = document.getElementById("l_food");
    lbl.style.visibility = "visible";

    var txt = document.getElementById("food");
    txt.style.visibility = "visible";
    txt.setAttribute('required', 'required');
}

function escondeCampo(obj) {
    var lbl = document.getElementById("l_food");
    lbl.style.visibility = "hidden";

    var txt = document.getElementById("food");
    txt.style.visibility = "hidden";
    txt.removeAttribute('required');
}
