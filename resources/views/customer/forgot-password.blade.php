<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page - H2ST</title>
    <link href="../customer/login/login-styles.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://apis.google.com/js/platform.js" async defer></script>

<body>
    <div class="cover-page">
        <header>
            <nav>
                <div class="logo">
                    <p>My logo</p>
                </div>
            </nav>
        </header>
        <main>
            <div class="login-container">
                <div class="title">
                    <h3 class="title-child">Welcome to <span class="flag-green">H2ST Furniture</span></h3>
                    <h3 class="title-child">No Account ?<br><a href="{{ url('customer/register-customer') }}"
                            class="flag-green">Sign up</a></h3>
                </div><br>
                <h1 class="title-signin">Reset Password</h1>
                <div class="login-icons">
                    <a href="{{ route('login.google') }}" class="with-google" onclick="signInWithGoogle()">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26"
                                fill="none">
                                <path
                                    d="M24.3761 13.2525C24.3761 12.3173 24.2987 11.6348 24.1311 10.927H13.2333V15.1483H19.6301C19.5011 16.1974 18.8047 17.7773 17.2571 18.8389L17.2354 18.9802L20.6811 21.5962L20.9198 21.6195C23.1122 19.6352 24.3761 16.7156 24.3761 13.2525Z"
                                    fill="#4285F4" />
                                <path
                                    d="M13.2326 24.3751C16.3664 24.3751 18.9974 23.3639 20.919 21.6198L17.2563 18.8392C16.2762 19.509 14.9607 19.9767 13.2326 19.9767C10.1632 19.9767 7.55803 17.9924 6.62938 15.2498L6.49326 15.2611L2.9104 17.9785L2.86354 18.1061C4.77224 21.822 8.69287 24.3751 13.2326 24.3751Z"
                                    fill="#34A853" />
                                <path
                                    d="M6.63006 15.2496C6.38502 14.5418 6.24321 13.7834 6.24321 12.9999C6.24321 12.2162 6.38502 11.4579 6.61717 10.7501L6.61067 10.5994L2.9829 7.83838L2.86421 7.89371C2.07754 9.43567 1.62614 11.1672 1.62614 12.9999C1.62614 14.8325 2.07754 16.564 2.86421 18.1059L6.63006 15.2496Z"
                                    fill="#FBBC05" />
                                <path
                                    d="M13.2326 6.0233C15.4122 6.0233 16.8824 6.94594 17.7207 7.71696L20.9965 4.5825C18.9846 2.74987 16.3665 1.625 13.2326 1.625C8.6929 1.625 4.77225 4.17804 2.86354 7.89384L6.61651 10.7503C7.55806 8.00763 10.1632 6.0233 13.2326 6.0233Z"
                                    fill="#EB4335" />
                            </svg>
                            <p>Sign in with Google</p>
                        </div>
                    </a>
                    <a href="{{ route('login.facebook') }}" class="with-facebook">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" viewBox="0 0 29 29"
                                fill="none">
                                <circle cx="14.5" cy="13.3401" r="12.6875" fill="url(#paint0_linear_31_14)" />
                                <path
                                    d="M19.2249 18.3802L19.7885 14.7992H16.2629V12.4763C16.2629 11.4964 16.7544 10.5407 18.3336 10.5407H19.9375V7.49196C19.9375 7.49196 18.4825 7.25 17.0921 7.25C14.1872 7.25 12.2903 8.96548 12.2903 12.0698V14.7992H9.0625V18.3802H12.2903V27.0375C12.9383 27.1367 13.6012 27.1875 14.2766 27.1875C14.9519 27.1875 15.6148 27.1367 16.2629 27.0375V18.3802H19.2249Z"
                                    fill="white" />
                                <defs>
                                    <linearGradient id="paint0_linear_31_14" x1="14.5" y1="0.652588"
                                        x2="14.5" y2="25.9523" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#18ACFE" />
                                        <stop offset="1" stop-color="#0163E0" />
                                    </linearGradient>
                                </defs>
                            </svg>
                            <p>Sign in with Facebook</p>
                        </div>
                    </a>
                </div>
                <div class="login-form">
                    <form method="POST" action="{{ route('postForgotPassword') }}">
                        @if (Session::has('success'))
                            {{ Session::get('success') }}
                        @endif
                        @csrf
                        <div>
                            <label for="useremail">Email</label>
                            <input id="useremail" class="userInput" type="email" name="useremail" required autofocus>
                            @error('useremail')
                                <span role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <button class="submitButton" type="submit">Send Password Reset Link</button>
                        </div>
                    </form>
                </div>
                <h3 class="title-child">Do you have any Account? Let's <br><a
                        href="{{ url('customer/login-customer') }}" class="flag-green">Sign in</a></h3>
            </div>
        </main>
    </div>
</body>

</html>
