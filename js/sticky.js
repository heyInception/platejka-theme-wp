/**
 * Sticky.js
 * Library for sticky elements written in vanilla javascript. With this library you can easily set sticky elements on your website. It's also responsive.
 *
 * @version 1.3.0
 * @author Rafal Galus <biuro@rafalgalus.pl>
 * @website https://rgalus.github.io/sticky-js/
 * @repo https://github.com/rgalus/sticky-js
 * @license https://github.com/rgalus/sticky-js/blob/master/LICENSE
 */
class Sticky{constructor(selector='',options={}){this.selector=selector;this.elements=[];this.version='1.3.0';this.vp=this.getViewportSize();this.body=document.querySelector('body');this.options={wrap:options.wrap||!1,wrapWith:options.wrapWith||'<span></span>',marginTop:options.marginTop||0,marginBottom:options.marginBottom||0,stickyFor:options.stickyFor||0,stickyClass:options.stickyClass||null,stickyContainer:options.stickyContainer||'body',};this.updateScrollTopPosition=this.updateScrollTopPosition.bind(this);this.updateScrollTopPosition();window.addEventListener('load',this.updateScrollTopPosition);window.addEventListener('scroll',this.updateScrollTopPosition);this.run()}
run(){const pageLoaded=setInterval(()=>{if(document.readyState==='complete'){clearInterval(pageLoaded);const elements=document.querySelectorAll(this.selector);this.forEach(elements,(element)=>this.renderElement(element))}},10)}
renderElement(element){element.sticky={};element.sticky.active=!1;element.sticky.marginTop=parseInt(element.getAttribute('data-margin-top'))||this.options.marginTop;element.sticky.marginBottom=parseInt(element.getAttribute('data-margin-bottom'))||this.options.marginBottom;element.sticky.stickyFor=parseInt(element.getAttribute('data-sticky-for'))||this.options.stickyFor;element.sticky.stickyClass=element.getAttribute('data-sticky-class')||this.options.stickyClass;element.sticky.wrap=element.hasAttribute('data-sticky-wrap')?!0:this.options.wrap;element.sticky.stickyContainer=this.options.stickyContainer;element.sticky.container=this.getStickyContainer(element);element.sticky.container.rect=this.getRectangle(element.sticky.container);element.sticky.rect=this.getRectangle(element);if(element.tagName.toLowerCase()==='img'){element.onload=()=>element.sticky.rect=this.getRectangle(element)}
if(element.sticky.wrap){this.wrapElement(element)}
this.activate(element)}
wrapElement(element){element.insertAdjacentHTML('beforebegin',element.getAttribute('data-sticky-wrapWith')||this.options.wrapWith);element.previousSibling.appendChild(element)}
activate(element){if(((element.sticky.rect.top+element.sticky.rect.height)<(element.sticky.container.rect.top+element.sticky.container.rect.height))&&(element.sticky.stickyFor<this.vp.width)&&!element.sticky.active){element.sticky.active=!0}
if(this.elements.indexOf(element)<0){this.elements.push(element)}
if(!element.sticky.resizeEvent){this.initResizeEvents(element);element.sticky.resizeEvent=!0}
if(!element.sticky.scrollEvent){this.initScrollEvents(element);element.sticky.scrollEvent=!0}
this.setPosition(element)}
initResizeEvents(element){element.sticky.resizeListener=()=>this.onResizeEvents(element);window.addEventListener('resize',element.sticky.resizeListener)}
destroyResizeEvents(element){window.removeEventListener('resize',element.sticky.resizeListener)}
onResizeEvents(element){this.vp=this.getViewportSize();element.sticky.rect=this.getRectangle(element);element.sticky.container.rect=this.getRectangle(element.sticky.container);if(((element.sticky.rect.top+element.sticky.rect.height)<(element.sticky.container.rect.top+element.sticky.container.rect.height))&&(element.sticky.stickyFor<this.vp.width)&&!element.sticky.active){element.sticky.active=!0}else if(((element.sticky.rect.top+element.sticky.rect.height)>=(element.sticky.container.rect.top+element.sticky.container.rect.height))||element.sticky.stickyFor>=this.vp.width&&element.sticky.active){element.sticky.active=!1}
this.setPosition(element)}
initScrollEvents(element){element.sticky.scrollListener=()=>this.onScrollEvents(element);window.addEventListener('scroll',element.sticky.scrollListener)}
destroyScrollEvents(element){window.removeEventListener('scroll',element.sticky.scrollListener)}
onScrollEvents(element){if(element.sticky&&element.sticky.active){this.setPosition(element)}}
setPosition(element){this.css(element,{position:'',width:'',top:'',left:''});if((this.vp.height<element.sticky.rect.height)||!element.sticky.active){return}
if(!element.sticky.rect.width){element.sticky.rect=this.getRectangle(element)}
if(element.sticky.wrap){this.css(element.parentNode,{display:'block',width:element.sticky.rect.width+'px',height:element.sticky.rect.height+'px',})}
if(element.sticky.rect.top===0&&element.sticky.container===this.body){this.css(element,{position:'fixed',top:element.sticky.rect.top+'px',left:element.sticky.rect.left+'px',width:element.sticky.rect.width+'px',});if(element.sticky.stickyClass){element.classList.add(element.sticky.stickyClass)}}else if(this.scrollTop>(element.sticky.rect.top-element.sticky.marginTop)){this.css(element,{position:'fixed',width:element.sticky.rect.width+'px',left:element.sticky.rect.left+'px',});if((this.scrollTop+element.sticky.rect.height+element.sticky.marginTop)>(element.sticky.container.rect.top+element.sticky.container.offsetHeight-element.sticky.marginBottom)){if(element.sticky.stickyClass){element.classList.remove(element.sticky.stickyClass)}
this.css(element,{top:(element.sticky.container.rect.top+element.sticky.container.offsetHeight)-(this.scrollTop+element.sticky.rect.height+element.sticky.marginBottom)+'px'})}else{if(element.sticky.stickyClass){element.classList.add(element.sticky.stickyClass)}
this.css(element,{top:element.sticky.marginTop+'px'})}}else{if(element.sticky.stickyClass){element.classList.remove(element.sticky.stickyClass)}
this.css(element,{position:'',width:'',top:'',left:''});if(element.sticky.wrap){this.css(element.parentNode,{display:'',width:'',height:''})}}}
update(){this.forEach(this.elements,(element)=>{element.sticky.rect=this.getRectangle(element);element.sticky.container.rect=this.getRectangle(element.sticky.container);this.activate(element);this.setPosition(element)})}
destroy(){window.removeEventListener('load',this.updateScrollTopPosition);window.removeEventListener('scroll',this.updateScrollTopPosition);this.forEach(this.elements,(element)=>{this.destroyResizeEvents(element);this.destroyScrollEvents(element);delete element.sticky})}
getStickyContainer(element){let container=element.parentNode;while(!container.hasAttribute('data-sticky-container')&&!container.parentNode.querySelector(element.sticky.stickyContainer)&&container!==this.body){container=container.parentNode}
return container}
getRectangle(element){this.css(element,{position:'',width:'',top:'',left:''});const width=Math.max(element.offsetWidth,element.clientWidth,element.scrollWidth);const height=Math.max(element.offsetHeight,element.clientHeight,element.scrollHeight);let top=0;let left=0;do{top+=element.offsetTop||0;left+=element.offsetLeft||0;element=element.offsetParent}while(element);return{top,left,width,height}}
getViewportSize(){return{width:Math.max(document.documentElement.clientWidth,window.innerWidth||0),height:Math.max(document.documentElement.clientHeight,window.innerHeight||0),}}
updateScrollTopPosition(){this.scrollTop=(window.pageYOffset||document.scrollTop)-(document.clientTop||0)||0}
forEach(array,callback){for(let i=0,len=array.length;i<len;i++){callback(array[i])}}
css(element,properties){for(let property in properties){if(properties.hasOwnProperty(property)){element.style[property]=properties[property]}}}}((root,factory)=>{if(typeof exports!=='undefined'){module.exports=factory}else if(typeof define==='function'&&define.amd){define([],function(){return factory})}else{root.Sticky=factory}})(this,Sticky)