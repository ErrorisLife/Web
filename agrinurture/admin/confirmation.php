<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Logout</title>
    <style>
        body {
            font-family: 'Fira Sans', sans-serif;
            text-align: center;
            margin-top: 100px;
        }
        .container {
            max-width: 400px;
            margin: auto;
            border: 2px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        button {
            margin: 10px;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .confirm {
            background-color: #d9534f;
            color: white;
        }
        .cancel {
            background-color: #5bc0de;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Are you sure you want to log out?</h2>
        <form action="../logout.php" method="post">
            <button type="submit" class="confirm">Yes, Logout</button>
        </form>
        <form action="dashboard.php" method="get">
            <button type="submit" class="cancel">Cancel</button>
        </form>
    </div>
</body>
</html>
