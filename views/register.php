<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TeamFlow - Inscription</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-emerald-600">TeamFlow</h1>
                <h2 class="mt-6 text-3xl font-bold text-gray-900">Créer un compte</h2>
                <p class="mt-2 text-sm text-gray-600">
                    Ou
                    <a href="/login" class="font-medium text-emerald-600 hover:text-emerald-500">
                        connectez-vous à votre compte
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

            <form class="mt-8 space-y-6" action="/register" method="POST">
                <div class="rounded-md shadow-sm space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">
                            Nom complet
                        </label>
                        <input id="name" name="name" type="text" required
                            class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 focus:z-10 sm:text-sm"
                            placeholder="Jean Dupont">
                    </div>
                    <div>
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
                        <p class="mt-1 text-xs text-gray-500">
                            Au moins 8 caractères, avec des lettres majuscules, minuscules et des chiffres
                        </p>
                    </div>
                    <div>
                        <label for="confirm_password" class="block text-sm font-medium text-gray-700">
                            Confirmer le mot de passe
                        </label>
                        <input id="confirm_password" name="confirm_password" type="password" required
                            class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 focus:z-10 sm:text-sm"
                            placeholder="••••••••">
                    </div>
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700">
                            Rôle dans l'équipe
                        </label>
                        <select id="role" name="role" required
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm rounded-md">
                            <option value="">Sélectionnez un rôle</option>
                            <option value="developer">Développeur</option>
                            <option value="designer">Designer</option>
                            <option value="manager">Chef de projet</option>
                            <option value="marketing">Marketing</option>
                        </select>
                    </div>
                </div>

                <div class="flex items-center">
                    <input id="terms" name="terms" type="checkbox" required
                        class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded">
                    <label for="terms" class="ml-2 block text-sm text-gray-900">
                        J'accepte les
                        <a href="#" class="font-medium text-emerald-600 hover:text-emerald-500">
                            conditions d'utilisation
                        </a>
                        et la
                        <a href="#" class="font-medium text-emerald-600 hover:text-emerald-500">
                            politique de confidentialité
                        </a>
                    </label>
                </div>

                <div>
                    <button type="submit"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="ri-user-add-line text-emerald-500 group-hover:text-emerald-400"></i>
                        </span>
                        Créer un compte
                    </button>
                </div>
            </form>

            <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-gray-50 text-gray-500">
                            Ou inscrivez-vous avec
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
            </div>
        </div>
    </div>
</body>
</html>
