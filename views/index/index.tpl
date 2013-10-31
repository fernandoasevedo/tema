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

<style>
    #sortable { list-style-type: none; margin: 0; padding: 0; width: 100%; }
    #sortable li { margin: 0 3px 3px 3px;  }
    #sortable li span { position: absolute; margin-left: -1.3em; }
</style>

<style>
    #searchDeputado {
        display: block;
        font-weight: bold;
        margin-bottom: 1em;
    }

</style>
<script>

    $(function() {

        var availableTags = [
            {foreach from=$deputados item=d}
               {literal} { {/literal}
                  nome: "{$d.nomeCompleto}",
                  label: "{$d.nomeCompleto|lower} {$d.nome|lower}",
                  nomeParlamentar: "{$d.nome}",
                  foto: "{$d.urlFoto}",
                  id: "{$d.ideCadastro}"
               {literal} } {/literal},
            {/foreach}
        ];

        $( "#searchDeputado" ).autocomplete({
            minLength: 0,
            source: availableTags,
            focus: function( event, ui ) {
                $( "#searchDeputado" ).val( ui.item.label );
                return false;
            },
            select: function( event, ui ) {
                $( "#searchDeputado" ).val( ui.item.nomeParlamentar );
                $( "#searchDeputado-id" ).val( ui.item.id );
                $( "#searchDeputado-nome" ).html( "<p>" + ui.item.nome + "</p><a href='{$_layoutParams.root}deputado/ide/"+ui.item.id+"/__' class='btn btn-primary btn-small block'>Ver Deputado</a>" );

                $( "#searchDeputado-icon" ).attr( "src", ui.item.foto );

                return false;
            }
        })
                .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
            return $( "<li>" )
                    .append( "<a>" + item.nomeParlamentar + "<br>" + item.nome + "</a>" )
                    .appendTo( ul );
        };

    });

</script>

<div class="row">
    <div class="col-lg-4">
        <div class="panel panel-default" id="headings">
            <div class="panel-heading">Lista de Deputados
            </div>
            <p class="lead">
            <div class="form-group">

                <input type="text" class="form-control" id="searchDeputado" placeholder="Buscar Deputado...">

            </div>
            <div class="row">
                <div class="col-lg-4" >
                    <img id="searchDeputado-icon" src="" class="img-rounded"  alt="" />
                </div>
                <div class="col-lg-8" >
                    <p id="searchDeputado-nome"></p>

                    <input type="hidden" id="searchDeputado-id" />
                </div>
            </div>
            </p>
            <p>
            <div id="myCarousel" class="carousel slide">
                <ol class="carousel-indicators">
                    {foreach from=$deputadosRandom key=id item=dr}
                        {if $id==0}
                            <li data-target="#myCarousel" data-slide-to="{$id}" class="active"></li>
                        {else}
                            <li data-target="#myCarousel" data-slide-to="{$id}"></li>
                        {/if}

                    {/foreach}
                </ol>
                <!-- Carousel items -->
                <div class="carousel-inner">
                    {foreach from=$deputadosRandom key=id item=dr}
                        {if $id==0}
                            <div class="active item">
                                <div class="row">
                                    <div class="col-lg-4" >
                                        <img src="{$dr.urlFoto}" class="img-rounded" >
                                    </div>
                                    <div class="col-lg-8" >
                                        <p id="searchDeputado-nome">{$dr.nome}</p>
                                        <a href='{$_layoutParams.root}deputado/ide/{$dr.ideCadastro}/__' class='btn btn-primary btn-small block'>Ver Deputado</a>
                                    </div>
                                </div>
                            </div>
                        {else}
                            <div class="item">
                                <div class="row">
                                    <div class="col-lg-4" >
                                        <img src="{$dr.urlFoto}" class="img-rounded" >
                                    </div>
                                    <div class="col-lg-8" >
                                        <p id="searchDeputado-nome">{$dr.nome}</p>
                                        <a href='{$_layoutParams.root}deputado/ide/{$dr.ideCadastro}/__' class='btn btn-primary btn-small block'>Ver Deputado</a>
                                    </div>
                                </div>
                            </div>
                        {/if}

                    {/foreach}
                </div>
                <!-- Carousel nav -->
                <a class="carousel-control left" href="#myCarousel" data-slide="prev"> < </a>
                <a class="carousel-control right" href="#myCarousel" data-slide="next"> > </a>
            </div>
            </p>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="panel panel-default" id="content-formatting">
            <div class="panel-heading">Faça uma busca
            </div>
            <p class="lead">
            <div class="form-group">

                <form action='' method='POST'>
                    <input type='hidden' name='send' value='1' />
                    <input type="text" name='search' class="form-control" id="search" placeholder="Busque por assuntos...">
                </form>

            </div>
            </p>

            {if isset($topicos) }
<p class="lead">
                <ul id="sortable">
                    {foreach from=$topicos item=topico}
                    <li>
                            <p>
                                <a href='{$_layoutParams.root}topico/id/{$topico.id}'>
                                {$topico.top_10_terms}
                                </a>
                            <br />                           

                            </p>

                    </li>
                    {/foreach}
                </ul>
            </p>
            {/if}

            <p></p>
        </div>
    </div>
</div>
<!--
<div class="row">

    <div class="span4">
        <div class="card">
            <h3 class="card-heading simple">Lista de Deputados</h3>
            <div class="card-body">
            </div>
         </div>
    </div>

    <div class="span8">

        <div class="span8">
            <div class="card">
                <h3 class="card-heading simple">Busque por assunto</h3>
                <div class="card-body">
                    <p>
                    <div class="input-append">
                        <input class="span7" id="appendedInputButton" type="text">
                        <button class="btn" type="button">Buscar</button>
                    </div>
                    </p>
                </div>
            </div>
        </div>

        <div class="span8">
            <div class="card">
                <h3 class="card-heading simple">Assuntos, tópicos temas...</h3>
                <div class="card-body">
                </div>
            </div>
        </div>


    </div>
</div>-->
