
    $(document).ready(function() {
        $('.follow-btn').click(function() {
            var button = $(this);
            var user_id = button.data('userid');
            var action = button.data('action');

            // Perform AJAX request to toggle follow status
            $.ajax({
                type: 'POST',
                url: '/modules/user-profile/toggle_follow.php',
                data: { user_id: user_id, action: action },
                success: function(response) {
                    // Toggle button text and action based on response
                    if (action === 'follow') {
                        button.text('Unfollow');
                        button.data('action', 'unfollow');
                    } else {
                        button.text('Follow');
                        button.data('action', 'follow');
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error
                }
            });
        });
    });