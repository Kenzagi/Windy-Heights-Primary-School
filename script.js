
// DOWNLOADING APPLICATION FORM;
const applyBtn = document.getElementById('apply');
apply.addEventListener('click', (event) => {
    // getting the text content that we want to copy
    // const content = document.getElementById('email').textContent;
    // loading the content into our clipboard
    // navigator.clipboard.writeText(content);
	
	popup.classList.add("downloading");
	setTimeout(() => {
		popup.classList.remove("downloading");
	}, 8000);
})


////////////////////////////////////////////////////////////////////////////////////////////////

// GALLERY CODE;

// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption

var modalImg = document.getElementById("image1");
var captionText = document.getElementById("caption");


var imageThumbs = document.getElementById("thumb-wrapper");
var currentImage = document.getElementById("myImg");
for (var i = 1; i <= 30; i++) {
	let thumb = document.createElement('img');
	thumb.src = "images/Gallery/" + i + ".jpg";
	
	thumb.alt = "Image " + i;
	thumb.id = 'myImg';
	thumb.classList.add("thumb");
	imageThumbs.appendChild(thumb);
	console.log(thumb);
	
	thumb.addEventListener(
  "click", function() {
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
  });
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}

////////////////////////////////////////////////////////////////////////////////////////////////

function closeSidebar(){
	const sidebar= document.querySelector('.sidebar');
	sidebar.style.display = 'none';
}

function showSidebar(){
	const sidebar= document.querySelector('.sidebar');
	sidebar.style.display = 'flex';
}