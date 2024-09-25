
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('assets/images/login-background.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
        }
        .login-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 100px auto;
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
        }
        .form-control {
            border-radius: 20px;
        }
        .btn-primary {
            border-radius: 20px;
            width: 100%;
            background-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .form-icon {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }
        .input-group {
            position: relative;
        }
        .input-group .form-control {
            padding-left: 40px;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
  <div class="login-container">
    <h2>Login</h2>
    <form action="proses_login.php" method="POST">
      <!-- Input Username -->
      <div class="mb-3 input-group">
        <span class="form-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.743 2.846L15 12.17V5.383zM1 5.383v6.787l4.743-2.941L1 5.383zM14.247 13H1.753l5.424-3.363L8 10.803l.823-.166L14.247 13z"/>
          </svg>
        </span>
        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
      </div>

      <!-- Input Password -->
      <div class="mb-3 input-group">
        <span class="form-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
            <path d="M8 1a4 4 0 0 0-4 4v2H3a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-1V5a4 4 0 0 0-4-4zM4 5a4 4 0 0 1 8 0v2H4V5z"/>
            <path d="M3 10h10v4H3v-4z"/>
          </svg>
        </span>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
      </div>

      <!-- Tombol Login -->
      <button type="submit" class="btn btn-primary">Login</button>
    </form>

    <!-- Tambahkan tautan daftar di bawah tombol login -->
    <div class="text-center mt-3">
      <p>Belum punya akun? <a href="register.php">Daftar</a></p>
    </div>
  </div>
</div>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</body>
</html>
