var imagePreview;
var imageSelect;

window.onload = function() {
	imagePreview = document.getElementById("uploadPreview");
	imageSelect = document.getElementById("imageSelect");
	imageSelect.addEventListener('change', updatePreview);
};


function updatePreview(){
	if(imageSelect.files.length > 0){
		imagePreview.src = URL.createObjectURL(imageSelect.files[0]);
		imagePreview.classList.remove("hidden");
	}else{
        imagePreview.src = "";
		//imagePreview.classList.add("hidden");
	}
}