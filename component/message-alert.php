<div class="mb-1">
                <?php
                        if(isset($_SESSION['message'])){

                ?>
                <p id="message" class="border shadow rounded bg-white border-secondary p-3 fs-5"><i class="fa-solid fa-envelope text-warning px-2 fs-5"></i><?php echo $_SESSION['message'];?></p>

                <script src="/asset/js/message-popup.js"></script>
                <?php unset($_SESSION['message']);}?>

    
            </div>