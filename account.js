var updatingPassword = document.getElementById("passwordCheckbox");
var passwordField = document.getElementById("password");
var passwordConfirmField = document.getElementById("passwordConfirm");
var passwordRequirements = document.getElementById("passwordRequirements");
var personalFields = document.getElementById("fields");
var addressFields = document.getElementById("addressFields");
var lengthValidation = document.getElementById("validLength");
var lowerValidation = document.getElementById("validLower");
var upperValidation = document.getElementById("validUpper");
var numberValidation = document.getElementById("validNumber");
var specialValidation = document.getElementById("validSpecial");
var matchValidation = document.getElementById("validMatch");

updatingPassword.addEventListener("change", updateChecked);

passwordField.addEventListener("keyup", validatePassword);
passwordConfirmField.addEventListener("keyup", validatePassword);

function updateChecked(event){
	if(updatingPassword.checked){
		passwordField.disabled = false;
		passwordConfirmField.disabled = false;
		passwordRequirements.classList.remove("hidden");
		personalFields.classList.add("floatLeft");
		
		
	}else{
		passwordField.disabled = true;
		passwordConfirmField.disabled = true;
		passwordRequirements.classList.add("hidden");
		personalFields.classList.remove("floatLeft");
	}
}

function validatePassword(){
	var password = passwordField.value;
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
	if(password.localeCompare(passwordConfirmField.value) === 0 && password.length != 0){
		matchValidation.src = "images/valid.png";
	}else{
		matchValidation.src = "images/invalid.png";
		valid = false;
	}
	return valid;
}