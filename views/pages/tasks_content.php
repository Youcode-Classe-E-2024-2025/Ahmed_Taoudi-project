<?php
//  pd($tasks);
?>
<div class="space-y-6">


    <!-- Kanban Board -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- À Faire Column -->
        <div class="bg-gray-50 p-4 rounded-lg">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">À Faire</h3>
                <span class="px-2 py-1 text-xs font-medium bg-gray-200 text-gray-700 rounded-full"><?=count($tasks['todo']); ?></span>
            </div>
            <div class="space-y-3">
                <?php if(empty($tasks['todo'])):?>
                    <p class="text-sm text-gray-500">Aucune tâche en cours</p>
                <?php else:?>
                    <?php foreach ($tasks['todo'] as $task): ?>
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                        <div class="flex justify-between items-start mb-3">
                            <div>   
                                <div class="flex items-center gap-2">
                                    <a href="#" onclick="showTaskDetails(<?= $task['id'] ?>)" class="text-sm font-medium text-gray-900 hover:text-indigo-600">
                                        <?= htmlspecialchars($task['title']) ?>
                                    </a>
                                    <?php if(isset($task['category_name'])): ?>
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-800">
                                            <i class="ri-folder-line mr-1"></i>
                                            <?= htmlspecialchars($task['category_name']) ?>
                                        </span>
                                    <?php endif; ?>
                                    <?php if(isset($task['tags'])): foreach ($task['tags'] as $tag): ?>
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                            <i class="ri-price-tag-3-line mr-1"></i>
                                            <?= htmlspecialchars($tag['name']) ?>
                                        </span>
                                    <?php endforeach; endif; ?>
                                </div>
                                <p class="text-xs text-gray-500 mt-1"><?=$task['description']?></p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center justify-between space-x-3 w-full">
                                
                                <span class="text-gray-500">
                                    <i class="ri-calendar-line mr-1"></i>
                                    <?= date('d M Y', strtotime($task['due_date'])); ?>
                                </span>
                                <?php if(isset($project)):?>
                                    <?php if($this->hasPermission($permissions,'edit')):?>
                                <div>

                                <button onclick="confirmDelete(<?= $task['id'] ?>)" class="text-gray-500">
                                    <i class="ri-delete-bin-line mr-1"></i>
                                    
                                </button >
                                <button onclick="editTask(<?= $task['id'] ?>)" class="text-gray-500">
                                    <i class="ri-edit-line mr-1"></i>
                                    
                                </button >
                                </div>
                                     <?php endif;?>
                                <?php else:?>
                                    <button onclick="editStatus(<?= $task['id'] ?>,<?= $task['project_id'] ?>)" class="text-gray-500">
                                       <i class="ri-edit-line mr-1"></i>
                                    </button >
                                <?php endif;?> 
                            </div>
                            
                        </div>
                    </div>
                <?php endforeach;?> 
               <?php endif;?>
                
               
            </div>
        </div>

        <!-- En Cours Column -->
        <div class="bg-gray-50 p-4 rounded-lg">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">En Cours</h3>
                <span class="px-2 py-1 text-xs font-medium bg-gray-200 text-gray-700 rounded-full"><?=count($tasks['doing']); ?></span>
            </div>
            <div class="space-y-3">
            <?php if(empty($tasks['doing'])):?>
                    <p class="text-sm text-gray-500">Aucune tâche en cours</p>
                <?php else:?>
                    <?php foreach ($tasks['doing'] as $task): ?>
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                        <div class="flex justify-between items-start mb-3">
                            <div>   
                                <div class="flex items-center gap-2">
                                    <a href="#" onclick="showTaskDetails(<?= $task['id'] ?>)" class="text-sm font-medium text-gray-900 hover:text-indigo-600">
                                        <?= htmlspecialchars($task['title']) ?>
                                    </a>
                                    <?php if(isset($task['category_name'])): ?>
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-800">
                                            <i class="ri-folder-line mr-1"></i>
                                            <?= htmlspecialchars($task['category_name']) ?>
                                        </span>
                                    <?php endif; ?>
                                    <?php if(isset($task['tags'])): foreach ($task['tags'] as $tag): ?>
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                            <i class="ri-price-tag-3-line mr-1"></i>
                                            <?= htmlspecialchars($tag['name']) ?>
                                        </span>
                                    <?php endforeach; endif; ?>
                                </div>
                                <p class="text-xs text-gray-500 mt-1"><?=$task['description']?></p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center justify-between space-x-3 w-full">
                                
                                <span class="text-gray-500">
                                    <i class="ri-calendar-line mr-1"></i>
                                    <?= date('d M Y', strtotime($task['due_date'])); ?>
                                </span>
                                <?php if(isset($project)):?>
                                    <?php if($this->hasPermission($permissions,'edit')):?>
                                <div>

                                <button onclick="confirmDelete(<?= $task['id'] ?>)" class="text-gray-500">
                                    <i class="ri-delete-bin-line mr-1"></i>
                                    
                                </button >
                                <button onclick="editTask(<?= $task['id'] ?>)" class="text-gray-500">
                                    <i class="ri-edit-line mr-1"></i>
                                    
                                </button >
                                </div>
                                     <?php endif;?>
                                <?php else:?>
                                    <button onclick="editStatus(<?= $task['id'] ?>,<?= $task['project_id'] ?>)" class="text-gray-500">
                                       <i class="ri-edit-line mr-1"></i>
                                    </button >
                                <?php endif;?> 
                            </div>
                            
                        </div>
                    </div>
                <?php endforeach;?> 
               <?php endif;?>
            </div>
        </div>

        <!-- En Révision Column -->
        <div class="bg-gray-50 p-4 rounded-lg">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">En Révision</h3>
                <span class="px-2 py-1 text-xs font-medium bg-gray-200 text-gray-700 rounded-full"><?=count($tasks['review']); ?></span>
            </div>
            <div class="space-y-3">
            <?php if(empty($tasks['review'])):?>
                    <p class="text-sm text-gray-500">Aucune tâche en cours</p>
                <?php else:?>
                    <?php foreach ($tasks['review'] as $task): ?>
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                        <div class="flex justify-between items-start mb-3">
                            <div>   
                                <div class="flex items-center gap-2">
                                    <a href="#" onclick="showTaskDetails(<?= $task['id'] ?>)" class="text-sm font-medium text-gray-900 hover:text-indigo-600">
                                        <?= htmlspecialchars($task['title']) ?>
                                    </a>
                                    <?php if(isset($task['category_name'])): ?>
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-800">
                                            <i class="ri-folder-line mr-1"></i>
                                            <?= htmlspecialchars($task['category_name']) ?>
                                        </span>
                                    <?php endif; ?>
                                    <?php if(isset($task['tags'])): foreach ($task['tags'] as $tag): ?>
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                            <i class="ri-price-tag-3-line mr-1"></i>
                                            <?= htmlspecialchars($tag['name']) ?>
                                        </span>
                                    <?php endforeach; endif; ?>
                                </div>
                                <p class="text-xs text-gray-500 mt-1"><?=$task['description']?></p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center justify-between space-x-3 w-full">
                                
                                <span class="text-gray-500">
                                    <i class="ri-calendar-line mr-1"></i>
                                    <?= date('d M Y', strtotime($task['due_date'])); ?>
                                </span>
                                <?php if(isset($project)):?>
                                    <?php if($this->hasPermission($permissions,'edit')):?>
                                <div>

                                <button onclick="confirmDelete(<?= $task['id'] ?>)" class="text-gray-500">
                                    <i class="ri-delete-bin-line mr-1"></i>
                                    
                                </button >
                                <button onclick="editTask(<?= $task['id'] ?>)" class="text-gray-500">
                                    <i class="ri-edit-line mr-1"></i>
                                    
                                </button >
                                </div>
                                     <?php endif;?>
                                <?php else:?>
                                    <button onclick="editStatus(<?= $task['id'] ?>,<?= $task['project_id'] ?>)" class="text-gray-500">
                                       <i class="ri-edit-line mr-1"></i>
                                    </button >
                                <?php endif;?> 
                            </div>
                            
                        </div>
                    </div>
                <?php endforeach;?> 
               <?php endif;?>
            </div>
        </div>

        <!-- Terminé Column -->
        <div class="bg-gray-50 p-4 rounded-lg">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Terminé</h3>
                <span class="px-2 py-1 text-xs font-medium bg-gray-200 text-gray-700 rounded-full"><?=count($tasks['done']); ?></span>
            </div>
            <div class="space-y-3">
            <?php if(empty($tasks['done'])):?>
                    <p class="text-sm text-gray-500">Aucune tâche en cours</p>
                <?php else:?>
                    <?php foreach ($tasks['done'] as $task): ?>
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                        <div class="flex justify-between items-start mb-3">
                            <div>   
                                <div class="flex items-center gap-2">
                                    <a href="#" onclick="showTaskDetails(<?= $task['id'] ?>)" class="text-sm font-medium text-gray-900 hover:text-indigo-600">
                                        <?= htmlspecialchars($task['title']) ?>
                                    </a>
                                    <?php if(isset($task['category_name'])): ?>
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-800">
                                            <i class="ri-folder-line mr-1"></i>
                                            <?= htmlspecialchars($task['category_name']) ?>
                                        </span>
                                    <?php endif; ?>
                                    <?php if(isset($task['tags'])): foreach ($task['tags'] as $tag): ?>
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                            <i class="ri-price-tag-3-line mr-1"></i>
                                            <?= htmlspecialchars($tag['name']) ?>
                                        </span>
                                    <?php endforeach; endif; ?>
                                </div>
                                <p class="text-xs text-gray-500 mt-1"><?=$task['description']?></p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center justify-between space-x-3 w-full">
                                
                                <span class="text-gray-500">
                                    <i class="ri-calendar-line mr-1"></i>
                                    <?= date('d M Y', strtotime($task['due_date'])); ?>
                                </span>
                                <?php if(isset($project)):?>
                                    <?php if($this->hasPermission($permissions,'edit')):?>
                                <div>

                                <button onclick="confirmDelete(<?= $task['id'] ?>)" class="text-gray-500">
                                    <i class="ri-delete-bin-line mr-1"></i>
                                    
                                </button >
                                <button onclick="editTask(<?= $task['id'] ?>)" class="text-gray-500">
                                    <i class="ri-edit-line mr-1"></i>
                                    
                                </button >
                                </div>
                                     <?php endif;?>
                                <?php else:?>
                                    <button onclick="editStatus(<?= $task['id'] ?>,<?= $task['project_id'] ?>)" class="text-gray-500">
                                       <i class="ri-edit-line mr-1"></i>
                                    </button >
                                <?php endif;?> 
                            </div>
                            
                        </div>
                    </div>
                <?php endforeach;?> 
               <?php endif;?>
            </div>
        </div>
    </div>
