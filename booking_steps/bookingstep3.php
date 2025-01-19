<?php 
session_start();

?>
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
    <?php
    include 'header.php';

    ?>


    <div align="center">
        <h1 class="text-2xl font-bold mb-8">Task Progress</h1>

        <!-- Progress Bar -->
        <div class="w-3/4 flex items-center">
            <!-- Circle 1 -->
            <div class="relative flex flex-col items-center">
                <div id="circle1" class="w-8 h-8 rounded-full flex items-center justify-center border-4 border-blue-600  text-blue-700 text-black font-semibold">
                    1
                </div>
                <span class="text-xs mt-2 text-blue-700">Location</span>
            </div>
            <!-- Line 1 -->
            <div id="line1" class="flex-1 h-1 bg-blue-600"></div>

            <div class="relative flex flex-col items-center">
                <div id="circle2" class="w-8 h-8 rounded-full flex items-center justify-center border-4 border-blue-600  text-blue-700 text-black font-semibold">
                    2
                </div>
                <span class="text-xs mt-2 text-blue-700">Browse</span>
            </div>
            <!-- Line 2 -->
            <div id="line2" class="flex-1 h-1 bg-blue-600"></div>

            <!-- Circle 3 -->
            <div class="relative flex flex-col items-center">
                <div id="circle3" class="w-8 h-8 rounded-full flex items-center justify-center border-4 border-gray-300 bg-white text-gray-700 font-semibold">
                    3
                </div>
                <span class="text-xs mt-2 text-gray-700">Confirm</span>
            </div>
            <!-- Line 3 -->
            <div id="line3" class="flex-1 h-1 bg-gray-300"></div>

            <!-- Circle 4 -->
            <div class="relative flex flex-col items-center">
                <div id="circle4" class="w-8 h-8 rounded-full flex items-center justify-center border-4 border-gray-300 bg-white text-gray-700 font-semibold">
                    4
                </div>
                <span class="text-xs mt-2 text-gray-700">Complete</span>
            </div>
        </div>

    </div>

    <form action="bookingstep4.php">
        <!-- Step 3: Task Details -->
        <div id="third-form" class="max-w-4xl mx-auto mt-10 p-6 bg-white shadow rounded-lg bg-gradient-to-bl from-blue-100 via-white to-blue-50 shadow-xl">
            <h2 class="text-2xl font-bold mb-4">Tell us the details of your task</h2>
            <p class="mb-4">
                Start the conversation and tell your Tasker what you need done. This helps us show you only qualified and available Taskers for the job.
                Don't worry, you can edit this later.
            </p>
            <textarea
                class="w-full resize-none border border-gray-300 rounded-md p-2 h-32 focus:outline-none focus:ring-2 focus:ring-blue-600"
                placeholder="Provide a summary of what you need done for your Tasker. Be sure to include details like the size of your space, any equipment/tools needed, and how to get in."
                required></textarea>
            <p class="mt-4">
                If you need two or more Taskers, please post additional tasks for each Tasker needed.
            </p>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">Submit</button>
        </div>
    </form>
    <?php
    include '../footer.php';

    ?>
</body>

</html>