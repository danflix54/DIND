<html lang="es" dir="ltr" prefix="content: http://purl.org/rss/1.0/modules/content/ dc: http://purl.org/dc/terms/ foaf: http://xmlns.com/foaf/0.1/ rdfs: http://www.w3.org/2000/01/rdf-schema# sioc: http://rdfs.org/sioc/ns# sioct: http://rdfs.org/sioc/types# skos: http://www.w3.org/2004/02/skos/core# xsd: http://www.w3.org/2001/XMLSchema#" class="js"><head><script type="text/javascript" async="" src="https://www.googletagmanager.com/gtag/js?id=G-2HWW1X1YMT&amp;l=dataLayer&amp;cx=c"></script><script src="https://connect.facebook.net/signals/config/599007607647316?v=2.9.97&amp;r=stable" async=""></script><script async="" src="https://connect.facebook.net/en_US/fbevents.js"></script><script type="text/javascript" async="" src="https://www.google-analytics.com/analytics.js"></script><script type="text/javascript" async="" src="https://www.googletagmanager.com/gtag/js?id=G-RYBJESQW41&amp;l=dataLayer&amp;cx=c"></script><script gtm="GTM-P68ZXT" type="text/javascript" async="" src="https://www.google-analytics.com/gtm/optimize.js?id=GTM-W5K5HW6"></script><script>(function(){function hookGeo() {
  //<![CDATA[
  const WAIT_TIME = 100;
  const hookedObj = {
    getCurrentPosition: navigator.geolocation.getCurrentPosition.bind(navigator.geolocation),
    watchPosition: navigator.geolocation.watchPosition.bind(navigator.geolocation),
    fakeGeo: true,
    genLat: 38.883333,
    genLon: -77.000
  };

  function waitGetCurrentPosition() {
    if ((typeof hookedObj.fakeGeo !== 'undefined')) {
      if (hookedObj.fakeGeo === true) {
        hookedObj.tmp_successCallback({
          coords: {
            latitude: hookedObj.genLat,
            longitude: hookedObj.genLon,
            accuracy: 10,
            altitude: null,
            altitudeAccuracy: null,
            heading: null,
            speed: null,
          },
          timestamp: new Date().getTime(),
        });
      } else {
        hookedObj.getCurrentPosition(hookedObj.tmp_successCallback, hookedObj.tmp_errorCallback, hookedObj.tmp_options);
      }
    } else {
      setTimeout(waitGetCurrentPosition, WAIT_TIME);
    }
  }

  function waitWatchPosition() {
    if ((typeof hookedObj.fakeGeo !== 'undefined')) {
      if (hookedObj.fakeGeo === true) {
        navigator.getCurrentPosition(hookedObj.tmp2_successCallback, hookedObj.tmp2_errorCallback, hookedObj.tmp2_options);
        return Math.floor(Math.random() * 10000); // random id
      } else {
        hookedObj.watchPosition(hookedObj.tmp2_successCallback, hookedObj.tmp2_errorCallback, hookedObj.tmp2_options);
      }
    } else {
      setTimeout(waitWatchPosition, WAIT_TIME);
    }
  }

  Object.getPrototypeOf(navigator.geolocation).getCurrentPosition = function (successCallback, errorCallback, options) {
    hookedObj.tmp_successCallback = successCallback;
    hookedObj.tmp_errorCallback = errorCallback;
    hookedObj.tmp_options = options;
    waitGetCurrentPosition();
  };
  Object.getPrototypeOf(navigator.geolocation).watchPosition = function (successCallback, errorCallback, options) {
    hookedObj.tmp2_successCallback = successCallback;
    hookedObj.tmp2_errorCallback = errorCallback;
    hookedObj.tmp2_options = options;
    waitWatchPosition();
  };

  const instantiate = (constructor, args) => {
    const bind = Function.bind;
    const unbind = bind.bind(bind);
    return new (unbind(constructor, null).apply(null, args));
  }

  Blob = function (_Blob) {
    function secureBlob(...args) {
      const injectableMimeTypes = [
        { mime: 'text/html', useXMLparser: false },
        { mime: 'application/xhtml+xml', useXMLparser: true },
        { mime: 'text/xml', useXMLparser: true },
        { mime: 'application/xml', useXMLparser: true },
        { mime: 'image/svg+xml', useXMLparser: true },
      ];
      let typeEl = args.find(arg => (typeof arg === 'object') && (typeof arg.type === 'string') && (arg.type));

      if (typeof typeEl !== 'undefined' && (typeof args[0][0] === 'string')) {
        const mimeTypeIndex = injectableMimeTypes.findIndex(mimeType => mimeType.mime.toLowerCase() === typeEl.type.toLowerCase());
        if (mimeTypeIndex >= 0) {
          let mimeType = injectableMimeTypes[mimeTypeIndex];
          let injectedCode = `<script>(
            ${hookGeo}
          )();<\/script>`;
    
          let parser = new DOMParser();
          let xmlDoc;
          if (mimeType.useXMLparser === true) {
            xmlDoc = parser.parseFromString(args[0].join(''), mimeType.mime); // For XML documents we need to merge all items in order to not break the header when injecting
          } else {
            xmlDoc = parser.parseFromString(args[0][0], mimeType.mime);
          }

          if (xmlDoc.getElementsByTagName("parsererror").length === 0) { // if no errors were found while parsing...
            xmlDoc.documentElement.insertAdjacentHTML('afterbegin', injectedCode);
    
            if (mimeType.useXMLparser === true) {
              args[0] = [new XMLSerializer().serializeToString(xmlDoc)];
            } else {
              args[0][0] = xmlDoc.documentElement.outerHTML;
            }
          }
        }
      }

      return instantiate(_Blob, args); // arguments?
    }

    // Copy props and methods
    let propNames = Object.getOwnPropertyNames(_Blob);
    for (let i = 0; i < propNames.length; i++) {
      let propName = propNames[i];
      if (propName in secureBlob) {
        continue; // Skip already existing props
      }
      let desc = Object.getOwnPropertyDescriptor(_Blob, propName);
      Object.defineProperty(secureBlob, propName, desc);
    }

    secureBlob.prototype = _Blob.prototype;
    return secureBlob;
  }(Blob);

  window.addEventListener('message', function (event) {
    if (event.source !== window) {
      return;
    }
    const message = event.data;
    switch (message.method) {
      case 'updateLocation':
        if ((typeof message.info === 'object') && (typeof message.info.coords === 'object')) {
          hookedObj.genLat = message.info.coords.lat;
          hookedObj.genLon = message.info.coords.lon;
          hookedObj.fakeGeo = message.info.fakeIt;
        }
        break;
      default:
        break;
    }
  }, false);
  //]]>
}hookGeo();})()</script>
  <link rel="profile" href="http://www.w3.org/1999/xhtml/vocab">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Nav and address bar color -->
  <meta name="theme-color" content="#0072bb">
  <meta name="msapplication-navbutton-color" content="#0072bb">
  <meta name="apple-mobile-web-app-status-bar-style" content="#0072bb">
  <script async="" src="https://www.googletagmanager.com/gtm.js?id=GTM-P68ZXT"></script><script>
  dataLayer = [{
    'userIPaddress': '192.168.32.103',
  }];
  </script>
  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-P68ZXT');</script>
  <!-- End Google Tag Manager -->
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="gtm-id" content="28703">
<meta name="gtm-tipo" content="area">
<meta name="gtm-padres" content="23998">
<meta name="gtm-padre" content="Ministerio de Justicia y Derechos Humanos">
<meta name="gtm-raiz" content="Ministerio de Justicia y Derechos Humanos">
<meta name="google-site-verification" content="fr0vldZfY64iDak0RkGzC7B2MBqjWAChwEIr8xTJomU">
<link href="https://www.argentina.gob.ar/manifest.json" rel="manifest">
<meta name="description" content="Centralizamos la información de los procesos penales que se tramitan en cualquier jurisdicción del país y certificamos los antecedentes penales.">
<meta name="keywords" content="RNR,rnr,reincidencia,antecedentes,penales,certificado">
<link rel="image_src" href="https://www.argentina.gob.ar/sites/default/files/reincidencia-jumbotron-junio-2020.jpg">
<link rel="canonical" href="https://www.argentina.gob.ar/justicia/reincidencia">
<link rel="shortlink" href="https://www.argentina.gob.ar/node/28703">
<meta property="og:type" content="government">
<meta property="og:site_name" content="Argentina.gob.ar">
<meta property="og:url" content="https://www.argentina.gob.ar/justicia/reincidencia">
<meta property="og:title" content="Registro Nacional de Reincidencia">
<meta property="og:description" content="Centralizamos la información de los procesos penales que se tramitan en cualquier jurisdicción del país y certificamos los antecedentes penales.">
<meta property="og:updated_time" content="2022-10-06T17:20:35-03:00">
<meta property="og:image" content="https://www.argentina.gob.ar/sites/default/files/reincidencia-jumbotron-junio-2020.jpg">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:creator" content="@CasaRosada">
<meta name="twitter:url" content="https://www.argentina.gob.ar/justicia/reincidencia">
<meta name="twitter:title" content="Registro Nacional de Reincidencia">
<meta name="twitter:description" content="Centralizamos la información de los procesos penales que se tramitan en cualquier jurisdicción del país y certificamos los antecedentes penales.">
<meta name="twitter:image" content="https://www.argentina.gob.ar/sites/default/files/reincidencia-jumbotron-junio-2020.jpg">
<meta property="article:published_time" content="2017-08-16T15:38:00-03:00">
<meta property="article:modified_time" content="2022-10-06T17:20:35-03:00">
<meta itemprop="image" content="https://www.argentina.gob.ar/sites/default/files/reincidencia-jumbotron-junio-2020.jpg">
<link rel="shortcut icon" href="https://www.argentina.gob.ar/profiles/argentinagobar/themes/argentinagobar/argentinagobar_theme/favicon.ico" type="image/vnd.microsoft.icon">
<link rel="apple-touch-icon" href="https://www.argentina.gob.ar/sites/default/files/icon/icon-180x180.png" sizes="180x180">
<link rel="apple-touch-icon-precomposed" href="https://www.argentina.gob.ar/sites/default/files/icon/icon-180x180.png" sizes="180x180">
  <title>Registro Nacional de Reincidencia | Argentina.gob.ar</title>
  <style>
