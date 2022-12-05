(function(a){a.jqx.jqxWidget("jqxMenu","",{});a.extend(a.jqx._jqxMenu.prototype,{defineInstance:function(){this.items=new Array();this.mode="horizontal";this.width=null;this.height=null;this.easing="easeInOutCirc";this.animationShowDuration=350;this.animationHideDuration=250;this.animationHideDelay=100;this.animationShowDelay=200;this.menuElements=new Array();this.autoSizeMainItems=true;this.autoCloseOnClick=true;this.enableRoundedCorners=true;this.disabled=false;this.autoOpenPopup=true;this.enableHover=true;this.autoOpen=true;this.autoGenerate=true;this.clickToOpen=false;this.showTopLevelArrows=false;this.events=["shown","closed","itemclick","initialized"]},createInstance:function(c){var b=this;this.propertyChangeMap.disabled=function(e,g,f,h){if(b.disabled){b.host.addClass(b.toThemeProperty("jqx-menu-disabled"))}else{b.host.removeClass(b.toThemeProperty("jqx-menu-disabled"))}};if(this.width!=null&&this.width.toString().indexOf("px")!=-1){this.host.width(this.width)}else{if(this.width!=undefined&&!isNaN(this.width)){this.host.width(this.width)}}if(this.height!=null&&this.height.toString().indexOf("px")!=-1){this.host.height(this.height)}else{if(this.height!=undefined&&!isNaN(this.height)){this.host.height(this.height)}}if(this.disabled){this.host.addClass(this.toThemeProperty("jqx-menu-disabled"))}if(this.element.innerHTML.indexOf("UL")){var d=this.host.find("ul:first");if(d.length>0){this.createMenu(d[0])}}this._render()},refresh:function(){if(this.width!=null&&this.width.toString().indexOf("px")!=-1){this.host.width(this.width)}else{if(this.width!=undefined&&!isNaN(this.width)){this.host.width(this.width)}}if(this.height!=null&&this.height.toString().indexOf("px")!=-1){this.host.height(this.height)}else{if(this.height!=undefined&&!isNaN(this.height)){this.host.height(this.height)}}},_closeAll:function(f){var d=f!=null?f.data:this;var b=d.items;a.each(b,function(){var e=this;if(e.isOpen==true){d._closeItem(d,e)}});if(d.mode=="popup"){if(f!=null){var c=d._isRightClick(f);if(!c){d.close()}}}},closeItem:function(e){if(e==null){return false}var b=e;var c=document.getElementById(b);var d=this;a.each(items,function(){var f=this;if(f.isOpen==true&&f.element==c){d._closeItem(d,f);if(f.parentId){d.closeItem(f.parentId)}}});return true},openItem:function(e){if(e==null){return false}var b=e;var c=document.getElementById(b);var d=this;a.each(d.items,function(){var f=this;if(f.isOpen==false&&f.element==c){d._openItem(d,f);if(f.parentId){d.openItem(f.parentId)}}});return true},_getClosedSubMenuOffset:function(c){var b=a(c.subMenuElement);var f=-b.outerHeight();var e=-b.outerWidth();var d=c.level==0&&this.mode=="horizontal";if(d){e=0}else{f=0}switch(c.openVerticalDirection){case"up":case"center":f=b.outerHeight();break}switch(c.openHorizontalDirection){case"left":if(d){e=0}else{e=b.outerWidth()}break;case"center":if(d){e=0}else{e=b.outerWidth()}break}return{left:e,top:f}},_closeItem:function(l,o,g,c){if(l==null||o==null){return false}var j=a(o.subMenuElement);var b=o.level==0&&this.mode=="horizontal";var f=this._getClosedSubMenuOffset(o);var m=f.top;var e=f.left;$menuElement=a(o.element);var k=j.closest("div.jqx-menu-popup");if(k!=null){var h=l.animationHideDelay;if(c==true){h=0}if(j.data("timer").show!=null){clearTimeout(j.data("timer").show);j.data("timer").show=null}var n=function(){o.isOpen=false;if(b){j.stop().animate({top:m},l.animationHideDuration,function(){a(o.element).removeClass(l.toThemeProperty("jqx-menu-item-top-selected"));var p=a(o.arrow);if(p.length>0&&l.showTopLevelArrows){p.removeClass();if(o.openVerticalDirection=="down"){p.addClass(l.toThemeProperty("jqx-menu-item-arrow-down"))}else{p.addClass(l.toThemeProperty("jqx-menu-item-arrow-up"))}}k.css({display:"none"});l._raiseEvent("1",o)})}else{j.stop().animate({left:e},l.animationHideDuration,function(){if(o.level>0){a(o.element).removeClass(l.toThemeProperty("jqx-menu-item-selected"));var p=a(o.arrow);if(p.length>0){p.removeClass();if(o.openHorizontalDirection!="left"){p.addClass(l.toThemeProperty("jqx-menu-item-arrow-right"))}else{p.addClass(l.toThemeProperty("jqx-menu-item-arrow-left"))}}}else{a(o.element).removeClass(l.toThemeProperty("jqx-menu-item-top-selected"));var p=a(o.arrow);if(p.length>0){p.removeClass();if(o.openHorizontalDirection!="left"){p.addClass(l.toThemeProperty("jqx-menu-item-arrow-top-right"))}else{p.addClass(l.toThemeProperty("jqx-menu-item-arrow-top-left"))}}}k.css({display:"none"});l._raiseEvent("1",o)})}};if(h>0){j.data("timer").hide=setTimeout(function(){n()},h)}else{n()}if(g!=undefined&&g){var d=j.find("."+l.toThemeProperty("jqx-menu-item"));a.each(d,function(){if(l.menuElements[this.id]&&l.menuElements[this.id].isOpen){var p=a(l.menuElements[this.id].subMenuElement);l._closeItem(l,l.menuElements[this.id],true,true)}})}}},getSubItems:function(j,h){if(j==null){return false}var g=this;var c=new Array();if(h!=null){a.extend(c,h)}var d=j;var f=this.menuElements[d];var b=a(f.subMenuElement);var e=b.find(".jqx-menu-item");a.each(e,function(){c[this.id]=g.menuElements[this.id];var k=g.getSubItems(this.id,c);a.extend(c,k)});return c},disable:function(g,d){if(g==null){return}var c=g;var f=this;if(this.menuElements[c]){var e=this.menuElements[c];e.disabled=d;var b=a(e.element);if(d){b.addClass(f.toThemeProperty("jqx-menu-item-disabled"))}else{b.removeClass(f.toThemeProperty("jqx-menu-item-disabled"))}}},setItemOpenDirection:function(d,c,e){if(d==null){return}var k=d;var g=this;var f=a.browser.msie&&a.browser.version<8;if(this.menuElements[k]){var j=this.menuElements[k];if(c!=null){j.openHorizontalDirection=c;if(j.hasItems&&j.level>0){var h=a(j.element);var b=a(j.arrow);if(j.arrow==null){b=a('<span id="arrow'+h[0].id+'"></span>');if(!f){b.prependTo(h)}else{b.appendTo(h)}}b.removeClass();if(j.openHorizontalDirection=="left"){b.addClass(g.toThemeProperty("jqx-menu-item-arrow-left"))}else{b.addClass(g.toThemeProperty("jqx-menu-item-arrow-right"))}b.css("visibility","visible");if(!f){b.css("display","block");b.css("float","right")}else{b.css("display","inline-block");b.css("float","none")}}}if(e!=null){j.openVerticalDirection=e;var b=a(j.arrow);if(j.arrow==null){b=a('<span id="arrow'+h[0].id+'"></span>');if(!f){b.prependTo(h)}else{b.appendTo(h)}}b.removeClass();if(j.openVerticalDirection=="down"){b.addClass(g.toThemeProperty("jqx-menu-item-arrow-down"))}else{b.addClass(g.toThemeProperty("jqx-menu-item-arrow-up"))}b.css("visibility","visible");if(!f){b.css("display","block");b.css("float","right")}else{b.css("display","inline-block");b.css("float","none")}}}},_anyOpenedTopLevelItems:function(){for(i=0;i<this.items.length;i++){if(this.items[i].level==0&&this.items[i].element.className.indexOf(this.toThemeProperty("jqx-menu-item-top-selected"))!=-1){return true}}return false},_getOpenedTopLevelItems:function(){for(i=0;i<this.items.length;i++){if(this.items[i].level==0&&this.items[i].element.className.indexOf(this.toThemeProperty("jqx-menu-item-top-selected"))!=-1){return this.items[i]}}return null},_getSiblings:function(c){var d=new Array();var b=0;for(i=0;i<this.items.length;i++){if(this.items[i]==c){continue}if(this.items[i].parentId==c.parentId&&this.items[i].hasItems){d[b++]=this.items[i]}}return d},_getOpenedOnLevelItems:function(b){var c=b.level;for(i=0;i<this.items.length;i++){if(this.items[i]==b){continue}if(this.items[i].level==c&&(this.items[i].element.className.indexOf(this.toThemeProperty("jqx-menu-item-top-selected"))!=-1||this.items[i].element.className.indexOf(this.toThemeProperty("jqx-menu-item-selected"))!=-1||this.items[i].element.className.indexOf(this.toThemeProperty("jqx-menu-item-top-hover"))!=-1||this.items[i].element.className.indexOf(this.toThemeProperty("jqx-menu-item-hover"))!=-1)){return this.items[i]}}return null},_openItem:function(n,q,p){if(n==null||q==null){return false}if(q.isOpen){return false}if(q.disabled){return false}if(n.disabled){return false}var d=1000;if(p!=undefined){d=p}var e=[5,5];var j=a(q.subMenuElement);if(j!=null){j.stop()}if(j.data("timer").hide!=null){clearTimeout(j.data("timer").hide)}var m=j.closest("div.jqx-menu-popup");var h=a(q.element);var g=q.level==0?this._getOffset(q.element):h.position();if(q.level==0&&this.mode=="popup"){g=h.offset()}var b=q.level==0&&this.mode=="horizontal";var r=b?g.left:this.menuElements[q.parentId]!=null&&this.menuElements[q.parentId].subMenuElement!=null?parseInt(a(a(this.menuElements[q.parentId].subMenuElement).closest("div.jqx-menu-popup")).outerWidth())-e[0]:parseInt(j.outerWidth());m.css({visibility:"visible",display:"block",left:-1+r,top:b?g.top+h.outerHeight():g.top,zIndex:d});j.css("display","block");if(this.mode!="horizontal"&&q.level==0){var l=this._getOffset(this.element);m.css("left",-1+l.left+this.host.outerWidth());j.css("left",-j.outerWidth())}else{var f=this._getClosedSubMenuOffset(q);j.css("left",f.left);j.css("top",f.top)}m.css({height:parseInt(j.outerHeight())+parseInt(e[1])+"px"});var o=0;var c=0;switch(q.openVerticalDirection){case"up":if(b){j.css("top",j.outerHeight());o=e[1];m.css({display:"block",top:g.top-m.outerHeight(),zIndex:d})}else{o=e[1];j.css("top",j.outerHeight());m.css({display:"block",top:g.top-m.outerHeight()+e[1]+h.outerHeight(),zIndex:d})}break;case"center":if(b){j.css("top",0);m.css({display:"block",top:g.top-m.outerHeight()/2+e[1],zIndex:d})}else{j.css("top",0);m.css({display:"block",top:g.top+h.outerHeight()/2-m.outerHeight()/2+e[1],zIndex:d})}break}switch(q.openHorizontalDirection){case"left":if(b){m.css({left:g.left-(m.outerWidth()-h.outerWidth()-e[0])})}else{c=e[0];j.css("left",m.outerWidth());m.css({left:g.left-(m.outerWidth())})}break;case"center":if(b){m.css({left:g.left-(m.outerWidth()/2-h.outerWidth()/2-e[0]/2)})}else{m.css({left:g.left-(m.outerWidth()/2-h.outerWidth()/2-e[0]/2)});j.css("left",m.outerWidth())}break}if(b){if(parseInt(j.css("top"))==o){q.isOpen=true;return}}else{if(parseInt(j.css("left"))==c){q.isOpen==true;return}}a.each(n._getSiblings(q),function(){n._closeItem(n,this,true,true)});var k=a.data(n.element,"animationHideDelay");n.animationHideDelay=k;j.data("timer").show=setTimeout(function(){if(m!=null){if(b){j.stop();j.css("left",c);h.addClass(n.toThemeProperty("jqx-menu-item-top-selected"));var s=a(q.arrow);if(s.length>0&&n.showTopLevelArrows){s.removeClass();if(q.openVerticalDirection=="down"){s.addClass(n.toThemeProperty("jqx-menu-item-arrow-down-selected"))}else{s.addClass(n.toThemeProperty("jqx-menu-item-arrow-up-selected"))}}j.animate({top:o},n.animationShowDuration,n.easing,function(){q.isOpen=true;n._raiseEvent("0",q)})}else{j.stop();j.css("top",o);if(q.level>0){h.addClass(n.toThemeProperty("jqx-menu-item-selected"));var s=a(q.arrow);if(s.length>0){s.removeClass();if(q.openHorizontalDirection!="left"){s.addClass(n.toThemeProperty("jqx-menu-item-arrow-right-selected"))}else{s.addClass(n.toThemeProperty("jqx-menu-item-arrow-left-selected"))}}}else{h.addClass(n.toThemeProperty("jqx-menu-item-top-selected"));var s=a(q.arrow);if(s.length>0){s.removeClass();if(q.openHorizontalDirection!="left"){s.addClass(n.toThemeProperty("jqx-menu-item-arrow-right-selected"))}else{s.addClass(n.toThemeProperty("jqx-menu-item-arrow-left-selected"))}}}j.animate({left:c},n.animationShowDuration,n.easing,function(){n._raiseEvent("0",q);q.isOpen=true})}}},this.animationShowDelay)},_getMaxHeight:function(b){if(b==0){}},_applyOrientation:function(h,c){var f=this;var e=0;this.host.removeClass(f.toThemeProperty("jqx-menu-horizontal"));this.host.removeClass(f.toThemeProperty("jqx-menu-vertical"));this.host.removeClass(f.toThemeProperty("jqx-menu"));this.host.addClass(f.toThemeProperty("jqx-menu"));if(h!=undefined&&c!=undefined&&c=="popup"){if(this.host.parent().length>0&&this.host.parent().parent().length>0&&this.host.parent().parent()[0]==document.body){var g=a.data(document.body,"jqxMenuOldHost"+this.element.id);if(g!=null){var d=this.host.closest("div.jqx-menu-wrapper");d.remove();d.appendTo(g);this.host.css("display","block");this.host.css("visibility","visible");d.css("display","block");d.css("visibility","visible")}}}else{if(h==undefined&&c==undefined){a.data(document.body,"jqxMenuOldHost"+this.element.id,this.host.parent()[0])}}if(this.autoOpenPopup){if(this.mode=="popup"){a(document).bind("contextmenu",function(j){return false});a(document).bind("mousedown",f,this._openContextMenu)}else{a(document).unbind("contextmenu");a(document).unbind("mousedown",this._openContextMenu)}}else{a(document).unbind("contextmenu");a(document).unbind("mousedown",this._openContextMenu)}switch(this.mode){case"horizontal":this.host.addClass(f.toThemeProperty("jqx-menu-horizontal"));a.each(this.items,function(){var l=this;$element=a(l.element);var k=a(l.arrow);k.removeClass();if(l.hasItems&&l.level>0){var k=a('<span id="arrow'+$element[0].id+'"></span>');k.prependTo($element);k.css("float","right");k.addClass(f.toThemeProperty("jqx-menu-item-arrow-right"));l.arrow=k[0]}if(l.level==0){a(l.element).css("float","left");if(l.hasItems&&f.showTopLevelArrows){var k=a('<span id="arrow'+$element[0].id+'"></span>');var j=a.browser.msie&&a.browser.version<8;if(l.arrow==null){if(!j){k.prependTo($element)}else{k.appendTo($element)}}else{k=a(l.arrow)}if(l.openVerticalDirection=="down"){k.addClass(f.toThemeProperty("jqx-menu-item-arrow-down"))}else{k.addClass(f.toThemeProperty("jqx-menu-item-arrow-up"))}k.css("visibility","visible");if(!j){k.css("display","block");k.css("float","right")}else{k.css("display","inline-block")}l.arrow=k[0]}else{if(l.hasItems&&!f.showTopLevelArrows){if(l.arrow!=null){var k=a(l.arrow);k.remove();l.arrow=null}}}e=Math.max(e,$element.height())}});if(f.autoSizeMainItems){if(parseInt(e)>parseInt(this.host.height())){e=parseInt(this.host.height())}e=parseInt(this.host.height());a.each(this.items,function(){var r=this;$element=a(r.element);if(r.level==0&&e>0){var j=$element.children().length>0?parseInt($element.children().height()):$element.height();var m=f.host.find("ul:first");var n=parseInt(m.css("padding-top"));var s=parseInt(m.css("margin-top"));var p=e-2*(s+n);var o=parseInt(p)/2-j/2;var k=parseInt(o);var q=parseInt(o);$element.css("padding-top",k);$element.css("padding-bottom",q);if(parseInt($element.outerHeight())>p){var l=1;$element.css("padding-top",k-l);k=k-l}}})}break;case"vertical":case"popup":this.host.addClass(f.toThemeProperty("jqx-menu-vertical"));a.each(this.items,function(){var k=this;$element=a(k.element);if(k.hasItems){var j=a('<span id="arrow'+$element[0].id+'"></span>');j.prependTo($element);j.css("float","right");if(k.level==0){j.addClass(f.toThemeProperty("jqx-menu-item-arrow-top-right"))}else{j.addClass(f.toThemeProperty("jqx-menu-item-arrow-right"))}k.arrow=j[0]}$element.css("float","none")});if(this.mode=="popup"){this.host.wrap('<div class="jqx-menu-wrapper" style="z-index:'+9999+';padding: 0px; margin: 0px; position: absolute; top: 0; left: 0; display: block; visibility: visible;"></div>');var d=this.host.closest("div.jqx-menu-wrapper");d.appendTo(a(document.body))}if(this.mode=="popup"){var b=this.host.height();this.host.css("position","absolute");this.host.css("top","0");this.host.css("left","0");this.host.height(b);this.host.css("display","none");this.host.css("visibility","hidden")}break}},_getOffset:function(b){var f=a(window).scrollTop();var h=a(window).scrollLeft();var c=a.jqx.mobile.isSafariMobileBrowser();var g=a(b).offset();var e=g.top;var d=g.left;if(c!=null&&c){return{left:d-h,top:e-f}}else{return a(b).offset()}},_isRightClick:function(c){var b;if(!c){var c=window.event}if(c.which){b=(c.which==3)}else{if(c.button){b=(c.button==2)}}return b},_openContextMenu:function(d){var c=d.data;var b=c._isRightClick(d);if(b){c.open(parseInt(d.clientX)+5,parseInt(d.clientY)+5)}},close:function(){var c=this;var d=a.data(this.element,"contextMenuOpened");if(d){var b=this.host;a.each(c.items,function(){var e=this;if(e.hasItems){c._closeItem(c,e)}});a.each(c.items,function(){var e=this;if(e.isOpen==true){$submenu=a(e.subMenuElement);var f=$submenu.closest("div.jqx-menu-popup");f.hide(this.animationHideDuration)}});this.host.hide(this.animationHideDuration);a.data(c.element,"contextMenuOpened",false);c._raiseEvent("1",c)}},open:function(e,d){if(this.mode=="popup"){var c=0;if(this.host.css("display")=="block"){this.close();c=this.animationHideDuration}var b=this;if(e==undefined||e==null){e=0}if(d==undefined||d==null){d=0}setTimeout(function(){b.host.show(b.animationShowDuration);a.data(b.element,"contextMenuOpened",true);b._raiseEvent("0",b);b.host.css("z-index",9999);if(e!=undefined&&d!=undefined){b.host.css({left:e,top:d})}},c)}},_renderHover:function(c,e,b){var d=this;if(!b){c.unbind("hover");c.hover(function(){if(!e.disabled&&!e.separator&&d.enableHover&&!d.disabled){if(e.level>0){c.addClass(d.toThemeProperty("jqx-menu-item-hover"))}else{c.addClass(d.toThemeProperty("jqx-menu-item-top-hover"))}}},function(){if(!e.disabled&&!e.separator&&d.enableHover&&!d.disabled){if(e.level>0){c.removeClass(d.toThemeProperty("jqx-menu-item-hover"))}else{c.removeClass(d.toThemeProperty("jqx-menu-item-top-hover"))}}})}},_render:function(f,b){var g=1000;var c=[5,5];var e=this;a.data(e.element,"animationHideDelay",e.animationHideDelay);var d=a.jqx.mobile.isTouchDevice();a.data(document.body,"menuel",this);if(this.autoCloseOnClick){this.removeHandler(a(document),"mousedown",e._closeAll);this.addHandler(a(document),"mousedown",e._closeAll,e)}this._applyOrientation(f,b);this.host.css("visibility","visible");a.each(this.items,function(){var p=this;var l=a(p.element);if(e.enableRoundedCorners){l.addClass(e.toThemeProperty("jqx-rc-all"))}e.removeHandler(l,"mousedown");e.removeHandler(l,"mousedown");e.addHandler(l,"mousedown",function(r){e._raiseEvent("2",p.element);if(e.autoCloseOnClick&&!d&&!e.clickToOpen){r.data=e;e._closeAll(r)}return false});e.removeHandler(l,"mouseenter");e.removeHandler(l,"mouseleave");e._renderHover(l,p,d);if(p.subMenuElement!=null){var m=a(p.subMenuElement);m.wrap('<div class="jqx-menu-popup" style="z-index:'+g+';padding: 0px; margin: 0px; position: absolute; top: 0; left: 0; display: block; visibility: hidden;"><div style="position:absolute; overflow:hidden; left: 0; top: 0; right: 0; width: 100%; height: 100%;"></div></div>');m.css({overflow:"hidden",position:"absolute",left:0,display:"inherit",top:-m.outerHeight()});m.data("timer",{});if(p.level>0){m.css("left",-m.outerWidth())}g++;var o=a(p.subMenuElement).closest("div.jqx-menu-popup").css({width:parseInt(a(p.subMenuElement).outerWidth())+parseInt(c[0])+"px",height:parseInt(a(p.subMenuElement).outerHeight())+parseInt(c[1])+"px"});var q=l.closest("div.jqx-menu-popup");if(q.length>0){o.appendTo(q)}else{var h=m.css("margin-left");var k=m.css("margin-right");var j=m.css("padding-left");var n=m.css("padding-right");o.appendTo(a(document.body));m.css("margin-left",h);m.css("margin-right",k);m.css("padding-left",j);m.css("padding-right",n)}if(!d&&!e.clickToOpen){e.addHandler(l,"mouseenter",function(){if(e.autoOpen||(p.level>0&&!e.autoOpen)){clearTimeout(m.data("timer").hide)}if(p.parentId&&p.parentId!=0){if(e.menuElements[p.parentId]){var r=e.menuElements[p.parentId].isOpen;if(!r){return}}}if(e.autoOpen||(p.level>0&&!e.autoOpen)){e._openItem(e,p)}return false});e.addHandler(l,"mousedown",function(){if(!e.autoOpen&&p.level==0){clearTimeout(m.data("timer").hide);if(m!=null){m.stop()}if(!p.isOpen){e._openItem(e,p)}else{e._closeItem(e,p,true)}}});e.addHandler(l,"mouseleave",function(s){clearTimeout(m.data("timer").hide);var v=a(p.subMenuElement);var r={left:parseInt(s.clientX),top:parseInt(s.clientY)};var u={left:parseInt(v.offset().left),top:parseInt(v.offset().top),width:parseInt(v.outerWidth()),height:parseInt(v.outerHeight())};var t=true;if(u.left-5<=r.left&&r.left<=u.left+u.width+5){if(u.top<=r.top&&r.top<=u.top+u.height){t=false}}if(t){e._closeItem(e,p,true)}});e.removeHandler(o,"mouseenter");e.addHandler(o,"mouseenter",function(){clearTimeout(m.data("timer").hide)});e.removeHandler(o,"mouseleave");e.addHandler(o,"mouseleave",function(r){clearTimeout(m.data("timer").hide);clearTimeout(m.data("timer").show);if(m!=null){m.stop()}e._closeItem(e,p,true)})}else{e.removeHandler(l,"click");e.addHandler(l,"click",function(r){clearTimeout(m.data("timer").hide);if(m!=null){m.stop()}if(p.level==0&&!p.isOpen){}if(!p.isOpen){e._openItem(e,p)}else{e._closeItem(e,p,true)}})}}});this._raiseEvent("3",this)},createID:function(){var b=Math.random()+"";b=b.replace(".","");b="99"+b;b=b/1;while(this.items[b]){b=Math.random()+"";b=b.replace(".","");b=b/1}return"menuItem"+b},createMenu:function(h){if(h==null){return}var n=this;var d=a(h).find("li");var e=0;for(var j=0;j<d.length;j++){if(d[j].className.indexOf("jqx-menu")==-1&&this.autoGenerate==false){continue}var c=d[j].id;if(!c){c=this.createID()}d[j].id=c;this.items[e]=new a.jqx._jqxMenu.jqxMenuItem();this.menuElements[c]=this.items[e];e+=1;var g=0;var m=this;a(d[j]).children().each(function(){if(this.className.indexOf("jqx-menu-dropdown")!=-1){m.items[e-1].subMenuElement=this;return false}else{if(m.autoGenerate&&(this.tagName=="ul"||this.tagName=="UL")){m.items[e-1].subMenuElement=this;a(this).addClass(m.toThemeProperty("jqx-menu-dropdown"));return false}}});a(d[j]).parents().each(function(){if(this.className.indexOf("jqx-menu-item")!=-1){g=this.id;return false}else{if(m.autoGenerate&&(this.tagName=="li"||this.tagName=="LI")){g=this.id;return false}}});var f=false;var l=d[j].getAttribute("type");if(!l){l=d[j].type}else{if(l=="separator"){var f=true}}if(!f){if(g){l="sub"}else{l="top"}}var b=this.items[e-1];b.id=c;b.parentId=g;b.type=l;b.separator=f;b.element=d[j];b.level=a(d[j]).parents("li").length;if(this.autoGenerate){if(l=="separator"){a(d[j]).addClass(this.toThemeProperty("jqx-menu-item-separator"))}else{if(b.level>0){a(d[j]).addClass(this.toThemeProperty("jqx-menu-item"))}else{a(d[j]).addClass(this.toThemeProperty("jqx-menu-item-top"))}}}b.hasItems=a(d[j]).find("li").length>0}},_setPosition:function(h){try{var d=document.getElementById(this.submenuGroups[h]);var g=this.items[h].depth;var b=this.menuItemObj.submenuType[g];var c=document.getElementById(this.menuItem_objects[h].divElement);if(b=="top"){d.style.left=DHTMLSuite.commonObj.getLeftPos(c)+"px";d.style.top=(DHTMLSuite.commonObj.getTopPos(c)+c.offsetHeight)+"px"}else{d.style.left=(DHTMLSuite.commonObj.getLeftPos(c)+c.offsetWidth)+"px";d.style.top=(DHTMLSuite.commonObj.getTopPos(c))+"px"}}catch(f){}},destroy:function(){this.host.removeClass()},_raiseEvent:function(f,c){if(c==undefined){c={owner:null}}var d=this.events[f];args=c;args.owner=this;var e=new jQuery.Event(d);e.owner=this;var b=this.host.trigger(e);return b},getTop:function(b){var c=b.offsetTop;while((b=b.offsetParent)!=null){if(b.tagName!="HTML"){c+=(b.offsetTop-b.scrollTop);if(document.all){c+=b.clientTop}}}return c},getLeft:function(b){var c=b.offsetLeft;while((b=b.offsetParent)!=null){if(b.tagName!="HTML"){c+=b.offsetLeft;if(document.all){c+=b.clientLeft}}}return c},propertyChangedHandler:function(b,c,e,d){if(this.isInitialized==undefined||this.isInitialized==false){return}if(c=="autoCloseOnClick"){if(d==false){a(document).unbind("mousedown",b._closeAll)}else{a(document).bind("mousedown",b,b._closeAll)}}else{if(c=="mode"||c=="width"||c=="height"||c=="showTopLevelArrows"){b.refresh();if(c=="mode"){b._render(d,e)}else{b._applyOrientation()}}}}})})(jQuery);(function(a){a.jqx._jqxMenu.jqxMenuItem=function(e,d,c){var b={id:e,parentId:d,parentItem:null,type:c,disabled:false,level:0,isOpen:false,hasItems:false,element:null,subMenuElement:null,arrow:null,openHorizontalDirection:"right",openVerticalDirection:"down"};return b}})(jQuery);