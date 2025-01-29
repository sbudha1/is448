//Shanti. Ajax and javascript code.

"use strict";

window.onload = pageLoad;

function pageLoad() {
  var submitB = document.getElementById("submitB");
  submitB.style.color = 'blue';
  var radioButtons = document.getElementsByName("timing");
  for (var i = 0; i < radioButtons.length; i++) {
    radioButtons[i].onclick = validateSelect;
  }
}


function setColor(submitB) {
  if (submitB.style.color === 'blue') {
    submitB.style.color = 'red';
    submitB.style.border = '2px solid black';
  } else {
    submitB.style.color = 'blue';
    submitB.style.border = '2px solid yellow';
  }
}


function validateSelect(event){
  var submitB = document.getElementById("submitB");
  setColor(submitB);
  var selectedTime = slot();
  if (!selectedTime) {
    alert("Please book a slot.");
  }
}

function validateSubmit(event) {
  
  var selectedTime = slot();

  if (!selectedTime) {
    alert("Please book a slot.");
    return false;
  }

  new Ajax.Request(
    "book_meeting.php",
    {
      method: "post",
      parameters: { timing: selectedTime },
      onSuccess: displayResult,
      onFailure: function(){
        alert("Ajax error");
      }
    }
  );
}

function slot() {
  var timeSlots = document.getElementsByName("timing");
  for (var i = 0; i < timeSlots.length; i++) {
    if (timeSlots[i].checked) {
      alert("You have selected: " + timeSlots[i].value);
      return timeSlots[i].value;
    }
  }
  return;
}

function displayResult(ajax) {
  var r = ajax.responseText;
  var msgbox = document.getElementById('msgbox');

  msgbox.innerHTML = r;
  msgbox.style.fontSize = "15px";

  if (r.includes('Appointment booked successfully!')) {
    msgbox.style.backgroundColor = "green";
    msgbox.style.color = "pink";
    
   
  } else {
    msgbox.style.backgroundColor = "red";
    msgbox.style.color = "white";
    msgbox.focus();
  }
}