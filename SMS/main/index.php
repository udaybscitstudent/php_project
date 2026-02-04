<?php 
include 'checklogin.php';
include 'header.php'; 
include 'conn.php';
$query = "select count(*) from students";
$query_p = "select count(*) from attendance where attendance = 'P' and DATE(DATE) = CURDATE()";

$res = mysqli_query($conn, $query);
$row = mysqli_fetch_array($res)[0];

$res_p = mysqli_query($conn, $query_p);
$row_p = mysqli_fetch_array($res_p)[0];
?>
<div class="h-[85vh] w-[90%]  mt-5 m-auto text-sm">
    <div class="grid grid-cols-3 gap-5 w-full mx-auto h-25">
        <div class="bg-white rounded shadow p-4 flex justify-center items-center"><p class="text-center text-lg">Total Students<br><?php echo $row; ?></p></div>
        <div class="bg-white rounded shadow p-4 flex justify-center items-center"><p class="text-center text-lg">Today Present Students<br><?php echo $row_p; ?></p></div>
        <div class="bg-white rounded shadow p-4 flex justify-center items-center"><p class="text-center text-lg">Today Absent Students<br><?php echo $row - $row_p; ?></p></div>
    </div>
<div class="h-[70vh] bg-white rounded shadow-lg w-full m-auto mt-5 py-5 px-5">
<?php
$result = mysqli_query($conn, "
    SELECT 
        MONTH(DATE) AS month,
        COUNT(DISTINCT S_ID) AS total_present
    FROM attendance
    WHERE ATTENDANCE = 'P'
    GROUP BY MONTH(DATE)
    ORDER BY MONTH(DATE)
");

$monthlyData = array_fill(1, 12, 0);

while ($row = mysqli_fetch_assoc($result)) {
    $monthlyData[$row['month']] = $row['total_present'];
}
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<canvas id="myChart"></canvas>

<script>
const data = <?php echo json_encode(array_values($monthlyData)); ?>;

new Chart(document.getElementById('myChart'), {
    type: 'bar',
    data: {
        labels: [
            'Jan','Feb','Mar','Apr','May','Jun',
            'Jul','Aug','Sep','Oct','Nov','Dec'
        ],
        datasets: [{
            label: 'Present Students Per Month',
            data: data,
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                }
            }
        }
    }
});
</script>


</div>
</div>
<?php include 'footer.php'; ?>
        