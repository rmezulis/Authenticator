<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Register</title>
    <meta name="description" content="The HTML5 Herald"/>
    <meta name="author" content="SitePoint"/>
    <link rel="stylesheet" href="App/Views/styles.css" type="text/css"/>
</head>
<body>
<div class="authenticator">
    <div class="container">
    <div class="background">
        <div class="my-profile">
            <p class="title">My profile</p>
            <p class="description profile-info">Name: <?php echo $_SESSION['name']; ?></p>
            <p class="description profile-info">Email: <?php echo $_SESSION['email']; ?></p>
            <button class="button button-blue" onclick="myAttributes()">MY ATTRIBUTES</button>
        </div>
        <div class="my-attributes">
            <p class="title">My attributes</p>
                <?php foreach ($_SESSION['attributes'] as $attribute) {?>
            <p class="description"><?php echo $attribute['name'] . ': ' . $attribute['value'];?></p>
                <?php } ?>
            <button class="button button-blue" onclick="myProfile()">MY PROFILE</button>
        </div>
    </div>
    <div class="profile" id="profile">
        <div class="profile-container">
            <span class="profile-title">Edit profile</span>
            <img class="logo" src="App/Views/logo.png" alt="logo"/>
        </div>
        <div class="break"></div>
        <form method="post" action="/profile/edit">
            <label for="name">Name<span class="star">*</span></label>
            <input class="input" id="name" type="text" name="name" value="<?php echo $_SESSION['name']?>" required/><br/>
            <label for="email">Email<span class="star">*</span></label>
            <input class="input" id="email" type="email" name="email" value="<?php echo $_SESSION['email']?>" required/><br/>
            <div class="login-button-container">
                <input class="button save" type="submit" value="SAVE"/>
                <a class="forgot" href="/profile/logout">Logout</a>
            </div>
        </form>
    </div>
    <div class="attributes" id="attributes">
        <div class="new-attribute-container">
            <span class="new-attribute-title">New attribute</span>
            <img class="logo" src="App/Views/logo.png" alt="logo"/>
        </div>
        <div class="break"></div>
        <form method="post" action="/profile/attribute">
            <label for="name">Name<span class="star">*</span></label>
            <input class="input" name="name" id="name" type="text" required>
            <label for="value">Value<span class="star">*</span></label>
            <input class="input" name="value" id="value" type="text" required>
            <input class="button save" type="submit" value="SAVE"/>
        </form>
    </div>
    </div>
</div>
<script>
    function myAttributes() {
        var profile = document.getElementById("profile");
        var attributes = document.getElementById("attributes");
        profile.classList.toggle("fade");
        profile.style.right = "97%";
        attributes.classList.toggle("fade");
        attributes.style.right = "149%";
        profile.style.zIndex = "-1";
    }

    function myProfile() {
        var profile = document.getElementById("profile");
        var attributes = document.getElementById("attributes");
        attributes.classList.toggle("fade");
        attributes.style.right = "105%";
        profile.classList.toggle("fade");
        profile.style.right = "54%";
        profile.style.zIndex = "1";
    }
</script>
</body>
</html>
