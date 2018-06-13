<?php $__env->startSection('content'); ?>
<?php echo $__env->make('inc.navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<br><br>
<div class="container">
    <div class="topMargin row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="card-header"><?php echo e(__('Register')); ?></div>

                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('register')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="form-group row">
                            
                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" name="name" value="<?php echo e(old('name')); ?>" placeholder="Username" required autofocus>

                                <?php if($errors->has('name')): ?>
                                    <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email')); ?>" placeholder="Email" required>
                                <?php if($errors->has('email')): ?>
                                    <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="phone_number" type="number" class="form-control<?php echo e($errors->has('phone_number') ? ' is-invalid' : ''); ?>" name="phone_number" value="<?php echo e(old('phone_number')); ?>" placeholder="Phone Number" required>

                                <?php if($errors->has('phone_number')): ?>
                                    <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('phone_number')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">

                            <div class="col-md-6">
                                <input id="billing_address" type="text" class="form-control<?php echo e($errors->has('billing_address') ? ' is-invalid' : ''); ?>" name="billing_address" value="<?php echo e(old('billing_address')); ?>" placeholder="Billing Address" required>

                                <?php if($errors->has('billing_address')): ?>
                                    <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('billing_address')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6">
                                <input id="shipping_address" type="text" class="form-control<?php echo e($errors->has('shipping_address') ? ' is-invalid' : ''); ?>" name="shipping_address" value="<?php echo e(old('shipping_address')); ?>" placeholder="Shipping Address" required>
                                <?php if($errors->has('shipping_address')): ?>
                                    <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('shipping_address')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <input id="company_name" type="text" class="form-control<?php echo e($errors->has('company_name') ? ' is-invalid' : ''); ?>" name="company_name" value="<?php echo e(old('company_name')); ?>" placeholder="Company Name" required>

                                <?php if($errors->has('billing_address')): ?>
                                    <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('billing_address')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label><input id="cbSameAddress" type="checkbox" name="sameAddress[]" value=""> Same as Billing Address</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" placeholder="Password" required>

                                <?php if($errors->has('password')): ?>
                                    <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-5">
                                <input id="roles_id" type="hidden" name="roles_id" value="4">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo e(__('Register')); ?>

                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#cbSameAddress").click(function(){
            $status = $(this).is(":checked");
            if($status){
                $billing_address = $("#billing_address").val();
                if($billing_address == ""){
                    alert("Billing Address is empty");
                    $("#cbSameAddress").prop("checked", false);
                }else{
                    // alert($billing_address);
                    $("#shipping_address").val($billing_address);
                }
            }else{
                $("#shipping_address").val(""); 
            }
            
        });
    });
</script>
<?php $__env->stopSection(); ?>

<style>
    .registerNav {
        background-color: #f5f8fa !important;
        color: #000000 !important;
        pointer-events: none;
        cursor: default;
    }
</style>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>