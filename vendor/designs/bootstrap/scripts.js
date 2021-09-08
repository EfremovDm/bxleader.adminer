/*!
 * Adminer Bootstrap-Like Design
 *
 * @author  Natan Felles, https://natanfelles.github.io <natanfelles@gmail.com>
 * @link    https://github.com/natanfelles/adminer-bootstrap-like
 * @link    https://www.adminer.org/plugins/#use
 * @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
 */
!function(e){e.addEventListener("load",function(){t.init()},!1);var t={init:function(){t.h1=document.querySelector("#menu h1"),t.logins=document.getElementById("logins"),t.dbs=document.getElementById("dbs"),t.links=document.querySelector("#menu .links"),t.tables=document.getElementById("tables"),t.menuMessage=document.querySelector("#menu .message"),t.breadcrumb=document.getElementById("breadcrumb"),t.lang=document.getElementById("lang"),t.logout=document.getElementById("logout"),t.content=document.getElementById("content"),t.pages=document.getElementsByClassName("pages")[0],t.menu=document.getElementById("menu"),t.setPositions(),t.setTables(),t.setSensor(),t.setScroller()},setScroller:function(){var t=document.getElementById("scroller"),n=t.querySelectorAll("a");function l(){e.innerHeight<e.innerHeight+document.documentElement.scrollTop?t.style.display="block":t.style.display="none"}l(),e.addEventListener("scroll",l),n[0].addEventListener("click",function(t){t.preventDefault(),e.scroll(0,0),document.body.scrollTop=0}),n[1].addEventListener("click",function(t){t.preventDefault(),e.scroll(0,document.body.scrollHeight)})},setPositions:function(){var n=!1;document.body.classList.contains("rtl")&&(n=!0),t.logins&&(t.logins.style.top=t.h1.offsetHeight-1+"px"),t.dbs&&(t.dbs.style.top=t.h1.offsetHeight+"px"),t.links&&(t.links.style.top=t.h1.offsetHeight+t.dbs.offsetHeight+"px"),t.tables&&(t.tables.style.top=t.h1.offsetHeight+t.dbs.offsetHeight+t.links.offsetHeight-1+"px"),t.menuMessage&&(t.menuMessage.style.top=t.h1.offsetHeight+t.dbs.offsetHeight+t.links.offsetHeight+"px"),t.lang&&t.logout&&(n?t.lang.style.left=t.logout.offsetWidth+8+"px":t.lang.style.right=t.logout.offsetWidth+8+"px"),t.content.style.minHeight=e.innerHeight-e.getComputedStyle(t.content,null).getPropertyValue("padding-top").replace("px","")-e.getComputedStyle(t.content,null).getPropertyValue("padding-bottom").replace("px","")-e.getComputedStyle(t.content,null).getPropertyValue("margin-top").replace("px","")-e.getComputedStyle(t.content,null).getPropertyValue("margin-bottom").replace("px","")+"px"},setTables:function(){if(t.tables){t.tables.style.height=e.innerHeight-t.tables.offsetTop+"px";for(var n=document.querySelectorAll("#tables li a"),l=0;l<n.length;l++)n[l].classList.contains("structure")&&(n[l].title=n[l].title+" - "+n[l].innerHTML,n[l].parentNode.addEventListener("click",function(){e.location=this.children[1].href}),n[l].offsetWidth>200&&(n[l].innerHTML=n[l].innerHTML.substring(0,28)+"...")),n[l].classList.contains("active")&&(n[l].parentNode.classList+="active");var o=document.querySelector("#tables .active");o&&(t.tables.scrollTop=o.offsetTop)}},setSensor:function(){var e=document.createElement("div");e.setAttribute("id","sensor"),document.body.appendChild(e);var t=document.getElementById("sensor"),n=!1;function l(e){var t=document.getElementById("menu"),l=document.getElementById("content"),o=document.getElementById("breadcrumb"),s=document.querySelector(".footer p");"closed"===e?(t.style.display="none",n?l.style.marginRight=0:l.style.marginLeft=0,o&&(n?o.style.paddingRight="40px":o.style.paddingLeft="40px"),s&&(n?s.style.right=0:s.style.left=0),localStorage.setItem("menu","closed")):(t.style.display="block",n?l.style.marginRight="266px":l.style.marginLeft="266px",o&&(n?o.style.paddingRight="306px":o.style.paddingLeft="306px"),s&&(n?s.style.right="266px":s.style.left="266px"),localStorage.setItem("menu","open"))}document.body.classList.contains("rtl")&&(n=!0),l(localStorage.getItem("menu")),t.addEventListener("mouseover",function(){l("open"===localStorage.getItem("menu")?"closed":"open")})}}}(window);