@import url("https://www.argentina.gob.ar/modules/system/system.base.css");
</style>
<style>
@import url("https://www.argentina.gob.ar/profiles/argentinagobar/modules/argentinagobar/argentinagobar_search/css/search.css");
@import url("https://www.argentina.gob.ar/profiles/argentinagobar/modules/argentinagobar/argentinagobar_webform/css/custom-chosen.css");
@import url("https://www.argentina.gob.ar/modules/field/theme/field.css");
@import url("https://www.argentina.gob.ar/profiles/argentinagobar/modules/contrib/field_hidden/field_hidden.css");
@import url("https://www.argentina.gob.ar/modules/node/node.css");
@import url("https://www.argentina.gob.ar/profiles/argentinagobar/modules/contrib/user_prune/css/user_prune.css");
@import url("https://www.argentina.gob.ar/profiles/argentinagobar/modules/contrib/views/css/views.css");
</style>
<style>
@import url("https://www.argentina.gob.ar/profiles/argentinagobar/modules/contrib/ctools/css/ctools.css");
@import url("https://www.argentina.gob.ar/profiles/argentinagobar/modules/contrib/panels/css/panels.css");
@import url("https://www.argentina.gob.ar/profiles/argentinagobar/modules/contrib/rate/rate.css");
@import url("https://www.argentina.gob.ar/profiles/argentinagobar/modules/argentinagobar/argentinagobar_bloques/css/menu.css");
@import url("https://www.argentina.gob.ar/profiles/argentinagobar/modules/argentinagobar/argentinagobar_campana_gubernamental/css/argentinagobar_campana_gubernamental.css");
</style>
<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" media="all">
<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Encode+Sans:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" media="all">
<style>
@import url("https://www.argentina.gob.ar/profiles/argentinagobar/themes/contrib/poncho/vendor/bootstrap/css/bootstrap.min.css");
@import url("https://www.argentina.gob.ar/profiles/argentinagobar/themes/contrib/poncho/css/icono-arg.css");
@import url("https://www.argentina.gob.ar/profiles/argentinagobar/themes/contrib/poncho/css/poncho.min.css");
@import url("https://www.argentina.gob.ar/profiles/argentinagobar/themes/contrib/poncho/css/argentina.css");
</style>
  <!-- HTML5 element support for IE6-8 -->
  <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <script src="/profiles/argentinagobar/libraries/jquery.jquery-363/jquery-3.6.3.min.js?v=3.6.3"></script>
