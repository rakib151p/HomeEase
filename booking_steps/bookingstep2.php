<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Form</title>
    <style>
        body {
            padding: 0;
            margin: 0;
        }
    </style>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>

</head>

<body class="bg-gradient-to-bl from-blue-100 via-white to-blue-50 font-sans h-screen">


    <!-- Step 2: Task Options -->
    <div id="task-options" class="max-w-4xl mx-auto mt-10 p-6 bg-white shadow rounded-lg hidden bg-gradient-to-bl from-blue-100 via-white to-blue-50 shadow-xl">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Task Options</h3>
        <p class="text-gray-600 text-sm mb-6">How big is your task?</p>

        <form onsubmit="showThirdForm(event)" class="space-y-4">
            <div class="space-y-2">
                <label class="flex items-center">
                    <input type="radio" name="task-size" value="Small" class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500" required>
                    <span class="ml-2 text-gray-700">Small - Est. 1 hr</span>
                </label>
                <label class="flex items-center">
                    <input type="radio" name="task-size" value="Medium" class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500" required>
                    <span class="ml-2 text-gray-700">Medium - Est. 2-3 hrs</span>
                </label>
                <label class="flex items-center">
                    <input type="radio" name="task-size" value="Large" class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500" required>
                    <span class="ml-2 text-gray-700">Large - Est. 4+ hrs</span>
                </label>
            </div>
            <button type="submit" class="w-full py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Continue</button>
        </form>
    </div>


</body>

</html>