document.addEventListener('DOMContentLoaded', function() {
  const menuToggle = document.getElementById('menu-toggle');
  const sidebar = document.getElementById('sidebar');
  const dashboardContent = document.getElementById('dashboard-content');
  const moduleLinks = document.querySelectorAll('nav a');

  // Sidebar Toggle Functionality
  menuToggle.addEventListener('click', function() {
    sidebar.classList.toggle('open');
    dashboardContent.classList.toggle('sidebar-open');
  });

  // Dynamic Content Loading (with adjustments)
  function loadContent(url) {
    fetch(url)
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.text();
      })
      .then(data => {
        dashboardContent.innerHTML = data;
        executeScripts(dashboardContent);
        updateActiveLink(url); // Make sure URL is correct
      }) 
      .catch(error => {
        console.error('Error fetching content:', error);
        dashboardContent.innerHTML = '<p class="error">Error loading content. Please try again.</p>';
      });
  }

  // Execute scripts within loaded modules
  function executeScripts(container) {
    // ... (Your existing script execution code remains the same)
  }

  // Update active link style
  function updateActiveLink(url) {
    // Get the filename from the URL 
    const filename = url.split('/').pop();

    moduleLinks.forEach(link => {
      const linkHref = link.getAttribute('href').split('/').pop();
      link.classList.toggle('active', filename === linkHref); 
    });
  }

  // Handle module links
  moduleLinks.forEach(link => {
    link.addEventListener('click', function(e) {
      e.preventDefault();
      const href = this.getAttribute('href');
      loadContent(href);
    });
  });

  // Initial content load 
  loadContent('dashboard.php'); 
});
