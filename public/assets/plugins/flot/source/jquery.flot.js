(function($){"use strict";var Canvas=window.Flot.Canvas;function defaultTickGenerator(axis){var ticks=[],start=$.plot.saturated.saturate($.plot.saturated.floorInBase(axis.min,axis.tickSize)),i=0,v=Number.NaN,prev;if(start===-Number.MAX_VALUE){ticks.push(start);start=$.plot.saturated.floorInBase(axis.min+axis.tickSize,axis.tickSize);}
do{prev=v;v=$.plot.saturated.multiplyAdd(axis.tickSize,i,start);ticks.push(v);++i;}while(v<axis.max&&v!==prev);return ticks;}
function defaultTickFormatter(value,axis,precision){var oldTickDecimals=axis.tickDecimals,expPosition=(""+value).indexOf("e");if(expPosition!==-1){return expRepTickFormatter(value,axis,precision);}
if(precision>0){axis.tickDecimals=precision;}
var factor=axis.tickDecimals?parseFloat('1e'+axis.tickDecimals):1,formatted=""+Math.round(value*factor)/factor;if(axis.tickDecimals!=null){var decimal=formatted.indexOf("."),decimalPrecision=decimal===-1?0:formatted.length-decimal-1;if(decimalPrecision<axis.tickDecimals){var decimals=(""+factor).substr(1,axis.tickDecimals-decimalPrecision);formatted=(decimalPrecision?formatted:formatted+".")+decimals;}}
axis.tickDecimals=oldTickDecimals;return formatted;};function expRepTickFormatter(value,axis,precision){var expPosition=(""+value).indexOf("e"),exponentValue=parseInt((""+value).substr(expPosition+1)),tenExponent=expPosition!==-1?exponentValue:(value>0?Math.floor(Math.log(value)/Math.LN10):0),roundWith=parseFloat('1e'+tenExponent),x=value/roundWith;if(precision){var updatedPrecision=recomputePrecision(value,precision);return(value/roundWith).toFixed(updatedPrecision)+'e'+tenExponent;}
if(axis.tickDecimals>0){return x.toFixed(recomputePrecision(value,axis.tickDecimals))+'e'+tenExponent;}
return x.toFixed()+'e'+tenExponent;}
function recomputePrecision(num,precision){var log10Value=Math.log(Math.abs(num))*Math.LOG10E,newPrecision=Math.abs(log10Value+precision);return newPrecision<=20?Math.floor(newPrecision):20;}
function Plot(placeholder,data_,options_,plugins){var series=[],options={colors:["#edc240","#afd8f8","#cb4b4b","#4da74d","#9440ed"],xaxis:{show:null,position:"bottom",mode:null,font:null,color:null,tickColor:null,transform:null,inverseTransform:null,min:null,max:null,autoScaleMargin:null,autoScale:"exact",windowSize:null,growOnly:null,ticks:null,tickFormatter:null,showTickLabels:"major",labelWidth:null,labelHeight:null,reserveSpace:null,tickLength:null,showMinorTicks:null,showTicks:null,gridLines:null,alignTicksWithAxis:null,tickDecimals:null,tickSize:null,minTickSize:null,offset:{below:0,above:0},boxPosition:{centerX:0,centerY:0}},yaxis:{autoScaleMargin:0.02,autoScale:"loose",growOnly:null,position:"left",showTickLabels:"major",offset:{below:0,above:0},boxPosition:{centerX:0,centerY:0}},xaxes:[],yaxes:[],series:{points:{show:false,radius:3,lineWidth:2,fill:true,fillColor:"#ffffff",symbol:'circle'},lines:{lineWidth:1,fill:false,fillColor:null,steps:false},bars:{show:false,lineWidth:2,horizontal:false,barWidth:0.8,fill:true,fillColor:null,align:"left",zero:true},shadowSize:3,highlightColor:null},grid:{show:true,aboveData:false,color:"#545454",backgroundColor:null,borderColor:null,tickColor:null,margin:0,labelMargin:5,axisMargin:8,borderWidth:1,minBorderMargin:null,markings:null,markingsColor:"#f4f4f4",markingsLineWidth:2,clickable:false,hoverable:false,autoHighlight:true,mouseActiveRadius:15},interaction:{redrawOverlayInterval:1000/60},hooks:{}},surface=null,overlay=null,eventHolder=null,ctx=null,octx=null,xaxes=[],yaxes=[],plotOffset={left:0,right:0,top:0,bottom:0},plotWidth=0,plotHeight=0,hooks={processOptions:[],processRawData:[],processDatapoints:[],processOffset:[],setupGrid:[],adjustSeriesDataRange:[],setRange:[],drawBackground:[],drawSeries:[],drawAxis:[],draw:[],findNearbyItems:[],axisReserveSpace:[],bindEvents:[],drawOverlay:[],resize:[],shutdown:[]},plot=this;var eventManager={};var redrawTimeout=null;plot.setData=setData;plot.setupGrid=setupGrid;plot.draw=draw;plot.getPlaceholder=function(){return placeholder;};plot.getCanvas=function(){return surface.element;};plot.getSurface=function(){return surface;};plot.getEventHolder=function(){return eventHolder[0];};plot.getPlotOffset=function(){return plotOffset;};plot.width=function(){return plotWidth;};plot.height=function(){return plotHeight;};plot.offset=function(){var o=eventHolder.offset();o.left+=plotOffset.left;o.top+=plotOffset.top;return o;};plot.getData=function(){return series;};plot.getAxes=function(){var res={};$.each(xaxes.concat(yaxes),function(_,axis){if(axis){res[axis.direction+(axis.n!==1?axis.n:"")+"axis"]=axis;}});return res;};plot.getXAxes=function(){return xaxes;};plot.getYAxes=function(){return yaxes;};plot.c2p=canvasToCartesianAxisCoords;plot.p2c=cartesianAxisToCanvasCoords;plot.getOptions=function(){return options;};plot.triggerRedrawOverlay=triggerRedrawOverlay;plot.pointOffset=function(point){return{left:parseInt(xaxes[axisNumber(point,"x")-1].p2c(+point.x)+plotOffset.left,10),top:parseInt(yaxes[axisNumber(point,"y")-1].p2c(+point.y)+plotOffset.top,10)};};plot.shutdown=shutdown;plot.destroy=function(){shutdown();placeholder.removeData("plot").empty();series=[];options=null;surface=null;overlay=null;eventHolder=null;ctx=null;octx=null;xaxes=[];yaxes=[];hooks=null;plot=null;};plot.resize=function(){var width=placeholder.width(),height=placeholder.height();surface.resize(width,height);overlay.resize(width,height);executeHooks(hooks.resize,[width,height]);};plot.clearTextCache=function(){surface.clearCache();overlay.clearCache();};plot.autoScaleAxis=autoScaleAxis;plot.computeRangeForDataSeries=computeRangeForDataSeries;plot.adjustSeriesDataRange=adjustSeriesDataRange;plot.findNearbyItem=findNearbyItem;plot.findNearbyItems=findNearbyItems;plot.findNearbyInterpolationPoint=findNearbyInterpolationPoint;plot.computeValuePrecision=computeValuePrecision;plot.computeTickSize=computeTickSize;plot.addEventHandler=addEventHandler;plot.hooks=hooks;var MINOR_TICKS_COUNT_CONSTANT=$.plot.uiConstants.MINOR_TICKS_COUNT_CONSTANT;var TICK_LENGTH_CONSTANT=$.plot.uiConstants.TICK_LENGTH_CONSTANT;initPlugins(plot);setupCanvases();parseOptions(options_);setData(data_);setupGrid(true);draw();bindEvents();function executeHooks(hook,args){args=[plot].concat(args);for(var i=0;i<hook.length;++i){hook[i].apply(this,args);}}
function initPlugins(){var classes={Canvas:Canvas};for(var i=0;i<plugins.length;++i){var p=plugins[i];p.init(plot,classes);if(p.options){$.extend(true,options,p.options);}}}
function parseOptions(opts){$.extend(true,options,opts);if(opts&&opts.colors){options.colors=opts.colors;}
if(options.xaxis.color==null){options.xaxis.color=$.color.parse(options.grid.color).scale('a',0.22).toString();}
if(options.yaxis.color==null){options.yaxis.color=$.color.parse(options.grid.color).scale('a',0.22).toString();}
if(options.xaxis.tickColor==null){options.xaxis.tickColor=options.grid.tickColor||options.xaxis.color;}
if(options.yaxis.tickColor==null){options.yaxis.tickColor=options.grid.tickColor||options.yaxis.color;}
if(options.grid.borderColor==null){options.grid.borderColor=options.grid.color;}
if(options.grid.tickColor==null){options.grid.tickColor=$.color.parse(options.grid.color).scale('a',0.22).toString();}
var i,axisOptions,axisCount,fontSize=placeholder.css("font-size"),fontSizeDefault=fontSize?+fontSize.replace("px",""):13,fontDefaults={style:placeholder.css("font-style"),size:Math.round(0.8*fontSizeDefault),variant:placeholder.css("font-variant"),weight:placeholder.css("font-weight"),family:placeholder.css("font-family")};axisCount=options.xaxes.length||1;for(i=0;i<axisCount;++i){axisOptions=options.xaxes[i];if(axisOptions&&!axisOptions.tickColor){axisOptions.tickColor=axisOptions.color;}
axisOptions=$.extend(true,{},options.xaxis,axisOptions);options.xaxes[i]=axisOptions;if(axisOptions.font){axisOptions.font=$.extend({},fontDefaults,axisOptions.font);if(!axisOptions.font.color){axisOptions.font.color=axisOptions.color;}
if(!axisOptions.font.lineHeight){axisOptions.font.lineHeight=Math.round(axisOptions.font.size*1.15);}}}
axisCount=options.yaxes.length||1;for(i=0;i<axisCount;++i){axisOptions=options.yaxes[i];if(axisOptions&&!axisOptions.tickColor){axisOptions.tickColor=axisOptions.color;}
axisOptions=$.extend(true,{},options.yaxis,axisOptions);options.yaxes[i]=axisOptions;if(axisOptions.font){axisOptions.font=$.extend({},fontDefaults,axisOptions.font);if(!axisOptions.font.color){axisOptions.font.color=axisOptions.color;}
if(!axisOptions.font.lineHeight){axisOptions.font.lineHeight=Math.round(axisOptions.font.size*1.15);}}}
for(i=0;i<options.xaxes.length;++i){getOrCreateAxis(xaxes,i+1).options=options.xaxes[i];}
for(i=0;i<options.yaxes.length;++i){getOrCreateAxis(yaxes,i+1).options=options.yaxes[i];}
$.each(allAxes(),function(_,axis){axis.boxPosition=axis.options.boxPosition||{centerX:0,centerY:0};});for(var n in hooks){if(options.hooks[n]&&options.hooks[n].length){hooks[n]=hooks[n].concat(options.hooks[n]);}}
executeHooks(hooks.processOptions,[options]);}
function setData(d){var oldseries=series;series=parseData(d);fillInSeriesOptions();processData(oldseries);}
function parseData(d){var res=[];for(var i=0;i<d.length;++i){var s=$.extend(true,{},options.series);if(d[i].data!=null){s.data=d[i].data;delete d[i].data;$.extend(true,s,d[i]);d[i].data=s.data;}else{s.data=d[i];}
res.push(s);}
return res;}
function axisNumber(obj,coord){var a=obj[coord+"axis"];if(typeof a==="object"){a=a.n;}
if(typeof a!=="number"){a=1;}
return a;}
function allAxes(){return xaxes.concat(yaxes).filter(function(a){return a;});}
function canvasToCartesianAxisCoords(pos){var res={},i,axis;for(i=0;i<xaxes.length;++i){axis=xaxes[i];if(axis&&axis.used){res["x"+axis.n]=axis.c2p(pos.left);}}
for(i=0;i<yaxes.length;++i){axis=yaxes[i];if(axis&&axis.used){res["y"+axis.n]=axis.c2p(pos.top);}}
if(res.x1!==undefined){res.x=res.x1;}
if(res.y1!==undefined){res.y=res.y1;}
return res;}
function cartesianAxisToCanvasCoords(pos){var res={},i,axis,key;for(i=0;i<xaxes.length;++i){axis=xaxes[i];if(axis&&axis.used){key="x"+axis.n;if(pos[key]==null&&axis.n===1){key="x";}
if(pos[key]!=null){res.left=axis.p2c(pos[key]);break;}}}
for(i=0;i<yaxes.length;++i){axis=yaxes[i];if(axis&&axis.used){key="y"+axis.n;if(pos[key]==null&&axis.n===1){key="y";}
if(pos[key]!=null){res.top=axis.p2c(pos[key]);break;}}}
return res;}
function getOrCreateAxis(axes,number){if(!axes[number-1]){axes[number-1]={n:number,direction:axes===xaxes?"x":"y",options:$.extend(true,{},axes===xaxes?options.xaxis:options.yaxis)};}
return axes[number-1];}
function fillInSeriesOptions(){var neededColors=series.length,maxIndex=-1,i;for(i=0;i<series.length;++i){var sc=series[i].color;if(sc!=null){neededColors--;if(typeof sc==="number"&&sc>maxIndex){maxIndex=sc;}}}
if(neededColors<=maxIndex){neededColors=maxIndex+1;}
var c,colors=[],colorPool=options.colors,colorPoolSize=colorPool.length,variation=0,definedColors=Math.max(0,series.length-neededColors);for(i=0;i<neededColors;i++){c=$.color.parse(colorPool[(definedColors+i)%colorPoolSize]||"#666");if(i%colorPoolSize===0&&i){if(variation>=0){if(variation<0.5){variation=-variation-0.2;}else variation=0;}else variation=-variation;}
colors[i]=c.scale('rgb',1+variation);}
var colori=0,s;for(i=0;i<series.length;++i){s=series[i];if(s.color==null){s.color=colors[colori].toString();++colori;}else if(typeof s.color==="number"){s.color=colors[s.color].toString();}
if(s.lines.show==null){var v,show=true;for(v in s){if(s[v]&&s[v].show){show=false;break;}}
if(show){s.lines.show=true;}}
if(s.lines.zero==null){s.lines.zero=!!s.lines.fill;}
s.xaxis=getOrCreateAxis(xaxes,axisNumber(s,"x"));s.yaxis=getOrCreateAxis(yaxes,axisNumber(s,"y"));}}
function processData(prevSeries){var topSentry=Number.POSITIVE_INFINITY,bottomSentry=Number.NEGATIVE_INFINITY,i,j,k,m,s,points,ps,val,f,p,data,format;function updateAxis(axis,min,max){if(min<axis.datamin&&min!==-Infinity){axis.datamin=min;}
if(max>axis.datamax&&max!==Infinity){axis.datamax=max;}}
function reusePoints(prevSeries,i){if(prevSeries&&prevSeries[i]&&prevSeries[i].datapoints&&prevSeries[i].datapoints.points){return prevSeries[i].datapoints.points;}
return[];}
$.each(allAxes(),function(_,axis){if(axis.options.growOnly!==true){axis.datamin=topSentry;axis.datamax=bottomSentry;}else{if(axis.datamin===undefined){axis.datamin=topSentry;}
if(axis.datamax===undefined){axis.datamax=bottomSentry;}}
axis.used=false;});for(i=0;i<series.length;++i){s=series[i];s.datapoints={points:[]};if(s.datapoints.points.length===0){s.datapoints.points=reusePoints(prevSeries,i);}
executeHooks(hooks.processRawData,[s,s.data,s.datapoints]);}
for(i=0;i<series.length;++i){s=series[i];data=s.data;format=s.datapoints.format;if(!format){format=[];format.push({x:true,y:false,number:true,required:true,computeRange:s.xaxis.options.autoScale!=='none',defaultValue:null});format.push({x:false,y:true,number:true,required:true,computeRange:s.yaxis.options.autoScale!=='none',defaultValue:null});if(s.stack||s.bars.show||(s.lines.show&&s.lines.fill)){var expectedPs=s.datapoints.pointsize!=null?s.datapoints.pointsize:(s.data&&s.data[0]&&s.data[0].length?s.data[0].length:3);if(expectedPs>2){format.push({x:false,y:true,number:true,required:false,computeRange:s.yaxis.options.autoScale!=='none',defaultValue:0});}}
s.datapoints.format=format;}
s.xaxis.used=s.yaxis.used=true;if(s.datapoints.pointsize!=null)continue;s.datapoints.pointsize=format.length;ps=s.datapoints.pointsize;points=s.datapoints.points;for(j=k=0;j<data.length;++j,k+=ps){p=data[j];var nullify=p==null;if(!nullify){for(m=0;m<ps;++m){val=p[m];f=format[m];if(f){if(f.number&&val!=null){val=+val;if(isNaN(val)){val=null;}}
if(val==null){if(f.required)nullify=true;if(f.defaultValue!=null)val=f.defaultValue;}}
points[k+m]=val;}}
if(nullify){for(m=0;m<ps;++m){val=points[k+m];if(val!=null){f=format[m];if(f.computeRange){if(f.x){updateAxis(s.xaxis,val,val);}
if(f.y){updateAxis(s.yaxis,val,val);}}}
points[k+m]=null;}}}
points.length=k;}
for(i=0;i<series.length;++i){s=series[i];executeHooks(hooks.processDatapoints,[s,s.datapoints]);}
for(i=0;i<series.length;++i){s=series[i];format=s.datapoints.format;if(format.every(function(f){return!f.computeRange;})){continue;}
var range=plot.adjustSeriesDataRange(s,plot.computeRangeForDataSeries(s));executeHooks(hooks.adjustSeriesDataRange,[s,range]);updateAxis(s.xaxis,range.xmin,range.xmax);updateAxis(s.yaxis,range.ymin,range.ymax);}
$.each(allAxes(),function(_,axis){if(axis.datamin===topSentry){axis.datamin=null;}
if(axis.datamax===bottomSentry){axis.datamax=null;}});}
function setupCanvases(){placeholder.css("padding",0).children().filter(function(){return!$(this).hasClass("flot-overlay")&&!$(this).hasClass('flot-base');}).remove();if(placeholder.css("position")==='static'){placeholder.css("position","relative");}
surface=new Canvas("flot-base",placeholder[0]);overlay=new Canvas("flot-overlay",placeholder[0]);ctx=surface.context;octx=overlay.context;eventHolder=$(overlay.element).unbind();var existing=placeholder.data("plot");if(existing){existing.shutdown();overlay.clear();}
placeholder.data("plot",plot);}
function bindEvents(){executeHooks(hooks.bindEvents,[eventHolder]);}
function addEventHandler(event,handler,eventHolder,priority){var key=eventHolder+event;var eventList=eventManager[key]||[];eventList.push({"event":event,"handler":handler,"eventHolder":eventHolder,"priority":priority});eventList.sort((a,b)=>b.priority-a.priority);eventList.forEach(eventData=>{eventData.eventHolder.unbind(eventData.event,eventData.handler);eventData.eventHolder.bind(eventData.event,eventData.handler);});eventManager[key]=eventList;}
function shutdown(){if(redrawTimeout){clearTimeout(redrawTimeout);}
executeHooks(hooks.shutdown,[eventHolder]);}
function setTransformationHelpers(axis){function identity(x){return x;}
var s,m,t=axis.options.transform||identity,it=axis.options.inverseTransform;if(axis.direction==="x"){if(isFinite(t(axis.max)-t(axis.min))){s=axis.scale=plotWidth/Math.abs(t(axis.max)-t(axis.min));}else{s=axis.scale=1/Math.abs($.plot.saturated.delta(t(axis.min),t(axis.max),plotWidth));}
m=Math.min(t(axis.max),t(axis.min));}else{if(isFinite(t(axis.max)-t(axis.min))){s=axis.scale=plotHeight/Math.abs(t(axis.max)-t(axis.min));}else{s=axis.scale=1/Math.abs($.plot.saturated.delta(t(axis.min),t(axis.max),plotHeight));}
s=-s;m=Math.max(t(axis.max),t(axis.min));}
if(t===identity){axis.p2c=function(p){if(isFinite(p-m)){return(p-m)*s;}else{return(p/4-m/4)*s*4;}};}else{axis.p2c=function(p){var tp=t(p);if(isFinite(tp-m)){return(tp-m)*s;}else{return(tp/4-m/4)*s*4;}};}
if(!it){axis.c2p=function(c){return m+c/s;};}else{axis.c2p=function(c){return it(m+c/s);};}}
function measureTickLabels(axis){var opts=axis.options,ticks=opts.showTickLabels!=='none'&&axis.ticks?axis.ticks:[],showMajorTickLabels=opts.showTickLabels==='major'||opts.showTickLabels==='all',showEndpointsTickLabels=opts.showTickLabels==='endpoints'||opts.showTickLabels==='all',labelWidth=opts.labelWidth||0,labelHeight=opts.labelHeight||0,legacyStyles=axis.direction+"Axis "+axis.direction+axis.n+"Axis",layer="flot-"+axis.direction+"-axis flot-"+axis.direction+axis.n+"-axis "+legacyStyles,font=opts.font||"flot-tick-label tickLabel";for(var i=0;i<ticks.length;++i){var t=ticks[i];var label=t.label;if(!t.label||(showMajorTickLabels===false&&i>0&&i<ticks.length-1)||(showEndpointsTickLabels===false&&(i===0||i===ticks.length-1))){continue;}
if(typeof t.label==='object'){label=t.label.name;}
var info=surface.getTextInfo(layer,label,font);labelWidth=Math.max(labelWidth,info.width);labelHeight=Math.max(labelHeight,info.height);}
axis.labelWidth=opts.labelWidth||labelWidth;axis.labelHeight=opts.labelHeight||labelHeight;}
function allocateAxisBoxFirstPhase(axis){executeHooks(hooks.axisReserveSpace,[axis]);var lw=axis.labelWidth,lh=axis.labelHeight,pos=axis.options.position,isXAxis=axis.direction==="x",tickLength=axis.options.tickLength,showTicks=axis.options.showTicks,showMinorTicks=axis.options.showMinorTicks,gridLines=axis.options.gridLines,axisMargin=options.grid.axisMargin,padding=options.grid.labelMargin,innermost=true,outermost=true,found=false;$.each(isXAxis?xaxes:yaxes,function(i,a){if(a&&(a.show||a.reserveSpace)){if(a===axis){found=true;}else if(a.options.position===pos){if(found){outermost=false;}else{innermost=false;}}}});if(outermost){axisMargin=0;}
if(tickLength==null){tickLength=TICK_LENGTH_CONSTANT;}
if(showTicks==null){showTicks=true;}
if(showMinorTicks==null){showMinorTicks=true;}
if(gridLines==null){if(innermost){gridLines=true;}else{gridLines=false;}}
if(!isNaN(+tickLength)){padding+=showTicks?+tickLength:0;}
if(isXAxis){lh+=padding;if(pos==="bottom"){plotOffset.bottom+=lh+axisMargin;axis.box={top:surface.height-plotOffset.bottom,height:lh};}else{axis.box={top:plotOffset.top+axisMargin,height:lh};plotOffset.top+=lh+axisMargin;}}else{lw+=padding;if(pos==="left"){axis.box={left:plotOffset.left+axisMargin,width:lw};plotOffset.left+=lw+axisMargin;}else{plotOffset.right+=lw+axisMargin;axis.box={left:surface.width-plotOffset.right,width:lw};}}
axis.position=pos;axis.tickLength=tickLength;axis.showMinorTicks=showMinorTicks;axis.showTicks=showTicks;axis.gridLines=gridLines;axis.box.padding=padding;axis.innermost=innermost;}
function allocateAxisBoxSecondPhase(axis){if(axis.direction==="x"){axis.box.left=plotOffset.left-axis.labelWidth/2;axis.box.width=surface.width-plotOffset.left-plotOffset.right+axis.labelWidth;}else{axis.box.top=plotOffset.top-axis.labelHeight/2;axis.box.height=surface.height-plotOffset.bottom-plotOffset.top+axis.labelHeight;}}
function adjustLayoutForThingsStickingOut(){var minMargin=options.grid.minBorderMargin,i;if(minMargin==null){minMargin=0;for(i=0;i<series.length;++i){minMargin=Math.max(minMargin,2*(series[i].points.radius+series[i].points.lineWidth/2));}}
var a,offset={},margins={left:minMargin,right:minMargin,top:minMargin,bottom:minMargin};$.each(allAxes(),function(_,axis){if(axis.reserveSpace&&axis.ticks&&axis.ticks.length){if(axis.direction==="x"){margins.left=Math.max(margins.left,axis.labelWidth/2);margins.right=Math.max(margins.right,axis.labelWidth/2);}else{margins.bottom=Math.max(margins.bottom,axis.labelHeight/2);margins.top=Math.max(margins.top,axis.labelHeight/2);}}});for(a in margins){offset[a]=margins[a]-plotOffset[a];}
$.each(xaxes.concat(yaxes),function(_,axis){alignAxisWithGrid(axis,offset,function(offset){return offset>0;});});plotOffset.left=Math.ceil(Math.max(margins.left,plotOffset.left));plotOffset.right=Math.ceil(Math.max(margins.right,plotOffset.right));plotOffset.top=Math.ceil(Math.max(margins.top,plotOffset.top));plotOffset.bottom=Math.ceil(Math.max(margins.bottom,plotOffset.bottom));}
function alignAxisWithGrid(axis,offset,isValid){if(axis.direction==="x"){if(axis.position==="bottom"&&isValid(offset.bottom)){axis.box.top-=Math.ceil(offset.bottom);}
if(axis.position==="top"&&isValid(offset.top)){axis.box.top+=Math.ceil(offset.top);}}else{if(axis.position==="left"&&isValid(offset.left)){axis.box.left+=Math.ceil(offset.left);}
if(axis.position==="right"&&isValid(offset.right)){axis.box.left-=Math.ceil(offset.right);}}}
function setupGrid(autoScale){var i,a,axes=allAxes(),showGrid=options.grid.show;for(a in plotOffset){plotOffset[a]=0;}
executeHooks(hooks.processOffset,[plotOffset]);for(a in plotOffset){if(typeof(options.grid.borderWidth)==="object"){plotOffset[a]+=showGrid?options.grid.borderWidth[a]:0;}else{plotOffset[a]+=showGrid?options.grid.borderWidth:0;}}
$.each(axes,function(_,axis){var axisOpts=axis.options;axis.show=axisOpts.show==null?axis.used:axisOpts.show;axis.reserveSpace=axisOpts.reserveSpace==null?axis.show:axisOpts.reserveSpace;setupTickFormatter(axis);executeHooks(hooks.setRange,[axis,autoScale]);setRange(axis,autoScale);});if(showGrid){plotWidth=surface.width-plotOffset.left-plotOffset.right;plotHeight=surface.height-plotOffset.bottom-plotOffset.top;var allocatedAxes=$.grep(axes,function(axis){return axis.show||axis.reserveSpace;});$.each(allocatedAxes,function(_,axis){setupTickGeneration(axis);setMajorTicks(axis);snapRangeToTicks(axis,axis.ticks,series);setTransformationHelpers(axis);setEndpointTicks(axis,series);measureTickLabels(axis);});for(i=allocatedAxes.length-1;i>=0;--i){allocateAxisBoxFirstPhase(allocatedAxes[i]);}
adjustLayoutForThingsStickingOut();$.each(allocatedAxes,function(_,axis){allocateAxisBoxSecondPhase(axis);});}
if(options.grid.margin){for(a in plotOffset){var margin=options.grid.margin||0;plotOffset[a]+=typeof margin==="number"?margin:(margin[a]||0);}
$.each(xaxes.concat(yaxes),function(_,axis){alignAxisWithGrid(axis,options.grid.margin,function(offset){return offset!==undefined&&offset!==null;});});}
plotWidth=surface.width-plotOffset.left-plotOffset.right;plotHeight=surface.height-plotOffset.bottom-plotOffset.top;$.each(axes,function(_,axis){setTransformationHelpers(axis);});if(showGrid){drawAxisLabels();}
executeHooks(hooks.setupGrid,[]);}
function widenMinMax(minimum,maximum){var min=(minimum===undefined?null:minimum);var max=(maximum===undefined?null:maximum);var delta=max-min;if(delta===0.0){var widen=max===0?1:0.01;var wmin=null;if(min==null){wmin-=widen;}
if(max==null||min!=null){max+=widen;}
if(wmin!=null){min=wmin;}}
return{min:min,max:max};}
function autoScaleAxis(axis){var opts=axis.options,min=opts.min,max=opts.max,datamin=axis.datamin,datamax=axis.datamax,delta;switch(opts.autoScale){case "none":min=+(opts.min!=null?opts.min:datamin);max=+(opts.max!=null?opts.max:datamax);break;case "loose":if(datamin!=null&&datamax!=null){min=datamin;max=datamax;delta=$.plot.saturated.saturate(max-min);var margin=((typeof opts.autoScaleMargin==='number')?opts.autoScaleMargin:0.02);min=$.plot.saturated.saturate(min-delta*margin);max=$.plot.saturated.saturate(max+delta*margin);if(min<0&&datamin>=0){min=0;}}else{min=opts.min;max=opts.max;}
break;case "exact":min=(datamin!=null?datamin:opts.min);max=(datamax!=null?datamax:opts.max);break;case "sliding-window":if(datamax>max){max=datamax;min=Math.max(datamax-(opts.windowSize||100),min);}
break;}
var widenedMinMax=widenMinMax(min,max);min=widenedMinMax.min;max=widenedMinMax.max;if(opts.growOnly===true&&opts.autoScale!=="none"&&opts.autoScale!=="sliding-window"){min=(min<datamin)?min:(datamin!==null?datamin:min);max=(max>datamax)?max:(datamax!==null?datamax:max);}
axis.autoScaledMin=min;axis.autoScaledMax=max;}
function setRange(axis,autoScale){var min=typeof axis.options.min==='number'?axis.options.min:axis.min,max=typeof axis.options.max==='number'?axis.options.max:axis.max,plotOffset=axis.options.offset;if(autoScale){autoScaleAxis(axis);min=axis.autoScaledMin;max=axis.autoScaledMax;}
min=(min!=null?min:-1)+(plotOffset.below||0);max=(max!=null?max:1)+(plotOffset.above||0);if(min>max){var tmp=min;min=max;max=tmp;axis.options.offset={above:0,below:0};}
axis.min=$.plot.saturated.saturate(min);axis.max=$.plot.saturated.saturate(max);}
function computeValuePrecision(min,max,direction,ticks,tickDecimals){var noTicks=fixupNumberOfTicks(direction,surface,ticks);var delta=$.plot.saturated.delta(min,max,noTicks),dec=-Math.floor(Math.log(delta)/Math.LN10);if(tickDecimals&&dec>tickDecimals){dec=tickDecimals;}
var magn=parseFloat('1e'+(-dec)),norm=delta/magn;if(norm>2.25&&norm<3&&(dec+1)<=tickDecimals){++dec;}
return isFinite(dec)?dec:0;};function computeTickSize(min,max,noTicks,tickDecimals){var delta=$.plot.saturated.delta(min,max,noTicks),dec=-Math.floor(Math.log(delta)/Math.LN10);if(tickDecimals&&dec>tickDecimals){dec=tickDecimals;}
var magn=parseFloat('1e'+(-dec)),norm=delta/magn,size;if(norm<1.5){size=1;}else if(norm<3){size=2;if(norm>2.25&&(tickDecimals==null||(dec+1)<=tickDecimals)){size=2.5;}}else if(norm<7.5){size=5;}else{size=10;}
size*=magn;return size;}
function getAxisTickSize(min,max,direction,options,tickDecimals){var noTicks;if(typeof options.ticks==="number"&&options.ticks>0){noTicks=options.ticks;}else{noTicks=0.3*Math.sqrt(direction==="x"?surface.width:surface.height);}
var size=computeTickSize(min,max,noTicks,tickDecimals);if(options.minTickSize!=null&&size<options.minTickSize){size=options.minTickSize;}
return options.tickSize||size;};function fixupNumberOfTicks(direction,surface,ticksOption){var noTicks;if(typeof ticksOption==="number"&&ticksOption>0){noTicks=ticksOption;}else{noTicks=0.3*Math.sqrt(direction==="x"?surface.width:surface.height);}
return noTicks;}
function setupTickFormatter(axis){var opts=axis.options;if(!axis.tickFormatter){if(typeof opts.tickFormatter==='function'){axis.tickFormatter=function(){var args=Array.prototype.slice.call(arguments);return ""+opts.tickFormatter.apply(null,args);};}else{axis.tickFormatter=defaultTickFormatter;}}}
function setupTickGeneration(axis){var opts=axis.options;var noTicks;noTicks=fixupNumberOfTicks(axis.direction,surface,opts.ticks);axis.delta=$.plot.saturated.delta(axis.min,axis.max,noTicks);var precision=plot.computeValuePrecision(axis.min,axis.max,axis.direction,noTicks,opts.tickDecimals);axis.tickDecimals=Math.max(0,opts.tickDecimals!=null?opts.tickDecimals:precision);axis.tickSize=getAxisTickSize(axis.min,axis.max,axis.direction,opts,opts.tickDecimals);if(!axis.tickGenerator){if(typeof opts.tickGenerator==='function'){axis.tickGenerator=opts.tickGenerator;}else{axis.tickGenerator=defaultTickGenerator;}}
if(opts.alignTicksWithAxis!=null){var otherAxis=(axis.direction==="x"?xaxes:yaxes)[opts.alignTicksWithAxis-1];if(otherAxis&&otherAxis.used&&otherAxis!==axis){var niceTicks=axis.tickGenerator(axis,plot);if(niceTicks.length>0){if(opts.min==null){axis.min=Math.min(axis.min,niceTicks[0]);}
if(opts.max==null&&niceTicks.length>1){axis.max=Math.max(axis.max,niceTicks[niceTicks.length-1]);}}
axis.tickGenerator=function(axis){var ticks=[],v,i;for(i=0;i<otherAxis.ticks.length;++i){v=(otherAxis.ticks[i].v-otherAxis.min)/(otherAxis.max-otherAxis.min);v=axis.min+v*(axis.max-axis.min);ticks.push(v);}
return ticks;};if(!axis.mode&&opts.tickDecimals==null){var extraDec=Math.max(0,-Math.floor(Math.log(axis.delta)/Math.LN10)+1),ts=axis.tickGenerator(axis,plot);if(!(ts.length>1&&/\..*0$/.test((ts[1]-ts[0]).toFixed(extraDec)))){axis.tickDecimals=extraDec;}}}}}
function setMajorTicks(axis){var oticks=axis.options.ticks,ticks=[];if(oticks==null||(typeof oticks==="number"&&oticks>0)){ticks=axis.tickGenerator(axis,plot);}else if(oticks){if($.isFunction(oticks)){ticks=oticks(axis);}else{ticks=oticks;}}
var i,v;axis.ticks=[];for(i=0;i<ticks.length;++i){var label=null;var t=ticks[i];if(typeof t==="object"){v=+t[0];if(t.length>1){label=t[1];}}else{v=+t;}
if(!isNaN(v)){axis.ticks.push(newTick(v,label,axis,'major'));}}}
function newTick(v,label,axis,type){if(label===null){switch(type){case 'min':case 'max':var precision=getEndpointPrecision(v,axis);label=isFinite(precision)?axis.tickFormatter(v,axis,precision,plot):axis.tickFormatter(v,axis,precision,plot);break;case 'major':label=axis.tickFormatter(v,axis,undefined,plot);}}
return{v:v,label:label};}
function snapRangeToTicks(axis,ticks,series){var anyDataInSeries=function(series){return series.some(e=>e.datapoints.points.length>0);}
if(axis.options.autoScale==="loose"&&ticks.length>0&&anyDataInSeries(series)){axis.min=Math.min(axis.min,ticks[0].v);axis.max=Math.max(axis.max,ticks[ticks.length-1].v);}}
function getEndpointPrecision(value,axis){var canvas1=Math.floor(axis.p2c(value)),canvas2=axis.direction==="x"?canvas1+1:canvas1-1,point1=axis.c2p(canvas1),point2=axis.c2p(canvas2),precision=computeValuePrecision(point1,point2,axis.direction,1);return precision;}
function setEndpointTicks(axis,series){if(isValidEndpointTick(axis,series)){axis.ticks.unshift(newTick(axis.min,null,axis,'min'));axis.ticks.push(newTick(axis.max,null,axis,'max'));}}
function isValidEndpointTick(axis,series){if(axis.options.showTickLabels==='endpoints'){return true;}
if(axis.options.showTickLabels==='all'){var associatedSeries=series.filter(function(s){return s.bars.horizontal?s.yaxis===axis:s.xaxis===axis;}),notAllBarSeries=associatedSeries.some(function(s){return!s.bars.show;});return associatedSeries.length===0||notAllBarSeries;}
if(axis.options.showTickLabels==='major'||axis.options.showTickLabels==='none'){return false;}}
function draw(){surface.clear();executeHooks(hooks.drawBackground,[ctx]);var grid=options.grid;if(grid.show&&grid.backgroundColor){drawBackground();}
if(grid.show&&!grid.aboveData){drawGrid();}
for(var i=0;i<series.length;++i){executeHooks(hooks.drawSeries,[ctx,series[i],i,getColorOrGradient]);drawSeries(series[i]);}
executeHooks(hooks.draw,[ctx]);if(grid.show&&grid.aboveData){drawGrid();}
surface.render();triggerRedrawOverlay();}
function extractRange(ranges,coord){var axis,from,to,key,axes=allAxes();for(var i=0;i<axes.length;++i){axis=axes[i];if(axis.direction===coord){key=coord+axis.n+"axis";if(!ranges[key]&&axis.n===1){key=coord+"axis";}
if(ranges[key]){from=ranges[key].from;to=ranges[key].to;break;}}}
if(!ranges[key]){axis=coord==="x"?xaxes[0]:yaxes[0];from=ranges[coord+"1"];to=ranges[coord+"2"];}
if(from!=null&&to!=null&&from>to){var tmp=from;from=to;to=tmp;}
return{from:from,to:to,axis:axis};}
function drawBackground(){ctx.save();ctx.translate(plotOffset.left,plotOffset.top);ctx.fillStyle=getColorOrGradient(options.grid.backgroundColor,plotHeight,0,"rgba(255, 255, 255, 0)");ctx.fillRect(0,0,plotWidth,plotHeight);ctx.restore();}
function drawMarkings(){var markings=options.grid.markings,axes;if(markings){if($.isFunction(markings)){axes=plot.getAxes();axes.xmin=axes.xaxis.min;axes.xmax=axes.xaxis.max;axes.ymin=axes.yaxis.min;axes.ymax=axes.yaxis.max;markings=markings(axes);}
var i;for(i=0;i<markings.length;++i){var m=markings[i],xrange=extractRange(m,"x"),yrange=extractRange(m,"y");if(xrange.from==null){xrange.from=xrange.axis.min;}
if(xrange.to==null){xrange.to=xrange.axis.max;}
if(yrange.from==null){yrange.from=yrange.axis.min;}
if(yrange.to==null){yrange.to=yrange.axis.max;}
if(xrange.to<xrange.axis.min||xrange.from>xrange.axis.max||yrange.to<yrange.axis.min||yrange.from>yrange.axis.max){continue;}
xrange.from=Math.max(xrange.from,xrange.axis.min);xrange.to=Math.min(xrange.to,xrange.axis.max);yrange.from=Math.max(yrange.from,yrange.axis.min);yrange.to=Math.min(yrange.to,yrange.axis.max);var xequal=xrange.from===xrange.to,yequal=yrange.from===yrange.to;if(xequal&&yequal){continue;}
xrange.from=Math.floor(xrange.axis.p2c(xrange.from));xrange.to=Math.floor(xrange.axis.p2c(xrange.to));yrange.from=Math.floor(yrange.axis.p2c(yrange.from));yrange.to=Math.floor(yrange.axis.p2c(yrange.to));if(xequal||yequal){var lineWidth=m.lineWidth||options.grid.markingsLineWidth,subPixel=lineWidth%2?0.5:0;ctx.beginPath();ctx.strokeStyle=m.color||options.grid.markingsColor;ctx.lineWidth=lineWidth;if(xequal){ctx.moveTo(xrange.to+subPixel,yrange.from);ctx.lineTo(xrange.to+subPixel,yrange.to);}else{ctx.moveTo(xrange.from,yrange.to+subPixel);ctx.lineTo(xrange.to,yrange.to+subPixel);}
ctx.stroke();}else{ctx.fillStyle=m.color||options.grid.markingsColor;ctx.fillRect(xrange.from,yrange.to,xrange.to-xrange.from,yrange.from-yrange.to);}}}}
function findEdges(axis){var box=axis.box,x=0,y=0;if(axis.direction==="x"){x=0;y=box.top-plotOffset.top+(axis.position==="top"?box.height:0);}else{y=0;x=box.left-plotOffset.left+(axis.position==="left"?box.width:0)+axis.boxPosition.centerX;}
return{x:x,y:y};};function alignPosition(lineWidth,pos){return((lineWidth%2)!==0)?Math.floor(pos)+0.5:pos;};function drawTickBar(axis){ctx.lineWidth=1;var edges=findEdges(axis),x=edges.x,y=edges.y;if(axis.show){var xoff=0,yoff=0;ctx.strokeStyle=axis.options.color;ctx.beginPath();if(axis.direction==="x"){xoff=plotWidth+1;}else{yoff=plotHeight+1;}
if(axis.direction==="x"){y=alignPosition(ctx.lineWidth,y);}else{x=alignPosition(ctx.lineWidth,x);}
ctx.moveTo(x,y);ctx.lineTo(x+xoff,y+yoff);ctx.stroke();}};function drawTickMarks(axis){var t=axis.tickLength,minorTicks=axis.showMinorTicks,minorTicksNr=MINOR_TICKS_COUNT_CONSTANT,edges=findEdges(axis),x=edges.x,y=edges.y,i=0;ctx.strokeStyle=axis.options.color;ctx.beginPath();for(i=0;i<axis.ticks.length;++i){var v=axis.ticks[i].v,xoff=0,yoff=0,xminor=0,yminor=0,j;if(!isNaN(v)&&v>=axis.min&&v<=axis.max){if(axis.direction==="x"){x=axis.p2c(v);yoff=t;if(axis.position==="top"){yoff=-yoff;}}else{y=axis.p2c(v);xoff=t;if(axis.position==="left"){xoff=-xoff;}}
if(axis.direction==="x"){x=alignPosition(ctx.lineWidth,x);}else{y=alignPosition(ctx.lineWidth,y);}
ctx.moveTo(x,y);ctx.lineTo(x+xoff,y+yoff);}
if(minorTicks===true&&i<axis.ticks.length-1){var v1=axis.ticks[i].v,v2=axis.ticks[i+1].v,step=(v2-v1)/(minorTicksNr+1);for(j=1;j<=minorTicksNr;j++){if(axis.direction==="x"){yminor=t/2;x=alignPosition(ctx.lineWidth,axis.p2c(v1+j*step))
if(axis.position==="top"){yminor=-yminor;}
if((x<0)||(x>plotWidth)){continue;}}else{xminor=t/2;y=alignPosition(ctx.lineWidth,axis.p2c(v1+j*step));if(axis.position==="left"){xminor=-xminor;}
if((y<0)||(y>plotHeight)){continue;}}
ctx.moveTo(x,y);ctx.lineTo(x+xminor,y+yminor);}}}
ctx.stroke();};function drawGridLines(axis){var overlappedWithBorder=function(value){var bw=options.grid.borderWidth;return(((typeof bw==="object"&&bw[axis.position]>0)||bw>0)&&(value===axis.min||value===axis.max));};ctx.strokeStyle=options.grid.tickColor;ctx.beginPath();var i;for(i=0;i<axis.ticks.length;++i){var v=axis.ticks[i].v,xoff=0,yoff=0,x=0,y=0;if(isNaN(v)||v<axis.min||v>axis.max)continue;if(overlappedWithBorder(v))continue;if(axis.direction==="x"){x=axis.p2c(v);y=plotHeight;yoff=-plotHeight;}else{x=0;y=axis.p2c(v);xoff=plotWidth;}
if(axis.direction==="x"){x=alignPosition(ctx.lineWidth,x);}else{y=alignPosition(ctx.lineWidth,y);}
ctx.moveTo(x,y);ctx.lineTo(x+xoff,y+yoff);}
ctx.stroke();};function drawBorder(){var bw=options.grid.borderWidth,bc=options.grid.borderColor;if(typeof bw==="object"||typeof bc==="object"){if(typeof bw!=="object"){bw={top:bw,right:bw,bottom:bw,left:bw};}
if(typeof bc!=="object"){bc={top:bc,right:bc,bottom:bc,left:bc};}
if(bw.top>0){ctx.strokeStyle=bc.top;ctx.lineWidth=bw.top;ctx.beginPath();ctx.moveTo(0-bw.left,0-bw.top/2);ctx.lineTo(plotWidth,0-bw.top/2);ctx.stroke();}
if(bw.right>0){ctx.strokeStyle=bc.right;ctx.lineWidth=bw.right;ctx.beginPath();ctx.moveTo(plotWidth+bw.right/2,0-bw.top);ctx.lineTo(plotWidth+bw.right/2,plotHeight);ctx.stroke();}
if(bw.bottom>0){ctx.strokeStyle=bc.bottom;ctx.lineWidth=bw.bottom;ctx.beginPath();ctx.moveTo(plotWidth+bw.right,plotHeight+bw.bottom/2);ctx.lineTo(0,plotHeight+bw.bottom/2);ctx.stroke();}
if(bw.left>0){ctx.strokeStyle=bc.left;ctx.lineWidth=bw.left;ctx.beginPath();ctx.moveTo(0-bw.left/2,plotHeight+bw.bottom);ctx.lineTo(0-bw.left/2,0);ctx.stroke();}}else{ctx.lineWidth=bw;ctx.strokeStyle=options.grid.borderColor;ctx.strokeRect(-bw/2,-bw/2,plotWidth+bw,plotHeight+bw);}};function drawGrid(){var axes,bw;ctx.save();ctx.translate(plotOffset.left,plotOffset.top);drawMarkings();axes=allAxes();bw=options.grid.borderWidth;for(var j=0;j<axes.length;++j){var axis=axes[j];if(!axis.show){continue;}
drawTickBar(axis);if(axis.showTicks===true){drawTickMarks(axis);}
if(axis.gridLines===true){drawGridLines(axis,bw);}}
if(bw){drawBorder();}
ctx.restore();}
function drawAxisLabels(){$.each(allAxes(),function(_,axis){var box=axis.box,legacyStyles=axis.direction+"Axis "+axis.direction+axis.n+"Axis",layer="flot-"+axis.direction+"-axis flot-"+axis.direction+axis.n+"-axis "+legacyStyles,font=axis.options.font||"flot-tick-label tickLabel",i,x,y,halign,valign,info,margin=3,nullBox={x:NaN,y:NaN,width:NaN,height:NaN},newLabelBox,labelBoxes=[],overlapping=function(x11,y11,x12,y12,x21,y21,x22,y22){return((x11<=x21&&x21<=x12)||(x21<=x11&&x11<=x22))&&((y11<=y21&&y21<=y12)||(y21<=y11&&y11<=y22));},overlapsOtherLabels=function(newLabelBox,previousLabelBoxes){return previousLabelBoxes.some(function(labelBox){return overlapping(newLabelBox.x,newLabelBox.y,newLabelBox.x+newLabelBox.width,newLabelBox.y+newLabelBox.height,labelBox.x,labelBox.y,labelBox.x+labelBox.width,labelBox.y+labelBox.height);});},drawAxisLabel=function(tick,labelBoxes){if(!tick||!tick.label||tick.v<axis.min||tick.v>axis.max){return nullBox;}
info=surface.getTextInfo(layer,tick.label,font);if(axis.direction==="x"){halign="center";x=plotOffset.left+axis.p2c(tick.v);if(axis.position==="bottom"){y=box.top+box.padding-axis.boxPosition.centerY;}else{y=box.top+box.height-box.padding+axis.boxPosition.centerY;valign="bottom";}
newLabelBox={x:x-info.width/2-margin,y:y-margin,width:info.width+2*margin,height:info.height+2*margin};}else{valign="middle";y=plotOffset.top+axis.p2c(tick.v);if(axis.position==="left"){x=box.left+box.width-box.padding-axis.boxPosition.centerX;halign="right";}else{x=box.left+box.padding+axis.boxPosition.centerX;}
newLabelBox={x:x-info.width/2-margin,y:y-margin,width:info.width+2*margin,height:info.height+2*margin};}
if(overlapsOtherLabels(newLabelBox,labelBoxes)){return nullBox;}
surface.addText(layer,x,y,tick.label,font,null,null,halign,valign);return newLabelBox;};surface.removeText(layer);executeHooks(hooks.drawAxis,[axis,surface]);if(!axis.show){return;}
switch(axis.options.showTickLabels){case 'none':break;case 'endpoints':labelBoxes.push(drawAxisLabel(axis.ticks[0],labelBoxes));labelBoxes.push(drawAxisLabel(axis.ticks[axis.ticks.length-1],labelBoxes));break;case 'major':labelBoxes.push(drawAxisLabel(axis.ticks[0],labelBoxes));labelBoxes.push(drawAxisLabel(axis.ticks[axis.ticks.length-1],labelBoxes));for(i=1;i<axis.ticks.length-1;++i){labelBoxes.push(drawAxisLabel(axis.ticks[i],labelBoxes));}
break;case 'all':labelBoxes.push(drawAxisLabel(axis.ticks[0],[]));labelBoxes.push(drawAxisLabel(axis.ticks[axis.ticks.length-1],labelBoxes));for(i=1;i<axis.ticks.length-1;++i){labelBoxes.push(drawAxisLabel(axis.ticks[i],labelBoxes));}
break;}});}
function drawSeries(series){if(series.lines.show){$.plot.drawSeries.drawSeriesLines(series,ctx,plotOffset,plotWidth,plotHeight,plot.drawSymbol,getColorOrGradient);}
if(series.bars.show){$.plot.drawSeries.drawSeriesBars(series,ctx,plotOffset,plotWidth,plotHeight,plot.drawSymbol,getColorOrGradient);}
if(series.points.show){$.plot.drawSeries.drawSeriesPoints(series,ctx,plotOffset,plotWidth,plotHeight,plot.drawSymbol,getColorOrGradient);}}
function computeRangeForDataSeries(series,force,isValid){var points=series.datapoints.points,ps=series.datapoints.pointsize,format=series.datapoints.format,topSentry=Number.POSITIVE_INFINITY,bottomSentry=Number.NEGATIVE_INFINITY,range={xmin:topSentry,ymin:topSentry,xmax:bottomSentry,ymax:bottomSentry};for(var j=0;j<points.length;j+=ps){if(points[j]===null){continue;}
if(typeof(isValid)==='function'&&!isValid(points[j])){continue;}
for(var m=0;m<ps;++m){var val=points[j+m],f=format[m];if(f===null||f===undefined){continue;}
if(typeof(isValid)==='function'&&!isValid(val)){continue;}
if((!force&&!f.computeRange)||val===Infinity||val===-Infinity){continue;}
if(f.x===true){if(val<range.xmin){range.xmin=val;}
if(val>range.xmax){range.xmax=val;}}
if(f.y===true){if(val<range.ymin){range.ymin=val;}
if(val>range.ymax){range.ymax=val;}}}}
return range;};function adjustSeriesDataRange(series,range){if(series.bars.show){var delta;var useAbsoluteBarWidth=series.bars.barWidth[1];if(series.datapoints&&series.datapoints.points&&!useAbsoluteBarWidth){computeBarWidth(series);}
var barWidth=series.bars.barWidth[0]||series.bars.barWidth;switch(series.bars.align){case "left":delta=0;break;case "right":delta=-barWidth;break;default:delta=-barWidth/2;}
if(series.bars.horizontal){range.ymin+=delta;range.ymax+=delta+barWidth;}else{range.xmin+=delta;range.xmax+=delta+barWidth;}}
if((series.bars.show&&series.bars.zero)||(series.lines.show&&series.lines.zero)){var ps=series.datapoints.pointsize;if(ps<=2){range.ymin=Math.min(0,range.ymin);range.ymax=Math.max(0,range.ymax);}}
return range;};function computeBarWidth(series){var xValues=[];var pointsize=series.datapoints.pointsize,minDistance=Number.MAX_VALUE;if(series.datapoints.points.length<=pointsize){minDistance=1;}
var start=series.bars.horizontal?1:0;for(let j=start;j<series.datapoints.points.length;j+=pointsize){if(isFinite(series.datapoints.points[j])&&series.datapoints.points[j]!==null){xValues.push(series.datapoints.points[j]);}}
function onlyUnique(value,index,self){return self.indexOf(value)===index;}
xValues=xValues.filter(onlyUnique);xValues.sort(function(a,b){return a-b});for(let j=1;j<xValues.length;j++){var distance=Math.abs(xValues[j]-xValues[j-1]);if(distance<minDistance&&isFinite(distance)){minDistance=distance;}}
if(typeof series.bars.barWidth==="number"){series.bars.barWidth=series.bars.barWidth*minDistance;}else{series.bars.barWidth[0]=series.bars.barWidth[0]*minDistance;}}
function findNearbyItems(mouseX,mouseY,seriesFilter,radius,computeDistance){var items=findItems(mouseX,mouseY,seriesFilter,radius,computeDistance);for(var i=0;i<series.length;++i){if(seriesFilter(i)){executeHooks(hooks.findNearbyItems,[mouseX,mouseY,series,i,radius,computeDistance,items]);}}
return items.sort((a,b)=>{if(b.distance===undefined){return-1;}else if(a.distance===undefined&&b.distance!==undefined){return 1;}
return a.distance-b.distance;});}
function findNearbyItem(mouseX,mouseY,seriesFilter,radius,computeDistance){var items=findNearbyItems(mouseX,mouseY,seriesFilter,radius,computeDistance);return items[0]!==undefined?items[0]:null;}
function findItems(mouseX,mouseY,seriesFilter,radius,computeDistance){var i,foundItems=[],items=[],smallestDistance=radius*radius+1;for(i=series.length-1;i>=0;--i){if(!seriesFilter(i))continue;var s=series[i];if(!s.datapoints)return;var foundPoint=false;if(s.lines.show||s.points.show){var found=findNearbyPoint(s,mouseX,mouseY,radius,computeDistance);if(found){items.push({seriesIndex:i,dataIndex:found.dataIndex,distance:found.distance});foundPoint=true;}}
if(s.bars.show&&!foundPoint){var foundIndex=findNearbyBar(s,mouseX,mouseY);if(foundIndex>=0){items.push({seriesIndex:i,dataIndex:foundIndex,distance:smallestDistance});}}}
for(i=0;i<items.length;i++){var seriesIndex=items[i].seriesIndex;var dataIndex=items[i].dataIndex;var itemDistance=items[i].distance;var ps=series[seriesIndex].datapoints.pointsize;foundItems.push({datapoint:series[seriesIndex].datapoints.points.slice(dataIndex*ps,(dataIndex+1)*ps),dataIndex:dataIndex,series:series[seriesIndex],seriesIndex:seriesIndex,distance:Math.sqrt(itemDistance)});}
return foundItems;}
function findNearbyPoint(series,mouseX,mouseY,maxDistance,computeDistance){var mx=series.xaxis.c2p(mouseX),my=series.yaxis.c2p(mouseY),maxx=maxDistance/series.xaxis.scale,maxy=maxDistance/series.yaxis.scale,points=series.datapoints.points,ps=series.datapoints.pointsize,smallestDistance=Number.POSITIVE_INFINITY;if(series.xaxis.options.inverseTransform){maxx=Number.MAX_VALUE;}
if(series.yaxis.options.inverseTransform){maxy=Number.MAX_VALUE;}
var found=null;for(var j=0;j<points.length;j+=ps){var x=points[j];var y=points[j+1];if(x==null){continue;}
if(x-mx>maxx||x-mx<-maxx||y-my>maxy||y-my<-maxy){continue;}
var dx=Math.abs(series.xaxis.p2c(x)-mouseX);var dy=Math.abs(series.yaxis.p2c(y)-mouseY);var dist=computeDistance?computeDistance(dx,dy):dx*dx+dy*dy;if(dist<smallestDistance){smallestDistance=dist;found={dataIndex:j/ps,distance:dist};}}
return found;}
function findNearbyBar(series,mouseX,mouseY){var barLeft,barRight,barWidth=series.bars.barWidth[0]||series.bars.barWidth,mx=series.xaxis.c2p(mouseX),my=series.yaxis.c2p(mouseY),points=series.datapoints.points,ps=series.datapoints.pointsize;switch(series.bars.align){case "left":barLeft=0;break;case "right":barLeft=-barWidth;break;default:barLeft=-barWidth/2;}
barRight=barLeft+barWidth;var fillTowards=series.bars.fillTowards||0;var defaultBottom=fillTowards>series.yaxis.min?Math.min(series.yaxis.max,fillTowards):series.yaxis.min;var foundIndex=-1;for(var j=0;j<points.length;j+=ps){var x=points[j],y=points[j+1];if(x==null){continue;}
var bottom=ps===3?points[j+2]:defaultBottom;if(series.bars.horizontal?(mx<=Math.max(bottom,x)&&mx>=Math.min(bottom,x)&&my>=y+barLeft&&my<=y+barRight):(mx>=x+barLeft&&mx<=x+barRight&&my>=Math.min(bottom,y)&&my<=Math.max(bottom,y))){foundIndex=j/ps;}}
return foundIndex;}
function findNearbyInterpolationPoint(posX,posY,seriesFilter){var i,j,dist,dx,dy,ps,item,smallestDistance=Number.MAX_VALUE;for(i=0;i<series.length;++i){if(!seriesFilter(i)){continue;}
var points=series[i].datapoints.points;ps=series[i].datapoints.pointsize;const comparer=points[points.length-ps]<points[0]?function(x1,x2){return x1>x2}:function(x1,x2){return x2>x1};if(comparer(posX,points[0])){continue;}
for(j=ps;j<points.length;j+=ps){if(comparer(posX,points[j])){break;}}
var y,p1x=points[j-ps],p1y=points[j-ps+1],p2x=points[j],p2y=points[j+1];if((p1x===undefined)||(p2x===undefined)||(p1y===undefined)||(p2y===undefined)){continue;}
if(p1x===p2x){y=p2y}else{y=p1y+(p2y-p1y)*(posX-p1x)/(p2x-p1x);}
posY=y;dx=Math.abs(series[i].xaxis.p2c(p2x)-posX);dy=Math.abs(series[i].yaxis.p2c(p2y)-posY);dist=dx*dx+dy*dy;if(dist<smallestDistance){smallestDistance=dist;item=[posX,posY,i,j];}}
if(item){i=item[2];j=item[3];ps=series[i].datapoints.pointsize;points=series[i].datapoints.points;p1x=points[j-ps];p1y=points[j-ps+1];p2x=points[j];p2y=points[j+1];return{datapoint:[item[0],item[1]],leftPoint:[p1x,p1y],rightPoint:[p2x,p2y],seriesIndex:i};}
return null;}
function triggerRedrawOverlay(){var t=options.interaction.redrawOverlayInterval;if(t===-1){drawOverlay();return;}
if(!redrawTimeout){redrawTimeout=setTimeout(function(){drawOverlay(plot);},t);}}
function drawOverlay(plot){redrawTimeout=null;if(!octx){return;}
overlay.clear();executeHooks(hooks.drawOverlay,[octx,overlay]);var event=new CustomEvent('onDrawingDone');plot.getEventHolder().dispatchEvent(event);plot.getPlaceholder().trigger('drawingdone');}
function getColorOrGradient(spec,bottom,top,defaultColor){if(typeof spec==="string"){return spec;}else{var gradient=ctx.createLinearGradient(0,top,0,bottom);for(var i=0,l=spec.colors.length;i<l;++i){var c=spec.colors[i];if(typeof c!=="string"){var co=$.color.parse(defaultColor);if(c.brightness!=null){co=co.scale('rgb',c.brightness);}
if(c.opacity!=null){co.a*=c.opacity;}
c=co.toString();}
gradient.addColorStop(i/(l-1),c);}
return gradient;}}}
$.plot=function(placeholder,data,options){var plot=new Plot($(placeholder),data,options,$.plot.plugins);return plot;};$.plot.version="3.0.0";$.plot.plugins=[];$.fn.plot=function(data,options){return this.each(function(){$.plot(this,data,options);});};$.plot.linearTickGenerator=defaultTickGenerator;$.plot.defaultTickFormatter=defaultTickFormatter;$.plot.expRepTickFormatter=expRepTickFormatter;})(jQuery);