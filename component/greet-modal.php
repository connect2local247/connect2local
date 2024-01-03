
<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="background:linear-gradient(#040014,#0B1419)">
                <div class="modal-body rounded" >
                <div id="animation container" class="m-auto" style="height:50px;width:50px">
                    <script>
                        var animation = bodymovin.loadAnimation({
                            container : document.getElementById('animation container'),
                            loop:false,
                            autoplay:true,
                            rendor:'svg',
                            path:"/asset/animation/success.json",
                            name:"demo animation",
                            background:"transparent"
                        })
                    </script>
                </div>
                <div id="greet-message" class="d-none text-center text-white"><?php if(isset($_SESSION['greet-message'])) echo $_SESSION['greet-message'];?></div>
                </div>
                </div>
            </div>
</div>