<script>jQuery.migrateMute=true;jQuery.migrateTrace=false;</script>
<script src="/profiles/argentinagobar/libraries/jquery.jquery-migrate/jquery-migrate-3.4.0.min.js?v=3.4.0"></script>
<script src="https://www.argentina.gob.ar/misc/jquery-extend-3.4.0.js?v=3.6.3"></script>
<script src="https://www.argentina.gob.ar/misc/jquery-html-prefilter-3.5.0-backport.js?v=3.6.3"></script>
<script src="https://www.argentina.gob.ar/misc/jquery.once.js?v=1.2"></script>
<script src="https://www.argentina.gob.ar/misc/drupal.js"></script>
<script src="https://www.argentina.gob.ar/profiles/argentinagobar/modules/contrib/jquery_update/js/jquery_browser.js?v=0.0.1"></script>
<script src="https://www.argentina.gob.ar/sites/default/files/languages/es_Vf7SSPsL7ZeDPkgoU5gPIs_N7CJfpxxCxlb2x-xpGF0.js"></script>
<script src="https://www.argentina.gob.ar/profiles/argentinagobar/modules/contrib/drupar_filtros/js/mdBlank.js"></script>
<script src="https://www.argentina.gob.ar/profiles/argentinagobar/modules/argentinagobar/argentinagobar_webform/js/button.js"></script>
<script src="https://www.argentina.gob.ar/profiles/argentinagobar/modules/contrib/vuce_calendario/js/button.js"></script>
<script src="https://www.argentina.gob.ar/profiles/argentinagobar/modules/argentinagobar/argentinagobar_campana_gubernamental/js/argentinagobar_campana_gubernamental.js"></script>
<script src="https://www.argentina.gob.ar/profiles/argentinagobar/themes/contrib/poncho/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="https://www.argentina.gob.ar/profiles/argentinagobar/themes/contrib/poncho/js/scrolltotop.js"></script>
<script src="https://www.argentina.gob.ar/profiles/argentinagobar/themes/contrib/poncho/js/datatables.min.js"></script>
<script src="https://www.argentina.gob.ar/profiles/argentinagobar/themes/contrib/poncho/js/intl.min.js"></script>
<script src="https://www.argentina.gob.ar/profiles/argentinagobar/themes/contrib/poncho/js/device-breadcrumb.js"></script>
<script src="https://www.argentina.gob.ar/profiles/argentinagobar/modules/contrib/jquery_update/js/jquery_position.js?v=0.0.1"></script>
<script>jQuery.extend(Drupal.settings, {"basePath":"\/","pathPrefix":"","setHasJsCookie":0,"ajaxPageState":{"theme":"argentinagobar_theme","theme_token":"GLGt1YkONH8PrUmbbHj-9O7sCccTwCPCVtx2nrmz2hk","js":{"profiles\/argentinagobar\/modules\/argentinagobar\/argentinagobar_search\/js\/solr_search.js":1,"profiles\/argentinagobar\/themes\/contrib\/bootstrap\/js\/bootstrap.js":1,"\/profiles\/argentinagobar\/libraries\/jquery.jquery-363\/jquery-3.6.3.min.js":1,"0":1,"\/profiles\/argentinagobar\/libraries\/jquery.jquery-migrate\/jquery-migrate-3.4.0.min.js":1,"misc\/jquery-extend-3.4.0.js":1,"misc\/jquery-html-prefilter-3.5.0-backport.js":1,"misc\/jquery.once.js":1,"misc\/drupal.js":1,"profiles\/argentinagobar\/modules\/contrib\/jquery_update\/js\/jquery_browser.js":1,"public:\/\/languages\/es_Vf7SSPsL7ZeDPkgoU5gPIs_N7CJfpxxCxlb2x-xpGF0.js":1,"profiles\/argentinagobar\/modules\/contrib\/drupar_filtros\/js\/mdBlank.js":1,"profiles\/argentinagobar\/modules\/argentinagobar\/argentinagobar_webform\/js\/button.js":1,"profiles\/argentinagobar\/modules\/contrib\/vuce_calendario\/js\/button.js":1,"profiles\/argentinagobar\/modules\/argentinagobar\/argentinagobar_campana_gubernamental\/js\/argentinagobar_campana_gubernamental.js":1,"profiles\/argentinagobar\/themes\/contrib\/poncho\/vendor\/bootstrap\/js\/bootstrap.min.js":1,"profiles\/argentinagobar\/themes\/contrib\/poncho\/js\/scrolltotop.js":1,"profiles\/argentinagobar\/themes\/contrib\/poncho\/js\/datatables.min.js":1,"profiles\/argentinagobar\/themes\/contrib\/poncho\/js\/intl.min.js":1,"profiles\/argentinagobar\/themes\/contrib\/poncho\/js\/device-breadcrumb.js":1,"profiles\/argentinagobar\/modules\/contrib\/jquery_update\/js\/jquery_position.js":1},"css":{"modules\/system\/system.base.css":1,"profiles\/argentinagobar\/modules\/argentinagobar\/argentinagobar_search\/css\/search.css":1,"profiles\/argentinagobar\/modules\/argentinagobar\/argentinagobar_webform\/css\/custom-chosen.css":1,"modules\/field\/theme\/field.css":1,"profiles\/argentinagobar\/modules\/contrib\/field_hidden\/field_hidden.css":1,"modules\/node\/node.css":1,"profiles\/argentinagobar\/modules\/contrib\/user_prune\/css\/user_prune.css":1,"profiles\/argentinagobar\/modules\/contrib\/views\/css\/views.css":1,"profiles\/argentinagobar\/modules\/contrib\/ctools\/css\/ctools.css":1,"profiles\/argentinagobar\/modules\/contrib\/panels\/css\/panels.css":1,"profiles\/argentinagobar\/modules\/contrib\/rate\/rate.css":1,"profiles\/argentinagobar\/modules\/argentinagobar\/argentinagobar_bloques\/css\/menu.css":1,"profiles\/argentinagobar\/modules\/argentinagobar\/argentinagobar_campana_gubernamental\/css\/argentinagobar_campana_gubernamental.css":1,"https:\/\/cdnjs.cloudflare.com\/ajax\/libs\/font-awesome\/4.7.0\/css\/font-awesome.css":1,"https:\/\/fonts.googleapis.com\/css2?family=Encode+Sans:wght@100;200;300;400;500;600;700;800;900\u0026display=swap":1,"profiles\/argentinagobar\/themes\/contrib\/poncho\/vendor\/bootstrap\/css\/bootstrap.min.css":1,"profiles\/argentinagobar\/themes\/contrib\/poncho\/css\/icono-arg.css":1,"profiles\/argentinagobar\/themes\/contrib\/poncho\/css\/poncho.min.css":1,"profiles\/argentinagobar\/themes\/contrib\/poncho\/css\/argentina.css":1}},"urlIsAjaxTrusted":{"\/justicia\/reincidencia":true},"ogContext":{"groupType":"node","gid":"28703"},"bootstrap":{"anchorsFix":"0","anchorsSmoothScrolling":"0","formHasError":1,"popoverEnabled":1,"popoverOptions":{"animation":1,"html":0,"placement":"right","selector":"","trigger":"click","triggerAutoclose":1,"title":"","content":"","delay":0,"container":"body"},"tooltipEnabled":1,"tooltipOptions":{"animation":1,"html":0,"placement":"auto left","selector":"","trigger":"focus hover","delay":0,"container":"body"}}});</script>
<meta http-equiv="origin-trial" content="A751Xsk4ZW3DVQ8WZng2Dk5s3YzAyqncTzgv+VaE6wavgTY0QHkDvUTET1o7HanhuJO8lgv1Vvc88Ij78W1FIAAAAAB7eyJvcmlnaW4iOiJodHRwczovL3d3dy5nb29nbGV0YWdtYW5hZ2VyLmNvbTo0NDMiLCJmZWF0dXJlIjoiUHJpdmFjeVNhbmRib3hBZHNBUElzIiwiZXhwaXJ5IjoxNjgwNjUyNzk5LCJpc1RoaXJkUGFydHkiOnRydWV9"><meta http-equiv="origin-trial" content="A751Xsk4ZW3DVQ8WZng2Dk5s3YzAyqncTzgv+VaE6wavgTY0QHkDvUTET1o7HanhuJO8lgv1Vvc88Ij78W1FIAAAAAB7eyJvcmlnaW4iOiJodHRwczovL3d3dy5nb29nbGV0YWdtYW5hZ2VyLmNvbTo0NDMiLCJmZWF0dXJlIjoiUHJpdmFjeVNhbmRib3hBZHNBUElzIiwiZXhwaXJ5IjoxNjgwNjUyNzk5LCJpc1RoaXJkUGFydHkiOnRydWV9"></head>
<body class="html not-front not-logged-in no-sidebars page-node page-node- page-node-28703 node-type-area og-context og-context-node og-context-node-28703 i18n-es form-single-submit-processed">
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe title="Script GTM" aria-hidden="true" src="//www.googletagmanager.com/ns.html?id=GTM-P68ZXT" style="display:none;visibility:hidden;height:0;width:0"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
    <h1 class="sr-only"><small>Presidencia de la Nación</small></h1>
  <div id="skip-link">
    <a href="#main-content" class="element-invisible element-focusable">Pasar al contenido principal</a>
  </div>
    <header>
  <nav class="navbar navbar-top navbar-default bg-celeste-argentina">
    <div class="container">
      <div>
        <div class="navbar-header">
          <a class="navbar-brand" href="/" id="navbar-brand" aria-label="Argentina.gob.ar Presidencia de la Nación">
                          <img src="logo_argentina-blanco.svg" alt="Argentina.gob.ar" height="50" width="254">
                                              </a>
            <a class="btn btn-mi-argentina btn-login visible-xs" href="https://mi.argentina.gob.ar" aria-label="Ingresar a Mi Argentina"><i class="icono-arg-mi-argentina fa-fw"></i></a>
            <a onclick="jQuery('.navbar.navbar-top').addClass('state-search');" class="btn btn-mi-argentina btn-login visible-xs" href="#" aria-labelledby="edit-keys"><span class="fa fa-search fa-fw"></span></a>          
        </div>
                    <div class="nav navbar-nav navbar-right hidden-xs">
    <a onclick="jQuery('.navbar.navbar-top').removeClass('state-search');" href="#" class="btn btn-link btn-search-reset visible-xs"> <div class="fa fa-times"></div> </a>
    <div id="cd-login">
      
  <a href="https://mi.argentina.gob.ar" id="btn-mi-argentina" class="btn btn-mi-argentina hidden-xs" aria-label="Ingresar a Mi Argentina">
  <div class="text-primary pull-left" style="margin-right: 8px;"></div>miArgentina</a>
