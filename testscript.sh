 table="hello_world"
 utable="$(tr '[:lower:]' '[:upper:]' <<< ${table:0:1})${table:1}"
 utable=`echo $utable |/usr/local/bin/sed -r 's/([A-Za-z]+)_([a-z]+)/\1\u\2/g'`
 echo $utable
