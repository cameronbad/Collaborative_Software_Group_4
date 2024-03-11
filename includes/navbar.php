<nav class="navbar navbar-expand-md sticky-top navbar-dark bg-dark">
    <div class="container">
    <a class="navbar-brand" href="#">EduTestPro</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <?php 
        if($_SESSION['accessLevel'] == '1') {
            echo '<li class="nav-item">
                <a class="nav-link" href="./testDashboard">Dashboard</a>
            </li>';
        }
        
        if($_SESSION['accessLevel'] == '2' || $_SESSION['accessLevel'] == '3') {
            echo '<li class="nav-item">
                <a class="nav-link" href="./studentDashboard">Students</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./testManagement">Tests</a>
            </li>';
        }
        if($_SESSION['accessLevel'] == '3') {
            echo '<li class="nav-item">
                <a class="nav-link" href="#">Lecturers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Subjects</a>
            </li>';
        }   
        ?>
        

        <li class="nav-item">
            <a class="nav-link" href="./leaderboard">Leaderboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./functionality/logout.php">Logout</a> <!-- Logs out user -->
        </li>     
        </ul>
        <span class="nav-item"> <!-- Displays the gravatar profile picture of the currently logged in user -->
            <?php
                $hash = md5(strtolower(trim($_SESSION['email'])));
                echo "<img src='http://gravatar.com/avatar/$hash?size=40&d=identicon' class='profilePicture'>";
            ?>
        </span>
        <span class="navbar-text nav-item">
            <a class="nav-link" href="#"><?= $_SESSION['username'] ?></a> <!-- Displays currently logged in user-->
        </span>
    </div>
    </div>
</nav>