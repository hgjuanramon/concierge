window.CORE = (window.CORE || {});
var APP = {};
(function (window, document, $, undefined) {

    this.init = function (options) {
        this.settings = $.extend({}, options, this.settings);
        return this;
    };
    this.run = function () {

        switch (this.settings.module) {
            case 'search':
            case 'home':
                $(document).ready(function () {
                    $('.slider1').bxSlider({
                        slideWidth: 300,
                        minSlides: 1,
                        maxSlides: 4,
                        slideMargin: 10
                    });
                });

                $('#state_id').on('change', function () {
                    var id = $(this).val();
                    $.ajax({
                        url: APP.base_url(APP.settings.module + '/get_municipios'),
                        data: {state_id: id},
                        dataType: "html",
                        type: "get",
                        beforeSend: function () {
                            $('.city_id .controls').append('<img class="loader" src="assets/images/loading/ajax-loader.gif">');
                        },
                        complete: function () {
                            $('.city_id .controls .loader').remove();
                        },
                        success: function (response) {
                            $('#city_id').html(response);
                        }
                    });
                });
                $('#order').on('change', function () {
                    var order = $(this).val();
                    window.location.href = SetParamUrl(window.location.href, 'order', order);
                });
                $('#from').on('keyup', function () {
                    $(this).val(number_format($(this).val()));
                });
                $('#to').on('keyup', function () {
                    $(this).val(number_format($(this).val()));
                });

                break;

            case 'contacto':
                var id_plaza = $('#id_plaza').val();
                var objLocation = JSON.parse(getLocation({id_plaza: id_plaza}));
                
                var dvMapa = document.getElementById('map');
                var gLat = objLocation.location.lat;
                var gLng = objLocation.location.lng;

                getMap(dvMapa, gLat, gLng);
                break;
            case 'realty':
                if (this.settings.action === "detail") {
                    var id_propiedad = $('#property_id').val();
                    var objLocation = JSON.parse(getLocation({id_propiedad: id_propiedad}));

                    var dvMapa = document.getElementById('map');
                    var gLat = objLocation.location.lat;
                    var gLng = objLocation.location.lng;

                    getMap(dvMapa, gLat, gLng);

                    $('#is_prospecto').on('change', function () {
                        if ($(this).is(':checked')) {
                            $(this).val(1);
                            $('.prospecto').removeClass('hidden');
                            $('.email').addClass('hidden');
                        } else {
                            $(this).val('0');
                            $('.prospecto').addClass('hidden');
                            $('.email').removeClass('hidden');
                        }
                    });
                    $('.btn-modal-email').on('click', function () {
                        var id = $(this).attr('id');
                        $('#myModal').modal('show');

                    });
                }
                break;
        }
        this.init_common();
    };
    this.init_common = function () {

        $('.go-up').click(function () {
            $('body, html').animate({
                scrollTop: '0px'
            }, 300);
        });
        $(window).scroll(function () {
            if ($(this).scrollTop() > 0) {
                $('.go-up').slideDown(300);
            } else {
                $('.go-up').slideUp(300);
            }
        });
    }
    var number_format = function (number) {
        var nums = new Array();
        var simb = ","; //Éste es el separador
        number = number.toString();
        number = number.replace(/\D/g, "");   //Ésta expresión regular solo permitira ingresar números
        nums = number.split(""); //Se vacia el valor en un arreglo
        var long = nums.length - 1; // Se saca la longitud del arreglo
        var patron = 3; //Indica cada cuanto se ponen las comas
        var prox = 2; // Indica en que lugar se debe insertar la siguiente coma
        var res = "";
        while (long > prox) {
            nums.splice((long - prox), 0, simb); //Se agrega la coma
            prox += patron; //Se incrementa la posición próxima para colocar la coma
        }
        for (var i = 0; i <= nums.length - 1; i++) {
            res += nums[i]; //Se crea la nueva cadena para devolver el valor formateado
        }
        return res;
    }
    var getLocation = function (data) {

        var jsonData = $.ajax({
            url: APP.base_url(APP.settings.module + '/get_location'),
            data: data,
            dataType: "json",
            async: false
        }).responseText;

        return jsonData;

    }

    var getMap = function (dvMapa, gLat, gLng) {

        function initialize() {
            var gLatLng = new google.maps.LatLng(gLat, gLng);
            var objConfigMap = {
                zoom: 15,
                center: gLatLng
            }

            var gMapa = new google.maps.Map(dvMapa, objConfigMap);

            var marker = new google.maps.Marker({
                position: gLatLng,
                map: gMapa,
                // Define the place with a location, and a query string.
            });
        }

        google.maps.event.addDomListener(window, 'load', initialize);
    }
    /*Funcion que actualiza el parametro de la url*/
    var SetParamUrl = function (uri, key, value) {
        var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
        var separator = uri.indexOf('?') !== -1 ? "&" : "?";
        if (uri.match(re)) {
            return uri.replace(re, '$1' + key + "=" + value + '$2');
        }
        else {
            return uri + separator + key + "=" + value;
        }
    }

}).apply(APP, [window, window.document, jQuery]);
APP = $.extend({}, window.CORE, APP);