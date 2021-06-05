#catalog-menu,
#catalog-menu ul,
#catalog-menu ul li,
#catalog-menu ul li a {
  margin: 0;
  padding: 0;
  border: 0;
  list-style: none;
  line-height: 1;
  display: block;
  position: relative;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
#catalog-menu {

  color: #ffffff;    
      
}

#catalog-menu ul ul {
  display: none;
}
#catalog-menu .active-menu-catalog ul{display: block;}
.align-right {
  float: right;
}
#catalog-menu > ul > li > a {
      padding: 15px 40px;
    border-top: 1px solid #fff;
    cursor: pointer;
    z-index: 2;
    font-size: 16px;
    font-weight: 400;
    text-decoration: none;
    color: #000;
    background-color: #f2f2f2;
}
#catalog-menu .none-sub a{padding-left: 10px;}
#catalog-menu .move {float: left;margin-right: 10px;    cursor: move;}
#catalog-menu > ul > li:first-child > a{border-top: 0;}
#catalog-menu > ul > li > a:hover,
#catalog-menu > ul > li.active > a,
#catalog-menu > ul > li.open > a {  
  background: #eee;  
}
#catalog-menu > ul > li.open > a {  
  border-bottom: 1px solid #8f8f8f;
}
#catalog-menu > ul > li:last-child > a,
#catalog-menu > ul > li.last > a {
  border-bottom: 1px solid #8f8f8f;
}
.tel{list-style: none;float: left;color: #999; position: relative;top: 9px;}
.tel a{color: #999;text-decoration: none;font-size: 17px;}
.holder {
  width: 0;
  height: 0;
  position: absolute;
  top: 0;
  left: 40px;
}
.openLink .holder::before, #catalog-menu ul ul .openLink.has-sub > a::after{
    content: '\f056';
}
.holder::before {
 display: block;
    position: absolute;
    content: "\f055";
    /* width: 6px; */
    /* height: 6px; */
    right: 12px;
    z-index: 10;
    font-family: fontawesome;
    top: 14px;
}

#catalog-menu > ul > li > a:hover > span::after,
#catalog-menu > ul > li.active > a > span::after,
#catalog-menu > ul > li.open > a > span::after {
  border-color: #eeeeee;
}

#catalog-menu ul ul li a {
  cursor: pointer;
  border-bottom: 1px solid #32373e;
     padding: 10px 60px;
  z-index: 1;
  text-decoration: none;
  color: #fff;
      background: rgba(0, 0, 0, 0.7);
  box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.1);font-size: 16px;
}
#catalog-menu ul ul li:hover > a,
#catalog-menu ul ul li.open > a,
#catalog-menu ul ul li.active > a,  #catalog-menu ul ul .active-submenu-catalog a{
  background: #2d2d2d;
  color: #fff;
}
#catalog-menu ul ul li:first-child > a {
  box-shadow: none;
}
#catalog-menu ul ul ul li:first-child > a {
  box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.1);
}
#catalog-menu ul ul ul li a {
  padding-left: 80px;
}
#catalog-menu ul ul ul li.has-sub > a::after{left: 60px;}
#catalog-menu ul ul ul ul li a {
    padding-left: 100px;
}
#catalog-menu ul ul ul ul li.has-sub > a::after{left: 80px;}
#catalog-menu > ul > li > ul > li:last-child > a,
#catalog-menu > ul > li > ul > li.last > a {
  border-bottom: 0;
}
#catalog-menu > ul > li > ul > li.open:last-child > a,
#catalog-menu > ul > li > ul > li.last.open > a {
  border-bottom: 1px solid #32373e;
}
#catalog-menu > ul > li > ul > li.open:last-child > ul > li:last-child > a {
  border-bottom: 0;
}
/*#catalog-menu ul ul li.openLink a:after{
    content: "\f056";
    font-family: fontawesome;
}*/
#catalog-menu ul ul li.has-sub > a::after {
  display: block;
  position: absolute;
  content: "\f055";
  width: 5px;
  height: 5px;
  left: 35px;
  z-index: 10;
  top: 8.5px;
  font-family: fontawesome;
}
#catalog-menu ul ul li.active > a::after,
#catalog-menu ul ul li.open > a::after,
#catalog-menu ul ul li > a:hover::after {
  border-color: #ffffff;
}