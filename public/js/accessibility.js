
/* - accessibility.js - */
// http://www2.camara.gov.br/portal_javascripts/accessibility.js?original=1
function setBaseFontSize(fontsize, reset){
    var body=jq('body');
    if(reset){
        body.removeClass('smallText').removeClass('largeText');
        createCookie("fontsize",fontsize,365)
    }
}

