<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/profile.css">
<script type="module" src="<?php echo base_url(); ?>assets/js/location.js"></script>

<div id="load"></div>
<div class="main">
    <div class="container profile-section">


        <ul class="nav nav-tabs" style="border-bottom: 1px solid #2e5e4e">
            <li class="nav-item">
                <a class="nav-link active" id="user" aria-current="page" href="#">User</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="manage_course" href="#">Manage Course</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="dashboard" href="#">Dashboard</a>
            </li>
        </ul>

        <div id="user_section">
            <?php if ($this->session->flashdata('username-message')) { ?>
                <br><span class="success-message"><?php echo $this->session->flashdata('username-message'); ?></span>
            <?php } ?>

            <?php echo form_open_multipart(base_url() . 'profile/change_username', array('class' => 'mt-3')); ?>
            <label class="ml-0 mr-2" for="">Username:</label>
            <input id="name_input" type="text" name="user_name" required="required" value="<?php echo $user_data['name']; ?> " readonly />
            <button id="edit" class="button" type="button">Edit</button>
            <input id="save" class="button" type="submit" value="Save" style="display: none;" />
            <?php echo form_close(); ?>

            <!-- <p>Username: <?php echo $user_data['name']; ?></p><br> -->
            <div>
                <span>Email: <?php echo $user_data['email']; ?></span>
                <?php if ($user_data['active']) { ?>
                    <span id="verified">Verified</span>
                <?php } else { ?>
                    <span id="not-Verified">Not Verified</span>
                <?php } ?>
            </div>

            <?php if ($this->session->flashdata('message')) { ?>
                <br><span class="success-message"><?php echo $this->session->flashdata('message'); ?></span><br>
            <?php } else if ($this->session->flashdata('error')) { ?>
                <br><span class="error-message"><?php echo $this->session->flashdata('error'); ?></span><br>
            <?php } ?>
            <br>
            <p>Password: ******** <span><a class="button p-1" href="login/change_password">Change password</a></span> </p><br>
            <button class="button" id="show_location">Show my location</button>
            <hr>
            <div id="location">
                <p id="latLng"></p> <br>
                <div id="map"></div>
            </div>
        </div>

        <div id="manage_course_section">
            <div>
                <div class="row mt-3">
                    <?php foreach ($courses as $course) { ?>
                        <div class="card col-4 px-1 my-1 py-1">
                            <img src=<?php echo $course['course_pic'] ?> class="card-img-top" alt="...">
                            <div class='card-body d-flex flex-column' style="min-height: 9rem">
                                <h6 class="card-title m-1"><?php echo $course['course_name'] ?></h6>
                                <div class="w-75 mt-auto">
                                    <a href="<?php echo base_url() . 'course/course_edit/' . $course['course_id'] ?>"><button type="submit" class="button col-12 mt-1">Edit</button></a>
                                    <a href="<?php echo base_url() . 'course/course_delete/' . $course['course_id'] ?>"><button type="submit" class="button-red col-12 mt-1">Delete</button></a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

</div>
</div>





<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTaUurDjgsA4IDbN2Oq7_GgXBlKODdOYs&callback=initMap&v=weekly" defer></script>