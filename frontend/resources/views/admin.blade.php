<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ticket Sales Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Admin Page: Ticket Report</h1>

    <!-- Table to display items -->
    <table id="itemsTable" class="table table-bordered">
        <thead>
            <tr>
                <th>Receipt Number</th>
                <th>Bus</th>
                <th>Route</th>
                <th>Schedule</th>
                <th>Trip</th>
                <th>Number of Tickets</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="itemsTableBody">
            <!-- Items will be populated here -->
        </tbody>
    </table>
    <div id="noDataNotification" style="display: none;" class="alert alert-info">
        No items available.
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Function to fetch and display items
    function fetchItems() {
        var noDataNotification = $('#noDataNotification');
        noDataNotification.show();
        $.get('/grpc/list-items', function(data) {
            var itemsTableBody = $('#itemsTableBody');
            itemsTableBody.empty(); // Clear the table body
            
            if (data.items.length > 0) {
                data.items.forEach(function(item) {                    
                    itemsTableBody.append(
                        '<tr>' +
                        '<td>' + item.receipt_number + '</td>' +
                        '<td>' + item.bus + '</td>' +
                        '<td>' + route[item.route_from] + ' to ' + route[item.route_to] + '</td>' +
                        '<td>' + item.schedule + '</td>' +
                        '<td>' + item.trip + '</td>' +
                        '<td>' + item.num_tickets + '</td>' +
                        '<td>' + item.price + '</td>' +
                        '<td><button data-id="' + item.id + '" class="deleteItemButton btn btn-danger">Delete</button></td>' +
                        '</tr>'
                    );
                });
                noDataNotification.hide(); // Hide notification if items are present
            } else {
                noDataNotification.show(); // Show notification if no items
            }
        });
    }

    // Fetch items when the page loads    
    fetchItems();

    // Delete Item
    $(document).on('click', '.deleteItemButton', function(e) {
        e.preventDefault();
        const id = $(this).data("id");
        var confirmSubmit = confirm('Confirm deletion.');

        if (confirmSubmit) {
            $.get('/grpc/delete-item/' + id, function(data) {
                fetchItems();
            })
        }
    });

    var route = {
        "city_a": "City A",
        "city_b": "City B",
        "city_c": "City C",
        "city_d": "City D",
        "city_e": "City E",
    }


});    
</script>
</body>
</html>
