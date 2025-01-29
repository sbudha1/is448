//Shanti. Ajax and javascript code.

"use strict";

window.onload = pageLoad;

function pageLoad() {
  var submitB = document.getElementById("submitB");
  submitB.style.color = 'blue';
  submitB.onclick = validateSubmit; 
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

function validateSubmit(event) {
  event.preventDefault(); 

  var submitB = document.getElementById("submitB");
  setColor(submitB);
  var selectedTime = slot();

  if (!selectedTime) {
    alert("Please book a slot.");
    return false;
  }

  new Ajax.Request(
    "book_meeting_ajax.php",
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
    
    // Confirm booking before submitting form
    if (confirm("Appointment booked successfully. Submit form?")) {
      document.getElementById("meetingForm").submit();
    }
  } else {
    msgbox.style.backgroundColor = "red";
    msgbox.style.color = "white";
    msgbox.focus();
  }
}