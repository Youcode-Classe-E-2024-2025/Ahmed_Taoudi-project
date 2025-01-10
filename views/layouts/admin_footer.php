<script>
    // Toggle sidebar on mobile
    document.getElementById('toggleSidebar').addEventListener('click', function() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('-translate-x-full');
    });

    function editUser(user) {
        // Implement edit user functionality
    }

    function deleteUser(userId) {
        if (confirm('Are you sure you want to delete this user?')) {
            window.location.href = `/admin/users/delete?id=${userId}`;
        }
    }

    // function editRole(role) {
    //     // Implement edit role functionality
    // }

    function deleteRole(roleName) {
        if (confirm('Are you sure you want to delete this role?')) {
            window.location.href = `/admin/roles/delete?name=${roleName}`;
        }
    }
    </script>
    <script>
function editRole(name, description, permissions) {
    document.getElementById('edit_role_name').value = name;
    document.getElementById('edit_description').value = description;
    
    // Reset all checkboxes
    const checkboxes = document.querySelectorAll('#edit_permissions input[type="checkbox"]');
    checkboxes.forEach(cb => cb.checked = false);
    
    // Check the permissions that the role has
    if (permissions) {
        const rolePermissions = permissions.split(',').map(p => p.trim());
        checkboxes.forEach(cb => {
            if (rolePermissions.includes(cb.nextElementSibling.textContent.trim())) {
                cb.checked = true;
            }
        });
    }
    
    document.getElementById('edit-role-modal').classList.remove('hidden');
}
</script>
</body>
</html>