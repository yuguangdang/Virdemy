<div class="main">
    <div class="container">
    <div class="row mt-3">
        <?php foreach ($courses as $course) { ?>            
                <div class="col-sm-4 d-flex align-items-stretch">
                    <div class="card mt-3 mx-2 course_card">
                        <img src=<?php echo $course['course_pic'] ?> class="card-img-top" alt="..." style="min-width: 350px;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $course['course_name'] ?></h5>
                            <br><br>
                            <div class="col-10">
                                <p><?php echo $course['creator'] ?></p>
                                <span>£<?php echo $course['price'] ?></span>
                                <a href="<?php echo base_url(). 'course/course_lookup/' . $course['course_id'] ?>"><button type="submit" class="button col-12 mt-1">Course detail</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<script>
    const recordVerticalOffset = () => {
        localStorage.setItem('pageVerticalPosition', window.scrollY);
    }

    window.addEventListener('scroll', recordVerticalOffset);
    const repositionPage = () => {
        let pageVerticalPosition = localStorage.getItem('pageVerticalPosition') || 0;
        window.scrollTo(0, pageVerticalPosition);
    }

    window.addEventListener('load', repositionPage);
</script>