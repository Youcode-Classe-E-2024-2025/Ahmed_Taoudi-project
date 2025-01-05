<div class="space-y-6">
    <!-- Projects Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Projets</h1>
            <p class="mt-1 text-sm text-gray-500">Gérez vos projets et suivez leur progression</p>
        </div>
        <button onclick="openModal(event)" id="btn-nouveau-projet" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            <i class="ri-add-line mr-1"></i> Nouveau Projet
        </button>
    </div>


    <!-- Projects Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        
        
        <?php foreach($projects as $prj) : ?> 
            <!-- Project Card -->
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
            <div class="p-5">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <!-- name -->
                       <a href="/projects?id=<?= $prj["id"]?>"><h3 class="text-lg font-semibold text-gray-900 hover:underline hover:text-green-700"><?= $prj["name"]?></h3></a> 
                        <!-- description -->
                        <p class="text-sm text-gray-500 mt-1"><?= $prj["description"]?></p>
                    </div>
                    <!-- status -->
                    <?php if($prj["status"] == 'in_progress'){?>
                    <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">En cours</span>
                    <?php }else if($prj["status"] == 'planning'){?>
                    <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">Planifie</span>
                    <?php }else{?>
                    <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Complete</span>
                    <?php }?>
                </div>


     
                
                <div class="space-y-3">
                    <!-- <div>
                        <div class="flex justify-between text-sm text-gray-500 mb-1">
                            <span>Progression</span>
                            <span>75%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: 75%"></div>
                        </div>
                    </div> -->
                    
                    <div class="flex justify-between items-center">
                        
                        <div class="text-sm text-gray-500">
                            <i class="ri-calendar-line mr-1"></i>
                            <?= $prj["end_date"]?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php endforeach ;?>
        
    </div>

</div>

<!-- New Project Modal -->
<div id="newProjectModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Nouveau Projet</h3>
            <form id="form-project-add" method="POST" action="/project/create">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nom du projet</label>
                        <input name="name" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea name="description" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500" rows="3"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date de debut</label>
                        <input name="start_date" type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date de fin</label>
                        <input  name="end_date" type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <!-- <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Catégorie</label>
                        <select  name="end_date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Sélectionner une catégorie</option>
                            <option value="dev">Développement</option>
                            <option value="design">Design</option>
                            <option value="marketing">Marketing</option>
                        </select>
                    </div> -->
                </div>
                <div class="flex justify-end gap-3 mt-4">
                    <button onclick="closeModal()" id="btn-close-model" type="button" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
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
    const modal = document.getElementById('newProjectModal');
    // const openModalBtn = document.getElementById('btn-nouveau-projet');
    // const closeModalBtn = modal.getElementById('btn-close-model');

    openModal = function (event){
        modal.classList.remove('hidden');
    };
    closeModal = function (){
        modal.classList.add('hidden');
    };

    // closeModalBtn.addEventListener('click', () => {
    //     modal.classList.add('hidden');
    // });

    // Close modal when clicking outside
    // modal.addEventListener('click', (e) => {
    //     if (e.target === modal) {
    //         modal.classList.add('hidden');
    //     }
    // });
</script>
