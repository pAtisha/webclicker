import "jquery-ui/dist/jquery-ui";
import "jquery-ui/ui/data";
import "jquery-ui/ui/widgets/mouse";
import "jquery-ui/ui/widgets/sortable";

$( document ).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //sort tests
    $('#test_table').sortable({
        axis: 'y', // Allow dragging vertically
        update: function(event, ui) {
            // Get the updated positions of the rows
            let positions = [];
            $('tbody tr').each(function(index) {
                positions.push({
                    id: $(this).attr('data-id'), // Assuming each row has a unique identifier stored in a 'data-id' attribute
                    position: index + 1
                });
            });

            // Send an AJAX request to update the positions in the database
            $.ajax({
                url: 'update-positions/test', // Replace with the actual route that updates the positions
                type: 'POST',
                data: {
                    positions: positions
                },
                success: function(response) {
                    //console.log(response);
                },
                error: function(xhr) {
                    //console.log(xhr);
                }
            });
        }
    });

    //sort questions with RELOAD
    $('#question_table').sortable({
        axis: 'y', // Allow dragging vertically
        update: function(event, ui) {
            // Get the updated positions of the rows
            let positions = [];
            $('.tr-data-id').each(function(index) {
                positions.push({
                    id: $(this).attr('data-id'), // Assuming each row has a unique identifier stored in a 'data-id' attribute
                    position: index + 1
                });
            });

            // Send an AJAX request to update the positions in the database
            $.ajax({
                url: '/professor/courses/update-positions/question', // Replace with the actual route that updates the positions
                type: 'POST',
                data: {
                    positions: positions
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr) {
                    //console.log(xhr);
                }
            });
        }
    });


    // let questions = [];
    // let positions = [];
    // $('.tr-data-id').each(function (index){
    //     $('.tr-data-id-answer-' + index).each(function (index){
    //         positions.push({
    //             id: $(this).attr('data-id'), // Assuming each row has a unique identifier stored in a 'data-id' attribute
    //             position: index + 1
    //         });
    //     })
    //     questions[index] = positions;
    //     console.log(questions[index]);
    // });

    // let positions = [];
    // let questions = [];
    // $('.tr-data-id').each(function (indexQuestion){
    //     $('.tr-data-id-answer-' + indexQuestion).each(function (indexAnswer){
    //         positions.push([{
    //               id: $(this).attr('data-id'),
    //               position: indexAnswer + 1
    //         }]);
    //     });
    //     questions.push(positions);
    //     positions = [];
    // });
    // console.log(questions);


    //sort answers
    $('[id*="answer_table_"]').each(function (index){

        $(this).sortable({
            axis: 'y', // Allow dragging vertically
            update: function(event, ui) {
                // Get the updated positions of the rows
                let positions = [];
                $('.tr-data-id-answer').each(function(index) {
                    positions.push({
                        id: $(this).attr('data-id'), // Assuming each row has a unique identifier stored in a 'data-id' attribute
                        position: index + 1
                    });
                });

                // Send an AJAX request to update the positions in the database
                $.ajax({
                    url: '/professor/courses/update-positions/answer', // Replace with the actual route that updates the positions
                    type: 'POST',
                    data: {
                        positions: positions
                    },
                    success: function(response) {
                        //console.log(response);
                    },
                    error: function(xhr) {
                        //console.log(xhr);
                    }
                });
            }
        });
    });
});





