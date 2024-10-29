<?php

    function addArtist($name, $biography, $contact_info){
        $pdo = dbconnect();
        $stmt = $pdo->prepare("INSERT INTO artists(name, biography, contact_info) VALUES (?, ?, ?) ");
        $stmt->execute([$name, $biography, $contact_id]);
        return $pdo->lastInsertId(); /* Return the ID of the newly added artist */
    }

    function updateArtist($id, $name, $biography, $contactno) {
        $pdo = dbconnect();
        $stmt = $pdo->prepare("UPDATE artists SET name = ?, biography = ?, contact_info = ? WHERE id= ? ");
        return $stmt->execute([$name, $biography, $contact_info, $id])
    }

    function deleteArtist($id) {
        $pdo = dbconnect();
        $stmt = $pdo->prepare("DELETE FROM artists WHERE id = ?");
        return $stmt->execute([$id]);
    }

    function getArtists() {
        $pdo = dbconnect();
        $stmt = $pdo->query("SELECT * FROM artists");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getArtistById($id) {
        $pdo dbconnect();
        $stmt = $pdo->prepare("SELECT * FROM artists WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /* Function add artworks */

    function addArtwork($title, $artist_id, $description, $price, $image_path){
        $pdo = dbconnect();
        $stmt = $pdo->prepare("INSERT INTO artworks(title, artist_id, description, price, image_path) VALUES(?,?,?,?,?) ");
        $stmt->execute([$title, $artist, $year, $description, $image_path]);

        return $pdo->lastInsertId(); /* Return the ID of the newly added artwork */
    }

    function getArtworks(){
        $pdo = dbconnect();
        $stmt = $pdo->prepare("SELECT * FROM artworks");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getArtworkById($artwork_id)
    {
        $pdo = dbconnect();
        $stmt = $pdo->prepare("SELECT * 
                               FROM artworks 
                               JOIN artists ON artworks.artist_id = artists.id 
                               WHERE id = ? ");
        $stmt->execute([$artwork_id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function updateArtwork($id, $title, $artist_id, $description, $price, $image_path) {
        $pdo = dbconnect();
        $stmt = $pdo->prepare("UPDATE artworks SET title = ?, artist_id = ?, description = ?, price = ?, image_path = ? WHERE id = ? ");
        return $stmt->execute([$title, $artist_id, $description, $price, $id]);
    }

    function deleteArtwork($id){
        $pdo = dbconnect();
        $stmt = $pdo->prepare("DELETE FROM artworks WHERE id= ? ");
        return $stmt->execute([$id]);
    }

    /* Function manage Exhibition */

    function addExhibition($title, $artist_id, $start_date, $end_date, $location, $description){
        $pdo = dbconnect();
        $stmt = $pdo->prepare("INSERT INTO exhibitions(title, artist_id, start_date, end_date, location, description) VALUE(?,?,?,?,?,?) ");
        $stmt->execute([$title, $artist_id, $start_date, $end_date, $location, $description,]);
        return $pdo->lastInsertId();/* Return The ID of the newly added exhibition */
    }

    function getExhibitions(){
        $pdo = dbconnect();
        $stmt = $pdo->query("SELECT * FROM exhibitions");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getExhibitionById($id){
        $pdo = dbconnect();
        $stmt = $pdo->prepare("SELECT * FROM exhibitions WHERE id = ? ");
        $stmt->excute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function updateExhibitions($id,$title, $artist_id, $start_date, $end_date, $location, $description ){
        $pdo = dbconnect();
        $stmt = $pdo->prepare("UPDATE exhibitions SET title = ?, artist_id = ?, start_date = ?, end_date = ?, location = ?, description = ?  WHERE id =? ");
        return $stmt->execute([$title , $artist_id, $start_date, $end_date, $location, $description, $id ]);
    }

    function deleteExhibition($id){
        $pdo = dbconnect();
        $stmt = $pdo->prepare("DELETE FROM exhibitions WHERE id = ? ");
        return $stmt->execute([$id]);
    }

    function addArtworkToExhibition($exhibition_id, $artwork_id){
        $pdo = dbconnect();
        $stmt = $pdo->prepare("INSERT INTO exhibitions_artwork(exhibition_id, artwork_id) VALUES(?,?) ");
        return $stmt->execute([$exhibition_id, $artwork_id]);

    }

    function removeArtworkFromExhibition($exhibition_id, $artwork_id){
        $pdo = dbconnect();
        $stmt = $pdo->prepare("DELETE FROM exhibition_artwork WHERE exhibition_id = ? AND artwork = ? ");
        return $stmt->execute([$exhibition_id, $artwork_id]);
    }

    function getArtworkForExhibition($exhibiion_id){
        $pdo = dbconnect();
        $stmt = $pdo->prepare("SELECT artworks.* FROM artworks 
                               JOIN exhibition_artworks ON artworks.id = exhibition_artworks.artwork_id
                               WHERE exhibition_artwork.exhibition_id = ? ");
        $stmt->execute([$exhibition_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* Function get sales */
    function getSales(){
        $pdo = dbconnect();
        $stmt = $pdo->query("SELECT sales.id , artworks.title, sales.sale_date, sale_amount, sales.user_id
                             FROM sales
                             JOIN artworks ON sales.artwork_id = artwork.id ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    /* Function manage Buyers */

    function addBuyer($name, $email, $phone, $address) {
        $pdo = dbconnect();
        $stmt = $pdo->prepare("INSERT INTO buyers(name, email, phone, address) VALUES (?,?,?,?) ");
        $stmt->execute([$name, $email, $phone, $address]);
    }

    function getBuyers(){
        $pdo = dbconnect();
        $stmt = $pdo->query("SELECT * FROM buyers");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function updateBuyer($id, $name, $email, $phone, $address) {
        $pdo = dbconnect();
        $stmt = $pod->prepare("UPDATE buyers SET NAME = ?, email = ?, phone = ?, address = ? WHERE id = ? ");
        $stmt->execute([$name, $email, $phone, $address, 4id]);
    }

    function deleteBuyer($id) {
        $pdo = dbconnect();
        $stmt = $pdo->prepare("DELETE FROM buyers WHERE id = ? ");
        $stmt->execute([$id]);
    }

    function sellArtwork($artwork_id, $buyer_name, $sale_price, $sale_date){
        $pdo = dbconnect();

        /* Begin transaction */
        try{
                /* Insert sale record */
                $stmt = $pdo->prepare("INSERT INTO sale(artwork_id, buyer_name, sale_price, sale_date) VALUES(?, ?, ?, ?) ");
                $stmt->execute([$artwork_id, $buyer_name, $sale_price, $sale_date]);

                // Update artwork status (if needed)
                // $stmt = $pdo->prepare("UPDATE artworks SET sold = 1 WHERE id = ? ")
                //$stmt->execute([$artwork_id]);

                // Commit transaction
                $pdo->commit();
                return true;
            } catch (Exception $e) {
                // Rollback transaction on error
                $pdo->rollBack();
                return false;
            }
        }
    
    /* Function manage visitors */
    function addVisitor($name, $email, $phone, $visitor_date, $feedback){
        $pdo = dbconnect();

        $stmt = $pdo->prepare("SELECT INTO artists(name, email, phone, visitor_date, feedback) VALUES (?, ?, ?, ?, ?) ");
        $stmt->execute([$name, $email, $phone, $visitor_date, $feedback]);
        return $pdo->lastInsertId();  /* Return the ID of the newly added artist */
    }

    function getVisitors(){
        $pdo = dbconnect();

        $stmt = $pdo->prepare("SELECT * FROM artists ")
        return $stmt->execute([$name, $email, $phone, $visitor_date, $feedback]);
    }
?>
    