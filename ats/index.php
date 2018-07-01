<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
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
    <link rel="stylesheet" href="third_party/bootstrap-table-develop/src/extensions/page-jumpto/bootstrap-table-jumpto.css"></style>
    <script src="third_party/bootstrap-table-develop/src/extensions/page-jumpto/bootstrap-table-jumpto.js"></script>

    <!-- bootstrap-editable -->
    <link href="third_party/bootstrap3-editable-1.5.1/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet">
    <script src="third_party/bootstrap3-editable-1.5.1/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

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
            toolTipInit();

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
            $.fn.modal.Constructor.prototype.enforceFocus = function () {};

            // // 在脚本中禁止自动完成
            // function init() { element.setAttribute("AutoComplete", "off"); }

            toastrInit();

            tableInit(queryParams);

            searchTaskId();

            // caidan
            $('#caidan').click(function(){
                $('#caidanDialog').modal("toggle");;

            });

            // Diaglog
            DialogCheckBox();

            // x-editable
            editableInit();

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
                    title: '<span class="text-primary"> 端口状态<span>', //this is the top title bar of the popover. add some basic css
                    html: 'true', //needed to show html of course
                    content: '<div id="content"></div>', //this is the content of the html box. add the image here or anything you want really.
                    animation: false
                }
            ).on("mouseenter", function () {
                var _this = this;
                $(this).popover("show");
                $('#content').html('hello');
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
            var testImageSelect = $("select[name='testImage']");

            testImageSelect.select2({
                    width: "100%",
                    ajax: {
                        url: 'demo/fileLoop.php',
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

            var testMachine = $("select[name='testMachine']");
            testMachine.select2({
                width: "100%",
                ajax: {
                    url: 'function/readAddData.php',
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
            var addMachine = $("select[name='testMachine']:eq(0)");
            addMachine.on("select2:select",function(e){
                console.log(addMachine.val());
                var data = addMachine.val();
                // var data = e.params.data;
                // console.log(data.text);
                $.ajax({
                    type: 'get',
                    url: 'function/readDmiInfoFromCSV.php',
                    data: {switchId: data},
                    dataType: 'json',
                    success: function(result){
                        $('#addPartNumber').val(result[0].pn);
                        $('#addSerialNumber').val(result[0].sn);
                        $('#addoemString').val(result[0].oem);
                        $('#addSwitchID').val(data);
                    },
                    error: function () {

                    }

                });



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
        }



        function tableInit(queryPs){
            $('#taskTable').bootstrapTable({
                url: 'function/getAtsTaskInfo.php',         //请求后台的URL（*）
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
                    title: 'StartDate'
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
                        return '';
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
                // 当页面更改页码或页面大小时触发
                onPageChange: function () {
                     Pace.restart();
                },
                // 当页面更改页码或页面大小时触发
                onRefresh: function () {
                    Pace.restart();
                },
                onLoadError: function () {
                    toastr.error("Table LoadError!");
                },
                onDblClickRow: function (row, $element) {
                    // $element.addClass('btn-success');
                    var taskId=row.TaskID;
                    $.ajax({
                        type: "get",
                        url: "function/atsController.php?do=checkTaskId&" + "taskID=" + taskId,
                        dataType: "json",
                        success: function (result) {
                            console.log(result);
                            if(true ==result){
                                $("#dmiInfo").modal("toggle");

                            } else{
                                toastr.info("TaskID = " + taskId + " didn't found! <br> Please Refresh Table!");
                            }
                        },
                        error:function (xhr,status,error) {
                            toastr.error(xhr.status + " " + xhr.statusText);
                        }
                    });

                     console.log(row.TaskID);
                },

                formatNoMatches: function () {  //没有匹配的结果
                    return '<i class="text-danger">No matching records found</i>';
                }
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
                $text = $('#searchTaskNoText').val();
                if ("" === $text || null === $text){
                    toastr.error("Please Input TaskNo To Search!");
                    return;
                }

               $('#taskTable').bootstrapTable('refresh', {
                   silent: true,
                   url: 'function/getAtsTaskInfo.php',
                   query: {taskId: $text}

               });
                //tableInit(queryParamsSingle);
                // $('#table').bootstrapTable('selectPage', 1);
            });

        };

        function DialogCheckBox(){
            $("#setOrNot").prop("checked",true);

            $("#setOrNot").change(function () {
                if($("#setOrNot").prop('checked')){

                    $("span[name='dmiShowMs']").text("you can setDMI by yourself if you unchecked");
                    $('#addSn').editable('disable');
                    $('#addPn').editable('disable');
                    $('#addOem').editable('disable');

                }else{
                    $("span[name='dmiShowMs']").text("check if you want reset DMI data to default");
                    $('#addSn').editable('enable');
                    $('#addPn').editable('enable');
                    $('#addOem').editable('enable');

                }

            });


        };

        // bootstrap x-editable
        function editableInit(){
            // inline or popup (default)
            $.fn.editable.defaults.mode = 'popup';

            $('#addSn').editable('disable', {
                type: 'text',
                pk: 1,
                title: 'reset SN'
            });
            $('#addPn').editable('disable', {
                type: 'text',
                pk: 2,
                title: 'reset PN'
            });
            $('#addOem').editable('disable', {
                    type: 'text',
                    pk: 3,
                    title: 'reset OEM'
                }
            );
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
            <a class="navbar-brand" href="index.php"><i class="fas fa-cog fa-spin" style="color: blueviolet"></i>
                Auto&nbsp;Test&nbsp;System
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">
                        <i class="fas fa-user"></i>&nbsp;<span class="text-primary">&nbsp;UserName</span>
                    </a>
                </li>

                <li>
                    <a href="#" data-toggle="popover" >
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
                        <a class="btn btn-primary btn-sm" id="searchTaskNo"><i class="fa fa-search-plus fa-fw"></i>&nbsp&nbsp;Search</a>
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
                            <label for="TestImage" class="col-sm-1 control-label">TestImage</label>
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
                            <label for="AssignTask" class="col-sm-1 control-label">AssignTask</label>
                            <div class="col-sm-2">
<!--                                <input type="text" class="form-control" id="AssignTask" placeholder="AssignTask">-->
                                <select class="form-control" >
                                    <option value="">JumpStart</option>
                                    <option value="0">Treboot</option>
                                </select>
                            </div>
                            <label for="TestStatus" class="col-sm-1 control-label">TestStatus</label>
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
            <div id="toolbar" class="btn-toolbar" role="toolbar">
                <div class="btn-group" role="group" >
                    <button type="button" class="btn btn-primary btn-sm" id="task"><i class="fa fa-tasks fa-fw"></i> Task</button>
                </div>

                <div class="btn-group" role="group" style="display: none">
                    <button type="button" class="btn btn-success btn-sm" id="addTask" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus fa-fw"></i>&nbsp;Add</button>
                    <button type="button" class="btn btn-info btn-sm" id="editTask" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil-alt fa-fw"></i>&nbsp;Edit</button>
                    <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-alt  fa-fw"></i>&nbsp;Delete</button>
                    <button type="button" class="btn btn-warning btn-sm"><i class="fa fa-copy  fa-fw"></i>&nbsp;Copy</button>
                </div>
<!--                <button class="btn btn-warning pull-right btn-sm" href="#"><i class="fa fa-sync fa-spin fa-fw" aria-hidden="true"></i></button>-->
            </div>
        <!-- ADD 模态框（Modal） -->
        <div class="modal fade" id="addModal"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Add Test Task</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal form-group-sm">
                            <div class="form-group">
                                <label for="TestMachine" class="col-sm-3 control-label">Test Machine</label>
                                <div class="col-sm-7">
                                    <select class="form-control" name="testMachine">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="TestItem" class="col-sm-3 control-label">Test Item</label>
                                <div class="col-sm-7">
                                    <select class="form-control" >
                                        <option value="">JumpStart</option>
                                        <option value="0">Treboot</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="TestImage" class="col-sm-3 control-label">Test Image</label>
                                <div class="col-sm-7">
                                    <select class="form-control" name="testImage">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="TestDMIReset" class="col-sm-3 control-label">TestDMIReset</label>
                                <div class="col-sm-7">
                                    <div class="checkbox">
                                        <label class="text-danger">
                                            <input type="checkbox" id="setOrNot"><span class="small" name="dmiShowMs">you can setDMI by yourself if you unchecked</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="SerialNumber" class="col-sm-3 control-label">Serial Number</label>
                                <div class="col-sm-7">
<!--                                    <input type="text" class="form-control" id="addSerialNumber" disabled>-->
                                    <a href="#" id="addSn" class="small">Empty</a>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="PartNumber" class="col-sm-3 control-label">Part Number</label>
                                <div class="col-sm-7">
<!--                                    <input type="text" class="form-control" id="addPartNumber" disabled>-->
                                    <a href="#" id="addPn" class="small">Empty</a>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="oemString" class="col-sm-3 control-label">OEM String</label>
                                <div class="col-sm-7">
<!--                                    <input type="text" class="form-control" id="addoemString"  disabled>-->
                                    <a href="#" id="addOem" class="small">Empty</a>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">SwitchID</label>
                                <div class="col-sm-2">
<!--                                    <input type="text" class="form-control" id="addSwitchID"  disabled>-->
                                    <span class="small">Empty</span>
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
        <!-- Edit 模态框（Modal） -->
        <div class="modal fade" id="editModal"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Edit Test Task</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal form-group-sm">
                            <div class="form-group">
                                <label for="TestMachine" class="col-sm-3 control-label">Test Machine</label>
                                <div class="col-sm-7">
                                    <select class="form-control" name="state2">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="TestItem" class="col-sm-3 control-label">Test Item</label>
                                <div class="col-sm-7">
                                    <select class="form-control" >
                                        <option value="">JumpStart</option>
                                        <option value="0">Treboot</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="TestImage" class="col-sm-3 control-label">Test Image</label>
                                <div class="col-sm-7">
                                    <select class="form-control" name="testImage">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="TestDMIReset" class="col-sm-3 control-label">TestDMIReset</label>
                                <div class="col-sm-7">
                                    <div class="checkbox">
                                        <label class="text-danger">
                                            <input type="checkbox"> Use JQ
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="SerialNumber" class="col-sm-3 control-label">Serial Number</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="SerialNumber" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="PartNumber" class="col-sm-3 control-label">Part Number</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="PartNumber" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="oemString" class="col-sm-3 control-label">OEM String</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="oemString"  disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="SwitchID" class="col-sm-3 control-label">SwitchID</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="SwitchID">
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
                                <label class="col-sm-3 control-label">Serial Number</label>
                                <div class="col-sm-8">
                                    <p class="form-control-static">email@example.com</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Part Number</label>
                                <div class="col-sm-8">
                                    <p class="form-control-static">email@example.com</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">OEM String</label>
                                <div class="col-sm-8">
                                    <p class="form-control-static">email@example.comemail@example.comemail@example.com</p>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">关闭</button>
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

