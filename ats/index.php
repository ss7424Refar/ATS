<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="resource/pic/3.ico"/>
    <title>Auto Test System</title>
    <link href="third_party/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery (Bootstrap 的 JavaScript 插件需要引入 jQuery) -->
    <script src="third_party/bootstrap-3.3.7-dist/js/jquery-3.1.1.js"></script>
    <!-- 包括所有已编译的插件 -->
    <script src="third_party/bootstrap-3.3.7-dist/js/bootstrap.js"></script>

    <script src="third_party/pace/pace.js"></script>
    <link href="third_party/pace/themes/blue/pace-theme-flash.css" rel="stylesheet"/>

    <!--fa-->
    <link rel="stylesheet" href="third_party/fontawesome-free-5.0.13/web-fonts-with-css/css/fontawesome-all.css">

    <!--    datetimepicker-->
    <link rel="stylesheet" href="third_party/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.css">
    <script src="third_party/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.js"></script>

    <script type="text/javascript" src="third_party/select2-develop/dist/js/select2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="third_party/select2-develop/dist/css/select2.min.css">

    <style type="text/css">
        body { padding-top: 70px; }

    </style>

    <script>
        <!-- Tooltip-->
        $(function () {
            $("[data-toggle='tooltip']").tooltip();
        });
        <!--    popover-->
        $(function () {
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
        });
        // searchDetail
        $(function () {
            // $('.panel-info').hide();
            $('#searchDetail').click(function () {
                $('.row:eq(0)').toggle(10);
               $('.panel-info').toggle(200);
            });
            $('#returnSearch').click(function () {
                $('.panel-info').toggle();
                $('.row:eq(0)').toggle(200);
            });

        });

        // Task
        $(function () {
            var buttonGroup=$('.btn-group:eq(2)');
            var time=null;

            $('.btn-group:eq(1), .btn-group:eq(2)').mouseenter(function () {
                clearTimeout(time);
                buttonGroup.css('display', 'block');
            });

            $('.btn-group:eq(1), .btn-group:eq(2)').mouseleave(function () {
                    time=setTimeout(function(){
                        buttonGroup.css('display', 'none');
                    },300);
            });
        });

        // fa-chevron-circle-down
        $(function () {
            $("i.fa-chevron-circle-down").click(function () {
                alert("点我干嘛！");
            });

        });
        // datetimepicker
        $(function () {
            $(".form_datetime").datetimepicker({
                initialDate: new Date(),
                bootcssVer:3,
                format: "yyyy-mm-dd",
                autoclose: true,
                todayBtn: true,
                minView: 2,
                pickerPosition: "bottom-right"
            });
        });

        // select2
        $(function () {
            var data = [
                {
                    id: 0,
                    text: 'enhancement'
                },
                {
                    id: 1,
                    text: 'bug'
                },
                {
                    id: 2,
                    text: 'duplicate'
                },
                {
                    id: 3,
                    text: 'invalid'
                },
                {
                    id: 4,
                    text: 'wontfix'
                }
            ];

            $('.js-example-basic-single').select2({
                    width: "100%",
                    data: data
                    // dropdownParent: "#addModal"
                }
            );
        });
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
            <a class="navbar-brand" href="#"><i class="fas fa-cog fa-spin" style="color: blueviolet"></i>
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
                        <label class="sr-only" for="exampleInputAmount">TaskNo</label>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fas fa-sort-numeric-up fa-fw"></i><small>&nbsp;TaskNo</small></div>
                            <input type="text" class="form-control input-sm" id="exampleInputAmount" placeholder="Please input TaskNo">
                        </div>
                    </div>
                    <div class="btn-group">
                        <a class="btn btn-primary btn-sm" href="#"><i class="fa fa-search-plus fa-fw"></i>&nbsp;Search</a>
                        <a class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" id="searchDetail">
                            <span class="fa fa-caret-down" data-toggle="tooltip" data-placement="right" title="click&nbsp;me!"></span>
                        </a>
                    </div>
                </form>
            </div>
        </div>

            <div class="panel panel-info" style="display: none">
                <div class="panel panel-heading">
                    <small><i class="fas fa-search-plus fa-fw">&nbsp;Search</i></small>
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
                                <select class="js-example-basic-single form-control" name="state1">
                                    <option value="AL">Alabama</option>
                                    <option value="WY">Wyoming</option>
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
                        <button type="submit" class="btn btn-success btn-sm col-md-offset-1"><i class="fa fa-undo fa-fw"></i>&nbsp;Reset</button>
                        <button type="reset" class="btn btn-primary btn-sm col-md-offset-1" id="returnSearch"><i class="fas fa-long-arrow-alt-left fa-fw"></i>&nbsp;Back</button>

                    </form>

                </div>
            </div>
        <hr>
            <div class="btn-toolbar" role="toolbar" style="margin-bottom: 20px">
            <div class="btn-group" role="group" >
                <button type="button" class="btn btn-primary btn-sm" id="task"><i class="fa fa-tasks fa-fw"></i> Task</button>
            </div>

            <div class="btn-group" role="group" style="display: none">
                <button type="button" class="btn btn-success btn-sm" id="addTask" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus fa-fw"></i>&nbsp;Add</button>
                <button type="button" class="btn btn-info btn-sm" id="editTask" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil-alt fa-fw"></i>&nbsp;Edit</button>
                <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-alt  fa-fw"></i>&nbsp;Delete</button>
                <button type="button" class="btn btn-warning btn-sm"><i class="fa fa-copy  fa-fw"></i>&nbsp;Copy</button>
            </div>
                <button class="btn btn-warning pull-right btn-sm" href="#"><i class="fa fa-sync fa-spin fa-fw" aria-hidden="true"></i></button>
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
                                    <select class="js-example-basic-single form-control" name="state2">
                                        <option value="AL">Alabama</option>
                                        <option value="WY">Wyoming</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="TestItem" class="col-sm-3 control-label">Test Item</label>
                                <div class="col-sm-7">
