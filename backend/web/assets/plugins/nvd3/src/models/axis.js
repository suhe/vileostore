nv.models.axis=function(){"use strict";var axis=d3.svg.axis();var margin={top:0,right:0,bottom:0,left:0},width=75,height=60,scale=d3.scale.linear(),axisLabelText=null,showMaxMin=true,highlightZero=true,rotateLabels=0,rotateYLabel=true,staggerLabels=false,isOrdinal=false,ticks=null,axisLabelDistance=12;axis.scale(scale).orient('bottom').tickFormat(function(d){return d});var scale0;function chart(selection){selection.each(function(data){var container=d3.select(this);var wrap=container.selectAll('g.nv-wrap.nv-axis').data([data]);var wrapEnter=wrap.enter().append('g').attr('class','nvd3 nv-wrap nv-axis');var gEnter=wrapEnter.append('g');var g=wrap.select('g')//------------------------------------------------------------
if(ticks!==null)
axis.ticks(ticks);else if(axis.orient()=='top'||axis.orient()=='bottom')
axis.ticks(Math.abs(scale.range()[1]- scale.range()[0])/ 100);
g.transition().call(axis);scale0=scale0||axis.scale();var fmt=axis.tickFormat();if(fmt==null){fmt=scale0.tickFormat();}
var axisLabel=g.selectAll('text.nv-axislabel').data([axisLabelText||null]);axisLabel.exit().remove();switch(axis.orient()){case'top':axisLabel.enter().append('text').attr('class','nv-axislabel');var w=(scale.range().length==2)?scale.range()[1]:(scale.range()[scale.range().length-1]+(scale.range()[1]-scale.range()[0]));axisLabel.attr('text-anchor','middle').attr('y',0).attr('x',w/2);if(showMaxMin){var axisMaxMin=wrap.selectAll('g.nv-axisMaxMin').data(scale.domain());axisMaxMin.enter().append('g').attr('class','nv-axisMaxMin').append('text');axisMaxMin.exit().remove();axisMaxMin.attr('transform',function(d,i){return'translate('+ scale(d)+',0)'}).select('text').attr('dy','-0.5em').attr('y',-axis.tickPadding()).attr('text-anchor','middle').text(function(d,i){var v=fmt(d);return(''+ v).match('NaN')?'':v;});axisMaxMin.transition().attr('transform',function(d,i){return'translate('+ scale.range()[i]+',0)'});}
break;case'bottom':var xLabelMargin=36;var maxTextWidth=30;var xTicks=g.selectAll('g').select("text");if(rotateLabels%360){xTicks.each(function(d,i){var width=this.getBBox().width;if(width>maxTextWidth)maxTextWidth=width;});var sin=Math.abs(Math.sin(rotateLabels*Math.PI/180));var xLabelMargin=(sin?sin*maxTextWidth:maxTextWidth)+30;xTicks.attr('transform',function(d,i,j){return'rotate('+ rotateLabels+' 0,0)'}).style('text-anchor',rotateLabels%360>0?'start':'end');}
axisLabel.enter().append('text').attr('class','nv-axislabel');var w=(scale.range().length==2)?scale.range()[1]:(scale.range()[scale.range().length-1]+(scale.range()[1]-scale.range()[0]));axisLabel.attr('text-anchor','middle').attr('y',xLabelMargin).attr('x',w/2);if(showMaxMin){var axisMaxMin=wrap.selectAll('g.nv-axisMaxMin')//.data(scale.domain())
.data([scale.domain()[0],scale.domain()[scale.domain().length- 1]]);axisMaxMin.enter().append('g').attr('class','nv-axisMaxMin').append('text');axisMaxMin.exit().remove();axisMaxMin.attr('transform',function(d,i){return'translate('+(scale(d)+(isOrdinal?scale.rangeBand()/ 2 : 0)) + ',0)'
}).select('text').attr('dy','.71em').attr('y',axis.tickPadding()).attr('transform',function(d,i,j){return'rotate('+ rotateLabels+' 0,0)'}).style('text-anchor',rotateLabels?(rotateLabels%360>0?'start':'end'):'middle').text(function(d,i){var v=fmt(d);return(''+ v).match('NaN')?'':v;});axisMaxMin.transition().attr('transform',function(d,i){return'translate('+(scale(d)+(isOrdinal?scale.rangeBand()/ 2 : 0)) + ',0)'
});}
if(staggerLabels)
xTicks.attr('transform',function(d,i){return'translate(0,'+(i%2==0?'0':'12')+')'});break;case'right':axisLabel.enter().append('text').attr('class','nv-axislabel');axisLabel.style('text-anchor',rotateYLabel?'middle':'begin').attr('transform',rotateYLabel?'rotate(90)':'').attr('y',rotateYLabel?(-Math.max(margin.right,width)+ 12):-10)//TODO: consider calculating this based on largest tick width... OR at least expose this on chart
.attr('x',rotateYLabel?(scale.range()[0]/2):axis.tickPadding());if(showMaxMin){var axisMaxMin=wrap.selectAll('g.nv-axisMaxMin').data(scale.domain());axisMaxMin.enter().append('g').attr('class','nv-axisMaxMin').append('text').style('opacity',0);axisMaxMin.exit().remove();axisMaxMin.attr('transform',function(d,i){return'translate(0,'+ scale(d)+')'}).select('text').attr('dy','.32em').attr('y',0).attr('x',axis.tickPadding()).style('text-anchor','start').text(function(d,i){var v=fmt(d);return(''+ v).match('NaN')?'':v;});axisMaxMin.transition().attr('transform',function(d,i){return'translate(0,'+ scale.range()[i]+')'}).select('text').style('opacity',1);}
break;case'left':axisLabel.enter().append('text').attr('class','nv-axislabel');axisLabel.style('text-anchor',rotateYLabel?'middle':'end').attr('transform',rotateYLabel?'rotate(-90)':'').attr('y',rotateYLabel?(-Math.max(margin.left,width)+ axisLabelDistance):-10)//TODO: consider calculating this based on largest tick width... OR at least expose this on chart
.attr('x',rotateYLabel?(-scale.range()[0]/2):-axis.tickPadding());if(showMaxMin){var axisMaxMin=wrap.selectAll('g.nv-axisMaxMin').data(scale.domain());axisMaxMin.enter().append('g').attr('class','nv-axisMaxMin').append('text').style('opacity',0);axisMaxMin.exit().remove();axisMaxMin.attr('transform',function(d,i){return'translate(0,'+ scale0(d)+')'}).select('text').attr('dy','.32em').attr('y',0).attr('x',-axis.tickPadding()).attr('text-anchor','end').text(function(d,i){var v=fmt(d);return(''+ v).match('NaN')?'':v;});axisMaxMin.transition().attr('transform',function(d,i){return'translate(0,'+ scale.range()[i]+')'}).select('text').style('opacity',1);}
break;}
axisLabel.text(function(d){return d});if(showMaxMin&&(axis.orient()==='left'||axis.orient()==='right')){g.selectAll('g')// the g's wrapping each tick
            .each(function(d,i) {
              d3.select(this).select('text').attr('opacity', 1);
              if (scale(d) < scale.range()[1] + 10 || scale(d) > scale.range()[0] - 10) { // 10 is assuming text height is 16... if d is 0, leave it!
                if (d > 1e-10 || d < -1e-10) // accounts for minor floating point errors... though could be problematic if the scale is EXTREMELY SMALL
                  d3.select(this).attr('opacity', 0);

                d3.select(this).select('text').attr('opacity', 0); // Don't remove the ZERO line!!
}});if(scale.domain()[0]==scale.domain()[1]&&scale.domain()[0]==0)
wrap.selectAll('g.nv-axisMaxMin').style('opacity',function(d,i){return!i?1:0});}
if(showMaxMin&&(axis.orient()==='top'||axis.orient()==='bottom')){var maxMinRange=[];wrap.selectAll('g.nv-axisMaxMin').each(function(d,i){try{if(i)// i== 1, max position
maxMinRange.push(scale(d)- this.getBBox().width- 4)//assuming the max and min labels are as wide as the next tick (with an extra 4 pixels just in case)
else
maxMinRange.push(scale(d)+ this.getBBox().width+ 4)}catch(err){if(i)// i== 1, max position
maxMinRange.push(scale(d)- 4)//assuming the max and min labels are as wide as the next tick (with an extra 4 pixels just in case)
else
maxMinRange.push(scale(d)+ 4)}});g.selectAll('g')// the g's wrapping each tick
            .each(function(d,i) {
              if (scale(d) < maxMinRange[0] || scale(d) > maxMinRange[1]) {
                if (d > 1e-10 || d < -1e-10) // accounts for minor floating point errors... though could be problematic if the scale is EXTREMELY SMALL
                  d3.select(this).remove();
                else
                  d3.select(this).select('text').remove(); // Don't remove the ZERO line!!
}});}
if(highlightZero)
g.selectAll('.tick').filter(function(d){return!parseFloat(Math.round(d.__data__*100000)/1000000) && (d.__data__ !== undefined) }) //this is because sometimes the 0 tick is a very small fraction, TODO: think of cleaner technique
.classed('zero',true);scale0=scale.copy();});return chart;}
chart.axis=axis;d3.rebind(chart,axis,'orient','tickValues','tickSubdivide','tickSize','tickPadding','tickFormat');d3.rebind(chart,scale,'domain','range','rangeBand','rangeBands');chart.options=nv.utils.optionsFunc.bind(chart);chart.margin=function(_){if(!arguments.length)return margin;margin.top=typeof _.top!='undefined'?_.top:margin.top;margin.right=typeof _.right!='undefined'?_.right:margin.right;margin.bottom=typeof _.bottom!='undefined'?_.bottom:margin.bottom;margin.left=typeof _.left!='undefined'?_.left:margin.left;return chart;}
chart.width=function(_){if(!arguments.length)return width;width=_;return chart;};chart.ticks=function(_){if(!arguments.length)return ticks;ticks=_;return chart;};chart.height=function(_){if(!arguments.length)return height;height=_;return chart;};chart.axisLabel=function(_){if(!arguments.length)return axisLabelText;axisLabelText=_;return chart;}
chart.showMaxMin=function(_){if(!arguments.length)return showMaxMin;showMaxMin=_;return chart;}
chart.highlightZero=function(_){if(!arguments.length)return highlightZero;highlightZero=_;return chart;}
chart.scale=function(_){if(!arguments.length)return scale;scale=_;axis.scale(scale);isOrdinal=typeof scale.rangeBands==='function';d3.rebind(chart,scale,'domain','range','rangeBand','rangeBands');return chart;}
chart.rotateYLabel=function(_){if(!arguments.length)return rotateYLabel;rotateYLabel=_;return chart;}
chart.rotateLabels=function(_){if(!arguments.length)return rotateLabels;rotateLabels=_;return chart;}
chart.staggerLabels=function(_){if(!arguments.length)return staggerLabels;staggerLabels=_;return chart;};chart.axisLabelDistance=function(_){if(!arguments.length)return axisLabelDistance;axisLabelDistance=_;return chart;};return chart;}