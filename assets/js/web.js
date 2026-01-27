const audio = document.getElementById("radio-audio");
const btnPlay = document.getElementById("btn-play");
const equalizer = document.getElementById("equalizer");

const btnPlay2 = document.getElementById("btn-play2");

r = () => {
  if (audio.paused) {
    audio.play();
    // Activa la animación
    equalizer.classList.add("playing");

    btnPlay.innerHTML = '<i class="bi bi-pause-fill"></i> PAUSAR';
    // btnPlay.classList.replace("btn-danger", "btn-danger");
    btnPlay2.innerHTML = '<i class="bi bi-pause-fill"></i> PAUSAR';
    // btnPlay2.classList.replace("btn-danger", "btn-danger");
  } else {
    audio.pause();
    // Detiene la animación
    equalizer.classList.remove("playing");

    btnPlay.innerHTML = '<i class="bi bi-play-fill"></i> REPRODUCIR';
    // btnPlay.classList.replace("btn-danger", "btn-danger");
    btnPlay2.innerHTML = '<i class="bi bi-play-fill"></i> Escuchar Radio';
    // btnPlay2.classList.replace("btn-danger", "btn-danger");
  }
};
btnPlay.addEventListener("click", r);
btnPlay2.addEventListener("click", r);

document.addEventListener("DOMContentLoaded", () => {
  $(document).on("click", ".cdepa", function (e) {
    e.preventDefault();

    $(".contdepa").load($(this).attr("href"));
  });

  // 🔴 BLOQUEAR CLICK EN MISMO LINK (ya lo tenías)
  document.addEventListener("click", (e) => {
    const link = e.target.closest("a");
    if (!link || !link.href) return;

    const current = window.location.href.split("#")[0];
    const target = link.href.split("#")[0];

    if (current === target) {
      e.preventDefault();
      e.stopImmediatePropagation();
      return false;
    }
  });

  barba.init({
    prevent: ({ el }) => {
      if (!el || !el.href) return false;

      // 🔥 1. Ignorar links marcados
      if (el.hasAttribute("data-barba-prevent")) return true;

      // 🔥 2. Ignorar externos
      if (el.host !== window.location.host) return true;

      // 🔥 3. Ignorar descargas
      if (el.href.match(/\.(pdf|zip|rar|mp3|jpg|png)$/i)) return true;

      // 🔥 4. Ignorar anclas
      if (el.hash) return true;

      return false; // Barba sí actúa
    },
    views: [
      {
        namespace: "home",
        afterEnter() {
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
        },
      },
    ],
    transitions: [
      {
        name: "simple-transition",
        leave(data) {
          data.current.container.style.opacity = 0;
        },
        enter(data) {
          data.next.container.style.opacity = 0;
          setTimeout(() => {
            data.next.container.style.opacity = 1;
            data.next.container.style.transition = "opacity 0.5s";
          }, 50);
        },
      },
    ],
  });

  barba.hooks.enter(() => {
    window.scrollTo(0, 0);
  });
});

Fancybox.bind("[data-fancybox]", {
  // Your custom options
});

(function ($) {
  /**
   * jQuery function to prevent default anchor event and take the href * and the title to make a share popup
   *
   * @param  {[object]} e           [Mouse event]
   * @param  {[integer]} intWidth   [Popup width defalut 500]
   * @param  {[integer]} intHeight  [Popup height defalut 400]
   * @param  {[boolean]} blnResize  [Is popup resizeabel default true]
   */
  $.fn.customerPopup = function (e, intWidth, intHeight, blnResize) {
    // Prevent default anchor event
    e.preventDefault();

    // Set values for window
    intWidth = intWidth || "500";
    intHeight = intHeight || "400";
    strResize = blnResize ? "yes" : "no";

    // Set title and open popup with focus on it
    var strTitle =
        typeof this.attr("title") !== "undefined"
          ? this.attr("title")
          : "Social Share",
      strParam =
        "width=" +
        intWidth +
        ",height=" +
        intHeight +
        ",resizable=" +
        strResize,
      objWindow = window.open(this.attr("href"), strTitle, strParam).focus();
  };

  /* ================================================== */

  $(document).ready(function ($) {
    $(".customer.share").on("click", function (e) {
      $(this).customerPopup(e);
    });
  });
})(jQuery);

$("form").submit(function () {
  $(this).mysave((data) => {
    window.location.href = data.redirect;
  });
});
