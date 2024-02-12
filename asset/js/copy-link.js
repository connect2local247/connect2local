document.addEventListener('DOMContentLoaded', function () {
  // Initialize Clipboard.js
  new ClipboardJS('.copy-link');
  var copy_links = document.querySelectorAll('.copy-link');
  var copyNotification = document.getElementById('copyNotification');

  for (var i = 0; i < copy_links.length; i++) {
      copy_links[i].addEventListener('click', function () {
          // Reset all links to black
          for (var j = 0; j < copy_links.length; j++) {
              copy_links[j].style.color = 'black';
          }

          // Set the clicked link to blue
          this.style.color = 'royalblue';

          // Copy the link to the clipboard
          var textToCopy = this.getAttribute('data-clipboard-text');
      });
  }
});