<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Setup | Task Flow</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md">
        <div class="bg-white shadow-2xl rounded-2xl p-8 transform transition duration-500 hover:scale-105">
            <div class="text-center mb-8">
                <i class="fas fa-database text-6xl text-blue-600 mb-4"></i>
                <h2 class="text-3xl font-bold text-gray-800">Database Setup</h2>
                <p class="text-gray-600 mt-2">Configure your Task Flow database</p>
            </div>

            <form action="/"  method="POST" class="space-y-6">
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded" role="alert">
                    <p class="text-blue-700">
                        <i class="fas fa-info-circle mr-2"></i>
                        Your database does not exist. Would you like to create it?
                    </p>
                </div>

                <div class="flex items-center justify-center space-x-4">
                    <label for="checkbox" class="flex items-center cursor-pointer">
                        <input 
                            id="checkbox" 
                            name="checkbox" 
                            type="checkbox" 
                            class="form-checkbox h-5 w-5 text-blue-600 rounded focus:ring-blue-500 border-gray-300"
                        >
                        <span class="ml-3 text-gray-700 font-medium">
                            Populate with Sample Data
                        </span>
                    </label>
                </div>

                <div class="text-center">
                    <button 
                        type="submit" 
                        name="createdb"
                        value="CREATE_DB" 
                        class="w-full px-6 py-3 bg-blue-600 text-white rounded-lg 
                        hover:bg-blue-700 transition duration-300 ease-in-out 
                        transform hover:scale-105 focus:outline-none 
                        focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 
                        flex items-center justify-center space-x-2"
                    >
                        <i class="fas fa-plus-circle"></i>
                        <span>Create Database</span>
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center text-sm text-gray-500">
                <p>
                    <i class="fas fa-shield-alt mr-2"></i>
                    Secure database initialization
                </p>
            </div>
        </div>
    </div>
</body>
</html>