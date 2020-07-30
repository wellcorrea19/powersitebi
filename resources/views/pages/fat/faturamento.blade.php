@extends('layouts.master')

@section('content')

<div id="page-wrapper">
    <div class="graphs">
        <h3 class="blank1 text-center">Faturamentos</h3>
        <div class="graph_box">

            <div class="col-md-12 col-lg-12">
                <div class="main-card mb-3 card">
                    <div class="card-header-tab card-header">
                        <div class="text-center">
                            <a href="#" id="mes_anterior" class="ml-1 btn-pill btn-wide border-0 btn-transition  btn btn-outline-alternate second-tab-toggle-alt"  onclick="mes_anterior();">Mes Anterior</a>
                            <a href="#" id="mes_atual" class="border-0 btn-pill btn-wide btn-transition  btn btn-outline-alternate" onclick="mes_atual();">Mes Atual</a>
                            <a href="#" id="data_costum" class="ml-1 btn-pill btn-wide border-0 btn-transition  btn btn-outline-alternate second-tab-toggle-alt" >Escolha Uma Data</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-lg-6">
                <div class="main-card mb-3 card">
                    <div class="card-header-tab card-header" >
                        <div class="card-header-title m-auto">
                            <i class="header-icon lnr-rocket icon-gradient bg-tempting-azure"> </i>
                            Faturamento Fiscal
                        </div>
                    </div>
                    <div class="card-body animate-bottom" id="loader1">
                    </div>
                    <div class="card-body">
                        <canvas id="chart-doughnut-1"></canvas>
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

            <div class="col-md-12 col-lg-6">
                <div class="mb-3 card">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title m-auto">
                            <i class="header-icon lnr-rocket icon-gradient bg-tempting-azure"> </i>
                            Faturamento Gerencial
                        </div>
                    </div>
                    <div class="card-body animate-bottom" id="loader2">
                    </div>
                    <div class="card-body">
                        <canvas id="chart-doughnut-2"></canvas>
                    </div>
                    <ul id="rank-3"
                        class="rm-list-borders rm-list-borders-scroll list-group list-group-flush"></ul>
                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                    </div>
                    <div class="ps__rail-y" style="top: 0px; height: 200px; right: 0px;">
                        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 173px;"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-lg-12">
                <div class="mb-3 card">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title m-auto">
                            <i class="header-icon lnr-rocket icon-gradient bg-tempting-azure"> </i>
                            Faturamento Gerencial Por Cliente
                        </div>
                    </div>
                    <div class="card-body animate-bottom" id="loader3">
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="tab-eg-55">
                            <div class="widget-chart p-3">
                                <div>
                                    <canvas id="chart-bar"></canvas>
                                </div>
                                <h6 class="card-title" style="margin: 20px;">Ranking Clientes</h6>
                                <ul id="rank-1"
                                    class="rm-list-borders rm-list-borders-scroll list-group list-group-flush"></ul>
                                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                </div>
                                <div class="ps__rail-y" style="top: 0px; height: 200px; right: 0px;">
                                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 173px;"></div>
                                </div>
                                <!-- <div class="widget-chart-content text-center mt-5">
                                    <div class="widget-description mt-0 text-warning">
                                        <i class="fa fa-arrow-left"></i>
                                        <span class="pl-1">175.5%</span>
                                        <span class="text-muted opacity-8 pl-1">Nos últimos meses</span>
                                    </div>
                                </div> -->
                            </div>
                        </div>
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
    function getFatFiscal(){
        if(chart1 !== undefined){chart1.destroy()
        document.getElementById("loader1").style.display = "block";}
            let data = json_encode($dados);
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


@endsection
