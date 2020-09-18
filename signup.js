
function check(form){
    var m = document.getElementById("mail").value;
    var p = document.getElementById("phone").value;
    var fn = document.getElementById("fname").value;
    var ln = document.getElementById("lname").value;
    var myInput = document.getElementById("psw");
    var letter = document.getElementById("letter");
    var capital = document.getElementById("capital");
    var number = document.getElementById("number");
    var length = document.getElementById("length");
    var count = 0;
    var invalid="Your ";
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(m))
    {

    }
    else{
        invalid += " email";
        count++;
    }

    if(/^\+?([0-9]{3})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/.test(p))
    {
    }
    else{
        if (count != 0)
            invalid += " , phone number";
        else
            invalid += " phone number";
        count++;
    }
    if((/^[a-zA-Z]+$/.test(fn))){

    }
    else{
        if(count!=0)
            invalid+=" , first name";
        else
            invalid+=" first name";
        count++;
    }if((/^[a-zA-Z]+$/.test(ln))){

    }
    else{
        if(count!=0)
            invalid+=" , last name";
        else
            invalid+=" last name";
        count++;
    }
    if (count != 0){
        if (count > 1)
            invalid += " are invalid. please check if you entered them correctly";
        else
            invalid += " is invalid. please check if you entered it correctly";
        alert(invalid);
        event.preventDefault();

    }
    else{
        alert("Your changes has been done successfully");
    }


    // When the user clicks on the password field, show the message box
    myInput.onfocus = function() {
        document.getElementById("message").style.display = "block";
    }

    // When the user clicks outside of the password field, hide the message box
    myInput.onblur = function() {
        document.getElementById("message").style.display = "none";
    }

    // When the user starts to type something inside the password field
    myInput.onkeyup = function() {
        // Validate lowercase letters
        var lowerCaseLetters = /[a-z]/g;
        if (myInput.value.match(lowerCaseLetters)) {
            letter.classList.remove("invalid");
            letter.classList.add("valid");
        } else {
            letter.classList.remove("valid");
            letter.classList.add("invalid");
        }

        // Validate capital letters
        var upperCaseLetters = /[A-Z]/g;
        if (myInput.value.match(upperCaseLetters)) {
            capital.classList.remove("invalid");
            capital.classList.add("valid");
        } else {
            capital.classList.remove("valid");
            capital.classList.add("invalid");
        }

        // Validate numbers
        var numbers = /[0-9]/g;
        if (myInput.value.match(numbers)) {
            number.classList.remove("invalid");
            number.classList.add("valid");
        } else {
            number.classList.remove("valid");
            number.classList.add("invalid");
        }

        // Validate length
        if (myInput.value.length >= 8) {
            length.classList.remove("invalid");
            length.classList.add("valid");
        } else {
            length.classList.remove("valid");
            length.classList.add("invalid");
        }
        event.preventDefault();
    }
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (!re.test(form.email.value)) {
            alert("Error:email is not correct");
            form.email.focus();
            return false;
        }if (form.psw.value == "") {
            alert("Error: password cannot be blank!");
            form.psw.focus();
            return false;
        }if (form.email.value == "") {
            alert("Error: Username cannot be blank!");
            form.email.focus();
            return false;
        }
    }


