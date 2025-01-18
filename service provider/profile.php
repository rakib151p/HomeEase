<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomeEase Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-blue-50 font-sans">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md flex flex-col p-4">
            <div class="flex flex-col items-center">
                <div class="bg-blue-200 rounded-full w-24 h-24 flex items-center justify-center">
                    <span class="text-blue-600 text-3xl font-bold">P</span>
                </div>
                <h2 class="mt-4 font-semibold text-lg">Team R3P innovators</h2>
                <p class="text-sm text-gray-500">Provider ID: 1023034</p>
            </div>

            <nav class="mt-8 space-y-4">
                <a href="dashboard.php" class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md">
                    <span class="material-icons mr-3">Dashboard</span>
                </a>
                <a href="" class="flex items-center px-4 py-2 text-blue-600 bg-blue-100 rounded-md">
                    <span class="material-icons mr-3">Profile</span>
                </a>
                <a href="Order_Manage.php" class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md">
                    <span class="material-icons mr-3">Order Manage</span>
                </a>
                <a href="order_history.php" class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md">
                    <span class="material-icons mr-3">History</span>
                </a>
                <a href="Myreviews.php" class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md">
                    <span class="material-icons mr-3">My reviews</span>
                </a>
                <a href="Notification.php" class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md">
                    <span class="material-icons mr-3">Notifications</span>
                </a>
                <a href="#" class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md">
                    <span class="material-icons mr-3">Log Out</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <div class="container  w-screen ">
                <div class="bg-white shadow-xl rounded-xl p-8 max-w-scree mx-auto">
                    <!-- Header -->
                    <div class="flex justify-between items-center mb-8">
                        <h2 class="text-3xl font-bold text-gray-800">Provider Profile</h2>
                        <button id="editToggle" class="bg-blue-600 text-white px-6 py-2 rounded-lg shadow hover:bg-blue-700 transition duration-300">
                            Edit
                        </button>
                    </div>

                    <!-- Profile Form -->
                    <form id="providerForm" action="#" method="POST" enctype="multipart/form-data">
                        <!-- Profile Picture Section -->
                        <div class="flex items-center mb-6">
                            <div class="relative">
                                <!-- Profile Picture Preview -->
                                <img
                                    id="profilePicturePreview"
                                    src="https://via.placeholder.com/100"
                                    alt="Profile Picture"
                                    class="w-24 h-24 rounded-full object-cover border-4 border-gray-300 shadow-lg">
                                <!-- Upload Label -->
                                <label
                                    for="provider_profile_picture"
                                    class="absolute bottom-0 right-0 bg-blue-600 text-white p-2 rounded-full shadow-lg cursor-pointer hover:bg-blue-700 transition">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="2"
                                        stroke="currentColor"
                                        class="w-5 h-5">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M15.232 5.232l3.536 3.536M9 11l5.268-5.268a2 2 0 112.828 2.828L11.828 15H9v-2.828zM3 3l18 18" />
                                    </svg>
                                </label>
                                <!-- File Input -->
                                <input
                                    type="file"
                                    id="provider_profile_picture"
                                    name="provider_profile_picture"
                                    class="hidden"
                                    accept="image/*">
                            </div>
                        </div>

                        <!-- Basic Details -->
                        <div class="grid grid-cols-2 gap-8 mb-8">
                            <div>
                                <label class="block text-gray-700 font-medium mb-2" for="provider_name">Name</label>
                                <input type="text" id="provider_name" name="provider_name"
                                    class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-2 focus:ring-blue-400"
                                    placeholder="Enter your name" value="" disabled>
                            </div>
                            <div>
                                <label class="block text-gray-700 font-medium mb-2" for="provider_email">Email</label>
                                <input type="email" id="provider_email" name="provider_email"
                                    class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-2 focus:ring-blue-400"
                                    placeholder="Enter your email" value="" disabled>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-8 mb-8">
                            <div>
                                <label class="block text-gray-700 font-medium mb-2" for="provider_password">Password</label>
                                <input type="password" id="provider_password" name="provider_password"
                                    class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-2 focus:ring-blue-400"
                                    placeholder="Enter your password" value="" disabled>
                            </div>
                            <div>
                                <label class="block text-gray-700 font-medium mb-2" for="provider_status">Status</label>
                                <select id="provider_status" name="provider_status"
                                    class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-2 focus:ring-blue-400"
                                    disabled>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <!-- Address and Registration Date -->
                        <div class="grid grid-cols-2 gap-8 mb-8">
                            <div>
                                <label class="block text-gray-700 font-medium mb-2" for="provider_address">Address</label>
                                <input type="text" id="provider_address" name="provider_address"
                                    class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-2 focus:ring-blue-400"
                                    placeholder="Enter your address" value="" disabled>
                            </div>
                            <div>
                                <label class="block text-gray-700 font-medium mb-2" for="provider_registration_date">Registration Date</label>
                                <input type="date" id="provider_registration_date" name="provider_registration_date"
                                    class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-2 focus:ring-blue-400"
                                    value="" disabled>
                            </div>
                        </div>

                        <!-- Experience and About -->
                        <div class="grid grid-cols-2 gap-8 mb-8">
                            <div>
                                <label class="block text-gray-700 font-medium mb-2" for="provider_experience">Experience (Years)</label>
                                <input type="number" id="provider_experience" name="provider_experience"
                                    class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-2 focus:ring-blue-400"
                                    placeholder="Years of experience" value="" disabled>
                            </div>
                            <div>
                                <label class="block text-gray-700 font-medium mb-2" for="provider_about">About</label>
                                <textarea id="provider_about" name="provider_about" rows="4"
                                    class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-2 focus:ring-blue-400"
                                    placeholder="Tell us about yourself" disabled></textarea>
                            </div>
                        </div>

                        <!-- Phone and Gender -->
                        <div class="grid grid-cols-2 gap-8 mb-8">
                            <div>
                                <label class="block text-gray-700 font-medium mb-2" for="provider_phone">Phone</label>
                                <input type="text" id="provider_phone" name="provider_phone"
                                    class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-2 focus:ring-blue-400"
                                    placeholder="Enter your phone number" value="" disabled>
                            </div>
                            <div>
                                <label class="block text-gray-700 font-medium mb-2" for="provider_gender">Gender</label>
                                <select id="provider_gender" name="provider_gender"
                                    class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-2 focus:ring-blue-400"
                                    disabled>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" class="bg-green-500 text-white px-6 py-3 rounded-lg shadow hover:bg-green-600 transition duration-300"
                                disabled id="saveButton">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <script>
                // Toggle Edit Mode
                const editToggle = document.getElementById('editToggle');
                const formElements = document.querySelectorAll('#providerForm input, #providerForm select, #providerForm textarea');
                const saveButton = document.getElementById('saveButton');

                editToggle.addEventListener('click', () => {
                    const isDisabled = formElements[0].disabled;
                    formElements.forEach(element => element.disabled = !isDisabled);
                    saveButton.disabled = isDisabled;
                    editToggle.textContent = isDisabled ? 'Cancel' : 'Edit';
                });

                // Update Profile Picture Preview
                const profilePictureInput = document.getElementById('provider_profile_picture');
                const profilePicturePreview = document.getElementById('profilePicturePreview');

                profilePictureInput.addEventListener('change', (event) => {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = (e) => profilePicturePreview.src = e.target.result;
                        reader.readAsDataURL(file);
                    }
                });
            </script>
        </main>
    </div>

</body>

</html>