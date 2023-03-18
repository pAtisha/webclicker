import $ from "jquery";

$(function(){
    // Setup Token

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //edit course form show data
    $('body').on('click', '#editCourseButton', function () {
        var id = $(this).val();
        $.get("/professor/courses/edit" +'/' + id, function (data) {
            $('#name_course').val(data.data.name);
            $('#password_course').val(data.data.password);

        })
    });

    $('.btn-edit-course').on('click', function(){

    });


    $('.btn-delete-course').on('click', function(){
        const id = $(this).val();
        $('#deleteFormCourse').attr('action', '/professor/courses/delete/' + id);
    });


});
