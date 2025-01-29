document.getElementById("submitBtn").addEventListener("mouseover", function () {
    this.style.backgroundColor = "blue";
});

document.getElementById("submitBtn").addEventListener("mouseout", function () {
    this.style.backgroundColor = "lightgray";
});
//--------------------------------------------------------------------------------

const nameInput = document.getElementById("name");
const ageYes = document.getElementById("age-yes");
const ageNo = document.getElementById("age-no");

ageYes.addEventListener("click", function () {
    nameInput.style.borderColor = "green";
    nameInput.style.color = "green";
});

ageNo.addEventListener("click", function () {
    nameInput.style.borderColor = "red";
    nameInput.style.color = "red";
});
//--------------------------------------------------------------------------------

// Function to check if name is already being used for another application
function checkName() {
    const name = document.getElementById("name").value;

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "check_name.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = xhr.responseText;
            if (response === "taken") {
                alert("This name has already been used for an application.");
            }
        }
    };
    xhr.send("name=" + name);
}

nameInput.addEventListener("keyup", checkName);

//--------------------------------------------------------------------------------

// This allows the header of the appication to change according to the user's name
const nameInput1 = document.getElementById("name");
const header = document.querySelector(".content h1");

nameInput1.addEventListener("input", function () {
    const name = nameInput1.value.trim();
    if (name !== "") {
        header.textContent = `User Application - ${name}`;
    } else {
        header.textContent = "User Application";
    }
});