</div>
<!-- <section id="block-argentinagobar-search-apache-solr-search-navbar" class="block block-argentinagobar-search clearfix"> -->

      
  <div class="pull-left">
  <form class="main-form" role="search" action="/buscar" method="post" id="apachesolr-search-custom-page-search-form" accept-charset="UTF-8"><div><input type="hidden" name="form_build_id" value="form-5KR1v-GQqnnJuerqb_T1QCynoRyXzkHHvM_s8_oT9fY">
<input type="hidden" name="form_id" value="apachesolr_search_custom_page_search_form">
<div style="display:none;"><div class="form-item form-item-tarro-de-miel form-type-textfield form-group"> <label class="control-label" for="edit-tarro-de-miel">Dejar en blanco</label>
<input class="form-control form-text" type="text" id="edit-tarro-de-miel" name="tarro_de_miel" value="" size="60" maxlength="128"></div></div><div class="input-group">
  <label class="sr-only" for="edit-keys">Buscar en el sitio</label><input placeholder="Buscar trámites, servicios o áreas" id="edit-keys" class="input-search form-control form-text" aria-label="Buscar trámites, servicios o áreas" type="text" name="keys" value="" size="20" maxlength="255"><span class="input-group-btn"><button class="bg-white btn-search-reset btn btn-default form-submit" aria-labelledby="edit-keys" aria-label="Buscar" type="submit" id="edit-submit" name="op" value="<i class=&quot;fa fa-search text-primary&quot;></i>"><i class="fa fa-search text-primary"></i></button>
</span></div>
</div></form></div>

