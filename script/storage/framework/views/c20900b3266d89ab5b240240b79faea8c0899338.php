<?php $__env->startSection('page-title'); ?>
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="<?php echo e($pageIcon); ?>"></i> <?php echo app('translator')->get($pageTitle); ?></h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12 text-right">
            <a href="#" data-toggle="modal" data-target="#my-meeting" class="btn btn-sm btn-success btn-outline waves-effect waves-light">
                <i class="ti-plus"></i> <?php echo app('translator')->get('zoom::modules.zoommeeting.addMeeting'); ?>
            </a>
            <a href="<?php echo e(route('admin.offmeeting.index')); ?>" class="btn btn-sm btn-info btn-outline waves-effect waves-light">
                <i class="ti-list"></i> <?php echo app('translator')->get('zoom::modules.zoommeeting.tableView'); ?>
            </a>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo app('translator')->get('app.menu.home'); ?></a></li>
                <li class="active"><?php echo app('translator')->get($pageTitle); ?></li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('head-script'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/calendar/dist/fullcalendar.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/timepicker/bootstrap-timepicker.min.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bower_components/multiselect/css/multi-select.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bootstrap-colorselector/bootstrap-colorselector.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
    <!-- .row -->

    <!-- BEGIN MODAL -->
    <div class="modal fade bs-modal-md in" id="my-meeting" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal-data-application">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="icon-plus"></i> <?php echo app('translator')->get('zoom::modules.zoommeeting.addMeeting'); ?></h4>
                </div>
                <div class="modal-body">
                    <?php echo Form::open(['id'=>'createMeeting','class'=>'ajax-form','method'=>'POST']); ?>

                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="required"><?php echo app('translator')->get('zoom::modules.zoommeeting.meetingName'); ?></label>
                                    <input type="text" name="meeting_title" id="meeting_title" class="form-control">
                                </div>
                            </div>

                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            <div class="col-md-2 ">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('modules.sticky.colors'); ?></label>
                                    <select id="colorselector" name="label_color">
                                        <option value="bg-info" data-color="#5475ed" selected>Blue</option>
                                        <option value="bg-warning" data-color="#f1c411">Yellow</option>
                                        <option value="bg-purple" data-color="#ab8ce4">Purple</option>
                                        <option value="bg-danger" data-color="#ed4040">Red</option>
                                        <option value="bg-success" data-color="#00c292">Green</option>
                                        <option value="bg-inverse" data-color="#4c5667">Grey</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-xs-12 ">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('zoom::modules.zoommeeting.description'); ?></label>
                                    <textarea name="description" id="description" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-3 ">
                                <div class="form-group">
                                    <label class="required"><?php echo app('translator')->get('zoom::modules.zoommeeting.startOn'); ?></label>
                                    <input type="text" name="start_date" id="start_date" class="form-control" autocomplete="none">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <div class="input-group bootstrap-timepicker timepicker">
                                    <label>&nbsp;</label>
                                    <input type="text" name="start_time" id="start_time" class="form-control">
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-3">
                                <div class="form-group">
                                    <label class="required"><?php echo app('translator')->get('zoom::modules.zoommeeting.endOn'); ?></label>
                                    <input type="text" name="end_date" id="end_date" class="form-control" autocomplete="none">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <div class="input-group bootstrap-timepicker timepicker">
                                    <label>&nbsp;</label>
                                    <input type="text" name="end_time" id="end_time" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Room</label>
                                    <select class="select2 form-control" data-placeholder="Room" id="project_id" name="room">
                                        <option value=" ">Select Room</option>
                                        <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option
                                                    value="<?php echo e($room->idroom); ?>"><?php echo e(ucwords($room->name)); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" id="member-attendees">
                                <div class="form-group">
                                    <label class="col-xs-3 m-t-10"><?php echo app('translator')->get('zoom::modules.meetings.addEmployees'); ?></label>
                                    <div class="col-xs-7">
                                        <div class="checkbox checkbox-info">
                                            <input id="all-employees" name="all_employees" value="true" type="checkbox">
                                            <label for="all-employees"><?php echo app('translator')->get('zoom::modules.meetings.allEmployees'); ?></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <select class="select2 m-b-10 select2-multiple " multiple="multiple"
                                            data-placeholder="<?php echo app('translator')->get('zoom::modules.message.chooseMember'); ?>" name="employee_id[]">
                                        <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($emp->id); ?>"><?php echo e(ucwords($emp->name)); ?> <?php if($emp->id == $user->id): ?>
                                                    (YOU) <?php endif; ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12"  id="client-attendees">
                                <div class="form-group">
                                    <label class="col-xs-3 m-t-10"><?php echo app('translator')->get('zoom::modules.meetings.addClients'); ?></label>
                                    <div class="col-xs-7">
                                        <div class="checkbox checkbox-info">
                                            <input id="all-clients" name="all_clients" value="true" type="checkbox">
                                            <label for="all-clients"><?php echo app('translator')->get('zoom::modules.meetings.allClients'); ?></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <select class="select2 m-b-10 select2-multiple " multiple="multiple"
                                            data-placeholder="<?php echo app('translator')->get('zoom::modules.message.selectClient'); ?>" name="client_id[]">
                                        <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($client->id); ?>"><?php echo e(ucwords($client->name)); ?> <?php if($client->id == $user->id): ?>
                                                    (YOU) <?php endif; ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo Form::close(); ?>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white waves-effect" data-dismiss="modal"><?php echo app('translator')->get('app.close'); ?></button>
                    <button type="button" class="btn btn-success save-meeting waves-effect waves-light"><?php echo app('translator')->get('app.submit'); ?></button>
                </div>
            </div>
        </div>
    </div>
    

    
    <div class="modal fade bs-modal-md in" id="meetingDetailModal" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal-data-application">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <span class="caption-subject font-red-sunglo bold uppercase" id="modelHeading"></span>
                </div>
                <div class="modal-body">
                    Loading...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn blue">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    
    
    <div class="modal fade bs-modal-md in" id="categoryModal" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-md" id="modal-data-application">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <span class="caption-subject font-red-sunglo bold uppercase" id="modelHeading"></span>
                </div>
                <div class="modal-body">
                    Loading...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn blue">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    

<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer-script'); ?>

    <script>
        var taskEvents = [
                <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            {
                id: '<?php echo e(ucfirst($event->idmeeting)); ?>',
                title: '<?php echo e(ucfirst($event->title)); ?>',
                start: '<?php echo e($event->start_date_time); ?>',
                end:  '<?php echo e($event->end_date_time); ?>',
                className: '<?php echo e($event->label); ?>'
            },
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        ];

        var getEventDetail = function (id) {
            var url = "<?php echo e(route('admin.offmeeting.show', ':id')); ?>";
            url = url.replace(':id', id);

            $('#modelHeading').html('Meeting');
            $.ajaxModal('#meetingDetailModal', url);
        }

        var calendarLocale = '<?php echo e($global->locale); ?>';
    </script>

    <script src="<?php echo e(asset('plugins/bower_components/moment/moment.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/calendar/dist/fullcalendar.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/calendar/dist/jquery.fullcalendar.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/calendar/dist/locale-all.js')); ?>"></script>
    <script src="<?php echo e(asset('js/meeting-calendar.js')); ?>"></script>

    <script src="<?php echo e(asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/timepicker/bootstrap-timepicker.min.js')); ?>"></script>

    <script src="<?php echo e(asset('js/cbpFWTabs.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/custom-select/custom-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bower_components/multiselect/js/jquery.multi-select.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bootstrap-colorselector/bootstrap-colorselector.min.js')); ?>"></script>

    <script>
        $(".select2").select2({
            formatNoMatches: function () {
                return "<?php echo e(__('messages.noRecordFound')); ?>";
            }
        });

        jQuery('#start_date, #end_date').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: '<?php echo e($global->date_picker_format); ?>',
        })

        $('#colorselector').colorselector();

        $('#start_time, #end_time').timepicker({
            <?php if($global->time_format == 'H:i'): ?>
            showMeridian: false,
            <?php endif; ?>
        });

        function addEventModal(start, end, allDay){
            $('.modal').modal('hide');
            if(start){
                $('#start_date, #end_date').datepicker('destroy');
                jQuery('#start_date, #end_date').datepicker({
                    autoclose: true,
                    todayHighlight: true,
                    format: '<?php echo e($global->date_picker_format); ?>'
                })

                jQuery('#start_date').datepicker('setDate', new Date(start));
                jQuery('#end_date').datepicker('setDate', new Date(start));
            }
            $('#my-meeting').modal('show');
        }

        $('.save-meeting').click(function () {
            $.easyAjax({
                url: "<?php echo e(route('admin.offmeeting.store')); ?>",
                container: '#modal-data-application',
                type: "POST",
                data: $('#createMeeting').serialize(),
                success: function (response) {
                    if(response.status == 'success'){
                        window.location.reload();
                    }
                }
            })
        })

        $('#repeat-meeting-new').change(function () {
            if($(this).is(':checked')){
                $('#repeat-fields-new').show();
            }
            else{
                $('#repeat-fields-new').hide();
            }
        })

        $('#send_reminder_new').change(function () {
            console.log($(this).is(':checked'));
            if($(this).is(':checked')){
                $('#reminder-fields-new').show();
            }
            else{
                $('#reminder-fields-new').hide();
            }
        })
        $('#add_category').click(function () {
            var url = '<?php echo e(route('admin.category.create')); ?>';
            $('#modelHeading').html('...');
            $.ajaxModal('#categoryModal', url);
        })

    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make((( $role =='admin') ? 'layouts.app' : 'layouts.member-app' ), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Nirodya Gamage\Documents\worksuite-saas-3.9.7\script\Modules/Zoom\Resources/views/meeting/calendar.blade.php ENDPATH**/ ?>