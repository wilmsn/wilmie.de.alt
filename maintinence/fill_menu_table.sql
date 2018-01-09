delete from menu;
insert into menu(ID,  menu1_id,  menu2_id,  menu3_id,  role,  show_dt,  show_mo,  has_sub,  class_dt,  class_mo,   label,    bookmark,   url,   content)
values          (1,   1,         1,         1,         '+',   true,     true,     false,    ' ',       'a',        'Info',   'info',     '#',   '/content/info_content.php');
insert into menu(menu1_id,menu2_id,menu3_id,role,show_dt,show_mo,has_sub,class_dt,class_mo,label,bookmark,url,content)
values(2,1,1,'+',true,true,true,'has_sub','b','Reisen',' ','#',' ');
insert into menu(menu1_id,menu2_id,menu3_id,role,show_dt,show_mo,has_sub,class_dt,class_mo,label,bookmark,url,content)
values(2,2,1,'+',true,true,true,'has_sub','a','Fernreisen',' ','#',' ');
insert into menu(menu1_id,menu2_id,menu3_id,role,show_dt,show_mo,has_sub,class_dt,class_mo,label,bookmark,url,content)
values(2,2,2,'+',true,true,false,' ','a','Thailand','thailand','#','/gallery.php?dir=thailand');
insert into menu(menu1_id,menu2_id,menu3_id,role,show_dt,show_mo,has_sub,class_dt,class_mo,label,bookmark,url,content)
values(2,2,3,'+',true,true,false,' ','a','Mexico','mexico','#','/gallery.php?dir=mexico');
insert into menu(menu1_id,menu2_id,menu3_id,role,show_dt,show_mo,has_sub,class_dt,class_mo,label,bookmark,url,content)
values(2,2,4,'+',true,true,false,' ','a','Sri Lanka','sirlanka','#','/gallery.php?dir=srilanka');
insert into menu(menu1_id,menu2_id,menu3_id,role,show_dt,show_mo,has_sub,class_dt,class_mo,label,bookmark,url,content)
values(2,2,5,'+',true,true,false,' ','a','Türkei','tuerkei','#','/gallery.php?dir=tuerkei');

insert into menu(menu1_id,menu2_id,menu3_id,role,show_dt,show_mo,has_sub,class_dt,class_mo,label,bookmark,url,content)
values(2,3,1,'+',true,true,true,'has_sub','a','Motorrad',' ','#',' ');
insert into menu(menu1_id,menu2_id,menu3_id,role,show_dt,show_mo,has_sub,class_dt,class_mo,label,bookmark,url,content)
values(2,3,2,'+',true,true,false,' ','a','Alpen','herbst03','#','/gallery.php?dir=herbst03');
insert into menu(menu1_id,menu2_id,menu3_id,role,show_dt,show_mo,has_sub,class_dt,class_mo,label,bookmark,url,content)
values(2,3,3,'+',true,true,false,' ','a','Großbritanien','wales2014','#','/gallery.php?dir=wales2014');
insert into menu(menu1_id,menu2_id,menu3_id,role,show_dt,show_mo,has_sub,class_dt,class_mo,label,bookmark,url,content)
values(2,3,4,'+',true,true,false,' ','a','Ostsee','ostsee','#','/gallery.php?dir=ostsee');

insert into menu(menu1_id,menu2_id,menu3_id,role,show_dt,show_mo,has_sub,class_dt,class_mo,label,bookmark,url,content)
values(2,4,1,'+',true,true,true,'has_sub','a','Sonstig',' ','#',' ');
insert into menu(menu1_id,menu2_id,menu3_id,role,show_dt,show_mo,has_sub,class_dt,class_mo,label,bookmark,url,content)
values(2,4,2,'+',true,true,false,' ','a','Silvester Berlin','silvester03','#','/gallery.php?dir=silvester03');
insert into menu(menu1_id,menu2_id,menu3_id,role,show_dt,show_mo,has_sub,class_dt,class_mo,label,bookmark,url,content)
values(2,4,3,'+',true,true,false,' ','a','SKi Mayrhofen','ski04','#','/gallery.php?dir=ski04');
insert into menu(menu1_id,menu2_id,menu3_id,role,show_dt,show_mo,has_sub,class_dt,class_mo,label,bookmark,url,content)
values(2,4,4,'+',true,true,false,' ','a','Wien','wien','#','/gallery.php?dir=wien');

