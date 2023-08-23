<!DOCTYPE html>
<html>
<head>
    <title>Unit Booking</title>
</head>
<body>
    <h1>Unit Booking Form</h1>
    <form id="booking-form">
        <label for="unit-name">Unit Name:</label>
        <input type="text" id="unit-name" name="unit-name" required><br>

        <label for="arrival">Arrival Date:</label>
        <input type="date" id="arrival" name="arrival" required><br>

        <label for="departure">Departure Date:</label>
        <input type="date" id="departure" name="departure" required><br>

        <label for="occupants">Occupants:</label>
        <input type="number" id="occupants" name="occupants" required><br>

        <label for="ages">Ages (comma-separated):</label>
        <input type="text" id="ages" name="ages" required><br>

        <button type="submit">Submit</button>
    </form>

    <h2>Response:</h2>
    <div id="response"></div>

    <script>
        document.getElementById("booking-form").addEventListener("submit", async function(event) {
            event.preventDefault();

            const unitName = document.getElementById("unit-name").value;
            const arrival = document.getElementById("arrival").value;
            const departure = document.getElementById("departure").value;
            const occupants = parseInt(document.getElementById("occupants").value);
            const ages = document.getElementById("ages").value.split(",").map(Number);

            const payload = {
                "Unit Name": unitName,
                "Arrival": arrival,
                "Departure": departure,
                "Occupants": occupants,
                "Ages": ages
            };

            const response = await fetch('api.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(payload)
            });

            const responseData = await response.json();
            const responseDiv = document.getElementById("response");
            responseDiv.innerHTML = `<p>Unit Name: ${unitName}</p><p>Rate: ${responseData.rate}</p><p>Date Range: ${arrival} to ${departure}</p>`;
        });
    </script>
</body>
</html>
