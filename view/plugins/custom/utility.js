document.addEventListener("DOMContentLoaded", function () {
    const numCandidatesField = document.getElementById("numCandidatesCaptured");
    const schoolTypeField = document.getElementById("schoolType");
    const remittanceField = document.getElementById("remittanceDue");
    const schoolNameField = document.getElementById("schoolName");

    // Function to calculate remittance
    function calculateRemittance() {
        const numCandidates = parseInt(numCandidatesField.value) || 0; // Default to 0 if invalid
        const schoolType = schoolTypeField.value.trim(); // Get the school type

        // Determine the rate based on the school type
        let ratePerCandidate = 0;
        if (schoolType === "Public") {
            ratePerCandidate = 280; // Rate for Public schools
        } else if (schoolType === "Private") {
            ratePerCandidate = 130; // Rate for Private schools
        } else {
            remittanceField.value = "Enter Number of Candidates Captured";
            return; // Exit if school type is invalid
        }

        // Calculate the remittance due
        const remittanceDue = numCandidates * ratePerCandidate;

        // Update the remittance field
        remittanceField.value = remittanceDue.toLocaleString("en-NG", {
            style: "currency",
            currency: "NGN",
            minimumFractionDigits: 2,
        });
    }

    // Function to handle changes in schoolName
    function updateSchoolType() {
        const selectedOption = schoolNameField.options[schoolNameField.selectedIndex];
        const schoolType = selectedOption.dataset.schoolType || ""; // Fetch the school type from a custom data attribute
        schoolTypeField.value = schoolType; // Update the schoolType field

        // Reset the number of candidates field to 0
        numCandidatesField.value = 0;

        // Recalculate the remittance (which will show as 0 initially)
        calculateRemittance();
    }

    // Attach event listeners to all relevant fields
    if (numCandidatesField && schoolTypeField && remittanceField && schoolNameField) {
        numCandidatesField.addEventListener("input", calculateRemittance); // Recalculate when numCandidatesCaptured changes
        schoolTypeField.addEventListener("input", calculateRemittance); // Recalculate when schoolType changes
        schoolNameField.addEventListener("change", updateSchoolType); // Update schoolType, reset numCandidates, and recalculate when schoolName changes
    } else {
        console.error("Required form fields are missing.");
    }
});



    // Password strength validation
    const newPasswordInput = document.getElementById("newPassword");
    const confirmPasswordInput = document.getElementById("confirmPassword");
    const passwordStrength = document.getElementById("passwordStrength");
    const passwordMatch = document.getElementById("passwordMatch");

    // Regular expression for password validation
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/;

    newPasswordInput.addEventListener("input", () => {
        const password = newPasswordInput.value;

        // Check password strength
        if (!password) {
            passwordStrength.innerHTML = "";
        } else if (passwordRegex.test(password)) {
            passwordStrength.innerHTML = "<span style='color: green;'>Strong Password</span>";
        } else {
            passwordStrength.innerHTML = "<span style='color: red;'>Password does not meet the required criteria</span>";
        }

        // Check if passwords match
        checkPasswordMatch();
    });

    confirmPasswordInput.addEventListener("input", checkPasswordMatch);

    function checkPasswordMatch() {
        const newPassword = newPasswordInput.value;
        const confirmPassword = confirmPasswordInput.value;

        if (!confirmPassword) {
            passwordMatch.innerHTML = "";
        } else if (newPassword === confirmPassword) {
            passwordMatch.innerHTML = "<span style='color: green;'>Passwords match</span>";
        } else {
            passwordMatch.innerHTML = "<span style='color: red;'>Passwords do not match</span>";
        }
    }

    // Final form validation before submission
    document.getElementById("changePasswordForm").addEventListener("submit", function (event) {
        const newPassword = newPasswordInput.value;
        const confirmPassword = confirmPasswordInput.value;

        if (!passwordRegex.test(newPassword)) {
            event.preventDefault();
            alert("Your new password does not meet the required criteria.");
        } else if (newPassword !== confirmPassword) {
            event.preventDefault();
            alert("New password and confirm password do not match.");
        }
    });
