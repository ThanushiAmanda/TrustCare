<?php
// Database configuration
$servername = "localhost";
$username = "root"; // Change to your database username
$password = ""; // Change to your database password
$dbname = "trustcare_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$search = isset($_GET['search']) ? $_GET['search'] : '';
$specialty = isset($_GET['specialty']) ? $_GET['specialty'] : '';
$date = isset($_GET['date']) ? $_GET['date'] : '';

$sql = "SELECT id, name, country, specialty, available_date FROM doctors WHERE 1=1";

if (!empty($search)) {
    $sql .= " AND country LIKE '%" . $conn->real_escape_string($search) . "%'";
}

if (!empty($specialty)) {
    $sql .= " AND specialty = '" . $conn->real_escape_string($specialty) . "'";
}

if (!empty($date)) {
    $sql .= " AND available_date = '" . $conn->real_escape_string($date) . "'";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Your Doctor</title>
    <link rel="stylesheet" href="doctorsStyle.css">
</head>
<body>
    <div class="container">
        <div class="search-box">
            <h2>Find Your Doctor</h2>
            <form method="GET" action="">
                <input type="text" placeholder="*" name="search" value="<?php echo htmlspecialchars($search); ?>">
                <select name="specialty">
                    <option value="">Select Specialty</option>
                    <option value="Visa Medical" <?php if ($specialty == 'Visa Medical') echo 'selected'; ?>>Visa Medical</option>
                    <!-- Add more options as needed -->
                </select>
                <input type="date" name="date" value="<?php echo htmlspecialchars($date); ?>">
                <button type="submit">Find Your Doctor</button>
            </form>
        </div>
        <div class="results">
    <?php if ($result && $result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="doctor-card">
                <p><strong>ID:</strong> <?php echo htmlspecialchars($row['id']); ?></p>
                <p><strong>Name:</strong> <?php echo htmlspecialchars($row['name']); ?></p>
                <p><strong>Country:</strong> <?php echo htmlspecialchars($row['country']); ?></p>
                <p><strong>Specialty:</strong> <?php echo htmlspecialchars($row['specialty']); ?></p>
                <p><strong>Available Date:</strong> <?php echo htmlspecialchars($row['available_date']); ?></p>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No doctors found.</p>
    <?php endif; ?>
</div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
