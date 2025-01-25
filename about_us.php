<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
</head>

<body class="bg-gradient-to-bl from-blue-100 via-white via-blue-100 to-slate-300">
    <?php 
    session_start();
    include 'header.php'; ?>


    <!-- Contact Us Section -->
    <section id="wat" class="py-12 ">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-blue-700 mb-8">Meet Our Team</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">

                <!-- Team Member 1 -->
                <div class="bg-gradient-to-bl from-blue-100 via-slate-100 to-slate-200  p-6 rounded-lg shadow-lg text-center">
                    <img src="image/about_us/1.jpg" alt="Member 1 Photo" class="rounded-full w-32 h-32 mx-auto mb-4">
                    <h3 class="text-2xl font-semibold text-gray-800">Md. Rakibul Islam</h3>
                    <p class="text-gray-500 mb-4">CEO and Founder</p>
                    <p class="text-gray-600">Md Rakibul Islam is the founder and CEO of HomeEase</p>
                    <a href="mailto:rakib151p@gmail.com" class="block mt-4 text-blue-600 hover:text-pink-700">rakib151p@gmail.com</a>
                </div>

                <!-- Team Member 2 -->
                <div class="bg-gradient-to-bl from-blue-100 via-slate-100 to-slate-200  p-6 rounded-lg shadow-lg text-center">
                    <img src="image/about_us/1.jpg" alt="Member 1 Photo" class="rounded-full w-32 h-32 mx-auto mb-4">
                    <h3 class="text-2xl font-semibold text-gray-800">Md. Rahadul Islam Jishan</h3>
                    <p class="text-gray-500 mb-4">CEO and Founder</p>
                    <p class="text-gray-600">Md Rahadul Islam Jishan is the founder and CEO of HomeEase</p>
                    <a href="mailto:rakib151p@gmail.com" class="block mt-4 text-blue-600 hover:text-pink-700">Rahadul151p@gmail.com</a>
                </div>

                <div class="bg-gradient-to-bl from-blue-100 via-slate-100 to-slate-200  p-6 rounded-lg shadow-lg text-center">
                    <img src="image/about_us/1.jpg" alt="Member 1 Photo" class="rounded-full w-32 h-32 mx-auto mb-4">
                    <h3 class="text-2xl font-semibold text-gray-800">Md Mosharraf Hossen</h3>
                    <p class="text-gray-500 mb-4">CEO and Founder</p>
                    <p class="text-gray-600">Md Mosharraf Hossen is the founder and CEO of HomeEase</p>
                    <a href="mailto:rakib151p@gmail.com" class="block mt-4 text-blue-600 hover:text-pink-700">Mosharraf151p@gmail.com</a>
                </div>

                <!-- Team Member 4 -->
                <div class="bg-gradient-to-bl from-blue-100 via-slate-100 to-slate-200  p-6 rounded-lg shadow-lg text-center">
                    <img src="image/about_us/1.jpg" alt="Member 1 Photo" class="rounded-full w-32 h-32 mx-auto mb-4">
                    <h3 class="text-2xl font-semibold text-gray-800">Tarek Rahman</h3>
                    <p class="text-gray-500 mb-4">CEO and Founder</p>
                    <p class="text-gray-600">Tarek Rahman is the founder and CEO of HomeEase</p>
                    <a href="mailto:rakib151p@gmail.com" class="block mt-4 text-blue-600 hover:text-pink-700">Tarek151p@gmail.com</a>
                </div>

            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>

</body>

</html>