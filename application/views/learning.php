<main class="container" style="min-height: 100vh;">
    <h4 class='mt-4 text-center' style="color: #2e5e4e;">My learning</h4>
    <hr>
    <div>
        <div class="row mt-3">
            <?php foreach ($courses as $course) { ?>
                <div class="card col-4 px-1 my-1 py-1">
                    <img src=<?php echo $course['course_pic'] ?> class="card-img-top" alt="...">
                    <div class='card-body text-center d-flex flex-column' style="min-height: 8rem">
                    <div class="mt-auto">
                        <h6 class="card-title m-1"><?php echo $course['course_name'] ?></h6>
                        
                        <section class='rating' style="color: #e7a91d;">
                            <?php $rating_value = $course['course_rating']; ?>
                            <span class="<?php if ($rating_value >= 1) {
                                                echo 'fa fa-star';
                                            } else {
                                                echo 'fa fa-star-o';
                                            } ?>"></span>
                            <span class="<?php if ($rating_value >= 2) {
                                                echo 'fa fa-star';
                                            } else {
                                                echo 'fa fa-star-o';
                                            } ?>"></span>
                            <span class="<?php if ($rating_value >= 3) {
                                                echo 'fa fa-star';
                                            } else {
                                                echo 'fa fa-star-o';
                                            } ?>"></span>
                            <span class="<?php if ($rating_value >= 4) {
                                                echo 'fa fa-star';
                                            } else {
                                                echo 'fa fa-star-o';
                                            } ?>"></span>
                            <span class="<?php if ($rating_value >= 5) {
                                                echo 'fa fa-star';
                                            } else {
                                                echo 'fa fa-star-o';
                                            } ?>"></span>
                            <span>(<?php echo $course['rating_count'] ?>)</span>
                            <button data-course-id="<?php echo $course['course_id'] ?>" type="button" class="button" data-toggle="modal" data-target="#rating_modal">
                                Rate
                            </button>
                        </section>
                        <div class="mt-2">
                            <a href="<?php echo base_url() . 'course/course_lookup/' . $course['course_id'] ?>"><button type="submit" class="button col-12 mt-1">Learn</button></a>  
                        </div>
                    </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</main>

<div class="modal fade" id="rating_modal" role="dialog" tabindex="-1" aria-hidden="true" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #e2ede3;">
                <button type="button" onclick="javascript:window.location.reload()" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="modal-title star-rating" style="color: #2e5e4e;">
                            Rating &nbsp; &nbsp;
                            <span class="fa fa-star-o" data-rating="1" style="color: #e7a91d;"></span>
                            <span class="fa fa-star-o" data-rating="2" style="color: #e7a91d;"></span>
                            <span class="fa fa-star-o" data-rating="3" style="color: #e7a91d;"></span>
                            <span class="fa fa-star-o" data-rating="4" style="color: #e7a91d;"></span>
                            <span class="fa fa-star-o" data-rating="5" style="color: #e7a91d;"></span>
                            <input type="hidden" name="whatever1" class="rating-value" value="2.56">
                        </h3>
                    </div>
                    <div class="clear10"></div>
                        <div class="col-md-12 text-center">
                            <br>
                            <input hidden id="course_id"></input>
                            <button class="button" onclick="post_rating()"> Post Rating</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function post_rating() {
        var course_id = $('#course_id').val();
        var starcount = $star_rating.siblings('input.rating-value').val();
        window.location.href = "<?php echo base_url(); ?>rating/insert_rating/" + course_id + "/" + starcount;
    }
    var $star_rating = $('.star-rating .fa');
    var SetRatingStar = function() {
        return $star_rating.each(function() {
            if (parseInt($star_rating.siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {

                return $(this).removeClass('fa-star-o').addClass('fa-star');
            } else {
                return $(this).removeClass('fa-star').addClass('fa-star-o');
            }
        });

    };
    // alert($star_rating.siblings('input.rating-value').val());

    $star_rating.on('click', function() {
        $star_rating.siblings('input.rating-value').val($(this).data('rating'));
        return SetRatingStar();
    });

    $('#rating_modal').on('show.bs.modal', function(e) {

    //get data-id attribute of the clicked element
    var course_id = $(e.relatedTarget).data('course-id');
    $("#course_id").val(course_id);
    });
</script>