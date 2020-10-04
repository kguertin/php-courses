$(document).ready(() => {
  let user_href;
  let user_id;
  let image_src;
  let image_name;
  let photo_id

  // Edit Photo Dropdown
  $('.info-box-header').click((() => {
    $(".inside").slideToggle('fast');
    $('#toggle').toggleClass("glyphicon-menu-down glyphicon , glyphicon-menu-up glyphicon")
  }))

  // Thumbnails

  $(".modal_thumbnails").click((e) => {
    $("#set_user_image").prop('disabled', false);
    user_href = $("#user-id").prop('href');
    user_id = user_href.split('=')[1];

    image_src = $(e.currentTarget).attr("src");
    image_name = image_src.split("\\")[1]

    photo_id = image_src = $(e.currentTarget).attr("data");
    $.ajax({
      url: 'includes/ajax_code.php',
      data: { photo_id: photo_id },
      type: 'POST',
      success: data => {
        if(!data.error) {
          $('#modal_sidebar').html(data);
        }
      }
    })

  });

  $('#set_user_image').click(() => {
    $.ajax({
      url: "includes/ajax_code.php",
      data: {image_name: image_name, user_id: user_id},
      type: 'POST',
      success: data => {
        if(!data.error){
          $(".user_image_box a img").prop('src', data)
        }
      }
    })
  })


  
  tinymce.init({
    selector: 'textarea',
  });
});