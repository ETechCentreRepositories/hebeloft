<?php $__env->startSection('content'); ?>

<?php if($users_id->roles_id == '1'): ?>
<?php echo $__env->make('inc.navbar_superadmin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php elseif($users_id->roles_id == '2'): ?>
<?php echo $__env->make('inc.navbar_admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php elseif($users_id->roles_id == '3'): ?>
<?php echo $__env->make('inc.navbar_outletstaff', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('inc.unauthorized', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php elseif($users_id->roles_id == '4'): ?>
<?php echo $__env->make('inc.navbar_wholesaler', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('inc.unauthorized', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>

<br>
<div class="topMargin container">
    <div class="d-flex">
        <div class="p-2">
            <a href="<?php echo e(route('exportUser.file',['type'=>'csv'])); ?>"><button type="button" class="btn btn-warning">Export</button></a>
        </div>
        <div class="p-2 ml-auto">
            <?php if($users_id->roles_id == '1'): ?>
                <button type="button" class="btn btn-warning" onclick="openCreateAdminModal()" style="padding-right:10dp">Register an Admin</button>
            <?php endif; ?>
            <button type="button" class="btn btn-warning" onclick="openCreateStaffModal()">Register a Staff</button>
        </div>
    </div>
    <br>
    <ul class="nav nav-tabs" role="tablist">
        <li class="active userRole nav-item"><a data-toggle="tab" href="#all" class="roles nav-link active show" role="tab" aria-controls="contact" aria-selected="true">All</a></li>
        <li class="userRole nav-item"><a data-toggle="tab" href="#admins" class="roles nav-link" role="tab" aria-controls="contact" aria-selected="false">Admins</a></li>
        <li class="userRole nav-item"><a data-toggle="tab" href="#staffs" class="roles nav-link" role="tab" aria-controls="contact" aria-selected="false">Outlet Staffs</a></li>
        <li class="userRole nav-item"><a data-toggle="tab" href="#wholesalers" class="roles nav-link" role="tab" aria-controls="contact" aria-selected="false">Wholesalers</a></li>
    </ul>
    <br>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="all">
            <table class="display" id="userTable">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Role</th>
                        <?php if($users_id->roles_id == '1'): ?>
                        <th class="emptyHeader"></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($user->name); ?></td>
                        <td><?php echo e($user->email); ?></td>
                        <td><?php echo e($user->phone_number); ?></td>
                        <td><?php echo e($user->roles['roles_name']); ?></td>
                        <?php if($users_id->roles_id == '1'): ?>
                        <td>
                            <div class="d-flex flex-row">
                                    <div class="p-2">
                                        <a href="/user/<?php echo e($user->id); ?>/edit"><button type="button" class="btn btn-primary action-buttons">Edit</button></a>
                                    </div>
                                <div class="p-2">
                                    <?php echo Form::open(['action' => ['UsersController@destroy', $user->id], 'method' => 'POST']); ?>

                                        <?php echo e(Form::hidden('_method', 'DELETE')); ?>

                                        <?php echo e(Form::submit('Delete', ['class' => 'btn btn-danger action-buttons'])); ?>

                                    <?php echo Form::close(); ?>

                                </div>
                            </div>
                        </td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        <div class="tab-pane fade" id="admins">
            <table class="display" id="adminTable">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Role</th>
                        <?php if($users_id->roles_id == '1'): ?>
                        <th class="emptyHeader"></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($user->name); ?></td>
                        <td><?php echo e($user->email); ?></td>
                        <td><?php echo e($user->phone_number); ?></td>
                        <td><?php echo e($user->roles['roles_name']); ?></td>
                        <?php if($users_id->roles_id == '1'): ?>
                        <td>
                            <div class="d-flex flex-row">
                                    <div class="p-2">
                                        <a href="/user/<?php echo e($user->id); ?>/edit"><button type="button" class="btn btn-primary action-buttons">Edit</button></a>
                                    </div>
                                <div class="p-2">
                                    <?php echo Form::open(['action' => ['UsersController@destroy', $user->id], 'method' => 'POST']); ?>

                                        <?php echo e(Form::hidden('_method', 'DELETE')); ?>

                                        <?php echo e(Form::submit('Delete', ['class' => 'btn btn-danger action-buttons'])); ?>

                                    <?php echo Form::close(); ?>

                                </div>
                            </div>
                        </td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        <div class="tab-pane fade" id="staffs">
            <table class="display" id="staffTable">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Role</th>
                        <?php if($users_id->roles_id == '1'): ?>
                        <th class="emptyHeader"></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($user->name); ?></td>
                        <td><?php echo e($user->email); ?></td>
                        <td><?php echo e($user->phone_number); ?></td>
                        <td><?php echo e($user->roles['roles_name']); ?></td>
                        <?php if($users_id->roles_id == '1'): ?>
                        <td>
                            <div class="d-flex flex-row">
                                    <div class="p-2">
                                        <a href="/hebeloft/user/<?php echo e($user->id); ?>/edit"><button type="button" class="btn btn-primary action-buttons">Edit</button></a>
                                    </div>
                                <div class="p-2">
                                    <?php echo Form::open(['action' => ['UsersController@destroy', $user->id], 'method' => 'POST']); ?>

                                        <?php echo e(Form::hidden('_method', 'DELETE')); ?>

                                        <?php echo e(Form::submit('Delete', ['class' => 'btn btn-danger action-buttons'])); ?>

                                    <?php echo Form::close(); ?>

                                </div>
                            </div>
                        </td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        
        
        <div class="tab-pane fade" id="wholesalers">
            <table class="display" id="wholesalerTable">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Role</th>
                        <?php if($users_id->roles_id == '1'): ?>
                        <th class="emptyHeader"></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $wholesalers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($user->name); ?></td>
                        <td><?php echo e($user->email); ?></td>
                        <td><?php echo e($user->phone_number); ?></td>
                        <td><?php echo e($user->roles['roles_name']); ?></td>
                        <?php if($users_id->roles_id == '1'): ?>
                        <td>
                            <div class="d-flex flex-row">
                                    <div class="p-2">
                                        <a href="/user/<?php echo e($user->id); ?>/edit"><button type="button" class="btn btn-primary action-buttons">Edit</button></a>
                                    </div>
                                <div class="p-2">
                                    <?php echo Form::open(['action' => ['UsersController@destroy', $user->id], 'method' => 'POST']); ?>

                                        <?php echo e(Form::hidden('_method', 'DELETE')); ?>

                                        <?php echo e(Form::submit('Delete', ['class' => 'btn btn-danger action-buttons'])); ?>

                                    <?php echo Form::close(); ?>

                                </div>
                            </div>
                        </td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="createAdminModal" class="modal">
    <span class="close cursor" onclick="closeCreateAdminModal()">&times;</span>
    <div class="card modalCard">
        <div class="card-body">
            <br>
            <h3 class="card-title">Register an Admin</h3>
            <br>
            <?php echo Form::open(['action' => ['UsersController@store'], 'method' => 'POST', 'enctype' => 'multipart/form-data']); ?>

                
                <?php echo e(csrf_field()); ?>


                <div class="form-group<?php echo e($errors->has('username') ? ' has-error' : ''); ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <input id="role" type="hidden" class="form-control" name="role" value="2"/>
                            <input id="adminUsername" type="text" class="form-control" name="adminUsername" placeholder="Username" value="<?php echo e(old('username')); ?>" required autofocus>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <input id="adminPhoneNumber" type="number" class="form-control" name="adminPhoneNumber" placeholder="Phone number" value="<?php echo e(old('number')); ?>" required>
                        </div>
                    </div>
                </div>

                <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                    <input id="adminPassword" type="password" class="form-control passwordField" name="adminPassword" placeholder="Password" required>
                    <input id="adminPasswordConfirm" type="password" class="form-control" name="adminPasswordConfirmation" placeholder="Confirm password" required>
                </div>
                <div class="form-group">
                    <div style="text-align:center">
                        <button type="submit" class="btn btn-primary">
                            Register
                        </button>
                    </div>
                </div>
            <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
</div>

<div id="createStaffModal" class="modal">
    <span class="close cursor" onclick="closeCreateStaffModal()">&times;</span>
    <div class="card modalCard">
        <div class="card-body">
            <br>
            <h3 class="card-title">Register a Staff</h3>
            <br>
            <?php echo Form::open(['action' => ['UsersController@store'], 'method' => 'POST', 'enctype' => 'multipart/form-data']); ?>

                <div class="form-group<?php echo e($errors->has('username') ? ' has-error' : ''); ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <input id="role" type="hidden" class="form-control" name="role" value="3"/>
                            <input id="username" type="text" class="form-control" name="username" placeholder="Username" value="<?php echo e(old('username')); ?>" required autofocus>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <input id="phone_number" type="number" class="form-control" name="phone_number" placeholder="Phone number" value="<?php echo e(old('number')); ?>" required>
                        </div>
                    </div>
                </div>

                <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                    <input id="password" type="password" class="form-control passwordField" name="password" placeholder="Password" required>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm password" required>
                </div>

                <br><hr><br>
                <label >Outlet:</label>
                <div class="form-group row">  
                </div>

                <div class="form-group">
                    <div style="text-align:center">
                        <button type="submit" class="btn btn-primary">
                            Register
                        </button>
                    </div>
                </div>
            <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function (){
        $("#userTable").DataTable();
        $("#adminTable").DataTable();
        $("#staffTable").DataTable();
        $("#wholesalerTable").DataTable();
    });
    function openCreateStaffModal() {
        document.getElementById('createStaffModal').style.display = "block";
    }

    function closeCreateStaffModal() {
        document.getElementById('createStaffModal').style.display = "none";
    }
    
    function openCreateAdminModal() {
        document.getElementById('createAdminModal').style.display = "block";
    }

    function closeCreateAdminModal() {
        document.getElementById('createAdminModal').style.display = "none";
    }
</script>
<?php $__env->stopSection(); ?>

<style>
    .userNav {
        background-color: #f5f8fa !important;
        color: #000000 !important;
        pointer-events: none;
        cursor: default;
    }
    
    .userRole {
    	margin-left: 10px;
    }
    
    .roles:hover { 
	background-color: #DCDCDC !important;
    }
    
    .roles {
    	color: #566b30 !important;
    }
    
    .show {
    	color: #000 !important;
    }
    
    .show:hover {
    	background-color: #f5f8fa !important;
    }
</style>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>