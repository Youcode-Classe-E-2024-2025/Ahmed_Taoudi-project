<!-- project content details -->
<?php
//  pd([
//     'project' => $project,
//     'tasks' => $tasks,
//     'team' => $team,
//     'availableUsers'=>$availableUsers,
//     'stats' => $stats,
//     'permissions'=>$permissions,
//     'categories' => $categories,
//     'tags' => $tags
// ]);
?>

<div class="space-y-6">
    <!-- Project Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900"><?= htmlspecialchars($project['name']) ?></h1>
            <p class="mt-1 text-sm text-gray-500"><?= htmlspecialchars($project['description']) ?></p>
        </div>
        <div class="flex items-center space-x-2">
            <span class="px-3 py-1 text-sm font-medium rounded-full 
                <?= $project['status'] === 'En cours' ? 'bg-green-100 text-green-800' : ($project['status'] === 'En pause' ? 'bg-yellow-100 text-yellow-800' :
                        'bg-gray-100 text-gray-800') ?>">
                <?= htmlspecialchars($project['status']) ?>
            </span>
            <a href="/project/edit?id=<?= $project['id'] ?>"
                class="text-sm text-indigo-600 hover:text-indigo-700">
                <i class="ri-edit-line"></i>
            </a>
        </div>
    </div>

    <!-- Project Details -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Left Column -->
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6 space-y-4">
        <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-gray-900">Détails du projet</h2>
                <form action="/project/updateVisibility" method="POST" class="inline">
                    <input type="hidden" name="project_id" value="<?= $project['id'] ?>">
                    <input type="hidden" name="visibility" value="<?= $project['visibility'] === 'public' ? 'private' : 'public' ?>">
                    <button type="submit" class="flex items-center text-sm <?= $project['visibility'] === 'public' ? 'text-green-600 hover:text-green-700' : 'text-gray-600 hover:text-gray-700' ?>">
                        <i class="ri-<?= $project['visibility'] === 'public' ? 'eye-line' : 'eye-off-line' ?> mr-1"></i>
                        <?= $project['visibility'] === 'public' ? 'Public' : 'Privé' ?>
                    </button>
                </form>
            </div>

            <div class="space-y-3">
                <div>
                    <label class="text-sm font-medium text-gray-500">Dates</label>
                    <p class="mt-1">
                        Du <?= date('d/m/Y', strtotime($project['start_date'])) ?>
                        au <?= date('d/m/Y', strtotime($project['end_date'])) ?>
                    </p>
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-500">Progression</label>
                    <div class="flex justify-between text-sm text-gray-500 mb-1">
                        <span>Tâches complétées</span>
                        <span><?= $stats['completed'] ?? 0 ?>/<?= $stats['total'] ?? 0 ?></span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <?php
                        $progress = 0;
                        if (isset($stats['total']) && $stats['total'] > 0) {
                            $progress = ($stats['completed'] / $stats['total']) * 100;
                        }
                        ?>
                        <div class="bg-green-500 h-2 rounded-full" style="width: <?= $progress ?>%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Team Members -->
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-medium text-gray-900">Membres de l'équipe</h2>
                <button onclick="openAddMemberModal()" class="text-sm text-indigo-600 hover:text-indigo-700">
                    <i class="ri-user-add-line mr-1"></i> Ajouter
                </button>
            </div>

            <div class="space-y-3">
                <?php if (empty($team)): ?>
                    <p class="text-gray-500 text-center py-4">Aucun membre dans l'équipe</p>
                <?php else: ?>
                    <?php foreach ($team as $member): ?>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center  w-full space-x-3">
                                <div class="flex items-center  w-full space-x-3">
                                    <img class="w-8 h-8 rounded-full"
                                        src="https://ui-avatars.com/api/?name=<?= urlencode($member['name']) ?>"
                                        alt="<?= htmlspecialchars($member['name']) ?>">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900"><?= htmlspecialchars($member['name']) ?></p>
                                        <p class="text-sm text-gray-500"><?= htmlspecialchars($member['email']) ?></p>
                                    </div>
                                </div>
                                <div>
                                    <form action="/project/removeMember" method="POST">
                                    <input type="hidden" name="project_id" value="<?= $project['id'] ?>">
                                    <input type="hidden" name="user_id" value="<?= $member['id'] ?>">
                                    <button type="submit" class="text-sm text-red-600 hover:text-red-700">
                                        <i class="ri-user-unfollow-line"></i>
                                        </button>
                                    </form>
                               </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Tasks Section -->
    <!-- Tasks Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Tâches</h1>
            <p class="mt-1 text-sm text-gray-500">Gérez vos tâches avec notre tableau Kanban</p>
        </div>
        <button class="open-modal px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            <i class="ri-add-line mr-1"></i> Nouvelle Tâche
        </button>
    </div>
    <?php require_once "views/pages/tasks_content.php"; ?>
    <!-- New Task Modal -->
    <div id="newTaskModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Nouvelle Tâche</h3>
                <form action="/task/create" method="POST">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Titre</label>
                            <input name="title" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea name="description" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500" rows="3"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Catégorie</label>
                            <select name="category_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Sélectionner une catégorie</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tags</label>
                            <div class="flex flex-wrap gap-2">
                                <?php foreach ($tags as $tag): ?>
                                <div class="tag-selector" data-tag-id="<?= $tag['id'] ?>">
                                    <input type="checkbox" name="tags[]" value="<?= $tag['id'] ?>" id="create-tag-<?= $tag['id'] ?>" class="hidden">
                                    <label for="create-tag-<?= $tag['id'] ?>" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-700 cursor-pointer hover:bg-blue-50 transition-colors duration-200">
                                        <i class="ri-price-tag-3-line mr-1"></i>
                                        <?= htmlspecialchars($tag['name']) ?>
                                    </label>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Date d'échéance</label>
                            <input name="due_date" type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Assigner à</label>
                            <div class="space-y-2 max-h-48 overflow-y-auto p-3 border border-gray-300 rounded-md">
                                <?php foreach ($team as $member): ?>
                                <div class="flex items-center space-x-3">
                                    <input type="checkbox" 
                                           id="member-<?= $member['id'] ?>" 
                                           name="assigned_users[]" 
                                           value="<?= $member['id'] ?>"
                                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                    <label for="member-<?= $member['id'] ?>" class="flex items-center space-x-3 cursor-pointer">
                                        <img class="h-8 w-8 rounded-full" 
                                             src="https://ui-avatars.com/api/?name=<?= urlencode($member['name']) ?>" 
                                             alt="<?= htmlspecialchars($member['name']) ?>">
                                        <span class="text-sm text-gray-900"><?= htmlspecialchars($member['name']) ?></span>
                                    </label>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <!-- project id -->
                        <input type="hidden" name="project_id" value="<?= $project['id'] ?>">
                    </div>
                    <div class="flex justify-end gap-3 mt-4">
                        <button type="button" class="close-modal px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Annuler
                        </button>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Créer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Modal functionality
        const modal = document.getElementById('newTaskModal');
        const openModalBtn = document.querySelector('button.open-modal');
        const closeModalBtn = modal.querySelector('button.close-modal');

        openModalBtn.addEventListener('click', () => {
            modal.classList.remove('hidden');
        });

        closeModalBtn.addEventListener('click', () => {
            modal.classList.add('hidden');
        });

        // Close modal when clicking outside
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.add('hidden');
            }
        });
    </script>

