<?php
require_once __DIR__ . "/classes/Pdo_methods.php";
require_once __DIR__ . "/classes/StickyForm.php";

$pdo = new PdoMethods();
$sticky = new StickyForm();
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if ($sticky->validateForm($_POST)) {

            $emailCheckSql = "SELECT * FROM user_information WHERE email = :email";
            $bindings = [
                [":email", $sticky->values["email"], "str"]
            ];
            $existingUser = $pdo->selectBinded($emailCheckSql, $bindings);

            if ($existingUser && count($existingUser) > 0) {
                $sticky->errors['email'] = "This email is already registered.";
                $message = "<div class='alert alert-danger'>Please correct the errors below.</div>";
            } else {

            $sql = "INSERT INTO user_information (first_name, last_name, email, password) VALUES (:first, :last, :email, :password)";
            $bindings = [
                [":first", $_POST["firstName"], "str"],
                [":last", $_POST["lastName"], "str"],
                [":email", $_POST["email"], "str"],
                [":password", password_hash($_POST["password1"], PASSWORD_DEFAULT), "str"]
            ];

        $result = $pdo->otherBinded($sql, $bindings);

            if ($result === "noerror") {
                $message = "<div class='alert alert-success'>User successfully registered!</div>";
                $sticky = new StickyForm();
            } else {
                $message = "<div class='alert alert-danger'>Database error. Could not add user.</div>";
            }    
        }
    }
}
$sql = "SELECT first_name, last_name, email, password FROM user_information ORDER BY last_name DESC";
$users = $pdo->selectNotBinded($sql);

?>
<html>
<head>
    <title>Sticky Form Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <?= $message ?>
    <form method="post" action="">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" id="first_name" name="firstName" value="<?= htmlspecialchars($sticky->values['firstName']) ?>">
                <div class="text-danger"><?= $sticky->errors['firstName'] ?? '' ?></div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="lastName" value="<?= htmlspecialchars($sticky->values['lastName']) ?>">
                <div class="text-danger"><?= $sticky->errors['lastName'] ?? '' ?></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="<?= htmlspecialchars($sticky->values['email']) ?>">
                <div class="text-danger"><?= $sticky->errors['email'] ?? '' ?></div>
            </div>

            <div class="col-md-4 mb-3">
                <label for="password1">Password</label>
                <input type="text" class="form-control" id="password1" name="password1" value="<?= htmlspecialchars($sticky->values['password1']) ?>">
                <div class="text-danger"><?= $sticky->errors['password1'] ?? '' ?></div>
            </div>

            <div class="col-md-4 mb-3">
                <label for="password2">Confirm Password</label>
                <input type="text" class="form-control" id="password2" name="password2" value="<?= htmlspecialchars($sticky->values['password2']) ?>">
                <div class="text-danger"><?= $sticky->errors['password2'] ?? '' ?></div>
            </div>
        </div>

        <input type="submit" class="btn btn-primary" value="Register">
    </form>

    <h3 class="mt-5">Current Users</h3>

    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Password</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($users && $users !== 'error'): ?>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['first_name']) ?></td>
                    <td><?= htmlspecialchars($user['last_name']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['password']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="3">No users found.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
