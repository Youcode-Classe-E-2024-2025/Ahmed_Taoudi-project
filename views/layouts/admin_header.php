<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TeamFlow - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start">
                    <button id="toggleSidebar" aria-expanded="true" aria-controls="sidebar" class="p-2 text-gray-600 rounded cursor-pointer lg:hidden hover:text-gray-900 hover:bg-gray-100">
                        <i class="ri-menu-line text-2xl"></i>
                    </button>
                    <a href="/" class="flex ml-2 md:mr-24">
                        <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap text-emerald-600">TeamFlow Admin</span>
                    </a>
                </div>
                <div class="flex items-center">
                    <div class="flex items-center ml-3">
                        <div class="flex items-center gap-2">
                            <span class="text-sm text-gray-600"><?= htmlspecialchars($user['name']) ?></span>
                            <a href="/logout" class="text-sm text-red-600 hover:text-red-800">
                                <i class="ri-logout-box-r-line"></i> Logout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <aside id="sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="/admin" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-emerald-100 group">
                        <i class="ri-dashboard-line text-xl text-emerald-600"></i>
                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/users" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-emerald-100 group">
                        <i class="ri-user-line text-xl text-emerald-600"></i>
                        <span class="ml-3">Users</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/roles" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-emerald-100 group">
                        <i class="ri-shield-user-line text-xl text-emerald-600"></i>
                        <span class="ml-3">Roles</span>
                    </a>
                </li>
                <li>
                    <a href="/" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-emerald-100 group">
                        <i class="ri-arrow-left-line text-xl text-emerald-600"></i>
                        <span class="ml-3">Back to Site</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

