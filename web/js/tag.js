var tagcontainer=new Array();
function addTag(tag,tagvariable)
{
   
  if (tagcontainer.indexOf(tag)==-1)
   {
     tagcontainer.push(tag);
     $("#taxonomy_div").append("<span onclick=\"var r=confirm(\'Do you want to remove this tag?\');if (r==true) {removeTag('"+tag+"');$(this).remove();}\">"+tag+"<input type=\"hidden\" name=\"Terms["+tagvariable+"][]\" value=\""+tag+"\"/>x")
   
   }
}
function removeTag(tag)
{
   
  if (tagcontainer.indexOf(tag)!=-1)
   {
     tagcontainer.pop(tag);
    
   }
}

 