<html>

<head>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body>
    <div>
        <canvas id="myChart" width="700px" height="300px"></canvas>
    </div>
    <?php
        //  include("inc/config.php");
        $sql = "SELECT `emp_type`,COUNT(`emp_id`) as total FROM `emp_details` GROUP by `emp_type`";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) >= 0) {
            $chatLabels = [];
            $chatData = [];
                while ($row = mysqli_fetch_assoc($result)) {
                    $chatLabels[] = $row['emp_type'];
                    $chatData[] = $row['total'];
                    }
                }
                $chatLabelsJson = json_encode($chatLabels);
                $chatDataJson = json_encode($chatData);
            $array = json_encode($chatLabels);;
            $json = json_encode($chatDataJson);

        ?>


    <script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito',
        '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    function number_format(number, decimals, dec_point, thousands_sep) {
        // *     example: number_format(1234.56, 2, ',', ' ');
        // *     return: '1 234,56'
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }



    var ctx = document.getElementById('myChart');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'doughnut',
        // The data for our dataset
        data: {
            labels: <?php echo $chatLabelsJson; ?>,
            datasets: [{
                label: "Employee ",
                backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)',
      'rgb(255, 205, 86)',
      'rgb(94, 119, 132)',
      'rgb(4, 136, 165)',],
                hoverBackgroundColor: "#fff",
                data: <?php echo $chatDataJson; ?>
            }]
        },
        // Configuration options go here
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            legend: {
                display: true
            },
            tooltips: {
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: true,
                caretPadding: 10,

            },
            plugins: {
              labels: {
          render: 'value',
          fontColor: ['black', 'black','black','black', 'black']
        },
            title: {
                display: true,
                text: 'Custom Chart Title'
            }
        }
            // scales: {
            //     xAxes: [{
            //         time: {
            //             unit: 'day'
            //         },
            //         gridLines: {
            //             display: false,
            //             drawBorder: false
            //         },
            //         ticks: {
            //             maxTicksLimit: 10
            //         },
            //         maxBarThickness: 25,
            //     }],
            //     yAxes: [{
            //         ticks: {
            //             min: 0,
            //             max: 20,
            //             maxTicksLimit: 10,
            //             padding: 10,
            //         },
            //         gridLines: {
            //             color: "rgb(234, 236, 244)",
            //             zeroLineColor: "rgb(234, 236, 244)",
            //             drawBorder: true,
            //             borderDash: [2],
            //             zeroLineBorderDash: [2]
            //         }
            //     }],
            // },
        }
    });
    </script>
</body>

</html>
