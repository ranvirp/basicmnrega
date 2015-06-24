module=('complaint')
for i in  "${!module[@]}"; do
   echo "generating for "${module[$i]}
   table=${module[$i]}
   utable="$(tr '[:lower:]' '[:upper:]' <<< ${table:0:1})${table:1}"
   ./yii gii/module --moduleClass="app\\modules\\"${module}"\\Module" --moduleID=${table} --interactive=0 --overwrite=1
  done
