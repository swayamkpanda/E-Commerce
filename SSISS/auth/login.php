<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YFF — Login</title>

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

        <!-- Trolley -->
        <div class="trolley-handle"></div>
        <div class="trolley"></div>

        <div class="trolley-wheel wheel-left"></div>
        <div class="trolley-wheel wheel-right"></div>

    </div>


    <!-- Login Card -->
    <div class="auth-card" id="loginCard">

        <div class="auth-logo">
            YFF
        </div>

        <h1>Welcome Back</h1>

        <p class="auth-subtitle">
            Login to continue your sustainable fashion journey.
        </p>

        <form id="loginForm">

            <div class="input-group">
                <label>Email</label>
                <input
                    type="email"
                    id="loginEmail"
                    placeholder="Enter your email"
                    required
                >
            </div>

            <div class="input-group">
                <label>Password</label>
                <input
                    type="password"
                    id="loginPassword"
                    placeholder="Enter your password"
                    required
                >
            </div>

            <button type="submit" class="auth-submit">
                Login
            </button>

        </form>

        <p class="auth-switch">
            Don't have an account?
            <a href="register.php">Create Account</a>
        </p>

    </div>


    <!-- Success Screen -->
    <div class="success-screen" id="successScreen">

        <div class="success-circle">
            <span>✓</span>
        </div>

        <h2 id="successTitle">
            Login Successful!
        </h2>

        <p id="successMessage">
            Welcome back to YFF.
        </p>

    </div>


    <!-- Loading / Status -->
    <div class="auth-status" id="authStatus">
        Preparing your experience...
    </div>

</div>


<script src="../assets/js/auth.js"></script>

</body>
</html>