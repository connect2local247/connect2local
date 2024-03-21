<div class="my-4 p-2">
                    <?php
            if (isset($_SESSION['error'])) {
                $error = $_SESSION['error'];
                ?>
                <div class="errorMessage col-xxl-3 col-xlg-3 col-lg-4 col-md-7 col-sm-9 col-10 border rounded fs-5 position-absolute end-0 top-0 m-2 text-center d-flex flex-column align-items-center text-white" id="error-message" style="height:180px;background-color:rgb(96, 92, 92)">
                    <div class="w-100 h-100 text-center position-relative" style="z-index:100;background:linear-gradient(#2F2462,#001520);">
                        <div class="text-bg-dark bg-gradient p-2 rounded" id="submit-btn">
                        <i class="fa-solid fa-xmark position-absolute end-0 mt-2 me-3" id="close-mark"></i>
                        <span>Error Message</span>
                        </div>
                        <div style="height:70%;display:flex;align-items:center;justify-content:center">
                            <p> <i class="fa-solid fa-xmark text-bg-danger p-2 rounded-circle"></i> <?php echo "$error"; ?></p>
                        </div>
                        <div class="position-absolute bottom-0 rounded" id="loading" style="background:linear-gradient(skyblue,royalblue,skyblue); width:100%; height:10px"></div>
                    </div>

<!-- ERROR MSG LOADING SCRIPT -->

                    <script src="/asset/js/error-loading.js"></script>
                </div>
                
                <?php
            }
        
            if (isset($_SESSION['greet-message'])) {
                include "greet-modal.php";
                unset($_SESSION['greet-message']);
                unset($_SESSION['error']);
            ?>
            <script src="/asset/js/greet-message.js"></script>
            <?php        
                                }
                                    
                    ?>

                </div>
            </div>     
