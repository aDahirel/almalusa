// Get modal element
var modal = document.getElementById('simpleModal');
// Get open modal link
var modalLink = document.getElementById('modalLink');
// get close button
var closeBtn = document.getElementsByClassName('closeBtn')[0];
// Listen for open click
modalLink.addEventListener('click', openModal);
// Listen for close click
closeBtn.addEventListener('click', closeModal);
// Listen for  outside click
window.addEventListener('click', outsideClick);
// Function to open modal
function openModal(){
    modal.style.display = 'block';
}
// Function to close modal
function closeModal(){
    modal.style.display = 'none';
}
// Function to close modal if outside click
function outsideClick(e){
    if(e.target == modal){
        modal.style.display = 'none';
    }
}