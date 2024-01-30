<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
</head>

<body>
<h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-8 lg:text-3xl">Login</h2>
<form action="includes/loginhandler.php" method="post" class="mx-auto max-w-lg rounded-lg border">
    <div class="flex flex-col gap-4 p-4 md:p-8">
        <div>
            <label for="email" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">Email</label>
            <input name="email" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" />
        </div>

        <div>
            <label for="password" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">Password</label>
            <input type="password" name="password" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" />
        </div>

        <input type="submit" name="submit" class="block rounded-lg bg-gray-800 px-8 py-3 text-center text-sm font-semibold text-white outline-none ring-gray-300 transition duration-100 hover:bg-gray-700 focus-visible:ring active:bg-gray-600 md:text-base">
    </div>
</form>
</body>

</html>

<?php
if(isset($_GET["error"])){
    if($_GET["error"]=="wronglogin"){
        echo "<p class='p-7'>Invalid Email or Password!</p>";
    }
    elseif ($_GET["error"]=="invalidemail"){
        echo "<p>Invalid Email</p>";
    }
    elseif ($_GET["error"]=="loginfirst"){
        echo "<p>Login First</p>";
    }
    elseif($_GET["error"]=="emptyinput"){
        echo "<p>Fill all the blanks</p>";
    }

    elseif($_GET["error"]=="stmtfailed"){
        echo "<p>Oops Something went wrong!</p>";
    }
    elseif($_GET["error"]=="usercreated"){
        echo "<p>User Created</p>";
    }

    elseif($_GET["error"]=="none"){
        echo "<p>You have Logged In</p>";
    }
}