/*****************************************************
Browsercheck - Added in all pages
****************************************************/
function checkBrowser(){
	this.ver=navigator.appVersion
	this.dom=document.getElementById?1:0
	this.ie5=(this.ver.indexOf("MSIE 5")>-1 && this.dom)?1:0;
	this.ie4=(document.all && !this.dom)?1:0;
	this.ns5=(this.dom && parseInt(this.ver) >= 5) ?1:0;
	this.ns4=(document.layers && !this.dom)?1:0;
	this.bw=(this.ie5 || this.ie4 || this.ns4 || this.ns5)
	return this
}
var bw=new checkBrowser()

function MoveToRight(from,to,max){
	obj1=window.document.frm[from]
	obj2=window.document.frm[to]
	sel=obj1.selectedIndex
	i=obj2.options.length
	cont = 0
	for(i=0;i<obj2.options.length;i++){
					if(obj2.options[i].value!=""){
						cont++
					}
				}

 	if (cont < max){ 
		if(sel!=-1){
			val1=obj1[sel].value
			txt1=obj1[sel].text
			if(val1!="" && val1!=0){
				
				var ok=false;
				for(i=0;i<obj2.options.length;i++){
					if(obj2.options[i].value==""){
						ok=true; break;
					}
				}
				if(!ok) i=obj2.options.length
				obj2.options[i]=new Option(txt1,val1,true)
				obj1.options[sel]=null

			}
		}	
	}
	if (cont >= max) alert ('Puoi scegliere al massimo '+ max +' giocatori')
}

	
function MoveToLeft(from,to){
	obj1=window.document.frm[from]
	obj2=window.document.frm[to]
	sel=obj1.selectedIndex
	if(sel!=-1){
		val1=obj1[sel].value
		txt1=obj1[sel].text
		if(val1!="" && val1!=0){
			obj1.options[sel]=null
			var ok=false;
			for(i=0;i<obj2.options.length;i++){
				if(obj2.options[i].value==""){
					ok=true; break;
				}
			}
			
			if(!ok) i=obj2.options.length
			obj2.options[i]=new Option(txt1,val1,true)
			
				
		}	
	}
}

			
function passa_id(){
	
	obj0=document.frm["listascelti0"].options
	for (i=0;i<3;i++)
	{
		try{
		if (i==0)
		{
			document.frm.passa0.value=obj0[i].value
		}else
		document.frm.passa0.value=document.frm.passa0.value+"-"+obj0[i].value
		}
		catch(er){}

	}
	
	obj1=document.frm["listascelti1"].options
	for (i=0;i<8;i++)
	{
		
		try{
		if (i==0)
		{
			document.frm.passa1.value=obj1[i].value
		}else
		document.frm.passa1.value=document.frm.passa1.value+"-"+obj1[i].value
		}
		catch(er){}

	}
	
	obj1=document.frm["listascelti2"].options
	for (i=0;i<8;i++)
	{
		
		try{
		if (i==0)
		{
			document.frm.passa2.value=obj1[i].value
		}else
		document.frm.passa2.value=document.frm.passa2.value+"-"+obj1[i].value
		}
		catch(er){}

	}
	
	obj1=document.frm["listascelti3"].options
	for (i=0;i<6;i++)
	{
		
		try{
		if (i==0)
		{
			document.frm.passa3.value=obj1[i].value
		}else
		document.frm.passa3.value=document.frm.passa3.value+"-"+obj1[i].value
		}
		catch(er){}

	}
	
	}

function cancella_menu(mnu_source){
	
	obj1=document.frm[mnu_source]
	for(i=0;i<obj1.options.length;i++){
		obj1.options[i]= null
		}
	
	}

function ControllaCampi()
{
var str;
var ck=true;
function isEmailAddr(email)
{
  var result = false;
  var theStr = new String(email);
  var index = theStr.indexOf("@");
  if (index > 0)
  {
    var pindex = theStr.indexOf(".",index);
    if ((pindex > index+1) && (theStr.length > pindex+1))
	result = true;
  }
  return result;
}
str="&Egrave; necessario inserire i seguenti campi obbligatori";
if (document.formIscr.Nome.value=="") {
str=str+"\n--> Nome";
ck=false;
//return false;
}

if (document.formIscr.Cognome.value=="") {
str=str+"\n--> Cognome"; 
 
ck=false;
}
if (document.formIscr.Email.value=="") { 
str=str+"\n--> E-mail";
ck=false;
}

if (document.formIscr.ColoreSF.value=="") { 
str=str+"\n--> Colore Sfondo";
ck=false;
}
if (document.formIscr.ColoreC.value=="") { 
str=str+"\n--> Colore caretteri";
ck=false;
}

if (document.formIscr.Pwd.value=="") { 
str=str+"\n--> Password";
ck=false;
}

if (document.formIscr.Pwd.value.length<5) { 
str=str+"\n\n La password deve essere almeno 5 caratteri";
ck=false;
}
if (!isEmailAddr(document.formIscr.Email.value)){
str=str+"\n\n La mail deve essere valida del tipo bruttocane@fanta.it";
ck=false;
}
if (document.formIscr.Pwd.value!=document.formIscr.PwdCK.value) { 
str=str+"\n\nIn oltre i campi password non coincidono: verificale!";
ck=false;
}
if (!ck){
alert(str);
return false;
}
else
return true;
}
