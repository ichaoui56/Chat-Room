
<link rel="stylesheet" href="<?= PATH ?>assets/css/login.css">
<title><?= ucfirst($page) ?></title>

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
        <form action="index.php?page=login"  id="loginForm" class="login" method="post">
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

                <button type="submit" name="login" class="animated-button"><span>SIGN IN</span></button>
        </form>

    </div>

    <div class="ring" style="display: none;width: 650px; height: 650px;">
        <i style="--clr:#00ff0a;"></i>
        <i style="--clr:#ff0057;"></i>
        <i style="--clr:#fffd44;"></i>

        <!-- register form  -->
        <form action="index.php?page=login" id="registerForm" class="login" method="post" enctype="multipart/form-data">
                <h2>Register</h2>

                <div class="input-div">
                    <input class="upload" name="picture" accept="image/*" type="file">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" stroke-linejoin="round"
                         stroke-linecap="round" viewBox="0 0 24 24" stroke-width="2" fill="none" stroke="currentColor" class="icon">
                        <polyline points="16 16 12 12 8 16"></polyline>
                        <line y2="21" x2="12" y1="12" x1="12"></line>
                        <path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"></path>
                        <polyline points="16 16 12 12 8 16"></polyline>
                    </svg>
                </div>²

                <div class="box-input">
                    <div class="border">
                        <input type="text" name="username" class="input" placeholder="Username"
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
                        <input type="password" name="password" class="input" placeholder="Password">
                    </div>
                </div>

                <button type="submit" name="signup" class="animated-button"><span>SIGN UP</span></button>

        </form>

    </div>
</section>