$(document).ready(function () {
    //Define availability elements
    var availability_status = document.getElementById('status');

    // Define rate element
    var rate = document.getElementById('rate');
    // Define amount due element
    var amount_due = document.getElementById('amount_due');
    // Define date range element
    var date_range = document.getElementById('date_range');
    // Define departure input element
    var departure_date = document.getElementById('departure');
    // Define arrival input element
    var arrival_date = document.getElementById('arrival');
    // Define occupants input element
    var occupants = document.getElementById('occupants');
    // Define age input elements
    var occupants_ages = document.getElementsByName('ages[]');
    // Define unit name input element
    var unitName = document.getElementById('unit_name');
    // 
    var unit_name_result = document.getElementById('unit_name_result');
    // 
    var button_icon = document.getElementById('btnIcon');


    //CHECK AVAILABILITY
    function checkAvailability(roomCount) {
        if (roomCount <= 0) {
            availability_status.classList.remove('fa-check');
            availability_status.classList.remove('text-success');
            availability_status.classList.add('fa-remove');
            availability_status.classList.add('text-danger');
        }
    }

    //Listen to modify button events
    $("#modifyBtn").click(function () {
        $(".main_panel").slideDown("slow");
        $(".result_panel").fadeToggle("slow");
        $('#modifyBtn').hide();
        $('#searchBtn').show();
    });



    //Create new age input dynamically.
    function addAgeInput() {

        var inputField = document.createElement('input');
        var ageInputDiv = document.getElementById('ageInputDiv');
        var addButton = document.getElementById('addAgeBtn');

        inputField.setAttribute('class', 'form-control');
        inputField.setAttribute('name', 'ages[]');
        inputField.setAttribute('type', 'number');
        inputField.setAttribute('placeholder', 'Age');

        ageInputDiv.insertBefore(inputField, addButton);

    }

    //Create array from Dom collection before submitting
    function createAgeArray(dom_collection) {
        let ages_array = [];
        for (let i = 0; i < dom_collection.length; i++) {
            ages_array.push(dom_collection[i].value);
        }
        
        return ages_array;
    }


    $("#addAgeBtn").click(function () {
        addAgeInput();
    });


    $(".searchBtn").click(function () {

        button_icon.setAttribute('class', 'fa fa-spinner fa-spin');

        //Hide/Show some elements during submission
        function onResponse(json_result) {
            checkAvailability(json_result['Rooms']);
            $(".main_panel").slideUp("slow");
            $(".result_panel").fadeToggle("slow");
            $('#searchBtn').hide();
            $('#modifyBtn').show();
            button_icon.setAttribute('class', '');
        }

        //Update Result Div after response ftrom remote APi
        function updateResult(json_result) {

            date_range.innerText = arrival_date.value + " - " + departure_date.value;
            rate.innerText = "N$ " + json_result['Legs'][0]['Effective Average Daily Rate'];
            amount_due.innerText = "N$ " + json_result['Legs'][0]['Deposit Breakdown'][0]['Due Amount'];
            unit_name_result.innerText = unit_name.value;
        }

        //Send Ajax Post Request
        $.ajax({
            type: 'POST',
            url: 'Rates.php',
            data: JSON.stringify({
                unit_name: unitName.value,
                arrival: arrival_date.value,
                ages: createAgeArray(occupants_ages),
                departure: departure.value,
                occupants: occupants.value
            }),
            success: function (data) {
                const response = jQuery.parseJSON(data);
                const json_result = JSON.parse(data);
                
                onResponse(json_result);
                updateResult(json_result)
            },
            contentType: "application/json",
            dataType: 'json'
        });
    });

});
