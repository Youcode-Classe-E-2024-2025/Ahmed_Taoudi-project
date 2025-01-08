<?php require_once 'views/layouts/admin_header.php'; ?>

<!-- Main Content -->
<div class="p-4 sm:ml-64 pt-20">
    <?php if (isset($_SESSION['message'])): ?>
        <div class="p-4 mb-4 text-sm text-emerald-700 bg-emerald-100 rounded-lg">
            <?= htmlspecialchars($_SESSION['message']) ?>
            <?php unset($_SESSION['message']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">
            <?= htmlspecialchars($_SESSION['error']) ?>
            <?php unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <div class="space-y-6">
        <!-- Stats Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-emerald-100 text-emerald-600">
                        <i class="ri-user-line text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Users</p>
                        <p class="text-2xl font-semibold text-gray-900"><?= $stats['total_users'] ?></p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-emerald-100 text-emerald-600">
                        <i class="ri-folder-line text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Active Projects</p>
                        <p class="text-2xl font-semibold text-gray-900"><?= $stats['active_projects'] ?></p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-emerald-100 text-emerald-600">
                        <i class="ri-shield-user-line text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Roles</p>
                        <p class="text-2xl font-semibold text-gray-900"><?= $stats['total_roles'] ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <a href="/admin/users">
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 text-center text-gray-900 text-2xl">
                 <i class="ri-user-line  text-2xl"></i> manage users
                </div>
            </a>
            <a href="/admin/roles">
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 text-center text-gray-900 text-2xl">
                   <i class="ri-shield-user-line text-2xl"></i> manage roles
                </div>
            </a>
        </div>


    </div>
</div>





<?php require_once 'views/layouts/admin_footer.php'; ?>