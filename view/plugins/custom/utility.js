function switch_location() {
    var country = document.getElementById("assembly_country");
    var selectedValue = country.options[country.selectedIndex].value;

    if (selectedValue == "Nigeria") {
        $('#select-state').show();
        $('#select-lga').show();
        $('#type-state').hide();
        $('#type-lga').hide();
        $('#assembly_state-select').attr('required', 'yes');
        $('#assembly_state-select').attr('name', 'assembly_state');
        $('#assembly_state-select').attr('data-error', 'Assembly State is required.');
        $('#assembly_lga-select').attr('required', 'yes');
        $('#assembly_lga-select').attr('name', 'assembly_lga');
        $('#assembly_lga-select').attr('data-error', 'Assembly LGA is required.');
        document.getElementById("assembly_state-text").removeAttribute("name");
        document.getElementById("assembly_state-text").removeAttribute("required");
        document.getElementById("assembly_lga-text").removeAttribute("name");
        document.getElementById("assembly_lga-text").removeAttribute("required");
    }
    else if (selectedValue != "Nigeria") {
        $('#select-state').hide();
        $('#select-lga').hide();
        $('#type-state').show();
        $('#type-lga').show();
        $('#assembly_state-text').attr('required', 'yes');
        $('#assembly_state-text').attr('name', 'assembly_state');
        $('#assembly_state-text').attr('data-error', 'Assembly State is required.');
        $('#assembly_lga-text').attr('required', 'yes');
        $('#assembly_lga-text').attr('name', 'assembly_lga');
        $('#assembly_lga-text').attr('data-error', 'Assembly LGA is required.');
        document.getElementById("assembly_state-select").removeAttribute("name");
        document.getElementById("assembly_state-select").removeAttribute("required");
        document.getElementById("assembly_lga-select").removeAttribute("name");
        document.getElementById("assembly_lga-select").removeAttribute("required");
    }
    else {
        alert("Select Assembly Country");
        $('#select-state').hide();
        $('#select-lga').hide();
        $('#type-state').hide();
        $('#type-lga').hide();
    }
}


function switch_state() {
    var country = document.getElementById("nationality");
    var selectedValue = country.options[country.selectedIndex].value;

    if (selectedValue == "Nigeria") {

        $('#select-state_of_origin').show();
        $('#type-state_of_origin').hide();

        $('#state_of_origin-select').attr('required', 'yes');
        $('#state_of_origin-select').attr('name', 'state_of_origin');
        $('#state_of_origin-select').attr('data-error', ' State of Origin is required.');
        document.getElementById("state_of_origin-text").removeAttribute("name");
        document.getElementById("state_of_origin-text").removeAttribute("required");
    }
    else if (selectedValue != "Nigeria") {

        $('#select-state_of_origin').hide();
        $('#type-state_of_origin').show();

        $('#state_of_origin-text').attr('required', 'yes');
        $('#state_of_origin-text').attr('name', 'state_of_origin');
        $('#state_of_origin-text').attr('data-error', ' State of Origin is required.');
        document.getElementById("state_of_origin-select").removeAttribute("name");
        document.getElementById("state_of_origin-select").removeAttribute("required");
    }
    else {
        alert("Select Nationality");
        $('#select-state_of_origin').hide();
        $('#type-state_of_origin').hide();
    }
}


function switch_residence() {
    var country = document.getElementById("residence_country");
    var selectedValue = country.options[country.selectedIndex].value;

    if (selectedValue == "Nigeria") {

        $('#select-residence_state').show();
        $('#select-residence_lga').show();
        $('#type-residence_state').hide();
        $('#type-residence_lga').hide();

        
        $('#residence_state-select').attr('required', 'yes');
        $('#residence_state-select').attr('name', 'residence_state');
        $('#residence_state-select').attr('data-error', 'State of Residence is required.');
        
        $('#residence_lga-select').attr('required', 'yes');
        $('#residence_lga-select').attr('name', 'residence_lga');
        $('#residence_lga-select').attr('data-error', ' LGA of Residence is required.');
        
        
        document.getElementById("residence_state-text").removeAttribute("name");
        document.getElementById("residence_state-text").removeAttribute("required");
        document.getElementById("residence_lga-text").removeAttribute("name");
        document.getElementById("residence_lga-text").removeAttribute("required");
    }
    else if (selectedValue != "Nigeria") {
        $('#select-residence_state').hide();
        $('#select-residence_lga').hide();
        $('#type-residence_state').show();
        $('#type-residence_lga').show();

        
        $('#residence_state-text').attr('required', 'yes');
        $('#residence_state-text').attr('name', 'residence_state');
        $('#residence_state-text').attr('data-error', 'State of Residence is required.');
        
        $('#residence_lga-text').attr('required', 'yes');
        $('#residence_lga-text').attr('name', 'residence_lga');
        $('#residence_lga-select').attr('data-error', ' LGA of Residence is required.');
        
        
        document.getElementById("residence_state-select").removeAttribute("name");
        document.getElementById("residence_state-select").removeAttribute("required");
        document.getElementById("residence_lga-select").removeAttribute("name");
        document.getElementById("residence_lga-select").removeAttribute("required");
    }
    else {
        alert("Select Country of Residency");
        $('#select-residence_state').hide();
        $('#select-residence_lga').hide();
        $('#type-residence_state').hide();
        $('#type-residence_lga').hide();
    }
}


$(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });


  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()



    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

  })
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })


var loadFile = function(event) {
var image = document.getElementById('output');
var passport = document.getElementById('passport');
image.src = URL.createObjectURL(event.target.files[0]);
document.getElementById("next_biodata_button").removeAttribute("hidden");
passport.src = URL.createObjectURL(event.target.files[0]);
};


$(function () {
  $('.select2').select2()
});

function validatePhoneNumber(input_str) {
  var re = /^\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/;
  return re.test(input_str);
}

function switch_assignment_details(){
  var role_type = document.getElementById("role_type");
  var selectedValue = role_type.options[role_type.selectedIndex].value;

  if (selectedValue == 1) {
  
  $('#national_role_box').show();
  $('#region_role_box').hide();
  $('#assembly_role_box').hide();
  $('#region_role_box1').hide();
  $('#assembly_role_box1').hide();

  $('#residence_state-select').attr('required', 'yes');
  $('#residence_state-select').attr('name', 'residence_state');
  $('#residence_state-select').attr('data-error', 'State of Residence is required.');

  }else if(selectedValue == 2) {
    
    $('#national_role_box').hide();
    $('#region_role_box').show();
    $('#assembly_role_box').hide();
    $('#region_role_box1').show();
    $('#assembly_role_box1').hide();
  
    $('#region_role').attr('required', 'yes');
    $('#region_role').attr('name', 'residence_state');
    $('#region_role').attr('data-error', 'Region is required.');

  }else if(selectedValue == 3) {
    
    $('#national_role_box').hide();
    $('#region_role_box').hide();
    $('#assembly_role_box').show();
    $('#region_role_box1').hide();
    $('#assembly_role_box1').show();

    $('#region_role').attr('required', 'yes');
    $('#region_role').attr('name', 'role_place');
    $('#region_role').attr('data-error', 'Region is required.');
  }
}