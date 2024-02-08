document.addEventListener("DOMContentLoaded", function () {
    var resendSecurityKey = document.getElementById("resendSecurityKey");
    var countdown = getRemainingTime() || 30;
    var resendTimeout;

    function updateResendSecurityKeyText() {
        resendSecurityKey.textContent = "Code Expires in " + countdown + " seconds";
    }

    function showResendSecurityKey() {
        resendSecurityKey.style.display = "inline";
        resendSecurityKey.textContent = "Resend Code";
        // Add event listener to trigger countdown when the resend link is clicked
        resendSecurityKey.addEventListener("click", resendSecurityKeyClickHandler);
    }

    function resendSecurityKeyClickHandler() {
        // Remove event listener to avoid multiple clicks during the countdown
        resendSecurityKey.removeEventListener("click", resendSecurityKeyClickHandler);
        // Reset the countdown and start it again
        resetCountdown();
        // Add the logic to resend the code here
        // For example, you can make an AJAX request or redirect to the resend code page
    }

    function startCountdown() {
        updateResendSecurityKeyText();
        clearTimeout(resendTimeout);

        function countdownTick() {
            countdown--;
            updateResendSecurityKeyText();
            if (countdown <= 0) {
                showResendSecurityKey();
            } else {
                setRemainingTime(countdown);
                resendTimeout = setTimeout(countdownTick, 1000); // 1 second
            }
        }

        countdownTick();
    }

    function resetCountdown() {
        setRemainingTime(30);
        startCountdown();
    }

    function getRemainingTime() {
        return parseInt(sessionStorage.getItem("remainingTime"));
    }

    function setRemainingTime(time) {
        sessionStorage.setItem("remainingTime", time);
    }

    // Initialize countdown
    startCountdown();

    // Add event listener to trigger countdown when the form is submitted
    document.querySelector("form").addEventListener("submit", function (event) {
        // No need to prevent default behavior here, allowing form submission
        resetCountdown(); // Restart the countdown after form submission
        // Add your form submission code here if needed
    });
});
