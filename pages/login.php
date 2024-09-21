<?php
session_start();
include 'db.php';

$showWarning = false; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];


    $stmt = $conn->prepare("SELECT * FROM accounts WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['username'];
        $_SESSION['fullname'] = $row['fullname'];
        $_SESSION['role'] = $row['account_type'];

        if ($row['account_type'] == 'doctor') {
            header("Location: doctor_dashboard.php");
        } else if ($row['account_type'] == 'secretary') {
            header("Location: secretary_dashboard.php");
        }
        exit();
    } else {
        $showWarning = true;
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login ┃ GD Optical Clinic</title>
    <link rel="shortcut icon" href="../images/ico.png" />
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="h-screen overflow-hidden flex items-center justify-center bg-cover bg-fixed" style="background-image: url('header.png');">

        <!-- Form -->
        <div class="flex flex-col items-center justify-center w-full max-w-md p-6 bg-white bg-opacity-20 rounded-3xl shadow-lg z-10 h-[32rem] backdrop-blur-sm">

    <div class="mb-6">
        <img src="../images/mainlogo.png" alt="Logo" class="w-32 h-auto">
    </div>
    

    <div class="mb-7">
        <h3 class="font-semibold text-xl text-gray-800">Log In</h3>
    </div>
    

    <form method="POST" action="">

        <div class="mb-4">
            <input name="username" class="w-full text-sm px-4 py-3 bg-white bg-opacity-70 focus:bg-opacity-100 border border-gray-200 rounded-lg focus:outline-none focus:border-blue-400" type="text" placeholder="Username" required>
        </div>

        <div class="relative mb-6" x-data="{ show: true }">
            <input name="password" placeholder="Password" :type="show ? 'password' : 'text'" class="text-sm text-black-200 px-4 py-3 rounded-lg w-full bg-white bg-opacity-70 focus:bg-opacity-100 border border-gray-200 focus:outline-none focus:border-blue-400" required>
            <div class="flex items-center absolute inset-y-0 right-0 mr-3 text-sm leading-5">
                <svg @click="show = !show" :class="{'hidden': !show, 'block':show }" class="h-4 text-blue-700 cursor-pointer" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                    <path fill="currentColor" d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z"></path>
                </svg>
                <svg @click="show = !show" :class="{'block': !show, 'hidden':show }" class="h-4 text-blue-700 cursor-pointer" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                    <path fill="currentColor" d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z"></path>
                </svg>
            </div>
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit" class="w-full flex justify-center bg-blue-800 hover:bg-blue-700 text-gray-100 p-3 rounded-lg tracking-wide font-semibold cursor-pointer transition ease-in duration-500">
                Log In
            </button>
        </div>
    </form>
</div>




                </div>
            </form>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js"></script>
</body>
</html>







