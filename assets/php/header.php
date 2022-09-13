<div class="header-section">
    <div class="container-fluid">
        <div class="row justify-content-between align-items-center">

            <!-- Header Logo (Header Left) Start -->
            <div class="header-logo col-auto">
                <a href="index.html">
                    monchercosmetics
                </a>
            </div>
            <!-- Header Logo (Header Left) End -->

            <!-- Header Right Start -->
            <div class="header-right flex-grow-1 col-auto">
                <div class="row justify-content-between align-items-center">

                    <!-- Side Header Toggle & Search Start -->
                    <div class="col-auto">
                        <div class="row align-items-center">

                            <!--Side Header Toggle-->
                            <div class="col-auto"><button class="side-header-toggle"><i class="fa-solid fa-bars"></i></button></div>

                            <!--Header Search-->
                            <div class="col-auto">

                                <div class="header-search">

                                    <button class="header-search-open d-block d-xl-none"><i class="fa-solid fa-magnifying-glass"></i></button>

                                    <div class="header-search-form">
                                        <form action="#">
                                            <input type="text" placeholder="<?Php echo $lang->words['Header']['Search Here']; ?>">
                                            <button><i class="zmdi zmdi-search"></i></button>
                                        </form>
                                        <button class="header-search-close d-block d-xl-none"><i class="fa-solid fa-xmark"></i></button>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Side Header Toggle & Search End -->

                    <!-- Header Notifications Area Start -->
                    <div class="col-auto">

                        <ul class="header-notification-area">

                            <!--Language-->
                            <li class="adomx-dropdown position-relative col-auto">
                                <a class="toggle" href="#"><?php switch ($_SESSION['lang']) {
                                                                case $_SESSION['lang'] == 'EN' or
                                                                    $_SESSION['lang'] == 'en': ?>
                                            <img class="lang-flag" src="assets/images/flags/flag-1.jpg" alt=""><i class="zmdi zmdi-caret-down drop-arrow"></i>
                                        <?php break;
                                                                case ($_SESSION['lang'] = 'RO') or
                                                                    ($_SESSION['lang'] = 'ro'): ?>
                                            <img src="https://vehicle-stickers.com/wp-content/uploads/2018/09/ro.svg" width="27" height="18" alt="">
                                    <?php } ?></a>

                                <!-- Dropdown -->
                                <ul class="adomx-dropdown-menu dropdown-menu-language">
                                    <li><a href="?lang=EN"><img src="assets/images/flags/flag-1.jpg" alt=""> English</a></li>
                                    <li><a href="?lang=RO"><img src="https://vehicle-stickers.com/wp-content/uploads/2018/09/ro.svg" width="27" height="18" alt=""> Romanian</a></li>
                                </ul>

                            </li>
                            <!--User-->
                            <li class="adomx-dropdown col-auto">
                                <a class="toggle" href="#">
                                    <span class="user">
                                        <span class="avatar">
                                            <img src="assets/images/avatar/avatar-1.jpg" alt="">
                                            <span class="status"></span>
                                        </span>
                                        <span class="name"><?php if (isset($_SESSION['AuthTokenAdmin'])) {
                                                                echo $_SESSION['AuthTokenAdmin'];
                                                            } ?></span>
                                    </span>
                                </a>

                                <!-- Dropdown -->
                                <div class="adomx-dropdown-menu dropdown-menu-user">
                                    <div class="head">
                                        <h5 class="name"><a href="#"><?php echo $lang->words['Header']['Welcome']; ?>, <b><?php if (isset($_SESSION['AuthTokenAdmin'])) {
                                                                                                                                echo $_SESSION['AuthTokenAdmin'];
                                                                                                                            } ?></b></a></h5>
                                    </div>
                                    <div class="body">
                                        <ul>
                                            <li><a href="#"><i class="fa fa-edit"></i><?php echo $lang->words['Header']['Edit Profile Details']; ?></a></li>
                                            <li><a href="?logout"><i class="fa fa-unlock"></i><?php echo $lang->words['Header']['Logout']; ?></a></li>
                                        </ul>
                                    </div>
                                </div>

                            </li>

                        </ul>

                    </div>
                    <!-- Header Notifications Area End -->

                </div>
            </div>
            <!-- Header Right End -->

        </div>
    </div>
