<?php
session_start();
include 'includes/db.php';
include 'includes/auth.php';

// === Get Values Returned from eSewa Redirect ===
$transaction_uuid = $_GET['transaction_uuid'] ?? '';
$total_amount     = $_GET['total_amount'] ?? '';
$product_code     = "EPAYTEST"; // Always EPAYTEST in Sandbox

if (empty($transaction_uuid) || empty($total_amount)) {
    header("Location: failure.php?error=missing_params");
    exit();
}

// === Verify Transaction with eSewa Sandbox ===
$verify_url = "https://rc.esewa.com.np/api/epay/transaction/status/?" .
              "product_code={$product_code}&" .
              "total_amount={$total_amount}&" .
              "transaction_uuid={$transaction_uuid}";

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => $verify_url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_FOLLOWLOCATION => true,
));

$response = curl_exec($curl);
curl_close($curl);

// Decode JSON
$data = json_decode($response, true);

// === Payment Status Check ===
$payment_status = $data['status'] ?? 'FAILED';

// If payment is successful
if ($payment_status === "COMPLETE") {
    // Clear cart after success
    unset($_SESSION['cart']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>
        <?php echo ($payment_status === "COMPLETE") ? "Payment Successful" : "Payment Failed"; ?>
    </title>
</head>
<body>
<div class="container">
    <?php if ($payment_status === "COMPLETE") { ?>
        <h2> Payment Successful!</h2>
        <p>Transaction ID: <?php echo htmlspecialchars($transaction_uuid); ?></p>
        <p>Amount Paid: Rs <?php echo htmlspecialchars($total_amount); ?></p>
        <p>Thank you for shopping with us.</p>
        <a href="index.php">Continue Shopping</a>
    <?php } else { ?>
        <h2> Payment Failed!</h2>
        <p>Your payment could not be verified.</p>
        <a href="index.php">Try Again</a>
    <?php } ?>
</div>
</body>
</html>
