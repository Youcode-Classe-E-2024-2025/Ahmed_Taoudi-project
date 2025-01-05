<?php
// Get some sample data (replace with actual data from your database)
// $totalProjects = 12;
// $activeProjects = 5;
// $totalTasks = 48;
// $completedTasks = 32;
?>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
    <!-- Project Stats -->
    <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
        <div class="flex items-center">
            <div class="flex-shrink-0 bg-indigo-100 rounded-full p-3">
                <i class="ri-folder-line text-xl text-indigo-600"></i>
            </div>
            <div class="ml-4">
                <h2 class="text-gray-900 text-lg font-semibold">Projects</h2>
                <div class="flex items-baseline">
                    <p class="text-2xl font-bold text-gray-900"><?php echo $activeProjects; ?></p>
                    <p class="ml-2 text-sm text-gray-600">of <?php echo $totalProjects; ?> active</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Task Stats -->
    <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
        <div class="flex items-center">
            <div class="flex-shrink-0 bg-green-100 rounded-full p-3">
                <i class="ri-task-line text-xl text-green-600"></i>
            </div>
            <div class="ml-4">
                <h2 class="text-gray-900 text-lg font-semibold">Tasks</h2>
                <div class="flex items-baseline">
                    <p class="text-2xl font-bold text-gray-900"><?php echo $completedTasks; ?></p>
                    <p class="ml-2 text-sm text-gray-600">of <?php echo $totalTasks; ?> completed</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Team Members -->
    <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
        <div class="flex items-center">
            <div class="flex-shrink-0 bg-blue-100 rounded-full p-3">
                <i class="ri-team-line text-xl text-blue-600"></i>
            </div>
            <div class="ml-4">
                <h2 class="text-gray-900 text-lg font-semibold">Team</h2>
                <div class="flex items-baseline">
                    <p class="text-2xl font-bold text-gray-900">8</p>
                    <p class="ml-2 text-sm text-gray-600">members</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Upcoming Deadlines -->
    <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
        <div class="flex items-center">
            <div class="flex-shrink-0 bg-red-100 rounded-full p-3">
                <i class="ri-calendar-line text-xl text-red-600"></i>
            </div>
            <div class="ml-4">
                <h2 class="text-gray-900 text-lg font-semibold">Deadlines</h2>
                <div class="flex items-baseline">
                    <p class="text-2xl font-bold text-gray-900">3</p>
                    <p class="ml-2 text-sm text-gray-600">this week</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Projects -->
<div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-4">
    <div class="p-4 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-900">Recent Projects</h2>
    </div>
    <div class="p-4">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Project</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Progress</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Team</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">Website Redesign</div>
                            <div class="text-sm text-gray-500">Due in 5 days</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: 75%"></div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex -space-x-2">
                                <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white" src="https://ui-avatars.com/api/?name=John+Doe" alt="">
                                <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white" src="https://ui-avatars.com/api/?name=Jane+Smith" alt="">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">Mobile App Development</div>
                            <div class="text-sm text-gray-500">Due in 2 weeks</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">In Progress</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: 45%"></div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex -space-x-2">
                                <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white" src="https://ui-avatars.com/api/?name=Mike+Brown" alt="">
                                <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white" src="https://ui-avatars.com/api/?name=Sarah+Wilson" alt="">
                                <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white" src="https://ui-avatars.com/api/?name=Tom+Davis" alt="">
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <!-- Tasks Due Today -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Tasks Due Today</h2>
        </div>
        <div class="p-4">
            <ul class="divide-y divide-gray-200">
                <li class="py-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input type="checkbox" class="h-4 w-4 text-indigo-600 rounded border-gray-300">
                            <span class="ml-3 text-sm text-gray-900">Update homepage design</span>
                        </div>
                        <span class="text-sm text-red-600">2 hours left</span>
                    </div>
                </li>
                <li class="py-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input type="checkbox" class="h-4 w-4 text-indigo-600 rounded border-gray-300">
                            <span class="ml-3 text-sm text-gray-900">Review client feedback</span>
                        </div>
                        <span class="text-sm text-red-600">5 hours left</span>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Recent Activity</h2>
        </div>
        <div class="p-4">
            <ul class="divide-y divide-gray-200">
                <li class="py-3">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <img class="h-8 w-8 rounded-full" src="https://ui-avatars.com/api/?name=John+Doe" alt="">
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-gray-900">John Doe completed task <span class="font-medium">Update API documentation</span></p>
                            <p class="text-sm text-gray-500">2 hours ago</p>
                        </div>
                    </div>
                </li>
                <li class="py-3">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <img class="h-8 w-8 rounded-full" src="https://ui-avatars.com/api/?name=Jane+Smith" alt="">
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-gray-900">Jane Smith created new project <span class="font-medium">Mobile App v2</span></p>
                            <p class="text-sm text-gray-500">5 hours ago</p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
