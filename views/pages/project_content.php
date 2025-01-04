<!-- project content details -->
<?php
//  pd([
//                 'project' => $project,
//                 'tasks' => $tasks,
//                 'team' => $team,
//                 'stats' => $stats
//             ]);
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
                <?= $project['status'] === 'En cours' ? 'bg-green-100 text-green-800' : 
                   ($project['status'] === 'En pause' ? 'bg-yellow-100 text-yellow-800' : 
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
            <h2 class="text-lg font-semibold text-gray-900">Détails du projet</h2>
            
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
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-gray-900">Équipe</h2>
                <button class="text-sm text-indigo-600 hover:text-indigo-700">
                    <i class="ri-user-add-line mr-1"></i> Ajouter
                </button>
            </div>
            
            <div class="space-y-3">
                <?php if (empty($team)): ?>
                    <p class="text-gray-500 text-center py-4">Aucun membre dans l'équipe</p>
                <?php else: ?>
                    <?php foreach ($team as $member): ?>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <img class="w-8 h-8 rounded-full" 
                                 src="https://ui-avatars.com/api/?name=<?= urlencode($member['name']) ?>" 
                                 alt="<?= htmlspecialchars($member['name']) ?>">
                            <div>
                                <p class="text-sm font-medium text-gray-900"><?= htmlspecialchars($member['name']) ?></p>
                                
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Tasks Section -->
  <?php require_once "views/pages/tasks_content.php"; ?>
</div>