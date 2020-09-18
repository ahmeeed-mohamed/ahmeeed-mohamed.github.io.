
function check(){
    var m = document.getElementById("mail").value;
    var p = document.getElementById("phone").value;
    var fn = document.getElementById("fname").value;
    var ln = document.getElementById("lname").value;
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
}

