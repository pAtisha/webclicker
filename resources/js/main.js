import $ from "jquery";

$(function(){

        $('.btn-delete-course').on('click', function(e){

            e.preventDefault();
            var id = $(this).val();
            var url = document.getElementById('deleteFormCourse').action;

            document.getElementById('deleteFormCourse').action += '/' + id;

            $('.btn-no-delete-course').on('click', function (){
                document.getElementById('deleteFormCourse').action = url;
            });
        });


});
