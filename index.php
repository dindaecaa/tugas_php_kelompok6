<?php
class Person {
    public $firstname, $lastname, $phone, $address;

    public function __construct($firstname, $lastname, $phone, $address) {
        $this->firstname = htmlspecialchars($firstname);
        $this->lastname  = htmlspecialchars($lastname);
        $this->phone     = htmlspecialchars($phone);
        $this->address   = htmlspecialchars($address);
    }

    public function getFullName() {
        return $this->firstname . ' ' . $this->lastname;
    }
}

$data = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = new Person(
        $_POST['firstname'],
        $_POST['lastname'],
        $_POST['phone'],
        $_POST['address']
    );
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Contact Us</title>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', sans-serif;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    
    background: radial-gradient(circle at top right, #6dd5ed, transparent 40%),
                radial-gradient(circle at bottom left, #2193b0, transparent 40%),
                linear-gradient(135deg, #2c5364, #203a43, #0f2027);
    color: white;
}

.wrapper {
    display: flex;
    width: 900px;
    justify-content: space-between;
    align-items: center;
}

/* LEFT */
.left {
    width: 45%;
}

.left h1 {
    font-size: 60px;
    margin-bottom: 20px;
}

.left p {
    font-size: 18px;
    opacity: 0.8;
    line-height: 1.6;
}

.info {
    display: flex;
    gap: 20px;
    margin-top: 40px;
}

.info div {
    width: 50%;
    font-size: 14px;
    opacity: 0.7;
}

/* FORM */
.form-box {
    width: 380px;
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(20px);
    padding: 30px;
    border-radius: 25px;
}

.form-box label {
    display: block;
    margin-bottom: 5px;
    font-size: 14px;
}

.form-box input,
.form-box textarea {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border-radius: 30px;
    border: none;
    outline: none;
}

.form-box textarea {
    border-radius: 15px;
    height: 100px;
}

.form-box button {
    width: 100%;
    padding: 12px;
    border-radius: 30px;
    border: none;
    background: black;
    color: white;
    font-weight: bold;
    cursor: pointer;
}

.result {
    margin-top: 15px;
    font-size: 14px;
}
</style>
</head>

<body>

<div class="wrapper">

    <!-- LEFT -->
    <div class="left">
        <h1>Contact Us!</h1>
        <p>
            Need help? We're here to help. <br>
            Please fill out the form below and we'll get back to you.
        </p>

        <div class="info">
            <div>
                <b>Customer Support</b><br>
                Need help? We're here to help.
            </div>
            <div>
                <b>Customer Support</b><br>
                Need help? We're here to help.
            </div>
        </div>
    </div>

    <!-- RIGHT FORM -->
    <div class="form-box">

        <form method="POST">

            <label>First Name</label>
            <input type="text" name="firstname" required>

            <label>Last Name</label>
            <input type="text" name="lastname" required>

            <label>Phone Number</label>
            <input type="text" name="phone" required>

            <label>Address</label>
            <textarea name="address" required></textarea>

            <button type="submit">Submit!</button>
        </form>

        <?php if ($data): ?>
            <div class="result">
                <p><b>Nama:</b> <?= $data->getFullName() ?></p>
                <p><b>Phone:</b> <?= $data->phone ?></p>
                <p><b>Address:</b> <?= $data->address ?></p>
            </div>
        <?php endif; ?>

    </div>

</div>

</body>
</html>
