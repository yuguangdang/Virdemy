<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/profile.css">

<div class="main">
    <div class="container profile-section">
        <h3>User account</h3><br>
        <p>Username: <?php echo $name; ?></p><br>
        <div>
            <span>Email: <?php echo $email; ?></span>
            <?php if ($active) { ?>
                    <span id="verified" >Verified</span>
            <?php } else { ?>
                <span id="not-Verified" >Not Verified</span>
            <?php } ?>
        </div>
        
        <?php if ($this->session->flashdata('message')) { ?>
            <br><span class="success-message"><?php echo $this->session->flashdata('message'); ?></span><br>
        <?php } else if ($this->session->flashdata('error')) { ?>
            <br><span class="error-message"><?php echo $this->session->flashdata('error'); ?></span><br>
        <?php } ?>
        <br>
        <p>Password: ********</p>
       <hr>
    </div>
</div>

