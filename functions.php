<?php
$conn = mysqli_connect("localhost", "root", "", "test_hc");
// $dataMonitoring = query("SELECT * FROM monitoring");
// $dataLeader = query("SELECT * FROM leader");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}


function mapingdata($monitoring, $leader)
{
    $data = array_map(function ($monitor) use ($leader) {
        $daftarleader = array_filter($leader, function ($lead) use ($monitor) {
            return $lead['id'] == $monitor['leader_id'];
        });

        // masukin array leader yang punya id == leader id kedalam array monitor
        // $monitor['lead'] = $daftarleader;//

        // naruh isi data leader ke $monitor[]
        $leader_name = array_column($daftarleader, 'leader_name');
        $monitor['leader_name'] = array_shift($leader_name);
        $profile_picture = array_column($daftarleader, 'profile_picture');
        $monitor['profile_picture'] = array_shift($profile_picture);
        $leader_email = array_column($daftarleader, 'email');
        $monitor['leader_email'] = array_shift($leader_email);

        return $monitor;
    }, $monitoring);
    // var_dump($data);
    return $data;
}
function tanggal_indo($tanggal)
{
    $bulan = array(
        1 =>   'Jan',
        'Feb',
        'Mar',
        'Apr',
        'Mei',
        'Jun',
        'Jul',
        'Agt',
        'Sep',
        'Okt',
        'Nov',
        'Des'
    );
    $split = explode('-', $tanggal);
    return $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];
}



function addNewMP($query)
{
    global $conn;
    $project_name = htmlspecialchars($_POST["project_name"]);
    $client_name = htmlspecialchars($_POST["client_name"]);
    $leader_id = htmlspecialchars($_POST["leader_id"]);
    $start_date = htmlspecialchars($_POST["start_date"]);
    $end_date = htmlspecialchars($_POST["end_date"]);
    $progress_input = htmlspecialchars($_POST["progress"]);
    if ($progress_input == null) {
        $progress = 0;
    } else if ($progress_input != null) {
        $progress = $progress_input / 100;
    }

    if ($leader_id == null) {
        echo "
        <script>
        alert('Pastikan Semua Data terisi');
        document.location.href= '';
        </script>
        ";
    }



    $query = "INSERT INTO monitoring VALUES ('', ' $project_name' , '$client_name', '$leader_id ', '$start_date', '$end_date', '$progress' )";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function edit($id)
{
    global $conn;

    $id = $_POST["id"];
    $project_name = htmlspecialchars($_POST["project_name"]);
    $client_name = htmlspecialchars($_POST["client_name"]);
    $leader_id = htmlspecialchars($_POST["leader_id"]);
    $start_date = htmlspecialchars($_POST["start_date"]);
    $end_date = htmlspecialchars($_POST["end_date"]);
    $progress_input = htmlspecialchars($_POST["progress"]);
    if ($progress_input == null) {
        $progress = 0;
    } else if ($progress_input != null) {
        $progress = $progress_input / 100;
    }

    $query = "UPDATE monitoring SET project_name = '$project_name', client_name='$client_name', leader_id ='$leader_id',start_date ='$start_date', end_date='$end_date', progress='$progress' WHERE id=$id ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}


function delete($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM monitoring WHERE id = $id");

    return mysqli_affected_rows($conn);
}

function cari($keyword)
{
    $query = "SELECT * FROM monitoring
            WHERE 
            project_name LIKE'%$keyword%' OR 
            client_name LIKE '%$keyword%' 
    ";

    return query($query);
}
