model=('tagging' 'taggable' 'vocabulary' 'term' )
for i in  "${!model[@]}"; do
   echo "generating for "${model[$i]}
   table=${model[$i]}
   utable="$(tr '[:lower:]' '[:upper:]' <<< ${table:0:1})${table:1}"
   ./yii gii/model --tableName=$table --interactive=0 --overwrite=1 --modelClass=$utable --ns=app\\modules\\taxonomy\\models --template='myModel'
   ./yii gii/crud  --interactive=0 --overwrite=1 --baseControllerClass=app\\modules\\taxonomy\\Controller --controllerClass=app\\modules\\taxonomy\\controllers\\${utable}Controller --enableI18N=1 --modelClass=app\\modules\\taxonomy\\models\\$utable --searchModelClass=app\\modules\\taxonomy\\models\\${utable}Search --template='myCrud' --viewPath=@app/modules/taxonomy/views/$table
done