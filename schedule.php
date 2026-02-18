<?php include "./includes/header.php" ?>


<div class="card my-2">
    <div class="card-header bg-primary text-white p-3 rounded">
        <h1>Matche Schedule</h1>
    </div>
    <div class="card-body">
        <a href="./schedule.php?Upcoming=Upcoming" class="btn btn-outline-success"> Upcoming Matches</a>
        <a href="./schedule.php?Recent=Recent" class="mx-1 btn btn-outline-success"> Recent Results</a>
    </div>

    <?php
    # Start Recent
    if (isset($_GET['Recent'])) { ?>
        <div class="border border-2  p-2">
            <?php
            $recenet = $pdo->query("SELECT team1.class_name AS team1,team2.class_name AS team2,matches.team1_goals,matches.team2_goals,matches.match_date,
    IF(matches.team1_goals > matches.team2_goals, team1.class_name,team2.class_name) AS winner
FROM matches 
LEFT JOIN teams AS team1 ON matches.team1_id=team1.id
LEFT JOIN teams AS team2 ON matches.team2_id=team2.id
WHERE matches.match_date<=NOW() ORDER BY matches.match_date ASC");
            // $matches = $recenet->fetchAll();
            // if (!$recenet) {
            foreach ($recenet as $matche) {
            ?>
                    <h5 class="text-secondary my-2">Matche Recent :</h5>
                <div class="border border-2 m-1 p-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div> <?= $matche['team1'] ?> <span class="badge bg-primary"><?= $matche['team1_goals'] ?></span> - <span class="badge bg-primary"><?= $matche['team2_goals'] ?></span> <?= $matche['team2'] ?></div>
                        <div><?= $matche['match_date'] ?></div>
                    </div>
                    <span
                        class="badge bg-success"><?= $matche['winner'] ?> Win</span>

                </div>
        <?php }
        }
        ?>
        </div>
        <?php
        # END Recent


        # Upcoming
        if (isset($_GET['Upcoming'])) { ?>
            <div class="border border-2  p-2">
                <?php
                $recenet = $pdo->query("SELECT team1.class_name AS team1,team2.class_name AS team2,matches.team1_goals,matches.team2_goals,matches.match_date,
    IF(matches.team1_goals > matches.team2_goals, team1.class_name,team2.class_name) AS winner
FROM matches 
LEFT JOIN teams AS team1 ON matches.team1_id=team1.id
LEFT JOIN teams AS team2 ON matches.team2_id=team2.id
WHERE matches.match_date>=NOW() ORDER BY matches.match_date ASC");
                $matches = $recenet->fetchAll();
                if (count($matches) >= 1) {
                    foreach ($matches as $matche) { ?>
                        <h5 class="text-secondary my-2">Matche Upcoming :</h5>
                

                        <div class="border border-2 m-1 p-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <div> <?= $matche['team1'] ?> <span class="badge bg-primary"><?= $matche['team1_goals'] ?></span> - <span class="badge bg-primary"><?= $matche['team2_goals'] ?></span> <?= $matche['team2'] ?></div>
                                <div><?= $matche['match_date'] ?></div>
                            </div>

                        </div>
                <?php }
                } else {
                    echo "<div class='alert alert-success'><strong>No Upcoming Matches</strong> Scheduled Yet </div>";
                }
                ?>
            </div>
        <?php }
        ?>
</div>

<?php include "./includes/footer.php" ?>