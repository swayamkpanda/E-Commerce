document.addEventListener("DOMContentLoaded", () => {

    /* =========================================================
       ELEMENTS
    ========================================================= */

    const runner = document.getElementById("shadowRunner");

    const loginCard = document.getElementById("loginCard");
    const signupCard = document.getElementById("signupCard");

    const successScreen =
        document.getElementById("successScreen");

    const successTitle =
        document.getElementById("successTitle");

    const successMessage =
        document.getElementById("successMessage");

    const status =
        document.getElementById("authStatus");

    const loginForm =
        document.getElementById("loginForm");

    const registerForm =
        document.getElementById("registerForm");

    /* =========================================================
       CONFIGURATION
       ========================================================= */

    /*
     * IMPORTANT:
     * Your main YFF website homepage.
     *
     * If your homepage has a different filename,
     * change this.
     */
    const WEBSITE_URL = "../index.php";


    /*
     * API locations
     */

    const LOGIN_API =
        "../api/auth/login.php";

    const REGISTER_API =
        "../api/auth/register.php";


    /*
     * Prevent multiple animations at once
     */

    let animationRunning = false;


    /* =========================================================
       HELPER FUNCTIONS
       ========================================================= */

    function hideCards() {

        if (loginCard) {
            loginCard.classList.remove("visible");
        }

        if (signupCard) {
            signupCard.classList.remove("visible");
        }
    }


    function resetRunner() {

        if (!runner) {
            return;
        }

        runner.style.display = "block";

        runner.classList.remove(
            "run-in",
            "run-out",
            "running"
        );

        /*
         * Force browser to restart animation
         */

        void runner.offsetWidth;
    }


    function shadowRunIn() {

        resetRunner();

        runner.classList.add(
            "running",
            "run-in"
        );
    }


    function shadowRunOut() {

        if (!runner) {
            return;
        }

        runner.classList.remove(
            "run-in",
            "running"
        );

        void runner.offsetWidth;

        runner.classList.add(
            "run-out"
        );
    }


    function hideShadow() {

        if (!runner) {
            return;
        }

        runner.style.display = "none";
    }


    /* =========================================================
       INITIAL PAGE ANIMATION
       ========================================================= */

    function deliverAuthPage() {

        if (!runner) {
            return;
        }

        animationRunning = true;

        hideCards();

        resetRunner();


        /*
         * Shadow starts running
         */

        shadowRunIn();


        if (status) {
            status.textContent =
                "The shadow shopper is running in…";
        }


        /*
         * Status update
         */

        setTimeout(() => {

            if (status) {

                status.textContent =
                    "Taking your page from the trolley…";

            }

        }, 900);


        /*
         * Show authentication card
         */

        setTimeout(() => {

            if (loginCard) {

                loginCard.classList.add(
                    "visible"
                );

            }

            if (signupCard) {

                signupCard.classList.add(
                    "visible"
                );

            }


            if (status) {

                status.textContent =
                    "Delivered!";

            }


            /*
             * Shadow leaves
             */

            shadowRunOut();


            /*
             * Completely remove shadow
             */

            setTimeout(() => {

                hideShadow();

                animationRunning = false;

                if (status) {

                    status.textContent =
                        "Ready.";

                }

            }, 1200);

        }, 1500);
    }


    /* =========================================================
       LOGIN / SIGNUP PAGE SWITCH
       ========================================================= */

    function switchAuthPage(type) {

        if (animationRunning) {
            return;
        }

        if (!runner) {
            return;
        }

        animationRunning = true;


        /*
         * Hide current page
         */

        hideCards();


        /*
         * Bring shadow back
         */

        runner.style.display = "block";

        runner.classList.remove(
            "run-in",
            "run-out",
            "running"
        );

        void runner.offsetWidth;


        runner.classList.add(
            "running",
            "run-in"
        );


        if (status) {

            status.textContent =
                "Packing the current page into the trolley…";

        }


        /*
         * Shadow returns with new page
         */

        setTimeout(() => {

            if (status) {

                status.textContent =
                    "Bringing the " +
                    type +
                    " page…";

            }

        }, 900);


        /*
         * Show new page
         */

        setTimeout(() => {

            if (type === "login") {

                if (loginCard) {

                    loginCard.classList.add(
                        "visible"
                    );

                }

            } else {

                if (signupCard) {

                    signupCard.classList.add(
                        "visible"
                    );

                }

            }


            /*
             * Shadow leaves again
             */

            shadowRunOut();


            setTimeout(() => {

                hideShadow();

                animationRunning = false;

                if (status) {

                    status.textContent =
                        "Ready.";

                }

            }, 1200);

        }, 1500);
    }


    /* =========================================================
       SUCCESSFUL AUTHENTICATION
       ========================================================= */

    function authenticationSuccess(type) {

        if (animationRunning) {
            return;
        }

        animationRunning = true;


        /*
         * Hide authentication card
         */

        hideCards();


        /*
         * Bring shadow back
         */

        if (runner) {

            runner.style.display =
                "block";

            runner.classList.remove(
                "run-in",
                "run-out",
                "running"
            );

            void runner.offsetWidth;

            runner.classList.add(
                "running",
                "run-in"
            );
        }


        if (status) {

            status.textContent =
                "The shadow is collecting your page…";

        }


        /*
         * Shadow reaches the page
         */

        setTimeout(() => {

            if (status) {

                status.textContent =
                    "Putting your page into the trolley…";

            }

        }, 700);


        /*
         * Shadow runs away
         */

        setTimeout(() => {

            shadowRunOut();


            if (status) {

                status.textContent =
                    "Completing authentication…";

            }

        }, 1100);


        /*
         * SUCCESS SCREEN
         */

        setTimeout(() => {

            hideShadow();


            if (type === "login") {

                if (successTitle) {

                    successTitle.textContent =
                        "Login Successful!";

                }

                if (successMessage) {

                    successMessage.textContent =
                        "Welcome back to YFF.";

                }

            } else {

                if (successTitle) {

                    successTitle.textContent =
                        "Account Created!";

                }

                if (successMessage) {

                    successMessage.textContent =
                        "Welcome to the YFF community.";

                }

            }


            /*
             * Show success animation
             */

            if (successScreen) {

                successScreen.classList.add(
                    "visible"
                );

            }


            if (status) {

                status.textContent =
                    "Completed ✓";

            }


            /*
             * Redirect after success animation
             *
             * 2.5 seconds gives the user enough time
             * to see the success message.
             */

            setTimeout(() => {

                window.location.href =
                    WEBSITE_URL;

            }, 2500);

        }, 2200);
    }


    /* =========================================================
       API ERROR
       ========================================================= */

    function showAuthenticationError(message) {

        animationRunning = false;


        /*
         * Show card again
         */

        if (loginForm && !registerForm) {

            if (loginCard) {

                loginCard.classList.add(
                    "visible"
                );

            }

        }


        if (registerForm && !loginForm) {

            if (signupCard) {

                signupCard.classList.add(
                    "visible"
                );

            }

        }


        if (status) {

            status.textContent =
                message ||
                "Something went wrong. Please try again.";

        }


        /*
         * Small shake effect
         */

        const activeCard =
            loginCard &&
            loginCard.classList.contains("visible")
                ? loginCard
                : signupCard;


        if (activeCard) {

            activeCard.animate(
                [
                    {
                        transform:
                            "translateY(0)"
                    },
                    {
                        transform:
                            "translateX(-8px)"
                    },
                    {
                        transform:
                            "translateX(8px)"
                    },
                    {
                        transform:
                            "translateX(-5px)"
                    },
                    {
                        transform:
                            "translateX(0)"
                    }
                ],
                {
                    duration: 350
                }
            );

        }

    }


    /* =========================================================
       API REQUEST
       ========================================================= */

    async function sendAuthenticationRequest(
        apiURL,
        data,
        type
    ) {

        try {

            if (status) {

                status.textContent =
                    "Checking your details…";

            }


            const response =
                await fetch(
                    apiURL,
                    {
                        method: "POST",

                        headers: {
                            "Content-Type":
                                "application/json"
                        },

                        body:
                            JSON.stringify(data)
                    }
                );


            /*
             * Try JSON first
             */

            let result;

            try {

                result =
                    await response.json();

            } catch (jsonError) {

                result = null;

            }


            /*
             * HTTP failure
             */

            if (!response.ok) {

                throw new Error(
                    result &&
                    result.message
                        ? result.message
                        : "Authentication failed."
                );

            }


            /*
             * Backend failure
             */

            if (
                result &&
                result.success === false
            ) {

                throw new Error(
                    result.message ||
                    "Invalid credentials."
                );

            }


            /*
             * SUCCESS
             */

            authenticationSuccess(type);


        } catch (error) {

            console.error(
                "Authentication error:",
                error
            );


            showAuthenticationError(
                error.message
            );

        }

    }


    /* =========================================================
       LOGIN FORM
       ========================================================= */

    if (loginForm) {

        loginForm.addEventListener(
            "submit",
            async (event) => {

                event.preventDefault();


                if (animationRunning) {
                    return;
                }


                const emailInput =
                    document.getElementById(
                        "loginEmail"
                    );

                const passwordInput =
                    document.getElementById(
                        "loginPassword"
                    );


                if (
                    !emailInput ||
                    !passwordInput
                ) {

                    return;

                }


                const email =
                    emailInput.value.trim();

                const password =
                    passwordInput.value;


                /*
                 * Basic validation
                 */

                if (!email) {

                    showAuthenticationError(
                        "Please enter your email."
                    );

                    return;

                }


                if (!password) {

                    showAuthenticationError(
                        "Please enter your password."
                    );

                    return;

                }


                /*
                 * Send to PHP API
                 */

                await sendAuthenticationRequest(
                    LOGIN_API,
                    {
                        email: email,
                        password: password
                    },
                    "login"
                );

            }
        );

    }


    /* =========================================================
       REGISTER FORM
       ========================================================= */

    if (registerForm) {

        registerForm.addEventListener(
            "submit",
            async (event) => {

                event.preventDefault();


                if (animationRunning) {
                    return;
                }


                const nameInput =
                    document.getElementById(
                        "registerName"
                    );

                const emailInput =
                    document.getElementById(
                        "registerEmail"
                    );

                const passwordInput =
                    document.getElementById(
                        "registerPassword"
                    );


                if (
                    !nameInput ||
                    !emailInput ||
                    !passwordInput
                ) {

                    return;

                }


                const name =
                    nameInput.value.trim();

                const email =
                    emailInput.value.trim();

                const password =
                    passwordInput.value;


                /*
                 * Validation
                 */

                if (!name) {

                    showAuthenticationError(
                        "Please enter your name."
                    );

                    return;

                }


                if (!email) {

                    showAuthenticationError(
                        "Please enter your email."
                    );

                    return;

                }


                if (!password) {

                    showAuthenticationError(
                        "Please create a password."
                    );

                    return;

                }


                /*
                 * Send registration request
                 */

                await sendAuthenticationRequest(
                    REGISTER_API,
                    {
                        name: name,
                        email: email,
                        password: password
                    },
                    "register"
                );

            }
        );

    }


    /* =========================================================
       LOGIN → SIGNUP
       ========================================================= */

    const signupLink =
        document.querySelector(
            "#loginCard .auth-switch a"
        );


    if (signupLink) {

        signupLink.addEventListener(
            "click",
            (event) => {

                /*
                 * Keep normal navigation if the
                 * animation cannot run.
                 */

                if (
                    !runner ||
                    !signupCard ||
                    !loginCard
                ) {

                    return;

                }


                event.preventDefault();


                switchAuthPage(
                    "signup"
                );

            }
        );

    }


    /* =========================================================
       SIGNUP → LOGIN
       ========================================================= */

    const loginLink =
        document.querySelector(
            "#signupCard .auth-switch a"
        );


    if (loginLink) {

        loginLink.addEventListener(
            "click",
            (event) => {

                if (
                    !runner ||
                    !signupCard ||
                    !loginCard
                ) {

                    return;

                }


                event.preventDefault();


                switchAuthPage(
                    "login"
                );

            }
        );

    }


    /* =========================================================
       START INITIAL ANIMATION
       ========================================================= */

    setTimeout(() => {

        deliverAuthPage();

    }, 400);

});