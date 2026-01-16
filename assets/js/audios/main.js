miplaylist = [];

(function () {
  miplay["0"] = [];
  for (let index in miplay) {
    for (let j in miplay[index]) {
      miplay["0"].push(miplay[index][j]);
    }
  }
  
  miplay[0].forEach(function(s) {
    $('#playList').append($('<div class="tsong" data-src="'+s.file+'"><a class="playa btn btn-sm btn-success float-end" href="'+s.file+'"  download="'+decodeURIComponent(s.file.split('/').pop())+'"><i class="fa-solid fa-download"></i></a><div class="play_song d-inline">'+s.trackName+'</div><div class="play_artist">'+s.trackArtist+'</div></div>'))
  });
  window.addEventListener("load", player.init);

})();

$(document).on("click", ".catem", function () {
  $('.catem').removeClass('activo');
  $(this).addClass("activo");
  $list = $(this).data("list");
  miplaylist = miplay[$list];

  $('#playList').empty();
  miplay[$list].forEach(function(s) {
    $('#playList').append($('<div class="tsong" data-src="'+s.file+'"><a class="playa float-end btn btn-sm btn-success" href="'+s.file+'"  download="'+decodeURIComponent(s.file.split('/').pop())+'"><i class="fa-solid fa-download"></i></a><div class="play_song d-inline">'+s.trackName+'</div><div class="play_artist">'+s.trackArtist+'</div></div>'))
  });
   player.nuevo();

  return false;
});
