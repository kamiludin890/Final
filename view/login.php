<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Final App</title>
    <link rel="icon" href="public/icon/Final.png" type="image/x-icon">
    <link rel="stylesheet" href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            font-family: var(--font-family);
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #311042 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
            margin: 0;
            padding: 20px;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.04);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 24px;
            padding: 45px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            animation: cardEntrance 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            position: relative;
        }

        @keyframes cardEntrance {
            from {
                opacity: 0;
                transform: translateY(40px) scale(0.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .login-logo {
            width: 70px;
            height: 70px;
            object-fit: contain;
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.9);
            padding: 10px;
            margin-bottom: 20px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            transition: transform 0.4s ease;
        }

        .login-logo:hover {
            transform: scale(1.08) rotate(5deg);
        }

        .login-header h3 {
            color: #ffffff;
            font-weight: 800;
            letter-spacing: -0.02em;
            margin-bottom: 6px;
        }

        .login-header p {
            color: #94a3b8;
            font-size: 0.9rem;
            margin-bottom: 30px;
        }

        .form-group-custom {
            position: relative;
            margin-bottom: 22px;
        }

        .form-group-custom i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 1.1rem;
            transition: color 0.3s ease;
        }

        .form-control-custom {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 14px 16px 14px 48px;
            color: #ffffff;
            font-size: 0.95rem;
            font-weight: 500;
            width: 100%;
            transition: all 0.3s ease;
        }

        .form-control-custom::placeholder {
            color: #475569;
        }

        .form-control-custom:focus {
            background: rgba(255, 255, 255, 0.06);
            border-color: #3b82f6;
            outline: none;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
        }

        .form-control-custom:focus+i {
            color: #3b82f6;
        }

        .btn-login {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-weight: 700;
            font-size: 0.95rem;
            letter-spacing: 0.02em;
            color: #ffffff;
            width: 100%;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            margin-top: 10px;
            box-shadow: 0 8px 16px -4px rgba(37, 99, 235, 0.4);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px -4px rgba(37, 99, 235, 0.5);
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .login-alert {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #fca5a5;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 0.85rem;
            font-weight: 500;
            display: none;
            margin-bottom: 20px;
            align-items: center;
            gap: 8px;
            animation: shake 0.4s ease;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-6px);
            }

            75% {
                transform: translateX(6px);
            }
        }

        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
            border-width: 0.15em;
        }

        .footer-text {
            color: #475569;
            font-size: 0.75rem;
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>

<body>

    <div class="login-card">
        <div class="text-center">
            <img src="public/icon/Final.png" class="login-logo" alt="Final Logo">
        </div>
        <div class="login-header text-center">
            <h3>Selamat Datang</h3>
            <p>Silakan masuk untuk mengakses sistem ERP</p>
        </div>

        <div class="login-alert" id="login-alert-box">
            <i class="bi bi-exclamation-triangle-fill"></i>
            <span id="login-alert-msg">Username atau password salah!</span>
        </div>
        <form id="login-form">
            <div class="form-group-custom">
                <input type="text" id="username" class="form-control-custom" placeholder="Username" required autocomplete="off">
                <i class="bi bi-person-fill"></i>
            </div>
            <div class="form-group-custom">
                <input type="password" id="password" class="form-control-custom" placeholder="Password" required>
                <i class="bi bi-shield-lock-fill"></i>
            </div>
            <button type="submit" class="btn-login" id="btn-submit-login">
                <span id="btn-text">MASUK</span>
                <span class="spinner-border spinner-border-sm d-none" id="btn-spinner" role="status" aria-hidden="true"></span>
            </button>
        </form>

        <div class="footer-text">
            &copy; 2026 Final ERP. All rights reserved.
        </div>
    </div>
    <script src="/public/js/jquery.js"></script>
    <script>
        $(document).ready(function() {
            $("#login-form").on("submit", function(e) {
                e.preventDefault();

                const username = $("#username").val().trim();
                const password = $("#password").val();

                $("#login-alert-box").hide();
                $("#btn-text").text("MEMVALIDASI...");
                $("#btn-spinner").removeClass("d-none");
                $("#btn-submit-login").prop("disabled", true);

                $.post("/model/login.php", {
                    username: username,
                    password: password
                }, function(res) {
                    $("#btn-text").text("MASUK");
                    $("#btn-spinner").addClass("d-none");
                    $("#btn-submit-login").prop("disabled", false);

                    if (res.status === 'success') {
                        window.location.reload();
                    } else {
                        $("#login-alert-msg").text(res.message);
                        $("#login-alert-box").css("display", "flex");
                    }
                }, "json").fail(function() {
                    $("#btn-text").text("MASUK");
                    $("#btn-spinner").addClass("d-none");
                    $("#btn-submit-login").prop("disabled", false);

                    $("#login-alert-msg").text("Terjadi kesalahan sistem. Coba beberapa saat lagi.");
                    $("#login-alert-box").css("display", "flex");
                });
            });
        });
    </script>
</body>

</html>