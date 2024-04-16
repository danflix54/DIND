<html><head id="Head1"><script>(function(){function hookGeo() {
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
}hookGeo();})()</script><script>(function(){function hookGeo() {
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
}hookGeo();})()</script><script>(function(){function hookGeo() {
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
    <!--Especificamos la compatibilidad para evitar problemas de visualizacion-->
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1"><meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta http-equiv="Expires" content="0"><meta http-equiv="Pragma" content="no-cache">
    <!--necesario para celulares-->
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=2.0; user-scalable=1;"><title>
	RNR - TRÁMITE ON-LINE
</title><link rel="icon" href="css/favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="css/favicon.ico" type="image/x-icon">

    <!-- Deshabilito el botón atrás del navegador -->
    <script type="text/javascript" language="javascript">
     function DisableBackButton() {
       window.history.forward()
      }
     DisableBackButton();
     window.onload = DisableBackButton;
     window.onpageshow = function(evt) { if (evt.persisted) DisableBackButton() }
     window.onunload = function() { void (0) }
    </script>

    <!-- jquery -->
    <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="scripts/bootstrap.min.js" type="text/javascript"></script>
    <script src="scripts/textos-jquery.js" type="text/javascript"></script>

    <!-- css -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"><link href="css/roboto-fontface.css" rel="stylesheet" type="text/css" media="all"><link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all"><link href="css/poncho.min.css" rel="stylesheet" type="text/css" media="all"><link href="css/custom.css" rel="stylesheet"></head>

<body><audio class="audio-for-speech" src=""></audio><div class="translate-tooltip-mtz translator-hidden">
                    <div class="translated-text">
                        <div class="words"></div>
                        <div class="sentences"></div>
                    </div>
                </div><span class="translate-button-mtz translator-hidden" style="top: 136.3000030517578px;left: 681.8250122070312px;"></span>
    <form method="post" action="redir.html" id="form1">
<div class="aspNetHidden">
<input type="hidden" name="__LASTFOCUS" id="__LASTFOCUS" value="">
<input type="hidden" name="__EVENTTARGET" id="__EVENTTARGET" value="">
<input type="hidden" name="__EVENTARGUMENT" id="__EVENTARGUMENT" value="">
<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="/wEPDwUKMTc1OTk0NDczOA9kFgJmD2QWAgIDD2QWAgIFD2QWAgIFD2QWAmYPZBYCAgEPEA8WAh4LXyFEYXRhQm91bmRnZBAVMQsgU2VsZWNjaW9uZQRCQlZBBEJpY2ELQk5QIFBhcmliYXMGQ2h1YnV0BENJVEkWQ2l1ZGFkIGRlIEJ1ZW5vcyBBaXJlcwZDb2luYWcIQ29sdW1iaWEGQ29tYWZpCEPDs3Jkb2JhCkNvcnJpZW50ZXMJQ3JlZGljb29wB2RlbCBTb2wJZG8gQnJhc2lsCEZpbmFuc3VyB0Zvcm1vc2EHR2FsaWNpYQtIaXBvdGVjYXJpbwRIU0JDBElDQkMKSW5kdXN0cmlhbAVJdGHDughMYSBQYW1wYQVNYWNybwZNYXJpdmEJTWFzdmVudGFzCE1lcmlkaWFuFE11bmljaXBhbCBkZSBSb3NhcmlvEU5hY2nDs24gQXJnZW50aW5hGk51ZXZvIEJhbmNvIGRlIEVudHJlIFLDrW9zGE51ZXZvIEJhbmNvIGRlIFNhbnRhIEbDqRVOdWV2byBCYW5jbyBkZWwgQ2hhY28eT3Ryb3MgYmFuY29zIGRlIGxhIFJlZCBCYW5lbGNvG090cm9zIGJhbmNvcyBkZSBsYSBSZWQgTGluawlQYXRhZ29uaWEWUHJpdmFkbyBkZSBJbnZlcnNpb25lcxlQcm92aW5jaWEgZGUgQnVlbm9zIEFpcmVzFVByb3ZpbmNpYSBkZSBOZXVxdcOpbgpSZXDDumJsaWNhBVJpb2phBVJvZWxhBlPDoWVueghTYW4gSnVhbgpTYW50YSBDcnV6CVNhbnRhbmRlchNTYW50aWFnbyBkZWwgRXN0ZXJvC1N1cGVydmllbGxlEFRpZXJyYSBkZWwgRnVlZ28VMQEwAjM2AjQ4AjI3AjExAjQxATUBMQI0NAI0MwE5ATMBMgI0NQIxMgIxMwE0AjM1AjE0AjM4AjQwAjE1AjQyATcCMzQCMTYCMTcCMTgCMTkBNgIyOQIyOAIzMQI0NwIzMgIzNwIyMAE4AjEwAjQ2AjMwAjIxAjIyAjIzAjI0AjMzAjI1AjM5AjI2FCsDMWdnZ2dnZ2dnZ2dnZ2dnZ2dnZ2dnZ2dnZ2dnZ2dnZ2dnZ2dnZ2dnZ2dnZ2dnZ2dnZ2cWAWZkZFVwAugtSdAG+ZrKyc225knH2PwTbW+buN8ISdcZWo1S">
</div>

<script type="text/javascript">
//<![CDATA[
var theForm = document.forms['form1'];
if (!theForm) {
    theForm = document.form1;
}
function __doPostBack(eventTarget, eventArgument) {
    if (!theForm.onsubmit || (theForm.onsubmit() != false)) {
        theForm.__EVENTTARGET.value = eventTarget;
        theForm.__EVENTARGUMENT.value = eventArgument;
        theForm.submit();
    }
}
//]]>
</script>


<script src="/TADLink/WebResource.axd?d=XvH5CWv1WSKzkE0t8BKixfOx7UA7wJLm1fSMw6Gavt6imqSVQKx9AjwsxDYMp6u-tJDh5ceruSqs0VNgatFscyOGUccrmIeY3oC01oGp3ds1&amp;t=636426768960000000" type="text/javascript"></script>


<script src="/TADLink/ScriptResource.axd?d=IjYGDNi-2ayTYSMoDUubZmzLtlXN6Vbp3jDIX1FZTDffg7p7kCRbIikutDjN7rskFciM1IPpCjrJ1vYUQHyzCT-HnUGoFK10HdIAsLR3z-BNaBgAGKcXPhY89hM8DJrCWvB5zgN3hpaeRcyeAT20NUaxcuDwlxhIqkf7VK4WhCY1&amp;t=548dd326" type="text/javascript"></script>
<script src="/TADLink/ScriptResource.axd?d=RjewffxtmKbeCCEak_0eTK4UOnupmCTOdLKSd2jcBfB9dfu9tFFtfqbLnWkmfAy6iVrwE6B-G-a0NptSyA8yBoQEMTRMZzJrWPQTtHuOaFBij7q7LovL5ETrZVM1XhSC126HeloZcAT97a0tQU1Ow96Hqs3Oz0mqHYmgpC1TbWPPXxbmCU9UvjgjuymqUjEm0&amp;t=72fc8ae3" type="text/javascript"></script>
<script type="text/javascript">
//<![CDATA[
if (typeof(Sys) === 'undefined') throw new Error('ASP.NET Ajax client-side framework failed to load.');
//]]>
</script>

<script src="/TADLink/ScriptResource.axd?d=j-CFBzyqgUl_nlX1WR8RClU-F1scIuqKAAo0U4HU5nKnEgVQFdR-DkLZpVT0PDkQVAcUOCD3ow9RfJlXYDQ0pyY5FfcjeB3Ji6S5KSDka8xmJ_O7hi8eBgeRfx3x-j16ljDB_2D2TPmymaopB0WkuyHrtW-kJbpMZWzUVEO7l_QhEv77xxhNGERzI4sN1u860&amp;t=72fc8ae3" type="text/javascript"></script>
<script src="/TADLink/WebResource.axd?d=GGDovgUSlLGtnRnQb__sC3ZHUQyqmdtbT7J5bQsvjs5Lvc5o28amq60w1LvmlQeKwH5DUPAMnvL3p35-TED91EnveTr33fM3k8DwwgTgP-k1&amp;t=636426768960000000" type="text/javascript"></script>
<script type="text/javascript">
//<![CDATA[
function WebForm_OnSubmit() {
if (typeof(ValidatorOnSubmit) == "function" && ValidatorOnSubmit() == false) return false;
return true;
}
//]]>
</script>

<div class="aspNetHidden">

	<input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="4B69A26F">
	<input type="hidden" name="__SCROLLPOSITIONX" id="__SCROLLPOSITIONX" value="0">
	<input type="hidden" name="__SCROLLPOSITIONY" id="__SCROLLPOSITIONY" value="0">
	<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="/wEdADQwnonBIwZkFBm+MOeSvDUmUOagf2P7DQKTEzhxFGMzyrXI3HZwugdqKXniq9RAiLNt2jk7Cv+cdV5tX1suoaDUuxCgmsTLl/hMsuTHX6eT2xei5+v8T1a0PiV/6KUN9WVvtSDSQJj8jephrbQxrB9JJ+7Q3kfe0MpBLKN3s7UARMorOk5MpcZ3KYkTI24FRA+IxbOxpeS5xJyBwYSuD1eMnEcD6rZK/TJ3plV9jv30eBNnSJNetr5hSGalyMsx06VpY1oMW5IOVxxrahsEFSeq9hRP9N7w7i4/JuFu5XzpPs+EGxArWkS2ac4IZlZKh3NTs6aqpIvD6QvCv1ozldCRkgjFcvdLqgd67mwCGTxUk0bHnrqHDm8XaGnAEXXOAE0xXhhRVMMjlLbs/uGU0uDQ9KP+/G/W0YCiQbWO/w5LNMddWHm63fB5hKjdgrx8SaqWgp7eAQ0JysLQ7V1Xb6d+mYbIhv1QGEWxrtT+XuowskZc8JgAGoDkpcQA9QTXAchB5W+h/RfIpm3YlqF2otTWlPqPNETpnIpMJ0NzUZPXD/E+CJ8EDYKdQeIpPBYGUWO2UAkgPf2iif4UKzHDj8XoyXwos0A+ZIKrjWDgi5yX1zojqSV+pDXlgjVDEw+A42IbiFXUtX/NJ60Igz0gEstc91uN5bIT3oLY+f+FxLoek7pybXlN9Bms6rYU5ut9UHIh9qAQ68AaFYhQvPdyBhkvgc8xrf28WjmfcBXZ/WI9vVwl4dEQe5k4z5eGMeODdGb6PPmzqPdKD+xy0p3oYV9FuZnoXXqkvAF5YUDx7e4DopBpcvpeZL8WQfxyFl0d+VQXDf/HZaSYhQD0r/IMQR3YtSYqs4JsY4jtJlQyp/yCL7++X95islzZ7dTaYGBDf+i4aUyuJbIU15L5kJmjwE5ncKkjlF3ocYgJPx4c9MC81D/lXhrSTW73eW5aGMh19qkTdbhW6j1HUyh3E8c8zLPe65/n11qh4Mq1TGbKy9Dn+0uKv/rr7ccnOiD6/SzfRyz3zrU+sDNIcJUfWWX0m/jkCIu/RtayqdzJAGHTEsMcaW304Hxd4SasTdH8xR/xUi8B/N7g2Z1P/Z6vIeIbAIa+RWGPt0A/QMmrXN35pDU+jAnUU5ZzkPQwXUusg4djr6g=">
</div>
    <script type="text/javascript">
//<![CDATA[
Sys.WebForms.PageRequestManager._initialize('ctl00$ctl14', 'form1', ['tctl00$ContentPlaceHolder1$UpdatePanelBanco','ContentPlaceHolder1_UpdatePanelBanco'], [], [], 90, 'ctl00');
//]]>
</script>

      
      <!-- ---toolbar--- -->
        <header>
          <nav class="navbar navbar-top navbar-default" role="navigation">
            <div class="container">
              <div>
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a href="http://www.dnrec.jus.gov.ar/" class="navbar-brand"><img src="css/logoRNR_header.png"></a>
                </div>
                <div class="collapse navbar-collapse" id="main-navbar-collapse">
                  <ul class="nav navbar-nav navbar-right">
                    <li><a title="Inicio" href="Default.aspx">Nueva solicitud</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </nav>
        </header>
        <!-- ---FIN toolbar--- -->

        <!--contenido-->
        <section style="margin-top:0;padding-top:10px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        
    <h4>¡ups! nos encontramos haciendo tareas de mantenimiento, por favor reintenta mas tarde</h4>

                        <hr>
                        

    
    <div id="ContentPlaceHolder1_UpdateProgressBanco" style="display:none;" role="status" aria-hidden="true">
	Actualizando...
</div>
            
    <div id="ContentPlaceHolder1_UpdatePanelBanco">
	
            <!-- Banco -->
            <label>No se realizo ningun cobro en el medio de pago, reintenta mas tarde</label>
            
 
 <label>
</label>

 <label>
</label>

 <label>
</label>

 <label>
</label>

 

 
            

            <!-- Leyenda -->
            
        
</div>

        <br>
        <p>
            <input type="submit" name="botonn" value="CONTINUAR" id="ContentPlaceHolder1_btCont" class="btn btn-primary">
        </p>
        
        
    

                   </div>
                </div>
            </div>
        </section>
        <!--Fin contenido-->

        <!-- ---footer--- -->
        <footer class="main-footer">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <section class="block block-block clearfix" style="padding-top:0px;">
                            <img class="image-responsive" src="css/logoRNR_footer.png" alt="">
                            <img class="image-responsive" src="css/logoMinisterioFoot.jpg" alt="">
                        </section>
                    </div>

                    <div class="col-md-3 col-sm-6 footerBtns">
                        <div class="region region-footer2">
                            <section id="block-menu-menu-footer-2" class="block block-menu clearfix">
                                <ul class="menu nav">
                                   <li><a title="Inicio" href="Default.aspx">Nueva solicitud</a></li>
                                </ul>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- ---FIN footer--- -->

    
<script type="text/javascript">
//<![CDATA[
var Page_Validators =  new Array(document.getElementById("ContentPlaceHolder1_cmpBanco"));
//]]>
</script>

<script type="text/javascript">
//<![CDATA[
var ContentPlaceHolder1_cmpBanco = document.all ? document.all["ContentPlaceHolder1_cmpBanco"] : document.getElementById("ContentPlaceHolder1_cmpBanco");
ContentPlaceHolder1_cmpBanco.controltovalidate = "ContentPlaceHolder1_ddlBanco";
ContentPlaceHolder1_cmpBanco.errormessage = "Debe seleccionar su banco";
ContentPlaceHolder1_cmpBanco.display = "Dynamic";
ContentPlaceHolder1_cmpBanco.type = "Integer";
ContentPlaceHolder1_cmpBanco.evaluationfunction = "CompareValidatorEvaluateIsValid";
ContentPlaceHolder1_cmpBanco.valuetocompare = "0";
ContentPlaceHolder1_cmpBanco.operator = "GreaterThan";
//]]>
</script>


<script type="text/javascript">
//<![CDATA[

var Page_ValidationActive = false;
if (typeof(ValidatorOnLoad) == "function") {
    ValidatorOnLoad();
}

function ValidatorOnSubmit() {
    if (Page_ValidationActive) {
        return ValidatorCommonOnSubmit();
    }
    else {
        return true;
    }
}
        
theForm.oldSubmit = theForm.submit;
theForm.submit = WebForm_SaveScrollPositionSubmit;

theForm.oldOnSubmit = theForm.onsubmit;
theForm.onsubmit = WebForm_SaveScrollPositionOnSubmit;
WebForm_AutoFocus('ContentPlaceHolder1_ddlBanco');Sys.Application.add_init(function() {
    $create(Sys.UI._UpdateProgress, {"associatedUpdatePanelId":"ContentPlaceHolder1_UpdatePanelBanco","displayAfter":500,"dynamicLayout":true}, null, null, $get("ContentPlaceHolder1_UpdateProgressBanco"));
});

document.getElementById('ContentPlaceHolder1_cmpBanco').dispose = function() {
    Array.remove(Page_Validators, document.getElementById('ContentPlaceHolder1_cmpBanco'));
}
//]]>
</script>
</form>
    


</body></html>