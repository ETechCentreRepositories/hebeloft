<nav class="navbar navbar-expand-md navbar-light navbar-laravel" style="background-color:#46552c;"  >
    <div class="container">
        <a class="nav navbar-left" href="<?php echo e(url('/')); ?>">
            
            
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="leftNavbar navbar-nav mr-auto">
                <a href="/home"><img src="http://localhost:8000/storage/logo/hebeloft_logo.png" class="logo"/></a>
                <li class="navList"><a class="homeNav nav-link" style="color:#e3b417;" href="/home"><div class="navLabels">Home</div></a></li>
                <li class="navList"><a class="inventoryNav nav-link" style="color:#e3b417;" href="/"><div class="navLabels">Inventory</div></a></li>
                <li class="navList"><a class="transferRequestNav nav-link" style="color:#e3b417;" href="/transferrequest"><div class="navLabels">Transfer Request</div></a></li>
                <li class="navList"><a class="salesOrderNav nav-link" style="color:#e3b417;" href="/salesorder"><div class="navLabels">Sales Order</div></a></li>
                <li class="navList"><a class="salesRecordNav nav-link" style="color:#e3b417;" href="/salesrecord"><div class="navLabels">Sales Record</div></a></li>
                <li class="navList"><a class="userNav nav-link" style="color:#e3b417;" href="/user"><div class="navLabels">User</div></a></li>
                <li class="navList"><a class="outletNav nav-link" style="color:#e3b417;" href="/outlet"><div class="navLabels">Outlet</div></a></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="rightNavbar navbar-nav ml-auto">
                <!-- Authentication Links -->
                <?php if(auth()->guard()->guest()): ?>
                <li class="navList"><a class="loginNav nav-link" style="color:#e3b417;" href="<?php echo e(route('login')); ?>"><div class="navLabels"><?php echo e(__('Login')); ?></div></a></li>
                <li class="navList"><a class="registerNav nav-link" style="color:#e3b417;" href="<?php echo e(route('register')); ?>"><div class="navLabels"><?php echo e(__('Register')); ?></div></a></li>
            <?php else: ?>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle username" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu logoutDropdown" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            <?php echo e(__('Logout')); ?>

                        </a>

                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                        </form>
                    </div>
                </li>
            <?php endif; ?> 
            </ul>
        </div>
    </div>
</nav>