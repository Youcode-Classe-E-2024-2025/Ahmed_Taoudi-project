
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TeamFlow - Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-emerald-600">TeamFlow</h1>
                <h2 class="mt-6 text-3xl font-bold text-gray-900">Connexion</h2>
                <p class="mt-2 text-sm text-gray-600">
                    Ou
                    <a href="/register" class="font-medium text-emerald-600 hover:text-emerald-500">
                        créez un compte gratuitement
                    </a>
                </p>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
            <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="ri-error-warning-line text-red-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">
                            <?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
                        </p>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <form class="mt-8 space-y-6" action="/login" method="POST">
                <div class="rounded-md shadow-sm space-y-4">
                    <div>
                         <!-- CSRF -->
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>"> 
                        
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            Adresse email
                        </label>
                        <input id="email" name="email" type="email" required 
                            class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 focus:z-10 sm:text-sm"
                            placeholder="exemple@email.com">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            Mot de passe
                        </label>
                        <input id="password" name="password" type="password" required
                            class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 focus:z-10 sm:text-sm"
                            placeholder="••••••••">
                    </div>
                </div>

                <!-- <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox"
                            class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded">
                        <label for="remember-me" class="ml-2 block text-sm text-gray-900">
                            Se souvenir de moi
                        </label>
                    </div>

                    <div class="text-sm">
                        <a href="#" class="font-medium text-emerald-600 hover:text-emerald-500">
                            Mot de passe oublié ?
                        </a>
                    </div>
                </div> -->

                <div>
                    <button type="submit"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="ri-lock-line text-emerald-500 group-hover:text-emerald-400"></i>
                        </span>
                        Se connecter
                    </button>
                </div>
            </form>

            <!-- <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-gray-50 text-gray-500">
                            Ou continuez avec
                        </span>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-2 gap-3">
                    <div>
                        <a href="#"
                            class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <i class="ri-google-fill text-xl"></i>
                            <span class="ml-2">Google</span>
                        </a>
                    </div>
                    <div>
                        <a href="#"
                            class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <i class="ri-github-fill text-xl"></i>
                            <span class="ml-2">GitHub</span>
                        </a>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</body>
</html>
