model=('format' 'format_values')
module='formats'
for i in  "${!model[@]}"; do
   echo "generating for "${model[$i]}
   table=${model[$i]}
  # utable="$(tr '[:lower:]' '[:upper:]' <<< ${table:0:1})${table:1}"
 # uscore="this_is_the_string_to_be_converted"
#arr=(${table//_/ })
#printf -v utable %s "${arr[@]^}"
utable=`echo $table | perl -pe 's/(^|_)./uc($&)/ge;s/_//g'`
echo $utable
   ./yii gii/model --tableName=$table --interactive=0 --overwrite=1 --modelClass=$utable --ns=app\\modules\\$module\\models --template='myModel'
   ./yii gii/crud  --interactive=0 --overwrite=1 --baseControllerClass=yii\\web\\Controller --controllerClass=app\\modules\\$module\\controllers\\${utable}Controller --enableI18N=1 --modelClass=app\\modules\\$module\\models\\$utable --searchModelClass=app\\modules\\$module\\models\\${utable}Search --template='myCrud' --viewPath=@app/modules/$module/views/$table
done