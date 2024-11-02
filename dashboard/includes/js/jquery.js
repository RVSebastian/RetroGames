$("#marca").change(function () {
  var marca = document.getElementById("marca").value;
  console.log(marca);
  $.ajax({
    type: "POST",
    url: "./components/stocklist.php",
    data: {
      marca: marca,
    },
    beforeSend: function () {
      $("#before").show(), $("#buscarmd").hide(),$("#error").hide(),$("respuesta").hide(),$("resp").hide();
    },
  })
    .done(function (res) {
      $("#resp").html(res), $("#before").hide(), $("#buscarmd").show(),$("#error").hide(),$("resp").show(),$("respuesta").show();
    })
    .fail(function () {
      $("#error").show();
    });
    var table = $("#prueba").DataTable({
      ajax: "./components/stocklist.php",
      order: [
          [0, 'desc']
      ],
      select: true,
  });

});

$("#marca2").change(function () {
  var marca = document.getElementById("marca2").value;
  console.log(marca);
  $.ajax({
    type: "POST",
    url: "./components/stocklist.php",
    data: {
      marca: marca,
      repuesto: true,
    },
    beforeSend: function () {
      $("#before2").show(), $("#buscarmd2").hide(),$("#error").hide(),$("respuesta2").hide(),$("resp2").hide();
    },
  })
    .done(function (res) {
      $("#resp2").html(res), $("#before2").hide(), $("#buscarmd2").show(),$("#error2").hide(),$("resp2").show(),$("respuesta2").show();
    })
    .fail(function () {
      $("#error").show();
    });
});


// reparar esto
$("#buscar").change(function () {
  var marca = document.getElementById("marca").value;
  var buscador = document.getElementById("buscar").value;
  console.log(buscador);
  if (buscador.lenght > 4) {
    $.ajax({
      type: "POST",
      url: "./components/stocklist.php",
      data: {
        marca: marca,
        buscador: buscador,
      },
      beforeSend: function () {
        $("#before").hide(), $("#buscarmd").hide(),$("#error").hide(),$("resp").hide();
      },
    })
      .done(function (res) {
        $("#resp").html(res);
      })
      .fail(function () {
        $("#error").show();
      });
  }

  
});
// reparar esto
$("#buscar2").change(function () {
  var marca = document.getElementById("marca2").value;
  var buscador = document.getElementById("buscar2").value;
  console.log(buscador);
  if (buscador.lenght > 4) {
    $.ajax({
      type: "POST",
      url: "./components/stocklist.php",
      data: {
        marca: marca,
        buscador: buscador,
      },
      beforeSend: function () {
        $("#before2").show(), $("#buscarmd2").hide(),$("#error").hide(),$("respuesta2").hide(),$("resp2").hide();
      },
    })
      .done(function (res) {
        $("#resp2").html(res), $("#before2").hide(), $("#buscarmd2").show(),$("#error2").hide(),$("resp2").show(),$("respuesta2").show();
      })
      .fail(function () {
        $("#error").show();
      });
  }

  
});
