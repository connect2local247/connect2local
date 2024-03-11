<div class="offcanvas offcanvas-bottom" tabindex="-1" id="contactInfo" aria-labelledby="contactInfoLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="contactInfoLabel">Contact Info</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body small">
      <a href="tel:<?php echo decryptData($phone,$bKey) ?>" class="btn border border-info">Phone Number</a>&nbsp;&nbsp;
      <a href="mailto:<?php echo decryptData($email,$bKey) ?>" class="btn border border-info">Email</a>
  </div>
</div>