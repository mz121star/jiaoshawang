!function(t,e){function n(){var n="-",r=i.encode,o=t.screen,a=t.navigator,s=this._getViewport();this.screen=o?o.width+"x"+o.height:n,this.viewport=s.width+"x"+s.height,this.charset=r(e.characterSet?e.characterSet:e.charset?e.charset:n),this.language=(a&&a.language?a.language:a&&a.browserLanguage?a.browserLanguage:n).toLowerCase(),this.javaEnabled=a&&a.javaEnabled()?1:0,this.isFirstVisit=!1,this.setCookie()}function r(t){this.url=t}function o(t){this._config=i.merge({sampleRate:100,useCombo:!0,beacon:e.location.protocol+"//frep.meituan.net/_.gif"},t||{}),this._client=new n,this._beacon=new r(this._config.beacon),this._queue=[],this._timer=null,this._app=null,this._tags={},this.visitorCode=i.random()}!function(){"use strict";function e(t){return"object"==typeof t&&void 0!==t.length}var n="undefined"==typeof exports?t:exports;n.TransformPerf={compress:function(t){function e(t){var e=a.exec(t);return{protocol:e[1],host:e[2],paths:e[3].split("/").filter(function(t){return t.length})}}function r(t,e){var n,r;for(t[e.protocol]=t[e.protocol]||{},n=t[e.protocol][e.host]=t[e.protocol][e.host]||{};e.paths.length;)r=e.paths.shift(),n=n[r]=n[r]||{};return n}function o(t,e){t.$$||(t.$$=[]);var n={};t.$$.push(n),n.timings=[];for(var r in i)n.timings[r]=Math.round(e[i[r]]);for(var o in e)"name"===o||~i.indexOf(o)||(n[o]=e[o]);return n}for(var a=new RegExp("^([^:]+)://([^/]+)(.+)$"),i=n.TransformPerf.timings,s={},c=0;c<t.length;c++)o(r(s,e(t[c].name)),t[c]);return s},uncompress:function(t){function r(t){var e=t[0]+"://";return e+=t.slice(1).join("/")}function o(t,n,i){var s,c;for(var u in n)if("$$"===u&&e(n.$$))for(var f=0;f<n.$$.length;f++)s={},s.name=r(i),a(n.$$[f],s),t.push(s);else c=i.slice(),c.push(u),o(t,n[u],c);return t}function a(t,e){for(var n in i)e[i[n]]=t.timings[n];delete t.timings;for(var r in t)e[r]=t[r];return e}var i=n.TransformPerf.timings;return o([],t,[])},getTimingNames:function(){return n.TransformPerf.timings},timings:["startTime","redirectStart","redirectEnd","fetchStart","domainLookupStart","domainLookupEnd","connectStart","secureConnectionStart","connectEnd","requestStart","responseStart","responseEnd","duration"]}}();var a=Object.prototype.hasOwnProperty,i={hash:function(t){var e,n=1,r=0;if(t)for(n=0,e=t.length-1;e>=0;e--)r=t.charCodeAt(e),n=(n<<6&268435455)+r+(r<<14),r=266338304&n,n=0!==r?n^r>>21:n;return n},keyPaths:function(t,e){function n(t){return o.length>=10?void e(o.concat(),t):t instanceof Object?void r(t).forEach(function(e){o.push(e),n(t[e]),o.pop()}):void e(o.concat(),t)}var r=Object.keys||function(t){var e=[];for(var n in t)a.call(t,n)&&e.push(n);return e},o=[];n(t)},whitelistify:function(t,e){var n=[];i.keyPaths(e,function(t){n.push(t.join("."))});var r="|"+n.join("|")+"|",o={};return i.keyPaths(t,function(t,e){if(-1!==r.indexOf("|"+t.join(".")+"|"))for(var n=o,a=0;a<t.length;a++)n[t[a]]||(n[t[a]]={}),a===t.length-1&&(n[t[a]]=e),n=n[t[a]]}),o},random:function(){return Math.round(2147483647*Math.random())},stringify:function(t){if("undefined"!=typeof JSON&&JSON.stringify)return JSON.stringify(t);var e=typeof t;switch(e){case"string":return'"'+t+'"';case"boolean":case"number":return String(t);case"object":if(null===t)return"null";var n=!1,r="";for(var o in t)if(a.call(t,o)){var s=""+o,c=i.stringify(t[o]);c.length&&(n?r+=",":n=!0,r+=t instanceof Array?c:'"'+s+'":'+c)}return t instanceof Array?"["+r+"]":"{"+r+"}";default:return""}},debug:function(t,e){"undefined"!=typeof console&&console.log&&(e&&console.warn?console.warn(t):console.log(t))},encode:function(t,e){return encodeURIComponent instanceof Function?e?encodeURI(t):encodeURIComponent(t):escape(t)},decode:function(t,e){var n;if(t=t.split("+").join(" "),decodeURIComponent instanceof Function)try{n=e?decodeURI(t):decodeURIComponent(t)}catch(r){n=unescape(t)}else n=unescape(t);return n},merge:function(t,e){for(var n in e)a.call(e,n)&&(t[n]=e[n]);return t},buildQueryString:function(t){var e,n=i.encode,r=[];for(e in t)if(a.call(t,e)){var o="object"==typeof t[e]?i.stringify(t[e]):t[e];r.push(n(e)+"="+n(o))}return r.join("&")},addEventListener:function(e,n,r){return t.addEventListener?t.addEventListener(e,n,r):t.attachEvent?t.attachEvent("on"+e,n):void 0},onload:function(t){"complete"===e.readyState?t():i.addEventListener("load",t,!1)},domready:function(t){"interactive"===e.readyState?t():e.addEventListener?e.addEventListener("DOMContentLoaded",t,!1):e.attachEvent&&e.attachEvent("onreadystatechange",t)},onunload:function(t){i.addEventListener("unload",t,!1),i.addEventListener("beforeunload",t,!1)},now:function(){return(new Date).getTime()},ajax:function(e){if(t.XMLHttpRequest&&"file:"!==t.location.protocol)try{var n=new XMLHttpRequest;if(n){var r=i.merge({method:"GET",async:!0},e);n.open(r.method,r.url,r.async),n.setRequestHeader("Content-type","application/json"),n.send(JSON.stringify(r.data))}}catch(o){}}},s={get:function(t){for(var n=e.cookie,r=t+"=",o=r.length,a=n.length,i=0;a>i;){var s=i+o;if(n.substring(i,s)===r)return this._getValue(s);if(i=n.indexOf(" ",i)+1,0===i)break}return""},set:function(t,n,r,o,a,i){a=a?a:this._getDomain(),e.cookie=t+"="+encodeURIComponent(n)+(r?"; expires="+r:"")+(o?"; path="+o:"; path=/")+(a?"; domain="+a:"")+(i?"; secure":"")},getExpire:function(t,e,n){var r=new Date;return"number"==typeof t&&"number"==typeof e&&"number"==typeof e?(r.setDate(r.getDate()+parseInt(t,10)),r.setHours(r.getHours()+parseInt(e,10)),r.setMinutes(r.getMinutes()+parseInt(n,10)),r.toGMTString()):void 0},_getValue:function(t){var n=e.cookie,r=n.indexOf(";",t);return-1===r&&(r=n.length),decodeURIComponent(n.substring(t,r))},_getDomain:function(){var t=e.domain;return"localhost"===t?"":("undefined"!=typeof M&&M.DOMAIN_HOST&&(t="."+M.DOMAIN_HOST),"www."===t.substring(0,4)&&(t=t.substring(4)),t)}},c="__mta";n.prototype={setCookie:function(){var t=s.get(c),e=s.getExpire(720,0,0),n=i.now();if(t)t=t.split("."),t[2]=t[3],t[3]=n,t[4]=parseInt(t[4],10)+1,s.set(c,t.join("."),e),this.uuid=t[0];else{var r=this._hashInfo(),o=n,a=n,u=n,f=1;t=[r,o,a,u,f].join("."),s.set(c,t,e),this.isFirstVisit=!0,this.uuid=r}},getInfo:function(){return{sr:this.screen,vp:this.viewport,csz:e.cookie?e.cookie.length:0,uuid:this.uuid}},_hashInfo:function(){var n=t.navigator,r=t.history.length;n=n.appName+n.version+this.language+n.platform+n.userAgent+this.javaEnabled+this.screen+(e.cookie?e.cookie:"")+(e.referrer?e.referrer:"");for(var o=n.length;r>0;)n+=r--^o++;return i.hash(n)},_getViewport:function(){return null!==t.innerWidth?{width:t.innerWidth,height:t.innerHeight}:"CSS1Compat"===e.compatMode?{width:e.documentElement.clientWidth,height:e.documentElement.clientHeight}:{width:e.body.clientWidth,height:e.body.clientWidth}}},r.MAX_URL_LENGTH=4096,r.prototype={config:function(t){this.url=t},send:function(t){t.version=o.VERSION;var e=i.buildQueryString(t);e.length&&(e.length<=r.MAX_URL_LENGTH?this._sendByScript(e):this.post(t))},post:function(t){i.ajax({url:this.url,method:"POST",data:t})},_sendByScript:function(t){var n=e.createElement("script");n.type="text/javascript",n.async=!0,n.src=this.url+"?"+t;var r=e.getElementsByTagName("script")[0];r.parentNode.insertBefore(n,r)}};var u=100;o.VERSION="0.2.2",o.Plugins={},o.addPlugin=function(t,e){if("function"!=typeof e.data)throw new Error("cannot add plugin: "+t);o.Plugins[t]=e},o.prototype={push:function(){for(var t=Array.prototype.slice,e=0,n=0,r=arguments.length;r>n;n++)try{var o=arguments[n];if("function"==typeof o)arguments[n](this);else{o=t.call(o,0);var a=o[0];this[a].apply(this,o.slice(1))}}catch(i){e++}return e},create:function(t,e){this._app=t,this._config=i.merge(this._config,e||{})},config:function(t,e){if(void 0!==e)switch(t){case"sampleRate":"number"==typeof e&&(this._config.sampleRate=e);break;case"beaconImage":this._beacon.config(this._config.beacon=e);break;case"useCombo":"boolean"==typeof e&&(this._config.useCombo=e)}},tag:function(t,e){"string"==typeof t&&t.length&&("undefined"!=typeof e?this._tags[t]=e:"undefined"!=typeof this._tags[t]&&delete this._tags[t])},send:function(e,n,r,a){if(e){var i=o.Plugins[e],s=!1;if(i)a=n,n=i.data(),n&&(s=!0,this._push({category:e,type:i.type||"timer",data:n},a));else if("number"==typeof n){var c={};c[e]=n,s=!0,this._push({type:r||"timer",data:c},a)}else"object"==typeof n&&(s=!0,this._push({category:e,type:r||"timer",data:n},a));if(s){var f=this;this._timer&&(t.clearTimeout(this._timer),this._timer=null),this._timer=t.setTimeout(function(){f._send.call(f,a)},u)}}},timing:function(t,e,n){this.send(t,e||1,"timer",n)},count:function(t,e,n){this.send(t,e||1,"counter",n)},gauge:function(t,e,n){this.send(t,e||1,"gauge",n)},_push:function(t,e){var n=i.merge,o=this._client.getInfo(),a=n({app:this._app,type:"combo"},t);a=n(a,this._tags),a=n(a,o),a.data=this._queue.concat(t),this._queue.push(t),i.buildQueryString(a).length>r.MAX_URL_LENGTH&&this._send(e)},_send:function(e){if(this._app&&this._isSample(e)){var n=i.merge,r=this._config.useCombo,o=this._client.getInfo(),a={app:this._app,type:"combo",url:t.location.href};if(a=n(a,this._tags),a=n(a,o),this._queue.length){if(r)1===this._queue.length?(a=n(a,this._queue[0]),this._beacon.send(a)):(a.data=this._queue,this._beacon.send(a));else for(var s=0,c=this._queue.length;c>s;s++)a=n(a,this._queue[s]),this._beacon.send(a);this._queue=[]}}},_isSample:function(t){return t=t>0?t:this._config.sampleRate,this.visitorCode%1e4<100*t}},o.addPlugin("cdn",{type:"timer",data:function(){if("object"==typeof M&&M.subresources&&M.subresources.names&&f){t.SubResoucesTiming=f;var e=M.subresources.lastImage||"",n=M.subresources.firstImage||"",r=new f(M.subresources.names,e,n);if(!r.length)return;for(var o={},a=0,i=r.length;i>a;a++){var s=r[a];if(s.server){o[s.server]={};for(var c in s)s.hasOwnProperty(c)&&parseInt(s[c],10)>0&&(o[s.server][c]=s[c])}}return o}}}),o.addPlugin("page",{type:"timer",data:function(){var e=t,n=e.performance||e.mozPerformance||e.msPerformance||e.webkitPerformance;if(n){var r=n.timing,o={redirect:r.fetchStart-r.navigationStart,dns:r.domainLookupEnd-r.domainLookupStart,connect:r.connectEnd-r.connectStart,network:r.connectEnd-r.navigationStart,send:r.responseStart-r.requestStart,receive:r.responseEnd-r.responseStart,backend:r.responseEnd-r.requestStart,domLoading:r.domLoading-r.navigationStart,render:r.loadEventEnd-r.loadEventStart,dom:r.domComplete-r.domLoading,frontend:r.loadEventEnd-r.domLoading,fs2rqs:r.requestStart-r.fetchStart,dcl2load:r.loadEventEnd-r.domContentLoadedEventStart,load:r.loadEventEnd-r.navigationStart,domReady:r.domContentLoadedEventStart-r.navigationStart,interactive:r.domInteractive-r.navigationStart,ttf:r.fetchStart-r.navigationStart,ttr:r.requestStart-r.navigationStart,ttdns:r.domainLookupStart-r.navigationStart,ttconnect:r.connectStart-r.navigationStart,ttfb:r.responseStart-r.navigationStart,s_ttfb:r.responseStart-r.requestStart,ttdcl:r.domContentLoadedEventStart-r.navigationStart,c_ttdcl:r.domContentLoadedEventStart-r.responseStart,c_ttl:r.loadEventEnd-r.responseStart};if("object"==typeof M&&M.subresources&&M.subresources.names&&"undefined"!=typeof t.SubResoucesTiming){var a=M.subresources.lastImage||"",i=M.subresources.firstImage||"",s=new t.SubResoucesTiming(M.subresources.names,a,i);s.length&&"fsImg"===s[s.length-1].id&&(o.atf=s[s.length-1].start,o.c_atf=s[s.length-1].start-(r.responseStart-r.navigationStart))}if(r.msFirstPaint&&(o.firstPaint=r.msFirstPaint),e.chrome&&e.chrome.loadTimes){var c=e.chrome.loadTimes();o.firstPaint=Math.round(1e3*(c.firstPaintTime-c.startLoadTime))}return"undefined"!=typeof M&&M.TimeTracker&&M.TimeTracker.fst&&(o.firstScreen=M.TimeTracker.fst-r.navigationStart),o}}}),o.addPlugin("page.module",{type:"timer",data:function(){function n(t){var n=[],r=e.getElementsByTagName("*");return Array.prototype.forEach.call(r,function(e){e.getAttribute(t)&&n.push(e)}),n}function r(t){if(t){var e=[],n=t.getElementsByTagName("img"),r={};return Array.prototype.forEach.call(n,function(t){var n=t.src;if(!n){var o=/^data/;if(!o.exec(n)&&1!==r[n]){r[n]=1;var a=s.getEntriesByName(n);a.forEach(function(t){Math.floor(t.responseEnd)<u&&e.push(t)})}}}),e}}function o(t){if(!t.length)return{time:0,idle:0};var e={},n={},r=[];t.forEach(function(t){var o=t.requestStart||t.startTime;e[o]=!0,n[t.responseEnd]=!0,r.push(o,t.responseEnd)}),r.sort(function(t,e){return t-e});var o=[],a=0,i=0,s=0,c=0,u=r[0];return r.forEach(function(t){if(c+=(t-u)*i,e[t]&&(o.push(t),i++),n[t]){var r=o.pop();i--,o.length||(a+=t-r)}s=Math.max(s,i),u=t}),{time:Math.round(a),idle:Math.round(u-a-r[0])}}function a(t){var e=o(r(t)),n={imageTime:e.time,imageIdle:e.idle,imageDuration:e.time+e.idle};return n}var i=t,s=i.performance||i.mozPerformance||i.msPerformance||i.webkitPerformance;if(s&&s.timing&&s.getEntries&&Object.keys&&Array.prototype.forEach&&Array.prototype.filter&&Array.prototype.reduce){var c=s.timing,u=c.loadEventEnd-c.navigationStart,f=n("data-page-module"),d={};return Array.prototype.forEach.call(f,function(t){var e=t.getAttribute("data-page-module");d[e]=a(t)}),d}}}),o.addPlugin("resource",{type:"timer",data:function(){if("object"==typeof M&&M.subresources&&M.subresources.names&&f){t.SubResoucesTiming=f;var e=M.subresources.lastImage||"",n=M.subresources.firstImage||"",r=new f(M.subresources.names,e,n);if(!r.length)return;for(var o={},a=0,i=r.length;i>a;a++){var s=r[a];if(s.id){o[s.id]={};for(var c in s)s.hasOwnProperty(c)&&parseInt(s[c],10)>0&&(o[s.id][c]=s[c])}}return o}}}),function(){var e={time:!0,idle:!0,count:!0,maxConcurrency:!0,offsetToStart:!0,offsetToEnd:!0,dns:!0,connect:!0,request:!0,caches:!0,response:!0},n={time:!0,count:!0,maxConcurrency:!0,offsetToStart:!0,offsetToEnd:!0},r={img:{load:{all:e,p0:e,p1:e,p2:e,p3:e},dcl:{all:n,p0:n,p1:n,p2:n,p3:n}},sprite:{load:{all:n},dcl:{all:n}},css:{load:{all:n},dcl:{all:n}},js:{load:{all:n},dcl:{all:n}},other:{onload:!0}};o.addPlugin("stats",{type:"timer",data:function(){function e(t){return function(e){return/meituan\.net/.test(e.name)&&t.test(e.name)}}function n(t){return Math.floor(t.responseEnd)<m}function o(t){return Math.floor(t.responseEnd)<y}function a(t){var e="http://".length,n="https://".length,r=t.length,o=t+".";return function(t){return t.name.substr(e,r+1)===o||t.name.substr(n,r+1)===o}}function s(t){return Math.abs(t-m)}function c(t){return Math.abs(t-v)}function u(t){var e={};return t.forEach(function(t){var n=t.name.match(/^https?:\/\/(.*?).meituan.net/),r=n&&n[1];r&&(e[r]=(e[r]||0)+1)}),e}function f(t){if(!t.length)return{};var e={},n={},r=[];t.forEach(function(t){var o=t.requestStart||t.startTime,a=t.responseEnd;5>a-o||(e[o]=!0,n[a]=!0,r.push(o,a))}),r.sort(function(t,e){return t-e});var o=[],a=0,i=0,u=0,f=0,d=r[0];return r.forEach(function(t){if(f+=(t-d)*i,e[t]&&(o.push(t),i++),n[t]){var r=o.pop();i--,o.length||(a+=t-r)}u=Math.max(u,i),d=t}),{time:Math.round(a),idle:Math.round(d-a-r[0]),offsetToStart:Math.round(r[0]),offsetToRPS:Math.round(c(r[0])),offsetToLoad:Math.round(s(d)),maxConcurrency:u,expConcurrency:a?+(f/a).toFixed(2):0}}function d(t,e){if(!t||0===t.length)return{};var n={},r={},o=[];t.forEach(function(t){var a=t[e.start],i=t[e.end];n[a]=!0,r[i]=!0,o.push(a,i)}),o.sort(function(t,e){return t-e});var a=[],i=0,s=o[0];return o.forEach(function(t){if(n[t]&&a.push(t),r[t]){var e=a.pop();a.length||(i+=t-e)}s=t}),Math.round(i)}function h(t){function e(t){var e={dns:{start:"domainLookupStart",end:"domainLookupEnd"},connect:{start:"connectStart",end:"connectEnd"},request:{start:"requestStart",end:"responseStart"},response:{start:"responseStart",end:"responseEnd"}};return{dns:d(t,e.dns),connect:d(t,e.connect),request:d(t,e.request),response:d(t,e.response),caches:t.filter(function(t){return t.responseEnd-t.fetchStart<5}).length}}var r=S.filter(t),s=r.filter(n),c=r.filter(o),h={load:{domainStats:u(s),domains:Object.keys(u(s)),files:s},dcl:{domainStats:u(c),domains:Object.keys(u(c)),files:c}},p={};return Object.keys(h).forEach(function(t){var n=h[t];p[t]={all:{count:0}},h[t].domains.forEach(function(r){p[t][r]={},p[t][r].count=n.domainStats[r],p[t].all.count+=p[t][r].count;var o=n.files.filter(a(r));i.merge(p[t][r],f(o)),i.merge(p[t][r],e(o))}),i.merge(p[t].all,f(n.files)),i.merge(p[t].all,e(n.files))}),p}var p=t,l=p.performance||p.mozPerformance||p.msPerformance||p.webkitPerformance;if(l&&l.timing&&l.getEntries&&Object.keys&&[].forEach&&[].filter&&[].reduce){var g=l.timing,m=g.loadEventEnd-g.navigationStart,v=g.responseStart-g.navigationStart,y=g.domContentLoadedEventStart-g.navigationStart,S=l.getEntries(),E={img:h(e(/\.(jpg|jpeg|webp|png|gif)$/)),sprite:h(e(/css\/si\/.*\.(jpg|jpeg|webp|png|gif)$/)),css:h(e(/\.css$/)),js:h(e(/\.js$/)),font:h(e(/\.woff([^\w]|$)/))};return E.other={onload:m},E=i.whitelistify(E,r),t.imagedomaintest&&(E={domaintest:E}),E}}})}();var f=function(){function e(t,e){var n;switch(t){case"img":n=/logo/.test(e)?"logo":"content";break;case"script":/deps/.test(e)?n="deps":/mt-core/.test(e)&&(n="yui");break;case"link":n=/common/.test(e)?"base":"widget"}return n}function n(t){var e=/^https?:\/\/(\w+)(?:\.)/.exec(t);return e[1]||""}var r="startTime",o="domainLookupStart",a="domainLookupEnd",i="connectStart",s="connectEnd",c="requestStart",u="responseStart",f="responseEnd",d="duration",h=[r,i,s,o,a,c,u,f,d];return function(p,l,g){function m(t,e){return P[t]&&P[e]&&-1!==P[t]&&-1!==P[e]?P[t]-P[e]:-1}var v,y,S,E,b,_,M,w,T,k,j,L,P,I,O,q,C,x,R;if(t.performance&&t.performance.getEntries&&Array.prototype.forEach&&Array.prototype.indexOf){M=navigator.userAgent.indexOf(!0)?!0:!1,j=[].concat(p),k=0,T=0,I=[],P={};for(var A=t.performance.getEntries(),N=0,$=A.length;$>N&&(w=A[N],j.length);N++)_=j.indexOf(w.name),-1!==_&&(j.splice(_,1),L={},P={},h.forEach(function(t){var e=parseInt(w[t],10);isNaN(e)||0>=e||(P[t]=e)}),v=m(o,r),E=m(a,o),y=m(s,i),q=m(c,s),O=m(u,c),x=m(f,u),S=0,M?P.fetchStart===P.requestStart&&P.requestStart===P.responseStart&&P.responseStart!==P.responseEnd&&(S=1):0!==P.domainLookupStart&&0===P.requestStart&&(S=1),C=n(w.name),b=e(w.initiatorType,w.name),R=null,(w.name===l||l&&l.push&&-1!==l.indexOf(w.name))&&(R=w.name,T=P[f]),g&&w.name===g&&(k=P[r]),L={start:P[r],duration:P[d],dc:S,server:C,type:w.initiatorType,id:b},R&&(L.url=R),~v&&(L.blocking=v),~E&&(L.dns=E),~y&&(L.connecting=y),~q&&(L.sending=q),~O&&(L.response=O),~x&&(L.transfer=x),I.push(L));return k&&T&&(L={start:k,duration:T-k,type:"items",id:"fsImg"},I.push(L)),I}}}();o.addPlugin("waterfall",{type:"waterfall",data:function(){var n=t,r=n.performance||n.mozPerformance||n.msPerformance||n.webkitPerformance;if(!r)return null;var o=TransformPerf.compress,a={};for(var i in r.timing)r.timing.hasOwnProperty(i)&&(a[i]=r.timing[i]);a.name=n.location.href,a.title=e.title,a.initiatorType="window",a.entryType="resource";var s=r.getEntries();return s.push(a),o(s)}}),i.onload(function(){if(t.MeituanAnalyticsObject){var e=Object.prototype.toString,n=new o,r=t[t.MeituanAnalyticsObject],a=r?r.q:[];r.q=n,a&&"[object Array]"===e.call(a)&&n.push.apply(n,a)}})}(window,document);