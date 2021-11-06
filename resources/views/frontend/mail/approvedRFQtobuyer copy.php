<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
    <div style="padding-left: 10%; padding-right: 10%;">
        <a class="ps-logo" href="https://mambodubai.com">
            <img src="https://mambodubai.com/newdesign/images/logo.png" alt="" style="width: 130px;">
        </a>
        <hr />
        <h1 style="color: #476B91;">Hi <?= $name ?></h1>
        <h4>Your request for the <a href="<?= $product_link ?>">product</a> has been approved. <br> The details are as follows - </h4>

        <h4>Company Name - <?= $company_name ?></h4>
        <h4>Product Name - <?= $rfq->product_name ?></h4>
        <h4>Quantity - <?= $rfq->req_quantity ?></h4>
        <h4>Additional Information - <?= $rfq->additional_information ?></h4>
        <?php
        if (@$file_link) { ?>
            <h4>File - <a href="<?= $file_link ?>">Check the attachment</a></h4>
        <?php } ?>

        <h4>Date of request - <?= $rfq->sign_date ?></h4><br>
        <h4>Thanks</h4>
        <h4>MamboDubai</h4>
    </div>
    
    <hr style="border: solid 1px #ccc; box-shadow: none; border-style: solid;">
    <p style="Margin: 0; font-size: 14px; Margin-bottom: 10px;"><em>Copyright © MamboDubai, All rights reserved.</em><br> <br>
        <strong>Our mailing address is:</strong> <a href="mailto:info@mambodubai.com" style="color: #ee6a56; text-decoration: underline;">info@mambodubai.com</a>
    </p>
    <hr style="border: solid 1px #ccc; box-shadow: none; border-style: solid;">
</body>

</html>
