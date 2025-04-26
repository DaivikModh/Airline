document.addEventListener('DOMContentLoaded', function() {
    // Get the search form and results section
    const searchForm = document.querySelector('form');
    const searchResults = document.getElementById('searchResults');

    // Handle form submission
    searchForm.addEventListener('submit', function(e) {
        e.preventDefault();

        // Get form values
        const from = document.getElementById('from').value;
        const to = document.getElementById('to').value;
        const departure = document.getElementById('departure').value;
        const returnDate = document.getElementById('return').value;
        const passengers = document.getElementById('passengers').value;
        const flightClass = document.getElementById('class').value;
        const airline = document.getElementById('airline').value;

        // Validate form
        if (!from || !to || !departure || !passengers || !flightClass) {
            alert('Please fill in all required fields');
            return;
        }

        // Show loading state
        searchResults.style.display = 'block';
        searchResults.innerHTML = '<div class="text-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>';

        // Simulate API call with setTimeout
        setTimeout(() => {
            // Generate sample flight results
            const flights = generateSampleFlights(from, to, departure, returnDate, passengers, flightClass, airline);
            
            // Display results
            displayFlights(flights);
        }, 1500);
    });

    // Function to generate sample flight data
    function generateSampleFlights(from, to, departure, returnDate, passengers, flightClass, airline) {
        const airlines = ['Delta Airlines', 'United Airlines', 'American Airlines'];
        const flights = [];

        for (let i = 0; i < 3; i++) {
            const price = Math.floor(Math.random() * 500) + 300;
            const departureTime = `${Math.floor(Math.random() * 12) + 1}:${Math.floor(Math.random() * 60).toString().padStart(2, '0')} ${Math.random() > 0.5 ? 'AM' : 'PM'}`;
            const arrivalTime = `${Math.floor(Math.random() * 12) + 1}:${Math.floor(Math.random() * 60).toString().padStart(2, '0')} ${Math.random() > 0.5 ? 'AM' : 'PM'}`;
            const duration = `${Math.floor(Math.random() * 5) + 2}h ${Math.floor(Math.random() * 60)}m`;

            flights.push({
                id: i + 1,
                airline: airline ? airline.charAt(0).toUpperCase() + airline.slice(1) + ' Airlines' : airlines[i],
                price: price,
                departureTime: departureTime,
                arrivalTime: arrivalTime,
                duration: duration
            });
        }

        return flights;
    }

    // Function to display flight results
    function displayFlights(flights) {
        let html = '<h3 class="mb-4">Available Flights</h3><div class="row">';

        flights.forEach(flight => {
            html += `
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title">${flight.airline}</h5>
                                <span class="badge bg-success">$${flight.price}</span>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <p class="mb-1"><strong>Departure:</strong> ${flight.departureTime}</p>
                                    <p class="mb-1"><strong>Arrival:</strong> ${flight.arrivalTime}</p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-1"><strong>Duration:</strong> ${flight.duration}</p>
                                </div>
                            </div>
                            <button class="btn btn-primary mt-3" onclick="selectFlight(${flight.id})">Select Flight</button>
                        </div>
                    </div>
                </div>
            `;
        });

        html += '</div>';
        searchResults.innerHTML = html;
    }

    // Function to handle flight selection
    window.selectFlight = function(flightId) {
        // Store selected flight in localStorage
        localStorage.setItem('selectedFlight', flightId);
        
        // Redirect to seat selection page
        window.location.href = 'seat-selection.html';
    };
}); 