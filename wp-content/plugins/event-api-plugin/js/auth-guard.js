// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function () {
    // Check if the current page is one that requires authentication
    const restrictedPages = ['addevent', 'another-restricted-page']; // Add your restricted page slugs
    const currentPage = window.location.pathname.split('/').pop(); // Get the current page slug

    if (restrictedPages.includes(currentPage) && !localStorage.getItem('user')) {
        // Redirect to the login page if not logged in
        window.location.href = 'http://eventmanagement.local/';
    }
});