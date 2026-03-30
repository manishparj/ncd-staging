<?php

include("inc/config.php");

$sql = "SELECT s_signupdate, COUNT(s_id) as total FROM t_user_data GROUP BY s_signupdate ORDER BY s_signupdate ASC LIMIT 10";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) >= 0) {
    $chatLabels = []; 
    $chatData = [];
    while ($row = mysqli_fetch_assoc($result)) {
        // $row = mysqli_fetch_row($result);
        // echo $row[0]." ".$row[1];
        $chatLabels[] = $row['s_signupdate'];
        $chatData[] = $row['total'];
    }
    $chatLabelsJson = json_encode($chatLabels);
    $chatDataJson = json_encode($chatData);
    echo $chatLabelsJson;
    echo $chatDataJson;

// $query = "SELECT * FROM t_user_data LIMIT 5 ";
// $result = mysqli_query($conn, $query);

// if (mysqli_num_rows($result) >= 1) {
//     while ($row = mysqli_fetch_assoc($result)) {
//         $date = $row['s_signupdate'];

//         $sql = "SELECT count(s_id) FROM t_user_data where s_signupdate='" . $row['s_signupdate'] . "' ";
//         $count = 0;
//         if ($result1 = mysqli_query($conn, $sql)) {
//             $row1 = mysqli_fetch_row($result1);
//             $count = $row1[0];
//         }
//     }
} else {
    echo "somting went wrong";
}
?>


<html>

<head>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css" rel="stylesheet">

</head>

<body>



    <canvas id="myChart" style="height: auto; width: 500px;"></canvas>

    <?php

    echo "<input type='hidden' id= 'jan' value = '$jan' >";
    echo "<input type='hidden' id= 'feb' value = '$feb' >";


    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>


    <script>
        var jan = document.getElementById("jan").value;
        var feb = document.getElementById("feb").value;


        window.onload = function() {
            var randomScalingFactor = function() {
                return Math.round(Math.random() * 100);
            };
            var config = {
                type: 'bar',
                data: {
                    borderColor: "#fffff",
                    datasets: [{
                        data: [
                            jan,
                            feb,

                        ],
                        borderColor: "#fff",
                        borderWidth: "3",
                        hoverBorderColor: "#000",

                        label: 'Monthly Sales Report',

                        backgroundColor: [
                            "#0190ff",
                            "#56d798",
                            "#ff8397",
                            "#6970d5",
                            "#f312cb",
                            "#ff0060",
                            "#ffe400"

                        ],
                        hoverBackgroundColor: [
                            "#f38b4a",
                            "#56d798",
                            "#ff8397",
                            "#6970d5",
                            "#ffe400"
                        ]
                    }],

                    labels: [
                        'Jan',
                        'Feb'

                    ]
                },

                options: {
                    responsive: true

                }
            };
            var ctx = document.getElementById('myChart').getContext('2d');
            window.myPie = new Chart(ctx, config);


        };
    </script>

</body>

</html>