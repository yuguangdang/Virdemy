<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/create_course.css">

<div class="main">
    <div class="form_style form_style-course">
        <div class="logo_section">
            <a class="navbar-brand" href="#">Virdemy</a>
        </div>
        <div>
            <?php echo form_open_multipart(base_url() . 'course/upload_course_img'); ?>
            <div class="form-group row">
                <label class="col-3" for="">Course picture</label>
                <input class="col-5" type="file" name="userfile" size="20" />
                <input class="col-3 button" type="submit" value="upload" />
            </div>
            <input hidden type="text" name="course_id" value=<?php echo $course_id ?>>
            <?php echo form_close(); ?>
            <?php if ($this->session->flashdata('img_message')) { ?>
                <div class="form-group">
                    <div class="success-message"><?php echo $this->session->flashdata('img_message'); ?></div>
                </div>
            <?php } else if ($this->session->flashdata('img_error')) { ?>
                <div class="form-group">
                    <div class="error-message"><?php echo $this->session->flashdata('img_error'); ?></div>
                </div>
            <?php } ?>

            <?php echo form_open_multipart(base_url() . 'course/upload_course_video'); ?>
            <div class="form-group row">
                <label class="col-3" for="">Course videos</label>
                <input class="col-5" type="file" name="userfile" size="20" />
                <input class="col-3 button" type="submit" value="upload" />
            </div>
            <input hidden type="text" name="course_id" value=<?php echo $course_id ?>>
            <?php echo form_close(); ?>
            <?php if ($this->session->flashdata('vid_message')) { ?>
                <div class="form-group">
                    <div class="success-message"><?php echo $this->session->flashdata('vid_message'); ?></div>
                </div>
            <?php } else if ($this->session->flashdata('vid_error')) { ?>
                <div class="form-group">
                    <div class="error-message"><?php echo $this->session->flashdata('vid_error'); ?></div>
                </div>
            <?php } ?>

            <?php echo form_open_multipart(base_url() . 'home'); ?>
            <div class="form-group">
                <button type="submit" value="upload" class="button col-4">View course</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>