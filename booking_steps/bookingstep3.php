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




    <!-- Step 3: Task Details -->
    <div id="third-form" class="max-w-4xl mx-auto mt-10 p-6 bg-white shadow rounded-lg hidden  bg-gradient-to-bl from-blue-100 via-white to-blue-50 shadow-xl">
        <h2 class="text-2xl font-bold mb-4">Tell us the details of your task</h2>
        <p class="mb-4">
            Start the conversation and tell your Tasker what you need done. This helps us show you only qualified and available Taskers for the job.
            Don't worry, you can edit this later.
        </p>
        <textarea class="w-full resize-none border border-gray-300 rounded-md p-2 h-32 focus:outline-none focus:ring-2 focus:ring-blue-600"
            placeholder="Provide a summary of what you need done for your Tasker. Be sure to include details like the size of your space, any equipment/tools needed, and how to get in."
            required>
    </textarea>
        <p class="mt-4">
            If you need two or more Taskers, please post additional tasks for each Tasker needed.
        </p>
        <a href="stepofbooking_2.php"><button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">Submit</button></a>
    </div>




</body>

</html>