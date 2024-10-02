<?php

    function addArtist($name, $nationality, $biography, $contactno){
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO artists(name, biography, contactno) VALUES (?, ?, ?) ");
        $stmt->execute([$name, $biography, $contact]);
        return $pdo->lastInsertId(); /* Return the ID of the newly added artist */
    }

    function updateArtist($id, $name, $biography, $contactno) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE artists SET name = ?, biography = ?, contact = ? WHERE id= ? ");
        return $stmt->execute([$name, $biography, $contact, $id])
    }

    function deleteArtist($id) {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM artists WHERE id = ?");
        return $stmt->execute([$id]);
    }

    function getArtists() {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM artists");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getArtistById($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM artists WHERE id = ?");
        $stmt->execute([id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /* Function add artworks */

    function addArtwork($title, $artist, $year, $description, $imagePath){
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO artworks(title, artist, year, description, imagePath) VALUES(?,?,?,?,?) ");
        $stmt->execute([$title, $artist, $year, $description, $imagePath]);
        return $pdo->lastInsertId(); /* Return the ID of the newly added artwork */
    }

    function getArtworks(){
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM artworks");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getArtworkById($id){
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM artworks WHERE id = ? ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function updateArtwork($id, $title, $artist, $year, $description) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE artworks SET title = ?, artist = ?, year = ?, description = ?, WHERE id = ? ");
        return $stmt->execute([$title, $artist, $year, $description]);
    }

    function deleteArtwork($id){
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM artworks WHERE id= ? ");
        return $stmt->execute([$id]);
    }

    /* Function manage Exhibition */

    function addExhibition($title, $artist, $description, $startDate, $endDate){
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO exhibitions(title, artist, description, start_date, end_date) VALUE(?,?,?,?,?) ");
        $stmt->execute([$title, $artist, $description, $startDate, $endDate]);
        return $pdo->lastInsertId();/* Return The ID of the newly added exhibition */
    }

    function getExhibitions(){
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM exhibitions");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getExhibitionById($id){
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM exhibitions WHERE id = ? ");
        $stmt->excute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function updateExhibitions($id,$title, $artist, $description, $startDate, $endDate){
        global $pdo;
        $stmt = $pdo->prepare("UPDATE exhibitions SET title = ?, artist = ?, description = ?, start_date = ?, end_date = ?, WHERE id =? ");
        $stmt->execute([$title , $artist, $description, $start_date, $end_date]);
    }

    function deleteExhibition($id){
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM exhibitions WHERE id = ? ");
        $stmt->execute([$id]);
    }

    /* Function manage Buyers */

    function addBuyer($name, $email, $phone, $address) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO buyers(name, email, phone, address) VALUES (?,?,?,?) ");
        $stmt->execute([$name, $email, $phone, $address]);
    }

    function getBuyers(){
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM buyers");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function updateBuyer($id, $name, $email, $phone, $address) {
        global $pdo;
        $stmt = $pod->prepare("UPDATE buyers SET NAME = ?, email = ?, phone = ?, address = ? WHERE id = ? ");
        $stmt->execute([$name, $email, $phone, $address, 4id]);
    }

    function deleteBuyer($id) {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM buyers WHERE id = ? ");
        $stmt->execute([$id]);
    }

    