<!--                                    <input type="password" class="form-control" id="TestItem">-->
                                    <select class="form-control" >
                                        <option value="">JumpStart</option>
                                        <option value="0">Treboot</option>
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
                                <label for="PartNumber" class="col-sm-3 control-label">Part Number</label>
                                <div class="col-sm-7">
                                    <input type="email" class="form-control" id="PartNumber" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="SerialNumber" class="col-sm-3 control-label">Serial Number</label>
                                <div class="col-sm-7">
                                    <input type="password" class="form-control" id="SerialNumber" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="oemString" class="col-sm-3 control-label">OEM String</label>
                                <div class="col-sm-7">
                                    <input type="password" class="form-control" id="oemString"  disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="SwitchID" class="col-sm-3 control-label">SwitchID</label>
                                <div class="col-sm-3">
                                    <input type="password" class="form-control" id="SwitchID"  disabled>
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
                                    <select class="js-example-basic-single form-control" name="state2">
                                        <option value="AL">Alabama</option>
                                        <option value="WY">Wyoming</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="TestItem" class="col-sm-3 control-label">Test Item</label>
                                <div class="col-sm-7">
                                    <!--                                    <input type="password" class="form-control" id="TestItem">-->
                                    <select class="form-control" >
                                        <option value="">JumpStart</option>
                                        <option value="0">Treboot</option>
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
                                <label for="PartNumber" class="col-sm-3 control-label">Part Number</label>
                                <div class="col-sm-7">
                                    <input type="email" class="form-control" id="PartNumber" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="SerialNumber" class="col-sm-3 control-label">Serial Number</label>
                                <div class="col-sm-7">
                                    <input type="password" class="form-control" id="SerialNumber" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="oemString" class="col-sm-3 control-label">OEM String</label>
                                <div class="col-sm-7">
                                    <input type="password" class="form-control" id="oemString"  disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="SwitchID" class="col-sm-3 control-label">SwitchID</label>
                                <div class="col-sm-3">
                                    <input type="password" class="form-control" id="SwitchID"  disabled>
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
        <table class="table table-striped table-hover table-responsive">
            <thead>
                <tr>
                    <th>#</th>
                    <th>TaskID</th>
                    <th>Test Machine</th>
                    <th>Test Image</th>
                    <th>Serial Number</th>
                    <th>Assigned Task</th>
                    <th>Test Status</th>
                    <th>Start Date</th>
                    <th>Finish Date</th>
                    <th>Test Result</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th><input type="checkbox"></th>
                    <td>ats10000</td>
                    <td>Altari-LE50-CS1-SKU1</td>
                    <td>TDH0042800B</td>
                    <td>Zd102073H</td>
                    <td>Jumpstart Test</td>
                    <td>ongoing</td>
                    <td>2018/06/28 9:30:30</td>
                    <td>2018/06/28 9:30:30</td>
                    <td>Pass(view)</td>
                </tr>

            </tbody>
        </table>
        <nav aria-label="Page navigation" class="text-center">
            <ul class="pagination">
                <li>
                    <a href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li>
                    <a href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>

    </div>
</body>
</html>


<?php
/**
 * Created by PhpStorm.
 * User: refar
 * Date: 18-6-17
 * Time: 上午10:09
 */