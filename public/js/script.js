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

        document.addEventListener('DOMContentLoaded', function() {
            // Find all the navigation links in the sidebar
            const navLinks = document.querySelectorAll('.sidebar-nav .nav-link');

            // Add a click event listener to each link
            navLinks.forEach(link => {
                link.addEventListener('click', function(event) {
                    // Prevent the link from navigating away
                    event.preventDefault();

                    // First, remove the 'active' class from all links
                    navLinks.forEach(nav => nav.classList.remove('active'));

                    // Then, add the 'active' class to the one that was just clicked
                    this.classList.add('active');
                });
            });
        });




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
            const bulkDeleteForm = document.getElementById('bulkDeleteForm');
            const selectAllCheckbox = document.getElementById('selectAllLeads');
            const leadCheckboxes = document.querySelectorAll('.lead-checkbox');

            // 1. SELECT ALL / DESELECT ALL LOGIC
            if (selectAllCheckbox) {
                selectAllCheckbox.addEventListener('change', function(e) {
                    leadCheckboxes.forEach(checkbox => {
                        checkbox.checked = e.target.checked;
                    });
                });
            }

            // 2. FORM SUBMISSION LOGIC
            if (bulkDeleteForm) {
                bulkDeleteForm.addEventListener('submit', function(event) {
                    event.preventDefault(); // Prevent default form submission initially

                    // Get all checked lead IDs
                    const selectedCheckboxes = document.querySelectorAll('.lead-checkbox:checked');

                    if (selectedCheckboxes.length === 0) {
                        alert('Please select one or more leads to delete.');
                        return;
                    }

                    // Confirmation dialog
                    const confirmation = confirm(`Are you sure you want to delete ${selectedCheckboxes.length} selected lead(s)? This action cannot be undone.`);

                    if (!confirmation) {
                        return; // Stop here if user cancels
                    }

                    // Remove any previously appended hidden inputs
                    this.querySelectorAll('input[name="selected_leads[]"]').forEach(input => input.remove());

                    // Create and append a hidden input for each selected ID
                    selectedCheckboxes.forEach(checkbox => {
                        const hiddenInput = document.createElement('input');
                        hiddenInput.type = 'hidden';
                        hiddenInput.name = 'selected_leads[]'; // Must match controller validation name
                        hiddenInput.value = checkbox.value;
                        this.appendChild(hiddenInput);
                    });

                    // Finally, submit the form with the collected IDs
                    this.submit();
                });
            }
        });