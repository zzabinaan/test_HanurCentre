<?php
require 'functions.php';

$monitoring = query("SELECT * FROM monitoring");
$leader = query("SELECT * FROM leader");
if (isset($_GET["cari"])) {
    $monitoring = cari($_GET["keyword"]);
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Monitoring Projects</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="cont container rounded shadow">
        <div class="d-flex align-items-center justify-content-between mt-5 mb-4">
            <h1> Project Monitoring</h1>
            <div class="d-flex">
                <form action="" method="GET" class="d-flex position-relative">
                    <input class="field" type="text" name="keyword" size="27rem" placeholder="search by project or client...">
                    <button class="position-absolute cari" name="cari"><img src="img/search.png" alt="search"></button>
                </form>
                <div class="mt-2 ms-2">
                    <a href=" addNewMP.php" class="pt-2 pb-2 ps-3 pe-3 rounded add-new"><span class="me-2 ms-0 p-0 bolder">+</span>Add New Projects</a>
                </div>
            </div>

        </div>


        <table class="table mb-4">
            <thead class="bg-light">
                <tr>
                    <th scope="col">PROJECT NAME</th>
                    <th scope="col">CLIENT</th>
                    <th scope="col">PROJECT LEADER</th>
                    <th scope="col">START DATE</th>
                    <th scope="col">END DATE</th>
                    <th scope="col">PROGRESS</th>
                    <th scope="col">ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($monitoring as $m) : ?>
                    <?php $i = $m["leader_id"] - 1;
                    $progress = $m["progress"] * 100;
                    ?>
                    <tr>
                        <td>
                            <div class="h-100 d-flex align-items-center">
                                <?= $m["project_name"] ?>
                            </div>

                        </td>
                        <td>
                            <div class="h-100 d-flex align-items-center">
                                <?= $m["client_name"] ?>
                            </div>
                        </td>
                        <td>
                            <div class="h-100 leader d-flex align-items-center">
                                <div class="image-con">
                                    <img class="rounded-circle" src="img/<?= $leader[$i]["profile_picture"] ?>" alt="profile-leader">
                                </div>
                                <div class="w-75">
                                    <div class="bolder">
                                        <?= $leader[$i]["leader_name"] ?>
                                    </div>
                                    <div>
                                        <?= $leader[$i]["email"] ?>
                                    </div>

                                </div>
                            </div>

                        </td>
                        <td>
                            <div class="h-100 d-flex align-items-center">
                                <?= tanggal_indo($m["start_date"]) ?>
                            </div>
                        </td>
                        <td>
                            <div class="h-100 d-flex align-items-center">
                                <?= tanggal_indo($m["end_date"]) ?>
                            </div>
                        </td>
                        <td style="width: 15rem;">
                            <?php if ($progress == 100) : ?>
                                <div class="h-100 mt-3 pt-1 mb-3">
                                    <div style="float:right; margin-top: -0.2rem;" class="ms-2">
                                        <?= $progress ?>%
                                    </div>
                                    <div class="progress h-25">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width:<?= $progress ?>%; background-color:#13b780;">
                                        </div>
                                    </div>
                                </div>

                            <?php else : ?>
                                <div class="h-100 mt-3 pt-1 mb-3">
                                    <div style="float:right; margin-top: -0.2rem;" class="ms-2">
                                        <?= $progress ?>%
                                    </div>
                                    <div class="progress h-25">
                                        <div class="progress-bar" role="progressbar" aria-valuemin="" aria-valuemax="100" style="width:<?= $progress ?>%; ">
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="h-100 d-flex align-items-center">
                                <a href="delete.php?id=<?= $m["id"]; ?>" class="bg-danger m-1 pt-1 pb-2 ps-2 pe-2 rounded" onclick="return confirm('Yakin Menghapus Data <?= $m['project_name'] ?>');"><img src="img/delete.png" alt="delete" style="width: 0.9rem;"></a>
                                <a href="edit.php?id=<?= $m["id"]; ?>" class=" m-1 pt-1 pb-2 ps-2 pe-2 rounded" style="background-color:#13b780;"><img src="img/draw.png" alt="edit" style="width: 0.9rem; "></a>
                            </div>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>