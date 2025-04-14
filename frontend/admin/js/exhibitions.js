// Base URL for API requests
const apiUrl = "api/exhibitions.php";

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
