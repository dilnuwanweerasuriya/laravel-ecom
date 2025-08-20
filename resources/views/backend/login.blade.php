<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .login-container {
            max-width: 400px;
            margin: 80px auto;
            padding: 25px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .logo {
            width: 64px;
            height: 64px;
            object-fit: cover;
        }

        .toggle-password {
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="login-container text-center">
        <!-- Logo -->
        <img src="https://dummyimage.com/64x64/000/fff&text=ADM" alt="Logo" class="logo mb-3 rounded-circle">
        <h3 class="mb-2">Admin Panel</h3>
        <p class="text-muted mb-4">Sign in to manage the dashboard</p>

        <!-- Login Form -->
        <form id="adminLoginForm" action="/admin/adminLogin" method="POST">
            @csrf
            <!-- Email -->
            <div class="mb-3 text-start">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Enter email"
                    required>
            </div>

            <!-- Password -->
            <div class="mb-3 text-start position-relative">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" id="password" name="password" class="form-control" placeholder="••••••••"
                        required>
                    <span class="input-group-text toggle-password" id="togglePassword">👁</span>
                </div>
            </div>

            <!-- Remember Me + Forgot Password -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remember me</label>
                </div>
                <a href="#" class="text-decoration-none">Forgot password?</a>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const passwordField = document.getElementById('password');

        togglePassword.addEventListener('click', () => {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            togglePassword.textContent = type === 'password' ? '👁' : '🙈';
        });
    </script>
</body>

</html>
