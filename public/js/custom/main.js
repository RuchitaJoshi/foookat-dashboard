var app_path = "http://localhost/foookat-seller-dashboard/public/";

$(document).ready(function() {

    <!--Confirm Delete Dialog show event handler -->
    $('#confirmDelete').on('show.bs.modal', function (e) {
        $message = $(e.relatedTarget).attr('data-message');
        $(this).find('.modal-body p').text($message);
        $title = $(e.relatedTarget).attr('data-title');
        $(this).find('.modal-title').text($title);


        $(this).find('.modal-title').text($title);

        // Pass form reference to modal for submission on yes/ok
        var form = $(e.relatedTarget).closest('form');
        $(this).find('.modal-footer #confirm').data('form', form);
    });

    <!-- Form confirm (yes/ok) handler, submits form -->
    $('#confirmDelete').find('.modal-footer #confirm').on('click', function(){
        $(this).data('form').submit();
    });

    <!-- Web Editor text areas -->
    tinymce.init({
        selector: '#note, #overview',
        theme: 'modern',
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons',
        image_advtab: true,
        templates: [
            { title: 'Test template 1', content: 'Test 1' },
            { title: 'Test template 2', content: 'Test 2' }
        ],
        content_css: [
            '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
            '//www.tinymce.com/css/codepen.min.css'
        ]
    });

    <!-- Time picker inputs -->
    $('#mon_open').timepicker({ 'timeFormat': 'H:i:s' });
    $('#mon_close').timepicker({ 'timeFormat': 'H:i:s' });
    $('#tue_open').timepicker({ 'timeFormat': 'H:i:s' });
    $('#tue_close').timepicker({ 'timeFormat': 'H:i:s' });
    $('#wed_open').timepicker({ 'timeFormat': 'H:i:s' });
    $('#wed_close').timepicker({ 'timeFormat': 'H:i:s' });
    $('#thu_open').timepicker({ 'timeFormat': 'H:i:s' });
    $('#thu_close').timepicker({ 'timeFormat': 'H:i:s' });
    $('#fri_open').timepicker({ 'timeFormat': 'H:i:s' });
    $('#fri_close').timepicker({ 'timeFormat': 'H:i:s' });
    $('#sat_open').timepicker({ 'timeFormat': 'H:i:s' });
    $('#sat_close').timepicker({ 'timeFormat': 'H:i:s' });
    $('#sun_open').timepicker({ 'timeFormat': 'H:i:s' });
    $('#sun_close').timepicker({ 'timeFormat': 'H:i:s' });

    $("#profile_picture").change(function(){
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#img_profile_picture').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    });
});

function stateChanged()
{
    var state = $('#state').val();
    var url =  app_path + 'businesses/cities';
    $.ajax({
        type: "POST",
        url: url,
        data: {'state' : state, '_token': $('input[name=_token]').val()},
        success: function(result){
            var city = $("#city");
            city.children().remove();
            if(result ===  null)
            {
                city.append($("<option>").val("").text("Pick a city"));
            }
            else
            {
                city.append($("<option>").val("").text("Pick a city"));
                for (var i = 0; i < result.length; i++) {
                    var val = result[i].name;
                    var text = result[i].name;
                    city.append($("<option>").val(val).text(text));
                }
            }
        }
    });
}