<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <title>TeamFlow </title>
</head>
<body>

<div class="bg-white">
    <!-- Hero section -->
    <div class="relative isolate overflow-hidden bg-gradient-to-b from-emerald-100/20">
        <div class="mx-auto max-w-7xl pb-24 pt-10 sm:pb-32 lg:grid lg:grid-cols-2 lg:gap-x-8 lg:px-8 lg:py-40">
            <div class="px-6 lg:px-0 lg:pt-4">
                <div class="mx-auto max-w-2xl">
                    <div class="max-w-lg">
                        <h1 class="mt-10 text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">
                            Gérez vos projets avec facilité
                        </h1>
                        <p class="mt-6 text-lg leading-8 text-gray-600">
                            TeamFlow est une solution complète de gestion de projet qui aide les équipes à collaborer efficacement, suivre les progrès et atteindre leurs objectifs.
                        </p>
                        <div class="mt-10 flex items-center gap-x-6">
                            <a href="/register"
                                class="rounded-md bg-emerald-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">
                                Commencer gratuitement
                            </a>
                            <a href="#features" class="text-sm font-semibold leading-6 text-gray-900">
                                En savoir plus <span aria-hidden="true">→</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-20 sm:mt-24 md:mx-auto md:max-w-2xl lg:mx-0 lg:mt-0 lg:w-screen">
                <div class="shadow-xl md:rounded-3xl">
                    <img src="assets/images/dashboard-preview.png" alt="Dashboard preview" class="w-full">
                </div>
            </div>
        </div>
    </div>

    <!-- Feature section -->
    <div id="features" class="mx-auto mt-8 max-w-7xl px-6 sm:mt-16 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-base font-semibold leading-7 text-emerald-600">Tout ce dont vous avez besoin</h2>
            <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                Une suite complète d'outils de gestion
            </p>
        </div>

        <div class="mx-auto mt-16 max-w-7xl sm:mt-20 lg:mt-24 lg:max-w-7xl">
            <div class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-10 lg:max-w-none lg:grid-cols-3 lg:gap-y-16">
                <div class="relative pl-16">
                    <div class="text-emerald-600 absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-50">
                        <i class="ri-task-line text-xl"></i>
                    </div>
                    <h3 class="text-base font-semibold leading-7 text-gray-900">
                        Gestion des tâches
                    </h3>
                    <p class="mt-2 text-base leading-7 text-gray-600">
                        Organisez et suivez vos tâches avec notre tableau Kanban intuitif. Assignez des responsables et des dates limites.
                    </p>
                </div>

                <div class="relative pl-16">
                    <div class="text-emerald-600 absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-50">
                        <i class="ri-team-line text-xl"></i>
                    </div>
                    <h3 class="text-base font-semibold leading-7 text-gray-900">
                        Collaboration d'équipe
                    </h3>
                    <p class="mt-2 text-base leading-7 text-gray-600">
                        Travaillez ensemble efficacement avec des outils de communication intégrés et le partage de fichiers.
                    </p>
                </div>

                <div class="relative pl-16">
                    <div class="text-emerald-600 absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-50">
                        <i class="ri-calendar-line text-xl"></i>
                    </div>
                    <h3 class="text-base font-semibold leading-7 text-gray-900">
                        Planification avancée
                    </h3>
                    <p class="mt-2 text-base leading-7 text-gray-600">
                        Planifiez vos projets avec des calendriers partagés et des diagrammes de Gantt interactifs.
                    </p>
                </div>

                <div class="relative pl-16">
                    <div class="text-emerald-600 absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-50">
                        <i class="ri-pie-chart-line text-xl"></i>
                    </div>
                    <h3 class="text-base font-semibold leading-7 text-gray-900">
                        Rapports et analyses
                    </h3>
                    <p class="mt-2 text-base leading-7 text-gray-600">
                        Suivez la progression avec des tableaux de bord personnalisables et des rapports détaillés.
                    </p>
                </div>

                <!-- <div class="relative pl-16">
                    <div class="text-emerald-600 absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-50">
                        <i class="ri-notification-line text-xl"></i>
                    </div>
                    <h3 class="text-base font-semibold leading-7 text-gray-900">
                        Notifications en temps réel
                    </h3>
                    <p class="mt-2 text-base leading-7 text-gray-600">
                        Restez informé des mises à jour importantes avec des notifications personnalisables.
                    </p>
                </div> -->

                <div class="relative pl-16">
                    <div class="text-emerald-600 absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-50">
                        <i class="ri-shield-check-line text-xl"></i>
                    </div>
                    <h3 class="text-base font-semibold leading-7 text-gray-900">
                        Sécurité avancée
                    </h3>
                    <p class="mt-2 text-base leading-7 text-gray-600">
                        Protégez vos données avec un chiffrement de bout en bout et une gestion fine des accès.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA section -->
    <div class="relative isolate mt-32 px-6 py-32 sm:mt-40 sm:py-40 lg:px-8">
        <div class="absolute inset-x-0 top-0 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
            <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-emerald-200 to-emerald-400 opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"></div>
        </div>
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                Prêt à améliorer votre gestion de projet ?
            </h2>
            <p class="mx-auto mt-6 max-w-xl text-lg leading-8 text-gray-600">
                Rejoignez les milliers d'équipes qui utilisent déjà TeamFlow pour gérer leurs projets efficacement.
            </p>
            <div class="mt-10 flex items-center justify-center gap-x-6">
                <a href="/register"
                    class="rounded-md bg-emerald-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">
                    Commencer gratuitement
                </a>
                <a href="/login" class="text-sm font-semibold leading-6 text-gray-900">
                    Se connecter <span aria-hidden="true">→</span>
                </a>
            </div>
        </div>
    </div>
</div>
</body>
</html>