<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f0f4f8, #d9e2ec);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #ffffff;
            padding: 35px;
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 420px;
            box-sizing: border-box;
            animation: fadeIn 1s ease;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
            font-size: 24px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            margin-top: 20px;
        }

        small {
            display: block;
            margin-top: 4px;
            color: #666;
            font-size: 12px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 14px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-sizing: border-box;
            transition: border 0.3s, box-shadow 0.3s;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
            outline: none;
        }

        input[type="text"]:hover,
        input[type="email"]:hover,
        input[type="password"]:hover {
            border-color: #007bff;
        }

        button[type="submit"] {
            width: 100%;
            padding: 14px;
            background-color: #007bff;
            border: none;
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            border-radius: 10px;
            margin-top: 30px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
            transform: scale(1.02);
        }

        .helper-links {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }

        .helper-links a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s;
        }

        .helper-links a:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <form method="post" action="/register">
        @csrf

        <h2>Create Account</h2>

        <label for="name">Full Name</label>
        <input type="text" name="name" id="name" required>
        <small>Your full name as it appears on your ID.</small>

        <label for="email">Email Address</label>
        <input type="email" name="email" id="email" required>
        <small>We'll never share your email.</small>
        
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>

        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required>
        <small>Re-enter your password to confirm.</small>

        <button type="submit">Register</button>

        <div class="helper-links">
            <p>Already have an account? <a href="/login">Login here</a>.</p>
        </div>
    </form>
</body>

</html>