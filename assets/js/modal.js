function openSeatModal() {
    document.getElementById('seatModal').style.display = 'flex';
    generateSeats();
}

function closeSeatModal() {
    document.getElementById('seatModal').style.display = 'none';
}

function generateSeats() {
    const seatsContainer = document.querySelector('.seats');
    seatsContainer.innerHTML = '';
    for (let i = 1; i <= 32; i++) {
        let seat = document.createElement('div');
        seat.classList.add('seat');
        seat.innerText = i;
        seat.onclick = function () {
            this.classList.toggle('selected');
        };
        seatsContainer.appendChild(seat);
    }
}

function confirmSeatSelection() {
    let selectedSeats = document.querySelectorAll('.seat.selected');
    if (selectedSeats.length === 0) {
        alert('Pilih setidaknya satu kursi!');
        return;
    }
    let seats = Array.from(selectedSeats).map(seat => seat.innerText);
    alert('Kursi yang dipilih: ' + seats.join(', '));
    closeSeatModal();
}