$(document).ready(() => {
  let user_href;
  let user_id;
  let image_src;
  let image_name;

  $(".modal_thumbnails").click((e) => {
    $("#set_user_image").prop('disabled', false);
    user_href = $("#user-id").prop('href');
    user_id = user_href.split('=')[1];

    image_src = $(e.currentTarget).attr("src");
    image_name = image_src.split("\\")[1]


  });


  
  tinymce.init({
    selector: 'textarea',
  });
});