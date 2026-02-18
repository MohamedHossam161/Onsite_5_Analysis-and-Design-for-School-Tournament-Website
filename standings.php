<?php include "./includes/header.php" ?>

<h1 class="bg-primary text-white p-3 rounded">Tournament Standing</h1>

<table class="table table-hover table-dark table-bordered my-2 text-center">
    <tr>
        <th>#</th>
        <th>Team</th>
        <th>P</th>
        <th>W</th>
        <th>D</th>
        <th>L</th>
        <th>GF</th>
        <th>GA</th>
        <th>GD</th>
        <th>Pts</th>
    </tr>
    <tbody>
        <?php
        $matches = $pdo->query("SELECT teams.id,teams.class_name,COUNT(matches.id) AS matched_played,
teams.goals_scored AS Goal_for,teams.goals_aginest AS Goal_Againest,
(teams.goals_scored-teams.goals_aginest) AS Goal_difference,teams.points,
SUM(
(matches.team1_id=teams.id AND matches.team1_goals>matches.team2_goals) OR
    (matches.team2_id=teams.id AND matches.team2_goals>matches.team1_goals)
) AS wins ,
SUM(
(matches.team1_id=teams.id AND matches.team1_goals<matches.team2_goals) OR
    (matches.team2_id=teams.id AND matches.team2_goals<matches.team1_goals)
) AS losses ,
SUM(
(matches.team1_id=teams.id AND matches.team1_goals=matches.team2_goals) OR
    (matches.team2_id=teams.id AND matches.team2_goals=matches.team1_goals)
) AS draws 

FROM teams LEFT JOIN matches ON (teams.id=matches.team1_id) OR (teams.id=matches.team2_id)
GROUP BY teams.class_name, teams.goals_scored, teams.goals_aginest, teams.points");
        foreach ($matches as $index=>$stand) { ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= $stand['class_name'] ?></td>
                <td><?= $stand['matched_played'] ?></td>
                <td><?= $stand['wins'] ?></td>
                <td><?= $stand['draws'] ?></td>
                <td><?= $stand['losses'] ?></td>
                <td><?= $stand['Goal_for'] ?></td>
                <td><?= $stand['Goal_Againest'] ?></td>
                <td><?= $stand['Goal_difference'] ?></td>
                <td><?= $stand['points'] ?></td>
            </tr>
        <?php }
        ?>
    </tbody>
</table>


<div class="mt-3">
    <h4>Legend:</h4>
    <div class="d-flex">
        <p><span class="text-primary mx-1 fw-bold">P:</span> Matches</p>
        <p><span class="text-primary mx-1 fw-bold">W:</span> Wins</p>
        <p><span class="text-primary mx-1 fw-bold">D:</span> Draws</p>
        <p><span class="text-primary mx-1 fw-bold">L:</span> Losses</p>
        <p><span class="text-primary mx-1 fw-bold">GF:</span> Goals For</p>
        <p><span class="text-primary mx-1 fw-bold">GA:</span> Goals Against</p>
        <p><span class="text-primary mx-1 fw-bold">GD:</span> Goals Difference</p>
        <p><span class="text-primary mx-1 fw-bold">Pts:</span> Points</p>
    </div>
</div>
</div>
</div>

<?php include "./includes/footer.php" ?>