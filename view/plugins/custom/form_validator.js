//Validate Membership form - Biodata

function validate_biodata() {
  if ($("#surname").val() == "") {
    alert("Surname Field is required");
    document.getElementById("surname").focus();
  } else if ($("#firstname").val() == "") {
    alert("Firstname Field is required");
    document.getElementById("firstname").focus();
  } else if ($("#gender").val() == "") {
    alert("Gender Field is required");
    document.getElementById("gender").focus();
  } else if ($("#dateofbirth").val() == "") {
    alert("Date of Birth Field is required");
    document.getElementById("dateofbirth").focus();
  } else if ($("#marital_status").val() == "") {
    alert("Marital Status Field is required");
    document.getElementById("marital_status").focus();
  } else if ($("#language").val() == "") {
    alert("Language Field is required");
    document.getElementById("language").focus();
  } else if ($("#geo_region").val() == "") {
    alert("Geographical Region Field is required");
    document.getElementById("geo_region").focus();
  } else if ($("#state_by_region").val() == "") {
    alert("State of Origin Field is required");
    document.getElementById("state_by_region").focus();
  } else {
    $("#validator_button").hide();
    document.getElementById("next_button").removeAttribute("hidden");
  }
}

function validate_contact() {
  if ($("#phonenumber").val() == "" && $("#phonenumber").length != 11) {
    alert("At least 1 contact phone number Field is required");
    document.getElementById("phonenumber").focus();
  } else if ($("#emailaddress").val() == "") {
    alert("Email Address Field is required");
    document.getElementById("emailaddress").focus();
  } else if ($("#nearest_busstop").val() == "") {
    alert("Nearest Bus Stop Field is required");
    document.getElementById("nearest_busstop").focus();
  } else if ($("#full_address").val() == "") {
    alert("Full Residential Address Field is required");
    document.getElementById("full_address").focus();
  } else if ($("#town").val() == "") {
    alert("Town / Area Field is required");
    document.getElementById("town").focus();
  } else if ($("#residence_country").val() == "") {
    alert("Country of Residence Field is required");
    document.getElementById("residence_country").focus();
  } else if ($("#selected_state").val() == "") {
    alert("State of Residence Field is required");
    document.getElementById("selected_state").focus();
  } else if ($("#lga_options").val() == "") {
    alert("Local Government Area of Residence Field is required");
    document.getElementById("lga_options").focus();
  } else {
    $("#validator_contact_button").hide();
    document.getElementById("next_contact_button").removeAttribute("hidden");
  }
}

function validate_church() {
  if ($("#year_joined").val() == "") {
    alert("Year Joined Field is required");
    document.getElementById("year_joined").focus();
  } else if ($("#current_rank").val() == "") {
    alert("Current Rank Field is required");
    document.getElementById("current_rank").focus();
  } else if ($("#grade_level").val() == "") {
    alert("Current Grade Level Field is required");
    document.getElementById("grade_level").focus();
  } else if ($("#npf_file_number").val() == "") {
    alert("Force / AP Number Field is required");
    document.getElementById("npf_file_number").focus();
  } else if ($("#tax_number").val() == "") {
    alert("Tax Identification Number Field is required");
    document.getElementById("tax_number").focus();
  } else if ($("#ippis_number").val() == "") {
    alert("IPPIS Number Field is required");
    document.getElementById("ippis_number").focus();
  } else if ($("#duty_post").val() == "") {
    alert("Duty Post Field is required");
    document.getElementById("duty_post").focus();
  } else if ($("#stateCommandSelector").val() == "") {
    alert("State Command Field is required");
    document.getElementById("stateCommandSelector").focus();
  } else if ($("#areaCommandSelector").val() == "") {
    alert("IArea Command Field is required");
    document.getElementById("areaCommandSelector").focus();
  } else if ($("#DivCommandSelector").val() == "") {
    alert("Divisional Police Station Field is required");
    document.getElementById("DivCommandSelector").focus();
  } else if ($("#qualification").val() == "") {
    alert("Education Qualification Field is required");
    document.getElementById("qualification").focus();
  } else {
    $("#validator_church_button").hide();
    document.getElementById("next_preview_button").removeAttribute("hidden");

    $("#preview_surname").attr("value", $("#surname").val());
    $("#preview_firstname").attr("value", $("#firstname").val());
    $("#preview_othername").attr("value", $("#othername").val());

    $("#preview_gender").attr("value", $("#gender").val());
    $("#preview_dob").attr("value", $("#dateofbirth").val());
    $("#preview_marital").attr("value", $("#marital_status").val());
    $("#preview_language").attr("value", $("#language").val());
    $("#preview_geo_region").attr("value", $("#geo_region").val());
    $("#preview_state_by_region").attr("value", $("#state_by_region").val());

    $("#preview_phone").attr("value", $("#phonenumber").val());
    $("#preview_alt_phone").attr("value", $("#alt_phonenumber").val());
    $("#preview_email").attr("value", $("#emailaddress").val());

    $("#preview_bstop").attr("value", $("#nearest_busstop").val());
    $("#preview_address").attr(
      "value",
      $("#full_address").val() + ", " + $("#town").val()
    );
    $("#preview_year_joined").attr("value", $("#year_joined").val());
    $("#preview_current_rank").attr("value", $("#current_rank").val());
    $("#preview_grade_level").attr("value", $("#grade_level").val());

    $("#preview_npf_file_number").attr("value", $("#npf_file_number").val());
    $("#preview_tax_number").attr("value", $("#tax_number").val());
    $("#preview_ippis_number").attr("value", $("#ippis_number").val());
    $("#preview_duty_post").attr("value", $("#duty_post").val());
    $("#preview_DivCommandSelector").attr("value", $("#DivCommandSelector").val());
    $("#preview_qualification").attr("value", $("#qualification").val());
  }
}

