// Base URL for API requests
const apiUrl = "http://localhost/galleries/backend/api/artists.php";

// Function to fetch all artists
function fetchAllArtists() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", apiUrl, true);
    
    xhr.onload = function() {
        if (xhr.status === 200) {
            const artists = JSON.parse(xhr.responseText);
            displayArtists(artists);
        } else {
            console.error("Failed to fetch artists:", xhr.statusText);
        }
    };
    
    xhr.onerror = function() {
        console.error("Network error");
    };
    
    xhr.send();
}

// Function to fetch a single artist by ID
function fetchArtistById(artistId) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", `${apiUrl}?id=${artistId}`, true);
    
    xhr.onload = function() {
        if (xhr.status === 200) {
            const artist = JSON.parse(xhr.responseText);
            displayArtistDetails(artist);
        } else {
            console.error("Failed to fetch artist:", xhr.statusText);
        }
    };
    
    xhr.onerror = function() {
        console.error("Network error");
    };
    
    xhr.send();
}

// Function to create a new artist
function createArtist(data) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", apiUrl, true);
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onload = function() {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            alert(response.message);
            fetchAllArtists();  // Refresh the artists list
        } else {
            console.error("Failed to create artist:", xhr.statusText);
        }
    };
    
    xhr.onerror = function() {
        console.error("Network error");
    };

    xhr.send(JSON.stringify(data));
}

// Function to update an artist
function updateArtist(artistId, data) {
    const xhr = new XMLHttpRequest();
    xhr.open("PUT", `${apiUrl}?id=${artistId}`, true);
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onload = function() {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            alert(response.message);
            fetchAllArtists();  // Refresh the artists list
        } else {
            console.error("Failed to update artist:", xhr.statusText);
        }
    };
    
    xhr.onerror = function() {
        console.error("Network error");
    };

    xhr.send(JSON.stringify(data));
}

// Function to delete an artist
function deleteArtist(artistId) {
    const xhr = new XMLHttpRequest();
    xhr.open("DELETE", `${apiUrl}?id=${artistId}`, true);
    
    xhr.onload = function() {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            alert(response.message);
            fetchAllArtists();  // Refresh the artists list
        } else {
            console.error("Failed to delete artist:", xhr.statusText);
        }
    };
    
    xhr.onerror = function() {
        console.error("Network error");
    };
    
    xhr.send();
}

