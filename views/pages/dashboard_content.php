<?php
// Get some sample data (replace with actual data from your database)
$totalProjects = 12;
$activeProjects = 5;
$totalTasks = 48;
$completedTasks = 32;
?>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
    <!-- Project Stats -->
    <!-- <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
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
    </div> -->

    <!-- Task Stats -->
    <!-- <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
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
    </div> -->

    <!-- Team Members -->
    <!-- <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
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
    </div> -->

    <!-- Upcoming Deadlines -->
    <!-- <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
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
    </div> -->
</div>

<!-- Charts Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
    <!-- Project Progress Chart -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Project Progress</h3>
        <div class="relative h-[300px]">
            <canvas id="projectProgressChart"></canvas>
        </div>
    </div>

    <!-- Team Productivity Chart -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Team Productivity</h3>
        <div class="relative h-[300px]">
            <canvas id="teamProductivityChart"></canvas>
        </div>
    </div>

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
        type: 'bar', // Changed to bar chart for better visualization
        data: {
            labels: data.teamProductivity.labels,
            datasets: [{
                label: 'Tasks by Status',
                data: data.teamProductivity.data,
                backgroundColor: ['#6366F1', '#FBBF24', '#10B981', '#EF4444'], // Different colors for each status
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