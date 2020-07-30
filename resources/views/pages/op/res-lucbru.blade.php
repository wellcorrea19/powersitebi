@extends('layouts.master')

@section('content')

<div id="page-wrapper">
    <div class="graphs">
        <h3 class="blank1 text-center">Elo Painel</h3>
        <div class="graph_box">

            <div class="col-md-12 col-lg-12">
                <div class="main-card mb-3 card">
                    <div class="card-header-tab card-header">
                        <div class="m-auto">
                            <a href="#" id="mes_anterior" class="ml-1 btn-pill btn-wide border-0 btn-transition  btn btn-outline-alternate second-tab-toggle-alt"  onclick="mes_anterior();">Mes Anterior</a>
                            <a href="#" id="mes_atual" class="border-0 btn-pill btn-wide btn-transition  btn btn-outline-alternate" onclick="mes_atual();">Mes Atual</a>
                            <a href="#" id="data_costum" class="ml-1 btn-pill btn-wide border-0 btn-transition  btn btn-outline-alternate second-tab-toggle-alt" >Escolha Uma Data</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-lg-12">
                <div class="main-card mb-6 card">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title m-auto">
                            <i class="header-icon lnr-rocket icon-gradient bg-tempting-azure"> </i>
                            Relatório Operacional Por Modalidade
                        </div>
                    </div>
                    <div class="card-body animate-bottom" id="loader1">
                    </div>
                    <div class="card-body">
                        <canvas id="chart-doughnut-1"></canvas>
                    </div>
                    <ul id="rank-1"
                        class="rm-list-borders rm-list-borders-scroll list-group list-group-flush"></ul>
                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                    </div>
                    <div class="ps__rail-y" style="top: 0px; height: 200px; right: 0px;">
                        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 173px;"></div>
                    </div>
                </div>
                <br>
                <div class="main-card mb-6 card">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title m-auto">
                            <i class="header-icon lnr-rocket icon-gradient bg-tempting-azure"> </i>
                            Relatório Operacional Por Tipo De Frete
                        </div>
                    </div>
                    <div class="card-body animate-bottom" id="loader2">
                    </div>
                    <div class="card-body">
                        <canvas id="chart-doughnut-2"></canvas>
                    </div>
                    <ul id="rank-2"
                        class="rm-list-borders rm-list-borders-scroll list-group list-group-flush"></ul>
                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                    </div>
                    <div class="ps__rail-y" style="top: 0px; height: 200px; right: 0px;">
                        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 173px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--  -->
