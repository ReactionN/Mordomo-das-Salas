<script>
function ValName(hostname)
{
var string = (hostname.trim());
var i;
var size;
var cnt;
var format = /^[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]*$/;
var compare = " ";

cnt = 0;

size = string.length;

space = 0;

for(i=0 ; i < size ; i++)
{	
				 if(isNaN(string[i]) == false)  // existe numero-> erro
 						{
    						cnt++;
							
							if(string[i].localeCompare(compare) == 0)
							{
								//document.write(i);
								cnt--;
								if( space!= 1 && i < size-1)
								{
									if(format.test(string[i+1]) == true)
									{
										cnt++;
									}
									space++;
								}
							}
        		}
				
				
				
				if(format.test(string[i]) == true)
				{
					cnt++;
				}
	
	
	
}

				document.write(cnt);
				if(cnt !=0 || space == 0)
					{
						document.write("Nome mal inserido");
					}
}



</script>