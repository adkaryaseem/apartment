<?php
include('../auth.php');
include('../config.php');

$conn = connect();
$total_slots = 20;

// --- Handle AJAX slot allotment ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['slotNumber'], $_POST['employeeId'])) {
    $slotNumber = (int)$_POST['slotNumber'];
    $employeeId = (int)$_POST['employeeId'];

    // Check if slot is already allocated
    $checkSlot = $conn->prepare("SELECT * FROM parking_slot WHERE slot_number = ?");
    $checkSlot->bind_param("i", $slotNumber);
    $checkSlot->execute();
    $checkSlot->store_result();
    if ($checkSlot->num_rows > 0) {
        echo "Error: Slot already allocated!";
        exit;
    }
    $checkSlot->close();

    // Check if employee already has a slot
    $checkEmp = $conn->prepare("SELECT * FROM parking_slot WHERE owner_id = ?");
    $checkEmp->bind_param("i", $employeeId);
    $checkEmp->execute();
    $checkEmp->store_result();
    if ($checkEmp->num_rows > 0) {
        echo "Error: Employee already has a slot!";
        exit;
    }
    $checkEmp->close();

    // Insert allocation
    $stmt = $conn->prepare("INSERT INTO parking_slot (slot_number, owner_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $slotNumber, $employeeId);
    if ($stmt->execute()) {
        echo "Parking slot allotted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    exit;
}

// --- Fetch employees without slot for dropdown ---
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['getEmployees'])) {
    $sql = "
        SELECT e.employee_id, e.first_name, e.last_name
        FROM employee e
        LEFT JOIN parking_slot p ON e.employee_id = p.owner_id
        WHERE p.owner_id IS NULL AND e.status='active'
    ";
    $result = $conn->query($sql);
    $employees = [];
    while ($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
    echo json_encode($employees);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Parking Slots</title>
<link rel="stylesheet" href="../style/style-parkingslot.css">
<style>
.allocated { background-color: #f08080; cursor: not-allowed; }
.available { background-color: #90ee90; cursor: pointer; }
.popup { display: none; position: fixed; top: 50%; left: 50%; 
         transform: translate(-50%, -50%); background: #fff; 
         padding: 20px; border-radius: 10px; box-shadow: 0 0 10px #000; }
</style>
</head>
<body>
<h2 class="return"><a href="./">Return Home</a></h2>
<h2>Parking Slots</h2>
<table border="1" cellpadding="10">
<tr>
    <th>Parking Slot ID</th>
    <th>Status</th>
    <th>Employee Name</th>
</tr>
<?php
for ($i = 1; $i <= $total_slots; $i++) {
    $stmt = $conn->prepare("
        SELECT p.owner_id, e.first_name, e.last_name
        FROM parking_slot p
        LEFT JOIN employee e ON p.owner_id = e.employee_id
        WHERE p.slot_number = ?
    ");
    $stmt->bind_param("i", $i);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $allocated = $row ? true : false;
    $status_class = $allocated ? 'allocated' : 'available';
    $status_text = $allocated ? 'Allocated' : 'Available';
    $employee_name = $allocated ? $row['first_name'] . ' ' . $row['last_name'] : '-';

    echo "<tr>";
    echo "<td>$i</td>";
    if ($allocated) {
        echo "<td class='$status_class'>$status_text</td>";
    } else {
        echo "<td class='$status_class' onclick='openPopup($i)'>$status_text</td>";
    }
    echo "<td>$employee_name</td>";
    echo "</tr>";

    $stmt->close();
}
$conn->close();
?>
</table>

<div class="popup" id="allotPopup">
<h3>Allot Parking Slot</h3>
<form id="allotForm" onsubmit="allotSlot(event)">
    <label>Select Employee:</label>
    <select id="employeeId" name="employeeId" required></select>
    <br><br>
    <button type="submit">Allot Slot</button>
    <button type="button" class="cancel" onclick="closePopup()">Cancel</button>
</form>
</div>

<script>
function openPopup(slotNumber) {
    const popup = document.getElementById('allotPopup');
    popup.style.display = 'block';
    popup.setAttribute('data-slot', slotNumber);
    populateEmployees();
}

function closePopup() {
    document.getElementById('allotPopup').style.display = 'none';
}

function populateEmployees() {
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const employees = JSON.parse(xhr.responseText);
            const select = document.getElementById('employeeId');
            select.innerHTML = '';
            if (employees.length === 0) {
                const option = document.createElement('option');
                option.value = '';
                option.textContent = 'No employees available';
                select.appendChild(option);
            } else {
                employees.forEach(emp => {
                    const option = document.createElement('option');
                    option.value = emp.employee_id;
                    option.textContent = emp.first_name + ' ' + emp.last_name;
                    select.appendChild(option);
                });
            }
        }
    };
    xhr.open('GET', '?getEmployees=1', true);
    xhr.send();
}

function allotSlot(event) {
    event.preventDefault();
    const slotNumber = document.getElementById('allotPopup').getAttribute('data-slot');
    const employeeId = document.getElementById('employeeId').value;

    if (!slotNumber || !employeeId) {
        alert('Please select a slot and an employee.');
        return;
    }

    const params = `slotNumber=${encodeURIComponent(slotNumber)}&employeeId=${encodeURIComponent(employeeId)}`;
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            alert(xhr.responseText);
            if (xhr.status === 200) location.reload();
        }
    };
    xhr.open('POST', '', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(params);

    closePopup();
}

// ESC key closes popup
document.addEventListener('keydown', (e) => {
    if (e.key === "Escape") closePopup();
});
</script>
</body>
</html>