</div>

<!-- Add Member Modal -->
<div id="add-member-modal" class="hidden fixed z-10 inset-0 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="/project/addMember" method="POST">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Ajouter des membres à l'équipe</h3>
                            
                            <?php if (empty($availableUsers)): ?>
                                <p class="text-sm text-gray-500">Tous les utilisateurs sont déjà membres de ce projet.</p>
                            <?php else: ?>
                                <div class="mt-2 max-h-60 overflow-y-auto">
                                    <div class="space-y-2">
                                        <?php foreach ($availableUsers as $user): ?>
                                            <div class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50">
                                                <input type="checkbox" 
                                                       id="user-<?= $user['id'] ?>" 
                                                       name="user_ids[]" 
                                                       value="<?= $user['id'] ?>"
                                                       class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                                <label for="user-<?= $user['id'] ?>" class="flex items-center flex-1 cursor-pointer">
                                                    <div class="flex items-center space-x-3">
                                                        <img class="h-8 w-8 rounded-full" 
                                                             src="https://ui-avatars.com/api/?name=<?= urlencode($user['name']) ?>" 
                                                             alt="<?= htmlspecialchars($user['name']) ?>">
                                                        <div>
                                                            <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($user['name']) ?></div>
                                                            <div class="text-sm text-gray-500"><?= htmlspecialchars($user['email']) ?></div>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="project_id" value="<?= $project['id'] ?>">
                
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <?php if (!empty($availableUsers)): ?>
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Ajouter
                        </button>
                    <?php endif; ?>
                    <button type="button" onclick="closeModal('add-member-modal')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 <?= !empty($availableUsers) ? 'sm:ml-3' : '' ?> sm:w-auto sm:text-sm">
                        <?= empty($availableUsers) ? 'Fermer' : 'Annuler' ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openAddMemberModal() {
    document.getElementById('add-member-modal').classList.remove('hidden');
}
</script>

<div id="confirm-delete-modal" class="hidden fixed z-10 inset-0 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">  
                        <i class="ri-alert-line text-red-600 text-2xl"></i>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Supprimer la tâche</h3>
                        <div class="mt-2">
                                <p class="text-sm text-gray-500">Voulez-vous vraiment supprimer cette tâche ?</p>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="/task/delete" method="POST">
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <input type="hidden" name="task_id" id="delete-task-id">
                    <input type="hidden" name="project_id" value="<?= $project['id'] ?>">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Supprimer
                    </button>
                    <button type="button" onclick="closeModal('confirm-delete-modal')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Annuler
                    </button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(id) {
       document.getElementById('confirm-delete-modal').classList.remove('hidden');
       document.getElementById('delete-task-id').value = id;

    }

    
    

