<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/create_course.css">



<div class="main background_image">
    <div class="form_style form_style-course col-6">
        <div class="logo_section">
            <a class="navbar-brand" href="#">Virdemy</a>
        </div>
        <div>
            <?php echo form_open_multipart(base_url() . 'course/create_course'); ?>
            <div class="form-group row">
                <label class="col-3" for="">Course title</label>
                <input class="col-8" type="text" class="form-control" required="required" name="courseTitle" >
            </div>
            <div class="form-group row">
                <label class="col-3" for="">Course description</label>
                <textarea class="col-8" name="description" id="" cols="30" rows="5" ></textarea>
            </div>
            <div class="form-group row">
                <label class="col-3" for="">Course price</label>
                <input type="number" min="0.00" max="10000.00" step="0.01" class="col-8 form-control" required="required" name="coursePrice" />
            </div>
            <div class="form-group">
                <button type="submit" value="upload" class="button">Create course</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

