// document.addEventListener("DOMContentLoaded", () => {
        //     const overlay = document.getElementById("overlay");
        //     const closeBtn = document.getElementById("closeBtn");
        //     const calendarElement = document.getElementById("calendar");
        //     const timeSelector = document.getElementById("time-selector");
        //     const timeDropdown = document.getElementById("time");
        //     const confirmSection = document.getElementById("confirm-section");
        //     const confirmBtn = document.getElementById("confirmBtn");
        //     const selectedDetails = document.getElementById("selectedDetails");
        //     const currentMonthElement = document.getElementById("currentMonth");
        //     const currentYearElement = document.getElementById("currentYear");

        //     const months = [
        //         "January", "February", "March", "April", "May", "June",
        //         "July", "August", "September", "October", "November", "December"
        //     ];

        //     let currentYear = new Date().getFullYear();
        //     let currentMonth = new Date().getMonth();
        //     let selectedDate = null;

        //     // Calculate available dates for the next 7 days
        //     const today = new Date();
        //     const availableDates = {};
        //     for (let i = 0; i < 7; i++) {
        //         const date = new Date(today.getFullYear(), today.getMonth(), today.getDate() + i);
        //         const dateKey = `${date.getFullYear()}-${date.getMonth() + 1}-${date.getDate()}`;
        //         const provider_id=document.getElementById('selected_provider_id').value;
        //         alert(provider_id+" abc"+dateKey);
        //         // availableDates[dateKey] = ["9:00 AM", "10:00 AM", "11:00 AM"]; // Example times
        //         fetchAvailableTimes(dateKey)
        //             .then(times => {
        //                 availableDates[dateKey] = times; // Assign fetched times to the availableDates array
        //                 renderCalendar(); // Re-render the calendar after updating available dates
        //             })
        //             .catch(error => {
        //                 alert(`Error fetching times for ${dateKey}:`, error);
        //                 availableDates[dateKey] = []; // Fallback to empty times if there's an error
        //             });
        //         // Fetch available times dynamically
        //         // const times = await fetchAvailableTimes(dateKey);
        //         // availableDates[dateKey] = times;
        //         // you just edit this section 
        //     }

        //     function renderCalendar() {
        //         calendarElement.innerHTML = "";
        //         currentMonthElement.textContent = months[currentMonth];
        //         currentYearElement.textContent = currentYear;

        //         const firstDay = new Date(currentYear, currentMonth, 1).getDay();
        //         const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();

        //         for (let i = 0; i < firstDay; i++) {
        //             const blank = document.createElement("div");
        //             calendarElement.appendChild(blank);
        //         }

        //         for (let day = 1; day <= daysInMonth; day++) {
        //             const button = document.createElement("button");
        //             button.textContent = day;

        //             const dateKey = `${currentYear}-${currentMonth + 1}-${day}`;
        //             if (availableDates[dateKey]) {
        //                 button.classList.add("bg-gray-200");
        //                 button.addEventListener("click", () => selectDate(dateKey, button));
        //             } else {
        //                 button.classList.add("bg-gray-100", "cursor-not-allowed");
        //                 button.disabled = true;
        //             }

        //             calendarElement.appendChild(button);
        //         }
        //     }

        //     function selectDate(dateKey, button) {
        //         // alert(dateKey);
        //         document.getElementById('hiddenDate').value = dateKey;
        //         selectedDate = dateKey;
        //         document.querySelectorAll("#calendar button").forEach(btn => btn.classList.remove("bg-indigo-500"));
        //         button.classList.add("bg-indigo-500");
        //         populateTimes(availableDates[dateKey]);
        //         selectedDetails.textContent = `Request for: ${months[currentMonth]} ${new Date(dateKey).getDate()}, ${currentYear}`;
        //         // document.getElementById('hiddenTime').value = 'Request for: 123';
        //         // alert(document.getElementById('hiddenTime').value);
        //         // selectedTimeParagraph.textContent = `Selected time: ${selectedTime}`;
        //         confirmSection.classList.remove("hidden");
        //     }

        //     function populateTimes(times) {
        //         timeDropdown.innerHTML = "";
        //         times.forEach(time => {
        //             const option = document.createElement("option");
        //             option.value = time;
        //             option.textContent = time;
        //             timeDropdown.appendChild(option);
        //         });
        //         timeSelector.classList.remove("hidden");
        //     }

        //     confirmBtn.addEventListener("click", () => {
        //         if (!selectedDate) {
        //             alert("Please select a date.");
        //             return;
        //         }
        //         const selectedTime = timeDropdown.value;
        //         // document.getElementById('hiddenDate').value = selectedDate;
        //         // alert(selectedDate);
        //         // var selected_date=selectedDate;
        //         // document.getElementById('hiddenTime').value = selectedTime;
        //         alert(`Request for: ${selectedDate} at ${selectedTime}`);
        //     });

        //     closeBtn.addEventListener("click", () => overlay.classList.add("hidden"));

        //     document.querySelectorAll(".mendaBtn").forEach((btn) => {
        //         btn.addEventListener("click", (event) => {

        //             const taskerId = event.target.getAttribute("data-tasker-id"); // Retrieve the tasker ID
        //             document.getElementById("selected_provider").value = taskerId;
        //             document.getElementById("selected_provider_id").value = taskerId;

        //             alert(`Selected Tasker ID: ${document.getElementById("selected_provider_id").value}`); // Display the tasker ID in an alert
        //             overlay.classList.remove("hidden"); // Show the overlay
        //         });
        //     });

        //     renderCalendar();
        // });
        