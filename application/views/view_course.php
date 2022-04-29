<main style="min-height: 100vh">
<div class="container d-flex">
    <div class="py-3">
        <video class="rounded" width="854" height="480" controls>
            <source src=<?php echo base_url() . "uploads/" . $video ?> type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="rounded p-2 mt-2" style="background-color: #fdfbe9;">
            <h3 class="my-3">Q&A Section</h3>
            <hr style="background-color: grey">
            <button type="submit" class="button" id="question">Ask a question</button>
            <?php echo form_open_multipart(base_url() . 'course/create_course', array('id' => 'question_form')); ?>
            <br>
            <div class="form-group row">
                <label class="col-3" for="">Question title</label>
                <input class="col-8" type="text" class="form-control" required="required" name="question_title" >
            </div>
            <div class="form-group row">
                <label class="col-3" for="">Question content</label>
                <textarea class="col-8" name="question_content" id="" cols="30" rows="5" ></textarea>
            </div>
            <div class="form-group">
                <button type="submit" value="creatQuestion" class="button">Create question</button>
            </div>
        </div>
    </div>
    <div class="col-3 text-center mt-3 py-1 mx-2 rounded" style="background-color: #2E5E4E;">
        <p style="color: #FEFBE9">Course content</p>
        <?php foreach ($videos as $video) { ?>
            <div class="row mx-1 my-1 py-1 video align-items-center">
                <div class="col" id="<?php echo $video['video_id'] ?>">
                    <?php echo $video['filename'] ?>
                </div>
                <div class="col">
                    <a href=<?php echo base_url() . "course/view_course/" . $course_id . "/" . $video['video_id'] ?>><i class="fa-regular fa-circle-play"></i></a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
</main>

<script>
    $(document).ready(function() {
        var question_form = document.getElementById("question_form");
        var question_button = document.getElementById("question");
        question_form.style.display = "none";
        
        $("#question").click(function() {
            if (question_form.style.display == "none") {
                question_form.style.display = "block";
                question_button.innerHTML = "All questions";
                } else {
                    console.log("skdfjkdsfjds");
                    question_form.style.display = "none";
                    question_button.innerHTML = "Ask a question";
                }
        });

        var url = window.location.href;
        var video_id = url.split('/').pop();
        var active_video = document.getElementById(video_id).parentElement;
        active_video.classList.add("video_active");
    });
</script>

