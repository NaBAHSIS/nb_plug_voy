<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blogdev";
$id = $_GET['id_cdv'];
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['validation']) && ($_POST['validation'] == 'Validé')) {
    $sql = "UPDATE cdv SET Statut='3' WHERE ID_cdv = $id";
    $conn->query($sql);
    $conn->close();
    header("Location: http://localhost/cdv/wp-admin/admin.php?page=cdv");
} else if (isset($_POST['validation']) && ($_POST['validation'] == 'Rejeté')) {
    $cdv_version_actif = "SELECT ID_cdv_version FROM cdv, cdv_version WHERE cdv_version.ID_cdv_version = ($id + (-2))";
    $result = $conn->query($cdv_version_actif);
    $row = $result->fetch_assoc();
    $id_actif = $row["ID_cdv_version"];
    $copie_id = $id_actif.'copie';
    $delete = "DELETE FROM cdv_version WHERE ID_cdv_version = $id_actif";
    $conn->query($delete);
    $sql = "INSERT INTO `cdv_version` (`ID_cdv`, `ID_cdv_version`) VALUES (NULL, '$copie_id')";
    $conn->query($sql);
    $conn->close();
    header("Location: ../wp-admin/admin.php?page=cdv");
}