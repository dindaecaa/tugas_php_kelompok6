<?php
// Class Person untuk menyimpan data inputan
class Person {
    public string $firstname;
    public string $lastname;
    public string $phone;
    public string $address;

    public function __construct(string $firstname, string $lastname, string $phone, string $address) {
        $this->firstname = htmlspecialchars(trim($firstname));
        $this->lastname  = htmlspecialchars(trim($lastname));
        $this->phone     = htmlspecialchars(trim($phone));
        $this->address   = htmlspecialchars(trim($address));
    }

    public function getFullName(): string {
        return $this->firstname . ' ' . $this->lastname;
    }
}

// Proses form ketika submit
$person    = null;
$submitted = false;
$errors    = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $submitted = true;

    // Validasi sederhana
    if (empty($_POST['firstname'])) $errors[] = 'Firstname wajib diisi.';
    if (empty($_POST['lastname']))  $errors[] = 'Lastname wajib diisi.';
    if (empty($_POST['phone']))     $errors[] = 'Phone Number wajib diisi.';
    if (empty($_POST['address']))   $errors[] = 'Address wajib diisi.';

    if (empty($errors)) {
        $person = new Person(
            $_POST['firstname'],
            $_POST['lastname'],
            $_POST['phone'],
            $_POST['address']
        );
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Form PHP</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f0f4f8;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .container {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.1);
            padding: 40px;
            width: 100%;
            max-width: 500px;
        }

        h2 {
            margin-bottom: 24px;
            font-size: 20px;
            color: #333;
        }

        input[type="text"],
        input[type="tel"],
        textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            margin-bottom: 14px;
            outline: none;
            transition: border-color 0.2s;
        }

        input[type="text"]:focus,
        input[type="tel"]:focus,
        textarea:focus {
            border-color: #4a90d9;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .btn-submit {
            display: block;
            margin: 0 auto;
            background: #4a90d9;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 28px;
            font-size: 14px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-submit:hover {
            background: #3578c1;
        }

        /* ---- Result section ---- */
        .result {
            margin-top: 28px;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }

        .result p {
            font-size: 14px;
            color: #222;
            margin-bottom: 6px;
            font-weight: 600;
        }

        .btn-reset {
            background: none;
            border: none;
            color: #4a90d9;
            cursor: pointer;
            font-size: 13px;
            margin-top: 10px;
            padding: 0;
            text-decoration: underline;
        }

        .btn-reset:hover {
            color: #3578c1;
        }

        /* ---- Error list ---- */
        .errors {
            background: #fff3f3;
            border: 1px solid #f5c6c6;
            border-radius: 4px;
            padding: 12px 16px;
            margin-bottom: 16px;
            color: #c0392b;
            font-size: 13px;
        }

        .errors ul {
            padding-left: 18px;
        }
    </style>
</head>
<body>
<div class="container">

    <?php if (!$person): ?>
        <!-- ===== FORM ===== -->
        <h2>Contact Form</h2>

        <?php if (!empty($errors)): ?>
            <div class="errors">
                <ul>
                    <?php foreach ($errors as $err): ?>
                        <li><?= $err ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <input
                type="text"
                name="firstname"
                placeholder="Firstname"
                value="<?= htmlspecialchars($_POST['firstname'] ?? '') ?>"
            >
            <input
                type="text"
                name="lastname"
                placeholder="Lastname"
                value="<?= htmlspecialchars($_POST['lastname'] ?? '') ?>"
            >
            <input
                type="tel"
                name="phone"
                placeholder="Phone Number"
                value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>"
            >
            <textarea name="address" placeholder="Address"><?= htmlspecialchars($_POST['address'] ?? '') ?></textarea>
            <button type="submit" name="submit" class="btn-submit">Submit</button>
        </form>

    <?php else: ?>
        <!-- ===== FORM (readonly, menampilkan nilai) ===== -->
        <h2>Contact Form</h2>

        <input type="text" value="<?= $person->firstname ?>" readonly>
        <input type="text" value="<?= $person->lastname ?>" readonly>
        <input type="tel"  value="<?= $person->phone ?>" readonly>
        <textarea readonly><?= $person->address ?></textarea>
        <button class="btn-submit" disabled>Submit</button>

        <!-- ===== RESULT ===== -->
        <div class="result">
            <p>Hi, my name is <?= $person->getFullName() ?></p>
            <p>Phone Number : <?= $person->phone ?></p>
            <p>Address : <?= $person->address ?></p>

            <!-- Tombol Reset kembali ke form kosong -->
            <form method="GET" action="">
                <button type="submit" class="btn-reset">Reset</button>
            </form>
        </div>

    <?php endif; ?>

</div>
</body>
</html>
