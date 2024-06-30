let icon_panier = document.querySelector(".panier-icon")
let btn_fermer = document.querySelector(".btn-fermer")
let panier = document.querySelector(".panier")
let prix_total = document.querySelector("total-valeur")

// ouverture panier
icon_panier.onclick = ()=>{
    panier.classList.add("active")
}
btn_fermer.onclick = ()=>{
    panier.classList.remove("active")
}

if(document.readyState =='loading'){
    document.addEventListener('DOMContentLoaded',fonctions)
}else{
    fonctions();
}
// déclarations des prototypes de toutes les fonctions
function fonctions(){
// la suppression d'un produit dans le panier
let btns_supprimer = document.querySelectorAll(".btn-supprimer")
for(var i=0; i < btns_supprimer.length;i++){
    var btn_supprimer = btns_supprimer[i]
    btn_supprimer.addEventListener('click',supprimer_produit)
}

//la modification de la quantité d'un produit dans le panier
let qtes = document.querySelectorAll(".qte-produit")
for(var i=0; i<qtes.length;i++){
   var  input_qte = qtes[i]
    input_qte.addEventListener('change',changement_qte)
}


}



// code de la fonction de suppression d'un produit
function supprimer_produit(event){
    var btn =event.target
    btn.parentElement.remove()
}

// la fonction de traitement du changement de la quantite
function changement_qte(event){
    var qte =event.target
    if(isNaN(qte.value) || (qte.value<1)){
        qte.value = 1;
    }
}

// fonction de calcul du prix total en fonction du nombre de produit et de leurs quantité
function MisAJourPrix(){
    var contenu_panier = document.querySelector(".contenu-panier")
    var produits = contenu_panier.querySelectorAll(".produits")

    for(var i=0;i<produits.length;i++){
        var produit = produits[i]

        var prix = produit.querySelector("prix-produit")
        prix = parseFloat(prix.innerText[0].replace("GNF",))
    }
    console.log(contenu_panier);
}