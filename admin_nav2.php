<?php
include 'connection.php';






//      COUNT ONLINE
$request = mysqli_query($connect, "SELECT COUNT(status) as totala FROM request WHERE status = 'pending'");
while ($row_online = mysqli_fetch_assoc($request)) {
    $count_request = $row_online['totala'];
}

?>



<nav class="pcoded-navbar">
    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
    <div class="pcoded-inner-navbar main-menu" id="pos_fixed">

        <div class="pcoded-navigation-label" style="font-size: 14px;">Navigation</div>
        <ul class="pcoded-item pcoded-left-item">




        <?php  
         if (isset($_SESSION['id_bl'])) { ?>

                <li class="">
                    <a href="block_leader_home.php" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                        <span class="pcoded-mtext">Dashboard</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                <hr>

             <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="fa fa-user"></i><b></b></span>
                        <span class="pcoded-mtext">Personel Registration</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                    <!--SECOND LEVEL BREAK DOWN-->
                    <ul class="pcoded-submenu">
                        <li class="">
                            <a href="members.php" class="waves-effect waves-dark">
                                <span class="pcoded-micon"><i class=""></i><b></b></span>
                                <span class="pcoded-mtext">Registration</span>
                                <span class="pcoded-mcaret"></span>
                            </a>
                        </li>

                        <li class="">
                            <a href="edit_members.php" class="waves-effect waves-dark">
                                <span class="pcoded-micon"><i class=""></i><b></b></span>
                                <span class="pcoded-mtext">Edit Registration</span>
                                <span class="pcoded-mcaret"></span>
                            </a>
                        </li>

                    </ul>
                    <!--END SECOND LEVEL BREAK DOWN-->
                </li>


              
        <?php
          }
        ?>

            <?php if (isset($_SESSION['id_admin'])) {
                ?>
                <li class="">
                    <a href="admin_home.php" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                        <span class="pcoded-mtext">Dashboard</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                <hr>


                <!-- <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="fa fa-bank"></i><b></b></span>
                        <span class="pcoded-mtext">Block Leaders</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                    SECOND LEVEL BREAK DOWN
                    <ul class="pcoded-submenu">
                        <li class="">
                            <a href="reg_block_leader" class="waves-effect waves-dark">
                                <span class="pcoded-micon"><i class=""></i><b></b></span>
                                <span class="pcoded-mtext">Register block Leader</span>
                                <span class="pcoded-mcaret"></span>
                            </a>
                        </li>

                        <li class="">
                            <a href="edit_block_leader" class="waves-effect waves-dark">
                                <span class="pcoded-micon"><i class=""></i><b></b></span>
                                <span class="pcoded-mtext">Edit Block Leader</span>
                                <span class="pcoded-mcaret"></span>
                            </a>
                        </li>

                        <li class="">
                            <a href="send_leaders" class="waves-effect waves-dark">
                                <span class="pcoded-micon"><i class=""></i><b></b></span>
                                <span class="pcoded-mtext">Send SMS to Block Leader(s)</span>
                                <span class="pcoded-mcaret"></span>
                            </a>
                        </li>






                    </ul>
                    END SECOND LEVEL BREAK DOWN
                </li> -->


                <!-- <hr> -->


                <li class="">
                            <a href="members.php" class="waves-effect waves-dark">
                                <span class="pcoded-micon"><i class="fa fa-user" style="color:green"></i><b></b></span>
                                <span class="pcoded-mtext" style="color:green">OFFRS Reg.</span>
                                <span class="pcoded-mcaret"></span>
                            </a>
                        </li>
                        <hr>

                        <li class="">
                            <a href="edit_members.php" class="waves-effect waves-dark">
                                <span class="pcoded-micon"><i class="fa fa-user-circle" style="color:green"></i><b></b></span>
                                <span class="pcoded-mtext" style="color:green"> OFFRS Edit Reg</span>
                                <span class="pcoded-mcaret"></span>
                            </a>
                        </li>
                        <hr>
                        <hr>

                        <li class="">
                            <a href="air_men_members.php" class="waves-effect waves-dark">
                                <span class="pcoded-micon"><i class="fa fa-user" style="color:red"></i><b></b></span>
                                <span class="pcoded-mtext" style="color:red">Airmen/Airwomen Reg.</span>
                                <span class="pcoded-mcaret"></span>
                            </a>
                        </li>
                        <hr>

                     

                        <li class="">
                            <a href="air_men_edit_members.php" class="waves-effect waves-dark">
                                <span class="pcoded-micon"><i class="fa fa-user-circle" style="color:red"></i><b></b></span>
                                <span class="pcoded-mtext" style="color:red">Airmen/Airwomen_Edit_Reg</span>
                                <span class="pcoded-mcaret"></span>
                            </a>
                        </li>
                      
                        <hr>


               


                <li class="">
                    <a href="all_members.php" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="ti-search"></i><b>D</b></span>
                        <span class="pcoded-mtext">Search & View All </span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                <hr>


                <!----------------MAJOR DROP DOWN------------->
         


                    <li class="">
                    <a href="history_accomodation.php" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="fa fa-home"></i><b>D</b></span>
                        <span class="pcoded-mtext">Accomodation History</b></span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                <hr>


                    <li class="">
                    <a href="signal.php" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="ti-arrow-top-right"></i><b>D</b></span>
                        <span class="pcoded-mtext">Signal (Posting)</b></span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                <hr>


                <!-- <li class="">
                    <a href="record_signal" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="ti-receipt"></i><b>D</b></span>
                        <span class="pcoded-mtext">Record Signal</b></span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                <hr> -->

                    <!-- <li class="">
                    <a href="request" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="ti-bell"></i><b>D</b></span>
                        <span class="pcoded-mtext">Request <b style='color:red; font-size: 18px;'><?php echo $count_request; ?></b></span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li> -->
                <!-- <hr> -->



             

                <?php
            } else if (isset($_SESSION['staff_full_name'])) {
                ?>

                    <li class="">
                        <a href="view_member.php?namee=<?php echo $_SESSION['staff_full_name'] ?>"
                            class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-user"></i><b>D</b></span>
                            <span class="pcoded-mtext">Profile </span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <hr>


                <?php
            }
            ?>

        </ul>

    </div>
</nav>

