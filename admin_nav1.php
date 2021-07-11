<?php

if (empty($_SESSION['name_id_admin']) && empty($_SESSION['id_bl'])) {
  //         echo "<script>alert('You must first login');</script>";
  echo "<script type='text/javascript'> $(document).ready(function(){ 
               swal({
                        title: 'Sorry!',
                        text: 'You must first login',
                        icon: 'error',
                       buttons: {
                           confirm : {text:'Back To Login',className:'sweet-orange'},
                         
                       },
                       closeOnClickOutside: false
                      })
                 .then(function() {
                    window.location = 'index.php';
                  });   
               }); </script>";
}

if (isset($_SESSION['id_admin'])) {
  $user_id = $_SESSION['id_admin'];
  $result_image = mysqli_query($connect, "SELECT * FROM admin WHERE id = '$user_id'");
  while ($row = mysqli_fetch_assoc($result_image)) {
    $images_admin = $row['imagess'];
  }

} else if (isset($_SESSION['id_staff'])) {
  $user_id = $_SESSION['id_staff'];
  $result_image = mysqli_query($connect, "SELECT * FROM census_registration WHERE id = '$user_id'");
  while ($row = mysqli_fetch_assoc($result_image)) {
    $images_admin = $row['images'];
  }
}


?>
<style>
  .switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 20px;
  }

  .switch input {
    opacity: 0;
    width: 0;
    height: 0;
  }

  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #009933;
    -webkit-transition: .4s;
    transition: .4s;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 14px;
    width: 14px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
  }

  input:checked+.slider {
    background-color: red;
  }

  input:focus+.slider {
    box-shadow: 0 0 1px #2196F3;
  }

  input:checked+.slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
  }

  /* Rounded sliders */
  .slider.round {
    border-radius: 34px;
  }

  .slider.round:before {
    border-radius: 50%;
  }

  @media(max-width:768px) {
    .menu-height {
      margin-top: 20px;
    }
  }

  @media (min-width: 1024px) {
    .menu-height {
      margin-top: 0px;
    }
  }
