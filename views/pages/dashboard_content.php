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


<!--  1 add a chart for project progress -->
<!-- Charts Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
    <!-- Project Progress Chart -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Project Progress</h3>
        <div class="relative h-[300px]">
            <canvas id="projectProgressChart"></canvas>
        </div>
    </div>

<!--  2 add a chart for team productivity -->
    <!-- Team Productivity Chart -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Team Productivity</h3>
        <div class="relative h-[300px]">
            <canvas id="teamProductivityChart"></canvas>
        </div>
    </div>

<!--  3 add a chart for task completion -->
    <!-- Task Completion Chart -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Task Completion</h3>
        <div class="relative h-[300px]">
            <canvas id="taskCompletionChart"></canvas>
        </div>
    </div>
</div>

<!-- Chart.js Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Function to fetch chart data
async function fetchChartData() {
    try {
        const response = await fetch('/home/getChartData');
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return await response.json();
    } catch (error) {
        console.error('Error fetching chart data:', error);
        return null;
    }
}

// Initialize Project Progress Chart
async function initProjectProgressChart() {
    const data = await fetchChartData();
    if (!data) return;

    const ctx = document.getElementById('projectProgressChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: data.projectProgress.labels,
            datasets: [{
                data: data.projectProgress.data,
                backgroundColor: ['#10B981', '#FBBF24', '#EF4444'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
}

// Initialize Team Productivity Chart
async function initTeamProductivityChart() {
    const data = await fetchChartData();
    if (!data) return;

    const ctx = document.getElementById('teamProductivityChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: data.teamProductivity.labels,
            datasets: [{
                label: 'Tasks Completed',
                data: data.teamProductivity.data,
                borderColor: '#6366F1',
                tension: 0.4,
                fill: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        display: false
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
}

// Initialize Task Completion Chart
async function initTaskCompletionChart() {
    const data = await fetchChartData();
    if (!data) return;

    const ctx = document.getElementById('taskCompletionChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.taskCompletion.labels,
            datasets: [{
                label: 'Completed Tasks',
                data: data.taskCompletion.data,
                backgroundColor: '#60A5FA',
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        display: false
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
}

// Initialize all charts
document.addEventListener('DOMContentLoaded', () => {
    initProjectProgressChart();
    initTeamProductivityChart();
    initTaskCompletionChart();
});
</script>