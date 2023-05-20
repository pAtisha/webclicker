import "jquery-ui";
import "jquery-ui/ui/widgets/mouse";
import "jquery-ui/ui/widgets/sortable";

$( document ).ready(function() {
            $('tbody').sortable({
                axis: 'y', // Allow dragging vertically
                update: function(event, ui) {
                    // Get the updated positions of the rows
                    var positions = [];
                    $('tbody tr').each(function(index) {
                        positions.push({
                            id: $(this).attr('data-id'), // Assuming each row has a unique identifier stored in a 'data-id' attribute
                            position: index + 1
                        });
                    });

                    // Send an AJAX request to update the positions in the database
                    $.ajax({
                        url: '{{ url("professor/update-positions/test") }}', // Replace with the actual route that updates the positions
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            positions: positions
                        },
                        success: function(response) {
                            console.log('uspesno');
                        },
                        error: function(xhr) {
                            console.log(xhr);
                        }
                    });
                }
            });
});





