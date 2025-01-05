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
                                <a href="#" onclick="showTaskDetails(<?= $task['id'] ?>)" class="text-sm font-medium text-gray-900 hover:text-indigo-600">
                                    <?= htmlspecialchars($task['title']) ?>
                                </a>
                                <p class="text-xs text-gray-500 mt-1"><?=$task['description']?></p>
                            </div>
                            <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800"><?=$task['status']?></span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center justify-between space-x-3 w-full">
                                
                                <span class="text-gray-500">
                                    <i class="ri-calendar-line mr-1"></i>
                                    <?= date('d M Y', strtotime($task['due_date'])); ?>
                                </span>
                                <?php if(isset($project)):?>
                                <div>

                                <button onclick="confirmDelete(<?= $task['id'] ?>)" class="text-gray-500">
                                    <i class="ri-delete-bin-line mr-1"></i>
                                    
                                </button >
                                <button onclick="editTask(<?= $task['id'] ?>)" class="text-gray-500">
                                    <i class="ri-edit-line mr-1"></i>
                                    
                                </button >
                                </div>
                                <?php else:?>
                                    <button onclick="editStatus(<?= $task['id'] ?>)" class="text-gray-500">
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
                                <a href="#" onclick="showTaskDetails(<?= $task['id'] ?>)" class="text-sm font-medium text-gray-900 hover:text-indigo-600">
                                    <?= htmlspecialchars($task['title']) ?>
                                </a>
                                <p class="text-xs text-gray-500 mt-1"><?=$task['description']?></p>
                            </div>
                            <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800"><?=$task['status']?></span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center justify-between space-x-3 w-full">
                                
                                <span class="text-gray-500">
                                    <i class="ri-calendar-line mr-1"></i>
                                    <?= date('d M Y', strtotime($task['due_date'])); ?>
                                </span>
                                <?php if(isset($project)):?>
                                <div>

                                <button onclick="confirmDelete(<?= $task['id'] ?>)" class="text-gray-500">
                                    <i class="ri-delete-bin-line mr-1"></i>
                                    
                                </button >
                                <button onclick="editTask(<?= $task['id'] ?>)" class="text-gray-500">
                                    <i class="ri-edit-line mr-1"></i>
                                    
                                </button >
                                </div>
                                <?php else:?>
                                    <button onclick="editStatus(<?= $task['id'] ?>)" class="text-gray-500">
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
                                <a href="#" onclick="showTaskDetails(<?= $task['id'] ?>)" class="text-sm font-medium text-gray-900 hover:text-indigo-600">
                                    <?= htmlspecialchars($task['title']) ?>
                                </a>
                                <p class="text-xs text-gray-500 mt-1"><?=$task['description']?></p>
                            </div>
                            <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800"><?=$task['status']?></span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center justify-between space-x-3 w-full">
                                
                                <span class="text-gray-500">
                                    <i class="ri-calendar-line mr-1"></i>
                                    <?= date('d M Y', strtotime($task['due_date'])); ?>
                                </span>
                                <?php if(isset($project)):?>
                                <div>

                                <button onclick="confirmDelete(<?= $task['id'] ?>)" class="text-gray-500">
                                    <i class="ri-delete-bin-line mr-1"></i>
                                    
                                </button >
                                <button onclick="editTask(<?= $task['id'] ?>)" class="text-gray-500">
                                    <i class="ri-edit-line mr-1"></i>
                                    
                                </button >
                                </div>
                                <?php else:?>
                                    <button onclick="editStatus(<?= $task['id'] ?>)" class="text-gray-500">
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
                                <a href="#" onclick="showTaskDetails(<?= $task['id'] ?>)" class="text-sm font-medium text-gray-900 hover:text-indigo-600">
                                    <?= htmlspecialchars($task['title']) ?>
                                </a>
                                <p class="text-xs text-gray-500 mt-1"><?=$task['description']?></p>
                            </div>
                            <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800"><?=$task['status']?></span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center justify-between space-x-3 w-full">
                                
                                <span class="text-gray-500">
                                    <i class="ri-calendar-line mr-1"></i>
                                    <?= date('d M Y', strtotime($task['due_date'])); ?>
                                </span>
                                <?php if(isset($project)):?>
                                <div>

                                <button onclick="confirmDelete(<?= $task['id'] ?>)" class="text-gray-500">
                                    <i class="ri-delete-bin-line mr-1"></i>
                                    
                                </button >
                                <button onclick="editTask(<?= $task['id'] ?>)" class="text-gray-500">
                                    <i class="ri-edit-line mr-1"></i>
                                    
                                </button >
                                </div>
                                <?php else:?>
                                    <button onclick="editStatus(<?= $task['id'] ?>)" class="text-gray-500">
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
    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="sm:flex sm:items-start"> 
            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Modifier le statut de la tâche</h3>
               
            </div>
        </div>
        <div class="mt-3">
            <input type="hidden" name="task_id" id="edit-task-status-id">
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
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="task-details-title"></h3>
                        
                        <div class="mt-4 space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Description</label>
                                <p id="task-details-description" class="mt-1 text-sm text-gray-600"></p>
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Statut</label>
                                    <span id="task-details-status" class="mt-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"></span>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Date d'échéance</label>
                                    <span id="task-details-due-date" class="mt-1 text-sm text-gray-600"></span>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Membres assignés</label>
                                <div id="task-details-members" class="space-y-2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="closeModal('task-details-modal')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                    Fermer
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function editStatus(taskId) {
        document.getElementById('change-task-status-modal').classList.remove('hidden');
        document.getElementById('edit-task-status-id').value = taskId;
    }

    function showTaskDetails(taskId) {
        // Fetch task details using AJAX
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
            // Populate the modal with task details
            document.getElementById('task-details-title').textContent = task.title;
            document.getElementById('task-details-description').textContent = task.description || 'Aucune description';
            
            // Set status with appropriate color
            const statusElement = document.getElementById('task-details-status');
            statusElement.textContent = getStatusLabel(task.status);
            statusElement.className = `mt-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${getStatusColor(task.status)}`;
            
            // Format and set due date
            const dueDate = new Date(task.due_date);
            document.getElementById('task-details-due-date').textContent = dueDate.toLocaleDateString('fr-FR');
            
            // Handle assigned members
            const membersContainer = document.getElementById('task-details-members');
            membersContainer.innerHTML = ''; // Clear existing members
            
            if (task.assigned_users && task.assigned_users.length > 0) {
                task.assigned_users.forEach(userId => {
                    const memberElement = document.createElement('div');
                    memberElement.className = 'flex items-center space-x-3 p-2 rounded-lg bg-gray-50';
                    
                    const member = findMemberById(userId);
                    if (member) {
                        memberElement.innerHTML = `
                            <img class="h-8 w-8 rounded-full" 
                                 src="https://ui-avatars.com/api/?name=${encodeURIComponent(member.name)}" 
                                 alt="${member.name}">
                            <span class="text-sm text-gray-900">${member.name}</span>
                        `;
                        membersContainer.appendChild(memberElement);
                    }
                });
            } else {
                membersContainer.innerHTML = '<p class="text-sm text-gray-500">Aucun membre assigné</p>';
            }
            
            // Show the modal
            document.getElementById('task-details-modal').classList.remove('hidden');
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Une erreur est survenue lors de la récupération des détails de la tâche');
        });
    }

    function getStatusLabel(status) {
        const labels = {
            'todo': 'À faire',
            'in_progress': 'En cours',
            'review': 'En révision',
            'done': 'Terminé'
        };
        return labels[status] || status;
    }

    function getStatusColor(status) {
        const colors = {
            'todo': 'bg-gray-100 text-gray-800',
            'in_progress': 'bg-blue-100 text-blue-800',
            'review': 'bg-yellow-100 text-yellow-800',
            'done': 'bg-green-100 text-green-800'
        };
        return colors[status] || 'bg-gray-100 text-gray-800';
    }

    function findMemberById(userId) {
        // This function should return the member data from your team array
        // You'll need to make this data available to the JavaScript
        const team = <?= json_encode($team ?? []) ?>;
        return team.find(member => member.id === userId);
    }
</script>