<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    
    <style>
        body {
            font-family: 'Fira Sans', sans-serif;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .reset-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .reset-container h1 {
            margin-bottom: 20px;
            font-size: 1.5em;
        }
        .reset-container input[type="email"] {
            width: 94%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1em;
        }
        .reset-container button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1em;
            cursor: pointer;
        }
        .reset-container button:hover {
            background-color: #0056b3;
        }
        .reset-container p {
            margin-top: 10px;
            font-size: 0.9em;
            color: #666;
        }
    </style>

</head>
<body>

    </head>
    <body>
       

        <div class="reset-container">
            <h1>Forgot Password</h1>
            <form action="requestingpasswordreset.php" method="POST">
                <input type="email" name="email" placeholder="Enter your registered email" required>
                <button type="submit">Request Reset</button>
            </form>
            <p>If you have an account, we will send a reset link to your email.</p>
        </div>
    </body>
    </html>
    
    
</body>
</html>