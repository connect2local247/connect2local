<div class="modal fade" id="notificationModal" tabindex="1" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content text-bg-dark border-0" style="z-index:10;min-height:70vh;min-width:50vw">
            <div class="modal-header border-0">
                <h1 class="modal-title fs-5" id="notificationModalLabel">Notification</h1>
                <i class="fa-solid fa-xmark" data-bs-dismiss="modal" aria-label="Close"></i>
            </div>
            <div class="modal-body border-0 text-bg-dark">
                <div class="container" id="notificationContainer">
                        <?php
                            function determine_user_type($user_id) {
                                // Regular expression to match user types
                                $pattern = '/^C2L\d+$/'; // Matches 'C2L' followed by one or more digits
                                $business_pattern = '/^C2LB\d+$/'; // Matches 'C2LB' followed by one or more digits
                                
                                // Check if the user ID matches any pattern
                                if (preg_match($pattern, $user_id)) {
                                    return 'Customer';
                                } elseif (preg_match($business_pattern, $user_id)) {
                                    return 'Business';
                                } else if($user_id == 1){
                                    return 'Admin';
                                }
                            }

                            $user = determine_user_type($_SESSION['current_user']);

                            if($user == 'Customer'){
                                fetchAndDisplayNotifications($conn);
                            } else if($user = "Business"){
                                fetchAndDisplayNotifications($conn);
                            } else if($user = "Admin"){
                                fetchAndDisplayNotifications($conn);
                            } else{
                                echo "<h1>Haven't Any Notification </h1>";
                            }

                        ?>
                </div>
            </div>
        </div>
    </div>
</div>
