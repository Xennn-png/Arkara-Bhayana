<?php
    include('../../config.php');

    $region = $_GET['region']; // Mendapatkan parameter region dari query string
    $sql = "SELECT * FROM characters WHERE region = '$region'"; // Query untuk mengambil data karakter berdasarkan region
    $result = $conn->query($sql);

    $characters = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $characters[] = [
                'name' => $row['nama'],
                'va' => $row['va'],
                'image' => $row['gambar'],
                'description' => $row['deskripsi'],
                'element' => $row['element']
            ];
        }
    }

    // Mengembalikan data dalam format JSON
    echo json_encode($characters);

    $conn->close();
?>
