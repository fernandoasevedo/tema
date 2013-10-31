<!--
 * Copyright 2013 de Catalão/Thiago Faleiros, Cleriston Dantas, Fernando Nóbrega
 * Este arquivo é parte do programa TEMA. 
 * O TEMA é um software livre; você pode redistribuí-lo e/ou modificá-lo dentro dos termos da
 * GNU General Public License como publicada pela Fundação do Software Livre (FSF); 
 * na versão 3 da Licença. Este programa é distribuído na esperança que possa
 * ser útil, mas SEM NENHUMA GARANTIA; sem uma garantia implícita de ADEQUAÇÃO a qualquer MERCADO ou
 * APLICAÇÃO EM PARTICULAR. Veja a licença para maiores detalhes. 
 * Você deve ter recebido uma cópia da
 * GNU General Public License, sob o título "LICENCA.txt",
 * junto com este programa, se não, acesse http://www.gnu.org/licenses
-->


<script>
	function btnAbrir(arquivo) {

		var local = "{$_layoutParams.root}/discursos/"+arquivo;

		var conteudo="<iframe src='"+local+"' frameborder='0' scrolling='yes' width='528px' ></iframe>";


		$('#mostraNomeArquivo').html('');
		$('#mostraNomeArquivo').append('Visualizando discurso');

		$('#mostraArquivo').html('');
		$('#mostraArquivo').append(conteudo);

		$('#myModal').modal('show');
	};


</script>

<style>
	.modal-body{
		overflow: scroll;
	}
</style>


<script src="{$_layoutParams.root}public/js/highcharts.js"></script>
<script src="{$_layoutParams.root}public/js/modules/exporting.js"></script>


<script type="text/javascript">
    $(function () {
        $('#container').highcharts( {

            chart: {
                type: 'line',
                animation: true
            },

            title: {
                text: '{$graficotitulo}',
                x: -20 //center
            },
            subtitle: {
                text: '',
                x: -20
            },

            xAxis: {
                categories: {$meses}
            },

            yAxis: {
                title: {
                    text: 'N de discursos com este assunto'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },


            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },

            series: [
                {
                    name: "Frequência",
                    color: '#50B432',
                    data: {$topicos}
                }
            ]
        });
    });


</script>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default" id="headings">
                <div class="panel-heading">Frequências de discuros deste assunto
                </div>
                <p class="lead">

                <div id="container" style="min-width: 600px; height: 400px; margin: 0 auto"></div>

                </p>
            </div>
        </div>
    </div>




    <div class="row">
        <div class="col-lg-5">
            <div class="panel panel-default" id="headings">
                <div class="panel-heading">Deputados relacionados
                </div>
                <p class="lead">

                {foreach item="deputado" from=$deputados }
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="{$deputado.urlFoto}" >
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{$deputado.nome}</h4>
                        <h5 class="media-heading">{$deputado.partido} / {$deputado.uf} / {$deputado.condicao}</h5>
                        Discursos nesse assunto: {$deputado.freq}

                        <!-- Nested media object -->
                        <div class="media">
                            <a href='{$_layoutParams.root}deputado/ide/{$deputado.ideCadastro}/__' class='btn btn-primary btn-small block'>Ver Deputado</a>
                        </div>
                    </div>
                </div>
                {/foreach}

                </p>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="panel panel-default" id="content-formatting">
                <div class="panel-heading">Lista de discursos relacionados</div>
                <p class="lead">
                {foreach from=$discursos item=discurso}
                    <div class="media">
                        <a class="pull-left" href="#"></a>
                        <div class="media-body">
                        <h4 class="media-heading"></h4>
                        <a href='#' onClick="btnAbrir('{$discurso.discurso_file}')"
                            style='float:right;' 
                            class='btn btn-primary btn-small block'>Ver discurso Completo</a>
                        <b>Sessão:</b> {$discurso.sessao}<br />
                        <b>Fase:</b>{$discurso.fase}<br />
                        <b>Data/hora:</b>{$discurso.data} /{$discurso.hora}<br />
                        {$discurso.sumario}
                        <hr />
                        </div>
                    </div>
                {/foreach}
                </p>
<!-- Modal -->
<div id="myModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="mostraNomeArquivo"></h3>
    </div>
    <div class="modal-body">
        <p id='mostraArquivo'></p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Fechar Janela</button>
    </div>
</div>

                <p></p>
                <div class="panel-heading">Notícias do assunto escolhido
                </div>
                <p class="lead">

                <ul>
                    {foreach from=$noticias->d->results item=noticia}
                        <div class="media">
                            <a class="pull-left" href="#">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><a href='http://{$noticia->DisplayUrl}'>{$noticia->Title|@print_r}</a></h4>

                            </div>
                        </div>


                    {/foreach}


                </p>
                <p></p>
            </div>
        </div>
    </div>

