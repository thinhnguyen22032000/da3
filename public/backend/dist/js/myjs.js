 $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
         $('#upload_form').on('submit', function(e) {
            e.preventDefault()
            let formData = new FormData(this)
            let lab_file = $('#lab_file')[0].files
            if(lab_file.length > 0) {
            $id_lesson = $('#id_lesson').val()
            formData.append('id_lesson', $id_lesson)
            let _url = 'http://localhost:88/da3/admin/ajax_upload_lab'
            $.ajax({
                url: _url,
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success:function(data) {
                  
                   $('#upload_form').hide();

                   $('#txt_submit').hide();

                   $('#alert__success').html('<div class="alert__success alert alert-success" role="alert">Submitted the assignment</div>')

                },
                error:function(err) {
                    console.log(2)
                }
            })
                 
            }
            else {
              $('#txt_submit').html('<p style="color:red">please select file to submit</p>')
            }
        })

    })
   