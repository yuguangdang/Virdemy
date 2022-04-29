<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>resources/dropzone.scss">
<script src="<?php echo base_url(); ?>resources/dropzone.js"></script>


<main style="min-height: 100vh;">
    <div class='py-4' style="background-color: #2E5E4E; color:antiquewhite">
        <div class='container'>
            <?php echo form_open_multipart(base_url() . 'course/update_course'); ?>
            <div class="form-group row">
                <label class="col-3" for="">Course title:</label>
                <input class="col-8" type="text" class="form-control" required="required" name="courseTitle" value="<?php echo isset($course_name) ? $course_name : '' ?>">
            </div>
            <div class="form-group row">
                <label class="col-3" for="">Course description:</label>
                <textarea class="col-8" name="description" id="" cols="30" rows="5"><?php echo isset($course_description) ? $course_description : '' ?></textarea>
            </div>
            <div class="form-group row">
                <label class="col-3" for="">Course price:</label>
                <input type="number" min="0.00" max="10000.00" step="0.01" class="col-8 form-control" required="required" name="coursePrice" value="<?php echo isset($price) ? $price : '' ?>" />
            </div>
            <div class="form-group row">
                <input hidden type="text" name="course_id" value="<?php echo $course_id ?>">
            </div>
            <?php if ($this->session->flashdata('message')) { ?>
                <div class="form-group">
                    <span class="success-message"><?php echo $this->session->flashdata('message'); ?></span>
                </div>
            <?php } ?>
            <div class="form-group row">
                <label  class="col-3" for="" style="visibility: hidden;"></label>
                <button type="submit" value="upload" class="button-yellow px-5 py-0">Save change</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>



    <div class="py-4 px-5 text-center">
        <h3 class="mx-auto" style="color: #2e5e4e">Course video </h3>

        <div class="container">
            <?php echo form_open_multipart(base_url() . 'course/add_course_video'); ?>
            <?php if ($this->session->flashdata('vid-message')) { ?>
                <div class="form-group">
                    <span class="success-message"><?php echo $this->session->flashdata('vid-message'); ?></span>
                </div>
            <?php } else if ($this->session->flashdata('vid-error')) { ?>
                <div class="form-group">
                    <span class="success-message"><?php echo $this->session->flashdata('vid-message'); ?></span>
                </div>
            <?php } ?>
            <div class="form-group row align-items-baseline">
                <label class="col-3" for="" style="color: #2e5e4e; font-weight: bold;">Add course video:</label>
                <input class="col-5 dropzone mr-4" type="file" name='files[]' size="20" required="required" multiple />
                <input hidden type="text" name="course_id" value=<?php echo $this->uri->segment('3'); ?>>
                <input id="upload" class="col-3 button" type="submit" value="Upload"/>
            </div>
            <?php echo form_close(); ?>
        </div>
        <hr>
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
                    <a class="mr-4" href=<?php echo base_url() . "course/view_course/" . $course_id . "/" . $video['video_id'] ?>><i class="fa-regular fa-circle-play"></i></a>
                    <a href=<?php echo base_url() . "course/delete_video/" . $course_id . "/" . $video['video_id'] ?>><i class="fa-solid fa-trash-can"></i></i></a>
                </div>
            </div>
        <?php } ?>
    </div>
</main>

<script>
    $(document).ready(function() {
        $('form').each(function() {
            var form = this;
            form.addEventListener('submit', function() {
                $("#load").show();
            })
        })
    });
</script>