document.addEventListener('DOMContentLoaded', function() {
    const addProjectForm = document.getElementById('addProjectForm');
    const departmentSelect = document.getElementById('department');
    const teamMembersSelect = document.getElementById('team_members');
    
    // Function to update team members based on selected department
    function updateTeamMembers() {
        const selectedDepartmentId = departmentSelect.value;
        const departmentEmployees = employeeData[selectedDepartmentId] || [];
        
        // Clear existing options
        teamMembersSelect.innerHTML = '';
        
        // Add new options for team members in the selected department
        departmentEmployees.forEach(employee => {
            const option = document.createElement('option');
            option.value = employee.id;
            option.textContent = employee.name;
            teamMembersSelect.appendChild(option);
        });
    }
    
    // Add event listener to department select
    departmentSelect.addEventListener('change', updateTeamMembers);
    
    // Initial call to populate team members based on the default selected department
    updateTeamMembers();
    
    // Form submission handling
    addProjectForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Submit the form data via AJAX
        const formData = new FormData(addProjectForm);
        fetch('process_add_project.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(data => {
            console.log(data);
            // Optionally handle success response
        })
        .catch(error => {
            console.error('Error submitting form:', error);
            // Optionally handle error response
        });
    });
  });
  