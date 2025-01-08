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
     
    <?php require_once "views/partials/navbar.php" ;?>

    <!-- Sidebar -->
    <aside id="sidebar" class="fixed top-0 left-0 z-20 flex flex-col flex-shrink-0 w-64 h-full pt-16 duration-75 bg-white border-r transition-width">
        <div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto">
            <div class="flex-1 px-3 space-y-1">
                <a href="/" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-emerald-100 group">
                    <i class="ri-dashboard-line text-xl text-gray-500 group-hover:text-emerald-600"></i>
                    <span class="ml-3">Tableau de bord</span>
                </a>
                <a href="/projects" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-emerald-100 group">
                    <i class="ri-folder-line text-xl text-gray-500 group-hover:text-emerald-600"></i>
                    <span class="ml-3">Projets</span>
                </a>
                <a href="/tasks" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-emerald-100 group">
                    <i class="ri-task-line text-xl text-gray-500 group-hover:text-emerald-600"></i>
                    <span class="ml-3">Tâches</span>
                </a>
                <a href="/team" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-emerald-100 group">
                    <i class="ri-team-line text-xl text-gray-500 group-hover:text-emerald-600"></i>
                    <span class="ml-3">Équipe</span>
                </a>
                <div class="pt-4 mt-4 border-t border-gray-200">
                    <div class="flex items-center justify-between px-2">
                        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Catégories & Tags
                        </h3>
                        <div class="flex space-x-1">
                            <button onclick="document.getElementById('category-management-modal').classList.remove('hidden')" 
                                    class="p-1 text-gray-500 hover:text-emerald-600 rounded-full hover:bg-emerald-100">
                                <i class="ri-settings-4-line"></i>
                            </button>
                            <button onclick="document.getElementById('tag-management-modal').classList.remove('hidden')" 
                                    class="p-1 text-gray-500 hover:text-emerald-600 rounded-full hover:bg-emerald-100">
                                <i class="ri-price-tag-3-line"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mt-2 space-y-1">
                        <?php if(isset($categories)): foreach($categories as $category): ?>
                            <a href="#" class="flex items-center px-2 py-1.5 text-sm text-gray-600 hover:bg-gray-100 rounded-lg">
                                <span class="w-2 h-2 bg-purple-500 rounded-full mr-2"></span>
                                <?= htmlspecialchars($category['name']) ?>
                            </a>
                        <?php endforeach; endif; ?>
                    </div>
                    
                    <h3 class="px-2 mt-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        Tags populaires
                    </h3>
                    <div class="mt-2 px-2 flex flex-wrap gap-2">
                        <?php if(isset($tags)): foreach($tags as $tag): ?>
                            <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                <?= htmlspecialchars($tag['name']) ?>
                            </span>
                        <?php endforeach; endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main content -->
    <div class="p-4 lg:ml-64 pt-20">
    <?php if (isset($_SESSION['message'])): ?>
        <div id="green_message">
            <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="ri-error-warning-line text-green-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">
                            <?php echo htmlspecialchars($_SESSION['message']); unset($_SESSION['message']); ?>
                        </p>
                    </div>
                </div>

            </div>
        </div>
        <script>setTimeout(()=>{  document.getElementById('green_message').remove();},5000) </script>
            <?php endif; ?>
        <div id="content">
            <?php require_once $content; ?>
        </div>
    </div>

   <script src="assets/js/main.js"></script>
</body>
</html>
