function setRating(rating) {
    // Update hidden input value
    document.getElementById('ratingInput').value = rating;

    // Update star appearance
    const stars = document.querySelectorAll('.rating i');
    stars.forEach((star, index) => {
        if (index < rating) {
            // This star should be solid
            star.classList.remove('far');
            star.classList.add('fas');
        } else {
            // This star should be regular
            star.classList.remove('fas');
            star.classList.add('far');
        }
    });
}

// Add click event listeners to stars
document.querySelectorAll('.rating i').forEach((star, index) => {
    star.addEventListener('click', () => setRating(index + 1));
});

