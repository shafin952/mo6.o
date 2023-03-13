<!DOCTYPE html>
<html lang="en">

<head>
   
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="column  ">
                <h2>Dashboard - User List</h2>
                <h4><a href="./index.html">Back</a></h4>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Profile Picture</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $file = fopen('users.csv', 'r');
                        while (($row = fgetcsv($file)) !== false) {
                            echo '<tr>';
                            foreach ($row as $data) {
                                if (strpos($data, '.jpg') !== false || strpos($data, '.png') !== false || strpos($data, '.jpeg') !== false) {
                                    echo '<td><img src="./' . htmlspecialchars($data) . '" width="50" height="50" ></td>';
                                } else {
                                    echo '<td>' . htmlspecialchars($data) . '</td>';
                                }
                            }
                            echo '</tr>';
                        }
                        fclose($file);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>