<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>

    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;

            /* Soft blur gradient background */
            background: linear-gradient(135deg, #d7b9e6, #9ec7ff, #f7b7c3);
            background-size: cover;
            font-family: 'Poppins', sans-serif;
        }

        .login-container {
            width: 370px;
            background: rgba(255, 255, 255, 0.28);
            backdrop-filter: blur(25px);
            border-radius: 18px;
            padding: 35px 30px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.15);
            animation: fadeIn 0.8s ease-in-out;
            text-align: center;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .login-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 15px;
            border-radius: 50%;
            background: rgba(0,0,0,0.2);
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 38px;
        }

        .input-group {
            background: rgba(255,255,255,0.45);
            display: flex;
            align-items: center;
            padding: 12px;
            border-radius: 8px;
            margin-top: 15px;
        }

        .input-group input {
            width: 100%;
            background: transparent;
            border: none;
            outline: none;
            font-size: 15px;
            color: #333;
            font-weight: 500;
        }

        .input-icon {
            margin-right: 10px;
            color: #1f3d63;
            font-size: 18px;
        }

        .remember-box {
            color: white;
            font-size: 13px;
            margin: 10px 0;
            display: flex;
            justify-content: space-between;
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            border: none;
            margin-top: 20px;
            background: #1f3d63;
            color: white;
            border-radius: 8px;
            font-size: 15px;
            letter-spacing: 1px;
            cursor: pointer;
            transition: 0.25s;
        }

        .login-btn:hover {
            background: #2b4e7e;
            transform: translateY(-2px);
        }

        .error {
            margin-top: 15px;
            color: #ffcccc;
            font-size: 14px;
        }

        ::placeholder {
            color: #666;
        }
    </style>
</head>

<body>

    <div class="login-container">

        <div class="login-icon">
            <span>👤</span>
        </div>

        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf

            <!-- Username -->
            <div class="input-group">
                <span class="input-icon">👤</span>
                <input type="text" name="username" placeholder="Email / Username" required>
            </div>

            <!-- Password -->
            <div class="input-group">
                <span class="input-icon">🔒</span>
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <div class="remember-box">
                <label>
                    <input type="checkbox" name="remember"> Remember me
                </label>
                <a href="#" style="color:white; text-decoration:none;">Forgot password?</a>
            </div>

            <button class="login-btn">LOGIN</button>

            @if(session('error'))
                <div class="error">{{ session('error') }}</div>
            @endif
        </form>

    </div>

</body>
</html>
