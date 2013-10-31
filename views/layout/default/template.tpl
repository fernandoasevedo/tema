<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-BR" lang="pt-BR" dir="ltr">
        <head>
            <title>{$titulo|default:"Hackathon"}</title>
            <meta http-equiv="Content-Type"  content="text/html; charset=UTF-8" />
            <meta http-equiv="Content-Type" content="text/css; charset=UTF-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="">
            <meta property="fb:app_id" content="166900893498178" />
            <meta name="author" content="devupsolucoes">

            <link rel="shortcut icon" href="{$_layoutParams.root}public/images/favicon.ico" />

            <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
            <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0-rc1/js/bootstrap.min.js"></script>
            <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

            <script src="{$_layoutParams.root}public/js/jquery.cookie.js"></script>



            <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>
            <link id="css_color" rel="stylesheet" type="text/css"  href="{$_layoutParams.root}public/css/bootstrap.css" title="default">

            <link href="{$_layoutParams.root}public/css/bootplus-responsive.css" rel="stylesheet">

            <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
            <!--[if lt IE 9]>
            <script src="{$_layoutParams.root}public/js/html5shiv.js"></script>
            <![endif]-->

            <!-- Fav and touch icons
            <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
            <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
            <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
            <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">

            <link href="{$_layoutParams.root_css}bootstrap.css" rel="stylesheet">
            <link href="{$_layoutParams.root_css}bootstrap-responsive.css" rel="stylesheet">
            <link href="{$_layoutParams.root_css}styles.css" rel="stylesheet">
            -->
            <!-- Css específicos de cada pagina, se houver... -->
            {if isset($_layoutParams.css) && count($_layoutParams.css)}
                {foreach item=css from=$_layoutParams.css}

                <link href="{$css}" type="text/css" rel="stylesheet">

                {/foreach}
            {/if}


            <script type="text/javascript">
                {literal}
                $(document).ready(function() {

                    // aumentando a fonte
                    $("#aumentar").click(function () {
                        var size = $("body").css('font-size');

                        size = size.replace('px', '');
                        size = parseInt(size) + 1.4;

                        $("body").animate({'font-size' : size + 'px'});
                    });

                    //diminuindo a fonte
                    $("#diminui").click(function () {
                        var size = $("body").css('font-size');

                        size = size.replace('px', '');
                        size = parseInt(size) - 1.4;

                        $("body").animate({'font-size' : size + 'px'});
                    });

                    // resetando a fonte
                    $("#normal").click(function () {
                        $("body").animate({'font-size' : '14px'});
                    });
                    {/literal}


                    contraste = 0;
                    if($.cookie("css") == "{$_layoutParams.root}public/css/bootstrap.contraste.css") {

                        $("#css_color").attr("href",$.cookie("css"));
                        contraste = 1;
                    }



                    $("#contraste").click(function(){

                        if (contraste == 0) {
                            $("#css_color").attr("href", "{$_layoutParams.root}public/css/bootstrap.contraste.css" );
                            //setar um cookie
                            $.cookie("css","{$_layoutParams.root}public/css/bootstrap.contraste.css", {literal}{expires: 365, path: '/'}{/literal});
                            contraste = 1;
                        } else {
                            $("#css_color").attr("href", "{$_layoutParams.root}public/css/bootstrap.css" );
                            contraste = 0;
                            //apagando o cookie
                            $.cookie("css", "{$_layoutParams.root}public/css/bootstrap.css", {literal}{expires: 365, path: '/'}{/literal});
                        }

                        return false;
                    });

                });


            </script>
    </head>

    <body>
    {literal}
    <!-- Analytics-->
    {/literal}

    <div class="navbar navbar-static-top">
        <div class="container">
            <a href="#" id="normal" class="navbar-brand btn" alt="Retorne o texto ao tamanho normal">A</a>
            <a href="#" id="aumentar" class="navbar-brand btn" alt="Aumente o tamanho do texto">A+</a>
            <a href="#" id="contraste" class="navbar-brand btn">C</a>
            <ul class="nav navbar-nav">

                <li class="dropdown">
                    {if isset($_layoutParams.menu)}
                    {foreach item=it from=$_layoutParams.menu}
                    {if isset($_layoutParams.item) && $_layoutParams.item == $it.id}
                        {assign var="_item_style" value='active'}
                    {else}
                        {assign var="_item_style" value=''}
                    {/if}
                <li>
                    <a class="{$_item_style}" href="{$it.base}">{$it.titulo}</a>
                </li>

                {/foreach}
                {/if}



                </li>

            </ul>
            <p class="navbar-text pull-right"></p>
        </div>
    </div>


    <div class="container">
    <img src="{$_layoutParams.root}public/images/topo.png" alt="" style="margin-bottom: 20px;">
    </div>

    <div class="container">

                    <!--{if Session::get('autenticacao')}<div id="usuarioconn"><img class="img" src="{$_layoutParams.root}views/layout/default/images/user.png"> Usuário: {$smarty.session.usuario}</div>{/if}-->
                    <noscript><p>Para o funcionamento correto desta aplicação o JavaScript deve estar habilitado.</p></noscript>

                    {include file=$_content}



    </div> <!-- /container -->

    <!-- JavaScript específicos de cada página, se houver... -->
        {if isset($_layoutParams.js) && count($_layoutParams.js)}
            {foreach item=js from=$_layoutParams.js}
                <script src="{$js}" type="text/javascript"></script>
            {/foreach}
        {/if}


    <!-- JavaScript -->




    </body>
    </html>
