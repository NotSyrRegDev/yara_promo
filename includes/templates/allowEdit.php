<script>

   
    
    let editIcons = document.querySelectorAll('.edit_input_icon');
    let inputsElem = document.querySelectorAll('.input_info');
   
    for ( let i =0; i < editIcons.length; i++ ) {
       
        editIcons[i].addEventListener('click' , (e) => {
           
            console.log(inputsElem[i])
            inputsElem[i].readOnly  = !inputsElem[i].readOnly;
        } );
    }

</script>