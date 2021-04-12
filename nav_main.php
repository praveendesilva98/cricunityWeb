<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
        <a class="logo" href="index.php"><img src="photos/logo.png"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a class="nav-link" href="index.php">HOME</a></li>
        <li><a class="nav-link" href="home.php">FEED</a></li>
        <li><a class="nav-link" href="<?= $userLoggedIn ?>">PROFILE</a></li>

        <li class="dropdown">
          <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">TEAMS<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="australia.php">AUSTRALIA</a></li>
            <li><a class="dropdown-item" href="bangladesh.php">BANGLADESH</a></li>
            <li><a class="dropdown-item" href="england.php">ENGLAND</a></li>
            <li><a class="dropdown-item" href="india.php">INDIA</a></li>
            <li><a class="dropdown-item" href="newzealand.php">NEW ZEALAND</a></li>
            <li><a class="dropdown-item" href="pakistan.php">PAKISTAN</a></li>
            <li><a class="dropdown-item" href="southafrica.php">SOUTH AFRICA</a></li>
            <li><a class="dropdown-item" href="srilanka.php">SRI LANKA</a></li>
            <li><a class="dropdown-item" href="westindies.php">WEST INDIES</a></li>
            <li><a class="dropdown-item" href="othercountries.php">OTHER NATIONS</a></li>
            <div class="dropdown-divider"></div>
            <li><a class="dropdown-item" href="ipl.php">IPL</a></li>
            <li><a class="dropdown-item" href="bbl.php">BBL</a></li>
            <li><a class="dropdown-item" href="psl.php">PSL</a></li>
            <li><a class="dropdown-item" href="cpl.php">CPL</a></li>
            <li><a class="dropdown-item" href="otherleagues.php">OTHER LEAGUES</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="news.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">NEWS<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="news.php">ALL NEWS</a></li>
            <li><a class="dropdown-item" href="australianews.php">AUSTRALIA</a></li>
            <li><a class="dropdown-item" href="bangladeshnews.php">BANGLADESH</a></li>
            <li><a class="dropdown-item" href="englandnews.php">ENGLAND</a></li>
            <li><a class="dropdown-item" href="indianews.php">INDIA</a></li>
            <li><a class="dropdown-item" href="newzealandnews.php">NEW ZEALAND</a></li>
            <li><a class="dropdown-item" href="pakistannews.php">PAKISTAN</a></li>
            <li><a class="dropdown-item" href="southafricanews.php">SOUTH AFRICA</a></li>
            <li><a class="dropdown-item" href="srilankanews.php">SRI LANKA</a></li>
            <li><a class="dropdown-item" href="westindiesnews.php">WEST INDIES</a></li>
            <li><a class="dropdown-item" href="othercountriesnews.php">OTHER NATIONS</a></li>
            <div class="dropdown-divider"></div>
            <li><a class="dropdown-item" href="iplnews.php">IPL</a></li>
            <li><a class="dropdown-item" href="bblnews.php">BBL</a></li>
            <li><a class="dropdown-item" href="pslnews.php">PSL</a></li>
            <li><a class="dropdown-item" href="cplnews.php">CPL</a></li>
            <li><a class="dropdown-item" href="otherleaguesnews.php">OTHER LEAGUES</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="videos.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">VIDEOS<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="videos.php">ALL VIDEOS</a></li>
            <li><a class="dropdown-item" href="australiavideos.php">AUSTRALIA</a></li>
            <li><a class="dropdown-item" href="bangladeshvideos.php">BANGLADESH</a></li>
            <li><a class="dropdown-item" href="englandvideos.php">ENGLAND</a></li>
            <li><a class="dropdown-item" href="indiavideos.php">INDIA</a></li>
            <li><a class="dropdown-item" href="newzealandvideos.php">NEW ZEALAND</a></li>
            <li><a class="dropdown-item" href="pakistanvideos.php">PAKISTAN</a></li>
            <li><a class="dropdown-item" href="southafricavideos.php">SOUTH AFRICA</a></li>
            <li><a class="dropdown-item" href="srilankavideos.php">SRI LANKA</a></li>
            <li><a class="dropdown-item" href="westindiesvideos.php">WEST INDIES</a></li>
            <li><a class="dropdown-item" href="othercountriesvideos.php">OTHER NATIONS</a></li>
            <div class="dropdown-divider"></div>
            <li><a class="dropdown-item" href="iplvideos.php">IPL</a></li>
            <li><a class="dropdown-item" href="bblvideos.php">BBL</a></li>
            <li><a class="dropdown-item" href="pslvideos.php">PSL</a></li>
            <li><a class="dropdown-item" href="cplvideos.php">CPL</a></li>
            <li><a class="dropdown-item" href="otherleaguesvideos.php">OTHER LEAGUES</a></li>
          </ul>
        </li>

        <li><a class="nav-link" href="topics.php">TOPICS</a></li>
        
        <li><a class="nav-link" href="upload-contents.php">UPLOAD CONTENT</a></li>
        <li><a class="nav-link" href="profile-settings.php">SETTINGS</a></li>
        <li><a class="nav-link" href="logout.php">LOGOUT</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<script src="main.js"></script>