$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});

function validateRecord() {
  // VALIDATION CODE HERE!
	if(document.getElementById('artist').value ==''){
		alert("You must include the artist's name");
		return false;
	} if(document.getElementById('albumTitle').value ==''){
		alert("You must include an album title");
		return false;
	} if(document.getElementById('genre').value ==''){
		alert("You must include a genre");
		return false;
	} if(document.getElementById('price').value ==''){
			alert("Please insert a valid price");
			return false;
	} if(document.getElementById('quality').value ==''){
			alert("You must specify used or new quality");
			return false;
}
}

function validateCart() {

}
