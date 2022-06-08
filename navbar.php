        <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon">
					<img src="images/index.png" class="img-fluid">
                </div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
<?php if($_SESSION["login_user_type"]=="Admin") {?>
            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link" href="notifications.php">
                    <i class="fas fa-fw fa-paper-plane"></i>
                    <span>Notifications</span>
                </a>
            </li>
<?php } ?>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLinks1"
                    aria-expanded="true" aria-controls="collapseLinks1">
                    <i class="fas fa-fw fa-cubes"></i>
                    <span>Conferences</span>
                </a>
                <div id="collapseLinks1" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="conferences.php">All Conferences</a>
                        <a class="collapse-item" href="conference.php">Add Conference</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLinks2"
                    aria-expanded="true" aria-controls="collapseLinks2">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Books</span>
                </a>
                <div id="collapseLinks2" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="books.php">All Books</a>
                        <a class="collapse-item" href="book.php">Add Book</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLinks4"
                    aria-expanded="true" aria-controls="collapseLinks4">
                    <i class="fas fa-fw fa-trophy"></i>
                    <span>Journals</span>
                </a>
                <div id="collapseLinks4" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="journals.php">All Journals</a>
                        <a class="collapse-item" href="journal.php">Add Journal</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLinks5"
                    aria-expanded="true" aria-controls="collapseLinks5">
                    <i class="fas fa-fw fa-image"></i>
                    <span>Expert Talks</span>
                </a>
                <div id="collapseLinks5" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="experttalks.php">All Expert Talks</a>
                        <a class="collapse-item" href="experttalk.php">Add Expert Talk</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLinks3"
                    aria-expanded="true" aria-controls="collapseLinks3">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Users</span>
                </a>
                <div id="collapseLinks3" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="users.php">All Users</a>
                        <a class="collapse-item" href="user.php">Add User</a>
                    </div>
                </div>
            </li>

        </ul>