// Function to display all artists in a table
function displayArtists(artists) {
    const artistsTable = document.getElementById("artistsTableBody");
    artistsTable.innerHTML = '';  // Clear previous rows

    artists.forEach(artist => {
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${artist.artist_id}</td>
            <td>${artist.first_name}</td>
            <td>${artist.last_name}</td>
            <td>
                <button onclick="fetchArtistById(${artist.artist_id})">View</button>
                <button onclick="editArtist(${artist.artist_id})">Edit</button>
                <button onclick="deleteArtist(${artist.artist_id})">Delete</button>
            </td>
        `;
        artistsTable.appendChild(row);
    });
}

// Function to display the details of a single artist
function displayArtistDetails(artist) {
    document.getElementById("artistId").textContent = artist.artist_id;
    document.getElementById("artistFirstName").textContent = artist.first_name;
    document.getElementById("artistLastName").textContent = artist.last_name;
    document.getElementById("artistBirthDate").textContent = artist.birth_date;
    document.getElementById("artistDeathDate").textContent = artist.death_date;
    document.getElementById("artistBiography").textContent = artist.biography;
}

// Function to edit an artist
function editArtist(artistId) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", `${apiUrl}?id=${artistId}`, true);
    
    xhr.onload = function() {
        if (xhr.status === 200) {
            const artist = JSON.parse(xhr.responseText);
            populateEditForm(artist);
        } else {
            console.error("Failed to fetch artist for editing:", xhr.statusText);
        }
    };
    
    xhr.onerror = function() {
        console.error("Network error");
    };
    
    xhr.send();
}

// Function to populate the edit form
function populateEditForm(artist) {
    document.getElementById("editArtistId").value = artist.artist_id;
    document.getElementById("editFirstName").value = artist.first_name;
    document.getElementById("editLastName").value = artist.last_name;
    document.getElementById("editBirthDate").value = artist.birth_date;
    document.getElementById("editDeathDate").value = artist.death_date;
    document.getElementById("editBiography").value = artist.biography;
}

// Event listener for creating a new artist
document.getElementById("createArtistForm").addEventListener("submit", function(e) {
    e.preventDefault();
    const newArtistData = {
        first_name: document.getElementById("newFirstName").value,
        last_name: document.getElementById("newLastName").value,
        birth_date: document.getElementById("newBirthDate").value,
        death_date: document.getElementById("newDeathDate").value,
        biography: document.getElementById("newBiography").value
    };
    
    createArtist(newArtistData);  // Create artist via the API
});

// Event listener for updating an artist
document.getElementById("updateArtistForm").addEventListener("submit", function(e) {
    e.preventDefault();
    const artistId = document.getElementById("editArtistId").value;
    const updatedArtistData = {
        first_name: document.getElementById("editFirstName").value,
        last_name: document.getElementById("editLastName").value,
        birth_date: document.getElementById("editBirthDate").value,
        death_date: document.getElementById("editDeathDate").value,
        biography: document.getElementById("editBiography").value
    };
    
    updateArtist(artistId, updatedArtistData);  // Update artist via the API
});

// Fetch all artists when the page loads
document.addEventListener("DOMContentLoaded", function() {
    fetchAllArtists();
});

// Base URL for API requests
const apiUrl = "http://localhost/galleries/backend/api/artworks.php";

// Function to fetch all artworks
function fetchAllArtworks() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", apiUrl, true);

    xhr.onload = function() {
        if (xhr.status === 200) {
            const artworks = JSON.parse(xhr.responseText);
            displayArtworks(artworks);
        } else {
            console.error("Failed to fetch artworks:", xhr.statusText);
        }
    };

    xhr.onerror = function() {
        console.error("Network error");
    };

    xhr.send();
}

// Function to fetch a single artwork by ID
function fetchArtworkById(artworkId) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", `${apiUrl}?id=${artworkId}`, true);

    xhr.onload = function() {
        if (xhr.status === 200) {
            const artwork = JSON.parse(xhr.responseText);
            displayArtworkDetails(artwork);
        } else {
            console.error("Failed to fetch artwork:", xhr.statusText);
        }
    };

    xhr.onerror = function() {
        console.error("Network error");
    };

    xhr.send();
}

// Function to create a new artwork
function createArtwork(data) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", apiUrl, true);
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onload = function() {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            alert(response.message);
            fetchAllArtworks();  // Refresh the artworks list
        } else {
            console.error("Failed to create artwork:", xhr.statusText);
        }
    };

    xhr.onerror = function() {
        console.error("Network error");
    };

    xhr.send(JSON.stringify(data));
}

// Function to update an artwork
function updateArtwork(artworkId, data) {
    const xhr = new XMLHttpRequest();
    xhr.open("PUT", `${apiUrl}?id=${artworkId}`, true);
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onload = function() {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            alert(response.message);
            fetchAllArtworks();  // Refresh the artworks list
        } else {
            console.error("Failed to update artwork:", xhr.statusText);
        }
    };

    xhr.onerror = function() {
        console.error("Network error");
    };

    xhr.send(JSON.stringify(data));
}

// Function to delete an artwork
function deleteArtwork(artworkId) {
    const xhr = new XMLHttpRequest();
    xhr.open("DELETE", `${apiUrl}?id=${artworkId}`, true);

    xhr.onload = function() {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            alert(response.message);
            fetchAllArtworks();  // Refresh the artworks list
        } else {
            console.error("Failed to delete artwork:", xhr.statusText);
        }
    };

    xhr.onerror = function() {
        console.error("Network error");
    };

    xhr.send();
}

// Function to display all artworks in a table
function displayArtworks(artworks) {
    const artworksTable = document.getElementById("artworksTableBody");
    artworksTable.innerHTML = '';  // Clear previous rows

    artworks.forEach(artwork => {
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${artwork.id}</td>
            <td>${artwork.title}</td>
            <td>${artwork.artist_id}</td>
            <td>${artwork.price}</td>
            <td>
                <button onclick="fetchArtworkById(${artwork.id})">View</button>
                <button onclick="editArtwork(${artwork.id})">Edit</button>
                <button onclick="deleteArtwork(${artwork.id})">Delete</button>
            </td>
        `;
        artworksTable.appendChild(row);
    });
}

