(function(){var a=Shadowbox;a.html=function(b){this.obj=b;this.height=b.height?parseInt(b.height,10):300;this.width=b.width?parseInt(b.width,10):500};a.html.prototype={append:function(b,e,c){this.id=e;var d=document.createElement("div");d.id=e;d.className="html";d.innerHTML=this.obj.content;b.appendChild(d)},remove:function(){var b=document.getElementById(this.id);if(b){a.lib.remove(b)}}}})();