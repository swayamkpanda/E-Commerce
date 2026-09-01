<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>YFF — Create Account</title>

    <link rel="stylesheet" href="../assets/css/auth.css">
</head>

<body>

<div class="auth-scene">

    <!-- Shadow Character -->

    <div class="shadow-runner" id="shadowRunner">

        <div class="shadow-head"></div>

        <div class="shadow-body"></div>

        <div class="shadow-arm arm-left"></div>
        <div class="shadow-arm arm-right"></div>

        <div class="shadow-leg leg-left"></div>
        <div class="shadow-leg leg-right"></div>

        <div class="shadow-shoe shoe-left"></div>
        <div class="shadow-shoe shoe-right"></div>

        <div class="trolley-handle"></div>
        <div class="trolley"></div>

        <div class="trolley-wheel wheel-left"></div>
        <div class="trolley-wheel wheel-right"></div>

    </div>


    <!-- Signup Card -->

    <div class="auth-card" id="signupCard">

        <div class="auth-logo">
            YFF
        </div>

        <h1>Create Account</h1>

        <p class="auth-subtitle">
            Start your sustainable fashion journey.
        </p>

        <form id="registerForm">

            <div class="input-group">

                <label>Full Name</label>

                <input
                    type="text"
                    id="registerName"
                    placeholder="Enter your name"
                    required
                >

            </div>


            <div class="input-group">

                <label>Email</label>

                <input
                    type="email"
                    id="registerEmail"
                    placeholder="Enter your email"
                    required
                >

            </div>


            <div class="input-group">

                <label>Password</label>

                <input
                    type="password"
                    id="registerPassword"
                    placeholder="Create a password"
                    required
                >

            </div>


            <button type="submit" class="auth-submit">
                Create Account
            </button>

        </form>


        <p class="auth-switch">

            Already have an account?

            <a href="login.php">
                Login
            </a>

        </p>

    </div>


    <!-- Success -->

    <div class="success-screen" id="successScreen">

        <div class="success-circle">
            <span>✓</span>
        </div>

        <h2 id="successTitle">
            Account Created!
        </h2>

        <p id="successMessage">
            Welcome to YFF.
        </p>

    </div>


    <div class="auth-status" id="authStatus">
        Preparing your experience...
    </div>

</div>


<script src="../assets/js/auth.js"></script>

</body>
</html>