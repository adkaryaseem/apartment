<?php
include ('./config.php');

$conn = connect();

$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $contact = $conn->real_escape_string($_POST['contact']);

    $sql = "INSERT INTO enquiries (name, email, contact) VALUES ('$name', '$email', '$contact')";

    if ($conn->query($sql) === TRUE) {
        $success_message = "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enquiry Form</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:700">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="./images/logo-no-bg.png" type="image/x-icon">
    <link rel="stylesheet" href="./style/style-enquire.css">
</head>
<body>
    <div class="background">
        <div class="container">
            <div class="screen">
                <div class="screen-header">
                    <div class="screen-header-left">
                        <div class="screen-header-button close"></div>
                        <div class="screen-header-button maximize"></div>
                        <div class="screen-header-button minimize"></div>
                    </div>
                    <div class="screen-header-right">
                        <div class="screen-header-ellipsis"></div>
                        <div class="screen-header-ellipsis"></div>
                        <div class="screen-header-ellipsis"></div>
                    </div>
                </div>
                <div class="screen-body">
                    <div class="screen-body-item">
                        <div class="app-title">
                            <span>ENQUIRY</span>
                            <span>FORM</span>
                        </div>
                              <!-- Success message -->                       
                                <?php if (!empty($success_message)): ?>
                                    <div id="successAlert">
                                      <?php echo htmlspecialchars($success_message, ENT_QUOTES); ?> 
                                      </div>
                                      <script>
                                          //alert("<?php echo $success_message; ?>");
                                          setTimeout(function () {
                                            document.getElementById("successAlert").remove();
                                          }, 2000);
                                      </script>
                                  <?php endif; ?>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div class="app-form-group">
                                <input type="text" class="app-form-control" id="name" name="name" placeholder="Name" required>
                            </div>
                            <div class="app-form-group">
                                <input type="email" class="app-form-control" id="email" name="email" placeholder="Email" required>
                            </div>
                            <div class="app-form-group">
                                <input type="tel" class="app-form-control" id="contact" name="contact" placeholder="Contact" required>
                            </div>
                            <div class="app-form-group buttons submit">
                            <input type="submit" class="app-form-button" value="Submit">
                            <a href="./" class="app-form-button return">Return</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