</div>
<div id="change-task-status-modal" class="hidden fixed z-10 inset-0 overflow-y-auto">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
<form action="/task/updateStatus" method="POST" class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                             <!-- CSRF -->
                             <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>"> 
    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="sm:flex sm:items-start"> 
            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Modifier le statut de la tâche</h3>
               
            </div>
        </div>
        <div class="mt-3">
            <input type="hidden" name="task_id" id="edit-task-status-id">
            <input type="hidden" name="project_id" id="edit-task-status-project-id">
            <select name="status" id="status" class="mt-1 block   py-2 px-3 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <option value="todo">À faire</option>
                <option value="in_progress">En cours</option>
                <option value="review">En révision</option>
                <option value="done">Terminé</option>
            </select>
        </div>
    </div>

    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">

        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
            Confirmer
        </button>
        <button onclick="closeModal('change-task-status-modal')" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
            Annuler
        </button>
    </div>
</form>
        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class=" sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        
    </div>
</div>
<!-- Task Details Modal -->
<div id="task-details-modal" class="hidden fixed z-10 inset-0 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="mt-3">
                    <h3 class="text-lg font-medium text-gray-900 mb-4" id="task-details-title"></h3>
                    <div class="space-y-4">
                        <div id="task-details-category-tags" class="flex flex-wrap gap-2"></div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <p id="task-details-description" class="text-sm text-gray-600"></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Date d'échéance</label>
                            <p id="task-details-due-date" class="text-sm text-gray-600"></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Assigné à</label>
                            <div id="task-details-assigned-users" class="flex flex-wrap gap-2"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="closeTaskDetailsModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Fermer
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function editStatus(taskId, projectId) {
        document.getElementById('change-task-status-modal').classList.remove('hidden');
        document.getElementById('edit-task-status-id').value = taskId;
        document.getElementById('edit-task-status-project-id').value = projectId;
    }

    function showTaskDetails(taskId) {
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
            // Set title
            document.getElementById('task-details-title').textContent = task.title;
            
            // Set category and tags
            const categoryTagsContainer = document.getElementById('task-details-category-tags');
            categoryTagsContainer.innerHTML = '';
            
            // Add category if exists
            if (task.category) {
                categoryTagsContainer.innerHTML += `
                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-800">
                        <i class="ri-folder-line mr-1"></i>
                        ${task.category}
                    </span>
                `;
            }
            
            // Add tags if exist
            if (task.tags && task.tags.length > 0) {
                task.tags.forEach(tag => {
                    categoryTagsContainer.innerHTML += `
                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                            <i class="ri-price-tag-3-line mr-1"></i>
                            ${tag.name}
                        </span>
                    `;
                });
            }
            
            // Set description
            document.getElementById('task-details-description').textContent = task.description;
            
            // Set due date
            document.getElementById('task-details-due-date').textContent = new Date(task.due_date).toLocaleDateString('fr-FR');
            
            // Set assigned users
            const assignedUsersContainer = document.getElementById('task-details-assigned-users');
            assignedUsersContainer.innerHTML = '';
            if (task.assigned_users && task.assigned_users.length > 0) {
                task.assigned_users.forEach(user => {
                    assignedUsersContainer.innerHTML += `
                        <div class="flex items-center space-x-2">
                            <img class="h-6 w-6 rounded-full" 
                                 src="https://ui-avatars.com/api/?name=${encodeURIComponent(user.name)}" 
                                 alt="${user.name}">
                            <span class="text-sm text-gray-600">${user.name}</span>
                        </div>
                    `;
                });
            } else {
                assignedUsersContainer.innerHTML = '<p class="text-sm text-gray-500">Aucun utilisateur assigné</p>';
            }
            
            // Show the modal
            document.getElementById('task-details-modal').classList.remove('hidden');
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Une erreur est survenue lors de la récupération des détails de la tâche');
        });
    }

    function closeTaskDetailsModal() {
        document.getElementById('task-details-modal').classList.add('hidden');
    }
</script>