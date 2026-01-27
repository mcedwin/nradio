$("form").load_img();
$(".alerta").hide();
$("form").submit(function () {
  $(this).mysave((data) => {
    //window.location.href = data.redirect;
    $(".alerta").show();
    $(".alerta .mensaje").text(data.mensaje);
    $("form")[0].reset();
    $(window).scrollTop(0);
  });
  return false;
});
