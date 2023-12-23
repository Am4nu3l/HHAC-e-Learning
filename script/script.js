// Get references to the button and the centered div
const showButton = document.getElementById("showButton");
const centeredDiv = document.getElementById("centeredDiv");
const cancelbtn = document.getElementById("cancel");
// Add a click event listener to the button
showButton.addEventListener("click", () => {
    // Toggle the 'hidden' class on the centered div to show/hide it
    centeredDiv.classList.toggle("hidden");
});
cancelbtn.addEventListener("click",()=>{
 centeredDiv.classList.toggle("hidden");
});