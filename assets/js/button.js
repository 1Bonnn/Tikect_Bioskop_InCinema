function showButton(posterElement) {
    const button = posterElement.querySelector('.film-button');
    
    // If the button is already visible, hide it
    if (button.style.display === 'block') {
        button.style.display = 'none';
    } else {
        // Hide all buttons first
        const allButtons = document.querySelectorAll('.film-button');
        allButtons.forEach(btn => btn.style.display = 'none');
        
        // Then show the button for the clicked poster
        button.style.display = 'block';
    }
}
