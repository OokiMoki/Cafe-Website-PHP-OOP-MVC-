<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/styles/register/register.css">
    <title>Registration Page</title>
</head>
<body>
    <div class="registration-container">
        <h2>Registration</h2>
        <form action="../../core/registration_process.php" method="post">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required>

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required>

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="role">Role:</label>
            <input type="text" id="role" name="role" required>

            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
