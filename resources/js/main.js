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

    //edit test form show data
    $('body').on('click', '#editTestButton', function () {
        var id = $(this).val();
        $.get("/professor/courses/edit/test" +'/' + id, function (data) {
            $('#name_test').val(data.data.name);
            $('#password_test').val(data.data.password);
            $('#time_test').val(data.data.time);

        })
    });

    //edit question form show data
    $('body').on('click', '#editQuestionButton', function () {
        var id = $(this).val();
        $.get("/professor/courses/questions/test/edit" +'/' + id, function (data) {
            $('#question_edit').val(data.data.question);
            $('#points_edit').val(data.data.points);

        })
    });

    //edit answer form show data
    $('body').on('click', '#editAnswerButton', function () {
        var id = $(this).val();
        $.get("/professor/courses/questions/test/answers/edit" +'/' + id, function (data) {
            $('#answer_edit').val(data.data.answer);
            $('#points_edit').val(data.data.points);

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

    $('.btn-edit-question').on('click', function (){
        const id = $(this).val();
        $('#editFormQuestion').attr('action', '/professor/courses/questions/test/update/' + id);
    });

    $('.btn-edit-answer').on('click', function (){
        const id = $(this).val();
        $('#editFormAnswer').attr('action', '/professor/courses/questions/test/answers/update/' + id);
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

    $('.btn-delete-question').on('click', function(){
        const id = $(this).val();
        $('#deleteFormQuestion').attr('action', '/professor/courses/question/delete/test/' + id);
    });

    $('.btn-delete-answer').on('click', function(){
        const id = $(this).val();
        $('#deleteFormAnswer').attr('action', '/professor/courses/question/delete/test/answers/' + id);
    });

    //create buttons
    $('.btn-create-test').on('click', function(){
        const id = $(this).val();
        $('#test_course_id').val(id);
    });

    $('.btn-create-question').on('click', function(){
        const id = $(this).val();
        $('#test_question_id').val(id);
    });

    $('.btn-create-answer').on('click', function(){
        const id = $(this).val();
        $('#test_question_id_answer').val(id);
    });

    //edit question container
    $('[id*="question_id_"]').on('click', function (){
       let clickedValue = $(this).attr('href');
       clickedValue = clickedValue.substring(1);

       $('#question_container' + clickedValue).addClass('red-border');

       setTimeout(function (){
           $('#question_container' + clickedValue).removeClass('red-border');
       }, 2000);
    });

});
