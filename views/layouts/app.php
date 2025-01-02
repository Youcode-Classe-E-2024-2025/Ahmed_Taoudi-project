<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TeamFlow - Gestion de Projet</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <nav class="bg-emerald-600 fixed w-full z-30 top-0">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start">
                    <button id="toggleSidebarMobile" aria-expanded="true" aria-controls="sidebar" class="lg:hidden mr-2 text-white">
                        <i class="ri-menu-line text-2xl"></i>
                    </button>
                    <a href="#" class="text-xl font-bold flex items-center lg:ml-2.5">
                        <img src="assets/images/logo.png" alt="Logo" class="h-8 w-8 mr-2">
                        <span class="text-emerald-600">TeamFlow</span>
                    </a>
                </div>
                <div class="flex items-center gap-4">
                    <a href="/login" class="text-white hover:text-gray-200">
                        <i class="ri-login-circle-line text-xl"></i>
                        <span class="ml-1">Connexion</span>
                    </a>
                    <a href="/register" class="bg-white text-emerald-600 px-4 py-2 rounded-md hover:bg-gray-100">
                        <span>Inscription</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <aside id="sidebar" class="fixed top-0 left-0 z-20 flex flex-col flex-shrink-0 w-64 h-full pt-16 duration-75 bg-white border-r transition-width">
        <div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto">
            <div class="flex-1 px-3 space-y-1">
                <a href="dashboard.php" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-emerald-100 group">
                    <i class="ri-dashboard-line text-xl text-gray-500 group-hover:text-emerald-600"></i>
                    <span class="ml-3">Tableau de bord</span>
                </a>
                <a href="projects.php" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-emerald-100 group">
                    <i class="ri-folder-line text-xl text-gray-500 group-hover:text-emerald-600"></i>
                    <span class="ml-3">Projets</span>
                </a>
                <a href="tasks.php" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-emerald-100 group">
                    <i class="ri-task-line text-xl text-gray-500 group-hover:text-emerald-600"></i>
                    <span class="ml-3">Tâches</span>
                </a>
                <a href="team.php" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-emerald-100 group">
                    <i class="ri-team-line text-xl text-gray-500 group-hover:text-emerald-600"></i>
                    <span class="ml-3">Équipe</span>
                </a>
                <div class="pt-4 mt-4 border-t border-gray-200">
                    <h3 class="px-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        Catégories
                    </h3>
                    <div class="mt-2 space-y-1">
                        <a href="#" class="flex items-center px-2 py-1.5 text-sm text-gray-600 hover:bg-gray-100 rounded-lg">
                            <span class="w-2 h-2 bg-blue-500 rounded-full mr-2"></span>
                            Développement
                        </a>
                        <a href="#" class="flex items-center px-2 py-1.5 text-sm text-gray-600 hover:bg-gray-100 rounded-lg">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                            Design
                        </a>
                        <a href="#" class="flex items-center px-2 py-1.5 text-sm text-gray-600 hover:bg-gray-100 rounded-lg">
                            <span class="w-2 h-2 bg-purple-500 rounded-full mr-2"></span>
                            Marketing
                        </a>
                    </div>
                </div>
                <div class="pt-4 mt-4 border-t border-gray-200">
                    <h3 class="px-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        Tags
                    </h3>
                    <div class="mt-2 space-y-1">
                        <a href="#" class="flex items-center px-2 py-1.5 text-sm text-gray-600 hover:bg-gray-100 rounded-lg">
                            <i class="ri-price-tag-3-line mr-2 text-gray-400"></i>
                            Urgent
                        </a>
                        <a href="#" class="flex items-center px-2 py-1.5 text-sm text-gray-600 hover:bg-gray-100 rounded-lg">
                            <i class="ri-price-tag-3-line mr-2 text-gray-400"></i>
                            En attente
                        </a>
                        <a href="#" class="flex items-center px-2 py-1.5 text-sm text-gray-600 hover:bg-gray-100 rounded-lg">
                            <i class="ri-price-tag-3-line mr-2 text-gray-400"></i>
                            Révision
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main content -->
    <div class="p-4 lg:ml-64 pt-20">
        <div id="content">
            <?php require_once $content; ?>
        </div>
    </div>

    <script>
        // Toggle mobile sidebar
        const toggleSidebarMobile = document.getElementById('toggleSidebarMobile');
        const sidebar = document.getElementById('sidebar');
        
        toggleSidebarMobile.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', (e) => {
            if (window.innerWidth < 1024) {
                if (!sidebar.contains(e.target) && !toggleSidebarMobile.contains(e.target)) {
                    sidebar.classList.add('-translate-x-full');
                }
            }
        });
    </script>
</body>
</html>
