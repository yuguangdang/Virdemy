<!DOCTYPE html>
<html>

<head>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta charset="utf-8">
    <title>Receipt</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <style>
        #receipt {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #receipt td,
        #receipt th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #receipt tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #receipt tr:hover {
            background-color: #ddd;
        }

        #receipt th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #2E5E4F;
            color: white;
        }

        #logo {
            color: #2e5e4e !important;
        }
    </style>
</head>

<body>
    <div style="text-align: center;">
        <h1 class="text-center bg-info" style="color: #2E5E4F;">Receipt</h1>

    </div>
    <br><br>
    <table class="table table-striped table-hover" style="margin: auto" id="receipt">
        <thead>
            <tr>
                <th></th>
                <th>Course</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $i = 1;
            ?>
            <?php foreach($receipt_items as $item) { ?>    
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $item->course_name ?></td>
                <td>£<?php echo $item->price ?></td>
            </tr>
            <?php 
                $i += 1;
            ?>
            <?php } ?>
            <tr>
                <td><?php $i ?></td>
                <td>Total:</td>
                <td>£<?php echo $total_price ?></td>
            </tr>
        <tbody>
    </table>
    <br><br>
    <div style="position: relative;">
        <h2 id="logo" style="position: absolute; right: 1rem">Virdemy</h2>
        <br><br>
        <p style="position: absolute; right: 1rem"><?php echo date("l jS \of F Y"); ?></p>
    </div>
</body>

</html>