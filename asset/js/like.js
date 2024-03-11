// JavaScript (like.js)
// JavaScript (like.js)
window.addEventListener('load', function() {
    // Fetch and update like status and count for all blog posts
    let blogPosts = document.querySelectorAll('.blog-post');
    blogPosts.forEach(function(blogPost) {
        let blogId = blogPost.getAttribute('data-blog-id');
        getLikeStatus(blogId);
        updateLikeCount(blogId);
    });
});

function getLikeStatus(blogId) {
    let xhr = new XMLHttpRequest();
    xhr.open('POST', '/modules/blog/like_handler.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            let response = JSON.parse(xhr.responseText);
            if (response.success) {
                let likeIcon = document.getElementById('like-icon-' + blogId);
                let liked = response.liked;

                // Update like button appearance based on like status
                if (liked) {
                    likeIcon.classList.remove('fa-regular');
                    likeIcon.classList.add('fa-solid', 'fa-heart', 'text-primary');
                } else {
                    likeIcon.classList.remove('fa-solid', 'fa-heart', 'text-primary');
                    likeIcon.classList.add('fa-regular');
                }
            }
        }
    };
    let params = 'blog_id=' + blogId;
    xhr.send(params);
}

function updateLikeCount(blogId) {
    let likeCountElement = document.getElementById('like-count-' + blogId);
    let xhr = new XMLHttpRequest();
    xhr.open('POST', '/modules/blog/get_like_count.php', true); // Create a new PHP file to fetch like count for the blog post
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            let response = JSON.parse(xhr.responseText);
            if (response.success) {
                let likeCount = response.like_count;
                likeCountElement.textContent = likeCount;
            }
        }
    };
    let params = 'blog_id=' + blogId;
    xhr.send(params);
}


function toggleLike(blogId,uniqueId) {
  let likeIcon = document.getElementById('like-icon-' + blogId);
  let likeCountElement = document.getElementById('like-count-' + blogId);
  let likeCount = parseInt(likeCountElement.textContent);
  if (likeIcon.classList.contains('fa-regular')) {
      // Blog not liked, send like request
      likeIcon.classList.remove('fa-regular');
      likeIcon.classList.add('fa-solid', 'fa-heart', 'text-primary');
      likeCount++;
      console.log(likeIcon)
      // Call backend to insert like data
      sendLike(uniqueId, true);
    } else {
        // Blog already liked, send unlike request
        likeIcon.classList.remove('fa-solid', 'text-primary');
        likeIcon.classList.add('fa-regular');
        likeCount--;
      console.log(likeIcon)

        // Call backend to delete like data
        sendLike(uniqueId, false);
    }

  likeCountElement.textContent = likeCount;
}

function sendLike(blogId, isLike) {
  let xhr = new XMLHttpRequest();
  xhr.open('POST', '/modules/blog/like_handler.php', true);
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
          // Handle response from backend if needed
          let response = JSON.parse(xhr.responseText);
          if (response.success) {
              // Update like button appearance if needed
              if (isLike && !response.liked) {
                  let likeIcon = document.getElementById('like-icon-' + blogId);
                  likeIcon.classList.remove('fa-solid', 'fa-heart', 'text-primary');
                  likeIcon.classList.add('fa-regular');
              } else if (!isLike && response.liked) {
                  let likeIcon = document.getElementById('like-icon-' + blogId);
                  likeIcon.classList.remove('fa-regular');
                  likeIcon.classList.add('fa-solid', 'fa-heart', 'text-primary');
              }
          }
      }
  };
  let params = 'blog_id=' + blogId + '&is_like=' + isLike;
  xhr.send(params);
}
