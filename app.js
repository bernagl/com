var url = 'http://64.251.10.6/Tintowin_WS/Tintowin_WS.asmx'
$.ajax({
  type: 'POST',
  url: './login.php',
  data: {
    exec: 'DatosCliente',
    data: { user: 'Mobkii', password: 'MobkiiTinto!', meses: 10 }
  },
  success: OnSuccessDatosCliente,
  error: OnErrorCall
})

function OnSuccessWsEstadoCtaCliente(response) {
  $(response)
    .find('WsEstadoCtaClienteResult')
    .each(function() {
      const a = JSON.parse($(this)[0].innerHTML)
      console.log(a)
    })
}

function OnSuccessDatosCliente(response) {
  $(response)
    .find('WsDatosClienteResult')
    .each(function() {
      const a = JSON.parse($(this)[0].innerHTML)
      console.log(a)
      const lastName = a.DATOS[0][0]
      const name = a.DATOS[0][1]
      const loyalty = a.DATOS[0][2]
      const points = a.DATOS[0][3]

      console.log(name, lastName, loyalty)
      $('#name').html(`${name} ${lastName}`)
      $('#loyalty span').html(loyalty)
      $('#points span').html(points)

      var ticketsBuffer = ''
      tickets.forEach(function(ticket) {
        ticketsBuffer += `<tr>
        <td>${ticket[0]}</td>
        <th>${ticket[1]}</th>
        <th>${ticket[2]}</th>
        <th>${ticket[3]}</th>
        <th>${ticket[4]}</th>
        <th>${ticket[5]}</th>
        <th>${format_currency(ticket[6])}MXN</th>
        <th>${ticket[7]}</th>
        <th>${ticket[8]}</th>
        <th>${ticket[9]}</th>
        <th>${ticket[10]}</th>
        <th>${ticket[11]}</th>
        <th>${ticket[12]}</th>
        <th class="generateFacturaPDF" data-id="${ticket[0]}">Factura PDF</th>
        <th class="generateFactura" data-id="${ticket[0]}">Factura</th>
    </tr>`
      })

      $('table tbody').html(ticketsBuffer)
      $(document).ready(function() {
        $('table').DataTable({
          language: {
            url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
          }
        })
      })
    })
}

$(document).on('click', '.generateFacturaPDF', function(e) {
  console.log('...')
  var id = $(this).attr('data-id')
  $.ajax({
    type: 'POST',
    url: './login.php',
    data: {
      exec: 'TicketPDF',
      data: { idTicket: id }
    },
    success: function(r) {
      console.log(r)
    },
    error: function(e) {
      console.log(e)
    }
  })
})(function() {
  $.ajax({
    type: 'POST',
    url: './login.php',
    data: {
      exec: 'WsEsctadoCtaCliente',
      data: { user: 'Mobkii', password: 'MobkiiTinto!', meses: 10 }
    },
    success: function(response) {
      $(response)
        .find('WsEstadoCtaClienteResult')
        .each(function() {
          const a = JSON.parse($(this)[0].innerHTML)
          console.log(a)
        })
    },
    error: function(e) {
      console.log(e)
    }
  })
})()

$(document).on('click', '.generateFactura', function(e) {
  console.log('...')
  var id = $(this).attr('data-id')
  $.ajax({
    type: 'POST',
    url: './login.php',
    data: {
      exec: 'Factura',
      data: { idTicket: id }
    },
    success: function(r) {
      console.log(r)
    },
    error: function(e) {
      console.log(e)
    }
  })
})

function OnSuccessWsTicketsCliente(response) {
  console.log(response)
  $(response)
    .find('WsTicketsCliente')
    .each(function() {
      const a = JSON.parse($(this)[0].innerHTML)
      console.log(a)
    })
}

function OnSuccessCallLogin(response) {
  $(response)
    .find('WSLoginUsuarioResult')
    .each(function() {
      const a = JSON.parse($(this)[0].innerHTML)
      $.ajax({
        type: 'POST',
        url: './login.php',
        data: {
          exec: 'setLogin',
          data: { uid: a.DATOS[0][0] }
        },
        success: e => console.log(e),
        error: e => console.log(2)
      })
    })
}

function OnErrorCall(response) {
  console.log(response)
}

function format_currency(v) {
  return isNaN(v)
    ? v
    : '$' +
        parseInt(v || 0).toLocaleString() +
        '.' +
        (v * 1).toFixed(2).slice(-2)
}
