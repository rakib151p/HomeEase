<?php
// // Database connection
// include '../config.php';
// // Query to fetch reviews along with customer names
// $sql = "
//     SELECT 
//         spr.service_provider_id, 
//         spr.customer_id, 
//         ut.user_name, 
//         spr.review_text, 
//         spr.review_rating 
//     FROM 
//         service_provider_review spr
//     JOIN 
//         user ut 
//     ON 
//         spr.customer_id = ut.user_id
//     ORDER BY 
//         spr.service_provider_id, spr.review_time DESC
// ";

// $result = $con->query($sql);

// $reviewsArray = [];

// if ($result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//         $providerId = $row['service_provider_id'];
//         $customerName = $row['user_name'];
//         $reviewText = $row['review_text'];
//         $reviewRating = $row['review_rating'];
        
//         // Organize data into an array
//         $reviewsArray[$providerId][] = [
//             'user_name' => $customerName,
//             'review_text' => $reviewText,
//             'review_rating' => $reviewRating
//         ];
//     }
// } else {
//     echo "No reviews found.";
// }

// // Close the connection
// $con->close();

// // Display the result (for testing purposes)
// echo "<pre>";
// print_r($reviewsArray);
// echo "</pre>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Provider Reviews</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

    <!-- Service Providers List -->
    <div class="max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Service Providers</h1>
        <button 
            class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600"
            onclick="showReviews(1)">
            Show Reviews for Provider 1
        </button>
        <button 
            class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 ml-2"
            onclick="showReviews(2)">
            Show Reviews for Provider 2
        </button>
    </div>

    <!-- Overlay Popup -->
    <div 
        id="reviewPopup" 
        class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden flex justify-center items-center z-50">
        <div class="bg-white w-11/12 max-w-lg p-6 rounded-lg shadow-lg relative">
            <button 
                class="absolute top-2 right-2 text-gray-500 hover:text-gray-800"
                onclick="closePopup()">
                ✖
            </button>
            <h2 class="text-xl font-semibold mb-4">Service Provider Reviews</h2>
            <div id="reviewsContainer" class="space-y-4">
                <!-- Reviews will be dynamically inserted here -->
            </div>
        </div>
    </div>

    <script>
        // Reviews Data (from PHP output)
        var reviewsData = {
            "1": [
                {
                    "customer_name": "John Doe",
                    "review_text": "Excellent service!",
                    "review_rating": 5
                },
                {
                    "customer_name": "Jane Smith",
                    "review_text": "Very professional.",
                    "review_rating": 4
                }
            ],
            "2": [
                {
                    "customer_name": "Mark Johnson",
                    "review_text": "Not satisfied.",
                    "review_rating": 2
                },
                {
                    "customer_name": "Emily Davis",
                    "review_text": "Great experience!",
                    "review_rating": 5
                }
            ]
        };

        // Show Reviews
        function showReviews(providerId) {
            const reviewsContainer = document.getElementById('reviewsContainer');
            const reviews = reviewsData[providerId] || [];
            reviewsContainer.innerHTML = '';

            if (reviews.length === 0) {
                reviewsContainer.innerHTML = `
                    <p class="text-gray-500">No reviews available for this provider.</p>
                `;
            } else {
                reviews.forEach(review => {
                    reviewsContainer.innerHTML += `
                        <div class="p-4 bg-gray-50 border rounded-md">
                            <p class="font-semibold">${review.customer_name}:</p>
                            <p class="text-gray-700">${review.review_text}</p>
                            <p class="text-yellow-500 font-medium">Rating: ${review.review_rating}/5</p>
                        </div>
                    `;
                });
            }

            document.getElementById('reviewPopup').classList.remove('hidden');
        }

        // Close Popup
        function closePopup() {
            document.getElementById('reviewPopup').classList.add('hidden');
        }
    </script>

</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popup Reviews</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto py-10 text-center">
        <h2 class="text-3xl font-bold text-gray-700 mb-8">Reviews Popup Example</h2>
        <button
            class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition-all"
            onclick="showReviews()">
            View Reviews
        </button>
    </div>

    <!-- Modal -->
    <div id="modal-overlay" class="hidden fixed inset-0 bg-black bg-opacity-50" onclick="closeModal()"></div>
    <div id="modal" class="hidden fixed inset-0 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Customer Reviews</h2>
                <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">✕</button>
            </div>
            <div
                id="reviews-container"
                class="space-y-4 max-h-[300px] overflow-y-auto border-t border-gray-200 pt-4">
                <!-- Reviews will be loaded here -->
            </div>
        </div>
    </div>

    <script>
        function showReviews() {
            const modal = document.getElementById("modal");
            const overlay = document.getElementById("modal-overlay");
            const reviewsContainer = document.getElementById("reviews-container");

            // Example reviews data
            const reviews = [{
                    name: "John Doe",
                    rating: 5,
                    comment: "Excellent service!"
                },
                {
                    name: "Jane Smith",
                    rating: 4,
                    comment: "Great experience, but there's room for improvement."
                },
                {
                    name: "Alice Johnson",
                    rating: 3,
                    comment: "It was okay, nothing extraordinary."
                },
                {
                    name: "Mark Lee",
                    rating: 4,
                    comment: "Good value for money!"
                },
                {
                    name: "Sara Khan",
                    rating: 5,
                    comment: "Absolutely loved it. Will use it again!"
                },
                {
                    name: "Tom Hardy",
                    rating: 2,
                    comment: "Not satisfied with the service."
                },
            ];

            // Clear any existing reviews
            reviewsContainer.innerHTML = "";

            // Populate reviews
            reviews.forEach((review) => {
                const reviewCard = document.createElement("div");
                reviewCard.className = "bg-gray-100 p-4 rounded-lg shadow-md";

                reviewCard.innerHTML = `
          <h3 class="text-lg font-semibold">${review.name}</h3>
          <p class="text-yellow-500">Rating: ${"⭐".repeat(review.rating)}</p>
          <p class="text-gray-600">${review.comment}</p>
        `;
                reviewsContainer.appendChild(reviewCard);
            });

            // Show modal and overlay
            modal.classList.remove("hidden");
            overlay.classList.remove("hidden");
        }

        function closeModal() {
            const modal = document.getElementById("modal");
            const overlay = document.getElementById("modal-overlay");

            modal.classList.add("hidden");
            overlay.classList.add("hidden");
        }
    </script>
</body>

</html>