insert into menu(menu1_id,menu2_id,menu3_id,role,show_dt,show_mo,has_sub,class_dt,class_mo,label,bookmark,url,content)
values(3,1,1,'+',true,true,true,'has_sub','b','Haus und Garten',' ','#',' ');
insert into menu(menu1_id,menu2_id,menu3_id,role,show_dt,show_mo,has_sub,class_dt,class_mo,label,bookmark,url,content)
values(3,2,1,'+',true,true,true,'has_sub','a','Bilder',' ','#',' ');
insert into menu(menu1_id,menu2_id,menu3_id,role,show_dt,show_mo,has_sub,class_dt,class_mo,label,bookmark,url,content)
values(3,2,2,'+',true,true,false,' ','a','Schwimmteich Bau','teichbau','#','/gallery.php?dir=teichbau');
insert into menu(menu1_id,menu2_id,menu3_id,role,show_dt,show_mo,has_sub,class_dt,class_mo,label,bookmark,url,content)
values(3,2,3,'+',true,true,false,' ','a','Schwimmteich fertig','schwimmteich','#','/gallery.php?dir=schwimmteich');
insert into menu(menu1_id,menu2_id,menu3_id,role,show_dt,show_mo,has_sub,class_dt,class_mo,label,bookmark,url,content)
values(3,2,4,'+',true,true,false,' ','a','Umbau','umbau','#','/gallery.php?dir=umbau');
insert into menu(menu1_id,menu2_id,menu3_id,role,show_dt,show_mo,has_sub,class_dt,class_mo,label,bookmark,url,content)
values(3,3,1,'+',true,true,false,' ','a','Wiki: Rezepte',' ','/wiki/index.php?title=Rezeptsammlung',' ');

insert into menu(menu1_id,menu2_id,menu3_id,role,show_dt,show_mo,has_sub,class_dt,class_mo,label,bookmark,url,content)
values(4,1,1,'a',true,true,true,'has_sub','b','Administration',' ','#',' ');
insert into menu(menu1_id,menu2_id,menu3_id,role,show_dt,show_mo,has_sub,class_dt,class_mo,label,bookmark,url,content)
values(4,1,2,'a',true,true,false,' ','a','Haussteuerung','haussteuerung','#','/content/haussteuerung_content.php');
insert into menu(menu1_id,menu2_id,menu3_id,role,show_dt,show_mo,has_sub,class_dt,class_mo,label,bookmark,url,content)
values(4,1,3,'a',true,true,false,' ','a','Sensorwerte','sensorwerte','#','/content/sensorwerte_content.php');
insert into menu(menu1_id,menu2_id,menu3_id,role,show_dt,show_mo,has_sub,class_dt,class_mo,label,bookmark,url,content)
values(4,1,4,'a',true,true,false,' ','a','FHEM',' ','/fhem',' ');

insert into menu(menu1_id,menu2_id,menu3_id,role,show_dt,show_mo,has_sub,class_dt,class_mo,label,bookmark,url,content)
values(5,1,1,'+',true,true,true,'has_sub','b','Elektronik',' ','#',' ');
insert into menu(menu1_id,menu2_id,menu3_id,role,show_dt,show_mo,has_sub,class_dt,class_mo,label,bookmark,url,content)
values(5,1,2,'+',true,true,false,' ','a','Wetterstation','wetter','#','/content/wetter_content.php');
insert into menu(menu1_id,menu2_id,menu3_id,role,show_dt,show_mo,has_sub,class_dt,class_mo,label,bookmark,url,content)
values(5,2,1,'+',true,true,false,' ','a','Wiki: Elektronik',' ','/wiki/index.php?title=Elektronik',' ');
insert into menu(menu1_id,menu2_id,menu3_id,role,show_dt,show_mo,has_sub,class_dt,class_mo,label,bookmark,url,content)
values(5,3,1,'+',true,true,true,'has_sub','a','Demos',' ','#',' ');
insert into menu(menu1_id,menu2_id,menu3_id,role,show_dt,show_mo,has_sub,class_dt,class_mo,label,bookmark,url,content)
values(5,3,2,'+',true,true,false,' ','a','Demo: Haussteuerung','demo_haussteuerung','#','/demo/haussteuerung_content.php');
insert into menu(menu1_id,menu2_id,menu3_id,role,show_dt,show_mo,has_sub,class_dt,class_mo,label,bookmark,url,content)
values(5,3,3,'+',true,true,false,' ','a','Demo: Sensorwerte','demo_sensorwerte','#','/demo/sensorwerte_content.php');

insert into menu(menu1_id,menu2_id,menu3_id,role,show_dt,show_mo,has_sub,class_dt,class_mo,label,bookmark,url,content)
values(9,1,1,'-',true,true,false,' ','a','Login',' ','#','/content/login_content.php');

insert into menu(menu1_id,menu2_id,menu3_id,role,show_dt,show_mo,has_sub,class_dt,class_mo,label,bookmark,url,content)
values(10,1,1,'a',true,true,false,' ','a','Logout',' ','#','/content/logout_content.php');

commit;
