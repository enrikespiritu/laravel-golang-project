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
    <h2 class="mb-4">Update Ticket Booking</h2>

    <!-- Item Form -->
    <form id="updateItemForm">
        <input type="hidden" id="updateItemId" name="id" value="{{ $item['id'] }}" />
        <div class="form-row">
            <div class="form-group col">
                <label for="receipt_number">Receipt Number</label>
                <input type="text" class="form-control" id="receipt_number" name="receipt_number" value="{{ $item['receipt_number'] }}" readonly>
            </div>
        </div> 
        <div class="form-row">
            <div class="form-group col"> 
                <label for="bus">Bus</label>
                <select class="form-control" id="bus" name="bus" required>
                    <option value="">Select a bus</option>
                    <option value="1" {{ $item['bus'] == '1' ? 'selected' : '' }}>Bus 1</option>
                    <option value="2" {{ $item['bus'] == '2' ? 'selected' : '' }}>Bus 2</option>
                    <option value="3" {{ $item['bus'] == '3' ? 'selected' : '' }}>Bus 3</option>
                </select>
            </div>
        </div> 
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="route_from">Route from: </label>
                <select class="form-control" id="route_from" name="route_from" disabled>
                    <option value="">Select a branch</option>
                    <option value="city_a" {{ $item['route_from'] == 'city_a' ? 'selected' : '' }}>City A</option>
                    <option value="city_b" {{ $item['route_from'] == 'city_b' ? 'selected' : '' }}>City B</option>
                    <option value="city_c" {{ $item['route_from'] == 'city_c' ? 'selected' : '' }}>City C</option>
                    <option value="city_d" {{ $item['route_from'] == 'city_d' ? 'selected' : '' }}>City D</option>
                    <option value="city_e" {{ $item['route_from'] == 'city_e' ? 'selected' : '' }}>City E</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="route_to">Route to: </label>
                <select class="form-control" id="route_to" name="route_to" disabled>
                    <option value="">Select a branch</option>
                    <option value="city_a" {{ $item['route_to'] == 'city_a' ? 'selected' : '' }}>City A</option>
                    <option value="city_b" {{ $item['route_to'] == 'city_b' ? 'selected' : '' }}>City B</option>
                    <option value="city_c" {{ $item['route_to'] == 'city_c' ? 'selected' : '' }}>City C</option>
                    <option value="city_d" {{ $item['route_to'] == 'city_d' ? 'selected' : '' }}>City D</option>
                    <option value="city_e" {{ $item['route_to'] == 'city_e' ? 'selected' : '' }}>City E</option>
                </select>
            </div>
        </div> 
        <div class="form-row">
            <div class="form-group col">  
                <label for="num_tickets">Trip</label>
                <input type="text" class="form-control" id="trip" name="trip" value="{{ $item['trip'] }}" readonly>
            </div> 
        </div>
        <div class="form-row">
            <div class="form-group col">
                <label for="schedule">Schedule</label>
                <select class="form-control" id="schedule" name="schedule" required>
                    <option value="">Select a Schedule</option>
                    <option value="morning" {{ $item['schedule'] == 'morning' ? 'selected' : '' }}>Morning</option>
                    <option value="afternoon" {{ $item['schedule'] == 'afternoon' ? 'selected' : '' }}>Afternoon</option>
                    <option value="evening" {{ $item['schedule'] == 'evening' ? 'selected' : '' }}>Evening</option>
                </select>
            </div>
        </div> 
        <div class="form-row">
            <div class="form-group col">  
                <label for="num_tickets">Number of Ticket(s)</label>
                <input type="number" class="form-control" id="num_tickets" name="num_tickets" min="1" max="80" value="{{ $item['num_tickets'] }}" required>
            </div> 
        </div>

        <div class="form-row">
            <div class="form-group col">  
                <label for="price">Price</label>
                <input type="text" class="form-control" id="price" name="price" value="{{ $item['price'] }}" readonly>
            </div> 
        </div>
        <input type="hidden" class="form-control" id="pricePerTicket" value="{{ $item['price']/$item['num_tickets'] }}">

        <button type="submit" class="btn btn-primary">Update Booking</button>
        <button data-id="{{ $item['id'] }}" class="deleteItemButton btn btn-danger">Delete</button>
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
    
    // Update Item
    $('#updateItemForm').on('submit', function(event) {
        event.preventDefault();
        const id = $('#updateItemId').val();
        var confirmSubmit = confirm('Update ticket now?');

        if (confirmSubmit) {
            $.post(`/grpc/update-item/${id}`, $(this).serialize(), function(data) {
                alert(data.message);
            });
        }        
    });

    // Delete Item
    $(document).on('click', '.deleteItemButton', function(e) {
        e.preventDefault();
        const id = $(this).data("id");
        var confirmSubmit = confirm('Confirm deletion.');

        if (confirmSubmit) {
            let str = $("#route_from").val();
            let separator = "_";
            let array = str.split(separator);

            $.get('/grpc/delete-item/' + id, function(data) {
                window.location.href = '/city-'+array[1]+'/';
            })
        }
    });

    // Logic to get price
    $('#num_tickets').on('change', function() {   
        var pricePerTicket = $('#pricePerTicket').val();
        var numTickets = $('#num_tickets').val();
        

        if ( numTickets != "" || numTickets != 0 ) {
            var price = numTickets * pricePerTicket;
            $('#price').val(price);
        }
    });

});    
</script>
</body>
</html>
