<main class="container" style="min-height: 100vh;">
    <h4 class='mt-4 text-center' style="color: #2e5e4e;">My learning</h4>
    <hr>
    <div>
        <div class="row mt-3">
            <?php foreach ($courses as $course) { ?>
                <div class="card col-4 px-1 my-1 py-1">
                    <img src=<?php echo $course['course_pic'] ?> class="card-img-top" alt="...">
                    <div class='card-body' style="min-height: 9rem">
                        <h6 class="card-title m-1"><?php echo $course['course_name'] ?></h6>
                        <div class="w-75">
                            <a href="<?php echo base_url() . 'course/course_lookup/' . $course['course_id'] ?>"><button type="submit" class="button col-12 mt-1">Learn</button></a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</main>