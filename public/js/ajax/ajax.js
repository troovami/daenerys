/****Imagenes****/
function botonCropVisible(valor){
	
	id = "btnCrop-" + valor;	
	var boton =  document.getElementById(id);
    boton.style.display="inline"; 	
    boton.style.position="relative";
    
    for (x = 0; x <6;x++){
    	
    	if (x != valor){
    		
    		botonCropHidden(x)
    	}
    }
}

function botonCropHidden(valor){
	id = "btnCrop-" + valor;	
	var boton =  document.getElementById(id);
    boton.style.display="none"; 	
    boton.style.position="absolute";
}

function popupVisible(){
	document.getElementById('popup').style.visibility="visible"; 
}

function popupHidden(){
	document.getElementById('popup').style.visibility="visible"; 
	var status = document.getElementById('popup').style.visibility="hidden";  
    botonCropHidden('0');botonCropHidden('1');botonCropHidden('2');
    botonCropHidden('3');botonCropHidden('4');botonCropHidden('5'); 
}

// Popup Visible  + Boton Visible
/*
document.querySelector('.cropped-0').addEventListener("click", function() {	popupVisible(); botonCropVisible('0'); })
document.querySelector('.cropped-1').addEventListener("click", function() {	popupVisible(); botonCropVisible('1'); })
document.querySelector('.cropped-2').addEventListener("click", function() {	popupVisible(); botonCropVisible('2'); })
document.querySelector('.cropped-3').addEventListener("click", function() {	popupVisible(); botonCropVisible('3'); })
document.querySelector('.cropped-4').addEventListener("click", function() {	popupVisible(); botonCropVisible('4'); })
document.querySelector('.cropped-5').addEventListener("click", function() {	popupVisible(); botonCropVisible('5'); })
// Popup Hidden  + Boton Hidden
document.querySelector('.close').addEventListener("click", function() { popupHidden();})
*/
/////////////////////////////////////////////////////////////////////////////// 

function ImagenesGaleria() {
	
	//alert('editando')
	
    var options =
    {
        imageBox: '.imageBox',
        thumbBox: '.thumbBox',
        spinner: '.spinner',
        imgSrc: 'avatar1.png'
    }
    var cropper = new cropbox(options);
    
    function croppedImage(valor){	
		var clase = ".cropped-" + valor;		
		var img = cropper.getDataURL();
		var tagImage = '<img class="img-responsive" src="'+img+'">';
		//var nameInputHidden = 'blb_img' + valor;
		var nameInputHidden = 'blb_img';
		var inputHiddenImage = '<input type="hidden" id="'+ nameInputHidden +'" name="'+ nameInputHidden +'" value="'+img+'">';
    	document.querySelector(clase).innerHTML = tagImage+inputHiddenImage;
    	popupHidden(); 
	}

    document.querySelector('#file').addEventListener('change', function(){
        var reader = new FileReader();
        reader.onload = function(e) {
            options.imgSrc = e.target.result;
            cropper = new cropbox(options);
        }
        reader.readAsDataURL(this.files[0]);
        this.files = [];
    })        
    document.querySelector('#btnCrop-0').addEventListener('click', function(){ croppedImage('0');document.getElementById('file').value = "" })
    document.querySelector('#btnCrop-1').addEventListener('click', function(){ croppedImage('1');document.getElementById('file').value = "" })
    document.querySelector('#btnCrop-2').addEventListener('click', function(){ croppedImage('2');document.getElementById('file').value = "" })
    document.querySelector('#btnCrop-3').addEventListener('click', function(){ croppedImage('3'); })
    document.querySelector('#btnCrop-4').addEventListener('click', function(){ croppedImage('4'); })
    document.querySelector('#btnCrop-5').addEventListener('click', function(){ croppedImage('5'); })

    // Maximizar
    document.querySelector('#btnZoomIn').addEventListener('click', function(){
        cropper.zoomIn();
    })
    // Minimizar
    document.querySelector('#btnZoomOut').addEventListener('click', function(){
        cropper.zoomOut();
    })
};  

