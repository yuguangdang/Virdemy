<!-- Modal -->
<input hidden id="isAdded" type="text" value="<?php echo (isset($addedToCart))? $addedToCart : ''; ?>">
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="color: #2e5e4e;">Added to cart</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <img class='img-thumbnail' src=<?php echo $course_pic ?> style="max-height: 15rem;">
        <p><?php echo $course_name ?></p>
      </div>
      <div class="modal-footer">
        <a href="<?php echo base_url() . 'cart' ?>" class="button px-2 pt-1">Go to cart</a>
      </div>
    </div>
  </div>
</div>

<main style="min-height: 100vh;">
    <div class='py-4' style="background-color: #2E5E4E; color:antiquewhite">
        <div class='container d-flex justify-content-center'>
            <div class='m-3 w-50'>
                <h3><?php echo $course_name ?></h3>
                <p><?php echo $description ?></p>
            </div>
            <div class='ml-1 w-50'>
                <img class='img-thumbnail' src=<?php echo $course_pic ?> style="max-height: 15rem;">
                <br><br>
                <p>Created by: <?php echo $creator ?></p>
                <p>Course price: £<?php echo $price ?></p>
                <br>
                <?php echo form_open_multipart(base_url() . "cart/add_in_cart/" . $course_id); ?>
                    <button class="button-yellow mr-3" id="add_to_cart">Add to cart</button>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>

    <div class="py-4 px-5 text-center">
        <h3 class="mx-auto" style="color: #2e5e4e">Course content</h3>
        <?php if (empty($videos)) { ?>
            <br>
            <h5>Sorry, there is no course video at the moment. </h5>
        <?php } else { ?>
            <?php foreach ($videos as $video) { ?>
                <div class="row mx-5 my-1 py-1 video align-items-center">
                    <div class="col">
                        <?php echo $course_name ?>
                    </div>
                    <div class="col">
                        <?php echo $video['filename'] ?>
                    </div>
                    <div class="col">
                        <?php echo $video['create_time'] ?>
                    </div>
                    <div class="col">
                        <a href=<?php echo base_url() . "course/view_course/" . $course_id . "/" . $video['video_id'] ?> class="<?php echo ($purchased)? '' : 'd-none'; ?>"><i class="fa-regular fa-circle-play"></i></a>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
</main>

<script>
    if ($('#isAdded').val() === '1') {
        $("#myModal").modal()
        $('#isAdded').val() === ''
        document.getElementById('add_to_cart').innerHTML = 'Added';
        document.getElementById('add_to_cart').disabled = true;
    }
    
</script>