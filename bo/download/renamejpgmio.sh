du -a | cut -d '/' -f2- | grep JPG|  

while read x;
 do
   mv "$x" "${x%.JPG}.jpg";
done 