</div>
<div class="side-header show">
    <button class="side-header-close"><i class="fa-solid fa-xmark"></i></button>
    <!-- Side Header Inner Start -->
    <div class="side-header-inner custom-scroll ps ps--active-y">

        <nav class="side-header-menu" id="side-header-menu">
            <ul>
                <li><a href="index.php"><i class="fa fa-home"></i><span><?php echo $lang->words['Header']['Dashboard']; ?></span></a></li>
                <?php
                if (
                    $perm['permissions'][0]['catalog/Categories']['access'] == "true" or
                    $perm['permissions'][0]['catalog/Products']['access'] == "true"
                ) {
                ?>
                    <li class="has-sub-menu">
                        <a href="#">
                            <i class="fa fa-folder-open"></i>
                            <span><?php echo $lang->words['Header']['Catalog']; ?></span>
                            <span class="menu-expand">
                                <i class="fa-solid fa-angle-down"></i>
                            </span>
                        </a>
                        <ul class="side-header-sub-menu">
                            <?php if ($perm['permissions'][0]['catalog/Categories']['access'] == "true") { ?><li><a href="Categories.php"><i class="fa-solid fa-folder-open"></i><span><?php echo $lang->words['Header']['Categories']; ?></span></a></li><?php } ?>
                            <?php if ($perm['permissions'][0]['catalog/Products']['access'] == "true") { ?><li><a href="products.php"><i class="fa fa-cubes"></i><span><?php echo $lang->words['Header']['Products']; ?></span></a></li><?php } ?>
                        </ul>
                    </li>
                <?Php } ?>
                <?php
                if (
                    $perm['permissions'][0]['sale/Orders']['access'] == "true" or
                    $perm['permissions'][0]['sale/Customers']['access'] == "true" or
                    $perm['permissions'][0]['sale/Coupons']['access'] == "true" or
                    $perm['permissions'][0]['sale/SendMail']['access'] == "true"
                ) {
                ?>
                    <li class="has-sub-menu">
                        <a href="#">
                            <i class="fa fa-flag-o"></i>
                            <span><?php echo $lang->words['Header']['Sales']; ?></span>
                            <span class="menu-expand">
                                <i class="fa-solid fa-angle-down"></i>
                            </span>
                        </a>
                        <ul class="side-header-sub-menu">
                            <?php if ($perm['permissions'][0]['sale/Orders']['access'] == "true") { ?><li><a href="orders.php"><i class="fa fa-flag-checkered"></i><span><?php echo $lang->words['Header']['Orders']; ?></span></a></li><?php } ?>
                            <li class="d-none"><a href="invoices.php"><i class="fa fa-book"></i><span><?php echo $lang->words['Header']['invoices']; ?></span></a></li>
                            <?php if ($perm['permissions'][0]['sale/Customers']['access'] == "true") { ?><li><a href="Customers.php"><i class="fa fa-users"></i><span><?php echo $lang->words['Header']['Customers']; ?></span></a></li><?php } ?>
                            <?php if ($perm['permissions'][0]['sale/Coupons']['access'] == "true") { ?><li class="d-none" style="pointer-events:none; opacity:0.6;"><a href="Coupons.php"><i class="fa fa-tags"></i><span><?php echo $lang->words['Header']['Coupons']; ?></span></a></li><?php } ?>
                            <?php if ($perm['permissions'][0]['sale/SendMail']['access'] == "true") { ?><li><a href="SendMail.php"><i class="fa fa-envelope-o"></i><span><?php echo $lang->words['Header']['Send Mail']; ?></span></a></li><?php } ?>
                        </ul>
                    </li>
                <?php } ?>
                <?Php if (
                    $perm['permissions'][0]['system/Settings/StoreDetails']['access'] == "true" or
                    $perm['permissions'][0]['system/Settings/Mail']['access'] == "true" or
                    $perm['permissions'][0]['system/Settings/System']['access'] == "true" or
                    $perm['permissions'][0]['system/Localization/Currencies']['access'] == "true" or
                    $perm['permissions'][0]['system/Localization/Countries']['access'] == "true" or
                    $perm['permissions'][0]['system/data/BackupRestore']['access'] == "true" or
                    $perm['permissions'][0]['system/data/Datasets']['access'] == "true" or
                    $perm['permissions'][0]['system/data/ImportExport']['access'] == "true" or
                    $perm['permissions'][0]['system/logs/InstallUpgradeHistory']['access'] == "true" or
                    $perm['permissions'][0]['system/logs/ErrorLogs']['access'] == "true" or
                    $perm['permissions'][0]['system/logs/ScheduledTasks']['access'] == "true" or
                    $perm['permissions'][0]['system/users/Users']['access'] == "true" or
                    $perm['permissions'][0]['system/users/UserGroups']['access'] == "true" or
                    $perm['permissions'][0]['system/Messages']['access'] == "true"
                ) { ?>
                    <li class="has-sub-menu">
                        <a href="#">
                            <i class="fa fa-wrench"></i>
                            <span><?php echo $lang->words['Header']['System']; ?></span>
                            <span class="menu-expand">
                                <i class="fa-solid fa-angle-down"></i>
                            </span>
                        </a>
                        <ul class="side-header-sub-menu">
                            <?Php if (
                                $perm['permissions'][0]['system/Settings/StoreDetails']['access'] == "true" or
                                $perm['permissions'][0]['system/Settings/Mail']['access'] == "true" or
                                $perm['permissions'][0]['system/Settings/System']['access'] == "true"
                            ) { ?>
                                <li class="has-sub-menu">
                                    <a href="#">
                                        <i class="fa fa-cogs"></i>
                                        <span><?php echo $lang->words['Header']['Settings']; ?></span>
                                        <span class="menu-expand">
                                            <i class="fa-solid fa-angle-down"></i>
                                        </span>
                                    </a>
                                    <ul class="side-header-sub-menu">
                                        <?php if ($perm['permissions'][0]['system/Settings/StoreDetails']['access'] == "true") { ?> <li><a href="StoreDetails.php"><i class="fa fa-list"></i><span><?php echo $lang->words['Header']['Store Details']; ?></span></a></li> <?php } ?>
                                        <?php if ($perm['permissions'][0]['system/Settings/Mail']['access'] == "true") { ?> <li><a href="mail.php"><i class="fa fa-envelope-square"></i><span><?php echo $lang->words['Header']['Mail']; ?></span></a></li><?php } ?>
                                        <?php if ($perm['permissions'][0]['system/Settings/System']['access'] == "true") { ?> <li><a href="system.php"><i class="fa fa-tasks"></i><span><?php echo $lang->words['Header']['System']; ?></span></a></li><?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>
                            <?php if (
                                $perm['permissions'][0]['system/users/Users']['access'] == "true" or
                                $perm['permissions'][0]['system/users/UserGroups']['access'] == "true"
                            ) { ?>
                                <li class="has-sub-menu">
                                    <a href="#">
                                        <i class="fa fa-users"></i>
                                        <span><?php echo $lang->words['Header']['Users']; ?></span>
                                        <span class="menu-expand">
                                            <i class="fa-solid fa-angle-down"></i>
                                        </span>
                                    </a>
                                    <ul class="side-header-sub-menu">
                                        <?php if ($perm['permissions'][0]['system/users/Users']['access'] == "true") { ?><li><a href="users.php"><i class="fa fa-male"></i><span><?php echo $lang->words['Header']['Users']; ?></span></a></li><?Php } ?>
                                        <?php if ($perm['permissions'][0]['system/users/UserGroups']['access'] == "true") { ?><li><a href="UserGroups.php"><i class="fa fa-code-fork"></i><span><?php echo $lang->words['Header']['User Groups']; ?></span></a></li><?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>
                            <?Php if (
                                $perm['permissions'][0]['system/Localization/Currencies']['access'] == "true" or
                                $perm['permissions'][0]['system/Localization/Countries']['access'] == "true"
                            ) { ?>
                                <li class="has-sub-menu">
                                    <a href="#">
                                        <i class="fa fa-random"></i>
                                        <span><?php echo $lang->words['Header']['Localization']; ?></span>
                                        <span class="menu-expand">
                                            <i class="fa-solid fa-angle-down"></i>
                                        </span>
                                    </a>
                                    <ul class="side-header-sub-menu">
                                        <?php if ($perm['permissions'][0]['system/Localization/Currencies']['access'] == "true") { ?> <li><a href="Currencies.php"><i class="fa fa-money"></i><span><?php echo $lang->words['Header']['Currencies']; ?></span></a></li> <?php } ?>
                                        <?php if ($perm['permissions'][0]['system/Localization/Countries']['access'] == "true") { ?><li><a href="Countries.php"><i class="fa fa-globe"></i><span><?php echo $lang->words['Header']['Countries']; ?></span></a></li><?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>
                            <?Php if (
                                $perm['permissions'][0]['system/data/BackupRestore']['access'] == "true" or
                                $perm['permissions'][0]['system/data/Datasets']['access'] == "true" or
                                $perm['permissions'][0]['system/data/ImportExport']['access'] == "true"
                            ) { ?>
                                <li class="has-sub-menu">
                                    <a href="#">
                                        <i class="fa fa-cubes"></i>
                                        <span><?php echo $lang->words['Header']['Data']; ?></span>
                                        <span class="menu-expand">
                                            <i class="fa-solid fa-angle-down"></i>
                                        </span>
                                    </a>
                                    <ul class="side-header-sub-menu">
                                        <?php if ($perm['permissions'][0]['system/data/BackupRestore']['access'] == "true") { ?><li style="pointer-events:none; opacity:0.6;"><a href="BackupRestore.php"><i class="fa fa-jsfiddle"></i><span><?php echo $lang->words['Header']['Backup / Restore']; ?></span></a></li><?php } ?>
                                        <?php if ($perm['permissions'][0]['system/data/Datasets']['access'] == "true") { ?><li style="pointer-events:none; opacity:0.6;"><a href="fsfs"><i class="fa fa-database"></i><span><?php echo $lang->words['Header']['Datasets']; ?></span></a></li><?php } ?>
                                        <?php if ($perm['permissions'][0]['system/data/ImportExport']['access'] == "true") { ?><li style="pointer-events:none; opacity:0.6;"><a href="ImportExport.php"><i class="fa fa-exchange"></i><span><?php echo $lang->words['Header']['Import / Export']; ?></span></a></li><?php } ?>
                                        <li class="disabled d-none"><a href="Restore.php"><i class="fa-solid fa-circle-notch"></i><span>Restore</span></a></li>
                                    </ul>
                                </li>
                            <?php } ?>
                            <?php if (
                                $perm['permissions'][0]['system/logs/InstallUpgradeHistory']['access'] == "true" or
                                $perm['permissions'][0]['system/logs/ErrorLogs']['access'] == "true" or
                                $perm['permissions'][0]['system/logs/ScheduledTasks']['access'] == "true"
                            ) {
                            ?>
                                <li class="has-sub-menu">
                                    <a href="#">
                                        <i class="fa fa-floppy-o"></i>
                                        <span><?php echo $lang->words['Header']['Logs']; ?></span>
                                        <span class="menu-expand">
                                            <i class="fa-solid fa-angle-down"></i>
                                        </span>
                                    </a>
                                    <ul class="side-header-sub-menu">
                                        <?php if ($perm['permissions'][0]['system/logs/InstallUpgradeHistory']['access'] == "true") { ?><li style="pointer-events:none; opacity:0.6;"><a href="sfddsgf"><i class="fa fa-history"></i><span><?php echo $lang->words['Header']['Install/Upgrade History']; ?></span></a></li><?php } ?>
                                        <?php if ($perm['permissions'][0]['system/logs/ErrorLogs']['access'] == "true") { ?><li><a href="ErrorLogs.php"><i class="fa fa-exclamation-triangle"></i><span><?php echo $lang->words['Header']['Error Logs']; ?></span></a></li><?php } ?>
                                        <?php if ($perm['permissions'][0]['system/logs/ScheduledTasks']['access'] == "true") { ?><li style="pointer-events:none; opacity:0.6;"><a href="ScheduledTasks.php"><i class="fa fa-tasks"></i><span><?php echo $lang->words['Header']['Scheduled Tasks']; ?></span></a></li><?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>
                            <?php if ($perm['permissions'][0]['system/Messages']['access'] == "true") { ?> <li class="d-none"><a href="message.php"><i class="fa fa-weixin"></i><span><?php echo $lang->words['Header']['Messages']; ?></span></a></li><?Php } ?>
                            <li><a href="social.php"><i class="fa-solid fa-share"></i><span>Social</span></a></li>
                        </ul>
                    </li>
                <?php } ?>

            </ul>
            <ul>
                <li>
                    <hr>
                </li>
                <li><a href="s"><span><?php echo $lang
                                            ->words['Header']['go back to the store']; ?></span></a></li>
            </ul>
        </nav>

        <div class="ps__rail-x" style="left: 0px; bottom: 3px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; height: 486px; right: 3px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 412px;"></div>
        </div>
    </div>
    <!-- Side Header Inner End -->
</div>