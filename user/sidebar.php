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
                    <i class="fa fa-home"></i>
                    <span>Homepage</span>
                </a>
            </li>

            <li class="sub-menu">
                <a href="javascript:;" >
                    <i class="fa fa-users"></i>
                    <span>Preferences</span>
                </a>
                <ul class="sub">
                    <li><a  href="">Profile</a></li>
                    <li><a  href="../logout.php?logout">Logout</a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href="javascript:;" >
                    <i class="fa fa-file-pdf-o"></i>
                    <span>Application</span>
                </a>
                <ul class="sub">
                    <li><a  href="preview.php">Applied loans</a></li>
                    <li><a  href="">Approved Loans</a></li>
                    <li><a  href="">Declined Loans</a></li>

                </ul>
            </li>
            <li class="sub-menu">
                <a href="" >
                    <i class="fa fa-envelope"></i>
                    <span>Offer Letter</span>
                </a>
            </li>
            <li class="sub-menu">
                <a href="javascript:;" >
                    <i class="fa fa-book"></i>
                    <span>My Reports</span>
                </a>
                <ul class="sub">
                    <li><a  href="preview.php">My Payments</a></li>
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