$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();

    $(window).scroll(function () {

    console.log($(window).scrollTop());

    if ($(window).scrollTop() > 218) {
      $('#mynav').addClass('navbar-fixed-top');
    }

    if ($(window).scrollTop() < 219) {
      $('#mynav').removeClass('navbar-fixed-top');
    }
    });

    setTimeout(function(){
      $('.alert-danger').remove();
      $('.alert-success').remove();
    }, 2000);
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

function getCartData(){
  var itemNum = document.getElementsByName('remove');
  var itemQuant = document.getElementsByName('quantity');
  console.log(itemNum[0].value);
  console.log(itemQuant[0].value);
  /*$.post('cart.php', {itemId:itemNum,itemQuantity:itemQuant},//posts itemId and itemQuantity
  function(data){
    $('#result').html(data);
  });*/
}
