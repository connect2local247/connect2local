var blogDescription = document.getElementById('blog-description');
        
        var paragraphText = blogDescription.textContent.trim();
        var maxLength = 150;

        if (paragraphText.length > maxLength) {
            var shortText = paragraphText.substring(0, maxLength);
            var remainingText = paragraphText.substring(maxLength);
            
            blogDescription.innerHTML = shortText + '<span id="remaining-text" style="display:none;">' + remainingText + '</span>' + ' <button class="border-0 bg-light  text-primary mx-1" onclick="toggleText()" id="read-more-btn" style="text-decoration:underline;font-weight:500">Read More</button>';
            
            function toggleText() {
                var remainingTextSpan = document.getElementById('remaining-text');
                var readMoreBtn = document.getElementById('read-more-btn');
                
                if (remainingTextSpan.style.display === 'none') {
                    remainingTextSpan.style.display = 'inline';
                    readMoreBtn.innerHTML = 'Read Less';
                } else {
                    remainingTextSpan.style.display = 'none';
                    readMoreBtn.innerHTML = 'Read More';
                }
            }
        }