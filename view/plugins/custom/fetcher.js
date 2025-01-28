document.addEventListener("DOMContentLoaded", function () {
    const schoolNameField = document.getElementById("schoolName");
    const schoolTypeField = document.getElementById("schoolType");

    schoolNameField.addEventListener("change", function () {
        const selectedSchoolCode = this.value;

        if (selectedSchoolCode) {
            // Make an AJAX request to fetch the school type
            fetch('../../app/ajax_query.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ schoolCode: selectedSchoolCode }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        // Update the schoolType field
                        schoolTypeField.value = data.schoolType || "Unknown";
                    } else {
                        alert(data.message || "Error fetching school type");
                        schoolTypeField.value = "";
                    }
                })
                .catch((error) => {
                    console.error("Error fetching school type:", error);
                    alert("An error occurred. Please try again.");
                    schoolTypeField.value = "";
                });
        } else {
            schoolTypeField.value = ""; // Clear field if no school selected
        }
    });
});
