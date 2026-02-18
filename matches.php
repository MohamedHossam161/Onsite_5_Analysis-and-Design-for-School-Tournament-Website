<?php include "./includes/header.php" ?>

<h1 class="bg-primary text-white p-3 rounded">Team Managment</h1>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $team1_id = $_POST['team1_id'];
    $team2_id = $_POST['team2_id'];
    $team1_goals = $_POST['team1_goals'];
    $team2_goals = $_POST['team2_goals'];
    $date = $_POST['date'];
    $stmt = $pdo->prepare("INSERT INTO `matches`(`team1_id`, `team2_id`, `team1_goals`, `team2_goals`, `match_date`) VALUES (?,?,?,?,?)");
    $stmt->execute([$team1_id, $team2_id, $team1_goals, $team2_goals, $date]);
    $pointForteam1 = 0;
    $pointForteam2 = 0;
    if ($team1_id) {
        if ($team1_goals > $team2_goals) {
            $pointForteam1 = 3;
        } elseif ($team1_goals == $team2_goals) {
            $pointForteam1 = 1;
        }
        $stmt = $pdo->prepare("UPDATE `teams` SET `points`=points+?,`goals_scored`=goals_scored+?,`goals_aginest`=goals_aginest+? WHERE id=?");
        $stmt->execute([$pointForteam1, $team1_goals, $team2_goals, $team1_id]);
    }
    if ($team2_id) {
        if ($team2_goals > $team1_goals) {
            $pointForteam2 = 3;
        } elseif ($team1_goals == $team2_goals) {
            $pointForteam2 = 1;
        }
        $stmt = $pdo->prepare("UPDATE `teams` SET `points`=points+?,`goals_scored`=goals_scored+?,`goals_aginest`=goals_aginest+? WHERE id=?");
        $stmt->execute([$pointForteam2, $team2_goals, $team1_goals, $team2_id]);
    }
    header("location:matches.php");
}

?>
<form action="" method="post">
    <div class="row">
        <div class="col-md-3">
            <select class="form-select" name="team1_id" id="">
                <?php
                $teams = $pdo->query("SELECT * FROM `teams`");
                foreach ($teams as $team) { ?>
                    <option value="<?= $team['id'] ?>"><?= $team['class_name'] ?></option>
                <?php }
                ?>
            </select>
        </div>
        <div class="col-md-1">
            <input type="text" class="form-control" name="team1_goals">
        </div>
        <div class="col-md-1">
            <input type="text" class="form-control" name="team2_goals">
        </div>
        <div class="col-md-3">
            <select class="form-select" name="team2_id" id="">
                <?php
                $teams = $pdo->query("SELECT * FROM `teams`");

                foreach ($teams as $team) { ?>
                    <option value="<?= $team['id'] ?>"><?= $team['class_name'] ?></option>
                <?php }
                ?>
            </select>
        </div>
        <div class="col-md-3">
            <input class="form-control" type="date" name="date">
        </div>
        <div class="col-md-1">
            <button class="btn btn-success">Save</button>
        </div>
    </div>
</form>

<h1 class="text-secondary my-2">Matches Hestory</h1>

<table class="table table-hover table-dark table-bordered my-2 text-center">
    <tr>
        <th>Date</th>
        <th>Match</th>
        <th>Result</th>
    </tr>
    <tbody>
        <?php
        $matches = $pdo->query("SELECT team1.class_name AS team1_name,team2.class_name AS team2_name,matches.team1_goals AS team1_goals,matches.team2_goals AS team2_goals ,matches.match_date FROM matches
LEFT JOIN teams AS team1 ON matches.team1_id=team1.id
LEFT JOIN teams AS team2 ON matches.team2_id=team2.id");
        foreach ($matches as $team) { ?>
            <tr>
                <td><?= $team['match_date'] ?></td>
                <td><?= $team['team1_name'] ?> <span class="text-warning fw-bold">VS</span> <?= $team['team2_name'] ?></td>
                <td><?= $team['team1_goals'] ?> <span class="text-warning fw-bold">-</span> <?= $team['team2_goals'] ?></td>
            </tr>
        <?php }
        ?>
    </tbody>
</table>

<?php include "./includes/footer.php" ?>