</script>

<div id="edit-task-modal" class="hidden fixed z-10 inset-0 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="mt-3">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Modifier la Tâche</h3>
                    <form action="/task/edit" method="POST">
                        <div class="space-y-4">
                            <input type="hidden" name="id" id="edit-task-id">
                            <input type="hidden" name="project_id" value="<?= $project['id'] ?>">
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Titre</label>
                                <input id="edit-task-title" name="title" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                <textarea id="edit-task-description" name="description" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500" rows="3"></textarea>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Catégorie</label>
                                <select name="category_id" id="edit-category" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">Sélectionner une catégorie</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tags</label>
                                <div class="flex flex-wrap gap-2">
                                    <?php foreach ($tags as $tag): ?>
                                    <div class="tag-selector" data-tag-id="<?= $tag['id'] ?>">
                                        <input type="checkbox" name="tags[]" value="<?= $tag['id'] ?>" id="edit-tag-<?= $tag['id'] ?>" class="hidden">
                                        <label for="edit-tag-<?= $tag['id'] ?>" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-700 cursor-pointer hover:bg-blue-50 transition-colors duration-200">
                                            <i class="ri-price-tag-3-line mr-1"></i>
                                            <?= htmlspecialchars($tag['name']) ?>
                                        </label>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                                <select id="edit-task-status" name="status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="todo">À faire</option>
                                    <option value="in_progress">En cours</option>
                                    <option value="review">En révision</option>
                                    <option value="done">Terminé</option>
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Date d'échéance</label>
                                <input id="edit-task-due-date" name="due_date" type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Assigner à</label>
                                <div class="space-y-2 max-h-48 overflow-y-auto p-3 border border-gray-300 rounded-md">
                                    <?php foreach ($team as $member): ?>
                                    <div class="flex items-center space-x-3">
                                        <input type="checkbox" 
                                               id="edit-member-<?= $member['id'] ?>" 
                                               name="assigned_users[]" 
                                               value="<?= $member['id'] ?>"
                                               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                        <label for="edit-member-<?= $member['id'] ?>" class="flex items-center space-x-3 cursor-pointer">
                                            <img class="h-8 w-8 rounded-full" 
                                                 src="https://ui-avatars.com/api/?name=<?= urlencode($member['name']) ?>" 
                                                 alt="<?= htmlspecialchars($member['name']) ?>">
                                            <span class="text-sm text-gray-900"><?= htmlspecialchars($member['name']) ?></span>
                                        </label>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex justify-end gap-3 mt-4">
                            <button type="button" onclick="closeModal('edit-task-modal')" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                Annuler
                            </button>
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tag selectors
    const tagSelectors = document.querySelectorAll('.tag-selector input[type="checkbox"]');
    tagSelectors.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const label = this.nextElementSibling;
            if (this.checked) {
                label.classList.remove('bg-gray-100', 'text-gray-700');
                label.classList.add('bg-blue-100', 'text-blue-800');
            } else {
                label.classList.remove('bg-blue-100', 'text-blue-800');
                label.classList.add('bg-gray-100', 'text-gray-700');
            }
        });
    });

    // Modify the existing editTask function
    const originalEditTask = window.editTask;
    window.editTask = function(taskId) {
        fetch('/taskJS', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ taskId: taskId })
        })
        .then(response => response.json())
        .then(task => {
            // Populate other fields
            document.getElementById('edit-task-id').value = task.id;
            document.getElementById('edit-task-title').value = task.title;
            document.getElementById('edit-task-description').value = task.description;
            document.getElementById('edit-category').value = task.category_id || '';
            document.getElementById('edit-task-status').value = task.status;
            document.getElementById('edit-task-due-date').value = task.due_date;
            
            // Handle assigned users checkboxes
            const assignedUsers = task.assigned_users.map(user => user.id) || [];
            document.querySelectorAll('input[name="assigned_users[]"]').forEach(checkbox => {
                checkbox.checked = assignedUsers.includes(parseInt(checkbox.value));
            });

            // Update tags
            if (task.tags) {
                const tagIds = task.tags.map(tag => tag.id);
                document.querySelectorAll('#edit-task-modal .tag-selector input[type="checkbox"]').forEach(checkbox => {
                    const isSelected = tagIds.includes(parseInt(checkbox.value));
                    checkbox.checked = isSelected;
                    const label = checkbox.nextElementSibling;
                    if (isSelected) {
                        label.classList.remove('bg-gray-100', 'text-gray-700');
                        label.classList.add('bg-blue-100', 'text-blue-800');
                    } else {
                        label.classList.remove('bg-blue-100', 'text-blue-800');
                        label.classList.add('bg-gray-100', 'text-gray-700');
                    }
                });
            }
            
            // Show the modal
            document.getElementById('edit-task-modal').classList.remove('hidden');
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Une erreur est survenue lors de la récupération des détails de la tâche');
        });
    };
});
</script>