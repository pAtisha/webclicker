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
            $('#type_edit').val(data.data.type);

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

    //create new question with existing ones
    $('body').on('click', '.btn-create-existing-question', function () {
        var course_id = $(this).val();
        $.get("/professor/courses/get/all", function (data) {
            $.each(data.data, function (i, item){
                $('#course_old').append($('<option>', {
                    value: item.id,
                    text : item.name,
                    id: 'course_selected'
                }));
            });
            $('#course_old').val(course_id);
            $('#course_old').trigger('change');
        });
    });

    $('body').on('change', '#course_old',function (e) {
        let optionSelected = $("option:selected", this);
        let valueSelected = this.value;
        let searchText = "";
        searchText += $('#question_filter').val();
        if(searchText.length < 3)
            searchText = "";

        draw_table(optionSelected, valueSelected, searchText);
    });

    let timeout;
    $('#question_filter').on("input", function() {
        if(this.value.length >= 3)
        {
            // Clear the previous timeout
            clearTimeout(timeout);

            // Set a new timeout to wait 2 seconds
            timeout = setTimeout(function() {
                // If the user is not typing anymore, do something
                $('#course_old').trigger('change');
            }, 1000);
        }
        else if(this.value.length < 3)
        {
            // Clear the previous timeout
            clearTimeout(timeout);

            // Set a new timeout to wait 2 seconds
            timeout = setTimeout(function() {
                // If the user is not typing anymore, do something
                $('#course_old').trigger('change');
            }, 1000);
        }
    });


    function draw_table(optionSelected, valueSelected, searchText)
    {
        let html_append = "";

        $("#tbody_delete").empty();

        $.get("/professor/questions/get/" + valueSelected + "/" + searchText, function (data){
            $.each(data.data, function(i, item){
                html_append +=                    "<tr>" +
                    "<td>" + item.question +"</td>" +
                    "<td><button value=\""+item.id+"\" type=\"button\" class=\"btn btn-primary btn-toggle-up-down btn-toggle-up-down-copy\" data-bs-toggle=\"collapse\" href=\"#collapseAnswersCopy" + item.id + "\" role=\"button\" aria-expanded=\"false\" aria-controls=\"collapseAnswersCopy" + item.id + "\"><i class=\"bi bi-chevron-down\"></i></button></td>" +
                    "                                        <td>\n" +
                    "                                            <input name=\"question_id[]\" type=\"checkbox\" aria-label=\"Checkbox for test\" value=\""+item.id+"\">\n" +
                    "                                        </td>"
                    +"</tr>" +
                    "                                    <tr class=\"collapse\" id=\"collapseAnswersCopy"+item.id+"\">\n" +
                    "                                        <td colspan=\"2\">\n" +
                    "                                            <table class=\"table\">\n" +
                    "                                                <thead>\n" +
                    "                                                <tr>\n" +
                    "                                                    <th scope=\"col\">Odgovor</th>\n" +
                    "                                                    <th scope=\"col\">Poeni</th>\n" +
                    "                                                </tr>\n" +
                    "                                                </thead>\n" +
                    "                                                <tbody id=\"answers_tbody"+item.id+"\">\n";
                html_append +=                                      "</tbody>\n" +
                    "                                            </table>\n" +
                    "                                        </td>\n" +
                    "                                    </tr>";
            })

        })
            .done(function (){
                $('#show_questions_table tbody').append(html_append);
            })
    }

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

    $('.btn-create-existing-question').on('click', function(){
        const id = $(this).val();
        $('#test_existing_question_id').val(id);
    });

    $('.btn-create-answer').on('click', function(){
        const id = $(this).val();
        $('#test_question_id_answer').val(id);
    });



    //edit question container
    $('[id*="question_id_"]').on('click', function (){
       let clickedValue = $(this).attr('href');
       clickedValue = clickedValue.substring(1);

        $('html,body').animate({
                scrollTop: $("#question_container" + clickedValue).offset().top},
            'normal');

       $('#question_container' + clickedValue).addClass('red-border');

       setTimeout(function (){
           $('#question_container' + clickedValue).removeClass('red-border');
       }, 2000);
    });

    let myModalEl = document.getElementById('addExistingQuestionModal');
    if(myModalEl) {
        myModalEl.addEventListener('hidden.bs.modal', function (event) {
            let array = document.querySelectorAll('#course_selected');
            $.each(array, function (i, item) {
                item.remove();
            });

            array = document.querySelectorAll('#show_questions_table tbody tr');
            $.each(array, function (i, item) {
                item.remove();
            });
        })
    }

    //collapsing answers
    $('[class*="btn-toggle-up-down"]').on('click', function() {
        let clickedValue = $(this).html();
       if(clickedValue == "<i class=\"bi bi-chevron-down\"></i>")
       {
           $(this).html("<i class=\"bi bi-chevron-up\"></i>");
       }
       else
       {
           $(this).html("<i class=\"bi bi-chevron-down\"></i>");
       }
    });

    $('#show_questions_table').on('click', '.btn-toggle-up-down-copy',function (){
        let id = $(this).val();
        $.get("/professor/answers/get/" + id, function (answers){
            $.each(answers, function(i, answer){
                $.each(answer, function(key, val)
                {
                    $('#answers_tbody' + id).append("                                                    <tr>\n" +
                        "                                                        <td>"+val.answer+"</td>\n" +
                        "                                                        <td>"+val.points+"</td>\n" +
                        "                                                    </tr>\n");
                });
            });
        });
    });

    //collapsing answers
    $('#show_questions_table').on('click', '.btn-toggle-up-down-copy', function() {
        let clickedValue = $(this).html();
        let id = $(this).val();
        $('#answers_tbody' + id).empty();
        if(clickedValue == "<i class=\"bi bi-chevron-down\"></i>")
        {
            $(this).html("<i class=\"bi bi-chevron-up\"></i>");
        }
        else
        {
            $(this).html("<i class=\"bi bi-chevron-down\"></i>");
        }
    });



});