// Function to display the details of a single artwork
function displayArtworkDetails(artwork) {
    document.getElementById("artworkId").textContent = artwork.id;
    document.getElementById("artworkTitle").textContent = artwork.title;
    document.getElementById("artworkDescription").textContent = artwork.description;
    document.getElementById("artworkPrice").textContent = artwork.price;
    document.getElementById("artworkImagePath").textContent = artwork.image_path;
    document.getElementById("artworkArtistId").textContent = artwork.artist_id;
}

// Function to edit an artwork
function editArtwork(artworkId) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", `${apiUrl}?id=${artworkId}`, true);

    xhr.onload = function() {
        if (xhr.status === 200) {
            const artwork = JSON.parse(xhr.responseText);
            populateEditForm(artwork);
        } else {
            console.error("Failed to fetch artwork for editing:", xhr.statusText);
        }
    };

    xhr.onerror = function() {
        console.error("Network error");
    };

    xhr.send();
}

// Function to populate the edit form
function populateEditForm(artwork) {
    document.getElementById("editArtworkId").value = artwork.id;
    document.getElementById("editTitle").value = artwork.title;
    document.getElementById("editDescription").value = artwork.description;
    document.getElementById("editPrice").value = artwork.price;
    document.getElementById("editImagePath").value = artwork.image_path;
    document.getElementById("editArtistId").value = artwork.artist_id;
}

// Event listener for creating a new artwork
document.getElementById("createArtworkForm").addEventListener("submit", function(e) {
    e.preventDefault();
    const newArtworkData = {
        title: document.getElementById("newTitle").value,
        description: document.getElementById("newDescription").value,
        price: document.getElementById("newPrice").value,
        image_path: document.getElementById("newImagePath").value,
        artist_id: document.getElementById("newArtistId").value
    };

    createArtwork(newArtworkData);  // Create artwork via the API
});

// Event listener for updating an artwork
document.getElementById("updateArtworkForm").addEventListener("submit", function(e) {
    e.preventDefault();
    const artworkId = document.getElementById("editArtworkId").value;
    const updatedArtworkData = {
        title: document.getElementById("editTitle").value,
        description: document.getElementById("editDescription").value,
        price: document.getElementById("editPrice").value,
        image_path: document.getElementById("editImagePath").value,
        artist_id: document.getElementById("editArtistId").value
    };

    updateArtwork(artworkId, updatedArtworkData);  // Update artwork via the API
});

// Fetch all artworks when the page loads
document.addEventListener("DOMContentLoaded", function() {
    fetchAllArtworks();
});

// Base URL for API requests
const apiUrl = "http://localhost/galleries/backend/api/exhibitions.php";

// Function to fetch all exhibitions
function fetchAllExhibitions() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", apiUrl, true);

    xhr.onload = function() {
        if (xhr.status === 200) {
            const exhibitions = JSON.parse(xhr.responseText);
            displayExhibitions(exhibitions);
        } else {
            console.error("Failed to fetch exhibitions:", xhr.statusText);
        }
    };

    xhr.onerror = function() {
        console.error("Network error");
    };

    xhr.send();
}

// Function to fetch a single exhibition by ID
function fetchExhibitionById(exhibitionId) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", `${apiUrl}?id=${exhibitionId}`, true);

    xhr.onload = function() {
        if (xhr.status === 200) {
            const exhibition = JSON.parse(xhr.responseText);
            displayExhibitionDetails(exhibition);
        } else {
            console.error("Failed to fetch exhibition:", xhr.statusText);
        }
    };

    xhr.onerror = function() {
        console.error("Network error");
    };

    xhr.send();
}

// Function to create a new exhibition
function createExhibition(data) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", apiUrl, true);
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onload = function() {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            alert(response.message);
            fetchAllExhibitions();  // Refresh the exhibitions list
        } else {
            console.error("Failed to create exhibition:", xhr.statusText);
        }
    };

    xhr.onerror = function() {
        console.error("Network error");
    };

    xhr.send(JSON.stringify(data));
}

// Function to update an exhibition
function updateExhibition(exhibitionId, data) {
    const xhr = new XMLHttpRequest();
    xhr.open("PUT", `${apiUrl}?id=${exhibitionId}`, true);
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onload = function() {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            alert(response.message);
            fetchAllExhibitions();  // Refresh the exhibitions list
        } else {
            console.error("Failed to update exhibition:", xhr.statusText);
        }
    };

    xhr.onerror = function() {
        console.error("Network error");
    };

    xhr.send(JSON.stringify(data));
}

