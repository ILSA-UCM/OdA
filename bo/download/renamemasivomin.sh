find -depth |
while read SRC; 
do
	echo $SRC
    DST=`dirname "${SRC}"`/`basename "${SRC}" | tr '[A-Z]' '[a-z]'`
    if [ "${SRC}" != "${DST}" ]
    then
        [ ! -e "${DST}" ] && mv -T "${SRC}" "${DST}" || echo "${SRC} was not renamed"
    fi
done