</style>
<nav class="navbar header-navbar pcoded-header" style="height: 5px;">
  <div class="navbar-wrapper">
    <div class="navbar-logo">
      <a class="mobile-menu waves-effect waves-light menu-height" id="mobile-collapse" href="#!">
        <i class="ti-menu" id="magic-collapse"></i>
      </a>
      <div class="mobile-search waves-effect waves-light">
        <div class="header-search">
          <div class="main-search morphsearch-search">
            <div class="input-group">
              <span class="input-group-prepend search-close"><i class="ti-close input-group-text"></i></span>
              <input type="text" class="form-control" placeholder="Enter Keyword">
              <span class="input-group-append search-btn"><i class="ti-search input-group-text"></i></span>
            </div>
          </div>
        </div>
      </div>

      <?php
      if (isset($_SESSION['id_admin'])) {
        ?>
        <a href="fin_admin.php">
          <i style="color: #ccffcc;"><b style="font-weight: bolder; font-size: 24px;">SEAFB (RDCSAC)</b><b
              style="font-size: 16px;"></b></i>
        </a>&nbsp;&nbsp;
        <?php
      } elseif (isset($_SESSION['id_staff'])) {
        ?>
        <a href="personel_login.php">
          <i style="color: #ccffcc;">_<b style="font-weight: bolder; font-size: 24px;">SEAFB (RDCSAC)</b><b
              style="font-size: 16px;"></b>_</i>
        </a>&nbsp;&nbsp;
        <?php
      } elseif (isset($_SESSION['id_bl'])) {
        ?>
        <a href="block_leader.php">
          <i style="color: #ccffcc;">_<b style="font-weight: bolder; font-size: 24px;">SEAFB (RDCSAC)</b><b
              style="font-size: 16px;"></b>_</i>
        </a>&nbsp;&nbsp;
        <?php
      }
      ?>

      <a class="mobile-options waves-effect waves-light " style="margin-top: 20px;">

        <i class="ti-more"></i>
      </a>
    </div>

    <div class="navbar-container container-fluid">
      <ul class="nav-left">
        <li>
          <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu" id="mymenu2"></i></a></div>
        </li>
        <li>
          <a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
            <!--<i class="ti-fullscreen"></i>-->
          </a>
        </li>
      </ul>
      <ul class="nav-right">

        <li class="user-profile header-notification">
          <a href="#!" class="waves-effect waves-light">
            <img src="images/1200px-Nigerian_Air_Force_emblem.svg.png" style="width: 80px; height: 70px;"
              class="img-radius" alt="User-Profile-Image">
            <?php
            if (isset($_SESSION['id_admin'])) {
              ?>
              <span>Admin</span>
              <i class="ti-angle-down"></i>
            </a>
            <ul class="show-notification profile-notification">

              <!--                                    <li class="waves-effect waves-light">
                                        <a href="user-profile.html">
                                            <i class="ti-user"></i> Profile
                                        </a>
                                    </li>-->
              <li class="waves-effect waves-light">
                <a href="change_adminpass.php">
                  <i class="ti-key"></i> Change Password
                </a>
              </li>
              <!-- <li class="waves-effect waves-light">
                                        <a href="https://651BSGACCN.ng/webmail/">
                                            <i class="ti-email"></i> Web Mail
                                        </a>
                                    </li> -->
              <?php
              $get_checked = "";

              $result_slider = mysqli_query($connect, "SELECT * FROM staff ");
              while ($row = mysqli_fetch_assoc($result_slider)) {
                $get_checked = $row['slider'];
              }

              if ($get_checked == "open") {
                $get_checked = "";
              } else {
                $get_checked = "checked";
              }
              ?>

              <!-- <i style="color: black; font-weight: bold; font-size: 18px; padding-left: 15px;">O</i><label class="switch">
                                            <input type="checkbox"  <?php // echo $get_checked; ?> id="get_slider">
                                      <span class="slider round"></span>
                                    </label> <i style="color: black; font-weight: bold; font-size: 18px;">C</i> -->
              <li class="waves-effect waves-light">
                <a href="fin_admin.php">
                  <i class="ti-layout-sidebar-left"></i> Logout
                </a>
              </li>

              <?php
            } elseif (isset($_SESSION['id_staff']) || $_SESSION['id_bl']) {

              ?>

              <li class="waves-effect waves-light">
                <a href="block_leader.php">
                  <i class="ti-layout-sidebar-left"></i> Logout
                </a>
              </li>
              <?php
            }
            ?>



          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>


<script>
  $(document).ready(function () {
    $('#get_slider').click(function () {
      //     alert('reading you');
      var get_slider = document.getElementById('get_slider');

      if (get_slider.checked === true) {
        var slide_control = 0;
        if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp = new XMLHttpRequest();
        }
        else {// code for IE6, IE5
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.open("GET", "slider_control.php?slide_control=" + slide_control, true);
        xmlhttp.send();
        xmlhttp.onreadystatechange = function () {
          if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            ////                 document.getElementById("dispay").innerHTML = xmlhttp.responseText;;
            var test = xmlhttp.responseText;
            if (test !== "") {
              swal({
                title: 'Success!',
                text: '' + test,
                icon: 'success',
                buttons: {
                  confirm: { text: 'Ok', className: 'sweet-orange' },

                },
                closeOnClickOutside: false
              });

            } else {
              alert('not reading control slider page');
            }
          }
        };

      } else {
        var slide_control = 1;
        if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp = new XMLHttpRequest();
        }
        else {// code for IE6, IE5
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.open("GET", "slider_control.php?slide_control=" + slide_control, true);
        xmlhttp.send();
        xmlhttp.onreadystatechange = function () {
          if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            ////                 document.getElementById("dispay").innerHTML = xmlhttp.responseText;;
            var test = xmlhttp.responseText;
            if (test !== "") {
              swal({
                title: 'Success!',
                text: '' + test,
                icon: 'success',
                buttons: {
                  confirm: { text: 'Ok', className: 'sweet-orange' },

                },
                closeOnClickOutside: false
              });

            } else {
              alert('not reading control slider page');
            }
          }
        };
      }
    });
  });     
</script>



<script>
  //Check if online or offline
  window.addEventListener("online", function () {
    alert("You are online now!");
  });

  window.addEventListener("offline", function () {
    alert("Oops! You are offline now!");
  });
  if (navigator.onLine) {
    console.log("You are online");
  } else {
    console.log("You are offline");
  }
</script>