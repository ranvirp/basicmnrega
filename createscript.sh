model=('complaint_marking')
for i in  "${!model[@]}"; do
   echo "generating for "${model[$i]}
   table=${model[$i]}
   utable="$(tr '[:lower:]' '[:upper:]' <<< ${table:0:1})${table:1}"
   ./yii gii/model --tableName=$table --interactive=0 --overwrite=1 --modelClass=$utable --ns=app\\modules\\complaint\\models --template='myModel'
   ./yii gii/crud  --interactive=0 --overwrite=1 --baseControllerClass=yii\\web\\Controller --controllerClass=app\\modules\\complaint\\controllers\\${utable}Controller --enableI18N=1 --modelClass=app\\modules\\complaint\\models\\$utable --searchModelClass=app\\modules\\complaint\\models\\${utable}Search --template='myCrud' --viewPath=@app/modules/complaint/views/$table
done