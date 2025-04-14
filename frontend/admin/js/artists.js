// Base URL for API requests
const apiUrl = "/api/artists.php";

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
