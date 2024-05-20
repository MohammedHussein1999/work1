// Function to set the background color of the page
function start() {
    // Prompt the user to enter a color
    var inputColor = prompt("Please enter a color for the background of the page", "Website prefers to choose this color (#eee) or choose your favorite color");

    // Set the background color of the page
    document.body.setAttribute("style", "background-color:" + inputColor);
}

// Event listener to call the start function when the page is loaded
window.addEventListener("load", start, false);