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
            <a href="#" class="button-yellow mr-3">Add to cart</a> <a href="#" onMouseOver="this.style.color='#FEFBE9'" onMouseOut="this.style.color='#f6c453'"><i class="fa-regular fa-heart"></i></a>
        </div>
    </div>
</div>

<div class="py-4 px-5 text-center">
    <h3 class="mx-auto" style="color: #2e5e4e">Course content</h3>
    <?php foreach ($videos as $video) { ?>  
        <div class="row mx-5 my-1 py-1 video align-items-center">
            <div class="col">
                <?php echo $course_name ?>
            </div>
            <div class="col">
                <?php echo $video['filename'] ?>
            </div> <div class="col">
                <?php echo $video['create_time'] ?>
            </div>
            <div class="col">
                <a href=<?php echo base_url() . "course/view_course/" . $course_id . "/" . $video['video_id'] ?>><i class="fa-regular fa-circle-play"></i></a>
            </div>
        </div>
    <?php } ?>
</div>