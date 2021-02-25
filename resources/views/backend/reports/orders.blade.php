@extends('backend.layouts.master')

@section('title')
Reports
@endsection

@section('custom-css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('vendor/datatables/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/datatables/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Daterangepicker -->
<link href="{{ asset('vendor/daterangepicker/daterangepicker.css') }}" type="text/css" rel="stylesheet" />

<style>
    .notice {
        font-style: italic;
        font-size: 0.8em;
    }
</style>
@endsection

@section('content-header')
Orders
@endsection

@section('content-header-menu')
Orders
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <form method="get" action="#" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label style="margin-left:10px; margin-top: 10px;" for="timeCreateReport">Time to report</label>
                    <input type="text" class="form-control" id="timeCreateReport">
                    <span id="timeCreateReportText" class="notice"></span>
                </div>
                <div class="form-group" style="display: none;">
                    <label for="fromDay">From day</label>
                    <input type="text" class="form-control" id="fromDay" name="fromDay">
                </div>
                <div class="form-group" style="display: none;">
                    <label for="toDay">To day</label>
                    <input type="text" class="form-control" id="toDay" name="toDay">
                </div>
                <button style="margin-left: 10px;" type="submit" class="btn btn-primary" id="btnCreatReport">Create</button>
            </form>
            <div class="col-md-12">
                <canvas id="chartOfobjChart" style="width: 100%;height: 400px;"></canvas>
            </div>
        </div>
    </div>
    
</div>
@endsection
@section('custom-scripts')
<!-- DataTables -->
<script src="{{ asset('vendor/datatables/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<!-- Moments -->
<script src="{{ asset('vendor/momentjs/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/daterangepicker/daterangepicker.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#timeCreateReport').daterangepicker({
            "showWeekNumbers": true,
            "showISOWeekNumbers": true,
            "timePicker": true,
            "timePicker24Hour": true,
            "locale": {
                "format": "DD/MM/YYYY HH:mm:ss",
                "separator": " - ",
                "applyLabel": "Accept",
                "cancelLabel": "Cancel",
                "fromLabel": "From",
                "toLabel": "To",
                "customRangeLabel": "Option",
                "weekLabel": "Day",
                "daysOfWeek": [
                    "Sun",
                    "Mon",
                    "Tue",
                    "Wed",
                    "Thu",
                    "Fri",
                    "Sat"
                ],
                "monthNames": [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec",
                ],
                "firstDay": 1
            },
            "startDate": "15/07/2019",
            "endDate": "21/07/2019",
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 days': [moment().subtract(6, 'days'), moment()],
                'Last 30 days': [moment().subtract(29, 'days'), moment()],
                'This month': [moment().startOf('month'), moment().endOf('month')],
                'Last month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, function(start, end, label) {
            // Hiển thị thời gian đã chọn
            $('#timeCreateReportText').html('Data will be listed from <span style="font-weight: bold">' + start.format('DD/MM/YYYY, HH:mm') + '</span> to <span style="font-weight: bold">' + end.format('DD/MM/YYYY, HH:mm') + '</span><br />Report preparation time can take several minutes, please press a button <span style="font-weight: bold">"Create"</span> and wait a few minutes!');

            // Gán giá trị cho Ngày để gởi dữ liệu về Backend
            $('#fromDay').val(start.format('YYYY-MM-DD HH:mm:ss'));
            $('#toDay').val(end.format('YYYY-MM-DD HH:mm:ss'));
        });
    });
</script>
<!-- NumeralJS -->
<script src="{{ asset('vendor/numeraljs/numeral.min.js') }}"></script>
<script>
    // Đăng ký tiền tệ VNĐ
    numeral.register('locale', 'vi', {
        delimiters: {
            thousands: ',',
            decimal: '.'
        },
        abbreviations: {
            thousand: 'k',
            million: 'm',
            billion: 'b',
            trillion: 't'
        },
        ordinal: function(number) {
            return number === 1 ? 'một' : 'không';
        },
        currency: {
            symbol: 'vnđ'
        }
    });

    // Sử dụng locate vi (Việt nam)
    numeral.locale('vi');
</script>
<!-- Các script dành cho thư viện ChartJS -->
<script src="{{ asset('vendor/chartjs/Chart.min.js') }}"></script>
<script>
    $(document).ready(function() {
        var objChart;
        var $chartOfobjChart = document.getElementById("chartOfobjChart").getContext("2d");

        $("#btnCreatReport").click(function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('admin.report.orders.data') }}',
                type: "GET",
                data: {
                    fromDay: $('#fromDay').val(),
                    toDay: $('#toDay').val(),
                },
                success: function(response) {
                    var myLabels = [];
                    var myData = [];
                    console.log(response);
                    $(response.data).each(function() {
                        myLabels.push((this.time));
                        myData.push(this.total);
                    });
                    myData.push(0); // creates a '0' index on the graph

                    if (typeof $objChart !== "undefined") {
                        $objChart.destroy();
                    }

                    $objChart = new Chart($chartOfobjChart, {
                        // The type of chart we want to create
                        type: "bar",

                        data: {
                            labels: myLabels,
                            datasets: [{
                                data: myData,
                                borderColor: "#9ad0f5",
                                backgroundColor: "#9ad0f5",
                                borderWidth: 1
                            }]
                        },

                        // Configuration options go here
                        options: {
                            legend: {
                                display: false
                            },
                            title: {
                                display: true,
                                text: "Report Orders"
                            },
                            scales: {
                                xAxes: [{
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Ngày nhận đơn hàng'
                                    }
                                }],
                                yAxes: [{
                                    ticks: {
                                        callback: function(value) {
                                            return numeral(value).format('0,0 $')
                                        }
                                    },
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Tổng thành tiền'
                                    }
                                }]
                            },
                            tooltips: {
                                callbacks: {
                                    label: function(tooltipItem, data) {
                                        return numeral(tooltipItem.value).format('0,0 $')
                                    }
                                }
                            },
                            responsive: true,
                            maintainAspectRatio: false,
                        }
                    });
                }
            });
        });

    });
</script>
@endsection

