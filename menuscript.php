    <script src="./js/jquery-3.4.1.min.js"></script>
    <script src="./js/materialize.min.js"></script>

    <script>
        $(document).ready(function(){
            $('.sidenav').sidenav(); 
            $('.materialboxed').materialbox(); 
            $('.tabs').tabs();
            $('.datepicker').datepicker({
                //disableWeekends:true
                selectMonths: true, // Creates a dropdown to control month
                selectYears: 15, // Creates a dropdown of 15 years to control year
                format: 'yyyy-mm-dd'
            });
            $('.tooltipped').tooltip();
            $('.dropdown-trigger').dropdown();
            $('select').formSelect();
            $('.slider').slider({interval:4000,height:350});
            $('.fixed-action-btn').floatingActionButton({hoverEnabled: false});
        }) 
    </script>