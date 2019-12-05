var createUserForm = document.getElementById("registrationForm");
var usernameInput = document.getElementById("username");
var passwordInput = document.getElementById("password");
var passwordConfirmInput = document.getElementById("passwordConfirm");
var lengthValidation = document.getElementById("validLength");
var lowerValidation = document.getElementById("validLower");
var upperValidation = document.getElementById("validUpper");
var numberValidation = document.getElementById("validNumber");
var specialValidation = document.getElementById("validSpecial");
var matchValidation = document.getElementById("validMatch");

passwordInput.addEventListener("keyup", validatePassword);
passwordConfirmInput.addEventListener("keyup", validatePassword);
createUserForm.onsubmit = function(){
	return validatePassword();
}

function validatePassword(){
	var password = passwordInput.value;
	var pattLower = /[a-z]/;
	var pattUpper = /[A-Z]/;
	var pattNum = /[0-9]/;
	var pattSpecial = /[^A-z|0-9]/;
	var valid = true;
	
	// check password length
	if(password.length >= 8){
		lengthValidation.src = "images/valid.png";
	}else{
		lengthValidation.src = "images/invalid.png";
		valid = false;
	}
	
	// check password has lowercase
	if(pattLower.test(password)){
		lowerValidation.src = "images/valid.png";
	}else{
		lowerValidation.src = "images/invalid.png";
		valid = false;
	}
	
	//check password has uppercase
	if(pattUpper.test(password)){
		upperValidation.src = "images/valid.png";
	}else{
		upperValidation.src = "images/invalid.png";
		valid = false;
	}
	
	//check password has number
	if(pattNum.test(password)){
		numberValidation.src = "images/valid.png";
	}else{
		numberValidation.src = "images/invalid.png";
		valid = false;
	}
	
	// check password has special character
	if(pattSpecial.test(password)){
		specialValidation.src = "images/valid.png";
	}else{
		specialValidation.src = "images/invalid.png";
		valid = false;
	}
	
	// check if passwords match
	if(password.localeCompare(passwordConfirmInput.value) === 0 && password.length != 0){
		matchValidation.src = "images/valid.png";
	}else{
		matchValidation.src = "images/invalid.png";
		valid = false;
	}
	return valid;
}