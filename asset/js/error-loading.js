const loading = document.getElementById('loading');
const errorMessage = document.getElementById('error-message');
const closeErrorPrompt = document.getElementById('close-mark');

closeErrorPrompt.addEventListener('click', function () {
    errorMessage.classList.add('hidden');
})

const decreaseWidth = () => {
    loading.style.width = (parseFloat(loading.style.width) - 1) + "%";

    if (parseFloat(loading.style.width) <= 0) {
        clearInterval(intervalId);

        // Apply smooth transition to hide the error message
        errorMessage.classList.add('hidden');
    }
};

const intervalId = setInterval(decreaseWidth, 35);
