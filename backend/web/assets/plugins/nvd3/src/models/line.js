nv.models.line=function(){"use strict";var scatter=nv.models.scatter();var margin={top:0,right:0,bottom:0,left:0},width=960,height=500,color=nv.utils.defaultColor()// a function that returns a color
,getX=function(d){return d.x},getY=function(d){return d.y},defined=function(d,i){return!isNaN(getY(d,i))&&getY(d,i)!==null},isArea=function(d){return d.area},clipEdge=false,x,y,interpolate="linear";scatter.size(16)// default size
.sizeDomain([16,256])//set to speed up calculation, needs to be unset if there is a custom size accessor
;var x0,y0;function chart(selection){selection.each(function(data){var availableWidth=width- margin.left- margin.right,availableHeight=height- margin.top- margin.bottom,container=d3.select(this);x=scatter.xScale();y=scatter.yScale();x0=x0||x;y0=y0||y;var wrap=container.selectAll('g.nv-wrap.nv-line').data([data]);var wrapEnter=wrap.enter().append('g').attr('class','nvd3 nv-wrap nv-line');var defsEnter=wrapEnter.append('defs');var gEnter=wrapEnter.append('g');var g=wrap.select('g')
gEnter.append('g').attr('class','nv-groups');gEnter.append('g').attr('class','nv-scatterWrap');wrap.attr('transform','translate('+ margin.left+','+ margin.top+')');scatter.width(availableWidth).height(availableHeight)
var scatterWrap=wrap.select('.nv-scatterWrap');scatterWrap.transition().call(scatter);defsEnter.append('clipPath').attr('id','nv-edge-clip-'+ scatter.id()).append('rect');wrap.select('#nv-edge-clip-'+ scatter.id()+' rect').attr('width',availableWidth).attr('height',(availableHeight>0)?availableHeight:0);g.attr('clip-path',clipEdge?'url(#nv-edge-clip-'+ scatter.id()+')':'');scatterWrap.attr('clip-path',clipEdge?'url(#nv-edge-clip-'+ scatter.id()+')':'');var groups=wrap.select('.nv-groups').selectAll('.nv-group').data(function(d){return d},function(d){return d.key});groups.enter().append('g').style('stroke-opacity',1e-6).style('fill-opacity',1e-6);groups.exit().remove();groups.attr('class',function(d,i){return'nv-group nv-series-'+ i}).classed('hover',function(d){return d.hover}).style('fill',function(d,i){return color(d,i)}).style('stroke',function(d,i){return color(d,i)});groups.transition().style('stroke-opacity',1).style('fill-opacity',.5);var areaPaths=groups.selectAll('path.nv-area').data(function(d){return isArea(d)?[d]:[]});areaPaths.enter().append('path').attr('class','nv-area').attr('d',function(d){return d3.svg.area().interpolate(interpolate).defined(defined).x(function(d,i){return nv.utils.NaNtoZero(x0(getX(d,i)))}).y0(function(d,i){return nv.utils.NaNtoZero(y0(getY(d,i)))}).y1(function(d,i){return y0(y.domain()[0]<=0?y.domain()[1]>=0?0:y.domain()[1]:y.domain()[0])})//.y1(function(d,i) { return y0(0) }) //assuming 0 is within y domain.. may need to tweak this
.apply(this,[d.values])});groups.exit().selectAll('path.nv-area').remove();areaPaths.transition().attr('d',function(d){return d3.svg.area().interpolate(interpolate).defined(defined).x(function(d,i){return nv.utils.NaNtoZero(x(getX(d,i)))}).y0(function(d,i){return nv.utils.NaNtoZero(y(getY(d,i)))}).y1(function(d,i){return y(y.domain()[0]<=0?y.domain()[1]>=0?0:y.domain()[1]:y.domain()[0])})//.y1(function(d,i) { return y0(0) }) //assuming 0 is within y domain.. may need to tweak this
.apply(this,[d.values])});var linePaths=groups.selectAll('path.nv-line').data(function(d){return[d.values]});linePaths.enter().append('path').attr('class','nv-line').attr('d',d3.svg.line().interpolate(interpolate).defined(defined).x(function(d,i){return nv.utils.NaNtoZero(x0(getX(d,i)))}).y(function(d,i){return nv.utils.NaNtoZero(y0(getY(d,i)))}));linePaths.transition().attr('d',d3.svg.line().interpolate(interpolate).defined(defined).x(function(d,i){return nv.utils.NaNtoZero(x(getX(d,i)))}).y(function(d,i){return nv.utils.NaNtoZero(y(getY(d,i)))}));x0=x.copy();y0=y.copy();});return chart;}
chart.dispatch=scatter.dispatch;chart.scatter=scatter;d3.rebind(chart,scatter,'id','interactive','size','xScale','yScale','zScale','xDomain','yDomain','xRange','yRange','sizeDomain','forceX','forceY','forceSize','clipVoronoi','useVoronoi','clipRadius','padData','highlightPoint','clearHighlights');chart.options=nv.utils.optionsFunc.bind(chart);chart.margin=function(_){if(!arguments.length)return margin;margin.top=typeof _.top!='undefined'?_.top:margin.top;margin.right=typeof _.right!='undefined'?_.right:margin.right;margin.bottom=typeof _.bottom!='undefined'?_.bottom:margin.bottom;margin.left=typeof _.left!='undefined'?_.left:margin.left;return chart;};chart.width=function(_){if(!arguments.length)return width;width=_;return chart;};chart.height=function(_){if(!arguments.length)return height;height=_;return chart;};chart.x=function(_){if(!arguments.length)return getX;getX=_;scatter.x(_);return chart;};chart.y=function(_){if(!arguments.length)return getY;getY=_;scatter.y(_);return chart;};chart.clipEdge=function(_){if(!arguments.length)return clipEdge;clipEdge=_;return chart;};chart.color=function(_){if(!arguments.length)return color;color=nv.utils.getColor(_);scatter.color(color);return chart;};chart.interpolate=function(_){if(!arguments.length)return interpolate;interpolate=_;return chart;};chart.defined=function(_){if(!arguments.length)return defined;defined=_;return chart;};chart.isArea=function(_){if(!arguments.length)return isArea;isArea=d3.functor(_);return chart;};return chart;}