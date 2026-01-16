$("#contribucion").val(wpautop($("#contribucion").val()))
tinymce.init({
  selector: "textarea#contribucion",
  //toolbar: false,
  menubar: false,
  promotion: false,
  convert_urls: false,
  branding: false,
  statusbar: false,
  height: 300,
  plugins: [
    'advlist', 'autolink', 'lists', 'link', 'image', 
    'charmap', 'preview', 'anchor', 'searchreplace', 
    'visualblocks', 'code', 'fullscreen', 
    'insertdatetime', 'media', 'help', 'wordcount',
    'forecolor', 'backcolor', 'textcolor'
  ],
  toolbar: [
    // Formato de texto
    'undo redo | ' +
    'styles | ' + // Tipos de encabezados
    
    // Estilos de texto
    'bold italic underline | ' + // Negrita, cursiva, subrayado
    'backcolor | ' + // Color de texto y fondo
    
    // Alineación y lista
    'alignleft aligncenter alignright alignjustify | ' +
    'bullist numlist outdent indent | ' +
    
    // Medios y enlaces
    'link unlink image | ' +
    
    // Herramientas adicionales
    'removeformat code'
  ],
  
  // Configuración de estilos predefinidos
  style_formats: [
    { title: 'Encabezado 1', block: 'h1' },
    { title: 'Encabezado 2', block: 'h2' },
    { title: 'Encabezado 3', block: 'h3' },
    { title: 'Encabezado 4', block: 'h4' },
    { title: 'Párrafo', block: 'p' }
  ],
  
  // Familias de fuentes
  font_family_formats: 
    'Arial=arial,helvetica,sans-serif;' +
    'Courier New=courier new,courier,monospace;' +
    'Times New Roman=times new roman,times,serif;' +
    'Verdana=verdana,geneva,sans-serif',
  
  // Tamaños de fuente
  font_size_formats: 
    '8pt 10pt 12pt 14pt 16pt 18pt 24pt 36pt 48pt',
  
  // Configuraciones de LINKS
  link_default_target: '_blank',
  link_title: true,
  link_context_toolbar: true,

  // Configuraciones de IMAGENES
  image_title: true,
  automatic_uploads: true,
  file_picker_types: 'image',
  images_upload_url: '/upload-imagen',
  
  // Manejador personalizado de selección de archivos
  file_picker_callback: function (cb, value, meta) {
    var input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('accept', 'image/*');

    input.onchange = function () {
      var file = this.files[0];
      var reader = new FileReader();
      
      reader.onload = function () {
        var id = 'blobid' + (new Date()).getTime();
        var blobCache = tinymce.activeEditor.editorUpload.blobCache;
        var base64 = reader.result.split(',')[1];
        var blobInfo = blobCache.create(id, file, base64);
        blobCache.add(blobInfo);

        cb(blobInfo.blobUri(), { title: file.name });
      };
      
      reader.readAsDataURL(file);
    };

    input.click();
  },

  // Estilo de contenido
  /*content_style: 
    'body { ' +
    'font-family: Arial, sans-serif; ' +
    'font-size: 14px; ' +
    'line-height: 1.6; ' +
    '}' +
    'img { max-width: 100%; height: auto; }',
*/
  setup: (editor) => {
    editor.on('submit', function() {
        return false;
    });
    
    editor.on('init', function() {
        //$("textarea#default").text(pre_wpautop($("#contenido").val()));
       // editor.execCommand('mceInsertContent', false, wpautop($("#detalle").val()));
    });
}
});

$(document).ready(function() {
  $('form').load_img1()

  $("form").submit(function () {
    $("#contribucion").val(
      pre_wpautop(tinyMCE.activeEditor.getContent())
    );
    $(this).mysave((data) => { window.location.href = data.redirect });
    return false;
  });
  
});