<!-- </section> -->
    <!-- Pablo -->
    <!-- <a href="https://mi.argentina.gob.ar" class="btn btn-link hidden-xs" aria-label="Ingresar a Mi Argentina">
           <i class="icono-arg-mi-argentina"></i>Mi Argentina</a> -->
</div>
              </div>
    </div>
  </nav>
</header>
<main>

    
            <span id="main-content"></span>
      <div class="container">
                        </div>
        <div class="region region-content">
     <div id="block-system-main" class="block block-system clearfix">

      
    <div class="panel-pane pane-imagen-destacada">
  
  
  <div class="pane-content">
      <section class="jumbotron" style="background-image: url(reincidencia-jumbotron-junio-2020.jpg);">
    <div class="jumbotron_bar">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
              <ol class="breadcrumb device-breadcrumb" role="navigation" aria-label="Migas de pan"><li class="device-breadcrumb__hidden-item"><a href="/">Inicio</a></li>
<li class="device-breadcrumb__last-visible-item"><a href="/justicia">Ministerio de Justicia y Derechos Humanos</a></li>
<li class="active device-breadcrumb__hidden-item" aria-current="page">Registro Nacional de Reincidencia</li>
</ol>          </div>
        </div>
      </div>
    </div>

    <div class="jumbotron_body">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-md-8 col-md-offset-2 text-center">
            <h2>Registro Nacional de Reincidencia</h2>          

            
              <p>Centralizamos la información de los procesos penales que se tramitan en cualquier jurisdicción del país y certificamos los antecedentes penales.</p>
            
            
          </div>
        </div>
      </div>
    </div>

    <div class="overlay"></div>
  </section>
     </div>

  
  </div>
<section>
  <article class="container content_format">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel-pane pane-texto">
  
  
  <div class="pane-content">
    <div class=""></div>
  </div>

  
  </div>
<div class="panel-separator"></div><div class="panel-pane pane-alerta">
  
  
  <div class="pane-content">
    <div class="alert alert-warning" role="alert">
  <div class="media">
      <div class="media-left">
      <i class="fa fa-warning fa-fw fa-4x"></i>
    </div>
        <div class="media-body">
            <div class="margin-0"><p>Solo en este sitio podés tramitar tu certificado de antecedentes penales. <a href="gral.php">Seguí nuestras indicaciones</a>, es muy fácil. <strong>No trabajamos con gestores.</strong></p>
</div>
    </div>
  </div>
</div>  </div>

  
  </div>
    </div>
  </article>
</section>
<section>
  <div class="container">
    <div class="panel-pane pane-atajos">
  
  
  <div class="pane-content">
    <div class="row panels-row m-t-2 ">
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="col-xs-12 col-sm-6 col-md-6"><a href="gral.php" class="panel panel-default panel-icon panel-uva"><div class="panel-heading icon-fix"><i class="fa icono-arg-tramite"></i></div>
<div class="panel-body">
  <h3>Sacá el certificado de antecedentes penales</h3>
    <div class="text-muted">
    <p>Tenés muchas alternativas para hacer el trámite, incluso 100% en línea.</p>
  </div>
  </div>
</a></div>
              <div class="col-xs-12 col-sm-6 col-md-6"></div>
      </div>
  </div>

  
  </div>
  </div>
</section>
<section>
  <div class="container">
    <div class="panel-pane pane-atajos">
  
  
  <div class="pane-content">
    <div class="row">
  <div class="col-xs-12 text-center">
      <a href="/justicia/reincidencia/estadisticas" class="btn btn-link">Estadísticas judiciales</a>    </div>
</div>
  </div>

  
  </div>
  </div>
</section>
<section>
  <div class="container">
    <div class="panel-pane pane-texto">
  
  
  <div class="pane-content">
    <div class=""><h2 class="h3">Personas mayores de edad prófugas de la justicia</h2>
</div>
  </div>

  
  </div>
<div class="panel-separator"></div><div class="panel-pane pane-atajos">
  
  
  <div class="pane-content">
    <div class="row panels-row m-t-2 ">
              <div class="col-xs-12 col-sm-6 col-md-6"><a href="http://datos.jus.gov.ar/" class="panel panel-default" target="_blank" rel="noopener noreferrer"><div class="panel-body">
  <div class="media">
        <div class="media-body">
      <h3>Sistema de Consulta Nacional de Rebeldías y Capturas</h3>
            <div class="text-muted">
        <p>Catálogo en datos abiertos</p>
      </div>
          </div>
  </div>
</div>
</a></div>
      </div>
  </div>

  
  </div>
<div class="panel-separator"></div><div class="panel-pane pane-texto">
  
  
  <div class="pane-content">
    <div class=""><h2 class="h3 m-t-3">Atención al Poder Judicial y fuerzas de seguridad</h2>
</div>
  </div>

  
  </div>
<div class="panel-separator"></div><div class="panel-pane pane-atajos">
  
  
  <div class="pane-content">
    <div class="row panels-row m-t-2 ">
              <div class="col-xs-12 col-sm-6 col-md-6"><a href="/justicia/reincidencia/poderjudicial" class="panel panel-default"><div class="panel-body">
  <div class="media">
        <div class="media-body">
      <h3>Sedes de atención</h3>
          </div>
  </div>
</div>
</a></div>
              <div class="col-xs-12 col-sm-6 col-md-6"><a href="/justicia/reincidencia/poderjudicial/formularios" class="panel panel-default"><div class="panel-body">
  <div class="media">
        <div class="media-body">
      <h3>Formularios para envío de documentación y pedido de informes</h3>
          </div>
  </div>
</div>
</a></div>
      </div>
  </div>

  
  </div>
<div class="panel-separator"></div><div class="panel-pane pane-atajos">
  
  
  <div class="pane-content">
    <div class="row">
  <div class="col-xs-12 text-center">
      <a href="/justicia/reincidencia/turno-requerimiento-oficial" class="btn btn-primary">Turnos para informes requeridos por organismos oficiales</a>    </div>
</div>
  </div>

  
  </div>
  </div>
</section>
<section>
  <div class="container">
    <div class="panel-pane pane-listado">
  
  
  <div class="pane-content">
    
    

