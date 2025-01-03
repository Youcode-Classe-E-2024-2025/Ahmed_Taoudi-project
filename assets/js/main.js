
        // Toggle mobile sidebar
        const toggleSidebarMobile = document.getElementById('toggleSidebarMobile');
        const sidebar = document.getElementById('sidebar');
        
        toggleSidebarMobile.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', (e) => {
            if (window.innerWidth < 1024) {
                if (!sidebar.contains(e.target) && !toggleSidebarMobile.contains(e.target)) {
                    sidebar.classList.add('-translate-x-full');
                }
            }
        });

    // Modal functionality
    // const modal = document.getElementById('newProjectModal');
    // const openModalBtn = document.getElementById('btn-nouveau-projet');
    // const closeModalBtn = modal?.getElementById('btn-close-model');

    // openModal = function (event){
    //     modal?.classList.remove('hidden');
    // };
    // closeModal = function (){
    //     modal?.classList.remove('hidden');
    // };

    // closeModalBtn.addEventListener('click', () => {
    //     modal.classList.add('hidden');
    // });

    // Close modal when clicking outside
    // modal.addEventListener('click', (e) => {
    //     if (e.target === modal) {
    //         modal.classList.add('hidden');
    //     }
    // });
