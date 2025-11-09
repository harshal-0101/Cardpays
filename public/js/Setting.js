
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar-menu');
            const contentSections = document.querySelectorAll('.content-section');

            function showSection(sectionId) {
                // 1. Hide all content sections
                contentSections.forEach(section => {
                    section.classList.remove('active');
                });
                
                // 2. Show the selected content section
                const targetSection = document.getElementById(sectionId);
                if (targetSection) {
                    targetSection.classList.add('active');
                }
            }

            // Function to handle sidebar link clicks
            sidebar.addEventListener('click', function(event) {
                let targetLi = event.target.closest('li');
                
                if (targetLi && targetLi.hasAttribute('data-section')) {
                    event.preventDefault(); 

                    // 1. Remove active class from all sidebar items
                    document.querySelectorAll('.sidebar-menu li').forEach(li => {
                        li.classList.remove('active');
                    });

                    // 2. Add active class to the clicked item
                    targetLi.classList.add('active');

                    // 3. Get the target section name and show it
                    const sectionName = targetLi.getAttribute('data-section');
                    const sectionId = sectionName + '-settings-section';
                    showSection(sectionId);
                }
            });

            // --- KEY CHANGE: Set the default section to General Settings ---
            const defaultSectionId = 'general-settings-section';
            showSection(defaultSectionId);
            
            // Highlight the General Settings link in the sidebar
            document.querySelector('[data-section="general"]').classList.add('active');
            
            // Ensure all other sections are inactive on load
            document.querySelector('[data-section="finance"]').classList.remove('active');
            document.querySelector('[data-section="pdf"]').classList.remove('active');
            document.querySelector('[data-section="currency"]').classList.remove('active');
            document.querySelector('[data-section="logo"]').classList.remove('active');
            document.querySelector('[data-section="company"]').classList.remove('active');

        });
