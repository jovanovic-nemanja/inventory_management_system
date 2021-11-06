<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>

<body>
    <div style="padding-left: 10%; padding-right: 10%;">
        <a class="ps-logo" href="https://mambodubai.com">
            <img src="https://mambodubai.com/images/logo.png" alt="" style="width: 130px;">
        </a>
        <hr/>
        <h1 style="color: #476B91;">Hi <?= $name ?></h1><br>
        <h4>A new request has been submitted for your <a href="<?= $product_link ?>">product</a>. <br> Request details are as follows - </h4>

        <h4>Customer Name - <?= $customer_name ?></h4>
        <h4>Product Name - <?= $rfq->product_name ?></h4>
        <h4>Quantity - <?= $rfq->req_quantity ?></h4>
        <h4>Additional Information - <?= $rfq->additional_information ?></h4>
        <?php 
            if (@$file_link) { ?>
                <h4>File - <a href="<?= $file_link ?>">Check the attachment</a></h4>
        <?php } ?>
        
        <h4>Date of request - <?= $rfq->sign_date ?></h4><br>
    </div>
</body>

</html>
