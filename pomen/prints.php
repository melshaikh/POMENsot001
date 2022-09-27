<?php
function printSide($page)
{
    $index = '';
    $users = '';
    $others = '';
    switch ($page)
    {
        case 'index':$index = 'class="active"'; break;
        case 'services':$users = 'class="active"'; break;
        case 'others':$others = 'class="active"'; break;
        default : $index = '';
    }
    echo '<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true" data-img="theme-assets/images/backgrounds/02.jpg">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">       
            <li class="nav-item mr-auto"><a class="navbar-brand" href="index.php"><img class="brand-logo" src="../images/pomenlogo.jpg"/>
              <h3 class="brand-text">IoT Farm</h3></a></li>
          <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
        </ul>
      </div>
      <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
          <li '.$index.'><a href="index.php"><i class="ft-home"></i><span class="menu-title" data-i18n="">Dashboard</span></a>
          </li>
          <li '.$users.' class=" nav-item"><a href="services.php"><i class="ft-pie-chart"></i><span class="menu-title" data-i18n="">Services</span></a>
          </li>
          <li '.$others.' class=" nav-item"><a href="others.php"><i class="ft-pie-chart"></i><span class="menu-title" data-i18n="">Others</span></a>
          </li>
          <li  class=" nav-item"><a href="logout.php"><i class="ft-book"></i><span class="menu-title" data-i18n="">logout</span></a>
          </li>
        </ul>
      </div>
      <div class="navigation-background"></div>
    </div>';
}
function printfooter()
{
    echo '<footer class="footer footer-static footer-light navbar-border navbar-shadow">
      <div class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">2021  &copy; Copyright <a class="text-bold-800 grey darken-2" href="https://elshaikh.unimap.edu.my" target="_blank">M. Elshaikh</a></span>
        
      </div>
    </footer>';
}

