<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>

<body>

    <div class="login-card">
        <div class="brand">
            <div>
                <img class="brand-logo" src="https://cdn-icons-png.flaticon.com/512/3177/3177440.png" alt="">
            </div>
            <h1>Welcome User</h1>
            <p>Create your credentials to access your account</p>
        </div>

        <form id="regdForm">

            <div class="form-group">
                <label for="f_name">Full Name</label>
                <input type="text" id="f_name" placeholder="Enter FullName" name="f_name">
                <div class="error" id="f_nameError"></div>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="name@company.com" autocomplete="email" name="email">
                <div class="error" id="emailError"></div>
            </div>

            <div class="form-group">
                <label for="phone_no">Phone No</label>
                <input type="text" id="phone_no" placeholder="Enter Phone No" name="phone_no">
                <div class="error" id="phone_noError"></div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password" autocomplete="current-password">
                <div class="error" id="passwordError"></div>
            </div>

            <div class="form-group">
                <label for="c_password">Confirm Password</label>
                <input type="password" id="c_password" placeholder="Enter your password" name="c_password" autocomplete="current-password">
                <div class="error" id="c_passwordError"></div>
            </div>

            <button type="submit" class="login-btn" id="loginButton">
                Sign Up
            </button>
        </form>

        <div class="signup-link">
            <p>Don't have an account? <a href="{{ route('Auth.Login') }}">Sign in</a></p>
        </div>
        <div style="text-align: center; color: rgb(13, 94, 13); display: none; margin-top: 10px;" id="regdSuccess">
            <strong>Registration Complete Successfully </strong>
        </div>
    </div>

    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#regdForm").on("submit", function(e) {
                e.preventDefault();

                let f_name = $("#f_name").val().trim();
                let email = $("#email").val().trim();
                let phoneNo = $("#phone_no").val().trim();
                let password = $("#password").val().trim();
                let confirmPassword = $("#c_password").val().trim();
                let loginButton = $("#loginButton");

                let isValid = true;

                // Reset errors
                $("#f_nameError").text("");
                $("#emailError").text("");
                $("#phone_noError").text("");
                $("#passwordError").text("");
                $("#c_passwordError").text("");

                // Validate full name
                if (!f_name) {
                    $("#f_nameError").text("Full Name is required.");
                    isValid = false;
                }

                // Validate email
                if (!email) {
                    $("#emailError").text("Email is required.");
                    isValid = false;
                } else if (!validateEmail(email)) {
                    $("#emailError").text("Invalid email format.");
                    isValid = false;
                }

                // Validate phone number
                if (!phoneNo) {
                    $("#phone_noError").text("Phone number is required.");
                    isValid = false;
                } else if (!/^\d{10}$/.test(phoneNo)) {
                    $("#phone_noError").text("Phone number must be 10 digits.");
                    isValid = false;
                }

                // Validate password
                if (!password) {
                    $("#passwordError").text("Password is required.");
                    isValid = false;
                } else if (password.length < 6) {
                    $("#passwordError").text("Password must be at least 6 characters.");
                    isValid = false;
                }

                // Validate confirm password
                if (!confirmPassword) {
                    $("#c_passwordError").text("Confirm Password is required.");
                    isValid = false;
                } else if (password !== confirmPassword) {
                    $("#c_passwordError").text("Passwords do not match.");
                    isValid = false;
                }

                if (isValid) {
                    loginButton.text("Signing up...").prop("disabled", true);

                    $.ajax({
                        url: "{{ url('/Register/Submit') }}",
                        method: "POST",
                        data: {
                            f_name: f_name,
                            email: email,
                            phone_no: phoneNo,
                            password: password,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.success) {
                                loginButton.text("Sign Up").prop("disabled", false);
                                $('#regdSuccess').show();
                                window.location.href = response.redirect_url;
                            } else {
                                // resetForm();
                                alert(response.error || "Registration failed. Please try again.");
                            }
                        },
                        error: function() {
                            resetForm();
                            alert("An error occurred while registering. Please try again.");
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
                $("#f_name").val("");
                $("#email").val("");
                $("#phone_no").val("");
                $("#password").val("");
                $("#c_password").val("");
                $("#f_nameError").text("");
                $("#emailError").text("");
                $("#phone_noError").text("");
                $("#passwordError").text("");
                $("#c_passwordError").text("");
                $("#loginButton").text("Sign Up").prop("disabled", false);
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
        max-width: 620px;
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









