<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
</head>

<body>
<h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-8 lg:text-3xl">Register</h2>
<form action="includes/signuphandler.php" method="post" class="mx-auto max-w-lg rounded-lg border">
    <div class="flex flex-col gap-4 p-4 md:p-8">
        <div>
            <label for="email" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">Username</label>
            <input name="name" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" />
        </div>
        <div>
            <label for="email" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">Email</label>
            <input name="email" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" />
        </div>

        <div>
            <label for="password" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">Password</label>
            <input type="password" name="password" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" />
        </div>
        <div>
            <label for="Confirm password" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">Confirm Password</label>
            <input type="password" name="confirm_password" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" />
        </div>

<!--        <div>-->
<!--            <label for="Role" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">Role</label>-->
<!--            <input type="text" name="role" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" />-->
<!--        </div>-->





        <input type="submit" name="submit" class="block rounded-lg bg-gray-800 px-8 py-3 text-center text-sm font-semibold text-white outline-none ring-gray-300 transition duration-100 hover:bg-gray-700 focus-visible:ring active:bg-gray-600 md:text-base">
    </div>
</form>
</body>

</html>

<?php
if(isset($_GET["error"])){
    if($_GET["error"]=="emptyinput"){
        echo "<p>Fill in all fields!</p>";
    }
    elseif ($_GET["error"]=="invalidemail"){
        echo "<p>Invalid Email</p>";
    }
    elseif($_GET["error"]=="passwordsdonotmatch"){
        echo "<p>Password Donot Match</p>";
    }
    elseif($_GET["error"]=="Emailalreadyexists"){
        echo "<p>Email Already Exist</p>";
    }
    elseif($_GET["error"]=="stmtfailed"){
        echo "<p>Oops Something went wrong!</p>";
    }
    elseif($_GET["error"]=="none"){
        echo "<p>You have signed in</p>";
    }
}