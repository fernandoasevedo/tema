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

{foreach from=$deputado item=d}
<script type="text/javascript" src="{$_layoutParams.root}public/js/jqcloud-1.0.4.min.js"></script>
<link href='{$_layoutParams.root}public/css/jqcloud.css' rel='stylesheet' type='text/css'>

<style>
    #sortable { list-style-type: none; margin: 0; padding: 0; width: 100%; }
    #sortable li { margin: 0 3px 3px 3px;  }
    #sortable li span { position: absolute; margin-left: -1.3em; }
</style>


<script>
    var word_list = [
    {foreach from=$cloud key=word item=freq}
        {literal}{text:{/literal}'{$word}',weight:{$freq}{literal}}{/literal},
    {/foreach}
    ];
    $(document).ready(function() {
    $("#topicocloud").jQCloud(word_list);
    });
</script>


<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default" id="headings">
            <div class="panel-heading">Deputado {$d.nome}
            </div>
            <p class="lead">
            <div class="row">
                <div class="col-lg-2" >
                    <img src="{$d.urlFoto}" class="img-rounded" >
                </div>
                <div class="col-lg-4" >
                    <p id="searchDeputado-nome">
                        <b>Nome civil:</b> {$d.nomeCompleto}
                        <br><b>Partido:</b> {$d.partido} / {$d.uf} / {$d.condicao}
                        <br><b>Gabiente:</b> {$d.gabinete}, anexo {$d.anexo}
                        <br><b>Fone:</b> {$d.fone}
                        <br><b>E-mail:</b> {$d.email}
                        <br><a target="_blank" href="http://www2.camara.gov.br/deputados/pesquisa/layouts_deputados_biografia?pk={$d.ideCadastro}">Biografia (página externa)</a>
                    </p>
                    <p>
                        <!-- AddThis Button BEGIN -->
                    <div class="addthis_toolbox addthis_default_style addthis_32x32_style"
                         addthis:url="{$_layoutParams.root}deputado/ide/{$d.ideCadastro}/"
                         addthis:title="Deputado {$d.nome}"
                         addthis:description="Assuntos, discursos, notícias relacionadas ao Deputado {$d.nomeParlamentar}">
                        <a class="addthis_button_preferred_1"></a>
                        <a class="addthis_button_preferred_2"></a>
                        <a class="addthis_button_preferred_3"></a>
                        <a class="addthis_button_preferred_4"></a>
                        <a class="addthis_button_compact"></a>
                        <a class="addthis_counter addthis_bubble_style"></a>
                    </div>
                    <script type="text/javascript">var addthis_config = {literal} {"data_track_addressbar":true} {/literal};</script>
                    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-521393175cee2716"></script>
                    <!-- AddThis Button END -->

                    </p>
                </div>
                <div class="col-lg-6">
                    <div id="topicocloud" style="width: 552px; height: 180px; position: relative;"></div>
                </div>

            </div>
            </p>
            <p>
            </p>
        </div>
    </div>
</div>
{/foreach}


<div class="row">
    <div class="col-lg-4">
        <div class="panel panel-default" id="headings">
            <div class="panel-heading">Lista de Assuntos
            </div>
            <p class="lead">
                <ul id="sortable">
                    {foreach from=$topicos item=topico}
                    <li>
                            <p>
                                <h5>{$topico.top_10_terms}</h5>
                            <br />

                            <a  style='float:right;display:block;padding:4px;'
                                href='{$_layoutParams.root}deputado/ide/{$d.ideCadastro}/{$topico.id}'>
                                Ver discursos
                            </a>  
                            <a  style='float:right;display:block;padding:4px'
                                href='{$_layoutParams.root}topico/id/{$topico.id}' >
                                Analisar assunto
                            </a>

                            </p><br />
                            <hr />
                    </li>
                    {/foreach}
                </ul>
            </p>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="panel panel-default" id="content-formatting">
            <div class="panel-heading">Lista de Discursos 
                {if isset($topicoSelecionado)}
                    do Assunto: <b>{$topicoSelecionado}</b>
					<br />
					<a href='{$_layoutParams.root}deputado/ide/{$d.ideCadastro}/__'>
						Remover filtro
					</a>
                {/if}

            </div>
            <p class="lead">
            </p>
            <p>
                {if isset($discursos)}
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
                {/if}               

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
        </div>
    </div>
</div>
