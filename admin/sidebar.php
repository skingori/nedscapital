<!-- **********************************************************************************************************************************************************
   MAIN SIDEBAR MENU
   *********************************************************************************************************************************************************** -->
<!--sidebar start-->
<aside>
    <div id="sidebar"  class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">

            <p class="centered"><a href=""><img src="../assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
            <h5 class="centered"><?php echo $username;?></h5>

            <li class="mt">
                <a class="active" href="index.php">
                    <i class="fa fa-refresh"></i>
                    <span>Back Home</span>
                </a>
            </li>

            <li class="sub-menu">
                <a href="javascript:;" >
                    <i class="fa fa-users"></i>
                    <span>Preferences</span>
                </a>
                <ul class="sub">
                    <li><a  href="">My Profile</a></li>
                    <li><a  href="">All Members</a></li>
                    <li><a  href="../logout.php?logout">Logout</a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href="javascript:;" >
                    <i class="fa fa-file-pdf-o"></i>
                    <span>Loan Details</span>
                </a>
                <ul class="sub">
                    <li><a  href="index.php">Applied loans</a></li>
                    <li><a  href="awaiting.php">Awaiting Approval</a></li>
                    <li><a  href="approved.php">Approved Loans</a></li>
                    <li><a  href="declined.php">Declined Loans</a></li>

                </ul>
               
            </li>
            <li class="sub-menu">
                <a href="letters.php" >
                    <i class="fa fa-envelope-o"></i>
                    <span>Offer Letters</span>
                </a>
            </li>
            <li class="sub-menu">
                <a href="payments.php" >
                    <i class="fa fa-paragraph"></i>
                    <span>Repayments</span>
                </a>
            </li>
            <li class="sub-menu">
                <a href="dashboard.php" >
                    <i class="fa fa-book"></i>
                    <span>All Reports</span>
                </a>
            </li>
            <li class="sub-menu">
                <a href="javascript:;" >
                    <i class="fa fa-bell"></i>
                    <span>Notifications</span>
                </a>
                <ul class="sub">
                    <li><a  href="">New *</a></li>
                    <li><a  href="">View all</a></li>

                </ul>
            </li>

        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->

<!-- **********************************************************************************************************************************************************
MAIN CONTENT
*********************************************************************************************************************************************************** -->
<!--main content start-->