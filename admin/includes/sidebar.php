<?php
//--------------------
//$page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/")+1);
//code for adding inside of class="nav-link <?= $page == 'index.php' ? 'active':'';? then close class tag
//$page == 'index.php' ? 'active':'';
?>
<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion shadow" id="sidenavAccordion" style="background: rgb(2,0,36);
background: linear-gradient(278deg, rgba(2,0,36,1) 0%, rgba(255,255,255,1) 0%, rgba(173,241,255,1) 100%);">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <?php if(isset($_GET['item'])){
                    $it = $_GET['item'];}
                ?>
                <div class="sb-sidenav-menu-heading">Main</div>
                <?php
                  if($it == "order"){
                    ?>
                        <a class="nav-link" href="order.php?item=order" style="transition: .3s ease;background: rgb(2,0,36);background: linear-gradient(7deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 0%, rgba(0,212,255,1) 100%);color:white">
                            <div class="sb-nav-link-icon"><i class="fas fa-cart-plus"></i></div>
                            POS CREATE ORDER
                        </a>
                    <?php
                  }else{
                    ?>
                        <a class="nav-link" href="order.php?item=order" style="color:grey">
                            <div class="sb-nav-link-icon"><i class="fas fa-cart-plus"></i></div>
                            POS CREATE ORDER
                        </a>
                    <?php
                  }
                ?>
                <!-- order -->
                <?php
                  if($it == "orderTable"){
                        ?>
                            <a class="nav-link" href="orderTable.php?item=orderTable" style="transition: .3s ease;background: rgb(2,0,36);background: linear-gradient(7deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 0%, rgba(0,212,255,1) 100%);color:white">
                                <div class="sb-nav-link-icon"><i class="fas fa-folder-open"></i></div>
                                ORDER HISTORY
                            </a>
                        <?php
                  }else{
                        ?>
                            <a class="nav-link" href="orderTable.php?item=orderTable" style="color:grey">
                                <div class="sb-nav-link-icon"><i class="fas fa-folder-open"></i></div>
                                ORDER HISTORY
                            </a>
                        <?php
                  }
                ?>
                <!-- orderTbale -->
                <?php
                    if($it == "orderlist"){
                        ?>
                            <a class="nav-link" href="orderlist.php?item=orderlist" style="transition: .3s ease;background: rgb(2,0,36);background: linear-gradient(7deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 0%, rgba(0,212,255,1) 100%);color:white">
                                <div class="sb-nav-link-icon"><i class="fas fa-list-alt"></i></div>
                                ORDER LIST HISTORY
                            </a>
                        <?php
                    }else{
                        ?>
                            <a class="nav-link" href="orderlist.php?item=orderlist" style="color:grey">
                                <div class="sb-nav-link-icon"><i class="fas fa-list-alt"></i></div>
                                ORDER LIST HISTORY
                            </a>
                        <?php
                    }
                ?>
                <!-- orderList -->
                <div class="sb-sidenav-menu-heading">Management Folders</div>
                <?php
                    if($it == "index"){
                        ?>
                            <a class="nav-link" href="index.php?item=index" style="transition: .3s ease;background: rgb(2,0,36);background: linear-gradient(7deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 0%, rgba(0,212,255,1) 100%);color:white">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                ALL MANAGEMENT
                            </a>
                        <?php
                    }else{
                        ?>
                            <a class="nav-link" href="index.php?item=index" style="color:grey">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                ALL MANAGEMENT
                            </a>
                        <?php
                    }
                ?>
                <!-- index -->
                <?php
                    if($it == "admins"){
                        ?>
                            <a class="nav-link" href="admins.php?item=admins" style="transition: .3s ease all;background: rgb(2,0,36);background: linear-gradient(7deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 0%, rgba(0,212,255,1) 100%);color:white">
                                <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                                ADMINS FOLDER
                            </a>
                        <?php
                    }else{
                        ?>
                            <a class="nav-link" href="admins.php?item=admins" style="color:grey">
                                <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                                ADMINS FOLDER
                            </a>
                        <?php
                    }
                ?>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Start Bootstrap
        </div>
    </nav>
</div>