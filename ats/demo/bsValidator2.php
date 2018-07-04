<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!--不缓存-->
    <META HTTP-EQUIV="pragma" CONTENT="no-cache">
    <META HTTP-EQUIV="Cache-Control" CONTENT="no-cache, must-revalidate">
    <META HTTP-EQUIV="expires" CONTENT="0">

    <link href="../third_party/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery (Bootstrap 的 JavaScript 插件需要引入 jQuery) -->
    <script src="../third_party/bootstrap-3.3.7-dist/js/jquery-3.1.1.min.js"></script>
    <!-- 包括所有已编译的插件 -->
    <script src="../third_party/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

    <!--    select2-->
    <script type="text/javascript" src="../third_party/select2-develop/dist/js/select2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../third_party/select2-develop/dist/css/select2.min.css">

    <link href="../third_party/bootstrapvalidator/dist/css/bootstrapValidator.min.css" rel="stylesheet">
    <script src="../third_party/bootstrapvalidator/dist/js/bootstrapValidator.min.js"></script>

    <script>
        $(function () {

            $('#addTaskForm').find('input[type="text"]').val('');

            var cstCh = $('input[name="customer"]');
            var sn = $('p[name="addSerialNumber"]');
            var pn = $('input[name="addPartNumber"]');
            var oem = $('input[name="addOemString"]');
            var switchId = $('input[name="addSwitchID"]');

            var defa = $('input[name="customer"]:eq(0)');
            defa.prop('checked', 'true');

            var addMachine = $("select[name='testMachine']:eq(0)");

            cstCh.change(function () {

                $('#addTaskForm').data('bootstrapValidator').destroy();
                formValidator();

                var vadio = $(this).val();

                if ("customer" === vadio) {
                    alert(1);
                    $('div[data-topic="pDmiInfo"]').css('display', 'none');
                    $('div[data-topic="inputDmiInfo"]').css('display', 'block');
                    if(null === addMachine.val()){
                        $('div[data-topic="inputDmiInfo"]').find('p').html('');
                    } else {
                        $('div[data-topic="inputDmiInfo"]').find('p').html(addMachine.val());

                    }

                } else if("default" === vadio) {
                    alert(2);
                    $('div[data-topic="inputDmiInfo"]').css('display', 'none');
                    if(null === addMachine.val()){
                        $('div[data-topic="pDmiInfo"]').css('display', 'none');

                    } else {
                        var data = addMachine.val();
                        $.ajax({
                            type: 'get',
                            url: '../function/readDmiInfoFromCSV.php',
                            data: {switchId: data},
                            dataType: 'json',
                            success: function(result){
                                $('div[data-topic="pDmiInfo"]').css('display', 'block');
                                $('p:eq(0)').html(result[0].pn);
                                $('p:eq(1)').html(result[0].sn);
                                $('p:eq(2)').html(result[0].oem);
                                $('p:eq(3)').html(data);

                            },
                            error: function () {
                                // sth

                            }

                        });

                    }


                }

            });

           formValidator();

            select2Init();


            addMachine.on("select2:select",function(e){
                console.log(addMachine.val());
                var data = addMachine.val();
                // var data = e.params.data;
                // console.log(data.text);

                if (defa.prop('checked')){
                    $.ajax({
                        type: 'get',
                        url: '../function/readDmiInfoFromCSV.php',
                        data: {switchId: data},
                        dataType: 'json',
                        success: function(result){
                            $('div[data-topic="pDmiInfo"]').css('display', 'block');
                            $('p:eq(0)').html(result[0].pn);
                            $('p:eq(1)').html(result[0].sn);
                            $('p:eq(2)').html(result[0].oem);
                            $('p:eq(3)').html(data);

                        },
                        error: function () {
                            // sth

                        }

                    });

                } else {
                    $('div[data-topic="inputDmiInfo"]').find('p').html(addMachine.val());

                }




            });

            addMachine.on("select2:clear", function (e) {
                alert(4);

                if (defa.prop('checked')){
                    $('div[data-topic="pDmiInfo"]').css('display', 'none');
                    $('div[data-topic="pDmiInfo"]').find('p').html('');
                } else {

                    $('div[data-topic="inputDmiInfo"]').find('p').html('');
                }

            });



        });

        function formValidator(){
            $('#addTaskForm').bootstrapValidator({
                message: 'This value is not valid',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    testMachine: {
                        message: 'the testMachine is not valid',
                        validators: {
                            notEmpty: {
                                message: 'The testMachine is required and can\'t be empty'
                            }
                        }
                    },
                    testImage: {
                        message: 'the testImage is not valid',
                        validators: {
                            notEmpty: {
                                message: 'The sn is required and can\'t be empty'
                            }
                        }
                    },
                    addSN: {
                        // enabled: false,
                        message: 'the sn is not valid',
                        validators: {
                            notEmpty: {
                                message: 'The sn is required and can\'t be empty'
                            },
                            stringLength: {
                                min: 5,
                                max: 10,
                                message: 'The sn must be more than 5 and less than 10 characters long'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z0-9_\. \u4e00-\u9fa5 ]+$/,
                                message: 'The sn can only consist of alphabetical, number, dot and underscore'
                            },

                        }
                    },
                    addPN: {
                        // enabled: false,
                        message: 'the pn is not valid',
                        validators: {
                            notEmpty: {
                                message: 'The pn is required and can\'t be empty'
                            },
                            stringLength: {
                                min: 5,
                                max: 20,
                                message: 'The pn must be more than 5 and less than 20 characters long'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z0-9_~!@#$%^&*-/,]+$/,
                                message: 'The pn can only consist of alphabetical, number, dot and underscore'
                            },

                        }
                    },
                    addOem: {
                        // enabled: false,
                        message: 'the oem is not valid',
                        validators: {
                            notEmpty: {
                                message: 'The oem is required and can\'t be empty'
                            },
                            stringLength: {
                                min: 5,
                                max: 50,
                                message: 'The oem must be more than 5 and less than 40 characters long'
                            },
                            regexp: {
                                // regexp: /^[a-zA-Z0-9_\. \u4e00-\u9fa5 ]+$/,
                                regexp: /^[a-zA-Z0-9_~!@#$%^&*-/,]+$/,
                                message: 'The oem can only consist of alphabetical, number, dot and underscore'
                            },

                        }
                    }
                }

            }).on('success.form.bv', function (e) {
                // Prevent form submission
                e.preventDefault();

                // Get the form instance
                var $form = $(e.target);

                // Get the BootstrapValidator instance
                var bv = $form.data('bootstrapValidator');


                // Use Ajax to submit form data
                $.post($form.attr('action'), $form.serialize(), function(result) {
                    console.log(result);
                }, 'json');
            });
        };

        // machine
        function select2Init(){
            var testMachine = $("select[name='testMachine']");
            testMachine.select2({
                width: "100%",
                ajax: {
                    url: '../function/readAddData.php',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term // search term
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: false
                },
                placeholder:'please select',
                allowClear:true
            });


            //test Image

            var testImageSelect = $("select[name='testImage']");

            testImageSelect.select2({
                    width: "100%",
                    ajax: {
                        url: 'fileLoop.php',
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                q: params.term // search term
                            };
                        },
                        processResults: function (data) {
                            return {
                                results: data
                            };
                        },
                        cache: false
                    },
                    placeholder:'please select',
                    allowClear:true
                }
            );
        }

    </script>
