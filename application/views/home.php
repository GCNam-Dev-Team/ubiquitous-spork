<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Gondwana Collection</title>
		<link rel="shortcut icon" href="https://gondwana-collection.com/hubfs/Gondwana_Hand-1.png">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="colorlib.com">

		<!-- MATERIAL DESIGN ICONIC FONT -->
		<link rel="stylesheet" href="<?= base_url('assets/fonts/material-design-iconic-font/css/material-design-iconic-font.css')?>">

		<!-- STYLE CSS -->
		<link rel="stylesheet" href="<?= base_url('assets/css/style.css')?>">

		<style>
			table {
			  font-family: arial, sans-serif;
			  border-collapse: collapse;
			  width: 100%;
			}

			td, th {
			  border: 1px solid #dddddd;
			  text-align: left;
			  padding: 8px;
			}
		</style>

	</head>
	<body>
		<div class="wrapper">
            <form action="" id="wizard">
        		<!-- SECTION 1 -->
                <h2></h2>
				
                <section>
                    <div class="inner">
						<div class="image-holder">
							<img src="<?= base_url('assets/images/form-wizard-1.jpg')?>" alt="">
						</div>
						<div class="form-content" >
							<div class="form-header">
								<h3>Booking</h3>
							</div>
							<p>Stay Information</p>
							<div class="form-row">
								<div class="form-holder w-100">
									<select name="unit" id="unit" class="form-control unit">
                                	    <option value="0" selected default disabled>Select a Unit</option>
                                	    <option value="Kalahari Farmhouse">Kalahari Farmhouse</option>
                                	    <option value="Klipspringer Camps">Klipspringer Camps</option>
                                	</select>
									<!-- <input type="text" placeholder="Last Name" class="form-control"> -->
								</div>
							</div>
							<div class="form-row">
								<div class="form-holder">
									<label for="">Arrival</label>
									<input id="checkindate" type="date" placeholder="Check-In Date" class="form-control arrival DateTime" >
								</div>
								<div class="form-holder">
									<label for="">Departure</label>
									<input id="checkoutdate" type="date" placeholder="Check-Out Date" class="form-control departure">
								</div>
							</div>
							<div class="checkbox-circle w-100">
								<label>
									Please choose a unit and give us dates to see the daily rate of the selection!
								</label>
							</div>
						</div>
					</div>
                </section>

				<!-- SECTION 2 -->
                <h2></h2>
                <section>
                    <div class="inner">
						<div class="image-holder">
							<img src="<?= base_url('assets/images/form-wizard-2.jpg')?>" alt="">
						</div>
						<div class="form-content">
							<div class="form-header">
								<h3>Booking</h3>
							</div>
							<p>Please Fill With Additional Info</p>
							<div class="form-row">
								<div class="form-holder w-100">
									<input type="number" placeholder="Number of Occupants e.g. 2" class="form-control occupants">
								</div>
							</div>
							<div class="form-row">
								<div class="form-holder w-100">
									<input type="text"  placeholder="Enter Ages (comma-separated) e.g. 10,16,21,40,45" class="form-control ages">
								</div>
							</div>
						</div>
					</div>
                </section>

                <!-- SECTION 3 -->
                <h2></h2>
				<section>
                    <div class="inner">
						<div class="image-holder">
							<img src="<?= base_url('assets/images/form-wizard-3.jpg')?>" alt="">
						</div>
						<div class="form-content">
							<div class="form-header">
								<h3>Booking</h3>
							</div>
							<p style="margin:0">Rates For The Stay</p>
							<div class="checkbox-circle w-100">
								<table class="table" style="display:none">
									<tr>
									  <td style="width:30%">Title</td>
									  <td class="replyTitle">Title </td>
									</tr>
									<tr>
									  <td style="width:30%">Room</td>
									  <td class="replyRoom">Room </td>
									</tr>
									<tr>
									  <td style="width:30%">Total Cost </td>
									  <td class="replyCost">Cost </td>
									</tr>
									<tr>
									  <td style="width:30%">Daily Rate </td>
									  <td class="replyRate">Rate </td>
									</tr>
									<tr>
									  <td style="width:30%">Deposit</td>
									  <td class="replyDeposit">Deposit</td>
									</tr>
								</table>
								<label class="reply">
								Please Wait
								</label>
							</div>
						</div>
					</div>
                </section>
            
            </form>
		</div>

		<!-- JQUERY -->
		<script src="<?= base_url('assets/js/jquery-3.3.1.min.js')?>"></script>
		<script src="<?= base_url('assets/js/moment.min.js')?>"></script>

		
		<!-- JQUERY STEP -->
		<script src="<?= base_url('assets/js/jquery.steps.js')?>?v=4"></script>
		<script src="<?= base_url('assets/js/main.js')?>?v=4"></script>
		<script>

			function check(type)
			{
			  	document.getElementById('finish').style.display = 'none';
				if(type == 'next')
				{
					const unit = document.querySelector('.unit').value
					const arrival = moment(document.querySelector('.arrival').value).format('DD-MM-YYYY')
					const departure = moment(document.querySelector('.departure').value).format('DD-MM-YYYY')
					const occupants = document.querySelector('.occupants').value
					const ages = document.querySelector('.ages').value.split(",")
					const reply = document.querySelector('.reply')

					// reply.innerHTML = 'Please Wait...'
					if(validate(unit, arrival, departure, occupants, ages, reply))
					{
						
						$.ajax({ 
        					url:"<?= base_url('rates')?>",
                			type: 'post',
							 data: {
							    unit : unit,
							    arrival: arrival,
							    departure: departure,
							    occupants: occupants,
							    ages: ages
							},
        					 success:function(data)
        					 {
								
								const jsonData = data; 
								var totalDaily = 0; 
								var totalDeposit = 0; 
								const parsedData = JSON.parse(jsonData);

								document.querySelector('.replyTitle').innerHTML = parsedData["Legs"][0]['Special Rate Description']
								document.querySelector('.replyRoom').innerHTML = parsedData["Rooms"]
								document.querySelector('.replyCost').innerHTML = 'N$ ' + parsedData["Total Charge"]								
								if(parsedData["Total Charge"] != 0)
								{
									for (let index = 0; index < ages.length; index++) {
										totalDaily += parsedData["Legs"][index]["Effective Average Daily Rate"] 
										if(parsedData["Legs"][index]['Deposit Breakdown'][0]['Due Amount'] != 0)
										{
											totalDeposit += parsedData["Legs"][index]['Deposit Breakdown'][0]['Due Day'] 
										}
									}
								}

								document.querySelector('.replyRate').innerHTML = 'N$ ' + totalDaily
								document.querySelector('.replyDeposit').innerHTML = 'N$ ' + totalDeposit

								reply.innerHTML = '';
								document.querySelector('.table').style.display = 'block'
								
								document.getElementById('finish').style.display = 'flex';
        					 }
        				});
					}
				}
				else if(type == 'finish')
				{
					window.location.href = 'https://gondwana-collection.com/'
				}
			}
	
			function validate(unit, arrival, departure, occupants, ages, reply){
				reply.innerHTML = 'Please Wait...';
				if(unit == 0)
				{
					reply.innerHTML = 'Please Go To The First Step and Select a Unit'
				}
				else if(arrival == 'Invalid date')
				{
					reply.innerHTML = 'Please Go To The First Step and Choose a Arrival Date'
				}
				else if(arrival != 'Invalid date' && new Date() > new Date(document.querySelector('.arrival').value))
				{
					reply.innerHTML = 'Please Go To The First Step and Choose a Arrival Date That is Greater than today'
				}
				else if(departure == 'Invalid date')
				{
					reply.innerHTML = 'Please Go To The First Step and Choose a Departure Date'
				}
				else if(departure != 'Invalid date' && new Date() > new Date(document.querySelector('.departure').value))
				{
					reply.innerHTML = 'Please Go To The First Step and Choose a Departure Date That is Greater than today'
				}
				else if(departure != 'Invalid date' && new Date(document.querySelector('.arrival').value) > new Date(document.querySelector('.departure').value))
				{
					reply.innerHTML = 'Please Go To The First Step and Choose a Departure Date That is Greater Than The Arrival Date'
				}
				else if(occupants == '' || occupants == '0')
				{
					reply.innerHTML = 'Please Go To The Second Step add The Number of Occupants'
				}
				else if(ages.length != occupants)
				{
					reply.innerHTML = 'Please Go To The Second Step and The Number of Ages Match With The Number of Occupants'
				}
				else
				{
					return true;
				}
				return false;
			}
			
		</script>
</body>
</html>
