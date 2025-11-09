        document.addEventListener('DOMContentLoaded', () => {
            
            // --- Modal Open/Close Logic for Public Form ---
            const publicFormModal = document.getElementById('newPublicFormModal');
            const openPublicFormBtn = document.getElementById('openPublicFormModalBtn');
            const closePublicFormBtn = document.getElementById('closePublicFormModalBtn');

            const openModal = (modal) => {
                if (!modal) return;
                modal.style.display = "block";
                setTimeout(() => { modal.classList.add('active'); }, 10);
                document.body.style.overflow = "hidden";
            };

            const closeModal = (modal) => {
                if (!modal) return;
                modal.classList.remove('active');
                setTimeout(() => { modal.style.display = "none"; document.body.style.overflow = "auto"; }, 300);
            };

            if (openPublicFormBtn && publicFormModal) {
                openPublicFormBtn.onclick = () => openModal(publicFormModal);
                closePublicFormBtn.onclick = () => closeModal(publicFormModal);
            }

            // Global click handler to close the modal if the background is clicked
            window.onclick = function(event) {
                if (event.target === publicFormModal) {
                    closeModal(publicFormModal);
                }
            };
            
            // --- Auto Reply Toggle Logic ---
            const autoReplyToggle = document.getElementById('autoReplyToggle');
            const autoReplyFields = document.getElementById('autoReplyFields');

            if (autoReplyToggle && autoReplyFields) {
                autoReplyToggle.addEventListener('change', function() {
                    if (this.checked) {
                        autoReplyFields.style.display = 'block';
                    } else {
                        autoReplyFields.style.display = 'none';
                    }
                });

                // Set initial state based on toggle
                if (autoReplyToggle.checked) {
                    autoReplyFields.style.display = 'block';
                } else {
                    autoReplyFields.style.display = 'none';
                }
            }

            // Mock submission handler for demonstration
            const publicFormForm = document.getElementById('publicFormForm');
            if (publicFormForm) {
                publicFormForm.onsubmit = function(event) {
                    event.preventDefault();
                    alert("Public Form submitted (check console for data)");
                    
                    const formData = {
                        enabled: document.getElementById('enabledToggle').checked, 
                        color: document.getElementById('publicFormColor').value,
                        table: document.getElementById('publicFormTable').value,
                        autoReplyEnabled: autoReplyToggle.checked, 
                        autoReplyTitle: document.getElementById('autoReplyTitle').value,
                        autoReplyEmail: document.getElementById('autoReplyEmail').value,
                        autoReplyMessage: document.getElementById('autoReplyMessage').value,
                        branch: document.getElementById('publicFormBranch').value
                    };
                    console.log(formData);

                    closeModal(publicFormModal);
                };
            }
        });
