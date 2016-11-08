function uploadImage(){
  var file_data = $('#image').prop('files')[0];
  var form_data = new FormData();
  form_data.append('file', file_data);
  $.ajax({
    url: './ajax/upload_image.php',
    dataType: 'json',
    cache: false,
    contentType: false,
    processData: false,
    data: form_data,
    type: 'post',
    success: function(response){
        if(response.status == "ok"){
          swal("Imagen Cambiada!", "La imagen se cambio correctamente.", "success")
          $('#image').val('');
        }else{
          swal("Error!", "La imagen no fue cambiada correctamente!", "error")
        }
    }
   });
};
