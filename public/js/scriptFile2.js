/**
 * Global function to clone the item row, clear its values, and insert it into the form.
 * This is used specifically in the Quotes/Invoice form.
 */
function addItemRow() {
    const container = document.getElementById('itemRowsContainer');
    
    // Safety check for other pages that don't have this feature
    if (!container) return;

    // Get the structure of the template row.
    const templateRow = document.querySelector('.item-template');
    
    // Clone the row and its content deeply
    const newRow = templateRow.cloneNode(true);
    
    // 1. Remove the 'item-template' class from the cloned element
    newRow.classList.remove('item-template');
    
    // 2. Clear values in the new row
    const inputs = newRow.querySelectorAll('input');
    inputs.forEach(input => {
        if (input.type === 'text' || input.type === 'number') {
            // Reset placeholder inputs (Item Name, Description) to empty string
            if (input.placeholder) {
                input.value = ''; 
            } 
            // Reset quantity to '1'
            else if (input.value === '1') {
                input.value = '1';
            }
            // Reset price/total inputs to '0.00'
            else if (input.getAttribute('readonly') !== null || input.value === '0.00') {
                input.value = '0.00';
            }
        }
    });
    
    // 3. Re-attach the delete function
    const deleteIcon = newRow.querySelector('.delete-icon');
    deleteIcon.setAttribute('onclick', 'deleteItemRow(this)');

    // 4. Insert the new row into the container
    container.appendChild(newRow);
}

/**
 * Global function to delete an item row when the trash icon is clicked.
 * This is used specifically in the Quotes/Invoice form.
 * @param {HTMLElement} deleteButton - The clicked trash icon element.
 */
function deleteItemRow(deleteButton) {
    const rowToRemove = deleteButton.closest('.item-row');
    const container = document.getElementById('itemRowsContainer');
    
    if (rowToRemove && container) {
        // Prevent removing the very last row (the initial/template one)
        const allRows = container.querySelectorAll('.item-row');
        if (allRows.length > 1) {
            rowToRemove.remove();
        } else {
            alert("You must have at least one item row.");
        }
    }
}


document.addEventListener('DOMContentLoaded', () => {
    
    // --- Modal Open/Close Logic ---
    
    // 1. Quotes/Invoice Modal
    const quoteModal = document.getElementById('newInvoiceModal');
    const openQuoteBtn = document.getElementById('openModalBtn');
    const closeQuoteBtn = document.getElementById('closeModalBtn');
    
    if (openQuoteBtn && quoteModal) {
        openQuoteBtn.onclick = function() {
            quoteModal.style.display = "block";
            setTimeout(() => { quoteModal.classList.add('active'); }, 10);
            document.body.style.overflow = "hidden";
        }
        closeQuoteBtn.onclick = function() {
            quoteModal.classList.remove('active');
            setTimeout(() => { quoteModal.style.display = "none"; document.body.style.overflow = "auto"; }, 300);
        }
    }
    
    // 2. Customer Modal
    const customerModal = document.getElementById('newCustomerModal');
    const openCustomerBtn = document.getElementById('openCustomerModalBtn');
    const closeCustomerBtn = document.getElementById('closeCustomerModalBtn');
    
    if (openCustomerBtn && customerModal) {
        openCustomerBtn.onclick = function() {
            customerModal.style.display = "block";
            setTimeout(() => { customerModal.classList.add('active'); }, 10);
            document.body.style.overflow = "hidden";
        }
        closeCustomerBtn.onclick = function() {
            customerModal.classList.remove('active');
            setTimeout(() => { customerModal.style.display = "none"; document.body.style.overflow = "auto"; }, 300);
        }
    }
    
    // 3. Expense Modal
    const expenseModal = document.getElementById('newExpenseModal');
    const openExpenseBtn = document.getElementById('openExpenseModalBtn');
    const closeExpenseBtn = document.getElementById('closeExpenseModalBtn');
    
    if (openExpenseBtn && expenseModal) {
        openExpenseBtn.onclick = function() {
            expenseModal.style.display = "block";
            setTimeout(() => { expenseModal.classList.add('active'); }, 10);
            document.body.style.overflow = "hidden";
        }
        closeExpenseBtn.onclick = function() {
            expenseModal.classList.remove('active');
            setTimeout(() => { expenseModal.style.display = "none"; document.body.style.overflow = "auto"; }, 300);
        }
    }

    // Global click handler to close any modal if the background is clicked
    window.onclick = function(event) {
        if (event.target == quoteModal) {
            quoteModal.classList.remove('active');
            setTimeout(() => { quoteModal.style.display = "none"; document.body.style.overflow = "auto"; }, 300);
        }
        if (event.target == customerModal) {
            customerModal.classList.remove('active');
            setTimeout(() => { customerModal.style.display = "none"; document.body.style.overflow = "auto"; }, 300);
        }
        if (event.target == expenseModal) {
            expenseModal.classList.remove('active');
            setTimeout(() => { expenseModal.style.display = "none"; document.body.style.overflow = "auto"; }, 300);
        }
    }
});