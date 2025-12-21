              // Enable / Disable Continue button
const userType = document.getElementById("userType");
const continueBtn = document.getElementById("continueBtn");

userType.addEventListener("change", function () {
    continueBtn.disabled = this.value === "";
});

// Handle form submit
document.querySelector(".login__form").addEventListener("submit", function (event) {
    event.preventDefault(); // needed because we use JS redirect

    switch (userType.value) {
        case "admin":
            window.location.href = "admin/admin_login.php";
            break;

        case "owner":
            window.location.href = "owner/owner_login.php";
            break;

        case "employee":
            window.location.href = "employee/employeelogin.php";
            break;

        case "tenant":
            window.location.href = "tenant/tenant_login.php";
            break;

        default:
            alert("Please select a user type");
    }
});
