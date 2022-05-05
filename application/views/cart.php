<main style="min-height: 100vh;">
    <br>
    <?php if ($this->session->flashdata('success')) { ?>
        <div class="alert alert-success text-center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <p><?php echo $this->session->flashdata('success'); ?></p>
        </div>
    <?php } ?>
    <div class="container">
        <h4 class="text-center" style="color: #2e5e4e;">Shopping cart</h4><hr>
    </div>
    <div class="container d-flex p-3">
        <?php if (empty(!$items)) { ?>
            <ul class="col-8 m-1 p-2" style="background-color: #fefbe9;">
                <?php foreach ($items as $item) { ?>
                    <li class="d-flex">
                        <img class='img-thumbnail mr-2' src=<?php echo $item['course_pic'] ?> style="max-width: 8rem;">
                        <div class="pt-2">
                            <h6><?php echo $item['course_name'] ?></h6>
                            <p>Price: £<?php echo $item['course_price'] ?></p>
                            <?php echo form_open_multipart(base_url() . "cart/remove/" . $item['course_id']); ?>
                            <button type="submit" class="button mt-2">Remove</button>
                            <?php echo form_close(); ?>
                        </div>
                    </li>
                    <hr>
                <?php } ?>
            </ul>
            <div class='col-4 m-1 p-4' style="background-color: #fefbe9; max-height: 8rem;">
                <p>Total:</p>
                <h5>£ <?php echo $totalPrice ?></h5>
                <?php echo form_open_multipart(base_url() . "stripe/stripe_payment/" . $totalPrice); ?>
                <button type="submit" class="button">Checkout</button>
                <?php echo form_close(); ?>
            </div>
        <?php } else { ?>
            <h6>The cart is empty. Explore all the courses <span><a href="<?php echo base_url() . 'home' ?>">here!</a></h6><br>
        <?php } ?>
    </div>
</main>