$(document).ready(function(){
    $('#submit').click(function(e){
        console.log("you have signed in");
       const name = $('#name').val().trim();
       const email = $('#email').val().trim();
       const password = $('#password').val().trim();
       const gender = $('input[name="gender]:checked').val()
       const mobile = $('#mobile').val().trim();
       const city = $('#city').val().trim();
       const po = $('#po').val().trim();
       const ps = $('#ps').val().trim();
       const dist = $('#dist').val().trim();
       const state = $('#state').val().trim();
       const pin = $('#pin').val().trim();
       const dob = $('#dob').val().trim();
    
    if(!/^[A-Za-z\s]+$/.test(name)){
        alert("Please enter a valid name");
        e.preventDefault();
        return;
    }
    



        
    })
})