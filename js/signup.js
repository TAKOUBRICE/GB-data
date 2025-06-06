$(document).ready(function($){
    $(".btn-signup").on("click", function(e){
        
        let form = $('#signup-form');
        if(form[0].checkValidity()){
            e.preventDefault();
            $.ajax({	
			type : 'POST',
			url  : 'php/signup.php',
			data : form.serialize(),
			beforeSend: function(){	
				$(".btn-signup").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden">...</span>');
			},
		    success : function(response){
                
                if(response == 1){
                    $(".btn-signup").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden">Loading...</span>');
                    Swal.fire({
                        title: "Succès!!",
                        text: "Inscription réussie!",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1000
                    });
                    setTimeout(function() {
                        location.href = "login.html";
                    },1200);
                }else{
                    $(".btn-signup").html('Créér le compte');
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
                    
                $("#create").html('Créér le compte');    
                }
				
            },
            Error: function(error){
                $(".btn-signup").html('Créér le compte');
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
