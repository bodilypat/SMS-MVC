// Base URL for API requests
const apiUrl = "http://localhost/your_folder/artworks_api.php";

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