// const wooClientKey='ck_ab00ea5ccea9c48c63cabaace66eb3e6d3ad3483';
// const wooSecretKey='cs_6422a772837a1b9de6d3f45fc8bcdd8a0935e5d3';
const getPriceByVariations =
  "http://localhost/aventurax.co/wp-json/custom-tour/v1/getPriceByIdProductVariation";
const addProductVariationToCart =
  "http://localhost/aventurax.co/wp-json/custom-tour/v1/addProductVariationToCart";



var tour = {
  IdProduct: "",
  Origen: "",
  Acomodacion: "",
  Fecha: "",
  Pago: "",
  valor: "",
  VariationId: "",
};

jQuery(function ($) {
  // now you can use jQuery code here with $ shortcut formatting
  // this executes immediately - before the page is finished loading
});

jQuery(document).ready(function ($) {
  // now you can use jQuery code here with $ shortcut formatting
  // this will execute after the document is fully loaded
  // anything that interacts with your html should go here

  //Inicializamos los valores del objeto tour
  function getIdProduct() {
    return $("#IdProduct")
      .text()
      .replace(/\t/g, "")
      .replace(/\n/g, "")
      .replace(" ", "")
      .toLowerCase();
  }

  function getOrigen() {
    return $("#txtOrigen")
      .text()
      .replace(/\t/g, "")
      .replace(/\n/g, "")
      .replace(" ", "")
      .toLowerCase();
  }

  function getPago() {
    return $("#txtPago")
      .text()
      .replace(/\t/g, "")
      .replace(/\n/g, "")
      .replace(" ", "")
      .toLowerCase();
  }

  function getAcomodacion() {
    return $("#txtAcomodacion")
      .text()
      .replace(/\t/g, "")
      .replace(/\n/g, "")
      .replace(" ", "")
      .toLowerCase();
  }

  function getFecha() {
    return $(".selectedFecha")
      .text()
      .replace(/\t/g, "")
      .replace(/\n/g, "")
      .replace(" ", "")
      .toLowerCase();
  }

  function getPrice() {
    var request = $.ajax({
      type: "POST",
      url: getPriceByVariations,
      data: tour,
      dataType: "json",
      success: function (response) {
        var formatter = new Intl.NumberFormat("es-US", {
          style: "currency",
          currency: "USD",
          maximumFractionDigits: 0,
        });
        $("#txtPrecio").text(formatter.format(response.salePrice) + " COP");
        console.log(response.salePrice);
      },
    });
  }

  tour.IdProduct = getIdProduct();
  tour.Origen = getOrigen();
  tour.Pago = getPago();
  tour.Acomodacion = getAcomodacion();
  tour.Fecha = getFecha();
  tour.valor = getPrice();
  
  
  console.log(tour);

  if($('.tercerDropdown ul li').length <2){
    $('.tercerDropdown').addClass('Ocultar');
    $('.boxFechas').css("top", "258px");
    // let ss = document.styleSheets[0];
    // let rules = ss.cssRules || ss.rules;
    // let topRule = null;
    // for (let i = 0; i < rules.length; i++){
    //   let rule = rules[i];
    // }
  }
  $("#menuOrigenes").addClass('Ocultar');
  $(".segundoDropdown > ul").addClass('Ocultar');
  $(".tercerDropdown > ul").addClass('Ocultar');
  
  
  
  var toggleOrigen = true;
  $(".primerDropdown").on("click", function(e){
    if(toggleOrigen){
      $("#menuOrigenes").removeClass('Ocultar');
      $("#menuOrigenes").addClass('Mostrar');
      toggleOrigen = false;
    }else{
      $("#menuOrigenes").removeClass('Mostrar');
      $("#menuOrigenes").addClass('Ocultar');
      toggleOrigen = true;
    }
  });

  
  var togglePagos = true;
  $(".segundoDropdown").on("click", function(e){
    if(togglePagos){
      $("#menuPagos").removeClass('Ocultar');
      $("#menuPagos").addClass('Mostrar');
      togglePagos = false;
    }else{
      $("#menuPagos").removeClass('Mostrar');
      $("#menuPagos").addClass('Ocultar');
      togglePagos = true;
    }
  });

  var toggleAcomodaciones = true;
  $(".tercerDropdown").on("click", function(e){
    if(toggleAcomodaciones){
      $("#menuAcomodaciones").removeClass('Ocultar');
      $("#menuAcomodaciones").addClass('Mostrar');
      toggleAcomodaciones = false;
    }else{
      $("#menuAcomodaciones").removeClass('Mostrar');
      $("#menuAcomodaciones").addClass('Ocultar');
      toggleAcomodaciones = true;
    }
  });

  $(".primerDropdown").on("click", "li", function (e) {
    $("#txtOrigen").text($(this).text());
    tour.Origen = getOrigen();
    getPrice();
  });

  //Dropdown Pago Evento Click
  $(".segundoDropdown").on("click", "li", function (e) {
    $("#txtPago").text($(this).text());
    tour.Pago = getPago();
    getPrice();
  });
  //Dropdown Acomodacion Evento Click
  $(".tercerDropdown").on("click", "li", function (e) {
    $("#txtAcomodacion").text($(this).text());
    tour.Acomodacion = getAcomodacion();
    getPrice();
  });
  //Fechas seleccion al Evento Click
  $(".boxFecha").on("click", function (e) {
    $(".boxFecha").removeClass("selectedFecha");
    $(this).addClass("selectedFecha");
    tour.Fecha = getFecha();
    console.log(tour);
    getPrice();
  });

  $('.boxCarrito').on('click', function(e){ 
    e.preventDefault();
    $thisbutton = $(this)
    
    var data = {
            action: 'ql_woocommerce_ajax_add_to_cart',
            product_id: tour.IdProduct,
            product_sku: '',
            quantity: 1,
            variation_id: tour.VariationId,
        };
    $.ajax({
            type: 'post',
            url: wc_add_to_cart_params.ajax_url,
            data: data,
            beforeSend: function (response) {
                $thisbutton.removeClass('added').addClass('loading');
            },
            complete: function (response) {
                $thisbutton.addClass('added').removeClass('loading');
            }, 
            success: function (response) { 
                if (response.error & response.product_url) {
                    window.location = response.product_url;
                    return;
                } else { 
                    $thisbutton.addClass('Ok').removeClass('added');
                    console.log('Producto adicionado al carrito');
                    //$(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);
                } 
            }, 
        }); 
     });

});
