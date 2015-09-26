function addTag(tagcontainer,tag,tagvariable)
{
   
  if (tagcontainer.indexOf(tag)==-1)
   {
     tagcontainer.push(tag);
     $("#taxonomy_div").append("<span onclick=\"confirm(\'Do you want to remove this tag?\');removeTag("+tag+");$(this).remove();\">"+tag+"<input type=\"hidden\" name=\"Terms["+tagvariable+"][]\" value=\""+tag+"\"/>x")
   
   }
}
function removeTag(tagcontainer,tag)
{
   
  if (tagcontainer.indexOf(tag)!=-1)
   {
     tagcontainer.pop(tag);
    
   }
}

 