<div class="comment-section collapse border-secondary border-top p-2" id="comment-section<?php echo $unique_identifier ?>">
                            <span class="h5">Comments</span>
    <form method="post" class="mt-3">
        <div class="mb-3">
            <textarea class="form-control" name="comment" placeholder="Add a comment..." rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Post</button>
    </form>
    <div class="container reply mt-3">
            <div class="row d-flex position-relative shadow text-bg-light border p-1 rounded-2" style="gap:7px">
                <div class="col-2 border" id="profile-img" style="height:50px">
                    <img src="/asset/image/user/profile.png" style="height:40px;width:40px" class="border rounded-circle" alt="">
                </div>
                <div class="col-9 text-dark" style="font-size:14px">
                    <span class="username fw-bold">@bhavesh_1724</span>
                    <p class="comment-content">
                        Lorem ipsum dolor sit amet.
                    </p>
                </div>
                <div class="comment-interaction">
                    <ul class="d-flex list-unstyled ms-2" style="gap:10px;font-size:12px">
                        <li class="list-item d-flex align-items-center" style="gap:4px">
                            <i class="fa-solid fa-heart "></i>
                            <a class=" mb-1 fw-bold text-dark nav-link" style="font-size:12px;">Like</a>
                        </li>
                        <li class="list-item d-flex align-items-center" style="gap:4px">
                        <i class="fa-solid fa-reply "></i>
                        <a class=" mb-1 fw-bold text-dark nav-link" style="font-size:12px;" >Reply</a>

                        </li>
                        <li class="list-item d-flex align-items-center" style="gap:4px">
                        <a class=" mb-1 fw-bold text-dark nav-link" style="font-size:12px;" >View Reply</a>
                        </li>
                    </ul>
                </div>
                <i class="posted-time position-absolute text-end top-0 align-items-center mt-1" style="font-size:13px;">13 mins ago</i>
            </div>
    </div>


          