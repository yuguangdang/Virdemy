<div class="main">
    <div class="container">
    <div class="row">
        <?php foreach ($courses as $course) { ?>            
                <div class="col-sm-4">
                    <div class="card mt-2 mx-2 course_card">
                        <img src=<?php echo $course['course_pic'] ?> class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $course['course_name'] ?></h5>
                            <p class="card-text"><?php echo $course['description'] ?></p>
                            <br>
                            <button type="submit" class="button col-12">Learn</button>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

