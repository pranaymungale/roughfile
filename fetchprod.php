<!DOCTYPE html>
<html>
<head>
    <title>Products List</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            text-align: left;
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .cat-image {
            max-width: 200px;
        }

    </style>
</head>
<body>

    <h1>Products List</h1>

    <table>
        <thead>
            <tr>
                <th>p_id</th>
                <th>id</th>
                <th>Name</th>
                <th>Description</th>
                <th>Composition</th>
                <th>Category</th>
                <th>Scientific_name</th>
                <th>prod_Image</th>
            </tr>
        </thead>
        <tbody>
            <?php
                include 'connection.php';
                include 'profunction.php'; // include the file that contains getCategoriesList() function
                // $data = getCategoriesList();

                $data = getcustomlist(); // Call the function to get the data
                $data = json_decode($data, true); // Convert the JSON string to an array

                if ($data['status'] == 200) {
                    foreach ($data['data'] as $row) {
                         echo "<tr>";
                         echo "<td>".$row['p_id']."</td>";
                         echo "<td>".$row['id']."</td>";
                         echo "<td>".$row['name']."</td>";
                         echo "<td>".$row['description']."</td>";
                         echo "<td>".$row['composition']."</td>";
                         echo "<td>".$row['category']."</td>";
                         echo "<td>".$row['scientific_name']."</td>";
                        echo "<td><img class='cat-image' src='".$row['prod_image']."'></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr>";
                    echo "<td colspan='4'>".$data['message']."</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>

</body>
</html>