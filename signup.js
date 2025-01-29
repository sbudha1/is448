"use strict";

window.onload=pageLoad;

function pageLoad() {
    document.getElementById("submit").onclick = validateForm;
    document.getElementById("submit").onmouseover = changeColor;
	document.getElementById("submit").onmouseout = changeColor;
    document.getElementById("firstname").onkeyup=displayTime;
    }
     

    //js form validations
function validateForm() {
    var firstname = document.getElementById('firstname').value;
    var lastname = document.getElementById('lastname').value;
    var email = document.getElementById('email').value;
    var phone = document.getElementById('phone').value;
    var password = document.getElementById('password').value;

    if (!firstname || !lastname || !email || !phone || !password) {
        alert('Please fill out all fields.');
        return false;
    }

    var emailRegex = /^[\w]+@[a-zA-Z]+\.[a-zA-Z]{3}$/;
    if (!emailRegex.test(email)) {
        alert('Please enter a valid email address.');
        return false;
    }

    return true; 
}
//js css change feature
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
function displayTime(){
    new Ajax.Request(
        "getTime.php", // Change the URL to point to getTime.php
        { 
            method: "post", 
            onSuccess: showTime
        }
    );
}

function showTime(ajax) {
    var responseText = ajax.responseText;
    alert(responseText);
}