<?php $__env->startSection('title', 'Roles'); ?>
<?php $__env->startSection('pagetitle',  'Role List'); ?>
<?php
    $table = "yes";
?>

<?php $__env->startSection('content'); ?>
<div class="content">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
					<h4 class="panel-title">Roles List</h4>
					<div class="heading-elements">
                        <button type="button" class="btn btn-sm bg-slate btn-raised heading-btn legitRipple" onclick="addrole()">
                            <i class="icon-plus2"></i> Add New
                        </button>
                    </div>
				</div>
				<div class="panel-body">
				</div>
                <table class="table table-bordered table-striped table-hover" id="datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Display Name</th>
                            <th>Last Update</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="roleModal" class="modal fade" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-slate">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title"><span class="msg">Add</span> Role</h6>
            </div>
            <form id="rolemanager" action="<?php echo e(route('toolsstore', ['type'=>'roles'])); ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="id">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group col-md-6">
                            <label>Role Name</label>
                            <input type="text" name="slug" class="form-control" placeholder="Enter Role Name" required="">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Display Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Display Name" required="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-raised legitRipple" data-dismiss="modal" aria-hidden="true">Close</button>
                    <button class="btn bg-slate btn-raised legitRipple" type="submit" data-loading-text="<i class='fa fa-spin fa-spinner'></i> Submitting">Submit</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php if(isset($permissions) && $permissions): ?>
<div id="permissionModal" class="modal fade right" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-slate">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Member Permission</h6>
            </div>
            <form id="permissionForm" action="<?php echo e(route('toolssetpermission')); ?>" method="post">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" name="role_id">
                <input type="hidden" name="type" value="permission">
                <div class="modal-body p-0">
                    <table id="datatable" class="table table-hover table-bordered">
	                    <thead>
	                    <tr>
	                        <th width="180px;">Section Category</th>
	                        <th>
                                <span class="pull-left m-t-5 m-l-10">Permissions</span> 
                                <div class="md-checkbox pull-right">
                                    <input type="checkbox" id="selectall">
                                    <label for="selectall">Select All</label>
                                </div>
                            </th>
	                    </tr>
	                    </thead>
	                    <tbody>
                            <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <div class="md-checkbox mymd">
                                            <input type="checkbox" class="selectall" id="<?php echo e(ucfirst($key)); ?>">
                                            <label for="<?php echo e(ucfirst($key)); ?>"><?php echo e(ucfirst($key)); ?></label>
                                        </div>
                                    </td>

                                    <td class="row">
                                        <?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="md-checkbox col-md-4 p-0" >
                                                <input type="checkbox" class="case" id="<?php echo e($permission->id); ?>" name="permissions[]" value="<?php echo e($permission->id); ?>">
                                                <label for="<?php echo e($permission->id); ?>"><?php echo e($permission->name); ?></label>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	                    </tbody>
	                </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-raised legitRipple" data-dismiss="modal" aria-hidden="true">Close</button>
                    <button class="btn bg-slate btn-raised legitRipple" type="submit" data-loading-text="<i class='fa fa-spin fa-spinner'></i> Submitting">Submit</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

<div id="schemeModal" class="modal fade" role="dialog" data-backdrop="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
                <div class="modal-header bg-slate">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Scheme Manager</h4>
            </div>
            <form id="schemeForm" method="post" action="<?php echo e(route('toolssetpermission')); ?>">
                <div class="modal-body">
                    <?php echo csrf_field(); ?>

                    <input type="hidden" name="role_id">
                    <input type="hidden" name="type" value="scheme">
                    <div class="row">
                        <div class="form-group">
                            <label>Scheme</label>
                            <select class="form-control select" name="permissions[]" required="">
                                <option value="">Select Scheme</option>
                                <?php $__currentLoopData = $scheme; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($element->id); ?>"><?php echo e($element->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-raised legitRipple" data-dismiss="modal" aria-hidden="true">Close</button>
                    <button class="btn bg-slate btn-raised legitRipple" type="submit" data-loading-text="<i class='fa fa-spin fa-spinner'></i> Submitting">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- /.modal -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
