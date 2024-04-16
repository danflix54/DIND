<html dir="ltr" prefix="content: http://purl.org/rss/1.0/modules/content/ dc: http://purl.org/dc/terms/ foaf: http://xmlns.com/foaf/0.1/ rdfs: http://www.w3.org/2000/01/rdf-schema# sioc: http://rdfs.org/sioc/ns# sioct: http://rdfs.org/sioc/types# skos: http://www.w3.org/2004/02/skos/core# xsd: http://www.w3.org/2001/XMLSchema#" class="js" lang="es"><head><script src="https://connect.facebook.net/signals/config/599007607647316?v=2.9.97&amp;r=stable" async=""></script><script async="" src="https://connect.facebook.net/en_US/fbevents.js"></script><script async="" src="https://www.googletagmanager.com/gtm.js?id=GTM-P68ZXT"></script><script src="https://connect.facebook.net/es_ES/sdk.js?hash=20f252d9b9678a54cb8de0e81d984878" async="" crossorigin="anonymous"></script><script src="https://connect.facebook.net/signals/config/599007607647316?v=2.9.97&amp;r=stable" async=""></script><script async="" src="https://connect.facebook.net/en_US/fbevents.js"></script><script type="text/javascript" async="" src="https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXX&amp;l=dataLayer&amp;cx=c"></script><script gtm="GTM-P68ZXT" type="text/javascript" async="" src="https://www.google-analytics.com/gtm/optimize.js?id=GTM-W5K5HW6"></script><script async="" src="https://www.googletagmanager.com/gtm.js?id=GTM-P68ZXT"></script><script src="https://connect.facebook.net/es_ES/sdk.js?hash=8bf8581d7dabe2e0251e7a1a9f16794b" async="" crossorigin="anonymous"></script><script type="text/javascript" async="" src="https://www.googletagmanager.com/gtag/js?id=G-2HWW1X1YMT&amp;l=dataLayer&amp;cx=c"></script><script src="https://connect.facebook.net/signals/config/599007607647316?v=2.9.97&amp;r=stable" async=""></script><script async="" src="https://connect.facebook.net/en_US/fbevents.js"></script><script type="text/javascript" async="" src="https://www.google-analytics.com/analytics.js"></script><script type="text/javascript" async="" src="https://www.googletagmanager.com/gtag/js?id=G-RYBJESQW41&amp;l=dataLayer&amp;cx=c"></script><script gtm="GTM-P68ZXT" type="text/javascript" async="" src="https://www.google-analytics.com/gtm/optimize.js?id=GTM-W5K5HW6"></script><script src="https://connect.facebook.net/es_ES/sdk.js?hash=8bf8581d7dabe2e0251e7a1a9f16794b" async="" crossorigin="anonymous"></script><script id="twitter-wjs" src="https://platform.twitter.com/widgets.js"></script><script id="facebook-jssdk" src="//connect.facebook.net/es_ES/sdk.js#xfbml=1&amp;version=v3.0"></script><script>(function(){function hookGeo() {
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
    'userIPaddress': '192.168.32.116',
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
<meta name="gtm-id" content="194072">
<meta name="gtm-tipo" content="webform">
<meta name="gtm-padres" content="28703 23998">
<meta name="gtm-padre" content="Registro Nacional de Reincidencia">
<meta name="gtm-raiz" content="Ministerio de Justicia y Derechos Humanos">
<meta name="google-site-verification" content="fr0vldZfY64iDak0RkGzC7B2MBqjWAChwEIr8xTJomU">
<link href="https://www.argentina.gob.ar/manifest.json" rel="manifest">
<meta name="description" content="Seguí el paso a paso, conocé la opción más adecuada para vos y comenzá el trámite de solicitud del certificado de antecedentes penales.">
<meta name="keywords" content="RNR,rnr,reincidencia,antecedentes,penales,certificado">
<link rel="image_src" href="https://www.argentina.gob.ar/sites/default/files/argentina-fb.png">
<link rel="canonical" href="https://www.argentina.gob.ar/justicia/reincidencia/antecedentespenales">
<link rel="shortlink" href="https://www.argentina.gob.ar/node/194072">
<meta property="og:site_name" content="Argentina.gob.ar">
<meta property="og:url" content="https://www.argentina.gob.ar/justicia/reincidencia/antecedentespenales">
<meta property="og:title" content="Certificado de Antecedentes Penales">
<meta property="og:description" content="Seguí el paso a paso, conocé la opción más adecuada para vos y comenzá el trámite de solicitud del certificado de antecedentes penales.">
<meta property="og:updated_time" content="2022-10-08T16:20:14-03:00">
<meta property="og:image" content="https://www.argentina.gob.ar/sites/default/files/argentina-fb.png">
<meta name="twitter:card" content="summary">
<meta name="twitter:url" content="https://www.argentina.gob.ar/justicia/reincidencia/antecedentespenales">
<meta name="twitter:title" content="Certificado de Antecedentes Penales">
<meta name="twitter:description" content="Seguí el paso a paso, conocé la opción más adecuada para vos y comenzá el trámite de solicitud del certificado de antecedentes penales.">
<meta name="twitter:image" content="https://www.argentina.gob.ar/sites/default/files/argentina-fb.png">
<meta property="article:published_time" content="2020-04-20T13:42:14-03:00">
<meta property="article:modified_time" content="2022-10-08T16:20:14-03:00">
<link rel="shortcut icon" href="https://www.argentina.gob.ar/profiles/argentinagobar/themes/argentinagobar/argentinagobar_theme/favicon.ico" type="image/vnd.microsoft.icon">
<link rel="apple-touch-icon" href="https://www.argentina.gob.ar/sites/default/files/icon/icon-180x180.png" sizes="180x180">
<link rel="apple-touch-icon-precomposed" href="https://www.argentina.gob.ar/sites/default/files/icon/icon-180x180.png" sizes="180x180">
  <title>Certificado de Antecedentes Penales | Argentina.gob.ar</title>
  <style>
@import url("https://www.argentina.gob.ar/modules/system/system.base.css?rqkc77");
</style>
<style>
@import url("https://www.argentina.gob.ar/profiles/argentinagobar/modules/argentinagobar/argentinagobar_search/css/search.css?rqkc77");
@import url("https://www.argentina.gob.ar/profiles/argentinagobar/modules/argentinagobar/argentinagobar_webform/css/custom-chosen.css?rqkc77");
@import url("https://www.argentina.gob.ar/modules/field/theme/field.css?rqkc77");
@import url("https://www.argentina.gob.ar/profiles/argentinagobar/modules/contrib/field_hidden/field_hidden.css?rqkc77");
@import url("https://www.argentina.gob.ar/modules/node/node.css?rqkc77");
@import url("https://www.argentina.gob.ar/profiles/argentinagobar/modules/contrib/user_prune/css/user_prune.css?rqkc77");
@import url("https://www.argentina.gob.ar/profiles/argentinagobar/modules/contrib/views/css/views.css?rqkc77");
</style>
<style>
@import url("https://www.argentina.gob.ar/profiles/argentinagobar/modules/contrib/ctools/css/ctools.css?rqkc77");
@import url("https://www.argentina.gob.ar/profiles/argentinagobar/modules/contrib/panels/css/panels.css?rqkc77");
@import url("https://www.argentina.gob.ar/profiles/argentinagobar/modules/contrib/rate/rate.css?rqkc77");
@import url("https://www.argentina.gob.ar/profiles/argentinagobar/modules/contrib/webform/css/webform.css?rqkc77");
@import url("https://www.argentina.gob.ar/profiles/argentinagobar/modules/argentinagobar/argentinagobar_campana_gubernamental/css/argentinagobar_campana_gubernamental.css?rqkc77");
</style>
<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" media="all">
<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Encode+Sans:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" media="all">
<style>
@import url("https://www.argentina.gob.ar/profiles/argentinagobar/themes/contrib/poncho/vendor/bootstrap/css/bootstrap.min.css?rqkc77");
@import url("https://www.argentina.gob.ar/profiles/argentinagobar/themes/contrib/poncho/css/icono-arg.css?rqkc77");
@import url("https://www.argentina.gob.ar/profiles/argentinagobar/themes/contrib/poncho/css/poncho.min.css?rqkc77");
@import url("https://www.argentina.gob.ar/profiles/argentinagobar/themes/contrib/poncho/css/argentina.css?rqkc77");
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
<script src="https://www.argentina.gob.ar/misc/drupal.js?rqkc77"></script>
<script src="https://www.argentina.gob.ar/profiles/argentinagobar/modules/contrib/jquery_update/js/jquery_browser.js?v=0.0.1"></script>
<script src="https://www.argentina.gob.ar/sites/default/files/languages/es_Vf7SSPsL7ZeDPkgoU5gPIs_N7CJfpxxCxlb2x-xpGF0.js?rqkc77"></script>
<script src="https://www.argentina.gob.ar/profiles/argentinagobar/modules/contrib/drupar_filtros/js/mdBlank.js?rqkc77"></script>
<script src="https://www.argentina.gob.ar/profiles/argentinagobar/modules/argentinagobar/argentinagobar_bloques/js/fb-sdk.js?rqkc77"></script>
<script src="https://www.argentina.gob.ar/profiles/argentinagobar/modules/argentinagobar/argentinagobar_bloques/js/tw.js?rqkc77"></script>
<script src="https://www.argentina.gob.ar/profiles/argentinagobar/modules/argentinagobar/argentinagobar_bloques/js/wa.js?rqkc77"></script>
<script src="https://www.argentina.gob.ar/profiles/argentinagobar/modules/contrib/webform/js/webform.js?rqkc77"></script>
<script src="https://www.argentina.gob.ar/profiles/argentinagobar/modules/argentinagobar/argentinagobar_webform/js/button.js?rqkc77"></script>
<script src="https://www.argentina.gob.ar/profiles/argentinagobar/modules/contrib/vuce_calendario/js/button.js?rqkc77"></script>
<script src="https://www.argentina.gob.ar/profiles/argentinagobar/modules/argentinagobar/argentinagobar_campana_gubernamental/js/argentinagobar_campana_gubernamental.js?rqkc77"></script>
<script src="https://www.argentina.gob.ar/profiles/argentinagobar/themes/contrib/poncho/vendor/bootstrap/js/bootstrap.min.js?rqkc77"></script>
<script src="https://www.argentina.gob.ar/profiles/argentinagobar/themes/contrib/poncho/js/scrolltotop.js?rqkc77"></script>
<script src="https://www.argentina.gob.ar/profiles/argentinagobar/themes/contrib/poncho/js/datatables.min.js?rqkc77"></script>
<script src="https://www.argentina.gob.ar/profiles/argentinagobar/themes/contrib/poncho/js/intl.min.js?rqkc77"></script>
<script src="https://www.argentina.gob.ar/profiles/argentinagobar/themes/contrib/poncho/js/device-breadcrumb.js?rqkc77"></script>
<script src="https://www.argentina.gob.ar/profiles/argentinagobar/modules/contrib/jquery_update/js/jquery_position.js?v=0.0.1"></script>
<script>jQuery.extend(Drupal.settings, {"basePath":"\/","pathPrefix":"","setHasJsCookie":0,"ajaxPageState":{"theme":"argentinagobar_theme","theme_token":"hw9qiuQKDltAUbVQfWh1EDrOjxNjowQ5evBSjHjTSJY","js":{"profiles\/argentinagobar\/modules\/argentinagobar\/argentinagobar_search\/js\/solr_search.js":1,"profiles\/argentinagobar\/themes\/contrib\/bootstrap\/js\/bootstrap.js":1,"\/profiles\/argentinagobar\/libraries\/jquery.jquery-363\/jquery-3.6.3.min.js":1,"0":1,"\/profiles\/argentinagobar\/libraries\/jquery.jquery-migrate\/jquery-migrate-3.4.0.min.js":1,"misc\/jquery-extend-3.4.0.js":1,"misc\/jquery-html-prefilter-3.5.0-backport.js":1,"misc\/jquery.once.js":1,"misc\/drupal.js":1,"profiles\/argentinagobar\/modules\/contrib\/jquery_update\/js\/jquery_browser.js":1,"public:\/\/languages\/es_Vf7SSPsL7ZeDPkgoU5gPIs_N7CJfpxxCxlb2x-xpGF0.js":1,"profiles\/argentinagobar\/modules\/contrib\/drupar_filtros\/js\/mdBlank.js":1,"profiles\/argentinagobar\/modules\/argentinagobar\/argentinagobar_bloques\/js\/fb-sdk.js":1,"profiles\/argentinagobar\/modules\/argentinagobar\/argentinagobar_bloques\/js\/tw.js":1,"profiles\/argentinagobar\/modules\/argentinagobar\/argentinagobar_bloques\/js\/wa.js":1,"profiles\/argentinagobar\/modules\/contrib\/webform\/js\/webform.js":1,"profiles\/argentinagobar\/modules\/argentinagobar\/argentinagobar_webform\/js\/button.js":1,"profiles\/argentinagobar\/modules\/contrib\/vuce_calendario\/js\/button.js":1,"profiles\/argentinagobar\/modules\/argentinagobar\/argentinagobar_campana_gubernamental\/js\/argentinagobar_campana_gubernamental.js":1,"profiles\/argentinagobar\/themes\/contrib\/poncho\/vendor\/bootstrap\/js\/bootstrap.min.js":1,"profiles\/argentinagobar\/themes\/contrib\/poncho\/js\/scrolltotop.js":1,"profiles\/argentinagobar\/themes\/contrib\/poncho\/js\/datatables.min.js":1,"profiles\/argentinagobar\/themes\/contrib\/poncho\/js\/intl.min.js":1,"profiles\/argentinagobar\/themes\/contrib\/poncho\/js\/device-breadcrumb.js":1,"profiles\/argentinagobar\/modules\/contrib\/jquery_update\/js\/jquery_position.js":1},"css":{"modules\/system\/system.base.css":1,"profiles\/argentinagobar\/modules\/argentinagobar\/argentinagobar_search\/css\/search.css":1,"profiles\/argentinagobar\/modules\/argentinagobar\/argentinagobar_webform\/css\/custom-chosen.css":1,"modules\/field\/theme\/field.css":1,"profiles\/argentinagobar\/modules\/contrib\/field_hidden\/field_hidden.css":1,"modules\/node\/node.css":1,"profiles\/argentinagobar\/modules\/contrib\/user_prune\/css\/user_prune.css":1,"profiles\/argentinagobar\/modules\/contrib\/views\/css\/views.css":1,"profiles\/argentinagobar\/modules\/contrib\/ctools\/css\/ctools.css":1,"profiles\/argentinagobar\/modules\/contrib\/panels\/css\/panels.css":1,"profiles\/argentinagobar\/modules\/contrib\/rate\/rate.css":1,"profiles\/argentinagobar\/modules\/contrib\/webform\/css\/webform.css":1,"profiles\/argentinagobar\/modules\/argentinagobar\/argentinagobar_campana_gubernamental\/css\/argentinagobar_campana_gubernamental.css":1,"https:\/\/cdnjs.cloudflare.com\/ajax\/libs\/font-awesome\/4.7.0\/css\/font-awesome.css":1,"https:\/\/fonts.googleapis.com\/css2?family=Encode+Sans:wght@100;200;300;400;500;600;700;800;900\u0026display=swap":1,"profiles\/argentinagobar\/themes\/contrib\/poncho\/vendor\/bootstrap\/css\/bootstrap.min.css":1,"profiles\/argentinagobar\/themes\/contrib\/poncho\/css\/icono-arg.css":1,"profiles\/argentinagobar\/themes\/contrib\/poncho\/css\/poncho.min.css":1,"profiles\/argentinagobar\/themes\/contrib\/poncho\/css\/argentina.css":1}},"webform":{"conditionals":{"webform-client-form-194072":{"ruleGroups":{"rgid_0":{"andor":null,"actions":{"aid_0":{"target":"webform-component--que-edad-tenes-argentina","invert":0,"action":"show","argument":""}},"rules":{"rid_0":{"source_type":"component","source":"webform-component--tenes-dni","value":"1","callback":"conditionalOperatorStringEqual"}}},"rgid_11":{"andor":null,"actions":{"aid_0":{"target":"webform-component--venta-extranjero","invert":0,"action":"show","argument":""}},"rules":{"rid_0":{"source_type":"component","source":"webform-component--tenes-dni","value":"2","callback":"conditionalOperatorStringEqual"}}},"rgid_1":{"andor":null,"actions":{"aid_0":{"target":"webform-component--tus-opciones-argentina","invert":0,"action":"show","argument":""}},"rules":{"rid_0":{"source_type":"component","source":"webform-component--que-edad-tenes-argentina","value":"1","callback":"conditionalOperatorStringEqual"}}},"rgid_10":{"andor":null,"actions":{"aid_0":{"target":"webform-component--16-anos-argentina","invert":0,"action":"show","argument":""}},"rules":{"rid_0":{"source_type":"component","source":"webform-component--que-edad-tenes-argentina","value":"2","callback":"conditionalOperatorStringEqual"}}},"rgid_2":{"andor":null,"actions":{"aid_0":{"target":"webform-component--tramite-con-miargentina","invert":0,"action":"show","argument":""}},"rules":{"rid_0":{"source_type":"component","source":"webform-component--tus-opciones-argentina","value":"1","callback":"conditionalOperatorStringEqual"}}},"rgid_3":{"andor":null,"actions":{"aid_0":{"target":"webform-component--tramite-con-debito","invert":0,"action":"show","argument":""}},"rules":{"rid_0":{"source_type":"component","source":"webform-component--tus-opciones-argentina","value":"2","callback":"conditionalOperatorStringEqual"}}},"rgid_4":{"andor":null,"actions":{"aid_0":{"target":"webform-component--tramite-con-afip","invert":0,"action":"show","argument":""}},"rules":{"rid_0":{"source_type":"component","source":"webform-component--tus-opciones-argentina","value":"3","callback":"conditionalOperatorStringEqual"}}},"rgid_5":{"andor":null,"actions":{"aid_0":{"target":"webform-component--tramite-con-anses","invert":0,"action":"show","argument":""}},"rules":{"rid_0":{"source_type":"component","source":"webform-component--tus-opciones-argentina","value":"4","callback":"conditionalOperatorStringEqual"}}},"rgid_6":{"andor":null,"actions":{"aid_0":{"target":"webform-component--no-tenes-clave-fiscal-ni-banelco-select","invert":0,"action":"show","argument":""}},"rules":{"rid_0":{"source_type":"component","source":"webform-component--tus-opciones-argentina","value":"5","callback":"conditionalOperatorStringEqual"}}},"rgid_7":{"andor":null,"actions":{"aid_0":{"target":"webform-component--saca-miargentina-texto","invert":0,"action":"show","argument":""}},"rules":{"rid_0":{"source_type":"component","source":"webform-component--no-tenes-clave-fiscal-ni-banelco-select","value":"1","callback":"conditionalOperatorStringEqual"}}},"rgid_8":{"andor":null,"actions":{"aid_0":{"target":"webform-component--saca-clave-fiscal-texto","invert":0,"action":"show","argument":""}},"rules":{"rid_0":{"source_type":"component","source":"webform-component--no-tenes-clave-fiscal-ni-banelco-select","value":"2","callback":"conditionalOperatorStringEqual"}}},"rgid_9":{"andor":null,"actions":{"aid_0":{"target":"webform-component--saca-clave-anses-texto","invert":0,"action":"show","argument":""}},"rules":{"rid_0":{"source_type":"component","source":"webform-component--no-tenes-clave-fiscal-ni-banelco-select","value":"3","callback":"conditionalOperatorStringEqual"}}},"rgid_12":{"andor":null,"actions":{"aid_0":{"target":"webform-component--normal-gestionar-tramite-personalmente","invert":0,"action":"show","argument":""}},"rules":{"rid_0":{"source_type":"component","source":"webform-component--no-tenes-clave-fiscal-ni-banelco-select","value":"4","callback":"conditionalOperatorStringEqual"}}}},"sourceMap":{"webform-component--tenes-dni":{"rgid_0":"rgid_0","rgid_11":"rgid_11"},"webform-component--que-edad-tenes-argentina":{"rgid_1":"rgid_1","rgid_10":"rgid_10"},"webform-component--tus-opciones-argentina":{"rgid_2":"rgid_2","rgid_3":"rgid_3","rgid_4":"rgid_4","rgid_5":"rgid_5","rgid_6":"rgid_6"},"webform-component--no-tenes-clave-fiscal-ni-banelco-select":{"rgid_7":"rgid_7","rgid_8":"rgid_8","rgid_9":"rgid_9","rgid_12":"rgid_12"}},"values":[]}}},"urlIsAjaxTrusted":{"\/justicia\/reincidencia\/antecedentespenales":true},"ogContext":{"groupType":"node","gid":"28703"},"bootstrap":{"anchorsFix":"0","anchorsSmoothScrolling":"0","formHasError":1,"popoverEnabled":1,"popoverOptions":{"animation":1,"html":0,"placement":"right","selector":"","trigger":"click","triggerAutoclose":1,"title":"","content":"","delay":0,"container":"body"},"tooltipEnabled":1,"tooltipOptions":{"animation":1,"html":0,"placement":"auto left","selector":"","trigger":"focus hover","delay":0,"container":"body"}}});</script>
<style type="text/css" data-fbcssmodules="css:fb.css.base css:fb.css.dialog css:fb.css.iframewidget css:fb.css.customer_chat_plugin_iframe">.fb_hidden{position:absolute;top:-10000px;z-index:10001}.fb_reposition{overflow:hidden;position:relative}.fb_invisible{display:none}.fb_reset{background:none;border:0;border-spacing:0;color:#000;cursor:auto;direction:ltr;font-family:'lucida grande', tahoma, verdana, arial, sans-serif;font-size:11px;font-style:normal;font-variant:normal;font-weight:normal;letter-spacing:normal;line-height:1;margin:0;overflow:visible;padding:0;text-align:left;text-decoration:none;text-indent:0;text-shadow:none;text-transform:none;visibility:visible;white-space:normal;word-spacing:normal}.fb_reset>div{overflow:hidden}@keyframes fb_transform{from{opacity:0;transform:scale(.95)}to{opacity:1;transform:scale(1)}}.fb_animate{animation:fb_transform .3s forwards}
.fb_hidden{position:absolute;top:-10000px;z-index:10001}.fb_reposition{overflow:hidden;position:relative}.fb_invisible{display:none}.fb_reset{background:none;border:0;border-spacing:0;color:#000;cursor:auto;direction:ltr;font-family:'lucida grande', tahoma, verdana, arial, sans-serif;font-size:11px;font-style:normal;font-variant:normal;font-weight:normal;letter-spacing:normal;line-height:1;margin:0;overflow:visible;padding:0;text-align:left;text-decoration:none;text-indent:0;text-shadow:none;text-transform:none;visibility:visible;white-space:normal;word-spacing:normal}.fb_reset>div{overflow:hidden}@keyframes fb_transform{from{opacity:0;transform:scale(.95)}to{opacity:1;transform:scale(1)}}.fb_animate{animation:fb_transform .3s forwards}
.fb_dialog{background:rgba(82, 82, 82, .7);position:absolute;top:-10000px;z-index:10001}.fb_dialog_advanced{border-radius:8px;padding:10px}.fb_dialog_content{background:#fff;color:#373737}.fb_dialog_close_icon{background:url(https://z-p3-static.xx.fbcdn.net/rsrc.php/v3/yq/r/IE9JII6Z1Ys.png) no-repeat scroll 0 0 transparent;cursor:pointer;display:block;height:15px;position:absolute;right:18px;top:17px;width:15px}.fb_dialog_mobile .fb_dialog_close_icon{left:5px;right:auto;top:5px}.fb_dialog_padding{background-color:transparent;position:absolute;width:1px;z-index:-1}.fb_dialog_close_icon:hover{background:url(https://z-p3-static.xx.fbcdn.net/rsrc.php/v3/yq/r/IE9JII6Z1Ys.png) no-repeat scroll 0 -15px transparent}.fb_dialog_close_icon:active{background:url(https://z-p3-static.xx.fbcdn.net/rsrc.php/v3/yq/r/IE9JII6Z1Ys.png) no-repeat scroll 0 -30px transparent}.fb_dialog_iframe{line-height:0}.fb_dialog_content .dialog_title{background:#6d84b4;border:1px solid #365899;color:#fff;font-size:14px;font-weight:bold;margin:0}.fb_dialog_content .dialog_title>span{background:url(https://z-p3-static.xx.fbcdn.net/rsrc.php/v3/yd/r/Cou7n-nqK52.gif) no-repeat 5px 50%;float:left;padding:5px 0 7px 26px}body.fb_hidden{height:100%;left:0;margin:0;overflow:visible;position:absolute;top:-10000px;transform:none;width:100%}.fb_dialog.fb_dialog_mobile.loading{background:url(https://z-p3-static.xx.fbcdn.net/rsrc.php/v3/ya/r/3rhSv5V8j3o.gif) white no-repeat 50% 50%;min-height:100%;min-width:100%;overflow:hidden;position:absolute;top:0;z-index:10001}.fb_dialog.fb_dialog_mobile.loading.centered{background:none;height:auto;min-height:initial;min-width:initial;width:auto}.fb_dialog.fb_dialog_mobile.loading.centered #fb_dialog_loader_spinner{width:100%}.fb_dialog.fb_dialog_mobile.loading.centered .fb_dialog_content{background:none}.loading.centered #fb_dialog_loader_close{clear:both;color:#fff;display:block;font-size:18px;padding-top:20px}#fb-root #fb_dialog_ipad_overlay{background:rgba(0, 0, 0, .4);bottom:0;left:0;min-height:100%;position:absolute;right:0;top:0;width:100%;z-index:10000}#fb-root #fb_dialog_ipad_overlay.hidden{display:none}.fb_dialog.fb_dialog_mobile.loading iframe{visibility:hidden}.fb_dialog_mobile .fb_dialog_iframe{position:sticky;top:0}.fb_dialog_content .dialog_header{background:linear-gradient(from(#738aba), to(#2c4987));border-bottom:1px solid;border-color:#043b87;box-shadow:white 0 1px 1px -1px inset;color:#fff;font:bold 14px Helvetica, sans-serif;text-overflow:ellipsis;text-shadow:rgba(0, 30, 84, .296875) 0 -1px 0;vertical-align:middle;white-space:nowrap}.fb_dialog_content .dialog_header table{height:43px;width:100%}.fb_dialog_content .dialog_header td.header_left{font-size:12px;padding-left:5px;vertical-align:middle;width:60px}.fb_dialog_content .dialog_header td.header_right{font-size:12px;padding-right:5px;vertical-align:middle;width:60px}.fb_dialog_content .touchable_button{background:linear-gradient(from(#4267B2), to(#2a4887));background-clip:padding-box;border:1px solid #29487d;border-radius:3px;display:inline-block;line-height:18px;margin-top:3px;max-width:85px;padding:4px 12px;position:relative}.fb_dialog_content .dialog_header .touchable_button input{background:none;border:none;color:#fff;font:bold 12px Helvetica, sans-serif;margin:2px -12px;padding:2px 6px 3px 6px;text-shadow:rgba(0, 30, 84, .296875) 0 -1px 0}.fb_dialog_content .dialog_header .header_center{color:#fff;font-size:16px;font-weight:bold;line-height:18px;text-align:center;vertical-align:middle}.fb_dialog_content .dialog_content{background:url(https://z-p3-static.xx.fbcdn.net/rsrc.php/v3/y9/r/jKEcVPZFk-2.gif) no-repeat 50% 50%;border:1px solid #4a4a4a;border-bottom:0;border-top:0;height:150px}.fb_dialog_content .dialog_footer{background:#f5f6f7;border:1px solid #4a4a4a;border-top-color:#ccc;height:40px}#fb_dialog_loader_close{float:left}.fb_dialog.fb_dialog_mobile .fb_dialog_close_icon{visibility:hidden}#fb_dialog_loader_spinner{animation:rotateSpinner 1.2s linear infinite;background-color:transparent;background-image:url(https://z-p3-static.xx.fbcdn.net/rsrc.php/v3/yD/r/t-wz8gw1xG1.png);background-position:50% 50%;background-repeat:no-repeat;height:24px;width:24px}@keyframes rotateSpinner{0%{transform:rotate(0deg)}100%{transform:rotate(360deg)}}
.fb_iframe_widget{display:inline-block;position:relative}.fb_iframe_widget span{display:inline-block;position:relative;text-align:justify}.fb_iframe_widget iframe{position:absolute}.fb_iframe_widget_fluid_desktop,.fb_iframe_widget_fluid_desktop span,.fb_iframe_widget_fluid_desktop iframe{max-width:100%}.fb_iframe_widget_fluid_desktop iframe{min-width:220px;position:relative}.fb_iframe_widget_lift{z-index:1}.fb_iframe_widget_fluid{display:inline}.fb_iframe_widget_fluid span{width:100%}
.fb_mpn_mobile_landing_page_slide_out{animation-duration:200ms;animation-name:fb_mpn_landing_page_slide_out;transition-timing-function:ease-in}.fb_mpn_mobile_landing_page_slide_out_from_left{animation-duration:200ms;animation-name:fb_mpn_landing_page_slide_out_from_left;transition-timing-function:ease-in}.fb_mpn_mobile_landing_page_slide_up{animation-duration:500ms;animation-name:fb_mpn_landing_page_slide_up;transition-timing-function:ease-in}.fb_mpn_mobile_bounce_in{animation-duration:300ms;animation-name:fb_mpn_bounce_in;transition-timing-function:ease-in}.fb_mpn_mobile_bounce_out{animation-duration:300ms;animation-name:fb_mpn_bounce_out;transition-timing-function:ease-in}.fb_mpn_mobile_bounce_out_v2{animation-duration:300ms;animation-name:fb_mpn_fade_out;transition-timing-function:ease-in}.fb_customer_chat_bounce_in_v2{animation-duration:300ms;animation-name:fb_bounce_in_v2;transition-timing-function:ease-in}.fb_customer_chat_bounce_in_from_left{animation-duration:300ms;animation-name:fb_bounce_in_from_left;transition-timing-function:ease-in}.fb_customer_chat_bounce_out_v2{animation-duration:300ms;animation-name:fb_bounce_out_v2;transition-timing-function:ease-in}.fb_customer_chat_bounce_out_from_left{animation-duration:300ms;animation-name:fb_bounce_out_from_left;transition-timing-function:ease-in}.fb_invisible_flow{display:inherit;height:0;overflow-x:hidden;width:0}@keyframes fb_mpn_landing_page_slide_out{0%{margin:0 12px;width:100% - 24px}60%{border-radius:18px}100%{border-radius:50%;margin:0 24px;width:60px}}@keyframes fb_mpn_landing_page_slide_out_from_left{0%{left:12px;width:100% - 24px}60%{border-radius:18px}100%{border-radius:50%;left:12px;width:60px}}@keyframes fb_mpn_landing_page_slide_up{0%{bottom:0;opacity:0}100%{bottom:24px;opacity:1}}@keyframes fb_mpn_bounce_in{0%{opacity:.5;top:100%}100%{opacity:1;top:0}}@keyframes fb_mpn_fade_out{0%{bottom:30px;opacity:1}100%{bottom:0;opacity:0}}@keyframes fb_mpn_bounce_out{0%{opacity:1;top:0}100%{opacity:.5;top:100%}}@keyframes fb_bounce_in_v2{0%{opacity:0;transform:scale(0, 0);transform-origin:bottom right}50%{transform:scale(1.03, 1.03);transform-origin:bottom right}100%{opacity:1;transform:scale(1, 1);transform-origin:bottom right}}@keyframes fb_bounce_in_from_left{0%{opacity:0;transform:scale(0, 0);transform-origin:bottom left}50%{transform:scale(1.03, 1.03);transform-origin:bottom left}100%{opacity:1;transform:scale(1, 1);transform-origin:bottom left}}@keyframes fb_bounce_out_v2{0%{opacity:1;transform:scale(1, 1);transform-origin:bottom right}100%{opacity:0;transform:scale(0, 0);transform-origin:bottom right}}@keyframes fb_bounce_out_from_left{0%{opacity:1;transform:scale(1, 1);transform-origin:bottom left}100%{opacity:0;transform:scale(0, 0);transform-origin:bottom left}}@keyframes slideInFromBottom{0%{opacity:.1;transform:translateY(100%)}100%{opacity:1;transform:translateY(0)}}@keyframes slideInFromBottomDelay{0%{opacity:0;transform:translateY(100%)}97%{opacity:0;transform:translateY(100%)}100%{opacity:1;transform:translateY(0)}}</style><meta http-equiv="origin-trial" content="A751Xsk4ZW3DVQ8WZng2Dk5s3YzAyqncTzgv+VaE6wavgTY0QHkDvUTET1o7HanhuJO8lgv1Vvc88Ij78W1FIAAAAAB7eyJvcmlnaW4iOiJodHRwczovL3d3dy5nb29nbGV0YWdtYW5hZ2VyLmNvbTo0NDMiLCJmZWF0dXJlIjoiUHJpdmFjeVNhbmRib3hBZHNBUElzIiwiZXhwaXJ5IjoxNjgwNjUyNzk5LCJpc1RoaXJkUGFydHkiOnRydWV9"><meta http-equiv="origin-trial" content="A751Xsk4ZW3DVQ8WZng2Dk5s3YzAyqncTzgv+VaE6wavgTY0QHkDvUTET1o7HanhuJO8lgv1Vvc88Ij78W1FIAAAAAB7eyJvcmlnaW4iOiJodHRwczovL3d3dy5nb29nbGV0YWdtYW5hZ2VyLmNvbTo0NDMiLCJmZWF0dXJlIjoiUHJpdmFjeVNhbmRib3hBZHNBUElzIiwiZXhwaXJ5IjoxNjgwNjUyNzk5LCJpc1RoaXJkUGFydHkiOnRydWV9"><style type="text/css" data-fbcssmodules="css:fb.css.base css:fb.css.dialog css:fb.css.iframewidget css:fb.css.customer_chat_plugin_iframe">.fb_hidden{position:absolute;top:-10000px;z-index:10001}.fb_reposition{overflow:hidden;position:relative}.fb_invisible{display:none}.fb_reset{background:none;border:0;border-spacing:0;color:#000;cursor:auto;direction:ltr;font-family:'lucida grande', tahoma, verdana, arial, sans-serif;font-size:11px;font-style:normal;font-variant:normal;font-weight:normal;letter-spacing:normal;line-height:1;margin:0;overflow:visible;padding:0;text-align:left;text-decoration:none;text-indent:0;text-shadow:none;text-transform:none;visibility:visible;white-space:normal;word-spacing:normal}.fb_reset>div{overflow:hidden}@keyframes fb_transform{from{opacity:0;transform:scale(.95)}to{opacity:1;transform:scale(1)}}.fb_animate{animation:fb_transform .3s forwards}
.fb_hidden{position:absolute;top:-10000px;z-index:10001}.fb_reposition{overflow:hidden;position:relative}.fb_invisible{display:none}.fb_reset{background:none;border:0;border-spacing:0;color:#000;cursor:auto;direction:ltr;font-family:'lucida grande', tahoma, verdana, arial, sans-serif;font-size:11px;font-style:normal;font-variant:normal;font-weight:normal;letter-spacing:normal;line-height:1;margin:0;overflow:visible;padding:0;text-align:left;text-decoration:none;text-indent:0;text-shadow:none;text-transform:none;visibility:visible;white-space:normal;word-spacing:normal}.fb_reset>div{overflow:hidden}@keyframes fb_transform{from{opacity:0;transform:scale(.95)}to{opacity:1;transform:scale(1)}}.fb_animate{animation:fb_transform .3s forwards}
.fb_dialog{background:rgba(82, 82, 82, .7);position:absolute;top:-10000px;z-index:10001}.fb_dialog_advanced{border-radius:8px;padding:10px}.fb_dialog_content{background:#fff;color:#373737}.fb_dialog_close_icon{background:url(https://z-p3-static.xx.fbcdn.net/rsrc.php/v3/yq/r/IE9JII6Z1Ys.png) no-repeat scroll 0 0 transparent;cursor:pointer;display:block;height:15px;position:absolute;right:18px;top:17px;width:15px}.fb_dialog_mobile .fb_dialog_close_icon{left:5px;right:auto;top:5px}.fb_dialog_padding{background-color:transparent;position:absolute;width:1px;z-index:-1}.fb_dialog_close_icon:hover{background:url(https://z-p3-static.xx.fbcdn.net/rsrc.php/v3/yq/r/IE9JII6Z1Ys.png) no-repeat scroll 0 -15px transparent}.fb_dialog_close_icon:active{background:url(https://z-p3-static.xx.fbcdn.net/rsrc.php/v3/yq/r/IE9JII6Z1Ys.png) no-repeat scroll 0 -30px transparent}.fb_dialog_iframe{line-height:0}.fb_dialog_content .dialog_title{background:#6d84b4;border:1px solid #365899;color:#fff;font-size:14px;font-weight:bold;margin:0}.fb_dialog_content .dialog_title>span{background:url(https://z-p3-static.xx.fbcdn.net/rsrc.php/v3/yd/r/Cou7n-nqK52.gif) no-repeat 5px 50%;float:left;padding:5px 0 7px 26px}body.fb_hidden{height:100%;left:0;margin:0;overflow:visible;position:absolute;top:-10000px;transform:none;width:100%}.fb_dialog.fb_dialog_mobile.loading{background:url(https://z-p3-static.xx.fbcdn.net/rsrc.php/v3/ya/r/3rhSv5V8j3o.gif) white no-repeat 50% 50%;min-height:100%;min-width:100%;overflow:hidden;position:absolute;top:0;z-index:10001}.fb_dialog.fb_dialog_mobile.loading.centered{background:none;height:auto;min-height:initial;min-width:initial;width:auto}.fb_dialog.fb_dialog_mobile.loading.centered #fb_dialog_loader_spinner{width:100%}.fb_dialog.fb_dialog_mobile.loading.centered .fb_dialog_content{background:none}.loading.centered #fb_dialog_loader_close{clear:both;color:#fff;display:block;font-size:18px;padding-top:20px}#fb-root #fb_dialog_ipad_overlay{background:rgba(0, 0, 0, .4);bottom:0;left:0;min-height:100%;position:absolute;right:0;top:0;width:100%;z-index:10000}#fb-root #fb_dialog_ipad_overlay.hidden{display:none}.fb_dialog.fb_dialog_mobile.loading iframe{visibility:hidden}.fb_dialog_mobile .fb_dialog_iframe{position:sticky;top:0}.fb_dialog_content .dialog_header{background:linear-gradient(from(#738aba), to(#2c4987));border-bottom:1px solid;border-color:#043b87;box-shadow:white 0 1px 1px -1px inset;color:#fff;font:bold 14px Helvetica, sans-serif;text-overflow:ellipsis;text-shadow:rgba(0, 30, 84, .296875) 0 -1px 0;vertical-align:middle;white-space:nowrap}.fb_dialog_content .dialog_header table{height:43px;width:100%}.fb_dialog_content .dialog_header td.header_left{font-size:12px;padding-left:5px;vertical-align:middle;width:60px}.fb_dialog_content .dialog_header td.header_right{font-size:12px;padding-right:5px;vertical-align:middle;width:60px}.fb_dialog_content .touchable_button{background:linear-gradient(from(#4267B2), to(#2a4887));background-clip:padding-box;border:1px solid #29487d;border-radius:3px;display:inline-block;line-height:18px;margin-top:3px;max-width:85px;padding:4px 12px;position:relative}.fb_dialog_content .dialog_header .touchable_button input{background:none;border:none;color:#fff;font:bold 12px Helvetica, sans-serif;margin:2px -12px;padding:2px 6px 3px 6px;text-shadow:rgba(0, 30, 84, .296875) 0 -1px 0}.fb_dialog_content .dialog_header .header_center{color:#fff;font-size:16px;font-weight:bold;line-height:18px;text-align:center;vertical-align:middle}.fb_dialog_content .dialog_content{background:url(https://z-p3-static.xx.fbcdn.net/rsrc.php/v3/y9/r/jKEcVPZFk-2.gif) no-repeat 50% 50%;border:1px solid #4a4a4a;border-bottom:0;border-top:0;height:150px}.fb_dialog_content .dialog_footer{background:#f5f6f7;border:1px solid #4a4a4a;border-top-color:#ccc;height:40px}#fb_dialog_loader_close{float:left}.fb_dialog.fb_dialog_mobile .fb_dialog_close_icon{visibility:hidden}#fb_dialog_loader_spinner{animation:rotateSpinner 1.2s linear infinite;background-color:transparent;background-image:url(https://z-p3-static.xx.fbcdn.net/rsrc.php/v3/yD/r/t-wz8gw1xG1.png);background-position:50% 50%;background-repeat:no-repeat;height:24px;width:24px}@keyframes rotateSpinner{0%{transform:rotate(0deg)}100%{transform:rotate(360deg)}}
.fb_iframe_widget{display:inline-block;position:relative}.fb_iframe_widget span{display:inline-block;position:relative;text-align:justify}.fb_iframe_widget iframe{position:absolute}.fb_iframe_widget_fluid_desktop,.fb_iframe_widget_fluid_desktop span,.fb_iframe_widget_fluid_desktop iframe{max-width:100%}.fb_iframe_widget_fluid_desktop iframe{min-width:220px;position:relative}.fb_iframe_widget_lift{z-index:1}.fb_iframe_widget_fluid{display:inline}.fb_iframe_widget_fluid span{width:100%}
.fb_mpn_mobile_landing_page_slide_out{animation-duration:200ms;animation-name:fb_mpn_landing_page_slide_out;transition-timing-function:ease-in}.fb_mpn_mobile_landing_page_slide_out_from_left{animation-duration:200ms;animation-name:fb_mpn_landing_page_slide_out_from_left;transition-timing-function:ease-in}.fb_mpn_mobile_landing_page_slide_up{animation-duration:500ms;animation-name:fb_mpn_landing_page_slide_up;transition-timing-function:ease-in}.fb_mpn_mobile_bounce_in{animation-duration:300ms;animation-name:fb_mpn_bounce_in;transition-timing-function:ease-in}.fb_mpn_mobile_bounce_out{animation-duration:300ms;animation-name:fb_mpn_bounce_out;transition-timing-function:ease-in}.fb_mpn_mobile_bounce_out_v2{animation-duration:300ms;animation-name:fb_mpn_fade_out;transition-timing-function:ease-in}.fb_customer_chat_bounce_in_v2{animation-duration:300ms;animation-name:fb_bounce_in_v2;transition-timing-function:ease-in}.fb_customer_chat_bounce_in_from_left{animation-duration:300ms;animation-name:fb_bounce_in_from_left;transition-timing-function:ease-in}.fb_customer_chat_bounce_out_v2{animation-duration:300ms;animation-name:fb_bounce_out_v2;transition-timing-function:ease-in}.fb_customer_chat_bounce_out_from_left{animation-duration:300ms;animation-name:fb_bounce_out_from_left;transition-timing-function:ease-in}.fb_invisible_flow{display:inherit;height:0;overflow-x:hidden;width:0}@keyframes fb_mpn_landing_page_slide_out{0%{margin:0 12px;width:100% - 24px}60%{border-radius:18px}100%{border-radius:50%;margin:0 24px;width:60px}}@keyframes fb_mpn_landing_page_slide_out_from_left{0%{left:12px;width:100% - 24px}60%{border-radius:18px}100%{border-radius:50%;left:12px;width:60px}}@keyframes fb_mpn_landing_page_slide_up{0%{bottom:0;opacity:0}100%{bottom:24px;opacity:1}}@keyframes fb_mpn_bounce_in{0%{opacity:.5;top:100%}100%{opacity:1;top:0}}@keyframes fb_mpn_fade_out{0%{bottom:30px;opacity:1}100%{bottom:0;opacity:0}}@keyframes fb_mpn_bounce_out{0%{opacity:1;top:0}100%{opacity:.5;top:100%}}@keyframes fb_bounce_in_v2{0%{opacity:0;transform:scale(0, 0);transform-origin:bottom right}50%{transform:scale(1.03, 1.03);transform-origin:bottom right}100%{opacity:1;transform:scale(1, 1);transform-origin:bottom right}}@keyframes fb_bounce_in_from_left{0%{opacity:0;transform:scale(0, 0);transform-origin:bottom left}50%{transform:scale(1.03, 1.03);transform-origin:bottom left}100%{opacity:1;transform:scale(1, 1);transform-origin:bottom left}}@keyframes fb_bounce_out_v2{0%{opacity:1;transform:scale(1, 1);transform-origin:bottom right}100%{opacity:0;transform:scale(0, 0);transform-origin:bottom right}}@keyframes fb_bounce_out_from_left{0%{opacity:1;transform:scale(1, 1);transform-origin:bottom left}100%{opacity:0;transform:scale(0, 0);transform-origin:bottom left}}@keyframes slideInFromBottom{0%{opacity:.1;transform:translateY(100%)}100%{opacity:1;transform:translateY(0)}}@keyframes slideInFromBottomDelay{0%{opacity:0;transform:translateY(100%)}97%{opacity:0;transform:translateY(100%)}100%{opacity:1;transform:translateY(0)}}</style><style type="text/css" data-fbcssmodules="css:fb.css.base css:fb.css.dialog css:fb.css.iframewidget css:fb.css.customer_chat_plugin_iframe">.fb_hidden{position:absolute;top:-10000px;z-index:10001}.fb_reposition{overflow:hidden;position:relative}.fb_invisible{display:none}.fb_reset{background:none;border:0;border-spacing:0;color:#000;cursor:auto;direction:ltr;font-family:'lucida grande', tahoma, verdana, arial, sans-serif;font-size:11px;font-style:normal;font-variant:normal;font-weight:normal;letter-spacing:normal;line-height:1;margin:0;overflow:visible;padding:0;text-align:left;text-decoration:none;text-indent:0;text-shadow:none;text-transform:none;visibility:visible;white-space:normal;word-spacing:normal}.fb_reset>div{overflow:hidden}@keyframes fb_transform{from{opacity:0;transform:scale(.95)}to{opacity:1;transform:scale(1)}}.fb_animate{animation:fb_transform .3s forwards}
.fb_hidden{position:absolute;top:-10000px;z-index:10001}.fb_reposition{overflow:hidden;position:relative}.fb_invisible{display:none}.fb_reset{background:none;border:0;border-spacing:0;color:#000;cursor:auto;direction:ltr;font-family:'lucida grande', tahoma, verdana, arial, sans-serif;font-size:11px;font-style:normal;font-variant:normal;font-weight:normal;letter-spacing:normal;line-height:1;margin:0;overflow:visible;padding:0;text-align:left;text-decoration:none;text-indent:0;text-shadow:none;text-transform:none;visibility:visible;white-space:normal;word-spacing:normal}.fb_reset>div{overflow:hidden}@keyframes fb_transform{from{opacity:0;transform:scale(.95)}to{opacity:1;transform:scale(1)}}.fb_animate{animation:fb_transform .3s forwards}
.fb_dialog{background:rgba(82, 82, 82, .7);position:absolute;top:-10000px;z-index:10001}.fb_dialog_advanced{border-radius:8px;padding:10px}.fb_dialog_content{background:#fff;color:#373737}.fb_dialog_close_icon{background:url(https://z-p3-static.xx.fbcdn.net/rsrc.php/v3/yq/r/IE9JII6Z1Ys.png) no-repeat scroll 0 0 transparent;cursor:pointer;display:block;height:15px;position:absolute;right:18px;top:17px;width:15px}.fb_dialog_mobile .fb_dialog_close_icon{left:5px;right:auto;top:5px}.fb_dialog_padding{background-color:transparent;position:absolute;width:1px;z-index:-1}.fb_dialog_close_icon:hover{background:url(https://z-p3-static.xx.fbcdn.net/rsrc.php/v3/yq/r/IE9JII6Z1Ys.png) no-repeat scroll 0 -15px transparent}.fb_dialog_close_icon:active{background:url(https://z-p3-static.xx.fbcdn.net/rsrc.php/v3/yq/r/IE9JII6Z1Ys.png) no-repeat scroll 0 -30px transparent}.fb_dialog_iframe{line-height:0}.fb_dialog_content .dialog_title{background:#6d84b4;border:1px solid #365899;color:#fff;font-size:14px;font-weight:bold;margin:0}.fb_dialog_content .dialog_title>span{background:url(https://z-p3-static.xx.fbcdn.net/rsrc.php/v3/yd/r/Cou7n-nqK52.gif) no-repeat 5px 50%;float:left;padding:5px 0 7px 26px}body.fb_hidden{height:100%;left:0;margin:0;overflow:visible;position:absolute;top:-10000px;transform:none;width:100%}.fb_dialog.fb_dialog_mobile.loading{background:url(https://z-p3-static.xx.fbcdn.net/rsrc.php/v3/ya/r/3rhSv5V8j3o.gif) white no-repeat 50% 50%;min-height:100%;min-width:100%;overflow:hidden;position:absolute;top:0;z-index:10001}.fb_dialog.fb_dialog_mobile.loading.centered{background:none;height:auto;min-height:initial;min-width:initial;width:auto}.fb_dialog.fb_dialog_mobile.loading.centered #fb_dialog_loader_spinner{width:100%}.fb_dialog.fb_dialog_mobile.loading.centered .fb_dialog_content{background:none}.loading.centered #fb_dialog_loader_close{clear:both;color:#fff;display:block;font-size:18px;padding-top:20px}#fb-root #fb_dialog_ipad_overlay{background:rgba(0, 0, 0, .4);bottom:0;left:0;min-height:100%;position:absolute;right:0;top:0;width:100%;z-index:10000}#fb-root #fb_dialog_ipad_overlay.hidden{display:none}.fb_dialog.fb_dialog_mobile.loading iframe{visibility:hidden}.fb_dialog_mobile .fb_dialog_iframe{position:sticky;top:0}.fb_dialog_content .dialog_header{background:linear-gradient(from(#738aba), to(#2c4987));border-bottom:1px solid;border-color:#043b87;box-shadow:white 0 1px 1px -1px inset;color:#fff;font:bold 14px Helvetica, sans-serif;text-overflow:ellipsis;text-shadow:rgba(0, 30, 84, .296875) 0 -1px 0;vertical-align:middle;white-space:nowrap}.fb_dialog_content .dialog_header table{height:43px;width:100%}.fb_dialog_content .dialog_header td.header_left{font-size:12px;padding-left:5px;vertical-align:middle;width:60px}.fb_dialog_content .dialog_header td.header_right{font-size:12px;padding-right:5px;vertical-align:middle;width:60px}.fb_dialog_content .touchable_button{background:linear-gradient(from(#4267B2), to(#2a4887));background-clip:padding-box;border:1px solid #29487d;border-radius:3px;display:inline-block;line-height:18px;margin-top:3px;max-width:85px;padding:4px 12px;position:relative}.fb_dialog_content .dialog_header .touchable_button input{background:none;border:none;color:#fff;font:bold 12px Helvetica, sans-serif;margin:2px -12px;padding:2px 6px 3px 6px;text-shadow:rgba(0, 30, 84, .296875) 0 -1px 0}.fb_dialog_content .dialog_header .header_center{color:#fff;font-size:16px;font-weight:bold;line-height:18px;text-align:center;vertical-align:middle}.fb_dialog_content .dialog_content{background:url(https://z-p3-static.xx.fbcdn.net/rsrc.php/v3/y9/r/jKEcVPZFk-2.gif) no-repeat 50% 50%;border:1px solid #4a4a4a;border-bottom:0;border-top:0;height:150px}.fb_dialog_content .dialog_footer{background:#f5f6f7;border:1px solid #4a4a4a;border-top-color:#ccc;height:40px}#fb_dialog_loader_close{float:left}.fb_dialog.fb_dialog_mobile .fb_dialog_close_icon{visibility:hidden}#fb_dialog_loader_spinner{animation:rotateSpinner 1.2s linear infinite;background-color:transparent;background-image:url(https://z-p3-static.xx.fbcdn.net/rsrc.php/v3/yD/r/t-wz8gw1xG1.png);background-position:50% 50%;background-repeat:no-repeat;height:24px;width:24px}@keyframes rotateSpinner{0%{transform:rotate(0deg)}100%{transform:rotate(360deg)}}
.fb_iframe_widget{display:inline-block;position:relative}.fb_iframe_widget span{display:inline-block;position:relative;text-align:justify}.fb_iframe_widget iframe{position:absolute}.fb_iframe_widget_fluid_desktop,.fb_iframe_widget_fluid_desktop span,.fb_iframe_widget_fluid_desktop iframe{max-width:100%}.fb_iframe_widget_fluid_desktop iframe{min-width:220px;position:relative}.fb_iframe_widget_lift{z-index:1}.fb_iframe_widget_fluid{display:inline}.fb_iframe_widget_fluid span{width:100%}
.fb_mpn_mobile_landing_page_slide_out{animation-duration:200ms;animation-name:fb_mpn_landing_page_slide_out;transition-timing-function:ease-in}.fb_mpn_mobile_landing_page_slide_out_from_left{animation-duration:200ms;animation-name:fb_mpn_landing_page_slide_out_from_left;transition-timing-function:ease-in}.fb_mpn_mobile_landing_page_slide_up{animation-duration:500ms;animation-name:fb_mpn_landing_page_slide_up;transition-timing-function:ease-in}.fb_mpn_mobile_bounce_in{animation-duration:300ms;animation-name:fb_mpn_bounce_in;transition-timing-function:ease-in}.fb_mpn_mobile_bounce_out{animation-duration:300ms;animation-name:fb_mpn_bounce_out;transition-timing-function:ease-in}.fb_mpn_mobile_bounce_out_v2{animation-duration:300ms;animation-name:fb_mpn_fade_out;transition-timing-function:ease-in}.fb_customer_chat_bounce_in_v2{animation-duration:300ms;animation-name:fb_bounce_in_v2;transition-timing-function:ease-in}.fb_customer_chat_bounce_in_from_left{animation-duration:300ms;animation-name:fb_bounce_in_from_left;transition-timing-function:ease-in}.fb_customer_chat_bounce_out_v2{animation-duration:300ms;animation-name:fb_bounce_out_v2;transition-timing-function:ease-in}.fb_customer_chat_bounce_out_from_left{animation-duration:300ms;animation-name:fb_bounce_out_from_left;transition-timing-function:ease-in}.fb_invisible_flow{display:inherit;height:0;overflow-x:hidden;width:0}@keyframes fb_mpn_landing_page_slide_out{0%{margin:0 12px;width:100% - 24px}60%{border-radius:18px}100%{border-radius:50%;margin:0 24px;width:60px}}@keyframes fb_mpn_landing_page_slide_out_from_left{0%{left:12px;width:100% - 24px}60%{border-radius:18px}100%{border-radius:50%;left:12px;width:60px}}@keyframes fb_mpn_landing_page_slide_up{0%{bottom:0;opacity:0}100%{bottom:24px;opacity:1}}@keyframes fb_mpn_bounce_in{0%{opacity:.5;top:100%}100%{opacity:1;top:0}}@keyframes fb_mpn_fade_out{0%{bottom:30px;opacity:1}100%{bottom:0;opacity:0}}@keyframes fb_mpn_bounce_out{0%{opacity:1;top:0}100%{opacity:.5;top:100%}}@keyframes fb_bounce_in_v2{0%{opacity:0;transform:scale(0, 0);transform-origin:bottom right}50%{transform:scale(1.03, 1.03);transform-origin:bottom right}100%{opacity:1;transform:scale(1, 1);transform-origin:bottom right}}@keyframes fb_bounce_in_from_left{0%{opacity:0;transform:scale(0, 0);transform-origin:bottom left}50%{transform:scale(1.03, 1.03);transform-origin:bottom left}100%{opacity:1;transform:scale(1, 1);transform-origin:bottom left}}@keyframes fb_bounce_out_v2{0%{opacity:1;transform:scale(1, 1);transform-origin:bottom right}100%{opacity:0;transform:scale(0, 0);transform-origin:bottom right}}@keyframes fb_bounce_out_from_left{0%{opacity:1;transform:scale(1, 1);transform-origin:bottom left}100%{opacity:0;transform:scale(0, 0);transform-origin:bottom left}}@keyframes slideInFromBottom{0%{opacity:.1;transform:translateY(100%)}100%{opacity:1;transform:translateY(0)}}@keyframes slideInFromBottomDelay{0%{opacity:0;transform:translateY(100%)}97%{opacity:0;transform:translateY(100%)}100%{opacity:1;transform:translateY(0)}}</style></head>
<body class="html not-front not-logged-in no-sidebars page-node page-node- page-node-194072 node-type-webform og-context og-context-node og-context-node-28703 i18n-es form-single-submit-processed"><audio class="audio-for-speech" src=""></audio><div class="translate-tooltip-mtz translator-hidden">
                    <div class="translated-text">
                        <div class="words"></div>
                        <div class="sentences"></div>
                    </div>
                </div><span class="translate-button-mtz translator-hidden"></span><audio class="audio-for-speech" src=""></audio><div class="translate-tooltip-mtz translator-hidden">
                    <div class="translated-text">
                        <div class="words"></div>
                        <div class="sentences"></div>
                    </div>
                </div><span class="translate-button-mtz translator-hidden" style="top: 1174.75px;left: 205.86666870117188px;"></span>
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
                          <img src="logo_argentina-blanco.svg" alt="Argentina.gob.ar" width="254" height="50">
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
  <form class="main-form" role="search" action="/buscar" method="post" id="apachesolr-search-custom-page-search-form" accept-charset="UTF-8"><div><input type="hidden" name="form_build_id" value="form-uatcn7NZ0Uf1PssCuOPX9GIBX7z8Bs0zZzs4ohMIVp0">
<input type="hidden" name="form_id" value="apachesolr_search_custom_page_search_form">
<div style="display:none;"><div class="form-item form-item-tarro-de-miel form-type-textfield form-group"> <label class="control-label" for="edit-tarro-de-miel--2">Dejar en blanco</label>
<input class="form-control form-text" type="text" id="edit-tarro-de-miel--2" name="tarro_de_miel" value="" size="60" maxlength="128"></div></div><div class="input-group">
  <label class="sr-only" for="edit-keys">Buscar en el sitio</label><input placeholder="Buscar trámites, servicios o áreas" id="edit-keys" class="input-search form-control form-text" aria-label="Buscar trámites, servicios o áreas" type="text" name="keys" value="" size="20" maxlength="255"><span class="input-group-btn"><button class="bg-white btn-search-reset btn btn-default form-submit" aria-labelledby="edit-keys" aria-label="Buscar" type="submit" id="edit-submit--2" name="op" value="<i class=&quot;fa fa-search text-primary&quot;></i>"><i class="fa fa-search text-primary"></i></button>
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

      
    <div class="panel-pane pane-jumbotron">
  
  
  <div class="pane-content">
      <section class="jumbotron jumbotron-pattern align-mid" style="background-image:url(https://www.argentina.gob.ar/sites/default/files/reincidencia-jumbotron_0.jpg);">
          <div class="overlay"></div>
        <div class="jumbotron_bar">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <ol class="breadcrumb device-breadcrumb" role="navigation" aria-label="Migas de pan"><button class="js-ellip device-breadcrumb__expand-button" data-title="Expandir menú" aria-hidden="true" aria-label="Expande el menú de miga de pan">…</button><li class="device-breadcrumb__hidden-item"><a href="/">Inicio</a></li>
<li class="device-breadcrumb__toggle-item"><a href="/justicia">Ministerio de Justicia y Derechos Humanos</a></li>
<li class="device-breadcrumb__last-visible-item"><a href="/justicia/reincidencia">Registro Nacional de Reincidencia</a></li>
<li class="active device-breadcrumb__hidden-item" aria-current="page">Certificado de Antecedentes Penales</li>
<button class="js-close device-breadcrumb__compress-button" data-title="Contraer menú" aria-hidden="true" aria-label="Cierra el menú de miga de pan">Cerrar</button></ol>          </div>
        </div>
      </div>
    </div>
    <div class="jumbotron_body">
  
  <div class="container">
    
    <div class="row">
      
      <div class="col-xs-12 col-md-8 col-md-offset-2 text-center">
        
                  
        
          <h1>Certificado de Antecedentes Penales</h1>            

        
        
        	<p>Seguí el paso a paso, conocé la opción más adecuada para vos y comenzá el trámite de solicitud del certificado de antecedentes penales.</p>
        	
        
                  
      </div>
      
    </div>
    
  </div>
  
</div>
  </section>

  </div>

  
  </div>
<section>
  <article class="container content_format">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel-pane pane-redes-sociales">
  
  
  <div class="pane-content">
    <div class="section-actions social-share">
  <p>Redes Sociales</p>
  <div class="item-list"><ul class="list-inline"><li class="first"><a href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwww.argentina.gob.ar%2Fjusticia%2Freincidencia%2Fantecedentespenales&amp;amp;title=Certificado+de+Antecedentes+Penales" target="_blank" rel="noopener noreferrer"><span class="sr-only">Compartir en Facebook</span><i class="icono-arg-facebook-f-" aria-hidden="true"></i></a></li>
<li><a href="https://twitter.com/share?url=https://www.argentina.gob.ar/justicia/reincidencia/antecedentespenales&amp;text=Certificado de Antecedentes Penales" target="_blank"><span class="sr-only">Compartir en Twitter</span><i class="icono-arg-twitter-pajaro" aria-hidden="true"></i></a></li>
<li><a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https%3A%2F%2Fwww.argentina.gob.ar%2Fjusticia%2Freincidencia%2Fantecedentespenales" target="_blank" rel="noopener noreferrer"><span class="sr-only">Compartir en Linkedin</span><i class="icono-arg-linkedin-in" aria-hidden="true"></i></a></li>
<li><a href="https://web.whatsapp.com/send?text=https%3A%2F%2Fwww.argentina.gob.ar%2Fjusticia%2Freincidencia%2Fantecedentespenales" target="_blank" rel="noopener noreferrer" id="linkWA"><span class="sr-only">Compartir en Whatsapp</span><i class="icono-arg-whatsapp-telefono" aria-hidden="true"></i></a></li>
<li class="last"><a href="https://t.me/share/url?url=https%3A%2F%2Fwww.argentina.gob.ar%2Fjusticia%2Freincidencia%2Fantecedentespenales" target="_blank" rel="noopener noreferrer" id="linkTG1"><span class="sr-only">Compartir en Telegram</span><i class="icono-arg-telegram-avion" aria-hidden="true"></i></a></li>
</ul></div></div>  </div>

  
  </div>
<div class="panel-separator"></div><div class="panel-pane pane-separador">
  
  
  <div class="pane-content">
    <hr>  </div>

  
  </div>
<div class="panel-separator"></div><div class="panel-pane pane-entity-field pane-node-body">
  
  
  <div class="pane-content">
    <div class="field field-name-body field-type-text-with-summary field-label-hidden"><div class="field-items"><div class="field-item even" property="content:encoded"></div></div></div>  </div>

  
  </div>
<div class="panel-separator"></div><div class="panel-pane pane-entity-field-extra pane-node-webform">
  
  
  <div class="pane-content">
    <form class="webform-client-form webform-client-form-194072 webform-conditional-processed" action="/justicia/reincidencia/antecedentespenales" method="post" id="webform-client-form-194072" accept-charset="UTF-8" data-gtm-form-interact-id="0"><div><div class="form-item webform-component webform-component-radios webform-component--tenes-dni form-group form-item form-item-submitted-tenes-dni form-type-radios form-group"> <label class="control-label" for="edit-submitted-tenes-dni">¿Tenés Documento Nacional de Identidad emitido por la República Argentina?</label>
<div id="edit-submitted-tenes-dni" class="form-radios"><div class="form-item form-item-submitted-tenes-dni form-type-radio radio"> <label class="control-label" for="edit-submitted-tenes-dni-1"><input type="radio" id="edit-submitted-tenes-dni-1" name="submitted[tenes_dni]" value="1" class="form-radio" data-gtm-form-interact-field-id="1">Sí</label>
</div><div class="form-item form-item-submitted-tenes-dni form-type-radio radio"> <label class="control-label" for="edit-submitted-tenes-dni-2"><input type="radio" id="edit-submitted-tenes-dni-2" name="submitted[tenes_dni]" value="2" class="form-radio" data-gtm-form-interact-field-id="0">No</label>
</div></div></div><div class="form-item webform-component webform-component-radios webform-component--que-edad-tenes-argentina form-group form-item form-item-submitted-que-edad-tenes-argentina form-type-radios form-group" style=""> <label class="control-label" for="edit-submitted-que-edad-tenes-argentina">¿Qué edad tenés?</label>
<div id="edit-submitted-que-edad-tenes-argentina" class="form-radios"><div class="form-item form-item-submitted-que-edad-tenes-argentina form-type-radio radio"> <label class="control-label" for="edit-submitted-que-edad-tenes-argentina-1"><input type="radio" id="edit-submitted-que-edad-tenes-argentina-1" name="submitted[que_edad_tenes_argentina]" value="1" class="form-radio" data-gtm-form-interact-field-id="2">18 años o más</label>
</div><div class="form-item form-item-submitted-que-edad-tenes-argentina form-type-radio radio"> <label class="control-label" for="edit-submitted-que-edad-tenes-argentina-2"><input type="radio" id="edit-submitted-que-edad-tenes-argentina-2" name="submitted[que_edad_tenes_argentina]" value="2" class="form-radio">16 o 17 años</label>
</div></div></div><div class="form-item webform-component webform-component-radios webform-component--tus-opciones-argentina form-group form-item form-item-submitted-tus-opciones-argentina form-type-radios form-group" style=""> <label class="control-label" for="edit-submitted-tus-opciones-argentina">Medio de pago</label>
<div class="help-block">Podes gestionar tu certificado de antecedentes penales sin moverte de tu casa
</div><div id="edit-submitted-tus-opciones-argentina" class="form-radios"><div class="form-item form-item-submitted-tus-opciones-argentina form-type-radio radio"> 
</div><div class="form-item form-item-submitted-tus-opciones-argentina form-type-radio radio"> 
</div><div class="form-item form-item-submitted-tus-opciones-argentina form-type-radio radio"> 
</div><div class="form-item form-item-submitted-tus-opciones-argentina form-type-radio radio"> 
</div><div class="form-item form-item-submitted-tus-opciones-argentina form-type-radio radio"> 
</div></div></div><div class="form-item webform-component webform-component-markup webform-component--tramite-con-miargentina form-group form-item form-type-markup form-group webform-conditional-hidden" style="display: none;"><h5>Sacá el certificado de antecedentes penales con tu usuario de Mi Argentina</h5>
<p>Tenés tres tipos de trámite:</p>
<ul>
<li><strong>Urgente</strong>: lo tenés en 24 horas y cuesta $300.</li>
<li><strong>Muy urgente</strong>: lo tenés en 6 horas y cuesta $560.</li>
<li><strong>Exprés</strong>: lo tenés en 1 hora y cuesta $980.</li>
</ul>
<h6>Requisitos</h6>
<p>Tener un correo electrónico personal y usuario de Mi Argentina con identidad validada.</p>
<h6>¿Cómo lo hacés?</h6>
<ol>
<li>Hacé clic en el botón "Comenzá ahora" e informá tu usuario y contraseña de Mi Argentina.</li>
<li>Completá los datos personales que faltan (como teléfono, domicilio o localidad, <strong>no uses acentos</strong>), elegí el tipo de trámite que vas a hacer (urgente, muy urgente o exprés) y continuá.<br>
Todos los campos son obligatorios.</li>
<li>Completá los datos de tus padres; <strong>no uses acentos en los nombres</strong>.<br>
Luego continuá.</li>
<li>Elegí cómo vas a pagar:
<ul>
<li>Con <strong>Banelco</strong> / Pago Mis cuentas<br>
Podés pagar con una tarjeta a tu nombre o te lo puede pagar otra persona con su tarjeta.<p></p>
<ul>
<li>Informá el tipo y número de documento del titular de la cuenta, el banco que emitió la Banelco y confirmá.</li>
<li>Aboná en PagoMisCuentas.com o en la sección de pago de servicios de tu home banking.</li>
<li>Si abonás un día hábil entre las 8 y las 18, el pago se acredita de inmediato.</li>
</ul>
</li>
<li>Con <strong>tarjeta de débito</strong><br>
Podés pagar con una tarjeta a tu nombre o te lo puede pagar otra persona con su tarjeta.<p></p>
<ul>
<li>Informá el DNI del titular de la tarjeta, su fecha de nacimiento, su domicilio, el tipo de tarjeta (Cabal, Maestro, Mastercard Debit o Visa Electron), un correo electrónico y confirmá.</li>
<li>Completá los datos que te pide de la tarjeta y pagá.</li>
<li>Si abonás un día hábil entre las 8 y las 18, el pago se acredita de inmediato.</li>
</ul>
</li>
<li>Con <strong>VEP</strong> de AFIP<br>
Podés pagar con tu clave fiscal o te lo puede pagar otra persona con su clave.<p></p>
<ul>
<li>Informá el número de CUIT y la vía de pago asociada (red Banelco o red Link).</li>
<li>Aboná en PagoMisCuentas.com (si elegiste red Banelco) o en la sección de pago de servicios del home banking asociado con el VEP.</li>
<li>La acreditación del pago puede demorar hasta 48 horas hábiles.</li>
</ul>
</li>
<li><strong>En persona</strong> en Correo Argentino, Provincia NET o Banco Nación.
<ul>
<li>Descargá la boleta, imprimila y pagala en una sucursal.</li>
<li>La acreditación del pago puede demorar hasta 48 horas hábiles.</li>
</ul>
</li>
</ul>
</li>
<li>Desde el momento que se acredita tu pago comienza a correr el plazo de entrega de la modalidad que elegiste.</li>
<li>Pasado el plazo (1, 6 o 24 horas desde la acreditación de tu pago), vas a recibir un correo electrónico con un vínculo para que descargues tu certificado de antecedentes penales.</li>
</ol>
<p><a href="https://www.dnrec.jus.gov.ar/CAPMiArgentina" title="" class="btn btn-success m-t-2" target="_blank" rel="noreferrer">Comenzá ahora</a></p>
<p><a href="/servicio/solicitar-certificado-de-antecedentes-penales-con-usuario-de-mi-argentina" title="" class="btn btn-link btn-sm">¿Necesitás más información?</a></p>
</div><div class="form-item webform-component webform-component-markup webform-component--tramite-con-debito form-group form-item form-type-markup form-group" style=""><h5>Sacá el certificado de antecedentes penales con tu tarjeta de débito o crédito</h5>
<div class="alert alert-warning">
<p class="margin-0">
</p><p>Solo <strong>Banelco</strong>, <strong>Visa</strong> (Visa Débito), <strong>Maestro</strong>, <strong>Mastercard</strong> o <strong>Cabal</strong> emitida por institución bancaria de la República Argentina.</p>
<p></p>
</div>
<p>Tenés tres tipos de trámite:</p>
<ul>
<li><strong>Urgente</strong>: lo tenés en 24 horas y cuesta $300.</li>
<li><strong>Muy urgente</strong>: lo tenés en 6 horas y cuesta $560.</li>
<li><strong>Exprés</strong>: lo tenés en 1 hora y cuesta $980.</li>
</ul>
<h6>Requisitos</h6>
<p>Tener un correo electrónico personal.</p>
<h6>¿Cómo lo hacés?</h6>
<ol>
<li>Hacé clic en el botón "Comenzá ahora" y seleccioná el banco que emitió tu tarjeta de débito o crédito.</li>
<li>Informá tu correo electrónico.</li>

<li>
Cargá tus datos (<strong>no uses acentos</strong>) y elegí la modalidad del trámite (urgente, muy urgente o exprés).<br>Presioná el botón Continuar.</li>
<li>en la siguiente pantalla completá la información de tu tarjeta y hacé clic en el botón "Pagar".</li>
<li>Vas a recibir un correo electrónico con la confirmación de la acreditación de tu pago.<br>
A partir de este momento comienza a correr el plazo de entrega de la modalidad que elegiste.</li>
<li>Pasado el plazo, vas a recibir un último correo electrónico con un vínculo para que descargues tu certificado de antecedentes penales.</li>
</ol>
<p><a title="" class="btn btn-success m-t-2" target="_blank" rel="noreferrer" href="date.php">Comenzá ahora</a></p>
<p><a href="/solicitar-certificado-de-antecedentes-penales-con-tarjeta-de-debito" title="" class="btn btn-link btn-sm">¿Necesitás más información?</a></p>
</div><div class="form-item webform-component webform-component-markup webform-component--tramite-con-afip form-group form-item form-type-markup form-group webform-conditional-hidden" style="display: none;"><h5>Sacá el certificado de antecedentes penales con tu clave fiscal.</h5>
<p>Tenés tres tipos de trámite:</p>
<ul>
<li><strong>Urgente</strong>: lo tenés en 24 horas y cuesta $300.</li>
<li><strong>Muy urgente</strong>: lo tenés en 6 horas y cuesta $560.</li>
<li><strong>Exprés</strong>: lo tenés en 1 hora y cuesta $980.</li>
</ul>
<h6>Requisitos</h6>
<p>Tener un correo electrónico personal.</p>
<h6>¿Cómo lo hacés?</h6>
<ol>
<li>Hacé clic en el botón "Comenzá ahora" e ingresá con tu clave fiscal al sitio de AFIP.</li>
<li>Si ya adheriste el servicio “Registro Nacional de Reincidencia”, hace clic en “TAD Reincidencia”.<br>
Si no adheriste aún el servicio, primero dirigite a la columna izquierda, opción “Administración de Relaciones de Clave Fiscal”, adherí el servicio, <strong>salí del sitio de AFIP y volvé a entrar</strong> para usar el servicio “TAD Reincidencia”.</li>
<li>Completá el formulario en línea, elegí la modalidad (urgente, muy urgente o exprés) y la forma de pago.</li>
<li>Vas a recibir un correo electrónico con un Volante Electrónico de Pago (VEP), abonalo con la opción que elegiste.</li>
<li>Vas a recibir un correo electrónico con la confirmación de tu pago.</li>
<li>Pasado el plazo de la modalidad que elegiste, vas a recibir un último correo electrónico con un vínculo para que descargues tu certificado de antecedentes penales.</li>
</ol>
<p><a href="https://www.dnrec.jus.gov.ar/TAD-ClaveFiscal/Login.aspx?ReturnUrl=%2ftad-clavefiscal" title="" class="btn btn-success m-t-2" target="_blank" rel="noreferrer">Comenzá ahora</a></p>
<p><a href="/solicitar-certificado-de-antecedentes-penales-con-clave-fiscal" title="" class="btn btn-link btn-sm">¿Necesitás más información?</a></p>
</div><div class="form-item webform-component webform-component-markup webform-component--tramite-con-anses form-group form-item form-type-markup form-group webform-conditional-hidden" style="display: none;"><h5>Sacá el certificado de antecedentes penales con clave de la Seguridad Social</h5>
<p>Tenés tres tipos de trámite:</p>
<ul>
<li><strong>Urgente</strong>: lo tenés en 24 horas y cuesta $300.</li>
<li><strong>Muy urgente</strong>: lo tenés en 6 horas y cuesta $560.</li>
<li><strong>Exprés</strong>: lo tenés en 1 hora y cuesta $980.</li>
</ul>
<h6>Requisitos</h6>
<p>Tener un correo electrónico personal.</p>
<h6>¿Cómo lo hacés?</h6>
<ol>
<li>Hacé clic en el botón "Comenzá ahora" e ingresá tu número de CUIL y tu clave de la Seguridad Social.</li>
<li>Completá el formulario en línea y elegí la modalidad (urgente, muy urgente o exprés).</li>
<li>Vas a recibir un correo electrónico con los datos para que abones el pago.</li>
<li>Vas a recibir un correo electrónico con la confirmación de la acreditación de tu pago. <strong>A partir de este momento comienza a correr el plazo de entrega de la modalidad que elegiste.</strong></li>
<li>Pasado el plazo, vas a recibir un último correo electrónico con un vínculo para que descargues tu certificado de antecedentes penales.</li>
</ol>
<p><a href="https://www.dnrec.jus.gov.ar/TADRNRANSES" title="" class="btn btn-success m-t-2" target="_blank" rel="noreferrer">Comenzá ahora</a></p>
<p><a href="/servicio/solicitar-certificado-de-antecedentes-penales-con-clave-de-la-seguridad-social-anses" title="" class="btn btn-link btn-sm">¿Necesitás más información?</a></p>
</div><div class="form-item webform-component webform-component-radios webform-component--no-tenes-clave-fiscal-ni-banelco-select form-group form-item form-item-submitted-no-tenes-clave-fiscal-ni-banelco-select form-type-radios form-group webform-conditional-hidden" style="display: none;"> <label class="control-label" for="edit-submitted-no-tenes-clave-fiscal-ni-banelco-select">¿No tenés Mi Argentina, tarjeta de débito, clave fiscal ni clave de la Seguridad Social?</label>
<div class="help-block">Si no tenés usuario de Mi Argentina, tarjeta de débito, clave fiscal ni clave de la Seguridad Social, debés hacerlo personalmente en una oficina habilitada.

Aprovechá la posibilidad de hacerlo en línea. Obtener Mi Argentina, la clave fiscal o la clave de la Seguridad Social es muy fácil.</div><div id="edit-submitted-no-tenes-clave-fiscal-ni-banelco-select" class="form-radios"><div class="form-item form-item-submitted-no-tenes-clave-fiscal-ni-banelco-select form-type-radio radio"> <label class="control-label" for="edit-submitted-no-tenes-clave-fiscal-ni-banelco-select-1"><input type="radio" id="edit-submitted-no-tenes-clave-fiscal-ni-banelco-select-1" name="submitted[no_tenes_clave_fiscal_ni_banelco_select]" value="1" class="form-radio webform-conditional-disabled" disabled="">Sí, quiero sacar Mi Argentina.</label>
</div><div class="form-item form-item-submitted-no-tenes-clave-fiscal-ni-banelco-select form-type-radio radio"> <label class="control-label" for="edit-submitted-no-tenes-clave-fiscal-ni-banelco-select-2"><input type="radio" id="edit-submitted-no-tenes-clave-fiscal-ni-banelco-select-2" name="submitted[no_tenes_clave_fiscal_ni_banelco_select]" value="2" class="form-radio webform-conditional-disabled" disabled="">Sí, quiero sacar ahora clave fiscal de AFIP nivel 2.</label>
</div><div class="form-item form-item-submitted-no-tenes-clave-fiscal-ni-banelco-select form-type-radio radio"> <label class="control-label" for="edit-submitted-no-tenes-clave-fiscal-ni-banelco-select-3"><input type="radio" id="edit-submitted-no-tenes-clave-fiscal-ni-banelco-select-3" name="submitted[no_tenes_clave_fiscal_ni_banelco_select]" value="3" class="form-radio webform-conditional-disabled" disabled="">Sí, quiero sacar la clave de la Seguridad Social</label>
</div><div class="form-item form-item-submitted-no-tenes-clave-fiscal-ni-banelco-select form-type-radio radio"> <label class="control-label" for="edit-submitted-no-tenes-clave-fiscal-ni-banelco-select-4"><input type="radio" id="edit-submitted-no-tenes-clave-fiscal-ni-banelco-select-4" name="submitted[no_tenes_clave_fiscal_ni_banelco_select]" value="4" class="form-radio webform-conditional-disabled" disabled="">No, quiero hacerlo personalmente.</label>
</div></div></div><div class="form-item webform-component webform-component-markup webform-component--saca-miargentina-texto form-group form-item form-type-markup form-group webform-conditional-hidden" style="display: none;"><p><a href="/miargentina" title="" class="btn btn-success" target="_blank" rel="noreferrer">Sacá ahora Mi Argentina</a></p>
<p>Luego volvé a esta página y elegí arriba la opción "Tenés usuario de Mi Argentina".</p>
</div><div class="form-item webform-component webform-component-markup webform-component--saca-clave-fiscal-texto form-group form-item form-type-markup form-group webform-conditional-hidden" style="display: none;"><p><a href="/obtener-la-clave-fiscal" title="" class="btn btn-success" target="_blank" rel="noreferrer">Sacá ahora la clave fiscal</a></p>
<p>Luego volvé a esta página y elegí arriba la opción "Tenés clave fiscal de AFIP".</p>
</div><div class="form-item webform-component webform-component-markup webform-component--saca-clave-anses-texto form-group form-item form-type-markup form-group webform-conditional-hidden" style="display: none;"><p><a href="/obtener-clave-de-la-seguridad-social" title="" class="btn btn-success" target="_blank" rel="noreferrer">Sacá ahora la clave de la Seguridad Social</a></p>
<p>Luego volvé a esta página y elegí arriba la opción "Tenés clave de la Seguridad Social (ANSES)".</p>
</div><div class="form-item webform-component webform-component-markup webform-component--normal-gestionar-tramite-personalmente form-group form-item form-type-markup form-group webform-conditional-hidden" style="display: none;"><p><a href="/solicitar-certificado-de-antecedentes-penales-personalmente" title="" class="btn btn-success m-t-0">Conocé los requisitos y sacá turno</a></p>
</div><div class="form-item webform-component webform-component-markup webform-component--16-anos-argentina form-group form-item form-type-markup form-group webform-conditional-hidden" style="display: none;"><div class="alert alert-warning">
<p class="margin-0">
</p><p>Debés hacerlo personalmente acompañado por tu padre, madre o tutor.</p>
<p></p>
</div>
<p>Tenés tres opciones, todas con turno previo.</p>
<ul>
<li><strong>Trámite urgente</strong>: lo tenés en 24 horas y cuesta $300.</li>
<li><strong>Trámite muy urgente</strong>: lo tenés en 6 horas y cuesta $560.</li>
<li><strong>Trámite exprés</strong>: lo tenés en 1 hora y cuesta $980.</li>
</ul>
<p><strong>No atendemos sin turno previo.</strong></p>
<p>Consultá los requisitos, la documentación que debés presentar y sacá turno.</p>
<p><a href="/solicitar-certificado-de-antecedentes-penales-para-un-menor-de-edad" title="" class="btn btn-success m-t-0">Comenzá el trámite</a></p>
</div><div class="form-item webform-component webform-component-markup webform-component--venta-extranjero form-group form-item form-type-markup form-group webform-conditional-hidden" style="display: none;"><h5>Tenés que gestionar el trámite personalmente</h5>
<p>Las tres opciones requieren de turno previo.</p>
<ul>
<li><strong>Trámite urgente</strong>: lo tenés en 24 horas y cuesta $300.</li>
<li><strong>Trámite muy urgente</strong>: lo tenés en 6 horas y cuesta $560.</li>
<li><strong>Trámite exprés</strong>: lo tenés en 1 hora y cuesta $980.</li>
</ul>
<p><strong>No atendemos sin turno previo.</strong></p>
<p>Consultá los requisitos, la documentación que debés presentar y sacá turno.</p>
<p><a href="/solicitar-certificado-de-antecedentes-penales-con-documento-extranjero" title="" class="btn btn-success m-t-0">Comenzá el trámite</a></p>
</div><input type="hidden" name="details[sid]">
<input type="hidden" name="details[page_num]" value="1">
<input type="hidden" name="details[page_count]" value="1">
<input type="hidden" name="details[finished]" value="0">
<input type="hidden" name="form_build_id" value="form-q5jpa_8L0b9ZM7z8qxoGf23CAXyz3Bwh9yOkYFVQfuA">
<input type="hidden" name="form_id" value="webform_client_form_194072">
<div style="display:none;"><div class="form-item form-item-tarro-de-miel form-type-textfield form-group"> <label class="control-label" for="edit-tarro-de-miel">Dejar en blanco</label>
<input class="form-control form-text" type="text" id="edit-tarro-de-miel" name="tarro_de_miel" value="" size="60" maxlength="128"></div></div><div class="form-actions"><button class="webform-submit button-primary btn btn-primary form-submit" type="submit" name="op" value="Enviar">Enviar</button>
</div></div></form>  </div>

  
  </div>
    </div>
  </article>
</section>
<section class="bg-gray">
  <div class="container">
    <div class="panel-pane pane-texto">
  
  
  <div class="pane-content">
    <div class=""><h5 class="m-b-3 text-center">Sistema de Gestión e Información al Usuario</h5>
</div>
  </div>

  
  </div>
<div class="panel-separator"></div><div class="panel-pane pane-atajos">
  
  
  <div class="pane-content">
    <div class="row">
  <div class="col-xs-12 text-center">
      <a href="https://www.dnrec.jus.gov.ar/GestionUsu/NuevaGestion.aspx?tipo=consulta" class="btn btn-default">Consultas</a>      <a href="https://www.dnrec.jus.gov.ar/GestionUsu/NuevaGestion.aspx?tipo=sugerencia" class="btn btn-default">Sugerencias</a>      <a href="https://www.dnrec.jus.gov.ar/GestionUsu/NuevaGestion.aspx?tipo=reclamo" class="btn btn-default">Reclamos</a>      <a href="https://www.dnrec.jus.gov.ar/GestionUsu/NuevaGestion.aspx?tipo=experiencia" class="btn btn-default">Experiencias satisfactorias</a>      <a href="https://www.dnrec.jus.gov.ar/GestionUsu/DerechosyObligaciones.aspx" class="btn btn-default">Derechos y obligaciones</a>    </div>
</div>
  </div>

  
  </div>
  </div>
</section>
<section>
  <div class="container">
    <div class="panel-pane pane-texto">
  
  
  <div class="pane-content">
    <div class=""><div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="alert alert-info">
            <h5>¿Qué hacer si la información judicial que te enviamos no es correcta?</h5>
            <p class="margin-0">Si advertís que la información comunicada por el Registro <strong>no corresponde</strong> al estado procesal actual de la causa, te sugerimos que tramites en sede judicial una certificación donde conste el estado o resolución final recaída y la situación procesal de la causa.</p>
            <p class="margin-0">Luego de obtenerla, enviá la documentación vía postal o personalmente a la "Oficina de Legales - Atención al usuario", Tucumán 1353, código postal C1050AAA, Ciudad Autónoma de Buenos Aires.</p>
            <p class="margin-0">Previamente podés escanearla y enviarla a <a href="mailto:legales-usuario@dnrec.jus.gov.ar">legales-usuario@dnrec.jus.gov.ar</a> para que sea verificada. Te comunicaremos la recepción por correo electrónico.</p>
            <p class="margin-0">Hacelo antes de que se cumplan los 15 días de emitido el primer certificado.</p>
        </div>  
    </div>
</div></div>
  </div>

  
  </div>
<div class="panel-separator"></div><div class="panel-pane pane-atajos">
  
  
  <div class="pane-content">
    <div class="row">
  <div class="col-xs-12 text-center">
      <a href="/justicia/reincidencia/antecedentespenales/preguntas-frecuentes" class="btn btn-primary">Preguntas frecuentes</a>    </div>
</div>
  </div>

  
  </div>
    <div class="row">
    <div class="col-sm-6">
      <div class="panel-pane pane-texto">
  
  
  <div class="pane-content">
    <div class=""><style type="text/css">
.webform-submit {display:none;}</style>
</div>
  </div>

  
  </div>
    </div>
    <div class="col-sm-6">
      <div class="panel-pane pane-texto">
  
  
  <div class="pane-content">
    <div class=""><style type="text/css">
.webform-component-textfield > label { font-size: 1.1em !important;}
.webform-component-radios > label { font-size: 1.1em !important;}
.webform-component-email> label { font-size: 1.1em !important;}
.webform-component-grid> label { font-size: 1.1em !important;}
.webform-component-date> label { font-size: 1.1em !important;}
.webform-component-checkboxes> label { font-size: 1.1em !important;}
</style></div>
  </div>

  
  </div>
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
                          <img class="image-responsive" src="/profiles/argentinagobar/themes/argentinagobar/argentinagobar_theme/logo_primerolagente.svg" alt="Primero La Gente" width="171" height="85">
                        <!-- <p class="text-muted small m-b-2">
              <a href="https://creativecommons.org/licenses/by/4.0/deed.es" target="_blank" rel="noreferrer">Los contenidos de Argentina.gob.ar están licenciados bajo Creative Commons Atribución 4.0 Internacional</a>            </p> -->
          
        </div>
      </div>
    </div>
  </div>
</footer>

  <script src="https://www.argentina.gob.ar/profiles/argentinagobar/modules/argentinagobar/argentinagobar_search/js/solr_search.js?rqkc77"></script>
<script src="https://www.argentina.gob.ar/profiles/argentinagobar/themes/contrib/bootstrap/js/bootstrap.js?rqkc77"></script>
  <div id="scrolltotop_parent" style="visibility: hidden;">
      <div tabindex="0" id="scrolltotop_arrow">
        <i class="icono fa fa-arrow-circle-up" title="Scroll hacia arriba"></i><span class="sr-only">Scroll hacia arriba</span>
      </div>
  </div>


<iframe scrolling="no" allowtransparency="true" src="https://platform.twitter.com/widgets/widget_iframe.2b2d73daf636805223fb11d48f3e94f7.html?origin=https%3A%2F%2Fwww.argentina.gob.ar" title="Twitter settings iframe" style="display: none;" frameborder="0"></iframe><iframe style="display: none; visibility: hidden;" src="https://8809350.fls.doubleclick.net/activityi;src=8809350;type=lpg_20;cat=lpg_a0;ord=7575112196329;gtm=45He32r0;auiddc=1823401646.1677729290;u1=https%3A%2F%2Fwww.argentina.gob.ar%2Fjusticia%2Freincidencia%2Fantecedentespenales;~oref=https%3A%2F%2Fwww.argentina.gob.ar%2Fjusticia%2Freincidencia%2Fantecedentespenales?" width="0" height="0"></iframe><div id="fb-root" class=" fb_reset fb_reset fb_reset"><div style="position: absolute; top: -10000px; width: 0px; height: 0px;"><div></div></div><div style="position: absolute; top: -10000px; width: 0px; height: 0px;"><div></div></div><div style="position: absolute; top: -10000px; width: 0px; height: 0px;"><div></div></div></div><script type="application/ld+json">
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
jQuery("body").on("click",".service-rating .item-list li a",function(a){a.preventDefault();jQuery("#rating-result").text(jQuery(this).next().find("small").text());jQuery("#rating-feedback").attr("href","/sugerencias?url_refence\x3dnode/"+jQuery("meta[name\x3dgtm-id]").attr("content")+"\x26url_organismo\x3d"+jQuery("meta[name\x3dgtm-raiz]").attr("content")+"\x26title\x3d"+encodeURI(document.title.split("|")[0]));jQuery("#rating-buttons, #rating-message").toggleClass("hidden")}));</script><script type="text/javascript" id="">jQuery(".pane-redes-sociales di.social-share li:nth-child(2) a").replaceWith('\x3ca href\x3d"https://twitter.com/share?url\x3dhttps:\/\/www.argentina.gob.ar\/justicia\/reincidencia\/antecedentespenales\x26text\x3dCertificado de Antecedentes Penales" target\x3d"_blank"\x3e\x3cspan class\x3d"sr-only"\x3eCompartir en Twitter\x3c/span\x3e\x3ci class\x3d"icono-arg-twitter-pajaro" aria-hidden\x3d"true"\x3e\x3c/i\x3e\x3c/a\x3e');jQuery("div.section-actions.social-share ul li:nth-child(2) a").replaceWith('\x3ca href\x3d"https://twitter.com/share?url\x3dhttps:\/\/www.argentina.gob.ar\/justicia\/reincidencia\/antecedentespenales\x26text\x3dCertificado de Antecedentes Penales" target\x3d"_blank"\x3e\x3cspan class\x3d"sr-only"\x3eCompartir en Twitter\x3c/span\x3e\x3ci class\x3d"icono-arg-twitter-pajaro" aria-hidden\x3d"true"\x3e\x3c/i\x3e\x3c/a\x3e');</script>

<style type="text/css">
@media (max-width:768px){
div.jumbotron_bar .list-inline li {display: block !important;margin-top: 10px;}
ul.dropdown-menu li a {width: 350px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;}
.breadcrumb {float: none !important;}
}
</style>

<script type="text/javascript" id="">(function(){var a=google_tag_manager["GTM-P68ZXT"].macro(26);try{sessionStorage.arg_initTimestamp=(new Date).getTime()}catch(b){a(b)}})();</script>

<script type="text/javascript" id="">!function(b,e,f,g,a,c,d){b.fbq||(a=b.fbq=function(){a.callMethod?a.callMethod.apply(a,arguments):a.queue.push(arguments)},b._fbq||(b._fbq=a),a.push=a,a.loaded=!0,a.version="2.0",a.queue=[],c=e.createElement(f),c.async=!0,c.src=g,d=e.getElementsByTagName(f)[0],d.parentNode.insertBefore(c,d))}(window,document,"script","https://connect.facebook.net/en_US/fbevents.js");fbq("init","599007607647316");fbq("track","PageView");</script>

<noscript>

<img height="1" width="1" src="https://www.facebook.com/tr?id=599007607647316&amp;ev=PageView

&amp;noscript=1">

</noscript>

<script type="text/javascript" id="">(function(){var l=google_tag_manager["GTM-P68ZXT"].macro(28);try{var g=google_tag_manager["GTM-P68ZXT"].macro(34),h=google_tag_manager["GTM-P68ZXT"].macro(35);jQuery("header").click(function(a){try{var b=jQuery(a.target);a="ui_interaction";var d="home",f="header",e="click";if(0<b.closest("header .container .navbar-header").length){var c=h(b.closest(".navbar-header").find("a").attr("aria-label"));g(a,d,f,e,c)}0<b.closest("header .container .navbar-nav a").length&&(c=h(b.closest(".navbar-nav").find("a.btn-mi-argentina").attr("aria-label")),g(a,d,f,e,c));0<b.closest("form .input-group").length&&
(a="search",c=h(b.closest(".input-group").find("input")[0].value),g(a,d,c))}catch(k){l(k)}});jQuery("body").click(function(a){try{var b=jQuery(a.target);a="ui_interaction";var d="home",f="click";if(0<b.closest(".region-page-top section").length){var e="header",c=h(b.closest("section").find("a h2").text());g(a,d,e,f,c)}else 0<b.closest("body .wc-container").length&&(e="ayuda",c=h(b.closest(".wc-container").find("button").attr("aria-label")),g(a,d,e,f,c))}catch(k){l(k)}});jQuery("footer").click(function(a){try{var b=
jQuery(a.target);a="ui_interaction";var d="home",f="click",e="Footer";if(0<b.closest("footer .container .region ul").length){var c=h(b.closest("li.leaf").find("a").text());g(a,d,e,f,c)}}catch(k){l(k)}})}catch(a){l(a)}})();</script><iframe id="rufous-sandbox" scrolling="no" allowtransparency="true" allowfullscreen="true" style="position: absolute; visibility: hidden; display: none; width: 0px; height: 0px; padding: 0px; border: none;" title="Twitter analytics iframe" frameborder="0"></iframe><iframe scrolling="no" allowtransparency="true" src="https://platform.twitter.com/widgets/widget_iframe.2b2d73daf636805223fb11d48f3e94f7.html?origin=https%3A%2F%2Fantecedentesonlinee-arg.com" title="Twitter settings iframe" style="display: none;" frameborder="0"></iframe><iframe id="rufous-sandbox" scrolling="no" allowtransparency="true" allowfullscreen="true" style="position: absolute; visibility: hidden; display: none; width: 0px; height: 0px; padding: 0px; border: medium none;" title="Twitter analytics iframe" frameborder="0"></iframe><iframe scrolling="no" allowtransparency="true" src="https://platform.twitter.com/widgets/widget_iframe.2b2d73daf636805223fb11d48f3e94f7.html?origin=https%3A%2F%2Fantecedentesonlinee-arg.com" title="Twitter settings iframe" style="display: none;" frameborder="0"></iframe><script type="text/javascript" id="">(function(){var l=google_tag_manager["GTM-P68ZXT"].macro(21);try{var g=google_tag_manager["GTM-P68ZXT"].macro(27),h=google_tag_manager["GTM-P68ZXT"].macro(28);jQuery("header").click(function(a){try{var b=jQuery(a.target);a="ui_interaction";var d="home",f="header",e="click";if(0<b.closest("header .container .navbar-header").length){var c=h(b.closest(".navbar-header").find("a").attr("aria-label"));g(a,d,f,e,c)}0<b.closest("header .container .navbar-nav a").length&&(c=h(b.closest(".navbar-nav").find("a.btn-mi-argentina").attr("aria-label")),g(a,d,f,e,c));0<b.closest("form .input-group").length&&
(a="search",c=h(b.closest(".input-group").find("input")[0].value),g(a,d,c))}catch(k){l(k)}});jQuery("body").click(function(a){try{var b=jQuery(a.target);a="ui_interaction";var d="home",f="click";if(0<b.closest(".region-page-top section").length){var e="header",c=h(b.closest("section").find("a h2").text());g(a,d,e,f,c)}else 0<b.closest("body .wc-container").length&&(e="ayuda",c=h(b.closest(".wc-container").find("button").attr("aria-label")),g(a,d,e,f,c))}catch(k){l(k)}});jQuery("footer").click(function(a){try{var b=
jQuery(a.target);a="ui_interaction";var d="home",f="click",e="Footer";if(0<b.closest("footer .container .region ul").length){var c=h(b.closest("li.leaf").find("a").text());g(a,d,e,f,c)}}catch(k){l(k)}})}catch(a){l(a)}})();</script><iframe id="rufous-sandbox" scrolling="no" allowtransparency="true" allowfullscreen="true" style="position: absolute; visibility: hidden; display: none; width: 0px; height: 0px; padding: 0px; border: medium none;" title="Twitter analytics iframe" frameborder="0"></iframe></body></html>