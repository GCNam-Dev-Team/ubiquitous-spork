document.addEventListener('DOMContentLoaded', function () {
  // Get reference to button
  const button = document.getElementById('get-rates-btn');

  // Add click handler 
  button.onclick = async () => {
    // Get form values
    const unitName = document.getElementById('unit-name').value;
    const arrival = document.getElementById('arrival').value;
    const departure = document.getElementById('departure').value;
    const occupants = parseInt(document.getElementById('occupants').value);
    const ages = document.getElementById('ages').value.split(',').map(age => parseInt(age));

    // Check if name and email are not empty
    if(unitName === "" || arrival === "" || departure === "" || occupants === "" || ages.length === 0 || ages.some(age => isNaN(age))) {
      alert("Please fill in all required fields and Ages should be numbers.");
    } else {
    // Construct payload
    const payload = {
      'Unit Name': unitName,
      'Arrival': arrival,
      'Departure': departure,
      'Occupants': occupants,
      'Ages': ages
    };

    // Make POST request
   await fetch('rates.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(payload)
    })
      .then(response => {
        if(response.status === 200){
         return response.text(); // Parse the response as text
        }else{
          // Request failed (status code outside 200-299)
          const statusText = response.statusText;
          const statusCode = response.status;
           // Handle the error appropriately (e.g., display an error message)
          alert(`Server returned an error. Error: ${statusText} (Status Code: ${statusCode})`);
          throw new Error('Server error');
        }
      })
      .then(data => {
        try {
          const jsonData = JSON.parse(data); // Try parsing as JSON
          // Display results
          let html = `
            <div>
              <p>Unit: ${jsonData.unit}</p>
              <p>Rate: $${jsonData.rate}</p>
              <p>Date Range: ${jsonData.arrival} - ${jsonData.departure}</p>
              <p>Availability: ${jsonData.availability}</p> 
            </div>
          `;
          document.getElementById('results').innerHTML = html;
        } catch (error) {
          // Handle parsing error
          console.error('Error parsing JSON:', error);
          // Display an error message or handle it in an appropriate way
        }
      })
      .catch(error => {
        console.error('Fetch error:', error);
        // Handle other errors here     
  });
};
}
});
