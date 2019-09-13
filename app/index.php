<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Voyage Hitema</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="../assets/css/index.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/thermometer.css">
    <link rel="stylesheet" href="https://simeydotme.github.io/jQuery-ui-Slider-Pips/dist/css/jqueryui.min.css">
    <link rel="stylesheet" href="https://simeydotme.github.io/jQuery-ui-Slider-Pips/dist/css/jquery-ui-slider-pips.min.css">
    <link rel="stylesheet" href="https://simeydotme.github.io/jQuery-ui-Slider-Pips/dist/css/app.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <script src="https://simeydotme.github.io/jQuery-ui-Slider-Pips/dist/js/jquery-plus-ui.min.js"></script>
    <script src="https://simeydotme.github.io/jQuery-ui-Slider-Pips/dist/js/jquery-ui-slider-pips.js"></script>

</head>
        
    <body>
    <form method="POST" action="../api/index.php">
    <div class="bg">
        <div class="title">
            Inspiration pour les voyages!
        </div>
        <div class="homeOptions">

            <div class="oneline" data-toggle="modal" data-target="#myModal">
                <p class="textTitle">La température</p>
                <p class="temp"></p>
            </div>

            <div class="oneline" data-toggle="modal" data-target="#myModal2">
                <p class="textTitle">La période</p>
                <p class="periode"></p>
            </div>

        </div>

        <div class="buttonSend">
            <button style="padding: 15px!important; background-color: white!important;" class="sendButton">Lancer la recherche</button>
        </div>
    </form>

        <div id= "result" class="result">
            <h2>Votre destination :</h2>
            <h4>Ville: <span id="ville"></span></h4>
            <h4>Température Min: <span id="temp_min"></span></h4>
            <h4>Température Max: <span id="temp_max"></span></h4>

        </div>

    </div>


    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                    <div class="stuff">
                        <main>
                            <div id="flat-slider"></div>
                            <input type="text" id="amount" placeholder="10°C - 20°C" readonly style="border:0; color:darkgrey; font-weight:bold;">
                        </main>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
                </div>
            </div>

        </div>
    </div>


    <div class="modal fade" id="myModal2" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                    <div class="month-picker">
                        <a href="#" class="month-picker-nav" title="Not implemented">&lt;</a>
                        <fieldset class="month-picker-fieldset">
                            <input type="radio" name="month" value="1" id="jan">
                            <label for="jan" class="month-picker-label">Janv</label>
                            <input type="radio" name="month" value="2" id="feb">
                            <label for="feb" class="month-picker-label">Fevr</label>
                            <input type="radio" name="month" value="3" id="mar">
                            <label for="mar" class="month-picker-label">Mars</label>
                            <input type="radio" name="month" value="4" id="apr">
                            <label for="apr" class="month-picker-label">Avri</label>
                            <input type="radio" name="month" value="5" id="may">
                            <label for="may" class="month-picker-label">Mai</label>
                            <input type="radio" name="month" value="6" id="jun">
                            <label for="jun" class="month-picker-label">Juin</label>
                            <input type="radio" name="month" value="7" id="jul">
                            <label for="jul" class="month-picker-label">Juil</label>
                            <input type="radio" name="month" value="8" id="aug">
                            <label for="aug" class="month-picker-label">Août</label>
                            <input type="radio" name="month" value="9" id="sep" checked>
                            <label for="sep" class="month-picker-label">Sept</label>
                            <input type="radio" name="month" value="10" id="oct">
                            <label for="oct" class="month-picker-label">Octo</label>
                            <input type="radio" name="month" value="11" id="nov">
                            <label for="nov" class="month-picker-label">Nove</label>
                            <input type="radio" name="month" value="12" id="dec">
                            <label for="dec" class="month-picker-label">Dece</label>
                        </fieldset>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
                </div>
            </div>

        </div>
    </div>


    <script src="../assets/js/thermometer.js"></script>
<script type="text/javascript">
    $(".sendButton").on('click', function(event){
        event.stopPropagation();
        event.stopImmediatePropagation();
        //alert("hb");
        //$(".result").toggle();

        let thermometer = $('#amount').val();
            let thermometerValues = thermometer.replace(/°C/g, '').replace(/\s/g, '').split('-');
            let thermometerMin = thermometerValues[0];
            let thermometerMax = thermometerValues[1];
            
            let month = $('[name="month"]:checked').val();

            // get the form data
            var formData = {
                'thermometerMin': thermometerMin,
                'thermometerMax': thermometerMax,
                'month': month
            };

            // process the form
            $.ajax({
                type        : 'POST', 
                url         : '../api/index.php', 
                data        : formData, 
                dataType    : 'json', 
                encode      : true,
                success: function(response) {

                    console.log(response);

                    if(response.status == 'ok'){
                        $('#ville').text(response.result.nom_ville);
                        $('#temp_min').text(response.result.temp_min);
                        $('#temp_max').text(response.result.temp_max);
                        $('body').scrollTo('#result');
                    }else{
                        
                        alert("Aucune ville ne correspond à vos critères");
                    } 
                }
            })

            // bloquer le submit par défaut
            event.preventDefault();
        });

            
    </script>
    </body>
    </html>
    </body>
</html>