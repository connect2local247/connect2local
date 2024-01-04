var message = document.getElementById('message');

setTimeout(() => {
    // Apply fade-out effect
    message.style.transition = "opacity 1.5s linear";
    message.style.opacity = "0";

    // Hide the element after the animation completes
    setTimeout(() => {
        message.classList.add("d-none");
    }, 1500);

    // Unset the session message
}, 4000);