// Function to delete an exhibition
function deleteExhibition(exhibitionId) {
    const xhr = new XMLHttpRequest();
    xhr.open("DELETE", `${apiUrl}?id=${exhibitionId}`, true);

    xhr.onload = function() {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            alert(response.message);
            fetchAllExhibitions();  // Refresh the exhibitions list
        } else {
            console.error("Failed to delete exhibition:", xhr.statusText);
        }
    };

    xhr.onerror = function() {
        console.error("Network error");
    };

    xhr.send();
}

// Function to display all exhibitions in a table
function displayExhibitions(exhibitions) {
    const exhibitionsTable = document.getElementById("exhibitionsTableBody");
    exhibitionsTable.innerHTML = '';  // Clear previous rows

    exhibitions.forEach(exhibition => {
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${exhibition.id}</td>
            <td>${exhibition.title}</td>
            <td>${exhibition.artist_id}</td>
            <td>${exhibition.price}</td>
            <td>
                <button onclick="fetchExhibitionById(${exhibition.id})">View</button>
                <button onclick="editExhibition(${exhibition.id})">Edit</button>
                <button onclick="deleteExhibition(${exhibition.id})">Delete</button>
            </td>
        `;
        exhibitionsTable.appendChild(row);
    });
}

// Function to display the details of a single exhibition
function displayExhibitionDetails(exhibition) {
    document.getElementById("exhibitionId").textContent = exhibition.id;
    document.getElementById("exhibitionTitle").textContent = exhibition.title;
    document.getElementById("exhibitionDescription").textContent = exhibition.description;
    document.getElementById("exhibitionPrice").textContent = exhibition.price;
    document.getElementById("exhibitionImagePath").textContent = exhibition.image_path;
    document.getElementById("exhibitionArtistId").textContent = exhibition.artist_id;
}

// Function to edit an exhibition
function editExhibition(exhibitionId) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", `${apiUrl}?id=${exhibitionId}`, true);

    xhr.onload = function() {
        if (xhr.status === 200) {
            const exhibition = JSON.parse(xhr.responseText);
            populateEditForm(exhibition);
        } else {
            console.error("Failed to fetch exhibition for editing:", xhr.statusText);
        }
    };

    xhr.onerror = function() {
        console.error("Network error");
    };

    xhr.send();
}

// Function to populate the edit form
function populateEditForm(exhibition) {
    document.getElementById("editExhibitionId").value = exhibition.id;
    document.getElementById("editTitle").value = exhibition.title;
    document.getElementById("editDescription").value = exhibition.description;
    document.getElementById("editPrice").value = exhibition.price;
    document.getElementById("editImagePath").value = exhibition.image_path;
    document.getElementById("editArtistId").value = exhibition.artist_id;
}

// Event listener for creating a new exhibition
document.getElementById("createExhibitionForm").addEventListener("submit", function(e) {
    e.preventDefault();
    const newExhibitionData = {
        title: document.getElementById("newTitle").value,
        description: document.getElementById("newDescription").value,
        price: document.getElementById("newPrice").value,
        image_path: document.getElementById("newImagePath").value,
        artist_id: document.getElementById("newArtistId").value
    };

    createExhibition(newExhibitionData);  // Create exhibition via the API
});

// Event listener for updating an exhibition
document.getElementById("updateExhibitionForm").addEventListener("submit", function(e) {
    e.preventDefault();
    const exhibitionId = document.getElementById("editExhibitionId").value;
    const updatedExhibitionData = {
        title: document.getElementById("editTitle").value,
        description: document.getElementById("editDescription").value,
        price: document.getElementById("editPrice").value,
        image_path: document.getElementById("editImagePath").value,
        artist_id: document.getElementById("editArtistId").value
    };

    updateExhibition(exhibitionId, updatedExhibitionData);  // Update exhibition via the API
});

// Fetch all exhibitions when the page loads
document.addEventListener("DOMContentLoaded", function() {
    fetchAllExhibitions();
});

// Base URL of the API (change this to the actual URL of your API)
const apiUrl = 'http://localhost/galleries/backend/api/artwork_exhibition.php';

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

// Fetch the initial list of artwork-exhibitions when the page loads
document.addEventListener('DOMContentLoaded', fetchArtworkExhibitions);

// Base URL of the API (change this to the actual URL of your API)
const apiUrl = 'http://localhost/galleries/backend/api/sales.php';

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

// Initial load: Fetch all sales when the page is loaded
document.addEventListener('DOMContentLoaded', fetchSales);
