<?php
session_start();
// 存储 session 数据
$_SESSION['user']='daring';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!--不缓存-->
    <META HTTP-EQUIV="pragma" CONTENT="no-cache">
    <META HTTP-EQUIV="Cache-Control" CONTENT="no-cache, must-revalidate">
    <META HTTP-EQUIV="expires" CONTENT="0">

    <link rel="shortcut icon" href="resource/pic/3.ico"/>
    <title>Auto Test System</title>
    <link href="third_party/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery (Bootstrap 的 JavaScript 插件需要引入 jQuery) -->
    <script src="third_party/bootstrap-3.3.7-dist/js/jquery-3.1.1.min.js"></script>
    <!-- 包括所有已编译的插件 -->
    <script src="third_party/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

    <script src="third_party/pace/pace.js"></script>
    <link href="third_party/pace/themes/blue/pace-theme-flash.css" rel="stylesheet"/>

    <!--fa-->
    <link rel="stylesheet" href="third_party/fontawesome-free-5.0.13/web-fonts-with-css/css/fontawesome-all.min.css">

    <!--    datetimepicker-->
    <link rel="stylesheet" href="third_party/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min.css">
    <script src="third_party/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min.js"></script>

    <!--    select2-->
    <script type="text/javascript" src="third_party/select2-develop/dist/js/select2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="third_party/select2-develop/dist/css/select2.min.css">

    <!--    toastr-->
    <link href="third_party/CodeSeven-toastr/build/toastr.min.css" rel="stylesheet" />
    <script src="third_party/CodeSeven-toastr/build/toastr.min.js"></script>

    <!--    bootstrap dataTables-->
    <link rel="stylesheet" type="text/css" href="third_party/bootstrap-table-develop/dist/bootstrap-table.min.css">
    <script type="text/javascript" src="third_party/bootstrap-table-develop/dist/bootstrap-table.min.js"></script>
    <script type="text/javascript" src="third_party/bootstrap-table-develop/dist/locale/bootstrap-table-en-US.min.js"></script>

    <!--    bootstrap dataTables extensions-->
    <link rel="stylesheet" href="third_party/bootstrap-table-develop/src/extensions/page-jumpto/bootstrap-table-jumpto.css">
    <script src="third_party/bootstrap-table-develop/src/extensions/page-jumpto/bootstrap-table-jumpto.js"></script>

    <!-- bootstrap-editable -->
    <link href="third_party/bootstrap3-editable-1.5.1/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet">
    <script src="third_party/bootstrap3-editable-1.5.1/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

    <link href="third_party/bootstrapvalidator/dist/css/bootstrapValidator.min.css" rel="stylesheet">
    <script src="third_party/bootstrapvalidator/dist/js/bootstrapValidator.min.js"></script>

    <!-- bootbox4.4 -->
    <script src="third_party/bootbox4.4/bootbox.min.js"></script>

    <style type="text/css">
        body { padding-top: 70px; }

        /*toast*/
        /*.toast-center-center {*/
            /*top: 50%;*/
            /*left: 50%;*/
            /*margin-top: -25px;*/
            /*margin-left: -150px;*/
        /*}*/


    </style>

    <script>

        $(function () {
            // ----------------------- dataInit -----------------------
            testImage = $("select[name='testImage']");
            testMachine = $("select[name='testMachine']");
            addMachine = $("select[name='testMachine']:eq(0)");
            addTestImage = $("select[name='testImage']:eq(1)");

            pDmiInfo = $('div[data-topic="pDmiInfo"]');
            pDmiInfo_product = $('div[data-topic="pDmiInfo"] p:eq(0)');
            pDmiInfo_sn = $('div[data-topic="pDmiInfo"] p:eq(1)');
            pDmiInfo_pn = $('div[data-topic="pDmiInfo"] p:eq(2)');
            pDmiInfo_oem = $('div[data-topic="pDmiInfo"] p:eq(3)');
            pDmiInfo_sys = $('div[data-topic="pDmiInfo"] p:eq(4)');
            pDmiInfo_lanIp = $('div[data-topic="pDmiInfo"] p:eq(5)');
            pDmiInfo_shelfId = $('div[data-topic="pDmiInfo"] p:eq(6)');

            inputDmiInfo = $('div[data-topic="inputDmiInfo"]');
            inputDmiInfo_lanIp = $('div[data-topic="inputDmiInfo"] p:eq(0)');
            inputDmiInfo_shelfId = $('div[data-topic="inputDmiInfo"] p:eq(1)');

            addCK = $('input[name="customer"]');
            addDefaultCK = $('input[name="customer"]:eq(0)');
            addCustomerCK = $('input[name="customer"]:eq(1)');

            // ----------------------- dataInit -----------------------

            <!-- Tooltip-->
            toolTipInit();
            <!--    popover-->
            popoverInit();

            // searchDetail
            searchDetailInit();

            //Task
            taskButton();

            // fa-chevron-circle-down
            $("i.fa-chevron-circle-down").click(function () {
                toastr.warning("点我干嘛！");
            });

            // datetimepickerInit
            datetimepickerInit();

            // select2
            select2Init();

            //modal中使用Select2搜索框无法输入
            $.fn.modal.Constructor.prototype.enforceFocus = function () {
            };

            // // 在脚本中禁止自动完成
            function init() { element.setAttribute("AutoComplete", "off"); }

            toastrInit();

            tableInit(queryParams);

            searchTaskId();

            // caidan
            $('#caidan').click(function () {
                $('#caidanDialog').modal("toggle");
            });

            addCheckBoxInit();

            addFormValidatorInit();

            // init addModal
            $('#addModal').on('show.bs.modal', function () {
                // alert(6);
                addDefaultCK.prop('checked', 'true');
                addMachine.val(null).trigger('change');
                addTestImage.val(null).trigger('change');
                pDmiInfo.css('display', 'none');
                inputDmiInfo.css('display', 'none');
                $('#addTaskForm').data('bootstrapValidator').destroy();
                addFormValidatorInit();
            });

            //advise
            $("#fineInfo").fadeIn().fadeOut(7000);

            //task button
            assignButtonInit();

            deleteTaskButtonInit();

        });
        <!-- Tooltip-->
        function toolTipInit(){
            $("[data-toggle='tooltip']").tooltip();
        };

        <!--    popover-->
        function popoverInit(){
            $("[data-toggle='popover']").popover(
                {
                    trigger: 'manual',
                    placement: 'bottom', //placement of the popover. also can use top, bottom, left or right
                    // title: '<span class="text-primary"><i class="fas fa-star"></i> check<span>', //this is the top title bar of the popover. add some basic css
                    html: 'true', //needed to show html of course
                    content: '<div id="content"></i><span class="text-warning small"><i class="fas fa-star">&nbsp;Check It</span></div>', //this is the content of the html box. add the image here or anything you want really.
                    animation: false
                }
            ).on("mouseenter", function () {
                var _this = this;
                $(this).popover("show");
                // $('#content').html('hello');
                $(this).siblings(".popover").on("mouseleave", function () {
                    $(_this).popover('hide');
                });

            }).on("mouseleave", function () {
                var _this = this;
                setTimeout(function () {
                    if (!$(".popover:hover").length) {
                        $(_this).popover("hide")
                    }
                }, 100);
            });
        };

        function searchDetailInit(){
            // searchDetail
            $('#searchDetail').click(function () {
                $('.row:eq(0)').toggle(10);
                $('.panel-info').toggle(200);
            });
            $('#returnSearch').click(function () {
                $('.panel-info').toggle();
                $('.row:eq(0)').toggle(200);
                return false;
            });
        };

        function taskButton(){
            var buttonGroup=$('.btn-group:eq(2)');
            var time=null;

            $('.btn-group:eq(1), .btn-group:eq(2)').mouseenter(function () {
                clearTimeout(time);
                buttonGroup.css('display', 'block');
            });

            // Task
            $('.btn-group:eq(1), .btn-group:eq(2)').mouseleave(function () {
                time=setTimeout(function(){
                    buttonGroup.css('display', 'none');
                },300);
            });
        };

        function datetimepickerInit(){
            // datetimepicker
            $(".form_datetime").datetimepicker({
                initialDate: new Date(),
                bootcssVer:3,
                format: "yyyy-mm-dd",
                autoclose: true,
                todayBtn: true,
                minView: 2,
                pickerPosition: "bottom-right"
            });

        };

        function  select2Init() {
            testImage.select2({
                    width: "100%",
                    ajax: {
                        // url: 'demo/fileLoop.php',
                        url: "function/atsController.php?do=getImageName4Select2",
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
                    placeholder: 'please select',
                    allowClear: true
                }
            );

            testMachine.select2({
                width: "100%",
                ajax: {
                    // url: 'function/readAddData.php',
                    url: "function/atsController.php?do=readMachine4Select2",
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


            addMachine.on("select2:select",function(e){
                console.log(addMachine.val());
                var addMachineVal = addMachine.val();
                var machineId = addMachine.select2('data')[0].text;
                if (null != machineId) {
                    machineId = machineId.replace(addMachineVal, '');
                    machineId = machineId.substring(1, machineId.length - 1);
                }
                console.log(machineId);
                // var data = e.params.data;
                // console.log(data.text);
                if (addDefaultCK.prop('checked')){
                    $.ajax({
                        type: 'get',
                        // url: 'function/readDmiInfoFromCSV.php',
                        url: "function/atsController.php?do=readTestPCInfo",
                        data: {machineId: machineId},
                        dataType: 'json',
                        success: function(result){
                            pDmiInfo.css('display', 'block');
                            pDmiInfo_product.html(result[0].product);
                            pDmiInfo_sn.html(result[0].sn);
                            pDmiInfo_pn.html(result[0].pn);
                            pDmiInfo_oem.html(result[0].oem);
                            pDmiInfo_sys.html(result[0].sys);
                            pDmiInfo_lanIp.html(result[0].lanIp);
                            pDmiInfo_shelfId.html(result[0].shelfId);
                        },
                        error: function () {
                            toastr.error("Dmi Read Failed");
                            $('#addModal').modal('hide');
                        }
                    });
                } else {
                    $.ajax({
                        type: 'get',
                        // url: 'function/readDmiInfoFromCSV.php',
                        url: "function/atsController.php?do=readTestPCInfo",
                        data: {machineId: machineId},
                        dataType: 'json',
                        success: function(result){
                            inputDmiInfo_lanIp.html(result[0].lanIp);
                            inputDmiInfo_shelfId.html(result[0].shelfId);
                        },
                        error: function () {
                            toastr.error("Dmi Read Failed");
                            $('#addModal').modal('hide');
                        }
                    });


                }
            }).on("select2:clear", function (e) {
                // alert(4);
                if (addDefaultCK.prop('checked')){
                    pDmiInfo.css('display', 'none').find('p').html('');
                } else {
                    inputDmiInfo.find('p').html('N/A');
                }
            });

        };

        function addCheckBoxInit() {
            // var cstCh = $('input[name="customer"]');
            // var addMachine = $("select[name='testMachine']:eq(0)");

            addCK.change(function () {

                $('#addTaskForm').data('bootstrapValidator').destroy();

                var vadio = $(this).val();
                var machineId = addMachine.val();

                if ("customer" === vadio) {
                    // alert(1);
                    pDmiInfo.css('display', 'none');
                    inputDmiInfo.css('display', 'block');

                    addMachine.val(null).trigger('change');
                    inputDmiInfo.find('input').val('');
                    inputDmiInfo.find('p').html('N/A');
                } else if("default" === vadio) {
                    // alert(2);
                    addMachine.val(null).trigger('change');
                    inputDmiInfo.css('display', 'none');
                    pDmiInfo.css('display', 'none');
                }
                addFormValidatorInit();
            });
        };

        function addFormValidatorInit(){
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
                            // ,stringLength: {
                            //     min: 5,
                            //     max: 20,
                            //     message: 'The testMachine(except machineId) must be more than 5 and less than 20 characters long'
                            // }
                            // ,
                            // callback: {
                            //     message: 'The testMachine(except machineId) must be more than 5 and less than 20 characters long',
                            //     callback: function (value, validator, $field) {
                            //         console.log(addMachine.select2('data'));
                            //         console.log(addMachine.select2('data').text);
                            //         var testMachine = addMachine.select2('data')[0].text;
                            //         if (null != testMachine){
                            //             testMachine =  testMachine.replace(value, '').replace('()','');
                            //         }
                            //         console.log('get_' + value);
                            //         console.log('get_' + testMachine);
                            //         if(testMachine.length >= 5 && testMachine.length <= 20){
                            //             return true;
                            //         }
                            //         return false;
                            //     }
                            // }
                        }
                    },
                    testImage: {
                        message: 'the testImage is not valid',
                        validators: {
                            notEmpty: {
                                message: 'The testImage is required and can\'t be empty'
                            }
                            // , stringLength: {
                            //     min: 4,
                            //     max: 20,
                            //     message: 'The testImage must be more than 4 and less than 20 characters long'
                            // }
                            // ,
                            // callback: {
                            //     message: 'The testImage must be more than 4 and less than 20 characters long',
                            //     callback: function (value, validator) {
                            //         var testImage = addTestImage.select2('data')[0].text;
                            //         console.log('get_' + value);
                            //         console.log('get_' + testImage);
                            //         if(testImage.length >= 4 && testImage.length <= 20){
                            //             return true;
                            //         }
                            //         return false;
                            //     }
                            // }
                        }
                    },
                    addProduct: {
                        message: 'the Product Name is not valid',
                        validators: {
                            notEmpty: {
                                message: 'The product name is required and can\'t be empty'
                            },
                            stringLength: {
                                min: 5,
                                max: 30,
                                message: 'The product name must be more than 5 and less than 20 characters long'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z0-9_~!@#$%^&*-/,]+$/,
                                message: 'The product name can only consist of special character like ~!@#$%^&*-/, , number, en.'
                            }

                        }
                    },
                    addSN: {
                        message: 'the sn is not valid',
                        validators: {
                            notEmpty: {
                                message: 'The sn is required and can\'t be empty'
                            },
                            stringLength: {
                                min: 5,
                                max: 20,
                                message: 'The sn must be more than 5 and less than 20 characters long'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z0-9_~!@#$%^&*-/,]+$/,
                                message: 'The sn can only consist of special character like ~!@#$%^&*-/, , number, en.'
                            }

                        }
                    },
                    addPN: {
                        message: 'the pn is not valid',
                        validators: {
                            notEmpty: {
                                message: 'The pn is required and can\'t be empty'
                            },
                            stringLength: {
                                min: 5,
                                max: 30,
                                message: 'The pn must be more than 5 and less than 20 characters long'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z0-9_~!@#$%^&*-/,]+$/,
                                message: 'The pn can only consist of special character like ~!@#$%^&*-/, , number, en.'
                            }

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
                                max: 100,
                                message: 'The oem must be more than 5 and less than 100 characters long'
                            },
                            regexp: {
                                // regexp: /^[a-zA-Z0-9_\. \u4e00-\u9fa5 ]+$/,
                                regexp: /^[a-zA-Z0-9_~!@#$%^&*-/,]+$/,
                                message: 'The oem can only consist of special character like ~!@#$%^&*-/, , number, en.'
                            }

                        }
                    },
                    addSystem: {
                        // enabled: false,
                        message: 'the sytsem config is not valid',
                        validators: {
                            notEmpty: {
                                message: 'The sytsem config is required and can\'t be empty'
                            },
                            stringLength: {
                                min: 1,
                                max: 20,
                                message: 'The sytsem config must be more than 5 and less than 100 characters long'
                            },
                            regexp: {
                                // regexp: /^[a-zA-Z0-9_\. \u4e00-\u9fa5 ]+$/,
                                regexp: /^[a-zA-Z0-9_~!@#$%^&*-/,]+$/,
                                message: 'The sytsem config can only consist of special character like ~!@#$%^&*-/, , number, en.'
                            }

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

                var testMachine = addMachine.select2('data')[0].text;
                var testItem = $('select[name="testItem"] option:selected').text();
                var testImage = addTestImage.select2('data')[0].text;
                // var machineId = addMachine.select2('val');

                var addMachineVal = addMachine.val();
                var machineId = addMachine.select2('data')[0].text;
                if (null != machineId) {
                    machineId = machineId.replace(addMachineVal, '');
                    machineId = machineId.substring(1, machineId.length - 1);
                }

                // console.log(machineId);
                if (addDefaultCK.prop('checked')){
                    // Use Ajax to submit form data
                    $.ajax({
                        type : "get",
                        url: "function/atsController.php?do=addTask",
                        data: {
                            testMachine: testMachine,
                            machineId: machineId,
                            testItem: testItem,
                            testImage: testImage,
                            customer: 'default',
                            addProduct: pDmiInfo.find('p:eq(0)').text(),
                            addSN: pDmiInfo.find('p:eq(1)').text(),
                            addPN: pDmiInfo.find('p:eq(2)').text(),
                            addOem:pDmiInfo.find('p:eq(3)').text(),
                            addSystem: pDmiInfo.find('p:eq(4)').text(),
                            lanIp: pDmiInfo.find('p:eq(5)').text(),
                            shelf: pDmiInfo.find('p:eq(6)').text(),
                        },
                        success : function (result) {
                            console.log(result);
                            if (result == "success") {
                                toastr.success('add success!');

                            } else {
                                toastr.error('add fail! try again ');
                            }
                        },
                        error : function(xhr,status,error){
                            toastr.error(xhr.status + ' add fail! ');
                        },
                        complete : function () {
                            $('#addModal').modal('hide');
                            $('#taskTable').bootstrapTable('selectPage', 1);
                        }
                    });

                } else {
                    // Use Ajax to submit form data
                    $.ajax({
                        type : "get",
                        url: "function/atsController.php?do=addTask",
                        data: {
                            testMachine: testMachine,
                            machineId: machineId,
                            testItem: testItem,
                            testImage: testImage,
                            customer: 'customer',
                            addProduct: inputDmiInfo.find('input:eq(0)').val(),
                            addSN: inputDmiInfo.find('input:eq(1)').val(),
                            addPN: inputDmiInfo.find('input:eq(2)').val(),
                            addOem: inputDmiInfo.find('input:eq(3)').val(),
                            addSystem: inputDmiInfo.find('input:eq(4)').val(),
                            lanIp: inputDmiInfo.find('p:eq(0)').text(),
                            shelf: inputDmiInfo.find('p:eq(1)').text(),
                        },
                        success : function (result) {
                            console.log(result);
                            if (result == "success") {
                                toastr.success('add success!');

                            } else {
                                toastr.error('add fail! try again ');
                            }
                        },
                        error : function(xhr,status,error){
                            toastr.error(xhr.status + ' add fail! ');
                        },
                        complete : function () {
                            $('#addModal').modal('hide');
                            $('#taskTable').bootstrapTable('selectPage', 1);
                        }
                    });

                }
            });

        };

        function  toastrInit() {

            // toastr
            toastr.options.positionClass = 'toast-top-center';
            toastr.options.closeButton = true;
            // css
            // toastr.options.positionClass = 'toast-center-center';

            toastr.options.timeOut = 2000; // How long the toast will display without user interaction
            toastr.options.extendedTimeOut = 2000; // How long the toast will display after a user hovers over it

            // toastr.options.progressBar = true;
        };

        function tableInit(queryPs){
            $('#taskTable').bootstrapTable({
                url: 'function/atsTaskInfoPageInit.php',         //请求后台的URL（*）
                method: 'get',                      //请求方式（*）
                classes: 'table table-responsive table-hover table-no-bordered', // table 样式
                iconSize: 'sm',
                buttonsClass: 'warning',
                toolbar: '#toolbar',                //工具按钮用哪个容器
                striped: true,                      //是否显示行间隔色
                cache: false,                       //是否使用缓存，默认为true，所以一般情况下需要设置一下这个属性（*）
                pagination: true,                   //是否显示分页（*）
                // sortable: true,                     //是否启用排序
                // sortOrder: "asc",                   //排序方式
                queryParamsType : "",                   //默认是limit，则para为params.limit, params.offset
                queryParams: queryPs,
                clickToSelect: false,               //点击行即可选中单选/复选框
                sidePagination: "server",           //分页方式：client客户端分页，server服务端分页（*）
                pageNumber:1,                       //初始化加载第一页，默认第一页
                pageSize: 10,                       //每页的记录行数（*）
                pageList: [10, 25, 50],        //可供选择的每页的行数（*）
                search: false,                       //是否显示表格搜索，此搜索是客户端搜索，不会进服务端
                strictSearch: true,
                showColumns: true,                  //是否显示所有的列
                showRefresh: true,                  //是否显示刷新按钮
                minimumCountColumns: 2,             //最少允许的列数
                // height: 500,                        //行高，如果没有设置height属性，表格自动根据记录条数觉得表格高度
                uniqueId: "TaskID",                     //每一行的唯一标识，一般为主键列
                showToggle:false,                    //是否显示详细视图和列表视图的切换按钮
                cardView: false,                    //是否显示详细视图
                detailView: false,                   //是否显示父子表
                columns: [{
                    checkbox: true
                }, {
                    field: 'TaskID',
                    title: 'TaskID',
                    formatter:function(value, row, index){
                        return 'ATS_' + value;
                    }
                }, {
                    field: 'TestMachine',
                    title: 'Test Machine',
                    formatter:function(value, row, index){
                        return value;
                    }
                }, {
                    field: 'TestImage',
                    title: 'Test Image'
                }, {
                    // field: 'DMI_SerialNumer',
                    // title: 'Serial Numer'
                    field: 'MachineID',
                    title: 'MachineID'
                }, {
                    field: 'TestItem',
                    title: 'Assigned Task'
                }, {
                    field: 'TaskStatus',
                    title: 'Task Status',
                    formatter:function(value, row, index){
                        if (0==value){
                            return "pending";
                        }else if (1==value){
                            return "ongoing";
                        }else if (1==value){
                            return "ongoing";
                        }else if (2==value){
                            return "finished";
                        }else if (3==value){
                            return "Cancelled";
                        }else if (4==value){
                            return "Abnormal End";
                        }
                        return "N/A";
                    }
                }, {
                    field: 'TestStartTime',
                    title: 'StartDate',
                }, {
                    field: 'TestEndTime',
                    title: 'FinishDate'
                }, {
                    field: 'TestResult',
                    title: 'Test Result',
                    formatter: function(value, row, index){
                        if("fail"==value){
                            return '<a target="_blank" href=file://' + row.TestResultPath  + '><i class="fas fa-times fa-fw"></i>&nbsp;' + value + '</a>';
                        } else if("pass"==value){
                            return '<a target="_blank" href=file://' + row.TestResultPath + '><i class="fas fa-check fa-fw"></i>&nbsp;' + value + '</a>';
                        }
                        return "N/A";
                        // return "<a href=" +  + "></a>";
                    }
                }
                ],
                rowStyle: function(row, index){
                    if("fail"==row.TestResult){
                        return {classes: 'danger'};
                    }else if("pass"==row.TestResult){
                        return {classes: 'active'};
                    }else if(0==row.TaskStatus){
                        return {classes: 'info'};
                    }
                    return {classes: 'warning'};
                },

                formatLoadingMessage: function () {
                    return '<i class="fas fa-spinner fa-2x fa-pulse" style="color:#96B97D"></i>';
                },
                // onLoadSuccess: function () {
                //     Pace.restart();
                // },
                onLoadError: function () {
                    toastr.error("Table LoadError!");
                },
                formatNoMatches: function () {  //没有匹配的结果
                    return '<i class="text-danger">No matching records found</i>';
                }
            }).on('dbl-click-row.bs.table', function(row, $element, field){
                    console.log($element);
                    var taskId=$element.TaskID;
                    console.log(taskId);
                    $.ajax({
                        type: "get",
                        url: "function/atsController.php?do=getAtsInfoByTaskId&" + "taskID=" + taskId,
                        dataType: "json",
                        success: function (result) {
                            console.log(result.flag);
                            if(result.flag){
                                $("#dmiInfo").find('p:eq(0)').html(result.row['TaskID']);
                                $("#dmiInfo").find('p:eq(1)').html(result.row['DMI_ProductName']);
                                $("#dmiInfo").find('p:eq(2)').html(result.row['DMI_SerialNumber']);
                                $("#dmiInfo").find('p:eq(3)').html(result.row['DMI_PartNumber']);
                                $("#dmiInfo").find('p:eq(4)').html(result.row['DMI_OEMString']);
                                $("#dmiInfo").find('p:eq(5)').html(result.row['DMI_SystemConfig']);
                                $("#dmiInfo").modal("toggle");
                            }
                            else{
                                toastr.info("TaskID = " + taskId + " didn't found! Please Refresh Table!");
                            }
                        },
                        error:function (xhr,status,error) {
                            toastr.error(xhr.status + " " + xhr.statusText);
                        }
                    });
            });

        };

        function queryParams(params) {
            var temp = {   //这里的键的名字和控制器的变量名必须一直，这边改动，控制器也需要改成一样的
                pageSize : params.pageSize,
                pageNumber : params.pageNumber
            };
            return temp;//传递参数（*
        };

        // click search to send para
        // function queryParamsSingle(params) {
        //     var temp = {   //这里的键的名字和控制器的变量名必须一直，这边改动，控制器也需要改成一样的
        //         limit: params.limit,   //页面大小
        //         offset: params.offset/params.limit+1, //页码
        //         taskId:$('#searchTaskNoText').val()
        //     };
        //     return temp;//传递参数（*）
        // };

        function searchTaskId(){
            $('#searchTaskNo').click(function () {
                console.log($('#searchTaskNoText').val());
                var text = $('#searchTaskNoText').val();
                if ("" === text || null === text){
                    toastr.error("Please Input TaskNo To Search!");
                    return;
                }

               $('#taskTable').bootstrapTable('refresh', {
                   silent: true,
                   url: 'function/atsTaskInfoPageInit.php',
                   query: {taskId: text}

               });
                //tableInit(queryParamsSingle);
                // $('#table').bootstrapTable('selectPage', 1);
            });

        };

        function assignButtonInit(){
            $('#assignTask').click( function () {
                var ckArr = $('#taskTable').bootstrapTable('getSelections');
                console.log(ckArr);

                if(ckArr.length == 0){
                    toastr.info("Please select at least one checkbox");

                } else if(ckArr.length >= 1 && ckArr.length<= 5){
                    $.ajax({
                        type: "get",
                        url: "function/atsController.php?do=checkAtsInfoByMultiTaskId",
                        data: {multiTask: ckArr},
                        dataType: 'json',
                        success: function (result) {
                            console.log(result.NoTaskIdFlag);
                            console.log(result.NotPendingFlag);

                            if (result.NoTaskIdFlag){
                                toastr.info("TaskID = " + result.saveNoTaskId + " didn't found! Please Refresh Table!");
                                return;
                            }
                            if (result.NotPendingFlag) {
                                toastr.info("TaskID = " + result.saveNotPending + " not pending! cannnot assign to ATS");
                                return;
                            }

                            // assign to ATS
                            $.ajax({
                                type: "get",
                                url: "function/atsController.php?do=assignAtsInfoByMultiTaskId",
                                data: {multiTask: ckArr},
                                // dataType: 'json',
                                success: function (result) {
                                    if("done" === result){
                                        toastr.success("success assign to ATS");
                                        $('#taskTable').bootstrapTable('selectPage', 1);
                                    } else {
                                        toastr.error(result);
                                    }
                                },
                                error: function () {
                                    toastr.error("fail assign to ATS");
                                }
                            });
                        },
                        error: function (xhr,status,error) {
                            toastr.error(xhr.status + " " + xhr.statusText);
                        }
                    });
                } else {
                    toastr.warning("Please select not more than five checkbox");
                }

            });
        }

        function deleteTaskButtonInit() {
            $('#deleteTask').click(function () {
                var ckArr = $('#taskTable').bootstrapTable('getSelections');
                console.log(ckArr);

                if(ckArr.length == 0){
                    toastr.info("Please select at least one checkbox");
                    return;

                }
                if(ckArr.length >= 1 && ckArr.length<= 5){

                    bootbox.confirm({
                        message: " Do you want delete ?",
                        buttons: {
                            confirm: {
                                label: 'Yes',
                                className: 'btn-success'
                            },
                            cancel: {
                                label: 'No',
                                className: 'btn-danger'
                            }
                        },
                        callback: function (result) {
                            if(result){
                                $.ajax({
                                    type: "get",
                                    url: "function/atsController.php?do=checkAtsInfoByMultiTaskId",
                                    data: {multiTask: ckArr},
                                    dataType: 'json',
                                    success: function (result2) {
                                        console.log(result2.NoTaskIdFlag);
                                        console.log(result2.NotPendingFlag);

                                        if (result2.NoTaskIdFlag){
                                            toastr.info("TaskID = " + result2.saveNoTaskId + " didn't found! Please Refresh Table!");
                                            return;
                                        }
                                        if (result2.NotPendingFlag) {
                                            toastr.info("TaskID = " + result2.saveNotPending + " not pending! cannnot delete");
                                            return;
                                        }

                                        // delete
                                        $.ajax({
                                            type: "get",
                                            url: "function/atsController.php?do=deleteAtsInfoByMultiTaskId",
                                            data: {multiTask: ckArr},
                                            // dataType: 'json',
                                            success: function (result2) {
                                                if("done" == result2){
                                                    toastr.success("success deleted");
                                                    $('#taskTable').bootstrapTable('selectPage', 1);
                                                } else {
                                                    toastr.error(result2);
                                                }
                                            },
                                            error: function () {
                                                toastr.error("fail deleted");
                                            }
                                        });
                                    },
                                    error: function (xhr,status,error) {
                                        toastr.error(xhr.status + " " + xhr.statusText);
                                    }
                                });

                            }
                        }
                    });

                } else {
                    toastr.warning("Please select not more than five checkbox");
                }

                });
            };


    </script>

</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <!--            bs-example-navbar-collapse-1折叠的开关-->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="atsIndex.php"><i class="fas fa-cog fa-spin" style="color: blueviolet"></i>
                Automation&nbsp;Test&nbsp;Platform
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">
                        <i class="fas fa-user"></i>&nbsp;<span class="text-primary">&nbsp<?php echo $_SESSION['user']; ?> </span>
                    </a>
                </li>

                <li>
                    <a target="_blank" href="view/detectTestPCWebsocketd.html" data-toggle="popover" >
                        <i class="fas fa-plug"></i>&nbsp;<span class="text-warning">&nbsp;PortStatus</span>
                    </a>
                </li>

                <li><a href="#">
                        <i class="fas fa-sign-out-alt">&nbsp;</i><span class="text-danger">&nbsp;Exit</span>
                    </a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<!--<button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="right" title="右侧的 Tooltip">右侧的-->
<!--    Tooltip-->
<!--</button>-->
    <div class="container">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-sm-offset-3 col-md-offset-8 ">
                <form class="form-inline">
                    <div class="form-group">
                        <label class="sr-only" for="searchTaskNoText">TaskNo</label>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fas fa-sort-numeric-up fa-fw"></i><small>&nbsp;TaskNo</small></div>
                            <input type="text" class="form-control input-sm" id="searchTaskNoText" placeholder="Please input TaskNo">
                        </div>
                    </div>
                    <div class="btn-group">
                        <a class="btn btn-primary btn-sm" id="searchTaskNo"><i class="fa fa-search-plus fa-fw"></i>&nbsp;&nbsp;Search</a>
                        <a class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" id="searchDetail">
                            <span class="fa fa-caret-down" data-toggle="tooltip" data-placement="right" title="click&nbsp;me!"></span>
                        </a>
                    </div>
                </form>
            </div>
        </div>

            <div class="panel panel-info" style="display: none">
                <div class="panel panel-heading">
                    <small id="caidan"><i class="fas fa-search-plus fa-fw">&nbsp;Search</i></small>
                    <i class="fas fa-chevron-circle-down fa-fw pull-right"></i>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal form-group-sm">
<!--                        first line form-->
                        <div class="form-group">
                            <label for="TaskID" class="col-sm-1 control-label">TaskID</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="TaskID" placeholder="TaskID">
                            </div>
                            <label for="TestPC" class="col-sm-1 control-label">TestPC</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="TestPC" placeholder="TestPC">
                            </div>
                            <label class="col-sm-1 control-label">TestImage</label>
                            <div class="col-sm-2">
<!--                                <input type="text" class="form-control" id="TestImage" placeholder="TestImage">-->
                                <select class="form-control" name="testImage">
                                </select>
                            </div>
                            <label for="SerialNo" class="col-sm-1 control-label">SerialNo</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="SerialNo" placeholder="SerialNo">
                            </div>
                        </div>
<!--                        second line form-->
                        <div class="form-group">
                            <label for="StartDate" class="col-sm-1 control-label">StartDate</label>
                            <div class="col-sm-2">
                                <input type="text"  class="form_datetime form-control" id="StartDate" placeholder="StartDate">
                            </div>
                            <label for="FinishDate" class="col-sm-1 control-label">FinishDate</label>
                            <div class="col-sm-2">
                                <input type="text"  class="form_datetime form-control" id="FinishDate" placeholder="FinishDate">
                            </div>
                            <label class="col-sm-1 control-label">AssignTask</label>
                            <div class="col-sm-2">
<!--                                <input type="text" class="form-control" id="AssignTask" placeholder="AssignTask">-->
                                <select class="form-control" >
                                    <option value="0">Please Select</option>
                                    <option value="1">JumpStart</option>
                                    <option value="2">Treboot</option>
                                </select>
                            </div>
                            <label class="col-sm-1 control-label">TestStatus</label>
                            <div class="col-sm-2">
                                <select class="form-control" >
                                    <option value="">Select</option>
                                    <option value="0">Pending</option>
                                    <option value="1">OnGoing</option>
                                    <option value="2">Finished</option>
                                    <option value="3">Cancelled</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-info btn-sm col-md-offset-4" ><i class="fas fa-check-circle fa-fw"></i>&nbsp;Submit</button>
                        <button type="reset" class="btn btn-success btn-sm col-md-offset-1"><i class="fa fa-undo fa-fw"></i>&nbsp;Reset</button>
                        <button class="btn btn-primary btn-sm col-md-offset-1" id="returnSearch"><i class="fas fa-long-arrow-alt-left fa-fw"></i>&nbsp;Back</button>

                    </form>

                </div>
            </div>
        <hr>
        <div class="alert alert-warning" id="fineInfo" style="display: none">
            <a href="#" class="close" data-dismiss="alert">
                &times;
            </a>
            <strong><i class="fa fa-hand-point-right fa-fw"></i>&nbsp;Info: </strong><i>&nbsp;You can double click table row to see DMI info.</i>
        </div>
            <div id="toolbar" class="btn-toolbar" role="toolbar">
                <div class="btn-group" role="group" >
                    <button type="button" class="btn btn-primary btn-sm" id="task"><i class="fa fa-tasks fa-fw"></i>&nbsp;Task</button>
                </div>

                <div class="btn-group" role="group" style="display: none">
                    <button type="button" class="btn btn-success btn-sm" id="addTask" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus fa-fw"></i>&nbsp;Add</button>
                    <button type="button" class="btn btn-warning btn-sm" id="assignTask"><i class="fa fa-wrench fa-fw"></i>&nbsp;Assign</button>
                    <button type="button" class="btn btn-info btn-sm" id="editTask" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil-alt fa-fw"></i>&nbsp;Edit</button>
                    <button type="button" class="btn btn-danger btn-sm" id="deleteTask"><i class="fa fa-trash-alt  fa-fw"></i>&nbsp;Delete</button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-copy  fa-fw"></i>&nbsp;Copy</button>
                </div>
<!--                <button class="btn btn-warning pull-right btn-sm" href="#"><i class="fa fa-sync fa-spin fa-fw" aria-hidden="true"></i></button>-->
            </div>
        <!-- ADD 模态框（Modal） -->
        <div class="modal fade" id="addModal"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" >Add Test Task</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal form-group-sm" id="addTaskForm" method="post">
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
                                        <option value="1">JumpStart</option>
                                        <option value="2">Treboot</option>
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
                                    <label class="col-sm-3 control-label">Product Name</label>
                                    <div class="col-sm-9">
                                        <p class="form-control-static"></p>
                                    </div>
                                </div>
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
                                    <label class="col-sm-3 control-label">SystemConfig</label>
                                    <div class="col-sm-9">
                                        <p class="form-control-static"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">LANIP</label>
                                    <div class="col-sm-3">
                                        <p class="form-control-static"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">ShelfID_SwitchID</label>
                                    <div class="col-sm-3">
                                        <p class="form-control-static"></p>
                                    </div>
                                </div>

                            </div>
                            <div style="display:none;" data-topic="inputDmiInfo">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Product Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="addProduct" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Serial Number</label>
                                    <div class="col-sm-9">
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
                                    <label class="col-sm-3 control-label">SystemConfig</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="addSystem" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">LANIP</label>
                                    <div class="col-sm-3">
                                        <p class="form-control-static"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">ShelfID_SwitchID</label>
                                    <div class="col-sm-3">
                                        <p class="form-control-static"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                <!--<button type="reset" class="btn btn-primary btn-sm">reset</button>-->
                                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal -->
        </div>
        <!-- Edit 模态框（Modal） -->
        <div class="modal fade" id="editModal"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Edit Test Task</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal form-group-sm" id="editForm">
                            <div class="form-group" style="display: none">
                                <label class="col-sm-3 control-label"></label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Test Machine</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" disabled="disabled">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Test Item</label>
                                <div class="col-sm-7">
                                    <select class="form-control" >
                                        <option value="1">JumpStart</option>
                                        <option value="2">Treboot</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Test Image</label>
                                <div class="col-sm-7">
                                    <select class="form-control" name="testImage">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="TestDMIReset" class="col-sm-3 control-label">TestDMIReset</label>
                                <div class="col-sm-7">
                                    <div class="btn btn-default btn-sm">getDMI</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-3 control-label">Product Name</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Serial Number</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Part Number</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">OEM String</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">SystemConfig</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">LANIP</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">ShelfID_SwitchID</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" disabled>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-sm">Submit</button>
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal -->
        </div>

        <table id="taskTable" class="" data-show-jumpto="true">
        </table>
<!--        dmi info-->
        <div class="modal fade" id="dmiInfo"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">DMI INFO</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal form-group-sm">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Task ID</label>
                                <div class="col-sm-8">
                                    <p class="form-control-static">Task ID</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Product Name</label>
                                <div class="col-sm-8">
                                    <p class="form-control-static"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Serial Number</label>
                                <div class="col-sm-8">
                                    <p class="form-control-static"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Part Number</label>
                                <div class="col-sm-8">
                                    <p class="form-control-static"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">OEM String</label>
                                <div class="col-sm-8">
                                    <p class="form-control-static"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">System Config</label>
                                <div class="col-sm-8">
                                    <p class="form-control-static"></p>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">close</button>
                    </div>
                </div>
            </div>
        </div>
<!--        caidanDialog-->
        <div class="modal fade bs-example-modal-sm" id="caidanDialog"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">ATS彩蛋</h4>
                    </div>
                    <div class="modal-body text-center" >
                        <img src="resource/pic/caidan.png">
                    </div>
                    <div class="modal-footer">
                        <blockquote>
                            <i class="text-info">扫一扫，有惊喜！</i>
                            <button type="button" class="btn btn-default btn-primary btn-sm" data-dismiss="modal">关闭</button>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

