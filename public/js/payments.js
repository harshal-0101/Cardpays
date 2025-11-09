document.addEventListener('DOMContentLoaded', () => {

    const overlay = document.getElementById('panel-overlay');

    // All panels
    const addPanel = document.getElementById('add-payment-mode-panel');
    const showPanel = document.getElementById('show-payment-mode-panel');
    const editPanel = document.getElementById('edit-payment-mode-panel');
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
    const addPaymentModeBtn = document.getElementById('add-payment-mode-btn');
    if (addPaymentModeBtn) {
        addPaymentModeBtn.addEventListener('click', () => {
            openPanel(addPanel);
        });
    }

    // --- Event Listeners for Closing Panels ---
    const closeButtons = document.querySelectorAll('.close-btn, #cancel-edit-btn');
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
            const paymentModeId = parentOptions.getAttribute('data-id');

            // Close the dropdown
            parentOptions.classList.remove('active');

            // Handle the action
            switch (action) {
                case 'show':
                    console.log('Show Payment Mode:', paymentModeId);
                    // TODO: Fetch data and populate the show-panel
                    // Simulating population:
                    // document.getElementById('show-pm-name').textContent = '...';
                    // document.getElementById('show-pm-id').textContent = paymentModeId;
                    openPanel(showPanel);
                    break;
                case 'edit':
                    console.log('Edit Payment Mode:', paymentModeId);
                    // TODO: Fetch data and populate the edit-form
                    openPanel(editPanel);
                    break;
                case 'copy-id':
                    console.log('Copy ID:', paymentModeId);
                    navigator.clipboard.writeText(paymentModeId).then(() => {
                        alert('Payment Mode ID copied to clipboard!');
                    });
                    break;
                case 'delete':
                    console.log('Delete Payment Mode:', paymentModeId);
                    if (confirm('Are you sure you want to delete this payment mode?')) {
                        // TODO: Add delete logic
                        parentRow.remove(); // Optimistic deletion
                        alert('Payment Mode deleted.');
                    }
                    break;
            }
        });
    });

    // --- Form Submission Handling ---
    const addPaymentModeForm = document.getElementById('add-payment-mode-form');
    if (addPaymentModeForm) {
        addPaymentModeForm.addEventListener('submit', (e) => {
            e.preventDefault();
            console.log('Add Payment Mode Form Submitted');
            // TODO: Add API call to create new payment mode
            alert('New payment mode added (simulated)!');
            closeAllPanels();
        });
    }

    const editPaymentModeForm = document.getElementById('edit-payment-mode-form');
    if (editPaymentModeForm) {
        editPaymentModeForm.addEventListener('submit', (e) => {
            e.preventDefault();
            console.log('Edit Payment Mode Form Submitted');
            // TODO: Add API call to update payment mode
            alert('Payment mode updated (simulated)!');
            closeAllPanels();
        });
    }
});