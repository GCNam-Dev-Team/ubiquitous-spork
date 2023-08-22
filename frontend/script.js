let rates = null;
console.log("Rates: ", rates);

document.getElementById("rateForm").addEventListener("submit", function (e) {
  e.preventDefault();

  rates = null;

  if (!rates) {
    // Show loader and hide the results
    document.getElementById("loader").style.display = "block";
    document.getElementById("results").style.display = "none";
  }

  const unitName = document.getElementById("unitName").value;
  const arrival = document.getElementById("arrival").value;
  const departure = document.getElementById("departure").value;
  const occupants = document.getElementById("occupants").value;
  const ages = document
    .getElementById("ages")
    .value.split(",")
    .map((age) => parseInt(age.trim()));

  const payload = {
    "Unit Name": unitName,
    Arrival: arrival,
    Departure: departure,
    Occupants: parseInt(occupants),
    Ages: ages,
  };

  fetch("http://localhost/assignment_app/api/index.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(payload),
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      return response.json();
    })
    .then((data) => {
      rates = data;
      // Show results and hide the loader
      document.getElementById("results").style.display = "block";
      document.getElementById("loader").style.display = "none";

      displayResult();
    })
    .catch((err) => {
      // Hide the results and loader
      document.getElementById("results").style.display = "none";
      document.getElementById("loader").style.display = "none";

      console.error("Error:", err);
      document.getElementById("results").innerText =
        "An error occurred while fetching data. Please try again.";
    });
  console.log("Rates 2: ", rates);
});

function displayResult() {
  if (rates) {
    const leg = rates.Legs[0]; //first item in the list of leg items
    const unitName = leg["Special Rate Description"].split("-").pop().trim(); // Extracting the unit name from the description
    const rate = leg["Effective Average Daily Rate"];
    const availability =
      leg["Error Code"] === 0 ? "Available" : "Not Available";
    const dateRange = `${rates.DateRange.Arrival} to ${rates.DateRange.Departure}`;
    document.getElementById("results").innerHTML = `
    <h4>Results</h4> 
<div class="card mt-4">

  <div class="card-body">
      <h5 class="card-title">${unitName}</h5>
      <p class="card-text">
          <strong>Rate:</strong> ${rate} NAD<br/>
          <strong>Date Range:</strong> ${dateRange}<br/>
          <strong>Availability:</strong> ${availability}
      </p>
  </div>
</div>
`;
  }
}
