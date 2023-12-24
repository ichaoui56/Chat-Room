
<link rel="stylesheet" href="<?= PATH ?>assets/css/login.css">

<input id="checkbox_toggle" type="checkbox" class="check">
<div class="checkbox">
    <label class="slide" for="checkbox_toggle">
        <label class="toggle" for="checkbox_toggle"></label>
        <label class="text" for="checkbox_toggle">Login</label>
        <label class="text" for="checkbox_toggle">Register</label>
    </label>
</div>

<section id="container">
    <div class="ring" style="width: 500px; height: 500px;">
        <i style="--clr:#00ff0a;"></i>
        <i style="--clr:#ff0057;"></i>
        <i style="--clr:#fffd44;"></i>

        <!-- login form  -->
        <div id="loginForm" class="login">
            <h2>Login</h2>
            <div class="box-input">
                <div class="border">
                    <input type="email" name="email" class="input" placeholder="Email">
                </div>
            </div>

            <div class="box-input">
                <div class="border">
                    <input type="password" name="password" class="input" placeholder="Password">
                </div>
            </div>

            <button type="submit" class="animated-button"><span>SIGN IN</span></button>

        </div>

    </div>

    <div class="ring" style="display: none;width: 650px; height: 650px;">
        <i style="--clr:#00ff0a;"></i>
        <i style="--clr:#ff0057;"></i>
        <i style="--clr:#fffd44;"></i>

        <!-- register form  -->
        <div id="registerForm" class="login">
            <h2>Register</h2>

            <div class="input-div">
                <input class="upload" name="file" type="file">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" stroke-linejoin="round"
                     stroke-linecap="round" viewBox="0 0 24 24" stroke-width="2" fill="none" stroke="currentColor" class="icon">
                    <polyline points="16 16 12 12 8 16"></polyline>
                    <line y2="21" x2="12" y1="12" x1="12"></line>
                    <path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"></path>
                    <polyline points="16 16 12 12 8 16"></polyline>
                </svg>
            </div>

            <div class="box-input">
                <div class="border">
                    <input type="email" name="email" class="input" placeholder="Email"
                           pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Please enter a valid email address.">
                </div>
            </div>

            <div class="box-input">
                <div class="border">
                    <input type="email" name="email" class="input" placeholder="Email"
                           pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Please enter a valid email address.">
                </div>
            </div>

            <div class="box-input">
                <div class="border">
                    <input type="password" name="password" class="input" placeholder="Password"
                           pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                           title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                </div>
            </div>

            <div class="box-input">
                <div class="border">
                    <input type="password" name="cpassword" class="input" placeholder="Confirm Password ">
                </div>
            </div>

            <button type="submit" class="animated-button"><span>SIGN UP</span></button>

        </div>

    </div>
</section>