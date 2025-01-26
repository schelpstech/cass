function fetch_state_by_region() {
    var selected_item = $("#geo_region").val();
    var action = 'fetch_state_by_region';
    if (selected_item != "") {
        $.ajax({
            url: "../../app/ajax_query.php",
            method: "POST",
            data: {
                selected_item: selected_item,
                action: action,
            },
            success: function (data) {
                $("#state_by_region").html(data);
            },
        });
    } else {
        alert("Select State");
    }
}

function fetch__lga() {
    var selected_item = $("#selected_state").val();
    var action = 'fetchlga';
    if (selected_item != "") {
        $.ajax({
            url: "../../app/ajax_query.php",
            method: "POST",
            data: {
                selected_item: selected_item,
                action: action,
            },
            success: function (data) {
                $("#lga_options").html(data);
            },
        });
    } else {
        alert("Select State");
    }
}

function fetchlga() {
    var selected_item = $("#assembly_state-select").val();
    var action = 'fetchlga';
    if (selected_item != "") {
        $.ajax({
            url: "../../app/ajax_query.php",
            method: "POST",
            data: {
                selected_item: selected_item,
                action: action,
            },
            success: function (data) {
                $("#assembly_lga-select").html(data);
            },
        });
    } else {
        alert("Select State");
    }
}

// Select School of Wisdom
function fetch_sow() {
    var selected_item = $("#current_assembly").val();
    var action = 'fetch_sow';
    if (selected_item != "") {
        $.ajax({
            url: "../../app/ajax_query.php",
            method: "POST",
            data: {
                selected_item: selected_item,
                action: action,
            },
            success: function (data) {
                $("#sunday_school").html(data);
            },
        });
    } else {
        alert("Select Assembly");
    }
}

function fetch_area_command() {
    var selected_item = $("#stateCommandSelector").val();
    var action = 'area_command_lookup';
    if (selected_item != "") {
        $.ajax({
            url: "../../app/ajax_query.php",
            method: "POST",
            data: {
                selected_item: selected_item,
                action: action,
            },
            success: function (data) {
                $("#areaCommandSelector").html(data);
            },
        });
    } else {
        alert("Select State Command");
    }
}

function fetch_Div_command() {
    var selected_item = $("#areaCommandSelector").val();
    var action = 'div_command_lookup';
    if (selected_item != "") {
        $.ajax({
            url: "../../app/ajax_query.php",
            method: "POST",
            data: {
                selected_item: selected_item,
                action: action,
            },
            success: function (data) {
                $("#DivCommandSelector").html(data);
            },
        });
    } else {
        alert("Select State Command");
    }
}