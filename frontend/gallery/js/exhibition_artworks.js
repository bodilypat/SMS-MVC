// Base URL of the API (change this to the actual URL of your API)
const apiUrl = 'api/exhibition_artworks.php';

// Function to make GET requests
function fetchArtworkExhibitions() {
    fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
            console.log('All artwork-exhibition relationships:', data);
            displayExhibitionData(data); // Function to display data on the webpage
        })
        .catch(error => console.error('Error fetching artwork-exhibitions:', error));
}

// Function to make POST requests (Create a new relationship)
function createArtworkExhibition(exhibitionId, artworkId) {
    const requestData = {
        exhibition_id: exhibitionId,
        artwork_id: artworkId
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
        console.log('Artwork-Exhibition relationship created:', data);
        fetchArtworkExhibitions(); // Refresh the list of relationships
    })
    .catch(error => console.error('Error creating artwork-exhibition relationship:', error));
}

// Function to make PUT requests (Update an existing relationship)
function updateArtworkExhibition(exhibitionId, artworkId, newExhibitionId, newArtworkId) {
    const requestData = {
        exhibition_id: newExhibitionId,
        artwork_id: newArtworkId
    };

    fetch(`${apiUrl}?exhibition_id=${exhibitionId}&artwork_id=${artworkId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(requestData)
    })
    .then(response => response.json())
    .then(data => {
        console.log('Artwork-Exhibition relationship updated:', data);
        fetchArtworkExhibitions(); // Refresh the list of relationships
    })
    .catch(error => console.error('Error updating artwork-exhibition relationship:', error));
}

// Function to make DELETE requests (Delete a relationship)
function deleteArtworkExhibition(exhibitionId, artworkId) {
    fetch(`${apiUrl}?exhibition_id=${exhibitionId}&artwork_id=${artworkId}`, {
        method: 'DELETE'
    })
    .then(response => response.json())
    .then(data => {
        console.log('Artwork-Exhibition relationship deleted:', data);
        fetchArtworkExhibitions(); // Refresh the list of relationships
    })
    .catch(error => console.error('Error deleting artwork-exhibition relationship:', error));
}

// Function to display fetched artwork-exhibition relationships on the webpage
function displayExhibitionData(data) {
    const tableBody = document.getElementById('artworkExhibitionTableBody');
    tableBody.innerHTML = ''; // Clear any existing rows

    data.forEach(row => {
        const tr = document.createElement('tr');
        
        tr.innerHTML = `
            <td>${row.exhibition_id}</td>
            <td>${row.artwork_id}</td>
            <td>
                <button onclick="editArtworkExhibition(${row.exhibition_id}, ${row.artwork_id})">Edit</button>
                <button onclick="deleteArtworkExhibition(${row.exhibition_id}, ${row.artwork_id})">Delete</button>
            </td>
        `;
        
        tableBody.appendChild(tr);
    });
}

// Function to handle editing an exhibition-artwork relationship (This could be a form)
function editArtworkExhibition(exhibitionId, artworkId) {
    // You can add a form to edit the exhibition and artwork IDs
    const newExhibitionId = prompt('Enter new exhibition ID:', exhibitionId);
    const newArtworkId = prompt('Enter new artwork ID:', artworkId);
    
    if (newExhibitionId && newArtworkId) {
        updateArtworkExhibition(exhibitionId, artworkId, newExhibitionId, newArtworkId);
    }
}

// Example usage of creating a new relationship (add a form or buttons to trigger this)
function addNewArtworkExhibition() {
    const exhibitionId = prompt('Enter exhibition ID:');
    const artworkId = prompt('Enter artwork ID:');
    
    if (exhibitionId && artworkId) {
        createArtworkExhibition(exhibitionId, artworkId);
    }
}
