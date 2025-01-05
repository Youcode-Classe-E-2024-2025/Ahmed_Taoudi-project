
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

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }

