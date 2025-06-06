$(document).ready(function($){
    $(".btn-login").on("click", function(e){
        let form = $('#login-form');
        if(form[0].checkValidity()){
          e.preventDefault();  
           $.ajax({				
			type : 'POST',
			url  : 'php/login.php',
			data : form.serialize() ,
			beforeSend: function(){	
				$(".btn-login").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden">...</span>');
			},
               
		    success : function(response){
                if(response == 1){
                    $(".btn-login").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden">Loading...</span>');
                    
                    Swal.fire({
                        title: "Succès!",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1000
                    });
                    setTimeout(function() {location.href = "index.php";},1200);			
                }else{

                     $(".btn-login").html('Connexion');
                     Swal.fire({
                        showCancelButton: true,
                        showConfirmButton: false,
                        cancelButtonColor: "#d33",
                        cancelButtonText: "OK",
                        icon: "error",
                        title: "Oops...!!",
                        text: response,
                        showClass: {
                            popup: `
                              animate__animated
                              animate__shakeX
                              animate__faster
                            `
                        }
                      
                    });
                    
                     
                }
    
                   
			},
            Error: function(error){
                $(".btn-login").html('Connexion');   
                Swal.fire({
                    showCancelButton: true,
                    showConfirmButton: false,
                    cancelButtonColor: "#d33",
                    cancelButtonText: "OK",
                    icon: "error",
                    title: "Oops...!!",
                    text: "problème détecter, essayer plus tard.",
                    showClass: {
                        popup: `
                          animate__animated
                          animate__shakeX
                          animate__faster
                        `
                    }
                });
            }
		}); 
        }
    });
  
});
