<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ticket Sales</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">City C: Buy Ticket</h2>

    <!-- Create Item Form -->
    <form id="createItemForm">
        <input type="hidden" id="route_from" name="route_from" value="city_c"/>
        <input type="hidden" id="trip" name="trip" value="" />
        <div class="form-row">
            <div class="form-group col">
                <label for="receipt_number">Receipt Number</label>
                <input type="text" class="form-control" value="<?php echo time(); ?>" id="receipt_number" name="receipt_number" readonly>
            </div>
        </div> 
        <div class="form-row">
            <div class="form-group col"> 
                <label for="bus">Bus</label>
                <select class="form-control" id="bus" name="bus" required>
                    <option value="">Select a bus</option>
                    <option value="1">Bus 1</option>
                    <option value="2">Bus 2</option>
                    <option value="3">Bus 3</option>
                </select>
            </div>
        </div> 
        <div class="form-row">
            <div class="form-group col">
                <label for="route_to">Route to: </label>
                <select class="form-control" id="route_to" name="route_to" required>
                    <option value="">Select destination</option>
                    <option value="city_a">City A</option>
                    <option value="city_b">City B</option>
                    <option value="city_d">City D</option>
                    <option value="city_e">City E</option>
                </select>
            </div>
        </div> 
        <div class="form-row">
            <div class="form-group col">
                <label for="schedule">Schedule</label>
                <select class="form-control" id="schedule" name="schedule" required>
                    <option value="">Select a Schedule</option>
                    <option value="morning">Morning</option>
                    <option value="afternoon">Afternoon</option>
                    <option value="evening">Evening</option>
                </select>
            </div>
        </div> 
        <div class="form-row">
            <div class="form-group col">  
                <label for="num_tickets">Number of Ticket(s)</label>
                <input type="number" class="form-control" id="num_tickets" name="num_tickets" min="1" max="80" required>
            </div> 
        </div>
        <div class="form-row">
            <div class="form-group col">  
                <label for="price">Price</label>
                <input type="text" class="form-control" id="price" name="price" value="" readonly>
            </div> 
        </div>

        <button type="submit" class="btn btn-primary">Buy Ticket</button>
    </form>

    
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    // Create Item
    $('#createItemForm').on('submit', function(event) {
        event.preventDefault();
        var confirmSubmit = confirm('Buy ticket now?');
        if (confirmSubmit) {
            $.post('/grpc/create-item', $(this).serialize(), function(data) {
                window.location.href = '/update-item/' + data.id
            });
        }
    });

    // Logic to set "trip" value (outbound/return)
    $('#route_to').on('change', function(e) {
        e.preventDefault();
        var selectedValue = this.options[this.selectedIndex].value;
        var outboundTrips = ['city_d', 'city_e'];
        
        if (outboundTrips.includes(selectedValue)) {
            $('#trip').val("outbound");
        } else {
            $('#trip').val("return");
        }

        computePrice()
    });

    // Logic to get price
    function computePrice() {
        var numTickets = $('#num_tickets').val();
        var destination = $('#route_to').val();

        if ( numTickets != "" && destination != "" && trip != "" ) {
            var price = numTickets * waypoints[destination] * 100;
            $('#price').val(price);
        }        
    }

    var waypoints = {
        "city_a": 2,
        "city_b": 1,
        "city_d": 1,
        "city_e": 2,
    }

    // Refresh computation when changing number of tickets
    $('#num_tickets').on('change', function() { 
        computePrice()
    });

});    
</script>
</body>
</html>
