"use strict";
//Author: Katelyn Atkinson
//Use case: 2 animal search/filter
window.onload=pageLoad;
function pageLoad(){
	document.getElementById("reset").onclick = changeColor;
	document.getElementById("pick").onclick = pickAnimal;
	document.getElementById("searchForm").onsubmit=validateForm;
}
function changeColor(){
	var ele = document.getElementById("reset");
	ele.style.color = "red"
}
function pickAnimal(){
	new Ajax.Request( "pick.php", 
    { 
        method: "get", 
        parameters: {},
        onSuccess: showAjax
    } );
}
function showAjax(ajax){
	document.getElementById("pickArea").innerHTML=ajax.responseText;
}
function validateForm() {
	var animal = document.getElementById("animalType").value;
	var ele = document.getElementById("submit");
	ele.style.color = "orange";
	
	var selected;
    var all = document.getElementsByName("age");
    var i;
    for (i = 0; i < all.length; i++) {
        if (all[i].checked) {
            selected = all[i].value;
        }
    }
	switch (selected) {
    case "any":
		break;
    case "young":
		break; 
    case "adult":
		break;    
    case "senior":
		break; 
    default:
		alert("Please select an option for each field");
		return false;
		break;
	}
  
  	var selected1;
    var all1 = document.getElementsByName("hairType");
    var j;
    for (j = 0; j < all1.length; j++) {
        if (all1[j].checked) {
            selected1 = all1[j].value;
        }
    }
	if((animal == "Dog" || animal == "Cat") && (selected1 == "other")){
		alert("No animals found with selected hair type");
		return false;
	}else if((animal == "Bird" || animal == "Horse" || animal == "Fish") && (selected1 == "long" || selected1 == "short")){
		alert("No animals found with selected hair type");
		return false;
	}else{
	switch (selected1) {
    case "any":
		break;
    case "long":
		break;
    case "short":
		break;
    case "other":
		break; 
    default:
		alert("Please select an option for each field");
		return false;
		break;
	}}
	
	var selected2;
    var all2 = document.getElementsByName("size");
    var k;
    for (k = 0; k < all2.length; k++) {
        if (all2[k].checked) {
            selected2 = all2[k].value;
        }
    }
	switch (selected2) {
    case "any":
		break;
    case "large":
		break; 
    case "medium":
		break;    
    case "small":
		break; 
    default:
		alert("Please select an option for each field");
		return false;
		break;
	}
}