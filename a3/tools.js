var collapse = document.getElementsByClassName("collapsible");
var i;
for (i = 0; i < collapse.length; i++) {
    collapse[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var content = this.nextElementSibling;
        if (content.style.maxHeight){
            content.style.maxHeight = null;
        } else {
            content.style.maxHeight = content.scrollHeight + "px";
        } 
    });
}

function validateForm() {
    clearErrors();
    var countErrors=0;
    if (!nameCheck()) {
        countErrors++;
    }  
    if (!passwordCheck()) {
        countErrors++;
    }  
    if (!emailCheck()) {
        countErrors++;
    } 
    if (!mobileCheck()) {
        countErrors++;
    }
    return (countErrors==0);
}

function clearErrors() {
    var allErrors = document.getElementsByClassName('error');
    for (var i = 0; i < allErrors.length; i++) {
        allErrors[i].innerHTML = "";
    }
    var allInputs = document.getElementsByTagName('input');
    for (i = 0; i < allInputs.length; i++) {
    }
}

function nameCheck() {
    var name=document.getElementById('name').value;
    var patt = /^[a-zA-Z \']+$/;
    if (patt.test(name)) {
        return true;
    } else {
        document.getElementById('errorName').innerHTML="Alphabetical characters and spaces only";
        return false;
    }
}

function passwordCheck() {
    var password=document.getElementById('password').value;
    var patt = /^[a-zA-Z0-9]+$/;
    if (patt.test(password)) {
        return true;
    } else {
        document.getElementById('errorPassword').innerHTML="Password may only include letters and numbers";
        return false;
    }
}

function emailCheck() {
    var email=document.getElementById('email').value;
    var patt = /^[a-zA-Z0-9_#-.]+@[a-zA-Z0-9#-.]+$/;
    if (patt.test(email)) {
        return true;
    } else {
        document.getElementById('errorEmail').innerHTML="Please enter a valid email";
        return false;
    }
}

function mobileCheck() {
    var mobile=document.getElementById('mobile').value;
    var patt = /^04[0-9]{8}$/;
    if (patt.test(mobile) || mobile =="") {
        return true;
    } else {
        document.getElementById('errorMobile').innerHTML="Mobile numbers must be Australian (numbers only)";
        return false;
    }
}

/*function store(key, value) {
    if (typeof(Storage) !== "undefined") {
        localStorage.setItem(key, value);
    }
}

function retrieve(key) {
    if (typeof(Storage) !== "undefined") {
        return localStorage.getItem(key).value;
    }
}*/