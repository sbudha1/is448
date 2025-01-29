"use strict";

window.onload=pageLoad;

function pageLoad() {
    document.getElementById("submit").onclick = validateForm;
    document.getElementById("submit").onmouseover = changeColor;
	document.getElementById("submit").onmouseout = changeColor;
}

function validateForm() {
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;

    if (!email || !password) {
        alert('Please fill out all fields.');
        return false;
    }

    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert('Please enter a valid email address.');
        return false;
    }
    return true; 
}

function changeColor()
{
  var dom=document.getElementById("submit");

  if(event.type == "mouseover"){
     dom.style.color='blue';
     dom.style.fontWeight='bold';
  }
  else {
     dom.style.color='black';
     dom.style.fontWeight='normal';
  }

}