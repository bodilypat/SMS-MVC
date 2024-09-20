CREATE TABLE Artist(
    ArtistID INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(100) NOT NULL,
    Birthdate DATE,
    Nationality VARCHAR(50),
    Biography TEXT
);
CREATE TABLE Artwork(
    ArtworkID INT PRIMARY KEY AUTO_INCREMENT,
    Title VARCHAR(255) NOT NULL,
    ArtistID INT,
    YearCreated YEAR,
    Medium VARCHAR(100),
    Dimensions VARCHAR(50),
    Price DECIMAL(10,2),
    ImageURL VARCHAR(255),
    FOREIGN KEY(artistID) REFERENCES Artists(artistID)
);
CREATE TABLE Exhitbitions(
    ExhibitionID INT PRYMARY KEY AUTO_INCREATEMENT,
    Title VARCHAR(255) NOT NULL,
    StartDate DATE,
    EndDate DATE,
    Description Text,
    Location VARCHAR(255)
);
CREATE TABLE ExibitionArtworks(
    ExhibitionID INT,
    ArtworkID INT,
    PRIMARY KEY (ExhibitionID, ArtworkID),
    FOREIGN KEY (ExhibitiionID) REFERENCES Exhibitions(ExhibitionID),
    FOREIGN KEY (ArtworkID) REFERENCES Artworks(ArtworkID)
);
CREATE TABLE GalleryVistors(
    VisitorID INT PRIMARY KEY AUTO_INCREATEMENT,
    FirstName VARCHAR(100),
    LastName VARCHAR(100),
    Email VARCHAR(255) UNIQUE,
    PhoneNumber VARCHAR(20),
    Address TEXT
);

CREATE TABLE Sales(
    SaleID INT PRIMARY KEY AUTO_INCREMENT,
    ArtworkID INT,
    VisitorID INT,
    SaleDate DATE,
    SalePrice DECIMAL(10,2),
    FOREIGN KEY (ArtworkID) REFERENCE Artworks(ArtworkID),
    FOREIGN KEY (VisitorID) REFERENCE GalleryVisitors(VisitorID)
)
