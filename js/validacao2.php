



<script>
function dataValidation(horaInicio, minutoInicio,  horaFim, minutoFim){
		

	
	
	var horaCurrente = new Date();
	var hour = horaCurrente.getHours();
	var minutes = horaCurrente.getMinutes();
	
	
	
	
	if(horaInicio != null && horaFim != null && minutoInicio != null && minutoFim != null){
		
	
	
	
	
	
	if(horaInicio == horaFim){
		if(horaInicio == hour){
			if(minutoInicio < minutes - 15){
				document.write("Erro: a hora que inseriu esta incorreta");
			}
			if(minutoInicio > minutoFim - 30){
				document.write("Erro: a hora que inseriu esta incorreta");
			}
			
		}else if(horaInicio > hour){
				if(Math.abs(minutes-minutoInicio) > 15){
					document.write("erro:");
				}
			
				
		}else if(horaInicio < hour){
			document.write("Erro: a hora do inicio tem que ser maior ou igual a hora atual");
		}
		
	
		if(horaFim == hour){
			if(minutoFim < minutes + 15){
				document.write("Erro: o horario invalido");
			}
			if(minutoFim < minutoInicio + 30){
				document.write("Erro: o horario do fim nao pode ser inferior a 30 minutos desde o inicio");
			}
			
		
		}else if(horaFim > hour){
			if(Math.abs(minutoFim-minutes) < 15){
				document.write("Erro: horario invalido");
			}
			
			
			
		}else if(horaFim < hour){
			document.write("Erro: a hora do fim nao pode ser menor que a hora atual");
		}
	
		
	
	}else{
	
		if(horaFim < horaInicio) {
			document.write("Erro: a hora do fim nao pode ser menor que a hora do inicio");
		
		}else if(horaFim > horaInicio){
			
			if(Math.abs(minutoInicio-minutoFim) < 30){
				document.write("Erro: a marcacao nao pode ser menos do que 30 minutos");
			}
		
			
		}
		
	}	
		
	
	}else{
		document.write("Erro: para submeter tem que inserir todos os campos");
	}
		
}
	
	
	
	
</script>





