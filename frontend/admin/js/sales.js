// Base URL of the API (change this to the actual URL of your API)
const apiUrl = 'api/sales.php';

// Function to make GET requests to fetch all sales
function fetchSales() {
    fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
            console.log('All sales:', data);
            displaySalesData(data); // Function to display data on the webpage
        })
        .catch(error => console.error('Error fetching sales:', error));
}

// Function to make POST requests (Create a new sale)
function createSale(artworkId, userId, amount) {
    const requestData = {
        artwork_id: artworkId,
        user_id: userId,
        amount: amount
    };

    fetch(apiUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(requestData)
    })
    .then(response => response.json())
    .then(data => {
        console.log('Sale created:', data);
        fetchSales(); // Refresh the list of sales
    })
    .catch(error => console.error('Error creating sale:', error));
}

// Function to make PUT requests (Update an existing sale)
function updateSale(id, artworkId, userId, amount) {
    const requestData = {
        artwork_id: artworkId,
        user_id: userId,
        amount: amount
    };

    fetch(`${apiUrl}?id=${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(requestData)
    })
    .then(response => response.json())
    .then(data => {
        console.log('Sale updated:', data);
        fetchSales(); // Refresh the list of sales
    })
    .catch(error => console.error('Error updating sale:', error));
}

// Function to make DELETE requests (Delete a sale)
function deleteSale(id) {
    fetch(`${apiUrl}?id=${id}`, {
        method: 'DELETE'
    })
    .then(response => response.json())
    .then(data => {
        console.log('Sale deleted:', data);
        fetchSales(); // Refresh the list of sales
    })
    .catch(error => console.error('Error deleting sale:', error));
}

// Function to display fetched sales data in a table
function displaySalesData(data) {
    const tableBody = document.getElementById('salesTableBody');
    tableBody.innerHTML = ''; // Clear any existing rows

    data.forEach(row => {
        const tr = document.createElement('tr');
        
        tr.innerHTML = `
            <td>${row.id}</td>
            <td>${row.artwork_id}</td>
            <td>${row.user_id}</td>
            <td>${row.sale_date}</td>
            <td>${row.amount}</td>
            <td>
                <button onclick="editSale(${row.id})">Edit</button>
                <button onclick="deleteSale(${row.id})">Delete</button>
            </td>
        `;
        
        tableBody.appendChild(tr);
    });
}

// Function to handle editing a sale record (open form or prompt)
function editSale(id) {
    const artworkId = prompt('Enter new artwork ID:');
    const userId = prompt('Enter new user ID:');
    const amount = prompt('Enter new amount:');

    if (artworkId && userId && amount) {
        updateSale(id, artworkId, userId, amount);
    }
}

// Function to add a new sale record (via a form or button click)
function addNewSale() {
    const artworkId = prompt('Enter artwork ID:');
    const userId = prompt('Enter user ID:');
    const amount = prompt('Enter sale amount:');

    if (artworkId && userId && amount) {
        createSale(artworkId, userId, amount);
    }
}
