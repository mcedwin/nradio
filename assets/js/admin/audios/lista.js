var url = "";

$(document).ready(function() {

    var url = window.location.href + '?json=true';
    var $table;

    var $dt = $('#mitabla'),
        conf = {
            data_source: url,
            cactions: ".ocform",
            order: [
                [0, "desc"]
            ],
            onrow: function(data) {
                html = `<div style='width:100px'>
                <a class="btn btn-success edit btn-sm" href="{baseurl}/admin/audios/editar/{id}"><i class="fas fa-edit"></i></a>
                <a class="btn btn-danger delete btn-sm" href="{baseurl}/admin/audios/borrar/{id}"><i class="fas fa-trash-alt"></i></a></td>
                </div>`;
                html = replaceAll(html, "{baseurl}", base_url);
                html = replaceAll(html, "{id}", data.DT_RowId);
                return html;
            }
        };


        var url2 = base_url + '/admin/audios/cates?json=true';
    var $table2;

    var $dt2 = $('#mitabla2'),
        conf2 = {
            data_source: url2,
            cactions: ".ocform",
            order: [
                [0, "desc"]
            ],
            onrow: function(data) {
                html = `<div style='width:100px'>
                <a class="btn btn-success edit btn-sm" href="{baseurl}/admin/audios/cate_editar/{id}"><i class="fas fa-edit"></i></a>
                <a class="btn btn-danger delete btn-sm" href="{baseurl}/admin/audios/cate_borrar/{id}"><i class="fas fa-trash-alt"></i></a>
                <a class="btn btn-warning tipo btn-sm" href="#" data-id="{id}"><i class="fa-solid fa-list"></i></a>
                </div>`;
                html = replaceAll(html, "{baseurl}", base_url);
                html = replaceAll(html, "{id}", data.DT_RowId);
                return html;
            }
        };

    $('.ocform input,.ocform select').change(function() {
        $table.draw();
        return false;
    })
    $('.ocform').submit(function() {
        $table.draw();
        return false;
    })

    $table = $dt.load_simpleTable(conf);
    $table2 = $dt2.load_simpleTable(conf2);


    $(document).on('click', '.delete', function() {
        $this = $(this);
        $.bsAlert.confirm("¿Desea eliminar el registro?", function() {
            $this.myprocess(() => {$table.draw(),$table2.draw()});
        });
        return false;
    });


    $(document).on('click', '.edit', function() {
        $(this).mydialog(function(dlg) { dlg.load_img() }, () => {$table.draw(),$table2.draw()})
        return false;
    });

    $(document).on('click', '.tipo', function() {
     $('#tipo').val($(this).data('id'))
     $table.draw()
      return false;
  });

    $(document).on('click', '.new', function() {
        $(this).mydialog(function(dlg) { dlg.load_img() }, () => {$table.draw(),$table2.draw()})
        return false;
    });

    $(document).on('click', '.activar', function() {
        $this = $(this);
        $.bsAlert.confirm("¿Desea cambiar el estado?", function() {
            $this.myprocess(() => $table.draw());
        });
        return false;
    });

    


});