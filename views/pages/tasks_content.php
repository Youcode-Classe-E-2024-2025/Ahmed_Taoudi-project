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
                                <h4 class="text-sm font-medium text-gray-900"><?=$task['title']?></h4>
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
                                <h4 class="text-sm font-medium text-gray-900"><?=$task['title']?></h4>
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
                                <h4 class="text-sm font-medium text-gray-900"><?=$task['title']?></h4>
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
                                <h4 class="text-sm font-medium text-gray-900"><?=$task['title']?></h4>
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
