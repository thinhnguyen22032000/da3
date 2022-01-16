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
          
            var extension = lab_file[0].name.split('.').pop().toLowerCase();
        
            if($.inArray(extension, ['pdf']) == -1) {

                $('#txt_submit').html('<p class="alert alert-notify mt-2"><i class="fas fa-exclamation-circle alert-notify__icon"></i>Please upload only pdf format files</p>')
                return false  
            }

            $id_lesson = $('#id_lesson').val()
            formData.append('id_lesson', $id_lesson)
            const _url = 'http://localhost:88/da3/ajax_upload_lab'
            console.log(formData)
            $.ajax({
                url: _url,
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success:function(data) {
                   document.querySelector('.modal_load').classList.add('load_submit')
                   document.querySelector('.load_submit-spiner').classList.add('loader')
                   setTimeout(()=>{
                   document.querySelector('.modal_load').classList.remove('load_submit')
                   document.querySelector('.load_submit-spiner').classList.remove('loader')                   

                   $('#upload_form').hide();

                   $('#txt_submit').hide();

                   $('#alert__success').html('<p class="alert alert-notify__success"><i class="far fa-check-circle alert-notify__icon"></i>Submitted the assignment</p>')

                   }, 1000)      

                },
                error:function(err) {
                    console.log('Err:'+ err)
                }
            })      
            }
            else {
              $('#txt_submit').html('<p class="alert alert-notify mt-2"><i class="fas fa-exclamation-circle"></i> please select file to submit</p>')
            }
        })

    })
   