//Visitors Form Validator

function validate_visitors() {
  if ($("#surname").val() == "") {
    alert("Surname Field is required");
    document.getElementById("surname").focus();
  } else if ($("#firstname").val() == "") {
    alert("Firstname Field is required");
    document.getElementById("firstname").focus();
  } else if ($("#gender").val() == "") {
    alert("Gender Field is required");
    document.getElementById("gender").focus();
  } else if ($("#marital_status").val() == "") {
    alert("Marital Status Field is required");
    document.getElementById("marital_status").focus();
  } else if ($("#occupation").val() == "") {
    alert("Occupation Field is required");
    document.getElementById("occupation").focus();
  } else if ($("#phonenumber").val() == "") {
    alert("At least 1 valid contact phone number Field is required");
    document.getElementById("phonenumber").focus();
  } else if ($("#nearest_busstop").val() == "") {
    alert("Nearest Bus Stop Field is required");
    document.getElementById("nearest_busstop").focus();
  } else if ($("#full_address").val() == "") {
    alert("Full Residential Address Field is required");
    document.getElementById("full_address").focus();
  } else if ($("#town").val() == "") {
    alert("Town / Area Field is required");
    document.getElementById("town").focus();
  } else if ($("#residence_country").val() == "") {
    alert("Country of Residence Field is required");
    document.getElementById("residence_country").focus();
  } else if (
    ($("#residence_state-text").val() == "") &
    ($("#residence_state-select").val() == "")
  ) {
    alert("State of Residence Field is required");
    if (
      ($("#residence_country").val() != "") &
      ($("#residence_country").val() == "Nigeria")
    ) {
      document.getElementById("#residence_state-select").focus();
    } else if (
      ($("#residence_country").val() != "") &
      ($("#residence_country").val() != "Nigeria")
    ) {
      document.getElementById("#residence_state-text").focus();
    } else {
      document.getElementById("residence_country").focus();
    }
  } else if (
    ($("#residence_lga-text").val() == "") &
    ($("#residence_lga-select").val() == "")
  ) {
    alert("LGA of Residence Field is required");
    if (
      ($("#residence_country").val() != "") &
      ($("#residence_country").val() == "Nigeria")
    ) {
      document.getElementById("#residence_lga-select").focus();
    } else if (
      ($("#residence_country").val() != "") &
      ($("#residence_country").val() != "Nigeria")
    ) {
      document.getElementById("#residence_lga-text").focus();
    } else {
      document.getElementById("residence_country").focus();
    }
  } else if ($("#invited_by").val() == "") {
    alert("Invited by Field is required");
    document.getElementById("invited_by").focus();
  } else if ($("#service_type").val() == "") {
    alert("Service Type Field is required");
    document.getElementById("service_type").focus();
  } else if ($("#service_date").val() == "") {
    alert("Service Date Field is required");
    document.getElementById("service_date").focus();
  } else if ($("#current_assembly").val() == "") {
    alert("Current Assembly Field is required");
    document.getElementById("current_assembly").focus();
  } else if ($("#department").val() == "") {
    alert("Department Field is required");
    document.getElementById("department").focus();
  } else {
    $("#modal_submit_form").modal("show");
  }
}
