;(function($){'use strict'
var tmpl=function(str,data){var f=!/[^\w\-.:]/.test(str)?(tmpl.cache[str]=tmpl.cache[str]||tmpl(tmpl.load(str))):new Function(tmpl.arg+',tmpl','var _e=tmpl.encode'+
tmpl.helper+
",_s='"+
str.replace(tmpl.regexp,tmpl.func)+
"';return _s;")
return data?f(data,tmpl):function(data){return f(data,tmpl)}}
tmpl.cache={}
tmpl.load=function(id){return document.getElementById(id).innerHTML}
tmpl.regexp=/([\s'\\])(?!(?:[^{]|\{(?!%))*%\})|(?:\{%(=|#)([\s\S]+?)%\})|(\{%)|(%\})/g
tmpl.func=function(s,p1,p2,p3,p4,p5){if(p1){return({'\n':'\\n','\r':'\\r','\t':'\\t',' ':' '}[p1]||'\\'+p1)}
if(p2){if(p2==='='){return "'+_e("+p3+")+'"}
return "'+("+p3+"==null?'':"+p3+")+'"}
if(p4){return "';"}
if(p5){return "_s+='"}}
tmpl.encReg=/[<>&"'\x00]/g
tmpl.encMap={'<':'&lt;','>':'&gt;','&':'&amp;','"':'&quot;',"'":'&#39;'}
tmpl.encode=function(s){return(s==null?'':''+s).replace(tmpl.encReg,function(c){return tmpl.encMap[c]||''})}
tmpl.arg='o'
tmpl.helper=",print=function(s,e){_s+=e?(s==null?'':s):_e(s);}"+
',include=function(s,d){_s+=tmpl(s,d);}'
if(typeof define==='function'&&define.amd){define(function(){return tmpl})}else if(typeof module==='object'&&module.exports){module.exports=tmpl}else{$.tmpl=tmpl}})(this)