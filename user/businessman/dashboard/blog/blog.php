<div class="card"  onclick="activateCard(this)">
            <div class="card-content border border-dark rounded shadow position-relative">
                    <?php include "blog-header.php" ?>
                    <?php include "blog-body.php" ?>
                    <?php include "blog-footer.php" ?>
            </div>

            <script>
    // Function to activate the clicked card
    function activateCard(card) {
        // Deactivate all other cards
        document.querySelectorAll('.card').forEach(function(item) {
            item.classList.remove('active');
        });
        // Activate the clicked card
        card.classList.add('active');
    }
</script>

<style>
    /* Style for active card */
    .card.active {
        /* outline: 1px solid black; Example border color change for active state */
        background:linear-gradient(royalblue,skyblue);
        color:white;
        border-color:white;
    }
</style>
        </div>
   