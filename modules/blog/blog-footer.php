<div class="card-footer">
    <div class="blog-title fw-semibold fs-5">
        <?php echo $title ?>
    </div>
    <div class="holded-text text-secondary">
        Description
    </div>
    <p class="blog-description-content mt-1" style="text-align: justify" id="blog-description<?php echo $unique_identifier; ?>">
        <?php echo $description; ?> 
        <!-- <button class="border-0 text-bg-light mx-1" id="read-more-btn" style="display:none"><u>Read More</u></button> -->
    </p>

    <script>
        var blogDescription = document.getElementById('blog-description<?php echo $unique_identifier; ?>');
        
        var paragraphText = blogDescription.textContent.trim();
        var maxLength = 150;

        if (paragraphText.length > maxLength) {
            var shortText = paragraphText.substring(0, maxLength);
            var remainingText = paragraphText.substring(maxLength);
            
            blogDescription.innerHTML = shortText + '<span id="remaining-text<?php echo $unique_identifier; ?>" style="display:none;">' + remainingText + '</span>' + ' <button class="border-0 bg-light  text-primary mx-1" onclick="toggleText(\'<?php echo $unique_identifier; ?>\')" id="read-more-btn<?php echo $unique_identifier; ?>" style="text-decoration:underline;font-weight:500;background:transparent !important;">Read More</button>';
            
            function toggleText(unique_identifier) {
                var remainingTextSpan = document.getElementById('remaining-text' + unique_identifier);
                var readMoreBtn = document.getElementById('read-more-btn' + unique_identifier);
                console.log(readMoreBtn);
                if (readMoreBtn.innerHTML == "Read More") {
                    remainingTextSpan.style.display = 'inline';
                    readMoreBtn.innerHTML = 'Read Less';
                } else {
                    remainingTextSpan.style.display = 'none';
                    readMoreBtn.innerHTML = 'Read More';
                }
            }
        }
    </script>

    <div class="blog-detail">
        <i class="text-secondary" style="font-size:14px">Posted on <?php echo date('F d, Y', strtotime($release_date)); ?> by Bhavesh Parmar </i>
    </div>

    </div>