
// DOWNLOADING APPLICATION FORM;
const applyBtn = document.getElementById('apply');
const popup = document.getElementById('popup');
function showBox(){
    // getting the text content that we want to copy
    // const content = document.getElementById('email').textContent;
    // loading the content into our clipboard
    // navigator.clipboard.writeText(content);
	console.log("33274623423462347246723");
	popup.classList.add("downloading");
	closeSidebar();
	setTimeout(() => {
		popup.classList.remove("downloading");
	}, 6000);
}


////////////////////////////////////////////////////////////////////////////////////////////////

// GALLERY CODE;

// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption

var modalImg = document.getElementById("image1");
var captionText = document.getElementById("caption");


var imageThumbs = document.getElementById("thumb-wrapper");
// var currentImage = document.getElementById("myImg");
for (var i = 1; i <= 127; i++) {
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
  // captionText.innerHTML = this.alt;
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



////////////////////////////////////////////////////////////////////////////////////////////////

function openCity(evt, period) {
  var i, x, tablinks;
  x = document.getElementsByClassName("year");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active-tab", "");
  }
  document.getElementById(period).style.display = "flex";
  evt.currentTarget.className += " active-tab";
}