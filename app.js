var url = 'http://64.251.10.6/Tintowin_WS/Tintowin_WS.asmx'

function request(data, success, error) {
  $.ajax({
    type: 'POST',
    url: './login.php',
    data: data,
    success: success,
    error: error
  })
}

;(function getUser() {
  const data = {
    exec: 'login',
    data: { user: 'Mobkii', password: 'MobkiiTinto!', meses: 10 }
  }

  request(data, OnSuccessCallLogin, function(e) {
    console.log(e)
  })
})()

function OnSuccessWsEstadoCtaCliente(response) {
  $(response)
    .find('WsEstadoCtaClienteResult')
    .each(function() {
      const a = JSON.parse($(this)[0].innerHTML)
      console.log(a)
    })
}

function getDatosCliente() {
  const data = { exec: 'DatosCliente' }
  request(data, function(response) {
    $(response)
      .find('WsDatosClienteResult')
      .each(function() {
        const a = JSON.parse($(this)[0].innerHTML)
        const lastName = a.DATOS[0][0]
        const name = a.DATOS[0][1]
        const loyalty = a.DATOS[0][2]
        const points = a.DATOS[0][3]
        $('#name').html(`${name} ${lastName}`)
        $('#loyalty span').html(loyalty)
        $('#points span').html(points)
      })
  })
}

function tickets(response) {
  $(response)
    .find('WsTicketsClienteResult')
    .each(function() {
      const a = JSON.parse($(this)[0].innerHTML)
    })
}

$(document).on('click', '.generateFacturaPDF', function(e) {
  var id = $(this).attr('data-id')
  const data = {
    exec: 'TicketPDF',
    data: { idTicket: id }
  }

  request(
    data,
    function(response) {
      $(response)
        .find('WsTicketPDFResult')
        .each(function() {
          const { DATOS } = JSON.parse($(this)[0].innerHTML)
          window.open(DATOS[0], '_blank')
        })
    },
    function(response) {}
  )
})

function getUserTickets() {
  const data = { exec: 'WsTicketsCliente' }
  request(
    data,
    function(response) {
      $(response)
        .find('WsTicketsClienteResult')
        .each(function() {
          const a = JSON.parse($(this)[0].innerHTML)
          renderTickets(a)
        })
    },
    function(error) {}
  )
}

$(document).on('click', '.generateFactura', function(e) {
  var id = $(this).attr('data-id')
  const data = {
    exec: 'Factura',
    data: { idTicket: id }
  }

  request(
    data,
    function(response) {
      $(response)
        .find('WsFacturaResult')
        .each(function() {
          const { RESULTADO, DATOS } = JSON.parse($(this)[0].innerHTML)
          if (RESULTADO[0][0] !== 0) {
            alert(RESULTADO[0][1])
          } else {
            console.log(DATOS[0][0])
          }
        })
    },
    function(e) {}
  )
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
      const data = {
        exec: 'setLogin',
        data: { uid: a.DATOS[0][0] }
      }
      request(
        data,
        function(response) {
          getUserTickets()
          getDatosCliente()
        },
        e => consol.log(e)
      )
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

function renderTickets({ DATOS: tickets }) {
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
    <th class="cursor-pointer generateFacturaPDF" data-id="${
      ticket[12]
    }">Factura PDF</th>
    <th class="cursor-pointer generateFactura" data-id="${
      ticket[12]
    }">Factura</th>
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
}
