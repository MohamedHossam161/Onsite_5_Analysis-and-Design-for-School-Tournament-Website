<?php include "./includes/header.php" ?>

<div class="container my-4">
    <div class="jumbotron text-center bg-primary text-white p-5 rounded">
        <h1 class="display-4">Welcome to Home Page</h1>
    </div>
</div>

<div class="container my-5">
    <div class="row text-center">
        <div class="col-md-4 mb-3">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Teams</h5>
                    <p>View all participating teams in the tournament.</p>
                    <a href="./teams.php" class="btn btn-primary">View Teams</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Matches</h5>
                    <p>Check the full match schedule and results.</p>
                    <a href="./schedule.php?Upcoming=Upcoming" class="btn btn-primary">View Matches</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Standings</h5>
                    <p>See the latest tournament rankings and points table.</p>
                    <a href="./standings.php" class="btn btn-primary">View Standings</a>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include "./includes/footer.php" ?>