<style>
    .md-checkbox {
        margin: 5px 0px;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        var url = "<?php echo e(url('statement/fetch/roles/0')); ?>";
        var onDraw = function() {};
        var options = [
            { "data" : "id"},
            { "data" : "slug"},
            { "data" : "name"},
            { "data" : "updated_at"},
            { "data" : "action",
                render:function(data, type, full, meta){
                    var menu = ``;

                    <?php if(Myhelper::can(['fund_transfer', 'fund_return'])): ?>
                        menu += `<li><a href="javascript:void(0)" onclick="editRole(this)"><i class="fa fa-pencil"></i> Edit</a></li>`;
                    <?php endif; ?>

                    <?php if(Myhelper::can('member_permission_change')): ?>
                        menu += `<li><a href="javascript:void(0)" onclick="getPermission(`+full.id+`)"><i class="icon-cogs"></i> Permission</a></li>`;
                    <?php endif; ?>

                    <?php if(Myhelper::can('member_scheme_change')): ?>
                        menu += `<li><a href="javascript:void(0)" onclick="scheme(`+full.id+`, '`+full.scheme+`')"><i class="icon-wallet"></i> Scheme</a></li>`;
                    <?php endif; ?>

                    out =  `<ul class="icons-list">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-right">
                                        `+menu+`
                                    </ul>
                                </li>
                            </ul>`;

                    return out;
                }
            },
        ];
        datatableSetup(url, options, onDraw);

        $( "#rolemanager" ).validate({
            rules: {
                slug: {
                    required: true,
                },
                name: {
                    required: true,
                },
            },
            messages: {
                mobile: {
                    required: "Please enter role slug",
                },
                name: {
                    required: "Please enter role name",
                }
            },
            errorElement: "p",
            errorPlacement: function ( error, element ) {
                if ( element.prop("tagName").toLowerCase() === "select" ) {
                    error.insertAfter( element.closest( ".form-group" ).find(".select2") );
                } else {
                    error.insertAfter( element );
                }
            },
            submitHandler: function () {
                var form = $('#rolemanager');
                form.ajaxSubmit({
                    dataType:'json',
                    beforeSubmit:function(){
                        form.find('button[type="submit"]').button('loading');
                    },
                    success:function(data){
                        if(data.status == "success"){
                            if(id == "new"){
                                form[0].reset();
                            }
                            form.find('button[type="submit"]').button('reset');
                            notify("Task Successfully Completed", 'success');
                            $('#datatable').dataTable().api().ajax.reload();
                        }else{
                            notify(data.status, 'warning');
                        }
                    },
                    error: function(errors) {
                        showError(errors, form);
                    }
                });
            }
        });

    	$("#roleModal").on('hidden.bs.modal', function () {
            $('#roleModal').find('.msg').text("Add");
            $('#roleModal').find('form')[0].reset();
        });
        
        $('form#permissionForm').submit(function(){
    		var form= $(this);
            $(this).ajaxSubmit({
                dataType:'json',
                beforeSubmit:function(){
                    form.find('button[type="submit"]').button('loading');
                },
                complete: function(){
                    form.find('button[type="submit"]').button('reset');
                },
                success:function(data){
                    if(data.status == "success"){
                        notify('Permission Set Successfully', 'success');
                    }else{
                        notify('Transaction Failed', 'warning');
                    }
                },
                error: function(errors) {
                	showError(errors, form);
                }
            });
            return false;
    	});

        $('#selectall').click(function(event) {
            if(this.checked) {
                $('.case').each(function() {
                   this.checked = true;       
                });
                $('.selectall').each(function() {
                    this.checked = true;       
                });
             }else{
                $('.case').each(function() {
                   this.checked = false;
                });   
                $('.selectall').each(function() {
                    this.checked = false;       
                });
            }
        });

        $('.selectall').click(function(event) {
            if(this.checked) {
                $(this).closest('tr').find('.case').each(function() {
                   this.checked = true;       
                });
             }else{
                $(this).closest('tr').find('.case').each(function() {
                   this.checked = false;
                });      
            }
        });

        $( "#schemeForm").validate({
            rules: {
                scheme_id: {
                    required: true
                }
            },
            messages: {
                scheme_id: {
                    required: "Please select scheme",
                }
            },
            errorElement: "p",
            errorPlacement: function ( error, element ) {
                if ( element.prop("tagName").toLowerCase() === "select" ) {
                    error.insertAfter( element.closest( ".form-group" ).find(".select2") );
                } else {
                    error.insertAfter( element );
                }
            },
            submitHandler: function () {
                var form = $('#schemeForm');
                var type = $('#schemeForm').find('[name="type"]').val();
                form.ajaxSubmit({
                    dataType:'json',
                    beforeSubmit:function(){
                        form.find('button:submit').button('loading');
                    },
                    complete: function () {
                        form.find('button:submit').button('reset');
                    },
                    success:function(data){
                        if(data.status == "success"){
                            getbalance();
                            form.closest('.modal').modal('hide');
                            notify("Role Scheme Updated Successfull", 'success');
                            $('#datatable').dataTable().api().ajax.reload();
                        }else{
                            notify(data.status , 'warning');
                        }
                    },
                    error: function(errors) {
                        showError(errors, form);
                    }
                });
            }
        });
    });

    function addrole(){
    	$('#roleModal').find('.panel-title').text("Add New Role");
    	$('#roleModal').find('input[name="id"]').val("new");
    	$('#roleModal').modal('show');
	}

	function editRole(ele){
		var id = $(ele).closest('tr').find('td').eq(0).text();
		var slug = $(ele).closest('tr').find('td').eq(1).text();
		var name = $(ele).closest('tr').find('td').eq(2).text();

		$('#roleModal').find('.msg').text("Edit");
    	$('#roleModal').find('input[name="id"]').val(id);
    	$('#roleModal').find('input[name="slug"]').val(slug);
    	$('#roleModal').find('input[name="name"]').val(name);
    	$('#roleModal').modal('show');
    }
    
    function getPermission(id) {
        if(id.length != ''){
            $.ajax({
                url: '<?php echo e(url('tools/getdefault/permission')); ?>/'+id,
                type: 'post',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            })
            .done(function(data) {
                $('#permissionForm').find('[name="role_id"]').val(id);
                $('.case').each(function() {
                   this.checked = false;
                });
                $.each(data, function(index, val) {
                    $('#permissionForm').find('input[value='+val.permission_id+']').prop('checked', true);
                });
                $('#permissionModal').modal();
            })
            .fail(function() {
                notify('Somthing went wrong', 'warning');
            });
        }
    }

    function scheme(id, scheme){
        $('#schemeForm').find('[name="role_id"]').val(id);
        if(scheme != '' && scheme != null && scheme != 'null'){
            $('#schemeForm').find('[name="permissions[]"]').select2().val(scheme).trigger('change');
        }
        $('#schemeModal').modal();
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\open_aisa\resources\views/tools/roles.blade.php ENDPATH**/ ?>