function addComment() {
    // Get the comment text from the textarea
    var commentText = document.getElementById("comment-text").value;

    // Check if the comment is not empty
    if (commentText.trim() !== "") {
        // Call a backend API to save the comment to the database
        saveCommentToDatabase(commentText, null);

        // Display the comment on the page immediately (for better user experience)
        displayComment(commentText, null);

        // Clear the textarea
        document.getElementById("comment-text").value = "";
    }
}

function displayComment(commentText, parentId) {
    // Create a new comment element and append it to the comments container
    var commentElement = document.createElement("div");
    commentElement.className = "comment";
    commentElement.innerHTML = `
        <p>${commentText}</p>
        <button onclick="toggleReplies(${commentElement.id})">View Replies</button>
        <div id="replies-${commentElement.id}" style="display:none;"></div>
        <form id="reply-form-${commentElement.id}">
            <textarea placeholder="Add a reply..."></textarea>
            <button type="button" onclick="addReply(${commentElement.id})">Post Reply</button>
        </form>
    `;
    commentElement.id = generateCommentId(); // You need to implement a function to generate unique IDs
    document.getElementById("comments-container").appendChild(commentElement);
}

function addReply(parentCommentId) {
    // Get the reply text from the textarea
    var replyText = document.getElementById(`reply-form-${parentCommentId}`).querySelector("textarea").value;

    // Check if the reply is not empty
    if (replyText.trim() !== "") {
        // Call a backend API to save the reply to the database
        saveCommentToDatabase(replyText, parentCommentId);

        // Display the reply immediately
        displayReply(replyText, parentCommentId);

        // Clear the textarea
        document.getElementById(`reply-form-${parentCommentId}`).querySelector("textarea").value = "";
    }
}

function displayReply(replyText, parentCommentId) {
    // Create a new reply element and append it to the replies container
    var replyElement = document.createElement("div");
    replyElement.className = "reply";
    replyElement.innerHTML = `<p>${replyText}</p>`;
    document.getElementById(`replies-${parentCommentId}`).appendChild(replyElement);
}

function toggleReplies(commentId) {
    var repliesContainer = document.getElementById(`replies-${commentId}`);
    var button = document.querySelector(`#${commentId} button`);

    if (repliesContainer.style.display === "none") {
        // Fetch and display replies from the backend
        fetchRepliesFromBackend(commentId);

        // Update button text
        button.innerText = "Hide Replies";
        repliesContainer.style.display = "block";
    } else {
        // Hide replies
        button.innerText = "View Replies";
        repliesContainer.style.display = "none";
    }
}

function fetchRepliesFromBackend(commentId) {
    // Use AJAX or fetch to retrieve replies from the backend (PHP script)
    // Example using fetch:
    fetch(`backend/get_replies.php?commentId=${commentId}`)
        .then(response => response.json())
        .then(replies => {
            // Display retrieved replies on the frontend
            replies.forEach(replyText => displayReply(replyText, commentId));
        })
        .catch(error => console.error('Error fetching replies:', error));
}

function saveCommentToDatabase(commentText, parentId) {
    // Use AJAX or fetch to send the comment data to the backend (PHP script)
    // Example using fetch:
    fetch('backend/save_comment.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            text: commentText,
            parentId: parentId
        }),
    })
    .then(response => response.json())
    .then(data => console.log('Success:', data))
    .catch((error) => {
        console.error('Error:', error);
    });
}
