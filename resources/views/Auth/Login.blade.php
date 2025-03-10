<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>


<body>
    
    <div class="login-card">
        <div class="brand">
            <div>
                <img class="brand-logo" src="https://cdn-icons-png.flaticon.com/512/3177/3177440.png"
                    alt="">
            </div>
            <h1>Welcome</h1>
            <p>Enter your credentials to access your account</p>
        </div>

        <form id="loginForm">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="name@company.com" autocomplete="email" >
                <div class="error" id="emailError"></div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Enter your password" autocomplete="current-password">
                <div class="error" id="passwordError"></div>
            </div>



            <button type="submit" class="login-btn" id="loginButton">
                Sign in
            </button>
        </form>
        
        
        
        <div class="signup-link">
            <p>Have Account ? <a href="{{ route('Auth.Register') }}">Sign up</a></p>
        </div>
        <div style="text-align: center; color: rgb(13, 94, 13); display: none; margin-top: 10px; " id="loginSuccess"><strong>Login Successfull</strong></div>
    </div>
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#loginForm").on("submit", function(e) {
                e.preventDefault();

                let email = $("#email").val().trim();
                let password = $("#password").val().trim();
                let loginButton = $("#loginButton");

                let isValid = true;

                // Reset errors
                $("#emailError").text("");
                $("#passwordError").text("");

                // Validate email
                if (!email) {
                    $("#emailError").text("Email is required.");
                    isValid = false;
                } else if (!validateEmail(email)) {
                    $("#emailError").text("Invalid email format.");
                    isValid = false;
                }

                // Validate password
                if (!password) {
                    $("#passwordError").text("Password is required.");
                    isValid = false;
                }

                if (isValid) {

                    loginButton.text("Signing in...").prop("disabled", true);

                    $.ajax({
                        url: "{{ url('/Login/CheckUser') }}",
                        method: "POST",
                        data: {
                            email: email,
                            password: password,
                            _token: "{{ csrf_token() }}" 
                        },
                        success: function(response) {
                            if (response.success) {
                               
                               loginButton.text("Signing in").prop("disabled", false);
                               $('#loginSuccess').show();

                                window.location.href = response.redirect_url;
                                // console.log(response);
                                
                            } 
                            else {
                                
                                alert(response.error ||
                                "Invalid credentials. Please try again.");
                                }
                                resetForm();
                        },
                        error: function() {
                            // Reset form and errors on AJAX error
                            resetForm();
                            alert("An error occurred while logging in. Please try again.");
                        }
                    });
                }
            });

            // Helper function to validate email format
            function validateEmail(email) {
                const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return regex.test(email);
            }

            // Helper function to reset form
            function resetForm() {
                $("#email").val("");
                $("#password").val("");
                $("#emailError").text("");
                $("#passwordError").text("");
                $("#loginButton").text("Sign in").prop("disabled", false);
            }
        });
    </script>

</body>


</html>


<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Inter', sans-serif;
    }

    body {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f5f5f5;
        padding: 20px;
    }

    .login-card {
        background: white;
        border-radius: 20px;
        padding: 3rem 2rem;
        width: 100%;
        max-width: 450px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
    }

    .brand {
        text-align: center;
        margin-bottom: 2rem;
    }

    .brand-logo {
        width: 50px;
        height: 50px;
        /* background: #000; */
        border-radius: 50%;
        margin: 0 auto 1rem;
    }

    .brand h1 {
        font-size: 1.75rem;
        color: #5156be;
        margin-bottom: 0.5rem;
    }

    .brand p {
        color: #666;
        font-size: 0.95rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
        position: relative;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        color: #333;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .form-group input {
        width: 100%;
        padding: 0.8rem 1rem;
        border: 2px solid #e1e1e1;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-group input:focus {
        outline: none;
        border-color: #000;
        box-shadow: 0 0 0 4px rgba(0, 0, 0, 0.1);
    }

    .remember-forgot {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .remember-me {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .remember-me input[type="checkbox"] {
        width: 16px;
        height: 16px;
        border-radius: 4px;
    }

    .remember-me label {
        color: #666;
        font-size: 0.9rem;
    }

    .forgot-password {
        color: #000;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .login-btn {
        width: 100%;
        padding: 1rem;
        background: #5156be;
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .login-btn:hover {
        background: #5156be;
        transform: translateY(-2px);
    }

    .login-btn:active {
        transform: translateY(0);
    }

    .social-login {
        margin-top: 2rem;
        text-align: center;
    }

    .social-login p {
        color: #666;
        font-size: 0.9rem;
        margin-bottom: 1rem;
        position: relative;
    }

    .social-login p::before,
    .social-login p::after {
        content: "";
        position: absolute;
        top: 50%;
        width: 45%;
        height: 1px;
        background: #e1e1e1;
    }

    .social-login p::before {
        left: 0;
    }

    .social-login p::after {
        right: 0;
    }

    .social-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
    }

    .social-btn {
        width: 50px;
        height: 50px;
        border: 2px solid #e1e1e1;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .social-btn:hover {
        border-color: #5156be;
        background: #f5f5f5;
    }

    .signup-link {
        text-align: center;
        margin-top: 1.5rem;
    }

    .signup-link a {
        color: #5156be;
        text-decoration: none;
        font-weight: 600;
    }

    .signup-link a:hover {
        text-decoration: underline;
    }

    .error {
        color: #dc3545;
        font-size: 0.85rem;
        margin-top: 0.5rem;

    }

    @keyframes shake {

        0%,
        100% {
            transform: translateX(0);
        }

        20%,
        60% {
            transform: translateX(-5px);
        }

        40%,
        80% {
            transform: translateX(5px);
        }
    }

    .shake {
        animation: shake 0.5s ease;
    }
</style>
