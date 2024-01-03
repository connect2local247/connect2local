var successModal = new bootstrap.Modal(document.getElementById('exampleModalToggle'));
var animation = document.getElementById('animation container');
var greetMessage = document.querySelector('#greet-message');
let modalBody = document.querySelector('.modal-body');

document.addEventListener("DOMContentLoaded", function () {
    successModal.show();

    setTimeout(function () {
        // spinner.style.display = 'none';
        modalBody.removeChild(animation);
        greetMessage.classList.remove('d-none');
    }, 2500); // Close the modal after 2.5 seconds (2500 milliseconds)

    setTimeout(function () {
        window.location.href = `${path}`;
        console.log(path);
    }, 5000); // Redirect after 5 seconds (5000 milliseconds)
});
