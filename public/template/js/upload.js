/*Upload File*/
$('#upload').change(function (){
    const form = new FormData();
    form.append('file', $(this)[0].files[0]);

    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
        },
        dataType: 'JSON',
        data: form,
        url:'/admin/upload/services',
        success: function (results){
            if (results.error === false){
                $('#image_show').html('<a href="' + results.url + '" target="_blank">' +
                '<img src="' + results.url + '" width="100px"></a>');

                $('#thumnb').val(results.url);
            } else {
                alert('Upload File Lỗi');
            }
            // console.log(results);
        }
    })

    // console.log(123);
})