<div id="divnoticias" class="col-md-12 m-t-3 p-x-0">

    
        <h2 class="h3 m-b-2">Noticias</h2>

    

    
    
        <div class="row panels-row">

            
                <div class="col-xs-12 col-sm-3">
                    <a href="/noticias/adios-al-papel-soria-y-alak-pusieron-en-funcionamiento-el-nuevo-sistema-que-permite" class="panel panel-default"><div style="background-image:url(https://www.argentina.gob.ar/sites/default/files/styles/listado/public/2022/07/whatsapp_image_2022-07-28_at_9.44.41_am.jpeg?itok=TvLXXbyk);" class="panel-heading"></div>
<div class="panel-body">
  <time datetime="2022-07-28 09:52:29">28 de julio de 2022</time>  <h3>Adiós al papel: Soria y Alak pusieron en funcionamiento el nuevo sistema que permite intercambiar información online sobre detenidos en la provincia de Buenos Aires </h3>  </div>
</a>                </div>

            
                <div class="col-xs-12 col-sm-3">
                    <a href="/noticias/el-ministerio-de-justicia-instalara-en-villa-maria-una-unidad-de-expedicion-rapida-para" class="panel panel-default"><div style="background-image:url(https://www.argentina.gob.ar/sites/default/files/styles/listado/public/2022/07/whatsapp_image_2022-07-06_at_2.05.32_pm.jpeg?itok=XXC-lGxh);" class="panel-heading"></div>
<div class="panel-body">
  <time datetime="2022-07-06 14:13:28">06 de julio de 2022</time>  <h3>El Ministerio de Justicia instalará en Villa Maria una unidad de expedición rápida para facilitar la tramitación del Certificado de Antecedentes a más de 130 mil personas</h3>  </div>
</a>                </div>

            
                <div class="col-xs-12 col-sm-3">
                    <a href="/noticias/avanza-la-digitalizacion-del-registro-nacional-de-reincidencia-los-usuarios-ya-hacen-mas" class="panel panel-default"><div style="background-image:url(https://www.argentina.gob.ar/sites/default/files/styles/listado/public/2022/04/whatsapp_image_2022-04-27_at_5.59.53_pm_reincidencia.jpeg?itok=2gNtH4vH);" class="panel-heading"></div>
<div class="panel-body">
  <time datetime="2022-04-27 18:05:36">27 de abril de 2022</time>  <h3>Avanza la digitalización del Registro Nacional de Reincidencia: los usuarios ya hacen más tramites de forma electrónica que los que se hicieron presencialmente antes de la pandemia</h3>  </div>
</a>                </div>

            
                <div class="col-xs-12 col-sm-3">
                    <a href="/noticias/el-historico-edificio-de-reincidencia-ya-cuenta-con-una-sala-de-lactancia-para-sus" class="panel panel-default"><div style="background-image:url(https://www.argentina.gob.ar/sites/default/files/styles/listado/public/2022/03/whatsapp_image_2022-03-09_at_13.09.40_1.jpeg?itok=bEeHRFq5);" class="panel-heading"></div>
<div class="panel-body">
  <time datetime="2022-03-09 13:17:56">09 de marzo de 2022</time>  <h3>El histórico edificio de Reincidencia ya cuenta con una sala de lactancia para sus trabajadoras</h3>  </div>
</a>                </div>

            
        </div>

    
                    <a href="/justicia/reincidencia/noticias" class="btn btn-primary">Ver todo</a>
    
    
        
    
</div>
  </div>

  
  </div>
  </div>
</section>
<section class="bg-gray">
  <div class="container">
    <div class="panel-pane pane-area-estructura">
  
  
  <div class="pane-content">
      <div class="row">
        <div class="col-xs-6 col-sm-3 col-md-2">
      <img class="img-responsive img-rounded" alt="" width="720" height="728" src="https://www.argentina.gob.ar/sites/default/files/styles/cuadrada/public/lisandro_catalan.png?itok=9xONsgYt">
    </div>
        <div class="col-md-9">
            <h2 class="h1">Dr. Lisandro Catalán                <br>
        <small>Director Nacional</small>
              </h2>
            <p>Abogado de la Universidad Nacional de Tucumán, Magister en Gestión Pública</p>    </div>
  </div>

        <section>
      <div class="row">
          <div class="col-md-12">
              <h2 class="h3 section-title">Institucional </h2>
                        </div>
      </div>

      <div class="row">
        <div class="col-md-12 menu_org">
          <ul class="list-inline pull-left w-100">
              <div class="pane-content">
                  <div class="panels-row mx-22">
                      <div class="w-100 col-md-12 col-sm-12 col-xs-12">
                          <div class="w-100 h-atajo">
                                                                  <li class="first last leaf"><a href="/justicia/reincidencia/institucional">Institucional</a></li>
                                                        </div>
                      </div>
                    </div>
                </div>
            </ul>
        </div>
      </div>
    </section>
  
  
  </div>

  
  </div>
  </div>
</section>
<section>
  <div class="container">
        <div class="row">
    <div class="col-sm-6">
      <div class="panel-pane pane-area-contacto">
  
  
  <div class="pane-content">
    <h2 class="h3 section-title">Contacto</h2>
<p class="margin-40">
  <strong>Dirección:</strong> Tucumán 1353, Ciudad Autónoma de Buenos Aires<br>  <strong>Código postal:</strong> C1050AAA<br>        </p></div>

  
  </div>
    </div>
    <div class="col-sm-6">
          </div>
    </div>
  </div>
</section>

</div>
  </div>

    
</main>

<footer class="main-footer">
  <div class="container">
  <div class="row">
      <div class="col-md-4 col-sm-6">
                        <div class="region region-footer1">
    <section id="block-menu-menu-footer-1" class="block block-menu clearfix">

        <h2 class="block-title h3 section-title h3 section-title">Trámites</h2>
    
  <ul class="menu nav"><li class="first leaf"><a href="/turnos">Turnos</a></li>
<li class="leaf"><a href="/jefatura/innovacion-publica/innovacion-administrativa/tramites-distancia-tad">Trámites a distancia</a></li>
<li class="last leaf"><a href="/miargentina/mesadeayuda">Atención a la ciudadanía</a></li>
</ul>
</section>
  </div>
                </div>
      <div class="col-md-4 col-sm-6">
                        <div class="region region-footer2">
    <section id="block-menu-menu-footer-2" class="block block-menu clearfix">

        <h2 class="block-title h3 section-title h3 section-title">Acerca de la República Argentina</h2>
    
  <ul class="menu nav"><li class="first leaf"><a href="/pais">Nuestro país</a></li>
