<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="shortcut icon" href="../images/ico.png" />
    <link rel="stylesheet" href="../dist/css/doctor_homepage.css">
    <title>GD Optical Clinic</title>
</head>
<body class="text-gray-800 font-inter">


    
    <!-- start: Sidebar -->
<div class="fixed left-0 top-0 w-64 h-full bg-gray-900 p-4 z-50 sidebar-menu transition-transform">
    <a href="../pages/secretary_dashboard.php" class="flex items-center pb-4 border-b border-b-gray-800">
        <img src="../images/dash.png" alt="Dashboard Icon" class="rounded object-cover" style="width: 40px; height: 40px;">
        <span class="text-lg font-bold text-white ml-3">GD Optical Clinic</span>
    </a>
    <ul class="mt-4">
        <li class="mb-1 group active">
            <a href="secretary_dashboard.php" class="flex items-center py-2 px-4 text-gray-300 hover:bg-gray-950 hover:text-gray-100 rounded-md group-active:bg-gray-800 group-active:text-white">
            <i class="ri-dashboard-3-line mr-3 text-lg" style="color: orange;"></i>
                <span class="text-sm">Dashboard</span>
            </a>
        </li>
        <li class="mb-1 group">
            <a href="add_patient.php" class="flex items-center py-2 px-4 text-gray-300 hover:bg-gray-950 hover:text-gray-100 rounded-md group-active:bg-gray-800 group-active:text-white">
            <i class="ri-table-line mr-3 text-lg" style="color: #197DE4;"></i>
                <span class="text-sm">Add Patients</span>
            </a>
        </li>
        <li class="mb-1 group">
            <a href="secretary_table.php" class="flex items-center py-2 px-4 text-gray-300 hover:bg-gray-950 hover:text-gray-100 rounded-md group-active:bg-gray-800 group-active:text-white">
                <i class="ri-article-line mr-3 text-lg "style="color: #25B453;"></i>
                <span class="text-sm">Patients Table</span>
            </a>
        </li>
        <li class="mb-1 group">
            <a href="#" class="flex items-center py-2 px-4 text-gray-300 hover:bg-gray-950 hover:text-gray-100 rounded-md group-active:bg-gray-800 group-active:text-white">
                <i class="ri-article-line mr-3 text-lg "style="color: #4F90C6;"></i>
                <span class="text-sm">Certificate</span>
            </a>
        </li>
        <li class="mb-1 group">
            <a href="secretary_history.php" class="flex items-center py-2 px-4 text-gray-300 hover:bg-gray-950 hover:text-gray-100 rounded-md group-active:bg-gray-800 group-active:text-white">
                <i class="ri-history-line mr-3 text-lg "style="color: #D32485;"></i>
                <span class="text-sm">History</span>
            </a>
        </li>
        
    </ul>
</div>
<div class="fixed top-0 left-0 w-full h-full bg-black/50 z-40 md:hidden sidebar-overlay"></div>

    <!-- end: Sidebar -->

   

    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../dist/js/script.js"></script>
</body>
</html>