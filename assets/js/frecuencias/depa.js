$('.cdepa').click(function(){
  $('.contdepa').load($(this).attr('href'));
  return false;
})