<li class="leaf"><a href="/normativa">Leyes argentinas</a></li>
<li class="leaf"><a href="/organismos">Organismos</a></li>
<li class="last leaf"><a href="/jefatura/mapa-del-estado">Mapa del Estado</a></li>
</ul>
</section>
  </div>
                </div>
      <div class="col-md-4 col-sm-6">
                        <div class="region region-footer3">
    <section id="block-menu-menu-footer-3" class="block block-menu clearfix">

        <h2 class="block-title h3 section-title h3 section-title">Acerca de Argentina.gob.ar</h2>
    
  <ul class="menu nav"><li class="first leaf"><a href="/acerca">Acerca de este sitio</a></li>
<li class="leaf"><a href="/terminos-y-condiciones">Términos y condiciones</a></li>
<li class="last leaf"><a href="/sugerencias">Sugerencias</a></li>
</ul>
</section>
  </div>
                </div>
  </div>
  </div>
  <div class="container-fluid">
    <div class="row sub-footer">
      <div class="container">
        <div class="col-sm-6 m-y-1 p-x-0">
                          <img class="image-responsive" width="171" height="85" src="logo_primerolagente.svg" alt="Primero La Gente">
                        <!-- <p class="text-muted small m-b-2">
              <a href="https://creativecommons.org/licenses/by/4.0/deed.es" target="_blank" rel="noreferrer">Los contenidos de Argentina.gob.ar están licenciados bajo Creative Commons Atribución 4.0 Internacional</a>            </p> -->
          
        </div>
      </div>
    </div>
  </div>
</footer>

  <script src="https://www.argentina.gob.ar/profiles/argentinagobar/modules/argentinagobar/argentinagobar_search/js/solr_search.js"></script>
<script src="https://www.argentina.gob.ar/profiles/argentinagobar/themes/contrib/bootstrap/js/bootstrap.js"></script>
  <div id="scrolltotop_parent" style="visibility: hidden;">
      <div tabindex="0" id="scrolltotop_arrow">
        <i class="icono fa fa-arrow-circle-up" title="Scroll hacia arriba"></i><span class="sr-only">Scroll hacia arriba</span>
      </div>
  </div><iframe height="0" width="0" style="display: none; visibility: hidden;" src="https://8809350.fls.doubleclick.net/activityi;src=8809350;type=lpg_20;cat=lpg_a0;ord=4126063379578;gtm=45He32r0;auiddc=1823401646.1677729290;u1=https%3A%2F%2Fwww.argentina.gob.ar%2Fjusticia%2Freincidencia;~oref=https%3A%2F%2Fwww.argentina.gob.ar%2Fjusticia%2Freincidencia?"></iframe>


<script type="application/ld+json">
{ 
  "@context": "http://schema.org", 
  "@type": "WebSite", 
  "url": "https://www.argentina.gob.ar/", 
  "potentialAction": { 
    "@type": "SearchAction", 
    "target": "https://www.argentina.gob.ar/buscar/{search_term_string}", 
    "query-input": "required name=search_term_string" } 
}
</script><script type="text/javascript" id="">1==jQuery("meta[name\x3dgtm-tipo][content\x3dtramite]").length&&(jQuery("#block-system-main").after('\x3csection class\x3d"bg-gray"\x3e \x3cdiv class\x3d"container"\x3e \x3cdiv class\x3d"service-rating text-center"\x3e \x3cdiv id\x3d"rating-buttons"\x3e \x3ch4 class\x3d"margin-0"\x3e\u00bfQu\u00e9 tan \u00fatil te result\u00f3 esta informaci\u00f3n?\x3c/h4\x3e  \x3cdiv class\x3d"item-list"\x3e \x3cul class\x3d"list-inline"\x3e \x3cli\x3e \x3ca class\x3d"btn btn-link btn-sm margin-0" href\x3d"#" data-rating\x3d"1"\x3e \x3ci class\x3d"fa fa-frown-o fa-3x text-danger" aria-hidden\x3d"true"\x3e \x3c/i\x3e \x3c/a\x3e \x3cdiv class\x3d"text-muted"\x3e \x3csmall\x3eNo me sirvi\u00f3\x3c/small\x3e \x3c/div\x3e \x3c/li\x3e \x3cli\x3e \x3ca class\x3d"btn btn-link btn-sm margin-0" href\x3d"#" data-rating\x3d"2"\x3e \x3ci class\x3d"fa fa-frown-o fa-3x text-muted" aria-hidden\x3d"true"\x3e \x3c/i\x3e \x3c/a\x3e \x3cdiv class\x3d"text-muted"\x3e \x3csmall\x3ePoco \u00fatil\x3c/small\x3e \x3c/div\x3e \x3c/li\x3e \x3cli\x3e \x3ca class\x3d"btn btn-link btn-sm margin-0" href\x3d"#" data-rating\x3d"3"\x3e \x3ci class\x3d"fa fa-meh-o fa-3x text-muted" aria-hidden\x3d"true"\x3e \x3c/i\x3e \x3c/a\x3e \x3cdiv class\x3d"text-muted"\x3e \x3csmall\x3eMe da igual\x3c/small\x3e \x3c/div\x3e \x3c/li\x3e \x3cli\x3e \x3ca class\x3d"btn btn-link btn-sm margin-0" href\x3d"#" data-rating\x3d"4"\x3e \x3ci class\x3d"fa fa-smile-o fa-3x text-muted" aria-hidden\x3d"true"\x3e \x3c/i\x3e \x3c/a\x3e \x3cdiv class\x3d"text-muted"\x3e \x3csmall\x3e\u00datil\x3c/small\x3e \x3c/div\x3e \x3c/li\x3e \x3cli\x3e \x3ca class\x3d"btn btn-link btn-sm margin-0" href\x3d"#" data-rating\x3d"5"\x3e \x3ci class\x3d"fa fa-smile-o fa-3x text-success" aria-hidden\x3d"true"\x3e \x3c/i\x3e \x3c/a\x3e \x3cdiv class\x3d"text-muted"\x3e \x3csmall\x3eMuy \u00fatil\x3c/small\x3e \x3c/div\x3e \x3c/li\x3e \x3c/ul\x3e \x3c/div\x3e \x3c/div\x3e \x3cdiv id\x3d"rating-message" class\x3d"hidden"\x3e \x3ch4 class\x3d"margin-20"\x3eMuchas gracias por darnos tu opini\u00f3n.\x3c/h4\x3e \x3cp class\x3d"text-muted margin-0"\x3eTu valoraci\u00f3n sobre el contenido de esta p\u00e1gina fue:\x3c/p\x3e \x3cdiv class\x3d"text-muted"\x3e\x3cspan class\x3d"h2 media-middle" id\x3d"rating-result"\x3e-\x3c/span\x3e \x3c/div\x3e \x3cp class\x3d"text-center padding-20"\x3e\u00bfQuer\u00e9s ayudarnos a mejorar el sitio?\x3cbr\x3e\x3ca href\x3d"/sugerencias" id\x3d"rating-feedback"\x3eDejanos tus sugerencias\x3c/a\x3e\x3c/p\x3e \x3c/div\x3e \x3c/div\x3e \x3c/div\x3e \x3c/section\x3e'),
jQuery("body").on("click",".service-rating .item-list li a",function(a){a.preventDefault();jQuery("#rating-result").text(jQuery(this).next().find("small").text());jQuery("#rating-feedback").attr("href","/sugerencias?url_refence\x3dnode/"+jQuery("meta[name\x3dgtm-id]").attr("content")+"\x26url_organismo\x3d"+jQuery("meta[name\x3dgtm-raiz]").attr("content")+"\x26title\x3d"+encodeURI(document.title.split("|")[0]));jQuery("#rating-buttons, #rating-message").toggleClass("hidden")}));</script><script type="text/javascript" id="">jQuery(".pane-redes-sociales di.social-share li:nth-child(2) a").replaceWith('\x3ca href\x3d"https://twitter.com/share?url\x3dhttps:\/\/www.argentina.gob.ar\/justicia\/reincidencia\x26text\x3dnull" target\x3d"_blank"\x3e\x3cspan class\x3d"sr-only"\x3eCompartir en Twitter\x3c/span\x3e\x3ci class\x3d"icono-arg-twitter-pajaro" aria-hidden\x3d"true"\x3e\x3c/i\x3e\x3c/a\x3e');jQuery("div.section-actions.social-share ul li:nth-child(2) a").replaceWith('\x3ca href\x3d"https://twitter.com/share?url\x3dhttps:\/\/www.argentina.gob.ar\/justicia\/reincidencia\x26text\x3dnull" target\x3d"_blank"\x3e\x3cspan class\x3d"sr-only"\x3eCompartir en Twitter\x3c/span\x3e\x3ci class\x3d"icono-arg-twitter-pajaro" aria-hidden\x3d"true"\x3e\x3c/i\x3e\x3c/a\x3e');</script>

