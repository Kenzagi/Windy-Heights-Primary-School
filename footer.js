// footer.js
document.addEventListener("DOMContentLoaded", function () {
    fetch('footer.html') // Make sure the path to footer.html is correct relative to the HTML file
        .then(response => response.text())
        .then(data => {
            document.getElementById('footer').innerHTML = data;
        })
        .catch(error => console.error('Error loading footer:', error));
});