</head>
<body>
    <div class="container">
        <h4>validator</h4><hr>
        <form class="form-horizontal form-group-sm" id="addTaskForm" method="post" action="post.php">
            <div class="form-group">
                <label class="col-sm-3 control-label">Test Machine</label>
                <div class="col-sm-9">
                    <select class="form-control" name="testMachine">
                    </select>
                    <!--<span class="help-block"><small>Required if you choose Test Machine</small></span>-->
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Test Item</label>
                <div class="col-sm-9">
                    <select class="form-control" name="testItem">
                        <option value="">JumpStart</option>
                        <option value="0">Treboot</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Test Image</label>
                <div class="col-sm-9">
                    <select class="form-control" name="testImage">
                    </select>
                    <!--<small class="help-block">Required if you choose Test Machine</small>-->
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">TestDMIReset</label>
                <div class="col-sm-9">
                    <div class="radio">
                        <label>
                            <input type="radio" name="customer" value="default" /> default
                        </label>
                        <label>
                            <input type="radio" name="customer" value="customer" /> customer
                        </label>
                    </div>
                </div>
            </div>
            <div style="display:none;" data-topic="pDmiInfo">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Serial Number</label>
                    <div class="col-sm-9">
                        <p class="form-control-static"></p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Part Number</label>
                    <div class="col-sm-9">
                        <p class="form-control-static"></p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">OEM String</label>
                    <div class="col-sm-9">
                        <p class="form-control-static"></p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">SwitchID</label>
                    <div class="col-sm-3">
                        <p class="form-control-static"></p>
                    </div>
                </div>

            </div>
            <div style="display:none;" data-topic="inputDmiInfo">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Serial Number</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="addSN" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Part Number</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="addPN" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">OEM String</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="addOem" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">SwitchID</label>
                    <div class="col-sm-3">
                        <p class="form-control-static"></p>
                    </div>
                </div>

            </div>
            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
<!--            <button type="reset" class="btn btn-primary btn-sm">reset</button>-->
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
        </form>

    </div>



</body>