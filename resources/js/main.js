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

    //edit user form show data
    $('body').on('click', '#editUserButton', function () {
        var id = $(this).val();
        $.get("/admin/users/edit" +'/' + id, function (data) {
            $('#name_user').val(data.data.name);
            $('#index_number').val(data.data.index_number);
            $('#email').val(data.data.email);

        })
    });

    //edit user form show data
    $('body').on('click', '#editTestButton', function () {
        var id = $(this).val();
        $.get("/professor/courses/edit/test" +'/' + id, function (data) {
            $('#name_test').val(data.data.name);
            $('#password_test').val(data.data.password);
            $('#time_test').val(data.data.time);

        })
    });

    //edit buttons

    $('.btn-edit-course').on('click', function (){
       const id = $(this).val();
       $('#editFormCourse').attr('action', '/professor/courses/update/' + id);
    });

    $('.btn-edit-user').on('click', function (){
        const id = $(this).val();
        $('#editFormUser').attr('action', '/admin/users/update/' + id);
    });

    $('.btn-edit-test').on('click', function (){
        const id = $(this).val();
        $('#editFormTest').attr('action', '/professor/courses/update/test/' + id);
    });

    //delete buttons

    $('.btn-delete-course').on('click', function(){
        const id = $(this).val();
        $('#deleteFormCourse').attr('action', '/professor/courses/delete/' + id);
    });

    $('.btn-delete-user').on('click', function(){
        const id = $(this).val();
        $('#deleteFormUser').attr('action', '/admin/users/delete/' + id);
    });

    $('.btn-delete-test').on('click', function(){
        const id = $(this).val();
        $('#deleteFormTest').attr('action', '/professor/courses/delete/test/' + id);
    });

    //create buttons
    $('.btn-create-test').on('click', function(){
        const id = $(this).val();
        $('#test_course_id').val(id);
    });


});
