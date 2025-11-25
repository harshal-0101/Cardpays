// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', () => {

    // --- Panel Element Definitions ---
    const panelOverlay = document.getElementById('panel-overlay');

    // "Add Admin" Panel
    const addAdminPanel = document.getElementById('admin-form-panel');
    const closeAddPanelBtn = document.getElementById('close-panel-btn');
    const addAdminBtn = document.getElementById('add-admin-btn');
    const addAdminForm = document.getElementById('add-admin-form');

    // "Show Admin" Panel
    const showAdminPanel = document.getElementById('show-admin-panel');
    const closeShowPanelBtn = document.getElementById('close-show-panel-btn');

    // "Edit Admin" Panel
    const editAdminPanel = document.getElementById('edit-admin-panel');
    const closeEditPanelBtn = document.getElementById('close-edit-panel-btn');
    const cancelEditBtn = document.getElementById('cancel-edit-btn');
    const editAdminForm = document.getElementById('edit-admin-form');

    // "Update Password" Panel
    const updatePasswordPanel = document.getElementById('update-password-panel');
    const closePasswordPanelBtn = document.getElementById('close-password-panel-btn');
    const cancelPasswordBtn = document.getElementById('cancel-password-btn');
    const updatePasswordForm = document.getElementById('update-password-form');

    // --- Panel State Functions ---

    // Function to open the ADD panel
    const openAddPanel = () => {
        addAdminForm.reset(); // Clear form
        addAdminPanel.classList.add('open');
        panelOverlay.classList.add('open');
    };

    // Function to open the SHOW panel
    const openShowPanel = () => {
        showAdminPanel.classList.add('open');
        panelOverlay.classList.add('open');
    };

    // Function to open the EDIT panel
    const openEditPanel = () => {
        editAdminPanel.classList.add('open');
        panelOverlay.classList.add('open');
    };

    // Function to open the UPDATE PASSWORD panel
    const openUpdatePasswordPanel = () => {
        updatePasswordForm.reset(); // Clear form
        updatePasswordPanel.classList.add('open');
        panelOverlay.classList.add('open');
    };

    // Function to close ALL panels
    const closeAllPanels = () => {
        addAdminPanel.classList.remove('open');
        showAdminPanel.classList.remove('open');
        editAdminPanel.classList.remove('open');
        updatePasswordPanel.classList.remove('open'); // Added this panel
        panelOverlay.classList.remove('open');
    };

    // --- Event Listeners for Opening/Closing Panels ---

    if (addAdminBtn) addAdminBtn.addEventListener('click', openAddPanel);
    if (closeAddPanelBtn) closeAddPanelBtn.addEventListener('click', closeAllPanels);
    if (closeShowPanelBtn) closeShowPanelBtn.addEventListener('click', closeAllPanels);
    if (closeEditPanelBtn) closeEditPanelBtn.addEventListener('click', closeAllPanels);
    if (cancelEditBtn) cancelEditBtn.addEventListener('click', closeAllPanels);
    if (closePasswordPanelBtn) closePasswordPanelBtn.addEventListener('click', closeAllPanels); // Added this
    if (cancelPasswordBtn) cancelPasswordBtn.addEventListener('click', closeAllPanels); // Added this
    if (panelOverlay) panelOverlay.addEventListener('click', closeAllPanels);

    // --- Form: Password Visibility Toggles ---

    // Toggle for "Add Admin" form
    const togglePassword = document.getElementById('toggle-password');
    const passwordInput = document.getElementById('password');
    if (togglePassword && passwordInput) {
        togglePassword.addEventListener('click', () => {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            togglePassword.classList.toggle('bx-show');
            togglePassword.classList.toggle('bx-hide');
        });
    }

    // Toggle for "Update Password" form
    const toggleNewPassword = document.getElementById('toggle-new-password');
    const newPasswordInput = document.getElementById('new-password');
    if (toggleNewPassword && newPasswordInput) {
        toggleNewPassword.addEventListener('click', () => {
            const type = newPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            newPasswordInput.setAttribute('type', type);
            toggleNewPassword.classList.toggle('bx-show');
            toggleNewPassword.classList.toggle('bx-hide');
        });
    }

    // --- Form: Submissions ---

    // "Add Admin" Form
    // if (addAdminForm) {
    //     addAdminForm.addEventListener('submit', (e) => {
    //         e.preventDefault();
    //         console.log('ADD Form submitted!');
    //         closeAllPanels();
    //     });
    // }

    // "Edit Admin" Form
    // if (editAdminForm) {
    //     editAdminForm.addEventListener('submit', (e) => {
    //         e.preventDefault();
    //         console.log('EDIT Form submitted!');
    //         closeAllPanels();
    //     });
    // }

    // "Update Password" Form
    if (updatePasswordForm) {
        updatePasswordForm.addEventListener('submit', (e) => {
            e.preventDefault();
            console.log('UPDATE PASSWORD Form submitted!');
            closeAllPanels();
        });
    }

    // --- Admin List: Toggle Switches ---
    const adminToggles = document.querySelectorAll('.data-row .toggle-switch input[type="checkbox"]');
    adminToggles.forEach(toggle => {
        toggle.addEventListener('change', (event) => {
            if (event.target.checked) console.log('Admin enabled');
            else console.log('Admin disabled');
        });
    });

    // --- Admin List: 'More Options' Dropdown ---
    const moreOptionsButtons = document.querySelectorAll('.data-row .more-options');
    moreOptionsButtons.forEach(button => {
        const menu = button.querySelector('.dropdown-menu');
        const menuItems = menu.querySelectorAll('li');

        // Toggle the menu
        button.addEventListener('click', (e) => {
            e.stopPropagation();
            const isVisible = menu.classList.contains('show');
            document.querySelectorAll('.dropdown-menu.show').forEach(openMenu => {
                openMenu.classList.remove('show');
            });
            if (!isVisible) menu.classList.add('show');
        });

        // Handle clicks on menu items
        menuItems.forEach(item => {
            item.addEventListener('click', (e) => {
                e.stopPropagation();
                const action = item.dataset.action;

                console.log(`Action: ${action} on row.`);

                // Check which action was clicked
                if (action === 'show') {
                    openShowPanel();
                } else if (action === 'edit') {
                    openEditPanel();
                } else if (action === 'update-password') {
                    openUpdatePasswordPanel(); // Added this
                } else {
                    console.log(`${action} clicked`);
                }

                menu.classList.remove('show');
            });
        });
    });

    // --- Window listener to close dropdown menus ---
    window.addEventListener('click', (e) => {
        document.querySelectorAll('.dropdown-menu.show').forEach(openMenu => {
            openMenu.classList.remove('show');
        });
    });

});