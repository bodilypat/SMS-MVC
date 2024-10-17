<?php

    include('../includes/functions.php');

    //Fetch all artworks to select form
    $artworks = getArtworks();
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $artwork_id = $_POST['artwork_id'];
        $buyer_name = $_POST['buyer_name'];
        $sale_price = $_POST['sale_price'];
        $sale_date = $_POST['saledate'];

        if(addSellArtwork($artwork_id, $buyer_name, $sale_price)){
            echo "Artwork sold successfully!";
        } else {
            echo "Error processing the sale.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Sell Artwork</title>
    </head>
    <body>
        <h1>Sell Artwork</h1>
        <form action="sell_artwork.php" method="post">
            <div class="form-group">
                <label for="artwork">Select Artwork:</label>
                <select name="artwork_id" required>
                    <?php foreach($artworks as $artwork): ?>
                        <option value="<?php echo $artwork['id'];?>"><?php ech htmlspecialchars($artwork['title']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="Buyer">Buyer Name</label>
                <input type="text" name="buyer_name"  class="form-control" required>
            </div>
            <div class="form-group">
                <label for="SalePrice">Sale Price</label>
                <input type="number" name="sale_price" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="Sale_Date">Sale Date</label>
                <input type="datetime-locate" name="sale_date" class="form-control" required>
            </div>
            <button type="submit" value="Sell Artwork">Sell</button>
        </form>
    </body>
</html>
