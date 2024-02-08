<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Drawer</title>
    <!-- Add your CSS styles here -->
    <style>
        /* Styles for the drawer */
        .drawer {
            position: fixed;
            top: 0;
            right: 0;
            width: 300px;
            height: 100%;
            background-color: #f0f0f0;
            z-index: 1000;
            transition: transform 0.3s ease-in-out;
            transform: translateX(100%);
        }
        .drawer.open {
            transform: translateX(0);
        }
        .drawer ul {
            list-style: none;
            padding: 0;
        }
        .drawer ul li {
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }
        /* Styles for the share button */
        .share-button {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <!-- Share button to toggle the drawer -->
    <button class="share-button" onclick="toggleDrawer()">Share</button>

    <!-- Drawer content -->
    <div class="drawer" id="drawer">
        <ul>
            <li><a href="#" onclick="share()">Share Link</a></li>
            <li><a href="#" onclick="copyToClipboard()">Copy Link</a></li>
        </ul>
    </div>

    <!-- Your blog content goes here -->
    <p>This is your blog content.</p>

    <!-- Add your JavaScript here -->
    <script>
        // Function to toggle the drawer
        function toggleDrawer() {
            var drawer = document.getElementById('drawer');
            drawer.classList.toggle('open');
        }

        // Function to share using fallback method
        function share() {
            var url = window.location.href;
            // Fallback method (could be replaced with a custom share dialog)
            alert('Share this link: ' + url);
        }

        // Function to copy the link to the clipboard
        function copyToClipboard() {
            var dummy = document.createElement("input");
            document.body.appendChild(dummy);
            dummy.setAttribute('value', window.location.href);
            dummy.select();
            document.execCommand("copy");
            document.body.removeChild(dummy);
            alert("Link copied to clipboard!");
        }
    </script>
</body>
</html>
