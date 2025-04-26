document.addEventListener('DOMContentLoaded', function() {
    // Get elements
    const seats = document.querySelectorAll('.seat');
    const selectedSeatsElement = document.getElementById('selectedSeats');
    const totalPriceElement = document.getElementById('totalPrice');
    const proceedButton = document.getElementById('proceedToPayment');

    // Initialize variables
    let selectedSeats = [];
    const seatPrices = {
        premium: 200, // First class seats
        available: 100, // Regular seats
    };

    // Add click event listeners to seats
    seats.forEach(seat => {
        seat.addEventListener('click', function() {
            // Skip if seat is occupied
            if (this.classList.contains('occupied')) {
                return;
            }

            const seatNumber = this.getAttribute('data-seat');
            
            // Toggle seat selection
            if (this.classList.contains('selected')) {
                // Deselect seat
                this.classList.remove('selected');
                this.classList.add('available');
                selectedSeats = selectedSeats.filter(seat => seat !== seatNumber);
            } else {
                // Select seat
                this.classList.remove('available');
                this.classList.add('selected');
                selectedSeats.push(seatNumber);
            }

            // Update selected seats display
            updateSelectedSeatsDisplay();
            
            // Update total price
            updateTotalPrice();
            
            // Update proceed button state
            updateProceedButton();
        });
    });

    // Function to update selected seats display
    function updateSelectedSeatsDisplay() {
        if (selectedSeats.length === 0) {
            selectedSeatsElement.textContent = 'No seats selected';
        } else {
            selectedSeatsElement.textContent = selectedSeats.join(', ');
        }
    }

    // Function to calculate and update total price
    function updateTotalPrice() {
        let total = 0;
        
        selectedSeats.forEach(seatNumber => {
            const seatElement = document.querySelector(`[data-seat="${seatNumber}"]`);
            if (seatElement.classList.contains('premium')) {
                total += seatPrices.premium;
            } else {
                total += seatPrices.available;
            }
        });

        totalPriceElement.textContent = `$${total.toFixed(2)}`;
    }

    // Function to update proceed button state
    function updateProceedButton() {
        if (selectedSeats.length > 0) {
            proceedButton.disabled = false;
        } else {
            proceedButton.disabled = true;
        }
    }

    // Handle proceed to payment button click
    proceedButton.addEventListener('click', function() {
        // Store selected seats in localStorage
        localStorage.setItem('selectedSeats', JSON.stringify(selectedSeats));
        
        // Calculate total price
        let total = 0;
        selectedSeats.forEach(seatNumber => {
            const seatElement = document.querySelector(`[data-seat="${seatNumber}"]`);
            if (seatElement.classList.contains('premium')) {
                total += seatPrices.premium;
            } else {
                total += seatPrices.available;
            }
        });
        
        // Store total price in localStorage
        localStorage.setItem('totalPrice', total);
        
        // Redirect to payment page
        window.location.href = 'payment.html';
    });

    // Initialize the page
    updateSelectedSeatsDisplay();
    updateTotalPrice();
    updateProceedButton();

    // Mark some random seats as occupied for demonstration
    const allSeats = Array.from(seats);
    const occupiedSeats = allSeats.filter(seat => !seat.classList.contains('premium'));
    
    // Randomly select 30% of non-premium seats to be occupied
    const numberOfOccupiedSeats = Math.floor(occupiedSeats.length * 0.3);
    const shuffledSeats = occupiedSeats.sort(() => 0.5 - Math.random());
    
    for (let i = 0; i < numberOfOccupiedSeats; i++) {
        const seat = shuffledSeats[i];
        seat.classList.remove('available');
        seat.classList.add('occupied');
    }
}); 