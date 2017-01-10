#!/bin/bash
echo "compiling styles... "
lessc -x ./css/style.less > ./css/style.css
echo "compiling templates... "
cp config.js tmp.js
for f in ./tmpl/*.html
do
    if [ -f $f -a -r $f ]; then
		if grep -q $f config.js; then
		    echo "Found $f"
		    t=`r=$RANDOM; cat $f | tr '\r\n' ' ' | sed "s|'|\'\+\"\'\"\+\'|g" | sed "s|>[\t ]*<|><|g" | sed 's/&/\\\&/g' | sed "s/{rand}/$r/g"`
		    #echo $t
		    sed -i "s~$f~$t~g" tmp.js
		else
		    echo "Not found $f"
		fi
    else
		echo "Error $f"
    fi
done
sed -e "s|\r\n||g" tmp.js > mobi.js
rm tmp.js
#enconv -L ru -x windows-1251 ./mobi.js
echo "done!"
