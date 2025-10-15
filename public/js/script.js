        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.nav-link');
            const dashboardViews = document.querySelectorAll('.dashboard-view');
            const headerTitle = document.querySelector('.header-title h1');

            // --- TEMPLATES for dynamic content ---
            const telecallerContent = `
                <div class="stats-grid">
                    <div class="stat-card"><div class="icon" style="background-color: var(--primary-color);"><i class="fa-solid fa-users"></i></div><div class="info"><h3>My Leads</h3><p>152</p></div></div>
                    <div class="stat-card"><div class="icon" style="background-color: var(--warning);"><i class="fa-solid fa-calendar-day"></i></div><div class="info"><h3>Today's Follow-ups</h3><p>28</p></div></div>
                    <div class="stat-card"><div class="icon" style="background-color: var(--success);"><i class="fa-solid fa-chart-line"></i></div><div class="info"><h3>Conversion Rate</h3><p>12.5%</p></div></div>
                </div>
                <div class="content-block"><h3>Today's Follow-up List</h3><div class="data-table-wrapper"><table class="data-table"><thead><tr><th>Name</th><th>Mobile</th><th>Last Contact</th><th>Status</th></tr></thead><tbody><tr><td>Raj Kumar</td><td>+91-9876543210</td><td>2 days ago</td><td><span class="status-badge status-call">Call Today</span></td></tr><tr><td>Anjali Sharma</td><td>+91-9988776655</td><td>1 day ago</td><td><span class="status-badge status-call">Call Today</span></td></tr></tbody></table></div></div>`;

            const managerContent = `
                <div class="stats-grid">
                    <div class="stat-card"><div class="icon" style="background-color: #6f42c1;"><i class="fa-solid fa-users-gear"></i></div><div class="info"><h3>Team Performance</h3><p>85%</p></div></div>
                    <div class="stat-card"><div class="icon" style="background-color: #fd7e14;"><i class="fa-solid fa-list-check"></i></div><div class="info"><h3>Active Leads</h3><p>475</p></div></div>
                </div>
                <div class="content-block chart-container-small"><h3>Leads Status Overview</h3><canvas id="leadsStatusChart"></canvas></div>`;

            const adminContent = `
                <div class="stats-grid">
                    <div class="stat-card"><div class="icon" style="background-color: var(--danger);"><i class="fa-solid fa-globe"></i></div><div class="info"><h3>Total Leads</h3><p>10,840</p></div></div>
                    <div class="stat-card"><div class="icon" style="background-color: var(--success);"><i class="fa-solid fa-handshake-simple"></i></div><div class="info"><h3>Total Conversions</h3><p>1,253</p></div></div>
                    <div class="stat-card"><div class="icon" style="background-color: var(--text-dark);"><i class="fa-solid fa-dollar-sign"></i></div><div class="info"><h3>Total Transactions</h3><p>$89,210</p></div></div>
                </div>
                <div class="content-block"><h3>System Activity (Leads vs Conversions)</h3><canvas id="systemActivityChart" height="120"></canvas></div>`;

            const transactionContent = `
                <div class="transaction-layout">
                    <div class="content-block">
                        <h3>Record New Transaction</h3>
                        <form id="transactionForm"><div class="form-group"><label for="leadSelect">Link to Lead</label><select id="leadSelect" required><option value="" disabled selected>Select a customer lead</option><option value="Raj Kumar">Raj Kumar</option><option value="Anjali Sharma">Anjali Sharma</option></select></div><div class="form-group"><label for="amount">Amount (₹)</label><input type="number" id="amount" placeholder="e.g., 5000" required min="1"></div><div class="form-group"><label for="transactionDate">Date of Payment</label><input type="date" id="transactionDate" required></div><div class="form-group"><label for="paymentMode">Mode of Payment</label><select id="paymentMode" required><option value="" disabled selected>Select mode</option><option value="UPI">UPI</option><option value="Card">Card</option><option value="Cash">Cash</option></select></div><button type="submit" class="btn btn-primary">Record Payment</button></form>
                    </div>
                    <div class="summary-card">
                        <h3>Transaction Summary</h3>
                        <div class="summary-item"><span>Lead:</span><span id="summaryLead">--</span></div>
                        <div class="summary-item"><span>Date:</span><span id="summaryDate">--</span></div>
                        <div class="summary-item"><span>Pay Mode:</span><span id="summaryMode">--</span></div>
                        <div class="summary-item summary-total"><span>Total Amount:</span><span id="summaryAmount">₹0.00</span></div><hr>
                        <button class="btn btn-secondary" id="generateReceiptBtn" disabled style="width: 100%;">Generate Receipt</button>
                    </div>
                </div>`;

            const receiptModalContent = `
                <div class="receipt-modal-content">
                    <div class="receipt-header"><i class="fa-solid fa-credit-card" style="font-size: 2rem;"></i><h2>Cards Pay</h2><p>Payment Receipt</p></div>
                    <dl class="receipt-details"><dt>Billed to:</dt><dd id="receiptLeadName">--</dd><dt>Transaction Date:</dt><dd id="receiptDate">--</dd><dt>Payment Mode:</dt><dd id="receiptMode">--</dd></dl>
                    <div class="receipt-amount"><span>TOTAL: </span><span id="receiptAmount">--</span></div>
                    <div class="receipt-actions"><button class="btn btn-secondary" id="closeReceiptBtn" style="flex:1;">Close</button><button class="btn btn-primary" id="printReceiptBtn" style="flex:2;"><i class="fa-solid fa-print"></i> Print</button></div>
                </div>`;

            // --- INITIAL CONTENT INJECTION ---
            document.getElementById('telecaller-view').innerHTML = telecallerContent;
            document.getElementById('manager-view').innerHTML = managerContent;
            document.getElementById('admin-view').innerHTML = adminContent;
            document.getElementById('transaction-view').innerHTML = transactionContent;
            document.getElementById('receiptModal').innerHTML = receiptModalContent;

            // --- MAIN SWITCH VIEW FUNCTION ---
            let charts = {};

            function switchView(viewId) {
                navLinks.forEach(l => {
                    if (l.getAttribute('data-view') === viewId) {
                        l.classList.add('active');
                    } else {
                        l.classList.remove('active');
                    }
                });
                dashboardViews.forEach(view => {
                    view.classList.remove('active');
                    if (view.id === viewId) {
                        view.classList.add('active');
                    }
                });
                const activeLink = document.querySelector(`.nav-link[data-view="${viewId}"]`);
                if (activeLink) {
                    const linkText = activeLink.querySelector('span').textContent;
                    headerTitle.textContent = linkText;
                }

                // Lazy load charts
                if (viewId === 'manager-view' && !charts.leadsStatus) {
                    initManagerCharts();
                } else if (viewId === 'admin-view' && !charts.systemActivity) {
                    initAdminChart();
                } else if (viewId === 'transaction-view') {
                    initTransactionLogic();
                }
            }

            // --- NAVIGATION ---
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const viewId = this.getAttribute('data-view');
                    switchView(viewId);
                });
            });

            // --- LEADS PAGE LOGIC ---
            const showFormBtn = document.getElementById('showFormBtn');
            const cancelNewLeadBtn = document.getElementById('cancelNewLeadBtn');
            const newLeadForm = document.getElementById('newLeadForm');
            const refreshBtn = document.getElementById('refreshBtn');

            if (showFormBtn) showFormBtn.addEventListener('click', () => switchView('lead-form-view'));
            if (cancelNewLeadBtn) cancelNewLeadBtn.addEventListener('click', () => switchView('leads-view'));
            if (newLeadForm) {
                newLeadForm.addEventListener('submit', (e) => {
                    e.preventDefault();
                    alert('New lead submitted successfully!');
                    switchView('leads-view');
                    newLeadForm.reset();
                });
            }
            if (refreshBtn) {
                refreshBtn.addEventListener('click', () => {
                    const icon = refreshBtn.querySelector('i');
                    icon.classList.add('spinning');
                    setTimeout(() => {
                        icon.classList.remove('spinning');
                        alert('Leads data refreshed!');
                    }, 1000);
                });
            }

            // --- CHART INITIALIZATION ---
            function initManagerCharts() {
                const leadsStatusCtx = document.getElementById('leadsStatusChart').getContext('2d');
                charts.leadsStatus = new Chart(leadsStatusCtx, { type: 'doughnut', data: { labels: ['New', 'Contacted', 'Follow-up', 'Converted', 'Lost'], datasets: [{ label: 'Leads Status', data: [120, 180, 75, 50, 50], backgroundColor: ['#0052cc', '#ffc107', '#fd7e14', '#28a745', '#dc3545'], hoverOffset: 4 }] }, options: { responsive: true } });
            }

            function initAdminChart() {
                const systemActivityCtx = document.getElementById('systemActivityChart').getContext('2d');
                charts.systemActivity = new Chart(systemActivityCtx, { type: 'line', data: { labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'], datasets: [{ label: 'Leads Generated', data: [650, 590, 800, 810, 560, 950], borderColor: 'rgba(0, 82, 204, 1)', backgroundColor: 'rgba(0, 82, 204, 0.1)', fill: true, tension: 0.3 }, { label: 'Conversions', data: [80, 75, 95, 110, 85, 120], borderColor: 'rgba(40, 167, 69, 1)', backgroundColor: 'rgba(40, 167, 69, 0.1)', fill: true, tension: 0.3 }] }, options: { responsive: true } });
            }

            // --- TRANSACTION LOGIC INITIALIZATION ---
            function initTransactionLogic() {
                const transactionForm = document.getElementById('transactionForm');
                if (transactionForm.dataset.initialized) return; // Prevent re-initialization

                const leadSelect = document.getElementById('leadSelect');
                const amountInput = document.getElementById('amount');
                const dateInput = document.getElementById('transactionDate');
                const modeSelect = document.getElementById('paymentMode');
                const summaryLead = document.getElementById('summaryLead');
                const summaryDate = document.getElementById('summaryDate');
                const summaryMode = document.getElementById('summaryMode');
                const summaryAmount = document.getElementById('summaryAmount');
                const generateReceiptBtn = document.getElementById('generateReceiptBtn');

                dateInput.valueAsDate = new Date();
                summaryDate.textContent = new Date().toLocaleDateString('en-CA');

                leadSelect.addEventListener('change', () => summaryLead.textContent = leadSelect.value);
                dateInput.addEventListener('change', () => summaryDate.textContent = dateInput.value);
                modeSelect.addEventListener('change', () => summaryMode.textContent = modeSelect.value);
                amountInput.addEventListener('input', () => {
                    summaryAmount.textContent = `₹${(parseFloat(amountInput.value) || 0).toFixed(2)}`;
                });

                let lastTransactionData = {};
                transactionForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    lastTransactionData = { lead: leadSelect.value, date: dateInput.value, mode: modeSelect.value, amount: parseFloat(amountInput.value).toFixed(2) };
                    alert(`Payment of ₹${lastTransactionData.amount} for ${lastTransactionData.lead} recorded successfully!`);
                    generateReceiptBtn.disabled = false;
                    transactionForm.reset();
                    dateInput.valueAsDate = new Date();
                    summaryLead.textContent = '--';
                    summaryDate.textContent = new Date().toLocaleDateString('en-CA');
                    summaryMode.textContent = '--';
                    summaryAmount.textContent = '₹0.00';
                });

                const receiptModal = document.getElementById('receiptModal');
                const closeReceiptBtn = document.getElementById('closeReceiptBtn');
                const printReceiptBtn = document.getElementById('printReceiptBtn');

                generateReceiptBtn.addEventListener('click', () => {
                    if (!lastTransactionData.lead) { alert('Please record a payment first.'); return; }
                    document.getElementById('receiptLeadName').textContent = lastTransactionData.lead;
                    document.getElementById('receiptDate').textContent = new Date(lastTransactionData.date).toLocaleDateString('en-GB');
                    document.getElementById('receiptMode').textContent = lastTransactionData.mode;
                    document.getElementById('receiptAmount').textContent = `₹${lastTransactionData.amount}`;
                    receiptModal.style.display = 'flex';
                });
                closeReceiptBtn.addEventListener('click', () => { receiptModal.style.display = 'none'; });
                printReceiptBtn.addEventListener('click', () => { window.print(); });

                transactionForm.dataset.initialized = 'true';
            }

            // --- INITIALIZE DEFAULT VIEW ---
            switchView('leads-view');
        });






        // lead scripts

        document.addEventListener('DOMContentLoaded', function() {
            const showFormBtn = document.getElementById('showFormBtn');
            const hideFormBtn = document.getElementById('hideFormBtn');
            const tableView = document.getElementById('tableView');
            const formView = document.getElementById('formView');
            const refreshBtn = document.getElementById('refreshBtn');
            const refreshIcon = refreshBtn.querySelector('i');

            // Event listener to show the form
            showFormBtn.addEventListener('click', function(event) {
                event.preventDefault();
                tableView.style.display = 'none';
                formView.style.display = 'block';
            });

            // Event listener to hide the form and show the table
            hideFormBtn.addEventListener('click', function() {
                formView.style.display = 'none';
                tableView.style.display = 'block';
            });

            // Event listener for the refresh button animation
            refreshBtn.addEventListener('click', function() {
                refreshIcon.classList.add('rotate-icon');
            });

            // Remove the animation class after it finishes
            refreshIcon.addEventListener('animationend', function() {
                refreshIcon.classList.remove('rotate-icon');
            });
        });


        // Sidebar scripts

        // document.addEventListener('DOMContentLoaded', function() {
        //     // Find all the navigation links in the sidebar
        //     const navLinks = document.querySelectorAll('.sidebar-nav .nav-link');

        //     // Add a click event listener to each link
        //     navLinks.forEach(link => {
        //         link.addEventListener('click', function(event) {
        //             // Prevent the link from navigating away
        //             event.preventDefault();

        //             // First, remove the 'active' class from all links
        //             navLinks.forEach(nav => nav.classList.remove('active'));

        //             // Then, add the 'active' class to the one that was just clicked
        //             this.classList.add('active');
        //         });
        //     });
        // });




        //crm manager sripts


        document.addEventListener('DOMContentLoaded', function() {
            const leadsStatusCtx = document.getElementById('leadsStatusChart').getContext('2d');
            const leadsStatusChart = new Chart(leadsStatusCtx, {
                type: 'doughnut',
                data: {
                    labels: ['New', 'Contacted', 'Follow-up', 'Converted', 'Lost'],
                    datasets: [{
                        label: 'Leads Status',
                        data: [120, 180, 75, 50, 50],
                        backgroundColor: [
                            '#0052cc',
                            '#fd7e14',
                            '#ffc107',
                            '#28a745',
                            '#dc3545'
                        ],
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true
                }
            });
        });








        document.addEventListener('DOMContentLoaded', function() {
            // --- Chart Initialization ---
            const systemActivityCtx = document.getElementById('systemActivityChart').getContext('2d');
            const systemActivityChart = new Chart(systemActivityCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Leads Generated',
                        data: [650, 590, 800, 810, 560, 950],
                        borderColor: 'rgba(0, 82, 204, 1)',
                        backgroundColor: 'rgba(0, 82, 204, 0.1)',
                        fill: true,
                        tension: 0.3
                    }, {
                        label: 'Conversions',
                        data: [80, 75, 95, 110, 85, 120],
                        borderColor: 'rgba(40, 167, 69, 1)',
                        backgroundColor: 'rgba(40, 167, 69, 0.1)',
                        fill: true,
                        tension: 0.3
                    }]
                },
                options: {
                    responsive: true
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.header-tabs button');
            const contents = document.querySelectorAll('.tab-content');

            // Modal Elements
            const editButton = document.getElementById('openEditModal');
            const modal = document.getElementById('editLeadModal');
            const leadEditForm = document.getElementById('leadEditForm');

            // Overview Elements (for updating data)
            const overviewNameValue = document.getElementById('overview-name-value');
            const overviewMobileValue = document.getElementById('overview-mobile-value');
            const overviewCityValue = document.getElementById('overview-city-value');
            const overviewCardsValue = document.getElementById('overview-cards-value');
            const overviewTotalBillValue = document.getElementById('overview-totalbill-value');
            const overviewStageValue = document.getElementById('overview-stage-value');
            const overviewSourceValue = document.getElementById('overview-source-value');
            const overviewOwnerValue = document.getElementById('overview-owner-value');


            // Modal Input Fields
            const modalName = document.getElementById('modal-name');
            const modalMobile = document.getElementById('modal-mobile');
            const modalCity = document.getElementById('modal-city');
            const modalCards = document.getElementById('modal-cards');
            const modalTotalBill = document.getElementById('modal-total-bill');
            const modalStage = document.getElementById('modal-stage');
            const modalSource = document.getElementById('modal-source');
            const modalOwner = document.getElementById('modal-owner');

            // NEW Transaction Record Elements
            const addRowBtn_leadTransaction = document.getElementById('addRowBtn_leadTransaction');
            const leadTransactionTableBody = document.getElementById('leadTransactionTableBody');
            const newRowTemplate = document.getElementById('newRowInputTemplate');

            // Function to safely extract text from a badge element
            function getBadgeValue(element) {
                const badge = element.querySelector('.badge');
                return badge ? badge.textContent.trim() : element.textContent.trim();
            }

            // Function to open the modal and sync data from the main view
            function openModal() {
                // 1. Sync data from overview to modal inputs
                modalName.value = getBadgeValue(overviewNameValue);
                modalMobile.value = getBadgeValue(overviewMobileValue);
                modalCity.value = getBadgeValue(overviewCityValue);
                modalStage.value = getBadgeValue(overviewStageValue);
                modalSource.value = getBadgeValue(overviewSourceValue);

                modalCards.value = getBadgeValue(overviewCardsValue);
                modalTotalBill.value = getBadgeValue(overviewTotalBillValue).replace('Rs. ', '').replace(/,/g, '');
                modalOwner.value = getBadgeValue(overviewOwnerValue);

                // 2. Open modal
                modal.classList.add('active');
            }

            // Function to close the modal
            function closeModal() {
                modal.classList.remove('active');
            }

            // --- Modal Event Listeners ---
            if (editButton) {
                editButton.addEventListener('click', openModal);
            }

            // Close modal when clicking outside the content (on the overlay)
            if (modal) {
                modal.addEventListener('click', function(e) {
                    if (e.target === modal) {
                        closeModal();
                    }
                });
            }

            // Handle Save (Form Submission) - Logic for updating the main grid
            if (leadEditForm) {
                leadEditForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    // 1. Get new values from the modal inputs
                    const newName = modalName.value;
                    const newMobile = modalMobile.value;
                    const newCity = modalCity.value;
                    const newCards = modalCards.value;
                    const newTotalBill = modalTotalBill.value;
                    const newStage = modalStage.value;
                    const newSource = modalSource.value;
                    const newOwner = modalOwner.value;

                    // 2. Update the corresponding fields in the Overview tab
                    overviewNameValue.textContent = newName;
                    overviewMobileValue.textContent = newMobile;
                    overviewCardsValue.textContent = newCards;

                    // Format Total Bill for display
                    overviewTotalBillValue.textContent = 'Rs. ' + new Intl.NumberFormat('en-IN').format(newTotalBill);
                    overviewOwnerValue.textContent = newOwner;

                    // Fields with badges: overwrite content with a new badge span
                    overviewCityValue.innerHTML = `<span class="badge">${newCity}</span>`;
                    overviewStageValue.innerHTML = `<span class="badge">${newStage}</span>`;
                    overviewSourceValue.innerHTML = `<span class="badge">${newSource}</span>`;

                    // 3. Close the modal
                    closeModal();
                });
            }


            // --- Tab Switching Logic ---
            function switchTab(targetTabId) {
                tabs.forEach(tab => tab.classList.remove('active'));
                contents.forEach(content => content.classList.remove('active'));

                const activeTabButton = document.querySelector(`.header-tabs button[data-tab="${targetTabId}"]`);
                const activeTabContent = document.getElementById(targetTabId);

                if (activeTabButton) {
                    activeTabButton.classList.add('active');
                }
                if (activeTabContent) {
                    activeTabContent.classList.add('active');
                }

                // Show/Hide right actions (Edit/Update) for the Overview tab
                const rightActions = document.querySelector('.header-right-actions');
                if (targetTabId === 'overview') {
                    rightActions.style.display = 'flex';
                } else {
                    rightActions.style.display = 'none';
                }
            }

            // Add click event listeners to all tab buttons
            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    const targetTabId = this.getAttribute('data-tab');
                    switchTab(targetTabId);
                });
            });

            // Set the default active tab (Overview, as per last working state)
            switchTab('overview');


            // NEW: Follow Up Logic
            const followUpForm = document.getElementById('followUpForm');
            const followUpTableBody = document.getElementById('followUpTableBody');
            const fuOwnerSelect = document.getElementById('fu-owner-select');
            const fuTypeSelect = document.getElementById('fu-type-select');
            const fuStatusSelect = document.getElementById('fu-status-select');
            const fuDateInput = document.getElementById('fu-date-input');
            const fuNotesTextarea = document.getElementById('fu-notes-textarea');

            if (followUpForm) {
                followUpForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    // 1. Get new values
                    const type = fuTypeSelect.value;
                    const status = fuStatusSelect.value;
                    const date = fuDateInput.value;
                    const owner = fuOwnerSelect.value;
                    const notes = fuNotesTextarea ? fuNotesTextarea.value.trim() : 'N/A';

                    // Skip if date is empty
                    if (!date) return;

                    // 2. Create status badge HTML
                    const statusClass = status === 'Pending' ? 'status-pending' : 'status-completed';
                    const statusHtml = `<span class="status-badge ${statusClass}">${status}</span>`;

                    // 3. Create a new table row element
                    const newRow = document.createElement('tr');
                    newRow.setAttribute('data-status', status);
                    newRow.innerHTML = `
                        <td>${date}</td>
                        <td>${type}</td>
                        <td>${notes || '-'}</td>
                        <td>${owner}</td>
                        <td>${statusHtml}</td>
                    `;

                    // 4. Insert the new row at the top of the table (most recent first)
                    followUpTableBody.prepend(newRow);

                    // 5. Reset the form fields
                    followUpForm.reset();

                    // Set a default date for convenience
                    fuDateInput.value = '2025-10-15';
                });
            }

            // NEW: Attachment Upload Logic
            const uploadFields = [
                // UPDATED FIELDS
                {
                    id: 'aadhar-front-file',
                    statusId: 'aadhar-front-status',
                    label: 'Aadhar Card (Front)'
                }, {
                    id: 'aadhar-back-file',
                    statusId: 'aadhar-back-status',
                    label: 'Aadhar Card (Back)'
                },
                // EXISTING FIELDS
                {
                    id: 'pan-file',
                    statusId: 'pan-status',
                    label: 'PAN Card'
                }, {
                    id: 'photo-file',
                    statusId: 'photo-status',
                    label: 'Customer Photo'
                }
            ];

            uploadFields.forEach(field => {
                const inputFile = document.getElementById(field.id);
                const statusSpan = document.getElementById(field.statusId);

                if (inputFile) {
                    inputFile.addEventListener('change', function() {
                        if (this.files.length > 0) {
                            console.log(`Simulating upload for ${field.label}: ${this.files[0].name}`);


                            statusSpan.textContent = `Uploaded: ${this.files[0].name}`;
                            statusSpan.style.color = '#28a745';
                        } else {
                            statusSpan.textContent = 'No file chosen';
                            statusSpan.style.color = '#007bff';
                        }
                    });
                }
            });

            // --- Transaction Table: Add Row & Delete Row Logic for 'Transaction Record' tab ---

            // Function to handle row deletion (uses event delegation for dynamically added rows)
            function handleDeleteRow(event) {
                const deleteButton = event.target.closest('.delete-row-btn');
                if (deleteButton) {
                    event.preventDefault(); // Prevent default if inside a form
                    deleteButton.closest('tr').remove();
                }
            }

            // Add listener for dynamic delete buttons in the transaction table body
            if (leadTransactionTableBody) {
                leadTransactionTableBody.addEventListener('click', handleDeleteRow);
            }

            // Add new row functionality
            if (addRowBtn_leadTransaction && leadTransactionTableBody && newRowTemplate) {
                addRowBtn_leadTransaction.addEventListener('click', function() {
                    const newRowContent = newRowTemplate.content.cloneNode(true);

                    // Note: Event delegation via leadTransactionTableBody.addEventListener('click', handleDeleteRow)
                    // already handles the deletion for new buttons, so explicit event listener on 
                    // individual new buttons is not strictly necessary but harmless if added.

                    leadTransactionTableBody.appendChild(newRowContent);
                });
            }
        });