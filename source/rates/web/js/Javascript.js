flatpickr("#arrival", {
	dateFormat: "Y-m-d", // Specify your desired date format
	enableTime: false, // Disable time selection
	allowInput: true // Allow manual input
});

flatpickr("#departure", {
	dateFormat: "Y-m-d", // Specify your desired date format
	enableTime: false, // Disable time selection
	allowInput: true // Allow manual input
});

async function fetchAndDisplayData() {
	const loader = document.getElementById("loader");
	const url = "http://localhost/ubiquitous-spork-fillipus/source/rates/api/Get.php";

    var unitName = document.getElementById("unitName").value;
    var arrival = document.getElementById("arrival").value;
    var departure = document.getElementById("departure").value;
    var occupants = document.getElementById("occupants").value;
    var ages = document.getElementById("ages").value;

    if(unitName === null || unitName === "")
    {
      alert("Please enter unit name");
      return;
    }
    if(arrival === null || arrival === "")
    {
      alert("Please enter arrival date");
      return;
    }
    if(departure === null || departure === "")
    {
      alert("Please enter departure date");
      return;
    }
    if(occupants === null || occupants === "")
    {
      alert("Please enter number of occupants");
      return;
    }

    if(ages === null || ages === "")
    {
      alert("Please enter the ages");
      return;
    }
    
	const requestData = {
		"Unit Name": unitName,
		"Arrival": arrival,
		"Departure": departure,
		"Occupants": occupants,
		"Ages": ages.split(',').map(value => Number(value.trim()))
	};

	try {
		loader.style.display = "block"; // Display the loader
		const response = await fetch(url, {
			method: "POST",
			body: JSON.stringify(requestData),
			headers: {
				"Content-Type": "application/json"
			}
		});

		const responseData = await response.json();
		fillTables(responseData);
		document.getElementById("_data").hidden = false;
	} catch (error) {
		alert("Error calling API " +error);
	} finally {
		loader.style.display = "none"; 
	}
}

function fillTables(data) {
	document.getElementById("location-id").textContent = data["Location ID"];
	document.getElementById("total-charge").textContent = data["Total Charge"];
	document.getElementById("booking-group-id").textContent = data["Booking Group ID"];
	document.getElementById("rooms").textContent = data["Rooms"];

	const legsTable = document.getElementById("legs");
	const depositBreakdownTable = document.getElementById("deposit-breakdown");
	const guestsTable = document.getElementById("guests");

    

	const legs = data.Legs[0];

	for (const key in legs) {
		if (legs.hasOwnProperty(key) && key !== "Deposit Breakdown" && key !== "Guests" && key !== "Child Ages") {
			const row = legsTable.insertRow();
			const cell1 = row.insertCell(0);
			const cell2 = row.insertCell(1);
			cell1.textContent = key;
			cell2.textContent = JSON.stringify(legs[key]);
		}
	}

	const depositBreakdown = legs["Deposit Breakdown"][0];

	for (const key in depositBreakdown) {
		if (depositBreakdown.hasOwnProperty(key)) {
			const row = depositBreakdownTable.insertRow();
			const cell1 = row.insertCell(0);
			const cell2 = row.insertCell(1);
			cell1.textContent = key;
			//cell2.textContent = JSON.stringify(depositBreakdown[key]);
		}
	}

	const guests = legs["Guests"];

	for (const guest of guests) {
		const row = guestsTable.insertRow();
		const ageGroupCell = row.insertCell(0);
		const ageCell = row.insertCell(1);
		const errorMessageCell = row.insertCell(2);
		const categoryCell = row.insertCell(3);
		ageGroupCell.textContent = guest["Age Group"];
		ageCell.textContent = guest["Age"];
		errorMessageCell.textContent = guest["Error Message"];
		categoryCell.textContent = guest["Category"];
	}

}
