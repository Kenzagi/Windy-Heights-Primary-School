
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


// GALLERY CODE;

var imageThumbs = document.getElementById("image-thumbs");
var currentImage = document.getElementById("current-image");

for (var i = 1; i <= 105; i++) {
	var thumb = document.createElement("img");
	thumb.src = "images/Gallery/" + i + ".jpg";
	thumb.alt = "Image " + i;
	thumb.classList.add("thumb");
	imageThumbs.appendChild(thumb);
	
	thumb.addEventListener(
  "click", function() {
	currentImage.src = this.src;
	currentImage.alt = this.alt;
  }
);
}

