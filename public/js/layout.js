(function ($) {
    var tfLineChart = (function () {
        var chartBar = function () {
            var options = {
                series: [
                    {
                        name: "revenueData",
                        data: [totalRevenue],
                    },
                    {
                        name: "TotalOrders",
                        data: [totalOrders],
                    },
                ],
                chart: {
                    type: "bar",
                    height: 325,
                    toolbar: {
                        show: false,
                    },
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: "10px",
                        endingShape: "rounded",
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                legend: {
                    show: false,
                },
                colors: ["#2377FC", "#FFA500"], // Only two colors needed
                stroke: {
                    show: false,
                },
                xaxis: {
                    labels: {
                        style: {
                            colors: "#212529",
                        },
                    },
                    categories: [
                        "Jan", "Feb", "Mar", "Apr", "May", "Jun",
                        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec",
                    ],
                },
                yaxis: {
                    show: false,
                },
                fill: {
                    opacity: 1,
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return "$ " + val;
                        },
                    },
                },
            };

            var chart = new ApexCharts(
                document.querySelector("#line-chart-8"),
                options
            );
            if ($("#line-chart-8").length > 0) {
                chart.render();
            }
        };

        return {
            load: function () {
                chartBar();
            },
        };
    })();

    jQuery(window).on("load", function () {
        tfLineChart.load();
    });

})(jQuery);

