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


////////////////////////         GALLERY PAGE INTERACTION CODE         //////////////////////////////////

var modal = document.getElementById("myModal");
var modalImg = document.getElementById("image1");
var captionText = document.getElementById("caption");
var imageThumbs = document.getElementById("thumb-wrapper");

var zoomInButton = document.getElementById("zoom-in");
    var zoomOutButton = document.getElementById("zoom-out");

    var scale = 1; // Initial scale

    function zoomIn() {
        scale += 0.1; // Increase scale
        modalImg.style.transform = `scale(${scale})`;
    }

    function zoomOut() {
        scale = Math.max(1, scale - 0.1); // Decrease scale, ensuring it doesn't go below 1
        modalImg.style.transform = `scale(${scale})`;
    }

    // Attach zoom functions to buttons
    if (zoomInButton) {
        zoomInButton.addEventListener('click', zoomIn);
    }
    if (zoomOutButton) {
        zoomOutButton.addEventListener('click', zoomOut);
    }
// Function to check if an image exists
function imageExists(image_url) {
    var http = new XMLHttpRequest();
    http.open('HEAD', image_url, false);
    http.send();
    return http.status != 404;
}

var i = 1;
while (true) {
    var imgSrc = "images/Gallery/" + i + ".jpg";
    if (!imageExists(imgSrc)) {
        break;
    }
	
    let thumb = document.createElement('img');
    thumb.src = imgSrc;
    thumb.alt = "Image " + i;
    thumb.classList.add("thumb");
    imageThumbs.appendChild(thumb);

    thumb.addEventListener("click", function () {
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    });

    i++;
}

// Close the modal when the user clicks on <span> (x)
var span = document.getElementsByClassName("close")[0];
span.onclick = function() {
    modal.style.display = "none";
}
////////////////////////         SIDEBAR MENU CODE         //////////////////////////////////

function closeSidebar(){
	const sidebar= document.querySelector('.sidebar');
	sidebar.style.display = 'none';
}

function showSidebar(){
	const sidebar= document.querySelector('.sidebar');
	sidebar.style.display = 'flex';
}



////////////////////////         NEWSLETTER PAGE CODE         //////////////////////////////////

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

document.getElementById('navbar-toggler').addEventListener('click', function () {
  const navbarNav = document.getElementById('navbarNav');
  navbarNav.classList.toggle('open');
});


////////////////////////////////////////////////////////////////////////////////////////////////

