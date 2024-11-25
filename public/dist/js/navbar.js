function scrollNavbar(direction) {
    const navbar = document.querySelector('.scrollable-navbar');
    const scrollAmount = 100; // Adjust scroll distance
    if (direction === -1) {
        navbar.scrollLeft -= scrollAmount;
    } else if (direction === 1) {
        navbar.scrollLeft += scrollAmount;
    }
}

// Function to update scroll button visibility
function updateScrollButtons() {
    const navbar = document.querySelector('.scrollable-navbar');
    const leftBtn = document.getElementById('scroll-left-btn');
    const rightBtn = document.getElementById('scroll-right-btn');

    leftBtn.style.display = navbar.scrollLeft > 0 ? 'block' : 'none';
    rightBtn.style.display =
        navbar.scrollLeft < navbar.scrollWidth - navbar.clientWidth ? 'block' : 'none';
}

// Add event listener to update buttons on scroll
document.querySelector('.scrollable-navbar').addEventListener('scroll', updateScrollButtons);

// Initial call to update button visibility
updateScrollButtons();