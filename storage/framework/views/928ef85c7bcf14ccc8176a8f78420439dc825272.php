<nav class="navbar navbar-expand-md navbar-light navbar-laravel" style="background-color:#46552c;" >
    <div class="container">
        <a class="nav navbar-left" href="<?php echo e(url('/')); ?>">
            
            
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="leftNavbar navbar-nav mr-auto">
                <a href="/"><img src="http://localhost:8000/storage/logo/hebeloft_logo.png" class="logo" style="padding: 7px 0;"/></a>
                
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="rightNavbar navbar-nav ml-auto">
                <!-- Authentication Links -->
                <?php if(auth()->guard()->guest()): ?>
                <li><a class="termsAndConditionsNav Nav nav-link" style="color:#e3b417;" onclick="openTermsAndConditions()">Terms and Conditions</a></li>
                <li class="navList"><a class="nav-link loginNav" style="color:#e3b417;" href="<?php echo e(route('login')); ?>"><div class="navLabels"><?php echo e(__('Login')); ?></div></a></li>
                <li class="navList"><a class="nav-link registerNav" style="color:#e3b417;" href="<?php echo e(route('register')); ?>"><div class="navLabels"><?php echo e(__('Register')); ?></div></a></li>
                <?php else: ?>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle username" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <?php echo e(Auth::user()->name); ?><span class="caret"></span>
                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
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

<div id="termsAndConditions" class="termsAndConditions modal">
    <span class="close cursor" onclick="closeTermsAndConditions()">&times;</span>
    <div class="card modalCard">
        <div class="card-body">
            <h3 class="termsAndConditionsTitle">Terms and conditions</h3>
            <br>
            <div class="termsAndConditionsContent">
                <p>
                    Hi! We love our stockists and are always happy to share our products with new shops!
                </p>
                <p>
                    <b>HOW TO ORDER:</b>
                    You can order through this hebeloft wholesale system and we will get back to you by next working day.  Upon receiving your order, we will send you a digital invoice for the total charges with shipping.
                </p>
                <p>
                    <b>STOCK:</b>
                    If there is anything in the shop that has a lower stock than what you had hoped to order, we will call or email you for confirmation and we will adjust your invoice based on stock.
                </p>
                <p>
                    <b>WHOLESALE PRICING:</b>
                    All prices are listed in Singapore dollars. All authorized retailers and trade clients will receive bulk order discount based on the agreement, plus complimentary domestic delivery. Prices are subject to change without notice. 
                </p>
                <p>
                    <b>OPENING ORDERS:</b>
                    A minimum order of $300 is required on opening orders.  All orders must be paid for before items are shipped out. We will contact you with your order total and a digital invoice.
                </p>
                <p>
                    <b>RE-ORDERS:</b>
                    $100 minimum order is required for re-orders. If you are one of our returning vendors and wish to pay within 14 days of your order, let us know and we will update your invoice. Late payments are subject to a 5% late fee for every 14 days past due.
                </p>
                <p>
                    <b>CHANGES TO ORDERS:</b>
                    Any changes or cancellation to orders must be emailed to customerservices@hebeloft.com within 48 hours.
                </p>
                <p>
                    <b>METHOD OF PAYMENT:</b>
                    Payments through Bank Transfer and cheques are accepted. Please refer to invoice for payment details.
                </p>
                <p>
                    <b>DELIVERY & SHIPPING:</b>
                    Though your shipment will likely go out sooner, please allow up to 1-2 weeks for your order to ship. Shipping/handling charges will be calculated and added to your order total when the order is ready to ship. We reserve the right to use our discretion as to the carrier to be used on any shipment. Your preferred carrier may be used if you agree to assume any additional transportation charges.
                </p>
                <p>
                    <b>DAMAGES / DEFECTS:</b>
                    Please inspect all shipments immediately upon arrival. Please contact us at customerservices@hebeloft.com within 5 days of receipt of damaged or defective shipments. Returned merchandise will be replaced with new merchandise. Returned merchandise will not be accepted if it is held for more than 15 days after receipt.
                </p>
                <p>
                    <b>RETURNS / EXCHANGES:</b>
                    Wholesale merchandise may not be returned or exchanged. We only accept returns in the case of defective merchandise as noted above.
                </p>
                <p>
                    <b>CONSIGNMENT:</b>
                    At this time, we are not able to do consignment. 
                </p>
                <p>
                    Thank you!
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    function openTermsAndConditions() {
        document.getElementById('termsAndConditions').style.display = "block";
    }
    
    function closeTermsAndConditions() {
        document.getElementById('termsAndConditions').style.display = "none";
    }
</script>