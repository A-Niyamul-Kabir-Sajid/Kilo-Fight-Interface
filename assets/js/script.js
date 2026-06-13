// Wait until the whole HTML document is loaded and ready
document.addEventListener('DOMContentLoaded', function () {

    // Select all <a> links inside the <nav> element (navbar links)
    const navLinks = document.querySelectorAll('nav a');

    // Loop through each link
    navLinks.forEach(link => {

        // Add a click event listener to each link
        link.addEventListener('click', () => {

            // Check if the window width is 900px or less (mobile/tablet size)
            if (window.innerWidth <= 900) {

                // Scroll the page upward by 70 pixels
                // This prevents the fixed navbar from covering the section
                window.scrollBy(0, -70);
            }
        });
    });
});
