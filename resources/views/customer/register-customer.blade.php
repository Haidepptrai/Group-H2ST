<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Page - H2ST</title>
    <link href="../customer/login/register-styles.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Add the SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <!-- Add the SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>

<body>
    <div class="cover-page">
        <header>
            <nav>
                <div class="logo">
                    <a href="{{route('home')}}">H2ST Furniture Shop</a>
                </div>
            </nav>
        </header>
        <main>
            <div class="login-container">
                <div class="title">
                    <h3 class="title-child">Welcome to <span class="flag-green">H2ST Furniture</span></h3>
                    <h3 class="title-child">Do you have any Account ?<br><a href="{{ url('customer/login-customer') }}"
                            class="flag-green">Sign in</a></h3>
                </div>
                <h1 class="title-signin">Sign up</h1>
                <div class="login-form">
                    <form class="pt-3" action="{{ route('userRegisterProcess') }}" method="POST"
                        enctype="multipart/form-data" id="signup-form">

                        @csrf
                        <label for="userFullname">Enter first name</label><br>
                        <input type="text" class="userInput" id="userfirstname" name="userFirstname"
                            placeholder="Your first name"><br>
                        <label for="userLastname">Enter last name</label><br>
                        <input type="text" class="userInput" id="userlastname" name="userLastname"
                            placeholder="Your last name"><br>
                        <label for="userEmail">Enter your email address</label><br>
                        <input type="email" class="userInput" id="userEmail" name="userEmail"
                            placeholder="Your email address"><br>
                        <div class="input-group">
                            <div class="input-item">
                                <label for="username">Username</label><br>
                                <input type="text" class="userInput" id="username" name="userName"
                                    placeholder="Your username" required pattern="[a-zA-Z0-9_]{3,20}"
                                    title="Username must be between 3 and 20 characters and can contain letters, numbers, and underscores"><br>
                            </div>
                            <div class="input-item">
                                <label for="contactNum">Contact number</label><br>
                                <input type="tel" class="userInput" id="contactNum" name="contactNum"
                                    placeholder="Your phone number" required pattern="[0-9]{9,12}"
                                    title="Please enter a valid 9 to 12 digit phone number"><br>
                            </div>
                        </div>
                        <label for="userPassword">Enter your password</label><br>
                        <input type="password" class="userInput" id="userPassword" name="userPassword"
                            placeholder="Password" pattern="[a-zA-Z0-9_]{3,20}"  title="Username must be between 6 and 20 characters and can contain letters, numbers, and underscores">
                        <i id="eye-icon" class="fas fa-eye eye-icon" onclick="togglePasswordVisibility()"></i>
                        <label for="userAddress">Address</label><br>
                        <input type="text" class="userInput" id="useraddress" name="userAddress"
                            placeholder="Your address"><br>
                        <input type="submit" class="submitButton" value="Sign up">
                    </form>
                </div>
            </div>
        </main>
        <script src="../../public/customer/login/handleDialog.js"></script>
        <script src="../../public/customer/login/showPassword.js"></script>
    </div>
</body>

</html>
