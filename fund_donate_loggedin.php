<?php
        include('./db_con.php');
        session_start();
        $role = $_SESSION['role'];
        $fund_id = $_GET['fund_id'];
        $sql = "SELECT funds.*, org_list.org_name, org_list.org_id FROM funds LEFT JOIN org_list ON funds.org_id = org_list.org_id WHERE funds.fund_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('i', $fund_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $fund = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/fund_donate.css">
    <link rel="stylesheet" href="./css/colors.css">
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <title>Fund Donation</title>
</head>
<body style="background-image: url('./assets/<?php echo htmlspecialchars($fund['img']); ?>');">
    <div id="popupForm" class="popup">
        <div class="popup-content">
            <span class="close" onclick="returnHome('<?php echo $role ?>')">&times;</span>
            <div class="wrapper">
                <h1>Fund Donation Form</h1>
                <form action="./fund_donation_submit_BE.php" method="POST">
                    <div class="input_group">
                        <div class="input_box">
                            <input type="text" name="donor_name" placeholder="Full Name" required class="name">
                            <i class="fa fa-user icon"></i>
                        </div>
                    </div>
                    <div class="input_group">
                        <div class="input_box">
                            <input type="email" name="donor_email" placeholder="Email Address" required class="name">
                            <i class="fa fa-envelope icon"></i>
                        </div>
                    </div>
                    <div class="input_group">
                        <div class="input_box">
                            <div class="input_box">
                                <input type="text" placeholder="Raised : <?php echo $fund['received'] ?>" disabled class="name">
                                <i class="fa fa-money icon"></i>
                            </div>
                        </div>
                        <div class="input_box">
                            <input type="text" placeholder="Goal : <?php echo $fund['amount'] ?>" disabled class="name">
                            <i class="fa fa-money icon"></i>
                        </div>
                        </div>
                    <div class="input_group" style="display: flex; flex-direction: column;">
                        <h4>Payment Method</h4>
                        <div class="input_box">
                            <input type="radio" name="pay" class="radio" id="bc1" value="card" checked>
                            <label for="bc1">
                                <span>Credit Card</span>
                            </label>
                            <input type="radio" name="pay" class="radio" id="bc2" value="bkash">
                            <label for="bc2">
                                <span>Bkash</span>
                            </label>
                        </div>
                    </div>
                    <div id="creditCardInputs">
                        <div class="input_group">
                            <div class="input_box">
                                <input type="text" name="card_no" class="name" placeholder="Card Number" required>
                                <i class="fa fa-credit-card icon"></i>
                            </div>
                            <div class="input_box">
                                <input type="text" name="card_cvc" class="name" placeholder="Card CVC" required>
                                <i class="fa fa-credit-card icon"></i>
                            </div>
                        </div>
                        <div class="input_group">
                            <div class="input_box">
                                <div class="input_box">
                                    <input type="text" name="card_exp_month" placeholder="Exp Month" required class="name">
                                    <i class="fa fa-calendar icon"></i>
                                </div>
                            </div>
                            <div class="input_box">
                                <input type="text" name="card_exp_year" placeholder="Exp Year" required class="name">
                                <i class="fa fa-calendar-o icon"></i>
                            </div>
                        </div>
                    </div>
                    <div id="bkashInputs" style="display: none;">
                        <div class="input_group">
                            <div class="input_box">
                                <input type="text" name="bkash_no" class="name" placeholder="Bkash Number" required>
                                <i class="fa fa-phone icon"></i>
                            </div>
                        </div>
                        <div class="input_group">
                            <div class="input_box">
                                <input type="text" name="Bkash_trans" class="name" placeholder="Transection ID" required>
                                <i class="fa fa-sort-numeric-desc icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="input_group">
                        <div class="input_box">
                            <input class="name" type="text" name="amount" placeholder="Need : <?php echo $fund['amount'] - $fund['received'] ?>" required>
                            <i class="fa fa-money icon"></i>
                            <input type="hidden" name="fund_id" value="<?php echo $fund_id ?>">
                            <input type="hidden" name="org_id" value="<?php echo $fund['org_id'] ?>">
                        </div>
                    </div>
                    <div class="input_group">
                        <div class="input_box">
                            <button type="submit" name="fund_donate_loggedin" id="button-30">Donate</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        function returnHome(x) {
            console.log(x);
            if (x == 'user'){
                window.location.href = './U_home.php';
            } else {
                window.location.href = './O_home.php';
            }
        }

        const creditCardInputs = document.getElementById("creditCardInputs");
        const bkashInputs = document.getElementById("bkashInputs");
        const bkashRadio = document.getElementById("bc2");
        const creditCardRadio = document.getElementById("bc1");

        function handlePaymentMethodChange() {
            if (bkashRadio.checked) {
                creditCardInputs.style.display = "none";
                bkashInputs.style.display = "block";
                document.getElementsByName("bkash_no")[0].setAttribute("required", "required");
                document.getElementsByName("Bkash_trans")[0].setAttribute("required", "required");
                document.getElementsByName("card_no")[0].removeAttribute("required");
                document.getElementsByName("card_cvc")[0].removeAttribute("required");
                document.getElementsByName("card_exp_month")[0].removeAttribute("required");
                document.getElementsByName("card_exp_year")[0].removeAttribute("required");
            } else if (creditCardRadio.checked) {
                creditCardInputs.style.display = "block";
                bkashInputs.style.display = "none";
                document.getElementsByName("card_no")[0].setAttribute("required", "required");
                document.getElementsByName("card_cvc")[0].setAttribute("required", "required");
                document.getElementsByName("card_exp_month")[0].setAttribute("required", "required");
                document.getElementsByName("card_exp_year")[0].setAttribute("required", "required");
                document.getElementsByName("bkash_no")[0].removeAttribute("required");
                document.getElementsByName("Bkash_trans")[0].removeAttribute("required");
            }
        }

        const paymentRadios = document.querySelectorAll('input[name="pay"]');
        paymentRadios.forEach((radio) => {
            radio.addEventListener("change", handlePaymentMethodChange);
        });
        handlePaymentMethodChange();
    </script>
</body>
</html>