<script type="text/javascript">
    moment.locale('pt-br');
    var actualData, _actualData;
    var chart1, chart2, chart3;

    Chart.defaults.global.tooltips.callbacks.label = function(tooltipItem, data) {
        var dataset = data.datasets[tooltipItem.datasetIndex];
        var datasetLabel = dataset.label || '';
        return datasetLabel + ": R$" + parseFloat(dataset.data[tooltipItem.index]).toFixed(2).replace('.', ',').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
    };


    // GRAFICO FATURAMENTOS
    function faturamento(datainicial,datafinal){
        if(chart1 !== undefined){chart1.destroy()
        document.getElementById("loader1").style.display = "block";}
        $.get("/faturamento/get/fiscal?datainicial="+datainicial+"&datafinal="+datafinal , function (res) {
            let data = JSON.parse(res).fatfiscal;
            let label = new Array();
            let valor = new Array();
            $('#chart-doughnut-1').html('');
            $('#rank-2').html('');
            for ( i in data){
                label.push(data[i].LABEL);
                valor.push(data[i].VALOR);
                var HTMLNovo = '<li class="list-group-item">' +
                    '<div class="widget-content p-0">' +
                    '<div class="widget-content-wrapper">' +
                    '<div class="widget-content-left mr-3"></div>' +
                    '<div class="widget-content-left">' +
                    '<div class="widget-heading">' + data[i].LABEL + '</div>' +
                    '</div>' +
                    '<div class="widget-content-right">' +
                    '<div class="font-size-xlg text-muted">' +
                    '<small class="opacity-5 pr-1">R$</small>' +
                    '<span>' +  parseFloat(data[i].VALOR).toFixed(2).replace('.', ',').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + '</span>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</li>';
                $('#rank-2').append(HTMLNovo);
            }

            let ctx = document.getElementById('chart-doughnut-1').getContext('2d');
            document.getElementById("loader1").style.display = "none";
            let options = {
                responsive: true,
                tooltips: {
                    beginAtZero: true,
                    callbacks: {
                        label: function (tooltipItems, data) {
                            return data.labels[tooltipItems.index] + ' - ' + 'R$' + data.datasets[0].data[tooltipItems.index].replace('.', ',').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
                        }

                    }
                }
            };
            chart1 = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: label,
                    datasets: [{
                        label: 'Gráfico de Dados',
                        data: valor,
                        backgroundColor: [
                            'rgba(50, 202, 50)',
                            'rgba(167, 159, 159, 1)',
                        ],
                    }]
                },
                options: options
            });
        });
    }

    // GRAFICO GERENCIAL CLIENTE
    function gerencialcliente(datainicial,datafinal){
        if(chart2 !== undefined){chart2.destroy()
        document.getElementById("loader3").style.display = "block";}
        $.get("/faturamento/get/gerencialcliente?datainicial="+datainicial+"&datafinal="+datafinal, function (res) {
            data = JSON.parse(res).fatgerencial_cliente;
            let label = new Array();
            let valor = new Array();
            let color = new Array();
            $('#rank-1').html('');
            $('#chart-bar').html('');
            for (i in data) {
                label.push(data[i].LABEL);
                valor.push(data[i].VALOR);
                color.push(gera_cor());
                var HTMLNovo = '<li class="list-group-item">' +
                    '<div class="widget-content p-0">' +
                    '<div class="widget-content-wrapper">' +
                    '<div class="widget-content-left mr-3"></div>' +
                    '<div class="widget-content-left">' +
                    '<div class="widget-heading">' + data[i].LABEL + '</div>' +
                    '</div>' +
                    '<div class="widget-content-right">' +
                    '<div class="font-size-xlg text-muted">' +
                    '<small class="opacity-5 pr-1">R$</small>' +
                    '<span>' +  parseFloat(data[i].VALOR).toFixed(2).replace('.', ',').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + '</span>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</li>';
                $('#rank-1').append(HTMLNovo);
            }
            let ctx = document.getElementById('chart-bar').getContext('2d');
            document.getElementById("loader3").style.display = "none";
            let options = {
                responsive: true,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function (value, index, values) {
                                if (parseInt(value) >= 1000) {
                                    return 'R$' +  parseFloat(value).toFixed(2).replace('.', ',').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
                                } else {
                                    return 'R$' + value;
                                }
                            }
                        }
                    }],
                    xAxes: [{
                        display: false
                    }],
                }
            };
            chart2 = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: label,
                    datasets: [{
                        label: 'Gráfico de Dados',
                        data: valor,
                        backgroundColor: color,
                    }]
                },
                options: options
            });
        });
    }

    // GRAFICO GERENCIAL
    function gerencial(datainicial,datafinal){
        if(chart3 !== undefined){chart3.destroy()
        document.getElementById("loader2").style.display = "block";}
        $.get("/faturamento/get/gerencial?datainicial="+datainicial+"&datafinal="+datafinal, function (res) {
            data = JSON.parse(res).fatgerencial;
            let label = new Array();
            let valor = new Array();
            $('#chart-doughnut-2').html('');
            $('#rank-3').html('');
            for ( i in data){
                label.push(data[i].LABEL);
                valor.push(data[i].VALOR);
                var HTMLNovo = '<li class="list-group-item">' +
                    '<div class="widget-content p-0">' +
                    '<div class="widget-content-wrapper">' +
                    '<div class="widget-content-left mr-3"></div>' +
                    '<div class="widget-content-left">' +
                    '<div class="widget-heading">' + data[i].LABEL + '</div>' +
                    '</div>' +
                    '<div class="widget-content-right">' +
                    '<div class="font-size-xlg text-muted">' +
                    '<small class="opacity-5 pr-1">R$</small>' +
                    '<span>' +  parseFloat(data[i].VALOR).toFixed(2).replace('.', ',').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + '</span>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</li>';
                $('#rank-3').append(HTMLNovo);
            }
            let ctx = document.getElementById('chart-doughnut-2').getContext('2d');
            document.getElementById("loader2").style.display = "none";
            let options = {
                responsive: true,
                tooltips: {
                    beginAtZero: true,
                    callbacks: {
                        label: function (tooltipItems, data) {
                            return data.labels[tooltipItems.index] + ' - ' + 'R$' + data.datasets[0].data[tooltipItems.index].replace('.', ',').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
                        }

                    }
                }
            };
            chart3 = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: label,
                    datasets: [{
                        label: 'Gráfico de Dados',
                        data: valor,
                        backgroundColor: [
                            'rgba(50, 202, 50)',
                            'rgba(167, 159, 159, 1)',
                        ],
                    }]
                },
                options: options
            });
        });
    }
    function mes_atual() {
        actualData = moment().startOf("Month").format('DD/MM/YYYY');
        _actualData = moment().format('DD/MM/YYYY');
        load_api(actualData,_actualData);
        $("#mes_anterior").removeClass('active');
        $("#data_costum").removeClass('active');
        $("#mes_atual").addClass('active');
    }

    function mes_anterior() {
        actualData = moment().subtract(1, 'Month').startOf("Month").format('DD/MM/YYYY');
        _actualData = moment().subtract(1, 'Month').endOf("Month").format('DD/MM/YYYY');
        load_api(actualData,_actualData);
        $("#mes_atual").removeClass('active');
        $("#data_costum").removeClass('active');
        $("#mes_anterior").addClass('active');
    }

    function data_custom(startDate,lastDate) {
        $("#mes_atual").removeClass('active');
        $("#mes_anterior").removeClass('active');
        $("#data_costum").addClass('active');
        load_api(startDate,lastDate);
    }

    function load_api(startDate,lastDate) {
        faturamento(startDate,lastDate);
        gerencial(startDate,lastDate);
        gerencialcliente(startDate,lastDate);
    }

    function gera_cor(){
        var hexadecimais = '0123456789ABCDEF';
        var cor = '#';

        // Pega um número aleatório no array acima
        for (var i = 0; i < 6; i++ ) {
            //E concatena à variável cor
            cor += hexadecimais[Math.floor(Math.random() * 16)];
        }
        return cor;
    }

</script>

<!-- Script calendario -->
<script type="text/javascript">
    mes_atual();

    $(function() {
        $('#data_costum').daterangepicker(
            {
                "locale": {
                    "format": "DD/MM/YYYY",
                    "separator": " - ",
                    "applyLabel": "Aplicar",
                    "cancelLabel": "Cancelar",
                    "daysOfWeek": [
                        "Dom",
                        "Seg",
                        "Ter",
                        "Qua",
                        "Qui",
                        "Sex",
                        "Sab"
                    ],
                    "monthNames": [
                        "Janeiro",
                        "Fevereiro",
                        "Março",
                        "Abril",
                        "Maio",
                        "Junho",
                        "Julho",
                        "Agosto",
                        "Setembro",
                        "Outubro",
                        "Novembro",
                        "Dezembro"
                    ],
                    "firstDay": 1
                }
            } , function(start, end, label) {
            data_custom(start.format('DD/MM/YYYY'),end.format('DD/MM/YYYY'));
        });
    });


</script>


@endsection
