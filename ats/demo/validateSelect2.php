<!DOCTYPE html>
<html>
    <head>

        <link href="../third_party/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- jQuery (Bootstrap 的 JavaScript 插件需要引入 jQuery) -->
        <script src="../third_party/bootstrap-3.3.7-dist/js/jquery-3.1.1.min.js"></script>
        <!-- 包括所有已编译的插件 -->
        <script src="../third_party/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

        <script type="text/javascript" src="../third_party/bootstrapvalidator-v0.5.2/bootstrapvalidator/dist/js/bootstrapValidator.min.js"></script>
        <script>
            $(document).ready(function(){
                init();
            });
            function init(){
                $('#s_propinsi').select2({
                    allowClear: true
                });
                // $('#s_kab_2').select2();
                valid_tambah();
                valid_edit();
            }
            function valid_tambah(){
                $('.form_tambah').bootstrapValidator({
                    message: 'This value is not valid',
                    feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {
                        s_propinsi2: {
                            validators: {
                                notEmpty: {
                                    message: 'Required'
                                }
                            }
                        },
                        name_kab2: {
                            validators: {
                                notEmpty: {
                                    message: 'Required'
                                }
                            }
                        }
                    }
                })
                    .on('success.form.bv', function(e) {
                        exc_add();
                    });


            }
        </script>

    </head>
    <body>
        <form name="form_tambah" class="form_tambah">
            <div id="tambah" class="col-md-5">
                <h4>Tambah Data Kabupaten</h4>
                <div class="form-group form-group-select2">
                    <select  name="s_propinsi2" id="s_propinsi"  class="form-control" data-live-search="true">
                        <option value="">Pilih Propinsi</option>
                        <?php
                        foreach($propinsi as $p) {
                            echo('<option value="'.$p->prop_id.'">'.$p->prop_name.'</option>');
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <input type="text" name="name_kab2" class="form-control" id="name_kab"/>
                </div>
                <button id="bt_tambah" class="btn btn-primary" ><span class="fa fa-fw fa-save"></span> Simpan</button>
            </div>
        </form>

    </body>

</html>


