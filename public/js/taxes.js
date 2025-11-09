// src/taxes.js
document.addEventListener('DOMContentLoaded', () => {

    const overlay = document.getElementById('panel-overlay');

    // All panels
    const addPanel = document.getElementById('add-tax-panel');
    const showPanel = document.getElementById('show-tax-panel');
    const editPanel = document.getElementById('edit-tax-panel');
    const allPanels = [addPanel, showPanel, editPanel];

    // --- Panel Toggling Functions ---
    const openPanel = (panel) => {
        if (panel) {
            panel.classList.add('visible');
            overlay.classList.add('visible');
        }
    };

    const closeAllPanels = () => {
        allPanels.forEach(panel => {
            if(panel) panel.classList.remove('visible');
        });
        overlay.classList.remove('visible');
    };

    // --- Event Listeners for Opening Panels ---
    const addTaxBtn = document.getElementById('add-tax-btn');
    if (addTaxBtn) {
        addTaxBtn.addEventListener('click', () => {
            openPanel(addPanel);
        });
    }

    // --- Event Listeners for Closing Panels ---
    const closeButtons = document.querySelectorAll('.close-btn, #cancel-edit-btn, #cancel-password-btn');
    closeButtons.forEach(btn => {
        btn.addEventListener('click', closeAllPanels);
    });

    if (overlay) {
        overlay.addEventListener('click', closeAllPanels);
    }

    // --- Dropdown Menu Logic ---
    document.addEventListener('click', (e) => {
        // Close all other dropdowns
        document.querySelectorAll('.more-options.active').forEach(dropdown => {
            if (!dropdown.contains(e.target)) {
                dropdown.classList.remove('active');
            }
        });

        // Toggle the clicked dropdown
        const optionsIcon = e.target.closest('.bx-dots-horizontal-rounded');
        if (optionsIcon) {
            const parent = optionsIcon.closest('.more-options');
            parent.classList.toggle('active');
        }
    });

    // --- Dropdown Action Logic ---
    document.querySelectorAll('.dropdown-menu li').forEach(item => {
        item.addEventListener('click', (e) => {
            const action = e.currentTarget.getAttribute('data-action');
            const parentRow = e.currentTarget.closest('.data-row');
            const parentOptions = e.currentTarget.closest('.more-options');
            const taxId = parentOptions.getAttribute('data-id');

            // Close the dropdown
            parentOptions.classList.remove('active');

            // Handle the action
            switch (action) {
                case 'show':
                    console.log('Show tax:', taxId);
                    // TODO: Fetch tax data and populate the show-panel
                    // Simulating population:
                    // document.getElementById('show-tax-name').textContent = 'Tax 0%';
                    // document.getElementById('show-tax-id').textContent = taxId;
                    openPanel(showPanel);
                    break;
                case 'edit':
                    console.log('Edit tax:', taxId);
                    // TODO: Fetch tax data and populate the edit-form
                    openPanel(editPanel);
                    break;
                case 'copy-id':
                    console.log('Copy ID:', taxId);
                    navigator.clipboard.writeText(taxId).then(() => {
                        alert('Tax ID copied to clipboard!');
                    });
                    break;
                case 'delete':
                    console.log('Delete tax:', taxId);
                    if (confirm('Are you sure you want to delete this tax?')) {
                        // TODO: Add delete logic
                        parentRow.remove(); // Optimistic deletion
                        alert('Tax deleted.');
                    }
                    break;
            }
        });
    });

    // --- Form Submission Handling ---
    const addTaxForm = document.getElementById('add-tax-form');
    if (addTaxForm) {
        addTaxForm.addEventListener('submit', (e) => {
            e.preventDefault();
            console.log('Add Tax Form Submitted');
            // TODO: Add API call to create new tax
            alert('New tax added (simulated)!');
            closeAllPanels();
        });
    }

    const editTaxForm = document.getElementById('edit-tax-form');
    if (editTaxForm) {
        editTaxForm.addEventListener('submit', (e) => {
            e.preventDefault();
            console.log('Edit Tax Form Submitted');
            // TODO: Add API call to update tax
            alert('Tax updated (simulated)!');
            closeAllPanels();
        });
    }
});