<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbxpertevents";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
function getAllPackages() {
    global $conn;
    $sql = "SELECT * FROM packages";
    $result = $conn->query($sql);
    $packages = $result->fetch_all(MYSQLI_ASSOC);
    return $packages;
}

function getPackageById($id) {
    global $conn;

    $sql = "SELECT * FROM packages WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $package = $result->fetch_assoc();
        $stmt->close();
        return $package;
    } else {
        $stmt->close();
        return null;
    }
}

function addPackage($title, $description, $price, $image) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO packages (title, description, price, image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $title, $description, $price, $image);
    $stmt->execute();
    return $stmt->insert_id;
}

function updatePackage($id, $title, $description, $price, $image) {
    global $conn;
    $stmt = $conn->prepare("UPDATE packages SET title=?, description=?, price=?, image=? WHERE id=?");
    $stmt->bind_param("ssdsi", $title, $description, $price, $image, $id);
    $stmt->execute();
    return $stmt->affected_rows;
}


function deletePackage($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM packages WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->affected_rows;
}

function getEvents() {
    global $conn;

    $sql = "SELECT id, title, description, image, user_id, package_id, date FROM events ORDER BY date DESC";

    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        echo "Error preparing statement: " . $conn->error;
        return array();
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $events = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $events[] = $row;
        }
    }

    $stmt->close();

    return $events;
}


function getEventById($event_id)
{
    global $conn;
    $sql = "SELECT * FROM events WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $event = $result->fetch_assoc();
    $stmt->close();
    return $event;
}
function getUserBookings($user_id) {
    global $conn;
    $sql = "SELECT bookings.id, events.title as event_title, bookings.name, bookings.email, bookings.phone, bookings.booking_date FROM bookings INNER JOIN events ON bookings.event_id = events.id WHERE bookings.user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $bookings = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $bookings[] = $row;
        }
    }
    return $bookings;
}

function getAllBookings() {
    global $conn;
    $sql = "SELECT bookings.id, events.title as event_title, bookings.name, bookings.email, bookings.phone, bookings.booking_date, CONCAT(users.name, ' (', users.email, ')') as client_name FROM bookings INNER JOIN events ON bookings.event_id = events.id INNER JOIN users ON bookings.user_id = users.id";
    $result = $conn->query($sql);

    $bookings = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $bookings[] = $row;
        }
    }
    return $bookings;
}
function getAllMessages() {
    global $conn;

    $sql = "SELECT * FROM messages";
    $result = $conn->query($sql);

    $messages = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $messages[] = $row;
        }
    }

    return $messages;
}
function getUserData($user_id) {
    global $conn;
    $stmt = $conn->prepare("SELECT name, email, password FROM users WHERE id=?");

    if ($stmt === false) {
        echo "Error: " . $conn->error;
        exit;
    }

    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row;
}
// Add a new guest invitation
function addGuestInvitation($event_id, $name, $email, $attending) {
    global $conn;

    $sql = "INSERT INTO guest_invitations (event_id, name, email, attending_status) VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo "Error preparing statement: " . $conn->error;
        return false;
    }

    $stmt->bind_param("isss", $event_id, $name, $email, $attending);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
}

// Get all guest invitations for a specific event
function getGuestInvitations($event_id) {
    global $conn;

    $sql = "SELECT id, event_id, name, email, attending_status FROM guest_invitations WHERE event_id = ?";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo "Error preparing statement: " . $conn->error;
        return array();
    }

    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $guest_invitations = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $guest_invitations[] = $row;
        }
    }

    $stmt->close();

    return $guest_invitations;
}

function getGuestInvitationById($id) {
    global $conn;

    $sql = "SELECT * FROM guest_invitations WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo "Error preparing statement: " . $conn->error;
        return array();
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    $guest_invitation = $result->fetch_assoc();

    $stmt->close();

    return $guest_invitation;
}

// Update guest invitation details
function updateGuestInvitation($id, $name, $email, $attending) {
    global $conn;

    $sql = "UPDATE guest_invitations SET name = ?, email = ?, attending_status = ? WHERE id = ?";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo "Error preparing statement: " . $conn->error;
        return false;
    }

    $stmt->bind_param("sssi", $name, $email, $attending, $id);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
}

// Delete a guest invitation
function deleteGuestInvitation($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM guest_invitations WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->affected_rows;
}
?>
