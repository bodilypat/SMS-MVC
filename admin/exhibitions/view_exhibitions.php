<?php

    include('../includes/functions.php');

    $exhibition = getExhibitions();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>View Exhbibition</title>
    </head>
    <body>
        <h1>Exhibitions</h1>
        <a href="add_exhibition.php">Add New Exhibition</a>
        <table border="1">
            <tr>
                 <th>Title</th>
                 <th>Artist</th>
                 <th>Start Date</th>
                 <th>End Date</th>
                 <th>Location</th>
                 <th>Description</th>
                 <th>Actions</th>
            </tr>
            <?php foreach($exhibitions as $exhibition): ?>
            <tr>
                 <td><?php echo $exhibition['title'];?></td>
                 <td><?php echo $exhibition['artist_name'];?></td>
                 <td><?php echo $exhibition['start_date'];?></td>
                 <td><?php echo $exhibition['end_date'];?></td>
                 <td><?php echo $exhibition['location'];?></td>
                 <td><?php echo $exhibition['description'];?></td>
                 <td>
                      <a href="edit_exhibition.php?id<?php $exhibition['id'];?>">Edit</a>
                      <a href="delete_exhibition.php?id<?php $exhibition['id'];?>"
                         onClick="return confirm('Are you sure');">Delete</a>
                 </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>