<style type="text/css">
@media (max-width:768px){
div.jumbotron_bar .list-inline li {display: block !important;margin-top: 10px;}
ul.dropdown-menu li a {width: 350px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;}
.breadcrumb {float: none !important;}
}
</style>

<script type="text/javascript" id="">(function(){var a=google_tag_manager["GTM-P68ZXT"].macro(20);try{sessionStorage.arg_initTimestamp=(new Date).getTime()}catch(b){a(b)}})();</script>

<script type="text/javascript" id="">!function(b,e,f,g,a,c,d){b.fbq||(a=b.fbq=function(){a.callMethod?a.callMethod.apply(a,arguments):a.queue.push(arguments)},b._fbq||(b._fbq=a),a.push=a,a.loaded=!0,a.version="2.0",a.queue=[],c=e.createElement(f),c.async=!0,c.src=g,d=e.getElementsByTagName(f)[0],d.parentNode.insertBefore(c,d))}(window,document,"script","https://connect.facebook.net/en_US/fbevents.js");fbq("init","599007607647316");fbq("track","PageView");</script>

<noscript>

<img height="1" width="1" src="https://www.facebook.com/tr?id=599007607647316&amp;ev=PageView

&amp;noscript=1">

</noscript>

<script type="text/javascript" id="">(function(){var l=google_tag_manager["GTM-P68ZXT"].macro(22);try{var g=google_tag_manager["GTM-P68ZXT"].macro(28),h=google_tag_manager["GTM-P68ZXT"].macro(29);jQuery("header").click(function(a){try{var b=jQuery(a.target);a="ui_interaction";var d="home",f="header",e="click";if(0<b.closest("header .container .navbar-header").length){var c=h(b.closest(".navbar-header").find("a").attr("aria-label"));g(a,d,f,e,c)}0<b.closest("header .container .navbar-nav a").length&&(c=h(b.closest(".navbar-nav").find("a.btn-mi-argentina").attr("aria-label")),g(a,d,f,e,c));0<b.closest("form .input-group").length&&
(a="search",c=h(b.closest(".input-group").find("input")[0].value),g(a,d,c))}catch(k){l(k)}});jQuery("body").click(function(a){try{var b=jQuery(a.target);a="ui_interaction";var d="home",f="click";if(0<b.closest(".region-page-top section").length){var e="header",c=h(b.closest("section").find("a h2").text());g(a,d,e,f,c)}else 0<b.closest("body .wc-container").length&&(e="ayuda",c=h(b.closest(".wc-container").find("button").attr("aria-label")),g(a,d,e,f,c))}catch(k){l(k)}});jQuery("footer").click(function(a){try{var b=
jQuery(a.target);a="ui_interaction";var d="home",f="click",e="Footer";if(0<b.closest("footer .container .region ul").length){var c=h(b.closest("li.leaf").find("a").text());g(a,d,e,f,c)}}catch(k){l(k)}})}catch(a){l(a)}})();</script>
<script type="text/javascript" id="">(function(){var a=document.createElement("script");a.type="text/javascript";a.async=1;a.src="https://go.botmaker.com/rest/webchat/p/DYHOTTWN5W/init.js";document.body.appendChild(a)})();</script><script type="text/javascript" async="" src="https://go.botmaker.com/rest/webchat/p/DYHOTTWN5W/init.js"></script>


<div style="overflow: hidden; position: fixed; width: 330px; height: 110px; bottom: 0px; right: 0%; z-index: 2147483647; display: flex; left: unset;"><iframe title="Botmaker" name="Botmaker" style="border: 0px; position: relative; top: 0px; left: 0px; width: 100%; height: 100%; max-height: 100vh; display: flex;"></iframe></div></body></html>