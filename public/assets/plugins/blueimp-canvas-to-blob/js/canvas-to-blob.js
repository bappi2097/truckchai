;(function(window){'use strict'
var CanvasPrototype=window.HTMLCanvasElement&&window.HTMLCanvasElement.prototype
var hasBlobConstructor=window.Blob&&(function(){try{return Boolean(new Blob())}catch(e){return false}})()
var hasArrayBufferViewSupport=hasBlobConstructor&&window.Uint8Array&&(function(){try{return new Blob([new Uint8Array(100)]).size===100}catch(e){return false}})()
var BlobBuilder=window.BlobBuilder||window.WebKitBlobBuilder||window.MozBlobBuilder||window.MSBlobBuilder
var dataURIPattern=/^data:((.*?)(;charset=.*?)?)(;base64)?,/
var dataURLtoBlob=(hasBlobConstructor||BlobBuilder)&&window.atob&&window.ArrayBuffer&&window.Uint8Array&&function(dataURI){var matches,mediaType,isBase64,dataString,byteString,arrayBuffer,intArray,i,bb
matches=dataURI.match(dataURIPattern)
if(!matches){throw new Error('invalid data URI')}
mediaType=matches[2]?matches[1]:'text/plain'+(matches[3]||';charset=US-ASCII')
isBase64=!!matches[4]
dataString=dataURI.slice(matches[0].length)
if(isBase64){byteString=atob(dataString)}else{byteString=decodeURIComponent(dataString)}
arrayBuffer=new ArrayBuffer(byteString.length)
intArray=new Uint8Array(arrayBuffer)
for(i=0;i<byteString.length;i+=1){intArray[i]=byteString.charCodeAt(i)}
if(hasBlobConstructor){return new Blob([hasArrayBufferViewSupport?intArray:arrayBuffer],{type:mediaType})}
bb=new BlobBuilder()
bb.append(arrayBuffer)
return bb.getBlob(mediaType)}
if(window.HTMLCanvasElement&&!CanvasPrototype.toBlob){if(CanvasPrototype.mozGetAsFile){CanvasPrototype.toBlob=function(callback,type,quality){var self=this
setTimeout(function(){if(quality&&CanvasPrototype.toDataURL&&dataURLtoBlob){callback(dataURLtoBlob(self.toDataURL(type,quality)))}else{callback(self.mozGetAsFile('blob',type))}})}}else if(CanvasPrototype.toDataURL&&dataURLtoBlob){if(CanvasPrototype.msToBlob){CanvasPrototype.toBlob=function(callback,type,quality){var self=this
setTimeout(function(){if(((type&&type!=='image/png')||quality)&&CanvasPrototype.toDataURL&&dataURLtoBlob){callback(dataURLtoBlob(self.toDataURL(type,quality)))}else{callback(self.msToBlob(type))}})}}else{CanvasPrototype.toBlob=function(callback,type,quality){var self=this
setTimeout(function(){callback(dataURLtoBlob(self.toDataURL(type,quality)))})}}}}
if(typeof define==='function'&&define.amd){define(function(){return dataURLtoBlob})}else if(typeof module==='object'&&module.exports){module.exports=dataURLtoBlob}else{window.dataURLtoBlob=dataURLtoBlob}})(window)